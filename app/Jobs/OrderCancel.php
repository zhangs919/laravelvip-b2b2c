<?php

namespace App\Jobs;

use App\Models\Goods;
use App\Models\OrderInfo;
use App\Repositories\OrderInfoLogicRepository;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OrderCancel implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $orderInfo;
    protected $type;
    protected $closeReason;
    protected $orderCancel;

    /**
     * Create a new job instance.
     *
     * OrderCancel constructor.
     * @param $orderInfo
     * @param string $type 类型 buyer_cancel shop_cancel system_cancel
     * @param string $closeReason 关闭原因
     * @param int $orderCancel 用户提交取消申请状态 默认0 无取消申请 1等待商家审核 2商家审核通过 3商家拒绝通过
     */
    public function __construct($orderInfo, $type, $closeReason, $orderCancel = 0)
    {
        //
        $this->orderInfo = $orderInfo;
        $this->type = $type;
        $this->closeReason = $closeReason;
        $this->orderCancel = $orderCancel;
    }

    /**
     * Execute the job.
     *
     * @return mixed
     */
    public function handle()
    {
        //
        $orderInfoLogic = new OrderInfoLogicRepository();

        $ret = $orderInfoLogic->changeOrderStateCancel($this->type,$this->closeReason,$this->orderInfo, $this->orderCancel);
        if (!$ret) {
            // 执行失败
            Log::stack(['job'])->info($this->closeReason.'失败，订单id：'.$this->orderInfo['order_id']);
        } else {
            Log::stack(['job'])->info($this->closeReason.'成功:' . $this->orderInfo['order_id']);
        }
        return $ret;
    }
}
