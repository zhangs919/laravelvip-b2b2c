<?php

namespace App\Models;


class ShopConfig extends BaseModel
{
    protected $table = 'shop_config';

    protected $fillable = [
        'shop_config_id', 'shop_id', 'config_code', 'value'
    ];

    protected $primaryKey = 'id';
}
