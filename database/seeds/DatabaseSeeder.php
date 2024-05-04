<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (!Storage::disk('local')->exists('seeder/install.lock')) {
            $this->call([
                InstallSeeder::class, // 安装配置数据
            ]);
        }
    }
}
