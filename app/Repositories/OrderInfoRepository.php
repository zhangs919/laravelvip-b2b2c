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
// | Date:2018-10-26
// | Description: 订单信息
// +----------------------------------------------------------------------

namespace App\Repositories;


use App\Models\OrderInfo;

class OrderInfoRepository
{
    use BaseRepository;

    protected $model;


    public function __construct()
    {
        $this->model = new OrderInfo();
    }


    // todo 获取每个状态的订单数量并返回
    public function getOrderCounts()
    {
        $data = [
            'all' => "0",
            'assign' => "0",
            'backing' => "0",
            'cancel' => "0",
            'closed' => "0",
            'finished' => "0",
            'pending' => "0",
            'shipped' => "0",
            'unevaluate' => "0",
            'unpayed' => "0",
            'unshipped' => "0",
        ];

        return $data;
    }
}