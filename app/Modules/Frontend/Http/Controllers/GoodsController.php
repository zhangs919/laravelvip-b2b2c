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
// | Date:2018-08-15
// | Description:商品控制器
// +----------------------------------------------------------------------

namespace App\Modules\Frontend\Http\Controllers;

use App\Jobs\RenderGoodsJob;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Goods;
use App\Models\GoodsLayout;
use App\Models\GoodsSku;
use App\Models\GoodsUnit;
use App\Models\LibGoodsSku;
use App\Models\Shop;
use App\Modules\Base\Http\Controllers\Frontend;
use App\Repositories\BonusRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\CollectRepository;
use App\Repositories\CompareRepository;
use App\Repositories\CustomerRepository;
use App\Repositories\GoodsCommentRepository;
use App\Repositories\GoodsHistoryRepository;
use App\Repositories\GoodsRepository;
use App\Repositories\GoodsSkuRepository;
use App\Repositories\LibGoodsRepository;
use App\Repositories\LibGoodsSkuRepository;
use App\Repositories\SelfPickupRepository;
use App\Repositories\ShopCategoryRepository;
use App\Repositories\ShopCreditRepository;
use App\Repositories\ShopRepository;
use App\Services\WechatSDKService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class GoodsController extends Frontend
{

    protected $goods; // 商品模型
    protected $libGoods; // 商品库商品模型
    protected $category; // 商品分类模型
    protected $goodsHistory; // 商品浏览记录模型
    protected $collect;
    protected $selfPickup;

    protected $shopCategory;
    protected $shop;
    protected $compare;
    protected $goodsSku;
    protected $libGoodsSku;
    protected $shopCredit;
    protected $customer;

    protected $bonus;

    protected $goodsComment; // 商品评价

    public function __construct(
        GoodsRepository $goods
        ,LibGoodsRepository $libGoods
        ,CategoryRepository $category
        ,GoodsHistoryRepository $goodsHistory
        ,ShopCategoryRepository $shopCategory
        ,CollectRepository $collect
        ,SelfPickupRepository $selfPickup
        ,ShopRepository $shop
        ,CompareRepository $compare
        ,GoodsSkuRepository $goodsSku
        ,LibGoodsSkuRepository $libGoodsSku
        ,ShopCreditRepository $shopCredit
        ,CustomerRepository $customer
        ,BonusRepository $bonus
        ,GoodsCommentRepository $goodsComment
    )
    {
        parent::__construct();

        $this->goods = $goods;
        $this->libGoods = $libGoods;
        $this->category = $category;
        $this->goodsHistory = $goodsHistory;
        $this->shopCategory = $shopCategory;
        $this->collect = $collect;
        $this->selfPickup = $selfPickup;
        $this->shop = $shop;
        $this->compare = $compare;
        $this->goodsSku = $goodsSku;
        $this->libGoodsSku = $libGoodsSku;
        $this->shopCredit = $shopCredit;
        $this->customer = $customer;
        $this->bonus = $bonus;
        $this->goodsComment = $goodsComment;

    }

    /**
     * 商品列表
     * 多端共用一个方法
     *
     * @param Request $request
     * @param string $filter_str
     * @return mixed
     */
    public function lists(Request $request, $filter_str='')
    {
        // 获取数据
        if (!empty($filter_str)) {
            $filter_param = explode('-', $filter_str);

            $params['cat_id'] = isset($filter_param[0]) ? (int)$filter_param[0] : 0; // 分类id
            $params['p2'] = isset($filter_param[1]) ? $filter_param[1] : 0; // 未知参数
            $params['p3'] = isset($filter_param[2]) ? $filter_param[2] : 0; // 未知参数
            $params['is_self'] = isset($filter_param[3]) ? $filter_param[3] : 0; // 平台自营
            $params['is_free'] = isset($filter_param[4]) ? $filter_param[4] : 0; // 包邮
            $params['is_cash'] = isset($filter_param[5]) ? $filter_param[5] : 0; // 支持货到付款
            $params['is_stock'] = isset($filter_param[6]) ? $filter_param[6] : 0; // 仅显示有货
            $params['sort'] = isset($filter_param[7]) ? $filter_param[7] : 0; // 排序字段 综合/销量/新品/评论/价格/人气
            $params['order'] = isset($filter_param[8]) ? $filter_param[8] : 4; // 排序方式 3-asc 4-desc
            $params['region'] = isset($filter_param[9]) ? $filter_param[9] : 0; // 地区code
            $params['style'] = isset($filter_param[10]) ? $filter_param[10] : 0; // 列表显示方式 0-大图模式 1-列表模式
            $params['brand_id'] = isset($filter_param[11]) ? $filter_param[11] : 0; // 品牌
            $params['price_min'] = isset($filter_param[12]) ? $filter_param[12] : 0; // 最小价格
            $params['price_max'] = isset($filter_param[13]) ? $filter_param[13] : 0; // 最大价格
            $params['keyword'] = isset($params['keyword']) ? $params['keyword'] : ''; // 关键词搜索
        } else { // url拼接地址 &
            $params = $request->all();
        }
        extract($params);

        $goods_category = [];
        $navigate_cat = [];
        $navigate_cat_type = 0;

        $cat_id = isset($params['cat_id']) ? $params['cat_id'] : 0;

        $cat_info = [];
        $cat_brands = [];
        if (isset($cat_id) && !empty($cat_id)) {
            $cat_info = $this->category->getById($cat_id);
            $brand_ids = explode(',', $cat_info->brand_ids);
            $cat_brands = Brand::whereIn('brand_id', $brand_ids)->get();


            // 商品分类列表
            $goods_category = Category::where('is_show',1)->select(['cat_id','cat_name','parent_id', 'cat_level'])->orderBy('cat_sort', 'asc')->get()->toArray();
            // 分类面包屑导航
            $navigate_cat = navigate_goods($cat_id);
            $navigate_cat_type = 0;

            // 分类菜单显示 目前没有用到
//        $cur_cat_arr = $this->goods->getGoodsCat($cat_info); // 当前分类



            $seo_info = [
                1 => $cat_info->title,
                2 => $cat_info->keywords,
                3 => $cat_info->discription,
            ];

            $this->show_seo($seo_info, ['name' => $cat_info->cat_name]); // SEO
        }

        $cat_id_arr = [];
        if (!empty($cat_id)) {
            $cat_id_arr = get_cat_grandson($cat_id); // 获取该分类下的所有分类id
        }

//        $condition['in'] = [
//            'field' => 'cat_id',
//            'condition' => $cat_id_arr
//        ];
        // 热卖商品
        $hot_sale_goods = $this->goods->getHotSaleGoods($cat_id_arr, 4);
        // 新品推荐
        $new_goods = $this->goods->getNewGoods($cat_id_arr, 4);

        // 店内排行榜-销售量
        $sale_top_list = $this->goods->getTopGoods('sale_num', $cat_id_arr, 4);
        // 店内排行榜-收藏数
//        $collect_top_list = $this->goods->getTopGoods('collect_num', $cat_id_arr, 4);

        // 销量排行榜
//        $sale_rank_goods = $this->goods->getSaleRankGoods($cat_id_arr, 4);

        // 浏览历史
        list($goods_history,$goods_history_total) = $this->goods->getGoodsHistory($cat_id_arr, 6);

        // 商城所在地区
//        $region_code = sysconf('mall_region_code');

        $region_code = !empty($params['region']) ? str_replace('_', ',', $params['region']) : null;

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
        list($where, $whereBetween, $whereIn) = $this->goods->splice_goods_list_condition($params);

        // 计算价格区间
        $goodsQuery = new Goods();
        $goodsPriceQuery = new Goods();
        if (!empty($where)) {
            $goodsQuery = $goodsQuery->where($where);
            $goodsPriceQuery = $goodsQuery->where($where);
        }
        if (!empty($whereBetween) && isset($whereBetween['goods_price'])) { // 暂时固定为goods_price
            $goodsQuery = $goodsQuery->whereBetween('goods_price', $whereBetween['goods_price']);
        }
        if (!empty($whereIn)) {
            foreach ($whereIn as $k=>$v) {
                $goodsQuery = $goodsQuery->whereIn($k, $v);
                $goodsPriceQuery = $goodsQuery->whereIn($k, $v);
            }
        }

        // 计算价格区间

        $goodsPriceData = $goodsPriceQuery
            ->select(DB::raw("MIN(goods_price) as price_min,MAX(goods_price) as price_max, GROUP_CONCAT(goods_price) as price_str"))
            ->first()->toArray();

        // 商品列表
        $curPage = isset($go) ? $go : 1;
        $pageSize = isset($size) ? $size : 12;
        $sortname = isset($sort) ? $sort : 1;
        if (!empty($order)) {
            $sortorder = str_replace([3,4], ['ASC','DESC'], $order);
        } else {
            $sortorder = 'DESC';
        }

        if (!empty($style)) {
            $style = str_replace([0,1],['grid','list'], $style);
        } else {
            $style = 'grid';
        }
        $field = ['goods_id','goods_name','cat_id','shop_id','sku_id','sku_open','goods_price','market_price','mobile_price','give_integral','goods_number','warn_number','goods_image','brand_id','click_count','sale_num','comment_num','collect_num','is_best','is_new','is_hot','is_promote','freight_id','sales_model','goods_sort','last_time',
//            'shop_name','shop_type','is_supply','show_price','show_content','button_content', 'is_free', 'brand_name','button_url'
            'goods_freight_fee'
        ];
        $total = $goodsQuery
            ->select($field)->count();
        $list = $goodsQuery
            ->select($field)
            ->forPage($curPage, $pageSize)
            ->orderBy(get_goods_sort_array($sortname), $sortorder)
            ->get()->toArray();
        if (!empty($list)) {
            foreach ($list as &$v) {
                $shop_info = Shop::where('shop_id',$v['shop_id'])
                    ->select(['shop_name','shop_type','is_supply','show_price','show_content','button_content','button_url', 'is_own_shop'])
                    ->first()->toArray();
                $brand_name = Brand::where('brand_id',$v['brand_id'])->value('brand_name');
                $isCollected = 0;
                if ($this->collect->checkIsCollected($this->user_id, 0, 0, $v['goods_id'])) {
                    // 已收藏
                    $isCollected = 1;
                }
                $v = array_merge($v,$shop_info);
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

        // 分页
        $pageHtml = frontend_pagination($total);
        $page_array = frontend_pagination($total,true);
        $page_json = json_encode($page_array);

        $goods_ids = implode(',',array_column($list,'goods_id'));

        list($filter, $filter_condition) = $this->goods->goodsFilterData($params, $goodsPriceData);



        // 重新设置params
        $params = [
            'filter_attr_vids' => isset($filter_attr_vids) ? $filter_attr_vids : null,
            'filter_attr_ids' => isset($filter_attr_ids) ? $filter_attr_ids : null,
            'filter_brand_ids' => isset($filter_brand_ids) ? $filter_brand_ids : null,
            'filter_goods_prices' => isset($filter_goods_prices) ? $filter_goods_prices : null,
            'cat_id' => isset($cat_id) ? $cat_id : 0,
            'cat_ids' => isset($cat_ids) ? $cat_ids : null,
            'type' => isset($type) ? $type : 0,
            'go' => isset($go) ? $go : 1,
            'brand_id' => isset($brand_id) ? $brand_id : 0,
            'filter_attr' => isset($filter_attr) ? $filter_attr : 0, // '1801-1784-1825-1738-1773'
            'price_min' => isset($price_min) ? $price_min : 0, // '1'
            'price_max' => isset($price_max) ? $price_max : 0, // '300'
            'region_code' => $region_code,
            'is_free' => isset($is_free) ? $is_free : 0,
            'is_self' => isset($is_self) ? $is_self : 0,
            'is_stock' => isset($is_stock) ? $is_stock : 0,
            'is_cash'=>isset($is_cash) ? $is_cash : 0,
            'style'=>isset($style) ? $style : 'grid',
            'sort'=>isset($sort) ? $sort : '1',
            'order'=>isset($order) ? $order : 'DESC',
            'keyword'=>isset($keyword) ? $keyword : null,
            'shop_id'=>isset($shop_id) ? $shop_id : 0,
            'barcode'=>isset($barcode) ? $barcode : null,
        ];

        if ($request->ajax()) {
            $render = view('goods.partials._goods_list', compact('list','page_json'))->render();

            return result(0, $render);
        }

        $compact = compact('cat_info', 'cat_brands',
            'cat_id', 'list', 'page_array', 'total', 'pageHtml', 'goods_ids', 'goods_category', 'navigate_cat','navigate_cat_type',
            'hot_sale_goods', 'new_goods','sale_top_list','goods_history',
            'page_json','filter', 'filter_condition', 'region_code', 'params');

        $webData = []; // web端（pc、mobile）数据对象
        $data = [
            'app_prefix_data' => [
                'region_code' => $region_code,
                'price_show' => [
                    'code' => 1
                ],
                'display' => 'grid',
                'filter' => $filter,
                'params' => [
                    $params
                ],
                'condition'=>$filter_condition, // 选中的筛选项
                'list' => $list,
                'page' => $page_array, // 列表底部详细分页
                'goods_ids' => $goods_ids,
                'keyword' => isset($keyword) ? $keyword : '',
                'cat_id'=>isset($cat_id) ? $cat_id : 0,
                'scroll'=>1,
                'show_sale_number'=>'1',
            ],
            'app_suffix_data' => [],
            'web_data' => $webData,
            'compact_data' => $compact,
            'tpl_view' => 'goods.goods_list'
        ];
        $this->setData($data); // 设置数据
        return $this->displayData(); // 模板渲染及APP客户端返回数据
    }

    /**
     * 商品详情
     *
     * @param Request $request
     * @param $goods_id
     * @return mixed
     */
    public function showGoods(Request $request, $goods_id)
    {

        // 将客户端用户信息写入session
        $user_address = [
            'api' => 'ip2region',
            'country' => '中国',
            'country_id' => null,
            'area' => '',
            'area_code' => '',
            'province' => '云南省',
            'province_code' => '53',
            'city' => '昆明市',
            'city_code'=>'53,01',
            'county' => '', // 县
            'county_code' => '', // 县code
            'isp' => '电信',
            'isp_code' => '',
            'ip' => '123.123.312.231',
        ];
        session(['user_address' => $user_address]);


        if ($request->routeIs('pc_show_goods') || $request->routeIs('mobile_show_goods')) {
            $sku_id = $this->goods->getSkuId($goods_id);
        } else {
            $sku_id = $goods_id;
            $goods_id = $this->goods->getGoodsId($sku_id);
        }

        $goods_info = $this->goods->getById($goods_id);
        if (empty($goods_info)) {
            abort(404, '商品不存在，可能已下架或者被转移');
        }
        if ($goods_info->goods_status != 1) {
            abort(404, '商品不存在，可能已下架或者被转移');
        }

//        RenderGoodsJob::dispatch($goods_info); // 测试 horizon tags

        $shopId = $goods_info->shop_id;

        // 店铺信息
        $shop_info = $this->shop->shopInfo($shopId);

        $this->setLrwTag();

        $goods = $goods_info->toArray();

        // 适配uni-app端 临时增加限购字段
        $goods['max_buy'] = 5;
        $goods['stock'] = $goods['goods_number'];
        $goods['promotion_price'] = $goods['goods_price']; // 促销价格 todo 促销工具功能完善后再取促销价格
        $goods['member_price'] = $goods['goods_price']; // 会员价格 todo 促销工具功能完善后再取促销价格



        // 商品品牌
        $brand_name = Brand::where('brand_id', $goods['brand_id'])->value('brand_name');

        // 商品sku列表
        $sku_list = $this->goods->getFrontendSkuList($goods_id);
        $base_sku_list = array_values($sku_list);

        // 商品规格列表
        $spec_list = $this->goods->getGoodsSpecList($goods_info);

        // 商品属性列表
        $attr_list = $this->goods->getGoodsAttrList($goods_id);

        // 商品售后服务保障列表
        $contract_ids = [];
        if (!empty($goods['contract_ids'])) {
            foreach ($goods['contract_ids'] as $k=>$v) {
                if ($v == 1) {
                    $contract_ids[] = $k;
                }
            }
        }
        $contract_list = $this->goods->getGoodsContractList($shopId, $contract_ids);

        // 包装清单
        $packing_layout = GoodsLayout::where('layout_id', $goods['packing_layout_id'])->value('content');
        // 售后保证版式
        $service_layout = GoodsLayout::where('layout_id', $goods['service_layout_id'])->value('content');

        // 店铺常见问题
        $question_list = $this->goods->getShopQuestions($goods['shop_id'], 5);

        // 商品评论
        $comment = [];

        // 商品单位名称
        $unit_name = GoodsUnit::where('unit_id', $goods['goods_unit'])->value('unit_name') ?? '';

        // 检查该商品是否加入过对比
        $is_compare = $this->compare->checkIsCompared($this->user_id, $goods_id);

        // 是否收藏商品
        $is_collect = false;
        if ($this->collect->checkIsCollected($this->user_id, 0, 0, $goods_id)) {
            // 已收藏
            $is_collect = true;
        }

        // 是否收藏店铺
        $is_shop_collect = false;
        if ($this->collect->checkIsCollected($this->user_id, 1, $goods['shop_id'])) {
            // 已收藏
            $is_shop_collect = true;
        }

        $goods['goods_button_name'] = null;
        $goods['goods_button_url'] = null;
        $goods['region_code'] = $shop_info['shop']['region_code'];
        $goods['is_free'] = null;
        $goods['free_set'] = null;
        $goods['limit_sale'] = null;
        $goods['collect_count'] = $goods['collect_num'];
        $goods['shop_name'] = $shop_info['shop']['shop_name'];
        $goods['is_supply'] = $shop_info['shop']['is_supply'];
        $goods['brand_name'] =  $brand_name;
        $goods['start_price'] = $shop_info['shop']['start_price'];
        $goods['button_content'] = $shop_info['shop']['button_content'];
        $goods['button_url'] = $shop_info['shop']['button_url'];
        $goods['show_price'] = $shop_info['shop']['show_price'];
        $goods['show_content'] = $shop_info['shop']['show_content'];
        $goods['region_name'] = null;
        $goods['base_sku_list'] = $base_sku_list;
        $goods['sku_list'] = $sku_list;
        $goods['price_show'] = [
            'code' => 1 // todo
        ];
        $goods['spec_list'] = $spec_list;
        $goods['attr_list'] = $attr_list;
        $goods['contract_list'] = $contract_list;
        $goods['packing_layout'] = $packing_layout;
        $goods['service_layout'] = $service_layout;
        $goods['question_list'] = $question_list;
        $goods['comment_count'] = $goods['comment_num'];
        $goods['comment'] = $comment;
        $goods['goods_price_format'] = '￥'.$goods['goods_price'];
        $goods['unit_name'] = $unit_name;
        $goods['is_compare'] = $is_compare;
        $goods['is_collect'] = $is_collect;
        $goods['shop_collect'] = $is_shop_collect;

        $goods['show_sale_number'] = sysconf('goods_show_sale_number'); // 是否显示商品销量

        // 商品SKU信息
        $sku = $this->goodsSku->getGoodsSkuInfo($sku_id, $goods_info, $shop_info['shop']);
		if (empty($sku)) {
			abort(404, '商品SKU不存在');
		}

        // 是否微信端访问
        $is_weixin = is_weixin();

        $shop_goods_count = $this->shop->getShopGoodsCount($shopId);
        $shop_collect_count = $shop_info['shop']['collect_num'];
        // 店内排行榜-销售量
        $sale_top_list = $this->goods->getTopGoods('sale_num', [], 10, $goods['shop_id']);
        // 店内排行榜-收藏数
        $collect_top_list = $this->goods->getTopGoods('collect_num', [], 10, $goods['shop_id']);




        $im_enable = 1; // todo



        $comment_count = '0';
        $collect_count = '0';
        $show_collect_count = sysconf('goods_info_show_collect'); // 是否显示商品收藏人气;

        // 红包列表
        $bonus_list = $this->bonus->getGoodsDetailBonusList($goods_id, $goods['shop_id'], $this->user_id);

//        dd($bonus_list);
        $rank_prices = null;
        $rank_message = '请登录，确认是否享受优惠';
        $show_freight_region = 1;
        $show_stock = '1'; // 是否显示库存



        // 自提点
        $condition = [
            'where' => [
                ['is_show', 1],
                ['shop_id', $goods_info->shop_id]
            ],
            'limit' => 0,
            'sortname' => 'pickup_id',
            'sortorder' => 'desc',
        ];
        list($pickup, $self_pickup_total) = $this->selfPickup->getList($condition);

        // 商品单位列表
        $unit_list = ['' => '-- 请选择 --'];
        $unitList = GoodsUnit::where('shop_id', $shopId)->orderBy('unit_id', 'asc')->get();
        if (!empty($unitList)) {
            foreach ($unitList as $item) {
                $unit_list[$item->unit_id] = $item->unit_name;
            }
        }

        // 分享
        $share = [
            'seo_goods_title' => '商品名称-网站名称',
            'seo_goods_keywords' => '【商品名称】-网站名称',
            'seo_goods_discription' => ''
        ];
        $commission_money = 0;
		$goods_qrcode_url = $this->goods->getGoodsQrCode($goods_id);

        $share_url = 'http://'.config('lrw.frontend_domain').'/goods-'.$goods_id.'.html?user_id='.$this->user_id;
        $share_uid = $this->user_id;
        $yikf_url = ''; //"http://kf.test.xxxx.com/index/index/home?business_id=706e3ef85c02fc953ec136b620b62629&groupid=0&shop_id=1&goods_id=292&visiter_id=_0&visiter_name=&avatar=http://xxxx/images/746/system/config/default_image/default_user_portrait_0.png&domain=http://www.test.xxxx.com&product={\"pid\":292,\"title\":\"12345699999999999999\",\"img\":\"http:\\/\\/xxxx\\/demo\\/shop\\/1\\/gallery\\/2017\\/08\\/25\\/15036437563148.png\",\"info\":\"\",\"price\":\"1.00\",\"goods_type\":0,\"url\":\"http:\\/\\/www.test.xxxx.com\\/goods-292.html?user_id=2\"}&goods_type=0";
        $cross_border_identity = '跨境';


        /* PC端独有 START */
        // 店铺内分类
        $where = [];
        $where[] = ['shop_id', $goods_info->shop_id];
        $condition = [
            'where' => $where,
            'sortname' => 'cat_sort',
            'sortorder' => 'asc',
        ];
        list($shop_category_list, $total) = $this->shopCategory->getList($condition, '', true);

        if (is_login()) {
            // 记录浏览历史
            $this->goodsHistory->addHistoryLog(is_login(), $goods_info);
        }
        Goods::where('goods_id', $goods_id)->increment('click_count', 1); // 统计点击数+1

        // 商品分类列表
        $goods_category = $this->category->getCachedCategory();
        // 分类面包屑导航
        $navigate_cat = navigate_goods($goods_id, 1);
        $navigate_cat_type = 1;


        $region_code = $shop_info['shop']['region_code'];
        $lrw_last_region_code = session('LRW_LAST_REGION_CODE');
        if (!empty($lrw_last_region_code)) {
            $lrw_last_region_code_arr = unserialize(substr($lrw_last_region_code,64));
            $region_code = $lrw_last_region_code_arr[1];
        }

        // 客服列表
        $customer_list = $this->customer->getCustomerList($shopId);

        // 浏览历史
        $cat_id_arr = get_cat_grandson($goods['cat_id']); // 获取该分类下的所有分类id
        list($goods_history,$goods_history_total) = $this->goods->getGoodsHistory($cat_id_arr, 10, [['user_id', $this->user_id]]);
        $goods_history = $goods_history->toArray();

        /* PC端独有 END */
        $compact = compact(
            'goods', 'sku', 'is_weixin','shop_goods_count','shop_collect_count',
            'sale_top_list','collect_top_list','im_enable','shop_info','comment_count',
            'collect_count','show_collect_count','bonus_list','rank_prices','rank_message',
            'show_freight_region','show_stock','region_code','pickup','unit_list', 'share',
            'commission_money','goods_qrcode_url','share_url','share_uid','yikf_url','cross_border_identity',

            'shop_category_list','goods_category','navigate_cat','navigate_cat_type','customer_list','goods_history' // PC端独有
            );
        $webData = []; // web端（pc、mobile）数据对象
//        dd($shop_info);
        $data = [
            'app_prefix_data' => [
                'goods' => $goods,
                'sku' => $sku,
                'is_weixin' => is_weixin(),
                'shop_goods_count' => $shop_goods_count,
                'shop_collect_count' => $shop_collect_count,
                'sale_top_list' => $sale_top_list,
                'collect_top_list' => $collect_top_list,
                'im_enable' => $im_enable,
                'shop_info' => $shop_info,
                'comment_count' => $comment_count,
                'collect_count' => $collect_count,
                'show_collect_count' => $show_collect_count,
                'bonus_list' => $bonus_list,
                'rank_prices' => $rank_prices,
                'rank_message' => $rank_message,
                'show_freight_region' => $show_freight_region,
                'show_stock' => $show_stock,
                'region_code' => $region_code,
                'pickup' => $pickup->toArray(),
                'unit_list' => $unit_list,
                'share' => $share,
                'commission_money' => $commission_money,
                'goods_qrcode_url' => $goods_qrcode_url,
                'share_url' => $share_url,
                'share_uid' => $share_uid,
                'yikf_url' => $yikf_url,
                'cross_border_identity' => $cross_border_identity
            ],
            'app_suffix_data' => [],
            'web_data' => $webData,
            'compact_data' => $compact,
            'tpl_view' => 'goods.show_goods'
        ];
//        dd($data);
        $this->setData($data); // 设置数据

        $this->show_seo('seo_goods',['name'=>$goods_info->goods_name, 'image' => $goods_info->goods_image]);

        return $this->displayData(); // 模板渲染及APP客户端返回数据
    }

    /**
     * 商品库商品详情
     * @param Request $request
     * @param $goods_id
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showLibGoods(Request $request, $goods_id)
    {

        if ($request->routeIs('pc_show_lib_goods') || $request->routeIs('mobile_show_lib_goods')) {
            $sku_id = $this->libGoods->getSkuId($goods_id);
        } else {
            $sku_id = $goods_id;
            $goods_id = $this->libGoods->getGoodsId($sku_id);
        }

        $goods_info = $this->libGoods->getById($goods_id);
        if (empty($goods_info)) {
            abort(404, '商品不存在，可能已下架或者被转移');
        }

        // 店铺信息
        $shop_info['shop']['shop_name'] = sysconf('site_name');

        $goods = $goods_info->toArray();

        // 商品品牌
        $brand_name = Brand::where('brand_id', $goods['brand_id'])->value('brand_name');

        // 商品sku列表
        $sku_list = $this->libGoods->getFrontendSkuList($goods_id);
        $base_sku_list = array_values($sku_list);

        // 商品规格列表
        $spec_list = $this->libGoods->getGoodsSpecList($goods_info);

        // 商品属性列表
        $attr_list = $this->libGoods->getGoodsAttrList($goods_id);

        $goods['goods_button_name'] = null;
        $goods['goods_button_url'] = null;
        $goods['region_code'] = $shop_info['shop']['region_code'] ?? '';
        $goods['is_free'] = null;
        $goods['free_set'] = null;
        $goods['limit_sale'] = null;
        $goods['collect_count'] = $goods['collect_num'];
        $goods['shop_name'] = $shop_info['shop']['shop_name'] ?? '';
        $goods['is_supply'] = $shop_info['shop']['is_supply'] ?? '';
        $goods['brand_name'] =  $brand_name;
        $goods['start_price'] = $shop_info['shop']['start_price'] ?? '';
        $goods['button_content'] = $shop_info['shop']['button_content'] ?? '';
        $goods['button_url'] = $shop_info['shop']['button_url'] ?? '';
        $goods['show_price'] = $shop_info['shop']['show_price'] ?? '';
        $goods['show_content'] = $shop_info['shop']['show_content'] ?? '';
        $goods['region_name'] = null;
        $goods['base_sku_list'] = $base_sku_list;
        $goods['sku_list'] = $sku_list;
        $goods['price_show'] = [
            'code' => 1 // todo
        ];
        $goods['spec_list'] = $spec_list;
        $goods['attr_list'] = $attr_list;
        $goods['show_sale_number'] = sysconf('goods_show_sale_number'); // 是否显示商品销量

        // 商品SKU信息
        $sku = $this->libGoodsSku->getGoodsSkuInfo($sku_id, $goods_info, $shop_info['shop']);
        // 商品单位列表
        $unit_list = ['' => '-- 请选择 --'];
        $unitList = GoodsUnit::where('shop_id', 0)->orderBy('unit_id', 'asc')->get();
        if (!empty($unitList)) {
            foreach ($unitList as $item) {
                $unit_list[$item->unit_id] = $item->unit_name;
            }
        }
        $show_freight_region = 1;
        $is_lib_goods = true;

        /* PC端独有 START */

        /* PC端独有 END */
        $compact = compact(
            'goods', 'sku', 'unit_list', 'show_freight_region', 'is_lib_goods', 'shop_info'
        );
        $webData = []; // web端（pc、mobile）数据对象
        $data = [
            'app_prefix_data' => [
                'goods' => $goods,
                'sku' => $sku,
                'unit_list' => $unit_list,
                'show_freight_region' => $show_freight_region,
                'is_lib_goods' => $is_lib_goods,
                'shop_info' => $shop_info,
            ],
            'app_suffix_data' => [],
            'web_data' => $webData,
            'compact_data' => $compact,
            'tpl_view' => 'goods.show_lib_goods'
        ];
        $this->setData($data); // 设置数据

        $this->show_seo('seo_goods',['name'=>$goods_info->goods_name, 'image' => $goods_info->goods_image]);

        return $this->displayData(); // 模板渲染及APP客户端返回数据
    }

    /**
     * 商品描述
     *
     * @param Request $request
     * @return mixed
     * @throws \Throwable
     */
    public function desc(Request $request)
    {
        $sku_id = $request->get('sku_id');

        $is_lib_goods = $request->get('is_lib_goods');
        if ($is_lib_goods) {
            $goods_id = LibGoodsSku::where('sku_id', $sku_id)->value('goods_id');
            $goods_info = $this->libGoods->getById($goods_id);
        } else {
            $goods_id = GoodsSku::where('sku_id', $sku_id)->value('goods_id');
            $goods_info = $this->goods->getById($goods_id);
        }
        $this->setLrwTag();

        $mobile_desc_render = null;
        $pc_desc_render = null;

//        if (is_mobile()) {
//            $mobile_desc = $goods_info->mobile_desc;
//            $mobile_desc_render = view('goods.mobile_desc', compact('mobile_desc'))->render();
//        } else {
//            $pc_desc = $goods_info->pc_desc;
//            $pc_desc_render = view('goods.pc_desc', compact('pc_desc'))->render();
//        }

        // 手机端图文
        $mobile_desc = $goods_info->mobile_desc;

        // PC端图文
        $pc_desc = $goods_info->pc_desc;
        $pc_desc_render = view('goods.pc_desc', compact('pc_desc'))->render();

        if (is_mobile() || is_app()) {
            // 微信端/APP访问
            if (empty($mobile_desc)) { // 如果手机端图文为空 则使用PC端图文
                $desc_type = 0;
            } else {
                $desc_type = 1;
                foreach ($mobile_desc as $key=>$item) {
                    if ($mobile_desc[$key]['type'] == 1) {
                        $mobile_desc[$key]['content'] = get_image_url($item['content']);
                    }
                }
                $pc_desc_render = null;
            }
        } else {
            // PC端访问
            $desc_type = 0;
            $mobile_desc = null;
        }

        $extra = [
            'desc_type' => $desc_type,
            'mobile_desc' => $mobile_desc,
            'need_load' => 0,
            'pc_desc' => is_app() ? $pc_desc : $pc_desc_render
        ];
        return result(0, null, '', $extra);
    }


    /**
     * 生成二维码
     * @param Request $request
     * @return mixed
     */
    public function qrCode(Request $request)
    {
        $id = $request->get('id',0);
        return $this->goods->generateGoodsQrCode($id);
    }

    /**
     * 商品详情 选择规格
     * ajax加载sku相关信息
     *
     * @param Request $request
     * @return mixed
     */
    public function sku(Request $request)
    {
        $sku_id = $request->get('sku_id');
        $is_lib_goods = $request->get('is_lib_goods');

        if ($is_lib_goods) {
            $goods_id = $this->libGoods->getGoodsId($sku_id);
            $goods_info = $this->libGoods->getById($goods_id)->toArray();

            // 店铺信息
            $shop_info = [];

            // 默认sku
            $default_sku = LibGoodsSku::where('sku_id',$sku_id)->first()->toArray();
            $spec_ids = explode('|', $default_sku['spec_ids']);
            $selected_spec_names = $default_sku['spec_names'];
//            $selected_spec_id = explode('|', $default_sku['spec_ids'])[1];
//            $goods_images = $this->libGoods->getGoodsImages($goods_id, $selected_spec_id);
        } else {
            $goods_id = $this->goods->getGoodsId($sku_id);
            $goods_info = $this->goods->getById($goods_id)->toArray();

            // 店铺信息
            $shop_info = Shop::where('shop_id',$goods_info['shop_id'])->first()->toArray();
            $shop_info['opening_hour'] = unserialize($shop_info['opening_hour']);

            // 默认sku
            $default_sku = GoodsSku::where('sku_id',$sku_id)->first()->toArray();
            $spec_ids = explode('|', $default_sku['spec_ids']);
            $selected_spec_names = $default_sku['spec_names'];
//            $selected_spec_id = explode('|', $default_sku['spec_ids'])[1];
//            $goods_images = $this->goods->getGoodsImages($goods_id, $selected_spec_id);
        }


        // 商品图片相册
        $sku_images = [];
        foreach ($default_sku['sku_images'] as $image) {
            $sku_images[] = [
                get_image_url($image).'?x-oss-process=image\/resize,m_pad,limit_0,h_80,w_80',
                get_image_url($image).'?x-oss-process=image\/resize,m_pad,limit_0,h_450,w_450',
                get_image_url($image)
            ];
        }

        $spec_attr_value = [];
        foreach (explode(' ', $selected_spec_names) as $item) {
            $spec_attr_value[] = explode(':', $item)[1];
        }
        $spec_attr_value = implode(' ', $spec_attr_value);
        $sku_name = $goods_info['goods_name'].' '.$spec_attr_value;

        // 2019.10.22更新
        $data = [
            'sku_id' => $sku_id,
            'goods_id' => $goods_info['goods_id'],
            'sku_name' => $sku_name,
            'sku_image' => get_image_url($default_sku['sku_image']),
            'goods_price' => $default_sku['goods_price'],
            'original_price' => "1.00", // 商品表添加字段
            'market_price' => $default_sku['market_price'],
            'goods_number' => $default_sku['goods_number'],
            'original_number' => 2, // 商品表添加字段
            'spec_ids' => $spec_ids,
            'is_enable' => 1,
            'cart_step' => 1,
            'goods_image' => get_image_url($goods_info['goods_image']),
            'shop_id' => $goods_info['shop_id'],
            'goods_status' => $goods_info['goods_status'],
            'goods_audit' => $goods_info['goods_audit'],
            'act_id' => "0",
            'order_act_id' => "0",
            'goods_moq' => $goods_info['goods_moq'],
            'user_discount' => "0",
            'freight_id' => $goods_info['freight_id'],
            'unit_name' => $goods_info['goods_unit'], // 商品单位id
            'is_virtual' => "0",
            'ext_info' => null,
            'is_supply' => $shop_info['is_supply'],
            'shop_type' => "1",
            'show_price' => "1",
            'show_content' => $shop_info['show_content'] ?? '', // 店铺价格显示内容
            'button_content' => $shop_info['button_content'] ?? '', // 购买按钮显示内容
            'button_url' => null,
            'start_price' => $shop_info['start_price'] ?? '0.00', // 起送金额
            'sales_model' => $goods_info['sales_model'] ?? 0,
            'is_give' => null,
            'give_number' => null,
            'is_deduction' => null,
            'deduction_number' => null,
            'goods_mix' => [],
            'market_price_format' => "￥".$default_sku['market_price'],
            'sku_images' => $sku_images,
            'spec_attr_value' => $spec_attr_value,
            'gift_list' => [],
            'purchase_num' => 0,
            'activity' => null,
            'order_activity' => null,
            'saled' => 0,
            'cs_act_type' => 0,
            'cs_act_status' => 1,
            'cs_act_status_label' => null,
            'button_label' => "加入购物车",
            'cs_start_time' => 0,
            'cs_end_time' => 0,
            'cs_start_time_format' => "1970-01-01 08:00:00",
            'cs_end_time_format' => "1970-01-01 08:00:00",
            'original_price_format' => "￥1.00",
            'goods_price_format' => "￥".$default_sku['goods_price'],
            'prices' => [
                'is_original_price' => true,
                'price_type' => "original_price",
                'original_price' => "0.00",
                'activity_price' => false,
                'member_price' => false,
                'goods_price' => $default_sku['goods_price'],
                'activity_enable' => "0.00",
            ],
            'cash_back' => [],
            'rank_prices' => null,
            'price_show' => ['code'=>1],
            'buy_enable' => [
                'code'=>1,
                'button_content' => "请登录"
            ],
        ];

        return result(0, $data);
    }

    /**
     * 修改配送至
     *
     * @param Request $request
     * @return array
     */
    public function changeLocation(Request $request)
    {
        $sku_id = $request->get('sku_id');
        $region_code = $request->get('region_code');
//        session('LRW_LAST_REGION_CODE', null);
        // 设置最近的地区code
        // SZY_LAST_REGION_CODE=82abf20d4117457546a12fd94ca5abbbc1aac3df8674d78f6dd78d7e9efcdccea:2:{i:0;s:20:"SZY_LAST_REGION_CODE";i:1;s:8:"21,08,82";};
        $lrw_last_region_code = session('LRW_LAST_REGION_CODE');
        if (empty($lrw_last_region_code) || !empty($region_code)) {
//            session('LRW_LAST_REGION_CODE',strtolower(Str::random(64)).serialize(['LRW_LAST_REGION_CODE',$region_code]));
            session(['LRW_LAST_REGION_CODE'=>strtolower(Str::random(64)).serialize(['LRW_LAST_REGION_CODE',$region_code])]);
        }

        $sku_info = $this->goodsSku->getById($sku_id);

        $data = [
            'freight_fee' => 0,
            'freight_info' => '包邮',
            'limit_sale' => 0,
            'goods_number' => $sku_info->goods_number
        ];
        return result(0, $data);
    }

    /**
     * 商品评价
     * @param Request $request
     * @return mixed
     */
    public function comment(Request $request)
    {
        $sku_id = $request->get('sku_id');
        $output = $request->get('output');

        // 获取数据
        $goods_id = $this->goods->getGoodsId($sku_id);

        $page_output = $output ? true : false;

        // 查询条件
        $where[] = ['is_show', 1]; // 是否显示初次评价
        $where[] = ['add_is_show', 1]; // 是否显示追加评价
        $where[] = ['is_delete', 0];
        $where[] = ['goods_id', $goods_id];
        $condition = [
            'where' => $where,
            'limit' => 0,
            'sortname' => 'comment_id',
            'sortorder' => 'desc',
        ];
        list($list, $total) = $this->goodsComment->getGoodsPageCommentList($condition);

        $desc_mark_avg = '5.00'; // 宝贝与描述相符 平均得分
        $comment_counts = [
            '1', // 全部评价
            '1', // 图片
            '0', // 好评
            '0', // 中评
            '0' // 差评
        ];

        // 分页
        $pageHtml = frontend_pagination($total);
        $page_array = frontend_pagination($total,true);
        $page_json = json_encode($page_array);

        $compact = compact('page_output', 'pageHtml', 'list', 'page_json',
            'sku_id', 'goods_id', 'desc_mark_avg', 'comment_counts');
        if (empty($page_output) && !is_app()) { // web端访问 ajax请求
            $render = view('goods.partials._comment_list', $compact)->render();
            return result(0, $render);
        }

        if (!is_app() && $page_output) { // web端访问
            $render = view('goods.comment', $compact)->render();
            return result(0, $render);
        }

        $webData = []; // web端（pc、mobile）数据对象
        $data = [
            'app_prefix_data' => [
                'page_output' => $page_output,
                'page' => $page_array,
                'list' => $list,
                'sku_id' => $sku_id,
                'goods_id' => $goods_id,
                'desc_mark_avg' => $desc_mark_avg,
                'comment_counts' => $comment_counts
            ],
            'app_suffix_data' => [],
            'web_data' => $webData,
            'compact_data' => $compact,
            'tpl_view' => 'goods.comment'
        ];
        $this->setData($data); // 设置数据
        return $this->displayData(); // 模板渲染及APP客户端返回数据
    }

    /**
     * 自提点详情
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function pickupInfo(Request $request)
    {
        $id = $request->get('id');
        if (empty($id)) {
            abort(404, '自提点不存在');
        }
        $info = $this->selfPickup->getById($id);
        if (empty($info)) {
            abort(404, '自提点不存在');
        }
        $seo_title = $info->pickup_name.' - '.sysconf('site_name');

        return view('goods.pickup_info', compact('info', 'seo_title'));
    }

    /**
     * 搜索自提点
     *
     * @param Request $request
     * @return array
     * @throws \Throwable
     */
    public function searchPickup(Request $request)
    {
        $keyword = $request->post('keyword', '');
        $shop_id = $request->post('shop_id', 0);
        // 自提点
        if (!empty($keyword)) {
            $where[] = ['pickup_name', 'like', "%{$keyword}%"];
        }
        $where[] = ['is_show', 1];
        $where[] = ['shop_id', $shop_id];
        $condition = [
            'where' => $where,
            'limit' => 0,
            'sortname' => 'pickup_id',
            'sortorder' => 'asc',
        ];
        list($self_pickup_list, $self_pickup_total) = $this->selfPickup->getList($condition);
        $render = view('goods.partials._self_pickup_list', compact('self_pickup_list'))->render();

        return result(0, $render);
    }

    /**
     * 商品分享
     * 微商城用到
     *
     * @param Request $request
     * @return array
     * @throws \Throwable
     */
    public function goodsShare(Request $request)
    {
        $goods_id = $request->get('goods_id');
        $qrcode_type = $request->get('qrcode_type');
        $mode = $request->get('mode');
        $read_cache = $request->get('read_cache');
        $uuid = make_uuid();

        $goods = $this->goods->getById($goods_id);
        if (empty($goods)) {
            return result(-1, null, '商品ID无效');
        }
        $goods_qrcode = $this->goods->generateGoodsQrCode($goods_id);
        $render = view('goods.goods_share', compact('goods', 'uuid', 'goods_qrcode'))->render();

        return result(0, $render, '',['uuid'=> $uuid]);
    }

    public function setDefaultCard(Request $request)
    {

        return result(-1,null);
    }
}
