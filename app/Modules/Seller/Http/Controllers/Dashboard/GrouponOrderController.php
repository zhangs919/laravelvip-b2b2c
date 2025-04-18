<?php


namespace App\Modules\Seller\Http\Controllers\Dashboard;

use App\Models\ActivityCategory;
use App\Models\Goods;
use App\Models\GoodsActivity;
use App\Models\GoodsSku;
use App\Models\GrouponLog;
use App\Modules\Base\Http\Controllers\Seller;
use App\Repositories\ActivityRepository;
use App\Repositories\GrouponOrderRepository;
use App\Services\Enum\ActTypeEnum;
use Illuminate\Http\Request;

/**
 * 拼团订单管理
 *
 * Class GrouponOrderController
 * @package App\Modules\Seller\Http\Controllers\Dashboard
 */
class GrouponOrderController extends Seller
{

    private $links = [
        ['url' => 'dashboard/fight-group/list', 'text' => '拼团活动列表'],
        ['url' => 'dashboard/groupon-order/list', 'text' => '拼团订单列表'],
        ['url' => 'dashboard/groupon-order/info', 'text' => '拼团订单详情'],
    ];

    protected $activity;
    protected $grouponOrder;

    public function __construct(
        ActivityRepository $activity,
        GrouponOrderRepository $grouponOrder
    )
    {
        parent::__construct();

        $this->activity = $activity;
        $this->grouponOrder =$grouponOrder;

        $this->set_menu_select('dashboard', 'dashboard-center');
    }


    public function lists(Request $request)
    {
        $title = '拼团订单列表';
        $fixed_title = '';
        $this->sublink($this->links, 'dashboard/groupon-order/list', '', '', 'info');

        $action_span = [
            [
                'id' => '',
                'url' => '/dashboard/center/index',
                'icon' => 'fa-reply',
                'text' => '返回营销中心'
            ],
        ];

        $explain_panel = [];
        $blocks = [
            'explain_panel' => $explain_panel,
            'fixed_title' => $fixed_title,
            'action_span' => $action_span
        ];

        $this->setLayoutBlock($blocks); // 设置block

        $params = $request->all();

        $where = [];
        $where[] = ['shop_id', seller_shop_info()->shop_id];
        $where[] = ['user_type', 0]; // 团长

        // 搜索条件
        $search_arr = ['keyword','status'];
        foreach ($search_arr as $v) {
            if (isset($params[$v]) && !empty($params[$v])) {

                if ($v == 'keyword') {
                    $where[] = ['group_sn', 'like', "%{$params[$v]}%"];
                } else {
                    $where[] = [$v, $params[$v]];
                }
            }
        }
        // 列表
        $condition = [
            'with' => ['orderInfo' => function ($query) {
                $query->select(['order_id', 'order_sn', 'order_status', 'surplus','order_amount','money_paid',
                    'shop_id', 'pay_name', 'pay_id', 'shipping_fee']);
//                ->with(['orderGoods', function($query) {
//                    $query->select(['goods_name', 'sku_id','goods_image', 'goods_price', 'goods_number', 'spec_info']);
//                }]);
            },'orderInfo.orderGoods','user' => function ($query) {
                $query->select(['user_id', 'user_name']);
            },'activity' => function($query){
                $query->select(['act_id', 'ext_info', 'act_ext_info', 'start_time', 'end_time']);
            }],
            'relation' => 'grouponLog',
            'where' => $where,
            'sortname' => 'log_id',
            'sortorder' => 'desc',
        ];
        // 列表
        list($list, $total) = $this->grouponOrder->getList($condition);

        $pageHtml = pagination($total);
        $page = frontend_pagination($total, true);

        if ($request->ajax()) {
            $render = view('dashboard.groupon-order.partials._list', compact('list', 'total', 'pageHtml'))->render();
            return result(0, $render);
        }

        // 获取数据

        $compact = compact('title', 'list', 'pageHtml');

        $webData = []; // web端（pc、mobile）数据对象
        $data = [
            'app_extra_data' => [],
            'app_prefix_data' => [
                'list' => $list,
                'page' => $page
            ],
            'app_context_data' => $this->getAppContext(),
            'app_suffix_data' => [],
            'web_data' => $webData,
            'compact_data' => $compact,
            'tpl_view' => 'dashboard.groupon-order.list'
        ];
        $this->setData($data); // 设置数据
        return $this->displayData(); // 模板渲染及APP客户端返回数据
    }

    public function info(Request $request)
    {
        $title = '拼团订单详情';

        $group_sn = $request->get('group_sn');
        $this->sublink($this->links, 'view', '', '', 'dashboard/fight-group/list');
        $fixed_title = '';

        $action_span = [
            [
                'url' => 'list',
                'icon' => 'fa-reply',
                'text' => '返回拼团订单列表'
            ],
        ];

        $explain_panel = [];
        $blocks = [
            'explain_panel' => $explain_panel,
            'fixed_title' => $fixed_title,
            'action_span' => $action_span
        ];

        $this->setLayoutBlock($blocks); // 设置block

        // 获取数据
        $list = $this->grouponOrder->getGrouponOrderList($group_sn);
        $order_info = $this->grouponOrder->getOrderInfo($group_sn);
        $groupon_log = GrouponLog::where([['group_sn', $group_sn], ['user_type', 0]])->first()->toArray();
        $groupon_count = $order_info['join_num'];

        $compact = compact('title', 'list','order_info', 'groupon_log','groupon_count');

        $webData = []; // web端（pc、mobile）数据对象
        $data = [
            'app_extra_data' => [],
            'app_prefix_data' => [
                'list' => $list,
                'order_info' => $order_info,
                'groupon_log' => $groupon_log,
                'groupon_count' => $groupon_count,
            ],
            'app_context_data' => $this->getAppContext(),
            'app_suffix_data' => [],
            'web_data' => $webData,
            'compact_data' => $compact,
            'tpl_view' => 'dashboard.groupon-order.info'
        ];
        $this->setData($data); // 设置数据
        return $this->displayData(); // 模板渲染及APP客户端返回数据
    }

    /**
     * 拼团超时 自动退款
     *
     * @param Request $request
     * @return array|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Foundation\Application|\Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function refund(Request $request)
    {
        $group_sn = $request->input('group_sn');

        //  对该拼团的所有订单进行退款处理
        try {
            $this->grouponOrder->refund($group_sn);
            return result(0, null, '操作成功');
        } catch (\Exception $e) {
            return result(-1, null, $e->getMessage());
        }
    }


}