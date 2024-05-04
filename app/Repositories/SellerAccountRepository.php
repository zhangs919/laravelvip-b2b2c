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
// | Date:2019-5-15
// | Description:店铺进出账明细
// +----------------------------------------------------------------------

namespace App\Repositories;



use App\Models\SellerAccount;
use Illuminate\Support\Facades\DB;

class SellerAccountRepository
{
    use BaseRepository;

    protected $model;
    protected $orderInfo;

    public function __construct()
    {
        $this->model = new SellerAccount();
        $this->orderInfo = new OrderInfoRepository();
    }

    /*
     * 说明：
     * account_type：账户分类
     *  11-交易订单
        12-退款订单
        13-取消订单
        14-短信购买
        15-神码收银
        16-退还运费
        17-退还配送费和包装费
        18-售卖店铺购物卡
    *
     * 13 20181220 090739237461 账单编号
     *    20181220 010618174770 订单编号
     */

    /**
     * 添加账户记录
     *
     * @param int $account_type 账户类型
     * @param int $order_id 订单id
     * @param int $user_id 买家id
     * @param int $admin_id 店主id
     * @return bool
     */
    public function addData(int $account_type, int $order_id = 0, int $user_id = 0, int $admin_id = 0)
    {
        $condition = [
            ['order_id', $order_id],
        ];
        $order_info = $this->orderInfo->getOrderInfo($condition);

        $back_order = null;
        if ($order_info['back_id']) {
            $back_order = DB::table('back_order')->where('back_id',$order_info['back_id'])->first(); // 退款信息
        }

        DB::beginTransaction();
        try {
            $input = [
                'account_sn' => $this->makeAccountSn($account_type),
                'user_id' => $user_id,
                'admin_id' => $admin_id,
                'amount' => $order_info['goods_amount'],
                'add_time' => time(),
                'note' => $this->getAccountNote($account_type, $order_info, $back_order),
                'account_type' => $account_type,
                'status' => 0,
                'order_sn' => $order_info['order_sn'],
                'back_sn' => $back_order->back_sn ?? null,
            ];
            $this->store($input);

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack(); // 事务回滚
//            echo $e->getMessage();
            return false;
        }
    }

    /**
     * 获取商家账户进账金额
     * @param int $userId
     * @param array $condition
     * @return mixed
     */
    public function getIncome($condition)
    {
        $condition[] = ['amount','>=',0];
        $result = SellerAccount::where($condition)->sum('amount');
        return $result;
    }

    /**
     * 获取商家账户出账金额
     * @param int $userId
     * @param array $condition
     * @return mixed
     */
    public function getExpend($condition)
    {
        $condition[] = ['amount','<',0];
        $result = SellerAccount::where($condition)->sum('amount');
        return -$result;
    }

    /**
     * 生成账单编号
     *
     * 长度 = 8位 + 2位 + 4位 + 6位 = 20位 如: 20190309 10 0059 974040
     * 年月日     (00-10) 分秒   随机6位数
     * 20190309    10     0059   974040
     *
     * @param int $account_type
     * @return string
     */
    public function makeAccountSn($account_type)
    {
        return $account_type.format_time(time(), 'Ymd')
            . sprintf('%02d', mt_rand(0, 10)) // 0-10取两位 不足两位前面加0补两位
            . format_time(time(), 'is')
            . mt_rand(100000, 999999);
    }

    /**
     *
     * @param int $account_type
     * @param array $order_info
     * @param object|null $back_order
     * @return string
     */
    public function getAccountNote(int $account_type, array $order_info = [], object $back_order = null)
    {
        $note = "";
        switch ($account_type) {
            case SellerAccount::ACCOUNT_TYPE_TRADE_ORDER:/*交易订单*/

                $note .= "
                店铺售卖商品收益<br>
                订单编号：{$order_info['order_sn']}<br>
                下单时间：".format_time($order_info['add_time'])."<br>
                商品总金额：{$order_info['goods_amount']}元<br>";

                if ($order_info['shop_bonus'] > 0) {
                    $note .= "红包支付：店铺红包{$order_info['shop_bonus']}元<br>";
                }
                if ($order_info['bonus'] > 0) {
                    $note .= "红包支付：平台红包{$order_info['bonus']}元<br>";
                }

                $note .="支付方式：{$order_info['pay_name']}<br>";

                $note .="{$order_info['pay_name']}：{$order_info['money_paid']}元<br>";
                if ($order_info['surplus'] > 0) {
                    $note .="余额支付：{$order_info['surplus']}元<br>";
                }

                $note .="卖家优惠金额：0.00元<br>
                活动优惠金额：{$order_info['discount_fee']}元<br>
                运费：{$order_info['shipping_fee']}元<br>
                额外配送费：{$order_info['other_shipping_fee']}元<br>
                包装费：{$order_info['packing_fee']}元
                ";
                break;

            case SellerAccount::ACCOUNT_TYPE_REFUND_ORDER:/*退款订单*/

                $note .= "
                店铺完成发货后申请的订单退款<br>
                订单编号：{$order_info['order_sn']}<br>
                退款编号：{$back_order->back_sn}<br>
                退款时间：".format_time($back_order->add_time)."<br>
                商品总金额：{$order_info['goods_amount']}元<br>";

                if ($order_info['shop_bonus'] > 0) {
                    $note .= "红包支付：店铺红包{$order_info['shop_bonus']}元<br>";
                }
                if ($order_info['bonus'] > 0) {
                    $note .= "红包支付：平台红包{$order_info['bonus']}元<br>";
                }

                $note .="支付方式：{$order_info['pay_name']}<br>
                {$order_info['pay_name']}：{$order_info['surplus']}元<br>
                卖家优惠金额：0.00元<br>
                活动优惠金额：{$order_info['discount_fee']}元<br>
                运费：{$order_info['shipping_fee']}元<br>
                额外配送费：{$order_info['other_shipping_fee']}元<br>
                包装费：{$order_info['packing_fee']}元
                ";
                break;

            case SellerAccount::ACCOUNT_TYPE_CANCEL_ORDER:/*取消订单*/
                $note .= "
                店铺订单成功被取消<br>
                订单编号：{$order_info['order_sn']}<br>
                取消时间：".format_time($order_info['end_time'])."<br>
                商品总金额：{$order_info['goods_amount']}元<br>";
                if ($order_info['shop_bonus'] > 0) {
                    $note .= "红包支付：店铺红包{$order_info['shop_bonus']}元<br>";
                }
                if ($order_info['bonus'] > 0) {
                    $note .= "红包支付：平台红包{$order_info['bonus']}元<br>";
                }
                $cancel = str_replace([2,3,4],['卖家','买家','系统'], $order_info['order_status']);
                $note .="支付方式：{$order_info['pay_name']}<br>
                {$order_info['pay_name']}：{$order_info['surplus']}元<br>
                卖家优惠金额：0.00元<br>
                活动优惠金额：{$order_info['discount_fee']}元<br>
                运费：{$order_info['shipping_fee']}元<br>
                额外配送费：{$order_info['other_shipping_fee']}元<br>
                包装费：{$order_info['packing_fee']}元<br>
                取消者：{$cancel}
                ";
                break;

            case SellerAccount::ACCOUNT_TYPE_SMS_BUY:/*短信购买*/

                break;

            case SellerAccount::ACCOUNT_TYPE_SM_CASHIER:/*神码收银*/

                break;

            case SellerAccount::ACCOUNT_TYPE_REFUND_SHIPPING:/*退还运费*/

                break;

            case SellerAccount::ACCOUNT_TYPE_REFUND_DELIVERY_PACKING_FEE:/*退还配送费和包装费*/

                break;

            case SellerAccount::ACCOUNT_TYPE_SHOP_CARD:/*售卖店铺购物卡*/

                break;


            default:

                break;
        }

        return $note;
    }
}