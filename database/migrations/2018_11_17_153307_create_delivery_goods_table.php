<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeliveryGoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('delivery_goods', function (Blueprint $table) {
            //'id','goods_id','sku_id','send_number','delivery_id','delivery_sn','order_id','user_id','shipping_id','shipping_code',
            //'shipping_name','shipping_type','sender_id','region_code','name','address','tel','express_sn','delivery_status','add_time',
            //'send_time','icode','is_show','is_arrived','exception_reason','record_id','goods_number','goods_image','goods_name',
            //'goods_barcode','spec_info','goods_price','other_price','pay_change','goods_status','is_gift','goods_type','act_type',
            //'contract_ids','goods_points','shop_id','back_id','back_status',
            $table->increments('id');
            $table->unsignedInteger('order_id')->default(0)->comment('订单id');
            $table->unsignedInteger('delivery_id')->default(0)->comment('发货单id');
            $table->unsignedInteger('goods_id')->default(0)->comment('商品id');
            $table->unsignedInteger('sku_id')->default(0)->comment('商品SKU id');
            $table->unsignedInteger('send_number')->default(0)->comment('发货数量');
            $table->boolean('is_gift')->default(false)->comment('是否为赠品 0-否 1-是');
            $table->unsignedInteger('parent_id')->default(0)->comment('所属商品ID');


            /*以下字段从发货单表（delivery_order）读取*/
            /*$table->string('delivery_sn')->nullable()->comment('发货单sn');
            $table->unsignedInteger('order_id')->default(0)->comment('订单id');
            $table->unsignedInteger('user_id')->default(0)->comment('买家id');
            $table->unsignedInteger('shipping_id')->default(0)->comment('物流公司id');
            $table->string('shipping_code')->nullable()->comment('物流公司代号');
            $table->string('shipping_name')->nullable()->comment('物流公司名称');
            $table->unsignedTinyInteger('shipping_type')->default(0)->comment('默认0 0指配派送 1指配派送 2物流众包 3第三方物流 4达达物流');
            $table->unsignedInteger('sender_id')->default(0)->comment('发货店铺id');
            $table->string('region_code')->nullable()->comment('发货地址code');
            $table->string('name')->nullable()->comment('发货人名称');
            $table->string('tel')->nullable()->comment('发货人联系方式');
            $table->string('express_sn')->nullable()->comment('物流编号');
            $table->unsignedTinyInteger('delivery_status')->default(0)->comment('发货单状态 默认0 0待发货 1已发货');
            $table->unsignedInteger('add_time')->default(0)->comment('发货单添加时间');
            $table->unsignedInteger('send_time')->default(0)->comment('发货时间');
            $table->string('icode')->nullable()->comment('icode');
            $table->string('is_show')->nullable()->comment('是否显示 如："1,2,3,4"');
            $table->boolean('is_arrived')->default(false)->comment('is arrived 默认0');
            $table->string('exception_reason')->nullable()->comment('异常原因');*/
            /*以上字段从发货单表（delivery_order）读取*/


            $table->unsignedInteger('record_id')->default(0)->comment('订单商品表主键id');

            // todo 以下信息是否可以直接从订单商品表读取？？
            /*$table->unsignedInteger('goods_number')->default(0)->comment('商品数量');
            $table->string('goods_image')->nullable()->comment('商品图片');
            $table->string('goods_name')->nullable()->comment('商品名称');
            $table->longText('goods_barcode')->nullable()->comment('商品条形码 支持一品多码，多个条形码之间用逗号分隔');
            $table->text('spec_info')->nullable()->comment('商品规格 如：重量：kg|尺码：XS');
            $table->decimal('goods_price', 10, 2)->default(0.00)->comment('商品价格');
            $table->decimal('other_price', 10, 2)->default(0.00)->comment('其他价格（包括：full_cut_amount gift point bonus）');
            $table->decimal('pay_change', 10, 2)->default(0.00)->comment('卖家优惠价格 如：-100.00');
            $table->unsignedInteger('goods_status')->default(0)->comment('商品状态');
            $table->boolean('is_gift')->default(false)->comment('是否礼物商品 默认0');
            $table->unsignedInteger('goods_type')->default(0)->comment('商品类型 默认0 0常规商品 11满减送商品 其他商品类型id待定');
            $table->unsignedInteger('act_type')->default(0)->comment('活动类型 默认0 0无活动 12满减送 其他活动类型id待定');
            $table->string('contract_ids')->nullable()->comment('保障服务ids 多个以逗号分隔 如：1,2');
            $table->unsignedInteger('goods_points')->default(0)->comment('商品积分');
            $table->unsignedInteger('shop_id')->default(0)->comment('店铺id');
            $table->unsignedInteger('back_id')->default(0)->comment('退款退货或换货维修id');
            $table->unsignedTinyInteger('back_status')->default(0)->comment('退款退货或换货维修状态');*/

            $table->timestamps();
        });

        DB::statement("ALTER TABLE `delivery_goods` comment '发货单商品表'"); // 表注释

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('delivery_goods');
    }
}
