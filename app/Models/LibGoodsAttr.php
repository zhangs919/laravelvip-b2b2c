<?php

namespace App\Models;


class LibGoodsAttr extends BaseModel
{
    protected $table = 'lib_goods_attr';

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
