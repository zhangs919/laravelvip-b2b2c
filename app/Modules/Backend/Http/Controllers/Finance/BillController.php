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
// | Date:2020-08-16
// | Description:结算管理
// +----------------------------------------------------------------------

namespace App\Modules\Backend\Http\Controllers\Finance;

use App\Modules\Base\Http\Controllers\Backend;
use App\Repositories\ShopBillRepository;
use Illuminate\Http\Request;

/**
 * 结算管理
 * Class BillController
 * @package App\Modules\Backend\Http\Controllers\Finance
 */
class BillController extends Backend
{

    private $links = [

    ];

    private $store_bill_links = [
        ['url' => 'finance/bill/system-shop-bill?type=0', 'text' => '月结'],
        ['url' => 'finance/bill/system-shop-bill?type=1', 'text' => '周结'],
        ['url' => 'finance/bill/system-shop-bill?type=2', 'text' => '日结'],
        ['url' => 'finance/bill/system-shop-bill?type=3', 'text' => '3日结'],
    ];

    protected $shopBill;

    public function __construct(ShopBillRepository $shopBill)
    {
        parent::__construct();

        $this->shopBill = $shopBill;

    }

    /**
     * 店铺结算列表
     *
     * @param Request $request
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Throwable
     */
    public function systemShopBill(Request $request)
    {

        $title = '列表';
        $fixed_title = '店铺账单 - '.$title;
        $type = $request->get('type', 0); // 结算周期 默认0-月结

        $action_span = [
            [
                'url' => '',
                'id' => 'btn_export',
                'icon' => 'fa-cloud-download',
                'text' => '导出'
            ],
        ];
        $explain_panel = [
//            '每个商家都有自己的结算周期，每个结算周期都会生成一个结算账单，周期内所有订单出账后，金额会自动打款到店铺的会员账户余额中，店铺可二次消费或者提现',
//            '账单计算公式：平台应结金额=商品总金额-店铺红包-店铺优惠+运费-店铺储值卡支付金额-平台佣金-站点佣金 ；<span class="c-red">（如发现金额计算不准，是因为存在货到付款情况，请以本期应结金额为准）</span>',
//            '账单处理流程：系统自动出账 > 系统自动打款到商家的会员账户余额中，共2个环节',
//            '账单出账时间：当周期内的所有订单都已经确认收货，并不再发生退款退货时，即可出账，例如：订单在1号确认收货，商城设置“申请售后期限”为7天，那么此笔订单会在8号出账',
//            '平台承担货款：是指由平台方发起的活动所产生的金额，此金额是由平台承担，例如：平台方红包',
//            '累计销售总额：统计所有店铺已经确认收货的在线支付订单总金额+货到付款订单平台佣金。待结算金额：统计所有未给店铺结算的账单金额。已结算金额：统计所有已经给店铺结算的账单金额。'
        ];
        $blocks = [
            'fixed_title' => $fixed_title,
            'action_span' => $action_span,
            'explain_panel' => $explain_panel,
        ];
        $this->setLayoutBlock($blocks); // 设置block

        $params = $request->all();

        $where = [];
        // 搜索条件 name 商品名称/订单编号/买家账号
        $search_arr = ['keywords','is_supply'];
        foreach ($search_arr as $v) {
            if (isset($params[$v]) && !empty($params[$v])) {
                if ($v == 'keywords') { //

                }
                else {
                    $where[] = [$v, $params[$v]];
                }
            }
        }

        // 列表
        $condition = [
            'where' => $where,
            'sortname' => 'bill_id',
            'sortorder' => 'asc'
        ];

        // 获取数据
        list($list, $total) = $this->shopBill->getList($condition);
        $list = $list->toArray();

        $pageHtml = pagination($total);
        $page = frontend_pagination($total, true);

        $calc_result = null;

        $compact = compact('title', 'list', 'pageHtml','calc_result','type');

        if ($request->ajax()) {
            $render = view('finance.bill.partials._system_shop_bill', $compact)->render();
            return result(0, $render);
        }

        return view('finance.bill.system_shop_bill', $compact);
    }

    public function exportShop(Request $request)
    {

    }

    public function shopOrdersInfo(Request $request)
    {

        $title = '账单详情';
        $fixed_title = '店铺账单 - '.$title;


        $action_span = [
            [
                'url' => '',
                'id' => 'btn_export',
                'icon' => 'fa-cloud-download',
                'text' => '导出'
            ],
            [
                'url' => 'javascript:history.go(-1);',
                'id' => '',
                'icon' => 'fa-reply',
                'text' => '返回店铺账单列表'
            ],
        ];
        $explain_panel = [
        ];
        $blocks = [
            'fixed_title' => $fixed_title,
            'action_span' => $action_span,
            'explain_panel' => $explain_panel,
        ];
        $this->setLayoutBlock($blocks); // 设置block


        $shop_id = seller_shop_info()->shop_id;
        $store_id = 0; // todo
        $group_time = $request->get('group_time');
        $type = $request->get('type', 0);
        $order_sn = $request->get('order_sn');
        $store_type = 0;//todo

//        $is_cod = $request->get('is_cod');

        // 查询参数
        $params['shop_id'] = seller_shop_info()->shop_id;
        $params['store_id'] = $store_id;
        $params['group_time'] = $group_time;
        $params['type'] = $type;
        $params['order_sn'] = $order_sn;

        // 获取数据
        list($list, $total) = $this->shopBill->getOrders($params);
        $pageHtml = pagination($total);

        $order_message = $this->shopBill->getOrderCount($params);
        $shop_info = seller_shop_info()->toArray();
        $store_info = null; // 网点信息
        $site = null; // 站点信息

        $compact = compact('title', 'list', 'pageHtml','shop_id','store_id','group_time','type','order_sn','store_type',
            'order_message','shop_info','store_info','site');

        if ($request->ajax()) {
            $render = view('finance.bill.partials._shop_orders_info', $compact)->render();
            return result(0, $render);
        }

        return view('finance.bill.shop_orders_info', $compact);
    }

}