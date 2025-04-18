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
// | Description: 全部分类
// +----------------------------------------------------------------------

namespace App\Modules\Frontend\Http\Controllers;

use App\Models\Brand;
use App\Models\Goods;
use App\Models\Shop;
use App\Modules\Base\Http\Controllers\Frontend;
use App\Repositories\CategoryRepository;
use App\Repositories\CollectRepository;
use App\Repositories\GoodsRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class CategoryController extends Frontend
{

    protected $category; // 商品分类
    protected $goods;
    protected $collect;

    public function __construct(
        CategoryRepository $category
        ,GoodsRepository $goods
        ,CollectRepository $collect
    )
    {
        parent::__construct();

        $this->category = $category;
        $this->goods = $goods;
        $this->collect = $collect;
    }

    /**
     * 全部商品分类
     *
     * @param Request $request
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Throwable
     */
    public function index(Request $request)
    {
        $seo_title = '全部分类';
        $cat_id = $request->get('cat_id', 0);

        $list = get_goods_category_tree();
        $list = array_values($list);

        if (!empty($list)) {
            $cat_id = !empty($cat_id) ? $cat_id : array_first($list)['cat_id'];
        }
        if (!empty($list)) {
            foreach ($list as &$item) {
                $item['cat_image'] = get_image_url($item['cat_image'], 'goods_image');
            }
        }

        $compact = compact('seo_title', 'list', 'cat_id');


        if ($request->getHost() == config('lrw.mobile_domain')) {
            // 微信端 获取商品列表
            // 获取数据
            $params = $request->all();

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
            $pageSize = isset($size) ? $size : 20;
            $sortname = isset($sortname) ? $sortname : 1;
            $sortorder = isset($sortorder) ? $sortorder : 'DESC';
            $field = ['goods_id','goods_name','cat_id','shop_id','sku_id','sku_open','goods_price','market_price','mobile_price','give_integral','goods_number','warn_number','goods_image','brand_id','click_count','sale_num','comment_num','collect_num','is_best','is_new','is_hot','is_promote','freight_id','sales_model','goods_sort','last_time',
//            'shop_name','shop_type','is_supply','show_price','show_content','button_content', 'is_free', 'brand_name','button_url'
                'goods_freight_fee'
            ];
            $goods_total = $goodsQuery
                ->select($field)->count();
            $goods_list = $goodsQuery
                ->select($field)
                ->forPage($curPage, $pageSize)
                ->orderBy(get_goods_sort_array($sortname), $sortorder)
                ->get()->toArray();
            if (!empty($goods_list)) {
                foreach ($goods_list as &$v) {
                    $shop_info = Shop::where('shop_id',$v['shop_id'])
                        ->select(['shop_name','shop_type','is_supply','show_price','show_content','button_content','button_url'])
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
                    $v['cart_num'] = 0; // 该商品购物车数量
                }
            }

            // 分页
            $goods_page_array = frontend_pagination($goods_total,true);
            $goods_page_json = json_encode($goods_page_array);

            $compact = compact('seo_title', 'list', 'cat_id', 'goods_list','goods_total','goods_page_json');

            if ($request->ajax()) {
                $render = view('category.partials._goods_list', $compact)->render();
                return result(0,$render);
            }
        }

        $webData = []; // web端（pc、mobile）数据对象
        $data = [
            'app_prefix_data' => [
                'list' => $list,
                'cat_id' => $cat_id
            ],
            'app_suffix_data' => [],
            'web_data' => $webData,
            'compact_data' => $compact,
            'tpl_view' => 'category.index'
        ];
        $this->setData($data); // 设置数据
        return $this->displayData(); // 模板渲染及APP客户端返回数据
    }
}