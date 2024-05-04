<?php

namespace App\Providers;

use App\Models\OrderInfo;
use App\Models\UserAddress;
use App\Policies\OrderInfoPolicy;
use App\Policies\UserAddressPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Sanctum\PersonalAccessToken;
use Laravel\Sanctum\Sanctum;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
//        'App\Model' => 'App\Policies\ModelPolicy',
        UserAddress::class => UserAddressPolicy::class,
        OrderInfo::class => OrderInfoPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        // 设置访问令牌模型名称
        // Sanctum::usePersonalAccessTokenModel(UserToken::class);
        // 验证访问令牌的回调
//        Sanctum::authenticateAccessTokensUsing(
//            static function (PersonalAccessToken $accessToken, bool $isValid) {
//                // 你的自定义逻辑
//                if (!$accessToken->can('server:limited')) {
//                    return $isValid;
//                }
////                dd($accessToken->created_at->gt(now()->subSeconds(10)));
//                return $isValid && $accessToken->created_at->gt(now()->subSeconds(30)); // 设置过期时间 单位：秒
//
//            }
//        );
        //
    }
}
