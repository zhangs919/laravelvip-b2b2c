<?php

namespace App\Models;


class NavAd extends BaseModel
{
    protected $table = 'nav_ad';

    protected $fillable = [
        'ad_name', 'ad_image', 'ad_link', 'is_show', 'ad_sort', 'ad_height', 'category_id'
    ];

    protected $primaryKey = 'id';
}
