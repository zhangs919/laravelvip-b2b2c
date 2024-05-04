<?php

namespace App\Models;



class SellerCommissionBill extends BaseModel
{

    const MONTH = 0; // 月结
    const WEEK = 1; // 周结
    const DAY = 2; // 日结
    const THREE_DAY = 3; // 3日结

    protected $table = 'seller_commission_bill';

    protected $fillable = [
        'shop_id',
        'bill_sn',
        'order_amount',
        'shipping_amount',
        'return_amount',
        'return_shippingfee',
        'drp_money',
        'proportion',
        'commission_model',
        'gain_commission',
        'should_amount',
        'actual_amount',
        'negative_amount',
        'chargeoff_time',
        'settleaccounts_time',
        'start_time',
        'end_time',
        'chargeoff_status',
        'bill_cycle',
        'bill_apply',
        'apply_note',
        'apply_time',
        'operator',
        'check_status',
        'reject_note',
        'check_time',
        'frozen_money',
        'frozen_data',
        'frozen_time',
        'negative_amount',
        'return_rate_fee',
        'rate_fee',
    ];

    protected $primaryKey = 'id';

    public function orderCount()
    {
        return $this->hasMany(SellerBillOrder::class, 'bill_id');
    }

}
