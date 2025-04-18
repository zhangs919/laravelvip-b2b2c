<?php

namespace App\Modules\Frontend\Http\Controllers\User;

use App\Models\BackLog;
use App\Models\OrderGoods;
use App\Models\OrderInfo;
use App\Models\ShopAddress;
use App\Models\User;
use App\Modules\Base\Http\Controllers\UserCenter;
use App\Repositories\BackOrderRepository;
use App\Repositories\OrderInfoRepository;
use App\Repositories\ShopRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BackOrderController extends UserCenter
{

    protected $backOrder;
    protected $shop;
	protected $orderInfo;

    public function __construct(
        BackOrderRepository $backOrder
        ,ShopRepository $shop
        , OrderInfoRepository $orderInfo,)
    {
        parent::__construct();

        $this->backOrder = $backOrder;
        $this->shop=$shop;
		$this->orderInfo = $orderInfo;
    }

    public function lists(Request $request)
    {
        $seo_title = '用户中心';

        $params = $request->all();
        $type = $request->get('type', 0); // 0-退款退货 1-换货维修

        // 获取数据
        $where = [];
        // 搜索条件 订单编号/退款退货单编号
        $search_arr = ['order_sn', 'back_sn'];
        foreach ($search_arr as $v) {
            if (isset($params[$v]) && !empty($params[$v])) {
                if ($v == 'name') { // todo
//                    $where[] = [$v, 'like', "%{$params[$v]}%"];
                } else {
                    $where[] = [$v, $params[$v]];
                }
            }
        }

        $where[] = ['user_id', $this->user_id];
        $whereIn = [];
        if ($type == 0) {
            $whereIn[] = ['back_type', [1,2]];
        } else {
            $whereIn[] = ['back_type', [3,4]];
        }

        // 列表
        $condition = [
            'where' => $where,
            'where_in' => $whereIn,
            'sortname' => 'back_id',
            'sortorder' => 'desc'
        ];

        list($list, $total) = $this->backOrder->getUserCenterBackOrderList($condition);
        $pageHtml = frontend_pagination($total);
        $page_array = frontend_pagination($total, true);
        $page_json = json_encode($page_array);

        $nav_default = 'back';

        $compact = compact('seo_title', 'pageHtml', 'list', 'page_json', 'nav_default','type');

        if ($request->ajax() && !is_app()) { // web端访问 ajax请求
            $render = view('user.back-order.partials._list', $compact)->render();
            return result(0, $render);
        }

        $webData = []; // web端（pc、mobile）数据对象
        $data = [
            'app_prefix_data' => [
                'page' => $page_array,
                'list' => $list,
                'nav_default' => $nav_default,
            ],
            'app_suffix_data' => [],
            'web_data' => $webData,
            'compact_data' => $compact,
            'tpl_view' => 'user.back-order.list'
        ];
        $this->setData($data); // 设置数据
        return $this->displayData(); // 模板渲染及APP客户端返回数据
    }

    /**
     * 详情
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function info(Request $request)
    {
        $seo_title = '用户中心';

        $id = $request->get('id');


        // 获取数据
        $condition = [
            ['back_id',$id],
            ['user_id',$this->user_id]
        ];
        $back_info = $this->backOrder->getUserCenterBackOrderInfo($condition);
        if (empty($back_info)) {
            abort(1, '退款信息不存在！');
        }

        $back_schedules = $this->backOrder->getBackSchedules($back_info);
        $shop_info = $this->shop->shopInfo($back_info['shop_id']);
        $order_info = OrderInfo::where('order_id',$back_info['order_id'])->first()->toArray();
        $goods_info = OrderGoods::where('record_id',$back_info['record_id'])->first()->toArray();
        $goods_info['goods_price_format'] = "￥".$goods_info['goods_price'];
        $goods_info['send_number'] = 1; //
        $goods_info['send_number_money'] = $goods_info['goods_price']; //
        $goods_info['all_number_money'] = $goods_info['goods_price']; //
        $goods_info['sku_img'] = get_image_url($goods_info['goods_image']); //

        $user_info = User::where('user_id',$back_info['user_id'])->first()->toArray();
        //申请退款卖家确认期限
        $back_seller_term = sysconf('back_seller_term');
        $back_logs = BackLog::where('back_id', $id)->get()->toArray();
        $default_user_portrait = get_image_url(sysconf('default_user_portrait'));
        $right_title = '申请售后';
        $nav_default = 'service';
        $shop_address = ShopAddress::where('shop_id', $order_info['shop_id'])->where('is_default', 1)->first();
        $addr_info = "{$shop_address->region_names} {$shop_address->address_detail}（{$shop_address->consignee}收） {$shop_address->mobile}";
        $service_name = format_back_type($back_info['back_type']);

        $compact = compact('seo_title', 'back_info','back_schedules','shop_info','order_info',
            'goods_info','user_info','back_seller_term','back_logs','default_user_portrait','right_title','nav_default',
            'addr_info','service_name');

        $webData = []; // web端（pc、mobile）数据对象
        $data = [
            'app_prefix_data' => [
                'back_info' => $back_info,
                'back_schedules' => $back_schedules,
                'shop_info' => $shop_info,
                'order_info' => $order_info,
                'goods_info' => $goods_info,
                'user_info' => $user_info,
                'back_seller_term' => $back_seller_term,
                'back_logs' => $back_logs,
                'default_user_portrait' => $default_user_portrait,
                'right_title' => $right_title,
                'nav_default' => $nav_default,
                'addr_info' => $addr_info,
                'service_name' => $service_name,
            ],
            'app_suffix_data' => [],
            'web_data' => $webData,
            'compact_data' => $compact,
            'tpl_view' => 'user.back-order.info'
        ];
        $this->setData($data); // 设置数据
        return $this->displayData(); // 模板渲染及APP客户端返回数据
    }

    /**
     * 申请售后
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function apply(Request $request)
    {
        $seo_title = '用户中心';

        // 获取数据
		$id = $request->get('id'); // 订单ID
		$record_id = $request->get('record_id'); // 订单商品表ID
        $gid = $request->get('gid'); // 商品ID
        $sid = $request->get('sid'); // 商品SKU ID
		$back_type = $request->get('back_type', 2); // 1-仅退款 2-退货退款

		$condition = [
			['order_id', $id],
			['user_id',$this->user_id]
		];
		$order_info = $this->orderInfo->getFrontendOrderInfo($condition);
		if (empty($order_info)) {
			abort(1, '订单id无效');
		}
		// 订单商品信息
        $goods_info = [];
		if ($record_id) {
            $goods_info = OrderGoods::where('record_id',$record_id)->first()->toArray();
            if (empty($goods_info)) {
                abort(1, '订单商品信息不存在！');
            }
        }
		// 可退款金额
        $goods_info['refund_amount'] = $goods_info['goods_price']*$goods_info['goods_number'];
        $refund_reason_list = format_refund_reason();
        $exchange_reason_list = format_refund_reason();
        $format_repair_reason = format_repair_reason();

        $compact = compact('seo_title', 'id', 'record_id', 'gid','sid','back_type',
            'order_info', 'goods_info', 'refund_reason_list', 'exchange_reason_list',
            'format_repair_reason');

        $webData = []; // web端（pc、mobile）数据对象
        $data = [
            'app_prefix_data' => [
                'refund_reason_list' => $refund_reason_list,
                'exchange_reason_list' => $exchange_reason_list,
                'format_repair_reason' => $format_repair_reason,
				'order_info' => $order_info,
                'goods_info' => $goods_info,
            ],
            'app_suffix_data' => [],
            'web_data' => $webData,
            'compact_data' => $compact,
            'tpl_view' => 'user.back-order.apply'
        ];
        $this->setData($data); // 设置数据
        return $this->displayData(); // 模板渲染及APP客户端返回数据
    }

    public function applySave(Request $request)
    {
        $params = $request->all();
        // 验证参数
        $validator = Validator::make($request->all(), [
            'id' => 'required|integer',
            'record_id' => 'required|integer',
            'gid' => 'required|integer',
            'sid' => 'required|integer',
            'back_type' => 'required|integer',
            'BackOrder.back_reason' => 'required|integer',
            'BackOrder.back_number' => 'required|integer',
            'BackOrder.refund_money' => 'required|numeric',
            'BackOrder.refund_type' => 'required|integer',
            'BackOrder.back_desc' => 'required|string',
            'img_path' => 'nullable|string',
        ], [
            'id.required' => '订单ID不能为空',
            'BackOrder.back_reason.required' => '退款原因不能为空',
            'BackOrder.back_number.required' => '退款数量不能为空',
            'BackOrder.refund_money.required' => '退款金额不能为空',
        ]);

        if ($validator->fails()) {
            abort(-1, $validator->messages()->first());
        }

        try {
            $this->backOrder->applySave($params, $this->user_id);
        } catch (\Exception $e) {
            abort(-1, $e->getMessage());
        }

        if (is_app()) {
            return result(0, [], '提交成功');
        }
        return redirect('/user/back.html');
    }

    /**
     * 用户修改售后申请
     * @param Request $request
     * @return mixed
     */
    public function edit(Request $request)
    {
        $seo_title = '用户中心';

        // 获取数据
        $id = $request->get('id'); // 退款单ID
        $send_id = $request->get('send_id'); // 1、2
        $condition = [
            ['back_id',$id],
            ['user_id',$this->user_id]
        ];
        $back_info = $this->backOrder->getUserCenterBackOrderInfo($condition);
        if (empty($back_info)) {
            return result(-1, null, '退款信息不存在！');
        }

        if ($request->ajax() && $send_id) {
            // 异步请求

            return result(0, null, '成功');
        }

        $condition = [
            ['order_id', $back_info['order_id']],
            ['user_id',$this->user_id]
        ];
        $order_info = $this->orderInfo->getFrontendOrderInfo($condition);
        if (empty($order_info)) {
            abort(1, '订单id无效');
        }
        // 订单商品信息
        $goods_info = OrderGoods::where('record_id',$back_info['record_id'])->first()->toArray();
        if (empty($goods_info)) {
            abort(1, '订单商品信息不存在！');
        }
        // 可退款金额
        $goods_info['refund_amount'] = $goods_info['goods_price']*$goods_info['goods_number'];
        $refund_reason_list = format_refund_reason();
        $exchange_reason_list = format_refund_reason();
        $format_repair_reason = format_repair_reason();

        $compact = compact('seo_title', 'back_info',
            'order_info', 'goods_info', 'refund_reason_list', 'exchange_reason_list',
            'format_repair_reason');

        $webData = []; // web端（pc、mobile）数据对象
        $data = [
            'app_prefix_data' => [
                'order_info' => $order_info,
                'goods_info' => $goods_info
            ],
            'app_suffix_data' => [],
            'web_data' => $webData,
            'compact_data' => $compact,
            'tpl_view' => 'user.back-order.edit'
        ];
        $this->setData($data); // 设置数据
        return $this->displayData(); // 模板渲染及APP客户端返回数据
    }

    public function editSave(Request $request)
    {
        $params = $request->all();

        $condition = [
            ['back_id',$params['id']],
            ['user_id',$this->user_id]
        ];
        $back_info = $this->backOrder->getUserCenterBackOrderInfo($condition);
        if (empty($back_info)) {
            abort(1, '退款信息不存在！');
        }

        $ret = $this->backOrder->editSave($params, $back_info);
        if (!$ret) {
            abort(1, '保存失败');
        }
        if (is_app()) {
            return result(0, [], '操作成功');
        }

        return redirect('/user/back.html');
    }

    public function editOrder(Request $request)
    {
        $type = $params['type'] ?? ''; // 类型 默认：空 空-修改订单 shipping-发回商品

    }

    /**
     * 买家主动撤销申请
     *
     * @param Request $request
     * @return mixed
     */
    public function cancel(Request $request)
    {
        $params = $request->all();

        $condition = [
            ['back_id',$params['id']],
            ['user_id',$this->user_id]
        ];
        $back_info = $this->backOrder->getUserCenterBackOrderInfo($condition);
        if (empty($back_info)) {
            abort(200, '退款信息不存在！');
        }

        $ret = $this->backOrder->cancel($params, $back_info);
        if (!$ret) {
            abort(200, '保存失败');
        }
        if (is_app()) {
            return result(0, [], '撤销成功');
        }

        return redirect('/user/back.html');
    }

    /**
     * 系统自动同意申请
     *
     * @param Request $request
     * @return array
     */
    public function confirmSys(Request $request)
    {
        $back_id = $request->get('back_id');
        // 获取数据
        $condition = [
            ['back_id',$back_id],
            ['user_id',$this->user_id]
        ];
        $back_info = $this->backOrder->getUserCenterBackOrderInfo($condition);
        if (!$back_info) {
            abort(200,INVALID_PARAM);
        }
        $ret = $this->backOrder->confirmSys($back_info);
        if (!$ret) {
            return result(-1, null, '操作失败');
        }

        return result(0, null, '操作成功');
    }
}
