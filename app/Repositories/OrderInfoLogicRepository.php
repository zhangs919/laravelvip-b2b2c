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
// | Date:2020-01-01
// | Description: 订单流程逻辑处理
// +----------------------------------------------------------------------

namespace App\Repositories;


use App\Models\Admin;
use App\Models\Goods;
use App\Models\OrderAction;
use App\Models\OrderInfo;
use App\Models\OrderPay;
use App\Models\SellerAccount;
use App\Models\Shop;
use App\Models\TradeSnapshot;
use App\Services\Enum\AccountProcessTypeEnum;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OrderInfoLogicRepository
{
    use BaseRepository;

    protected $model;

    protected $sellerAccount;

    public function __construct()
    {
        $this->model = new OrderInfo();

        $this->sellerAccount = new SellerAccountRepository();
    }


    /**
     * 关闭订单
     *
     * @param array $orderInfo 订单信息
     * @param string $role 操作角色 buyer-买家 shop-商家 admin-管理员 system-系统
     * @param string $user 操作人
     * @param string $msg 操作备注
     *
     *
     * @param string $type 类型 buyer_cancel shop_cancel system_cancel
     * @param string $closeReason 关闭原因
     * @param $orderInfo
     * @param int $orderCancel 用户提交取消申请状态 默认0 无取消申请 1等待商家审核 2商家审核通过 3商家拒绝通过
     * @return bool
     */
    public function changeOrderStateCancel($type, $closeReason, $orderInfo, $orderCancel)
    {
        DB::beginTransaction();
        try {
            // 1.库存销量更新 使用队列
            // 是否还原商品库存并减少销量
            $resetGoodsData = false;

            // 2.订单状态修改
            if ($type == 'shop_cancel') { // 商家关闭订单
                // 如果是已支付订单 则记录卖家进出账明细
                if ($orderInfo['pay_status'] == PS_PAYED) {
                    $shop_user_id = Shop::where('shop_id', $orderInfo['shop_id'])->value('user_id');
                    $this->sellerAccount->addData(SellerAccount::ACCOUNT_TYPE_CANCEL_ORDER, $orderInfo['order_id'], $orderInfo['user_id'], $shop_user_id);
                }
                $resetGoodsData = true;
                $update = [
                    'order_status' => OS_CANCELED,
                    'end_time' => time(),
                    'close_reason' => $closeReason
                ];
                OrderInfo::where('order_id', $orderInfo['order_id'])->update($update);
            } elseif ($type == 'buyer_cancel') { // 用户取消订单
                $resetGoodsData = false;
                if ($orderInfo['pay_status'] == PS_UNPAYED) { // 待付款 直接取消
                    $update = [
                        'order_status' => OS_CANCELED,
                        'end_time' => time(),
                        'close_reason' => $closeReason
                    ];
                } else {
                    $update = [
                        'order_cancel' => OC_WAIT_AUDIT,//1等待商家审核
                        'last_time' => time(),
                        'close_reason' => $closeReason
                    ];
                }
                OrderInfo::where('order_id', $orderInfo['order_id'])->update($update);
            } elseif ($type == 'shop_audit_cancel') {

                //用户提交取消申请状态 默认0 无取消申请 1等待商家审核 2商家审核通过 3商家拒绝通过
                $update = [
                    'order_cancel' => $orderCancel,
                    'last_time' => time(),
                    'refuse_reason' => $closeReason
                ];
                if ($orderCancel == OC_AUDITED) {
                    $resetGoodsData = true;
                    $update['order_status'] = OS_CANCELED;
                    $update['end_time'] = time();
                }
                OrderInfo::where('order_id', $orderInfo['order_id'])->update($update);
            } elseif ($type == 'system_cancel') {
                $resetGoodsData = true;
                $update = [
                    'order_status' => OS_CANCELED,
                    'end_time' => time(),
                    'close_reason' => $closeReason
                ];
                OrderInfo::where('order_id', $orderInfo['order_id'])->update($update);
            }

            if ($resetGoodsData) {
                $order_goods = $orderInfo['goods_list'];
                foreach ($order_goods as $good) {
                    // 还原商品库存并减少销量
                    Goods::where('goods_id', $good['goods_id'])->decrement('sale_num', $good['goods_number']);
                    Goods::where('goods_id', $good['goods_id'])->increment('goods_number', $good['goods_number']);
                }
            }

            // 3.记录订单操作日志
            $this->orderAction($orderInfo['order_sn'], $orderInfo['order_status'], $orderInfo['shipping_status'],
                $orderInfo['pay_status'], '操作主订单取消', str_replace('_cancel', '', $type), 1);

            Log::info('订单取消成功:' . $orderInfo['order_id']);

            DB::commit();

            return true;
        }catch (\Exception $e) {
            Log::stack(['api'])->info("---取消订单错误：".$e->getMessage());
            DB::rollBack();

            return false;
        }

    }

    /**
     * @param array $orderInfo 订单信息
     * @param string $role 操作角色 buyer-买家 shop-商家 admin-管理员 system-系统
     * @param string $user 操作人
     * @param array $post
     * @return boolean
     */
    public function changeOrderReceivePay($orderInfo, $role, $user, $post = [])
    {
        DB::beginTransaction();
        try {
            //
            // 添加订单日志
            $this->orderAction($orderInfo['order_sn'], $orderInfo['order_status'], $orderInfo['shipping_status'],
                $orderInfo['pay_status'], '操作主订单支付', $role, 1);

            // 添加卖家账户记录
            $shopInfo = Shop::where('shop_id', $orderInfo['shop_id'])->first();
            $sellerAccount = new SellerAccountRepository();
            $sellerAccount->addData(SellerAccount::ACCOUNT_TYPE_TRADE_ORDER, $orderInfo['order_id'], $orderInfo['user_id'], $shopInfo->user_id);

            // 更新订单状态
            $updateArray = [];
            $updateArray['pay_time'] = time();
            $updateArray['pay_status'] = PS_PAYED;
            if (!empty($post['trade_no'])) {
                $updateArray['pay_sn'] = $post['trade_no'];
            }

            OrderInfo::where('order_sn', $orderInfo['order_sn'])->update($updateArray);

            // 余额支付+现金支付 扣减账户余额
            if ($orderInfo['surplus'] > 0) {
                $userAccountRep = new UserAccountRepository();
                $userAccountRep->addData(AccountProcessTypeEnum::ACCOUNT_TYPE_PAY,
                    0, $orderInfo['order_id'], $orderInfo['user_id']);
            }

            DB::commit();

            return true;
        }catch (\Exception $e) {
            DB::rollBack();
//            echo $e->getMessage();

            return false;
        }
    }


    /**
     * 记录订单操作记录
     *
     * @param string $order_sn 订单编号
     * @param int $order_status 订单状态
     * @param int $shipping_status 配送状态
     * @param int $pay_status 付款状态
     * @param string $note 备注
     * @param string $username 用户自己的操作则为 buyer
     * @param int $place 取消订单记录，值为1
     * @param int $confirm_take_time 确认收货时间
     */
    public function orderAction($order_sn = '', $order_status = 0, $shipping_status = 0, $pay_status = 0, $note = '', $username = '', $place = 0, $confirm_take_time = 0)
    {
        if (!empty($confirm_take_time)) {
            $log_time = $confirm_take_time;
        } else {
            $log_time = time();
        }

        if (empty($username)) {
            $admin_id = auth('admin')->id();

            $username = Admin::where('user_id', $admin_id)->value('user_name');
            $username = $username ? $username : '';
        }

        $order_id = OrderInfo::where('order_sn', $order_sn)->value('order_id');
        $order_id = $order_id ? $order_id : 0;

        if ($order_id > 0) {
            $place = !is_null($place) ? $place : '';
            $note = !is_null($note) ? $note : '';

            $other = [
                'order_id' => $order_id,
                'action_user' => $username,
                'order_status' => $order_status,
                'shipping_status' => $shipping_status,
                'pay_status' => $pay_status,
                'action_place' => $place,
                'action_note' => $note,
                'log_time' => $log_time
            ];
            OrderAction::insert($other);
        }
    }

    /**
     * 更新订单对应的 order_pay
     * 如果未支付，修改支付金额；否则，生成新的支付log
     * @param int $order_id 订单id
     */
    public function updateOrderPayLog($order_id)
    {
        $order_id = intval($order_id);
        if ($order_id > 0) {
            $order_amount = OrderInfo::where('order_id', $order_id)->value('order_amount');

            if (!is_null($order_amount)) {
                $pay_id = OrderPay::where('order_id', $order_id)
                    ->where('order_type', PAY_ORDER)
                    ->where('is_paid', 0)
                    ->value('pay_id');

                if ($pay_id > 0) {

                    /* 未付款，更新支付金额 */
                    OrderPay::where('pay_id', $pay_id)->update(['order_amount' => $order_amount]);
                } else {
                    /* 已付款，生成新的pay_log */
                    $other = [
                        'order_id' => $order_id,
                        'order_amount' => $order_amount,
                        'order_type' => PAY_ORDER,
                        'is_paid' => 0
                    ];
                    OrderPay::insert($other);
                }
            }
        }
    }

    /**
     * 查找是否存在快照
     *
     * @param string $order_sn
     * @param int $goods_id
     * @return mixed
     */
    public function getFindSnapshot($order_sn = '', $goods_id = 0)
    {
        $trade_id = TradeSnapshot::where('order_sn', $order_sn)
            ->where('goods_id', $goods_id)
            ->value('trade_id');

        return $trade_id;
    }

}