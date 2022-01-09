<?php

namespace App\Models;


class ShopCategory extends BaseModel
{
    protected $table = 'shop_category';

    protected $fillable = [
        'cat_name','parent_id','shop_id','keywords','cat_desc','cat_sort','is_show'
    ];

    protected $primaryKey = 'cat_id';
}
