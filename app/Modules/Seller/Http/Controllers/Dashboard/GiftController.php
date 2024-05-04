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
// | Date:2019-3-23
// | Description:赠品
// +----------------------------------------------------------------------

namespace App\Modules\Seller\Http\Controllers\Dashboard;

use App\Models\Goods;
use App\Models\GoodsSku;
use App\Modules\Base\Http\Controllers\Seller;
use App\Repositories\ActivityCategoryRepository;
use App\Repositories\ActivityRepository;
use App\Repositories\BrandRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\GoodsRepository;
use Illuminate\Http\Request;

/**
 * 赠品活动管理
 *
 * Class GiftController
 * @package app\Modules\Seller\Http\Controllers\Dashboard
 */
class GiftController extends Seller
{

    private $links = [
        ['url' => 'dashboard/gift/list', 'text' => '列表'],
        ['url' => 'dashboard/gift/add', 'text' => '添加'],
        ['url' => 'dashboard/gift/edit', 'text' => '编辑'],
    ];

    protected $activity;
    protected $activityCategory;
    protected $goods;
    protected $category;
    protected $brand;

    public function __construct(
        ActivityRepository $activity
        ,ActivityCategoryRepository $activityCategory
        ,GoodsRepository $goods
        ,CategoryRepository $category
        ,BrandRepository $brand
    )
    {
        parent::__construct();

        $this->activity = $activity;
        $this->activityCategory = $activityCategory;
        $this->goods = $goods;
        $this->category = $category;
        $this->brand = $brand;

        $this->set_menu_select('dashboard', 'dashboard-center');
    }


    public function lists(Request $request)
    {
        $title = '列表';
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
                'text' => '添加赠品'
            ],
        ];

        $explain_panel = [
            '赠品活动目前应用于满减/送促销活动中作为优惠条件，抽奖类活动作为赠品领取',
            '作为赠品的商品，赠品价格为0，如作为赠品的商品有设置运费，抽奖类活动需要支付运费，满减/送促销活动不需要支付运费',
            '已赠送：表示抽奖类活动已赠送出去的赠品活动次数；已领取：表示抽奖类活动已赠送出去并已领取的赠品活动次数',
            '虚拟商品不参与赠品活动'
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
        list($list, $total) = $this->activity->getGiftActivityList($where);

        $pageHtml = pagination($total);
        $page = frontend_pagination($total, true);

        if ($request->ajax()) {
            $render = view('dashboard.gift.partials._list', compact('list', 'total', 'pageHtml'))->render();
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
            'tpl_view' => 'dashboard.gift.list'
        ];
        $this->setData($data); // 设置数据
        return $this->displayData(); // 模板渲染及APP客户端返回数据
    }

    public function add(Request $request)
    {
        $title = '添加';

        $id = $request->get('id', 0);
        $this->sublink($this->links, 'add', '', '', 'edit');

        $model = [
            'sort' => 255
        ];
        $start_time = date('Y-m-d H:i:s', time());
        $end_time = date("Y-m-d H:i:s",strtotime("+7 day"));
        $goods_list = [];

        if ($id) {
            // 更新操作
            $model = $this->activity->getById($id, ['sort','act_id','act_name','act_title','act_img','start_time','end_time','shop_id','ext_info']);
            $model = $model->toArray();

            // 赠品活动商品列表
            $goods_list = $this->activity->getGiftGoodsActivityList($id);

            $start_time = $model['start_time'];
            $end_time = $model['end_time'];

            $title = '编辑';
            $this->sublink($this->links, 'edit', '', '', 'add');
        }

        $fixed_title = '赠品活动 - '.$title;

        $action_span = [
            [
                'url' => 'list',
                'icon' => 'fa-reply',
                'text' => '返回赠品列表'
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
        $app_prefix_data['model'] = $model;
        if ($id) {
            $app_prefix_data['goods_list'] = $goods_list;
        } else {
            $app_prefix_data['start_time'] = $start_time;
            $app_prefix_data['end_time'] = $end_time;
        }

        $compact = compact('title', 'model', 'goods_list', 'start_time', 'end_time');

        $webData = []; // web端（pc、mobile）数据对象
        $data = [
            'app_extra_data' => [],
            'app_prefix_data' => $app_prefix_data,
            'app_context_data' => $this->getAppContext(),
            'app_suffix_data' => [],
            'web_data' => $webData,
            'compact_data' => $compact,
            'tpl_view' => 'dashboard.gift.add'
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
        $postModel = $request->post('GiftModel');

        // 活动扩展数据
        $ext_info['valid_data'] = $postModel['valid_data'];
        $ext_info['gift_limit'] = $postModel['gift_limit'];

        $postModel['ext_info'] = $ext_info;
        $postModel['act_type'] = 13; // 13-赠品活动

        // 活动数据
        $activityData = $postModel;

        // 活动商品数据
        $goodsActivityData =[];
        foreach ($post['goods_spu'] as $k=>$v) {
            $goodsActivityData[] = [
                'goods_id' => $v,
                'sku_id' => 0,
                'cat_id' => 0, // 赠品活动 没有分类
                'act_price' => 0.00, // 活动价格 为0.00
                'act_stock' => 0, // 活动库存 为0
                'ext_info' => [
                    'valid_data' => $postModel['valid_data'],
                    'gift_limit' => $postModel['gift_limit'],
                    'act_number' => $post['act_number'][$k], // 赠品数量 每个商品不一样
                ]
            ];
        }

        if (!empty($postModel['act_id'])) {
            // 编辑
            $ret = $this->activity->modifyActivity($activityData, $goodsActivityData);
            $msg = '赠品活动编辑';
            $act_id = $postModel['act_id'];
        }else {
            // 添加
            $activityData['shop_id'] = seller_shop_info()->shop_id;

            $ret = $this->activity->addActivity($activityData, $goodsActivityData);
            $msg = '赠品活动添加';
            $act_id = @$ret->act_id;
        }

        if ($ret === false) {
            // fail
            return result(-1, null, $msg.'失败');
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
            shop_log('赠品活动删除失败。ID：'.$id);
            return result(-1, null, '删除失败');
        }

        // Log
        shop_log('赠品活动删除成功。ID：'.$id);
        return result(0, null, '删除成功');
    }

    public function batchDelete(Request $request)
    {
        $ids = $request->post('ids');
        $ids = !is_array($ids) ? [$ids] : $ids;
        $ret = $this->activity->deleteActivity(0, $ids);

        $ids = implode(',', $ids);
        if ($ret === false) {
            // Log
            shop_log('赠品活动删除失败。ID：'.$ids);
            return result(-1, '', '删除失败');
        }
        // Log
        shop_log('删除了多个赠品活动。ID：'.$ids);
        return result(0, '', '删除成功');
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

        $compact = compact(
            'page_id', 'pagination_id', 'list', 'pageHtml',
            'sku_ids', 'goods_ids', 'category_list',
            'brand_list');
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
    public function goodsInfo(Request $request)
    {
        $goods_id = $request->post('goods_id');
        $price_mode = $request->post('price_mode'); // 价格模式 0-统一套餐价 1-自定义规格价

//        $goods_info = Goods::where('goods_id',$goods_id)->first();
        $goods_info = Goods::where('goods_id', $goods_id)
            ->select(['goods_id','goods_price','goods_number','goods_name'])->first();
        $goods_sku_list = GoodsSku::where([['goods_id', $goods_id],['checked',1]])
            ->select(['sku_id','goods_number','goods_price'])->get()->toArray();
        $goods_price = [];
        $price_arr = array_column($goods_sku_list, 'goods_price');
        $min_price = min($price_arr);
        $max_price = max($price_arr);
        if ($min_price == $max_price) {
            $goods_price = $min_price;
        } else {
            $goods_price = "￥{$min_price}-￥{$max_price}";
        }

        $sku_ids = implode(',', array_column($goods_sku_list, 'sku_id'));



        if (empty($goods_info)) {
            return result(-1, null, '商品ID无效');
        }
        if ($goods_info->goods_number <= 0) {
            return result(-1, null, '该商品库存不足，不可选择！');
        }

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

        $render = view('dashboard.gift.goods_info', compact('goods_info', 'category_list', 'price_mode', 'goods_price', 'sku_ids'))->render();
        return result(0, $render, '');
    }


}