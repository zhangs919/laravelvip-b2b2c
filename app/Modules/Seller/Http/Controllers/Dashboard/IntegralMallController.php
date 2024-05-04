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
// | Date:2018-11-10
// | Description: 积分兑换商品
// +----------------------------------------------------------------------

namespace App\Modules\Seller\Http\Controllers\Dashboard;

use App\Modules\Base\Http\Controllers\Seller;
use App\Repositories\BonusRepository;
use App\Repositories\IntegralGoodsRepository;
use App\Repositories\IntegralOrderInfoRepository;
use App\Repositories\ShopConfigFieldRepository;
use Illuminate\Http\Request;

/**
 * 积分兑换商品管理
 *
 * Class IntegralMallController
 * @package app\Modules\Seller\Http\Controllers\Dashboard
 */
class IntegralMallController extends Seller
{

    private $links = [
        ['url' => 'dashboard/integral-mall/revision', 'text' => '核销'],
        ['url' => 'dashboard/integral-mall/integral-goods-list', 'text' => '积分兑换商品'],
        ['url' => 'dashboard/integral-mall/integral-order-list', 'text' => '积分兑换列表'],
        ['url' => 'dashboard/integral-mall/integral-bonus-list', 'text' => '积分兑换红包'],
        ['url' => 'dashboard/integral-mall/integral-mall-set', 'text' => '积分商城设置'],
    ];

    protected $shopConfigField;

    protected $integralGoods;
    protected $integralOrderInfo;
    protected $bonus;

    public function __construct(
        ShopConfigFieldRepository $shopConfigField
        , IntegralGoodsRepository $integralGoods
        , IntegralOrderInfoRepository $integralOrderInfo
        , BonusRepository $bonus
    )
    {
        parent::__construct();

        $this->shopConfigField = $shopConfigField;
        $this->integralGoods = $integralGoods;
        $this->integralOrderInfo = $integralOrderInfo;
        $this->bonus = $bonus;

        $this->set_menu_select('dashboard', 'dashboard-center');
    }

    /*********************** 核销 ********************/
    /**
     * 核销
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function revision(Request $request)
    {
        $title = '核销';
        $fixed_title = '营销中心 - ' . $title;
        $this->sublink($this->links, 'revision');

        $action_span = [];

        $explain_panel = [
            '如果平台方开启了扫描订单二维码核销无需点击确认核销按钮即可自动触发交易成功，则此处，扫描订单二维码后，自动就触发交易成功'
        ];
        $blocks = [
            'explain_panel' => $explain_panel,
            'fixed_title' => $fixed_title,
            'action_span' => $action_span
        ];

        $this->setLayoutBlock($blocks); // 设置block

        return view('dashboard.integral-mall.revision', compact('title'));
    }

    /**
     * 开始核销
     *
     * @param Request $request
     * @return array
     */
    public function doRevision(Request $request)
    {
        $order_id = $request->post('order_id');
        $ret = $this->integralOrderInfo->doRevision($order_id);
        if (!$ret) {
            return result(-1, null, '核销失败');
        }

        return result(0, null, '核销成功！');
    }

    /**
     * 核销-获取订单信息
     *
     * @param Request $request
     * @return array
     * @throws \Throwable
     */
    public function getOrder(Request $request)
    {
        $order_sn = $request->get('order_sn');

        // 获取数据
        $condition = [
            ['order_sn', $order_sn],
        ];
        $order_info = $this->integralOrderInfo->getFrontendOrderInfo($condition);

        $auto_revision = 0; // 核销状态 默认0 0-无法核销 1-未核销 2-无法核销
        if (!empty($order_info)) {
            if (get_order_operate_state('shop_delivery', $order_info)) {
                // 待发货 未核销
                $auto_revision = 1;
            } elseif (get_order_operate_state('buyer_confirm_receipt', $order_info)) {
                // 待收货 已核销
                $auto_revision = 2;
            }
        }
        $compact = compact('auto_revision', 'order_info');
        $tpl_view = 'dashboard.integral-mall.get_order';
        if ($request->ajax()) {
            $render = view($tpl_view, $compact)->render();
            return result(0, $render);
        }

        $webData = []; // web端（pc、mobile）数据对象
        $data = [
            'app_extra_data' => [],
            'app_prefix_data' => [
                'auto_revision' => $auto_revision,
            ],
            'app_context_data' => $this->getAppContext(),
            'app_suffix_data' => [],
            'web_data' => $webData,
            'compact_data' => $compact,
            'tpl_view' => $tpl_view
        ];
        $this->setData($data); // 设置数据
        return $this->displayData(); // 模板渲染及APP客户端返回数据
    }

    /*********************** 积分兑换商品 ********************/

    public function integralGoodsList(Request $request)
    {
        $title = '积分兑换商品';
        $fixed_title = '营销中心 - ' . $title;
        $this->sublink($this->links, 'integral-goods-list');

        $action_span = [
            [
                'id' => '',
                'url' => '/dashboard/center/index',
                'icon' => 'fa-reply',
                'text' => '返回营销中心'
            ],
            [
                'url' => 'add-integral-goods',
                'icon' => 'fa-plus',
                'text' => '添加积分兑换商品'
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
        $search_arr = ['goods_name', 'goods_status'];
        foreach ($search_arr as $v) {
            if (isset($params[$v]) && !empty($params[$v])) {
                if ($v == 'goods_name') {
                    $where[] = [$v, 'like', "%{$params[$v]}%"];
                } else {
                    $where[] = [$v, $params[$v]];
                }
            }
        }
        if (isset($params['goods_status']) && in_array($params['goods_status'], [0, 1])) {
            $where[] = ['goods_status', $params['goods_status']];
        }

        // 列表
        $condition = [
            'where' => $where,
            'sortname' => 'goods_sort',
            'sortorder' => 'asc'
        ];
        list($list, $total) = $this->integralGoods->getList($condition);

        $pageHtml = pagination($total);

        $compact = compact('title', 'list', 'total', 'pageHtml');
        if ($request->ajax()) {
            $render = view('dashboard.integral-mall.partials._integral_goods_list', $compact)->render();
            return result(0, $render);
        }
        return view('dashboard.integral-mall.integral_goods_list', $compact);
    }

    public function addIntegralGoods(Request $request)
    {
        $title = '添加积分兑换商品';
        $id = $request->get('id', 0);


        if ($id) {
            // 更新操作
            $info = $this->integralGoods->getById($id);
            if (!empty($info->mobile_desc)) {
                $info->mobile_desc = json_decode($info->mobile_desc);
            }
            view()->share('info', $info);
            $title = '编辑积分兑换商品';
        }

        $fixed_title = '营销中心 - ' . $title;

        $action_span = [
            [
                'url' => 'integral-goods-list',
                'icon' => 'fa-reply',
                'text' => '返回积分兑换商品'
            ],
        ];

        $explain_panel = [];
        $blocks = [
            'explain_panel' => $explain_panel,
            'fixed_title' => $fixed_title,
            'action_span' => $action_span
        ];

        $this->setLayoutBlock($blocks); // 设置block

        return view('dashboard.integral-mall.add_integral_goods', compact('title'));
    }

    public function editIntegralGoods(Request $request)
    {
        return $this->addIntegralGoods($request);
    }

    /**
     * 保存信息
     * @param Request $request
     * @return mixed
     */
    public function saveIntegralGoods(Request $request)
    {
        $post = $request->post('IntegralGoodsModel');

        // 商品图片处理
        if (!empty($post['goods_images'])) {
            $goods_images = explode('|', $post['goods_images']);
            $post['goods_image'] = $goods_images[0];
        }

        if (!empty($post['goods_id'])) {
            // 编辑
            $ret = $this->integralGoods->update($post['goods_id'], $post);
            $msg = '编辑';
        } else {
            // 添加
            $post['shop_id'] = seller_shop_info()->shop_id;
            $ret = $this->integralGoods->store($post);
            $msg = '添加';
        }

        if ($ret === false) {
            // fail
            flash('error', $msg . '失败');
            return redirect('/dashboard/integral-mall/integral-goods-list');
        }
        // success
        flash('success', $msg . '成功');
        return redirect('/dashboard/integral-mall/integral-goods-list');
    }

    public function setGoodsStatus(Request $request)
    {
        $id = $request->get('id');
        $ret = $this->integralGoods->changeState($id, 'goods_status');
        if ($ret === false) {
            return result(-1, null, OPERATE_FAIL);
        }
        return result(0, $ret, 1);
    }

    public function editIntegralGoodsInfo(Request $request)
    {
        $id = $request->post('goods_id');
        $title = $request->post('title');
        $value = $request->post('value');

        if (in_array($title, ['goods_integral', 'goods_number', 'exchange_number', 'goods_sort'])) {
            $value = intval($value);
        }
        $ret = $this->integralGoods->update($id, [$title => $value]);

        if ($ret === false) {
            return result(-1, null, '编辑失败');
        }
        return result(0, null);
    }

    public function delIntegralGoods(Request $request)
    {
        $id = $request->post('id');
        if (is_array($id)) {
            // 批量删除
            $ret = $this->integralGoods->batchDel($id);
            $id = implode(',', $id);
        } else {
            // 删除单个
            $ret = $this->integralGoods->del($id);
        }
        if ($ret === false) {
            // Log
            shop_log('积分兑换商品删除失败。ID：' . $id);
            return result(-1, null, '删除失败');
        }
        // Log
        shop_log('积分兑换商品删除成功。ID：' . $id);
        return result(0, null, '删除成功');
    }


    /*********************** 积分兑换列表 ********************/
    public function integralOrderList(Request $request)
    {
        $title = '积分兑换列表';
        $fixed_title = '营销中心 - ' . $title;
        $this->sublink($this->links, 'integral-order-list');

        $action_span = [
            [
                'id' => '',
                'url' => '/dashboard/center/index',
                'icon' => 'fa-reply',
                'text' => '返回营销中心'
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
        $uid = $request->get('uid', ''); // 查看某个会员的所有订单
        $from = $request->get('from', '');
        $params = $request->all();
        $params['order_status'] = $request->get('order_status', '');

        $where = [];
        // 搜索条件 name 商品名称/订单编号/买家账号
        $search_arr = ['name', 'order_status', 'add_time_begin', 'add_time_end'];
        foreach ($search_arr as $v) {
            if (isset($params[$v]) && !empty($params[$v])) {
                if ($v == 'name') { // todo
//                    $where[] = [$v, 'like', "%{$params[$v]}%"];
                } elseif ($v == 'add_time_begin' || $v == 'add_time_end') {

                } else {
                    $where[] = [$v, $params[$v]];
                }
            }
        }

        if (!empty($uid)) {
            $where[] = ['user_id', $uid];
        }

        $where[] = ['shop_id', seller_shop_info()->shop_id]; // 店铺id

        // 列表
        $condition = [
            'with' => ['integralOrderGoods'],
            'where' => $where,
            'sortname' => 'order_id',
            'sortorder' => 'asc'
        ];

        list($list, $total) = $this->integralOrderInfo->getOrderList($condition);
        $pageHtml = pagination($total);
        $page = frontend_pagination($total, true);

        $order_count = $this->integralOrderInfo->getOrderCounts(0, seller_shop_info()->shop_id);
        $order_status_list = $this->integralOrderInfo->getOrderStatusList();

        $compact = compact('title', 'list', 'pageHtml', 'params', 'order_count', 'order_status_list');

        if ($request->ajax()) {
            $render = view('dashboard.integral-mall.partials._integral_order_list', $compact)->render();
            return result(0, $render);
        }

        $webData = []; // web端（pc、mobile）数据对象
        $data = [
            'app_extra_data' => [],
            'app_prefix_data' => [
                'list' => $list,
                'page' => $page,
                'order_count' => $order_count,
                'order_status_list' => $order_status_list,
            ],
            'app_context_data' => $this->getAppContext(),
            'app_suffix_data' => [],
            'web_data' => $webData,
            'compact_data' => $compact,
            'tpl_view' => 'dashboard.integral-mall.integral_order_list'
        ];
        $this->setData($data); // 设置数据
        return $this->displayData(); // 模板渲染及APP客户端返回数据
    }


    /*********************** 积分兑换红包 ********************/
    public function integralBonusList(Request $request)
    {
        $title = '积分兑换红包';
        $fixed_title = '营销中心 - ' . $title;
        $this->sublink($this->links, 'integral-bonus-list');

        $action_span = [
            [
                'id' => '',
                'url' => '/dashboard/center/index',
                'icon' => 'fa-reply',
                'text' => '返回营销中心'
            ],
            [
                'url' => 'add-integral-bonus',
                'icon' => 'fa-plus',
                'text' => '添加积分兑换红包'
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
        $params = $request->all();

        $where = [];
        $where[] = ['bonus_type', 10]; // 红包类型 10-积分兑换红包
        $where[] = ['shop_id', seller_shop_info()->shop_id];
        $where[] = ['is_delete', 0]; // 未删除状态
        // 搜索条件
        $search_arr = ['keywords', 'start_time', 'end_time', 'is_enable'];
        foreach ($search_arr as $v) {
            if (isset($params[$v]) && !empty($params[$v])) {

                if ($v == 'keywords') {
                    $where[] = ['bonus_name', 'like', "%{$params[$v]}%"];
                } else {
                    $where[] = [$v, $params[$v]];
                }
            }
        }
        // 列表
        list($list, $total) = $this->bonus->getBonusList($where);

        $pageHtml = pagination($total);
        $page = frontend_pagination($total, true);
        $bonus_types = null;

        $compact = compact('title', 'list', 'pageHtml', 'bonus_types');

        if ($request->ajax()) {
            $render = view('dashboard.integral-mall.partials._integral_bonus_list', $compact)->render();
            return result(0, $render);
        }

        $webData = []; // web端（pc、mobile）数据对象
        $data = [
            'app_extra_data' => [],
            'app_prefix_data' => [
                'list' => $list,
                'page' => $page,
                'bonus_types' => $bonus_types,
            ],
            'app_context_data' => $this->getAppContext(),
            'app_suffix_data' => [],
            'web_data' => $webData,
            'compact_data' => $compact,
            'tpl_view' => 'dashboard.integral-mall.integral_bonus_list'
        ];
        $this->setData($data); // 设置数据
        return $this->displayData(); // 模板渲染及APP客户端返回数据
    }


    /*********************** 积分商城设置 ********************/

    /**
     * 积分商城设置
     *
     * @param Request $request
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function integralMallSet(Request $request)
    {
        $title = '积分商城设置';
        $fixed_title = '营销中心 - ' . $title;
        $this->sublink($this->links, 'integral-mall-set');


        $action_span = [
            [
                'id' => '',
                'url' => '/dashboard/center/index',
                'icon' => 'fa-reply',
                'text' => '返回营销中心'
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
        $group = 'integral_mall_set'; // 当前配置分组
        $model = $this->shopConfigField->getSpecialConfigsByGroup($group, 'code', true);
        $back_url = $request->fullUrl();

        $compact = compact('title', 'model', 'back_url');

        $webData = []; // web端（pc、mobile）数据对象
        $data = [
            'app_extra_data' => [],
            'app_prefix_data' => [
                'model' => $model,
                'back_url' => $back_url,
            ],
            'app_context_data' => $this->getAppContext(),
            'app_suffix_data' => [],
            'web_data' => $webData,
            'compact_data' => $compact,
            'tpl_view' => 'dashboard.integral-mall.integral_mall_set'
        ];
        $this->setData($data); // 设置数据
        return $this->displayData(); // 模板渲染及APP客户端返回数据
    }

}