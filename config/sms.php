<?php

return [
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
            'file' => storage_path('logs/easy-sms.log'),
        ],

        // 阿里云：短信内容使用 template + data
        'aliyun' => [
            // 已测试 能成功发送
            'access_key_id' => '', //sysconf('aliyunsms_app_key'),
            'access_key_secret' => '', //sysconf('aliyunsms_app_secret'),
            'sign_name' => '', //sysconf('sms_sign_name'),
        ],
        
        // 云片：短信内容使用 content
        'yunpian' => [
            'api_key' => '',
        ],

        // Submail：短信内容使用 data
        'submail' => [
            'app_id' => '',
            'app_key' => '',
            'project' => '',
        ],

        // 螺丝帽：短信内容使用 content
        'luosimao' => [
            'api_key' => '',
        ],

        // 容联云通讯：短信内容使用 template + data
        'yuntongxun' => [
            'app_id' => '',
            'account_sid' => '',
            'account_token' => '',
            'is_sub_account' => false,
        ],

        // 互亿无线：短信内容使用 content
        'huyi' => [
            'api_id' => '',
            'api_key' => '',
        ],

        // 聚合数据：短信内容使用 template + data
        'juhe' => [
            'app_key' => '',
        ],

        // SendCloud：短信内容使用 template + data
        'sendcloud' => [
            'sms_user' => '',
            'sms_key' => '',
            'timestamp' => false, // 是否启用时间戳
        ],

        // 百度云：短信内容使用 template + data
        'baidu' => [
            'ak' => '',
            'sk' => '',
            'invoke_id' => '',
            'domain' => '',
        ],

        // 华信短信平台：短信内容使用 content
        'huaxin' => [
            'user_id' => '',
            'password' => '',
            'account' => '',
            'ip' => '',
            'ext_no' => '',
        ],

        // 253云通讯（创蓝）：短信内容使用 content
        'chuanglan' => [
            'account' => '',
            'password' => '',

            // \Overtrue\EasySms\Gateways\ChuanglanGateway::CHANNEL_VALIDATE_CODE  => 验证码通道（默认）
            // \Overtrue\EasySms\Gateways\ChuanglanGateway::CHANNEL_PROMOTION_CODE => 会员营销通道
            'channel' => \Overtrue\EasySms\Gateways\ChuanglanGateway::CHANNEL_VALIDATE_CODE,

            // 会员营销通道 特定参数。创蓝规定：api提交营销短信的时候，需要自己加短信的签名及退订信息
            'sign' => '【通讯云】',
            'unsubscribe' => '回TD退订',
        ],

        // 融云：短信分为两大类，验证类和通知类短信。 发送验证类短信使用 template + data
        'rongcloud' => [
            'app_key' => '',
            'app_secret' => '',
        ],

        // 天毅无线：短信内容使用 content
        'tianyiwuxian' => [
            'username' => '', //用户名
            'password' => '', //密码
            'gwid' => '', //网关ID
        ],

        // twilio：短信使用 content，发送对象需要 使用+添加区号
        'twilio' => [
            'account_sid' => '', // sid
            'from' => '', // 发送的号码 可以在控制台购买
            'token' => '', // apitoken
        ],

        // 腾讯云 SMS：短信内容使用 content
        'qcloud' => [
            'sdk_app_id' => '', // SDK APP ID
            'app_key' => '', // APP KEY
            'sign_name' => '', // 短信签名，如果使用默认签名，该字段可缺省（对应官方文档中的sign）
        ],

        // 阿凡达数据：短信内容使用 template + data
        'avatardata' => [
            'app_key' => '', // APP KEY
        ],
    ],
];