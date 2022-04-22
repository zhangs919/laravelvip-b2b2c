<?php

namespace App\Repositories;


use App\Jobs\OrderUpdate;
use App\Models\Contract;
use App\Models\SelfPickup;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Queue;

class BuyRepository
{
    use BaseRepository;

    /**
     * 会员信息
     * @var array
     */
    private $_user_info = [];

    /**
     * 下单数据
     * @var array
     */
    private $_order_data = [];

    /**
     * 表单数据
     * @var array
     */
    private $_post_data = [];

    protected $goods;
    protected $goodsSku;
    protected $shop;
    protected $customer;
    protected $payment;
    protected $userAddress;
    protected $buy1; // 购买下单逻辑辅助类
    protected $orderInfo;
    protected $orderGoods;

    public function __construct()
    {

        $this->goods = new GoodsRepository();
        $this->goodsSku = new GoodsSkuRepository();
        $this->shop = new ShopRepository();
        $this->customer = new CustomerRepository();
        $this->payment = new PaymentRepository();
        $this->userAddress = new UserAddressRepository();
        $this->buy1 = new Buy1Repository();
        $this->orderInfo = new OrderInfoRepository();
        $this->orderGoods = new OrderGoodsRepository();
    }

    /**
     * 得到购买商品的id、sku_id、number数组数据
     * @param array $cart_id 购买商品信息数组
     * @return array
     */
    private function _parseItems($cart_id)
    {
        $buy_items = [];
        if (is_array($cart_id)) {
            foreach ($cart_id as $v) {
                if (preg_match_all('/^(\d{1,10})\|(\d{1,10})\|(\d{1,6})$/', $v, $match)) {
                    if (intval($match[3][0]) > 0) { // 购买数量大于0
                        $buy_items[] = [
                            'cart_id' => $match[1][0],
                            'sku_id' => $match[2][0],
                            'number' => $match[3][0],
                        ];
                    }
                }
            }
        }

        return $buy_items;
    }

    /**
     * 购买第一步
     * 确定订单信息
     *
     * @param array $userBuy 用户购买信息数组
     * @param int $userId 当前登录用户id
     * @return array
     */
    public function buyStep1($userBuy, $userId)
    {
        if (empty($userBuy)) {
            // 无购买信息 跳转到购物车页面
            return arr_result(-1, null, '您没有提交任何需要结算的商品');
        }

        // 购买商品信息 (商品id/购物车id)|sku_id|购买数量 如果是购物车购买 是多个数组
        $cart_id = !empty($userBuy['cart_id']) ? $userBuy['cart_id'] : null;
        $buy_items = $this->_parseItems($cart_id);
        if (empty($buy_items)) {
            return arr_result(-1, null, '您没有提交任何需要结算的商品');
        }

        if (count($buy_items) > 50) {
            return arr_result(-1, null, '一次最多只可购买50种商品');
        }


        $integral_enable = isset($userBuy['integral_enable']) ? $userBuy['integral_enable'] : false;
        $balance_enable = isset($userBuy['balance_enable']) ? $userBuy['balance_enable'] : false;
        $pay_code = isset($userBuy['pay_code']) ? $userBuy['pay_code'] : '';
        $selected_address = isset($userBuy['selected_address']) ? $userBuy['selected_address'] : 0; // 选中的收货地址id
        $send_time_id = isset($userBuy['send_time_id']) ? $userBuy['send_time_id'] : 0;
        $send_time = isset($userBuy['send_time']) ? $userBuy['send_time'] : '';

//        dd($buy_items);

        // 用户收货地址
        $address_list = $this->userAddress->getUserAddressList($userId, 'buy', $selected_address);
//        dd($address_list);
        // 送货时间
        $checked = $send_time_id; // 选中项 默认0
        $send_time_list = $this->getSendTime($checked);
        // 送货时间描述
        $send_time_desc = sysconf('send_time_desc');
        // 最佳送货时间
        $best_time = $send_time;
        // 是否显示送货时间
        $send_time_show = !empty($send_time_list) ? true : false;
        // 购物车信息
        $cart_info = $this->getCartInfo($userId, $userBuy, $buy_items);
        // 是否显示配送方式
        $shipping_list_show = true;

        // 是否显示发票信息
        $invoice_show = !empty($cart_info['invoice_info']) ? true : false;
        $invoice_info = $cart_info['invoice_info'];

        $invoice_desc = '不开发票';
        // 支付方式列表 多个店铺 数组取交集
        $pay_list = $this->payment->getPaymentList($pay_code);

        $data = [
            'address_list' => $address_list,
            'address_list_show' => !empty($address_list) ? true : false,
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
        ];

        return arr_result(0, $data);
    }

    /**
     * 获取最佳送货时间文字描述
     *
     * @param int $sendTimeId 送货时间Id
     * @return mixed|null
     */
    public function getBestTime($sendTimeId)
    {
        $sendTime = explode(',', sysconf('send_time')); // 送货时间
        foreach ($sendTime as $k => $v) {
            if ($k == $sendTimeId) {
                return str_replace(
                    [1, 2, 3, 4, 5],
                    ['立即配送', '工作日/周末/假日均可', '仅周末送货', '仅工作日送货', '指定送货时间'],
                    $v
                );
            }
        }
        return null;
    }

    /**
     * 获取送货时间
     * 购物下单页面调用到
     *
     * @param int $checked
     * @return array
     */
    public function getSendTime($checked = 0)
    {
        $sendTime = explode(',', sysconf('send_time')); // 送货时间
        $shippingTime = json_decode(sysconf('shipping_time'), true); // 指定送货时间
        $list = [];
        if (!empty($sendTime)) {
            foreach ($sendTime as $k => $v) {
                $item = [
                    'value' => str_replace(
                        [1, 2, 3, 4, 5],
                        ['立即配送', '工作日/周末/假日均可', '仅周末送货', '仅工作日送货', '指定送货时间'],
                        $v
                    ),
                    'checked' => $k == $checked ? 'checked' : '',
                    'set_time' => false,
                ];
                if (!empty($shippingTime) && $v == 5) { /*指定送货时间*/
                    $item['set_time'] = true;
                    $bestTime = [];
                    $timePeriod = [];
                    foreach ($shippingTime['begin_hour'] as $hourKey => $hour) {
                        $timePeriod[] = $shippingTime['begin_hour'][$hourKey] . ':' . $shippingTime['begin_minute'][$hourKey] .
                            '--' . $shippingTime['end_hour'][$hourKey] . ':' . $shippingTime['end_minute'][$hourKey];
                    }
                    foreach (range(0, 6) as $weekDay) {
                        if (in_array($weekDay, $shippingTime['week'])) {
                            $date = Carbon::now()->addDays($weekDay);
                            $dateFormat = $date->format('m-d');
                            $week = $date->dayOfWeek;
                            $weekFormat = str_replace(
                                range(0, 6),
                                ['周日', '周一', '周二', '周三', '周四', '周五', '周六'],
                                $week
                            );
                            // 当前日期
                            $currentDate = Carbon::now()->addDays(0);
                            $currentWeek = $currentDate->dayOfWeek;
                            if ($week == $currentWeek) {
                                $weekFormat = '今天';
                            }

                            $timeArray = [];
                            foreach ($timePeriod as $timeValue) {
                                $trueTimeBegin = strtotime($date->format('Y') . '-' . $dateFormat . ' ' . explode('--', $timeValue)[0]);
                                $trueTimeEnd = strtotime($date->format('Y') . '-' . $dateFormat . ' ' . explode('--', $timeValue)[1]);
                                $use = 0;
                                // 消费者下单时间+1个小时小于配送时间段的开始时间
                                // 或消费者下单时间+1个小时小于配送时间段的结束时间，
                                // 那么此时间段消费者是可以选择的
                                if ((time() < $trueTimeBegin + 3600) || (time() < $trueTimeEnd + 3600)) {
                                    $use = 1;
                                }
                                $timeArray[] = [
                                    'use' => $use,
                                    'text' => $timeValue
                                ];
                            }
                            $bestTime[] = [
                                'name' => $dateFormat,
                                'week' => $weekFormat,
                                'time' => $timeArray
                            ];
                        }
                    }
                    $item['best_time'] = $bestTime;
                }
                $list[] = $item;
            }
        }

        return $list;
    }

    /**
     * @param int $checked
     */
    public function getInvoiceInfo($checked = 0)
    {

    }

    /**
     * 获取直接购买店铺及商品数据
     *
     * @param $user_id
     * @param $user_buy
     * @return mixed
     */
    public function getQuickBuyShopGoods($user_id, $user_buy, $buy_items)
    {
        $buy_item = array_first($buy_items);

        $goods_id = $buy_item['cart_id'];
        $sku_id = $buy_item['sku_id'];
        $goods_number = $buy_item['number']; // 购买数量
        $goods_info = $this->goods->getOnSaleGoodsInfo($goods_id, $sku_id, $goods_number);
        $sku_info = $this->goodsSku->getById($sku_id);

        // 店铺信息
        $shop_info = $this->shop->getShopInfo($goods_info['shop_id']);
        $shop_info->customer = $this->customer->getCustomerMain($goods_info['shop_id']);
        $shop_info->aliim_enable = shopconf('aliim_enable', '', $goods_info['shop_id']); // 店铺是否开启阿里云旺客服
        $shop_info->system_aliim_enable = sysconf('aliim_enable'); // 平台是否开启阿里云旺客服
        // 店铺自提点列表
        $pickup_list = SelfPickup::where([['shop_id', $goods_info['shop_id']], ['is_show', 1]])
            ->orderBy('sort', 'asc')->get()->toArray();
        $shop_info->delivery_enable = !empty($pickup_list) ? 1 : 0;
        $shop_info->pickup_list = $pickup_list;

        // 计算店铺商品运费
        $shipping_fee = 0.00; // todo 需要计算

        // 配送方式
        $shipping_list = $this->getShippingList($shipping_fee);

        // 订单初始化数据
        // 商品总金额 商品单价*购买数量
        $goods_amount = $sku_info->goods_price * $goods_number;
        // 订单总金额 商品总金额 + 运费 + 其他优惠 - 其他优惠
        $order_amount = $goods_amount + $shipping_fee;
        $order = [
            'order_amount' => $order_amount,
            'goods_amount' => $goods_amount,
            'shipping_fee' => $shipping_fee,
            'give_integral' => $goods_info['give_integral'],
            'inv_fee' => 0,
            'is_cash' => 0,
            'cash_more' => 0,
            'shop_bonus_id' => 0,
            'shop_bonus_amount' => 0,
            'bonus_amount' => 0,
            'order_type' => 0,
            'other_amount' => 0,
            'buyer_type' => 0,
            'buy_type' => 1,
            'card_id' => 0,
            'shop_store_card_amount' => 0,
            'full_cut_amount' => 0,
            'full_cut_bonus' => null,
            'full_cut_point' => 0,
            'discount_fee' => 0,
            'pre_sale_mode' => null,
            'shop_bonus_amount_format' => '￥0',
            'shipping_fee_format' => '￥' . $shipping_fee,
            'order_amount_format' => '￥' . $order_amount,
            'bonus_amount_format' => '￥0',
            'cash_more_format' => '￥0',
            'full_cut_amount_format' => '￥0',
            'shop_id' => $goods_info['shop_id'],
            'shop_store_card_amount_format' => '￥0',
        ];

        $data[$goods_info['shop_id']] = [
            'select' => 0,
            'add_time' => time(),
            'add_time_format' => format_time(time(), 'Y-m-d H:i:s'),
            'shop_info' => $shop_info->toArray(), // 转换成数组
            'bonus_list' => null, // todo
            'goods_list' => [
                [
                    'user_id' => $user_id,
                    'session_id' => 0,
                    'goods_id' => $goods_id,
                    'sku_id' => $sku_id,
                    'goods_name' => $goods_info['goods_name'],
                    'goods_number' => $goods_number,
                    'goods_price' => $goods_info['goods_price'],
                    'goods_type' => 0,
                    'parent_id' => 0,
                    'is_gift' => 0,
                    'add_time' => time(),
                    'buyer_type' => 0, // 买家类型 0-普通买家 1-商家买家
                    'buy_type' => 1, // 购买类型 1-直接购买

                    'shop_id' => $goods_info['shop_id'],
                    'cart_id' => null,
                    // SKU信息
                    'sku_name' => $sku_info->sku_name,
                    'sku_image' => $sku_info->sku_image,
                    'original_price' => $sku_info->goods_price,
                    'sku_number' => $sku_info->goods_number,
                    'market_price' => $sku_info->market_price,
                    'sku_sn' => $sku_info->goods_sn,
                    'spec_names' => !empty($sku_info->spec_names) ? explode(' ', $sku_info->spec_names) : '',

                    // 商品信息
                    'cat_id' => $goods_info['cat_id'],
                    'order_act_id' => $goods_info['order_act_id'],
                    'brand_id' => $goods_info['brand_id'],
                    'goods_status' => $goods_info['goods_status'] == 1 ? true : false,
                    'goods_audit' => $goods_info['goods_audit'],
                    'is_delete' => $goods_info['is_delete'],
                    'goods_image' => $goods_info['goods_image'],
                    'goods_images' => $goods_info['goods_images'],
                    'give_integral' => $goods_info['give_integral'],
                    'invoice_type' => $goods_info['invoice_type'],
                    'stock_mode' => $goods_info['stock_mode'],
                    'spu_number' => $goods_info['goods_number'],
                    'contract_ids' => $goods_info['contract_ids'],
                    'goods_sn' => $goods_info['goods_sn'],
                    'act_id' => $goods_info['act_id'],
                    'is_virtual' => $goods_info['is_virtual'],
                    'goods_mode' => $goods_info['goods_mode'],
                    'ext_info' => $goods_info['ext_info'],

                    // 店铺信息
                    'shop_status' => $shop_info->shop_status,
                    'goods_min_number' => 1,
                    'goods_max_number' => $goods_info['goods_number'],
                    'select' => 0,
                    'cart_act_id' => $goods_info['act_id'],
                    'activity' => null,
                    'order_activity' => null,
                    'goods_price_format' => '￥' . $sku_info->goods_price,
                    'market_price_format' => '￥' . $sku_info->market_price,
                    'original_price_format' => '￥' . $sku_info->original_price,
                    'add_time_format' => format_time(time(), 'Y-m-d H:i:s'),
                    'goods_amount' => $sku_info->goods_price * $goods_number,
                    'goods_amount_format' => '￥' . $sku_info->goods_price * $goods_number,
                    'contract_list' => null,
                    'gift_list' => null,
                    'discount_fee' => 0,
                    'shop_bonus_amount' => 0,
                    'other_price' => 0
                ]
            ],
            'shipping_list' => $shipping_list,
            'limit_goods' => null,
            'limit_goods_ids' => null,
            'order' => $order,
            'store_card_list' => null,
        ];

        return $data;
    }

    /**
     * 获取购物车商品列表
     * todo
     * @return array
     */
    public function getCartShopGoods($user_id)
    {

        return [];
    }


    public function getCartInfo($user_id, $user_buy, $buy_items)
    {
        $buy_type = $user_buy['buy_type']; // 购买类型 0-加入购物车购买 1-立即购买 2-去结算 3-兑换 4-自由购 5-到店购 6-礼品提货

        if ($buy_type == 1) { // 直接购买
            $goods_number = $buy_items[0]['number']; // 购买数量

            $select_goods_number = 0;
            $select_goods_amount = 0;
            $shop_list = $this->getQuickBuyShopGoods($user_id, $user_buy, $buy_items);
            $select_shop_amount = [
                '5' => 32,
                '37' => 22.3
            ];
        } else { // 购物车购买
            $goods_number = 0; // 购买数量 todo
            $select_goods_number = 0;
            $select_goods_amount = 0;
            $shop_list = $this->getCartShopGoods($user_id);
            $select_shop_amount = [];
        }

        // 发票信息
        $invoice_type = '0';
        $invoice_info = [];

        $data = [
            'select_goods_number' => $select_goods_number,
            'select_goods_amount' => $select_goods_amount,
            'select_goods_amount_format' => '￥' . $select_goods_amount,
            'goods_number' => $goods_number,
            'full_cut_amount' => 0,
            'invalid_cart_ids' => null,
            'goods_amount' => 32,
            'pre_sale_mode' => null,
            'select_shop_amount' => $select_shop_amount,
            'shop_delivery_enable' => [
                '5' => 1,
                '37' => 1
            ],
            'submit_enable' => 1,
            'shop_list' => $shop_list,
            'invalid_list' => null,
            'order' => [
                'pay_code' => null,
                'order_amount' => 63,
                'goods_amount' => 55,
                'shipping_fee' => 8,
                'balance' => 0,
                'integral' => 0,
                'integral_amount' => 0,
                'inv_fee' => 0,
                'money_pay' => 63,
                'is_cash' => 0,
                'cash_more' => 0,
                'bonus_id' => 0,
                'bonus_amount' => 0,
                'shop_bonus_amount' => 0,
                'buyer_type' => 0,
                'shop_store_card_amount' => 0,
                'full_cut_amount' => 0,
                'full_cut_bonus' => 0,
                'full_cut_point' => 0,
                'order_data' => null,
                'order_type' => 0,
                'is_cod' => 0,
                'pay_id' => null,
                'pay_name' => null,
                'discount_fee' => 0,
                'give_integral' => 0,
                'total_bonus_amount' => 0,
                'order_amount_format' => "￥63",
                'goods_amount_format' => "￥55",
                'shipping_fee_format' => "￥8",
                'integral_amount_format' => "￥0",
                'money_pay_format' => "￥63",
                'cash_more_format' => "￥0",
                'shop_bonus_amount_format' => "￥0",
                'bonus_amount_format' => "￥0",
                'total_bonus_amount_format' => "￥0",
                'full_cut_amount_format' => "￥0",
                'discount_fee_format' => "￥0",
                'shop_store_card_amount_format' => "￥0",
                'balance_format' => "￥0",
            ],
            'invoice_type' => $invoice_type,
            'invoice_info' => $invoice_info,
            'user_info' => [
                'pay_point' => '14|0',
                'pay_point_amount' => 0.14,
                'pay_point_amount_format' => '￥0.14',
                'balance' => '2000',
                'balance_format' => '￥2000',
                'balance_password_enable' => 0
            ],
            'key' => 'c693f1a07c11be160f05ee55afcc351e' // 32位
        ];

        $data['select_goods_number'] = 2;

        return $data;
    }

    /**
     * 购买下单页面 获取配送方式列表
     * 普通快递 上门自提
     *
     * @param $shipping_fee
     * @return array
     */
    public function getShippingList($shipping_fee)
    {
        $data = [
            [
                'id' => 0,
                'name' => sysconf('shipping_name') . ' ',
                'price' => $shipping_fee,
                'price_format' => '￥' . $shipping_fee,
                'selected' => 'selected',
                'is_cash' => 0,
                'cash_more' => 0,
                'limit_goods' => null,
            ],
            [
                'id' => 1,
                'name' => sysconf('self_shipping_name') . ' ',
                'price' => 0,
                'price_format' => '￥0',
                'selected' => '',
                'is_cash' => 0,
                'cash_more' => 0,
                'pickup_id' => null,
                'pickup_name' => null,
                'limit_goods' => null,
            ],
        ];

        return $data;
    }


    /**
     * 生成订单编号
     *
     * 注意：后期需要重写订单编号生成方法，需要考虑到分布式服务器订单编号的不重复问题。
     * 方案：可以新建一个全局数据库，只建一个order表，表只有一个order_id自增字段，
     *      在生成订单编号时，通过api读取该数据库的order表order_id字段，进行自增，
     *      从而避免了频繁的更新操作。
     *
     * 长度 = 8位 + 2位 + 4位 + 6位 = 20位 如: 20190309 10 0059 974040
     * 年月日     (00-10) 分秒   随机6位数
     * 20190309    10     0059   974040
     *
     * szy
     * 20190309 10 0059 974040 parent_order_sn
     * 20190309 10 0059 136180 order_sn  2019-03-09 18:10:49
     * 20190309 10 0059 658800 order_sn  2019-03-09 18:10:50
     *
     * 20180727 00 5513 258860 parent_order_sn
     * 20180727 00 5513 656460 order_sn
     * 20180727 00 5514 503860 order_sn
     * 20180727 00 5514 676250 order_sn
     *
     *
     * 20190301063561604
     *
     * 大商创
     * 20170824 05 3559 112260 order_sn  2017-08-24 13:35:59
     *
     * @return string
     */
    public function makeOrderSn()
    {
        return format_time(time(), 'Ymd')
            . sprintf('%02d', mt_rand(0, 10)) // 0-10取两位 不足两位前面加0补两位
            . format_time(time(), 'is')
            . mt_rand(100000, 999999);

        /*$time = explode(' ', microtime());
        $time = $time[1] . $time[0] * 1000;
        $time = explode('.', $time);
        $time = isset($time[1]) ? $time[1] : 0;
        $time = date('YmdHis') + $time;
        mt_srand((double) microtime() * 1000000);
        return $time . str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT);*/
    }

    /**
     * 生成发货单编号(年月日 + 0 + [00-10] + 发货单生成时间取分钟 + 随机5位数)
     * 长度 = 8位 + 2位 + 2位 + 5位 = 17位 如: 20190222030144951
     * 年月日     (0-9)   分   随机5位数
     * 20190221    03     33   64227
     * @return string
     */
    public function makeDeliverySn()
    {
        return format_time(time(), 'Ymd')
            . sprintf('%02d', mt_rand(0, 10)) // 0-10取两位 不足两位前面加0补两位
            . format_time(time(), 'i')
            . mt_rand(10000, 99999);
    }

    /****************** 以下是生成订单逻辑代码 ********************/

    /**
     * 提交订单
     *
     * @param array $userBuy
     * @param $user
     * @param array $postscript 买家留言数组[以店铺id为下标]
     * @return array
     */
    public function submitOrder($userBuy, $user, $postscript)
    {
        $user_id = $user['user_id'];
        $this->_user_info = $user;
        $this->_post_data = $userBuy;


        DB::beginTransaction(); // 开始事务
        try {

            // 购买类型 0-加入购物车购买 1-立即购买 2-去结算 3-兑换 4-自由购 5-到店购 6-礼品提货
            $buy_type = isset($userBuy['buy_type']) ? $userBuy['buy_type'] : null;
            $integral_enable = isset($userBuy['integral_enable']) ? $userBuy['integral_enable'] : false;
            // 是否开启余额支付 0-关闭余额支付 1-开启余额支付
            $balance_enable = isset($userBuy['balance_enable']) ? $userBuy['balance_enable'] : false;
            $pay_code = isset($userBuy['pay_code']) ? $userBuy['pay_code'] : '';
            $selected_address = isset($userBuy['selected_address']) ? intval($userBuy['selected_address']) : 0; // 选中的收货地址id
            $send_time_id = isset($userBuy['send_time_id']) ? $userBuy['send_time_id'] : 0;
            $send_time = isset($userBuy['send_time']) ? $userBuy['send_time'] : '';


            // 1. 订单生成前的表单验证与处理

            if (empty($userBuy)) {
                // 无购买信息 跳转到购物车页面
                throw new \Exception('您没有提交任何需要结算的商品');
            }

            // 购买商品信息 (商品id/购物车id)|sku_id|购买数量 如果是购物车购买 是多个数组
            $cart_id = !empty($userBuy['cart_id']) ? $userBuy['cart_id'] : null;
            $buy_items = $this->_parseItems($cart_id);
            if (empty($buy_items)) {
                throw new \Exception('您没有提交任何需要结算的商品');
            }

            if (count($buy_items) > 50) {
                throw new \Exception('一次最多只可购买50种商品');
            }

            // 判断 部分商品不支持配送
            $limit_goods = [
                [
                    'goods_id' => 12,
                    'goods_name' => '新鲜猪肝 生猪干 1斤（多退少补）',
                    'sku_id' => 2,
                    'sku_name' => '新鲜猪肝 生猪干 1斤（多退少补）'
                ]
            ];
            if (empty($limit_goods)) { // todo
                return arr_result(109, $limit_goods, '部分商品暂不支持配送，请修改收货地址或移除部分商品');
            }

            // 验证收货地址 如果所有订单商品都是上门自提 则不需验证
            $input_address_id = $selected_address;
            if ($input_address_id <= 0) {
                throw new \Exception('请选择收货地址');
            } else {
                $input_address_info = $this->userAddress->getUserAddressInfo($user_id, $input_address_id);
                if (empty($input_address_info)) {
                    throw new \Exception('请选择收货地址');
                }

            }

            // 验证开票信息

            // 验证是否支持货到付款

            // 验证付款方式

            // 验证代金券

            // 验证红包


            // 保存数据


            // 2. 得到购买商品信息
            if ($buy_type == 0) {
                // 购物车购买  TODO 等待购物车方法重写后再完善

            } elseif ($buy_type == 1) {
                // 直接购买
                $buy_item = array_first($buy_items);
                $goods_id = $buy_item['cart_id'];
                $sku_id = $buy_item['sku_id'];
                $quantity = $buy_item['number'];

                // 商品信息[得到最新商品属性及促销信息] todo 等促销功能做的差不多了再调整该方法，增加各种促销活动信息返回
                $goods_info = $this->goods->getOnSaleGoodsInfo($goods_id, $sku_id, $quantity);
                if (empty($goods_info)) {
                    throw new \Exception('商品已下架或不存在');
                }
                $goods_info['number'] = $quantity;

                // 进一步处理数组
                $shop_cart_list = [];
                $goods_list = [];
                $goods_list[0] = $shop_cart_list[$goods_info['shop_id']][0] = $goods_info;
            }

            // 保存数据
            $this->_order_data['goods_list'] = $goods_list;
            $this->_order_data['shop_cart_list'] = $shop_cart_list;
            $this->_order_data['input_address_info'] = $input_address_info;

            // 3. 得到购买相关金额计算等信息
            // 商品金额计算（分别对每个商品/优惠套装小计、每个店铺小计）
            list($shop_cart_list, $shop_goods_total) = $this->buy1->calcCartList($shop_cart_list);

            // todo 判断预定不想睡任何优惠

            // 取得店铺优惠 - 满即送（赠品列表，店铺满送规则列表）

            // todo 重新计算店铺扣除各种优惠活动后商品实际支付金额
            $shop_activity = [];
            $activity_type = '';
            $shop_final_goods_total = $this->buy1->reCalcGoodsTotal($shop_goods_total, $shop_activity, $activity_type);

            // 计算每个店铺运费 判断如果是上门自提 不需要运费
            $shop_freight_total[key($shop_final_goods_total)] = 0;
            $is_self_pickup = false; // 是否上门自提
            if ($is_self_pickup) {
                $shop_freight_total[key($shop_final_goods_total)] = 0;
            } else {
                // 取得包邮店铺ID信息

            }

            // 计算店铺最终订单实际支付金额（加上运费）
            $shop_final_order_total = $this->buy1->reCalcGoodsTotal($shop_final_goods_total, $shop_freight_total, 'freight');

            // todo 计算每个店铺(所有店铺级优惠活动，代金券，满减)总共优惠多少
//            $shop_promotion_total = $this->buy1->getShopPromotionTotal($shop_goods_total, $shop_freight_total, $shop_final_order_total);

            //todo 得到有效平台红包

            // todo 计算每个订单应用了多少平台红包

            //重新计算优惠金额,将店铺红包减去运费的余额追加到店铺总优惠里
            $shop_bonus_total = []; // todo
//            $shop_promotion_total = $this->buy1->reCalcShopPromotionTotal($shop_promotion_total, $shop_freight_total, $shop_bonus_total);

            // 判断如果有部分商品无货，返回提示
//            throw new \Exception('抱歉，您购买的部分商品无货，请重购买');

            // 获取商品购买数量
            $goods_buy_quantity = $this->buy1->getEachGoodsBuyQuantity($shop_cart_list);
//            dd($goods_buy_quantity);
            // 保存数据
            $this->_order_data['shop_goods_total'] = $shop_goods_total;
            $this->_order_data['shop_final_order_total'] = $shop_final_goods_total;
            $this->_order_data['shop_freight_total'] = $shop_freight_total;
            $this->_order_data['shop_cart_list'] = $shop_cart_list;
            $this->_order_data['goods_buy_quantity'] = $goods_buy_quantity;


            // 4. 生成订单
            extract($this->_order_data);

            $user_id = $this->_user_info['user_id'];
            $user_name = $this->_user_info['user_name'];
            $user_email = $this->_user_info['user_email'];

            // 存储生成的订单数据
            $order_list = [];
            // 存储通知信息
            $notice_list = [];

            // 收货人信息

            $sub_order_id = 1; // 子订单id 从1开始自增
            $parent_sn = null; // 默认只有一个订单的情况下，为null
            if (count($shop_cart_list) > 1) {
                // 如果是购物车购买 并且购买商品种类大于1 则生成父订单编号(parent_sn)
                $parent_sn = $this->makeOrderSn();
            }
            foreach ($shop_cart_list as $shop_id => $goods_list) {

                // 初始化数组
                $order_info = [];
                $order_goods = [];

                // 订单信息
                $order = [
                    'order_sn' => $this->makeOrderSn(),
                    'parent_sn' => $parent_sn, // 父订单编号
                    'user_id' => $user_id,
                    'order_status' => 0, // todo 如果是余额支付，并且余额大于待支付订单总金额，则将状态设置为交易成功
                    'shop_id' => $shop_id,
                    'site_id' => 0, // 站点id todo 站点功能做好了再完善
                    'store_id' => 0, // 网点id todo 网点后台做好了再完善
                    'pickup_id' => 0, // 自提点id todo 前面需要获取post过来的店铺自提点信息
                    'shipping_status' => 0,
                    'pay_status' => 0, // 支付状态 todo 如果是余额支付，并且余额大于待支付订单总金额，则将状态设置为已支付
                    'consignee' => $input_address_info['consignee'],
                    'region_code' => $input_address_info['region_code'],
                    'region_name' => get_region_names_by_region_code($input_address_info['region_code']),
                    'address' => $input_address_info['address_detail'],
                    'address_lng' => $input_address_info['address_lng'],
                    'address_lat' => $input_address_info['address_lat'],
                    'receiving_mode' => 0, // 收货方式 默认0 0-普通快递 2-上门自提 todo 前面需要获取post过来的店铺自提点信息
                    'tel' => !empty($input_address_info['tel']) ? $input_address_info['tel'] : $input_address_info['mobile'],
                    'email' => $input_address_info['email'],
                    'postscript' => isset($postscript[$shop_id]) ? $postscript[$shop_id] : null, // 买家留言
                    'best_time' => $send_time, // 最佳送货时间
                    'pay_id' => $balance_enable ? '0' : $this->payment->getPayIdByPayCode($pay_code), // 支付方式id
                    'pay_code' => $balance_enable ? '0' : $pay_code, // 支付方式缩写
                    'pay_name' => $balance_enable ? '余额支付' : format_pay_type($pay_code), // 支付名称
                    'pay_sn' => 0, // 支付单号 暂时不清楚什么时候生成
                    'is_cod' => $pay_code == 'cod' ? 1 : 0, // 是否为货到付款
                    'order_amount' => $shop_final_order_total[$shop_id],
                    'order_points' => 0, // 订单兑换积分 todo 积分商城做好了再完善
                    'money_paid' => 0.00, // 订单支付金额 todo 如果是余额支付，则有值
                    'goods_amount' => $shop_final_goods_total[$shop_id], // 商品总金额 已减去运费
                    'inv_fee' => 0.00, // 发票总费用
                    'shipping_fee' => $shop_freight_total[$shop_id],
                    'case_more' => 0.00, // 货到付款加价
                    'discount_fee' => 0.00, // 活动优惠金额
                    'change_amount' => 0.00, // 订单改价总金额
                    'shipping_change' => 0.00, // 运费改价金额
                    'surplus' => 0.00, // 余额支付
                    'user_surplus' => 0.00, // 可提现余额支付
                    'user_surplus_limit' => 0.00, // 不可提现余额支付
                    'bonus_id' => 0, // 用户全网红包id
                    'shop_bonus_id' => 0, // 用户店铺红包id
                    'bonus' => 0.00, // 全网红包金额
                    'shop_bonus' => 0.00, // 店铺红包金额
                    'store_card_id' => 0, // 店铺储值卡ID
                    'store_card_price' => 0.00, // 店铺储值卡金额
                    'integral' => 0, // 积分数量
                    'integral_money' => 0.00, // 积分金额
                    'give_integral' => 0, // 订单赠送的积分
                    'order_from' => check_order_from(), // 订单来源 默认1 1PC端 2WAP端 ...
                    'add_time' => time(), //
                    'take_time' => 0, //
                    'take_countdown' => 0, // 订单完成倒计时时间
                    'pay_time' => 0, // 支付时间
                    'shipping_time' => 0, // 订单配送时间
                    'confirm_time' => 0, // 确认收货截止时间
                    'delay_days' => 0, // 延迟收货天数
                    'order_type' => 0, // 交易类型 0-普通商品 1-拍卖 2-预售 3-团购 5-积分兑换 6-拼团 8-砍价 10-搭配套餐 11-限时折扣 12-满减送 13-赠品活动 99-电子秤商品
                    'buyer_type' => 0, // todo 买家类型 0-个人 1-店铺
                    'is_distrib' => 0, // 是否为分销商品
                    'distrib_status' => 0, // 分销订单状态
                    'is_show' => '1,2,3,4', // todo 暂时不清楚是什么意思
                    'order_data' => null, // 订单活动数据 序列化存储
                    'cash_user_id' => 0, //
                    'sub_order_id' => $sub_order_id, // 子订单id
                    'buy_type' => $buy_type, // 购买类型
                    'reachbuy_code' => '0', // 自由购下单码号码
                    'growth_value' => '0', // 会员等级成长值
                    'pickup_name' => null, // 自提点名称 todo 前面需要获取post过来的店铺自提点信息
                    'shop_name' => $goods_list[0]['shop_name'], //
                    'shop_type' => $goods_list[0]['shop_type'], // 店铺类型
                    'customer_tool' => $goods_list[0]['customer_tool'], // 客服工具
                    'customer_account' => $goods_list[0]['customer_account'], // 客服账号
                ];
                $order_ret = $this->orderInfo->store($order);
                if (empty($order_ret)) {
                    throw new \Exception('订单保存失败[未生成订单数据]');
                }
                $order_id = $order_ret->order_id;
                $order_list[$order_id] = $order;

                // 生成订单商品数据
                $i = 0;
                foreach ($goods_list as $goods_info) {
                    // 判断商品上架状态及库存状态
                    if ($goods_info['goods_status'] != 1 || $goods_info['storage_state']) {
                        throw new \Exception('抱歉，部分商品存在下架、变更销售方式或库存不足的情况，请重新选择');
                    }
                    $goods_contract_ids = explode(',', $goods_info['contract_ids']);
                    $goods_contract = Contract::whereIn('contract_id', $goods_contract_ids)
                        ->select(['contract_id','contract_name','contract_image','contract_desc'])
                        ->get()->toArray();

                    // todo 商品活动扩展信息
                    // "{\"full_cut_amount\":0,\"gift\":0,\"point\":0,\"bonus\":0}"
                    $ext_info = [
                        'full_cut_amount' => 0,
                        'gift' => 0,
                        'point' => 0,
                        'bonus' => 0
                    ]; //
                    // todo 判断是否是组合购买
                    $is_goods_mix = false; // 根据活动类型获取
                    if (!$is_goods_mix) {
                        // 不是搭配套餐
                        $order_goods[$i] = [
                            'order_id'=> $order_id,
                            'goods_id' => $goods_info['goods_id'],
                            'sku_id' => $goods_info['sku_id'],
                            'spec_info' => $goods_info['spec_info'],
                            'goods_name' => $goods_info['goods_name'],
                            'goods_sn' => $goods_info['goods_sn'],
                            'sku_sn' => $goods_info['sku_sn'],
                            'goods_image' => $goods_info['goods_image'],
                            'goods_price' => $goods_info['goods_price'],
                            'goods_points' => 0,
                            'distrib_price' => 0.00,
                            'goods_number' => $goods_info['number'], // 购买数量
                            'other_price' => 0.00,
                            'pay_change' => 0.00,
                            'parent_id' => 0,
                            'is_gift' => 0,
                            'give_integral' => 0,
                            'stock_mode' => $goods_info['stock_mode'], // 库存计数
                            'stock_dropped' => 0, // 库存是否已减
                            'act_type' => 0, // 活动类型 默认0 0无活动 1-拍卖 2-预售 3-团购 5-积分兑换 6-拼团 8-砍价 10-搭配套餐 11-限时折扣 12-满减送 13-赠品活动
                            'goods_type' => 0, // 商品交易类型 0-普通商品 1-拍卖 2-预售 3-团购 5-积分兑换 6-拼团 8-砍价 10-搭配套餐 11-限时折扣 12-满减送 13-赠品活动 99-电子秤商品
                            'is_distrib' => 0,
                            'discount' => 0.00,
                            'profits' => 0.00,
                            'distrib_money' => 0.00,
                            'goods_contracts' => json_encode($goods_contract), // json_encode 的保障服务信息
                            'ext_info' => json_encode($ext_info),// 订单商品活动扩展信息
                            'goods_mode' => $goods_info['goods_mode'], // 商品类别 默认0 0实物商品（物流发货） 1电子卡券（无需物流） 2服务商品（无需物流）

//                            'shop_id' => $goods_info['shop_id'],
//                            'contract_ids' => $goods_info['contract_ids'],//implode(',', $goods_info['contract_ids']), // 保障服务ids 多个以逗号分隔 如：1,2
//                            'market_price' => $goods_info['market_price'],
//                            'sku_image' => $goods_info['sku_image'],
                        ];
                    } else {
                        // 搭配套餐

                    }

                }

                $order_goods_ret = $this->orderGoods->addAll($order_goods);
                if (!$order_goods_ret) {
                    throw new \Exception('订单保存失败[未生成商品数据]');
                }

                // 存储商家发货提醒数据

                $sub_order_id++;

                $result_order_sn = $order['order_sn'];
            }

            if (count($shop_cart_list) > 1) {
                // 如果是购物车购买 并且购买商品种类大于1
                $result_order_sn = $parent_sn;
            }


            // 5. 余额支付

            // 6. 订单后续其它处理
            // todo 通过使用 laravel 的queue队列进行变更库存和销量等数据
            OrderUpdate::dispatch($goods_buy_quantity);

//            $queueResult = Queue::push('createOrderUpdateStorage', $goods_buy_quantity);
//            dd($queueResult);
//            if ($queueResult['code'] != 0) {
//                throw new \Exception('订单保存失败[变更库存销量失败]');
//            }

            // 门店自提订单减存

            // 更新使用的平台红包状态

            // 删除购物车中的商品

            // 保存订单自提点信息

            // 发送提醒类信息
            if (!empty($notice_list)) {
                // todo
            }

            // 到此整个流程完成 end

            DB::commit(); // 事务提交

            $this->_order_data['order_sn'] = $result_order_sn;

            return arr_result(0, $this->_order_data);
        } catch (\Exception $e) {
            DB::rollback();//事务回滚
//            echo $e->getMessage();
//            echo $e->getCode();
            return arr_result(-1, null, $e->getMessage());
        }


    }

}