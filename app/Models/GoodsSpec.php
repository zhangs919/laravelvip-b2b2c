<?php

namespace App\Models;


class GoodsSpec extends BaseModel
{
    protected $table = 'goods_spec';

    /**
     * attr_vid  serialize
     * attr_vname serialize
     * @var array
     */
    protected $fillable = [
//        'goods_id', 'attr_id', 'attr_vid','attr_name', 'attr_vname', 'attr_desc', 'attr_sort'
//        'goods_id', 'cat_id', 'attr_id', 'attr_sort', 'attr_name', 'is_default',
//        'attr_values' // 商品规格值存储到 goods_spec_value 表中

        'goods_id', 'attr_id', 'attr_vid','cat_id','attr_value', 'attr_desc', 'is_checked','spec_sort'
    ];

    protected $primaryKey = 'spec_id';

}
