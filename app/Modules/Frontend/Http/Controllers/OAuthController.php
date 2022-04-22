<?php

namespace App\Modules\Frontend\Http\Controllers;


use App\Http\Controllers\Controller;
//use Overtrue\Socialite\SocialiteManager;
use Illuminate\Support\Arr;
use Overtrue\Socialite\User as SocialiteUser;

class OAuthController extends Controller
{

    /**
     * @param string $platform
     *
     * @return mixed
     */
    public function getRedirectUrl(string $platform)
    {
        return Socialite::driver($platform)->redirect()->getTargetUrl();
    }

    /**
     * @param string $platform
     *
     * @return array
     */
    public function handleCallback(string $platform)
    {
        try {
            $socialiteUser = Socialite::driver($platform)->stateless()->user();
        } catch (\Exception $e) {
            return abort(401, $e->getMessage());
        }


        $user = !empty(session('user')) ? session('user')->toArray() : [];
        dd($user);
        $user = new SocialiteUser([
            'id' => Arr::get($user, 'openid'),
            'name' => Arr::get($user, 'nickname'),
            'nickname' => Arr::get($user, 'nickname'),
            'avatar' => Arr::get($user, 'headimgurl'),
            'email' => null,
            'original' => [],
            'provider' => 'WeChat',
        ]);

        return Profile::createFromSocialite($socialiteUser, $platform);
    }




//    protected $socialite;

//    public function __construct()
//    {
//        $this->socialite = new SocialiteManager(config('services'));
//    }
//
//    /**
//     * 跳转进行授权
//     *
//     * @param $driver
//     */
//    public function redirectToProvider($driver)
//    {
//        $response = $this->socialite
//            ->driver($driver)
////            ->with(['hd'=>'example.com']) // 设置额外参数
//            ->redirect();
//
//        // 动态设置 redirect
////        $url = 'http://localhost/';
////        $response = $this->socialite->driver($driver)->redirect($url);
//        // or
////        $response = $this->socialite->driver($driver)->withRedirectUrl($url)->redirect();
////        // or
////        $response = $this->socialite->driver($driver)->setRedirectUrl($url)->redirect();
//
//        echo $response;// or $response->send();
//    }
//
//    /**
//     * 回调 返回用户信息
//     *
//     * @param $driver
//     */
//    public function handleProviderCallback($driver)
//    {
//        $user = $this->socialite->driver($driver)->user();
//
//        dd($user);
//
//    }
}