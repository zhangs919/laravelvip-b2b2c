<?php


namespace App\Services\Enum;

/**
 * 账户变动类型枚举类
 *
 * Class ActTypeEnum
 * @package App\Services\Enum
 */
class AccountProcessTypeEnum
{
    const ACCOUNT_TYPE_RECHARGE = 1;// 充值
    const ACCOUNT_TYPE_WITHDRAW = 4;// 提现
    const ACCOUNT_TYPE_CHANGE_BALANCE = 5;// 调节账户资金
    const ACCOUNT_TYPE_PAY = 8; // 购物-余额支付
    const ACCOUNT_TYPE_CANCEL_PAY = 10;// 取消-余额支付
    const ACCOUNT_TYPE_REFUND = 11;// 退款-余额支付
    const ACCOUNT_TYPE_RECOMMEND = 15;// 推荐分成
    const ACCOUNT_TYPE_CANCEL_RECOMMEND = 16;// 撤销推荐分成
    const ACCOUNT_TYPE_DISTRIB_WITHDRAWAL = 17;// 分销账户提现到余额
    const ACCOUNT_TYPE_REJECT_WITHDRAWAL = 18;// 拒绝提现
    const ACCOUNT_TYPE_PLATFORM_DEPOSITE = 19;// 平台结算进账
    const ACCOUNT_TYPE_SM_CASHIER = 20;// 神码收银
    const ACCOUNT_TYPE_BUY_SMS = 21;// 购买短信
    const ACCOUNT_TYPE_RECHARGE_CARD = 22;// 储值卡充值
    const ACCOUNT_TYPE_REFUND_SHIPPING_FEE = 23;// 退款成功退还运费
    const ACCOUNT_TYPE_CANCEL_WITHDRAWAL = 24;// 取消提现
    const ACCOUNT_TYPE_OFFLINE_PAY = 25;// 线下消费余额
    const ACCOUNT_TYPE_WITHDRAWAL_FEE = 26;// 提现手续费
    const ACCOUNT_TYPE_OFFLINE_COLLECTION = 27;// 线下收款
}