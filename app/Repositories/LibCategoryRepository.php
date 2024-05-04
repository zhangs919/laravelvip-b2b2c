<?php

namespace App\Repositories;


use App\Models\LibCategory;
use App\Services\Tree;
use Illuminate\Support\Facades\DB;

class LibCategoryRepository
{
    use BaseRepository;

    protected $model;

    protected $tree;

    public function __construct()
    {
        $this->model = new LibCategory();
        $this->tree = new Tree();
    }

    public function getList($condition = [], $column = '', $toTree = false, $toFormatTree = false, $empty = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;")
    {
        $data = $this->model->getList($condition, $column);

        if (!empty($data[0]) && $toTree) {
            // 是否转换为树形结构
            $list = [];
            foreach ($data[0] as $key=>$value) {
                $value->goods_count = 0; //DB::table('goods')->where('cat_id', $value->cat_id)->count();
                $list[$key] = $value->toArray();
            }
            $data[0] = $this->tree->list_to_tree($list, 'cat_id', 'parent_id');
        }

        if (!empty($data[0]) && $toFormatTree) {
            // 是否转换为树形结构
            $list = [];
            foreach ($data[0] as $key=>$value) {
                $value->goods_count = DB::table('lib_goods')->where('lib_cat_id', $value->cat_id)->count();
                $list[$key] = $value->toArray();
            }
            $data[0] = $this->tree->toFormatTree($list, 'cat_name', 'cat_id', 'parent_id', 0, $empty);
        }

        return $data;
    }

    /**
     * 获取格式化的分类名称列表
     *
     * @return array
     */
    public function getFormatCategory()
    {
        $condition = [
            'where' => [
                ['is_show',1]
            ],
            'limit' => 0, // 不分页
            'sortname' => 'created_at',
            'sortorder' => 'asc'
        ];
        list($list, $total) = $this->getList($condition, '', false, true);

        $cat_list[0] = [
            'has_child' => false,
            'cat_id' => 0,
            'cat_name' => '-- 请选择 --'
        ];

        $cat_name = '';
        if (!empty($list)) {
            foreach ($list as $item) {
                $hasChild = false;
                if ($item['level'] == 1) {
                    $cat_name = $item['_child'] ? '<span>◢</span>&nbsp;'.$item['cat_name'] : $item['cat_name'];
                    $hasChild = $item['_child'] ? true : false;
                } elseif ($item['level'] == 2) {
                    $cat_name = $item['_child'] ? '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>◢</span>&nbsp;'.$item['cat_name'] : '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$item['cat_name'];
                    $hasChild = $item['_child'] ? true : false;
                } elseif ($item['level'] == 3) {
                    $cat_name = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$item['cat_name'];
                    $hasChild = false;
                }
//                $cat_list[] = $cat_name;
                $cat_list[$item['cat_id']] = [
                    'has_child' => $hasChild,
                    'cat_id' => $item['cat_id'],
                    'cat_name' => $cat_name
                ];
            }
        }

        return $cat_list;
    }
}