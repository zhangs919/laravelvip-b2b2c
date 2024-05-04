<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->guest()) {
            if ($request->ajax() || $request->wantsJson()) {
                return result(99, null, '需要登录');
//                return response('Unauthorized', 401);
            } else {
                return redirect()->guest('login');
            }
        }

        // 通过在路由中指定中间件名称来验证访问权限


        return $next($request);
    }
}
