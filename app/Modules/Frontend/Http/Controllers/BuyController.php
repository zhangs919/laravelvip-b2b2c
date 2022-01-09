<?php

namespace App\Modules\Frontend\Http\Controllers;

use App\Modules\Base\Http\Controllers\Frontend;
use App\Repositories\BuyRepository;
use App\Repositories\PaymentRepository;
use App\Repositories\UserAddressRepository;
use Illuminate\Http\Request;

class BuyController extends Frontend
{

    protected $userAddress;
    protected $payment;
    protected $buy; // 购物逻辑代码

    public function __construct()
    {
        parent::__construct();

        $this->need_auth = true;

        $this->userAddress = new UserAddressRepository();
        $this->payment = new PaymentRepository();
        $this->buy = new BuyRepository();

    }

    /**
     * 结算页面
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function checkout(Request $request)
    {
        $seo_title = '结算页面';


        // 获取数据

        // 购买类型 1-直接购买 0购物车购买
        $userBuy = session('user_buy_'.$this->user_id);

        // 用户收货地址
        $address_list = $this->userAddress->getUserAddressList($this->user_id, 'buy');
        // 送货时间
        $checked = 0; // 选中项 默认0 无选中项 todo
        $send_time_list = $this->buy->getSendTime($checked);
        // 送货时间描述
        $send_time_desc = sysconf('send_time_desc');
        // 最近送货时间
        $best_time = $this->buy->getBestTime($checked);
        // 是否显示送货时间
        $send_time_show = !empty($send_time_list) ? true : false;
        // 购物车信息
        $cart_info = $this->buy->getCartInfo($this->user_id, $userBuy);
        // 是否显示配送方式
        $shipping_list_show = true;
        // 是否显示发票信息
        $invoice_show = false;
        // 发票信息列表
        $invoice_info = [];
        $invoice_desc = '不开发票';
        // 支付方式列表 多个店铺 数组取交集
        $pay_list = [];




        $compact = compact('seo_title', 'address_list');
        $webData = []; // web端（pc、mobile）数据对象
        $data = [
            'app_prefix_data' => [
                'address_list' => $address_list,
                'address_list_show' => true,
                'send_time_list' => $send_time_list,
                'send_time_desc' => $send_time_desc,
                'best_time' => $best_time,
                'send_time_show' => $send_time_show,
                'cart_info' => $cart_info,
                'shipping_list_show' => $shipping_list_show,
                'invoice_show' => $invoice_show,
                'invoice_info' => $invoice_info,
                'invoice_desc' => $invoice_desc,
                'pay_list' => $pay_list,
                'buy_type' => $userBuy['buy_type'],
                'is_exchange' => false,
                'is_gift' => false,
                'shop_id' => 0,
                'rc_model' => null,
                'show_url' => null,
                'balance_enable' => '1',
                'balance_first' => '0',
                'topay_enable' => true
            ],
            'app_suffix_data' => [
                'site_id' => 0,
                'cart' => [
                    'goods_count' => 2 // todo
                ]
            ],
            'web_data' => $webData,
            'compact_data' => $compact,
            'tpl_view' => 'buy.checkout'
        ];
        dd($data);
        $this->setData($data); // 设置数据
        return $this->displayData(); // 模板渲染及APP客户端返回数据
    }

    /**
     * 切换收货地址
     *
     * @param Request $request
     * @return array
     */
    public function changeAddress(Request $request)
    {
        $address_id = $request->post('address_id');

        return result(0);
    }

    /**
     * 用户收货地址列表
     *
     * @param Request $request
     * @return array
     * @throws \Throwable
     */
    public function userAddress(Request $request)
    {
        $address_list = $this->userAddress->getUserAddressList($this->user_id, 'user_center');

        $render = view('buy.user_address', compact('address_list'))->render();

        return result(0, $render);
    }



    public function submit(Request $request)
    {
        $postscript = $request->post('postscript'); // 多个是数组

        $order_sn = '20181003093704768950';
        $data = route('pc_payment').'?order_sn='.$order_sn; // 支付页面url
        $extra = [
            'group_sn' => null,
            'order_sn' => $order_sn
        ];
        return result(0, $data, '提交订单成功', $extra);
    }

    public function resubmit(Request $request)
    {
        $key = $request->post('key');
        $order_id = $request->post('order_id');
        $order_sn = $request->post('order_sn');
        $integral_enable = $request->post('integral_enable', false);
        $balance_enable = $request->post('balance_enable', false);
        $pay_code = $request->post('pay_code');

        $data = route('pc_payment').'?order_sn='.$order_sn; // 支付页面url
        $extra = [
            'merge_pay' => true,
            'merge_sn' => 'MP201810031228356202598',
            'order_id' => '368,369',
        ];
        return result(0, $data, '提交订单成功', $extra);
    }

    /**
     * 付款结果查询
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function result(Request $request)
    {
        $key = $request->get('key'); // 订单信息加密后的key

        $seo_title = '结算页面';

        return view('buy.result', compact('seo_title'));
    }

    /**
     * 付款页面
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function pay(Request $request)
    {
        $id = $request->get('id'); // 订单id 1,2,3

        $seo_title = '结算页面';

        return view('buy.pay', compact('seo_title'));
    }


    public function changePayment(Request $request)
    {
        $integral_enable = $request->post('integral_enable', false);
        $balance_enable = $request->post('balance_enable', false);
        $pay_code = $request->post('pay_code');

        $order = [
            'balance' => 0,
            'balance_format' => "￥0",
            'bonus_amount' => 0,
            'bonus_amount_format' => "￥0",
            'bonus_id' => 0,
            'buyer_type' => 0,
            'cash_more' => 0,
            'cash_more_format' => "￥0",
            'discount_fee' => 0,
            'discount_fee_format' => "￥0",
            'full_cut_amount' => 0,
            'full_cut_amount_format' => "￥0",
            'full_cut_bonus' => 0,
            'full_cut_point' => 0,
            'give_integral' => 0,
            'goods_amount' => 0,
            'goods_amount_format' => "￥1.8",
            'integral' => 0,
            'integral_amount' => 0,
            'integral_amount_format' => "￥0",
            'inv_fee' => 0,
            'is_cash' => true,
            'is_cod' => 1,
            'money_pay' => 1880,
            'money_pay_format' => "￥1880",
            'order_amount' => 1880,
            'order_amount_format' => "￥1880",
            'order_data' => [],
            'order_type' => 0,
            'pay_code' => "cod",
            'pay_id' => -1,
            'pay_name' => "货到付款",
            'shipping_fee' => 6,
            'shipping_fee_format' => "￥6",
            'shop_bonus_amount' => 0,
            'shop_bonus_amount_format' => "￥0",
            'shop_store_card_amount' => 0,
            'shop_store_card_amount_format' => "￥0",
            'total_bonus_amount' => 0,
            'total_bonus_amount_format' => "￥0",
        ];
        $pay_list = $this->payment->getPaymentList($pay_code);
        // 按店铺分为多个数组
        $shop_orders = [
            [
                'bonus_amount' => 0,
                'bonus_amount_format' => "￥0",
                'buy_type' => 0,
                'buyer_type' => 0,
                'card_id' => 0,
                'cash_more' => 0,
                'cash_more_format' => "￥0",
                'discount_fee' => 0,
                'discount_fee_format' => "￥0",
                'full_cut_amount' => 0,
                'full_cut_amount_format' => "￥0",
                'full_cut_bonus' => [],
                'full_cut_point' => 0,
                'give_integral' => 0,
                'goods_amount' => 118,
                'inv_fee' => 0,
                'is_cash' => 1,
                'order_amount' => 124,
                'order_amount_format' => "￥124",
                'order_type' => 0,
                'other_amount' => 0,
                'pre_sale_mode' => null,
                'shipping_fee' => 6,
                'shipping_fee_format' => "￥6",
                'shop_bonus_amount' => 0,
                'shop_bonus_amount_format' => "￥0",
                'shop_bonus_id' => 0,
                'shop_id' => 1,
                'shop_store_card_amount' => 0,
                'shop_store_card_amount_format' => "￥0",
            ]
        ];
        $user_info = [
            'balance' => 0,
            'balance_format' => "￥0",
            'balance_password_enable' => 1,
            'pay_point' => "0|0",
            'pay_point_amount' => 0,
            'pay_point_amount_format' => "￥0"
        ];

        $extra = [
            'check_address' => 1,
            'order' => $order,
            'pay_list' => $pay_list,
            'shop_orders' => $shop_orders,
            'user_info' => $user_info
        ];

        return result(0, null, null, $extra);
    }

    /**
     * 付款页面 设置支付方式
     *
     * @param Request $request
     * @return array
     */
    public function setPayment(Request $request)
    {
        $key = $request->post('key');
        $order_id = $request->post('order_id');
        $order_sn = $request->post('order_sn');
        $integral_enable = $request->post('integral_enable', 0);
        $balance_enable = $request->post('balance_enable', 0);
        $pay_code = $request->post('pay_code');

        $order = [
            'balance' => 0,
            'balance_format' => "￥0",
            'cash_more' => 0,
            'give_integral' => 0,
            'integral' => 0,
            'integral_amount' => 0,
            'integral_amount_format' => "￥0",
            'is_cash' => 0,
            'money_pay' => 1880,
            'money_pay_format' => "￥1880",
            'order_amount' => 1880,
            'order_amount_format' => "￥1880",
            'pay_code' => "alipay",
        ];
        $user_info = [
            'balance' => 0,
            'balance_format' => "￥0",
            'balance_password_enable' => 0,
            'pay_point' => "0|0",
            'pay_point_amount' => 0,
            'pay_point_amount_format' => "￥0"
        ];

        $extra = [
            'order' => $order,
            'user_info' => $user_info
        ];

        return result(0, null, null, $extra);
    }

}