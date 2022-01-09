<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoodsSkusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('goods_sku', function (Blueprint $table) {
            $table->increments('sku_id');
            $table->unsignedInteger('goods_id')->comment('商品SPU id');
            $table->string('sku_name')->nullable()->comment('商品SKU名称');
            $table->string('sku_image')->nullable()->comment('商品SKU图片');
            $table->text('sku_images')->nullable()->comment('商品SKU相册图片 序列化存储');
            $table->string('spec_ids')->nullable()->comment('商品规格表主键id spec_id 多个以"|"分隔 格式：12|21|32');
            $table->string('spec_vids')->nullable()->comment('商品规格表规格值id attr_vid 多个以"|"分隔 格式：232|332|224');
            $table->string('spec_names')->nullable()->comment('商品规格表规格值名称键值对 attr_name:attr_value 多个以"|"分隔 格式：网络:4G|内存:32G|颜色:金色');
            $table->decimal('goods_price', 10, 2)->default('0.00')->comment('店铺价');
            $table->decimal('mobile_price', 10, 2)->default('0.00')->comment('手机端价格');
            $table->decimal('market_price', 10, 2)->default('0.00')->comment('市场价');
            $table->unsignedInteger('goods_number')->default(0)->comment('商品库存');
            $table->unsignedInteger('sku_number_version')->default(0)->comment('商品SKU库存数量版本号 默认0');
            $table->char('goods_sn', 60)->nullable()->comment('商品货号');
            $table->longText('goods_barcode')->nullable()->comment('商品条形码 支持一品多码，多个条形码之间用逗号分隔');
            $table->unsignedInteger('warn_number')->default(0)->comment('库存警告数量');
            $table->string('goods_stockcode')->nullable()->comment('商品库位码');
            $table->string('goods_weight')->nullable()->comment('物流重量(Kg)');
            $table->string('goods_volume')->nullable()->comment('物流体积(m3)');
            $table->longText('pc_desc')->nullable()->comment('商品电脑端描述');
            $table->longText('mobile_desc')->nullable()->comment('商品手机端描述');
            $table->boolean('is_spu')->default(true)->comment('是否SPU 默认1');
            $table->boolean('is_enable')->default(true)->comment('是否可用 默认1');

            $table->timestamps();
        });

        DB::statement("ALTER TABLE `goods_sku` comment '商品SKU表'"); // 表注释
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('goods_sku');
    }
}
