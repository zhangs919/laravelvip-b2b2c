<?php

namespace app\Modules\Backend\Http\Controllers\Finance;


use App\Modules\Base\Http\Controllers\Backend;
use Illuminate\Http\Request;

class ShopsStatisticsController extends Backend
{

    private $links = [
        ['url' => 'finance/shops-statistics/index', 'text' => '新增店铺'],
        ['url' => 'finance/shops-statistics/sales-list', 'text' => '店铺销售统计'],
        ['url' => 'finance/shops-statistics/areas-list', 'text' => '店铺地区分布'],
    ];


    public function __construct()
    {
        parent::__construct();


    }

    public function index(Request $request)
    {
        $title = '新增店铺';
        $fixed_title = '店铺统计 - '.$title;
        $this->sublink($this->links, 'index');

        $action_span = [];

        $explain_panel = [
            '统计图展示了时间段内新增店铺数的走势和与前一时间段的对比',
        ];
        $blocks = [
            'explain_panel' => $explain_panel,
            'fixed_title' => $fixed_title,
            'action_span' => $action_span
        ];

        $this->setLayoutBlock($blocks); // 设置block

        $compact = compact('title');
        return view('finance.shops-statistics.index', $compact);
    }

    public function getData(Request $request)
    {
        $extra = [
            'x_data' => range(0,23,1), // x轴一天24小时
            'x_name' => "时间点",
            'y_data_today' => range(0, 24, 1), // 店铺数量数据 今日
            'y_data_yesterday' => range(0, 24) // 店铺数量数据 昨日
        ];
        return result(0, null, '', $extra);
    }

}