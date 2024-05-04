<?php

// TODO ！！！！！！！！未使用该文件中的配置！！！！！！！！

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],

    'github' => [
        'client_id' => env('GITHUB_CLIENT_ID'),
        'client_secret' => env('GITHUB_CLIENT_SECRET'),
        'redirect' => env('GITHUB_REDIRECT_URL'),
    ],

    'qq' => [
        'client_id' => 'appid',
        'client_secret' => 'appSecret',
        'redirect' => '',//get_http().config('lrw.frontend_domain').'/website/login?type=qq',  // todo 此处不能调用get_http()方法 否则执行composer 会保存
    ],

    'weibo' => [
        'client_id' => 'appid',
        'client_secret' => 'appSecret',
        'redirect' => '',//get_http().config('lrw.frontend_domain').'/website/login?type=weibo',
    ],

    'wechat' => [
        'provider' => 'wechat', // 自定义driver名称
        'client_id' => env('WECHAT_OFFICIAL_ACCOUNT_APPID'),
        'client_secret' => env('WECHAT_OFFICIAL_ACCOUNT_SECRET'),
        'redirect' => '',//get_http().config('lrw.frontend_domain').'/website/login?type=pc_weixin',
    ],

    'kd100' => [
        'customer' => env('KD100_CUSTOMER'),
        'key' => env('KD100_KEY')
    ],

];
