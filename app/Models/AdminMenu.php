<?php

namespace App\Models;


class AdminMenu extends BaseModel
{
    //
    protected $table = 'admin_menu';

    protected $fillable = [
         'title', 'icon','pid','parent_name','name', 'url','route', 'target', 'sort', 'is_show'
    ];

    protected $primaryKey = 'id';
}
