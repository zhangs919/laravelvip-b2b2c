<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBackOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('back_order', function (Blueprint $table) {
            $table->increments('back_id');
            $table->char('back_sn', 20)->nullable()->comment('Back sn');
            $table->unsignedTinyInteger('back_type')->default(0)->comment('业务类型 0-无状态 1-退款 2-退款退货 3-换货 4-申请维修 5-线下业务');
            $table->unsignedInteger('site_id')->default(0)->comment('站点id');
            $table->unsignedInteger('shop_id')->default(0)->comment('店铺id');
            $table->unsignedInteger('user_id')->default(0)->comment('买家id');
            $table->unsignedInteger('order_id')->default(0)->comment('订单id');
            $table->unsignedInteger('delivery_id')->default(0)->comment('发货单id');
            $table->unsignedInteger('record_id')->default(0)->comment('订单商品记录编号');
            $table->unsignedInteger('goods_id')->default(0)->comment('商品id');
            $table->unsignedInteger('sku_id')->default(0)->comment('商品SKU ID');
            $table->unsignedInteger('back_number')->default(0)->comment('退换商品数量');
            $table->unsignedInteger('add_time')->default(0)->comment('添加时间');
            $table->unsignedInteger('last_time')->default(0)->comment('买家最后修改时间');
            $table->unsignedInteger('dismiss_time')->default(0)->comment('Dismiss Time');
            $table->unsignedInteger('disabled_time')->default(0)->comment('Disabled Time');
            $table->unsignedTinyInteger('back_status')->default(0)->comment('退换货单状态 0-待处理 1-同意申请 2-货物已发出 3-货物已收到 4-处理完成 5-被驳回 6-已失效 7-已撤销');
            $table->unsignedInteger('back_reason')->default(0)->comment('退换货原因 1-退款不退货 2-退款退货 3-换货 4-申请维修 5-下线业务');
            $table->decimal('refund_money', 10, 2)->default('0.00')->comment('退款金额');
            $table->unsignedTinyInteger('refund_type')->default(0)->comment('退款方式 默认0 0退回账户余额 1退回原支付方式');
            $table->unsignedTinyInteger('refund_status')->default(0)->comment('Refund status 默认0');
            $table->string('back_desc')->nullable()->comment('退换货说明');
            $table->string('back_img1')->nullable()->comment('Back Img1');
            $table->string('back_img2')->nullable()->comment('Back Img2');
            $table->string('back_img3')->nullable()->comment('Back Img3');
            $table->unsignedInteger('send_time')->default(0)->comment('Send Time');
            $table->unsignedInteger('shipping_id')->default(0)->comment('买家寄出商品物流公司ID');
            $table->string('shipping_code')->nullable()->comment('买家寄出商品物流公司代码');
            $table->string('shipping_name')->nullable()->comment('买家寄出商品物流公司名称');
            $table->string('shipping_sn')->nullable()->comment('买家寄出商品物流单号');
            $table->unsignedInteger('seller_reason')->default(0)->comment('Seller Reason');
            $table->string('seller_desc')->nullable()->comment('退货说明');
            $table->string('seller_img1')->nullable()->comment('Seller Img1');
            $table->string('seller_img2')->nullable()->comment('Seller Img2');
            $table->string('seller_img3')->nullable()->comment('Seller Img3');
            $table->unsignedInteger('seller_address')->default(0)->comment('卖家收货地址');
            $table->unsignedInteger('reminder_times')->default(0)->comment('Reminder Times');
            $table->string('exchange_reason')->nullable()->comment('申请换货的原因');
            $table->string('repair_reason')->nullable()->comment('申请维修的原因');
            $table->unsignedInteger('user_address')->default(0)->comment('买家收货地址');
            $table->string('exchange_desc')->nullable()->comment('换货说明');
            $table->string('repair_desc')->nullable()->comment('维修说明');
            $table->boolean('is_after_sale')->default(false)->comment('是否售后 默认0 0售前 1售后');
            $table->unsignedInteger('update_time')->default(0)->comment('更新时间');


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
        Schema::dropIfExists('back_order');
    }
}
