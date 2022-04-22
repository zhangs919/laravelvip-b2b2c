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
// | Date:2018-08-17
// | Description: 店铺控制器
// +----------------------------------------------------------------------

namespace App\Modules\Frontend\Http\Controllers;

use App\Models\Brand;
use App\Models\DefaultSearch;
use App\Models\Goods;
use App\Models\Shop;
use App\Models\TplBackup;
use App\Modules\Base\Http\Controllers\Frontend;
use App\Repositories\CollectRepository;
use App\Repositories\NavBannerRepository;
use App\Repositories\NavigationRepository;
use App\Repositories\NavQuickServiceRepository;
use App\Repositories\PaymentRepository;
use App\Repositories\ShopApplyRepository;
use App\Repositories\ShopCategoryRepository;
use App\Repositories\ShopClassRepository;
use App\Repositories\ShopRepository;
use App\Repositories\TemplateCatRepository;
use App\Repositories\TemplateItemRepository;
use App\Repositories\TemplateRepository;
use App\Repositories\TemplateSelectorRepository;
use App\Repositories\ToolsRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class ShopController extends Frontend
{

    protected $tools;

    protected $shop;

    protected $shopClass;

    protected $shopApply;

    protected $template;
    protected $selector;
    protected $templateItem;
    protected $templateCat;
    protected $navBanner;
    protected $navigation;
    protected $navQuickService;
    protected $shopCategory;

    protected $collect;
    protected $payment;

    public function __construct()
    {
        parent::__construct();

        $this->tools = new ToolsRepository();
        $this->shop = new ShopRepository();
        $this->shopClass = new ShopClassRepository();
        $this->shopApply = new ShopApplyRepository();

        $this->template = new  TemplateRepository();
        $this->selector = new TemplateSelectorRepository();
        $this->templateItem = new TemplateItemRepository();
        $this->templateCat = new TemplateCatRepository();
        $this->navBanner = new NavBannerRepository();
        $this->navigation = new NavigationRepository();
        $this->navQuickService = new NavQuickServiceRepository();
        $this->shopCategory = new ShopCategoryRepository();

        $this->collect = new CollectRepository();
        $this->payment = new PaymentRepository();

    }

    /**
     * 入驻申请首页
     *
     * @param Request $request
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function apply(Request $request)
    {
        $seo_title = '入驻申请-首页';

        // 获取数据

        /*
         * 入驻进度
         * 0未进行任何店铺入驻步骤
         * 1
         * 2
         * 3
         * 4 支付开店款项
         * 5 开店成功
         */
        $progress = $this->shop->checkShopApplyProcess($this->user_id); //


        // PC端数据
        // 入驻轮播图（pc端）
        $shop_apply_banner_img = explode('|', sysconf('shop_apply_banner_img'));
        $pc_shop_guest_list_asc = $this->article->getShopApplyArticles(23, 2, 'asc'); // 入驻指南顺序排列
        $pc_shop_guest_list_desc = $this->article->getShopApplyArticles(23, 4, 'desc'); // 入驻指南倒序排列

        // APP端数据
        $shop_guest_list_asc = $this->article->getShopApplyArticles(23, 5, 'asc'); // 入驻指南顺序排列
        $shop_guest_list_desc = $this->article->getShopApplyArticles(23, 5, 'desc'); // 入驻指南倒序排列
        $info_notice_list = $this->article->getShopApplyArticles(24, 5, 'asc',['article_id','title']); // 信息公告
        // 入驻背景图（wap端）
        $banner_img = [sysconf('m_shop_apply_banner_img')];

        $compact = compact('seo_title','shop_apply_banner_img','pc_shop_guest_list_asc','pc_shop_guest_list_desc','info_notice_list');
        $webData = []; // web端（pc、mobile）数据对象
        $data = [
            'app_prefix_data' => [
                'progress' => $progress,
                'shop_guest_list_asc' => $shop_guest_list_asc,
                'shop_guest_list_desc' => $shop_guest_list_desc,
                'info_notice_list' => $info_notice_list,
                'banner_img' => $banner_img,
            ],
            'app_suffix_data' => [],
            'web_data' => $webData,
            'compact_data' => $compact,
            'tpl_view' => 'shop.apply'
        ];
        $this->setData($data); // 设置数据
        return $this->displayData(); // 模板渲染及APP客户端返回数据

//        $compact = compact('seo_title');
//
//        return view('shop.apply', $compact);
    }

    public function agreement(Request $request)
    {

        if (auth()->guard('user')->guest()) {
            return redirect('/login.html');
        }
        $seo_title = '入驻申请-入驻协议';

        // 获取数据
        $seller_protocol = sysconf('seller_protocol'); // 店铺入驻协议

        $compact = compact('seo_title', 'seller_protocol');
        $webData = []; // web端（pc、mobile）数据对象
        $data = [
            'app_prefix_data' => [
                'seller_protocol' => $seller_protocol,
                'title' => $seo_title
            ],
            'app_suffix_data' => [],
            'web_data' => $webData,
            'compact_data' => $compact,
            'tpl_view' => 'shop.agreement'
        ];
        $this->setData($data); // 设置数据
        return $this->displayData(); // 模板渲染及APP客户端返回数据

//        $compact = compact('seo_title');
//
//        return view('shop.agreement', $compact);
    }

    /**
     * 入驻申请-手机认证
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function register(Request $request)
    {
        if (auth()->guard('user')->guest()) {
            return redirect('/login.html');
        }

        $seo_title = '入驻申请-手机认证';


        // 获取数据
        $user_info = !empty(auth('user')) ? auth('user')->user()->toArray() : null;

//        dd($user_info);
        $compact = compact('seo_title','user_info');
        $webData = []; // web端（pc、mobile）数据对象
        $data = [
            'app_prefix_data' => [
                'user_info' => $user_info,
                'title' => $seo_title
            ],
            'app_suffix_data' => [],
            'web_data' => $webData,
            'compact_data' => $compact,
            'tpl_view' => 'shop.register'
        ];
        $this->setData($data); // 设置数据
        return $this->displayData(); // 模板渲染及APP客户端返回数据

//        $compact = compact('seo_title');
//
//        return view('shop.register', $compact);
    }

    /**
     * 入驻申请-开店类型选择
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function agreementType1(Request $request)
    {
        if (auth()->guard('user')->guest()) {
            return redirect('/login.html');
        }

        $seo_title = '入驻申请-开店类型选择';
        // 店铺入驻 缓存信息
        $shop_cache = Cache::get('shop_apply_info_'.auth('user')->id());
        $is_supply = !isset($shop_cache['shop']['is_supply']) ? $shop_cache['shop']['is_supply'] : 0;
        $shop_type = !isset($shop_cache['shop']['shop_type']) ? $shop_cache['shop']['shop_type'] : 1;

        // 获取数据

        $compact = compact('seo_title', 'shop_cache');

        $webData = []; // web端（pc、mobile）数据对象
        $data = [
            'app_prefix_data' => [
                'is_supply' => $is_supply,
                'ongoing' => 1,
                'title' => $seo_title
            ],
            'app_suffix_data' => [],
            'web_data' => $webData,
            'compact_data' => $compact,
            'tpl_view' => 'shop.agreement_type1'
        ];
        $this->setData($data); // 设置数据
        return $this->displayData(); // 模板渲染及APP客户端返回数据

    }

    /**
     * 入驻申请-填写个人/企业信息
     *
     * @param Request $request
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function authInfo(Request $request)
    {
        if (auth()->guard('user')->guest()) {
            return redirect('/login.html');
        }

        $is_supply = $request->get('is_supply',0); // 是否入驻供货商 0零售商 1供货商
        $shop_type = $request->get('shop_type',1); // 开店类型 1个人店铺 2企业店铺
        $seo_title = '';


//        dd($request->post());
        // 将信息写入cache
        $cacheData = [
            'shop' => [
                'user_id' => auth('user')->id(),
                'is_supply' => (int)$is_supply,
                'shop_type' => (int)$shop_type
            ],
            'shop_field_value' => [

            ]
        ];
        Cache::put('shop_apply_info_'.auth('user')->id(), $cacheData, 30);



        if ($request->method() == 'POST') {
            $shopFieldValueInsert = $request->post();

            $shopInsert['user_id'] = auth('user')->id();
            $shopInsert['shop_type'] = $shop_type;
            $shopInsert['is_supply'] = $is_supply;

            $ret = $this->shop->addShop($shopInsert, $shopFieldValueInsert);
            if (!$ret) {
                flash('error', '店铺信息保存失败');
                return redirect($request->fullUrl());
//                return result(-1, '', '店铺信息保存失败');
            }
            return redirect('/shop/apply/shop-info.html');
        }

        // 获取数据
        $user_info = !empty(auth('user')) ? auth('user')->user()->toArray() : null;
        $idcard_demo_image = explode('|', sysconf('idcard_demo_image'));
        $company_demo_image = explode('|', sysconf('company_demo_image'));

        $app_prefix_data['user_info'] = $user_info;

        if ($shop_type == 2) {
            $seo_title = '入驻申请-填写个人信息';
            $model = [
                'real_name' => null,
                'card_no' => null,
                'special_aptitude' => null,
                'special_aptitude1' => null,
                'special_aptitude2' => null,
                'hand_card' => null,
                'card_side_a' => null,
                'card_side_b' => null,
                'address' => null,
            ];
            $app_prefix_data['model'] = $model;
            $app_prefix_data['idcard_demo_image'] = $idcard_demo_image;

        } elseif ($shop_type == 1) {
            $seo_title = '入驻申请-填写企业信息';
            $model = [
                'company_name' => null,
                'unified_social_credi' => null,
                'artificial_person' => null,
                'card_no' => null,
                'license' => null,
                'special_aptitude' => null,
                'special_aptitude1' => null,
                'special_aptitude2' => null,
                'card_type' => null,
                'card_side_a' => null,
                'card_side_b' => null,
            ];
            $app_prefix_data['model'] = $model;
            $app_prefix_data['idcard_demo_image'] = $idcard_demo_image;
            $app_prefix_data['company_demo_image'] = $company_demo_image;
        }
        $app_prefix_data['title'] = $seo_title;



        $pc_data = $app_prefix_data;
        $compact = compact('seo_title', 'is_supply', 'shop_type', 'pc_data');

        $webData = []; // web端（pc、mobile）数据对象
        $data = [
            'app_prefix_data' => $app_prefix_data,
            'app_suffix_data' => [],
            'web_data' => $webData,
            'compact_data' => $compact,
            'tpl_view' => 'shop.auth_info'.$shop_type
        ];
        $this->setData($data); // 设置数据
        return $this->displayData(); // 模板渲染及APP客户端返回数据
    }


    /**
     * 入驻申请-完善店铺信息
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function shopInfo(Request $request)
    {
        if (auth()->guard('user')->guest()) {
            return redirect('/login.html');
        }

        $seo_title = '入驻申请-完善店铺信息';

        // 获取店铺分类列表
        $where = [];
        $condition = [
            'where' => $where,
            'limit' => 0, // 不分页
            'sortname' => 'created_at',
            'sortorder' => 'desc'
        ];
        list($cat_list, $total) = $this->shopClass->getList($condition, '', false, true);
        $use_fee_value = unserialize(sysconf('use_fee_value'));

        if ($request->method() == 'POST') {
            $ShopApplyModel = $request->post('ShopApplyModel');
            $ShopApplyModel['cat_ids'] = implode(',', $request->post('cat_ids'));
            $ret = $this->shopApply->store($ShopApplyModel);
            if (!$ret) {
                return result(-1, '', '店铺信息保存失败');
            }
            return redirect('/shop/apply/result.html');
        }

        // 获取店铺信息
        $shop_info = $this->shop->getByField('user_id', $this->user_id);

        if (empty($shop_info)) {
            abort(200, '店铺申请信息不存在。');
        }

        $compact = compact('seo_title', 'cat_list', 'use_fee_value', 'shop_info');

        return view('shop.shop_info', $compact);
    }

    /**
     * 入驻申请-提示页
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function result(Request $request)
    {
        if (auth()->guard('user')->guest()) {
            return redirect('/login.html');
        }

        $seo_title = '入驻申请-提示页';
        $shop = $this->shop->getByField('user_id', auth('user')->user()->user_id);
        if (empty($shop)) {
            return redirect('/shop/apply/index.html');
        }
        // 获取数据
        /*
         * 开店进度
         * 0未申请开店
         * 1
         * 2开店申请已提交,等待平台审核通过
         * 3
         * 4平台审核通过,等待支付开店款项
         * 5开店成功
         */
        $progress = $this->shop->checkShopApplyProcess($this->user_id);
        $shop = $shop->toArray();
        $pay_list = $this->payment->getPaymentList();

        $compact = compact('seo_title','progress','shop','pay_list');
        $webData = []; // web端（pc、mobile）数据对象
        $data = [
            'app_prefix_data' => [
                'progress' => $progress,
                'shop' => $shop,
                'is_result' => true,
                'title' => $seo_title,
                'ad_image' => '',
                'ad_url' => '',
                'pay_list' => $pay_list
            ],
            'app_suffix_data' => [],
            'web_data' => $webData,
            'compact_data' => $compact,
            'tpl_view' => 'shop.result'
        ];
        $this->setData($data); // 设置数据
        return $this->displayData(); // 模板渲染及APP客户端返回数据
//        $compact = compact('seo_title');
//        return view('shop.result', $compact);
    }

    // 撤销开店申请
    public function cancel(Request $request)
    {
        // todo 删除开店申请信息和店铺认证信息

        return redirect('/shop/apply/index.html');
    }

    // 开店申请 付款
    public function pay(Request $request)
    {

    }




    /**
     * 店铺街
     *
     * @param Request $request
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Throwable
     */
    public function street(Request $request)
    {
        $output = $request->get('output', 0);

        // 附近店铺
        $lat = !empty($request->get('lat', 0)) ? $request->get('lat', 0) : 0; // 经度
        $lng = !empty($request->get('lng', 0)) ? $request->get('lng', 0) : 0; // 纬度

        // 筛选条件
        $cls_id = $request->get('cls_id', 0); // 店铺分类id
        $cls_id_arr = explode('_', $cls_id);
        $child_class_list = [];
        $query_parent_cls_id = 0;

        if (count($cls_id_arr) == 3) {
            // 有效cls_id参数
            if ($cls_id_arr[0] == 1) {
                // 一级分类
                $query_parent_cls_id = $cls_id_arr[1];
            } elseif ($cls_id_arr[0] == 2) {
                // 二级分类
                $query_parent_cls_id = $cls_id_arr[2];
            }

            // 获取店铺分类列表
            $where = [];
            $where[] = ['is_show', 1];
            $where[] = ['parent_id', $query_parent_cls_id];
            $condition = [
                'where' => $where,
                'limit' => 0, // 不分页
                'sortname' => 'cls_sort',
                'sortorder' => 'asc'
            ];

            list($child_class_list, $total) = $this->shopClass->getList($condition);
        }

        // 获取店铺分类列表
        $where = [];
        $where[] = ['is_show', 1];
        $where[] = ['parent_id', 0];
        $condition = [
            'where' => $where,
            'limit' => 0, // 不分页
            'sortname' => 'cls_sort',
            'sortorder' => 'asc'
        ];
        list($cat_list, $total) = $this->shopClass->getList($condition);

        $where = [];
        $where[] = ['shop_status',1];
        $where[] = ['show_in_street',1];

        $distance = $request->get('distance',''); // 距离 单位：km
        if (!empty($distance) && !empty($lat) && !empty($lng)) { // 距离、经纬度都不为空时 才通过距离查询附近店铺
            $distance = $distance * 1000; // 距离 单位：m
            $where[] = ['distance', '<', $distance]; // 当前距离与店铺距离小于 $distance 的距离
        }
        $condition = [
            'where' => $where,
            'sortname' => 'shop_sort',
            'sortorder' => 'asc',
            // 计算附近店铺 distance（当前位置经纬度与每个店铺的经纬度距离，单位：m）
            'field' => DB::raw("shop.*,(6378.138 * 2 * asin(sqrt(pow(sin((shop_lat * pi() / 180 - {$lat} * pi() / 180) / 2),2) + cos(shop_lat * pi() / 180) * cos({$lat} * pi() / 180) * pow(sin((shop_lng * pi() / 180 - {$lng} * pi() / 180) / 2),2))) * 1000) as distance")
        ];
        list($list, $total) = $this->shop->getList($condition);
        if (!$list->isEmpty()) {
            foreach ($list as $item) {
                $item->distance = $item->distance > 0 ? round($item->distance/1000,2) : 0;
            }
        }

        $pageHtml = frontend_pagination($total);
        $pageArr = frontend_pagination($total, true);
        $page_json = json_encode($pageArr);

        $compact = compact('page_json', 'pageHtml', 'list', 'cat_list', 'child_class_list', 'query_parent_cls_id', 'cls_id', 'cls_id_arr', 'distance');

        if ($request->ajax()) {
            if ($output) {
                $tpl = 'street_output';
            } else {
                $tpl = 'street_shop_list';
            }
            $render = view('shop.partials.'.$tpl,$compact)->render();
            return result(0, $render);
        }

        $this->show_seo('seo_shop_street'); // SEO

        return view('shop.street', $compact);
    }

    public function openList(Request $request)
    {
        $ids = $request->get('ids');

        $data = [];
        foreach ($ids as $id) {
            $data[] = [
                'is_opening' => true, // todo 获取 店铺开店时间状态
                'shop_id' => $id
            ];
        }

        return result(0, $data);
    }

    /**
     * 店铺主页
     *
     * @param Request $request
     * @param int $shop_id 店铺id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function shopHome(Request $request, $shop_id)
    {

        $cat_id = $request->get('cat_id', 0);


        if (is_app()) {
            $page = 'app';
        } elseif (is_mobile() || (request()->getHost() == env('MOBILE_DOMAIN'))) {
            $page = 'm_shop';
        } else {
            $page = 'shop';
        }

        $navigation_limit = 13; // 数据数量
//        $shop_info = $this->shop->getById($shop_id);

        // 店铺信息
        $shop_info = $this->shop->shopInfo($shop_id);

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

        $template = $this->templateItem->getTplItems($page, $shop_id); // app端模板数据

        list($tplHtml, $navContainerHtml) = $this->templateItem->getPageTplHtml($page, $shop_id); // 模板Html数据

        // 判断首页静态页面开启状态
        $webStatic = (is_mobile() && !is_app()) ? shopconf('m_shop_web_static',false,$shop_id) : shopconf('shop_web_static',false,$shop_id);

        // 默认搜索词
        $default_keywords = [];
        $default_search = DefaultSearch::where('is_show', 1)->orderBy('sort', 'asc')->get();
        $cat_id = 0;
        if (!empty($default_search)) {
            foreach ($default_search as $v) {
                if ($v->search_type == 1 && $cat_id) {
                    $url = "/search.html?keyword=".$v->search_keywords;
                }
                if ($v->search_type == 1) {
                    if ($cat_id) {
                        $url = "/search.html?keyword=".$v->search_keywords;
                    }else {
                        continue;
                    }
                } else {
                    $url = "/search.html?keyword=".$v->search_keywords;
                }

                $default_keywords[] = [
                    'keyword' => $v->search_keywords,
                    'url' => $url,
                ];
            }
        }

        // 自由购功能是否开启
        $freebuy_enable = true; // 0-关闭 1-开启

        // 分享
        $share = $this->show_seo('seo_shop',['name'=>$shop_info['shop']['shop_name']]); // SEO

        $share = [
            'seo_shop_title' => $share['title'],
            'seo_shop_keywords' => $share['keywords'],
            'seo_shop_discription' => $share['discription'],
            'seo_shop_image' => $share['image'],
        ];

        // 判断是否是外卖风格 rule_url
        $is_takeout_mode = TplBackup::where([['back_id',$shop_info['shop']['back_id']], ['is_sys', 1], ['is_theme', 1]])->count();

        $compact = compact('cat_id', 'page', 'tplHtml', 'navContainerHtml', 'webStatic', 'shop_info','region_name','duration_time','is_collect','collect_count',
            'shop_navigation', 'shop_category_list', 'default_keywords', 'freebuy_enable', 'share', 'is_takeout_mode');

        if ($is_takeout_mode) { // 外卖模式
            $rule_url = 'theme/takeout/'.$shop_id;

            if (is_mobile() && !is_app()) {
                return redirect($rule_url);
            }

            $app_prefix_data = [
                'rule_url' => $rule_url,
                'freebuy_enable' => $freebuy_enable,
                'share' => $share
            ];
        } else {
            $app_prefix_data = [
                'shop_id' => $shop_id,
                'shop_info' => $shop_info,// 店铺信息对象
                'region_name' => $region_name,
                'duration_time' => $duration_time, //'1年 4个月 8天',
                'is_collect' => $is_collect,
                'collect_count' => $collect_count,
                'goods_count' => 2,
                'bonus_count' => '0',
                'is_opening' =>  true,
                'data_template' => $template,
                'position' => 'index',
                'shop_header_style' => '0',
                'category' => [
                    [
                        'cat_id' => 0,
                        'cat_name' => '全部商品'
                    ]
                ],
                'freebuy_enable' => $freebuy_enable,
                'share' => $share
            ];
        }

        $webData = []; // web端（pc、mobile）数据对象
        $data = [
            'app_prefix_data' => $app_prefix_data,
            'app_suffix_data' => [],
            'web_data' => $webData,
            'compact_data' => $compact,
            'tpl_view' => 'shop.shop_home'
        ];

        $this->setData($data); // 设置数据
        return $this->displayData(); // 模板渲染及APP客户端返回数据
//        return view('shop.shop_home', $compact);
    }

    /**
     * 店铺详情
     *
     * @param Request $request
     * @param $shop_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function shopDetail(Request $request, $shop_id=0)
    {
        if (!empty($request->get('shop_id',0))) {
            $shop_id = $request->get('shop_id',0);
        }

        // 获取数据
        // 店铺信息
        $shop_info = $this->shop->shopInfo($shop_id);

        $region_name = get_region_names_by_region_code($shop_info['shop']['region_code'], ' ');

        // 开店时长
        $duration_time = calc_shop_duration($shop_info['shop']['open_time'],$shop_info['shop']['end_time']);

        // 是否收藏店铺
        $is_collect = false;
        if ($this->collect->checkIsCollected($this->user_id, 1, $shop_id)) {
            // 已收藏
            $is_collect = true;
        }
        $shop_info['shop']['is_collect'] = $is_collect;
        $collect_count = $shop_info['shop']['collect_num'];

        // ajax 请求 店铺首页 获取店铺信息json数据

        $data = [
            'bonus_count' => '0',
            'collect_count' => $collect_count,
            'customer_types' => [], // todo 客服列表
            'duration_time' => $duration_time,
            'goods_count' => 0,
            'im_enable' => '',
            'is_collect' => $is_collect,
            'is_opening' => true, // todo 如何判断
            'position' => 'info',
            'region_name' => $region_name,
            'shop_id' => $shop_id,
            'shop_info' => $shop_info,
            'show_collect_count' => sysconf('shop_show_collect'), // 是否显示店铺收藏人气
            'yikf_url' => 'http://'.env('KF_DOMAIN').'/index/index/home?business_id=eb5bf6642a5afe7621241a51842b901c&groupid=0&shop_id=1&goods_id=0&visiter_id=26_15164&visiter_name=SZY186SJAC5369&avatar=http://68yun.oss-cn-beijing.aliyuncs.com/images/15164/user/26/images/2018/08/17/15344845108283.jpeg&domain='
//                .route('mobile_home')
                .'http://'.env('MOBILE_DOMAIN')
                .'&product=&goods_type=0'
        ];

        if ($request->ajax()) { // 微商城 异步加载
            return result(0, $data);
        }

        $compact = compact('shop_info', 'region_name');
        $webData = []; // web端（pc、mobile）数据对象
        $data = [
            'app_prefix_data' => [
//                'shop_info' => $shop_info
            ],
            'app_suffix_data' => [],
            'web_data' => $webData,
            'compact_data' => $compact,
            'tpl_view' => 'shop.shop_detail'
        ];
        $this->setData($data); // 设置数据
        return $this->displayData(); // 模板渲染及APP客户端返回数据


    }


//    public function info_back(Request $request, $shop_id)
//    {
//        // 店铺信息
//        $shop_info = $this->shop->shopInfo($shop_id);
//
//        $this->show_seo('seo_shop',['name'=>$shop_info['shop']['shop_name']]); // SEO
//        return view('shop.info');
//    }

    /**
     * 店铺商品
     *
     * @param Request $request
     * @param $filter_str
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function shopGoodsList(Request $request, $filter_str)
    {
        // 获取数据
        $params = $request->all();
        extract($params);

        $navigation_limit = 13;

        $filter_arr = explode('-', $filter_str);
        $shop_id = $filter_arr[0];

        // 获取店铺导航
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



        // 店铺信息
        $shop_info = $this->shop->shopInfo($shop_id);

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


        // 商品列表
        $curPage = isset($page['cur_page']) ? $page['cur_page'] : 1;
        $pageSize = isset($page['page_size']) ? $page['page_size'] : 12;
        $cat_id = isset($cat_id) ? $cat_id : 0;
        $sort = isset($sort) ? $sort : 1;
        $order = isset($order) ? $order : 'DESC';
        $keyword = isset($keyword) ? $keyword : '';

        /*
        * 筛选条件
        *
        */
        $where = [];
        $where[] = ['goods_status',1]; // 商品状态 已发布
        $where[] = ['goods_audit',1]; // 审核通过
        $field = ['goods_id','goods_name','cat_id','shop_id','sku_id','sku_open','goods_price','market_price','mobile_price','give_integral','goods_number','warn_number','goods_image','brand_id','click_count','sale_num','comment_num','collect_num','is_best','is_new','is_hot','is_promote','freight_id','sales_model','goods_sort','last_time',
//            'shop_name','shop_type','is_supply','show_price','show_content','button_content', 'is_free', 'brand_name','button_url'
            'goods_freight_fee'
        ];
        $goods_total = Goods::where($where)
            ->select($field)->count();
        $list = Goods::where($where)
            ->select($field)
            ->forPage($curPage, $pageSize)
            ->orderBy(str_replace([0,1,2,3], ['goods_sort', 'sale_num', 'comment_num', 'goods_price'], $sort), $order)
            ->get()->toArray();
        if (!empty($list)) {
            foreach ($list as &$v) {
                $goods_shop_info = Shop::where('shop_id',$v['shop_id'])
                    ->select(['shop_name','shop_type','is_supply','show_price','show_content','button_content','button_url'])
                    ->first()->toArray();
                $brand_name = Brand::where('brand_id',$v['brand_id'])->value('brand_name');
                $isCollected = 0;
                if ($this->collect->checkIsCollected($this->user_id, 0, 0, $v['goods_id'])) {
                    // 已收藏
                    $isCollected = 1;
                }
                $v = array_merge($v,$goods_shop_info);
                $v['is_free'] = $v['goods_freight_fee'] > 0 ? 0 : 1;
                $v['brand_name'] = $brand_name;
                $v['act_type'] = null;
                $v['default_spec_id'] = null;
                $v['goods_gift'] = 0;
                $v['price_show'] = ['code'=>1];
                $v['goods_price_format'] = '￥'.$v['goods_price'];
                $v['market_price_format'] = '￥'.$v['market_price'];
                $v['buy_enable'] = [ // 判断是否登录
                    'code' => 1,
                    'button_content' => '请登录'
                ];
                $v['is_collected'] = $isCollected; // 判断是否收藏商品
                $v['cart_num'] = 0; // 该商品购物车数量
            }
        }
        $pageHtml = frontend_pagination($goods_total);
        $page_array = frontend_pagination($goods_total,true);
        $page_json = json_encode($page_array);
        $filter = [];
//        $params = [];
//        $keyword = null;
        $category = [];
//        dd($goods_total);

        $compact = compact('shop_info', 'shop_navigation', 'shop_category_list', 'pageHtml', 'goods_total',
            'duration_time','region_name', 'list', 'page_json', 'keyword');

        if ($request->ajax()) {
            $render = view('shop.partials._shop_goods', $compact)->render();
            return result(0, $render);
        }
//        dd($shop_info);
        $webData = []; // web端（pc、mobile）数据对象
        $data = [
            'app_prefix_data' => [
                'shop_id' => $shop_id,
                'shop_info' => $shop_info,
                'region_name' => $region_name,
                'duration_time' => $duration_time,
                'is_collect' => $is_collect,
                'collect_count' => $collect_count,
                'goods_count' => 0,
                'bonus_count' => '0',
                'start_price_format' => '￥'.$shop_info['shop']['start_price'],
                'position' => 'list',
                'price_show' => [
                    'code' => 1 // todo
                ],
                'list' => $list,
                'page' => $page_array,
                'filter' => $filter,
                'params' => $params,
                'keyword' => $keyword,
                'category' => $category,
                'parent_id' => null,
                'cat_id' => '0',
                'cart_count' => 0,
                'select_goods_amount' => 0,
                'select_goods_amount_format' => '￥0',
                'dif_price' => 100,
                'dif_price_format' => '￥100',
                'select_goods_number' => 0,
                'scroll' => 1,
                'goods_list_show_mode' => '0',
                'show_sale_number' => '1',
            ],
            'app_suffix_data' => [],
            'web_data' => $webData,
            'compact_data' => $compact,
            'tpl_view' => 'shop.shop_goods'
        ];
        $this->setData($data); // 设置数据
        return $this->displayData(); // 模板渲染及APP客户端返回数据
    }

    /**
     * 名称验证是否重复
     *
     * @param Request $request
     * @return mixed
     */
    public function clientValidate(Request $request)
    {
        $result = $this->shop->clientValidate($request, 'ShopApplyModel');
        if (!$result['code']) {
            return result(-1, '', $result['message']);
        }
        return result(0);
    }

    /**
     * 工商资质 查询
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function license(Request $request)
    {
        $id = $request->get('id');

        return view('shop.license');
    }

    /**
     * 异步加载店铺内分类
     *
     * @param Request $request
     * @return array
     * @throws \Throwable
     */
    public function shopCatList(Request $request)
    {
        $shop_id = $request->get('shop_id');
        $cat_id = $request->get('cat_id','');

        // 获取数据
        $list = $this->shopCategory->getFormatShopCategory($shop_id);

        $compact = compact('shop_id','cat_id','list');

        if ($request->ajax()) { // 微信端 异步加载
            $render = view('shop.shop_cat_list', $compact)->render();
            return result(0, $render);
        }

        $compact = compact('');
        $webData = []; // web端（pc、mobile）数据对象
        $data = [
            'app_prefix_data' => [
                'page_output' => false,
                'cat_list' => $list,
                'cat_id' => $cat_id,
                'parent_id' => null
            ],
            'app_suffix_data' => [],
            'web_data' => $webData,
            'compact_data' => $compact,
            'tpl_view' => 'goods.goods_list'
        ];
        $this->setData($data); // 设置数据
        return $this->displayData(); // 模板渲染及APP客户端返回数据
    }

    public function mobileShopInfo(Request $request)
    {

    }

    /**
     * 生成二维码
     * @param Request $request
     * @return mixed
     */
    public function qrCode(Request $request)
    {
        $shop_id = $request->get('id',0);
        $shop_info = $this->shop->getById($shop_id);

        // todo 如何获取手机端商品详情url
        if (!is_mobile()) {
            $url = route('pc_shop_home', ['shop_id'=>$shop_id]);
        } else {
            $url = route('mobile_shop_home', ['shop_id'=>$shop_id]);
        }

        $qrCode = QrCode::errorCorrection('L')
            ->format('png')
            ->size(148)
//            ->merge('/public/qrcodes/water.png',.15) // 合并水印图片到二维码
//            ->merge(get_image_url($shop_info->shop_image),.15) // 合并水印图片到二维码
            ->margin(2)
//            ->color(255,0,255)
//            ->backgroundColor(125,245,0)
            ->encoding('UTF-8')
            ->generate($url);
        return response()->make($qrCode, 200, ['Content-Type' => 'image/png']);
    }
}