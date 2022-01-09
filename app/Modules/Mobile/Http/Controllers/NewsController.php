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

namespace App\Modules\Mobile\Http\Controllers;

use App\Modules\Base\Http\Controllers\Mobile;
use App\Repositories\ArticleCatRepository;
use App\Repositories\ArticleRepository;
use App\Repositories\TemplateItemRepository;
use App\Repositories\TemplateRepository;
use App\Repositories\TemplateSelectorRepository;
use Illuminate\Http\Request;

class NewsController extends Mobile
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
        $page = 'm_news';

        // 从 template_item 表中获取模板数据
        $where[] = ['page', $page];
        $condition = [
            // data,shop_id,page,sort,ext_info,tpl_title,is_valid,site_id,code,file //这些字段从模板表取 tpl_name,icon,type
            'field' => ['uid', 'data', 'shop_id', 'page', 'sort', 'ext_info', 'tpl_title', 'is_valid', 'site_id', 'code', 'file'],
            'where' => $where,
            'limit' => 0, // 查询全部
            'sortname' => 'sort',
            'sortorder' => 'asc'
        ];
        list($templateItems, $itemCount) = $this->templateItem->getList($condition);

        $tplHtml = $navContainerHtml = "";
        foreach ($templateItems as &$item)
        {
            $navTpl = $this->template->getTplList(1, 5, 'code');
            if (in_array($item->code, $navTpl)) {
                // 如果是导航模板
                $navContainerHtml .= $item->file;
            }else {
                $tplHtml .= $item->file;
            }
        }

        $compact = compact('page', 'topic_id', 'tplHtml', 'navContainerHtml');

        $this->show_seo('seo_news'); // SEO

        return view('news.home', $compact);
    }


    public function lists(Request $request, $cat_id)
    {


        // 分类列表
        $condition = [
            'where' => [
                ['is_show', 1],
                ['cat_model', 2], // 普通分类
                ['cat_type', 1],
            ],
            'sortname' => 'cat_sort',
            'sortorder' => 'asc',
        ];
        list($cat_list, $cat_total) = $this->articleCat->getList($condition, '', true);

        // 文章列表
        $cat_ids = get_article_cat_grandson(intval($cat_id));
        $where = [];
        $where[] = ['status',1];
        $condition = [
            'where' => [['status', 1]],
            'in' => ['field'=>'cat_id','condition' => $cat_ids]
        ];
        list($article_list, $article_total) = $this->article->getList($condition);
        $pageArr = frontend_pagination($article_total, true);
        $page_count = $pageArr['page_count'];
        $cur_page = $pageArr['cur_page'];
        $page_json = json_encode($pageArr);

        // 推荐文章
        $recommend_list = $this->get_recommend_list($cat_id);
        $compact = compact('cat_list', 'article_list', 'pageHtml', 'recommend_list', 'page_count', 'cur_page', 'page_json');

        $this->show_seo('seo_news'); // SEO

        return view('news.list', $compact);
    }

    public function show(Request $request, $article_id)
    {

        $article_info = $this->article->getById($article_id);

        // 推荐文章
        $recommend_list = $this->get_recommend_list($article_info->cat_id);

        // 上一篇/下一篇
        list($previous, $next) = $this->article->getFrontAfterArticle($article_id);
        $seo_title = $article_info->title.' - '.sysconf('site_name');
        $compact = compact('seo_title','article_info', 'recommend_list', 'previous', 'next');

        $this->show_seo('seo_goods',['name'=>$seo_title]); // SEO

        return view('news.show', $compact);
    }

    public function get_recommend_list($cat_id)
    {
        $cat_ids = get_article_cat_grandson(intval($cat_id));
        $where = [];
        $where[] = ['status',1];
        $condition = [
            'where' => [['status', 1],['is_recommend',1]],
            'in' => ['field'=>'cat_id','condition' => $cat_ids],
            'limit' => 5
        ];
        list($recommend_list, $recommend_total) = $this->article->getList($condition);
        return $recommend_list;
    }
}