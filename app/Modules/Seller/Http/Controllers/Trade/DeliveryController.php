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
// | Date:2020-01-02
// | Description:发货单管理
// +----------------------------------------------------------------------

namespace App\Modules\Seller\Http\Controllers\Trade;

use App\Models\DeliveryOrder;
use App\Models\ShopAddress;
use App\Modules\Base\Http\Controllers\Seller;
use App\Proxy\ShippingProxy;
use App\Repositories\DeliveryGoodsRepository;
use App\Repositories\DeliveryOrderRepository;
use App\Repositories\OrderInfoRepository;
use App\Repositories\ShopRepository;
use App\Repositories\ShopShippingRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DeliveryController extends Seller
{

    private $links = [

    ];

    protected $deliveryOrder;
    protected $deliveryGoods;
    protected $orderInfo;
    protected $shop;
    protected $shopShipping;

    protected $shippingProxy;


    public function __construct(
        DeliveryOrderRepository $deliveryOrder
        ,DeliveryGoodsRepository $deliveryGoods
        ,OrderInfoRepository $orderInfo
        ,ShopRepository $shop
        ,ShopShippingRepository $shopShipping
        ,ShippingProxy $shippingProxy
    )
    {
        parent::__construct();

        $this->deliveryOrder = $deliveryOrder;
        $this->deliveryGoods = $deliveryGoods;
        $this->orderInfo = $orderInfo;
        $this->shop = $shop;
        $this->shopShipping = $shopShipping;
        $this->shippingProxy = $shippingProxy;

        $this->set_menu_select('trade', 'trade-delivery-list');
    }

    /**
     * 发货单列表
     *
     * @param Request $request
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Throwable
     */
    public function lists(Request $request)
    {
        $title = '发货单列表';
        $fixed_title = '发货单管理 - ' . $title;


        $action_span = [];
        $explain_panel = [
            '已发货未收货非指派网点订单才有修改运单的按钮',
            '一笔订单，拆单发货，则会生成多个发货单。卖家对订单发货选择第三方物流，则发货单列表中才会展示打印快递单按钮',
            '卖家对订单进行发货，在发货页面，点击确认发货后，发货单状态则变为"已发货"。如果卖家对订单进行发货，在发货页面，未点击确认发货，将发货页面关闭，此时也会生成发货单，发货单的状态是"待发货"，待发货状态的发货单，卖家可以进行取消发货单和继续发货操作。取消发货单，则发货单被删除',
        ];
        $blocks = [
            'fixed_title' => $fixed_title,
            'action_span' => $action_span,
            'explain_panel' => $explain_panel,
        ];
        $this->setLayoutBlock($blocks); // 设置block

        $params = $request->all();
//        $params['delivery_status'] = $request->get('delivery_status', '');

        $where = [];
        // 搜索条件 name 商品名称/订单编号/买家账号
        $search_arr = ['keywords_type','keywords','delivery_status','shipping_type',
            'add_time_begin','add_time_end','send_time_begin','send_time_end'];
        foreach ($search_arr as $v) {
            if (isset($params[$v]) && !empty($params[$v])) {
                if ($v == 'keywords') { // todo
//                    $where[] = [$v, 'like', "%{$params[$v]}%"];
                } elseif ($v == 'add_time_begin' || $v == 'add_time_end') {

                } elseif ($v == 'delivery_status') {
                    if ($params[$v] == 'shipped') {
                        // 已发货
                        $where[] = [$v, DELIVERY_SHIPPED];
                    } else {
                        // 待发货
                        $where[] = [$v, DELIVERY_CREATE];
                    }
                } else {
                    $where[] = [$v, $params[$v]];
                }
            }
        }

        $where[] = ['sender_id', seller_shop_info()->shop_id]; // 店铺id

        // 列表
        $condition = [
            'with' => ['orderInfo','deliveryGoods'],
            'where' => $where,
            'sortname' => 'delivery_id',
            'sortorder' => 'desc'
        ];

        list($list, $total) = $this->deliveryOrder->getDeliveryList($condition);
        $pageHtml = pagination($total);
        $page = frontend_pagination($total, true);

        if ($request->ajax()) {
            $render = view('trade.delivery.partials._list', compact('list', 'total', 'pageHtml', 'params'))->render();
            return result(0, $render);
        }

        // 获取数据
        $delivery_status_list = [
            '' => '全部',
            'unshipped' => '待发货',
            'shipped' => '已发货',
        ];
        $shipping_type_list = [
            '' => '全部',
            '0' => '无需物流',
            '3' => '第三方快递',
            '1-2' => '嗖嗖物流',
        ];
        $service_type_list = [
            '' => '全部',
            'refunding' => '退款中',
            'replacement' => '换货中',
            'repairing' => '维修中',
        ];
        $delivery_counts = $this->deliveryOrder->getDeliveryCounts(seller_shop_info()->shop_id);

        $compact = compact('title', 'list', 'pageHtml', 'params'
            ,'delivery_status_list','shipping_type_list'
            ,'service_type_list','delivery_counts');

        $webData = []; // web端（pc、mobile）数据对象
        $data = [
            'app_extra_data' => [

            ],
            'app_prefix_data' => [
                'list' => $list,
                'page' => $page,
                'delivery_status_list' => $delivery_status_list,
                'shipping_type_list' => $shipping_type_list,
                'service_type_list' => $service_type_list,
                'delivery_counts' => $delivery_counts,
            ],
            'app_context_data' => $this->getAppContext(),
            'app_suffix_data' => [],
            'web_data' => $webData,
            'compact_data' => $compact,
            'tpl_view' => 'trade.delivery.list'
        ];
        $this->setData($data); // 设置数据
        return $this->displayData(); // 模板渲染及APP客户端返回数据
    }

    /**
     * 发货单详情
     *
     * @param Request $request
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function info(Request $request)
    {
        $title = '发货单详情';
        $fixed_title = '发货单管理 - ' . $title;
        $delivery_id = $request->get('id');

        $action_span = [
            [
                'id' => '',
                'url' => 'javascript:history.go(-1);',
                'icon' => 'fa-reply',
                'text' => '返回发货单列表'
            ],
            [
                'id' => 'btn_print',
                'url' => 'javascript:;',
                'icon' => 'fa-print',
                'text' => '打印发货单'
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
            ['delivery_id', $delivery_id],
        ];
        $delivery_info = $this->deliveryOrder->getDeliveryInfo($condition);

        if (empty($delivery_info)) {
            abort(200, '发货单id无效');
        }

        $types = [
            "无需物流",
            "指配派送",
            "物流众包",
            "第三方物流",
            "达达物流"
        ];

        $order_info = $this->deliveryOrder->getOrderInfo($delivery_info['order_id']);

        $order_schedules = $this->orderInfo->getOrderSchedules($order_info);

        $shop_info = $this->shop->shopInfo($delivery_info['sender_id'])['shop'];
//        dd($shop_info);
        $express_info = [
            'status' => 1,
            'shipping_type' => 0,
            'express_sn' => "0",
        ];
        $express_trace = $this->shippingProxy->getExpress($delivery_info['shipping_code'], $delivery_info['express_sn']);

        $compact = compact('title', 'delivery_info', 'types','order_info', 'order_schedules','shop_info'
                ,'express_info', 'express_trace');

        $webData = []; // web端（pc、mobile）数据对象
        $data = [
            'app_extra_data' => [],
            'app_prefix_data' => [
                'delivery_info' => $delivery_info,
                'types' => $types,
                'order_info' => $order_info,
                'order_schedules' => $order_schedules,
                'shop_info' => $shop_info,
                'express_info' => $express_info,
                'is_gift' => false,
            ],
            'app_context_data' => $this->getAppContext(),
            'app_suffix_data' => [],
            'web_data' => $webData,
            'compact_data' => $compact,
            'tpl_view' => 'trade.delivery.info'
        ];
        $this->setData($data); // 设置数据
        return $this->displayData(); // 模板渲染及APP客户端返回数据
    }



    public function getDeliveryCounts(Request $request)
    {
        $data = $this->deliveryOrder->getDeliveryCounts(seller_shop_info()->shop_id);

        return json_result($data);
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
        $type = $request->get('type'); // address-修改收货人信息 seller_address-修改发货人信息
        $delivery_id = $request->get('id'); // 发货单id
        $order_id = $request->get('oid'); // 订单id
        $uuid = make_uuid();
        $from = $request->get('from');
//        $from = 'info';

        if ($type == 'address') { // 修改收货人信息
//            $order_id = DeliveryOrder::where('delivery_id', $delivery_id)->value('order_id');
            if (!$order_id) {
                return result(-1,null,INVALID_PARAM);
            }
            $data = $order_info = $this->orderInfo->getById($order_id)->toArray();
            view()->share('order_info', $order_info);

        } elseif ($type == 'seller_address') { // 修改发货人信息
            $shop_address = ShopAddress::where('shop_id', seller_shop_info()->shop_id)
                ->orderBy('is_default','desc')->get()->toArray();
            $deliveryOrder = DeliveryOrder::where('delivery_id', $delivery_id)->select(['region_code','address'])->first();
            view()->share('shop_address', $shop_address);
            view()->share('region_code_now', $deliveryOrder->region_code);
            view()->share('address_now', $deliveryOrder->address);
            view()->share('from', $from);
            $data = [
                'delivery_id' => $delivery_id,
                'shop_address' => $shop_address,
                'from' => $from,
                'order_id' => null,
                'region_code_now' => $deliveryOrder->region_code,
                'address_now' => $deliveryOrder->address,
            ];
        }

        if (is_app()) {
            return result(0, $data);
        }

        $render = view('trade.delivery.edit_' . $type, compact('uuid', 'delivery_id', 'type', 'from'))->render();

        return result(0, $render);
    }

    /**
     * 修改订单保存数据
     *
     * @param Request $request
     * @return array|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function editOrderSave(Request $request)
    {

        $oid = $request->post('oid'); // 订单id
        $from = $request->post('from');
        $type = $request->post('type'); // address-修改收货人信息 seller_address-修改发货人信息
        $edit = $request->post('edit');

        $msg = '';
        if ($type == 'address') {
            $orderModel = $request->post('OrderModel');
            $ret = $this->orderInfo->update($oid, $orderModel);

            if ($from == 'order-info') {
                if ($ret === false) {
                    flash('error', '保存失败！');
                    return back();
                }
                flash('success', '保存成功！');
                return back();
            } else {
                if ($ret === false) {
                    return result(-1, null, '保存失败！');
                }
                return result(0, null, '保存成功！');
            }

        } elseif ($type == 'seller_address') {
            $address_id = $request->post('id');
            $delivery_id = $request->post('delivery_id');
            $addressInfo = ShopAddress::where('address_id', $address_id)->first();
            if (empty($addressInfo)) {
                flash('error', '发货地址无效！');
                return back();
            }
            //'region_code', 'name','address', 'tel'
            $update = [
                'name' => $addressInfo->consignee,
                'region_code' => $addressInfo->region_code,
                'address' => $addressInfo->address_detail,
                'tel' => !empty($addressInfo->mobile) ? $addressInfo->mobile : $addressInfo->tel,
            ];
            $ret = $this->deliveryOrder->update($delivery_id, $update);
            if ($ret === false) {
                return result(0, null, '修改发货人信息失败！',['address_id'=>$address_id]);
            }
            return result(0, null, '修改发货人信息成功！',['address_id'=>$address_id]);
        }

        return result(0, null, $msg);

    }

    /**
     * 修改订单价格保存数据
     *
     * @param Request $request
     * @return array|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
//    public function edit(Request $request)
//    {
//        // change_amount[4]: 0.00
//        //change_amount[5]: 0.00
//        //shipping_fee: 0.00
//        //other_shipping_fee: 0.00
//        //packing_fee: 0.00
//        //order_id: 3
//        $post = $request->post();
//
//        // todo 保存数据
//
//
//        return result(0, null, '修改订单成功！');
//    }


    public function toShipping(Request $request)
    {
        $title = '发货单-发货';
        $fixed_title = '发货单管理 - ' . $title;
        $delivery_id = $request->get('id'); // 初次生成发货单跳转到发货页面
        $order_id = $request->get('order_id'); // 已生成发货单，点击跳转到发货页面

        $action_span = [];

        $explain_panel = [];
        $blocks = [
            'explain_panel' => $explain_panel,
            'fixed_title' => $fixed_title,
            'action_span' => $action_span
        ];

        $this->setLayoutBlock($blocks); // 设置block



        // 获取数据

        if (!empty($delivery_id)) {
            $condition = [
                ['delivery_id', $delivery_id],
            ];
        } else {
            $condition = [
                ['order_id', $order_id],
            ];
        }

        $delivery_info = $this->deliveryOrder->getDeliveryInfo($condition);

        if (empty($delivery_info)) {
            abort(200, '发货单id无效');
        }

        // 验证是否重复发货
        if ($delivery_info['delivery_status'] == 1) {
            // 已完成发货 跳转页面
            flash('error', '请勿重复发货！');
            return redirect('/trade/order/list');
        }

        // 确认发货 start
        $params = $request->all();
        if (isset($params['shipping_id']) && isset($params['express_sn'])) {
            $shipping_id = $params['shipping_id'];
            $express_sn = $params['express_sn'];
            // 配送方式 0 无需物流 1 指派 2 众包 3 第三方物流
            $shipping_type = $request->get('type', 0);

            $ret = $this->deliveryOrder->delivery($delivery_id, $shipping_id, $express_sn, $shipping_type);
            if ($ret === false) {
                return result(-1,null,'发货失败！');
            }

            return result(0,null,'发货成功！');
        }
        // 确认发货 end

        $order_info = $this->deliveryOrder->getOrderInfo($delivery_info['order_id']);

        $shipping_list = [];

        $order_schedules = $this->orderInfo->getOrderSchedules($order_info);

        $is_gift = 0;

        $pickup_address = null;
        $cost = null;
        $computed_logistics_cost = null;
        $is_edit_cost_enable = null;

        $compact = compact('title', 'delivery_info','order_info', 'order_schedules','is_gift');

        $webData = []; // web端（pc、mobile）数据对象
        $data = [
            'app_extra_data' => [],
            'app_prefix_data' => [
                'delivery_info' => $delivery_info,
                'order_info' => $order_info,
                'shipping_list' => $shipping_list,
                'order_schedules' => $order_schedules,
                'is_gift' => $is_gift,
                'pickup_address' => $pickup_address,
                'cost' => $cost,
                'computed_logistics_cost' => $computed_logistics_cost,
                'is_edit_cost_enable' => $is_edit_cost_enable,
            ],
            'app_context_data' => $this->getAppContext(),
            'app_suffix_data' => [],
            'web_data' => $webData,
            'compact_data' => $compact,
            'tpl_view' => 'trade.delivery.to_shipping'
        ];
        $this->setData($data); // 设置数据
        return $this->displayData(); // 模板渲染及APP客户端返回数据
    }

    public function cancel()
    {
        
    }

    /**
     * 获取快递公司列表
     * 
     * @param Request $request
     * @return array|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     * @throws \Throwable
     */
    public function searchExpress(Request $request)
    {
        $express_keyword = $request->get('express_keyword');
        $is_sheet = $request->get('is_sheet'); // 0
        $delivery_id = $request->get('delivery_id');


        // 获取数据
        $where = [];
        $where[] = ['shipping.is_open',1];
        $where[] = ['shop_shipping.is_open',1];
        if (!empty($express_keyword)) {
            $where[] = ['shipping.shipping_name','like', "%{$express_keyword}%"];
        }
//        if ($is_sheet) {
//            $where[] = ['shipping.is_sheet', $is_sheet];
//        }

        $expressList = DB::table('shop_shipping')
            ->where($where)
            ->leftJoin('shipping','shop_shipping.shipping_id','shipping.shipping_id')
            ->orderBy('is_default', 'desc')
            ->orderBy('shipping.shipping_sort','asc')
            ->get();

        $express = [];
        if ($expressList->isNotEmpty()) {
            foreach ($expressList as $item) {
                $express[] = (array)$item;
            }
        }

        $shipping_list = [
            'default'=>'express',
            'list' => [
                'express' => $express
            ]
        ];

        $compact = compact('shipping_list','is_sheet','delivery_id');
        if (!is_app()) { // Web端
            $render = view('trade.delivery.search_express', $compact)->render();
            return result(0, $render);
        }

        $webData = []; // web端（pc、mobile）数据对象
        $data = [
            'app_prefix_data' => [

            ],
            'app_suffix_data' => [],
            'web_data' => $webData,
            'compact_data' => $compact,
            'tpl_view' => 'trade.delivery.search_express'
        ];
        $this->setData($data); // 设置数据
        return $this->displayData(); // 模板渲染及APP客户端返回数据

    }

    /**
     * 获取物流单（电子面单）
     *
     * @param Request $request
     * @return array|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function getSheet(Request $request)
    {

        return result(-1,null,'请联系平台方配置该快递的电子面单参数！');


    }

    /**
     * 打印电子面单（电子面单）
     *
     * @param Request $request
     * @return array|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function checkPrint(Request $request)
    {

        return result(-1,null,'请联系平台方配置该快递的电子面单参数！');


    }

    /**
     * 打印快递单
     *
     * @param Request $request
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function print(Request $request)
    {
        // 获取数据
        $delivery_id = $request->get('id');

        $printData = $this->deliveryOrder->getPrintData($delivery_id);
        if (!$printData) {
            abort(200,INVALID_PARAM);
        }

        extract($printData);

        $compact = compact('model','label_list','print');
        $webData = []; // web端（pc、mobile）数据对象
        $data = [
            'app_prefix_data' => [
                'model' => $model,
                'label_list' => $label_list,
                'print' => $print
            ],
            'app_suffix_data' => [],
            'web_data' => $webData,
            'compact_data' => $compact,
            'tpl_view' => 'trade.delivery.print'
        ];
        $this->setData($data); // 设置数据
        return $this->displayData(); // 模板渲染及APP客户端返回数据
    }

    /**
     * 设置默认
     * @param Request $request
     * @return array|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function shippingDefault(Request $request)
    {
        $id = $request->get('id');
        if (!$id) {
            // fail
            return result(-1,null,INVALID_PARAM);
        }

        $ret = $this->shopShipping->setDefault($id, seller_shop_info()->shop_id);
        if ($ret === false) {
            // fail
            return result(-1, null, '设置默认失败！');
        }

        return result(0,null,'设置默认成功！');
    }
}