<?php

namespace App\Models;


use Illuminate\Support\Facades\DB;

class Attribute extends BaseModel
{
    protected $table = 'attribute';

    protected $fillable = [
        'type_id','attr_name','attr_remark',
        'is_index','is_show',// 注释
        'attr_style','attr_values',
//        'attr_values', // attr_vid attr_vname attr_vsort is_delete
        'attr_sort','shop_id','par_attr_id','is_spec','is_linked'
    ];

    protected $primaryKey = 'attr_id';

    public function attr_value()
    {
        return $this->hasMany(AttrValue::class, 'attr_id');
    }


}
