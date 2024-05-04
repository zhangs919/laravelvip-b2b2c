<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

/**
 * 系统安装初始化配置文件
 * TODO 后期要做的SAAS云商城，可以使用此处进行自动部署完成系统的部署上线
 *
 * Class InstallInitCommand
 * @package App\Console\Commands
 */
class InstallInitCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'install:init';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '安装初始化配置文件';

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

//        # 生成进度条 步数*5
//        $progress = $this->output->createProgressBar(5);
//
//        # 生成秘钥
//        Artisan::call('key:generate');
//
//        $progress->advance();
//
//        # 执行数据回滚 - 数据迁移
//        Artisan::call('migrate:reset');
//
//        $progress->advance();
//
//        # 执行数据表生成
//        Artisan::call('migrate');
//
//        $progress->advance();
//
//        # 执行数据填充 包括系统配置、后台菜单权限（system_config.sql、backend_menu_auth.sql）
//        Artisan::call('db:seed');
//
//        $progress->advance();
//
//        # 清除缓存
//
//        Artisan::call('install:clear');
//
//        $progress->finish();
//
//        $this->info("\n安装完成");

    }
}
