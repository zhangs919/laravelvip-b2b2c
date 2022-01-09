<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
//        if (Auth::guard($guard)->check()) {
//            return redirect('/home');
//        }

        // 平台后台登录
        if ($guard == 'admin') {
            // ajax_login
//            if ($request->ajax() && Auth::guard($guard)->check()) {
//                return result(0, null, '登录成功');
//            }
        }

        // 商家中心登录
        if ($guard == 'seller') {
            // ajax_login
//            if ($request->ajax() && Auth::guard($guard)->check()) {
//                return result(0, null, '登录成功');
//            }
        }

        // 会员登录
        if ($guard == 'user') {
            // ajax_login
            if (/*$request->ajax() &&*/ Auth::guard($guard)->check()) {
//                $back_url = $request->post('back_url', '');
//                return result(0, ['back_url'=>$back_url], '登录成功');
            }
        }

//        if (Auth::guard($guard)->check()) {
//            // 根据不同 guard 跳转到不同的页面
////            dd($guard ? '/main':'/home');
//            $url = $guard ? '/':'/';
//            return redirect($url);
//        }

        return $next($request);
    }
}
