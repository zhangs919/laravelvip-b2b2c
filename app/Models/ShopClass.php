<?php

namespace App\Models;


class ShopClass extends BaseModel
{
    protected $table = 'shop_class';

    protected $fillable = [
        'cls_name','parent_id','cls_image','is_hot','is_show','cls_sort','keywords','cls_desc'
    ];

    protected $primaryKey = 'cls_id';
}
