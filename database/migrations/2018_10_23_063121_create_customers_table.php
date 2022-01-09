<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer', function (Blueprint $table) {
            $table->increments('customer_id');
            $table->integer('shop_id', false, true)->comment('店铺id');
            $table->integer('type_id', false, true)->comment('客服类型id');
            $table->string('customer_name')->comment('客服名称');
            $table->tinyInteger('customer_tool', false, true)->default(0)->comment('客服工具 默认0 1QQ 2旺旺');
            $table->string('customer_account', 50)->comment('客服账号');
            $table->boolean('is_main')->default(false)->comment('是否主客服');
            $table->boolean('is_show')->default(true)->comment('是否显示');
            $table->integer('customer_sort', false, true)->default(255)->comment('排序');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customer');
    }
}
