<?php

namespace app\Modules\Backend\Http\Controllers\Finance;


use App\Modules\Base\Http\Controllers\Backend;
use Illuminate\Http\Request;

class IndustryAnalyseController extends Backend
{


    public function __construct()
    {
        parent::__construct();


    }

    public function index(Request $request)
    {
        $title = '行业分析';
        $fixed_title = '统计 - '.$title;

        $action_span = [];

        $explain_panel = [
            '符合以下任何一种条件的订单即为有效订单：1、采用在线支付方式支付并且已付款未发生退款或退款未完成；2、采用货到付款方式支付并且交易成功；3、交易成功的订单',
            '销售额：选择的时间内，该分类下商品的所有订单总金额',
            '有效销售额：选择的时间内，该分类下商品的所有有效订单总金额',
            '总下单量：选择的时间内交所有状态的订单总数量',
            '有效下单量：选择的时间内交易成功、已付款未发生退款或退款未完成、货到付款支付并且交易成功、线下订单未退款数',
        ];
        $blocks = [
            'explain_panel' => $explain_panel,
            'fixed_title' => $fixed_title,
            'action_span' => $action_span
        ];

        $this->setLayoutBlock($blocks); // 设置block

        $compact = compact('title');
        return view('finance.industry-analyse.index', $compact);
    }

    public function industryData(Request $request)
    {
        $extra = [
            'x' => ["12.00","765.00","32.00","32.00","43.00"],
            'y' => ["食品饮料","生鲜食品","饮料/酒水","生鲜食品","食品饮料"]
        ];

        return result(0,null,'',$extra);
    }

}