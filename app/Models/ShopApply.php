<?php

namespace App\Models;


class ShopApply extends BaseModel
{
    protected $table = 'shop_apply';

    protected $fillable = [
        'shop_name','cat_id','duration','system_fee','insure_fee'
    ];

    protected $primaryKey = 'shop_id';
}
