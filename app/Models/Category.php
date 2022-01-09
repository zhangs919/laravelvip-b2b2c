<?php

namespace App\Models;


class Category extends BaseModel
{
    protected $table = 'category';

    /**
     * ext_info 存关联规格数据 格式：序列化 ['brand']
     * 新加字段 cat_letter 如：分类名称为：零食糕点 则cat_letter为：lingshigaodian
     *          image_link
     *          code 00604 00604,00610  00604,00610,00617  分类code 类似地区code todo 未做保存
     * @var array
     */
    protected $fillable = [
        'cat_name', 'parent_id', 'cat_level', 'cat_image', 'cat_letter', 'ext_info', 'cat_desc',
        'take_rate', 'sync_take_rate', 'show_mode', 'is_parent', 'is_show',
        'show_virtual', 'sync_show_virtual', 'link_type', 'cat_link', 'image_link', 'cat_sort', 'brand_ids',
        'title', 'keywords', 'discription','code'
    ];

    protected $primaryKey = 'cat_id';


    /**
     * 多对多 关联品牌
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function brand()
    {
        return $this->belongsToMany(Brand::class, 'brand_category', 'cat_id', 'brand_id');
    }
}
