<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class SellerBillBackOrder extends BaseModel
{
    use HasFactory;


    protected $table = 'seller_bill_order_return';

    public $timestamps = false;

    protected $fillable = [
        'order_id',
        'ret_id'
    ];
}
