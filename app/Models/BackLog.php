<?php

namespace App\Models;


class BackLog extends BaseModel
{
    protected $table = 'back_log';

    protected $fillable = [
        'back_id','record_id','title','contents','images','headimg','add_time'
    ];

    protected $primaryKey = 'log_id';
}
