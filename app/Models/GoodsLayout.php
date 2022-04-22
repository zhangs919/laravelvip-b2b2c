<?php

namespace App\Models;


class GoodsLayout extends BaseModel
{
    protected $table = 'goods_layout';

    protected $fillable = [
        'shop_id','layout_name','position','content'
    ];

    protected $primaryKey = 'layout_id';
}
