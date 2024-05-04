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
 * 店铺发货单订单表
 *
 * Class DeliveryOrder
 * @package App\Models
 */
class DeliveryOrder extends BaseModel
{
    protected $table = 'delivery_order';

    protected $fillable = [
        'delivery_sn', 'order_id', 'user_id', 'shipping_id', 'shipping_code', 'shipping_name', 'shipping_type',
        'delivery_charge',
        'sender_id',
        'region_code', 'name','address', 'tel',
        'express_sn', 'delivery_status', 'add_time', 'send_time',
        'icode', 'is_show', 'is_arrived', 'exception_reason'
    ];

    protected $primaryKey = 'delivery_id';

    /**
     * 一对多关联 发货单商品表
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function deliveryGoods()
    {
        return $this->hasMany(DeliveryGoods::class, 'delivery_id', 'delivery_id');
    }

    public function orderInfo()
    {
        return $this->belongsTo(OrderInfo::class, 'order_id','order_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id','user_id');
    }

    public function shop()
    {
        return $this->belongsTo(Shop::class, 'shop_id', 'sender_id');
    }

    public function shipping()
    {
        return $this->belongsTo(Shipping::class,'shipping_id','shipping_id');
    }
}
