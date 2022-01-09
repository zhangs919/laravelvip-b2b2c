<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCollectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('collect', function (Blueprint $table) {
            $table->increments('collect_id');
            $table->unsignedInteger('user_id')->default(0)->comment('会员id');
            $table->unsignedTinyInteger('collect_type')->default(0)->comment('收藏类型 默认0 0商品收藏 1店铺收藏 2品牌收藏');
            $table->unsignedInteger('goods_id')->default(0)->comment('商品id');
            $table->unsignedInteger('sku_id')->default(0)->comment('商品SKU id');
            $table->string('goods_name')->comment('商品名称');
            $table->decimal('collect_price',10,2)->default('0.00')->comment('收藏商品价格');
            $table->boolean('is_buyed')->default(false)->comment('是否购买过');
            $table->unsignedInteger('shop_id')->default(0)->comment('店铺id');
            $table->unsignedInteger('add_time')->default(0)->comment('收藏时间');
            $table->unsignedTinyInteger('collect_from')->default(1)->comment('收藏来源 1PC端 2微信端 3Android端 4IOS端');

            $table->timestamps();
        });

        DB::statement("ALTER TABLE `collect` comment '商品或店铺收藏表'"); // 表注释
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('collect');
    }
}
