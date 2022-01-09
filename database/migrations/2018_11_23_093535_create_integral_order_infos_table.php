<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIntegralOrderInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('integral_order_info', function (Blueprint $table) {
            $table->increments('order_id');
            // 'order_sn','user_id','order_status','site_id','shop_id','pickup_id','shipping_status','pay_status','consignee',
            //        'region_code','region_name','address','address_lng','address_lat','receiving_mode','tel','email','postscript','best_time',
            //        'shipping_fee','order_from','add_time','shipping_time','confirm_time','delay_days','order_type','service_mark','send_mark',
            //        'shipping_mark','buyer_type','end_time','is_show','is_delete','close_reason','order_cancel','refuse_reason','order_points',
            //        'remark','last_time','shipping_id','express_sn','buy_type','user_name','shop_name','shop_type','customer_tool','customer_account',
            //<option value="unshipped">待发货</option>
            //                                        <option value="shipped">已发货</option>
            //                                        <option value="finished">交易成功</option>

            $table->string('order_sn', 60)->default('')->comment('订单号');
            $table->unsignedInteger('user_id')->default(0)->comment('买家id');
            $table->unsignedTinyInteger('order_status')->default(0)
                ->comment('订单状态 默认0 0shipped发货中 1finished交易成功');
            $table->unsignedInteger('site_id')->default(0)->comment('站点id');
            $table->unsignedInteger('shop_id')->default(0)->comment('店铺id');
            $table->unsignedInteger('pickup_id')->default(0)->comment('自提点id');
            $table->unsignedTinyInteger('shipping_status')->default(0)->comment('物流状态 ');
            $table->unsignedTinyInteger('pay_status')->default(0)->comment('支付状态 ');
            $table->string('consignee')->default('')->comment('收货人姓名');
            $table->string('region_code')->nullable()->comment('收货地址');
            $table->string('region_name')->nullable()->comment('收货人地址region_name');
            $table->string('address')->default('')->comment('收货人详细地址');
            $table->string('address_lng')->comment('地图定位 经度');
            $table->string('address_lat')->comment('地图定位 纬度');
            $table->unsignedTinyInteger('receiving_mode')->default(0)->comment('收货方式 默认0');
            $table->string('tel', 60)->nullable()->comment('收货人联系方式');
            $table->string('email', 60)->nullable()->comment('收货人邮箱');
            $table->string('postscript')->nullable()->comment('买家留言');
            $table->string('best_time')->nullable()->comment('最佳送货时间 默认空 可选：工作日/周末/假日均可');
            $table->decimal('shipping_fee', 10, 2)->default(0.00)->comment('配送总费用');
            $table->unsignedInteger('order_from')->default(1)->comment('订单来源 默认1 1PC端 2WAP端 ...');
            $table->unsignedInteger('add_time')->default(0)->comment('订单添加时间 默认0');
            $table->unsignedInteger('shipping_time')->default(0)->comment('发货时间 默认0');
            $table->unsignedInteger('confirm_time')->default(0)->comment('确认收货时间 默认0');
            $table->unsignedInteger('delay_days')->default(0)->comment('延迟收货天数 默认0 0正常收货');
            $table->unsignedInteger('order_type')->default(0)->comment('交易类型 默认0');
            $table->unsignedInteger('service_mark')->default(0)->comment('服务态度 默认0');
            $table->unsignedInteger('send_mark')->default(0)->comment('发货速度 默认0');
            $table->unsignedInteger('shipping_mark')->default(0)->comment('物流速度 默认0');
            $table->unsignedInteger('buyer_type')->default(0)->comment('买家类型 默认0');
            $table->unsignedInteger('end_time')->default(0)->comment('订单终止时间 默认0');
            $table->string('is_show')->nullable()->comment('是否显示 如："1,2,3,4"');
            $table->boolean('is_delete')->default(false)->comment('是否删除 默认0');
            $table->string('close_reason')->nullable()->comment('订单关闭原因');
            $table->unsignedTinyInteger('order_cancel')->default(0)->comment('用户提交取消申请状态 默认0 无取消申请 1等待商家审核 2商家审核通过 3商家拒绝通过');
            $table->string('refuse_reason')->nullable()->comment('商家拒绝取消订单申请理由 默认空');
            $table->unsignedInteger('order_points')->default(0)->comment('订单积分 默认0');
            $table->longText('remark')->nullable()->comment('备注 序列化存储');
            $table->unsignedInteger('last_time')->default(0)->comment('订单最后修改时间 默认0');
            $table->text('shipping_id')->comment('物流id');
            $table->string('express_sn')->nullable()->comment('物流单号');
            $table->unsignedTinyInteger('buy_type')->default(0)->comment('buy_type 默认0 ');
            $table->char('user_name', 60)->default('')->comment('会员名');
            $table->string('shop_name')->nullable()->comment('店铺名称');
            $table->unsignedTinyInteger('shop_type')->default(0)->comment('店铺类型 默认0 0自营店铺 1个人店铺 2企业店铺');
            $table->unsignedTinyInteger('customer_tool')->default(0)->comment('客服工具 默认0 0无客服 1QQ 2旺旺');
            $table->string('customer_account')->nullable()->comment('客服账号 默认空 QQ号码或旺旺号码');

            $table->timestamps();
        });

        DB::statement("ALTER TABLE `integral_order_info` comment '积分兑换订单表'"); // 表注释
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('integral_order_info');
    }
}
