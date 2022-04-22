<?php

namespace App\Modules\Frontend\Http\Controllers;


use App\Modules\Base\Http\Controllers\Frontend;
use Illuminate\Http\Request;

class WxApiController extends Frontend
{


    public function __construct()
    {
        parent::__construct();


    }

    public function index(Request $request)
    {
        $shop_id = $request->get('shop_id');
        $weixin_token = 'lrwphp'; // 微信公众号平台 Token

//        Log::info('request arrived.'); # 注意：Log 为 Laravel 组件，所以它记的日志去 Laravel 日志看，而不是 EasyWeChat 日志

        $app = app('wechat.official_account');
        $app->server->push(function($message){
            return "欢迎关注 laravelvip！";
        });

        return $app->server->serve();
    }

}