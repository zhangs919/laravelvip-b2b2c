<?php

namespace App\Models;


class GoodsImage extends BaseModel
{
    protected $table = 'goods_image';

    /**
     * @var array
     */
    protected $fillable = [
        'goods_id', 'spec_id', 'path', 'is_default', 'sort'
    ];

    protected $primaryKey = 'img_id';
}
