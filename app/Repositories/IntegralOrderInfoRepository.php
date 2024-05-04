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
// | Date:2019-6-1
// | Description: 积分兑换订单
// +----------------------------------------------------------------------

namespace App\Repositories;


use App\Models\IntegralOrderInfo;
use Illuminate\Support\Facades\DB;

class IntegralOrderInfoRepository
{
    use BaseRepository;

    protected $model;
    protected $customer;
    protected $deliveryOrder;


    public function __construct(DeliveryOrderRepository $deliveryOrder)
    {
        $this->model = new IntegralOrderInfo();
        $this->customer = new CustomerRepository();
        $this->deliveryOrder = $deliveryOrder;
    }

    public function getOrderCounts($userId = 0, $shopId = 0, $is_delete = 0)
    {
        // 订单状态 0-订单已确认 1-交易成功 2-卖家取消 3-买家取消 4-系统自动取消 10-抢单中
        // 配送状态 0-待发货 1-已发货 2-发货中 3-已提交物流系统
        // 支付状态 0-未支付 1-已支付

        $where = [];

        if ($userId) {
            $where[] = ['user_id', $userId];
        }

        if ($shopId) {
            $where[] = ['shop_id', $shopId];
        }

        $where[] = ['is_delete', $is_delete];

        // 根据 3种状态来判断 商家中心订单列表状态

        // 全部订单
        $all = IntegralOrderInfo::where($where)->count();
        // 等待买家付款
        $unpayed = IntegralOrderInfo::where($where)->where([['order_status',0],['pay_status',0]])->count();
        // 已发货
        $shipped = IntegralOrderInfo::where($where)->where([['order_status',0],['pay_status',1],['shipping_status',1]])->count();
        // 交易成功
        $finished = IntegralOrderInfo::where($where)->where([['order_status',1]])->count();
        // 交易关闭
        $closed = IntegralOrderInfo::where($where)->whereIn('order_status', [2,3,4])->count();

        $data = [
            'all' => $all,
            'unpayed' => $unpayed,
            'shipped' => $shipped,
            'finished' => $finished,
            'closed' => $closed,
        ];

        return $data;
    }

    public function getOrderStatusList()
    {
        $data = [
            '' => "全部",
            'unshipped' => "待发货",
            'shipped' => "已发货",
            'finished' => "交易成功",
            'closed' => "交易关闭"
        ];

        return $data;
    }

    /**
     * 商家后台 订单列表 格式化输出（json）
     * @param $condition
     * @return array
     */
    public function getOrderList($condition)
    {
        list($list, $total) = $this->model->getList($condition);

        $list = $list->toArray();

        if (!empty($list)) {
            foreach ($list as &$v) {
                // 拼接其他字段
//                $v['order_status_format'] = format_order_status($v['order_status']); //'交易关闭'; // todo
                $v['order_status_format'] = format_order_status($v['order_status'],$v['shipping_status'],$v['pay_status']); //'交易关闭'; // todo
                $v['order_from_format'] = format_order_from($v['order_from']);  // WAP端

                $v['goods_list'] = [];
                if (!empty($v['integral_order_goods'])) {
                    foreach ($v['integral_order_goods'] as $goods) {

                        $v['goods_list'][] = $goods;
                    }
                }

                // 移除 integral_order_goods 对象
                unset($v['integral_order_goods']);

            }
        }

        return [$list, $total];
    }

    /**
     * 前端会员中心 订单列表 格式化输出（json）
     * @param $condition
     * @return array
     */
    public function getFrontendOrderList($condition)
    {
        list($list, $total) = $this->model->getList($condition);

        $list = $list->toArray();

        if (!empty($list)) {
            foreach ($list as &$v) {
                // 拼接其他字段

                // 店铺信息
                $shop_info = $v['shop'];

                // 客服信息
                $customer_info = $this->customer->getCustomerMain($v['shop_id']);

                $v['shop_name'] = $shop_info->shop_name ?? null;
                $v['shop_type'] = $shop_info->shop_type ?? null;
                $v['customer_tool'] = $customer_info->customer_tool ?? null;
                $v['customer_account'] = $customer_info->customer_account ?? null;
                $v['order_status_format'] = format_order_status($v['order_status'],$v['shipping_status'],$v['pay_status']); //'交易关闭'; // todo
                $v['order_from_format'] = format_order_from($v['order_from']);  // WAP端

                $v['goods_list'] = [];
                if (!empty($v['integral_order_goods'])) {
                    foreach ($v['integral_order_goods'] as $goods) {

                        $v['goods_list'][] = $goods;
                    }
                }
                //http://kf.test.lrw.com/index/index/home?business_id=xxxxxxxx&groupid=0&shop_id=0&goods_id=0&visiter_id=83_0&visiter_name=好事花生&avatar=http://xxxx.oss-cn-beijing.aliyuncs.com/images/746/upload/images/2019/06/15/15605770918943.jpeg&domain=http://www.test.xxxx.com
                $v['yikf_url'] = null;

                // 移除对象
                unset($v['integral_order_goods'],$v['shop']);
            }
        }

        return [$list, $total];
    }

    /**
     * 前端会员中心 获取订单信息
     * @param $condition
     * @return array
     */
    public function getFrontendOrderInfo($condition)
    {
        $info = $this->model->where($condition)->with(['integralOrderGoods'])->first();
        if (empty($info)) {
            return [];
        }
        $info = $info->toArray();

        $info['order_status_format'] = format_order_status($info['order_status'],$info['shipping_status'],$info['pay_status']); //'交易关闭 | 订单已确认，等待买家付款'; // todo


        $info['goods_list'] = [];
        if (!empty($info['integralOrderGoods'])) {
            foreach ($info['integralOrderGoods'] as $goods) {

                $goods['delivery_number'] = 0; // todo

                $info['goods_list'][] = $goods;
            }
        }

        // qrcode_订单id.png
        $info['qrcode_image'] = ''; // todo http://images.test.xxxx.com/oqrcode/2C/qrcode_81.png

        // 移除 order_goods 对象
        unset($info['integralOrderGoods']);

        return $info;
    }

    /**
     * 获取订单详情页顶部步骤数据
     *
     * @param $orderInfo
     *
     * @return array
     */
    public function getOrderSchedules($orderInfo)
    {
        if (in_array($orderInfo['order_status'], [2,3,4])) {
            $orderSchedules = [
                [
                    'title' => '成交时间',
                    'time' => $orderInfo['add_time'],
                    'status' => '1'
                ],
            ];
        } else {
            $orderSchedules = [
                [
                    'title' => '提交兑换',
                    'title_sub' => '提交兑换时间',
                    'time' => $orderInfo['add_time'],
                    'status' => $orderInfo['add_time'] > 0 ? 1 : 0
                ],
                [
                    'title' => '商家发货',
                    'title_sub' => '商家发货时间',
                    'time' => $orderInfo['shipping_time'],
                    'status' => $orderInfo['shipping_time'] > 0 ? 1 : 0
                ],
                [
                    'title' => '确认收货',
                    'title_sub' => '确认收货时间',
                    'time' => $orderInfo['end_time'],
                    'status' => $orderInfo['end_time'] > 0 ? 1 : 0
                ],
            ];
        }

        return $orderSchedules;
    }

    /**
     * 订单核销
     *
     * @param $order_id
     * @return bool
     * @throws \Exception
     */
    public function doRevision($order_id)
    {
        DB::beginTransaction();
        try {
            $info = $this->model->where('order_id', $order_id)->with(['integralOrderGoods'])->first();
            if (empty($info)) {
                throw new \Exception('订单ID无效');
            }

            // 执行核销操作 如果是待发货 自动进行商家发货及买家收货操作，完成订单，并核销，将订单核销状态改为已核销
            // 确认发货
            $delivery_id = $this->deliveryOrder->submitDelivery($order_id);
            $this->deliveryOrder->delivery($delivery_id, '', '', 0);
            // 确认收货
            $update = [
                'shipping_status' => SS_RECEIVED,
                'end_time' => time(),
                'last_time' => time(),
                'take_time' => time()
            ];
            $ret = IntegralOrderInfo::where('order_id', $order_id)
                ->update($update);
            if (!$ret) {
                throw new \Exception('确认收货失败！');
            }

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            return false;
        }
    }
}