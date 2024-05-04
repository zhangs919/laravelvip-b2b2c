<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class SellerNegativeOrder extends BaseModel
{
    use HasFactory;

    protected $table = 'seller_negative_order';

    public $timestamps = false;

    protected $fillable = [
        'negative_id',
        'order_id',
        'order_sn',
        'ret_id',
        'return_sn',
        'seller_id',
        'return_amount',
        'return_shippingfee',
        'settle_accounts',
        'add_time'
    ];
}
