<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment', function (Blueprint $table) {
            $table->increments('pay_id');
            $table->string('pay_code', 20)->comment('支付方式代码');
            $table->string('pay_name')->comment('支付方式名称');
            $table->string('pay_desc')->comment('支付方式说明');
            $table->integer('pay_sort')->default('255')->comment('排序');
            $table->text('pay_config')->nullable()->comment('支付方式配置');
            $table->boolean('is_enable')->default(false)->comment('是否启用');
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
        Schema::dropIfExists('payment');
    }
}
