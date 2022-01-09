<?php

namespace App\Models;


class NavWords extends BaseModel
{
    protected $table = 'nav_words';

    protected $fillable = [
        'words_name','words_type','new_open','is_show','words_sort','words_link','category_id'
    ];

    protected $primaryKey = 'id';
}
