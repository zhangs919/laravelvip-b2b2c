<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrintSpecsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('print_spec', function (Blueprint $table) {
            $table->increments('id');
            // 'shop_id', 'printer', 'print_spec', 'is_default'
            $table->integer('shop_id', false, true)->default(0)->comment('店铺id');
            $table->string('printer')->comment('打印机名称');
            $table->string('print_spec')->comment('打印机规格');
            $table->boolean('is_default')->default(false)->comment('是否默认打印机 默认0');
            $table->timestamps();
        });

        DB::statement("ALTER TABLE `print_spec` comment '打印规格表'"); // 表注释
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('print_spec');
    }
}
