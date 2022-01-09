<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSheetConfigsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sheet_config', function (Blueprint $table) {
            $table->increments('sheet_config_id');
            $table->char('shipping_code',20)->comment('系统物流代码');
            $table->string('customer_name')->nullable()->comment('商家ID');
            $table->string('customer_pwd')->nullable()->comment('商家接口密码');
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
        Schema::dropIfExists('sheet_config');
    }
}
