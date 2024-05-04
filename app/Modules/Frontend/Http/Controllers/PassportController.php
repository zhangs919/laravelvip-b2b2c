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
// | Date:2018-08-17
// | Description: 登录注册
// +----------------------------------------------------------------------

namespace App\Modules\Frontend\Http\Controllers;

use App\Models\User;
use App\Modules\Base\Http\Controllers\Frontend;
use App\Repositories\UserRepository;
use App\Services\ConnectApi;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

/**
 * 登录注册
 *
 * Class PassportController
 * @package App\Modules\Frontend\Http\Controllers
 */
class PassportController extends Frontend
{

    use AuthenticatesUsers;

//    protected $redirectTo = '/main';
//    protected $username;

    protected $userRep;
    protected $connectApi;

    public function __construct(UserRepository $userRep, ConnectApi $connectApi)
    {
        parent::__construct();

        $this->userRep = $userRep;
        $this->connectApi = $connectApi;

        $this->middleware('guest:user')->except('logout');
    }


    /**
     * 登录表单
     *
     * @param Request $request
     * @return mixed
     * @throws \Throwable
     */
    public function showLoginForm(Request $request)
    {
        if (is_login()) {
            return redirect('/');
        }
        $uuid = make_uuid();
        if ($request->ajax()) {
            $render = view('passport.ajax_login', compact('uuid'))->render();
            return result(0, $render);
        }
        $seo_title = '登录 - ' . sysconf('site_name');

        $show_captcha = false; // 是否显示验证码
        if ($this->hasTooManyLoginAttempts($request)) {
            $show_captcha = true;
        }
        $tpl = 'login';
        if (is_weixin() && $request->get('type') != 'mobile') {
            $tpl = 'login_weixin';
        }
        return view('passport.'.$tpl, compact('uuid', 'seo_title', 'show_captcha'));
    }

    protected function redirectPath()
    {
        $back_url = \request()->post('back_url', '/');
        return $back_url;
    }

    /**
     * 重写登陆验证方法
     *
     * @param Request $request
     */
    protected function validateLogin(Request $request)
    {

		if ($request->input('SmsLoginModel.mobile')) {
			$this->validate($request, [
				'SmsLoginModel.mobile' => 'required|string',
				'SmsLoginModel.smsCaptcha' => 'required|string',
			], [
				'SmsLoginModel.mobile.required' => '手机号不能为空',
				'SmsLoginModel.smsCaptcha.required' => '验证码不能为空',
			]);
		} elseif ($request->input('LoginModel.username')) {
			$this->validate($request, [
				'LoginModel.username' => 'required|string',
				'LoginModel.password' => 'required|string',
			], [
				'LoginModel.username.required' => '用户名不能为空',
				'LoginModel.password.required' => '密码不能为空',
			]);
		}

    }

    /**
     * 重写登陆方法
     *
     * @param Request $request
     * @return mixed
     */
    protected function attemptLogin(Request $request)
    {
        $res = $this->connectApi->attemptLogin($request);
        if (isset($res['code']) && $res['code'] == -1) {
            flash('error', $res['message']);
            return redirect($res['redirect'])->withInput();
        }
		if ($request->input('SmsLoginModel.mobile')) { // 动态密码登录
			$back_url = $request->input('back_url');
			return redirect($back_url);
		}
        return $this->guard()->attempt(
            $res['data']
            , $request->filled('remember')
        );
    }

    /**
     * The user has been authenticated.
     *
     * @param \Illuminate\Http\Request $request
     * @param mixed $user
     * @return mixed
     */
    protected function authenticated(Request $request, $user)
    {
        // 存user到session
        $request->session()->put('user', $user);

        // 登录成功 记录登录日志
        user_log(is_login(), 1);

        // ajax 登录
        $ajax_layout = $request->post('ajax_layout', 0);
        if ($ajax_layout) {
            $back_url = $request->post('back_url', '');
            return result(0, ['back_url' => $back_url], '登录成功');
        }
    }

    /**
     * 重写guard方法
     *
     * @return mixed
     */
    protected function guard()
    {
        return auth()->guard('user');
    }

    /**
     * 重写username方法
     *
     * @return string
     */
    public function username()
    {
        return 'user_name';
    }

    /**
     * 注册
     *
     * @param Request $request
     * @return mixed
     */
    public function showRegisterForm(Request $request)
    {
        $seo_title = sysconf('site_name') . ' - 注册';

        $reg_type = 'mobile';
        if ($request->path() == 'register/email.html') {
            $reg_type = 'email';
        }

        if ($request->method() == 'POST') {


            $res = $this->connectApi->attemptRegister($request, $reg_type);
            if (isset($res['code']) && $res['code'] == -1) {
                flash('error', $res['message']);
                return redirect('/register.html')->withInput($res['register_model']);
            }

            // 手动认证登录
            $this->guard()->attempt(
                $res['data']
            );
			$user = auth('user')->user();

            // 存user到session
            Session::put('user', $user);
            // 登录成功 记录登录日志
            user_log(is_login(), 1);

			if ($reg_type == 'mobile' && is_mobile() || (request()->getHost() == config('lrw.mobile_domain'))) {
				return view('passport.register', compact('seo_title', 'user'));
			} else {
				$ref_url = route('pc_home'); // 暂时默认跳转回网站首页
            	return redirect($ref_url);
			}
        }

        return view('passport.register_' . $reg_type, compact('seo_title', 'reg_type'));
    }

    /**
     * 手机号/邮箱验证是否重复
     * @param Request $request
     * @return array
     */
    public function clientValidate(Request $request)
    {
        $attribute = $request->get('attribute');
        $requestModel = '';
        if ($attribute == 'mobile') {
            $requestModel = 'MobileRegisterModel';
        } elseif ($attribute == 'email') {
            $requestModel = 'EmailRegisterModel';
        }
        $result = $this->userRep->clientValidate($request, $requestModel);
        if (!$result['code']) {
            return result(-1, '', $result['message']);
        }
        return result(0);
    }

    /**
     * 发送短信验证码
     *
     * @param Request $request
     * @return mixed
     */
    public function smsCaptcha(Request $request)
    {
        $params = $request->all();
        $mobile = $request->post('mobile');
        $captcha = $request->post('captcha');
        $log_type = 1; // 注册会员
        if (array_has($params,'captcha') && empty($params['captcha'])) {
            return result(-1, null, '验证码不能为空');
        }
        if (!empty($captcha) && $captcha != session('captcha')) {
            return result(-1, null, '验证码有误');
        }

        // 发送频繁
//        return result(-1, ['show_captcha'=>1], '每60秒内只能发送一次短信验证码，请稍候重试', ['errors'=>['mobile' => ['每60秒内只能发送一次短信验证码，请稍候重试']]]);
        $ret = $this->connectApi->sendCaptcha($mobile, $log_type);
        if (!$ret['code']) {
            return result(-1, null, $ret['message']);
        }
        return result(0, null, '发送成功');
    }

	public function checkSmsCaptcha(Request $request)
	{
		$params = $request->all();
		$mobile = $request->post('mobile');
		$sms_captcha = $request->post('sms_captcha');

		// 验证手机验证码
		if (config('app.env') == 'production' && $sms_captcha != session('sms_captcha')) {
			return arr_result(-1, null, '验证码输入错误');
		}

		return result(0, null, '验证成功');
	}

    public function emailCaptcha(Request $request)
    {

        $message = 'test';
        $to = '410284576@qq.com';
        $subject = '测试邮件';
        Mail::send(
            'emails.register_tpl', // 邮件模板
            ['content' => $message],
            function ($message) use ($to, $subject) {
                $message->to($to)->subject($subject);
            }
        );
        // 返回的一个错误数组，利用此可以判断是否发送成功
        dd(Mail::failures());
//        $ret = false;
//        if (!$ret) {
//            return result(-1, null, '邮箱验证码发送失败');
//        }
//        return result(0, null, '邮箱验证码发送成功');
    }

    /**
     * 重写退出登录
     *
     * @param Request $request
     * @return string
     */
    protected function loggedOut(Request $request)
    {
        session()->invalidate();
        return redirect('/login.html');
    }
}
