<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserBonusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_bonus', function (Blueprint $table) {
            $table->increments('user_bonus_id');
            $table->unsignedInteger('user_id')->default(0)->comment('会员id');
            $table->unsignedInteger('bonus_id')->default(0)->comment('红包id');
            $table->string('bonus_sn')->nullable()->comment('红包sn');
            $table->decimal('bonus_price',10,2)->default(0.00)->comment('红包金额');
            $table->text('bonus_data')->nullable()->comment('红包扩展数据 序列化存储');
            $table->unsignedInteger('receive_time')->default(0)->comment('红包领取时间');
            $table->unsignedInteger('used_time')->default(0)->comment('红包使用时间');
            $table->unsignedInteger('start_time')->default(0)->comment('红包发放起始时间');
            $table->unsignedInteger('end_time')->default(0)->comment('红包发放截至时间');
            $table->unsignedInteger('add_time')->default(0)->comment('红包添加时间');
            $table->string('order_sn')->nullable()->comment('订单sn');
            $table->unsignedTinyInteger('bonus_status')->default(0)->comment('红包状态 默认0 0-正常 1-已使用 2-已失效');
            $table->boolean('is_delete')->default(false)->comment('是否删除 0-未删除 1-已删除');
            $table->unsignedInteger('sales_id')->default(0)->comment('sales id');
            $table->string('user_name')->nullable()->comment('会员名');
            $table->unsignedInteger('shop_id')->default(0)->comment('店铺id');
            $table->unsignedTinyInteger('bonus_type')->default(0)->comment('红包类型 默认0 1-主动领红包/到店送红包 2-收藏送红包 4-会员送红包 6-注册送红包 9-推荐送红包 10-积分兑换红包');
            $table->unsignedTinyInteger('use_range')->default(0)->comment('使用范围 默认0 0-全部商品 1-指定商品');
            $table->text('bonus_datas')->nullable()->comment('红包扩展数据 序列化存储');
            $table->decimal('min_goods_amount',10,2)->default(0.00)->comment('最小订单金额限制');
            $table->boolean('is_original_price')->default(true)->comment('仅限原价购买时使用 0-可与其他优惠、活动一起使用 1-仅限原价购买时使用');
            $table->unsignedInteger('order_id')->default(0)->comment('订单id');
            $table->string('goods_ids')->nullable()->comment('红包商品ids 多个以逗号分隔');

            $table->timestamps();
        });

        DB::statement("ALTER TABLE `user_bonus` comment '会员红包表'"); // 表注释

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_bonus');
    }
}
