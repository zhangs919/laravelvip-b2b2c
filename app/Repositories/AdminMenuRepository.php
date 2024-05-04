<?php

namespace App\Repositories;

use App\Models\AdminMenu;
use App\Services\Tree;

class AdminMenuRepository
{
    use BaseRepository;

    protected $model;
    protected $tree;

    public function __construct()
    {
        $this->model = new AdminMenu();
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
            $data[0] = $this->tree->list_to_tree($list, 'id', 'pid');
        }

        if (!empty($data[0]) && $toFormatTree) {
            // 是否转换为树形结构
            $list = [];
            foreach ($data[0] as $key=>$value) {
                $list[$key] = $value->toArray();
            }
            $data[0] = $this->tree->toFormatTree($list, 'name', 'id', 'pid');
        }
        return $data;
    }
}