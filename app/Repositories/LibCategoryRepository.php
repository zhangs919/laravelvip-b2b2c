<?php

namespace App\Repositories;


use App\Models\LibCategory;
use App\Services\Tree;

class LibCategoryRepository
{
    use BaseRepository;

    protected $model;

    protected $tree;

    public function __construct(LibCategory $libCategory, Tree $tree)
    {
        $this->model = $libCategory;
        $this->tree = $tree;
    }

    public function getList($condition = [], $column = '', $toTree = false)
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
        return $data;
    }
}