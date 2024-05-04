<?php

namespace App\Patch;

use Exception;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;

class Migration_v1_0_0
{
    public function run()
    {
        try {

            // 其他对数据库表的操作 - 新增表、字段、原有数据更新操作等
            // $this->cart();

            $this->systemConfig();
        } catch (Exception $e) {
            Log::error($e->getMessage());
        }
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
        sysconf('lrw_version', 'v1.0.0');

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