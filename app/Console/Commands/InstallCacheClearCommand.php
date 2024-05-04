<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

/**
 * 清除相关的缓存
 * 并重新进行缓存配置
 *
 * Class InstallCacheClearCommand
 * @package App\Console\Commands
 */
class InstallCacheClearCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'install:clear';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '清除相关的缓存，并重新进行缓存配置';

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
     * @return mixed
     */
    public function handle()
    {
        # 清除缓存
        Artisan::call('config:clear');
        Artisan::call('view:clear');
        Artisan::call('route:clear');
        Artisan::call('cache:clear');

        # 更新分类
//        Artisan::call('update:category');

        # 清除页面中的缓存
//        Redis::del(User::key);


        # 清除活跃用户
//        Artisan::call('me:clear_active_user');

        # 提示
        $this->info('清除相关数据缓存完成');

    }
}
