<?php

namespace App\Models;


class GoodsCat extends BaseModel
{
    protected $table = 'goods_cat';

    /**
     * @var array
     */
    protected $fillable = [
        'goods_id', 'cat_id'
    ];

    protected $primaryKey = 'goods_id';
}
