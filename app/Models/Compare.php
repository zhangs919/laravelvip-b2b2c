<?php

namespace App\Models;


class Compare extends BaseModel
{
    protected $table = 'compare';

    protected $fillable = [
        'user_id','goods_id'
    ];

    protected $primaryKey = 'compare_id';

}
