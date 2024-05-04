<?php

namespace App\Modules\Frontend\Http\Controllers;

use App\Modules\Base\Http\Controllers\Frontend;
use App\Repositories\CollectRepository;
use App\Repositories\NavBannerRepository;
use App\Repositories\NavigationRepository;
use App\Repositories\NavQuickServiceRepository;
use App\Repositories\ShopCategoryRepository;
use App\Repositories\ShopRepository;
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
    protected $shop;
    protected $collect;
    protected $shopCategory;

    public function __construct(
        TemplateRepository $template
        ,TemplateSelectorRepository $selector
        ,TemplateItemRepository $templateItem
        ,TemplateCatRepository $templateCatRepository
        ,NavBannerRepository $navBannerRepository
        ,NavigationRepository $navigationRepository
        ,NavQuickServiceRepository $navQuickServiceRepository
        ,TopicRepository $topicRepository
        ,ShopRepository $shop
        ,CollectRepository $collect
        ,ShopCategoryRepository $shopCategory
    )
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
        $this->shop = $shop;
        $this->collect = $collect;
        $this->shopCategory = $shopCategory;
    }

    public function show(Request $request, $topic_id, $tpl_name = '')
    {
        if (is_app()) {
            $page = 'app_topic';
        } elseif (is_mobile() || (request()->getHost() == config('lrw.mobile_domain'))) {
            $page = 'm_topic';
        } else {
            $page = 'topic';
        }

        // 获取数据
        // 专题信息
        $topic_info = $this->topic->getById($topic_id);
        $topic = $topic_info->toArray();
        $title = $seo_title = $topic['topic_name'];
        $is_index = false;

        // 专题页面背景设置 样式
        $bgStyle = '';
        if (!empty($topic['bg_color']) && empty($topic['bg_image'])) {
            $bgStyle = 'style="background-color:'.$topic['bg_color'].'"';
        } elseif (!empty($topic['bg_image'])) {
            $bgStyle = 'style="background:'.$topic['bg_color'].' url('.get_image_url($topic['bg_image']).') repeat-y center top"';
        }

        if ($topic['shop_id'] > 0) {
            // 店铺专题
            // 店铺信息
            $shop_id = $topic['shop_id'];
            $shop_info = $this->shop->shopInfo($shop_id);
            $shop_info['shop']['qrcode'] = $this->shop->getShopQrCode($shop_id);
            $region_name = get_region_names_by_region_code($shop_info['shop']['region_code'], ' ');

            // 开店时长
            $duration_time = calc_shop_duration($shop_info['shop']['open_time'],$shop_info['shop']['end_time']);

            // 是否收藏店铺
            $is_collect = false;
            if ($this->collect->checkIsCollected($this->user_id, 1, $shop_id)) {
                // 已收藏
                $is_collect = true;
            }

            $collect_count = $shop_info['shop']['collect_num'];

            // 获取店铺导航
            $navigation_limit = 13; // 数据数量
            $shop_navigation = $this->template->getShopNavigationData($shop_id, $navigation_limit);

            // 店铺内分类
            $where = [];
            $where[] = ['shop_id', $shop_id];
            $condition = [
                'where' => $where,
                'sortname' => 'cat_sort',
                'sortorder' => 'asc',
            ];
            list($shop_category_list, $total) = $this->shopCategory->getList($condition, '', true);

            // 判断首页静态页面开启状态
            $webStatic = 1; //(is_mobile() && !is_app()) ? shopconf('m_shop_web_static',false,$shop_id) : shopconf('shop_web_static',false,$shop_id);
            $show_temp = 'topic.shop_show';

        } else {
            // 平台专题
            $shop_id = 0;
            $shop_info = [];
            $region_name = null;
            $duration_time = null;
            $is_collect = null;
            $collect_count = null;
            $shop_navigation = null;
            $shop_category_list = null;

            // 判断首页静态页面开启状态
            $webStatic = 1; //(is_mobile() && !is_app()) ? shopconf('m_shop_web_static',false,$shop_id) : shopconf('shop_web_static',false,$shop_id);
            $show_temp = 'topic.show';
        }
        if ($tpl_name) {
            $show_temp = "topic.{$tpl_name}";
        }
        $template = $this->templateItem->getTplItems($page, $shop_id, $topic_id); // app端模板数据
        list($tplHtml, $navContainerHtml) = $this->templateItem->getPageTplHtml($page, $shop_id, $topic_id); // 模板Html数据

        $compact = compact('seo_title','page', 'topic_id','template', 'tplHtml', 'navContainerHtml',
            'topic','bgStyle','shop_info','webStatic',
            'region_name','duration_time','is_collect','collect_count',
            'shop_navigation','shop_category_list');

//        $this->show_seo('seo_topic',['name'=>$topic['topic_name']]);

        $webData = []; // web端（pc、mobile）数据对象
        $data = [
            'app_prefix_data' => [
                'title'=>$title,
                'is_index'=>$is_index,
                'template' => $template,
                'page' => $page,
                'is_design' => false,
                'topic'=>$topic,
                'site_nav'=>null,
            ],
            'app_suffix_data' => [],
            'web_data' => $webData,
            'compact_data' => $compact,
            'tpl_view' => $show_temp
        ];
        $this->setData($data); // 设置数据
        return $this->displayData(); // 模板渲染及APP客户端返回数据
    }

    /**
     * 装修预览
     *
     * @param Request $request
     * @return mixed
     */
    public function preview(Request $request)
    {
        $topic_id = $request->get('topic_id');

        return $this->show($request, $topic_id, 'preview');
    }

}