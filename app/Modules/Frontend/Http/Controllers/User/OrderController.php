<?php

namespace App\Modules\Frontend\Http\Controllers\User;

use App\Models\GoodsHistory;
use App\Modules\Base\Http\Controllers\UserCenter;
use App\Repositories\GoodsHistoryRepository;
use App\Repositories\OrderGoodsRepository;
use App\Repositories\OrderInfoRepository;
use Illuminate\Http\Request;

class OrderController extends UserCenter
{

    protected $orderInfo;
    protected $orderGoods;

    public function __construct()
    {
        parent::__construct();

        $this->orderInfo = new OrderInfoRepository();
        $this->orderGoods = new OrderGoodsRepository();
    }

    public function index(Request $request)
    {
        return $this->lists($request);
    }

    public function lists(Request $request)
    {
        $seo_title = '用户中心';

        $params = $request->all();
        $params['order_status'] = $request->get('order_status', '');


        // 获取数据
        $where = [];
        // 搜索条件 name 商品名称/订单编号/买家账号
        $search_arr = ['name', 'order_status', 'add_time_begin', 'add_time_end', 'shop_name', 'evaluate_status', 'pay_type',
            'service_type', 'pickup', 'order_type', 'user_mobile', 'consignee_name', 'consignee_mobile', 'consignee_address'];
        foreach ($search_arr as $v) {
            if (isset($params[$v]) && !empty($params[$v])) {
                if ($v == 'name') { // todo
//                    $where[] = [$v, 'like', "%{$params[$v]}%"];
                } elseif ($v == 'add_time_begin' || $v == 'add_time_end') {

                }
                else {
                    $where[] = [$v, $params[$v]];
                }
            }
        }

        $where[] = ['user_id', $this->user_id];

        // 列表
        $condition = [
            'with' => ['orderGoods'],
            'where' => $where,
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
        $order_counts = [
            'all' => '0',
            'unpayed' => '0',
            'unshipped' => '0',
            'assign' => '0',
            'shipped' => '0',
            'backing' => '0',
            'unevaluate' => '0',
            'finished' => '0',
            'closed' => '0',
            'cancel' => '0',
        ];
        $nav_default = 'order';
        $is_exchange = 0;
        $show_merge_pay_button = false;
        $customer_service_term = 1296000;
        $comment_status = 1;

        $compact = compact('seo_title','pageHtml', 'list', 'page_json',
            'pay_term','pay_term_unit_name','order_status_list',
            'evaluate_status_list','order_time_list','pickup_list',
            'order_counts','nav_default','is_exchange',
            'show_merge_pay_button','customer_service_term','comment_status');

        if ($request->ajax() && !is_app()) { // web端访问 ajax请求
            $render = view('user.order.partials._list', $compact)->render();
            return result(0, $render);
        }

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
        $buttons = [
            'view_logistics',
        ];
        $customer_service_term = 1296000;
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
            abort(200, '订单id无效');
        }

        $compact = compact('seo_title','operate_text','buttons','customer_service_term',
            'types','comment_status','order_info');
        $webData = []; // web端（pc、mobile）数据对象
        $data = [
            'app_prefix_data' => [

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
        $from = $request->get('from', ''); // 来源页面
        $type = $request->get('type', ''); // 操作方法 如：cancel取消订单
        $order_id = $request->get('id'); // 订单id
        $is_exchange = $request->get('is_exchange', 0);

        switch ($type)
        {
            case 'cancel':
                $uuid = make_uuid();
                $reason_list = [];
                $render = view('user.order.order_cancel', compact('uuid', 'order_id', 'reason_list'))->render();
                return result(0, $render);
                break;

            case '':

                break;

            default :
                break;
        }


    }

    public function orderCancel(Request $request)
    {
        return result(0, null, '取消订单成功！');
    }
}