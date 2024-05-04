<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class SellerBillGoods extends BaseModel
{
    use HasFactory;

    protected $table = 'seller_bill_goods';

    public $timestamps = false;

    protected $fillable = [
        'rec_id',
        'order_id',
        'goods_id',
        'cat_id',
        'proportion',
        'goods_price',
        'dis_amount',
        'goods_number',
        'goods_attr',
        'drp_money',
        'commission_rate'
    ];


}
