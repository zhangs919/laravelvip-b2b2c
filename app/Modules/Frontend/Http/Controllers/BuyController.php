<?php

namespace App\Modules\Frontend\Http\Controllers;

use App\Models\OrderInfo;
use App\Models\User;
use App\Modules\Base\Http\Controllers\Frontend;
use App\Repositories\BuyRepository;
use App\Repositories\CheckoutRepository;
use App\Repositories\GoodsRepository;
use App\Repositories\OrderInfoRepository;
use App\Repositories\PaymentRepository;
use App\Repositories\UserAddressRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class BuyController extends Frontend
{

    protected $userAddress;
    protected $payment;
//    protected $buy; // 购物逻辑代码
    protected $checkout;
    protected $orderInfo;
    protected $goods;

    public function __construct(
        UserAddressRepository $userAddress
        ,PaymentRepository $payment
//        ,BuyRepository $buy
        ,CheckoutRepository $checkout
        ,OrderInfoRepository $orderInfo
        ,GoodsRepository $goods
    )
    {
        parent::__construct();

        $this->need_auth = true;

        $this->userAddress = $userAddress;
        $this->payment = $payment;
//        $this->buy = $buy;
        $this->checkout = $checkout;
        $this->orderInfo = $orderInfo;
        $this->goods = $goods;

    }

    /**
     * 结算页面
     *
     * @param Request $request
     * @return mixed
     */
    public function checkout(Request $request)
    {
//        if ($this->getNationalMemorialDayStatus()) {
//            abort(403, '今日是国家默哀日，暂停购物！');
//        }
        if (!sysconf('is_enable_buy')) {
            abort(404, '暂未开放购买功能！');
        }

        $seo_title = '结算页面';

        // 获取数据
        // 购买第一步 返回下单页面数据
        if (is_app()) { // app
//            $this->checkout->clearCheckoutData($this->user_id);

            $checkout_submit_data = $this->checkout->getCheckoutData($this->user_id);
            if (empty($checkout_submit_data)) {
                // 购买类型 0-加入购物车购买 1-立即购买 2-去结算 3-兑换 4-自由购 5-到店购 6-礼品提货
                $buy_type = $request->input('buy_type', 1);
                // 先清空购买信息
                $this->checkout->clearCheckoutData($this->user_id);

                if ($buy_type == 1) { // 直接购买
                    $sku_id = $request->input('sku_id');
                    $goods_id = $this->goods->getGoodsId($sku_id);
                    $number = $request->input('number');
                    $group_sn = $request->input('group_sn'); // 团长开团或用户参与拼团 必传参数
                    $goods_info = $this->goods->getOnSaleGoodsInfo($goods_id, $sku_id, $number);
                    if (empty($goods_info)) {
                        // 商品不存在
                        return result(-1,null,'商品不存在');
                    }
                    // 设置购买信息
                    $cart_id[$goods_info['shop_id']] = [$goods_id.'|'.$sku_id.'|'.$number];
                    $checkoutData = [
                        'buy_type' => 1,
                        'cart_id' => $cart_id,
                        'group_sn' => $group_sn
                    ];
                } else { // 购物车下单
                    // 从购物车表中取当前登录用户的选中购物车商品列表
                    $this->cart->setUserId($this->user_id);
                    $this->cart->setUniqueId($this->session_id);
                    $cart_list = $this->cart->getCartGoodsList(1); // 购物车数据
                    $cart_id = [];
                    foreach ($cart_list as $v) {
                        $cart_id[$v['shop_id']][] = $v['cart_id'].'|'.$v['sku_id'].'|'.$v['goods_number'];
                    }
                    $checkoutData = [
                        'buy_type' => 0,
                        'cart_id' => $cart_id
                    ];
                }

                $ret = $this->checkout->setCheckoutData($this->user, $checkoutData);
                if (isset($ret['code']) && $ret['code'] == 1) {
                    return result(-1, null, $ret['message']);
                }
                $checkout_submit_data = $this->checkout->getCheckoutData($this->user_id);
                if (empty($checkout_submit_data)) {
                    return result(-1, null, '您没有提交任何需要结算的商品！！');
                }
            } else {
                // 获取
                $checkout_submit_data = $this->checkout->getCheckoutData($this->user_id);
            }

//                return result(0, $checkout_submit_data['data'], '获取成功');
        } else {
            $checkout_submit_data = $this->checkout->getCheckoutData($this->user_id);
            if (empty($checkout_submit_data)) {
                // 客户端判断
                /* elseif (is_mobile() || (request()->getHost() == config('lrw.mobile_domain'))) { // 微信端
                    // 购买参数错误 跳转到购物车页面
                    return redirect(route('mobile_cart_list'));
                } else { // pc端
                    // 购买参数错误 跳转到购物车页面
                    return redirect(route('pc_cart_list'));
                }*/
                // 否则跳转到购物车页面
                return redirect('/cart.html');
            }
        }

        extract($checkout_submit_data); // 将数据从 $result中取出

        // 送货时间描述
        $send_time_desc = sysconf('send_time_desc');
        // 是否显示送货时间
        $send_time_show = !empty($send_time_list) ? true : false;



        // 是否显示发票信息
        $invoice_show = true; // todo 根据店铺商品是否允许开发票判断 !empty($cart_info['invoice_info']) ? true : false;
        // 发票信息
//        $invoice_type = '0';
//        $invoice_info = $this->buy1->getInvoiceInfo($invoice_type);

        $invoice_desc = $invoice ?? '不开发票'; // '不开发票';
        // 支付方式列表 多个店铺 数组取交集
        $pay_code = $checkout_submit_data['data']['order']['pay_code'];
        $pay_list = $this->payment->getPaymentList($pay_code);

        $cart_info = $cart_list;
        $cart_info['order'] = $data['order'];
        $cart_info['invoice_type'] = $data['invoice_type'];
        $cart_info['invoice_info'] = $data['invoice_info'];
        $cart_info['user_info'] = $data['user_info'];
        $cart_info['key'] = $key; // todo

        // 是否显示配送方式
        $shipping_list_show = true;

        // 送货时间
        $checked = $best_time_id; // 选中项 默认0
        $send_time_list = $this->checkout->getSendTime($checked);

        // 用户收货地址
        $address_list = $this->userAddress->getUserAddressList($this->user_id, 'buy', $address_id);
        $address_list_show = !empty($address_list) ? true : false;

        // 获取微信端选中地址信息
        $address_info = [];
        if (!empty($address_list)) {
            foreach($address_list as $v){
                if($v['selected']) {
                    $address_info = $v;
                }
            }
        }
        $check_address = !empty($address_list) ? 0 : 1; // 是否检查地址 如果是上门自提 则不需要检查地址 如果是普通快递 需要检查地址

        $compact = compact('seo_title', 'address_list',
            'send_time_list','send_time_desc','send_time_show','best_time',
            'cart_info','shipping_list_show','invoice_show','invoice_info',
            'invoice_desc', 'pay_list', 'check_address', 'address_info');
        $webData = []; // web端（pc、mobile）数据对象
        $data = [
            'app_prefix_data' => [
                'address_list' => $address_list,
                'address_info' => $address_info,
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
                'buy_type' => $buy_type,
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

        $this->setData($data); // 设置数据
        return $this->displayData(); // 模板渲染及APP客户端返回数据
    }


    /**
     * 切换收货地址
     * ok
     * @param Request $request
     * @return array
     */
    public function changeAddress(Request $request)
    {
        $address_id = $request->post('address_id');
        /*$userBuy = session('user_buy_'.$this->user_id);
        $userBuy['selected_address'] = $address_id;
        session(['user_buy_'.$this->user_id => $userBuy]);*/
        $checkoutData = [
            'address_id' => $address_id,
        ];

        // 设置购买信息
        $ret = $this->checkout->setCheckoutData($this->user, $checkoutData, 2);
        if (isset($ret['code']) && $ret['code'] == 1) {
            return result(-1, null, $ret['message']);
        }
        return result(0, [], '操作成功');
    }

    /**
     * 切换送货时间
     * ok
     * @param Request $request
     * @return array
     */
    public function changeBestTime(Request $request)
    {
        $send_time_id = $request->post('send_time_id');
        $send_time = $request->post('send_time');
        if (empty($send_time)) {
            $send_time = $this->checkout->getBestTime($send_time_id);
        }

//        $userBuy = session('user_buy_'.$this->user_id);
//        $userBuy['send_time_id'] = $send_time_id;
//        $userBuy['send_time'] = $send_time;
//        session(['user_buy_'.$this->user_id => $userBuy]);

        $checkoutData = [
            'best_time' => $send_time,
            'best_time_id' => $send_time_id
        ];

        // 设置购买信息
        $ret = $this->checkout->setCheckoutData($this->user, $checkoutData, 1);
        if (isset($ret['code']) && $ret['code'] == 1) {
            return result(-1, null, $ret['message']);
        }
        return result(0, $checkoutData, '操作成功');
    }

    /**
     * 修改发票信息
     *
     * @param Request $request
     * @return array
     */
    public function changeInvoice(Request $request)
    {

        $checkoutData = $request->post();

        // 设置购买信息
        $ret = $this->checkout->setCheckoutData($this->user, $checkoutData, 4);
        if (isset($ret['code']) && $ret['code'] == 1) {
            return result(-1, null, $ret['message']);
        }

        // 获取购买信息
        $checkoutData = $this->checkout->getCheckoutData($this->user_id);

        $key = array_search('selected', array_column($checkoutData['invoice_info'], 'selected'));
        $result = $checkoutData['invoice_info'][$key]['name'];
        // 不开发票
        $data = [
            $result
        ];
        return result(0, $data, '设置发票信息成功');
    }

    /**
     * 用户收货地址列表
     *
     * @param Request $request
     * @return mixed
     * @throws \Throwable
     */
    public function userAddress(Request $request)
    {
        $address_list = $this->userAddress->getUserAddressList($this->user_id, 'buy');

        if ($request->ajax()) { // PC端 ajax请求
            $render = view('buy.user_address', compact('address_list'))->render();

            return result(0, $render);
        }

        return view('buy.user_address', compact('address_list'));
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

        // 设置购买信息
        $checkoutData['postscript'] = $postscript;
        $checkoutRet = $this->checkout->setCheckoutData($this->user, $checkoutData, 5);
        Log::info("提交订单 checkoutRet:".json_encode($checkoutRet));

        if (isset($checkoutRet['code']) && $checkoutRet['code'] == 1) {
            return result(-1, null, $checkoutRet['message']);
        }
        Log::info("提交订单结果:".json_encode($checkoutRet));

        $ret = $this->checkout->submitOrder($this->user);
        if ($ret['code'] != 0) {
            return result($ret['code'], $ret['data'], $ret['message']);
        }


        Log::info("提交订单结果:".json_encode($ret));

        $group_sn = $ret['data']['group_sn'] ?? null;
        $order_sn = $ret['data']['order_sn'];

        $data = route('payment').'?order_sn='.$order_sn; // 支付页面url
        $extra = [
            'group_sn' => $group_sn,
            'order_sn' => $order_sn
        ];
        if (is_app()) {
            return result(0, $extra, '提交订单成功');
        }
        return result(0, $data, '提交订单成功', $extra);
    }

    /**
     * 再次提交订单
     * 从 /checkout/pay.html 付款页面提交订单
     * @param Request $request
     * @return array|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function resubmit(Request $request)
    {
        $key = $request->post('key');
        $order_id = $request->post('order_id');
        $order_sn = $request->post('order_sn');
        $integral_enable = $request->post('integral_enable', false);
        $balance_enable = $request->post('balance_enable', false);
        $pay_code = $request->post('pay_code');

        $order_id_arr = explode(',', $order_id);

        //
        // 获取支付提交信息
        $pay_submit_data = $this->checkout->getPaySubmitData($key);
        if (!$pay_submit_data) {
            return result(-1, null, '失败');
        }

        // 更新订单支付方式 todo 如果是多个订单合并支付，并更新parent_sn为新的值
        $ret = OrderInfo::whereIn('order_id', $order_id_arr)->update(['pay_code'=>$pay_code]);
        if ($ret === false) {
            return result(-1, null, '提交订单失败');
        }

        // 清空支付缓存
//        $this->checkout->clearPaySubmitData($key);


        $data = route('payment').'?order_sn='.$order_sn.'&area_tag='; // 支付页面url
        $extra = [
            'merge_pay' => $pay_submit_data['merge_pay'],
            'merge_sn' => $order_sn,
            'order_id' => $order_id,
            'order_sn' => $order_sn
        ];
        return result(0, $data, '提交订单成功', $extra);
    }

    /**
     * 付款结果查询
     * todo
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function result(Request $request)
    {
        $key = $request->get('key'); // 订单信息加密后的key todo 待支持时？
        $order_sn = $request->get('order_sn'); // 单个订单 则为订单编号；多个订单 则为parent_sn编号

        $seo_title = '结算页面';

        // 获取数据
        if (!empty($key)) {
            // key
            // 获取支付提交信息
            $pay_submit_data = $this->checkout->getPaySubmitData($key);
            if (empty($pay_submit_data)) {
                abort(200, '订单信息不存在或者已失效！');
            }
            $order_ids_arr = explode('|', $pay_submit_data['order_id']);
            $order_list = OrderInfo::whereIn('order_id', $order_ids_arr)
                ->with(['shop','orderGoods'])
                ->get()->toArray();

            if (empty($order_list)) {
                abort(200, '订单信息不存在或者已失效！');
            }

            $order_sn = $pay_submit_data['order_sn'];

            $is_pay = !in_array(0, array_column($order_list, 'pay_status')) ? 1 : 0;
            $steps = $this->orderInfo->getPaySteps([1,2,3,4]);
        } else {
            // order_sn
            $order_list = OrderInfo::where('order_sn', 'like', "%{$order_sn}%")
                ->with(['shop','orderGoods'])
                ->get()->toArray();
            if (empty($order_list)) {
                $order_list = OrderInfo::where('parent_sn', 'like', "%{$order_sn}%")
                    ->with(['shop','orderGoods'])
                    ->get()->toArray();
            }

            // 未找到待支付订单 返回异常
            if (empty($order_list)) {
                abort(200, '您还没有任何待付款订单，赶快去购物吧！');
            }

            $order_ids_arr = array_column($order_list, 'order_id');

            $is_pay = !in_array(0, array_column($order_list, 'pay_status')) ? 1 : 0;
        }

        $order = [
            'order_sn' => $order_sn,
            'is_cod' => 0,
            'order_amount' => array_sum(array_column($order_list, 'order_amount')),
            'money_paid' => array_sum(array_column($order_list, 'money_paid')),
            'is_pay' => $is_pay,
            'status' => !in_array(0, array_column($order_list, 'order_status')) ? 1 : 0,
            'order_data' => null,
            'order_id' => $order_ids_arr,
            'comstore_id'=>'0',
            'cash_back_amount'=>0,
            'buy_type' => array_first($order_list)['buy_type'],
            'order_type' => array_first($order_list)['order_type'],
            'shop_id' => array_first($order_list)['shop_id'],
            'reachbuy_code' => array_first($order_list)['reachbuy_code'],
            'add_time' => array_first($order_list)['add_time'],
            'consignee' => array_first($order_list)['consignee'],
            'order_sns' => '0',
            'user_id' => array_first($order_list)['user_id'],
            'give_integral' => 0,
            'order_amount_format' => '￥'.array_sum(array_column($order_list, 'order_amount')),
            'money_paid_format' => '￥'.array_sum(array_column($order_list, 'money_paid')),
            'order_count' => count($order_ids_arr),
        ];


        foreach ($order_list as &$item) {
            $item['shop_name'] = $item['shop']['shop_name'];
            $item['cash_back_amount'] = null;
            $item['order_amount_format'] = '￥'.$item['order_amount'];
            $item['money_paid_format'] = '￥'.$item['money_paid'];
            $item['surplus_format'] = '￥'.$item['surplus'];

            $item['goods_list'] = $item['order_goods'];
            $item['order_status_format'] = format_order_status($item['order_status'],$item['shipping_status'],$item['pay_status']);

            unset($item['shop'],$item['order_goods']);
        }

        if ($is_pay) {
            $steps = $this->orderInfo->getPaySteps([1,2,3,4]);
        } else {
            $steps = $this->orderInfo->getPaySteps([1,2]);
        }

        $is_exchange = false;
        $is_gift = false;
        $mall_phone = sysconf('mall_phone');
        $is_success = null;
        $group_sn = '';

        $sum_cash_back_amount = 0;
        $full_cut = null;

        $compact = compact('seo_title','key','order','order_list','is_exchange',
            'is_gift','mall_phone','is_success','group_sn','steps','sum_cash_back_amount','full_cut');
        $webData = []; // web端（pc、mobile）数据对象
        $data = [
            'app_prefix_data' => [
                'order' => $order,
                'order_list'=>$order_list,
                'is_exchange'=>$is_exchange,
                'is_gift'=>$is_gift,
                'mall_phone'=>$mall_phone,
                'is_success'=>$is_success,
                'group_sn'=>$group_sn,
                'steps'=>$steps,
                'sum_cash_back_amount'=>$sum_cash_back_amount,
                'full_cut'=>$full_cut,
            ],
            'app_suffix_data' => [],
            'web_data' => $webData,
            'compact_data' => $compact,
            'tpl_view' => 'buy.result'
        ];
        $this->setData($data); // 设置数据
        return $this->displayData(); // 模板渲染及APP客户端返回数据
    }

    /**
     * 付款页面
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function pay(Request $request)
    {
        $order_id = $request->get('id'); // 订单id 1,2,3 如果是多个订单id，则表示对多个订单进行合并支付

        $seo_title = '结算页面';

        // order_sn 如果是单个订单 则是订单编号
        //          如果是多个订单，并且不是同一个parent_sn 的订单 随机生成 order_sn 格式为：MP202001040938490898798
        //          如果是多个订单，并且是同一个parent_sn 的订单   则取订单的parent_sn即可 如：202001040938490898721
        // key 随机生成md5字符串

        if (!$order_id) {
            abort(-1, '订单不存在或者状态已改变');
        }

        // 获取数据
        // todo 付款页面每刷新一次 key就会变 所以不是 md5($order_id)，
        // todo 这个key 只是获取 result页面 订单信息
        $key = $this->checkout->setPayKey(); //

        list($order_sn, $money_pay, $order, $order_list, $remark_list, $pay_list, $user_info, $merge_pay
            ,$is_virtual,$steps,$balance_enable,$balance_first,$topay_enable) = $this->checkout->setPaymentData($key, $this->user, $order_id);


        $compact = compact('seo_title','key','order_id','order_sn','money_pay',
            'order','order_list','remark_list','pay_list','user_info','merge_pay',
            'is_virtual','steps','balance_enable','balance_first','topay_enable');
        $webData = []; // web端（pc、mobile）数据对象
        $data = [
            'app_prefix_data' => [
                'key' => $key,
                'order_id' => $order_id,
                'order_sn' => $order_sn,
                'money_pay' => $money_pay,
                'money_pay_format' => '￥'.$money_pay,
                'order' => $order,
                'order_list' => $order_list,
                'remark_list' => $remark_list,
                'pay_list' => $pay_list,
                'user_info' => $user_info,
                'merge_pay' => $merge_pay,
                'is_virtual' => $is_virtual,
                'steps' => $steps,
                'balance_enable' => $balance_enable,
                'balance_first' => $balance_first,
                'topay_enable' => $topay_enable,
            ],
            'app_suffix_data' => [],
            'web_data' => $webData,
            'compact_data' => $compact,
            'tpl_view' => 'buy.pay'
        ];
        $this->setData($data); // 设置数据
        return $this->displayData(); // 模板渲染及APP客户端返回数据
    }


    /**
     * 修改支付方式
     * todo 暂时只做了PC、Mobile端的数据返回
     * 暂未做APP端数据返回 返回的结果与PC、Mobile一样
     *
     * @param Request $request
     * @return array
     */
    public function changePayment(Request $request)
    {
        $integral_enable = $request->post('integral_enable', false);
        $balance = $request->post('balance', 0); // 大于0时 使用指定金额的余额支付
        $balance_enable = $request->post('balance_enable', false);
        $pay_code = $request->post('pay_code');

        $checkoutData = [
            'integral_enable' => $integral_enable,
            'balance' => $balance,
            'balance_enable' => $balance_enable,
        ];
        $checkoutData['data']['order']['pay_code'] = $pay_code;
        // 设置购买信息
        $ret = $this->checkout->setCheckoutData($this->user, $checkoutData, 3);
        if (isset($ret['code']) && $ret['code'] == 1) {
            return result(-1, null, $ret['message']);
        }

        // 获取购买信息
        $checkoutData = $this->checkout->getCheckoutData($this->user_id);
        $pay_list = $this->payment->getPaymentList($pay_code);
        // 按店铺分为多个数组
        $shop_orders = [];
        foreach ($checkoutData['data']['shop_list'] as $shop_id=>$item) {
            $shop_orders[] = $item['order'];
        }
        $extra = [
            'pay_list' => $pay_list,
            'user_info' => $checkoutData['data']['user_info'],
            'order' => $checkoutData['data']['order'],
            'shop_orders' => $shop_orders,
            'check_address' => $checkoutData['check_address'],
            'pickup_id' => null
        ];
        if (is_app()) {
            return result(0, $extra, '操作成功');
        }
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

        // 设置支付提交信息
        $paySubmitData['order']['pay_code'] = $pay_code;
        $this->checkout->setPaySubmitData($key, $this->user, $paySubmitData, 3);

        // 获取支付提交信息
        $pay_submit_data = $this->checkout->getPaySubmitData($key);
        if (!$pay_submit_data) {
            return result(-1, null, '失败');
        }


        $order = [
            'balance' => 0,
            'balance_format' => "￥0",
            'cash_more' => 0,
            'give_integral' => 0,
            'integral' => 0,
            'integral_amount' => 0,
            'integral_amount_format' => "￥0",
            'is_cash' => 0,
            'money_pay' => $pay_submit_data['order']['money_paid'],
            'money_pay_format' => "￥".$pay_submit_data['order']['money_paid'],
            'order_amount' => $pay_submit_data['order']['order_amount'],
            'order_amount_format' => "￥".$pay_submit_data['order']['order_amount'],
            'pay_code' => $pay_submit_data['order']['pay_code'],
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
