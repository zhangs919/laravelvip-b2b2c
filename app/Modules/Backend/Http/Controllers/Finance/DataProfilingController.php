<?php

namespace App\Modules\Backend\Http\Controllers\Finance;


use App\Modules\Base\Http\Controllers\Backend;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class DataProfilingController extends Backend
{


    public function __construct()
    {
        parent::__construct();


    }

    public function index(Request $request)
    {
        $title = '数据概况';
        $fixed_title = '统计 - ' . $title;

        $action_span = [];

        $explain_panel = [
            '符合以下任何一种条件的订单即为有效订单：1）采用在线支付方式支付并且已付款；2）采用货到付款方式支付并且交易已完成',
            '下单金额、下单会员数、下单量、下单商品数、评价价格、平均客单价中统计的数量是包含普通订单、自由购订单、堂内点餐中的数据',
        ];
        $blocks = [
            'explain_panel' => $explain_panel,
            'fixed_title' => $fixed_title,
            'action_span' => $action_span
        ];

        $this->setLayoutBlock($blocks); // 设置block
        $update_time = Carbon::now()->toDateTimeString();

        // 有效销售额
        list($y_data_today, $x_data) = get_statistic_order_amount_hour(Carbon::today()->format('Y-m-d'));
        list($y_data_yesterday, $x_data) = get_statistic_new_user_hour(Carbon::yesterday()->format('Y-m-d'));

        // 7日内店铺销售TOP10
        $date_start = Carbon::now()->subDays(7)->format('Y-m-d 00:00:00');
        $date_end = Carbon::now()->format('Y-m-d 23:59:59');
        $order_amount_top_shops = DB::table('order_info as o')->selectRaw('SUM(o.money_paid + o.surplus) as total_fee, o.shop_id,s.shop_name')
            ->leftJoin('shop as s', 's.shop_id', '=', 'o.shop_id')
            ->groupBy('shop_id')
            ->whereBetween('o.created_at', [$date_start, $date_end])
            ->orderBy('total_fee', 'desc')
            ->limit(10)
            ->get();

        $goods_sale_top = DB::table('order_goods')->selectRaw('goods_id,goods_name,SUM(goods_number) as total_num')
            ->groupBy('goods_id')
            ->whereBetween('created_at', [$date_start, $date_end])
            ->orderBy('total_num', 'desc')
            ->limit(10)
            ->get();

        $compact = compact('title', 'update_time', 'x_data', 'y_data_today', 'y_data_yesterday',
            'order_amount_top_shops','goods_sale_top');
        return view('finance.data-profiling.index', $compact);
    }

    public function getData(Request $request)
    {
        $data = get_statistic_data_profiling();
        return json_encode($data);
    }

}