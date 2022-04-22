<?php

namespace App\Models;


class SheetConfig extends BaseModel
{
    protected $table = 'sheet_config';

    protected $fillable = [
        'shipping_code', 'customer_name', 'customer_pwd'
    ];

    protected $primaryKey = 'sheet_config_id';
}
