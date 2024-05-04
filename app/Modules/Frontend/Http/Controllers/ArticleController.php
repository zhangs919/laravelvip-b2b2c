<?php

namespace App\Modules\Frontend\Http\Controllers;

use App\Models\Article;
use App\Modules\Base\Http\Controllers\Frontend;
use App\Repositories\ArticleCatRepository;
use App\Repositories\ArticleRepository;
use Illuminate\Http\Request;

class ArticleController extends Frontend
{

    protected $articleCat;

    protected $article;

    protected $class_list;

    public function __construct(
        ArticleCatRepository $articleCat
        ,ArticleRepository $article
    )
    {
        parent::__construct();

        $this->articleCat = $articleCat;
        $this->article = $article;

        // 帮助中心 文章分类
        $this->class_list = $this->articleCat->getHelpCenterClass();
    }

    /**
     * 帮助中心 文章搜索
     *
     * @param Request $request
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function defaultSearch(Request $request)
    {
        $cat_ids = array_column($this->class_list, 'cat_id');

        $type = $request->post('type', ''); // 搜索类型
        $keyword = $request->post('keyword', ''); // 搜索关键词

        $condition = [
            'where' => [
                ['status', 1],
                ['title', 'like', "%{$keyword}%"],
            ],
            'in' => [
                'field' => 'cat_id',
                'condition' => $cat_ids
            ],
            'field' => ['article_id','title','summary'],
            'limit' => 0,
        ];
        list($list, $total) = $this->article->getList($condition);
        $class_list = $this->class_list;

        $compact = compact('list', 'class_list', 'keyword');
        $webData = []; // web端（pc、mobile）数据对象
        $data = [
            'app_prefix_data' => [
                'article_cat' => $class_list,
                'article_content' => false,
                'search_content' => $list->toArray()
            ],
            'app_suffix_data' => [],
            'web_data' => $webData,
            'compact_data' => $compact,
            'tpl_view' => 'article.default_search'
        ];
        $this->setData($data); // 设置数据
        return $this->displayData(); // 模板渲染及APP客户端返回数据
    }

    /**
     * 帮助中心 文章详情
     * 
     * @param Request $request
     * @param $article_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showHelp(Request $request, $article_id = 0)
    {
        if (empty($article_id)) { // /help/default/info?article_id=$article_id请求
            $article_id = $request->get('article_id');
        }
        if (!$article_id) {
            abort(404, '文章id无效');
        }

        $class_list = $this->article->getHelpCenterArticle();
        $article_info = $this->article->getById($article_id);

        $this->show_seo('seo_article_info',['name'=>$article_info->title]); // SEO

        $compact = compact('article_info', 'class_list');
        $webData = []; // web端（pc、mobile）数据对象
        $data = [
            'app_prefix_data' => [
                'article_cat' => $class_list,
                'article_content' => [
                    'title' => $article_info->title,
                    'cat_id' => $article_info->cat_id,
                    'content' => $article_info->content
                ],
                'article_id' => $article_id
            ],
            'app_suffix_data' => [],
            'web_data' => $webData,
            'compact_data' => $compact,
            'tpl_view' => 'article.show_help'
        ];
        $this->setData($data); // 设置数据
        return $this->displayData(); // 模板渲染及APP客户端返回数据
    }

//    public function showShop(Request $request, $article_id)
//    {
//        // 商家指南 文章分类
//        $condition = [
//            'where' => [
//                ['is_show', 1],
////                ['cat_type', ['in' => [3,11,12]]]
//            ],
//            'in' => [
//                'field' => 'cat_type',
//                'condition' => [3,11,12]
//            ],
//            'limit' => 0,
//        ];
//        list($class_list, $total) = $this->articleCat->getList($condition, '', true);
////        dd($class_list);
//        $article_info = $this->article->getById($article_id);
//
////        dd($article_info);
//        return view('article.show_shop', compact('article_info', 'class_list'));
//    }

    /**
     * 所有文章分类下的文章详情展示
     *
     * @param Request $request
     * @param $article_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showArticle(Request $request, $article_id)
    {

        $articleCatFields = $this->articleCat->getAppArticleCatFields();
        $articleFields = $this->article->getAppArticleFields();

        $condition = [
            'where' => [
                ['is_show', 1],
            ],
            'limit' => 0,
            'field' => $articleCatFields
        ];
        list($cat_list, $total) = $this->articleCat->getList($condition, '', true);
        $article_info = $this->article->getById($article_id, $articleFields);
        if (empty($article_info)) {
            abort(404, '文章id无效');
        }
        $article_info = $article_info->toArray();

        Article::where('article_id', $article_id)->increment('click_number', 1); // 统计点击数+1

        // 当前文章所属分类信息
        $cat = $this->articleCat->getById($article_info['cat_id'], $articleCatFields);
        // 上一篇、下一篇文章
        list($article_pre, $article_next) = $this->article->getFrontAfterArticle($article_id);

        $this->show_seo('seo_article_info',['name'=>$article_info['title']]); // SEO

        $compact = compact('cat_list','article_info','cat','article_pre','article_next');
        $webData = []; // web端（pc、mobile）数据对象
        $data = [
            'app_prefix_data' => [
                'article' => $article_info,
                'article_pre' => $article_pre,
                'article_next' => $article_next,
                'cat_list' => $cat_list,
                'cat_id' => $article_info['cat_id'],
                'shop_id' => $article_info['shop_id'],
                'cat' => $cat->toArray(),
                'list_title' => "",
                'url' => 'article'
            ],
            'app_suffix_data' => [],
            'web_data' => $webData,
            'compact_data' => $compact,
            'tpl_view' => 'article.show_article'
        ];
        $this->setData($data); // 设置数据
        return $this->displayData(); // 模板渲染及APP客户端返回数据
    }

    /**
     * 显示文章列表
     *
     * @param Request $request
     * @param $cat_id
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Throwable
     */
    public function showArticleList(Request $request, $cat_id = 0)
    {
        $seo_title = '文章列表';
        $articleCatFields = $this->articleCat->getAppArticleCatFields();
        $articleFields = $this->article->getAppArticleFields();

        // 文章列表
        $keyword = $request->get('keyword', '');
        $condition = [
            'where' => [
                ['status', 1],
                ['title', 'like', "%{$keyword}%"],
            ],
            'field' => $articleFields,
        ];
        $cat = [];
        if ($cat_id) {
            $cat_ids = get_article_cat_grandson($cat_id);
            $condition['in'] = [
                'field' => 'cat_id',
                'condition' => $cat_ids
            ];
            // 当前文章所属分类信息
            $cat = $this->articleCat->getById($cat_id, $articleCatFields);
            $seo_title = $cat['cat_name'];
        }
        list($list, $total) = $this->article->getList($condition);
        $list = $list->toArray();
        $pageHtml = frontend_pagination($total);
        if ($request->ajax()) {
            $render = view('article.partials._article_list', compact('list', 'total', 'pageHtml'))->render();
            return result(0,$render);
        }

        // 分类列表
        $condition = [
            'where' => [
                ['is_show', 1],
            ],
            'limit' => 0,
            'field' => $articleCatFields
        ];
        list($cat_list, $cat_total) = $this->articleCat->getList($condition, '', true);
        
        $this->show_seo('seo_article_cat',['name'=>$seo_title]); // SEO

        $compact = compact('list','pageHtml','cat_list','cat');
        $webData = []; // web端（pc、mobile）数据对象
        $data = [
            'app_prefix_data' => [
                'list' => $list,
                'page' => frontend_pagination($total, true),
                'cat_list' => $cat_list,
                'cat_id' => $cat_id,
                'shop_id' => 0,
                'cat' => $cat,
                'list_title' => "",
                'url' => 'article'
            ],
            'app_suffix_data' => [],
            'web_data' => $webData,
            'compact_data' => $compact,
            'tpl_view' => 'article.article_list'
        ];
        $this->setData($data); // 设置数据
        return $this->displayData(); // 模板渲染及APP客户端返回数据
    }

}