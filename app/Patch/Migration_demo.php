<?php

namespace App\Patch;

use Eloquent;
use Exception;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;

class Migration_demo
{
    public function run()
    {
        try {

            // 其他对数据库表的操作 - 新增表、字段、原有数据更新操作等
            // $this->cart();

            // 执行sql文件（菜单权限数据 或 表结构有更改，并可清空数据的表适用）
            $this->runSql();

            // 执行迁移-migrate
            Artisan::call('migrate');

            // 执行填充-seed
            $this->runSeed();

            // 系统配置 清空缓存
            $this->systemConfig();

        } catch (Exception $e) {
            Log::error($e->getMessage());
        }
    }

    public function runSql()
    {
        Eloquent::unguard();

        // 导入菜单权限及系统配置
        $path = base_path('data/backend.sql'); // sql文件路径
        DB::unprepared(file_get_contents($path));
    }

    /**
     * 执行填充-seed
     */
    public function runSeed()
    {
        // 如： Artisan::call('UserTableSeeder');
    }

    // public function cart()
    // {
    //     $table_name = 'cart';
    //     if (!Schema::hasTable($table_name)) {
    //         return false;
    //     }

    //     if (!Schema::hasColumn($table_name, 'goods_favourable')) {
    //         Schema::table($table_name, function (Blueprint $table) {
    //             $table->decimal('goods_favourable', 10, 2)->default(0)->comment('优惠活动均摊金额');
    //         });
    //     }
    // }


    /**
     * 更新版本
     *
     * @throws Exception
     */
    private function systemConfig()
    {
//        sysconf('lrw_version', 'v4.0.0');

        $this->clearCache();
    }

    /**
     * @throws Exception
     */
    private function clearCache()
    {
        cache()->flush();
    }
}