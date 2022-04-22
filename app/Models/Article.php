<?php

namespace App\Models;


class Article extends BaseModel
{
    protected $table = 'article';

    protected $fillable = [
        'cat_id', 'cat_model', 'cat_type', 'extend_cat', 'user_id', 'shop_id', 'goods_ids',
        'title', 'keywords', 'add_time', 'source', 'is_show',
        'is_recommend', 'article_thumb', 'summary', 'content',
        'link', 'sort', 'status', 'click_number'
    ];

    protected $primaryKey = 'article_id';

    public function articleCat()
    {
        $this->belongsTo(ArticleCat::class, 'cat_id');
    }

    public function scopeByIds($query, $ids)
    {
        return $query->whereIn('id', $ids)->orderByRaw(sprintf("FIND_IN_SET(id, '%s')", join(',', $ids)));
    }

    public function toESArray()
    {
        // 只取出需要的字段
        $arr = array_only($this->toArray(), [
            'article_id',
            'cat_id',
            'title',
            'summary',
            'content'
        ]);

        return $arr;
    }








}
