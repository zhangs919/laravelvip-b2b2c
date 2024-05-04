<?php
namespace App\Services\Scheduler\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class SchedulerTestCommand extends Command
{
    protected $signature = 'Scheduler:Test';

    protected $description = 'Scheduler 测试脚本';

    public function handle()
    {
        Log::info('Scheduler 任务运行了...');
    }
}
