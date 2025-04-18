<?php

namespace App\Models;


class SellerBillOrder extends BaseModel
{

    protected $table = 'seller_bill_order';

    protected $fillable = [
        'bill_id',
        'user_id',
        'shop_id',
        'order_id',
        'order_sn',
        'order_status',
        'shipping_status',
        'pay_status',
        'order_amount',
        'return_amount',
        'return_shippingfee',
        'goods_amount',
        'tax',
        'shipping_fee',
        'other_shipping_fee',
        'insure_fee',
        'pay_fee',
        'packing_fee',
        'card_fee',
        'bonus',
        'shop_bonus',
        'integral_money',
        'coupons',
        'discount_fee',
        'store_card_price',
        'money_paid',
        'surplus',
        'drp_money',
        'confirm_take_time',
        'chargeoff_status',
        'return_rate_fee',
        'rate_fee'
    ];

    protected $primaryKey = 'id';

    public function getOrder()
    {
        return $this->hasOne('App\Models\OrderInfo', 'order_id', 'order_id');
    }

    public function getSellerCommissionBill()
    {
        return $this->hasOne('App\Models\SellerCommissionBill', 'id', 'bill_id');
    }

    public function getSellerBillGoods()
    {
        return $this->hasOne('App\Models\SellerBillGoods', 'order_id', 'order_id');
    }

    public function getSellerBillGoodsList()
    {
        return $this->hasMany('App\Models\SellerBillGoods', 'order_id', 'order_id');
    }
}
