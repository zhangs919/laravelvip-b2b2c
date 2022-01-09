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

namespace App\Modules\Mobile\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Goods;
use App\Models\GoodsSku;
use App\Models\Shop;
use App\Modules\Base\Http\Controllers\Mobile;
use App\Repositories\CategoryRepository;
use App\Repositories\GoodsHistoryRepository;
use App\Repositories\GoodsRepository;
use App\Repositories\SelfPickupRepository;
use App\Repositories\ShopCategoryRepository;
use Illuminate\Http\Request;

class GoodsController extends Mobile
{

    protected $goods; // 商品模型
    protected $category; // 商品分类模型
    protected $goodsHistory; // 商品浏览记录模型
    protected $goodsCollect;
    protected $shopCollect;
    protected $selfPickup;

    protected $shopCategory;

    public function __construct()
    {
        parent::__construct();

        $this->goods = new GoodsRepository();
        $this->category = new CategoryRepository();
        $this->goodsHistory = new GoodsHistoryRepository();
        $this->shopCategory = new ShopCategoryRepository();
        $this->selfPickup = new SelfPickupRepository();


    }

    /**
     * 商品列表
     * 筛选条件
     *
     * @param Request $request
     * @param $filter_str
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function goodsList(Request $request, $filter_str = '')
    {
        $filter_param = explode('-', $filter_str);
        $cat_id = $request->get('cat_id', 0);

        if (empty($filter_param) && !$cat_id) {
            return redirect(route('pc_home'));
        }
        if (!$cat_id) {
            $cat_id = isset($filter_param[0]) ? (int)$filter_param[0] : 0; // 分类id
        }
        $p2 = isset($filter_param[1]) ? $filter_param[1] : 0; // 未知参数
        $p3 = isset($filter_param[2]) ? $filter_param[2] : 0; // 未知参数
        $is_platform = isset($filter_param[3]) ? $filter_param[3] : 0; // 平台自营
        $is_free_shipping = isset($filter_param[4]) ? $filter_param[4] : 0; // 包邮
        $is_offpay = isset($filter_param[5]) ? $filter_param[5] : 0; // 支持货到付款
        $has_goods_number = isset($filter_param[6]) ? $filter_param[6] : 0; // 仅显示有货
        $sort_field = isset($filter_param[7]) ? $filter_param[7] : 0; // 排序字段 综合/销量/新品/评论/价格/人气
        $sort_type = isset($filter_param[8]) ? $filter_param[8] : 4; // 排序方式 3-asc 4-desc
        $area_code = isset($filter_param[9]) ? $filter_param[9] : 0; // 地区code
        $display_model = isset($filter_param[10]) ? $filter_param[10] : 0; // 列表显示方式 0-大图模式 1-列表模式
        $brand_id = isset($filter_param[11]) ? $filter_param[11] : 0; // 品牌
        $min_price = isset($filter_param[12]) ? $filter_param[12] : 0; // 最小价格
        $max_price = isset($filter_param[13]) ? $filter_param[13] : 0; // 最大价格






        /*
         * 筛选条件
         *
         */
        $where = [];
        $where[] = ['goods_status',1]; // 商品状态 已发布
        $where[] = ['goods_audit',1]; // 审核通过
        // 搜索条件
       /* $search_arr = ['goods_barcode','keyword', 'cat_id','goods_status'];
        foreach ($search_arr as $v) {
            if (isset($params[$v]) && !empty($params[$v])) {

                if ($v == 'goods_barcode') {
                    $where[] = [$v, 'like', "%{$params[$v]}%"];
                } else {
                    $where[] = [$v, $params[$v]];
                }
            }
        }*/
        // 查询条件

        // 列表
        $condition = [
            'where' => $where,
            'sortname' => 'goods_id',
            'sortorder' => 'desc'
        ];

        $cat_id_arr = [];
        $cat_brands = [];
        $hot_sale_goods = [];
        $new_goods = [];
        $sale_rank_goods = [];
        $goods_history = [];
        $goods_category = [];
        $navigate_cat = [];
        $navigate_cat_type = 0;

        if ($cat_id) {
            $cat_info = $this->category->getById($cat_id);
            $brand_ids = explode(',', $cat_info->brand_ids);
            $cat_brands = Brand::whereIn('brand_id', $brand_ids)->get();
            $cat_id_arr = get_cat_grandson($cat_id); // 获取该分类下的所有分类id
            $condition['in'] = [
                'field' => 'cat_id',
                'condition' => $cat_id_arr
            ];

            // 热卖商品
            $hot_sale_goods = $this->goods->getHotSaleGoods($cat_id_arr, 4);
            // 新品推荐
            $new_goods = $this->goods->getNewGoods($cat_id_arr, 4);
            // 销量排行榜
            $sale_rank_goods = $this->goods->getSaleRankGoods($cat_id_arr, 4);
            // 浏览历史
            list($goods_history,$goods_history_total) = $this->goods->getGoodsHistory($cat_id_arr, 6);

            // 商品分类列表
            $goods_category = Category::where('is_show',1)->select(['cat_id','cat_name','parent_id', 'cat_level'])->orderBy('cat_sort', 'asc')->get();
            // 分类面包屑导航
            $navigate_cat = navigate_goods($cat_id);
            $navigate_cat_type = 0;

            $seo_info = [
                1 => $cat_info->title,
                2 => $cat_info->keywords,
                3 => $cat_info->discription,
            ];

            $this->show_seo($seo_info, ['name' => $cat_info->cat_name]); // SEO
        }

        $pageSize = 12;
        list($goods_list, $goods_total) = $this->goods->getList($condition, '', $this->user_id);
        $pageArr = frontend_pagination($goods_total, true);
        $page_count = $pageArr['page_count'];
        $cur_page = $pageArr['cur_page'];
        $page_json = json_encode($pageArr);

        // 分类菜单显示 目前没有用到
//        $cur_cat_arr = $this->goods->getGoodsCat($cat_info); // 当前分类

        $compact = compact('cat_info', 'cat_brands',
            'cat_id', 'goods_list', 'goods_total', 'goods_category', 'navigate_cat','navigate_cat_type',
            'hot_sale_goods', 'new_goods','sale_rank_goods','goods_history',
            'display_model', 'page_count', 'cur_page', 'page_json');

        $goPage = $request->get('go', 0);

        if ($goPage) {
            $render = view('goods.partials.goods_list', $compact)->render();
            return result(0, $render);
        }
//        $this->show_seo($seo_info); // SEO

        return view('goods.goods_list', $compact);
    }

    /**
     * 商品详情
     *
     * @param Request $request
     * @param $goods_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showGoods(Request $request, $goods_id)
    {
        if ($request->routeIs('mobile_show_goods')) {
            $sku_id = $this->goods->getSkuId($goods_id);
        } else {
            $sku_id = $goods_id;
            $goods_id = $this->goods->getGoodsId($sku_id);
        }

        $goods_info = $this->goods->getById($goods_id);
        // 是否收藏商品
        $goods_info->is_collected = false;
        if ($this->goodsCollect->checkIsCollected($goods_id, $this->user_id)) {
            // 已收藏
            $goods_info->is_collected = true;
        }

        $cat_id_arr = get_cat_grandson($goods_info->cat_id); // 获取该分类下的所有分类id

        // 默认sku
        $default_sku = GoodsSku::where('sku_id',$sku_id)->first()->toArray();
        if (!empty($default_sku['spec_ids'])) {
            $selected_spec_ids = explode('|', $default_sku['spec_ids']);
            $selected_spec_id = $selected_spec_ids[0];
            $spec_attr_value = [];
            foreach (explode(' ', $default_sku['spec_names']) as $item) {
                $spec_attr_value[] = explode(':', $item)[1];
            }
            $selected_spec_names = $spec_attr_value;
            $goods_images = $this->goods->getGoodsImages($goods_id, $selected_spec_id);
        } else {
//            $default_sku['specs'] = '';
            $selected_spec_ids = [];
            $selected_spec_id = '';
            $selected_spec_names = [];
            $goods_images = $this->goods->getGoodsImages($goods_id);
        }

        // 商品图片相册
        $goods_images = array_column($goods_images->toArray(), 'path');
//        $goods_images_list = [];
//        foreach ($goods_images as $image) {
//            $goods_images_list[] = [
//                get_image_url($image).'?x-oss-process=image\/resize,m_pad,limit_0,h_80,w_80',
//                get_image_url($image).'?x-oss-process=image\/resize,m_pad,limit_0,h_450,w_450',
//                get_image_url($image)
//            ];
//        }
//        $goods_images = json_encode($goods_images_list);

        // 店铺信息
        $shop_info = Shop::where('shop_id',$goods_info->shop_id)->first();
        // 是否收藏店铺
        $shop_info->is_collected = false;
        if ($this->shopCollect->checkIsCollected($goods_info->shop_id, $this->user_id)) {
            // 已收藏
            $shop_info->is_collected = true;
        }

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
        $goods_category = Category::where('is_show',1)->select(['cat_id','cat_name','parent_id', 'cat_level'])->orderBy('cat_sort', 'asc')->get();
        // 分类面包屑导航
        $navigate_cat = navigate_goods($goods_id,1);
        $navigate_cat_type = 1;
        // 商品sku列表
        $sku_list = $this->goods->getFrontendSkuList($goods_id);
        $sku_list = json_encode($sku_list);
        // 规格列表
        $spec_list = $this->goods->getGoodsSpecList($goods_id);

        // 产品属性 规格列表
//        $attr_spec_list = array_collapse($spec_list);

        //属性列表
        $attr_list = $this->goods->getGoodsAttrList($goods_id);

        // 销量排行榜
        $sale_rank_goods = $this->goods->getSaleRankGoods($cat_id_arr, 10, $goods_info->shop_id)->toArray();

        // 收藏排行榜
        $collect_rank_goods = $this->goods->getCollectRankGoods($cat_id_arr, 10, $goods_info->shop_id)->toArray();

        // 店铺常见问题
        $shop_questions = $this->goods->getShopQuestions($goods_info->shop_id, 5);

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
        list($self_pickup_list, $self_pickup_total) = $this->selfPickup->getList($condition);

        $compact = compact('sku_id', 'goods_info', 'shop_info',
            'shop_category_list',
            'goods_category', 'navigate_cat', 'navigate_cat_type',
            'sku_list','spec_list','default_sku', 'selected_spec_ids', 'selected_spec_names',
            'goods_images',
//            'attr_spec_list',
            'attr_list',
            'sale_rank_goods','collect_rank_goods','shop_questions', 'self_pickup_list');

        $this->show_seo('seo_goods',['name'=>$goods_info->goods_name]); // SEO

        return view('goods.show_goods', $compact);
    }

    /**
     * PC商品描述
     *
     * @param Request $request
     * @return mixed
     * @throws \Throwable
     */
    public function desc(Request $request)
    {
        $sku_id = $request->get('sku_id');
        $goods_id = GoodsSku::where('sku_id', $sku_id)->value('goods_id');
        $goods_info = $this->goods->getById($goods_id);
        $pc_desc = $goods_info->pc_desc;
        $pc_desc_render = view('goods.mobile_desc', compact('pc_desc'))->render();

        $extra = [
            'desc_type' => 0,
            'mobile_desc' => null,
            'need_load' => 0,
            'pc_desc' => $pc_desc_render
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
        $goods_id = $this->goods->getGoodsId($sku_id);
        $goods_info = $this->goods->getById($goods_id)->toArray();

        // 店铺信息
        $shop_info = Shop::where('shop_id',$goods_info['shop_id'])->first()->toArray();
        $shop_info['opening_hour'] = unserialize($shop_info['opening_hour']);

        // 默认sku
        // 默认sku
        $default_sku = GoodsSku::where('sku_id',$sku_id)->first()->toArray();
        $spec_ids = explode('|', $default_sku['spec_ids']);
        $selected_spec_names = $default_sku['spec_names'];
        $selected_spec_id = explode('|', $default_sku['spec_ids'])[0];
        $goods_images = $this->goods->getGoodsImages($goods_id, $selected_spec_id);


        // 商品图片相册
        $goods_images = array_column($goods_images->toArray(), 'path');
        $goods_images_list = [];
        foreach ($goods_images as $image) {
            $goods_images_list[] = [
                get_image_url($image).'?x-oss-process=image\/resize,m_pad,limit_0,h_80,w_80',
                get_image_url($image).'?x-oss-process=image\/resize,m_pad,limit_0,h_450,w_450',
                get_image_url($image)
            ];
        }
        $sku_image = $goods_images[0];
        $sku_images = $goods_images_list;

        $spec_attr_value = [];
        foreach (explode(' ', $selected_spec_names) as $item) {
            $spec_attr_value[] = explode(':', $item)[1];
        }
        $spec_attr_value = implode(' ', $spec_attr_value);
        $sku_name = $goods_info['goods_name'].' '.$spec_attr_value;

        $data = [
            'act_id' => "0",
            'activity' => null,
            'button_content' => $shop_info['button_content'], // 购买按钮显示内容
            'button_url' => null,
            'buy_enable' => ['code'=>1],
            'freight_id' => $goods_info['freight_id'],
            'gift_list' => [],
            'goods_audit' => $goods_info['goods_audit'],
            'goods_id' => $goods_info['goods_id'],
            'goods_image' => $goods_info['goods_image'],
            'goods_mix' => [],
            'goods_moq' => $goods_info['goods_moq'],
            'goods_number' => $default_sku['goods_number'],
            'goods_price' => $default_sku['goods_price'],
            'goods_price_format' => "￥".$default_sku['goods_price'],
            'goods_status' => $goods_info['goods_status'],
            'is_enable' => 1,
            'is_supply' => $shop_info['is_supply'],
            'market_price' => $default_sku['market_price'],
            'market_price_format' => "￥".$default_sku['market_price'],
            'order_act_id' => "0",
            'order_activity' => null,
            'original_number' => 2, // 商品表添加字段
            'original_price' => "1.00", // 商品表添加字段
            'original_price_format' => "￥1.00",
            'price_show' => ['code'=>1],
            'purchase_num' => 0,
            'rank_prices' => null,
            'sales_model' => $goods_info['sales_model'],
            'shop_id' => $goods_info['shop_id'],
            'show_content' => $shop_info['show_content'], // 店铺价格显示内容
            'show_price' => $shop_info['show_price'], // 店铺价格是否显示
            'sku_id' => $sku_id,
            'sku_image' => $sku_image,
            'sku_images' => $sku_images,
            'sku_name' => $sku_name,
            'spec_attr_value' => $spec_attr_value,
            'spec_ids' => $spec_ids,
            'start_price' => $shop_info['start_price'], // 起送金额
            'unit_name' => $goods_info['goods_unit'], // 商品单位id
            'user_discount' => "0",
        ];

        return result(0, $data);
    }
    public function changeLocation(Request $request)
    {
        $data = [
            'freight_fee' => 0,
            'freight_info' => '包邮',
            'limit_sale' => 0,
            'goods_number' => 12
        ];
        return result(0, $data);
    }

    public function comment(Request $request)
    {
        $sku_id = $request->get('sku_id');

        $render = view('goods.comment', compact('sku_id'))->render();
        return result(0, $render);
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
            'sortorder' => 'desc',
        ];
        list($self_pickup_list, $self_pickup_total) = $this->selfPickup->getList($condition);
        $render = view('goods.partials._self_pickup_list', compact('self_pickup_list'))->render();

        return result(0, $render);
    }
}