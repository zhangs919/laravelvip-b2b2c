<?php

namespace App\Models;


class DefaultSearch extends BaseModel
{
    //
    protected $table = 'default_search';

    protected $fillable = [
        'search_type','type_id','search_keywords','is_show','sort'
    ];

    protected $primaryKey = 'id';


    public function getCacheData()
    {
        $cache_id = CACHE_KEY_DEFAULT_SEARCH[0];
        if ($list = cache()->get($cache_id)) {
            return $list;
        }
        $list = DefaultSearch::where('is_show', 1)->orderBy('sort', 'asc')->get();
        cache()->put($cache_id, $list, CACHE_KEY_DEFAULT_SEARCH[1]);
        return $list;
    }
}
