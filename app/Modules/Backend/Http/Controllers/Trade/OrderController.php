<?php

namespace App\Modules\Backend\Http\Controllers\Trade;

use App\Models\OrderInfo;
use App\Modules\Base\Http\Controllers\Backend;
use App\Repositories\OrderGoodsRepository;
use App\Repositories\OrderInfoRepository;
use Illuminate\Http\Request;

class OrderController extends Backend
{

    private $links = [
        ['url' => 'trade/order/list', 'text' => '订单列表'],
    ];

    protected $orderInfo;

    protected $orderGoods;

    public function __construct(
        OrderInfoRepository $orderInfo
        ,OrderGoodsRepository $orderGoods
    )
    {
        parent::__construct();

        $this->orderInfo = $orderInfo;
        $this->orderGoods = $orderGoods;
    }


    public function lists(Request $request)
    {
        $title = '订单列表';
        $fixed_title = '商品订单 - '.$title;

        $uid = $request->get('uid', ''); // 查看某个会员的所有订单
        $from = $request->get('from', '');

        $this->sublink($this->links, 'list');
        $action_span = [];
        $explain_panel = [];
        $blocks = [
            'fixed_title' => $fixed_title,
            'action_span' => $action_span,
            'explain_panel' => $explain_panel,
        ];
        $this->setLayoutBlock($blocks); // 设置block

        $params = $request->all();
        $params['order_status'] = $request->get('order_status', '');

        $where = [];
        $whereIn = [];
        $whereBetween = [];
        // 搜索条件 name 商品名称/订单编号/买家账号
        $search_arr = ['name', 'order_status',
//            'add_time_begin', 'add_time_end',
//            'shop_name', 'evaluate_status', 'pay_type',
            'service_type', 'pickup', 'order_type', 'user_mobile', 'consignee_name', 'consignee_mobile', 'consignee_address'];
        foreach ($search_arr as $v) {
            if (isset($params[$v]) && !empty($params[$v])) {
                if ($v == 'name') { // todo
//                    $where[] = [$v, 'like', "%{$params[$v]}%"];
                }
//                elseif ($v == 'add_time_begin' || $v == 'add_time_end') {
//
//                }
                elseif ($v == 'order_status') {
                    if ($params[$v] == 'unpayed') {
                        $whereIn[] = ['order_status', [OS_UNCONFIRMED, OS_CONFIRMED]];
                        $where[] = ['pay_status', PS_UNPAYED];
                    } elseif ($params[$v] == 'pending') { // 待接单 todo
                        $where[] = ['order_status', OS_CONFIRMED];
                    }  elseif ($params[$v] == 'unshipped') {
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
                        $where[] = ['order_cancel', OC_WAIT_AUDIT];
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

        if (!empty($params['add_time_begin']) && empty($params['add_time_end'])) {
            $where[] = ['created_at', '>', $params['add_time_begin']];
        } elseif (empty($params['add_time_begin']) && !empty($params['add_time_end'])) {
            $where[] = ['created_at', '<', $params['start_to']];
        } elseif (!empty($params['add_time_begin']) && !empty($params['add_time_end'])) {
            $whereBetween =  [
                'field' => 'created_at',
                'condition' => [$params['add_time_begin'], $params['add_time_end']]
            ];
        }

        // 列表
        $condition = [
            'with' => ['pickup','orderGoods', 'deliveryOrder', 'deliveryOrder.deliveryGoods'],
            'where' => $where,
            'where_in' => $whereIn,
            'between' => $whereBetween,
            'sortname' => 'order_id',
            'sortorder' => 'desc'
        ];

        list($list, $total) = $this->orderInfo->getOrderList($condition);
        $pageHtml = pagination($total);
        $add_time_begin = get_lately_week_date();

        $compact = compact('title','list', 'total', 'pageHtml', 'params','add_time_begin');
        if ($request->ajax()) {
            $render = view('trade.order.partials._list', $compact)->render();
            return result(0, $render);
        }

        return view('trade.order.list', $compact);
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
        $fixed_title = '商品订单 - '.$title;
        $order_id = $request->get('id');

        $action_span = [
            [
                'id' => '',
                'url' => 'javascript:history.go(-1);',
                'icon' => 'fa-reply',
                'text' => '返回订单列表'
            ],
//            [
//                'id' => 'btn_print',
//                'url' => 'add',
//                'icon' => 'fa-print',
//                'text' => '打印订单'
//            ],
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

        $compact = compact('title', 'info', 'types','order_schedules');

       return view('trade.order.info', $compact);
    }

    /**
     * 打印订单
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function print(Request $request)
    {
        $title = '打印订单';
        $order_id = $request->get('id'); // 多个订单：1,3 以逗号分隔
        $order_ids = explode(',', $order_id);

        // 获取数据

        // 列表
        $condition = [
            'with' => ['orderGoods'],
            'where' => [],
            'in' => [
                'field' => 'order_id',
                'condition' => $order_ids
            ],
            'sortname' => 'order_id',
            'sortorder' => 'asc'
        ];
        list($order_list, $order_total)= $this->orderInfo->getPrintOrderList($condition);

        $print_title = '购物清单';
        $logo = get_image_url(sysconf('mall_logo'));
        $delivery_id = 0; // todo
        $spec_list = [];
        $default_spec = [];
        $buy_type = 0;
        $is_exchange = false;
        $is_gift = false;
        $is_freebuy = false;
        $is_reachbuy = false;
        $mall_wx_qrcode = get_image_url(sysconf('mall_wx_qrcode'));
        $shop_wechat = '';
        $shop_qrcode = 'http://images.lrw.com/15164/gqrcode/shop/C4/qrcode_1.png';
        $qrcode_image = 'http://images.lrw.com/15164/oqrcode/83/qrcode_2,1.png';
        $store_logo = ''; //get_image_url($this->seller_info->shop->shop_logo);

        $compact = compact('title', 'order_list', 'print_title', 'order_id','logo','delivery_id',
            'spec_list','default_spec','buy_type','is_exchange','is_gift','is_freebuy','is_reachbuy',
            'mall_wx_qrcode','shop_wechat','shop_qrcode','qrcode_image','store_logo');

        return view('trade.order.print', $compact);
    }

    public function getOrderCounts(Request $request)
    {
        $data = $this->orderInfo->getOrderCounts();

        return json_result($data);
    }

    public function remark(Request $request)
    {
        $id = $request->get('id');

        if ($request->method() == 'POST') {
            $mall_remark = $request->post('mall_remark');
            if (empty($mall_remark)) {
                return result(-1, '备注内容不能为空');
            }
            $order_mall_remark = OrderInfo::where('order_id', $id)->value('mall_remark');
            if (!empty($order_mall_remark)) {
                $order_mall_remark = unserialize($order_mall_remark);
            } else {
                $order_mall_remark = [];
            }
            $mall_remark_data[] = [
                'user_id' => $this->admin_id,
                'user_name' => $this->admin_info->user_name,
                'remark' => $mall_remark,
                'add_time' => time()
            ];
            $remark_data = array_merge($order_mall_remark, $mall_remark_data);
            $remark_data = serialize($remark_data);
            $ret = $this->orderInfo->update($id, ['mall_remark'=>$remark_data]);
            if ($ret === false) {
                return result(-1, null, '数据保存失败');
            }

            return result(0, null, '数据保存成功');
        }

        $render = view('trade.order.remark', compact('id'))->render();

        return result(0, $render);
    }
}