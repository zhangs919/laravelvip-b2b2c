<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class StoreAuthMiddleware
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
//        dd(Auth::guard($guard));
        if (Auth::guard($guard)->guest()) {
            if ($request->ajax() || $request->wantsJson()) {
                return result(99, null, '需要登录');
//                return response('Unauthorized', 401);
            } else {
                return redirect()->guest('login');
            }
        }
        return $next($request);
    }
}
