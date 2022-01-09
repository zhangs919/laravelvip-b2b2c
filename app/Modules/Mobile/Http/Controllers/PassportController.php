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

namespace App\Modules\Mobile\Http\Controllers;

use App\Modules\Base\Http\Controllers\Mobile;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class PassportController extends Mobile
{

    use AuthenticatesUsers;

//    protected $redirectTo = '/main';
//    protected $username;

    protected $userRep;

    public function __construct()
    {

        parent::__construct();

        $this->userRep = new UserRepository();

        $this->middleware('guest:user')->except('logout');
    }

    /**
     * 登录表单
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Throwable
     */
    public function showLoginForm(Request $request)
    {
        $uuid = make_uuid();
        if ($request->ajax()) {
            $render = view('passport.ajax_login', compact('uuid'))->render();
            return result(0, $render);
        }
        $seo_title = sysconf('site_name').' - 登录';

        return view('passport.login', compact('uuid', 'seo_title'));
    }

    protected function redirectPath()
    {
        return '/';
    }

    /**
     * 重写登陆验证方法
     *
     * @param Request $request
     */
    protected function validateLogin(Request $request)
    {

        $this->validate($request, [
            'LoginModel.username' => 'required|string',
            'LoginModel.password' => 'required|string',
        ], [
            'LoginModel.username.required' => '用户名不能为空',
            'LoginModel.password.required' => '密码不能为空',
        ]);
    }

    /**
     * 重写登陆方法
     *
     * @param Request $request
     * @return mixed
     */
    protected function attemptLogin(Request $request)
    {
        $loginData = [];
        if (Input::get('SmsLoginModel.mobile')) { // 动态密码登录
            $loginData = []; // todo
        } elseif($username = Input::get('LoginModel.username')) { // 普通登录
            if (check_is_mobile($username)) { // 手机号登录
                $username_field = 'mobile';
            } elseif (check_is_email($username)) { // 邮箱登录
                $username_field = 'email';
            } else { // 默认用户名登录
                $username_field = 'user_name';
            }
            $loginData = [$username_field => Input::get('LoginModel.username'), 'password' => Input::get('LoginModel.password')];
        }

        return $this->guard()->attempt(
            $loginData
            , $request->filled('remember')
        );
    }

    /**
     * The user has been authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function authenticated(Request $request, $user)
    {
        // 存user到session
        $request->session()->put('user', $user);
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
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showRegisterForm(Request $request)
    {
        $seo_title = sysconf('site_name').' - 注册';

        $reg_type = 'mobile';
        if ($request->path() == 'register/email.html') {
            $reg_type = 'email';
        }

        if ($request->method() == 'POST') {
            $ref_url = route('pc_home'); // 暂时默认跳转回网站首页

            if ($reg_type == 'mobile') {
                // 手机注册
                $MobileRegisterModel = $request->input('MobileRegisterModel');

                // 验证图片验证码
                if (isset($MobileRegisterModel['captcha'])) {
                    $inputImgCaptcha = $MobileRegisterModel['captcha'];
                    $imgCaptcha = session('laravelvipcaptcha'); // 图片验证码
                    if ($inputImgCaptcha != $imgCaptcha) {
                        flash('error', '验证码不正确。');

                        return redirect('/register.html')->withInput($MobileRegisterModel);
                    }
                }

                // todo 验证手机验证码

                // 保存注册信息
                $ret = $this->userRep->register($MobileRegisterModel);
                if ($ret['code'] < 0) {
                    flash('error', '注册信息保存失败。');
                    return redirect('/register.html')->withInput($MobileRegisterModel);
                }
                flash('success', '注册成功。');

                // 登录
                $this->guard()->attempt(
                    ['mobile' => Input::get('MobileRegisterModel.mobile'), 'password' => Input::get('MobileRegisterModel.password')]
                    , $request->filled('remember')
                );
                // 存user到session
                $request->session()->put('user', auth('user')->user());
                return redirect($ref_url);
            }
            $remember = $request->input('remember', 0); // 是否同意用户注册协议

            // 注册验证参数

            // 注册保存数据

            flash('error', '注册失败');
            redirect('/');
//            return result(0, '', '注册成功');
        }

        return view('passport.register_' . $reg_type, compact('seo_title'));
    }

    /**
     * 手机号验证是否重复
     * @param Request $request
     * @return array
     */
    public function clientValidate(Request $request)
    {
        $result = $this->userRep->clientValidate($request, 'MobileRegisterModel');
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
        $mobile = $request->get('mobile');
        $captcha = $request->get('captcha');

        // 发送频繁
//        return result(-1, ['show_captcha'=>1], '每60秒内只能发送一次短信验证码，请稍候重试', ['errors'=>['mobile' => ['每60秒内只能发送一次短信验证码，请稍候重试']]]);


        return result(0, null, '发送成功');
    }
}