<?php

namespace App\Modules\Frontend\Http\Controllers;

use App\Modules\Base\Http\Controllers\Frontend;
use App\Repositories\BuyRepository;
use App\Repositories\PaymentRepository;
use App\Repositories\UserAddressRepository;
use Faker\Provider\Uuid;
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
        return abort(404, '暂未开放购买功能'); // todo 暂时关闭购买功能


        $seo_title = '结算页面';

        // 获取数据

        // 购买类型 1-直接购买 0购物车购买
        $userBuy = session('user_buy_'.$this->user_id);

        // 购买第一步 返回下单页面数据
        $result = $this->buy->buyStep1($userBuy, $this->user_id);

        if ($result['code'] != 0) {
            // 客户端判断
            if (is_app()) { // app
                return result($result['code'], $result['data'], $result['message']);
            } elseif (is_mobile() || (request()->getHost() == env('MOBILE_DOMAIN'))) { // 微信端
                // 购买参数错误 跳转到购物车页面
                return redirect(route('mobile_cart_list'));
            } else { // pc端
                // 购买参数错误 跳转到购物车页面
                return redirect(route('pc_cart_list'));
            }
        }

        extract($result['data']); // 将数据从 $result['data']中取出

        $check_address = 1; // 是否检查地址 如果是上门自提 则不需要检查地址 如果是普通快递 需要检查地址


        $compact = compact('seo_title', 'address_list',
            'send_time_list','send_time_desc','send_time_show','best_time',
            'cart_info','shipping_list_show','invoice_show','invoice_info',
            'invoice_desc', 'pay_list', 'check_address');
        $webData = []; // web端（pc、mobile）数据对象
        $data = [
            'app_prefix_data' => [
                'address_list' => $address_list,
                'address_list_show' => $address_list_show,
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
//        dd($data);
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
        $userBuy = session('user_buy_'.$this->user_id);
        $userBuy['selected_address'] = $address_id;
        session(['user_buy_'.$this->user_id => $userBuy]);

        return result(0);
    }

    /**
     * 切换送货时间
     *
     * @param Request $request
     * @return array
     */
    public function changeBestTime(Request $request)
    {
        $send_time_id = $request->post('send_time_id');
        $send_time = $request->post('send_time');
        if (empty($send_time)) {
            $send_time = $this->buy->getBestTime($send_time_id);
        }
        $userBuy = session('user_buy_'.$this->user_id);
        $userBuy['send_time_id'] = $send_time_id;
        $userBuy['send_time'] = $send_time;
        session(['user_buy_'.$this->user_id => $userBuy]);

        $data = [
            'best_time' => $send_time,
            'best_time_id' => $send_time_id
        ];
        return result(0, $data);
    }

    /**
     * 修改发票信息
     *
     * @param Request $request
     */
    public function changeInvoice(Request $request)
    {

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
        $address_list = $this->userAddress->getUserAddressList($this->user_id, 'buy');
        $render = view('buy.user_address', compact('address_list'))->render();

        return result(0, $render);
    }


    /**
     * 订单提交
     *
     * 1. 验证订单提交信息
     * 2. 生成订单并返回订单编号
     *
     * @param Request $request
     * @return array
     */
    public function submit(Request $request)
    {
        // 多个是数组 如：postscript[133]: 留言了 下标为：店铺id
        $postscript = $request->post('postscript');
        $userBuy = session('user_buy_'.$this->user_id);

        $ret = $this->buy->submitOrder($userBuy, $this->user, $postscript);

        if ($ret['code'] != 0) {
            return result($ret['code'], $ret['data'], $ret['message']);
        }

        $order_sn = $ret['data']['order_sn'];
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


    /**
     * 修改支付方式
     *
     * @param Request $request
     * @return array
     */
    public function changePayment(Request $request)
    {
        $integral_enable = $request->post('integral_enable', false);
        $balance = $request->post('balance', false);
        $balance_enable = $request->post('balance_enable', false);
        $pay_code = $request->post('pay_code');

        $userBuy = session('user_buy_'.$this->user_id);
        $userBuy['integral_enable'] = $integral_enable;
        $userBuy['balance'] = $balance;
        $userBuy['balance_enable'] = $balance_enable;
        $userBuy['pay_code'] = $pay_code;
        session(['user_buy_'.$this->user_id => $userBuy]);


        $order = [
            'balance' => 116,
            'balance_format' => "￥116.00",
            'bonus_amount' => 0,
            'bonus_amount_format' => "￥0.00",
            'bonus_id' => 0,
            'buyer_type' => 0,
            'cash_more' => 0,
            'cash_more_format' => "￥0.00",
            'discount_fee' => 0,
            'discount_fee_format' => "￥0.00",
            'full_cut_amount' => 0,
            'full_cut_amount_format' => "￥0",
            'full_cut_bonus' => 0,
            'full_cut_point' => 0,
            'give_integral' => 0,
            'goods_amount' => 110,
            'goods_amount_format' => "￥118.00",
            'integral' => 0,
            'integral_amount' => 0,
            'integral_amount_format' => "￥0.00",
            'inv_fee' => 0,
            'is_cash' => 0,
            'is_cod' => 0,
            'money_pay' => 0,
            'money_pay_format' => "￥0.00",
            'order_amount' => 116,
            'order_amount_format' => "￥116.00",
            'order_data' => [],
            'order_type' => 0,
            'pay_code' => "weixin",
            'pay_id' => null, //-1,
            'pay_name' => null, //"货到付款",
            'shipping_fee' => 6,
            'shipping_fee_format' => "￥6.00",
            'shop_bonus_amount' => 0,
            'shop_bonus_amount_format' => "￥0.00",
            'shop_store_card_amount' => 0,
            'shop_store_card_amount_format' => "￥0.00",
            'total_bonus_amount' => 0,
            'total_bonus_amount_format' => "￥0.00",
        ];
        $pay_list = $this->payment->getPaymentList($pay_code);
        // 按店铺分为多个数组
        $shop_orders = [
            [
                'bonus_amount' => 0,
                'bonus_amount_format' => "￥0.00",
                'buy_type' => 0,
                'buyer_type' => 0,
                'card_id' => 0,
                'cash_more' => 0,
                'cash_more_format' => "￥0.00",
                'discount_fee' => 0,
                'discount_fee_format' => "￥0.00",
                'full_cut_amount' => 0,
                'full_cut_amount_format' => "￥0.00",
                'full_cut_bonus' => [],
                'full_cut_point' => 0,
                'give_integral' => 0,
                'goods_amount' => 110,
                'inv_fee' => 0,
                'is_cash' => 0,
                'order_amount' => 116,
                'order_amount_format' => "￥116.00",
                'order_type' => 0,
                'other_amount' => 0,
                'pre_sale_mode' => null,
                'shipping_fee' => 6,
                'shipping_fee_format' => "￥6.00",
                'shop_bonus_amount' => 0,
                'shop_bonus_amount_format' => "￥0.00",
                'shop_bonus_id' => 0,
                'shop_id' => 1,
                'shop_store_card_amount' => 0,
                'shop_store_card_amount_format' => "￥0",
            ]
        ];
        $user_info = [
            'balance' => 15550,
            'balance_format' => "￥15550.00",
            'balance_password_enable' => 0,
            'online_balance' => 15550,
            'pay_point' => "0|9000",
            'pay_point_amount' => 0,
            'pay_point_amount_format' => "￥0.00"
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