<?php

namespace App\Models;


class TradeSnapshot extends BaseModel
{

    protected $table = 'trade_snapshot';

    protected $primaryKey = 'trade_id';

    public $timestamps = false;

    protected $fillable = [
        'order_id',
        'order_sn',
        'user_id',
        'goods_id',
        'goods_name',
        'goods_sn',
        'shop_price',
        'goods_number',
        'shipping_fee',
        'rz_shopName',
        'goods_weight',
        'add_time',
        'goods_attr',
        'goods_attr_id',
        'ru_id',
        'goods_desc',
        'goods_img',
        'snapshot_time'
    ];
}
