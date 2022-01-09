<?php

namespace App\Models;


class HotSearch extends BaseModel
{
    //
    protected $table = 'hot_search';

    protected $fillable = [
        'site_id','keyword','show_words','is_show','sort',
    ];

    protected $primaryKey = 'id';
}
