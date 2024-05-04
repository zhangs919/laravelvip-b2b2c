<?php

namespace App\Repositories;

use App\Models\Article;
use App\Models\ArticleCat;
use App\Services\Tree;
use Illuminate\Support\Facades\DB;

class ArticleCatRepository
{
    use BaseRepository;

    protected $model;

    protected $tree;

    public function __construct()
    {
        $this->model = new ArticleCat();
        $this->tree = new Tree();
    }

//    public function getList($condition = [], $column = '', $toTree = true)
//    {
//        $data = $this->model->getList($condition, $column);
//        if (!empty($data[0]) && $toTree) {
//            // 是否转换为树形结构
//            $list = [];
//            foreach ($data[0] as $key=>$value) {
////                $value->article_count = DB::table('article')->where('cat_id', $value->cat_id)->count();
//                $list[$key] = $value->toArray();
//            }
//            $data[0] = $this->tree->list_to_tree($list, 'cat_id', 'parent_id');
//        }
//
//        return $data;
//    }

    public function getList($condition = [], $column = '', $toTree = false, $toFormatTree = false)
    {
        $condition['relation'] = 'article'; // 关联文章数量 article_count

        $data = $this->model->getList($condition, $column);

        if (!empty($data[0]) && $toTree) {
            // 是否转换为树形结构
            $list = [];
            foreach ($data[0] as $key=>$value) {
//                $value->article_count = DB::table('article')->where('cat_id', $value->cat_id)->count();
                $list[$key] = $value->toArray();
            }
            $data[0] = $this->tree->list_to_tree($list, 'cat_id', 'parent_id');
        }

        if (!empty($data[0]) && $toFormatTree) {
            // 是否转换为树形结构
            $list = [];
            foreach ($data[0] as $key=>$value) {
//                $value->article_count = DB::table('article')->where('cat_id', $value->cat_id)->count();
                $list[$key] = $value->toArray();
            }
            $data[0] = $this->tree->toFormatTree($list, 'cat_name', 'cat_id', 'parent_id');
        }
        return $data;
    }

    /**
     * 根据分类展示形式获取分类列表
     *
     * @param int $cat_model 分类展示形式 1单网页展示 2普通展示
     * @param bool $filter_active 如果为true 则只返回 在添加文章时 可以被选择的分类列表
     * @return mixed
     */
    public function getCatListByCatModel($cat_model = 1, $filter_active = false, $cat_type = 0)
    {
        // 分类列表
        $where[] = ['cat_model', $cat_model];
        if ($cat_type) {
            $where[] = ['cat_type', $cat_type];
        }
        $catCondition = [
            'where' => $where,
            'relation' => 'article', // 获取该分类下的文章数量 article_count
            'limit' => 0, // 不分页
            'sortname' => 'cat_sort',
            'sortorder' => 'asc'
        ];
        list($cat_list, $total) = $this->getList($catCondition, '', false, true);

        if (!empty($cat_list) && $filter_active) {
            // 筛选判断不能被选择成为文章的分类
            // 1. 单网页展示 如果分类下面已经存在文章 则不允许选择该分类作为文章的分类
            // 2. 普通展示 如果分类有二级分类，则不允许选择一级分类作为文章的分类
            foreach ($cat_list as &$v) {
                $isActive = false;
                if($v['cat_model'] == 1 && $v['article_count'] == 0) {
                    $isActive = true;
                } elseif ($v['cat_model'] == 2) {

                    if ($v['parent_id'] > 0) {
                        // 该分类是子分类 允许被选择
                        $isActive = true;
                    } elseif($v['parent_id'] == 0) {
                        // 该分类是一级分类 检查是否有下级分类
                        $isActive = empty(ArticleCat::where('parent_id', $v['cat_id'])->first()) ? true : false;
                    }
                }
                $v['active'] = $isActive;
            }
        }
        return $cat_list;
    }


    /**
     * 获取帮助中心文章分类
     *
     * @return mixed
     */
    public function getHelpCenterClass()
    {
        // 帮助中心 文章分类
        $condition = [
            'where' => [
                ['is_show', 1],
                ['cat_type', 4]
            ],
            'field' => ['cat_id','cat_name','parent_id'],
            'limit' => 0,
        ];
        list($class_list, $total) = $this->getList($condition, '', true);

        if (!empty($class_list)) {
            foreach ($class_list as &$item) {
                $articles = Article::where([['status',1],['is_show',1],['cat_id',$item['cat_id']]])->orderBy('sort', 'asc')->select(['article_id','title'])->get()->toArray();
                $item['article'] = $articles;

                unset($item['parent_id'], $item['article_count']);
            }
        }

        return $class_list;
    }

    /**
     * 获取app端文章分类字段
     * @return array
     */
    public function getAppArticleCatFields()
    {
        $fields = ['cat_id','cat_name','cat_model','cat_type','parent_id','cat_sort','is_show','cat_desc','cat_image','cat_level','meta_title','meta_keywords','meta_desc'];
        return $fields;
    }
}