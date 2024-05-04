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
// | Date:2019-5-14
// | Description:会员账户明细
// +----------------------------------------------------------------------

namespace App\Repositories;


use App\Models\User;
use App\Models\UserAccount;
use Illuminate\Support\Facades\DB;

class UserAccountRepository
{
    use BaseRepository;

    protected $model;
    protected $orderInfo;


    public function __construct()
    {
        $this->model = new UserAccount();
        $this->orderInfo = new OrderInfoRepository();
    }

    /*
     * 说明：
     * process_type：账户变动类型
     *      1-充值
            4-提现
            5-调节账户资金
            8-购物-余额支付
            10-取消-余额支付
            11-退款-余额支付
            15-推荐分成
            16-撤销推荐分成
            17-分销账户提现到余额
            18-拒绝提现
            19-平台结算进账
            20-神码收银
            21-购买短信
            22-储值卡充值
            23-退款成功退还运费
            24-取消提现
            25-线下消费余额
            26-提现手续费
            27-线下收款

            // todo
            28-线上转入线下余额
            29-线下转入线上余额
            30-保证金
            31-订单返现金额
            32-售后退款
            33-店铺奖励金
            34-退款成功退还配送费和包装费
            36-发布二手信息
            39-会员权益卡-付费购买
            40-会员权益卡-退款
            41-售卖店铺购物卡

     */

    /**
     * 添加会员账户记录
     *
     * @param int $process_type 账户变动类型
     * @param int $is_add 是否增加余额 1-增加 0-减少
     * @param int $order_id 订单id
     * @param int $user_id 卖家id
     * @param string $admin_user 平台方管理员id
     * @return bool
     */
    public function addData(int $process_type, $is_add, int $order_id = 0, int $user_id = 0, string $admin_user = '')
    {
        $condition = [
            ['order_id', $order_id],
        ];
        $order_info = $this->orderInfo->getOrderInfo($condition);
        $amount = $order_info['surplus']; // 余额支付金额

//        $back_order = null;
//        if ($order_info['back_id']) {
//            $back_order = DB::table('back_order')->where('back_id',$order_info['back_id'])->first(); // 退款信息
//        }

        list($trade_type, $note) = $this->getAccountNote($process_type, $order_info);

        DB::beginTransaction();
        try {
            // 余额变动 增加/减少
            $user = User::where('user_id', $user_id)->first();
            if (empty($user)) {
                throw new \Exception('用户不存在');
            }
            if (!$is_add) {
                // 判断余额是否足够
                if ($user->user_money < $amount) {
                    throw new \Exception('余额不足');
                }
                $user->user_money -= $amount;
            } else {
                $user->user_money += $amount;
            }
            $user->save();

            // 添加会员账户记录
            $input = [
                'account_sn' => $this->makeAccountSn($process_type),
                'user_id' => $user_id,
                'admin_user' => $admin_user,
                'amount' => $amount,
                'cur_balance' => $user->user_money, // 当前账户余额
                'add_time' => time(),
                'last_time' => 0,
                'note' => $note,
                'process_type' => $process_type,
                'payment_code' => $order_info['pay_code'],
                'payment_name' => $order_info['pay_name'],
                'trade_type' => $trade_type,
            ];
            $this->store($input);

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack(); // 事务回滚
            echo $e->getMessage();
            return false;
        }
    }


    /**
     * 生成账单编号
     *
     * 长度 = 8位 + 2位 + 4位 + 6位 = 20位 如: 20190309 10 0059 974040
     * 年月日     (00-10) 分秒   随机6位数
     * 20190309    10     0059   974040
     *
     * @param int $process_type
     * @return string
     */
    public function makeAccountSn($process_type)
    {
        $process_type = $process_type < 10 ? $process_type."0" : $process_type;
        return $process_type.format_time(time(), 'Ymd')
            . sprintf('%02d', mt_rand(0, 10)) // 0-10取两位 不足两位前面加0补两位
            . format_time(time(), 'is')
            . mt_rand(100000, 999999);
    }

    /**
     *
     * @param int $account_type 账户变动类型
     * @param array $order_info 订单信息
     * @return array
     */
    public function getAccountNote(int $account_type, array $order_info = [])
    {
        $trade_type = "";
        $note = "";

        switch ($account_type) {
            case 1:/*充值*/
                $note .= "充值<br>
                    订单编号：20190421150123021551<br>
                    下单时间：2019-04-21 23:01:30<br>
                    充值金额：1<br>
                    支付方式：微信支付<br>
                    微信支付：0.01
                    ";
                $trade_type = "充值";
                break;

            case 4:/*提现*/

                break;

            case 5:/*调节账户资金*/
                $note .= "调节账户不可提现资金\n增加：2000元\n";
                $trade_type = "调节资金";
                break;

            case 8:/*购物-余额支付*/
                $seller_discount_fee = $order_info['shop_bonus'] + $order_info['store_card_price'];
                $note .= "
                    购买商品使用余额支付<br>
                    订单编号：{$order_info['order_sn']}<br>
                    店铺名称：{$order_info['shop']['shop_name']}<br>
                    下单时间：{$order_info['created_at']}<br>
                    商品总金额：{$order_info['goods_amount']}元<br>
                    支付方式：余额支付<br>
                    余额支付：{$order_info['surplus']}元<br>
                    运费：{$order_info['shipping_fee']}元<br>
                    额外配送费：{$order_info['other_shipping_fee']}元<br>
                    包装费：{$order_info['packing_fee']}元<br>
                    可提现资金支付：{$order_info['user_surplus']}元<br>
                    不可提现资金支付：{$order_info['user_surplus_limit']}元<br>
                    卖家优惠金额：{$seller_discount_fee}元<br>
                    活动优惠金额：{$order_info['discount_fee']}
                    ";
                $trade_type = "购物-余额支付";
                break;

            case 10:/*取消-余额支付*/

                $note .= "
                    取消订单返还余额\n
                    订单编号：20180817014616818110\n
                    店铺名称：良品自营店\n
                    取消时间：2018-08-23 13:58:23\n
                    商品总金额：13.80元\n
                    红包支付：平台红包：1.88元\n
                    支付方式：余额支付\n
                    运费：8.00元\n
                    退回可提现资金：0.00元\n
                    退回不可提现资金：19.92元\n
                    取消者：买家\n
                    优惠：0.00元
                    ";
                $trade_type = "取消-余额支付";
                break;

            case 11:/*退款-余额支付*/

                break;

            case 15:/*推荐分成*/

                break;

            case 16:/*撤销推荐分成*/

                break;

            case 17:/*分销账户提现到余额*/

                break;

            case 18:/*拒绝提现*/

                break;

            case 19:/*平台结算进账*/
                $note .= "平台结算 进账 </br>
                    结算时间：2020-01-02 14:46:16</br>
                    结算周期：2019-12-01~2019-12-31</br>
                    结算金额：73.1元
                    ";
                $trade_type = "平台结算进账";
                break;

            case 20:/*神码收银*/

                break;

            case 21:/*购买短信*/

                break;

            case 22:/*储值卡充值*/

                break;

            case 23:/*退款成功退还运费*/

                break;

            case 24:/*取消提现*/

                break;

            case 25:/*线下消费余额*/

                break;

            case 26:/*提现手续费*/

                break;

            case 27:/*线下收款*/
                $note .= "线下收款<br>
                    消费者：qdm<br>
                    收款时间：2019-12-11 09:30:00<br>
                    收款金额：100元
                    ";
                $trade_type = "线下收款";
                break;


            default:
                $note .= "
                ";
                $trade_type = "取消订单";
                break;
        }

        return [$trade_type, $note];
    }
}