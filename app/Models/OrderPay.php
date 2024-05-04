<?php

namespace App\Models;

/**
 * 订单支付模型
 *
 * Class OrderPay
 * @package App\Models
 */
class OrderPay extends BaseModel
{
    protected $table = 'order_pay';

    protected $fillable = [
        'user_id', 'pay_no', 'trade_no', 'order_id', 'payment_name', 'order_type',
        'order_amount', 'order_balance', 'is_paid', 'pay_time'
    ];

    protected $primaryKey = 'pay_id';
}
