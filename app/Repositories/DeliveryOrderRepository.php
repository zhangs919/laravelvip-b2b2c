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
// | Date:2020-01-02
// | Description: 发货单管理
// +----------------------------------------------------------------------

namespace App\Repositories;


use App\Events\OrderShipped;
use App\Models\DeliveryOrder;
use App\Models\GoodsSku;
use App\Models\OrderGoods;
use App\Models\OrderInfo;
use App\Models\Shipping;
use App\Models\Shop;
use App\Models\ShopAddress;
use App\Models\ShopShipping;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Laravelvip\Kdniao\Kdniao;

class DeliveryOrderRepository
{
    use BaseRepository;

    protected $model;

    protected $userRep;
    protected $shopRep;
    protected $orderInfo;
    protected $deliveryGoods;

    public function __construct(
        DeliveryOrder $model
        , UserRepository $userRep
        , ShopRepository $shopRep
        , OrderInfoRepository $orderInfo
        , DeliveryGoodsRepository $deliveryGoods)
    {
        $this->model = $model;
        $this->userRep = $userRep;
        $this->shopRep = $shopRep;
        $this->orderInfo = $orderInfo;
        $this->deliveryGoods = $deliveryGoods;
    }

    /**
     * 商家后台 发货单列表 格式化输出（json）
     *
     * @param $condition
     * @return array
     */
    public function getDeliveryList($condition)
    {
        list($list, $total) = $this->model->getList($condition);

        $list = $list->toArray();
        if (!empty($list)) {
            foreach ($list as &$item) {

//                dd($item);
                $orderInfo = $item['order_info'];

                // 拼接其他字段
                $user_info = $this->userRep->getById($item['user_id']);

                // 订单信息
                $item['shop_id'] = $item['sender_id'];
                $item['order_sn'] = $orderInfo['order_sn'];
                $item['order_add_time'] = $orderInfo['add_time'];
                $item['order_status'] = $orderInfo['order_status'];
                $item['shipping_status'] = $orderInfo['shipping_status'];
                $item['order_type'] = $orderInfo['order_type'];
                $item['consignee'] = $orderInfo['consignee'];
                $item['postscript'] = $orderInfo['postscript'];
                $item['pay_code'] = $orderInfo['pay_code'];
                $item['user_name'] = $user_info['user_name'];

                $item['delivery_status_format'] = format_delivery_status($item['delivery_status']);
                $item['is_assign'] = ($orderInfo['order_status'] == 1 && $orderInfo['shipping_status'] == 3) ? 1 : 0; // todo 是否已指派订单 1-待发货已指派
                $item['store_id'] = $orderInfo['store_id'];
                $item['store_type'] = 0;
                $item['region_name'] = $orderInfo['region_name'];

                // 用户信息
                $item['user_info'] = $user_info;

                // 发货单商品信息
                $goods_list = [];
                if (!empty($item['delivery_goods'])) {
                    foreach ($item['delivery_goods'] as $goods) {

                        $orderGoods = OrderGoods::where('goods_id', $goods['goods_id'])->first()->toArray();
                        $goodsSku = GoodsSku::where('sku_id', $goods['sku_id'])->first()->toArray();

//                        $orderGoods = $goods['order_goods'];
//                        $goodsSku = $goods['goods_sku'];
//                        $goodsSku = GoodsSku::select(['goods_id','market_price','goods_number'])->find($goods['sku_id']);

                        // 其他字段
                        $goods['is_gift'] = $orderGoods['is_gift'];
                        $goods['parent_id'] = $orderGoods['parent_id'];
                        $goods['spec_info'] = $orderGoods['spec_info'];
                        $goods['goods_name'] = $orderGoods['goods_name'];
                        $goods['goods_sn'] = $orderGoods['goods_sn'];
                        $goods['sku_sn'] = $orderGoods['sku_sn'];
                        $goods['goods_image'] = get_image_url($orderGoods['goods_image']);
                        $goods['goods_price'] = $orderGoods['goods_price'];
                        $goods['goods_points'] = $orderGoods['goods_points'];
                        $goods['distrib_price'] = $orderGoods['distrib_price'];
                        $goods['goods_number'] = $orderGoods['goods_number'];
                        $goods['other_price'] = $orderGoods['other_price'];
                        $goods['pay_change'] = $orderGoods['pay_change'];
                        $goods['is_evaluate'] = $orderGoods['is_evaluate'];
                        $goods['goods_status'] = $orderGoods['goods_status'];
                        $goods['give_integral'] = $orderGoods['give_integral'];
                        $goods['stock_mode'] = $orderGoods['stock_mode'];
                        $goods['stock_dropped'] = $orderGoods['stock_dropped'];
                        $goods['act_type'] = $orderGoods['act_type'];
                        $goods['goods_type'] = $orderGoods['goods_type'];
                        $goods['is_distrib'] = $orderGoods['is_distrib'];
                        $goods['discount'] = $orderGoods['discount'];
                        $goods['profits'] = $orderGoods['profits'];
                        $goods['distrib_money'] = $orderGoods['distrib_money'];
                        $goods['goods_contracts'] = $orderGoods['goods_contracts'];
                        $goods['ext_info'] = $orderGoods['ext_info'];
                        $goods['goods_mode'] = $orderGoods['goods_mode'];

                        // goods_sku
                        $goods['goods_barcode'] = $goodsSku['goods_barcode'];
                        $goods['goods_stockcode'] = $goodsSku['goods_stockcode'];
                        $goods['goods_stock'] = $goodsSku['goods_number']; // 库存
                        $goods['sku_img'] = get_image_url($goodsSku['sku_image']); //
                        $goods['third_id'] = null;
                        $goods['goods_volume'] = $goodsSku['goods_volume']; //
                        $goods['goods_weight'] = $goodsSku['goods_weight']; //
                        $goods['url'] = null; //

                        $goods_list[] = $goods;
                    }
                }
                $item['goods_list'] = $goods_list;

                // 商家信息
                $item['shop_info'] = $this->shopRep->shopInfo($item['sender_id']);
                $item['customer_main'] = $item['shop_info']['customer_main'];
                $item['is_sheet'] = null;

            }
        }

        return [$list, $total];
    }

    /**
     * 商家后台 获取发货单详情
     *
     * @param $condition
     * @return array
     */
    public function getDeliveryInfo($condition)
    {
        $info = DeliveryOrder::where($condition)->with(['orderInfo','deliveryGoods'])->first();
        if (empty($info)) {
            return [];
        }

        $info = $info->toArray();
        $orderInfo = $info['order_info'];

//        dd($info);
        $info['delivery_status_format'] = format_delivery_status($info['delivery_status']);
        $info['region_name'] = get_region_names_by_region_code($info['region_code']);
        $info['is_assign'] = ($orderInfo['order_status'] == 1 && $orderInfo['shipping_status'] == 3) ? 1 : 0; // todo 是否已指派订单 1-待发货已指派
        $info['store_id'] = $orderInfo['store_id'];
        $info['store_type'] = 0;

        // 发货单商品信息
        $goods_list = [];
        if (!empty($info['delivery_goods'])) {
            foreach ($info['delivery_goods'] as $goods) {

//                $orderGoods = $goods['order_goods'];
                $orderGoods = OrderGoods::where('goods_id', $goods['goods_id'])->first()->toArray();
                $goodsSku = GoodsSku::where('sku_id', $goods['sku_id'])->first()->toArray();
//                dd($goodsSku);
//                $goodsSku = $goods['goods_sku'];
//                        $goodsSku = GoodsSku::select(['goods_id','market_price','goods_number'])->find($goods['sku_id']);

                // 其他字段
                $goods['is_gift'] = $orderGoods['is_gift'];
                $goods['parent_id'] = $orderGoods['parent_id'];
                $goods['spec_info'] = $orderGoods['spec_info'];
                $goods['goods_name'] = $orderGoods['goods_name'];
                $goods['goods_sn'] = $orderGoods['goods_sn'];
                $goods['sku_sn'] = $orderGoods['sku_sn'];
                $goods['goods_image'] = get_image_url($orderGoods['goods_image']);
                $goods['goods_price'] = $orderGoods['goods_price'];
                $goods['goods_points'] = $orderGoods['goods_points'];
                $goods['distrib_price'] = $orderGoods['distrib_price'];
                $goods['goods_number'] = $orderGoods['goods_number'];
                $goods['other_price'] = $orderGoods['other_price'];
                $goods['pay_change'] = $orderGoods['pay_change'];
                $goods['is_evaluate'] = $orderGoods['is_evaluate'];
                $goods['goods_status'] = $orderGoods['goods_status'];
                $goods['give_integral'] = $orderGoods['give_integral'];
                $goods['stock_mode'] = $orderGoods['stock_mode'];
                $goods['stock_dropped'] = $orderGoods['stock_dropped'];
                $goods['act_type'] = $orderGoods['act_type'];
                $goods['goods_type'] = $orderGoods['goods_type'];
                $goods['is_distrib'] = $orderGoods['is_distrib'];
                $goods['discount'] = $orderGoods['discount'];
                $goods['profits'] = $orderGoods['profits'];
                $goods['distrib_money'] = $orderGoods['distrib_money'];
                $goods['goods_contracts'] = $orderGoods['goods_contracts'];
                $goods['ext_info'] = $orderGoods['ext_info'];
                $goods['goods_mode'] = $orderGoods['goods_mode'];

                // goods_sku
                $goods['goods_barcode'] = $goodsSku['goods_barcode'];
                $goods['goods_stockcode'] = $goodsSku['goods_stockcode'];
                $goods['goods_stock'] = $goodsSku['goods_number']; // 库存
                $goods['sku_img'] = get_image_url($goodsSku['sku_image']); //
                $goods['third_id'] = null;
                $goods['goods_volume'] = $goodsSku['goods_volume']; //
                $goods['goods_weight'] = $goodsSku['goods_weight']; //
                $goods['url'] = null; //

                $goods_list[] = $goods;
            }
        }
        $info['goods_list'] = $goods_list;


        return $info;
    }

    /**
     * 商家中心 获取发货单详情中 订单信息
     *
     * @param $order_id
     * @return mixed
     */
    public function getOrderInfo($order_id)
    {
        $info = OrderInfo::where('order_id', $order_id)->with('orderGoods','user')->first()->toArray();
        $shopRep = new ShopRepository();
        $shopInfo = $shopRep->shopInfo($info['shop_id']);

        // 拼接其他数据
        $info['order_status_code'] = format_order_status($info['order_status'], $info['shipping_status'], $info['pay_status'], null, 1);
        $info['comment_type'] = 0; //
        $info['comment'] = null; // 订单评价数据
        $info['order_status_format'] = format_order_status($info['order_status'], $info['shipping_status'], $info['pay_status']);
        $info['order_from_format'] = format_order_from($info['order_from']);
        $info['backing'] = null; // 售后信息
        $info['shipping_type'] = '普通快递'; //format_shipping_type($info['shipping_type']);
        $info['shipping_status_format'] = format_shipping_status($info['shipping_status']);
        $info['bonus_all'] = '￥' . ($info['bonus'] + $info['shop_bonus']);
        // todo 计算公式需再确认
        $info['final_amount'] = '￥' . ($info['order_amount']);
        $info['amount_unship'] = '￥' . $info['order_amount'];
        $info['complainted'] = 7; // todo
        $info['all_delivery'] = 1; // todo
        $info['delivery_num'] = 1; // todo
        $info['goods_num'] = array_sum(array_column($info['order_goods'], 'goods_number'));
        $info['ship_time'] = $info['shipping_time'];
        $info['user_info'] = $info['user'];
        $info['shop_info'] = $shopInfo['shop'];
        $info['customer_main'] = $shopInfo['customer_main'];
        $info['order_invoice'] = null;

        unset($info['user'], $info['shop']);


        return $info;

    }

    /**
     * 获取每个状态的发货单数量并返回
     *
     * @param int $shopId
     *
     * @return array
     */
    public function getDeliveryCounts($shopId = 0)
    {
        // 发货单状态 0-待发货 1-已发货
        $where = [];

        if ($shopId) {
            $where[] = ['sender_id', $shopId];
        }

        // 全部发货单
        $all = DeliveryOrder::where($where)->count();
        // 待发货 todo
        $unshipped = DeliveryOrder::where($where)->where([['delivery_status', DELIVERY_CREATE]])->count();
        // 已发货 todo
        $shipped = DeliveryOrder::where($where)->where([['delivery_status', DELIVERY_SHIPPED]])->count();

        $data = [
            'all' => $all,
            'unshipped' => $unshipped,
            'shipped' => $shipped,
        ];

        return $data;
    }

    /**
     * 获取后台打印快递单页面数据
     *
     * @param int $delivery_id 发货单id
     * @return array|bool
     */
    public function getPrintData($delivery_id)
    {
        $delivery_info = $this->getById($delivery_id);
        if (empty($delivery_info)) {
            return false;
        }
        $model = ShopShipping::where('shipping_id', $delivery_info['shipping_id'])->first();
        if (empty($model)) {
            return false;
        }
        $model = $model->toArray();

        // todo
        $label_list = [];

        // todo
        $print = null;

        return [
            'model' => $model,
            'label_list' => $label_list,
            'print' => $print
        ];
    }

    /**
     * 获取订单详情页物流信息
     *
     * @param int $order_id 订单id
     * @return array
     */
    public function getFrontendExpressData(int $order_id)
    {
        $condition = [
            'with' => ['orderInfo','deliveryGoods','shipping'],
            'where' => [['order_id', $order_id]],
            'sortname' => 'delivery_id',
            'sortorder' => 'desc',
            'limit' => 0
        ];

        list($list, $total) = $this->model->getList($condition);

        if ($list->isEmpty()) {
            return [];
        }
        $list = $list->toArray();

        $express = [];
        foreach ($list as $item) {
            $goods_list = [];
            if (!empty($item['delivery_goods'])) {
                foreach ($item['delivery_goods'] as $goods) {
                    $orderGoods = OrderGoods::where('goods_id', $goods['goods_id'])->first()->toArray();
                    $goodsSku = GoodsSku::where('sku_id', $goods['sku_id'])->first()->toArray();

                    // 其他字段
                    $goods['is_gift'] = $orderGoods['is_gift'];
                    $goods['parent_id'] = $orderGoods['parent_id'];
                    $goods['goods_image'] = get_image_url($orderGoods['goods_image'],'goods_image');

                    $goods = array_merge($goods, $goodsSku);
                    $goods['sku_image'] = empty($goods['sku_image']) ? $goods['goods_image'] : get_image_url($goods['sku_image'],'goods_image');
                    $goods_list[] = $goods;
                }
            }

            $info = $item['shipping'];
            $info['express_sn'] = $item['express_sn'];
            $info['goods_list'] = $goods_list;

            // 根据 express_sn 获取发货物流信息
            $express_result = $this->getExpressContent($item['express_sn'], $info['shipping_code']);

            $express[] = [
                'error' => $express_result['error'],
                'content' => $express_result['content'],
                'info' => $info,
//                'shipping_type_format' => $item['shipping_type'] == 3 ? $info['shipping_name'] : format_shipping_type($item['shipping_type']),
                'shipping_type_format' => format_shipping_type($item['shipping_type']),
                'shipping_type' => $item['shipping_type'],
                'express_sn' => $item['express_sn'],
                'shop_id' => $item['order_info']['shop_id'],
                'store_type' => 0,
                'store_id' => 0,
            ];
        }

        return $express;
    }

    /**
     * 根据物流编号获取物流信息
     *
     * @param $express_sn
     * @param $shipping_code
     * @return array
     * @throws \Laravelvip\Kdniao\Exceptions\HttpException
     * @throws \Laravelvip\Kdniao\Exceptions\InvalidArgumentException
     */
    private function getExpressContent($express_sn, $shipping_code) {

        if (empty($express_sn) && empty($shipping_code)) {
            //
            $list = [
                [
                    'time' => '',
                    'msg' => '无需物流，暂不支持查询！'
                ]
            ];

        } else {
            $kdniao = new Kdniao();
            $express_result = $kdniao->track($express_sn, $shipping_code);
            $express_result = json_decode($express_result, true);
            if (empty($express_result['Traces'])) {
                $list = [
                    [
                        'time' => '',
                        'msg' => '抱歉，查询出错，请重试或点击快递公司官网地址进行查询。'
                    ]
                ];
            } else {
                $list = $express_result['Traces']; // todo
            }
        }

        $result = [
            'error' => 12,
            'content' => [
                'list' => $list
            ]
        ];
        return $result;
    }

    /****************** 以下是生成发货单逻辑代码 ********************/

    /**
     * 生成发货单
     *
     * @param int $orderId 订单ID
     * @param array $deliveryGoods 发货商品数组
     * @return bool
     */
    public function submitDelivery($orderId, $deliveryGoods = [])
    {
        // todo 1.验证数据

        DB::beginTransaction();
        try {

            // 新增发货单数据
            // 一个发货单订单
            // 发货单订单商品（一键发货-将该订单的商品全部发货；拆单发货-将该订单的部分商品发货）

            $condition = [
                ['order_id', $orderId],
            ];
            $orderInfo = $this->orderInfo->getOrderInfo($condition);
            // 发货信息 取商家默认发货地址
            $shopAddress = ShopAddress::where([['shop_id', $orderInfo['shop_id']], ['is_default', 1]])->first();
            if (empty($shopAddress)) {
                throw new \Exception('请先设置默认发货地址');
            }

            // 2.生成发货单订单数据
            $order = [
                'delivery_sn' => $this->makeDeliverySn(),
                'order_id' => $orderId,
                'user_id' => $orderInfo['user_id'],
                // 发货信息
                'sender_id' => $orderInfo['shop_id'],
                'region_code' => $shopAddress->region_code ?? null,
                'name' => $shopAddress->consignee ?? null,
                'address' => $shopAddress->address_detail ?? null,
                'tel' => !empty($shopAddress->mobile) ? $shopAddress->mobile : $shopAddress->tel,
                'add_time' => time(),
                'icode' => null,
                'is_show' => $orderInfo['is_show']
            ];
            $order_ret = $this->store($order);
            if (empty($order_ret)) {
                throw new \Exception('发货单保存失败[未生成发货单订单数据]');
            }
            $delivery_id = $order_ret->delivery_id;

            // 3.生成发货单订单商品数据
            $delivery_goods_insert = [];
            foreach ($orderInfo['goods_list'] as $orderGoods) {

                if (empty($deliveryGoods)) { // 一键发货
                    // 发货数量
                    $send_number = $orderGoods['goods_number'];
                    // todo 需验证发货数量

                    $delivery_goods_insert[] = [
                        'order_id' => $orderId,
                        'delivery_id' => $delivery_id,
                        'record_id' => $orderGoods['record_id'],
                        'goods_id' => $orderGoods['goods_id'],
                        'sku_id' => $orderGoods['sku_id'],
                        'send_number' => $send_number,
                        'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    ];
                } else { // 拆单发货
                    if (!empty($deliveryGoods[$orderGoods['record_id']])) {
                        // 发货数量
                        $send_number = $deliveryGoods[$orderGoods['record_id']];
                        // todo 需验证发货数量

                        $delivery_goods_insert[] = [
                            'order_id' => $orderId,
                            'delivery_id' => $delivery_id,
                            'record_id' => $orderGoods['record_id'],
                            'goods_id' => $orderGoods['goods_id'],
                            'sku_id' => $orderGoods['sku_id'],
                            'send_number' => $send_number,
                            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                        ];
                    }
                }
            }

            $delivery_goods_ret = $this->deliveryGoods->addAll($delivery_goods_insert);
            if (!$delivery_goods_ret) {
                throw new \Exception('发货单订单商品保存失败[未生成发货单订单商品数据]');
            }

            // 4.方式1：更新订单表发货状态 发货中
            OrderInfo::where('order_id', $orderId)->update(['shipping_status' => SS_SHIPPED_ING,'last_time'=>time()]);
            // todo 4.方式2：通过队列事件来处理发货
//            event(new OrderShipped($orderInfo));

            // todo 5.写入日志


            DB::commit();

            return $delivery_id; // 返回发货单id
        } catch (\Exception $e) {
            DB::rollBack();
//            echo $e->getMessage();
//            echo $e->getCode();
            return $e->getMessage();
        }

    }

    /**
     * 确认发货
     * 保存发货状态数据
     *
     * @param $delivery_id
     * @param $shipping_id
     * @param $express_sn
     * @param $shipping_type
     * @return bool
     */
    public function delivery($delivery_id, $shipping_id, $express_sn, $shipping_type)
    {
        // todo 1.验证数据

        DB::beginTransaction();
        try {

            $shipping_info = Shipping::where('shipping_id', $shipping_id)->first();

            // 确认发货 保存数据
            $update = [
                'shipping_id' => $shipping_id,
                'shipping_code' => $shipping_info->shipping_code ?? null,
                'shipping_name' => $shipping_info->shipping_name ?? null,
                'shipping_type' => $shipping_type,
                'express_sn' => $express_sn,
                'delivery_status' => DELIVERY_SHIPPED,
                'send_time' => time()
            ];
            $this->update($delivery_id, $update);

            // 更新订单发货时间 todo 是否需判断全部发货后再更新发货时间？
            $order_id = DeliveryOrder::where('delivery_id', $delivery_id)->value('order_id');
            $orderDelayDays = OrderInfo::where('order_id', $order_id)->value('delay_days');
            $confirm_time = time() + get_order_receiving_term() - get_order_delay_days_term($orderDelayDays);
            $orderUpdate = [
                'last_time'=>time(),
                'shipping_time'=>time(),
                'shipping_status'=> SS_SHIPPED,
                'confirm_time' => $confirm_time, // 确认收货截止时间
            ];
            OrderInfo::where('order_id', $order_id)->update($orderUpdate);

            DB::commit();

            return true;
        } catch (\Exception $e) {
            DB::rollBack();
//            echo $e->getMessage();
//            echo $e->getCode();
            return false;
        }

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

}