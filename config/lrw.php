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
// | Date:2018-08-01
// | Description: 系统版本配置
// +----------------------------------------------------------------------

// 商城系统 自定义配置信息
return [
    // 根域名
    'root_domain' => env('ROOT_DOMAIN', ''),
    // 配置二级域名
    'backend_domain' => env('BACKEND_DOMAIN', ''),
    'seller_domain' => env('SELLER_DOMAIN', ''),
    'store_domain' => env('STORE_DOMAIN', ''),
    'frontend_domain' => env('FRONTEND_DOMAIN', ''),
    'mobile_domain' => env('MOBILE_DOMAIN', ''),
    'kf_domain' => env('KF_DOMAIN', ''),
    'goods_detail_domain' => env('GOODS_DETAIL_DOMAIN', ''),
    'mobile_goods_detail_domain' => env('MOBILE_GOODS_DETAIL_DOMAIN', ''),
    'api_domain' => env('API_DOMAIN', ''),
    'push_domain' => env('PUSH_DOMAIN', ''),
    # 版本升级服务端地址 ！！！请勿修改 否则影响版本更新！！！
    'upgrade_server' => 'https://www.laravelvip.com',
    # elastic hosts
    'es_hosts' => env('ES_HOSTS', ''),
//    'kdniao_app_id' => sysconf('kdniao_app_id') ?? env('KDNIAO_APP_ID') // 后期按此方法优化

	'openai_api_key' => env('OPENAI_API_KEY', ''), // openai api key

];
