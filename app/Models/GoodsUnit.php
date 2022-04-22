<?php

namespace App\Models;


class GoodsUnit extends BaseModel
{
    protected $table = 'goods_unit';

    protected $fillable = [
        'shop_id','unit_name'
    ];

    protected $primaryKey = 'unit_id';
}
