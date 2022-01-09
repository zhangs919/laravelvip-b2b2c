<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIntegralOrderGoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('integral_order_goods', function (Blueprint $table) {
            $table->increments('record_id');
            $table->unsignedInteger('order_id')->default(0)->comment('订单id');
            $table->unsignedInteger('goods_id')->default(0)->comment('积分商品id');
            $table->string('goods_name')->nullable()->comment('积分商品名称');
            $table->string('goods_image')->nullable()->comment('积分商品图片');
            $table->decimal('goods_price', 10, 2)->default(0.00)->comment('商品价格');
            $table->unsignedInteger('goods_points')->default(0)->comment('商品积分');
            $table->unsignedInteger('goods_number')->default(0)->comment('购买商品数量');
            $table->boolean('stock_dropped')->default(false)->comment('库存是否已减 默认0 0未减库存 1已减库存');
            $table->string('goods_contracts')->nullable()->comment('');
            $table->boolean('is_delete')->default(false)->comment('是否删除 默认0');
            $table->unsignedTinyInteger('order_status')->default(0)->comment('订单状态 默认0 ');
            $table->unsignedInteger('goods_integral')->default(0)->comment('所需积分');
            $table->unsignedInteger('goods_stock')->default(0)->comment('商品库存');
            $table->timestamps();
        });

        DB::statement("ALTER TABLE `integral_order_goods` comment '积分兑换订单商品表'"); // 表注释
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('integral_order_goods');
    }
}
