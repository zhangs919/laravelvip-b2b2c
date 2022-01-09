<?php

namespace App\Models;


class DefaultSearch extends BaseModel
{
    //
    protected $table = 'default_search';

    protected $fillable = [
        'search_type','type_id','search_keywords','is_show','sort'
    ];

    protected $primaryKey = 'id';
}
