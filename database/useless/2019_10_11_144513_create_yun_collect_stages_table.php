<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateYunCollectStagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('yun_collect_stage', function (Blueprint $table) {
            $table->bigIncrements('ycs_id');
            $table->unsignedInteger('third_goods_id')->comment('第三方商品ID编号');
            $table->string('goods_name')->comment('第三方商品名称');
            $table->string('goods_image')->nullable()->comment('商品封面图');
            $table->decimal('goods_price')->default('0.00')->comment('商品价格');
            $table->unsignedInteger('comment_num')->default(0)->comment('评论数量');
            $table->text('link_url')->nullable()->comment('第三方商品链接');
            $table->unsignedTinyInteger('collect_status')->default(0)->comment('采集状态 默认0 0-待采集 1-待导入 2-已导入');

            $table->timestamps();
        });

        DB::statement("ALTER TABLE `yun_collect_stage` comment '云采集商品暂存表'"); // 表注释
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('yun_collect_stage');
    }
}
