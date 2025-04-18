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

use App\Models\ActivityCategory;
use App\Models\Goods;
use App\Models\GoodsActivity;
use App\Models\GoodsSku;
use App\Modules\Base\Http\Controllers\Seller;
use App\Repositories\ActivityCategoryRepository;
use App\Repositories\ActivityRepository;
use App\Repositories\BrandRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\GoodsRepository;
use App\Repositories\ShopCategoryRepository;
use App\Services\Enum\ActTypeEnum;
use Illuminate\Http\Request;

/**
 * 拼团管理
 *
 * Class GoodsMixController
 * @package app\Modules\Seller\Http\Controllers\Dashboard
 */
class FightGroupController extends Seller
{

    private $links = [
        ['url' => 'dashboard/fight-group/list', 'text' => '拼团活动列表'],
        ['url' => 'dashboard/groupon-order/list', 'text' => '拼团订单列表'],
        ['url' => 'dashboard/fight-group/add', 'text' => '添加'],
        ['url' => 'dashboard/fight-group/view', 'text' => '拼团详情'],
    ];

    protected $activity;
    protected $activityCategory;
    protected $goods;
    protected $category;
    protected $brand;
    protected $shopCategory;

    public function __construct(
        ActivityRepository $activity
        ,ActivityCategoryRepository $activityCategory
        ,GoodsRepository $goods
        ,CategoryRepository $category
        ,BrandRepository $brand
        ,ShopCategoryRepository $shopCategory
    )
    {
        parent::__construct();

        $this->activity = $activity;
        $this->activityCategory = $activityCategory;
        $this->goods = $goods;
        $this->category = $category;
        $this->brand = $brand;
        $this->shopCategory = $shopCategory;

        $this->set_menu_select('dashboard', 'dashboard-center');
    }


    public function lists(Request $request)
    {
        $title = '列表';
        $fixed_title = '营销中心 - '.$title;
        $this->sublink($this->links, 'dashboard/fight-group/list', '', '', 'add,view');

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
                'text' => '添加拼团活动'
            ],
        ];

        $explain_panel = [
            '什么是拼团？  买家以拼团价格购买商品，第一个支付成功的立即成为团长，并且邀请朋友组团购买，在规定时间内达到拼团人数即为组团成功，否则组团失败。主要流程：买家选择心仪商品——支付开团或参团——邀请好友参团——达到人数拼团成功',
            '成团条件：团有效期内达到拼团人数，拼团成功；若在有效期内未达到成团人数，本次拼团失败，订单关闭并自动退款',
            '活动范围：拼团商品使用拼团方式支付时不支持会员折扣；不支持满减/赠、优惠券、优惠活动等',
            '活动编辑条件：活动开始前，可修改各项拼团活动信息',
            '拼团失败：a. 有效期内未成团；b. 商品售罄。在以上2种情况下，拼团失败，订单关闭并自动退款',
            '活动结束后，已经创建的拼团或已付款未发货的订单仍然有效',
            '虚拟商品不参与拼团活动'
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
        $where[] = ['act_type', ActTypeEnum::ACT_TYPE_FIGHT_GROUP]; // 6-拼团

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
            $render = view('dashboard.fight-group.partials._list', compact('list', 'total', 'pageHtml'))->render();
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
            'tpl_view' => 'dashboard.fight-group.list'
        ];
        $this->setData($data); // 设置数据
        return $this->displayData(); // 模板渲染及APP客户端返回数据
    }

    public function add(Request $request)
    {
        $title = '添加';

        $id = $request->get('id', 0);
        $this->sublink($this->links, 'add', '', '', 'dashboard/groupon-order/list,view');

        $fixed_title = '拼团活动 - '.$title;

        $action_span = [
            [
                'url' => 'list',
                'icon' => 'fa-reply',
                'text' => '返回拼团活动列表'
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
        $model = [
            'sort' => 255
        ];
        $start_time = date('Y-m-d H:i:s', time());
        $end_time = date("Y-m-d H:i:s",strtotime("+7 day"));
        $cat_list = $this->activityCategory->getCateData(); //拼团活动分类

        $compact = compact('title', 'model', 'start_time', 'end_time', 'cat_list');

        $webData = []; // web端（pc、mobile）数据对象
        $data = [
            'app_extra_data' => [],
            'app_prefix_data' => [
                'model' => $model,
                'start_time' => $start_time,
                'end_time' => $end_time,
                'cat_list' => $cat_list
            ],
            'app_context_data' => $this->getAppContext(),
            'app_suffix_data' => [],
            'web_data' => $webData,
            'compact_data' => $compact,
            'tpl_view' => 'dashboard.fight-group.add'
        ];
        $this->setData($data); // 设置数据
        return $this->displayData(); // 模板渲染及APP客户端返回数据
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
        $postModel = $request->post('FightGroupModel');
        $shop_id = seller_shop_info()->shop_id;

        // 扩展数据
        $ext_info = [
            'act_price' => $post['act_price'],
            'first_discount' => $post['first_discount'],
            'discount_price' => null,
            'act_stock' => $post['act_stock'],
            'sku_ids' => array_keys($post['act_price'])
        ];

        // 活动扩展数据
        $act_ext_info = [
            'groupon_mode' => $postModel['groupon_mode'],
            'fight_num' => $postModel['fight_num'],
            'fight_time' => $postModel['fight_time'],
            'fight_time_unit' => $postModel['fight_time_unit'],
            'is_gather' => $postModel['is_gather'],
            'is_imitate' => $postModel['is_imitate'],
            'is_commander_discount' => $postModel['is_commander_discount'],
            'discount_over_used' => $postModel['discount_over_used'],
            'groupon_rule' => $postModel['groupon_rule'],
        ];

        $postModel['ext_info'] = $ext_info;
        $postModel['act_ext_info'] = $act_ext_info;
        $postModel['act_type'] = ActTypeEnum::ACT_TYPE_FIGHT_GROUP; // 6-拼团

        $activityData = $postModel;
        $goodsActivityData = [];
        foreach ($post['act_price'] as $k=>$v) {
            $act_stock = $post['act_stock'][$k];
            $goodsActivityData[] = [
                'shop_id' => $shop_id,
                'sku_id' => $k,
                'act_type' => ActTypeEnum::ACT_TYPE_FIGHT_GROUP,
                'goods_id' => $post['goods_id'],
                'cat_id' => $postModel['cat_id'],
                'act_price' => $v,
                'act_stock' => $act_stock,
                'is_enable' => 1,
                'ext_info' => [],
            ];
        }

        // 添加
        $activityData['shop_id'] = $shop_id;
        $activityData['create_user_id'] = seller_shop_info()->user_id;

        try {
            $ret = $this->activity->addActivity($activityData, $goodsActivityData);
        } catch (\Exception $e) {
            return result(-1, null, '拼团活动添加失败'.$e->getMessage());
        }
        $act_id = $ret->act_id;

        // success
        shop_log('拼团活动添加成功。ID：'.$act_id);
        return result(0, null, '拼团活动添加成功');
    }


    public function view(Request $request)
    {
        $title = '拼团详情';

        $id = $request->get('id', 0);
        $this->sublink($this->links, 'view', '', '', 'dashboard/groupon-order/list,add');
        $fixed_title = '拼团活动 - '.$title;

        $action_span = [
            [
                'url' => 'list',
                'icon' => 'fa-reply',
                'text' => '返回拼团活动列表'
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
        $cat_id = GoodsActivity::where('act_id', $id)->value('cat_id');
        $cat_name = ActivityCategory::where('id', $cat_id)->value('cat_name');
        $model = $this->activity->getById($id);
        $model = $model->toArray();
        $goods_id = GoodsSku::whereIn('sku_id', array_keys($model['ext_info']['act_price']))->value('goods_id');
        $goods_info = Goods::where('goods_id', $goods_id)->first()->toArray(); // 拼团商品信息
        $sku_ext = $model['ext_info'];
        $sku_list = $this->goods->getSkuList($goods_id);
        $sku_list = $sku_list->toArray();
//        dd($model);

        $compact = compact('title', 'cat_name','model', 'goods_info','sku_ext',
        'sku_list','is_commander_discount','is_view');

        $webData = []; // web端（pc、mobile）数据对象
        $data = [
            'app_extra_data' => [],
            'app_prefix_data' => [
                'cat_name' => $cat_name,
                'model' => $model,
                'goods_info' => $goods_info,
                'sku_ext' => $sku_ext,
                'sku_list' => $sku_list,
                'is_commander_discount' => $model['act_ext_info']['is_commander_discount'],
                'is_view' => 1,
            ],
            'app_context_data' => $this->getAppContext(),
            'app_suffix_data' => [],
            'web_data' => $webData,
            'compact_data' => $compact,
            'tpl_view' => 'dashboard.fight-group.view'
        ];
        $this->setData($data); // 设置数据
        return $this->displayData(); // 模板渲染及APP客户端返回数据
    }

    /**
     * 删除
     * @param Request $request
     * @return mixed
     */
    public function delete(Request $request)
    {
        $id = $request->post('id');
        $ret = $this->activity->del($id);

        if ($ret === false) {
            // Log
            return result(-1, null, '删除失败');
        }

        // Log
        return result(0, null, '删除成功');
    }

    public function batchDelete(Request $request)
    {
        $ids = $request->post('ids');
        $ret = $this->activity->batchDel($ids);

        $ids = implode(',', $ids);
        if ($ret === false) {
            // Log
            admin_log('拼团活动删除失败。ID：'.$ids);
            return result(-1, '', '删除失败');
        }
        // Log
        admin_log('删除了多个拼团活动。ID：'.$ids);
        return result(0, '', '删除成功');
    }

    /**
     * 更换优惠模式
     *
     * @param Request $request
     * @return array
     * @throws \Throwable
     */
    public function changeMode(Request $request)
    {
        $discount_mode = $request->get('discount_mode',0); // 优惠模式 0-团长享受折扣 1-团长优惠价格

        $render = view('dashboard.fight-group.change_mode', compact('discount_mode'))->render();
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
        $render = view('dashboard.fight-group.'.$tpl, $compact)->render();
        return result(0, $render);
    }

    public function skuList(Request $request)
    {
        $goods_id = $request->get('goods_id');
        $is_commander_discount = $request->get('is_commander_discount');
        $is_going = $request->get('is_going');
        $sku_list = $this->goods->getSkuList($goods_id);
        $uuid = make_uuid();
        $render = view('dashboard.fight-group.sku_list', compact('goods_id','is_commander_discount','is_going', 'sku_list', 'uuid'))->render();

        return result(0, $render);
    }

}