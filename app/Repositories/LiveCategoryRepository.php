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
// | Date:2020-09-28
// | Description: 直播分类
// +----------------------------------------------------------------------

namespace App\Repositories;



use App\Models\LiveCategory;
use App\Services\Tree;

class LiveCategoryRepository
{
    use BaseRepository;

    protected $model;

    protected $tree;


    public function __construct()
    {
        $this->model = new LiveCategory();
        $this->tree = new Tree();
    }

    public function getList($condition = [], $column = '', $toTree = false, $toFormatTree = false)
    {
        $data = $this->model->getList($condition, $column);

        if (!empty($data[0]) && $toTree) {
            // 是否转换为树形结构
            $list = [];
            foreach ($data[0] as $key=>$value) {
                $list[$key] = $value->toArray();
            }
            $data[0] = $this->tree->list_to_tree($list, 'cat_id', 'parent_id');
        }

        if (!empty($data[0]) && $toFormatTree) {
            // 是否转换为树形结构
            $list = [];
            foreach ($data[0] as $key=>$value) {
                $list[$key] = $value->toArray();
            }
            $data[0] = $this->tree->toFormatTree($list, 'cat_name', 'cat_id', 'parent_id');
        }
        return $data;
    }
}