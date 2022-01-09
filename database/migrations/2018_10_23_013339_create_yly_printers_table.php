<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateYlyPrintersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('yly_printer', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('shop_id', false, true)->comment('店铺id');
            $table->string('machine_code', 16)->comment('打印机终端号');
            $table->string('msign', 64)->comment('打印机密钥');
            $table->string('print_name', 16)->comment('打印机名称');
            $table->string('phone', 16)->nullable()->comment('手机号');
            $table->boolean('is_default')->defualt(false)->comment('是否默认');
            $table->timestamps();
        });

        DB::statement("ALTER TABLE `yly_printer` comment '易联云打印机表'"); // 表注释
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('yly_printer');
    }
}
