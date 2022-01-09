<?php

namespace App\Modules\Backend\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class PassportController extends Controller
{

    use AuthenticatesUsers;

//    protected $redirectTo = '/main';
//    protected $username;

    public function __construct()
    {

        $this->middleware('guest:admin')->except('logout');
//        $this->username = config('admin.global.username');
    }

    public function showLoginForm(Request $request)
    {
//        dd(session()->flash('user_name'));
        if ($request->ajax()) {
            $uid = make_uuid();
            $render = view('passport.ajax_login', compact('uid'))->render();
            return result(0, $render);
        }

        // 登录图片处理
        $login_bg = explode('|', sysconf('admin_login_bg_image'));
        $login_bg = array_filter($login_bg);
        if (sysconf('admin_login_bg_mode') == 1 && !empty($login_bg)) {
            // 自定义
            foreach ($login_bg as &$value) {
                $value = get_image_url($value);
            }
            $login_bg = implode('|', $login_bg);
        } else {
            // 系统默认
            $login_bg = '/backend/images/login/login_bg1.jpg|/backend/images/login/login_bg2.jpg|/backend/images/login/login_bg3.jpg|/backend/images/login/login_bg4.jpg|/backend/images/login/login_bg5.jpg';
        }

        return view('passport.login', compact('login_bg'));
    }

//    protected function redirectPath()
//    {
//        return '/main';
//    }

    /**
     * 重写登陆验证方法
     *
     * @param Request $request
     */
    protected function validateLogin(Request $request)
    {
        $this->validate($request, [
            'AdminLoginModel.'.$this->username() => 'required|string',
            'AdminLoginModel.password' => 'required|string',
        ],[
            'AdminLoginModel.'.$this->username().'.required' => '用户名不能为空',
            'AdminLoginModel.password.required' => '密码不能为空',
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
        return $this->guard()->attempt(
            [
                'user_name' => Input::get('AdminLoginModel.user_name'),
                'password' => Input::get('AdminLoginModel.password'),
            ]
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
        // 登录成功 更新登录信息
        Admin::where('user_id', auth('admin')->id())->update(['last_time' => date('Y-m-d H:i:s', time()), 'last_ip' => $request->ip(), 'visit_count'=>($user->visit_count+1)]);

        $user = Admin::where('user_id', $user->user_id)->first();

        // 存user到session
        $request->session()->put('admin', $user);

        // 记录日志
        admin_log('管理员登录后台，用户ID：'.$user->user_id);

        // ajax 登录
        $ajax_layout = $request->post('ajax_layout', 0);
        if ($ajax_layout) {
            $back_url = $request->post('back_url', '');
            return result(0, ['back_url'=>$back_url], '登录成功');
        }
    }

    /**
     * 重写guard方法
     *
     * @return mixed
     */
    protected function guard()
    {
        return auth()->guard('admin');
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

}