<?php

namespace App\Models;


class ArticleCat extends BaseModel
{

    protected $table = 'article_cat';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'cat_id', 'cat_name', 'parent_id', 'cat_model', 'cat_type', 'cat_level', 'cat_image',
        'cat_desc', 'meta_title', 'meta_keywords', 'meta_desc', 'is_show', 'cat_sort'
    ];

    protected $primaryKey = 'cat_id';

    public function article()
    {
        return $this->hasMany(Article::class, 'cat_id', 'cat_id');
    }

}
