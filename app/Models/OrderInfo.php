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
// | Description:
// +----------------------------------------------------------------------

namespace App\Models;

/**
 * 订单信息模型
 * Class OrderInfo
 * @package App\Models
 */
class OrderInfo extends BaseModel
{

    protected $table = 'order_info';

    /**
     * "order_data": "a:1:{s:16:\"order_act_amount\";i:10;}",
     * "mall_remark": "a:3:{i:0;a:4:{s:7:\"user_id\";i:588;s:9:\"user_name\";s:20:\"许建平13452269909\";s:6:\"remark\";s:12:\"我的订单\";s:8:\"add_time\";i:1540446041;}i:1;a:4:{s:7:\"user_id\";i:357;s:9:\"user_name\";s:17:\"张丽18833887649\";s:6:\"remark\";s:3:\"aaa\";s:8:\"add_time\";i:1540529172;}i:2;a:4:{s:7:\"user_id\";i:357;s:9:\"user_name\";s:17:\"张丽18833887649\";s:6:\"remark\";s:3:\"vvv\";s:8:\"add_time\";i:1540532744;}}",
     * "buttons": [
     *  "del_order",
     *   "again_buy"
     * ],
     *
     *
     * @var array
     */
    protected $fillable = [
        'order_sn', 'parent_sn', 'user_id', 'order_status', 'shop_id', 'site_id', 'store_id',
        'pickup_id', 'shipping_status', 'pay_status', 'consignee', 'region_code', 'region_name', 'address',
        'address_lng', 'address_lat', 'receiving_mode', 'tel', 'email', 'postscript', 'best_time', 'pay_id',
        'pay_code', 'pay_name', 'pay_sn', 'is_cod', 'order_amount', 'order_points', 'money_paid', 'goods_amount',
        'inv_fee', 'shipping_fee',

        'other_shipping_fee','packing_fee',

        'cash_more', 'discount_fee', 'change_amount', 'shipping_change', 'surplus',
        'user_surplus', 'user_surplus_limit', 'bonus_id', 'shop_bonus_id', 'bonus', 'shop_bonus', 'store_card_id',
        'store_card_price', 'integral', 'integral_money', 'give_integral', 'order_from', 'add_time', 'take_time',
        'take_countdown', 'pay_time', 'shipping_time', 'confirm_time', 'delay_days', 'order_type', 'service_mark',
        'send_mark', 'shipping_mark', 'buyer_type', 'evaluate_status', 'evaluate_time', 'end_time', 'is_distrib',
        'distrib_status', 'is_show', 'is_delete', 'order_data', 'mall_remark', 'site_remark', 'shop_remark', 'store_remark',
        'close_reason', 'cash_user_id', 'last_time', 'order_cancel', 'refuse_reason', 'sub_order_id', 'buy_type', 'reachbuy_code',
        'growth_value',


        'cs_take_status','cs_take_amount','cs_confirm_time',
        'cs_settlement_time','cs_delivery_fee','cs_delivery_enable',
        'cs_take_time','revision_user_id','terminal_no',
        'virtual_code',

        /*以下字段后期考虑移除*/
        'card_id','is_cross_border','inital_request','inital_response',
        'import_duty', 'shipping_tax','goods_tax','push_pay_order_status',
        'push_order_status','push_logistics_order_status',
        'is_send_weixin_message',

        'is_settlement','chargeoff_status'
//

//        'pickup_name', 'shop_name', 'shop_type', 'customer_tool', 'customer_account', 'complaint_id', 'complaint_status',

        // 以下字段app接口上返回 不用存储到订单信息表中
//        'sn', 'order_amount_format', 'order_status_format', 'order_from_format', 'comment_type',
//          'complainted', // 相当于complaint_status 投诉状态
//        'buttons', 'goods_list', 'rowspan', 'rowspan_all', 'aliim_enable', 'system_aliim_enable',
//        'goods_num',
//        'groupon_status', 'groupon_status_format', 'group_sn',  有团购活动时才有此字段返回
//        'has_backing_goods', 'countdown'
    ];

    protected $primaryKey = 'order_id';

    /**
     * 一对多关联 订单商品表
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orderGoods()
    {
        return $this->hasMany(OrderGoods::class, 'order_id', 'order_id');
    }

    /**
     * 一对一关联 自提点表
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function pickup()
    {
        return $this->hasOne(SelfPickup::class, 'pickup_id', 'pickup_id');
    }

    /**
     * 一对多关联 发货单订单表
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function deliveryOrder()
    {
        return $this->hasOne(DeliveryOrder::class, 'order_id','order_id');
    }

    /**
     * 关联商家表
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function shop()
    {
        return $this->belongsTo(Shop::class,'shop_id','shop_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id','user_id');
    }

    /**
     * 关联账单订单
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function getSellerBillOrder()
    {
        return $this->hasOne(SellerBillOrder::class, 'order_id', 'order_id');
    }

    /**
     * 关联退换货订单
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function getOrderReturn()
    {
        return $this->hasOne(BackOrder::class, 'order_id', 'order_id');
    }
}