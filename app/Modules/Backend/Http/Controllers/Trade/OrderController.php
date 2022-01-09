<?php

namespace App\Modules\Backend\Http\Controllers\Trade;

use App\Modules\Base\Http\Controllers\Backend;
use App\Repositories\OrderGoodsRepository;
use App\Repositories\OrderInfoRepository;
use Illuminate\Http\Request;

class OrderController extends Backend
{

    private $links = [
        ['url' => 'trade/order/list', 'text' => '订单列表'],
    ];

    protected $orderInfo;

    protected $orderGoods;

    public function __construct()
    {
        parent::__construct();

        $this->orderInfo = new OrderInfoRepository();
        $this->orderGoods = new OrderGoodsRepository();
    }


    public function lists(Request $request)
    {
        $title = '订单列表';
        $fixed_title = '商品订单 - '.$title;

        $uid = $request->get('uid', ''); // 查看某个会员的所有订单
        $from = $request->get('from', '');

        $this->sublink($this->links, 'list');
        $action_span = [];
        $explain_panel = [];
        $blocks = [
            'fixed_title' => $fixed_title,
            'action_span' => $action_span,
            'explain_panel' => $explain_panel,
        ];
        $this->setLayoutBlock($blocks); // 设置block

        $params = $request->all();
        $params['order_status'] = $request->get('order_status', '');

        $where = [];
        // 搜索条件 name 商品名称/订单编号/买家账号
        $search_arr = ['name', 'order_status', 'add_time_begin', 'add_time_end', 'shop_name', 'evaluate_status', 'pay_type',
            'service_type', 'pickup', 'order_type', 'user_mobile', 'consignee_name', 'consignee_mobile', 'consignee_address'];
        foreach ($search_arr as $v) {
            if (isset($params[$v]) && !empty($params[$v])) {
                if ($v == 'name') { // todo
//                    $where[] = [$v, 'like', "%{$params[$v]}%"];
                } elseif ($v == 'add_time_begin' || $v == 'add_time_end') {

                }
                else {
                    $where[] = [$v, $params[$v]];
                }
            }
        }

        if (!empty($uid)) {
            $where[] = ['user_id', $uid];
        }

        // 列表
        $condition = [
            'where' => $where,
            'sortname' => 'order_id',
            'sortorder' => 'asc'
        ];

        list($list, $total) = $this->orderInfo->getList($condition);
        $pageHtml = pagination($total);
        if ($request->ajax()) {
            $render = view('trade.order.partials._list', compact('list', 'total', 'pageHtml', 'params'))->render();
            return result(0, $render);
        }

        return view('trade.order.list', compact('title', 'list', 'pageHtml', 'params'));
    }

    public function print(Request $request)
    {

        return view('trade.order.print');
    }

    public function getOrderCounts(Request $request)
    {
        $data = $this->orderInfo->getOrderCounts();

        return json_result($data);
    }
}