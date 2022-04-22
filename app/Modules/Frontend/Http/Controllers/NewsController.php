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


    public function __construct(TemplateRepository $template,
                                TemplateSelectorRepository $selector,
                                TemplateItemRepository $templateItem)
    {
        parent::__construct();

        $this->template = $template;
        $this->selector = $selector;
        $this->templateItem = $templateItem;

        $this->articleCat = new ArticleCatRepository();
        $this->article = new ArticleRepository();

    }

    public function home(Request $request)
    {
//        $page = 'news';

        // 从 template_item 表中获取模板数据
//        $where[] = ['page', $page];
//        $condition = [
//            // data,shop_id,page,sort,ext_info,tpl_title,is_valid,site_id,code,file //这些字段从模板表取 tpl_name,icon,type
//            'field' => ['uid', 'data', 'shop_id', 'page', 'sort', 'ext_info', 'tpl_title', 'is_valid', 'site_id', 'code', 'file'],
//            'where' => $where,
//            'limit' => 0, // 查询全部
//            'sortname' => 'sort',
//            'sortorder' => 'asc'
//        ];
//        list($templateItems, $itemCount) = $this->templateItem->getList($condition);
//
//        $tplHtml = $navContainerHtml = "";
//        foreach ($templateItems as &$item)
//        {
//            $navTpl = $this->template->getTplList(1, 5, 'code');
//            if (in_array($item->code, $navTpl)) {
//                // 如果是导航模板
//                $navContainerHtml .= $item->file;
//            }else {
//                $tplHtml .= $item->file;
//            }
//        }

//        $compact = compact('page', 'topic_id', 'tplHtml', 'navContainerHtml');

        if (is_app()) {
            $page = 'app_news';
        } elseif (is_mobile() || (request()->getHost() == env('MOBILE_DOMAIN'))) {
            $page = 'm_news';
        } else {
            $page = 'news';
        }

        $template = $this->templateItem->getTplItems($page); // app端模板数据

        list($tplHtml, $navContainerHtml) = $this->templateItem->getPageTplHtml($page); // 模板Html数据

        $cat_list = []; // 分类列表

        $compact = compact('page', 'tplHtml', 'navContainerHtml');

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

//        return view('news.home', $compact);
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
//        dd($list);
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

//        return view('news.list', $compact);
    }

    public function show(Request $request, $article_id)
    {

//        $article_info = $this->article->getById($article_id);
//
//        // 推荐文章
//        $recommend_list = $this->get_recommend_list($article_info->cat_id);
//
//        // 上一篇/下一篇
//        list($previous, $next) = $this->article->getFrontAfterArticle($article_id);
//        $seo_title = $article_info->title.' - '.sysconf('site_name');
//        $compact = compact('seo_title','article_info', 'recommend_list', 'previous', 'next');



        $articleCatFields = $this->articleCat->getAppArticleCatFields();
        $articleFields = $this->article->getAppArticleFields();

        $article = $this->article->getById($article_id, $articleFields)->toArray();

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

//        $this->show_seo('seo_article_info',['name'=>$article_info['title']]); // SEO
        $seo_title = $article['title'].' - '.sysconf('site_name');
        $this->show_seo('seo_news',['name'=>$seo_title]); // SEO

        $compact = compact('article','hide_header','crumbs','cat','recommend','article_pre','article_next', 'seo_title');
        $webData = []; // web端（pc、mobile）数据对象
        $data = [
            'app_prefix_data' => [
                'article' => $article,
                'hide_header' => true,
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
//        $this->show_seo('seo_news'); // SEO

//        return view('news.show', $compact);
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