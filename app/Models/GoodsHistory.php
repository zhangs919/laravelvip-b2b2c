<?php

namespace App\Models;


class GoodsHistory extends BaseModel
{
    protected $table = 'goods_history';

    protected $fillable = [
        'goods_id','user_id','cat_id','cat_id1','cat_id2','cat_id3',
        'history_price','look_time','look_count'
    ];

    protected $primaryKey = 'history_id';
}
