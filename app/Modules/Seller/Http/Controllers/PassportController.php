<?php

namespace App\Modules\Seller\Http\Controllers;

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
    protected $user;
    protected $shop;

    public function __construct(CopyrightAuthRepository $copyrightAuth,UserRepository $user,ShopRepository $shop)
    {
        $this->copyrightAuth = $copyrightAuth;
        $this->user = $user;
        $this->shop = $shop;

        $this->middleware('guest:seller')->except('logout');
    }

    public function showLoginForm(Request $request)
    {
        $uuid = make_uuid();
        if ($request->ajax()) {
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

        return view('passport.login', compact('copyright_auth','uuid'));
    }

    protected function redirectPath()
    {
        // 登录成功 记录shop_id session
        $user_info = auth('seller')->user();

        $shop_id = $user_info->shop_id;
        $shop_info = $this->shop->getById($shop_id);
        session()->put('shop_info', $shop_info);

        // 记录日志
        shop_log('卖家管理员【'.seller_info()->user_name.'】登录卖家中心。');
        $back_url = \request()->post('back_url','/index');
        return $back_url;
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
            $isSeller = $this->user->checkIsSeller($condition);
            if (!$isSeller) {
                // 如果不是卖家 则返回错误
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
        User::where('user_id', auth('seller')->id())->update(['last_login' => date('Y-m-d H:i:s', time()), 'last_ip' => $request->ip(), 'visit_count'=>($user->visit_count+1)]);

        $user = User::where('user_id', $user->user_id)->first();

        // 存user到session
        $request->session()->put('seller', $user);

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
        return auth()->guard('seller');
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