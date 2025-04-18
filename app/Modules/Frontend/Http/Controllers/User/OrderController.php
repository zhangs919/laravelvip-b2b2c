<?php

namespace App\Modules\Frontend\Http\Controllers\User;

use App\Jobs\OrderCancel;
use App\Models\OrderInfo;
use App\Modules\Base\Http\Controllers\UserCenter;
use App\Repositories\DeliveryOrderRepository;
use App\Repositories\OrderGoodsRepository;
use App\Repositories\OrderInfoRepository;
use App\Repositories\UserRankLogRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends UserCenter
{

    protected $orderInfo;
    protected $orderGoods;
    protected $deliveryOrder;
    protected $userRankLog;

    public function __construct(
        OrderInfoRepository $orderInfo,
        OrderGoodsRepository $orderGoods,
        DeliveryOrderRepository $deliveryOrder,
        UserRankLogRepository $userRankLog)
    {
        parent::__construct();

        $this->orderInfo = $orderInfo;
        $this->orderGoods = $orderGoods;
        $this->deliveryOrder = $deliveryOrder;
        $this->userRankLog = $userRankLog;
    }

    public function index(Request $request)
    {
        return $this->lists($request);
    }

    public function lists(Request $request)
    {
        $seo_title = '用户中心';

        $params = $request->all();
		$params['order_status'] = $request->get('order_status') ?? 'all';
        $is_delete = $request->get('is_delete',0);

        // 获取数据
        $where = [];
        $whereIn = [];
        // 搜索条件 name 商品名称/订单编号/买家账号
        $search_arr = ['name', 'order_status', 'add_time_begin', 'add_time_end', 'shop_name', 'evaluate_status', 'pay_type',
            'service_type', 'pickup', 'order_type', 'user_mobile', 'consignee_name', 'consignee_mobile', 'consignee_address'];
        foreach ($search_arr as $v) {
            if (isset($params[$v]) && !empty($params[$v])) {
                if ($v == 'name') { // todo
//                    $where[] = [$v, 'like', "%{$params[$v]}%"];
                    $order_ids = DB::table('order_goods')->select(['order_id'])->where('goods_name', 'like', "%{$params[$v]}%")
                        ->pluck('order_id')->toArray();
                    $whereIn[] = ['order_id', $order_ids];
                } elseif ($v == 'add_time_begin' || $v == 'add_time_end') {

                } elseif ($v == 'order_status') {
                    if ($params[$v] == 'unpayed') {
                        $whereIn[] = ['order_status', [OS_UNCONFIRMED, OS_CONFIRMED]];
                        $where[] = ['pay_status', PS_UNPAYED];
                    } elseif ($params[$v] == 'unshipped') {
                        $where[] = ['order_status', OS_CONFIRMED];
                        $where[] = ['shipping_status', SS_UNSHIPPED];
                        $whereIn[] = ['pay_status', [PS_PAYING, PS_PAYED]];
                    } elseif ($params[$v] == 'shipped') {
                        $whereIn[] = ['order_status', [OS_CONFIRMED, OS_SPLITED]];
                        $where[] = ['shipping_status', SS_SHIPPED];
                        $where[] = ['pay_status', PS_PAYED];
                    } elseif ($params[$v] == 'unevaluate') {
                        $whereIn[] = ['order_status', [OS_CONFIRMED, OS_SPLITED, OS_RETURNED_PART, OS_ONLY_REFOUND]];
						$where[] = ['shipping_status', SS_RECEIVED];
						$where[] = ['pay_status', PS_PAYED];
                        $where[] = ['evaluate_status', ES_UNEVALUATED];
                    }  elseif ($params[$v] == 'finished') {
                        $whereIn[] = ['order_status', [OS_CONFIRMED, OS_SPLITED, OS_RETURNED_PART, OS_ONLY_REFOUND]];
                        $where[] = ['shipping_status', SS_RECEIVED];
                        $where[] = ['pay_status', PS_PAYED];
                    } elseif ($params[$v] == 'backing') {
						$whereIn[] = ['order_status', [OS_ONLY_REFOUND]];
						$where[] = ['pay_status', PS_PAYED];
					}
                } elseif ($v == 'evaluate_status') {
                    if ($params[$v] == 'unevaluate') {
                        $whereIn[] = ['order_status', [OS_CONFIRMED, OS_SPLITED, OS_RETURNED_PART, OS_ONLY_REFOUND]];
						$where[] = ['shipping_status', SS_RECEIVED];
						$where[] = ['pay_status', PS_PAYED];
                        $where[] = ['evaluate_status', ES_UNEVALUATED];
                    }
                } else {
                    $where[] = [$v, $params[$v]];
                }
            }
        }

        $where[] = ['user_id', $this->user_id];
        $where[] = ['is_delete', $is_delete];

        // 列表
        $condition = [
            'with' => ['pickup','orderGoods'],
            'where' => $where,
            'where_in' => $whereIn,
            'sortname' => 'order_id',
            'sortorder' => 'desc'
        ];

        list($list, $total) = $this->orderInfo->getFrontendOrderList($condition);

        $pageHtml = frontend_pagination($total);
        $page_array = frontend_pagination($total,true);
        $page_json = json_encode($page_array);
        $pay_term = '1';
        $pay_term_unit_name = '天';
        $order_status_list = [
            '' => '全部',
            'unpayed' => '等待买家付款',
            'unshipped' => '等待卖家发货',
            'shipped' => '卖家已发货',
            'finished' => '交易成功',
            'closed' => '交易关闭',
            'backing' => '退款中的订单',
        ];
        $evaluate_status_list = [
            '' => '全部',
            'unevaluate' => '待评价',
            'evaluate' => '已评价',
        ];
        $order_time_list = [
            '' => '全部',
            'ThreeMonth' => '近三个月订单',
            'ThisYear' => '今年内订单',
            'OneYear' => '2017年订单',
            'TwoYear' => '2016年订单',
            'ThreeYear' => '2015年订单',
            'OldYear' => '2015年以前订单',
        ];
        $pickup_list = [
           '全部' ,
           '普通快递' ,
           '上门自提' ,
        ];
        $order_counts = $this->orderInfo->getOrderCounts($this->user_id, 0, 1, $is_delete);
		// 格式化订单数量数据
		$order_counts_data = [];
		$order_state_format = $this->orderInfo->getOrderStateFormat();
		foreach ($order_counts as $key=>$item) {
			if (isset($order_state_format[$key]) && in_array($key, ['all','unpayed','unshipped','shipped','unevaluate'])) {
				$order_counts_data[] = [
					'key' => $key,
					'label' => $order_state_format[$key],
					'value' => $item
				];
			}
		}
        $nav_default = 'order';
        $is_exchange = 0;
        $show_merge_pay_button = false;
        $customer_service_term = sysconf('customer_service_term') * 24*60*60;
        $comment_status = 1;


        $order_status = $params['order_status'];
        $compact = compact('seo_title','pageHtml', 'list', 'page_json',
            'pay_term','pay_term_unit_name','order_status_list',
            'evaluate_status_list','order_time_list','pickup_list',
            'order_counts','order_counts_data','nav_default','is_exchange',
            'show_merge_pay_button','customer_service_term','comment_status','is_delete',
            'order_status');

        if ($request->ajax() && !is_app()) { // web端访问 ajax请求
            $render = view('user.order.partials._list', $compact)->render();
            return result(0, $render);
        }

//        dd($list);
        $webData = []; // web端（pc、mobile）数据对象
        $data = [
            'app_prefix_data' => [
                'page' => $page_array,
                'list' => $list,
                'pay_term' => $pay_term,
                'pay_term_unit_name' => $pay_term_unit_name,
                'order_status_list' => $order_status_list,
                'evaluate_status_list' => $evaluate_status_list,
                'order_time_list' => $order_time_list,
                'pickup_list' => $pickup_list,
                'order_counts' => $order_counts,
                'order_counts_data' => $order_counts_data,
                'nav_default' => $nav_default,
                'is_exchange' => $is_exchange,
                'show_merge_pay_button' => $show_merge_pay_button,
                'customer_service_term' => $customer_service_term,
                'comment_status' => $comment_status,
            ],
            'app_suffix_data' => [],
            'web_data' => $webData,
            'compact_data' => $compact,
            'tpl_view' => 'user.order.index'
        ];
        $this->setData($data); // 设置数据
        return $this->displayData(); // 模板渲染及APP客户端返回数据
    }

    /**
     * 订单详情
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function info(Request $request)
    {
        $seo_title = '用户中心';

        $id = $request->get('id');


        // 获取数据
        $operate_text = '';

        $customer_service_term = sysconf('customer_service_term') * 24*60*60;
        $types = [
            "无需物流",
            "指配派送",
            "物流众包",
            "第三方物流",
            "达达物流"
        ];
        $comment_status = 1;

        $condition = [
            ['order_id', $id],
        ];
        $order_info = $this->orderInfo->getFrontendOrderInfo($condition);
        if (empty($order_info)) {
            abort(404, '订单id无效');
        }
        $buttons = $order_info['buttons'];
        $order_schedules = $this->orderInfo->getOrderSchedules($order_info,1);

        $compact = compact('seo_title','operate_text','buttons','customer_service_term',
            'types','comment_status','order_info','order_schedules');
        $webData = []; // web端（pc、mobile）数据对象
        $data = [
            'app_prefix_data' => [
                'operate_text' => $operate_text,
                'buttons' => $buttons,
                'customer_service_term' => $customer_service_term,
                'types' => $types,
                'comment_status' => $comment_status,
                'order_info' => $order_info,
            ],
            'app_suffix_data' => [],
            'web_data' => $webData,
            'compact_data' => $compact,
            'tpl_view' => 'user.order.info'
        ];
        $this->setData($data); // 设置数据
        return $this->displayData(); // 模板渲染及APP客户端返回数据
    }

    public function editOrder(Request $request)
    {
        // from=info&type=cancel&id=1&is_exchange=
        // from=list&type=cancel&id=267&is_exchange=0
        $from = $request->get('from', ''); // 来源页面 list info
        $type = $request->get('type', ''); // 操作方法 如：cancel-取消订单 delay-延长收货时间
        $order_id = $request->get('id'); // 订单id
        $is_exchange = $request->get('is_exchange', 0);
        $uuid = make_uuid();

        switch ($type)
        {
            case 'cancel':/*取消订单*/
                $close_trad_reason = explode("\r\n", sysconf('user_close_trad_reason'));
                view()->share('close_trad_reason', $close_trad_reason);

                break;

            case 'delay':/*延长确认收货时间*/
                $orderInfo = OrderInfo::where('order_id', $order_id)->first()->toArray();
                $countdown = $this->orderInfo->getOrderCountdown($orderInfo);
                $delay_days = $orderInfo['delay_days'];
                if ($countdown <= $delay_days*24*60*60) {
                    return result(-1,null,'当前时间距离自动确认收货期限大于'.$delay_days.'天，请在小于'.$delay_days.'天时再选择延长收货！');
//                    return result(-1,null,'当前时间距离自动确认收货期限大于三天，请在小于三天时再选择延长收货！');
                }

                $extend_receiving_days = explode("\r\n", sysconf('extend_receiving_days'));
                view()->share('extend_receiving_days', $extend_receiving_days);

                break;

            case 'confirm':/*确认收货*/

                break;

            default :
                break;
        }

        $render = view('user.order.edit_'.$type, compact('uuid', 'order_id'))->render();
        return result(0, $render);
    }


    /**
     * 取消订单保存数据
     *
     * @param Request $request
     * @return array|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function cancel(Request $request)
    {
        $order_id = $request->post('id'); // 批量操作时，以英文逗号分隔订单id
        $reason = $request->post('reason', '');  // 取消原因 如：未及时付款

        $condition = [
            ['order_id', $order_id],
            ['user_id', $this->user_id]
        ];
        $info = $this->orderInfo->getFrontendOrderInfo($condition);
        if (empty($info)) {
            return result(-1, null, '订单ID无效！');
        }
        if (!in_array('buyer_cancel', $info['buttons'])) {
            return result(-1, null, '订单状态无效！');
        }
        $ret = OrderCancel::dispatch($info,'buyer_cancel', $reason);
        if ($ret === false) {
            return result(-1, null, '取消订单失败！');
        }

        return result(0, null, '取消订单成功！');

    }

    /**
     * 确认收货保存数据
     *
     * @param Request $request
     * @return array|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function confirm(Request$request)
    {
        $order_id = $request->post('id'); //

        $condition = [
            ['order_id', $order_id],
            ['user_id', $this->user_id]
        ];
        $info = $this->orderInfo->getFrontendOrderInfo($condition);
        if (empty($info)) {
            return result(-1, null, '订单ID无效！');
        }
        if (!in_array('buyer_confirm_receipt', $info['buttons'])) {
            return result(-1, null, '订单状态无效！');
        }
        $update = [
            'shipping_status' => SS_RECEIVED,
            'end_time' => time(),
            'last_time' => time(),
            'take_time' => time()
        ];
        $ret = OrderInfo::where([['user_id',$this->user_id],['order_id', $order_id]])
            ->update($update);
        if (!$ret) {
            return result(-1, null,'确认收货失败！');
        }
        // 添加成长值记录
        $this->userRankLog->addData($this->user_id, $order_id);

        return result(0,null,'确认收货成功！');
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
     * 查看物流
     *
     * @param Request $request
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function express(Request $request)
    {
        $seo_title = '用户中心';

        $id = $request->get('id');
        if (!$id) {
            abort(403, INVALID_PARAM);
        }

        // 获取数据
        $express = $this->deliveryOrder->getFrontendExpressData($id);
        $nav_default = 'order';
        $is_exchange = 0;

        $compact = compact('seo_title','express','nav_default','is_exchange');
        $webData = []; // web端（pc、mobile）数据对象
        $data = [
            'app_prefix_data' => [
                'express' => $express,
                'nav_default' => $nav_default,
                'is_exchange' => $is_exchange
            ],
            'app_suffix_data' => [],
            'web_data' => $webData,
            'compact_data' => $compact,
            'tpl_view' => 'user.order.express'
        ];
        $this->setData($data); // 设置数据
        return $this->displayData(); // 模板渲染及APP客户端返回数据
    }

    /**
     * 删除/彻底删除/还原订单
     *
     * @param Request $request
     * @return array|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $order_id = is_array($request->post('order_id')) ? array_filter($request->post('order_id')) : $request->post('order_id'); // 批量删除 为数组
        $type = $request->post('type', 1); // 0-还原订单 1-放入回收站 2-彻底删除 3-批量删除订单(确认弹出框)

        if ($type == 3) {
            return result(0, null, '您确定要删除被选中的'.count($order_id).'个订单吗？');
        }

        if ($type == 2) {
            // 彻底删除
            $is_delete = 2;
            $msg = '订单彻底删除';
        } elseif ($type == 1) {
            // 放入回收站
            $is_delete = 1;
            $msg = '订单删除';
        } else {
            // 还原订单
            $is_delete = 0;
            $msg = '还原订单';
        }

        if (is_array($order_id)) {
            // 批量删除
            $ret = OrderInfo::whereIn('order_id', $order_id)->update(['is_delete' => $is_delete]);
            if ($ret === false) {
                return result(-1,null, $msg.'失败');
            }

            // 成功
            return result(0, null, '成功'.$msg.'了'.count($order_id).'个订单', ['ids'=>$order_id]);
        } else {
            $condition = [
                ['order_id', $order_id],
                ['user_id', $this->user_id]
            ];
            $info = $this->orderInfo->getFrontendOrderInfo($condition);
            if (empty($info)) {
                return result(-1, null, '订单ID无效！');
            }

            if ($type == 2) {
                // 彻底删除
                if (!in_array('buyer_drop', $info['buttons'])) {
                    return result(-1, null, '订单状态无效！');
                }
            } elseif ($type == 1) {
                // 放入回收站
                if (!in_array('buyer_delete', $info['buttons'])) {
                    return result(-1, null, '订单状态无效！');
                }
            } else {
                // 还原订单
                if (!in_array('buyer_restore', $info['buttons'])) {
                    return result(-1, null, '订单状态无效！');
                }
            }

            $ret = OrderInfo::where('order_id', $order_id)->update(['is_delete' => $is_delete]);
            if ($ret === false) {
                return result(-1,null, $msg.'失败');
            }

            // 成功
            return result(0, null, $msg.'成功');
        }


    }

}
