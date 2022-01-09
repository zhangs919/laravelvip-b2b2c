<?php

namespace App\Repositories;



use App\Models\AttrValue;
use App\Models\GoodsSku;
use App\Models\SelfPickup;
use Carbon\Carbon;

class BuyRepository
{
    use BaseRepository;

    protected $goods;
    protected $goodsSku;
    protected $shop;
    protected $customer;

    public function __construct()
    {

        $this->goods = new GoodsRepository();
        $this->goodsSku = new GoodsSkuRepository();
        $this->shop = new ShopRepository();
        $this->customer = new CustomerRepository();
    }

    /**
     * 获取最佳送货时间文字描述
     *
     * @param int $sendTime 送货时间 如:1 表示立即配送
     * @return mixed|null
     */
    public function getBestTime($sendTime)
    {
        if (empty($sendTime)) {
            return null;
        }
        $bestTime = str_replace(
            [1,2,3,4,5],
            ['立即配送','工作日/周末/假日均可','仅周末送货','仅工作日送货',''],
            $sendTime
        );
        return $bestTime;
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
        $sendTime = explode(',',sysconf('send_time')); // 送货时间
        $shippingTime = json_decode(sysconf('shipping_time'),true); // 指定送货时间
        $list = [];
        if (!empty($sendTime)) {
            foreach ($sendTime as $k=>$v) {
                $item = [
                    'value' => $v,
                    'checked' => $k == $checked ? 'checked' : '',
                    'set_time' => false,
                ];
                if (!empty($shippingTime)) {
                    $item['set_time'] = true;
                    $bestTime = [];
                    $timePeriod = [];
                    foreach ($shippingTime['begin_hour'] as $hourKey=>$hour) {
                        $timePeriod[] = $shippingTime['begin_hour'][$hourKey].':'.$shippingTime['begin_minute'][$hourKey].
                            '--'.$shippingTime['end_hour'][$hourKey].':'.$shippingTime['end_minute'][$hourKey];
                    }
                    foreach (range(0, 6) as $weekDay) {
                        if (in_array($weekDay, $shippingTime['week'])) {
                            $date = Carbon::now()->addDays($weekDay);
                            $dateFormat = $date->format('m-d');
                            $week = $date->dayOfWeek;
                            $weekFormat = str_replace(
                                range(0,6),
                                ['周日','周一','周二','周三','周四','周五','周六'],
                                $week
                            );
                            if ($week == 0) {
                                $weekFormat = '今天';
                            }

                            $timeArray = [];
                            foreach ($timePeriod as $timeValue) {
                                $trueTime = strtotime($date->format('Y').'-'.$dateFormat.' '.explode('--',$timeValue)[0]);
                                $use = 1;
                                if ($trueTime < time()) {
                                    $use = 0;
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
     * 获取直接购买店铺及商品数据
     *
     * @param $user_id
     * @param $user_buy
     * @return mixed
     */
    public function getQuickBuyShopGoods($user_id, $user_buy)
    {
        $goods_id = $user_buy['goods_id'];
        $sku_id = $user_buy['sku_id'];
        $goods_number = $user_buy['number']; // 购买数量
        $goods_info = $this->goods->getOnSaleGoodsInfo($goods_id);
        $sku_info = $this->goodsSku->getById($sku_id);

        // 店铺信息
        $shop_info = $this->shop->getShopInfo($goods_info->shop_id);
        $shop_info->customer = $this->customer->getCustomerMain($goods_info->shop_id);
        $shop_info->aliim_enable = shopconf('aliim_enable','',$goods_info->shop_id); // 店铺是否开启阿里云旺客服
        $shop_info->system_aliim_enable = sysconf('aliim_enable'); // 平台是否开启阿里云旺客服
        // 店铺自提点列表
        $pickup_list = SelfPickup::where([['shop_id',$goods_info->shop_id],['is_show',1]])
            ->orderBy('sort','asc')->get()->toArray();
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
            'give_integral' => $goods_info->give_integral,
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
            'shipping_fee_format' => '￥'.$shipping_fee,
            'order_amount_format' => '￥'.$order_amount,
            'bonus_amount_format' => '￥0',
            'cash_more_format' => '￥0',
            'full_cut_amount_format' => '￥0',
            'shop_id' => $goods_info->shop_id,
            'shop_store_card_amount_format' => '￥0',
        ];

        $data[$goods_info->shop_id] = [
            'select' => 0,
            'add_time' => time(),
            'add_time_format' => format_time(time(), 'Y-m-d H:i:s'),
            'shop_info' => $shop_info->toArray(), // 转换成数组
            'bonus_list' => null, // todo
            'goods_list' => [
                'user_id' => $user_id,
                'session_id' => 0,
                'goods_id' => $goods_id,
                'sku_id' => $sku_id,
                'goods_name' => $goods_info->goods_name,
                'goods_number' => $goods_number,
                'goods_price' => $goods_info->goods_price,
                'goods_type' => 0,
                'parent_id' => 0,
                'is_gift' => 0,
                'add_time' => time(),
                'buyer_type' => 0, // 买家类型 0-普通买家 1-商家买家
                'buy_type' => 1, // 购买类型 1-直接购买

                'shop_id' => $goods_info->shop_id,
                'cart_id' => null,
                // SKU信息
                'sku_name' => $sku_info->sku_name,
                'sku_image' => $sku_info->sku_image,
                'original_price' => $sku_info->goods_price,
                'sku_number' => $sku_info->goods_number,
                'market_price' => $sku_info->market_price,
                'sku_sn' => $sku_info->goods_sn,
                'spec_names' => $sku_info->spec_names,

                // 商品信息
                'cat_id' => $goods_info->cat_id,
                'order_act_id' => $goods_info->order_act_id,
                'brand_id' => $goods_info->brand_id,
                'goods_status' => $goods_info->goods_status == 1 ? true : false,
                'goods_audit' => $goods_info->goods_audit,
                'is_delete' => $goods_info->is_delete,
                'goods_image' => $goods_info->goods_image,
                'goods_images' => $goods_info->goods_images,
                'give_integral' => $goods_info->give_integral,
                'invoice_type' => $goods_info->invoice_type,
                'stock_mode' => $goods_info->stock_mode,
                'spu_number' => $goods_info->goods_number,
                'contract_ids' => $goods_info->contract_ids,
                'goods_sn' => $goods_info->goods_sn,
                'act_id' => $goods_info->act_id,
                'is_virtual' => $goods_info->is_virtual,
                'goods_mode' => $goods_info->goods_mode,
                'ext_info' => $goods_info->ext_info,

                // 店铺信息
                'shop_status' => $shop_info->shop_status,
                'goods_min_number' => 1,
                'goods_max_number' => $goods_info->goods_number,
                'select' => 0,
                'cart_act_id' => $goods_info->act_id,
                'activity' => null,
                'order_activity' => null,
                'goods_price_format' => '￥'.$sku_info->goods_price,
                'market_price_format' => '￥'.$sku_info->market_price,
                'original_price_format' => '￥'.$sku_info->original_price,
                'add_time_format' => format_time(time(), 'Y-m-d H:i:s'),
                'goods_amount' => $sku_info->goods_price * $goods_number,
                'goods_amount_format' => '￥'.$sku_info->goods_price * $goods_number,
                'contract_list' => null,
                'gift_list' => null,
                'discount_fee' => 0,
                'shop_bonus_amount' => 0,
                'other_price' => 0
            ],
            'shipping_list' => $shipping_list,
            'limit_goods' => null,
            'limit_goods_ids' => null,
            'order' => $order,
            'store_card_list' => null,
        ];

        return $data;
    }



    public function getCartInfo($user_id, $user_buy)
    {
        $buy_type = $user_buy['buy_type'];

        if ($buy_type == 1) { // 直接购买
            $goods_number = $user_buy['number']; // 购买数量

            $select_goods_number = 0;
            $select_goods_amount = 0;
            $shop_list = $this->getQuickBuyShopGoods($user_id, $user_buy);
        } else { // 购物车购买
            $goods_number = 0; // 购买数量 todo
            $select_goods_number = 0;
            $select_goods_amount = 0;
            $shop_list = $this->getCartShopGoods($user_id);
        }
        $data = [
            'select_goods_number' => $select_goods_number,
            'select_goods_amount' => $select_goods_amount,
            'select_goods_amount_format' => '￥'.$select_goods_amount,
            'goods_number' => $goods_number,
            'full_cut_amount' => 0,
            'invalid_cart_ids' => null,
            'goods_amount' => 32,
            'pre_sale_mode' => null,
            'select_shop_amount' => [
                '5' => 32,
                '37' => 22.3
            ],
            'shop_delivery_enable' => [
                '5' => 1,
                '37' => 1
            ],
            'submit_enable' => 1,
            'shop_list' => $shop_list,
            'invalid_list' => null,
            'order' => [],
            'invoice_type' => '0',
            'invoice_info' => [],
            'user_info' => [
                'pay_point' => '14|0',
                'pay_point_amount' => 0.14,
                'pay_point_amount_format' => '￥0.14',
                'balance' => '2000',
                'balance_format' => '￥2000',
                'balance_password_enable' => 0
            ],
            'key' => 'c693f1a07c11be160f05ee55afcc351e'
        ];

        $data['select_goods_number'] = 2;

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
                'name' => sysconf('shipping_name').' ',
                'price' => $shipping_fee,
                'price_format' => '￥'.$shipping_fee,
                'selected' => 'selected',
                'is_cash' => 0,
                'cash_more' => 0,
                'limit_goods' => null,
            ],
            [
                'id' => 1,
                'name' => sysconf('self_shipping_name').' ',
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
}