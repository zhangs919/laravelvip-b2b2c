<?php

namespace App\Modules\Seller\Http\Controllers\Store;

use App\Models\StoreGroup;
use App\Models\User;
use App\Modules\Base\Http\Controllers\Seller;
use App\Repositories\StoreRepository;
use Illuminate\Http\Request;

class TradeController extends Seller
{

    private $links = [
    ];

    protected $store;


    public function __construct(StoreRepository $store)
    {
        parent::__construct();

        $this->store = $store;

        $this->set_menu_select('store', 'store-trade-list');

    }

    public function lists(Request $request)
    {
        $title = '列表';
        $fixed_title = '网点销售统计 - '.$title;

        $action_span = [

        ];

        $explain_panel = [
            '系统根据自然周展示网点的所有支付信息，可通过起止时间、网点分组、网点名称查询支付信息，起止时间是根据订单的下单时间进行记录',
            '货到付款订单查询的起止时间按发货的时间进行统计查询，货到付款订单的付款时间按订单的确认收货时间计算',
            '订单支付成功即可产生资金记录，订单退款后仍然会产生记录，因此金额会时常变动，请熟知',
            '订单总额中包含店铺佣金、订单运费、活动款等，如果要与网点结算货款，请在结算中查看最终结算金额',
            '合计：如果有勾选一些信息，合计的就是当前勾选的信息；如果未勾选任何信息，则合计当前页面所有信息',
        ];
        $blocks = [
            'explain_panel' => $explain_panel,
            'fixed_title' => $fixed_title,
            'action_span' => $action_span
        ];

        $this->setLayoutBlock($blocks); // 设置block



        // 获取数据
        $params = $request->all();

        $where = [];
        $where[] = ['shop_id', seller_shop_info()->shop_id];
        // 搜索条件
        $search_arr = ['store_name'];
        foreach ($search_arr as $v) {
            if (isset($params[$v]) && !empty($params[$v])) {

                if ($v == 'store_name') {
                    $where[] = ['store_name', 'like', "%{$params[$v]}%"];
                } else {
                    $where[] = [$v, $params[$v]];
                }
            }
        }
        // 列表
        $condition = [
            'where' => $where,
            'sortname' => 'store_id',
            'sortorder' => 'asc',
        ];
        list($store_list, $total) = $this->store->getList($condition);

        $list = [];
        if (!$store_list->isEmpty()) {
            foreach ($store_list as $item) {
                // 订单数量大于0
                $list[] = [
                    'store_id' => $item->store_id,
                    'store_name' => $item->store_name,
                    'group_id' => $item->group_id,
                    'group_name' => $item->storeGroup->group_name ?? null,
                    'alipay' => '0.00',
                    'weixin' => '0.00',
                    'union' => '0.00',
                    'balance' => '0.00',
                    'cod' => '0.00',
                    'store_card_id' => '0',
                    'store_card_amount' => '0.00',
                    'bonus' => '0.00',
                    'shop_bonus' => '0.00',
                    'bonus_count' => '0',
                    'shop_bonus_count' => '0',
                    'gift_count' => '0',
                    'order_amount' => '0.00',
                    'order_count' => '0',
                    'time' => '', // 订单时间
                    'start_time' => '', // 订单时间
                    'end_time' => '', // 订单时间
                ];
            }
        }

        $pageHtml = pagination($total);
        $page_array = frontend_pagination($total,true);
        $page_json = json_encode($page_array);

        $group_list = StoreGroup::select(['group_id','group_name'])->get()->toArray();
        $start_time = null;
        $end_time = null;

        $compact = compact('title','list','pageHtml','page_json',
        'group_list','start_time','end_time');

        if ($request->ajax()) {
            $render = view('store.trade.partials._list', $compact)->render();
            return result(0, $render);
        }

        $webData = []; // web端（pc、mobile）数据对象
        $data = [
            'app_extra_data' => [],
            'app_prefix_data' => [
                'page' => $page_json,
                'list' => $list,
                'group_list' => $group_list,
                'start_time' => $start_time,
                'end_time' => $end_time,
            ],
            'app_context_data' => $this->getAppContext(),
            'app_suffix_data' => [],
            'web_data' => $webData,
            'compact_data' => $compact,
            'tpl_view' => 'store.trade.list'
        ];
        $this->setData($data); // 设置数据
        return $this->displayData(); // 模板渲染及APP客户端返回数据
    }

    public function detail(Request $request)
    {
        $title = '详情';
        $fixed_title = '网点销售统计 - '.$title;

        $action_span = [
            [
                'url' => '/store/trade/list',
                'icon' => 'fa-reply',
                'text' => '返回统计列表'
            ],
        ];

        $explain_panel = [
            '系统根据自然周展示网点的所有支付信息，可通过起止时间、网点分组、网点名称查询支付信息，起止时间是根据订单的下单时间进行记录',
            '货到付款订单查询的起止时间按发货的时间进行统计查询，货到付款订单的付款时间按订单的确认收货时间计算',
            '订单支付成功即可产生资金记录，订单退款后仍然会产生记录，因此金额会时常变动，请熟知',
            '订单总额中包含店铺佣金、订单运费、活动款等，如果要与网点结算货款，请在结算中查看最终结算金额',
            '合计：如果有勾选一些信息，合计的就是当前勾选的信息；如果未勾选任何信息，则合计当前页面所有信息',
        ];
        $blocks = [
            'explain_panel' => $explain_panel,
            'fixed_title' => $fixed_title,
            'action_span' => $action_span
        ];

        $this->setLayoutBlock($blocks); // 设置block



        // 获取数据
        $params = $request->all();

        list($list, $total) = [[], 0];
        $pageHtml = pagination($total);
        $page_array = frontend_pagination($total,true);
        $page_json = json_encode($page_array);

        $compact = compact('title','list','pageHtml','page_json');

        if ($request->ajax()) {
            $render = view('store.trade.partials._detail', $compact)->render();
            return result(0, $render);
        }

        $webData = []; // web端（pc、mobile）数据对象
        $data = [
            'app_extra_data' => [],
            'app_prefix_data' => [
                'page' => $page_json,
                'list' => $list,
            ],
            'app_context_data' => $this->getAppContext(),
            'app_suffix_data' => [],
            'web_data' => $webData,
            'compact_data' => $compact,
            'tpl_view' => 'store.trade.detail'
        ];
        $this->setData($data); // 设置数据
        return $this->displayData(); // 模板渲染及APP客户端返回数据
    }
}
