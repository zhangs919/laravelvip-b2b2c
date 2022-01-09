<?php

namespace App\Models;


class BrandCategory extends BaseModel
{
    protected $table = 'brand_category';

    protected $fillable = [
        'brand_id', 'cat_id'
    ];

    protected $primaryKey = 'bc_id';


}
