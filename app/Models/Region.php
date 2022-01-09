<?php

namespace App\Models;


class Region extends BaseModel
{

    protected $table = 'region';

    protected $fillable = [
        'region_name', 'region_code', 'parent_code', 'region_type', 'center', 'city_code', 'level', 'is_enable', 'is_scope', 'sort'
    ];

    protected $primaryKey = 'region_id';

}
