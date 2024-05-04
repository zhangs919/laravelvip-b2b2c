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
 * 预售管理
 *
 * Class PreSaleController
 * @package app\Modules\Seller\Http\Controllers\Dashboard
 */
class PreSaleController extends Seller
{

    private $links = [
        ['url' => 'dashboard/pre-sale/list', 'text' => '预售活动商品列表'],
        ['url' => 'dashboard/pre-sale/add', 'text' => '添加'],
        ['url' => 'dashboard/pre-sale/edit', 'text' => '编辑'],
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
        $this->sublink($this->links, 'list', '', '', 'add,edit');

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
                'text' => '添加预售活动商品'
            ],
        ];

        $explain_panel = [];
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
        $search_arr = ['keyword','pre_sale_mode','begin','end','act_status','status'];
        foreach ($search_arr as $v) {
            if (isset($params[$v]) && !empty($params[$v])) {

                if ($v == 'keyword') {
                    $where[] = ['act_name', 'like', "%{$params[$v]}%"];
                } else {
                    $where[] = [$v, $params[$v]];
                }
            }
        }
        // 列表
        list($list, $total) = $this->activity->getPreSaleGoodsActivityList($where);

        $pageHtml = pagination($total);
        $page = frontend_pagination($total, true);

        if ($request->ajax()) {
            $render = view('dashboard.pre-sale.partials._list', compact('list', 'total', 'pageHtml'))->render();
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
            'tpl_view' => 'dashboard.pre-sale.list'
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
            'purchase_num' => 0,
            'start_time' => time(),
            'end_time' => strtotime("+7 day")
        ];
        $start_time = date('Y-m-d H:i:s', time());
        $end_time = date("Y-m-d H:i:s",strtotime("+7 day"));

        if ($id) {
            // 更新操作
            $model = $this->activity->getById($id, ['sort','act_id','act_name','act_title','act_img','start_time','end_time','purchase_num','shop_id','ext_info']);
            if (empty($model)) {
                // fail
                flash('error', "编号#{$id}不存在");
                return redirect('/dashboard/pre-sale/list');
            }
            $model = $model->toArray();

            $goods_info = [];

            $title = '编辑';
            $this->sublink($this->links, 'edit', '', '', 'add');
        }

        $fixed_title = '预售活动 - '.$title;

        $action_span = [
            [
                'url' => 'list',
                'icon' => 'fa-reply',
                'text' => '返回预售活动列表'
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
        if (isset($goods_info)) {
            $app_prefix_data['goods_info'] = $goods_info;
        } else {
            $app_prefix_data['start_time'] = $start_time;
            $app_prefix_data['end_time'] = $end_time;
        }

        $compact = compact('title', 'model', 'goods_info', 'start_time', 'end_time', 'week');

        $webData = []; // web端（pc、mobile）数据对象
        $data = [
            'app_extra_data' => [],
            'app_prefix_data' => $app_prefix_data,
            'app_context_data' => $this->getAppContext(),
            'app_suffix_data' => [],
            'web_data' => $webData,
            'compact_data' => $compact,
            'tpl_view' => 'dashboard.pre-sale.add'
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
        $postModel = $request->post('PreSaleModel');

        // 活动扩展数据
        $ext_info = null;
        $postModel['ext_info'] = $ext_info;
        $postModel['act_type'] = 2; // 2-预售活动

        $activityData = $postModel;
        $goodsActivityData = [
            [
                'sku_id' => $post['sku_id'],
                'goods_id' => $post['goods_id'],
                'cat_id' => 0, // 预售活动 没有分类
                'act_price' => $post['goods_price'],
                'act_stock' => $post['goods_number']
            ]
        ];

        if (!empty($postModel['act_id'])) {
            // 编辑
            $ret = $this->activity->modifyActivity($activityData, $goodsActivityData);
            $msg = '预售活动编辑';
            $act_id = $postModel['act_id'];
        }else {
            // 添加
            $activityData['shop_id'] = seller_shop_info()->shop_id;

            $ret = $this->activity->addActivity($activityData, $goodsActivityData);
            $msg = '预售活动添加';
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

    public function skuList(Request $request)
    {
        // act_id: 1074
        //goods_id: 16
        //pre_sale_mode: 1
        $act_id = $request->get('act_id');
        $goods_id = $request->get('goods_id');
        $pre_sale_mode = $request->get('pre_sale_mode');

        $render = view('dashboard.pre-sale.sku_list', compact('act_id','goods_id','pre_sale_mode'))->render();

        return result(0, $render);
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
            admin_log('预售活动删除失败。ID：'.$ids);
            return result(-1, '', '删除失败');
        }
        // Log
        admin_log('删除了多个预售活动。ID：'.$ids);
        return result(0, '', '删除成功');
    }



}