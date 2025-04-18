<?php

namespace App\Modules\Backend\Http\Controllers\Finance;


use App\Modules\Base\Http\Controllers\Backend;
use App\Repositories\Common\LrwRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UsersStatisticsController extends Backend
{

    private $links = [
        ['url' => 'finance/users-statistics/index', 'text' => '新增会员'],
        ['url' => 'finance/users-statistics/users-list', 'text' => '会员分析'],
//        ['url' => 'finance/users-statistics/areas-list', 'text' => '会员区域分析'],
//        ['url' => 'finance/users-statistics/ranks-list', 'text' => '会员等级分析'],
//        ['url' => 'finance/users-statistics/sales-list', 'text' => '会员消费排行'],
    ];


    public function __construct()
    {
        parent::__construct();


    }

    public function index(Request $request)
    {
        $title = '新增会员';
        $fixed_title = '会员统计 - '.$title;
        $this->sublink($this->links, 'index');

        $action_span = [];

        $explain_panel = [
            '统计图展示了时间段内新增会员数的走势和与前一时间段的对比',
        ];
        $blocks = [
            'explain_panel' => $explain_panel,
            'fixed_title' => $fixed_title,
            'action_span' => $action_span
        ];

        $this->setLayoutBlock($blocks); // 设置block

        $compact = compact('title');
        return view('finance.users-statistics.index', $compact);
    }

    public function usersList(Request $request)
    {
        $title = '会员分析';
        $fixed_title = '会员统计 - '.$title;
        $this->sublink($this->links, 'users-list');

        $action_span = [];

        $explain_panel = [
            '符合以下任何一种条件的订单即为有效订单：1、采用在线支付方式支付并且已付款未发生退款或退款未完成；2、采用货到付款方式支付并且交易成功；3、交易成功的订单',
            '统计的有效订单中包含普通商品订单、自由购订单、堂内点餐订单，提货券订单，不包含积分兑换的订单、线下收银订单'
        ];
        $blocks = [
            'explain_panel' => $explain_panel,
            'fixed_title' => $fixed_title,
            'action_span' => $action_span
        ];

        $this->setLayoutBlock($blocks); // 设置block

        // 下单总金额前15名买家
        $order_amount_top_users = DB::table('order_info as o')->selectRaw('SUM(o.money_paid + o.surplus) as total_fee, o.user_id,u.mobile,u.user_name')
            ->leftJoin('user as u', 'u.user_id', '=', 'o.user_id')
            ->groupBy('user_id')
            ->orderBy('total_fee', 'desc')
            ->limit(15)
            ->get();

        // 下单量前15名买家
        $order_count_top_users = DB::table('order_info as o')
            ->selectRaw('count(o.order_id) as order_count, o.user_id,u.mobile,u.user_name')
            ->leftJoin('user as u', 'u.user_id', '=', 'o.user_id')
            ->groupBy('user_id')
            ->orderBy('order_count', 'desc')
            ->limit(15)
            ->get();

        $compact = compact('title', 'order_amount_top_users', 'order_count_top_users');
        return view('finance.users-statistics.users_list', $compact);
    }

    public function areasList(Request $request)
    {
        $title = '会员区域分析';
        $fixed_title = '会员统计 - '.$title;
        $this->sublink($this->links, 'areas-list');

        $action_span = [];

        $explain_panel = [
            '符合以下任何一种条件的订单即为有效订单：1、采用在线支付方式支付并且已付款未发生退款或退款未完成；2、采用货到付款方式支付并且交易成功；3、交易成功的订单',
            '统计时间段内各个区域所有会员有效订单的下单会员数、下单量和下单总额统计数据',
            '统计的有效订单中包含普通商品订单、自由购订单、堂内点餐订单，不包含提货券订单，积分兑换的订单、线下收银订单',
        ];
        $blocks = [
            'explain_panel' => $explain_panel,
            'fixed_title' => $fixed_title,
            'action_span' => $action_span
        ];

        $this->setLayoutBlock($blocks); // 设置block


        $compact = compact('title');
        return view('finance.users-statistics.areas_list', $compact);
    }

    public function ranksList(Request $request)
    {
        $title = '会员等级分析';
        $fixed_title = '会员统计 - '.$title;
        $this->sublink($this->links, 'ranks-list');

        $action_span = [];

        $explain_panel = [];
        $blocks = [
            'explain_panel' => $explain_panel,
            'fixed_title' => $fixed_title,
            'action_span' => $action_span
        ];

        $this->setLayoutBlock($blocks); // 设置block

        $user_rank_data = get_statistic_user_rank();
        $compact = compact('title', 'user_rank_data');
        return view('finance.users-statistics.ranks_list', $compact);
    }

    public function salesList(Request $request)
    {
        $title = '会员消费排行';
        $fixed_title = '会员统计 - '.$title;
        $this->sublink($this->links, 'sales-list');

        $action_span = [];

        $explain_panel = [
            '符合以下任何一种条件的订单即为有效订单：1、采用在线支付方式支付并且已付款未发生退款或退款未完成；2、采用货到付款方式支付并且交易成功；3、交易成功的订单',
            '统计的有效订单中包含普通商品订单、自由购订单、堂内点餐订单，提货券订单，不包含积分兑换的订单、线下收银订单',
            '默认会员消费排行是按有效订单数量降序排列',
            '订单总数量：统计选择时间内，会员的所有订单状态下的订单总数量',
            '订单总金额：统计选择时间内，会员的所有订单状态下的订单的订单总金额',
            '退款量：统计选择时间内，会员的所有退款成功的退款量',
            '退款金额：统计选择时间内，会员的所有退款成功的退款总金额',
        ];
        $blocks = [
            'explain_panel' => $explain_panel,
            'fixed_title' => $fixed_title,
            'action_span' => $action_span
        ];

        $this->setLayoutBlock($blocks); // 设置block

        list($list, $total) = [[], 0];
        $pageHtml = pagination($total);

        $compact = compact('title', 'list', 'total', 'pageHtml');
        if ($request->ajax()) {
            $render = view('finance.users-statistics.partials._sales_list', $compact)->render();
            return result(0, $render);
        }
        return view('finance.users-statistics.sales_list', $compact);
    }

    /**
     * 会员数量数据
     *
     * @param Request $request
     * @return array
     */
    public function getData(Request $request)
    {
        list($y_data_today, $x_data) = get_statistic_new_user_hour(Carbon::today()->format('Y-m-d'));
        list($y_data_yesterday, $x_data) = get_statistic_new_user_hour(Carbon::yesterday()->format('Y-m-d'));
        $extra = [
            'x_data' => $x_data, // x轴一天24小时
            'x_name' => "时间点",
            'y_data_today' => $y_data_today, // 会员数量数据 今日
            'y_data_yesterday' => $y_data_yesterday // 会员数量数据 昨日
        ];
        return result(0, null, '', $extra);
    }

}