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
// | Date:2019-04-07
// | Description: 店铺外卖风格控制器
// +----------------------------------------------------------------------

namespace App\Modules\Frontend\Http\Controllers\Theme;



use App\Models\ShopCategory;
use App\Modules\Base\Http\Controllers\Frontend;
use App\Repositories\CartRepository;
use App\Repositories\CollectRepository;
use App\Repositories\GoodsRepository;
use App\Repositories\ShopCategoryRepository;
use App\Repositories\ShopClassRepository;
use App\Repositories\ShopRepository;
use Illuminate\Http\Request;

class TakeoutController extends Frontend
{


    protected $shop;

    protected $shopClass;

    protected $collect;

    protected $shopCategory;

    protected $goods;

    protected $cart;


    public function __construct()
    {
        parent::__construct();

        $this->shop = new ShopRepository();
        $this->shopClass = new ShopClassRepository();
        $this->collect = new CollectRepository();
        $this->shopCategory = new ShopCategoryRepository();
        $this->goods = new GoodsRepository();
        $this->cart = new CartRepository();

    }


    public function shopHome(Request $request, $shop_id)
    {
        $keyword = $request->get('keyword','');
        $cat_id = $request->get('cat_id', 0);

        // 店铺信息
        $shop_info = $this->shop->shopInfo($shop_id);

//        $region_name = get_region_names_by_region_code($shop_info['shop']['region_code'], ' ');

        // 开店时长
//        $duration_time = calc_shop_duration($shop_info['shop']['open_time'],$shop_info['shop']['end_time']);

        // 是否收藏店铺
        $is_collect = false;
        if ($this->collect->checkIsCollected($this->user_id, 1, $shop_id)) {
            // 已收藏
            $is_collect = true;
        }

        $collect_count = $shop_info['shop']['collect_num'];

        // 店铺内一级分类
        $where = [];
        $where[] = ['is_show', 1];
        $where[] = ['shop_id', $shop_id];
        $where[] = ['parent_id', 0];
        $condition = [
            'where' => $where,
            'sortname' => 'cat_sort',
            'sortorder' => 'asc',
        ];
        list($shop_category, $total) = $this->shopCategory->getList($condition);

        // 店铺内二级分类
        $is_sub_cat = ShopCategory::where([['shop_id', $shop_id], ['cat_id', $cat_id]])->value('parent_id');

        $where = [];
        $where[] = ['is_show', 1];
        $where[] = ['shop_id', $shop_id];
        if (!$is_sub_cat) { // 一级分类
            $parent_id = $cat_id;
            $where[] = ['parent_id', $cat_id];
        } else {
            $parent_id = $is_sub_cat;
            $where[] = ['parent_id', $is_sub_cat];
        }
        $condition = [
            'where' => $where,
            'sortname' => 'cat_sort',
            'sortorder' => 'asc',
        ];
        list($sub_shop_category, $total) = $this->shopCategory->getList($condition);
//        dd($sub_shop_category);
        // 自由购功能是否开启
        $freebuy_enable = 1; // 0-关闭 1-开启

        // 商品列表
        // 查询条件
        $where = [];
        $where[] = ['goods_status',1]; // 商品状态 已发布
        $where[] = ['goods_audit',1]; // 审核通过
        if (!empty($keyword)) {
            $where[] = ['goods_name', 'like', "%{$keyword}%"];
        }
        $whereRaw = [];
        if ($cat_id > 0) { // todo 此次查询不正确 后期调整
            $whereRaw = [
                'field' => 'instr(`shop_cat_ids`, ?)',
                'condition' => [$cat_id]
            ];
        }
        // 列表
        $condition = [
            'where' => $where,
            'where_raw' => $whereRaw,
            'sortname' => 'goods_id',
            'sortorder' => 'desc'
        ];

        list($goods_list, $goods_total) = $this->goods->getList($condition, '', $this->user_id);
//        $pageHtml = frontend_pagination($goods_total);
        $goods_list = $goods_list->toArray();
//        dd($goods_list);
        $pageArr = frontend_pagination($goods_total, true);
//        $page_count = $pageArr['page_count'];
//        $cur_page = $pageArr['cur_page'];
        $page_json = json_encode($pageArr);


        $this->cart->setUserId($this->user_id);
//            $this->cart->setUniqueId(session()->getId());
        $this->cart->setUniqueId($this->session_id);
        $cart_list = $this->cart->getCartList(); // 购物车数据
        $cart_price_info = $this->cart->getCartPriceInfo($cart_list);

        $compact = compact('keyword', 'cat_id', 'parent_id', 'shop_info', 'is_collect',
            'collect_count', 'shop_category', 'sub_shop_category', 'freebuy_enable',
            'goods_list', 'page_json', 'cart_price_info');

        if ($request->ajax()) {
            $render = view('theme.takeout.partials._list', $compact)->render();

            return result(0, $render);
        }

        $this->show_seo('seo_shop',['name'=>$shop_info['shop']['shop_name']]); // SEO

        return view('theme.takeout.shop_home', $compact);
    }
}