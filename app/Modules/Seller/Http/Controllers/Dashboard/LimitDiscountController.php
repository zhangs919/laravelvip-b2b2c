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

namespace app\Modules\Seller\Http\Controllers\Dashboard;

use App\Models\Activity;
use App\Models\Goods;
use App\Modules\Base\Http\Controllers\Seller;
use App\Repositories\ActivityCategoryRepository;
use App\Repositories\ActivityRepository;
use App\Repositories\BrandRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\GoodsRepository;
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
        ['url' => 'dashboard/limit-discount/list', 'text' => '列表'],
        ['url' => 'dashboard/limit-discount/add', 'text' => '添加'],
        ['url' => 'dashboard/limit-discount/edit', 'text' => '编辑'],
    ];

    protected $activity;
    protected $activityCategory;
    protected $goods;
    protected $category;
    protected $brand;

    public function __construct()
    {
        parent::__construct();

        $this->activity = new ActivityRepository();
        $this->activityCategory = new ActivityCategoryRepository();
        $this->goods = new GoodsRepository();
        $this->category = new CategoryRepository();
        $this->brand = new BrandRepository();

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

    /**
     *
     * @param Request $request
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
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
        $week = null;

        if ($id) {
            // 更新操作
            $model = $this->activity->getById($id, ['sort','act_id','act_name','act_title','act_img','start_time','end_time','purchase_num','shop_id','ext_info']);
            if (empty($model)) {
                // fail
                flash('error', "编号#{$id}不存在");
                return redirect('/dashboard/limit-discount/list');
            }
            $model = $model->toArray();
            $timepicker = null;
            $week = [
                ''
            ];
            $week_string = null;
            $goods_list = $this->activity->getLimitDiscountGoodsActivityList($id); // 商品列表

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
        $app_prefix_data['model'] = $model;
        if (isset($goods_list)) {
            $app_prefix_data['timepicker'] = null;
            $app_prefix_data['week'] = [
                ''
            ];
            $app_prefix_data['week_string'] = '';
            $app_prefix_data['goods_list'] = $goods_list;
        } else {
            $app_prefix_data['start_time'] = $start_time;
            $app_prefix_data['end_time'] = $end_time;
            $app_prefix_data['week'] = $week;
        }

        $compact = compact('title', 'model', 'goods_list', 'start_time', 'end_time', 'week');

        $webData = []; // web端（pc、mobile）数据对象
        $data = [
            'app_extra_data' => [],
            'app_prefix_data' => $app_prefix_data,
            'app_context_data' => $this->getAppContext(),
            'app_suffix_data' => [],
            'web_data' => $webData,
            'compact_data' => $compact,
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

        // 活动扩展数据
        $ext_info['act_repeat'] = $postModel['act_repeat'];
        $ext_info['timepicker'] = $post['timepicker'];
        $ext_info['act_label'] = $postModel['act_label'];

        if ($postModel['act_repeat'] == 1) { // 周期重复
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
            // 不重复 清空周期重复数据 ??

        }

        $ext_info['limit_type'] = $post['limit_type']; // 限购设置 每人限购N件
        if ($post['limit_type'] == 1) { // 限购
            $ext_info['limit_num_1'] = $post['limit_num_1'];
        }
        $postModel['ext_info'] = $ext_info;
        $postModel['act_type'] = 11; // 11-限时折扣

        $activityData = $postModel;
        $goodsActivityData = [
            [
                'sku_id' => $post['sku_id'],
                'goods_id' => $post['goods_id'],
                'cat_id' => 0, // 限时折扣活动 没有分类
                'act_price' => $post['goods_price'],
                'act_stock' => $post['goods_number']
            ]
        ];

        if (!empty($postModel['act_id'])) {
            // 编辑
            $ret = $this->activity->modifyActivity($activityData, $goodsActivityData);
            $msg = '限时折扣编辑';
            $act_id = $postModel['act_id'];
        }else {
            // 添加
            $activityData['shop_id'] = seller_shop_info()->shop_id;

            $ret = $this->activity->addActivity($activityData, $goodsActivityData);
            $msg = '限时折扣添加';
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
     * 选中商品时 异步加载商品信息
     *
     * @param Request $request
     * @return array
     * @throws \Throwable
     */
    public function goodsInfo(Request $request)
    {
        $goods_id = $request->post('goods_id');
        $goods_info = Goods::where('goods_id',$goods_id)->first();
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

        $render = view('dashboard.limit-discount.goods_info', compact('goods_info', 'category_list'))->render();
        return result(0, $render, '');
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