<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_type', function (Blueprint $table) {
            $table->increments('type_id');
            $table->integer('shop_id', false, true)->comment('店铺id');
            $table->string('type_name', 10)->comment('客服类型名称');
            $table->string('type_desc', 40)->nullable()->comment('客服类型描述');
            $table->boolean('is_show')->default(true)->comment('是否显示');
            $table->integer('type_sort', false, true)->default(255)->comment('排序');
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
        Schema::dropIfExists('customer_type');
    }
}
