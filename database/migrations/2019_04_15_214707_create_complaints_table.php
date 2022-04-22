<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComplaintsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('complaint', function (Blueprint $table) {
            $table->increments('complaint_id');
            $table->string('complaint_sn')->nullable()->comment('投诉编号');
            $table->unsignedInteger('order_id')->default(0)->comment('投诉的订单ID');
            $table->unsignedInteger('goods_id')->default(0)->comment('投诉的商品ID');
            $table->unsignedInteger('sku_id')->default(0)->comment('投诉的商品Sku ID');
            $table->unsignedInteger('shop_id')->default(0)->comment('投诉的店铺ID');
            $table->unsignedInteger('user_id')->default(0)->comment('投诉的用户ID');
            $table->unsignedInteger('parent_id')->default(0)->comment('上级投诉ID');
            $table->unsignedTinyInteger('role_type')->default(0)->comment('角色类型 0-买家 1-卖家 2-平台');
            $table->unsignedInteger('complaint_type')->default(0)->comment('投诉原因');
            $table->string('complaint_mobile')->nullable()->comment('联系电话');
            $table->text('complaint_images')->nullable()->comment('上传投诉凭证图片');
            $table->text('complaint_desc')->nullable()->comment('投诉说明');
            $table->unsignedInteger('complaint_status')->default(0)->comment('投诉处理状态 0- 等待卖家处理  1 - 卖家已回复  2-买家撤销投诉 3 - 平台方介入 4-平台方仲裁中  5- 仲裁成功  6-仲裁失败');
            $table->unsignedInteger('add_time')->default(0)->comment('创建时间');
            $table->unsignedInteger('close_time')->default(0)->comment('关闭时间');
            $table->unsignedInteger('deduct_credit')->default(0)->comment('店铺扣分');
            $table->decimal('deduct_money',10,2)->default('0.00')->comment('店铺罚款');

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
        Schema::dropIfExists('complaint');
    }
}
