<?php

namespace App\Repositories;


use App\Models\ActivityCategory;
use App\Services\Tree;
use Illuminate\Support\Facades\DB;

class ActivityCategoryRepository
{
    use BaseRepository;

    protected $model;

    protected $tree;


    public function __construct()
    {
        $this->model = new ActivityCategory();
        $this->tree = new Tree();
    }


    public function getList($condition = [], $column = '', $toTree = false, $toFormatTree = false, $empty = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;")
    {
        $data = $this->model->getList($condition, $column);

        if (!empty($data[0])) {
            foreach ($data[0] as $v) {
                $v->cat_name_pinyin_short = pinyin_abbr($v->cat_name); // 拼音首字母简写
                $v->cat_name_pinyin = pinyin_permalink($v->cat_name, ''); // 拼音全拼
            }
        }

        if (!empty($data[0]) && $toTree) {
            // 是否转换为树形结构
            $list = [];
            foreach ($data[0] as $key=>$value) {
                $list[$key] = $value->toArray();
            }
            $data[0] = $this->tree->list_to_tree($list, 'id', 'parent_id');
        }

        if (!empty($data[0]) && $toFormatTree) {
            // 是否转换为树形结构
            $list = [];
            foreach ($data[0] as $key=>$value) {
                $value->goods_count = DB::table('goods')->where('cat_id', $value->cat_id)->count();
                $list[$key] = $value->toArray();
            }
            $data[0] = $this->tree->toFormatTree($list, 'cat_name', 'id', 'parent_id', 0, $empty);
        }
        return $data;
    }

    public function getCateData()
    {
        $list = ActivityCategory::where('is_show', 1)->pluck('cat_name','id')->toArray();

        return $list;
    }

}