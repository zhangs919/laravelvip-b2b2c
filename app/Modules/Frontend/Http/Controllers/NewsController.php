<?php

// +----------------------------------------------------------------------
// | laravelvip 乐融沃B2B2C商城系统
// +----------------------------------------------------------------------
// | Copyright (c) 2017-2027 http://www.laravelvip.com All rights reserved.
// +----------------------------------------------------------------------
// | Notice: This code is not open source, it is strictly prohibited
// |         to distribute the copy, otherwise it will pursue its
// |         legal responsibility.
// +----------------------------------------------------------------------
// | 版权所有 2015-2027 云南乐融沃网络科技有限公司，并保留所有权利。
// | 网站地址: http://www.laravelvip.com
// +----------------------------------------------------------------------
// | 这不是一个自由软件！禁止拷贝本软件副本，否则将追究其法律责任！
// | 如需使用，请移步官网购买正版授权。
// +----------------------------------------------------------------------
// | Author: 雲溪荏苒 <290648237@qq.com>
// | Date:2018-08-28
// | Description:
// +----------------------------------------------------------------------

namespace App\Modules\Frontend\Http\Controllers;

use App\Models\ArticleCat;
use App\Modules\Base\Http\Controllers\Frontend;
use App\Repositories\ArticleCatRepository;
use App\Repositories\ArticleRepository;
use App\Repositories\TemplateItemRepository;
use App\Repositories\TemplateRepository;
use App\Repositories\TemplateSelectorRepository;
use Illuminate\Http\Request;

class NewsController extends Frontend
{

    protected $template;
    protected $selector;
    protected $templateItem;

    protected $articleCat;

    protected $article;


    public function __construct(
        TemplateRepository $template
        ,TemplateSelectorRepository $selector
        ,TemplateItemRepository $templateItem
        ,ArticleCatRepository $articleCat
        ,ArticleRepository $article
    )
    {
        parent::__construct();

        $this->template = $template;
        $this->selector = $selector;
        $this->templateItem = $templateItem;

        $this->articleCat = $articleCat;
        $this->article = $article;
    }

    public function home(Request $request)
    {
        if (is_app()) {
            $page = 'app_news';
        } elseif (is_mobile() || (request()->getHost() == config('lrw.mobile_domain'))) {
            $page = 'm_news';
        } else {
            $page = 'news';
        }

        $template = $this->templateItem->getTplItems($page); // app端模板数据

        list($tplHtml, $navContainerHtml) = $this->templateItem->getPageTplHtml($page); // 模板Html数据

        // 判断首页静态页面开启状态
        $webStatic = 1; // 固定为开启静态页面

        // 分类列表
        $articleCatFields = $this->articleCat->getAppArticleCatFields();
        $condition = [
            'where' => [
                ['is_show', 1],
                ['cat_model', 2], // 普通分类
                ['cat_type', 1],
            ],
            'sortname' => 'cat_sort',
            'sortorder' => 'asc',
            'field' => $articleCatFields
        ];
        list($cat_list, $cat_total) = $this->articleCat->getList($condition, '', true);

        $compact = compact('page','template', 'tplHtml', 'navContainerHtml','webStatic');

        $this->show_seo('seo_news'); // SEO

        $webData = []; // web端（pc、mobile）数据对象
        $data = [
            'app_prefix_data' => [
                'template' => $template,
                'cat_list' => $cat_list,
                'page' => $page,
                'is_design' => false,
                'site_id' => 0,
                'news_header' =>'',
                'news_footer' => '',
            ],
            'app_suffix_data' => [],
            'web_data' => $webData,
            'compact_data' => $compact,
            'tpl_view' => 'news.home'
        ];
        $this->setData($data); // 设置数据
        return $this->displayData(); // 模板渲染及APP客户端返回数据
    }


    public function lists(Request $request, $cat_id)
    {
        $articleCatFields = $this->articleCat->getAppArticleCatFields();
        $articleFields = $this->article->getAppArticleFields();

        $keyword = $request->get('keyword','');

        // 分类列表
        $condition = [
            'where' => [
                ['is_show', 1],
                ['cat_model', 2], // 普通分类
                ['cat_type', 1],
            ],
            'sortname' => 'cat_sort',
            'sortorder' => 'asc',
            'field' => $articleCatFields
        ];
        list($cat_list, $cat_total) = $this->articleCat->getList($condition, '', true);

        // 当前分类
        $cat = $this->articleCat->getById($cat_id, $articleCatFields)->toArray();

        // 面包屑
        $crumbs = [];
        if ($cat['parent_id'] > 0) {
            $crumbs = ArticleCat::where([['is_show',1],['cat_id', $cat['parent_id']]])->select(['cat_id','cat_name','parent_id'])->get()->toArray();
        }

        // 推荐文章
        $recommend = $this->get_recommend_list($cat_id);

        // 文章列表
        $cat_ids = get_article_cat_grandson(intval($cat_id));
        $where = [];
        $where[] = ['status',1];
        if (!empty($keyword)) {
            $where[] = ['title', "%{$keyword}%"];
        }
        $condition = [
            'where' => $where,
            'in' => ['field'=>'cat_id','condition' => $cat_ids],
            'field' => $articleFields
        ];
        list($list, $total) = $this->article->getList($condition);
        $pageHtml = frontend_pagination($total);
        if ($request->ajax()) {
            $render = view('news.partials._list', compact('list', 'total', 'pageHtml'))->render();
            return result(0,$render);
        }
        $page_array = frontend_pagination($total, true);
        $json_page = json_encode($page_array);

        $compact = compact('keyword', 'cat_list', 'cat', 'crumbs', 'recommend', 'list', 'pageHtml', 'json_page');

        $this->show_seo('seo_news'); // SEO

        $webData = []; // web端（pc、mobile）数据对象
        $data = [
            'app_prefix_data' => [
                'keyword' => $keyword,
                'cat_list' => $cat_list,
                'cat' => $cat,
                'crumbs' => $crumbs,
                'recommend' => $recommend,
                'list' => $list->toArray(),
                'page' => $page_array,
                'news_header' =>'',
                'news_footer' => '',
            ],
            'app_suffix_data' => [],
            'web_data' => $webData,
            'compact_data' => $compact,
            'tpl_view' => 'news.list'
        ];
        $this->setData($data); // 设置数据
        return $this->displayData(); // 模板渲染及APP客户端返回数据
    }

    public function show(Request $request, $article_id)
    {
        $articleCatFields = $this->articleCat->getAppArticleCatFields();
        $articleFields = $this->article->getAppArticleFields();

        $article = $this->article->getById($article_id, $articleFields)->toArray();
//        $article['content'] = str_replace(['\r', '\n', '\t', '\r\n\t'], ['','','',''], $article['content']); // 过滤 \r\n\t
//        preg_replace('//s*/', '', $article['content']); ; // 过滤 \r\n\t
        $hide_header = true;

        // 当前文章所属分类信息
        $cat = $this->articleCat->getById($article['cat_id'], $articleCatFields)->toArray();

        // 面包屑
        $crumbs = [];
        if ($cat['parent_id'] > 0) {
            $crumbs = ArticleCat::where([['is_show',1],['cat_id', $cat['parent_id']]])->select(['cat_id','cat_name','parent_id'])->get()->toArray();
        }
        // 推荐文章
        $recommend = $this->get_recommend_list($cat['cat_id']);

        // 上一篇、下一篇文章
        list($article_pre, $article_next) = $this->article->getFrontAfterArticle($article_id);

        $seo_title = $article['title'].' - '.sysconf('site_name');
        $this->show_seo('seo_news',['name'=>$seo_title, 'image' => $article['article_thumb']]); // SEO

        $compact = compact('article','hide_header','crumbs','cat','recommend','article_pre','article_next', 'seo_title');
        $webData = []; // web端（pc、mobile）数据对象
        $data = [
            'app_prefix_data' => [
                'article' => $article,
                'hide_header' => $hide_header,
                'cat' => $cat,
                'crumbs' => $crumbs,
                'recommend' => $recommend,
                'article_pre' => $article_pre,
                'article_next' => $article_next,
                'news_header' => '',
                'news_footer' => ''
            ],
            'app_suffix_data' => [],
            'web_data' => $webData,
            'compact_data' => $compact,
            'tpl_view' => 'news.show'
        ];
        $this->setData($data); // 设置数据
        return $this->displayData(); // 模板渲染及APP客户端返回数据
    }

    public function get_recommend_list($cat_id)
    {
        $cat_ids = get_article_cat_grandson(intval($cat_id));
        $where = [];
        $where[] = ['status',1];
        $condition = [
            'where' => [['status', 1],['is_recommend',1]],
            'in' => ['field'=>'cat_id','condition' => $cat_ids],
            'limit' => 5,
            'field' => $this->article->getAppArticleFields()
        ];
        list($recommend_list, $recommend_total) = $this->article->getList($condition);
        return $recommend_list->toArray();
    }
}