<?php

namespace App\Models;


class Brand extends BaseModel
{
    protected $table = 'brand';

    protected $fillable = [
        'brand_name','brand_letter','site_url','brand_logo','brand_banner','promotion_image','brand_desc','is_show','is_recommend',
        'brand_apply','brand_sort'
    ];

    protected $primaryKey = 'brand_id';

    /**
     * 多对多 关联商品分类
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function category()
    {
        return $this->belongsToMany(Category::class, 'brand_category', 'brand_id', 'cat_id');
    }
}
