<?php

namespace App\Models;


class NavBrand extends BaseModel
{
    protected $table = 'nav_brand';

    protected $fillable = [
        'brand_id','is_show','brand_sort','category_id'
    ];

    protected $primaryKey = 'id';

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }
}
