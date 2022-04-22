<?php

namespace App\Models;


class ShopConfigField extends BaseModel
{
    //
    protected $table = 'shop_config_field';

    protected $fillable = [
//        'id', 'code', 'shop_id', 'value', 'parent_code', 'remark',
        'code',
        'title',
        'group',
        'type',
        'required',
        'anchor',
        'default_value', // 默认配置值 添加配置项时 可以设置默认值
//        'value', 配置值 不在这里赋值 在shop_config_value 表中赋值
        'options',
        'labels',
        'tips',
        'sort',
        'status',
        'store_dir'
    ];

    protected $primaryKey = 'id';

}
