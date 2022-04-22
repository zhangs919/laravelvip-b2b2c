<?php

use Illuminate\Database\Seeder;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
//        factory('App\Models\Admin', 3)->create([
//            'password' => bcrypt('123456')
//        ]);

        /*Eloquent::unguard();

        $this->call('AdminsTableSeeder');
        $this->command->info('Admin table seeded!');

        $path = '/docs/admin.sql'; // sql 文件路径
        DB::unprepared(file_get_contents($path));
        $this->command->info('Admin table seeded!');*/
    }
}
