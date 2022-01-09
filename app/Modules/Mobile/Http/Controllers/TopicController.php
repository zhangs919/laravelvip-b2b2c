<?php

namespace App\Modules\Mobile\Http\Controllers;

use App\Modules\Base\Http\Controllers\Mobile;
use App\Repositories\NavBannerRepository;
use App\Repositories\NavigationRepository;
use App\Repositories\NavQuickServiceRepository;
use App\Repositories\TemplateCatRepository;
use App\Repositories\TemplateItemRepository;
use App\Repositories\TemplateRepository;
use App\Repositories\TemplateSelectorRepository;
use App\Repositories\TopicRepository;
use Illuminate\Http\Request;

class TopicController extends Mobile
{

    protected $template;
    protected $selector;
    protected $templateItem;
    protected $templateCat;
    protected $navBanner;
    protected $navigation;
    protected $navQuickService;
    protected $topic;

    public function __construct(TemplateRepository $template,
                                TemplateSelectorRepository $selector,
                                TemplateItemRepository $templateItem,
                                TemplateCatRepository $templateCatRepository,
                                NavBannerRepository $navBannerRepository,
                                NavigationRepository $navigationRepository,
                                NavQuickServiceRepository $navQuickServiceRepository,
                                TopicRepository $topicRepository)
    {
        parent::__construct();

        $this->template = $template;
        $this->selector = $selector;
        $this->templateItem = $templateItem;
        $this->templateCat = $templateCatRepository;
        $this->navBanner = $navBannerRepository;
        $this->navigation = $navigationRepository;
        $this->navQuickService = $navQuickServiceRepository;
        $this->topic = $topicRepository;
    }

    public function show(Request $request, $topic_id)
    {
        $seo_title = '乐融沃B2B2C商城演示站';
        $page = 'm_topic';


        // 获取首页焦点图
//        $navBannerCondition = [
//            'where' => [
//                ['nav_page', $page],
//                ['is_show', 1],
//            ],
//            'limit' => 5, // 只取5个
//            'sortname' => 'banner_sort',
//            'sortorder' => 'asc'
//        ];
//        list($nav_banner, $total) = $this->navBanner->getList($navBannerCondition);



        // 从 template_item 表中获取模板数据
        $where[] = ['page', $page];
        $where[] = ['topic_id', $topic_id];
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
            $navTpl = $this->template->getTplList(2, 5, 'code');
            if (in_array($item->code, $navTpl)) {
                // 如果是导航模板
                $navContainerHtml .= $item->file;
            }else {
                $tplHtml .= $item->file;
            }
        }

        // 专题信息
        $topic_info = $this->topic->getById($topic_id);
        // 专题页面背景设置 样式
        $bgStyle = '';
        if (!empty($topic_info->m_bg_color) && empty($topic_info->m_bg_image)) {
            $bgStyle = 'style="background-color:'.$topic_info->m_bg_color.'"';
        } elseif (!empty($topic_info->bg_image)) {
            $bgStyle = 'style="background:'.$topic_info->m_bg_color.' url('.get_image_url($topic_info->m_bg_image).') repeat-y center top;background-size: 100% auto;"';
        }

        $compact = compact('seo_title', 'page', 'topic_id', 'tplHtml', 'navContainerHtml', 'topic_info', 'bgStyle');

        return view('topic.show', $compact);
    }

}