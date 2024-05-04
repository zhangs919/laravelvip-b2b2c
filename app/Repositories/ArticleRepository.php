<?php

namespace App\Repositories;

use App\Models\Article;
use Illuminate\Support\Facades\Cache;

class ArticleRepository
{
    use BaseRepository;

    protected $model;
    protected $articleCat;

    public function __construct()
    {
        $this->model = new Article();
        $this->articleCat = new ArticleCatRepository();
    }


    /**
     * 获取帮助中心文章列表
     *
     * @return mixed
     */
    public function getHelpCenterArticle()
    {

        $cache_id = CACHE_KEY_HELP_CENTER_ARTICLES[0];
        if ($class_list = cache()->get($cache_id)) {
            return $class_list;
        }
        // 帮助中心文章分类
        $class_list = $this->articleCat->getHelpCenterClass();
        if (!empty($class_list)) {
            foreach ($class_list as &$item) {
                $aCondition = [
                    'where' => [
                        ['status', 1],
                        ['cat_id', $item['cat_id']]
                    ],
                    'limit' => 0,
                ];
                list($articles, $articleTotal) = $this->model->getList($aCondition);
                $item['article'] = $articles->toArray();
            }
        }
        cache()->put($cache_id, $class_list, CACHE_KEY_HELP_CENTER_ARTICLES[1]);

        return $class_list;
    }

    /**
     * 获取上一篇/下一篇
     *
     * @param int $id 文章id
     * @return array
     */
    public function getFrontAfterArticle($id)
    {
        //上一篇
        $previous = $this->model->select($this->getAppArticleFields())
            ->where([['article_id', '<', $id]])->orderBy('article_id', 'desc')->limit(1)->first();
        if (!empty($previous)) {
            $previous->toArray();
        }
        //下一篇
        $next = $this->model->select($this->getAppArticleFields())
            ->where([['article_id', '>', $id]])->orderBy('article_id', 'asc')->limit(1)->first();
        if (!empty($next)) {
            $next->toArray();
        }
        return [$previous, $next];
    }


    /**
     * 获取app端文章字段
     *
     * @return array
     */
    public function getAppArticleFields()
    {
        $data = [
            'article_id','title','cat_id','content','keywords',
//            'jurisdiction',
            'article_thumb',
            'add_time','is_comment','click_number','is_show','user_id','status','link','source',
            'summary','goods_ids','shop_id','extend_cat','sort','is_recommend'
        ];

        return $data;
    }

    /**
     * 获取店铺入驻文章列表
     *
     * @param $cat_id
     * @param int $size
     * @param string $ordertype
     * @param string $articleFields
     * @return mixed
     */
    public function getShopApplyArticles($cat_id, $size = 5, $ordertype = 'asc', $articleFields = '')
    {
        if ($articleFields == '') {
            $articleFields = ['article_id','title','content','keywords','article_thumb','add_time','link','summary'];
        }
        // 入驻指南文章 asc排序
        $condition = [
            'where' => [
                ['status', 1],
                ['cat_id', $cat_id],
            ],
            'sortname' => 'sort',
            'sortorder' => $ordertype,
            'page_size' => $size,
            'field' => $articleFields,
        ];
        list($list, $total) = $this->getList($condition);
        $list = $list->toArray();
        if (!empty($list)) {
            foreach ($list as &$v) {
                if (isset($v['article_thumb'])) {
                    $v['article_thumb'] = get_image_url($v['article_thumb']);
                }
            }
        }

        return $list;
    }

    /**
     * 根据分类类型id获取文章列表
     *
     * @param int $cat_type 分类类型id 如：2-商城公告
     * @param int $size
     * @param string $ordertype
     * @param string $articleFields
     * @return mixed
     */
    public function getArticlesByCatType($cat_type, $size = 5, $ordertype = 'asc', $articleFields = '')
    {
        if ($articleFields == '') {
            $articleFields = ['article_id','title','content','keywords','article_thumb','add_time','link','summary'];
        }
        // 入驻指南文章 asc排序
        $condition = [
            'where' => [
                ['status', 1],
                ['cat_type', $cat_type],
            ],
            'sortname' => 'sort',
            'sortorder' => $ordertype,
            'page_size' => $size,
            'field' => $articleFields,
        ];
        list($list, $total) = $this->getList($condition);
        $list = $list->toArray();
        if (!empty($list)) {
            foreach ($list as &$v) {
                if (isset($v['article_thumb'])) {
                    $v['article_thumb'] = get_image_url($v['article_thumb']);
                }
            }
        }

        return $list;
    }
}