<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class OrderInfoCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'order_info:cancel';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '系统自动取消订单';

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

    }
}
