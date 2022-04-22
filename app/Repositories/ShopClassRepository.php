<?php

namespace App\Repositories;

use App\Models\ShopClass;
use App\Services\Tree;
use Illuminate\Support\Facades\DB;

class ShopClassRepository
{
    use BaseRepository;

    protected $model;

    protected $tree;


    public function __construct()
    {
        $this->model = new ShopClass();
        $this->tree = new Tree();
    }

    public function getList($condition = [], $column = '', $toTree = false, $toFormatTree = false)
    {
        $data = $this->model->getList($condition, $column);

        if (!empty($data[0]) && $toTree) {
            // 是否转换为树形结构
            $list = [];
            foreach ($data[0] as $key=>$value) {
                $value->shop_count = DB::table('shop')->where('cat_id', $value->cls_id)->count();
                $list[$key] = $value->toArray();
            }
            $data[0] = $this->tree->list_to_tree($list, 'cls_id', 'parent_id');
        }

        if (!empty($data[0]) && $toFormatTree) {
            // 是否转换为树形结构
            $list = [];
            foreach ($data[0] as $key=>$value) {
                $value->shop_count = DB::table('shop')->where('cat_id', $value->cls_id)->count();
                $list[$key] = $value->toArray();
            }
            $data[0] = $this->tree->toFormatTree($list, 'cls_name', 'cls_id', 'parent_id');
        }
        return $data;
    }

}