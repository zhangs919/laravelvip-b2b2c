<?php

namespace App\Models;


class ShopRank extends BaseModel
{
    protected $table = 'shop_rank';

    protected $fillable = [
        'shop_id', 'rank_name', 'rank_level', 'is_special', 'discount', 'min_amount', 'min_times', 'expired_level', 'use_between', 'start_time', 'end_time', 'valid_days', 'is_enable'
    ];

    protected $primaryKey = 'rank_id';
}
