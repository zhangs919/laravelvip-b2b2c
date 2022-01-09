<?php

namespace App\Repositories;


use App\Models\CatAttribute;
use App\Models\Category;
use App\Services\Tree;
use Illuminate\Support\Facades\DB;

class CategoryRepository
{
    use BaseRepository;

    protected $model;

    protected $tree;

    public function __construct()
    {
        $this->model = new Category();
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
                $value->goods_count = DB::table('goods')->where('cat_id', $value->cat_id)->count();
                $list[$key] = $value->toArray();
            }
            $data[0] = $this->tree->list_to_tree($list, 'cat_id', 'parent_id');
        }

        if (!empty($data[0]) && $toFormatTree) {
            // 是否转换为树形结构
            $list = [];
            foreach ($data[0] as $key=>$value) {
                $value->goods_count = DB::table('goods')->where('cat_id', $value->cat_id)->count();
                $list[$key] = $value->toArray();
            }
            $data[0] = $this->tree->toFormatTree($list, 'cat_name', 'cat_id', 'parent_id', 0, $empty);
        }
        return $data;
    }


    public function storeCatAttr($attr_values)
    {
//        dd($attr_values);
        DB::beginTransaction();
        try {

            // 批量插入/更新
            if (!empty($attr_values)) {
                foreach ($attr_values as $item) {

                    if (isset($item['is_delete'])) {
                        $updateCondition = [['cat_id', $item['cat_id']], ['attr_id', $item['attr_id']]];

                        // 如果有is_delete 则表示是修改
                        if ($item['is_delete']) {
                            // 如果is_delete = 1 则表示删除
                            CatAttribute::where($updateCondition)->delete();
                        } else {
                            // 否则表示更新
                            unset($item['is_delete']);
                            CatAttribute::where($updateCondition)->update($item);
                        }
                    } else {
                        // 如果没有is_delete 则表示新增
                        $cat_attr_model  = new CatAttribute();
                        $cat_attr_model->fill($item);
                        $cat_attr_model->save();
                    }

                }
            }

            DB::commit();
            return true;
        }catch (\Exception $e){
            DB::rollback();//事务回滚
            echo $e->getMessage();
            echo $e->getCode();
            return false;
        }
    }

    public function storeCatSpec($attr_values)
    {
//        dd($attr_values);
        DB::beginTransaction();
        try {

            // 批量更新
            if (!empty($attr_values)) {
                foreach ($attr_values as $item) {

                    $updateCondition = [['cat_id', $item['cat_id']], ['attr_id', $item['attr_id']]];
                    CatAttribute::where($updateCondition)->update($item);

                }
            }

            DB::commit();
            return true;
        }catch (\Exception $e){
            DB::rollback();//事务回滚
            echo $e->getMessage();
            echo $e->getCode();
            return false;
        }
    }

    public function getCategoryBread($cat_id)
    {
        $cat_info = $this->model->getByField('cat_id', $cat_id);
        $level1 = $level2 = $level3 = [];
        if ($cat_info->cat_level == 3) {
            $level3 = $cat_info;
            $level2 = $this->model->getByField('cat_id', $cat_info->parent_id);
            $level1 = $this->model->getByField('cat_id', $level2->parent_id);
        } elseif ($cat_info->cat_level == 2) {
            $level2 = $cat_info;
            $level1 = $this->model->getByField('cat_id', $level2->parent_id);
        } elseif ($cat_info->cat_level == 1) {
            $level1 = $cat_info;
        }
        $data = [
            0 => $level1,
            1 => $level2,
            2 => $level3
        ];

        return array_filter($data);
    }

    public function getCatIds($cat_id)
    {
        $cat_id1 = $cat_id2 = $cat_id3 = 0;
        $cat_arr = $this->getCategoryBread($cat_id);
        if(!empty($cat_arr)) {
            foreach ($cat_arr as $item) {
                if ($item['cat_level'] == 1) {
                    $cat_id1 = $item['cat_id'];
                } elseif ($item['cat_level'] == 2) {
                    $cat_id2 = $item['cat_id'];
                } elseif ($item['cat_level'] == 3) {
                    $cat_id3 = $item['cat_id'];
                }
            }
        }
        $catIds = [
            'cat_id1' => $cat_id1,
            'cat_id2' => $cat_id2,
            'cat_id3' => $cat_id3
        ];
        return $catIds;
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
            'sortorder' => 'desc'
        ];
        list($list, $total) = $this->getList($condition, '', false, true);

        $cat_list = [
            0=>''
        ];
        $cat_name = '';
        if (!empty($list)) {
            foreach ($list as $item) {
                if ($item['level'] == 1) {
                    $cat_name = $item['_child'] ? '<span>◢</span>&nbsp;'.$item['cat_name'] : $item['cat_name'];
                } elseif ($item['level'] == 2) {
                    $cat_name = $item['_child'] ? '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>◢</span>&nbsp;'.$item['cat_name'] : '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$item['cat_name'];
                } elseif ($item['level'] == 3) {
                    $cat_name = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$item['cat_name'];
                }
                $cat_list[] = $cat_name;
            }
        }

        return $cat_list;
    }
}