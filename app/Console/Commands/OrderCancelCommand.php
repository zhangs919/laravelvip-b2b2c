<?php

namespace App\Console\Commands;

use App\Jobs\OrderCancel;
use App\Repositories\OrderInfoRepository;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OrderCancelCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'order:cancel';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '15分钟未支付，取消订单';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        $orderInfoRep = new OrderInfoRepository();
        list($orders, $total) = $orderInfoRep->getSystemCancelOrderList();
//        dd($total);

        if (!empty($orders)) {
            foreach ($orders as $item) {
//                Log::info('系统取消订单失败，订单id：'.$item['order_id']);

                OrderCancel::dispatch($item,'system_cancel', '订单超时，系统自动关闭订单！');
            }
        }
    }
}
