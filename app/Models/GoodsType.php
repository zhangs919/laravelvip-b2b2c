<?php

namespace App\Models;


class GoodsType extends BaseModel
{
    protected $table = 'goods_type';

    protected $fillable = [
        'type_name','type_desc','type_sort'
    ];

    protected $primaryKey = 'type_id';

}
