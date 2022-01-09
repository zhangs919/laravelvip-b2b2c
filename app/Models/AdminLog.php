<?php

namespace App\Models;


class AdminLog extends BaseModel
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'admin_log';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'content', 'admin_name', 'admin_id', 'ip', 'url'
    ];

}
