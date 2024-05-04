<?php

namespace App\Modules\Backend\Http\Controllers\Finance;


use App\Modules\Base\Http\Controllers\Backend;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class SalesAnalyseController extends Backend
{

    private $links = [
        ['url' => 'finance/sales-analyse/index', 'text' => '销售量统计'],
        ['url' => 'finance/sales-analyse/amount', 'text' => '销售额统计'],
        ['url' => 'finance/sales-analyse/order', 'text' => '订单统计'],
    ];


    public function __construct()
    {
        parent::__construct();


    }

    public function index(Request $request)
    {
        $title = '销售量统计';
        $fixed_title = '销售分析 - '.$title;
        $this->sublink($this->links, 'index');

        $action_span = [];

        $explain_panel = [
            '符合以下任何一种条件的订单即为有效订单：1、采用在线支付方式支付并且已付款未发生退款或退款未完成；2、采用货到付款方式支付并且交易成功；3、交易成功的订单',
            '统计图展示了符合搜索条件的有效订单中的下单数量在时间段内的走势情况',
            '统计的有效订单中包含普通商品订单、自由购订单、堂内点餐订单，提货券订单，不包含积分兑换的订单、线下收银订单',
        ];
        $blocks = [
            'explain_panel' => $explain_panel,
            'fixed_title' => $fixed_title,
            'action_span' => $action_span
        ];

        $this->setLayoutBlock($blocks); // 设置block

        $compact = compact('title');
        return view('finance.sales-analyse.index', $compact);
    }

    public function amount(Request $request)
    {
        $title = '销售额统计';
        $fixed_title = '销售分析 - '.$title;
        $this->sublink($this->links, 'amount');

        $action_span = [];

        $explain_panel = [
            '符合以下任何一种条件的订单即为有效订单：1、采用在线支付方式支付并且已付款未发生退款或退款未完成；2、采用货到付款方式支付并且交易成功；3、交易成功的订单',
            '统计图展示了符合搜索条件的有效订单中的下单金额在时间段内的走势情况',
            '统计的有效订单中包含普通商品订单、自由购订单、堂内点餐订单，提货券订单，不包含积分兑换的订单、线下收银订单',
        ];
        $blocks = [
            'explain_panel' => $explain_panel,
            'fixed_title' => $fixed_title,
            'action_span' => $action_span
        ];

        $this->setLayoutBlock($blocks); // 设置block

        $compact = compact('title');
        return view('finance.sales-analyse.amount', $compact);
    }

    public function order(Request $request)
    {
        $title = '订单统计';
        $fixed_title = '销售分析 - '.$title;
        $this->sublink($this->links, 'order');

        $action_span = [];

        $explain_panel = [
            '符合以下任何一种条件的订单即为有效订单：1、采用在线支付方式支付并且已付款未发生退款或退款未完成；2、采用货到付款方式支付并且交易成功；3、交易成功的订单',
            '统计的有效订单中包含普通商品订单、自由购订单、堂内点餐订单，提货券订单，不包含积分兑换的订单、线下收银订单',
        ];
        $blocks = [
            'explain_panel' => $explain_panel,
            'fixed_title' => $fixed_title,
            'action_span' => $action_span
        ];

        $this->setLayoutBlock($blocks); // 设置block

        $params = $request->all();
        $curPage = !empty($params['page']['cur_page']) ? $params['page']['cur_page'] : 1;
        $pageSize = !empty($params['page']['page_size']) ? $params['page']['page_size'] : 10;
        $where = [];
        // 搜索条件
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
        $model = DB::table('shop as s')->selectRaw('s.shop_id,s.shop_name,
            COUNT(DISTINCT o.order_id) as order_count,
            SUM(IF(o.pay_status=2,1,0)) as order_count_valid,
            SUM(IF(o.order_status=2,1,0) or IF(o.order_status=3,1,0)) as close_count,
            IFNULL(SUM(o.money_paid + o.surplus), 0.00) as order_amount,
            IFNULL(SUM(IF(o.pay_status=2,(o.money_paid + o.surplus),0)), 0.00) as order_amount_valid,
            COUNT(DISTINCT bo.order_id) as back_count,
            IFNULL(SUM(bo.refund_money),0.00) as back_amount')
            ->leftJoin('order_info as o', 'o.shop_id','=','s.shop_id')
            ->leftJoin('back_order as bo', 'bo.order_id','=','o.order_id')->groupBy('s.shop_id');
        // 排序
        $sortname = $request->get('sortname', 'shop_id');
        $sortname = 's.'.$sortname;
        $sortorder = $request->get('sortorder', 'asc');

        $total = DB::table('shop as s')->count();
        $list = $model->forPage($curPage, $pageSize)->orderBy($sortname, $sortorder)->get();
        $pageHtml = pagination($total);

        $compact = compact('list', 'total', 'pageHtml');
        if ($request->ajax()) {
            $render = view('finance.sales-analyse.partials._order', $compact)->render();
            return result(0, $render);
        }

        return view('finance.sales-analyse.order', $compact);
    }

    public function getData(Request $request)
    {
        // 有效销售额
        list($y_data_amt, $x_data) = get_statistic_order_amount_hour(Carbon::today()->format('Y-m-d'));
        list($y_data_cnt, $x_data) = get_statistic_order_count_hour(Carbon::today()->format('Y-m-d'));
        $extra = [
            'sum_amt' => format_price(array_sum($y_data_amt)),
            'sum_cnt' => array_sum($y_data_cnt),
            'x_data' => $x_data, // x轴一天24小时
            'x_name' => "时间点",
            'y_data_amt' => $y_data_amt, // 订单销售额数据
            'y_data_cnt' => $y_data_cnt // 订单销售量数据
        ];
        return result(0, null, '', $extra);
    }

    public function getOrderData(Request $request)
    {
        $back_amount = DB::table('back_order')
            ->selectRaw('SUM(refund_money) as total_fee')
            ->where('back_type', 1)
            ->value('total_fee');
        $order_amount = DB::table('order_info')
            ->selectRaw('SUM(money_paid + surplus) as total_fee')->value('total_fee');
        $order_amount_valid = DB::table('order_info')
            ->where('pay_status', PS_PAYED)
            ->selectRaw('SUM(money_paid + surplus) as total_fee')->value('total_fee');
        $order_count = DB::table('order_info')
            ->distinct('order_id')->count();
        $order_count_valid = DB::table('order_info')
            ->where('pay_status', PS_PAYED)
            ->distinct('order_id')->count();
        $users_count = DB::table('user')->count();

        $data = [
            'back_amount' => $back_amount,
            'order_amount' => $order_amount,
            'order_amount_valid' => $order_amount_valid,
            'order_count' => $order_count,
            'order_count_valid' => $order_count_valid,
            'users_count' => $users_count
        ];
        return json_encode($data);
    }

}