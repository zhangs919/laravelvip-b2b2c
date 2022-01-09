<?php

namespace App\Modules\Frontend\Http\Controllers;

use App\Modules\Base\Http\Controllers\Frontend;
use App\Repositories\NavBannerRepository;
use App\Repositories\NavigationRepository;
use App\Repositories\NavQuickServiceRepository;
use App\Repositories\TemplateCatRepository;
use App\Repositories\TemplateItemRepository;
use App\Repositories\TemplateRepository;
use App\Repositories\TemplateSelectorRepository;
use App\Repositories\TopicRepository;
use Illuminate\Http\Request;

class TopicController extends Frontend
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
        $page = 'topic';


        // 获取首页焦点图
        $navBannerCondition = [
            'where' => [
                ['nav_page', $page],
                ['is_show', 1],
            ],
            'limit' => 5, // 只取5个
            'sortname' => 'banner_sort',
            'sortorder' => 'asc'
        ];
        list($nav_banner, $total) = $this->navBanner->getList($navBannerCondition);

        $client = 'pc';
        $template = $this->templateItem->getTplItems($page, 0, $topic_id); // app端模板数据
        $data = [
            'title' => '',
            'is_index' => false,
            'template' => $template,
            'page' => 'app_topic',
            'is_design' => false,
            'topic' => [], // 专题信息
            'site_nav' => null,

            'context' => [], // 公共数据 所有接口一样

        ];
        if ($client == 'app') {
            return result(0, $data);
        }

        list($tplHtml, $navContainerHtml) = $this->templateItem->getPageTplHtml($page, 0, $topic_id); // 模板Html数据

        // 专题信息
        $topic_info = $this->topic->getById($topic_id);
        // 专题页面背景设置 样式
        $bgStyle = '';
        if (!empty($topic_info->bg_color) && empty($topic_info->bg_image)) {
            $bgStyle = 'style="background-color:'.$topic_info->bg_color.'"';
        } elseif (!empty($topic_info->bg_image)) {
            $bgStyle = 'style="background:'.$topic_info->bg_color.' url('.get_image_url($topic_info->bg_image).') repeat-y center top"';
        }

        $compact = compact('seo_title', 'page', 'topic_id', 'tplHtml', 'navContainerHtml', 'nav_banner', 'topic_info', 'bgStyle');

        return view('topic.show', $compact);
    }

}