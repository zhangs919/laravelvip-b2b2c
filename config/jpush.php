<?php

// 极光推送
return [
    'android_app_key' => env('JPUSH_APP_KEY'),
    'android_master_secret' => env('JPUSH_APP_MASTER_SECRET'),

    'ios_app_key' => env('JPUSH_IOS_KEY'),
    'ios_master_secret' => env('JPUSH_IOS_MASTER_SECRET'),

    // 环境 true-生产环境 false-开发环境
    'environment' => env('JPUSH_APNS_PRODUCTION', true),
];
