<?php

namespace App\Models;


class LibCategory extends BaseModel
{
    protected $table = 'lib_category';

    protected $fillable = [
        'cat_name', 'parent_id', 'is_show', 'cat_sort',
    ];

    protected $primaryKey = 'cat_id';

}
