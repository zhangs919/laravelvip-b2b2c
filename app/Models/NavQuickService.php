<?php

namespace App\Models;


class NavQuickService extends BaseModel
{
    protected $table = 'nav_quick_service';

    protected $fillable = [
        'qs_name', 'qs_icon', 'qs_link', 'is_show', 'sort', 'site_id'
    ];

    protected $primaryKey = 'id';
}
