<?php

namespace App\Models;


use Illuminate\Support\Arr;
use Laravel\Scout\Searchable;

class Article extends BaseModel
{
//    use Searchable;

    protected $table = 'article';

    protected $fillable = [
        'cat_id', 'cat_model', 'cat_type', 'extend_cat', 'user_id', 'shop_id', 'goods_ids',
        'title', 'keywords', 'add_time', 'source', 'is_show',
        'is_recommend', 'article_thumb', 'summary', 'content',
        'link', 'sort', 'status', 'click_number'
    ];

    protected $primaryKey = 'article_id';


    // 定义索引里面的类型，上文我们说过，可以把type理解成一个数据表。我们现在要做的就是把我们所有的要全文搜索的字段都存入到es中的一个叫'_doc'的表中。
//    public function searchableAs()
//    {
//        return 'article';
//    }
//    // 定义有那些字段需要搜索
//    public function toSearchableArray()
//    {
//        $array = [
//            'cat_id' => $this->cat_id,  //user_name加上前缀以区别。因为不同的表里可能会有相同的字段。mysql中的字段是name,email,created_at。在es中我们存储的user_name，user_email,user_created_at。是可以自定义的。
//            'title' => $this->title,
//            'summary' => $this->summary,
//            'content' => $this->content,
//        ];
//
//        return $array;
//    }
//
//    public function shouldBeSearchable()
//    {
//        return $this->is_show;
//    }

    public function articleCat()
    {
        $this->belongsTo(ArticleCat::class, 'cat_id');
    }

	public function shop()
	{
		$this->belongsTo(Shop::class, 'shop_id');
	}

    public function scopeByIds($query, $ids)
    {
        return $query->whereIn('id', $ids)->orderByRaw(sprintf("FIND_IN_SET(id, '%s')", join(',', $ids)));
    }

    public function toESArray()
    {
        // 只取出需要的字段
        $arr = Arr::only($this->toArray(), [
            'article_id',
            'cat_id',
            'title',
            'summary',
            'content'
        ]);

        return $arr;
    }








}
