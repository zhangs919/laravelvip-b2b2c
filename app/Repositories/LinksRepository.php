<?php

// +----------------------------------------------------------------------
// | laravelvip 乐融沃B2B2C商城系统
// +----------------------------------------------------------------------
// | Copyright (c) 2017-2027 http://www.laravelvip.com All rights reserved.
// +----------------------------------------------------------------------
// | Notice: This code is not open source, it is strictly prohibited
// |         to distribute the copy, otherwise it will pursue its
// |         legal responsibility.
// +----------------------------------------------------------------------
// | 版权所有 2015-2027 云南乐融沃网络科技有限公司，并保留所有权利。
// | 网站地址: http://www.laravelvip.com
// +----------------------------------------------------------------------
// | 这不是一个自由软件！禁止拷贝本软件副本，否则将追究其法律责任！
// | 如需使用，请移步官网购买正版授权。
// +----------------------------------------------------------------------
// | Author: 雲溪荏苒 <290648237@qq.com>
// | Date:2018-08-10
// | Description:友情链接
// +----------------------------------------------------------------------

namespace App\Repositories;

use App\Models\Links;

class LinksRepository
{
    use BaseRepository;

    protected $model;



    public function __construct()
    {
        $this->model = new Links();
    }

    public function getFlinksList()
    {
        $cache_id = CACHE_KEY_FLINK_LIST[0];
        if ($data = cache()->get($cache_id)) {
            return $data;
        }

        $condition = [
            'where' => [
                ['is_show',1]
            ],
            'sortname' => 'links_sort',
            'sortorder' => 'asc',
        ];
        $data = $this->model->getList($condition);
        cache()->put($cache_id, $data, CACHE_KEY_FLINK_LIST[1]);

        return $data;
    }

}