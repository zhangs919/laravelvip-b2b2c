<?php

namespace App\Models;


class LibGoodsImage extends BaseModel
{
    protected $table = 'lib_goods_image';

    /**
     * @var array
     */
    protected $fillable = [
        'goods_id', 'spec_id', 'path', 'is_default', 'sort'
    ];

    protected $primaryKey = 'img_id';
}
