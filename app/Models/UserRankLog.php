<?php

namespace App\Models;


class UserRankLog extends BaseModel
{
    protected $table = 'user_rank_log';

    protected $fillable = [
        'user_id','growth_value',
        'target_type', // 来源类型 0-订单 1-退单
        'target_id', // 订单id或退款id
        // 关联查询来源/用途 订单商品数据
    ];

    protected $appends = [
        'target_sn',
        'target_info'
    ];

    protected $primaryKey = 'id';

    public function orderInfo()
    {
        return $this->belongsTo(OrderInfo::class, 'target_id', 'order_id');
    }

    public function backOrder()
    {
        return $this->belongsTo(BackOrder::class,'target_id', 'back_id');
    }

    public function getPayAmountAttribute()
    {
        if ($this->target_type == 1) {
            // 退单
            return $this->backOrder->refund_money ?? '';
        } else {
            // 订单
            return $this->orderInfo->money_paid ?? '';
        }
    }

    public function getTargetSnAttribute()
    {
        if ($this->target_type == 1) {
            // 退单
            return $this->backOrder->back_sn ?? '';
        } else {
            // 订单
            return $this->orderInfo->order_sn ?? '';
        }
    }

    public function getTargetInfoAttribute()
    {
        if ($this->target_type == 1) {
            // 退单
            if (empty($this->backOrder->orderGoods)) {
                return '';
            }
            return $this->backOrder->orderGoods;
        } else {
            // 订单
            if (empty($this->orderInfo->orderGoods)) {
                return '';
            }
            return $this->orderInfo->orderGoods[0];
        }
    }
}
