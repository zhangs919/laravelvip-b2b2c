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
// | Date:2020-08-16
// | Description:店铺结算
// +----------------------------------------------------------------------

namespace App\Models;

/**
 * 店铺结算模型 todo 当新的商家结算功能开发完成后，此模型作废
 * since v4.0
 * Class ShopBill
 * @package App\Models
 */
class ShopBill extends BaseModel
{
    const MONTH = 0; // 月结
    const WEEK = 1; // 周结
    const DAY = 2; // 日结
    const THREE_DAY = 3; // 3日结

    protected $table = 'shop_bill';

    protected $fillable = [
        'bill_sn','shop_name','shop_id','site_name','site_id','order_ids','shop_status',
        'order_count','order_amount','system_money','site_money','shop_money','shipping_fee'
        ,'other_shipping_fee','packing_fee','alipay','weixin','union','is_cod','store_card'
        ,'integral_money','surplus','activity_money','year','group_time','start_date','end_date',
        'finish_money','bill_cycle','operator'

        //"site_status_format": null,
        //        "shop_status_format": "已出账，已结算",
        //        "store_status_format": null
    ];

    protected $primaryKey = 'bill_id';
}
