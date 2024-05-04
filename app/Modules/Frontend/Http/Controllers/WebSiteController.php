<?php

// +----------------------------------------------------------------------
// | laravelvip 乐融沃B2B2C商城系统
// +----------------------------------------------------------------------
// | Copyright (c) 2017-2027 http://www.laravelvip.com All rights reserved.
// +----------------------------------------------------------------------
// | Notice: This code is not open source, it is strictly prohibited
// |         to distribute the copy, otherwise it will pursue its
// |         legal responsibility.
// +----------------------------------------------------------------------
// | 版权所有 2015-2027 云南乐融沃网络科技有限公司，并保留所有权利。
// | 网站地址: http://www.laravelvip.com
// +----------------------------------------------------------------------
// | 这不是一个自由软件！禁止拷贝本软件副本，否则将追究其法律责任！
// | 如需使用，请移步官网购买正版授权。
// +----------------------------------------------------------------------
// | Author: 雲溪荏苒 <290648237@qq.com>
// | Date:2020-11-06
// | Description:第三方登录
// +----------------------------------------------------------------------

namespace App\Modules\Frontend\Http\Controllers;

use App\Models\User;
use App\Modules\Base\Http\Controllers\Frontend;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Overtrue\Socialite\SocialiteManager;

class WebSiteController extends Frontend
{
    protected $type;
    protected $socialite;
    protected $driver = '';
    protected $third_key;

    public function __construct()
    {
        parent::__construct();

        $this->type = \request()->input('type');
        $this->driver = third_login_driver($this->type);
        $this->third_key = third_login_key($this->type);

        if (!$this->driver) {
//            abort(404, '还没有安装此插件！');
        }

        $redirect = request()->getSchemeAndHttpHost()."/website/act-login.html?type=".$this->type;

		$wechat_client_id = '';
		$wechat_client_secret = '';
		if ($this->type == 'pc_weixin') {
			$wechat_client_id = sysconf('pc_weixin_app_key');
			$wechat_client_secret = sysconf('pc_weixin_app_secret');
		} elseif ($this->type == 'mobile_weixin') {
			$wechat_client_id = sysconf('mobile_weixin_app_key');
			$wechat_client_secret = sysconf('mobile_weixin_app_secret');
		}

        $config = [
            'qq' => [
                'provider' => 'qq', // 自定义driver名称
                'client_id' => sysconf('qq_app_key'),
                'client_secret' => sysconf('qq_app_secret'),
                'redirect' => $redirect
            ],

            'weibo' => [
                'provider' => 'weibo', // 自定义driver名称
                'client_id' => sysconf('weibo_app_key'), // mobile_weibo_app_key
                'client_secret' => sysconf('weibo_app_secret'),//mobile_weibo_app_secret
                'redirect' => $redirect
            ],

            //> WeChat scopes:
            //- `snsapi_base`, `snsapi_userinfo` - Used to Media Platform Authentication.
            //- `snsapi_login` - Used to web Authentication.
            'wechat' => [ // snsapi_userinfo:移动端登录 snsapi_login:web端登录
                'provider' => 'wechat', // 自定义driver名称 没效果
                'client_id' => $wechat_client_id, // mobile_weixin_app_key、pc_weixin_app_key
                'client_secret' => $wechat_client_secret, //mobile_weixin_app_secret、pc_weixin_app_secret
                'redirect' => $redirect
            ],

            'github' => [
                'provider' => 'github', // 自定义driver名称
                'client_id' => 'xxx',
                'client_secret' => 'xxxxx',
                'redirect' => $redirect,
            ],
        ];

        $socialite = new SocialiteManager($config);

        if ($this->driver) {
			if ($this->type == 'pc_weixin') {
				$this->socialite = $socialite->create($this->driver)->scopes(['snsapi_login']);
			} elseif ($this->type == 'mobile_weixin') {
				$this->socialite = $socialite->create($this->driver)->scopes(['snsapi_userinfo']);
			} else {
				$this->socialite = $socialite->create($this->driver);
			}
		}

    }

    /**
     * 跳转进行授权
     *
     * @param Request $request
     */
    public function login(Request $request)
    {
//        if ($this->type == 'pc_weixin') {
//            $response = $this->socialite
//                ->driver($this->driver)
//                ->scopes(['snsapi_login'])
//                ->redirect();
//        } elseif ($this->type == 'mobile_weixin') {
//            $response = $this->socialite
//                ->driver($this->driver)
//                ->scopes(['snsapi_userinfo'])
//                ->redirect();
//        } else {
//            $response = $this->socialite
//            ->driver($this->driver)
//////            ->with(['hd'=>'bind']) // 设置额外参数
//////            ->withRedirectUrl($url) //动态设置 redirect
//////            ->redirect($url) // 动态设置 redirect
////            ->scopes(['snsapi_userinfo'])
//            ->redirect();
//        }

        $url = $this->socialite->redirect();
        return redirect($url);
    }

    /**
     * 登录回调
     *
     * @param Request $request
     * @return mixed
     */
    public function actLogin(Request $request)
    {
        // 根据access_token 获取用户信息
//        $access_token = $request->get('access_token');
//        $user = $this->socialite->user($access_token);

		$code = $request->get('code');
		$user = $this->socialite->userFromCode($code);
		Log::error(json_encode($user));


		// 获取access_token
//        $access_token = $user->getAccessToken();
//        $access_token = new AccessToken(['access_token' => $access_token]);

        if (empty($user)) {
            flash('error', '授权失败，请重试！');
            return redirect('/');
        }

        // 绑定信息
        $openid = $user->getId(); // openid
        $open_info = $user->getRaw(); // 不保存信息
        $open_info['third_key'] = $this->third_key;
		$open_info['id'] = $openid;
		$open_info['name'] = $user->getName();
		$open_info['avatar_url'] = $user->getAvatar();

        // 验证用户是否存在
        $user_info = User::where([[$this->third_key.'_key', $openid]])->first();
        if (empty($user_info)) {
            // 不存在
            // 判断是否登录
            if (!is_login()) { // 跳转到账号绑定页面
                Session::put('third_login_info', $open_info);
//                return redirect('/bind'); // PC
                return redirect('/bind/bind/mobile'); // 微商城
            }
            // 执行绑定
            $update = [
                "{$this->third_key}_key" => $openid,
            ];

            $ret = User::where('user_id', $this->user_id)->update($update);

            if ($ret === false) {
                flash('error', '绑定失败！');
                return redirect('/');
            }

            return redirect('/user/bind.html');
        } else {
            // 存在 登录成功 更新登录信息
            $update = [
                'last_login' => date('Y-m-d H:i:s', time()),
                'last_ip' => request()->ip(),
                'visit_count'=>($user_info->visit_count+1),
            ];
            User::where('user_id', $user_info->user_id)->update($update);

            // 手动身份认证登录
            auth('user')->login($user_info);

            // 存user到session
            Session::put('user', $user_info);

            // 记录日志
            user_log($user_info->user_id,1);

            return redirect('/');
        }
    }

    public function oauth(Request $request)
    {
        $url = $request->input('url', 'login');
        $shop_id = $request->input('shop_id', 0);

        // 跳转微信免登陆
//        $response = $this->socialite->redirect();
//        $response->send();
		$url = $this->socialite->redirect();
		return redirect($url);
    }

}
