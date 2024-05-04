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
// | Date:2020-02-05
// | Description:单品统计
// +----------------------------------------------------------------------

namespace App\Repositories;

/**
 * 单品统计
 * 不含数据表
 *
 * Class GoodsStatisticsRepository
 * @package App\Repositories
 */
class GoodsStatisticsRepository
{
    use BaseRepository;



    public function __construct()
    {

    }

    //单品统计列表
    public function pageList($condition)
    {
        //        "record_id": "7325",
        //        "goods_name": "ipad钢化膜2018新款air2苹果mini4平板pro9.7英寸10.5电脑11新12.9版",
        //        "spec_info": "颜色分类：iPad mini1/2/3【高清款HZ68】9H耐磨防刮◆裸机手感",
        //        "goods_sn": "",
        //        "goods_barcode": "",
        //        "pricing_mode": "0",
        //        "unit_name": null,
        //        "goods_price": "29.90",
        //        "sales_price": "29.90",
        //        "goods_number": "1",
        //        "pay_change": "0.00",
        //        "order_sn": "20191231004621681640",
        //        "order_id": "5997",
        //        "order_type": "0",
        //        "order_from": "3",
        //        "buy_type": "1"

        $list = [];
        $total = 0;
        return [$list, $total];
    }
}