<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cart', function (Blueprint $table) {
            $table->increments('cart_id');

            $table->unsignedInteger('user_id')->comment('会员id');
            $table->char('session_id',128)->comment('session');
            $table->unsignedInteger('shop_id')->comment('店铺id');
            $table->unsignedInteger('goods_id')->comment('商品id');
            $table->unsignedInteger('sku_id')->comment('商品id');
            $table->unsignedInteger('cart_act_id')->default(0)->comment('商品活动id 默认0 无活动');
            $table->char('goods_name')->comment('商品名称');
            $table->unsignedInteger('goods_number')->comment('购买数量');
            $table->decimal('goods_price',11,2)->default('0.00')->comment('本店价');
            $table->unsignedInteger('goods_type')->default(0)->comment('');
            $table->unsignedInteger('parent_id')->default(0)->comment('');
            $table->boolean('is_gift')->default(false)->comment('是否赠品');
            $table->unsignedInteger('buyer_type')->default(0)->comment('买家类型 0-个人 1-店铺');
            $table->unsignedInteger('add_time')->default(0)->comment('添加时间');


//            $table->char('goods_sn')->nullable()->comment('商品货号');
//            $table->decimal('market_price',11,2)->default('0.00')->comment('市场价');
//            $table->decimal('member_goods_price',11,2)->default('0.00')->comment('会员折扣价');
//            $table->char('spec_key')->nullable()->comment('商品规格key 对应goods_sku key');
//            $table->char('spec_key_name')->nullable()->comment('商品规格组合名称 对应goods_sku key_name');
//            $table->longText('goods_barcode')->nullable()->comment('商品条形码 支持一品多码，多个条形码之间用逗号分隔');
//            $table->tinyInteger('selected',false,true)->default(1)->comment('购物车选中状态');
//            $table->tinyInteger('prom_type',false,true)->default(0)->comment('0普通订单 1限时抢购 2团购 3促销优惠');
//            $table->integer('prom_id',false,true)->default(0)->comment('活动id');
//            $table->string('sku')->nullable()->comment('sku');// 不确定这个字段是否有用

            // 索引
            $table->index('session_id', 'session_id');
            $table->index('user_id', 'user_id');
            $table->index('goods_id', 'goods_id');
//            $table->index('spec_key', 'spec_key');
            $table->timestamps();
        });

        DB::statement("ALTER TABLE `cart` comment '购物车表'"); // 表注释

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cart');
    }
}
