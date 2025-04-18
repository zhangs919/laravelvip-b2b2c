<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class SellerNegativeBill extends BaseModel
{
    use HasFactory;

    protected $table = 'seller_negative_bill';


    protected $fillable = [
        'bill_sn',
        'commission_bill_sn',
        'commission_bill_id',
        'shop_id',
        'return_amount',
        'return_shippingfee',
        'chargeoff_status',
        'start_time',
        'end_time'
    ];
}
