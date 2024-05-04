<?php

// +----------------------------------------------------------------------
// | laravelvip 乐融沃B2B2C商城系统
// +----------------------------------------------------------------------
// | Copyright (c) 2017-2027 http://www.laravelvip.com All rights reserved.
// +----------------------------------------------------------------------
// | Notice: This code is not open source, it is strictly prohibited
// |         to distribute the copy, otherwise it will pursue its
// |         legal responsibility.
// +----------------------------------------------------------------------
// | 版权所有 2015-2027 云南乐融沃网络科技有限公司，并保留所有权利。
// | 网站地址: http://www.laravelvip.com
// +----------------------------------------------------------------------
// | 这不是一个自由软件！禁止拷贝本软件副本，否则将追究其法律责任！
// | 如需使用，请移步官网购买正版授权。
// +----------------------------------------------------------------------
// | Author: 雲溪荏苒 <290648237@qq.com>
// | Date:2019-6-22
// | Description: 购物逻辑
// +----------------------------------------------------------------------

namespace App\Repositories;



use App\Jobs\OrderUpdate;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Contract;
use App\Models\Goods;
use App\Models\OrderInfo;
use App\Models\OrderPay;
use App\Models\Shop;
use App\Models\User;
use App\Models\UserAddress;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class CheckoutRepository
{
    use BaseRepository;

    protected $goods;
    protected $goodsSku;
    protected $shop;
    protected $customer;
    protected $buy1;
    protected $userAddress;
    protected $payment;
    protected $orderInfo;
    protected $orderGoods;
    protected $orderInfoLogic;

    public function __construct()
    {

        $this->goods = new GoodsRepository();
        $this->goodsSku = new GoodsSkuRepository();
        $this->shop = new ShopRepository();
        $this->customer = new CustomerRepository();
        $this->buy1 = new Buy1Repository();
        $this->userAddress = new UserAddressRepository();
        $this->payment = new PaymentRepository();
        $this->orderInfo = new OrderInfoRepository();
        $this->orderGoods = new OrderGoodsRepository();
        $this->orderInfoLogic = new OrderInfoLogicRepository();
    }

    /**
     * 得到购买商品的id、sku_id、number数组数据
     * @param array $cart_id 购买商品信息数组
     * @return array
     */
    private function _parseItems($cart_id)
    {

        $buyItems = [];
        if (is_array($cart_id)) {
            foreach ($cart_id as $shop_id=>$v) {
                foreach ($v as $item) {
                    if (preg_match_all('/^(\d{1,10})\|(\d{1,10})\|(\d{1,6})$/', $item, $match)) {
                        if (intval($match[3][0]) > 0) { // 购买数量大于0
                            $buyItems[$shop_id][] = [
                                'cart_id' => $match[1][0],
                                'sku_id' => $match[2][0],
                                'number' => $match[3][0],
                            ];
                        }
                    }
                }

            }
        }

        return $buyItems;
    }

    /**
     * 获取最佳送货时间文字描述
     *
     * @param int $sendTimeId 送货时间Id
     * @return mixed|null
     */
    public function getBestTime($sendTimeId = -1)
    {
        $sendTime = explode(',', sysconf('send_time')); // 送货时间
        $data = [];
        foreach ($sendTime as $k => $v) {
            $item = str_replace(
                [1, 2, 3, 4, 5],
                ['立即配送', '工作日/周末/假日均可', '仅周末送货', '仅工作日送货', '指定送货时间'],
                $v
            );
            if ($k == $sendTimeId) {
                return $item;
            }
            $data[] = $item;
        }
        return $data;
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
     * 获取直接购买店铺及商品数据
     * todo 该方法已废弃
     *
     * @param $user_id
     * @param $buyItems
     * @return mixed
     */
    public function getQuickBuyShopGoods($user_id, $buyItems)
    {
        $buy_item = array_first($buyItems);

        $goods_id = $buy_item['cart_id'];
        $sku_id = $buy_item['sku_id'];
        $goods_number = $buy_item['number']; // 购买数量
        $goods_info = $this->goods->getOnSaleGoodsInfo($goods_id, $sku_id, $goods_number);
        $sku_info = $this->goodsSku->getById($sku_id);

        // 店铺信息
        $shop_info = $this->shop->getShopInfo($goods_info['shop_id']);
//        dd($shop_info);
//        $shop_info->customer = $this->customer->getCustomerMain($goods_info['shop_id']);
//        $shop_info->aliim_enable = shopconf('aliim_enable', '', $goods_info['shop_id']); // 店铺是否开启阿里云旺客服
//        $shop_info->system_aliim_enable = sysconf('aliim_enable'); // 平台是否开启阿里云旺客服
        // 店铺自提点列表
//        $pickup_list = $shop_info['pickup_list'];
//        $shop_info->delivery_enable = !empty($pickup_list) ? 1 : 0;
//        $shop_info->pickup_list = $pickup_list;

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
            'integral' => 0,
            'integral_amount' => 0,
            'inv_fee' => 0,
            'is_cash' => 1,
            'cash_more' => "2",
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
            'full_cut_bonus' => [],
            'full_cut_point' => 0,
            'discount_fee' => 0,
            'pre_sale_mode' => null,
            'other_shipping_fee_amount' => 0,
            'packing_fee' => 0,
            'cs_delivery_fee' => 0,
            'other_shipping_fee' => [],
            'other_shipping_fee_amount_format' => '￥0',
            'packing_fee_format' => '￥0',
            'shop_bonus_amount_format' => '￥0',
            'shipping_fee_format' => '￥1',
            'order_amount_format' => '￥' . $order_amount,
            'bonus_amount_format' => '￥0',
            'cash_more_format' => '￥2',
            'full_cut_amount_format' => '￥0',
            'cs_delivery_fee_format' => '￥0',
            'shop_id' => $goods_info['shop_id'],
            'shop_store_card_amount_format' => '￥0',
        ];

        $data[$goods_info['shop_id']] = [
            'select' => 0,
            'add_time' => time(),
            'add_time_format' => format_time(time(), 'Y-m-d H:i:s'),
            'shop_info' => $shop_info,
            'bonus_list' => [], // todo
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
                    'store_id' => 0,
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
                    'user_discount' => $goods_info['user_discount'],
                    'sales_model' => $goods_info['sales_model'],
                    'is_virtual' => $goods_info['is_virtual'],
                    'goods_mode' => $goods_info['goods_mode'],
                    'ext_info' => $goods_info['ext_info'],

                    // 店铺信息
                    'shop_status' => $shop_info['shop_status'],
                    'is_cross_border' => '0',
                    'goods_min_number' => 1,
                    'goods_max_number' => $goods_info['goods_number'],
                    'select' => 0,
                    'cart_act_id' => $goods_info['act_id'],
                    'activity' => null,
                    'order_activity' => null, // todo
                    'act_type' => null, // todo
                    'prices' => [
                        'is_original_price'=>true,
                        'price_type' => 'original_price',
                        'original_price' => $sku_info->original_price,
                        'activity_price' => false,
                        'member_price' => false,
                        'goods_price' => $sku_info->goods_price,
                        'activity_enable' => '0.00',
                    ],
                    'goods_price_format' => '￥' . $sku_info->goods_price,
                    'market_price_format' => '￥' . $sku_info->market_price,
                    'original_price_format' => '￥' . $sku_info->original_price,
                    'add_time_format' => format_time(time(), 'Y-m-d H:i:s'),
                    'goods_amount' => $sku_info->goods_price * $goods_number,
                    'goods_amount_format' => '￥' . $sku_info->goods_price * $goods_number,
                    'cart_disable' => 0,
                    'contract_list' => [],
                    'gift_list' => [],
                    'reduce_cash' => 0,
                    'discount_fee' => 0,
                    'shop_bonus_amount' => 0,
                    'other_price' => 0
                ]
            ],
            'shipping_list' => $shipping_list,
            'limit_goods' => [],
            'limit_goods_ids' => [],
            'order' => $order,
            'store_card_list' => [],
        ];

        return $data;
    }

    /**
     * 获取直接购买/购物车购买 店铺及商品数据
     *
     * @param $buyType
     * @param $user
     * @param $buyItems
     * @return array
     */
    public function getBuyShopGoods($buyType, $user, $buyItems)
    {
        // 买家类型 0-普通买家 1-商家买家
        $buyerType = $user->shop_id > 0 ? 1 : 0;

        $data = [];
        foreach ($buyItems as $shopId=>$buyItem) {
            // 店铺信息
            $shop_info = $this->shop->getShopInfo($shopId);

            // 计算店铺商品运费
            $shipping_fee = 0.00; // todo 需要计算

            // 配送方式
            $shipping_list = $this->getShippingList($shipping_fee);

            // 订单商品
            $goodsList = [];
            // 商品总数量
            $goods_number = 0;
            // 商品总金额 商品单价*购买数量
            $goods_amount = 0;
            // 运费 + 其他优惠 - 其他优惠
            $shipping_fee = 0;
            // 其他优惠 如：满减、等活动
//            $act_cut = 0;
            $give_integral = 0;

            foreach ($buyItem as $item) {

//                dd($buyItem);
                $goods_id = $item['cart_id'];
                if ($buyType == 0) {
                    // 购物车购买
                    $goods_id = Cart::where('cart_id', $item['cart_id'])->value('goods_id');
                }
                $sku_id = $item['sku_id'];
//                $goods_number = $item['number']; // 购买数量
                $goods_info = $this->goods->getOnSaleGoodsInfo($goods_id, $sku_id,  $item['number']);
                $sku_info = $this->goodsSku->getById($sku_id);

                $goodsList[] = [
                    'user_id' => $user->user_id,
                    'session_id' => 0,
                    'goods_id' => $goods_id,
                    'sku_id' => $sku_id,
                    'goods_name' => $goods_info['goods_name'],
                    'goods_number' =>  $item['number'],
                    'goods_price' => $goods_info['goods_price'],
                    'goods_type' => 0,
                    'parent_id' => 0,
                    'is_gift' => 0,
                    'add_time' => time(),
                    'buyer_type' => $buyerType, // 买家类型 0-普通买家 1-商家买家
                    'buy_type' => 1, // 购买类型 1-直接购买

                    'shop_id' => $goods_info['shop_id'],
                    'store_id' => 0,
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
                    'user_discount' => $goods_info['user_discount'],
                    'sales_model' => $goods_info['sales_model'],
                    'is_virtual' => $goods_info['is_virtual'],
                    'goods_mode' => $goods_info['goods_mode'],
                    'ext_info' => $goods_info['ext_info'],

                    // 店铺信息
                    'shop_status' => $shop_info['shop_status'],
                    'is_cross_border' => '0',
                    'goods_min_number' => 1,
                    'goods_max_number' => $goods_info['goods_number'],
                    'select' => 0,
                    'cart_act_id' => $goods_info['act_id'],
                    'activity' => null,
                    'order_activity' => null, // todo
                    'act_type' => null, // todo
                    'prices' => [
                        'is_original_price'=>true,
                        'price_type' => 'original_price',
                        'original_price' => $sku_info->original_price,
                        'activity_price' => false,
                        'member_price' => false,
                        'goods_price' => $sku_info->goods_price,
                        'activity_enable' => '0.00',
                    ],
                    'goods_price_format' => '￥' . $sku_info->goods_price,
                    'market_price_format' => '￥' . $sku_info->market_price,
                    'original_price_format' => '￥' . $sku_info->original_price,
                    'add_time_format' => format_time(time(), 'Y-m-d H:i:s'),
                    'goods_amount' => $sku_info->goods_price * $item['number'],
                    'goods_amount_format' => '￥' . $sku_info->goods_price * $item['number'],
                    'cart_disable' => 0,
                    'contract_list' => [],
                    'gift_list' => [],
                    'reduce_cash' => 0,
                    'discount_fee' => 0,
                    'shop_bonus_amount' => 0,
                    'other_price' => 0
                ];

                // 商品总数量
                $goods_number += $item['number'];

                // 商品总金额 商品单价*购买数量
                $goods_amount += ($sku_info->goods_price *  $item['number']);

                // 计算店铺商品运费
                $goods_shipping_fee = 0;
                // 运费
                $shipping_fee += $goods_shipping_fee;

                // todo 此处不做运费及优惠计算处理
//                $goods_act_cut = 0;
                // 其他优惠 如：满减、等活动
//                $act_cut += $goods_act_cut;

                // give_integral
                $give_integral += $goods_info['give_integral'];
            }



            // 订单总金额 商品总金额
            // todo 此处不做运费及优惠计算处理
            $order_amount = $goods_amount; //  + $shipping_fee;
            /*$order = [
                'goods_number' => $goods_number,
                'pay_code' => 'weixin',
                'order_amount' => $order_amount,
                'goods_amount' => $goods_amount,
                'shipping_fee' => $shipping_fee,
                'balance' => 0,
                'integral' => 0,
                'integral_amount' => 0,
                'inv_fee' => 0,
                'money_pay' => $order_amount, // todo
                'is_cash' => 1,
                'cash_more' => 0,
                'bonus_id' => 0,
                'bonus_amount' => 0,
                'shop_bonus_amount' => 0,
                'buyer_type' => $buyerType,
                'shop_store_card_amount' => 0,
                'full_cut_amount' => 0,
                'full_cut_bonus' => [],
                'full_cut_point' => 0,
                'order_data' => [],
                // 交易类型 0-普通商品 1-拍卖 2-预售 3-团购 5-积分兑换 6-拼团 8-砍价 10-搭配套餐 11-限时折扣 12-满减送 13-赠品活动 99-电子秤商品
                'order_type' => 0,
                'other_shipping_fee_amount' => 0,
                'packing_fee' => 0,
                'integral_goods_amount' => 0,
                'cs_delivery_fee' => 0,
                'is_cod' => 0,
                'buy_type' => $buyType,
                'card_id' => 0,

                'discount_fee' => 0,
                'pre_sale_mode' => null,
                'other_shipping_fee' => [],
                'other_shipping_fee_amount_format' => '￥0',
                'packing_fee_format' => '￥0',
                'shop_bonus_amount_format' => '￥0',
                'shipping_fee_format' => '￥'.$shipping_fee,
                'order_amount_format' => '￥' . $order_amount,
                'bonus_amount_format' => '￥0',
                'cash_more_format' => '￥0',
                'full_cut_amount_format' => '￥0',
                'cs_delivery_fee_format' => '￥0',
                'shop_id' => $shopId,
                'shop_store_card_amount_format' => '￥0',
            ];*/


            $order = [
                'goods_number' => $goods_number,
                'order_amount' => $order_amount,
                'goods_amount' => $goods_amount,
                'shipping_fee' => $shipping_fee,
                'give_integral' => $give_integral,
                'integral' => 0,
                'integral_amount' => 0,
                'inv_fee' => 0,
                'is_cash' => 1,
                'cash_more' => 0,
                'shop_bonus_id' => 0,
                'shop_bonus_amount' => 0,
                'bonus_amount' => 0,
                // 交易类型 0-普通商品 1-拍卖 2-预售 3-团购 5-积分兑换 6-拼团 8-砍价 10-搭配套餐 11-限时折扣 12-满减送 13-赠品活动 99-电子秤商品
                'order_type' => 0,
                'other_amount' => 0,
                'buyer_type' => $buyerType,
                'buy_type' => $buyType,
                'card_id' => 0,
                'shop_store_card_amount' => 0,
                'full_cut_amount' => 0,
                'full_cut_bonus' => [],
                'full_cut_point' => 0,
                'discount_fee' => 0,
                'pre_sale_mode' => null,
                'other_shipping_fee_amount' => 0,
                'packing_fee' => 0,
                'cs_delivery_fee' => 0,
                'other_shipping_fee' => [],
                'other_shipping_fee_amount_format' => '￥0',
                'packing_fee_format' => '￥0',
                'shop_bonus_amount_format' => '￥0',
                'shipping_fee_format' => '￥'.$shipping_fee,
                'order_amount_format' => '￥' . $order_amount,
                'bonus_amount_format' => '￥0',
                'cash_more_format' => '￥0',
                'full_cut_amount_format' => '￥0',
                'cs_delivery_fee_format' => '￥0',
                'shop_id' => $shopId,
                'shop_store_card_amount_format' => '￥0',
            ];

            $data[$shopId] = [
                'select' => 0,
                'add_time' => time(),
                'add_time_format' => format_time(time(), 'Y-m-d H:i:s'),
                'shop_info' => $shop_info,
                'bonus_list' => [], // todo
                'goods_list' => $goodsList,
                'shipping_list' => $shipping_list,
                'limit_goods' => [],
                'limit_goods_ids' => [],
                'order' => $order,
                'store_card_list' => [],
            ];
        }

        return $data;
    }

    /**
     * 设置购买信息
     *
     * @param $user
     * @param array $checkoutData
     * @param int $type
     * @return array
     */
    public function setCheckoutData($user, $checkoutData = [], $type = 0)
    {

        $userId = $user->user_id;

        // 先从缓存中读取购物信息
        $checkout_submit_data = session('checkout_submit_data');

        if (empty($checkout_submit_data)) {
            // 如果购物信息为空 则初始化设置
            if (empty($checkoutData)) {
                // 无购买信息 跳转到购物车页面
                return arr_result(-1, null, '您没有提交任何需要结算的商品');
            }

            // 购买类型 0-加入购物车购买 1-立即购买 2-去结算 3-兑换 4-自由购 5-到店购 6-礼品提货
            $buyType = $checkoutData['buy_type'] ?? null;
            // 购买商品信息 (商品id/购物车id)|sku_id|购买数量 如果是购物车购买 是多个数组
            $cart_id = $checkoutData['cart_id'] ?? null;
            $buyItems = $this->_parseItems($cart_id);

//            dd($buyItems);
            if (empty($buyItems)) {
                return arr_result(-1, null, '您没有提交任何需要结算的商品');
            }

//            if (count($buyItems) > 50) {
//                return arr_result(-1, null, '一次最多只可购买50种商品');
//            }
            // 拼装数据
            // 默认收货地址
            $address_id = UserAddress::where([['user_id', $userId]])
                ->select(['address_id'])
                ->orderBy('is_default', 'desc')->value('address_id');
            // 自提点id
            $pickup_ids = [];
            $shop_delivery_enable = [];
            $shipping_ids = [];
            $shop_bonus_ids = [];
            $shop_store_card_ids = [];
            $shop_ids = [];
            $consignee_ids = [];
            foreach ($buyItems as $shop_id=>$buy_item) {

                $pickup_ids[$shop_id] = 0; // 设置默认自提点id为空
                $shop_delivery_enable[$shop_id] = 1; // todo
                $shipping_ids[$shop_id] = null; // todo
                $shop_bonus_ids[$shop_id] = 0; // todo
                $shop_store_card_ids[$shop_id] = 0; // todo
                $shop_ids[] = $shop_id;
                $consignee_ids[$shop_id] = 0; // todo
            }

            // 送货时间
            $send_time_list = $this->getBestTime(); // 送货时间

            // 最佳送货时间
            $best_time = $send_time_list[0];


            /*if ($buyType == 1) {
                // 直接购买
                $sku_id = $checkoutData['sku_id']; // 商品SKU ID
                $number = $checkoutData['number']; // 购买数量

            } elseif ($buyType == 0) {
                // 购物车购买 从购物车表中读取选中的购物车商品信息


            } else {

            }*/

            /*if ($buyType == 0) { // 购物车购买
                $shop_list = [];
            } elseif ($buyType == 1) { // 直接购买
                $shop_list = $this->getQuickBuyShopGoods($userId, $buyItems);
            }*/
            $shop_list = $this->getBuyShopGoods($buyType, $user, $buyItems);
//            dd($shop_list);

            // todo 需计算
//            $user = User::where('user_id', $userId)->first();




            $shop_order_arr = array_column($shop_list, 'order');
            $other_shipping_fee_amount = array_sum(array_column($shop_order_arr, 'other_shipping_fee_amount'));
            // 商品总金额 = 商品总价
            $goods_amount = array_sum(array_column($shop_order_arr, 'goods_amount'));
            $shipping_fee = array_sum(array_column($shop_order_arr, 'shipping_fee')); // 运费
            $give_integral = array_sum(array_column($shop_order_arr, 'give_integral')); //
            $integral = array_sum(array_column($shop_order_arr, 'integral'));
            $integral_amount = array_sum(array_column($shop_order_arr, 'integral_amount')); //
            $inv_fee = array_sum(array_column($shop_order_arr, 'inv_fee')); //
            $cash_more = array_sum(array_column($shop_order_arr, 'cash_more')); // 额外配送费
            $packing_fee = array_sum(array_column($shop_order_arr, 'packing_fee')); // 包装费
            $bonus_amount = array_sum(array_column($shop_order_arr, 'bonus_amount')); // 使用平台红包金额
            $shop_bonus_amount = array_sum(array_column($shop_order_arr, 'shop_bonus_amount')); // 使用店铺红包金额
            $total_bonus_amount = $bonus_amount + $shop_bonus_amount;
            $full_cut_amount = array_sum(array_column($shop_order_arr, 'full_cut_amount')); //
            $discount_fee = array_sum(array_column($shop_order_arr, 'discount_fee')); // 优惠
            $shop_store_card_amount = array_sum(array_column($shop_order_arr, 'shop_store_card_amount')); // 店铺卡金额
//            dd($shop_list);
            // 订单总金额 = 商品总价+运费+额外配送费+包装费-红包-优惠
            $order_amount = $goods_amount + $shipping_fee + $cash_more + $packing_fee
                + $bonus_amount
                - $shop_bonus_amount - $discount_fee;

//            dd($order_amount);
            $user_balance_total = $user->user_money + $user->user_money_limit;

			// todo 关闭余额支付 后期再做余额支付功能
			$balance = 0;
			$balance_enable = false;

            // todo 以下计算有误 后期再做余额支付的详细计算
            if ($balance_enable && ($user_balance_total > 0)) {
                // 开启余额支付 并且余额大于0 余额支付金额不能大于订单总金额

                if ($balance == 0) {
                    // 全部用余额支付 todo 需判断用户剩余余额是否足够支付该订单
                    $balance = $order_amount; // 默认 余额全额支付该订单
                }

                if ($user_balance_total < $order_amount) { // 余额不足以支付该订单 使用全部余额
                    $balance = $user_balance_total;
                }
            }
            $money_pay = $order_amount - $balance; // 支付金额 = 订单总金额-余额支付金额

            // 支付可用积分 = 用户支付积分-用户冻结积分 todo 还有问题 pay_point = '0|0'时
            $pay_point = 0; // $user->pay_point - $user->frozen_point; // todo 暂时注释掉

            // 支付可用积分总金额 = 支付可用积分 / 消费金额送积分 取1位小数
            $pay_point_amount = round($pay_point / sysconf('give_integral_consume'),1);
            $pay_point_amount_format = '￥'.format_price($pay_point_amount);

			$pay_code = 'weixin'; // 默认支付方式：微信支付

            $order = [
//                'pay_code' => 'weixin', // todo 暂时默认用微信支付
                'order_amount' => $order_amount,
                'goods_amount' => $goods_amount,
                'shipping_fee' => $shipping_fee,
                'balance' => $balance, // 余额支付金额
                'integral' => $integral,
                'integral_amount' => $integral_amount,
                'inv_fee' => $inv_fee,
                'money_pay' => $money_pay,
                'is_cash' => true,
                'cash_more' => $cash_more, // 额外配送费
                'bonus_id' => 0,
                'bonus_amount' => $bonus_amount, // 使用平台红包金额
                'shop_bonus_amount' => $shop_bonus_amount, // 使用店铺红包金额
                'buyer_type' => 0,
                'shop_store_card_amount' => $shop_store_card_amount, // 使用店铺卡金额
                'full_cut_amount' => $full_cut_amount, // 满减送
                'full_cut_bonus' => 0,
                'full_cut_point' => 0,
                'order_data' => [],
                'order_type' => 0,
                'other_shipping_fee_amount' => 0,
                'packing_fee' => $packing_fee,
                'integral_goods_amount' => 0,
                'cs_delivery_fee' => 0,
                'is_cod' => 0,
//                'pay_id' => null,
//                'pay_name' => null,
				'pay_id' => $balance_enable ? '0' : $this->payment->getPayIdByPayCode($pay_code), // 支付方式id
				'pay_code' => $balance_enable ? '0' : $pay_code, // 支付方式缩写
				'pay_name' => $balance_enable ? '余额支付' : format_pay_type($pay_code), // 支付名称

                'discount_fee' => $discount_fee, // 优惠
                'give_integral' => $give_integral,
                'total_bonus_amount' => $total_bonus_amount,
                'order_amount_format' => '￥'.$order_amount,
                'goods_amount_format' => '￥'.$goods_amount,
                'shipping_fee_format' => '￥'.$shipping_fee,
                'integral_amount_format' => '￥0',
                'money_pay_format' => '￥'.$money_pay,
                'cash_more_format' => '￥'.$cash_more,
                'shop_bonus_amount_format' => '￥'.$shop_bonus_amount,
                'bonus_amount_format' => '￥'.$bonus_amount,
                'total_bonus_amount_format' => '￥'.$total_bonus_amount,
                'full_cut_amount_format' => '￥'.$full_cut_amount,
                'discount_fee_format' => '￥'.$discount_fee,
                'shop_store_card_amount_format' => '￥'.$shop_store_card_amount,
                'balance_format' => '￥'.$balance,
                'other_shipping_fee_amount_format' => '￥'.$other_shipping_fee_amount,
                'packing_fee_format' => '￥'.$packing_fee,
                'cs_delivery_fee_format' => "￥0",
                'integral_goods_list' => [],
            ];



            // 发票信息
            $invoice_type = '0';
            $invoice_info = $this->buy1->getInvoiceInfo($invoice_type);

            $cart_list = [
                'select_goods_number' => 0,
                'select_goods_amount' => 0,
                'select_goods_amount_format' => '￥0',
                'goods_number' => 1,
                'full_cut_amount' => 0,
                'invalid_cart_ids' => [],
                'goods_amount'=>1,
                'pre_sale_mode' => null,
                'shop_delivery_enable' => $shop_delivery_enable,
                'submit_enable' => 1,
                'shop_list' => $shop_list,
                'invalid_list' => null,
            ];

            $data_extra = [
                'integral_deduction_amount' => 0,
                'integral_deduction' => 0,
                'order' => $order,
                'invoice_type' => $invoice_type,
                'invoice_info' => $invoice_info,
                'user_info' => [
                    /*todo ??? 买家是商家时*/
                    'user_name' => $user->user_name,
                    'mobile' => $user->mobile,
                    'address_now' => $user->address_now,
                    'detail_address' => $user->detail_address,
                    /*买家是商家时*/

                    'pay_point' => $pay_point, //'14|0',
                    'pay_point_amount' => $pay_point_amount, //0.14,
                    'pay_point_amount_format' => $pay_point_amount_format, //'￥0.14',
                    'balance' => $user_balance_total, //'325.08',
                    'online_balance' => $user_balance_total, //325.08,
                    'balance_format' => "￥".format_price($user_balance_total),
                    'balance_password_enable' => !empty($user->surplus_password) ? 1 : 0
                ],
                'cross_border_code' => 0,
                'is_has_cross_border_goods' => 0,
            ];
            $data = array_merge($cart_list, $data_extra);

            $address_list = [];
            $check_address = !empty($address_list) ? 0 : 1; // 是否检查地址 如果是上门自提 则不需要检查地址 如果是普通快递 需要检查地址




            $checkout_submit_data = [
                'O' => 'service\cart\models\CheckoutModel',
                'user_id' => $userId,
                'buy_type' => $buyType,
                'group_sn' => null,
                'bar_id' => 0,
                'address_id' => $address_id,
                'pickup_ids' => $pickup_ids,
                'best_time_id' => 0, // 默认取第一个
                'best_time' => $best_time,
                'invoice'=>null,
                'postscript'=>[], // 买家留言
                'send_time_list'=>$send_time_list,
                'pickup_time_list' => [],
                'pickup_time'=>'',
                'address_list'=>$address_list,
                'region_code' => '13,02,03', // todo 暂时不知道怎么取值
                'position' => [// todo 暂时不知道怎么取值
                    '118.232134',
                    '39.232134',
                ],
                'balance_password' => null,
                'integral_ratio' => sysconf('give_integral_consume'), // 积分兑换比率 100:1 todo
                'key' => $this->setPayKey(), // todo ??? 如何生成
                'data' => $data,
                'cart_list' => $cart_list,
                'cart' => null,
                'invoice_info' => $invoice_info,
                'shipping_ids' => $shipping_ids,
                'shop_bonus_ids' => $shop_bonus_ids,
                'bonus_id' => null,
                'cod_enable' => true,
                'shop_store_card_ids' => $shop_store_card_ids,
                'card_id' => null,
                'surplus_amount' => [],
                'shop_id' => 0,
                'check_address' => $check_address,
                'integral_enable' => 0,
                'shop_ids' => $shop_ids,
                'consignee_ids' => $consignee_ids,
                'cs_delivery_enable' => 0,
                'consignee_house' => null,
                'shipping_type' => null,
                'is_cross_border' => 0,
                'clientRuleCache' => 'cache',
            ];
        } else {
            // 如果不为空 则更新指定信息
            if ($type == 1) {
                // 切换送货时间
                $checkout_submit_data['best_time'] = $checkoutData['best_time'];
                $checkout_submit_data['best_time_id'] = $checkoutData['best_time_id'];
            } elseif ($type == 2) {
                // 切换收货地址
                $checkout_submit_data['address_id'] = $checkoutData['address_id'];
            } elseif ($type == 3) {
                // 修改支付方式
                $order_amount = $checkout_submit_data['data']['order']['order_amount'];
                $user_balance_total = $user->user_money + $user->user_money_limit;

                $balance = $checkoutData['balance'] ?? 0;
                $balance_enable = $checkoutData['balance_enable'] == '1' ? true : false;

                // todo 以下计算有误 后期再做余额支付的详细计算
                if ($balance_enable && ($user_balance_total > 0)) {
                    // 开启余额支付 并且余额大于0 余额支付金额不能大于订单总金额

                    if ($balance == 0) {
                        // 全部用余额支付 todo 需判断用户剩余余额是否足够支付该订单
                        $balance = $order_amount; // 默认 余额全额支付该订单
                    }

                    if ($user_balance_total < $order_amount) { // 余额不足以支付该订单 使用全部余额
                        $balance = $user_balance_total;
                    }
                }
                $money_pay = $order_amount - $balance; // 支付金额 = 订单总金额-余额支付金额

                $checkout_submit_data['data']['order']['money_pay'] = $money_pay;
                $checkout_submit_data['data']['order']['money_pay_format'] = '￥'.$money_pay;
                $checkout_submit_data['integral_enable'] = $checkoutData['integral_enable'];
                $checkout_submit_data['data']['order']['pay_code'] = $checkoutData['data']['order']['pay_code'];
				$checkout_submit_data['data']['order']['balance'] = $balance;
				$checkout_submit_data['data']['order']['balance_enable'] = $balance_enable;
            } elseif ($type == 4) {
                // 修改发票信息
                if (!empty(isset($checkoutData['inv_type']))) {
                    foreach ($checkout_submit_data['invoice_info'] as $k=>&$v) {
                        if ($checkoutData['inv_type'] == $k) {
                            $v['selected'] = 'selected';
                            $v['disabled'] = '';

                            if ($checkoutData['inv_type'] == 0) {
                                // 不开发票

                            } elseif ($checkoutData['inv_type'] == 1) {
                                // 增值税普通发票
                                $contents = $checkoutData;
                                unset($contents['inv_name'], $contents['inv_type']);
                                $v['contents'] = $contents;
                                foreach ($v['content_list'] as $ck=>&$cv) {
                                    $cv['checked'] = '';
                                    if ($contents['inv_content'] == $ck) {
                                        $cv['checked'] = 'checked';
                                    }
                                }
                            } elseif ($checkoutData['inv_type'] == 2) {
                                // 增值税专用发票
                                $contents = $checkoutData;
                                unset($contents['inv_name'], $contents['inv_type'],$contents['_csrf']);
                                $v['contents'] = $contents;
                            }
                            $checkout_submit_data['invoice'] = $v['name']; // todo
                        } else {
                            $v['selected'] = '';
                            $v['disabled'] = 'disabled';
                        }


                    }
                }


            } elseif ($type == 5) {
                // 订单提交 设置买家留言
                $checkout_submit_data['postscript'] = $checkoutData['postscript'];
            }
        }

//        dd($checkout_submit_data['invoice_info']);
//        dd($checkout_submit_data['data']['order']['pay_code']);
        // 最后 将新的数组存入session
        session(['checkout_submit_data'=>$checkout_submit_data]);
    }

    /**
     * 获取购买信息
     *
     * @param string $key
     * @return bool|\Illuminate\Session\SessionManager|\Illuminate\Session\Store|mixed
     */
    public function getCheckoutData($key = '')
    {
        $data = session('checkout_submit_data');

        if (empty($data)) { // 如果为空 则返回购买异常
            return false;
        }

        if (isset($data[$key])) {
            return $data[$key];
        }

        return $data;
    }

    /**
     * 清空购买信息
     *
     */
    public function clearCheckoutData()
    {
        session(['checkout_submit_data'=>null]);
    }

    /**
     * 设置购买支付提交数据
     *
     * @param $key
     * @param $user
     * @param array $paySubmitData
     * @param int $type
     */
    public function setPaySubmitData($key, $user, $paySubmitData = [], $type = 0)
    {

        // 先从缓存中读取购物信息
        $pay_submit_data = session('pay_submit_data_'.$key);
        if (empty($pay_submit_data)) {
            $pay_submit_data = $paySubmitData;
        } else {
            if ($type == 3) {
                // 修改支付方式
                $pay_submit_data['order']['pay_code'] = $paySubmitData['order']['pay_code'];
            }
        }
//        var_export($key);
//        var_export($pay_submit_data);
        session(['pay_submit_data_'.$key => $pay_submit_data]);
    }

    /**
     * 获取购买支付提交数据
     *
     * @param string $key
     * @return bool|\Illuminate\Session\SessionManager|\Illuminate\Session\Store|mixed
     */
    public function getPaySubmitData($key = '')
    {
        $data = session('pay_submit_data_'.$key);

        if (empty($data)) { // 如果为空 则返回异常
            return false;
        }

        return $data;
    }

    /**
     * 清空购买信息
     * @param $key
     */
    public function clearPaySubmitData($key)
    {
        session(['pay_submit_data_'.$key=>null]);
    }

    /****************** 以下是生成订单逻辑代码 ********************/

    /**
     * 提交订单
     *
     * @param $user
     * @return array|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function submitOrder($user)
    {


//        $user_info = session('user');

//        $user = $this->_user_info;
//        $user_id = $user['user_id'];
//        $this->_post_data = $checkoutData;


        DB::beginTransaction(); // 开始事务
        try {
            // 获取购买信息
            $checkoutData = $this->getCheckoutData();

            // 购买类型 0-加入购物车购买 1-立即购买 2-去结算 3-兑换 4-自由购 5-到店购 6-礼品提货
            $buy_type = $checkoutData['buy_type'];
            $integral_enable = $checkoutData['integral_enable'];
            // 是否开启余额支付 0-关闭余额支付 1-开启余额支付
            $balance = $checkoutData['data']['order']['balance'];
            $balance_enable = $balance > 0 ? true : false;
            $pay_code = $checkoutData['data']['order']['pay_code'];
//            $best_time_id = $checkoutData['best_time_id'];
//            $best_time = $checkoutData['best_time'];

            // 1. 订单生成前的表单验证与处理

            if (empty($checkoutData)) {
                // 无购买信息 跳转到购物车页面
                throw new \Exception('您没有提交任何需要结算的商品');
            }

            // 购买商品信息 (商品id/购物车id)|sku_id|购买数量 如果是购物车购买 是多个数组
            /*$cart_id = !empty($userBuy['cart_id']) ? $userBuy['cart_id'] : null;
            $buyItems = $this->_parseItems($cart_id);
            if (empty($buyItems)) {
                throw new \Exception('您没有提交任何需要结算的商品');
            }*/

            if (count($checkoutData['data']['shop_list']) > 50) {
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
            if ($checkoutData['check_address'] && $checkoutData['address_id'] <= 0) {
                throw new \Exception('请选择收货地址');
            } else {
                $input_address_info = $this->userAddress->getUserAddressInfo($checkoutData['user_id'], $checkoutData['address_id']);
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

//            dd($checkoutData);
            // 4. 生成订单
            $shop_list = $checkoutData['data']['shop_list'];
            // 获取商品购买数量
            $goods_buy_quantity = $this->buy1->getEachGoodsBuyQuantity($shop_list);
            // 存储通知信息
            $notice_list = [];

            $sub_order_id = 1; // 子订单id 从1开始自增
            $parent_sn = null; // 默认只有一个订单的情况下，为null
            if (count($shop_list) > 1) { // 多个不同商家的订单
                // 如果是购物车购买 并且购买商品种类大于1 则生成父订单编号(parent_sn)
                $parent_sn = $this->makeOrderSn();
            }
            $order_ids = [];
            foreach ($shop_list as $shop_id => $item) {
//dd($item['shop_info']);
                // 初始化数组
                $order_info = [];
                $order_goods = [];

                // 订单信息
                $order = [
                    'order_sn' => $this->makeOrderSn(),
                    'parent_sn' => $parent_sn, // 父订单编号
                    'user_id' => $checkoutData['user_id'],
                    'order_status' => OS_CONFIRMED,
                    'shop_id' => $shop_id,
                    'site_id' => 0, // 站点id todo 站点功能做好了再完善
                    'store_id' => 0, // 网点id todo 网点后台做好了再完善
                    'pickup_id' => $checkoutData['pickup_ids'][$shop_id], // 自提点id todo 前面需要获取post过来的店铺自提点信息
                    'shipping_status' => SS_UNSHIPPED,
                    'pay_status' => PS_UNPAYED, // 支付状态
                    'consignee' => $input_address_info['consignee'],
                    'region_code' => $input_address_info['region_code'],
                    'region_name' => get_region_names_by_region_code($input_address_info['region_code']),
                    'address' => $input_address_info['address_detail'],
                    'address_lng' => $input_address_info['address_lng'],
                    'address_lat' => $input_address_info['address_lat'],
                    'receiving_mode' => $checkoutData['pickup_ids'][$shop_id] > 0 ? 2 : 0, // 收货方式 默认0 0-普通快递 2-上门自提 todo 前面需要获取post过来的店铺自提点信息
                    'tel' => !empty($input_address_info['tel']) ? $input_address_info['tel'] : $input_address_info['mobile'],
                    'email' => $input_address_info['email'],
                    'postscript' => !empty($checkoutData['postscript'][$shop_id]) ? $checkoutData['postscript'][$shop_id] : null, // 买家留言
                    'best_time' => $checkoutData['best_time'], // 最佳送货时间
                    'pay_id' => $balance_enable ? '0' : $this->payment->getPayIdByPayCode($pay_code), // 支付方式id
                    'pay_code' => $balance_enable ? '0' : $pay_code, // 支付方式缩写
                    'pay_name' => $balance_enable ? '余额支付' : format_pay_type($pay_code), // 支付名称
                    'pay_sn' => 0, // 支付单号 第三方支付平台编号 支付成功回调后更新
                    'is_cod' => $pay_code == 'cod' ? 1 : 0, // 是否为货到付款
                    'order_amount' => $item['order']['order_amount'],
                    'order_points' => 0, // 订单兑换积分 todo 积分商城做好了再完善
                    'money_paid' => $item['order']['order_amount'] - $balance, // todo 订单实际需要支付金额 todo 如果是在线支付，则有值；余额支付支付时，为0.00
                    'goods_amount' => $item['order']['goods_amount'], // 商品总金额 已减去运费
                    'inv_fee' => $item['order']['inv_fee'], // 发票总费用
                    'shipping_fee' => $item['order']['shipping_fee'],
                    'cash_more' => $item['order']['cash_more'], // 货到付款加价
                    'discount_fee' => $item['order']['discount_fee'], // 活动优惠金额
                    'change_amount' => 0.00, // 订单改价总金额
                    'shipping_change' => 0.00, // 运费改价金额
                    'surplus' => $balance, // 余额支付
                    'user_surplus' => $balance, // 可提现余额支付
                    'user_surplus_limit' => 0.00, // 不可提现余额支付
                    'bonus_id' => 0, // 用户全网红包id
                    'shop_bonus_id' => $item['order']['shop_bonus_id'], // 用户店铺红包id
                    'bonus' => $item['order']['bonus_amount'], // 全网红包金额
                    'shop_bonus' => $item['order']['shop_bonus_amount'], // 店铺红包金额
                    'store_card_id' => 0, // 店铺储值卡ID
                    'store_card_price' => $item['order']['shop_store_card_amount'], // 店铺储值卡金额
                    'integral' => $item['order']['integral'], // 积分数量
                    'integral_money' => $item['order']['integral_amount'], // 积分金额
                    'give_integral' => $item['order']['give_integral'], // 订单赠送的积分
                    'order_from' => check_order_from(), // 订单来源 默认1 1PC端 2WAP端 ...
                    'add_time' => time(), //
                    'take_time' => 0, //
                    'take_countdown' => 0, // 订单完成倒计时时间
                    'pay_time' => 0, // 支付时间
                    'shipping_time' => 0, // 订单配送时间
                    'confirm_time' => 0, // 确认收货截止时间
                    'delay_days' => 0, // 延迟收货天数
                    'order_type' => $item['order']['order_type'], // 交易类型 0-普通商品 1-拍卖 2-预售 3-团购 5-积分兑换 6-拼团 8-砍价 10-搭配套餐 11-限时折扣 12-满减送 13-赠品活动 99-电子秤商品
                    'buyer_type' => $item['order']['buyer_type'], // todo 买家类型 0-个人 1-店铺
                    'is_distrib' => 0, // 是否为分销商品
                    'distrib_status' => 0, // 分销订单状态
                    'is_show' => '1,2,3,4', // todo 暂时不清楚是什么意思
                    'order_data' => null, // 订单活动数据 序列化存储 "a:1:{s:8:\"group_sn\";s:1:\"0\";}"
                    'cash_user_id' => 0, //
                    'sub_order_id' => $sub_order_id, // 子订单id
                    'buy_type' => $buy_type, // 购买类型
                    'reachbuy_code' => '0', // 自由购下单码号码
                    'growth_value' => '0', // 会员等级成长值
                    'pickup_name' => null, // 自提点名称 todo 前面需要获取post过来的店铺自提点信息
                    'shop_name' => $item['shop_info']['shop_name'], //
                    'shop_type' => $item['shop_info']['shop_type'], // 店铺类型
                    'customer_tool' => $item['shop_info']['customer']['customer_tool'] ?? null, // 客服工具
                    'customer_account' => $item['shop_info']['customer']['customer_account'] ?? null, // 客服账号
                ];
                $order_ret = $this->orderInfo->store($order);
                if (empty($order_ret)) {
                    throw new \Exception('订单保存失败[未生成订单数据]');
                }
                $order_id = $order_ret->order_id;
//                $order_list[$order_id] = $order;

                // 生成订单商品数据
                $i = 0;
                // 店铺佣金比例
                $shop_rate = Shop::where('shop_id', $shop_id)->value('take_rate');

                foreach ($item['goods_list'] as $goods_info) {
                    // 获取商品分类佣金比例
                    $take_rate = Category::where('cat_id', $goods_info['cat_id'])->select('take_rate')->value('take_rate');

                    // 判断商品上架状态及库存状态
                    if ($goods_info['goods_status'] != 1 || intval($goods_info['sku_number']) < intval($goods_info['goods_number']) ) {
                        throw new \Exception('抱歉，部分商品存在下架、变更销售方式或库存不足的情况，请重新选择');
                    }
                    $goods_contract_ids = !empty($goods_info['contract_ids']) ? explode(',', $goods_info['contract_ids']) : [];
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
                    // todo 判断是否是搭配套餐购买
                    $is_goods_mix = false; // 根据活动类型获取
                    if (!$is_goods_mix) {
                        // 不是搭配套餐
                        $order_goods[] = [
                            'order_id'=> $order_id,
                            'goods_id' => $goods_info['goods_id'],
                            'sku_id' => $goods_info['sku_id'],
                            'spec_info' => !empty($goods_info['spec_names']) ? implode(' ',$goods_info['spec_names']) : null, //产地:法国 净含量:100g
                            'goods_name' => $goods_info['goods_name'],
                            'goods_sn' => $goods_info['goods_sn'],
                            'sku_sn' => $goods_info['sku_sn'],
                            'goods_image' => $goods_info['goods_image'],
                            'goods_price' => $goods_info['goods_price'],
                            'goods_points' => 0,
                            'distrib_price' => 0.00,
                            'goods_number' => $goods_info['goods_number'], // 购买数量
                            'other_price' => $goods_info['other_price'],
                            'pay_change' => 0.00,
                            'parent_id' => $goods_info['parent_id'],
                            'is_gift' => $goods_info['is_gift'],
                            'give_integral' => $goods_info['give_integral'],
                            'stock_mode' => $goods_info['stock_mode'], // 库存计数
                            'stock_dropped' => 0, // 库存是否已减
                            'act_type' => $goods_info['act_type'], // 活动类型 默认0 0无活动 1-拍卖 2-预售 3-团购 5-积分兑换 6-拼团 8-砍价 10-搭配套餐 11-限时折扣 12-满减送 13-赠品活动
                            'goods_type' => $goods_info['goods_type'], // 商品交易类型 0-普通商品 1-拍卖 2-预售 3-团购 5-积分兑换 6-拼团 8-砍价 10-搭配套餐 11-限时折扣 12-满减送 13-赠品活动 99-电子秤商品
                            'is_distrib' => 0,
                            'discount' => $goods_info['discount_fee'],
                            'profits' => 0.00,
                            'distrib_money' => 0.00,
                            'goods_contracts' => json_encode($goods_contract), // json_encode 的保障服务信息
                            'ext_info' => json_encode($ext_info),// 订单商品活动扩展信息
                            'goods_mode' => $goods_info['goods_mode'], // 商品类别 默认0 0实物商品（物流发货） 1电子卡券（无需物流） 2服务商品（无需物流）
                            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
//                            'shop_id' => $goods_info['shop_id'],
//                            'contract_ids' => $goods_info['contract_ids'],//implode(',', $goods_info['contract_ids']), // 保障服务ids 多个以逗号分隔 如：1,2
//                            'market_price' => $goods_info['market_price'],
//                            'sku_image' => $goods_info['sku_image'],
                            'take_rate' => $take_rate, // 商品分类佣金比例
                            'shop_rate' => $shop_rate, // 店铺佣金比例
                        ];
                    } else {
                        // 搭配套餐

                    }


                    //商品库存预警提醒
                    $warn_number = Goods::where('goods_id', $goods_info['goods_id'])->select(['warn_number'])->value('warn_number');
                    if ($warn_number >= ($goods_info['sku_number'] - $goods_info['goods_number'])) {
                        $param = [];
                        $param['goods_id'] = $goods_info['goods_id'];
                        $param['sku_id'] = $goods_info['sku_id'];
                        $notice_list['goods_inventory_warning_remind'][$goods_info['shop_id']] = $param;
                    }

                }
                $order_goods_ret = $this->orderGoods->addAll($order_goods);
                if (!$order_goods_ret) {
                    throw new \Exception('订单保存失败[未生成商品数据]');
                }

                // 存储商家发货提醒数据

                /* 插入支付日志 */
                $this->insertOrderPay($order_id, $order['user_id'], $order['order_amount'], PAY_ORDER);

                // 记录订单操作日志
                $this->orderInfoLogic->orderAction($order['order_sn'], $order['order_status'], $order['shipping_status'], $order['pay_status'], '操作主订单支付', '买家');

                $sub_order_id++;

                $result_order_sn = $order['order_sn'];
                $order_ids[] = $order_id;
            }

            if (count($shop_list) > 1) {
                // 如果是购物车购买 并且购买商品种类大于1
                $result_order_sn = $parent_sn;
            }

            // 5. 余额支付

            // 6. 订单后续其它处理
            // todo 通过使用 laravel 的queue队列进行变更库存和销量等数据
            $dispatchRet = OrderUpdate::dispatch($goods_buy_quantity);
//                dd($dispatchRet);
            if ($dispatchRet === false) {
                throw new \Exception('变更商品库存和销量失败');
            }

            // 门店自提订单减存

            // 更新使用的平台红包状态

            // 删除购物车中的商品

            // 保存支付信息
            $this->setPaymentData($checkoutData['key'], $user, implode(',', $order_ids));


            // 删除 checkout_submit_data 缓存
            $this->clearCheckoutData();

            // 保存订单自提点信息

            // 发送提醒类信息
            if (!empty($notice_list)) {
                foreach ($notice_list as $code => $value) { // todo 后期封装消息发送类（站内信、短信、邮箱、微信）
//                $_queue->push('sendStoreMsg', array('code' => $code, 'store_id' => key($value), 'param' => current($value)));
//                    $_queue->sendStoreMsg(array('code' => $code, 'store_id' => key($value), 'param' => current($value)));
                }
            }

            // 到此整个流程完成 end

            DB::commit(); // 事务提交


            $result_data = [
                'order_sn' =>$result_order_sn
            ];
//                dd($result_data);
            return arr_result(0, $result_data);
        } catch (\Exception $e) {
            DB::rollback();//事务回滚
//            echo $e->getMessage();
//            echo $e->getCode();
            return arr_result(-1, null, $e->getMessage());
        }


    }

    /**
     * 将支付LOG插入数据表
     *
     * @access  public
     * @param integer $order_id 订单编号
     * @param integer $user_id 用户id
     * @param float $amount 订单金额
     * @param integer $type 支付类型
     * @param integer $is_paid 支付状态
     *
     * @return  int
     */
    public function insertOrderPay($order_id, $user_id, $amount, $type = PAY_SURPLUS, $is_paid = 0)
    {
        if ($order_id) {
            $order_pay = [
                'pay_no' => $this->makeOrderSn(), // 支付编号
                'order_id' => $order_id,
                'user_id' => $user_id,
                'order_amount' => $amount,
                'order_type' => $type,
                'is_paid' => $is_paid
            ];

            $log_id = OrderPay::insertGetId($order_pay);
        } else {
            $log_id = 0;
        }

        return $log_id;
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
     * 某创
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
     * 生成并设置 支付结果页及支付页面的随机key
     * @param $str
     * @return string
     */
    public function setPayKey($str = '')
    {
        $key = $str != '' ? md5($str) : md5($this->makeOrderSn());
        session(['pay_key'=>$key]); // 缓存key
        return $key;
    }

    /**
     * 设置订单支付信息缓存
     *
     * @param $key
     * @param $user
     * @param $order_id string|integer 订单id 单个或多个以逗号分隔
     * @return array
     */
    public function setPaymentData($key, $user, $order_id)
    {
        // 订单id数组
        $order_ids_arr = explode(',', $order_id);
        if (count($order_ids_arr) > 1) {
            // todo 多个订单合并支付
            $order_list = OrderInfo::whereIn('order_id', $order_ids_arr)->where([['order_status',OS_CONFIRMED],['pay_status',PS_UNPAYED]])->get()->toArray();
            if (empty($order_list)) {
                abort(200, '订单不存在或者状态已改变');
            }

            $parentSn = array_unique(array_column($order_list, 'parent_sn'));
            if (count($parentSn) > 1
                || empty($parentSn[0]) && count($order_list) > 1) {
                // 合并支付 多个不同parent_sn或者（一个有parent_sn和一个无parent_sn）
                foreach ($order_list as &$item) {
                    $item['add_time_format'] = format_time($item['add_time']);
                    $item['money_paid_format'] = '￥'.$item['money_paid'];
                }
                // 重新生成订单编号
                $order_sn = 'MP'.$this->makeOrderSn();
            } else {
                // 合并支付 多个相同parent_sn
                $order_sn = $parentSn[0];
                $order_list = null;
            }

            $order_amount = array_sum(array_column($order_list, 'order_amount'));
            $money_pay = array_sum(array_column($order_list, 'money_paid'));
            $pay_code = array_first($order_list)['pay_code']; // 默认取第0个
            $region_code = array_first($order_list)['region_code']; // 默认取第0个
            $consignee = array_first($order_list)['consignee']; // 默认取第0个
            $address = array_first($order_list)['address']; // 默认取第0个
            $tel = array_first($order_list)['tel']; // 默认取第0个
            $best_time = array_first($order_list)['best_time']; // 默认取第0个
            $order_type = array_first($order_list)['order_type']; // 默认取第0个
            $buy_type = array_first($order_list)['buy_type']; // 默认取第0个
            $order_data = array_first($order_list)['order_data']; // 默认取第0个

            $merge_pay = true;
            $is_virtual = false;

            $user_id = array_first($order_list)['user_id'];
        } else {
            // 单个订单支付
            $condition = [
                ['order_id', $order_id],
            ];
            $info = $this->orderInfo->getOrderInfo($condition);
            if (empty($info)) {
                abort(200, '订单不存在或者状态已改变');
            }
            $order_amount = $info['order_amount'];
            $money_pay = $info['money_paid'];
            $pay_code = $info['pay_code'];
            $region_code = $info['region_code'];
            $consignee = $info['consignee'];
            $address = $info['address'];
            $tel = $info['tel'];
            $best_time = $info['best_time'];
            $order_id = $info['order_id'];
            $order_type = $info['order_type'];
            $buy_type = $info['buy_type'];
            $order_data = $info['order_data'];
            $order_sn = $info['order_sn'];

            $order_list = null;

            $merge_pay = false;
            $is_virtual = false;

            $user_id = $info['user_id'];
        }

        $order = [
            'order_amount' => $order_amount,
            'money_paid' => $money_pay,
            'pay_code' => $pay_code,
            'region_code' => $region_code,
            'consignee' => $consignee,
            'address' => $address,
            'tel' => $tel,
            'best_time' => $best_time,
            'order_id' => $order_id,
            'order_type' => $order_type,
            'buy_type' => $buy_type,
            'order_data' => $order_data,
            'order_sn' => $order_sn,
            'region_names' => get_region_names_by_region_code($region_code)
        ];

        $remark_list = [
            '收货信息：'.$order['consignee'].' '.$order['region_names'].' '.$order['address'].'  '.$order['tel'],
            '送货时间：'.$order['best_time']
        ];

        $pay_list = $this->payment->getPaymentList($order['pay_code']);

        $user_info = [
            'user_name' => $user->user_name,
            'mobile' => $user->mobile,
            'address_now' => $user->address_now,
            'detail_address' => $user->detail_address,
            'pay_point' => 0,//556, // todo
            'pay_point_amount' => 0.00,//5.87, // todo
            'pay_point_amount_format' => '￥0.00', //'￥5.87', // todo
            'balance' => 0, //todo
            'online_balance' => 0,
            'balance_format' => '￥0',
            'balance_password_enable' => 0,
        ];

        $steps = $this->orderInfo->getPaySteps([1,2,3]);

        $balance_enable = '0';
        $balance_first = '0';
        $topay_enable = true;

        // 设置 pay_submit_data_key值
        $paySubmitData = [
            'order_id' => $order_id,
            'order_sn' => $order_sn,
            'money_pay' => $money_pay,
            'order' => $order,
            'merge_pay' => $merge_pay
        ];
        $this->setPaySubmitData($key, $user, $paySubmitData);
//        session(['pay_submit_data_'.$key => $paySubmitData]);

        return [$order_sn, $money_pay, $order, $order_list, $remark_list, $pay_list, $user_info, $merge_pay
            ,$is_virtual,$steps,$balance_enable,$balance_first,$topay_enable];
    }

}
