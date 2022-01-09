<?php

namespace App\Models;


class CopyrightAuth extends BaseModel
{
    protected $table = 'copyright_auth';

    protected $fillable = [
        'auth_name','auth_image','links_url','is_show','auth_sort'
    ];

    protected $primaryKey = 'auth_id';
}
