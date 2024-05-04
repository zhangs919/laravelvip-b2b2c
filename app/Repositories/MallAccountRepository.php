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
// | Description:平台进出账明细
// +----------------------------------------------------------------------

namespace App\Repositories;



use App\Models\MallAccount;
use Illuminate\Support\Facades\DB;

class MallAccountRepository
{
    use BaseRepository;

    protected $model;


    public function __construct()
    {
        $this->model = new MallAccount();
    }

    /*
     * 说明：
     * account_type：账户分类
     *  // 进账
     *  40-默认
        101-购物在线支付交易收入
        102-充值
        103-保证金和使用费
        104-续缴平台使用费
        105-神码收银
        // 106-余额支付退款         注：无用
        // 107-余额支付取消订单     注：无用
        108-人为调整-增加
        109-在线支付购买短信
        110-站点加盟费
        111-平台储值卡充值
        112-支付宝退款

        // 出账
        // 201-购物余额支付交易支出   注：无用
        202-在线支付退款
        203-在线支付取消订单
        204-站点扣点
        205-提现
        206-人为调整-减少
     */

    public function addData(int $account_type, int $order_id = 0, int $user_id = 0, int $admin_id = 0)
    {

        $order_info = []; // todo
        $back_order = null; // todo

        DB::beginTransaction();
        try {
            $input = [
                'account_sn' => $this->makeAccountSn($account_type),
                'user_id' => $user_id,
                'admin_id' => $admin_id,
                'amount' => 1000, // todo
                'add_time'=>time(),
                'note' => $this->getAccountNote($account_type, $order_info, $back_order),
                'account_type' => $account_type,
                'pay_name' => '', // todo
                'status' => 0,
                'order_sn' => $order_info['order_sn'] ?? null,
                'back_sn' => $back_order->back_sn ?? null,
            ];
            $this->store($input);

        }catch (\Exception $e) {
            DB::rollBack();
            return false;
        }
    }

    /**
     * 获取平台账户进账金额
     * @param int $adminId
     * @return mixed
     */
    public function getIncome($adminId)
    {
        return MallAccount::where([['admin_id',$adminId],['amount','>=',0]])->sum('amount');
    }

    /**
     * 获取平台账户出账金额
     * @param int $adminId
     * @return mixed
     */
    public function getExpend($adminId)
    {
        $result = MallAccount::where([['admin_id',$adminId],['amount','<',0]])->sum('amount');
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

            case 101:/*购物在线支付交易收入*/
                break;

            case 102:/*充值*/
                break;

            case 103:/*保证金和使用费*/
                break;

            case 104:/*续缴平台使用费*/
                $note .= "店铺名称：乐融沃生鲜专营店<br>
                付款时间：2018-02-15 13:29:13<br>
                使用期限：2018-06-05 ~ 2019-06-04<br>
                店铺平台使用费：1000.00元";
                break;

            case 105:/*神码收银*/
                break;

            case 108:/*人为调整-增加*/
                break;

            case 109:/*在线支付购买短信*/
                break;

            case 110:/*站点加盟费*/
                break;

            case 111:/*平台储值卡充值*/
                break;

            case 112:/*支付宝退款*/
                break;

            // 出账
            case 202:/*在线支付退款*/
                break;

            case 203:/*在线支付取消订单*/
                break;

            case 204:/*站点扣点*/
                break;

            case 205:/*提现*/
                break;

            case 206:/*人为调整-减少*/
                break;

            default: /*默认 40*/
                $note .= "店铺名称：乐融沃生鲜专营店<br>
                店铺平台使用费：1000元";

                break;
        }

        return $note;
    }
}