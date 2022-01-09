<?php

namespace App\Models;


class UserShopRank extends BaseModel
{
    protected $table = 'user_shop_rank';

    protected $fillable = [
        'rank_name', 'rank_level'
    ];

    protected $primaryKey = 'rank_id';
}
