<?php

namespace App\Models;


class CatAttribute extends BaseModel
{
    protected $table = 'cat_attribute';

    protected $fillable = [
        'cat_id', // 商品分类id
        'attr_id', // 属性或规格id
        'is_required', // 必填
        'is_show', // 显示
        'is_default',
        'is_input', // 允许输入
        'is_alias', // 别名
        'is_spec', // 是否规格 1规格 0属性
        'is_desc', // 备注
        'is_filter', // 筛选
        'group_name', // 分组名称
        'sort',
    ];

    protected $primaryKey = 'cat_attr_id';

    public function attr_value()
    {
        return $this->hasMany(AttrValue::class, 'attr_id');
    }
}
