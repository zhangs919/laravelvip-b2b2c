<?php

namespace app\Modules\Backend\Http\Controllers\Finance;


use App\Modules\Base\Http\Controllers\Backend;
use Illuminate\Http\Request;

class DataProfilingController extends Backend
{


    public function __construct()
    {
        parent::__construct();


    }

    public function index(Request $request)
    {
        $title = '数据概况';
        $fixed_title = '统计 - '.$title;

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

        $compact = compact('title');
        return view('finance.data-profiling.index', $compact);
    }

    public function getData(Request $request)
    {
        $data = [
            'goods_count' => "113",
            'shops_count' => 23,
            'today_new_goods_count' => "0",
            'today_new_shops_count' => "0",
            'today_new_users_count' => "1",
            'today_order_amount' => "0.00",
            'today_order_count' => "0",
            'today_order_goods_count' => "0",
            'today_order_users_count' => "0",
            'users_count' => "57",
        ];
        return json_encode($data);
    }

}