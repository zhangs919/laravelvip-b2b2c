<?php

namespace App\Models;


class ShopNavigation extends BaseModel
{
    protected $table = 'shop_navigation';

    protected $fillable = [
        'nav_name','nav_type','nav_link','is_show','new_open','nav_sort','shop_id'
    ];

    protected $primaryKey = 'nav_id';
}
