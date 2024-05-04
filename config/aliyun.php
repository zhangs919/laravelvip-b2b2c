<?php

// 阿里云相关配置
return [
    'access_id' => env('ALI_ACCESS_KEY_ID'),//ID阿里云身份验证，在阿里云RAM控制台创建。
    'access_key' => env('ALI_ACCESS_KEY_SECRET'),//Secret阿里云身份验证，在阿里云RAM控制台创建。
    'rocket_mq' => [
        'http_endpoint' => 'http://1296600567122960.mqrest.cn-qingdao-public.aliyuncs.com',//设置HTTP协议客户端接入点，进入消息队列RocketMQ版控制台实例详情页面的接入点区域查看。
        'instance_id' => 'MQ_INST_1296600567122960_BX05M82P',/// 若实例有命名空间，则实例ID必须传入；若实例无命名空间，则实例ID传入null空值或字符串空值。实例的命名空间可以在消息队列RocketMQ版控制台的实例详情页面查看。
        'group_id' => 'GID_lrw',//您在消息队列RocketMQ版控制台创建的Group ID。
        'topic' => 'lrw',//消息所属的Topic，在消息队列RocketMQ版控制台创建。
    ]
];