<?php

namespace App\Modules\Backend\Http\Controllers\Finance;


use App\Modules\Base\Http\Controllers\Backend;
use App\Repositories\ShopClassRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShopsStatisticsController extends Backend
{

    private $links = [
        ['url' => 'finance/shops-statistics/index', 'text' => '新增店铺'],
        ['url' => 'finance/shops-statistics/sales-list', 'text' => '店铺销售统计'],
        ['url' => 'finance/shops-statistics/areas-list', 'text' => '店铺地区分布'],
    ];

    protected $shopClass;

    public function __construct(ShopClassRepository $shopClass)
    {
        parent::__construct();

        $this->shopClass = $shopClass;

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

        // 获取店铺分类列表
        $where = [];
        $condition = [
            'where' => $where,
            'limit' => 0, // 不分页
            'sortname' => 'created_at',
            'sortorder' => 'desc'
        ];
        list($cat_list, $total) = $this->shopClass->getList($condition, '', false, true);

        $compact = compact('title', 'cat_list');
        return view('finance.shops-statistics.index', $compact);
    }

    public function getData(Request $request)
    {
        list($y_data_today, $x_data) = get_statistic_new_shop_hour(Carbon::today()->format('Y-m-d'));
        list($y_data_yesterday, $x_data) = get_statistic_new_shop_hour(Carbon::yesterday()->format('Y-m-d'));
        $extra = [
            'x_data' => $x_data, // x轴一天24小时
            'x_name' => "时间点",
            'y_data_today' => $y_data_today, // 店铺数量数据 今日
            'y_data_yesterday' => $y_data_yesterday // 店铺数量数据 昨日
        ];
        return result(0, null, '', $extra);
    }

    public function salesList(Request $request)
    {
        $title = '店铺销售统计';
        $fixed_title = '店铺统计 - '.$title;
        $this->sublink($this->links, 'sales-list');

        $action_span = [];

        $explain_panel = [
            '符合以下任何一种条件的订单即为有效订单：1、采用在线支付方式支付并且已付款未发生退款或退款未完成；2、采用货到付款方式支付并且交易成功；3、交易成功的订单',
            '统计的有效订单中包含普通商品订单、自由购订单、堂内点餐订单，提货券订单，不包含积分兑换的订单、线下收银订单',
            '下单量：统计选择时间内的所有订单状态下的订单总量',
            '下单金额：统计选择时间内的所有订单状态下的订单的订单总金额',
            '退款数量：统计选择时间内的所有退款成功的退款量',
            '退款金额：统计选择时间内的所有退款成功的退款总金额',
            '下单会员数、下单量、下单金额、有效订单量、有效订单金额按时间筛选，只要下单时间在筛选的时间内，即可被统计出来',
            '退款数量、退款金额按时间筛选，只要退款成功时间在筛选时间内，即可被统计出来，退款数量和退款金额包含确认收货后的退款统计',
        ];
        $blocks = [
            'explain_panel' => $explain_panel,
            'fixed_title' => $fixed_title,
            'action_span' => $action_span
        ];

        $this->setLayoutBlock($blocks); // 设置block

        // 获取店铺分类列表
        $where = [];
        $condition = [
            'where' => $where,
            'limit' => 0, // 不分页
            'sortname' => 'created_at',
            'sortorder' => 'desc'
        ];
        list($cat_list, $total) = $this->shopClass->getList($condition, '', false, true);

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
            COUNT(DISTINCT o.user_id) as users_count,
            SUM(IF(o.pay_status=2,1,0)) as order_count_valid,
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

        $compact = compact('list', 'total', 'pageHtml', 'cat_list');
        if ($request->ajax()) {
            $render = view('finance.shops-statistics.partials._sales_list', $compact)->render();
            return result(0, $render);
        }
        return view('finance.shops-statistics.sales_list', $compact);
    }

    public function areasList(Request $request)
    {
        $title = '店铺地区分布';
        $fixed_title = '店铺统计 - '.$title;
        $this->sublink($this->links, 'areas-list');

        $action_span = [];

        $explain_panel = [
            '系统支持按省、市、区/县查询各个地区下的店铺数量',
        ];
        $blocks = [
            'explain_panel' => $explain_panel,
            'fixed_title' => $fixed_title,
            'action_span' => $action_span
        ];

        $this->setLayoutBlock($blocks); // 设置block

        // 获取店铺分类列表
        $where = [];
        $condition = [
            'where' => $where,
            'limit' => 0, // 不分页
            'sortname' => 'created_at',
            'sortorder' => 'desc'
        ];
        list($cat_list, $total) = $this->shopClass->getList($condition, '', false, true);

        list($list, $total) = [[], 0];
        $pageHtml = pagination($total);

        $compact = compact('list', 'total', 'pageHtml', 'cat_list');
        if ($request->ajax()) {
            $render = view('finance.shops-statistics.partials._areas_list', $compact)->render();
            return result(0, $render);
        }
        return view('finance.shops-statistics.areas_list', $compact);
    }

}