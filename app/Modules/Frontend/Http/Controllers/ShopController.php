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
use App\Models\GoodsTag;
use App\Models\Shop;
use App\Models\ShopCategory;
use App\Models\ShopFieldValue;
use App\Models\TplBackup;
use App\Modules\Base\Http\Controllers\Frontend;
use App\Repositories\CollectRepository;
use App\Repositories\GoodsRepository;
use App\Repositories\NavigationRepository;
use App\Repositories\PaymentLogicRepository;
use App\Repositories\PaymentRepository;
use App\Repositories\ShopApplyRepository;
use App\Repositories\ShopCategoryRepository;
use App\Repositories\ShopClassRepository;
use App\Repositories\ShopCreditRepository;
use App\Repositories\ShopPaymentRepository;
use App\Repositories\ShopRepository;
use App\Repositories\TemplateCatRepository;
use App\Repositories\TemplateItemRepository;
use App\Repositories\TemplateRepository;
use App\Repositories\TemplateSelectorRepository;
use App\Repositories\ToolsRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class ShopController extends Frontend
{

    protected $tools;
    protected $shop;
    protected $shopClass;
    protected $template;
    protected $selector;
    protected $templateItem;
    protected $templateCat;
    protected $navigation;
    protected $shopCategory;
    protected $collect;
    protected $shopCredit;
	protected $goods;

    public function __construct(
        ToolsRepository $tools
        ,ShopRepository $shop
        ,ShopClassRepository $shopClass
        ,TemplateRepository $template
        ,TemplateSelectorRepository $selector
        ,TemplateItemRepository $templateItem
        ,TemplateCatRepository $templateCat
        ,NavigationRepository $navigation
        ,ShopCategoryRepository $shopCategory
        ,CollectRepository $collect
        ,ShopCreditRepository $shopCredit
		,GoodsRepository $goods
    )
    {
        parent::__construct();

        $this->tools = $tools;
        $this->shop = $shop;
        $this->shopClass = $shopClass;
        $this->template = $template;
        $this->selector = $selector;
        $this->templateItem = $templateItem;
        $this->templateCat = $templateCat;
        $this->navigation = $navigation;
        $this->shopCategory = $shopCategory;
        $this->collect = $collect;
        $this->shopCredit = $shopCredit;
        $this->goods = $goods;
    }


    /**
     * 店铺街/附近商家
     *
     * @param Request $request
     * @return array|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     * @throws \Throwable
     */
    public function shops(Request $request)
    {

        // 获取数据

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
        list($cls_list_1, $cls_list_1_total) = $this->shopClass->getList($condition);
        $cls_list_1 = $cls_list_1->toArray();

        // 获取店铺分类列表 树形格式化
        $where = [];
        $where[] = ['is_show', 1];
//        $where[] = ['parent_id', 0];
        $condition = [
            'where' => $where,
            'limit' => 0, // 不分页
            'sortname' => 'cls_sort',
            'sortorder' => 'asc'
        ];
        list($format_class_list, $format_class_total) = $this->shopClass->getList($condition, '',true);

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
			'with' => ['goods' => function($query) {
				$query->limit(12); // 取店铺12个商品
			}],
            'sortname' => 'shop_sort',
            'sortorder' => 'asc',
            // 计算附近店铺 distance（当前位置经纬度与每个店铺的经纬度距离，单位：m）
            'field' => DB::raw("shop.*,(6378.138 * 2 * asin(sqrt(pow(sin((shop_lat * pi() / 180 - {$lat} * pi() / 180) / 2),2) + cos(shop_lat * pi() / 180) * cos({$lat} * pi() / 180) * pow(sin((shop_lng * pi() / 180 - {$lng} * pi() / 180) / 2),2))) * 1000) as distance")
        ];
        list($shop_list, $total) = $this->shop->getList($condition);
        $list = [];
        if (!$shop_list->isEmpty()) {
            foreach ($shop_list as $item) {
                // 店铺信誉
                $credit = $this->shopCredit->getCreditInfoByScore($item->credit);

                $goods_list =[];
                if (!empty($item->goods)) {
                    foreach ($item->goods as $gk=>$goods) {
                        $goods_list[] = [
                            'goods_id' => $goods->goods_id,
                            'goods_name' => $goods->goods_name,
                            'goods_image' => $goods->goods_image,
                            'goods_price' => $goods->goods_price,
                        ];
                    }
                }
                $list[] = [
                    'shop_id' => $item->shop_id,
                    'user_id' => $item->user_id,
                    'shop_name' => $item->shop_name,
                    'shop_image' => get_image_url($item->shop_image, 'shop_image'),
                    'shop_logo' => get_image_url($item->shop_logo, 'shop_logo'),
                    'shop_poster' => $item->shop_poster,
                    'opening_hour' => $item->opening_hour,
                    'credit' => $item->credit,
                    'simply_introduce' => $item->simply_introduce,
                    'shop_description' => $item->shop_description,
                    'sale_num' => 0, // 店铺销量
                    'credit_name' => $credit['credit_name'],
                    'credit_img' => $credit['credit_img'],
                    'address' => $item->address,
                    'region_code' => $item->region_code,
                    'shop_lng' => $item->shop_lng,
                    'shop_lat' => $item->shop_lat,
                    'start_price' => $item->start_price,
                    'detail_introduce' => $item->detail_introduce,
                    'score' => "5.00", // 需计算
                    'recommend_num' => 0,
                    'recommend_sort' => 0,
                    'distance' => $item->distance > 0 ? round($item->distance/1000,2) : 0,
                    'is_opening' => true,
                    'start_price_format' => '￥'.$item->start_price,
                    'goods_list' => $goods_list,
                ];
            }
        }

        $pageHtml = frontend_pagination($total);
        $pageArr = frontend_pagination($total, true);
        $page_json = json_encode($pageArr);

        $compact = compact('page_json', 'pageHtml', 'list', 'cls_list_1', 'format_class_list', 'child_class_list', 'query_parent_cls_id', 'cls_id', 'cls_id_arr', 'distance');

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

        $webData = []; // web端（pc、mobile）数据对象
        $data = [
            'app_prefix_data' => [
                'page' => $pageArr,
                'list' => $list,
                'sort' => 'default',
                'name' => '',
                'cls_level' => '',
                'cls_id' =>null,
                'parent_id' =>null,
                'cls_id_old' =>'',
                'cls_list_1' => $cls_list_1,
                'region_list' => [],
                'default_shop_logo' => sysconf('default_shop_logo'),
                'sites' => null,
                'site_id' => null,
            ],
            'app_suffix_data' => [],
            'web_data' => $webData,
            'compact_data' => $compact,
            'tpl_view' => 'shop.shops'
        ];
        $this->setData($data); // 设置数据
        return $this->displayData(); // 模板渲染及APP客户端返回数据
    }

    public function refDistance()
    {
		$data = [];
        return result(0, $data);
    }

    public function openList(Request $request)
    {
        $ids = $request->get('ids');

        $data = [];
        $shopList = Shop::whereIn('shop_id', $ids)->select(['shop_id','opening_hour','shop_status'])->get();
        foreach ($shopList as $item) {
            $item->opening_hour = unserialize($item->opening_hour);
            $item->opening_hour = $this->shop->getShopOpeningHour($item->opening_hour);
            $is_opening = $this->shop->shopIsOpening($item->opening_hour);
            $data[] = [
                'is_opening' => $is_opening,
                'shop_id' => $item['shop_id']
            ];
        }

        return result(0, $data);
    }

    /**
     * 店铺主页
     *
     * @param Request $request
     * @param int $shop_id 店铺id
     * @param string $tpl_name 页面模板名称
     * @return mixed
     */
    public function shopHome(Request $request,  $shop_id,  $tpl_name = 'shop_home')
    {
        if (is_app()) {
            $page = 'app_shop';
        } elseif (is_mobile() || (request()->getHost() == config('lrw.mobile_domain'))) {
            $page = 'm_shop';
            // 判断是否带有店铺编号 如果没 则跳转带上店铺编号 todo 此处还有bug 暂时注释掉
//            if (strlen(get_lrw_tag()) != 7) {
//                $shop_home = '/'.get_shop_code($shop_id).route('mobile_shop_home', ['shop_id' =>$shop_id], false);
//                return redirect($shop_home);
//            }
        } else {
            $page = 'shop';
        }

        $this->setLrwTag();

        $navigation_limit = 13; // 数据数量
        // 店铺信息
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

        $shop_header_style = shopconf('shop_header_style', false, $shop_id);

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
        $is_takeout_mode = TplBackup::where([['back_id',$shop_info['shop']['m_back_id']], ['is_sys', 1], ['is_theme', 1]])->count();

        $is_design = false;

        $compact = compact('cat_id', 'page', 'tplHtml', 'navContainerHtml', 'template', 'webStatic', 'shop_info','region_name','duration_time','is_collect','collect_count',
            'shop_navigation', 'shop_category_list', 'default_keywords', 'freebuy_enable', 'share', 'is_takeout_mode','is_design');

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
                'shop_header_style' => $shop_header_style,
                'category' => $shop_category_list/*[
                    [
                        'cat_id' => 0,
                        'cat_name' => '全部商品'
                    ]
                ]*/,
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
            'tpl_view' => 'shop.'.$tpl_name
        ];

        $this->setData($data); // 设置数据
        return $this->displayData(); // 模板渲染及APP客户端返回数据
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
        $this->setLrwTag();

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
        $goods_count = $this->shop->getShopGoodsCount($shop_id);
        // ajax 请求 店铺首页 获取店铺信息json数据

        $data = [
            'bonus_count' => '0',
            'collect_count' => $collect_count,
            'customer_types' => [], // todo 客服列表
            'duration_time' => $duration_time,
            'goods_count' => $goods_count,
            'im_enable' => '',
            'is_collect' => $is_collect,
            'is_opening' => $shop_info['shop']['is_opening'],
            'position' => 'info',
            'region_name' => $region_name,
            'shop_id' => $shop_id,
            'shop_info' => $shop_info,
            'show_collect_count' => sysconf('shop_show_collect'), // 是否显示店铺收藏人气
            'yikf_url' => 'http://'.config('lrw.kf_domain').'/index/index/home?business_id=xxxxxx&groupid=0&shop_id=1&goods_id=0&visiter_id=26_15164&visiter_name=SZY186SJAC5369&avatar=http://xxxxx.jpeg&domain='
//                .route('mobile_home')
                .'http://'.config('lrw.mobile_domain')
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

    /**
     * 经营者营业执照信息
     *
     * @param Request $request
     * @return array|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function license(Request $request)
    {
        $id = $request->get('id');

        $data = [
            'use_weixin_login' => 1,
            'wx_login_logo' => sysconf('wx_login_logo')
        ];

        if (is_app()) {
            return result(0, $data);
        }
		// 获取店铺信息
		$shop_info = $this->shop->getByField('shop_id', $id);

		if (empty($shop_info)) {
			abort(200, '店铺信息不存在。');
		}

        $site_name = sysconf('site_name');
		$show_data = false;
        if ($request->method() == 'POST') {
            // 提交查询
            $captchaModel = $request->post('CaptchaModel');
            $captcha = $captchaModel['captcha']; // 图形验证码
            // 验证图形验证码
			if (session('captcha') != $captcha) {
				return redirect($request->fullUrl())->with('error', '验证码不正确');
			}

            // 返回查询结果
			$shop_field_value = ShopFieldValue::where('shop_id', $id)->first();
			$show_data = true;

			return view('shop.license', compact('site_name','id', 'shop_info', 'shop_field_value', 'show_data'));

        }

        return view('shop.license', compact('site_name','id', 'shop_info', 'show_data'));
    }

    /**
     * 店铺商品
     *
     * @param Request $request
     * @param $filter_str
     * @return array|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     * @throws \Throwable
     */
    public function shopGoodsList(Request $request, $filter_str)
    {
        $filter_arr = explode('-', $filter_str);
        if (!empty($filter_arr) && count($filter_arr) > 1) {
			$params = [];
            $shop_id = $filter_arr[0];
			$params['cat_id'] = isset($filter_arr[1]) ? (int)$filter_arr[1] : 0; // 分类id
			$params['go'] = isset($filter_arr[2]) ? (int)$filter_arr[2] : 0; // 分页
			$params['is_free'] = isset($filter_arr[3]) ? (int)$filter_arr[3] : 0; //
			$params['is_stock'] = isset($filter_arr[5]) ? (int)$filter_arr[5] : 0; //
			$params['sort'] = isset($filter_arr[6]) ? (int)$filter_arr[6] : 0; //
			$params['order'] = isset($filter_arr[7]) ? (int)$filter_arr[7] : 4; //

			$params['order'] = str_replace([4, 3],['ASC', 'DESC'], $params['order']);

			if (isset($filter_arr[2])) {
                $cur_page = $filter_arr[2];
                $request->offsetSet('page', [
                    'cur_page' => intval($cur_page) ?: 1,
                    'page_size' => 12
                ]);
				$params['page'] = [
					'cur_page' => intval($cur_page) ?: 1,
					'page_size' => 12
				];
            }
        } else {
			$params = $request->all();
			$shop_id = $filter_str;
		}


        // 获取数据

		$params['shop_id'] = $shop_id;
		$params['uri_type'] = 1; // 链接类型：0 /shop/1/list.html?s=1&is_free=1&sort=5&order=DESC  1 /shop-list-7-0-0-0-0-0-2-3-0-0.html
        extract($params);

        $cat_id = isset($cat_id) ? $cat_id : 0;

        $navigation_limit = 13;



        // 获取店铺导航
        $shop_navigation = $this->template->getShopNavigationData($shop_id, $navigation_limit);

        // 店铺内分类(pc端)
        $where = [];
        $where[] = ['shop_id', $shop_id];
        $condition = [
            'where' => $where,
            'sortname' => 'cat_sort',
            'sortorder' => 'asc',
        ];
        list($shop_category_list, $total) = $this->shopCategory->getList($condition, '', true);

        // 店铺内二级分类(微信端)
        $shop_cat_info = ShopCategory::where([['shop_id', $shop_id], ['cat_id', $cat_id]])->first();
        $is_sub_cat = $shop_cat_info->parent_id??0;

        if (!$is_sub_cat) { // 一级分类
            $parent_id = $cat_id;
        } else {
            $parent_id = $is_sub_cat;
        }
        $category = $this->shopCategory->getFormatShopCategory($shop_id);
        $category = array_merge([['cat_id'=>0,'cat_name'=>'全部商品']], $category);
        $chr_list = [];
        if ($parent_id > 0) {
            // 查询指定分类
            $chr_list = $this->shopCategory->getFormatShopCategory($shop_id, $parent_id);
            $chr_list = array_merge([['cat_id'=>$parent_id,'cat_name'=>'全部']], $chr_list);
        }
        $cat_name = $shop_cat_info->cat_name ?? '全部';

        $tpl_name = 'shop.shop_goods';
        // 店铺商品列表页样式 0-默认样式 1-经典样式
        $m_shop_list_style = shopconf('m_shop_list_style', false, $shop_id);

        if (is_mobile() || (request()->getHost() == config('lrw.mobile_domain'))) {
            $tpl_name = 'shop.shop_goods_'.$m_shop_list_style;
        }

        // 店铺信息
        $shop_info = $this->shop->shopInfo($shop_id);
		$shop_info['shop']['qrcode'] = $this->shop->getShopQrCode($shop_id);

        $this->show_seo('seo_shop',['name'=>$shop_info['shop']['shop_name']]); // SEO

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

        $this->cart->setUserId($this->user_id);
        $this->cart->setUniqueId($this->session_id);
        $cart_list = $this->cart->getCartGoodsList(); // 购物车数据
        $cart_price_info = $this->cart->getCartPriceInfo($cart_list);
        $cart_goods = [];
        foreach ($cart_list as $item) {
            $cart_goods[$item['goods_id']] = $item;
        }

		/*
        * 筛选条件
        *
        */
		$where = [];
		$where[] = ['goods_status',1]; // 商品状态 已发布
		$where[] = ['goods_audit',1]; // 审核通过
		list($where, $whereBetween, $whereIn, $whereRaw) = $this->goods->splice_shop_goods_list_condition($params);
		$goodsQuery = new Goods();
		if (!empty($where)) {
			$goodsQuery = $goodsQuery->where($where);
		}
		if (!empty($whereRaw)) {
			$goodsQuery = $goodsQuery->whereRaw($whereRaw['field'], $whereRaw['condition']);
		}


		// 商品列表
        $curPage = isset($page['cur_page']) ? $page['cur_page'] : 1;
        $pageSize = isset($page['page_size']) ? $page['page_size'] : 12;
        $sort = isset($sort) ? $sort : 1;
        $order = isset($order) ? $order : 'DESC';
        $keyword = isset($keyword) ? $keyword : '';
		if (!empty($style)) {
			$style = str_replace([0,1],['grid','list'], $style);
		} else {
			$style = 'grid';
		}

		$field = ['goods_id','goods_name','cat_id','shop_id','sku_id','sku_open','goods_price','market_price','mobile_price','give_integral','goods_number','warn_number','goods_image','brand_id','click_count','sale_num','comment_num','collect_num','is_best','is_new','is_hot','is_promote','freight_id','sales_model','goods_sort','last_time','tag_id',
//            'shop_name','shop_type','is_supply','show_price','show_content','button_content', 'is_free', 'brand_name','button_url'
			'goods_freight_fee'
		];

		$total = $goodsQuery
			->select($field)->count();
		$list = $goodsQuery
			->select($field)
			->forPage($curPage, $pageSize)
			->orderBy(get_shop_goods_sort_array($sort), $order)
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
				// 商品标签
				$goods_tag = GoodsTag::where('tag_id',$v['tag_id'])
					->select(['tag_image','tag_position'])
					->first();
				$v['tag_image'] = $goods_tag->tag_image ?? '';
				$v['tag_position'] = $goods_tag->tag_position ?? null;
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
                $v['cart_num'] = isset($cart_goods[$v['goods_id']]) ? $cart_goods[$v['goods_id']]['goods_number'] : 0; // 该商品购物车数量
            }
        }
        $pageHtml = frontend_pagination($total);
        $page_array = frontend_pagination($total,true);
        $page_json = json_encode($page_array);
		$filter = $this->goods->shopGoodsFilterData($params, 0);
//		dd($filter);
        $app_prefix_data = [
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
            'cat_id' => '0',
            'parent_id' => null,
            'category' => $category,
            'chr_list' => $chr_list,
            'cat_name' => $cat_name,
            'cart_count' => $this->cart_goods_num,
            'm_search_mode' => 0,
            'order_type' => null,
            'sort_type' => null,
            'list' => $list,
            'page' => $page_array,
            'filter' => $filter,
            'params' => $params,
            'keyword' => $keyword,
            'select_goods_amount' => 0,
            'select_goods_number' => 0,
            'select_goods_amount_format' => '￥0',
            'dif_price' => 100,
            'dif_price_format' => '￥100',
            'm_shop_list_style' => $m_shop_list_style,
            'display'=>'list',
            'scroll' => 1,
            'goods_list_show_mode' => '1',
            'show_sale_number' => '1',
            'yikf_url' => '',
            'cross_border_identity' => '',
            'share_mode' => 0,
            'replace_order' => 0,
            'evaluate_show' => '1',
            'search_show' => 1,
        ];


        $webStatic = 0;

        $compact = compact('shop_info', 'shop_navigation', 'shop_category_list', 'category','chr_list', 'pageHtml', 'total',
            'duration_time','region_name', 'list', 'page_json','page_array', 'keyword','cat_id','parent_id','cat_name',
            'cart_price_info','filter',
            'webStatic'
        );

        if ($request->ajax()) {
            $render = view('shop.partials._shop_goods_'.$m_shop_list_style, $compact)->render();
            return result(0, $render);
        }
//        dd($shop_info);
        $webData = []; // web端（pc、mobile）数据对象
        $data = [
            'app_prefix_data' => $app_prefix_data,
            'app_suffix_data' => [],
            'web_data' => $webData,
            'compact_data' => $compact,
            'tpl_view' => $tpl_name // 根据店铺商品列表页样式 渲染不同的模板
        ];
        $this->setData($data); // 设置数据
        return $this->displayData(); // 模板渲染及APP客户端返回数据
    }

	/**
	 * 搜本店
	 *
	 * @param Request $request
	 */
	public function shopSearch(Request $request, $shop_id)
	{

		// 获取数据
		$params = $request->all();
		extract($params);
        $params['shop_id'] = $shop_id;

		$cat_id = isset($cat_id) ? $cat_id : 0;
//		$region_code = !empty($params['region']) ? str_replace('_', ',', $params['region']) : null;


		$navigation_limit = 13;
		// 获取店铺导航
		$shop_navigation = $this->template->getShopNavigationData($shop_id, $navigation_limit);

		// 店铺内分类(pc端)
		$where = [];
		$where[] = ['shop_id', $shop_id];
		$condition = [
			'where' => $where,
			'sortname' => 'cat_sort',
			'sortorder' => 'asc',
		];
		list($shop_category_list, $total) = $this->shopCategory->getList($condition, '', true);

		// 店铺内二级分类(微信端)
		$shop_cat_info = ShopCategory::where([['shop_id', $shop_id], ['cat_id', $cat_id]])->first();
		$is_sub_cat = $shop_cat_info->parent_id??0;

		if (!$is_sub_cat) { // 一级分类
			$parent_id = $cat_id;
		} else {
			$parent_id = $is_sub_cat;
		}
		$category = $this->shopCategory->getFormatShopCategory($shop_id);
		$category = array_merge([['cat_id'=>0,'cat_name'=>'全部商品']], $category);
		$chr_list = [];
		if ($parent_id > 0) {
			// 查询指定分类
			$chr_list = $this->shopCategory->getFormatShopCategory($shop_id, $parent_id);
			$chr_list = array_merge([['cat_id'=>$parent_id,'cat_name'=>'全部']], $chr_list);
		}
		$cat_name = $shop_cat_info->cat_name ?? '全部';

		$tpl_name = 'shop.shop_search';
		// 店铺商品列表页样式 0-默认样式 1-经典样式
		$m_shop_list_style = shopconf('m_shop_list_style', false, $shop_id);

		if (is_mobile() || (request()->getHost() == config('lrw.mobile_domain'))) {
			$tpl_name = 'shop.shop_goods_'.$m_shop_list_style;
		}

		// 店铺信息
		$shop_info = $this->shop->shopInfo($shop_id);
		$shop_info['shop']['qrcode'] = $this->shop->getShopQrCode($shop_id);

		$this->show_seo('seo_shop',['name'=>$shop_info['shop']['shop_name']]); // SEO

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

		$this->cart->setUserId($this->user_id);
		$this->cart->setUniqueId($this->session_id);
		$cart_list = $this->cart->getCartGoodsList(); // 购物车数据
		$cart_price_info = $this->cart->getCartPriceInfo($cart_list);
		$cart_goods = [];
		foreach ($cart_list as $item) {
			$cart_goods[$item['goods_id']] = $item;
		}

		/*
		* 筛选条件
		*
		*/
		$where = [];
		$where[] = ['goods_status',1]; // 商品状态 已发布
		$where[] = ['goods_audit',1]; // 审核通过
		list($where, $whereBetween, $whereIn, $whereRaw) = $this->goods->splice_shop_goods_list_condition($params);

		$goodsQuery = new Goods();
		if (!empty($where)) {
			$goodsQuery = $goodsQuery->where($where);
		}
		if (!empty($whereRaw)) {
			$goodsQuery = $goodsQuery->whereRaw($whereRaw['field'], $whereRaw['condition']);
		}

		// 商品列表
		$curPage = isset($page['cur_page']) ? $page['cur_page'] : 1;
		$pageSize = isset($page['page_size']) ? $page['page_size'] : 12;
		$sort = isset($sort) ? $sort : 1;
		$order = isset($order) ? $order : 'DESC';
		$keyword = isset($keyword) ? $keyword : '';
		if (!empty($style)) {
			$style = str_replace([0,1],['grid','list'], $style);
		} else {
			$style = 'grid';
		}

		$field = ['goods_id','goods_name','cat_id','shop_id','sku_id','sku_open','goods_price','market_price','mobile_price','give_integral','goods_number','warn_number','goods_image','brand_id','click_count','sale_num','comment_num','collect_num','is_best','is_new','is_hot','is_promote','freight_id','sales_model','goods_sort','last_time','tag_id',
//            'shop_name','shop_type','is_supply','show_price','show_content','button_content', 'is_free', 'brand_name','button_url'
			'goods_freight_fee'
		];

		$total = $goodsQuery
			->select($field)->count();
		$list = $goodsQuery
			->select($field)
			->forPage($curPage, $pageSize)
			->orderBy(get_shop_goods_sort_array($sort), $order)
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
				// 商品标签
				$goods_tag = GoodsTag::where('tag_id',$v['tag_id'])
					->select(['tag_image','tag_position'])
					->first();
				$v['tag_image'] = $goods_tag->tag_image ?? '';
				$v['tag_position'] = $goods_tag->tag_position ?? null;
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
				$v['cart_num'] = isset($cart_goods[$v['goods_id']]) ? $cart_goods[$v['goods_id']]['goods_number'] : 0; // 该商品购物车数量
			}
		}
		$pageHtml = frontend_pagination($total);
		$page_array = frontend_pagination($total,true);
		$page_json = json_encode($page_array);
		$filter = $this->goods->shopGoodsFilterData($params, 1);

		$app_prefix_data = [
			'shop_id' => $shop_id,
			'shop_info' => $shop_info,
			'region_name' => $region_name,
			'duration_time' => $duration_time,
			'is_collect' => $is_collect,
			'collect_count' => $collect_count,
			'goods_count' => 0,
			'bonus_count' => '0',
			'page' => $page_array,
			'list' => $list,
			'filter' => $filter,
			'condition' => null,
			'keyword' => $keyword,
			'user_id' => null,
			'shop_cat_list' => $shop_category_list,
			'region_value' => null,
			'position' => 'search',
			'show_sale_number' => '1',
			'yikf_url' => '',
			'evaluate_show' => '1',
		];


		$webStatic = 0;

		$compact = compact('shop_id', 'shop_info', 'shop_navigation', 'shop_category_list', 'category','chr_list', 'pageHtml', 'total',
			'duration_time','region_name', 'list', 'page_json','page_array', 'keyword','cat_id','parent_id','cat_name',
			'cart_price_info',
			'webStatic', 'filter'
		);

		if ($request->ajax()) {
			$render = view('shop.partials._shop_goods_'.$m_shop_list_style, $compact)->render();
			return result(0, $render);
		}
//        dd($shop_info);
		$webData = []; // web端（pc、mobile）数据对象
		$data = [
			'app_prefix_data' => $app_prefix_data,
			'app_suffix_data' => [],
			'web_data' => $webData,
			'compact_data' => $compact,
			'tpl_view' => $tpl_name // 根据店铺商品列表页样式 渲染不同的模板
		];
		$this->setData($data); // 设置数据
		return $this->displayData(); // 模板渲染及APP客户端返回数据
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

    /**
     * 装修预览
     *
     * @param Request $request
     * @return mixed
     */
    public function preview(Request $request)
    {
        $shop_id = $request->get('shop_id');

        return $this->shopHome($request, $shop_id, 'preview');
    }

	public function outOpenhourOrderEnable()
	{

		return result(-1, null);
	}
}
