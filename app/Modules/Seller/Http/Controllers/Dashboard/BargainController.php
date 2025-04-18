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
// | Date:2024-05-24
// | Description:砍价
// +----------------------------------------------------------------------

namespace App\Modules\Seller\Http\Controllers\Dashboard;

use App\Models\Freight;
use App\Models\Goods;
use App\Models\GoodsSku;
use App\Modules\Base\Http\Controllers\Seller;
use App\Repositories\ActivityCategoryRepository;
use App\Repositories\ActivityRepository;
use App\Repositories\BrandRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\GoodsActivityRepository;
use App\Repositories\GoodsRepository;
use App\Repositories\ShopCategoryRepository;
use App\Services\Enum\ActTypeEnum;
use Illuminate\Http\Request;

/**
 * 砍价管理
 * Class BargainController
 * @package App\Modules\Seller\Http\Controllers\Dashboard
 */
class BargainController extends Seller
{

    private $links = [
        ['url' => 'dashboard/bargain/list', 'text' => '店铺砍价活动列表'],
        ['url' => 'dashboard/bargain-order/list', 'text' => '砍价订单列表'],
        ['url' => 'dashboard/bargain/shop-activity-goods-list', 'text' => '店铺活动商品列表'],
        ['url' => 'dashboard/bargain/add', 'text' => '添加店铺砍价活动'],
        ['url' => 'dashboard/bargain/view', 'text' => '查看砍价活动'],
    ];

    protected $activity;
    protected $activityCategory;
    protected $goodsActivity;
    protected $goods;
    protected $category;
    protected $brand;
    protected $shopCategory;

    public function __construct(
        ActivityRepository $activity
        ,ActivityCategoryRepository $activityCategory
        ,GoodsActivityRepository $goodsActivity
        ,GoodsRepository $goods
        ,CategoryRepository $category
        ,BrandRepository $brand
        ,ShopCategoryRepository $shopCategory
    )
    {
        parent::__construct();

        $this->activity = $activity;
        $this->activityCategory = $activityCategory;
        $this->goodsActivity = $goodsActivity;

        $this->goods = $goods;
        $this->category = $category;
        $this->brand = $brand;
        $this->shopCategory = $shopCategory;

        $this->set_menu_select('dashboard', 'dashboard-center');
    }


    public function lists(Request $request)
    {
        $title = '砍价活动列表';
        $fixed_title = '营销中心 - '.$title;
        $this->sublink($this->links, 'dashboard/bargain/list', '', '', 'shop-activity-goods-list,add,view');

        $action_span = [
            [
                'id' => '',
                'url' => '/dashboard/center/index',
                'icon' => 'fa-reply',
                'text' => '返回营销中心'
            ],
            [
                'id' => '',
                'url' => 'add',
                'icon' => 'fa-plus',
                'text' => '添加砍价活动'
            ],
        ];

        $explain_panel = [
            '系统包含平台砍价活动和店铺砍价活动，平台砍价活动是平台方发起砍价规则，店铺选择商品参与；店铺砍价活动由店铺自行设置砍价规则和活动商品'
        ];
        $blocks = [
            'explain_panel' => $explain_panel,
            'fixed_title' => $fixed_title,
            'action_span' => $action_span
        ];

        $this->setLayoutBlock($blocks); // 设置block

        $params = $request->all();

        $where = [];
        $where[] = ['shop_id', seller_shop_info()->shop_id];
        $where[] = ['act_type', ActTypeEnum::ACT_TYPE_BARGAIN];

        // 搜索条件
        $search_arr = ['act_name','begin','end','act_status'];
        foreach ($search_arr as $v) {
            if (isset($params[$v]) && !empty($params[$v])) {

                if ($v == 'act_name') {
                    $where[] = ['act_name', 'like', "%{$params[$v]}%"];
                } else {
                    $where[] = [$v, $params[$v]];
                }
            }
        }
        // 列表
        $condition = [
            'where' => $where,
            'sortname' => 'act_id',
            'sortorder' => 'desc',
        ];
        // 列表
        list($list, $total) = $this->activity->getList($condition);

        $pageHtml = pagination($total);
        $page = frontend_pagination($total, true);

        if ($request->ajax()) {
            $render = view('dashboard.bargain.partials._list', compact('list', 'total', 'pageHtml'))->render();
            return result(0, $render);
        }

        // 获取数据

        $compact = compact('title', 'list', 'pageHtml');

        $webData = []; // web端（pc、mobile）数据对象
        $data = [
            'app_extra_data' => [],
            'app_prefix_data' => [
                'list' => $list,
                'page' => $page,
                'user_list' => [] // 活动创建人列表 筛选用
            ],
            'app_context_data' => $this->getAppContext(),
            'app_suffix_data' => [],
            'web_data' => $webData,
            'compact_data' => $compact,
            'tpl_view' => 'dashboard.bargain.list'
        ];
        $this->setData($data); // 设置数据
        return $this->displayData(); // 模板渲染及APP客户端返回数据
    }



    public function shopActivityGoodsList(Request $request)
    {
        $this->sublink($this->links, 'shop-activity-goods-list', '', '', 'dashboard/bargain-order/list,add,view');

        $act_id = $request->get('act_id');
        $activity = $this->activity->getById($act_id);

        $title = "活动#{$act_id}【{$activity->act_name}]】- 店铺活动商品列表";
        $fixed_title = '';

        $action_span = [
            [
                'id' => '',
                'url' => 'list',
                'icon' => 'fa-reply',
                'text' => '返回砍价活动列表'
            ],
//            [
//                'id' => 'btn_add_activity_goods',
//                'url' => 'javascript:void(0);',
//                'icon' => 'fa-plus',
//                'text' => '添加活动商品'
//            ],
        ];

        $explain_panel = [
            '<b>当前活动库存模式：SKU 级别，活动中同一规格的商品共享店铺设置的统一活动库存</b>',
            '活动的商品列表根据活动商品所属的店铺或者门店，以标签页的形式分开展示'
        ];
        $blocks = [
            'explain_panel' => $explain_panel,
            'fixed_title' => $fixed_title,
            'action_span' => $action_span
        ];

        $this->setLayoutBlock($blocks); // 设置block

        $params = $request->all();

        $shop_id = seller_shop_info()->shop_id;
        $where = [];
        $where[] = ['shop_id', $shop_id];
        $where[] = ['act_id', $act_id];
        // 搜索条件
        $search_arr = ['keyword_type','keyword','is_enable'];
        foreach ($search_arr as $v) {
            if (isset($params[$v]) && !empty($params[$v])) {

//                if ($v == 'act_name') {
//                    $where[] = ['act_name', 'like', "%{$params[$v]}%"];
//                } else {
//                    $where[] = [$v, $params[$v]];
//                }
            }
        }
        // 列表
        $condition = [
            'where' => $where,
            'sortname' => 'id',
            'sortorder' => 'desc',
        ];
        // 列表
        list($list, $total) = $this->goodsActivity->getList($condition);

        $pageHtml = pagination($total);
        $page = frontend_pagination($total, true);

        $compact = compact('title', 'list', 'total', 'pageHtml','act_id','activity');
        if ($request->ajax()) {
            $render = view('dashboard.bargain.partials._shop_activity_goods_list', $compact)->render();
            return result(0, $render);
        }

        // 获取数据

        $webData = []; // web端（pc、mobile）数据对象
        $data = [
            'app_extra_data' => [],
            'app_prefix_data' => [
                'title' => $title,
                'list' => $list,
                'page' => $page,
                'act_tag' => 0,
                'act_id' => $act_id,
                'shop_id' => $shop_id,
                'activity' => $activity,
                'search_shop_type' => '',
                'explain' => $explain_panel,
            ],
            'app_context_data' => $this->getAppContext(),
            'app_suffix_data' => [],
            'web_data' => $webData,
            'compact_data' => $compact,
            'tpl_view' => 'dashboard.bargain.shop_activity_goods_list'
        ];
        $this->setData($data); // 设置数据
        return $this->displayData(); // 模板渲染及APP客户端返回数据
    }

    public function addActivityGoods(Request $request)
    {
        if ($request->method() == 'POST') {
            // todo 处理添加活动商品 与添加活动类似

        }
        $act_id = $request->get('act_id', 0);
        $model = $this->activity->getById($act_id);
        if (empty($model)) {
            return result(0, "编号#{$act_id}不存在");
        }
        $start_time = date('Y-m-d H:i:s', time());
        $end_time = date("Y-m-d H:i:s",strtotime("+7 day"));

        // 获取数据
        $compact =[
            'act_price_type' => 0,
            'act_goods_type_list' => [
                '全部商品参与（包含出售中和已下架商品）',
                '全部出售中商品参与',
                '指定商品参与',
                '指定商品不参与',
            ],
            'act_price_type_list' => [
                "打折",
                "减价",
                "指定折扣价"
            ],
            'act_multistore_type_list' => [
                "全部门店",
                "指定分组下的门店",
                "指定门店"
            ],
            'is_open_multi_store' => '1',
            'model' => $model,
            'start_time' => $start_time,
            'end_time' => $end_time,
            'progress_key' => 'shop:activity:progress:info:8'
        ];
        $render = view('dashboard.bargain.add_activity_goods', $compact)->render();

        return result(0, $render);
    }

    /**
     *
     * @param Request $request
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function add(Request $request)
    {
        $title = '添加';

        $this->sublink($this->links, 'add', '', '', 'shop-activity-goods-list,dashboard/bargain-order/list,view');

        $model = null;
        $start_time = date('Y-m-d H:i:s', time());
        $end_time = date("Y-m-d H:i:s",strtotime("+7 day"));

        $fixed_title = '砍价 - '.$title;

        $action_span = [
            [
                'url' => 'list',
                'icon' => 'fa-reply',
                'text' => '返回店铺砍价活动列表'
            ],
        ];

        $explain_panel = [];
        $blocks = [
            'explain_panel' => $explain_panel,
            'fixed_title' => $fixed_title,
            'action_span' => $action_span
        ];

        $this->setLayoutBlock($blocks); // 设置block

        // 获取数据
        $shop_id = seller_shop_info()->shop_id;
        $freight_list = Freight::where('shop_id', $shop_id)->pluck('title', 'freight_id')->toArray();
        $freight_list = array_merge(["0" => "店铺统一运费"], $freight_list);

        $app_prefix_data =[
            'model' => $model,
            'act_goods_type_list' => [
                '全部商品参与（包含出售中和已下架商品）',
                '全部出售中商品参与',
                '指定商品参与',
                '指定商品不参与',
            ],
            'shop_id' => $shop_id,
            'is_open_multi_store' => false,
            'act_multistore_type_list' =>null,
            'start_time' => $start_time,
            'end_time' => $end_time,
            'progress_key' => "shop:activity:progress:info:{$shop_id}",
            'freight_list' => $freight_list
        ];

        $compact_data = $app_prefix_data;
        $compact_data['title'] = $title;

        $webData = []; // web端（pc、mobile）数据对象
        $data = [
            'app_extra_data' => [],
            'app_prefix_data' => $app_prefix_data,
            'app_context_data' => $this->getAppContext(),
            'app_suffix_data' => [],
            'web_data' => $webData,
            'compact_data' => $compact_data,
            'tpl_view' => 'dashboard.bargain.add'
        ];
        $this->setData($data); // 设置数据
        return $this->displayData(); // 模板渲染及APP客户端返回数据
    }

    public function edit(Request $request)
    {
        return $this->add($request);
    }

    /**
     * 保存信息
     *
     * @param Request $request
     * @return mixed
     */
    public function saveData(Request $request)
    {
        $post = $request->post();
        $postModel = $request->post('BargainModel');
        $shop_id = seller_shop_info()->shop_id;

//        dd($post);
        // 扩展数据
        $ext_info = [
            'bargain_time' => $postModel['bargain_time'],
            'all_goods_bargain_num' => $postModel['all_goods_bargain_num'],
            'one_goods_bargain_num' => $postModel['one_goods_bargain_num'],
            'help_bargain_num' => $postModel['help_bargain_num'],
            'virtual_min_part_num' => $postModel['virtual_min_part_num'],
            'virtual_max_part_num' => $postModel['virtual_max_part_num'],
        ];

        $new_item = [];
        foreach ($post['new_price_min'] as $k=>$v) {
            $new_item[] = [
                'new_price_min' => $v,
                'new_price_max' => $post['new_price_max'][$k],
                'new_bargain_min_price' => $post['new_bargain_min_price'][$k],
                'new_bargain_max_price' => $post['new_bargain_max_price'][$k],
            ];
        }
        $old_item = [];
        foreach ($post['old_price_min'] as $k=>$v) {
            $old_item[] = [
                'old_price_min' => $v,
                'old_price_max' => $post['old_price_max'][$k],
                'old_bargain_min_price' => $post['old_bargain_min_price'][$k],
                'old_bargain_max_price' => $post['old_bargain_max_price'][$k],
            ];
        }
        $ext_info['new_item'] = $new_item;
        $ext_info['old_item'] = $old_item;

        // 活动扩展数据
        $act_ext_info = [];

        $postModel['ext_info'] = $ext_info;
        $postModel['act_ext_info'] = $act_ext_info;
        $postModel['act_type'] = ActTypeEnum::ACT_TYPE_BARGAIN;

        $activityData = $postModel;
        $goodsActivityData = [];
        $goods_spu = $post['goods_spu'];
        $sku_ids = $post['sku_ids'];

        foreach ($goods_spu as $k=>$v) {
            $original_price = explode('-', $post['goods_spu_original_price'][$k])[1];
            $act_price = explode('-', $post['goods_spu_act_price'][$k])[1];
            $act_stock = explode('-', $post['goods_spu_act_stock'][$k])[1];
            $freight_id = explode('-', $post['goods_spu_freight_id'][$k])[1];
            $ratio = explode('-', $post['goods_spu_ratio'][$k])[1];
            $goodsActivityData[] = [
                'shop_id' => $shop_id,
                'sku_id' => $sku_ids[$k],
                'act_type' => ActTypeEnum::ACT_TYPE_BARGAIN,
                'goods_id' => $v,
//                'cat_id' => 0,
                'act_price' => $v,
                'act_stock' => $act_stock,
                'is_enable' => 1,
                'ext_info' => [
                    'original_price' => $original_price,
                    'act_price' => $act_price,
                    'act_stock' => $act_stock,
                    'freight_id' => $freight_id,
                    'self_bargain_ratio' => $ratio,
                ],
            ];
        }

        // 添加
        $activityData['shop_id'] = seller_shop_info()->shop_id;
        $activityData['create_user_id'] = seller_shop_info()->user_id;

        try {
            $ret = $this->activity->addActivity($activityData, $goodsActivityData);
        } catch (\Exception $e) {
            return result(-1, null, '砍价活动添加失败'.$e->getMessage());
        }
        $act_id = $ret->act_id;

        // success
        shop_log('砍价活动添加成功。ID：'.$act_id);
        return result(0, null, '砍价活动添加成功');
    }

    /**
     * 删除
     * @param Request $request
     * @return mixed
     */
    public function delete(Request $request)
    {
        $id = $request->post('id');
        $ret = $this->activity->deleteActivity(0, [$id]);

        if ($ret === false) {
            // Log
            shop_log('砍价删除失败。ID：'.$id);
            return result(-1, null, '删除失败');
        }

        // Log
        shop_log('砍价删除成功。ID：'.$id);
        return result(0, null, '删除成功');
    }

    public function batchDelete(Request $request)
    {
        $ids = $request->post('ids');
        $ret = $this->activity->deleteActivity(0, $ids);

        $ids = implode(',', $ids);
        if ($ret === false) {
            // Log
            shop_log('砍价删除失败。ID：'.$ids);
            return result(-1, '', '删除失败');
        }
        // Log
        shop_log('删除了多个砍价。ID：'.$ids);
        return result(0, '', '删除成功');
    }

    public function skuInfo(Request $request)
    {
        $uuid = make_uuid();
        $act_id = $request->post('act_id');
        $goods_id = $request->post('goods_id');
        //sku_original_price: 10-111,11-111,12-111
        //sku_act_price: 10-66,11-66,12-66
        //sku_act_stock: 10-44,11-44,12-44
        //sku_ratio: 10-0,11-0,12-0

        // sku_original_price: 59-80,60-80
        //sku_act_price: 59-50,60-50
        //sku_act_stock: 59-99,60-99
        //sku_ratio: 59-1,60-1

        $sku_original_price = $request->post('sku_original_price');
        $sku_act_price = $request->post('sku_act_price');
        $sku_act_stock = $request->post('sku_act_stock');
        $sku_ratio = $request->post('sku_ratio');
        $sku_original_price = explode(',', $sku_original_price);
        $sku_act_price = explode(',', $sku_act_price);
        $sku_act_stock = explode(',', $sku_act_stock);
        $sku_ratio = explode(',', $sku_ratio);
        $sku_original_price_arr = [];
        foreach ($sku_original_price as $v) {
            $v_arr = explode('-', $v);
            $sku_original_price_arr[$v_arr[0]] = $v_arr[1];
        }
        $sku_act_price_arr = [];
        foreach ($sku_act_price as $v) {
            $v_arr = explode('-', $v);
            $sku_act_price_arr[$v_arr[0]] = $v_arr[1];
        }
        $sku_act_stock_arr = [];
        foreach ($sku_act_stock as $v) {
            $v_arr = explode('-', $v);
            $sku_act_stock_arr[$v_arr[0]] = $v_arr[1];
        }
        $sku_ratio_arr = [];
        foreach ($sku_ratio as $v) {
            $v_arr = explode('-', $v);
            $sku_ratio_arr[$v_arr[0]] = $v_arr[1];
        }

        $params = [
            $sku_original_price_arr,
            $sku_act_price_arr,
            $sku_act_stock_arr,
            $sku_ratio_arr,
            $sku_original_price,
            $sku_act_price,
            $sku_act_stock,
            $sku_ratio
        ];


        $goods_info = Goods::where('goods_id', $goods_id)->first();
        if (!empty($goods_info)) {
            $goods_info = $goods_info->toArray();
        }
        $sku_list = GoodsSku::where([['goods_id', $goods_id],['checked',1]])
            ->select(['sku_id','goods_id','spec_names','goods_price','checked'])->get()
            ->each(function ($item) {

            })->toArray();
        $extra =[
            'params' => $params
        ];
        $compact = compact('uuid','goods_info','sku_list', 'params',
            'sku_original_price', 'sku_act_price','sku_act_stock', 'sku_ratio'
        );
        $render = view('dashboard.bargain.sku_info', $compact)->render();

        return result(0, $render, '', $extra);
    }

    /**
     * 商品选择器
     *
     * @param Request $request
     * @return mixed
     * @throws \Throwable
     */
    public function picker(Request $request)
    {
        $page_id = make_uuid();
        $pagination_id = $request->post('page')['page_id'];
        $pagination_id = str_replace('#', '', $pagination_id);
        $output = $request->post('output');
        $left = $request->post('left');
        $right = $request->post('right');
        $goods_status = $request->post('goods_status', 1); // 商品状态
        $is_sku = $request->post('is_sku', 0); //
        $is_supply = $request->post('is_supply', null); //
        $show_store = $request->post('show_store', 0); //
        $is_enable = $request->post('is_enable', 1); //
        $goods_audit = $request->post('goods_audit', 1); //
        $goods_ids = $request->post('goods_ids', []);
        if (!is_array($goods_ids)) {
            $goods_ids = [$goods_ids];
        }
        $sku_ids = $request->post('sku_ids', []);

        // 商品列表
        $where[] = ['shop_id', seller_shop_info()->shop_id];
        $where[] = ['goods_status', $goods_status];
//        $where[] = ['is_sku', $is_sku];
//        $where[] = ['show_store', $show_store];
//        $where[] = ['is_enable', $is_enable];
        $where[] = ['goods_audit', $goods_audit];

        $whereIn = [];

        $tpl = 'picker';
        if (!$output) {
            // ajax 输出文章列表
            $tpl = 'partials._picker_goods_list';
//            if (!empty($selected_ids)) {
//                $whereIn = [
//                    'field' => 'article_id',
//                    'condition' => $selected_ids
//                ];
//            }
        }


        $condition = [
            'where' => $where,
            'in' => $whereIn,
            'sortname' => 'goods_id',
            'sortorder' => 'desc'
        ];
        list($list, $total) = $this->goods->getList($condition);
        $pageHtml = short_pagination($total, 5);

        // 查询商品分类列表（树形）
        $where = [];
        $where[] = ['is_show',1];
        $condition = [
            'where' => $where,
            'limit' => 0, // 不分页
            'sortname' => 'created_at',
            'sortorder' => 'asc',
        ];
        list($category_list, $category_total) = $this->category->getList($condition, '', false, true);

        // 查询品牌
        $where = [];
        $where[] = ['is_show',1];
        $condition = [
            'where' => $where,
            'sortname' => 'brand_id',
            'sortorder' => 'desc',
            'field' => ['brand_id', 'brand_name']
        ];
        list($brand_list, $brand_total) = $this->brand->getList($condition);

        // 店铺内分类列表
        $shop_cat_list = $this->shopCategory->getShopCategoryList(seller_shop_info()->shop_id);

        $compact = compact(
            'page_id', 'pagination_id', 'list', 'pageHtml',
            'sku_ids', 'goods_ids', 'category_list',
            'brand_list', 'shop_cat_list');
        $render = view('dashboard.bargain.'.$tpl, $compact)->render();
        return result(0, $render);
    }

    /**
     * 选中商品时 异步加载商品信息
     *
     * @param Request $request
     * @return array
     * @throws \Throwable
     */
    public function goodsInfo(Request $request)
    {
        $goods_id = $request->post('goods_id');
        $price_mode = $request->post('price_mode'); // 价格模式 0-统一套餐价 1-自定义规格价

        $goods_info = Goods::where('goods_id', $goods_id)
//            ->select(['goods_id','goods_price','goods_number','goods_name'])
            ->first()->toArray();
        if (empty($goods_info)) {
            return result(-1, null, '商品ID无效');
        }
        if ($goods_info['goods_number'] <= 0) {
            return result(-1, null, '该商品库存不足，不可选择！');
        }

        $sku_list = GoodsSku::where([['goods_id', $goods_id],['checked',1]])
            ->select(['sku_id','goods_number','goods_price'])->get()
            ->each(function ($item) {
                $item->act_stock = $item->goods_number;
                $item->act_stock_init = 0;
            })->toArray();

        $price_arr = array_column($sku_list, 'goods_price');
        $min_price = min($price_arr);
        $max_price = max($price_arr);
        if ($min_price == $max_price) {
            $goods_price = $min_price;
            $goods_price_format = '￥'.$min_price;
        } else {
            $goods_price = "{$min_price}-{$max_price}";
            $goods_price_format = "￥{$min_price}-￥{$max_price}";
        }

        $sku_ids = implode(',', array_column($sku_list, 'sku_id'));
        $goods_info['act_stock'] = array_sum(array_column($sku_list, 'act_stock'));
        $goods_info['act_stock_init'] = array_sum(array_column($sku_list, 'act_stock_init'));
        $goods_info['original_price_val'] = '0-0';
        $goods_info['act_price_val'] = '0-0';
        $goods_info['ratio_val'] = '0-0';
        $goods_info['goods_price_format'] = $goods_price_format;
        $goods_info['sku_num'] = count($sku_list);
        $goods_info['min_price'] = $min_price;
        $goods_info['max_price'] = $max_price;

        $goods_spu_price = [];
        $goods_spu_stock = [];
        foreach ($sku_list as $item) {
            $goods_spu_price[] = $item['sku_id'].'-0';
            $goods_spu_stock[] = $item['sku_id'].'-'.$item['goods_number'];
        }
        $goods_spu_price_str = implode(',', $goods_spu_price);
        $goods_spu_stock_str = implode(',', $goods_spu_stock);
        $goods_info['goods_spu_original_price'] = $goods_spu_price_str;
        $goods_info['goods_spu_act_price'] = $goods_spu_price_str;
        $goods_info['goods_spu_act_stock'] = $goods_spu_stock_str;
        $goods_info['goods_spu_freight_id'] = $goods_spu_price_str;
        $goods_info['goods_spu_ratio'] = $goods_spu_price_str;

        // 查询活动分类列表（树形）
        $where = [];
        $where[] = ['is_show',1];
        $condition = [
            'where' => $where,
            'limit' => 0, // 不分页
            'sortname' => 'created_at',
            'sortorder' => 'desc',
        ];
        list($category_list, $category_total) = $this->activityCategory->getList($condition, '', false, true);

        $render = view('dashboard.bargain.goods_info', compact('goods_info', 'category_list', 'price_mode', 'goods_price', 'sku_ids', 'sku_list'))->render();
        $extra = [
            'act_id' => 0,
            'act_sku_list' => [],
            'goods' => $goods_info,
            'sku_list' => $sku_list,
        ];

        return result(0, $render, $extra);
    }

    /**
     * 选中商品时 异步加载商品信息
     *
     * @param Request $request
     * @return array
     * @throws \Throwable
     */
//    public function batchGoodsInfo(Request $request)
//    {
//        $goods_ids = $request->post('goods_ids', []);
//        $act_id = $request->post('act_id');
//
//        if (empty($goods_ids)) {
//            return result(-1, null, INVALID_PARAM);
//        }
//        $goods_id = array_first($goods_ids);
//        $goods_info = Goods::where('goods_id', $goods_id)
//            ->select(['goods_id','sku_id','goods_price','goods_number','goods_name','goods_sn','goods_barcode','sku_open'])->first();
//        $goods_sku_list = GoodsSku::where([['goods_id', $goods_id],['checked',1]])
//            ->select(['sku_id','goods_number','goods_price'])->get()->toArray();
//        $price_arr = array_column($goods_sku_list, 'goods_price');
//        $min_price = min($price_arr);
//        $max_price = max($price_arr);
//        if ($min_price == $max_price) {
//            $goods_price = $min_price;
//        } else {
//            $goods_price = "￥{$min_price}-￥{$max_price}";
//        }
//        $sku_ids = array_column($goods_sku_list, 'sku_id');
//        if (empty($goods_info)) {
//            return result(-1, null, '商品ID无效');
//        }
//        if ($goods_info->goods_number <= 0) {
//            return result(-1, null, '该商品库存不足，不可选择！');
//        }
//        $render = view('dashboard.bargain.batch_goods_info', compact('goods_info', 'price_mode', 'goods_price', 'sku_ids'))->render();
//        return result(0, $render, '', ['unstock_goods_ids'=>[]]);
//    }


    public function editActInfo(Request $request)
    {
        $ret = $this->activity->editInfo($request);
        if ($ret === false) {
            return result(-1, null);
        }
        return result(0, null);
    }

}