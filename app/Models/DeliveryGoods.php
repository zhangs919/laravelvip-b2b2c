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
// | Date:2018-11-18
// | Description:
// +----------------------------------------------------------------------

namespace App\Models;

/**
 * 店铺发货单订单商品表
 *
 * Class DeliveryGoods
 * @package App\Models
 */
class DeliveryGoods extends BaseModel
{
    protected $table = 'delivery_goods';

    /**
     * "saleservice": null,
        "goods_back_format": "",
        "goods_status_format": "交易成功",
        "goods_price_format": "￥222.00",
        "buttons": [
        "to_apply",
        "to_complaint_seller"
        ]
     * @var array
     */
    protected $fillable = [

        'id','goods_id','sku_id','send_number','delivery_id',

        /*以下字段从发货单表（delivery_order）读取*/
//        'delivery_sn','order_id','user_id','shipping_id','shipping_code',
//        'shipping_name','shipping_type','sender_id','region_code','name','address','tel','express_sn','delivery_status','add_time',
//        'send_time','icode','is_show','is_arrived','exception_reason',
        /*以上字段从发货单表（delivery_order）读取*/

        'record_id',

        /*todo 以下信息是否可以直接从订单商品表读取？？*/
//        'goods_number','goods_image','goods_name',
//        'goods_barcode','spec_info','goods_price','other_price','pay_change','goods_status','is_gift','goods_type','act_type',
//        'contract_ids','goods_points','shop_id','back_id','back_status',
        /*todo 以上信息是否可以直接从订单商品表读取？？*/

        // 以下字段app接口上返回 不用存储到表中
        //'saleservice','goods_back_format','goods_status_format',
        //'goods_price_format','buttons'

    ];

    protected $primaryKey = 'id';
}
