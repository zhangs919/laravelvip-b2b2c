<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeliveryOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('delivery_order', function (Blueprint $table) {
            $table->increments('delivery_id');
            $table->string('delivery_sn')->nullable()->comment('发货单sn');
            $table->unsignedInteger('order_id')->default(0)->comment('订单id');
            $table->unsignedInteger('user_id')->default(0)->comment('买家id');
            $table->unsignedInteger('shipping_id')->default(0)->comment('物流公司id');
            $table->string('shipping_code')->nullable()->comment('物流公司代号');
            $table->string('shipping_name')->nullable()->comment('物流公司名称');
            $table->unsignedTinyInteger('shipping_type')->default(0)->comment('新配送方式 0 无需物流 1 指派 2 众包 3 第三方物流');
            $table->unsignedInteger('sender_id')->default(0)->comment('发货店铺id');
            $table->string('region_code')->nullable()->comment('发货地址code');
            $table->string('name')->nullable()->comment('发货人名称');
            $table->string('tel')->nullable()->comment('发货人联系方式');
            $table->string('express_sn')->nullable()->comment('物流编号');
            $table->unsignedTinyInteger('delivery_status')->default(0)->comment('发货单状态 0-待发货 1-已发货 2-发货中 3-已提交物流系统');
            $table->unsignedInteger('add_time')->default(0)->comment('发货单添加时间');
            $table->unsignedInteger('send_time')->default(0)->comment('发货时间');
            $table->string('icode')->nullable()->comment('icode');
            $table->string('is_show')->nullable()->comment('是否显示 如："1,2,3,4"');
            $table->boolean('is_arrived')->default(false)->comment('is arrived 默认0');
            $table->string('exception_reason')->nullable()->comment('异常原因');

            $table->timestamps();
        });

        DB::statement("ALTER TABLE `delivery_order` comment '发货单订单表'"); // 表注释

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('delivery_order');
    }
}
