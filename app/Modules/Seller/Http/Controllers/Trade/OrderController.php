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
// | Date:2019-03-20
// | Description:订单管理
// +----------------------------------------------------------------------

namespace App\Modules\Seller\Http\Controllers\Trade;

use App\Jobs\OrderCancel;
use App\Models\OrderInfo;
use App\Models\PrintSpec;
use App\Models\ShopAddress;
use App\Modules\Base\Http\Controllers\Seller;
use App\Repositories\DeliveryOrderRepository;
use App\Repositories\OrderGoodsRepository;
use App\Repositories\OrderInfoLogicRepository;
use App\Repositories\OrderInfoRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class OrderController extends Seller
{

    private $links = [
        ['url' => 'trade/order/list', 'text' => '订单列表'],
        ['url' => 'trade/order/view', 'text' => '核销'],
    ];

    protected $orderInfo;

    protected $orderGoods;

    protected $orderInfoLogic;

    protected $deliveryOrder;

    public function __construct(
        OrderInfoRepository $orderInfo
        , OrderGoodsRepository $orderGoods
        , OrderInfoLogicRepository $orderInfoLogic
        , DeliveryOrderRepository $deliveryOrder
    )
    {
        parent::__construct();

        $this->orderInfo = $orderInfo;
        $this->orderGoods = $orderGoods;
        $this->orderInfoLogic = $orderInfoLogic;
        $this->deliveryOrder = $deliveryOrder;

        $this->set_menu_select('trade', 'trade-order-list');
    }

    /**
     * 订单列表
     *
     * @param Request $request
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Throwable
     */
    public function lists(Request $request)
    {
        $title = '订单列表';
        $fixed_title = '商品订单 - ' . $title;

        $uid = $request->get('uid', ''); // 查看某个会员的所有订单
//        $from = $request->get('from', '');

        $this->sublink($this->links, 'list');
        $action_span = [];
        $explain_panel = [];
        $blocks = [
            'fixed_title' => $fixed_title,
            'action_span' => $action_span,
            'explain_panel' => $explain_panel,
        ];
        $this->setLayoutBlock($blocks); // 设置block

        // 获取数据
        $params = $request->all();
        $params['order_status'] = $request->get('order_status', '');

        $where = [];
        $whereIn = [];
        // 搜索条件 name 商品名称/订单编号/买家账号
        $search_arr = ['name', 'order_status', 'add_time_begin', 'add_time_end', 'shop_name', 'evaluate_status', 'pay_type',
            'service_type', 'pickup', 'order_type', 'user_mobile', 'consignee_name', 'consignee_mobile', 'consignee_address'];
        foreach ($search_arr as $v) {
            if (isset($params[$v]) && !empty($params[$v])) {
                if ($v == 'name') { // todo
//                    $where[] = [$v, 'like', "%{$params[$v]}%"];
                } elseif ($v == 'add_time_begin' || $v == 'add_time_end') {

                } elseif ($v == 'order_status') {
                    if ($params[$v] == 'unpayed') {
                        $whereIn[] = ['order_status', [OS_UNCONFIRMED, OS_CONFIRMED]];
                        $where[] = ['pay_status', PS_UNPAYED];
                    } elseif ($params[$v] == 'unshipped') {
                        $where[] = ['order_status', OS_CONFIRMED];
                        $where[] = ['shipping_status', SS_UNSHIPPED];
                        $whereIn[] = ['pay_status', [PS_PAYING, PS_PAYED]];
                    } elseif ($params[$v] == 'assign') { // todo 待发货已指派订单
                        $whereIn[] = ['order_status', [OS_SPLITED, OS_SPLITING_PART, OS_RETURNED_PART]];
                        $whereIn[] = ['shipping_status', [SS_PREPARING, SS_SHIPPED_PART, SS_SHIPPED_ING]];
                        $whereIn[] = ['pay_status', [PS_PAYING, PS_PAYED, PS_REFOUND_PART]];
                    } elseif ($params[$v] == 'shipped_part') { // 发货中
                        $whereIn[] = ['order_status', [OS_SPLITED, OS_SPLITING_PART, OS_RETURNED_PART]];
                        $whereIn[] = ['shipping_status', [SS_PREPARING, SS_SHIPPED_PART, SS_SHIPPED_ING]];
                        $whereIn[] = ['pay_status', [PS_PAYING, PS_PAYED, PS_REFOUND_PART]];
                    } elseif ($params[$v] == 'shipped') {
                        $whereIn[] = ['order_status', [OS_CONFIRMED, OS_SPLITED]];
                        $where[] = ['shipping_status', SS_SHIPPED];
                        $where[] = ['pay_status', PS_PAYED];
                    } elseif ($params[$v] == 'finished') { // 已完成
                        $whereIn[] = ['order_status', [OS_CONFIRMED, OS_SPLITED, OS_RETURNED_PART, OS_ONLY_REFOUND]];
                        $where[] = ['shipping_status', SS_RECEIVED];
                        $where[] = ['pay_status', PS_PAYED];
                    } elseif ($params[$v] == 'closed') {
                        $whereIn[] = ['order_status', [OS_CANCELED, OS_INVALID]];
                    } elseif ($params[$v] == 'backing') {
                        $where[] = ['order_status', OS_ONLY_REFOUND];
                    } elseif ($params[$v] == 'cancel') {
                        $where[] = ['order_status', OS_CONFIRMED];
                        $where[] = ['order_cancel', OC_UNAPPLY];
                    }
                } elseif ($v == 'evaluate_status') {
                    if ($params[$v] == 'unevaluate') {
                        $whereIn[] = ['order_status', [OS_CONFIRMED, OS_SPLITED, OS_RETURNED_PART, OS_ONLY_REFOUND]];
                        $where[] = ['evaluate_status', ES_UNEVALUATED];
                    }
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
            'with' => ['orderGoods', 'pickup','deliveryOrder', 'deliveryOrder.deliveryGoods'],
            'where' => $where,
            'where_in' => $whereIn,
            'sortname' => 'order_id',
            'sortorder' => 'desc'
        ];

        list($list, $total) = $this->orderInfo->getOrderList($condition);
        $pageHtml = pagination($total);
        $page = frontend_pagination($total, true);

        $shop_address_count = ShopAddress::where('shop_id',seller_shop_info()->shop_id)->count();
        $add_time_begin = get_lately_week_date();

        $compact = compact('title', 'list', 'pageHtml', 'params','shop_address_count', 'add_time_begin');
        if ($request->ajax()) {
            $render = view('trade.order.partials._list', $compact)->render();
            return result(0, $render);
        }

        $webData = []; // web端（pc、mobile）数据对象
        $data = [
            'app_extra_data' => [

            ],
            'app_prefix_data' => [
                'list' => $list,
                'page' => $page,
                'order_counts' => $this->orderInfo->getOrderCounts(0, seller_shop_info()->shop_id, 1),
                'add_time_begin' => date('Y-m-d'), // 获取今日日期
                'buy_type' => 0,
                'list_url' => '/trade/order/list.html'
            ],
            'app_context_data' => $this->getAppContext(),
            'app_suffix_data' => [],
            'web_data' => $webData,
            'compact_data' => $compact,
            'tpl_view' => 'trade.order.list'
        ];
        $this->setData($data); // 设置数据
        return $this->displayData(); // 模板渲染及APP客户端返回数据
    }

    /**
     * 订单详情
     *
     * @param Request $request
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function info(Request $request)
    {
        $title = '订单详情';
        $fixed_title = '订单管理 - ' . $title;
        $order_id = $request->get('id');

        $action_span = [
            [
                'id' => '',
                'url' => 'javascript:history.go(-1);',
                'icon' => 'fa-reply',
                'text' => '返回订单列表'
            ],
            [
                'id' => 'btn_print',
                'url' => 'javascript:;',
                'icon' => 'fa-print',
                'text' => '打印订单'
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
        $condition = [
            ['order_id', $order_id],
        ];
        $info = $this->orderInfo->getOrderInfo($condition);

        if (empty($info)) {
            abort(200, '订单id无效');
        }

        $types = [
            "无需物流",
            "指配派送",
            "物流众包",
            "第三方物流",
            "达达物流"
        ];

        $order_schedules = $this->orderInfo->getOrderSchedules($info);

        $compact = compact('title', 'info', 'types', 'order_schedules');

        $webData = []; // web端（pc、mobile）数据对象
        $data = [
            'app_extra_data' => [],
            'app_prefix_data' => [
                'info' => $info,
                'types' => $types,
                'order_schedules' => $order_schedules,
                'shop_info' => null,
                'pay_term' => '1',
                'pay_term_unit' => '0',
                'store_count' => '5',
                'buy_type' => '1',
                'shop_address_count' => '1',
            ],
            'app_context_data' => $this->getAppContext(),
            'app_suffix_data' => [],
            'web_data' => $webData,
            'compact_data' => $compact,
            'tpl_view' => 'trade.order.info'
        ];
        $this->setData($data); // 设置数据
        return $this->displayData(); // 模板渲染及APP客户端返回数据
    }

    /**
     * 打印订单 / 打印发货单
     *
     * @param Request $request
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function print(Request $request)
    {
        $title = '订单详情';
        $order_id = $request->get('id'); // 多个订单id：1,3 以逗号分隔
        $delivery_id = $request->get('did'); // 多个发货单id：1,3 以逗号分隔

        $order_ids = explode(',', $order_id); // 打印订单
        $delivery_ids = explode(',', $delivery_id); // 打印发货单

        // 获取数据
        $where[] = ['shop_id', seller_shop_info()->shop_id]; // 店铺id

        // 列表
        $condition = [
            'with' => ['orderGoods'],
            'where' => $where,
            'in' => [
                'field' => 'order_id',
                'condition' => $order_ids
            ],
            'sortname' => 'order_id',
            'sortorder' => 'asc'
        ];
        list($order_list, $order_total) = $this->orderInfo->getPrintOrderList($condition);

        $print_title = '购物清单';
        $logo = get_image_url(sysconf('mall_logo'));
        $delivery_id = 0; // todo
        $spec_list = PrintSpec::where('shop_id', seller_shop_info()->shop_id)->get()->toArray();

        $default_spec = PrintSpec::where([
            ['shop_id', seller_shop_info()->shop_id],
            ['is_default',1]
        ])->first();
        $default_spec = !empty($default_spec) ? $default_spec->toArray() : null;

        $buy_type = 0;
        $is_exchange = false;
        $is_gift = false;
        $is_freebuy = false;
        $is_reachbuy = false;
        $mall_wx_qrcode = get_image_url(sysconf('mall_wx_qrcode'));
        $shop_wechat = '';
        $shop_qrcode = 'http://images.xxxx.com/15164/gqrcode/shop/C4/qrcode_1.png';
        $qrcode_image = 'http://images.xxxx.com/15164/oqrcode/83/qrcode_2,1.png';
        $store_logo = get_image_url($this->seller_info->shop->shop_logo);

        $compact = compact('title', 'order_list', 'print_title', 'order_id', 'logo', 'delivery_id',
            'spec_list', 'default_spec', 'buy_type', 'is_exchange', 'is_gift', 'is_freebuy', 'is_reachbuy',
            'mall_wx_qrcode', 'shop_wechat', 'shop_qrcode', 'qrcode_image', 'store_logo');

        $webData = []; // web端（pc、mobile）数据对象
        $data = [
            'app_extra_data' => [],
            'app_prefix_data' => [
                'order_list' => $order_list,
                'print_title' => $print_title,
                'logo' => $logo,
                'order_id' => $order_id,
                'delivery_id' => $delivery_id,
                'spec_list' => $spec_list,
                'default_spec' => $default_spec,
                'buy_type' => $buy_type,
                'is_exchange' => $is_exchange,
                'is_gift' => $is_gift,
                'is_freebuy' => $is_freebuy,
                'is_reachbuy' => $is_reachbuy,
                'mall_wx_qrcode' => $mall_wx_qrcode,
                'shop_wechat' => $shop_wechat,
                'shop_qrcode' => $shop_qrcode,
                'qrcode_image' => $qrcode_image,
                'store_logo' => $store_logo
            ],
            'app_context_data' => $this->getAppContext(),
            'app_suffix_data' => [],
            'web_data' => $webData,
            'compact_data' => $compact,
            'tpl_view' => 'trade.order.print'
        ];
        $this->setData($data); // 设置数据
        return $this->displayData(); // 模板渲染及APP客户端返回数据
    }

    public function selectSpec(Request $request)
    {

        return result(-1,null, '打印设置无效');
        $render = view('trade.order.select_spec')->render();

        return result(0, $render);
    }

    public function getOrderCounts(Request $request)
    {
        $data = $this->orderInfo->getOrderCounts(0, seller_shop_info()->shop_id);

        return json_result($data);
    }

    public function remark(Request $request)
    {
        $id = $request->get('id');

        if ($request->method() == 'POST') {
            $shop_remark = $request->post('shop_remark');
            if (empty($shop_remark)) {
                return result(-1, '备注内容不能为空');
            }
            $order_shop_remark = OrderInfo::where('order_id', $id)->value('shop_remark');
            if (!empty($order_shop_remark)) {
                $order_shop_remark = unserialize($order_shop_remark);
            } else {
                $order_shop_remark = [];
            }
            $shop_remark_data[] = [
                'user_id' => $this->seller_info->user_id,
                'user_name' => $this->seller_info->nickname,
                'remark' => $shop_remark,
                'add_time' => time()
            ];
            $remark_data = array_merge($order_shop_remark, $shop_remark_data);
            $remark_data = serialize($remark_data);
            $ret = $this->orderInfo->update($id, ['shop_remark' => $remark_data]);
            if ($ret === false) {
                return result(-1, null, '数据保存失败');
            }

            return result(0, null, '数据保存成功');
        }

        $render = view('trade.order.remark', compact('id'))->render();

        return result(0, $render);
    }


    /**
     * 修改订单信息
     *
     * @param Request $request
     * @return array|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     * @throws \Throwable
     */
    public function editOrder(Request $request)
    {
        $type = $request->get('type'); // order/close/received/delivery/delay
        $id = $request->get('id'); // 订单详情有值
        $oid = $request->get('oid'); // 订单列表有值
        $from = $request->get('from'); // order-info list
        $uuid = make_uuid();

        $order_id = $id;
//        if ($from == 'list') {
//            $order_id = $id;
//        } elseif ($from == 'order-info') {
//            $order_id = $oid;
//        }

//        if ($type == 'address') {
//            $info = $this->orderInfo->getById($id,['consignee','region_code','region_name','address','tel']);
//
//        }

        if ($type == 'order') { // 修改订单价格
            $condition = [
                ['order_id', $order_id],
            ];
            $info = $this->orderInfo->getOrderInfo($condition);
            view()->share('info', $info);
        } elseif ($type == 'close') { // 关闭订单
            $close_trad_reason = explode("\r\n", sysconf('close_trad_reason'));
            view()->share('close_trad_reason', $close_trad_reason);
        } elseif ($type == 'delivery') { // 拆单发货
            $condition = [
                ['order_id', $order_id],
            ];
            $info = $this->orderInfo->getOrderInfo($condition);
            view()->share('info', $info);
        } elseif ($type == 'delay') { // 延长收货时间
            $extend_receiving_days = explode("\r\n", sysconf('extend_receiving_days'));
            view()->share('extend_receiving_days', $extend_receiving_days);
        } elseif ($type == 'assign') { // 订单指派网点
            $condition = [
                ['order_id', $order_id],
            ];
            $info = $this->orderInfo->getOrderInfo($condition);
            view()->share('info', $info);
        }


        $render = view('trade.order.edit_' . $type, compact('uuid', 'order_id'))->render();

        return result(0, $render);
    }

    /**
     * 修改订单保存数据
     *
     * @param Request $request
     * @return array|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function editOrderSave(Request $request)
    {
        $order_id = $request->post('id'); // 批量操作时，以英文逗号分隔订单id
        $type = $request->post('type'); // close-关闭订单 received-收到货款

        $data = null;
        $msg = '';

        if ($type == 'close') {
            // todo 关闭订单
            $reason = $request->post('reason');  // 未及时付款

            $condition = [
                ['order_id', $order_id],
            ];
            $info = $this->orderInfo->getOrderInfo($condition);
            $ret = OrderCancel::dispatch($info,'shop_cancel', $reason);
            if ($ret === false) {
                return result(-1, null, '取消订单失败！');
            }
            $msg = '取消订单成功！';
        }elseif ($type == 'received') {
            // todo 收到货款
            $ret = false;

            if (!$ret) {
                return result(-1, null,'没有符合条件的订单！');
            }
            $msg = '';
        } elseif ($type == 'delivery') {
            // 拆单发货
            $delivery_goods = $request->post('delivery_goods');
            $ret = $this->deliveryOrder->submitDelivery($order_id, $delivery_goods);
            if (is_string($ret)) {
                return result(-1, null, $ret);
            }

            $data = ['delivery_id'=>$ret];
            $msg = '拆单发货成功！';
        }


        return result(0, $data, $msg);

    }

    /**
     * 修改订单价格保存数据
     *
     * @param Request $request
     * @return array|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        // change_amount[4]: 0.00
        //change_amount[5]: 0.00
        //shipping_fee: 0.00
        //other_shipping_fee: 0.00
        //packing_fee: 0.00
        //order_id: 3
        $post = $request->post();

        // todo 保存数据


        return result(0, null, '修改订单成功！');
    }

    /**
     * 审核取消订单
     *
     * @param Request $request
     * @return array|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     * @throws \Throwable
     */
    public function audit(Request $request)
    {
        $buy_type = $request->get('buy_type');
        $id = $request->get('id');
        if (!$id) {
            return result(-1,null,INVALID_PARAM);
        }

        if ($request->method() == 'POST') {
            // 审核取消订单 拒绝-修改取消订单审核状态 通过-关闭订单
            $order_cancel = $request->post('order_cancel');  //
            $refuse_reason = $request->post('refuse_reason');  //
            $id = $request->post('id');  //

            $condition = [
                ['order_id', $id],
            ];
            $info = $this->orderInfo->getOrderInfo($condition);
            $ret = OrderCancel::dispatch($info,'shop_audit_cancel', $refuse_reason, $order_cancel);
            if ($ret === false) {
                return result(-1, null, '审核取消订单失败！');
            }

            return result(0, null, '审核取消订单成功！');
        }

        $render = view('trade.order.audit', compact('id'))->render();

        return result(0,$render);
    }

    /**
     * 取消派单
     *
     * @param Request $request
     * @return array|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function assignCancel(Request $request)
    {
        $order_id = $request->post('id');

        return result(0,null, '取消派单成功！');
    }

    /**
     * 延长收货时间保存数据
     *
     * @param Request $request
     * @return array|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function delay(Request $request)
    {
        $order_id = $request->post('id');

        $order_info = $this->orderInfo->getById($order_id);
        if (empty($order_info)) {
            return result(-1,null,INVALID_PARAM);
        }
        if ($order_info->delay_days > 0) {
            // 已延长一次 不能再次延长
            return result(-1,null,'收货时间只能延长一次！');
        }

        $orderInfo = OrderInfo::where('order_id', $order_id)->first()->toArray();
        $countdown = $this->orderInfo->getOrderCountdown($orderInfo);
        $delay_days = $orderInfo['delay_days'];
        if ($countdown <= $delay_days*24*60*60) {
            return result(-1,null,'当前时间距离自动确认收货期限大于'.$delay_days.'天，请在小于'.$delay_days.'天时再选择延长收货！');
        }

        // 延长收货时间
        $delay_days = $request->post('delay_days');
        $ret = OrderInfo::where('order_id', $order_id)->update(['delay_days' => $delay_days,'last_time'=>time()]);
        if (!$ret) {
            return result(-1,null,'延长收货时间失败！');
        }

        return result(0,null,'延长收货时间成功！');
    }

    /**
     * 一键发货
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function quickDelivery(Request $request)
    {
        $order_id = $request->get('order_id');
        $price = $request->get('price'); // todo 运费

        // 一键发货
        $ret = $this->deliveryOrder->submitDelivery($order_id);
        if (is_string($ret)) {
            // fail
            flash('error', $ret);
            return redirect('/trade/order/list');
        }

        // 成功
        flash('success', '一键发货成功！');
        return redirect('/trade/order/list');
    }

    /**
     * 计算订单运费
     *
     * @param Request $request
     * @return array|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function calculateOrderFreightPrice(Request $request)
    {
        $order_id = $request->get('order_id');

        $data = '12.00';

        return result(0, $data, '',['no_use'=>0,'is_update_price'=>0]);
    }


    /***********订单核销**********/
    /**
     * 核销
     *
     * @param Request $request
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function view(Request $request)
    {
        $title = '核销';
        $fixed_title = '订单管理 - ' . $title;

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


        // 获取数据


        $compact = compact('title');

        $webData = []; // web端（pc、mobile）数据对象
        $data = [
            'app_extra_data' => [],
            'app_prefix_data' => [

            ],
            'app_context_data' => $this->getAppContext(),
            'app_suffix_data' => [],
            'web_data' => $webData,
            'compact_data' => $compact,
            'tpl_view' => 'trade.order.view'
        ];
        $this->setData($data); // 设置数据
        return $this->displayData(); // 模板渲染及APP客户端返回数据
    }

    /**
     * 核销订单
     * todo 参考平台方后，已做了一部分功能
     *
     * @param Request $request
     * @return array|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     * @throws \Throwable
     */
    public function getOrder(Request $request)
    {
        $order_sn = $request->get('order_sn');

        $order_data = [1];

        if (is_app()) {
            $data = [
                'auto_revision' => 0,
                'reachbuy_auto_revision' => 0,
                'integral_auto_revision' => 0,
                'virtual_auto_revision' => 0,
                'order_info' => [
                    'order_data' => $order_data
                ]
            ];
            return result(0, $data);
        }
        $render = view('trade.order.get_order', compact('order_data'))->render();

        return result(0, $render);
    }
}
