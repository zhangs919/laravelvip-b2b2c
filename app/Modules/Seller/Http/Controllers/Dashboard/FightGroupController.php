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
        $this->sublink($this->links, 'list', '', '', 'check');

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
        list($list, $total) = $this->activity->getGoodsMixActivityList($where);

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
        $this->sublink($this->links, 'add', '', '', 'view');

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
        $cat_list = []; // 拼团活动分类

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

    public function view(Request $request)
    {
        $title = '拼团详情';

        $id = $request->get('id', 0);
        $this->sublink($this->links, 'view', '', '', 'add');
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
        $min_price = '';
        $max_price = null;

        $model = $this->activity->getById($id);
        $model = $model->toArray();
        $goods_info = []; // 拼团商品信息

        $compact = compact('title', 'model', 'goods_info');

        $webData = []; // web端（pc、mobile）数据对象
        $data = [
            'app_extra_data' => [],
            'app_prefix_data' => [
                'min_price' => $min_price,
                'max_price' => $max_price,
                'model' => $model,
                'goods_info' => $goods_info,
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
     * 保存信息
     *
     * @param Request $request
     * @return mixed
     */
    public function saveData(Request $request)
    {
        $post = $request->post('FightGroupModel');

        // 添加
        $post['shop_id'] = seller_shop_info()->shop_id;

        $ret = $this->activity->store($post);
        $msg = '拼团活动添加';

        if ($ret === false) {
            // fail
            return result(-1, null, $msg.'失败');
        }
        // success
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

}