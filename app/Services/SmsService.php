<?php

// +----------------------------------------------------------------------
// | laravelvip 乐融沃B2B2C商城系统
// +----------------------------------------------------------------------
// | Copyright (c) 2017-2027 http://www.laravelvip.com All rights reserved.
// +----------------------------------------------------------------------
// | Notice: This code is not open source, it is strictly prohibited
// |         to distribute the copy, otherwise it will pursue its
// |         legal responsibility.
// +----------------------------------------------------------------------
// | 版权所有 2015-2027 云南乐融沃网络科技有限公司，并保留所有权利。
// | 网站地址: http://www.laravelvip.com
// +----------------------------------------------------------------------
// | 这不是一个自由软件！禁止拷贝本软件副本，否则将追究其法律责任！
// | 如需使用，请移步官网购买正版授权。
// +----------------------------------------------------------------------
// | Author: 雲溪荏苒 <290648237@qq.com>
// | Date:2018-10-31
// | Description: 短信发送
// +----------------------------------------------------------------------

namespace App\Services;


use Overtrue\EasySms\EasySms;
use Overtrue\EasySms\Exceptions\Exception;

class SmsService
{

    /**
     * @param $mobile
     * @param string $content
     * @return bool
     */
    public function send($mobile, $content = '')
    {
        $config = [
            // HTTP 请求的超时时间（秒）
            'timeout' => 5.0,

            // 默认发送配置
            'default' => [
                // 网关调用策略，默认：顺序调用
                'strategy' => \Overtrue\EasySms\Strategies\OrderStrategy::class,

                // 默认可用的发送网关
                'gateways' => [
//                    'yunpian',
                    'aliyun',
//                    'alidayu',
                ],
            ],
            // 可用的网关配置
            'gateways' => [
                'errorlog' => [
                    'file' => '/tmp/easy-sms.log',
                ],
                'yunpian' => [
                    'api_key' => '',
                ],
                'aliyun' => [
                    // 已测试 能成功发送
                    'access_key_id' => sysconf('aliyunsms_app_key'),
                    'access_key_secret' => sysconf('aliyunsms_app_secret'),
                    'sign_name' => sysconf('sms_sign_name'),
                ],
                'alidayu' => [
                    'app_key' => '',
                    'app_secret' => '',
                    'sign_name' => '',
                ],
            ],
        ];

        $easySms = new EasySms($config);

        // 暂时默认使用阿里云短信 后期优化
        $gateway = 'aliyun';

        try {
//            $res = $easySms->send($mobile, [
//                'content'  => $content, //'您的验证码为：6379，该验证码 5 分钟内有效，请勿泄漏于他人。',
//                'template' => 'SMS_141615486',
//                'data' => [
//                    'code' => 6379
//                ],
//            ]);

            /*
             * aliyun" => array:3 [▼
                "gateway" => "aliyun"
                "status" => "success"
                "result" => array:4 [▼
                  "Message" => "OK"
                  "RequestId" => "99602E6A-F070-4ED2-80D7-A621C29FA2B9"
                  "BizId" => "163923440971884559^0"
                  "Code" => "OK"
                ]
              ]
             */

//            if ($res[$gateway]['status'] == 'failure') {
//                // 发送失败 返回错误信息
//
//            }
            return true;
        } catch (Exception $e) {
//            dd($e->getResults());
            return false;
        }


    }
}