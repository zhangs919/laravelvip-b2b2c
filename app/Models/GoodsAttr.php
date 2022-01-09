<?php

namespace App\Models;


class GoodsAttr extends BaseModel
{
    protected $table = 'goods_attr';

    /**
     * attr_vid  serialize
     * attr_vname serialize
     * @var array
     */
    protected $fillable = [
        'goods_id', 'attr_id', 'attr_vid', 'attr_name', 'attr_vname'
    ];

    protected $primaryKey = 'id';
}
