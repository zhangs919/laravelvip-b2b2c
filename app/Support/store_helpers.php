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
// | Date:2018-10-09
// | Description: 网点中心助手函数
// +----------------------------------------------------------------------

/**
 * 网点中心 网点管理员用户信息
 *
 * @return \Illuminate\Contracts\Auth\Authenticatable|null
 */
function store_info()
{
    $data = auth('store')->user();
    return $data;
}

/**
 * 网点中心菜单
 *
 * @return array|mixed
 */
function store_top_menus()
{
    $menus = [
        [
            'title' => '商品管理',
            'menus' =>'goods-goods',
            'url' => '/goods/list'
        ],
        [
            'title' => '订单管理',
            'menus' =>'order-order',
            'url' => '/order/order/list'
        ],
        [
            'title' => '发货单管理',
            'menus' =>'order-delivery',
            'url' => '/order/delivery/list'
        ],
        [
            'title' => '网点信息',
            'menus' =>'store-manage',
            'url' => '/store/manage/info'
        ],
        [
            'title' => '结算账户',
            'menus' =>'store-settlement',
            'url' => '/store/settlement/list'
        ],
        [
            'title' => '财务',
            'menus' =>'store-bill',
            'url' => '/store/bill/store-bill'
        ],
    ];

    return $menus;
}
