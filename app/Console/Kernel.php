<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Stringable;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        /**
         * 服务器添加：* * * * * cd /path-to-your-project && php artisan schedule:run >> /dev/null 2>&1
         */

//         $schedule->command('inspire')
//                  ->everyMinute()->sendOutputTo('t.txt',true);

        // 方式一：调度闭包调用
//        $schedule->call(function () {
//            // DB 操作或者其他
//            DB::table('user')->get();
//        })->daily();

        // 方式二：调度Artisan命令
//        $schedule->command('install:clear --force')->daily();

        // 方式三：调度队列任务
//        $schedule->job(new Heartbeat)->everyFiveMinutes();

        // 方式四：调度Shell命令
//        $schedule->exec('node /home/forge/script.js')->daily();

        // 更新失效红包状态 间隔：5分钟
        $schedule->command('user_bonus:invalid')->everyFiveMinutes();

        // 系统自动取消订单 间隔：1分钟
        $schedule->command('order:cancel')->everyMinute();

        // 自动备份数据库 间隔：每天 00:10
        $schedule->command('data:backup')->dailyAt("00:10");

        /* 每天午夜执行一次任务每天零点，查询账单订单数据是否存在 */
        $schedule->command('app:commission sorder')->daily();

        /* 每天 1 点 和 2 点分别执行一次任务，执行为生成账单 */
        $schedule->command('app:commission')->twiceDaily(1, 2);

        /* 每天 1 点 和 2 点分别执行一次任务，执行为生成账单详细数据 */
        $schedule->command('app:commission charge')->twiceDaily(1, 2);

        /* 每天午夜执行一次任务（译者注：每天零点），执行账单订单佣金插入数据 */
        $schedule->command('app:commission settlement')->daily();

        // 使用方式三：调度队列任务
//        $schedule->job(new ProcessUserBonus())
//            ->everyMinute()
//            ->before(function () {
//                // 任务即将开始
//                file_put_contents('job.txt', 'before', FILE_APPEND);
//
//            })
//            ->after(function (){
//                // 任务完成
//            })
//            ->onSuccess(function (Stringable $output){
//                // 任务成功
//                file_put_contents('job.txt', $output, FILE_APPEND);
//
//            })
//            ->onFailure(function (Stringable $output){
//                // 任务失败
//                file_put_contents('job.txt', $output, FILE_APPEND);
//
//            });


    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
