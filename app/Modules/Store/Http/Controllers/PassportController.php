<?php

namespace App\Modules\Store\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Repositories\CopyrightAuthRepository;
use App\Repositories\ShopRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class PassportController extends Controller
{

    use AuthenticatesUsers;

//    protected $redirectTo = '/main';
//    protected $username;

    protected $copyrightAuth;
    protected $shop;
    protected $user;

    public function __construct(CopyrightAuthRepository $copyrightAuth, ShopRepository $shop,UserRepository $user)
    {

        $this->copyrightAuth = $copyrightAuth;
        $this->shop = $shop;
        $this->user = $user;

        $this->middleware('guest:store')->except('logout');
    }

    public function showLoginForm(Request $request)
    {
        if ($request->ajax()) {
            $uuid = make_uuid();
            $render = view('passport.ajax_login', compact('uuid'))->render();
            return result(0, $render);
        }
        // 底部资质导航
        $copyCondition = [
            'where' => [
                ['is_show', 1]
            ],
            'sortname' => 'auth_sort',
            'sortorder' => 'asc'
        ];
        list($copyright_auth, $copyright_auth_total) = $this->copyrightAuth->getList($copyCondition);

        return view('passport.login', compact('copyright_auth'));
    }

    protected function redirectPath()
    {
        // 登录成功 记录shop_id session
        $user_info = auth('store')->user();
        $shop_info = $this->shop->getByField('user_id', $user_info->user_id);
        session()->put('shop_info', $shop_info); // 将店铺信息存入session

        // 记录日志
        shop_log('网点管理员【'.store_info()->user_name.'】登录网点中心。');
        $back_url = \request()->post('back_url','/index');
        return $back_url;
    }

    /**
     * 重写登陆验证方法
     *
     * @param Request $request
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function validateLogin(Request $request)
    {
        $this->validate($request, [
            'LoginModel.username' => 'required|string',
            'LoginModel.password' => 'required|string',
        ],[
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
        // 登录前验证 是否是商家账号

        $loginData = [];
        if ($request->input('SmsLoginModel.mobile')) { // 动态密码登录
            $loginData = []; // todo
        } elseif($username = $request->input('LoginModel.username')) { // 普通登录
            if (check_is_mobile($username)) { // 手机号登录
                $username_field = 'mobile';
            } elseif (check_is_email($username)) { // 邮箱登录
                $username_field = 'email';
            } else { // 默认用户名登录
                $username_field = 'user_name';
            }

            $condition[] = [$username_field, $username];
            $isSeller = $this->user->checkIsStore($condition);
            if (!$isSeller) {
                // 如果不是网点管理员 则返回错误
                return false;
            }
            $loginData = [$username_field => $request->input('LoginModel.username'), 'password' => $request->input('LoginModel.password')];
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
        // 登录成功 更新登录信息
        User::where('user_id', auth('store')->id())->update(['last_login' => date('Y-m-d H:i:s', time()), 'last_ip' => $request->ip(), 'visit_count'=>($user->visit_count+1)]);

        $user = User::where('user_id', $user->user_id)->first();

        // 存user到session
        $request->session()->put('store', $user);

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
        return auth()->guard('store');
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
     * 重写退出登录
     *
     * @param Request $request
     * @return string
     */
    protected function loggedOut(Request $request)
    {
        return redirect('/login');
    }

}