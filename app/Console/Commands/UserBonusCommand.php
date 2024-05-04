<?php

namespace App\Console\Commands;

use App\Jobs\ProcessUserBonus;
use App\Models\UserBonus;
use Illuminate\Console\Command;

class UserBonusCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user_bonus:invalid';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '设置无效用户红包状态';

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
        ProcessUserBonus::dispatch();

//        // 更新失效红包状态
//        return UserBonus::where('end_time', '<', time())->where('bonus_status', 0)->update(['bonus_status' => 2]);
    }
}
