<?php

namespace App\Repositories;


use App\Models\Category;
use App\Models\DefaultSearch;

class DefaultSearchRepository
{
    use BaseRepository;

    protected $model;


    public function __construct()
    {
        $this->model = new DefaultSearch();
    }

    public function getList($condition = [], $column = '')
    {
        $data = $this->model->getList($condition, $column);

        if (!empty($data[0])) {

            foreach ($data[0] as $key=>$value) {
                $cat_name = '默认';
                if ($value->search_type == 1) {
                    $cat_name = Category::where('cat_id',$value->type_id)->value('cat_name');
                }
                $value->search_name = $cat_name;
            }
        }
        return $data;
    }
}