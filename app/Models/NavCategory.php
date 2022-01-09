<?php

namespace App\Models;


class NavCategory extends BaseModel
{
    protected $table = 'nav_category';

    protected $fillable = [
        'name', 'nav_json', 'nav_icon', 'is_show', 'sort', 'nav_page'
    ];

    protected $primaryKey = 'id';
}
