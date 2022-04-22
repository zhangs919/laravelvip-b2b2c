<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBonusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bonus', function (Blueprint $table) {
            $table->increments('bonus_id');
            $table->unsignedInteger('shop_id')->default(0)->comment('店铺id');
            $table->unsignedTinyInteger('bonus_type')->default(0)->comment('红包类型 默认0 1-主动领红包/到店送红包 2-收藏送红包 4-会员送红包 6-注册送红包 9-推荐送红包 10-积分兑换红包');
            $table->string('bonus_name')->comment('红包名称');
            $table->string('bonus_desc')->nullable()->comment('红包描述');
            $table->string('bonus_image')->nullable()->comment('红包图片');
            $table->unsignedTinyInteger('send_type')->default(0)->comment('send type');
            $table->decimal('bonus_amount',10,2)->default(0.00)->comment('红包面值');
            $table->unsignedInteger('receive_count')->default(0)->comment('每人限领数量');
            $table->unsignedInteger('bonus_number')->default(0)->comment('红包发放数量');
            $table->unsignedTinyInteger('use_range')->default(0)->comment('使用范围 默认0 0-全部商品 1-指定商品');
            $table->text('bonus_data')->nullable()->comment('红包扩展数据 序列化存储');
            $table->decimal('min_goods_amount',10,2)->default(0.00)->comment('最小订单金额限制');
            $table->boolean('is_original_price')->default(true)->comment('仅限原价购买时使用 0-可与其他优惠、活动一起使用 1-仅限原价购买时使用');
            $table->unsignedInteger('start_time')->default(0)->comment('红包发放起始时间');
            $table->unsignedInteger('end_time')->default(0)->comment('红包发放截至时间');
            $table->boolean('is_enable')->default(true)->comment('是否有效 0-无效 1-有效');
            $table->boolean('is_delete')->default(false)->comment('是否删除 0-未删除 1-已删除');
            $table->unsignedInteger('add_time')->default(0)->comment('红包添加时间');
            $table->unsignedInteger('sort')->default(255)->comment('排序');
            $table->unsignedInteger('receive_number')->default(0)->comment('已领取数量');
            $table->unsignedInteger('used_number')->default(0)->comment('已使用数量');

            $table->string('goods_ids')->nullable()->comment('红包商品ids 多个以逗号分隔');

            $table->timestamps();
        });

        DB::statement("ALTER TABLE `bonus` comment '红包表'"); // 表注释

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bonus');
    }
}
