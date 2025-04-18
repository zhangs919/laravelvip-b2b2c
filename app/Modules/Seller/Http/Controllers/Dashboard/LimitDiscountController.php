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
// | Date:2019-1-13
// | Description:
// +----------------------------------------------------------------------

namespace App\Modules\Seller\Http\Controllers\Dashboard;

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
 * 限时折扣管理
 *
 * Class LimitDiscountController
 * @package app\Modules\Seller\Http\Controllers\Dashboard
 */
class LimitDiscountController extends Seller
{

    private $links = [
        ['url' => 'dashboard/limit-discount/list', 'text' => '限时折扣活动列表'],
        ['url' => 'dashboard/limit-discount/shop-activity-goods-list', 'text' => '店铺活动商品列表'],
        ['url' => 'dashboard/limit-discount/add', 'text' => '添加'],
        ['url' => 'dashboard/limit-discount/edit', 'text' => '编辑'],
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
        $title = '限时折扣活动列表';
        $fixed_title = '营销中心 - '.$title;

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
                'text' => '添加限时折扣'
            ],
        ];

        $explain_panel = [
            '商家可在某一特定时期，设置指定商品打折促销，用以刺激消费者购买，以此提升销售业绩',
            '当一个商品同时参加了会员折扣、限时折扣时，下单时以两者中最优惠的活动结算，不会『折上折』',
            '排序控制限时折扣在前台活动页面展示顺序，排序越小，越优先展示，如果排序相同，则后添加的活动优先展示',
            '虚拟商品参与限时折扣活动'
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
        list($list, $total) = $this->activity->getLimitDiscountActivityList($where);

        $pageHtml = pagination($total);
        $page = frontend_pagination($total, true);

        if ($request->ajax()) {
            $render = view('dashboard.limit-discount.partials._list', compact('list', 'total', 'pageHtml'))->render();
            return result(0, $render);
        }

        // 获取数据

        $compact = compact('title', 'list', 'pageHtml');

        $webData = []; // web端（pc、mobile）数据对象
        $data = [
            'app_extra_data' => [],
            'app_prefix_data' => [
                'list' => $list,
                'page' => $page
            ],
            'app_context_data' => $this->getAppContext(),
            'app_suffix_data' => [],
            'web_data' => $webData,
            'compact_data' => $compact,
            'tpl_view' => 'dashboard.limit-discount.list'
        ];
        $this->setData($data); // 设置数据
        return $this->displayData(); // 模板渲染及APP客户端返回数据
    }

    public function shopActivityGoodsList(Request $request)
    {
        $this->sublink($this->links, 'shop-activity-goods-list', '', '', 'add,edit');

        $act_id = $request->get('act_id');
        $activity = $this->activity->getById($act_id);

        $title = "活动#{$act_id}【{$activity->act_name}]】- 店铺活动商品列表";
        $fixed_title = '';

        $action_span = [
            [
                'id' => '',
                'url' => 'list',
                'icon' => 'fa-reply',
                'text' => '返回限时折扣活动列表'
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
            $render = view('dashboard.limit-discount.partials._shop_activity_goods_list', $compact)->render();
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
            'tpl_view' => 'dashboard.limit-discount.shop_activity_goods_list'
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
        $render = view('dashboard.limit-discount.add_activity_goods', $compact)->render();

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

        $id = $request->get('id', 0);
        $this->sublink($this->links, 'add', '', '', 'shop-activity-goods-list,edit');

        $model = [
            'sort' => 255,
            'user_range' => 0,
            'act_multistore_type' => 0,
        ];
        $start_time = date('Y-m-d H:i:s', time());
        $end_time = date("Y-m-d H:i:s",strtotime("+7 day"));

        $goods_list = [];

        if ($id) {
            // 更新操作
            $model = $this->activity->getById($id, ['sort','act_id','act_name','act_title','act_img','start_time','end_time','purchase_num','shop_id','ext_info']);
            if (empty($model)) {
                // fail
                flash('error', "编号#{$id}不存在");
                return redirect('/dashboard/limit-discount/list');
            }
            $model = $model->toArray();
//            $timepicker = null;
//            $week = [
//                ''
//            ];
//            $week_string = null;
//            $goods_list = $this->activity->getLimitDiscountGoodsActivityList($id); // 商品列表

            $title = '编辑';
            $this->sublink($this->links, 'edit', '', '', 'add');
        }

        $fixed_title = '限时折扣 - '.$title;

        $action_span = [
            [
                'url' => 'list',
                'icon' => 'fa-reply',
                'text' => '返回限时折扣列表'
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
        $app_prefix_data =[
            'timepicker' =>$timepicker ?? null,
            'week' =>$week ?? null,
            'week_string' =>$week_string ?? null,
            'act_price_type' => $act_price_type ?? 0,
            'act_discount'=>null,
            'act_mark_down'=>null,
            'act_price'=>null,
            'act_stock'=>0,
            'no_join_goods_list'=>null,
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
            'store_list' =>null,
            'select_store_ids' =>'',
            'select_group_list' =>null,
            'select_group_ids' =>'',
            'group_list' => [], // 门店分组
            'model' => $model,
            'start_time' => $start_time,
            'end_time' => $end_time
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
            'tpl_view' => 'dashboard.limit-discount.add'
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
        $postModel = $request->post('LimitDiscountModel');
        $shop_id = seller_shop_info()->shop_id;

        // 活动扩展数据
        $ext_info['act_repeat'] = $postModel['act_repeat'];
        $ext_info['act_label'] = $postModel['act_label'];

        if ($postModel['act_repeat'] == 1) { // 周期重复
            $ext_info['timepicker'] = $post['timepicker'];
            // 0-每天 1-每周 2-每月
            if ($post['timepicker'] == 0) {
                $ext_info['day_hour'] = $post['day_hour'];
            } elseif($post['timepicker'] == 1) {
                $ext_info['week_hour'] = $post['week_hour'];
            } elseif ($post['timepicker'] == 2) {
                $ext_info['month_day'] = $post['month_day'];
                $ext_info['month_hour'] = $post['month_hour'];
            }
        } else {
            // 不重复 清空周期重复数据 ?? todo
            $ext_info['cycle_data'] = $post['cycle_data'];
        }

        $ext_info['limit_type'] = $post['limit_type']; // 限购设置 每人限购N件
        if ($post['limit_type'] == 1) { // 限购
            $ext_info['limit_num_1'] = $post['limit_num_1'];
        } else {
            $ext_info['limit_num'] = 0;
        }
        $postModel['ext_info'] = $ext_info;
        $postModel['act_type'] = ActTypeEnum::ACT_TYPE_LIMIT_DISCOUNT; // 11-限时折扣
        //"ext_info" => array:4 [
        //    "act_repeat" => "0"
        //    "timepicker" => "0"
        //    "act_label" => "标签"
        //    "limit_type" => "0"
        //  ]
//        {\"act_repeat\":0,\"cycle_data\":{\"type\":\"-1\"},\"act_label\":\"\标\签1\",\"limit_type\":\"0\",\"limit_num\":0}
        $activityData = $postModel;
        $goodsActivityData = [];

        if ($postModel['use_range'] == 1) {
            // 指定商品
            $goodsActivityData = [];
            foreach ($post['goods_spu'] as $k=>$v) {
                $goods_id = $v;
                // 折扣（折）
                $discount_str = $post['goods_spu_discount'][$k];
                if ($discount_str) {
                    $discount_arr = explode('-', $discount_str);
                    $discount = $discount_arr[1]; // 折扣
                    $sku_id = $discount_arr[0];
                    $goods_sku = GoodsSku::where('sku_id', $sku_id)->select(['sku_id', 'goods_price', 'goods_number'])->first();
                    $act_price = round($goods_sku->goods_price * ($discount/10), 2);
                    $discount_mode = 0;
                    $discount_num = $discount;
                }

                // 减价（元）
                $reduce_str = $post['goods_spu_reduce'][$k];
                if ($reduce_str) {
                    $reduce_arr = explode('-', $reduce_str);
                    $reduce = $reduce_arr[1]; // 减价
                    $sku_id = $reduce_arr[0];
                    $goods_sku = GoodsSku::where('sku_id', $sku_id)->select(['sku_id', 'goods_price', 'goods_number'])->first();
                    $act_price = $goods_sku->goods_price - $reduce;
                    $discount_mode = 1;
                    $discount_num = $reduce;
                }

                // 指定折扣价（元）
                $set_str = $post['goods_spu_set'][$k];
                if ($set_str) {
                    $set_arr = explode('-', $set_str);
                    $set = $set_arr[1]; // 指定折扣价
                    $sku_id = $set_arr[0];
                    $act_price = $set;
                    $discount_mode = 2;
                    $discount_num = $set;
                }

                $stock_str = $post['goods_spu_stock'][$k];
                $stock_arr = explode('-', $stock_str);
                $stock = $stock_arr[1]; // 库存

                $goodsActivityData[] = [
                    'shop_id' => $shop_id,
                    'sku_id' => $sku_id,
                    'act_type' => ActTypeEnum::ACT_TYPE_LIMIT_DISCOUNT,
                    'goods_id' => $goods_id,
                    'cat_id' => 0, // 限时折扣活动 没有分类
                    'act_price' => $act_price,
                    'act_stock' => $stock,
                    'is_enable' => 1,
                    'ext_info' => [
                        'discount_mode' => $discount_mode,
                        'discount_num' => $discount_num
                    ],
                ];
            }
        }

        if (!empty($postModel['act_id'])) {
            // 编辑
            try {
                $ret = $this->activity->modifyActivity($activityData);
            } catch (\Exception $e) {
                return result(-1, null, '限时折扣编辑失败'.$e->getMessage());
            }
            $msg = '限时折扣编辑';
            $act_id = $postModel['act_id'];
        }else {
            // 添加
            $activityData['shop_id'] = seller_shop_info()->shop_id;
            $activityData['create_user_id'] = seller_shop_info()->user_id;
            try {
                $ret = $this->activity->addActivity($activityData, $goodsActivityData);
            } catch (\Exception $e) {
                return result(-1, null, '限时折扣添加失败'.$e->getMessage());
            }
            $msg = '限时折扣添加';
            $act_id = @$ret->act_id;
        }

        // success
        shop_log($msg.'成功。ID：'.$act_id);
        return result(0, null, $msg.'成功');
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
            shop_log('限时折扣删除失败。ID：'.$id);
            return result(-1, null, '删除失败');
        }

        // Log
        shop_log('限时折扣删除成功。ID：'.$id);
        return result(0, null, '删除成功');
    }

    public function batchDelete(Request $request)
    {
        $ids = $request->post('ids');
        $ret = $this->activity->deleteActivity(0, $ids);

        $ids = implode(',', $ids);
        if ($ret === false) {
            // Log
            shop_log('限时折扣删除失败。ID：'.$ids);
            return result(-1, '', '删除失败');
        }
        // Log
        shop_log('删除了多个限时折扣。ID：'.$ids);
        return result(0, '', '删除成功');
    }

    public function skuInfo(Request $request)
    {
        $render = view('dashboard.limit-discount.sku_info')->render();

        return result(0, $render);
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
        $render = view('dashboard.limit-discount.'.$tpl, $compact)->render();
        return result(0, $render);
    }

    /**
     * 选中商品时 异步加载商品信息
     *
     * @param Request $request
     * @return array
     * @throws \Throwable
     */
//    public function goodsInfo(Request $request)
//    {
//        $goods_id = $request->post('goods_id');
//        $price_mode = $request->post('price_mode'); // 价格模式 0-统一套餐价 1-自定义规格价
//
////        $goods_info = Goods::where('goods_id',$goods_id)->first();
//        $goods_info = Goods::where('goods_id', $goods_id)
//            ->select(['goods_id','goods_price','goods_number','goods_name'])->first();
//        $goods_sku_list = GoodsSku::where([['goods_id', $goods_id],['checked',1]])
//            ->select(['sku_id','goods_number','goods_price'])->get()->toArray();
//        $goods_price = [];
//        $price_arr = array_column($goods_sku_list, 'goods_price');
//        $min_price = min($price_arr);
//        $max_price = max($price_arr);
//        if ($min_price == $max_price) {
//            $goods_price = $min_price;
//        } else {
//            $goods_price = "￥{$min_price}-￥{$max_price}";
//        }
//
//        $sku_ids = implode(',', array_column($goods_sku_list, 'sku_id'));
//
//
//
//        if (empty($goods_info)) {
//            return result(-1, null, '商品ID无效');
//        }
//        if ($goods_info->goods_number <= 0) {
//            return result(-1, null, '该商品库存不足，不可选择！');
//        }
//
//        // 查询活动分类列表（树形）
//        $where = [];
//        $where[] = ['is_show',1];
//        $condition = [
//            'where' => $where,
//            'limit' => 0, // 不分页
//            'sortname' => 'created_at',
//            'sortorder' => 'desc',
//        ];
//        list($category_list, $category_total) = $this->activityCategory->getList($condition, '', false, true);
//
//        $render = view('dashboard.limit-discount.goods_info', compact('goods_info', 'category_list', 'price_mode', 'goods_price', 'sku_ids'))->render();
//        return result(0, $render, '');
//    }

    /**
     * 选中商品时 异步加载商品信息
     *
     * @param Request $request
     * @return array
     * @throws \Throwable
     */
    public function batchGoodsInfo(Request $request)
    {
        $goods_ids = $request->post('goods_ids', []);
        $act_id = $request->post('act_id');
        $is_join = $request->post('is_join');

        if (empty($goods_ids)) {
            return result(-1, null, INVALID_PARAM);
        }
        $goods_id = array_first($goods_ids);
        $goods_info = Goods::where('goods_id', $goods_id)
            ->select(['goods_id','sku_id','goods_price','goods_number','goods_name','goods_sn','goods_barcode','sku_open'])->first();
        $goods_sku_list = GoodsSku::where([['goods_id', $goods_id],['checked',1]])
            ->select(['sku_id','goods_number','goods_price'])->get()->toArray();
        $price_arr = array_column($goods_sku_list, 'goods_price');
        $min_price = min($price_arr);
        $max_price = max($price_arr);
        if ($min_price == $max_price) {
            $goods_price = $min_price;
        } else {
            $goods_price = "￥{$min_price}-￥{$max_price}";
        }
        $sku_ids = array_column($goods_sku_list, 'sku_id');
        if (empty($goods_info)) {
            return result(-1, null, '商品ID无效');
        }
        if ($goods_info->goods_number <= 0) {
            return result(-1, null, '该商品库存不足，不可选择！');
        }
        $render = view('dashboard.limit-discount.batch_goods_info', compact('goods_info', 'price_mode', 'goods_price', 'sku_ids', 'is_join'))->render();
        return result(0, $render, '', ['unstock_goods_ids'=>[]]);
    }


    public function editActInfo(Request $request)
    {
        $ret = $this->activity->editInfo($request);
        if ($ret === false) {
            return result(-1, null);
        }
        return result(0, null);
    }

}