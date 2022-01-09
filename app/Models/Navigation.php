<?php

namespace App\Models;


class Navigation extends BaseModel
{
    protected $table = 'navigation';

    protected $fillable = [
        'nav_name','nav_type','nav_link','nav_position','nav_layout','nav_icon','is_show','new_open','nav_sort','nav_page'
    ];

    protected $primaryKey = 'id';
}
