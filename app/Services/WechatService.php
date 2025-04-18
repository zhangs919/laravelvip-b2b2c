<?php


namespace App\Services;


use App\Repositories\PaymentRepository;
use EasyWeChat\Factory;
use EasyWeChat\Pay\Application as PayApplication;
use EasyWeChat\OfficialAccount\Application as OfficialAccount;
use EasyWeChat\MiniApp\Application as MiniApp;

class WechatService
{
    public static function pay()
    {
        $payment = new PaymentRepository();
        $weixin_config = $payment->getPayConfig('weixin');

        $config = [
            // 前面的appid什么的也得保留哦
            'app_id'             => sysconf('weixin_programs_appid'),
            'mch_id'             => $weixin_config['mchid'],
            'key'                => $weixin_config['key'],
            'cert_path'          => storage_path($weixin_config['apiclient_cert']), // XXX: 绝对路径！！！！
            'key_path'           => storage_path($weixin_config['apiclient_key']),      // XXX: 绝对路径！！！！
//            'notify_url'         => request()->getSchemeAndHttpHost().'/notify/front-weixin',
            // 'device_info'     => '013467007045764',
            // 'sub_app_id'      => '',
            // 'sub_merchant_id' => '',
            // ...
        ];

        $payment = Factory::payment($config);
        return $payment;
    }

    // easywechat v7.* 待调试
    public static function pay2()
    {
        $payment = new PaymentRepository();
        $weixin_config = $payment->getPayConfig('weixin');

        $config = [
            'mch_id' => $weixin_config['mchid'],

            // 商户证书
            'private_key' => storage_path($weixin_config['apiclient_key']),
            'certificate' => storage_path($weixin_config['apiclient_cert']),

            // v3 API 秘钥
            'secret_key' => $weixin_config['key'],

            // v2 API 秘钥
            'v2_secret_key' => '',

            // 平台证书：微信支付 APIv3 平台证书，需要使用工具下载
            // 下载工具：https://github.com/wechatpay-apiv3/CertificateDownloader
            'platform_certs' => [
                // 请使用绝对路径
                // '/path/to/wechatpay/cert.pem',
            ],

            /**
             * 接口请求相关配置，超时时间等，具体可用参数请参考：
             * https://github.com/symfony/symfony/blob/5.3/src/Symfony/Contracts/HttpClient/HttpClientInterface.php
             */
            'http' => [
                'throw'  => true, // 状态码非 200、300 时是否抛出异常，默认为开启
                'timeout' => 5.0,
                // 'base_uri' => 'https://api.mch.weixin.qq.com/', // 如果你在国外想要覆盖默认的 url 的时候才使用，根据不同的模块配置不同的 uri
            ],
        ];

        $app = new PayApplication($config);

        return $app;
    }

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
     * @return MiniApp
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidArgumentException
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
