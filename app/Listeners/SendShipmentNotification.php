<?php

namespace App\Listeners;

use App\Events\OrderShipped;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendShipmentNotification implements ShouldQueue
{

    use InteractsWithQueue;

    /**
     * 任务将被发送到的连接的名称
     *
     * @var string
     */
    public $connection = 'sqs';

    /**
     * 任务将被发送到的队列的名称
     *
     * @var string
     */
    public $queue = 'listeners';

    /**
     * 任务被处理的延迟时间（秒）
     *
     * @var int
     */
    public $delay = 60;


    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  OrderShipped  $event
     * @return void
     */
    public function handle(OrderShipped $event)
    {
        // 使用 $event->orderInfo 来访问订单
//        $event->orderInfo;

        if (true) {
            $this->release(30);
        }
    }

    /**
     * 处理任务的失败
     *
     * @param OrderShipped $event
     * @param $exception
     */
    public function fail(OrderShipped $event, $exception)
    {
        
    }

    /**
     * 获取监听器队列的名称
     * 
     * @return string
     */
    public function viaQueue() {
        return 'listeners';
    }

    public function shouldQueue(OrderShipped $event)
    {
        // 配送状态 0-待发货 1-已发货 2-发货中 3-已提交物流系统
        return $event->orderInfo->shipping_status == 0;
    }

}
