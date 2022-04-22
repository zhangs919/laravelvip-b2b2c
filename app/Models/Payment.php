<?php

namespace App\Models;


class Payment extends BaseModel
{
    protected $table = 'payment';

    protected $fillable = [
        'pay_code', 'pay_name', 'pay_desc', 'pay_sort', 'pay_config', 'is_enable'
    ];

    protected $primaryKey = 'pay_id';
}
