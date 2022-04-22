<?php

namespace App\Models;

class SystemConfig extends BaseModel
{
    //
    protected $table = 'system_config';

    protected $fillable = [
        'id',
        'code',
        'title',
        'unit',
        'group',
        'type',
        'required',
        'anchor',
        'value',
        'options',
        'labels',
        'tips',
        'sort',
        'status',
        'store_dir'
    ];
}
