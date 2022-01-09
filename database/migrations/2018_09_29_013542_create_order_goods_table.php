<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderGoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('order_goods', function (Blueprint $table) {
            $table->increments('record_id');
            $table->integer('order_id', false, true)->default(0)->comment('订单id');
            $table->integer('goods_id', false, true)->default(0)->comment('商品id');
            $table->integer('sku_id', false, true)->default(0)->comment('商品id');
            $table->text('spec_info')->nullable()->comment('商品规格 如：重量：kg|尺码：XS');
            $table->string('goods_name')->nullable()->comment('商品名称');
            $table->string('goods_sn', 60)->nullable()->comment('商品sn');
            $table->string('sku_sn', 60)->nullable()->comment('sku sn 相当于 商品sn');
            $table->string('goods_image')->nullable()->comment('商品图片');
            $table->decimal('goods_price', 10, 2)->default(0.00)->comment('商品价格');
            $table->unsignedInteger('goods_points')->default(0)->comment('商品积分');
            $table->decimal('distrib_price', 10, 2)->default(0.00)->comment('分销价格');
            $table->unsignedInteger('goods_number')->default(0)->comment('购买商品数量');
            $table->decimal('other_price', 10, 2)->default(0.00)->comment('其他价格（包括：full_cut_amount gift point bonus）');
            $table->decimal('pay_change', 10, 2)->default(0.00)->comment('卖家优惠价格 如：-100.00');
            $table->unsignedInteger('parent_id')->default(0)->comment('parent id');
            $table->boolean('is_gift')->default(false)->comment('是否礼物商品 默认0');
            $table->boolean('is_evaluate')->default(false)->comment('是否评价 默认0');
            $table->unsignedInteger('goods_status')->default(0)->comment('商品状态 0-无状态 1-仅退款 2-退款退货 3-换货 4-申请维修 5-线下业务');
            $table->unsignedInteger('give_integral')->default(0)->comment('give integral');
            $table->unsignedInteger('stock_mode')->default(0)->comment('库存计数 默认0 0拍下减库存 1付款减库存 2出库减库存');
            $table->boolean('stock_dropped')->default(false)->comment('库存是否已减 默认0 0未减库存 1已减库存');
            $table->unsignedInteger('act_type')->default(0)->comment('活动类型 默认0 0无活动 1-拍卖 2-预售 3-团购 5-积分兑换 6-拼团 8-砍价 10-搭配套餐 11-限时折扣 12-满减送 13-赠品活动');
            $table->unsignedInteger('goods_type')->default(0)->comment('商品交易类型 0-普通商品 1-拍卖 2-预售 3-团购 5-积分兑换 6-拼团 8-砍价 10-搭配套餐 11-限时折扣 12-满减送 13-赠品活动 99-电子秤商品');
            $table->boolean('is_distrib')->default(false)->comment('是否分销商品 默认0');
            $table->decimal('discount', 10, 2)->default(0.00)->comment('折扣价格');
            $table->decimal('profits', 10, 2)->default(0.00)->comment('利润价格');
            $table->decimal('distrib_money', 10, 2)->default(0.00)->comment('分销价格');
            $table->unsignedInteger('goods_mode')->default(0)->comment('商品类别 默认0 0实物商品（物流发货） 1电子卡券（无需物流） 2服务商品（无需物流）');
            $table->unsignedInteger('shop_id')->default(0)->comment('店铺id');
            $table->string('contract_ids')->nullable()->comment('保障服务ids 多个以逗号分隔 如：1,2');
            $table->decimal('market_price', 10, 2)->default(0.00)->comment('商品市场价');
            $table->string('sku_image')->nullable()->comment('商品SKU图片 相当于商品图片');
            $table->unsignedInteger('back_id')->default(0)->comment('退款退货或换货维修id');
            $table->unsignedTinyInteger('back_status')->default(0)->comment('退款退货或换货维修状态');
            $table->unsignedInteger('back_number')->default(0)->comment('退款退货或换货维修数量');
            $table->unsignedInteger('send_number')->default(0)->comment('退款退货或换货维修已发货数量');
            $table->decimal('send_number_money', 10, 2)->default(0.00)->comment('退款退货或换货维修已发货金额');
            $table->decimal('all_number_money', 10, 2)->default(0.00)->comment('退款退货或换货维修所有金额');



            // 索引
            /**
             * 以下后期优化设置
             * KEY `goods_id` (`goods_id`),
            KEY `order_id` (`order_id`),
            KEY `ru_id` (`ru_id`),
            KEY `freight` (`freight`),
            KEY `tid` (`tid`),
            KEY `stages_qishu` (`stages_qishu`),
            KEY `user_id` (`user_id`),
            KEY `product_id` (`product_id`),
            KEY `is_real` (`is_real`),
            KEY `warehouse_id` (`warehouse_id`),
            KEY `area_id` (`area_id`),
            KEY `is_gift` (`is_gift`)
             */
            $table->timestamps();
        });

        DB::statement("ALTER TABLE `order_goods` comment '订单商品表'"); // 表注释
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_goods');
    }
}
