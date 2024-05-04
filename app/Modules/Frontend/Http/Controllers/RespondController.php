<?php

namespace App\Modules\Frontend\Http\Controllers;

use App\Models\OrderInfo;
use App\Modules\Base\Http\Controllers\Frontend;
use App\Repositories\PaymentLogicRepository;

/**
 * 支付同步回调
 *
 * Class RespondController
 * @package App\Modules\Frontend\Http\Controllers
 */
class RespondController extends Frontend
{

	protected $paymentLogic;

	protected $payCode;


	public function __construct(PaymentLogicRepository $paymentLogic)
	{
		parent::__construct();


		$this->paymentLogic = $paymentLogic;
	}

    public function frontAlipay()
    {


        // 获取数据
		$this->payCode = 'alipay';

		$data = $this->paymentLogic->return($this->payCode);

		// "charset" => "utf-8"
		//    "out_trade_no" => "20231230021922254761"
		//    "method" => "alipay.trade.page.pay.return"
		//    "total_amount" => "390.50"
		//    "trade_no" => "2023123022001465270501466955"
		//    "auth_app_id" => "9021000133640369"
		//    "version" => "1.0"
		//    "app_id" => "9021000133640369"
		//    "seller_id" => "2088721025991716"
		//    "timestamp" => "2023-12-30 13:20:04"

        // 订单号：$data->out_trade_no
        // 支付宝交易号：$data->trade_no
        // 订单总金额：$data->total_amount

		$order_list = OrderInfo::where('pay_sn', 'like', "%{$data->trade_no}%")
			->with(['shop'])
			->get()->toArray();

		// 未找到待支付订单 返回异常
		if (empty($order_list)) {
			abort(200, '您还没有任何订单，赶快去购物吧！');
		}
		$shop_names = [];
		foreach ($order_list as $item) {
			$shop_names[] = $item['shop']['name'];
		}
		$shop_names = implode(',', $shop_names);
		$order_sns = array_column($order_list, 'order_sn');
		$order_sns = implode(',', $order_sns);
		$order_ids_arr = array_column($order_list, 'order_id');
		$order_first = array_first($order_list);

		$order = [
            'order_sn' => $data->out_trade_no,
            'is_cod' => 0,
            'order_amount' => $data->total_amount,
            'money_paid' => $data->total_amount,
            'is_pay' => 1,
            'status' => 1,
            'order_data' => false,
            'order_id' => $order_ids_arr,
            'cash_back_amount' => 0,
            'buy_type' => $order_first['buy_type'],
            'order_type' =>$order_first['order_type'],
            'shop_id' => $order_first['shop_id'],
            'reachbuy_code'=>$order_first['reachbuy_code'],
            'add_time' => $order_first['add_time'],
            'consignee' => $order_first['consignee'],
            'order_sns' => $order_sns,
            'user_id' => $order_first['user_id'],
            'order_amount_format' => '￥'.$data->total_amount,
            'money_paid_format' => '￥'.$data->total_amount,
            'order_count' => count($order_list),
			'shop_names' => $shop_names
        ];
        $is_exchange = false;
        $is_gift = false;
        $is_virtual = false;
        $mall_phone = sysconf('mall_phone');
        $is_success = false;
        $group_sn = '';
        $steps = [
            [
                'step' => 1,
                'name' => '我的购物车',
                'url' => '/cart.html',
                'selected' => true,
            ],
            [
                'step' => 2,
                'name' => '确认订单',
                'url' => '/checkout.html',
                'selected' => true,
            ],
            [
                'step' => 3,
                'name' => '付款',
                'selected' => true,
            ],
            [
                'step' => 4,
                'name' => '支付成功',
                'selected' => true,
            ],

        ];
        $sum_cash_back_amount = 0;

        $compact = compact('order', 'order_list', 'is_exchange', 'is_gift', 'is_virtual',
            'mall_phone', 'is_success', 'group_sn', 'steps', 'sum_cash_back_amount');

        $webData = []; // web端（pc、mobile）数据对象
        $data = [
            'app_prefix_data' => [
                'order' => $order,
                'order_list' => $order_list,
                'is_exchange' => $is_exchange,
                'is_gift' => $is_gift,
                'is_virtual' => $is_virtual,
                'mall_phone' => $mall_phone,
                'is_success' => $is_success,
                'group_sn' => $group_sn,
                'steps' => $steps,
                'sum_cash_back_amount' => $sum_cash_back_amount
            ],
            'app_suffix_data' => [],
            'web_data' => $webData,
            'compact_data' => $compact,
            'tpl_view' => 'respond.front-alipay'
        ];
        $this->setData($data); // 设置数据
        return $this->displayData(); // 模板渲染及APP客户端返回数据
    }

	public function frontWeixin()
	{

    }

	public function frontUnipay()
	{

    }


}
