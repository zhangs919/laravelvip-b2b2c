<?php

namespace App\Models;


class HotSearch extends BaseModel
{
    //
    protected $table = 'hot_search';

    protected $fillable = [
        'site_id','keyword','show_words','is_show','sort',
    ];

    protected $primaryKey = 'id';

    public function getCacheData()
    {
        $cache_id = CACHE_KEY_HOT_SEARCH[0];
        if ($list = cache()->get($cache_id)) {
            return $list;
        }
        $list = HotSearch::where('is_show', 1)->select(['id','keyword','show_words'])->limit(10)->orderBy('sort', 'asc')->get();
        cache()->put($cache_id, $list, CACHE_KEY_HOT_SEARCH[1]);
        return $list;
    }
}
