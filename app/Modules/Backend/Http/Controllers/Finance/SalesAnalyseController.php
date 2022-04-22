<?php

namespace app\Modules\Backend\Http\Controllers\Finance;


use App\Modules\Base\Http\Controllers\Backend;
use Illuminate\Http\Request;

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

        $compact = compact('title');
        return view('finance.sales-analyse.order', $compact);
    }

    public function getData(Request $request)
    {
        $extra = [
            'sum_amt' => "0.00",
            'sum_cnt' => 0,
            'x_data' => range(0,23,1), // x轴一天24小时
            'x_name' => "时间点",
            'y_data_amt' => range(0, 24, 1), // 店铺数量数据 今日
            'y_data_cnt' => range(0, 24) // 店铺数量数据 昨日
        ];
        return result(0, null, '', $extra);
    }

    public function getOrderData(Request $request)
    {
        $data = [
            'back_amount' => "1.00",
            'cancel_amount' => 35,
            'order_amount' => "12323.43",
            'order_amount_valid' => "234.42",
            'order_count' => 53,
            'users_count' => 32
        ];
        return json_encode($data);
    }

}