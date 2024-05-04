<?php


namespace App\Services;


use EasyWeChat\OfficialAccount\Application as OfficialAccount;
use EasyWeChat\MiniApp\Application as MiniApp;

class WechatService
{

    /**
     * 微信公众号
     *
     * @param int $shop_id
     * @return \EasyWeChat\OfficialAccount\Application
     */
    public static function app($shop_id = 0, $token = '', $auth_verify = '')
    {
        if ($shop_id) {
            $appid = shopconf('appid',false,$shop_id);
            $appkey = shopconf('appsecret', false, $shop_id);
        } else {
            // 读取平台公众号信息
            $appid = sysconf('appid');
            $appkey = sysconf('appsecret');
        }

//        Log::info('request arrived.'); # 注意：Log 为 Laravel 组件，所以它记的日志去 Laravel 日志看，而不是 EasyWeChat 日志

        $config = [
            'app_id' => $appid,
            'secret' => $appkey,
        ];
        if ($token) {
        	$config['token'] = $token;
		}
		if ($auth_verify) { // EncodingAESKey，兼容与安全模式下请一定要填写！！！
			$config['aes_key'] = $auth_verify;
		}
        $app = new OfficialAccount($config);
        return $app;
    }

    /**
     * 微信小程序
     *
     * @return \EasyWeChat\MiniProgram\Application
     */
    public static function miniProgram()
    {
        // 读取平台小程序信息
        $appid = sysconf('weixin_programs_appid');
        $secret = sysconf('weixin_programs_secret');

//        Log::info('request arrived.'); # 注意：Log 为 Laravel 组件，所以它记的日志去 Laravel 日志看，而不是 EasyWeChat 日志

        $config = [
            'app_id' => $appid,
            'secret' => $secret,
        ];
        $app = new MiniApp($config);
        return $app;
    }
}
