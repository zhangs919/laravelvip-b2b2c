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

namespace app\Modules\Seller\Http\Controllers\Dashboard;

use App\Modules\Base\Http\Controllers\Seller;
use App\Repositories\IntegralGoodsRepository;
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

    protected $integralGoods;

    public function __construct()
    {
        parent::__construct();

        $this->integralGoods = new IntegralGoodsRepository();

        $this->set_menu_select('dashboard', 'dashboard-center');
    }

    /**
     * 核销
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function revision(Request $request)
    {
        $title = '核销';
        $fixed_title = '营销中心 - '.$title;
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
        // 执行核销操作 如果是待发货 自动进行商家发货及买家收货操作，完成订单，并核销，将订单核销状态改为已核销

        return result(0, null, '核销成功！');
    }

    /**
     * 核销
     * 根据订单编号获取订单信息
     *
     * @param Request $request
     * @return array
     * @throws \Throwable
     */
    public function getOrder(Request $request)
    {
        $order_sn = $request->get('order_sn');

        // 根据订单编号查询订单信息
        $order_info = [1]; // todo 查询订单信息
        $render = view('dashboard.integral-mall.get_order', compact('order_info'))->render();

        return result(0, $render);
    }

    public function integralGoodsList(Request $request)
    {
        $title = '积分兑换商品';
        $fixed_title = '营销中心 - '.$title;
        $this->sublink($this->links, 'integral-goods-list');

        $action_span = [
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

        $fixed_title = '营销中心 - '.$title;

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
        }else {
            // 添加
            $post['shop_id'] = seller_shop_info()->shop_id;
            $ret = $this->integralGoods->store($post);
            $msg = '添加';
        }

        if ($ret === false) {
            // fail
            flash('error', $msg.'失败');
            return redirect('/dashboard/integral-mall/integral-goods-list');
        }
        // success
        flash('success', $msg.'成功');
        return redirect('/dashboard/integral-mall/integral-goods-list');
    }

    public function setGoodsStatus(Request $request)
    {
        $id = $request->get('id');
        $ret = $this->integralGoods->changeState($id, 'goods_status');
        if ($ret === false) {
            return result(-1, null, '操作失败');
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
            shop_log('积分兑换商品删除失败。ID：'.$id);
            return result(-1, null, '删除失败');
        }
        // Log
        shop_log('积分兑换商品删除成功。ID：'.$id);
        return result(0, null, '删除成功');
    }


}