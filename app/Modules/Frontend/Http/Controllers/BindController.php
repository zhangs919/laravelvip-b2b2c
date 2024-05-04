<?php

namespace App\Modules\Frontend\Http\Controllers;

use App\Models\User;
use App\Modules\Base\Http\Controllers\Frontend;
use App\Services\ConnectApi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class BindController extends Frontend
{

    protected $connectApi;


    public function __construct(ConnectApi $connectApi)
    {
        parent::__construct();

        $this->connectApi = $connectApi;

    }

    /**
     * 账号绑定，已有账号
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function index(Request $request)
    {
		$seo_title = sysconf('site_name') . ' - 绑定';

        $third_login_info = session('third_login_info');

        if ($request->method() == 'POST') {
            $res = $this->connectApi->attemptLogin($request);
            if (isset($res['code']) && $res['code'] == -1) {
                flash('error', $res['message']);
                return redirect('/bind')->withInput();
            }
            // 手动认证登录
            if (!auth('user')->attempt($res['data'])) {
                flash('error', '账号密码错误');
                return redirect('/bind')->withInput();
            }

            // 认证通过
            // 存user到session
            Session::put('user', auth('user')->user());

            // 登录成功 记录登录日志
            user_log(is_login(), 1);

            // 登录成功 执行绑定
            $update = [
                "{$third_login_info['third_key']}_key" => $third_login_info['id'],
            ];

            $ret = User::where('user_id', auth('user')->id())->update($update);

            if ($ret === false) {
                flash('error', '绑定失败！');
                return redirect('/bind');
            }

            return redirect('/user/bind.html');
        }

        return view('bind.index', compact('seo_title', 'third_login_info'));
    }

    /**
     * 账号绑定，没有账号
     * @param Request $request
     * @param $type
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function bind(Request $request, $type)
    {
		$seo_title = sysconf('site_name') . ' - 绑定';
        $third_login_info = session('third_login_info');


        if ($request->method() == 'POST') {
            $bindUrl = '/bind/bind/'.$type;
            $res = $this->connectApi->attemptRegister($request, $type);
            if (isset($res['code']) && $res['code'] == -1) {
                flash('error', $res['message']);
                return redirect($bindUrl)->withInput($res['register_model']);
            }
            // 手动认证登录
            if (!auth('user')->attempt($res['data'])) {
                flash('error', '账号密码错误');
                return redirect($bindUrl)->withInput();
            }

            // 认证通过
            // 存user到session
            Session::put('user', auth('user')->user());

            // 登录成功 记录登录日志
            user_log(is_login(), 1);

            // 登录成功 执行绑定
            $update = [
                "{$third_login_info['third_key']}_key" => $third_login_info['id'],
            ];
            $ret = User::where('user_id', auth('user')->id())->update($update);

            if ($ret === false) {
                flash('error', '绑定失败！');
                return redirect($bindUrl);
            }

			return redirect('/');
//            return redirect('/user/bind.html');
        }

        return view('bind.bind_' . $type, compact('seo_title', 'third_login_info', 'type'));
    }

}
