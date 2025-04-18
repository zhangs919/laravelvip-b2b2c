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
// | Date:2020-01-31
// | Description:结算管理
// +----------------------------------------------------------------------

namespace App\Modules\Seller\Http\Controllers\Finance;

use App\Modules\Base\Http\Controllers\Seller;
use App\Repositories\SellerBillOrderRepository;
use App\Repositories\SellerCommissionBillRepository;
use Illuminate\Http\Request;

/**
 * 结算管理
 *
 * Class BillController
 * @package App\Modules\Seller\Http\Controllers\Finance
 */
class BillController extends Seller
{

    private $links = [

    ];

    private $store_bill_links = [
        ['url' => 'finance/bill/store-bill?type=0', 'text' => '月结'],
        ['url' => 'finance/bill/store-bill?type=1', 'text' => '周结'],
        ['url' => 'finance/bill/store-bill?type=2', 'text' => '日结'],
        ['url' => 'finance/bill/store-bill?type=3', 'text' => '3日结'],
    ];

    protected $sellerCommissionBill;
    protected $sellerBillOrder;

    public function __construct(
        SellerCommissionBillRepository $sellerCommissionBill,
        SellerBillOrderRepository $sellerBillOrder
    )
    {
        parent::__construct();

        $this->sellerCommissionBill = $sellerCommissionBill;
        $this->sellerBillOrder = $sellerBillOrder;

    }

    /**
     * 店铺结算列表
     *
     * @param Request $request
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Throwable
     */
    public function shopBill(Request $request)
    {
        $this->set_menu_select('finance', 'finance-bill-manager-list');

        $title = '列表';
        $fixed_title = '结算管理 - '.$title;
        $type = $request->get('type', 0); // 结算周期 默认0-月结

        $action_span = [
//            [
//                'url' => '',
//                'id' => 'btn_export',
//                'icon' => 'fa-cloud-download',
//                'text' => '导出'
//            ],
        ];
        $explain_panel = [
            // 简化说明
            '每个商家都有自己的结算周期，每个结算周期都会生成一个结算账单，周期内所有订单出账后，金额会自动打款到店铺的会员账户余额中，店铺可二次消费或者提现',
            '付款金额=未退款的商品总金额； ',
            '平台佣金=未退款成功的商品总金额*平台与店铺的佣金比例',
            '账单计算公式：应付店铺金额=订单中未退款的商品总金额-平台佣金；',
            '账单处理流程：系统自动出账 > 平台手动结算打款到商家的结算账户中，共2个环节',
            '账单出账时间：当周期内的所有订单都已经确认收货，并不再发生退款退货时，即可出账，例如：订单在1号确认收货，商城设置“申请售后期限”为7天，那么此笔订单会在8号出账',
            '支付汇总：统计结算周期内所有订单的各种支付方式的支付金额'
            // 详细说明
//            '每个商家都有自己的结算周期，每个结算周期都会生成一个结算账单，周期内所有订单出账后，金额会自动打款到店铺的会员账户余额中，店铺可二次消费或者提现',
//            '付款金额=订单中所有商品总金额-店铺红包-店铺优惠-平台红包-积分抵扣金额-退款成功的商品的退款金额； 平台佣金=（未退款成功的商品总金额-未退款商品均分的店铺红包-未退款商品均分的店铺优惠）*平台与店铺的佣金比例-（未退款成功的商品总金额-未退款商品均分的店铺红包-未退款商品均分的店铺优惠）*平台与店铺的佣金比例*站点与平台间的佣金比例，站点佣金=（未退款成功的商品总金额-未退款商品均分的店铺红包-未退款商品均分的店铺优惠）*平台与店铺的佣金比例*站点与平台间的佣金比例',
//            '账单计算公式：应付店铺金额=订单中未退款的商品总金额-未退款商品均分的店铺红包-未退款商品均分的店铺优惠+运费+额外配送费+包装费-（店铺购物卡总支付金额-店铺购物卡退回金额）-平台佣金-站点佣金+（退款成功的商品的应退款金额-退款成功的商品的实际退款金额）-未退款商品均分的订单返现金额；如发现金额计算不准，是因为存在货到付款情况，请以本期应结金额为准',
//            '货到付款支付方式，应付店铺金额=余额支付金额+平台承担活动款+积分抵扣金额-平台佣金-站点佣金 货到付款是特殊的付款方式，系统默认此款项已由店铺收取，因此店铺需要支付佣金给平台，所以本期应结金额为负数，结算时请注意',
//            '账单处理流程：系统自动出账 > 商家手动结算打款到网点/门店的结算账户中，共2个环节',
//            '账单出账时间：当周期内的所有订单都已经确认收货，并不再发生退款退货时，即可出账，例如：订单在1号确认收货，商城设置“申请售后期限”为7天，那么此笔订单会在8号出账',
//            '平台承担活动款：是指由平台方发起的活动所产生的金额，此金额是由平台承担，例如：平台方红包',
//            '支付汇总：统计结算周期内所有订单的各种支付方式的支付金额',
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
        $search_arr = ['chargeoff_status'];
        foreach ($search_arr as $v) {
            if (isset($params[$v]) && !empty($params[$v])) {
                if ($v == 'xxx') {
                    $where[] = [$v, 'like', "%{$params[$v]}%"];
                } else {
                    $where[] = [$v, $params[$v]];
                }
            }
        }

        $where[] = ['shop_id', seller_shop_info()->shop_id];

        // 列表
        $condition = [
            'where' => $where,
            'sortname' => 'id',
            'sortorder' => 'asc',
            'relation' => 'order'
        ];
        // 获取数据
        list($list, $total) = $this->sellerCommissionBill->getList($condition);
        $list = $list->toArray();

        $pageHtml = pagination($total);
        $page = frontend_pagination($total, true);

        $calc_result = null;

        $compact = compact('title', 'list', 'pageHtml','calc_result','type');

        if ($request->ajax()) {
            $render = view('finance.bill.partials._shop_bill', $compact)->render();
            return result(0, $render);
        }

        $webData = []; // web端（pc、mobile）数据对象
        $data = [
            'app_extra_data' => [],
            'app_prefix_data' => [
                'list' => $list,
                'page' => $page,
                'calc_result' => $calc_result,
                'type' => $type,
            ],
            'app_context_data' => $this->getAppContext(),
            'app_suffix_data' => [],
            'web_data' => $webData,
            'compact_data' => $compact,
            'tpl_view' => 'finance.bill.shop_bill'
        ];
        $this->setData($data); // 设置数据
        return $this->displayData(); // 模板渲染及APP客户端返回数据
    }

    public function exportShop(Request $request)
    {

    }

    public function shopOrdersInfo(Request $request)
    {
        $this->set_menu_select('finance', 'finance-bill-manager-list');

        $title = '账单详情';
        $fixed_title = '结算管理 - '.$title;


        $action_span = [
//            [
//                'url' => '',
//                'id' => 'btn_export',
//                'icon' => 'fa-cloud-download',
//                'text' => '导出'
//            ],
            [
                'url' => 'javascript:history.go(-1);',
                'id' => '',
                'icon' => 'fa-reply',
                'text' => '返回店铺账单列表'
            ],
        ];
        $explain_panel = [];
        $blocks = [
            'fixed_title' => $fixed_title,
            'action_span' => $action_span,
            'explain_panel' => $explain_panel,
        ];
        $this->setLayoutBlock($blocks); // 设置block


        $params = $request->all();
        $id = $params['id'];

        $where = [];
        // 搜索条件 name 商品名称/订单编号/买家账号
        $search_arr = ['order_sn', 'chargeoff_status'];
        foreach ($search_arr as $v) {
            if (isset($params[$v]) && !empty($params[$v])) {
                if ($v == 'order_sn') {
                    $where[] = [$v, 'like', "%{$params[$v]}%"];
                } else {
                    $where[] = [$v, $params[$v]];
                }
            }
        }

        $where[] = ['shop_id', seller_shop_info()->shop_id];
        $where[] = ['bill_id', $id];

        // 列表
        $condition = [
            'where' => $where,
            'sortname' => 'id',
            'sortorder' => 'asc',
        ];

        // 获取数据
        list($list, $total) = $this->sellerBillOrder->getList($condition);
        $total_data = $this->sellerBillOrder->getSumData($where);
        $pageHtml = pagination($total);
        $page = frontend_pagination($total, true);

        $bill_info = $this->sellerCommissionBill->getById($id);
        $bill_info['start_time'] = format_time($bill_info['start_time'], 'Y-m-d');
        $bill_info['end_time'] = format_time($bill_info['end_time'], 'Y-m-d');
        $shop_info = seller_shop_info();
        $compact = compact('title', 'list', 'pageHtml', 'bill_info','shop_info','total_data');

        if ($request->ajax()) {
            $render = view('finance.bill.partials._shop_orders_info', $compact)->render();
            return result(0, $render);
        }

        $webData = []; // web端（pc、mobile）数据对象
        $data = [
            'app_extra_data' => [],
            'app_prefix_data' => [
                'list' => $list,
                'page' => $page,
//                'order_message' => $order_message,
                'bill_info' => $bill_info,
                'shop_info' => $shop_info,
                'total_data' => $total_data,
            ],
            'app_context_data' => $this->getAppContext(),
            'app_suffix_data' => [],
            'web_data' => $webData,
            'compact_data' => $compact,
            'tpl_view' => 'finance.bill.shop_orders_info'
        ];
        $this->setData($data); // 设置数据
        return $this->displayData(); // 模板渲染及APP客户端返回数据
    }

    /**
     * 网点结算列表
     * todo 网点结算与店铺结算类似 后期新建 store_bill表即可
     *
     * @param Request $request
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Throwable
     */
    public function storeBill(Request $request)
    {
        $this->set_menu_select('finance', 'finance-bill-list');

        $title = '网点对账列表';
        $fixed_title = '网点结算 - '.$title;
        $type = $request->get('type', 0);

        $this->sublink($this->store_bill_links, $type, 'type');

        $action_span = [];
        $explain_panel = [
            '每个网点都有自己的结算周期，每个结算周期都会生成一个结算账单，店铺依据结算账单与网点进行结算',
            '付款金额=订单中所有商品总金额-店铺红包-店铺优惠-平台红包-积分抵扣金额-退款成功的商品的退款金额',
            '店铺佣金计算规则：店铺佣金=（订单中未退款的商品总金额-未退款商品均分的店铺红包-未退款商品均分的店铺优惠-平台总佣金）*店铺与网点的佣金比例',
            '账单计算公式：应付网点金额=订单中未退款的商品总金额-未退款商品均分的店铺红包-未退款商品均分的店铺优惠+运费+额外配送费+包装费-平台总佣金（包含站点佣金）-店铺佣金',
            '货到付款支付方式：应付网点金额=余额支付金额+商品消费店铺储值卡支付金额+平台承担活动款-平台总佣金（包含站点佣金）-店铺佣金+积分抵扣金额（货到付款是特殊的付款方式，系统默认此款项已由网点接收，因此网点需要支付佣金给店铺，因为结算佣金有可能为负数 ，结算时请注意。）',
            '账单处理流程：系统自动出账 > 商家手动结算打款到网点/门店的结算账户中，共2个环节',
            '账单出账时间：当周期内的所有订单都已经确认收货，并不再发生退款退货时，即可出账，例如：订单在1号确认收货，商城设置“申请售后期限”为7天，那么此笔订单会在8号出账',
        ];
        $blocks = [
            'fixed_title' => $fixed_title,
            'action_span' => $action_span,
            'explain_panel' => $explain_panel,
        ];
        $this->setLayoutBlock($blocks); // 设置block

        $params = $request->all();

        $where = [];
        // 搜索条件 name
        $search_arr = [];
        foreach ($search_arr as $v) {
            if (isset($params[$v]) && !empty($params[$v])) {
                if ($v == 'key_word') { // todo
//                    $where[] = [$v, 'like', "%{$params[$v]}%"];
                } /*elseif ($v == 'add_time_begin' || $v == 'add_time_end') {

                }*/
                else {
                    $where[] = [$v, $params[$v]];
                }
            }
        }

        $where[] = ['user_id', seller_shop_info()->user_id];

        // 列表
        $condition = [
            'where' => $where,
            'sortname' => 'id',
            'sortorder' => 'asc'
        ];


        // 获取数据
        list($list, $total) = [0,0]; //$this->userAccount->getList($condition);
//        $list = $list->toArray();

        $pageHtml = pagination($total);
        $page = frontend_pagination($total, true);

        $calc_result = null;


        $compact = compact('title', 'list', 'pageHtml','calc_result','type');

        if ($request->ajax()) {
            $render = view('finance.bill.partials._store_bill', $compact)->render();
            return result(0, $render);
        }


        $webData = []; // web端（pc、mobile）数据对象
        $data = [
            'app_extra_data' => [],
            'app_prefix_data' => [
                'list' => $list,
                'page' => $page,
                'calc_result' => $calc_result,
                'type' => $type,
            ],
            'app_context_data' => $this->getAppContext(),
            'app_suffix_data' => [],
            'web_data' => $webData,
            'compact_data' => $compact,
            'tpl_view' => 'finance.bill.store_bill'
        ];
        $this->setData($data); // 设置数据
        return $this->displayData(); // 模板渲染及APP客户端返回数据
    }
}