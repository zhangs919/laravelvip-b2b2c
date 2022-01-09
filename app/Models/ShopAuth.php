<?php

namespace App\Models;


class ShopAuth extends BaseModel
{
    protected $table = 'shop_auth';

    protected $fillable = [
        'shop_id'
    ];

    protected $primaryKey = 'id';
}
