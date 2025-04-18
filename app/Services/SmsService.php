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


use Illuminate\Support\Facades\Log;
use Overtrue\EasySms\EasySms;
use Overtrue\EasySms\Exceptions\Exception;

class SmsService
{

    /**
     * @param $mobile
     * @param string $content
     * @param string $captcha
     * @return bool
     */
    public function send($mobile, $content = '', $captcha = '')
    {
        $config = config('sms');
        // 动态获取配置信息
        $config['gateways']['aliyun'] = [
            'access_key_id' => sysconf('aliyunsms_app_key'),
            'access_key_secret' => sysconf('aliyunsms_app_secret'),
            'sign_name' => sysconf('sms_sign_name'),
        ];
        $easySms = new EasySms($config);

        // 暂时默认使用阿里云短信 后期优化
        $gateway = 'aliyun';
        try {
            /*todo 暂时注释 上线后打开注释*/
            $res = $easySms->send($mobile, [
                'content'  => $content, //'您的验证码为：6379，该验证码 5 分钟内有效，请勿泄漏于他人。',
                'template' => 'SMS_296920556', // 注册：SMS_162522033 登录：SMS_141615486
                'data' => [
                    'code' => $captcha
                ],
            ]);
            Log::info(json_encode($res));
            if ($res[$gateway]['status'] == 'failure') {
                // 发送失败 返回错误信息
                throw new \Exception('短信发送失败');
            }


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


            return true;
        } catch (Exception $e) {
            return $e->getMessage();
        }


    }
}