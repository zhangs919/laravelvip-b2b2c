<?php

namespace App\Models;


class NavBanner extends BaseModel
{
    protected $table = 'nav_banner';

    protected $fillable = [
        'banner_name', 'banner_image', 'banner_link', 'is_show', 'banner_sort', 'banner_height', 'site_id', 'nav_page'
    ];

    protected $primaryKey = 'id';
}
