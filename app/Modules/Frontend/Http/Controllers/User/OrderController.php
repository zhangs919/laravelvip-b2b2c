<?php

namespace App\Modules\Frontend\Http\Controllers\User;

use App\Models\GoodsHistory;
use App\Modules\Base\Http\Controllers\UserCenter;
use App\Repositories\GoodsHistoryRepository;
use App\Repositories\OrderGoodsRepository;
use App\Repositories\OrderInfoRepository;
use Illuminate\Http\Request;

class OrderController extends UserCenter
{

    protected $orderInfo;
    protected $orderGoods;

    public function __construct()
    {
        parent::__construct();

        $this->orderInfo = new OrderInfoRepository();
        $this->orderGoods = new OrderGoodsRepository();
    }

    public function index(Request $request)
    {
        return $this->lists($request);
    }

    public function lists(Request $request)
    {
        $seo_title = '用户中心';

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

        $where[] = ['user_id', $this->user_id];

        // 列表
        $condition = [
            'where' => $where,
            'sortname' => 'order_id',
            'sortorder' => 'asc'
        ];

        list($list, $total) = $this->orderInfo->getList($condition);
        $pageHtml = frontend_pagination($total);
        if ($request->ajax()) {
            $render = view('user.order.partials._list', compact('list', 'total', 'pageHtml', 'params'))->render();
            return result(0, $render);
        }
//        dd($list);
        return view('user.order.index', compact('seo_title', 'list', 'pageHtml', 'params'));
    }

    /**
     * 订单详情
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function info(Request $request)
    {
        $seo_title = '用户中心';

        $id = $request->get('id');
        $info = $this->orderInfo->getById($id);

        return view('user.order.info', compact('seo_title', 'info'));
    }

    public function editOrder(Request $request)
    {
        // from=info&type=cancel&id=1&is_exchange=
        // from=list&type=cancel&id=267&is_exchange=0
        $from = $request->get('from', ''); // 来源页面
        $type = $request->get('type', ''); // 操作方法 如：cancel取消订单
        $order_id = $request->get('id'); // 订单id
        $is_exchange = $request->get('is_exchange', 0);

        switch ($type)
        {
            case 'cancel':
                $uuid = make_uuid();
                $reason_list = [];
                $render = view('user.order.order_cancel', compact('uuid', 'order_id', 'reason_list'))->render();
                return result(0, $render);
                break;

            case '':

                break;

            default :
                break;
        }


    }

    public function orderCancel(Request $request)
    {
        return result(0, null, '取消订单成功！');
    }
}