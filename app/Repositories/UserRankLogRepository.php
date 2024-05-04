<?php

namespace App\Repositories;

use App\Models\OrderInfo;
use App\Models\UserRankLog;

class UserRankLogRepository
{
    use BaseRepository;

    protected $model;

    public function __construct()
    {
        $this->model = new UserRankLog();
    }


    /**
     * 添加成长值记录
     * 触发时机：
     *  1.增加：确认收货后
     *  2.减少：确认收货后退款退货
     *
     * @param int $target_id 订单id或退单id
     * @param int $target_type 类型 0-订单 1-退单
     */
    public function addData($user_id, $target_id, $target_type = 0)
    {
		$growth_value = 0;
        // 计算成长值
        if ($target_type == 1) {
            // 退单

        } else {
            // 订单
            $monetary_rate = (int)sysconf('monetary_rate') / 100; // 消费金额与赠送成长值比例
            // 取订单实付金额
            $orderInfo = OrderInfo::find($target_id);
            if (empty($orderInfo)) {
                return false;
            }
            $growth_value = floor($orderInfo->money_paid * $monetary_rate); // 成长值 = 实付金额*比例 再取整数
            $max_growth_value = (int)sysconf('max_growth_value') ?? 0; // 每笔订单最多赠送成长值
            if ($max_growth_value > 0 && $growth_value > $max_growth_value) {
                // 每笔订单最多赠送成长值
                $growth_value = $max_growth_value;
            }
        }

        $input = [
            'user_id' => $user_id,
            'growth_value' => $growth_value,
            'target_type' => $target_type,
            'target_id' => $target_id,
        ];
        $this->store($input);
    }
}
