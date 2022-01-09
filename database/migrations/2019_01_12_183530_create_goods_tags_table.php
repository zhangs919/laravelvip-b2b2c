<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoodsTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('goods_tag', function (Blueprint $table) {
            $table->increments('tag_id');
            $table->unsignedInteger('shop_id')->default(0)->comment('店铺id');
            $table->string('tag_name')->comment('标签名称');
            $table->string('tag_image')->comment('标签图片');
            $table->string('tag_shape')->comment('标签形状');
            $table->unsignedTinyInteger('tag_position')->default(0)->comment('标签位置 默认0 0-左上角 1-右上角 2-左下角 3-右下角 4-中间');
            $table->unsignedInteger('sort')->default(255)->comment('排序');
            $table->unsignedInteger('add_time')->default(0)->comment('添加时间');
            $table->timestamps();
        });

        DB::statement("ALTER TABLE `goods_tag` comment '商品标签'"); // 表注释

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('goods_tag');
    }
}
