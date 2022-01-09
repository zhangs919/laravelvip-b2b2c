<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIntegralGoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('integral_goods', function (Blueprint $table) {
            $table->increments('goods_id');
            $table->unsignedInteger('shop_id')->default(0)->comment('店铺id 当平台开启店铺积分商城时才有值');
            $table->string('goods_name')->comment('商品名称');
            $table->decimal('goods_price', 10, 2)->default('0.00')->comment('商品价格');
            $table->decimal('market_price', 10, 2)->default('0.00')->comment('市场价格（组合价格）');
            $table->unsignedInteger('goods_integral')->comment('所需积分');
            $table->unsignedInteger('goods_number')->default(0)->comment('可兑换商品库存');
            $table->unsignedInteger('exchange_number')->default(0)->comment('已兑换量');
            $table->unsignedTinyInteger('goods_status')->default(1)->comment('商品状态 默认1 1出售中 0已下架');
            $table->boolean('is_limit')->default(false)->comment('限制兑换时间 默认0 1限制 0不限制');
            $table->date('start_time')->nullable()->comment('开始时间');
            $table->date('end_time')->nullable()->comment('结束时间');
            $table->string('goods_image')->nullable()->comment('商品图片 取商品图片的第一张');
            $table->longText('goods_images')->nullable()->comment('商品图片 多个图片以“丨”分隔');
            $table->longText('pc_desc')->nullable()->comment('商品电脑端描述');
            $table->longText('mobile_desc')->nullable()->comment('商品手机端描述');
            $table->unsignedInteger('goods_sort')->default(255)->comment('商品排序');
            $table->string('goods_video')->nullable()->comment('商品视频');

            $table->timestamps();
        });

        DB::statement("ALTER TABLE `integral_goods` comment '积分兑换商品表'");

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('integral_goods');
    }
}
