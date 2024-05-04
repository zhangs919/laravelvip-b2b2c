<?php

namespace App\Jobs;

use App\Models\Goods;
use App\Models\OrderInfo;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

/**
 * 代表这个类需要被放到队列中执行，而不是触发时立即执行
 *
 * 下单更新库存和销量等信息
 *
 * Class OrderUpdate
 * @package App\Jobs
 */
class OrderUpdate implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

//    protected $orderInfo;

    protected $param;

    /**
     * Create a new job instance.
     *
     * OrderUpdate constructor.
     * @param OrderInfo $orderInfo
     * @param $delay
     */
    public function __construct($param)
    {
//        $this->orderInfo = $orderInfo;
        // 设置延迟的时间，delay() 方法的参数代表多少秒之后执行
//        $this->delay($delay);

        $this->param = $param;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
//        Log::info('Hello，Queue');

        // 通过事务执行 sql
        try {
            DB::transaction(function () {
                $goods_buy_quantity = $this->param;
                foreach ($goods_buy_quantity as $goods_id => $quantity) {
                    // 减少商品库存并增加销量
                    Goods::where('goods_id', $goods_id)->increment('sale_num',$quantity);
                    Goods::where('goods_id', $goods_id)->decrement('goods_number',$quantity);
                }
                return true;
            });
        } catch (\Exception $e) {
//            $e->getMessage(); //变更商品库存与销量失败
            return false;
        }

    }

    /**
     * 下单变更库存销量
     *
     * @param $goods_buy_quantity
     */
//    public function createOrderUpdateStorage($goods_buy_quantity)
//    {
//
//        Log::info('createOrderUpdateStorage');
//    }
}
