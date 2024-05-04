<?php

namespace App\Http\Middleware;

use Closure;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Facades\JWTAuth;


/**
 * 此类废弃，已用sanctum替代
 * Class UserApiAuthMiddleware
 * @package App\Http\Middleware
 */
class UserApiAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        try {
            if (!$user = JWTAuth::parseToken()->authenticate()) {
                return response()->json([
                    'data' => null,
                    'message' => '用户不存在',
                    'code' => 400004
                ]);
            }
        } catch (TokenExpiredException $e) {

            return response()->json([
                'data' => null,
                'message' => 'Token 失效',
                'code' => 400001
            ]);
        } catch (TokenInvalidException $e) {

            return response()->json([
                'data' => null,
                'message' => 'Token 无效',
                'code' => 400003
            ]);
        } catch (JWTException $e) {

            return response()->json([
                'data' => null,
                'message' => 'Token 不存在',
                'code' => 400002
            ]);
        }
        return $next($request);
    }
}
