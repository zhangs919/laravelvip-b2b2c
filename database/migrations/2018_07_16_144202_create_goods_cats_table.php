<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoodsCatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('goods_cat', function (Blueprint $table) {
            $table->integer('goods_id')->default(0)->comment('商品id');
            $table->integer('cat_id')->default(0)->comment('分类id');

            $table->primary(['goods_id','cat_id']); // 复合主键
            $table->index('goods_id', 'goods_id'); // 索引
            $table->index('cat_id', 'cat_id'); // 索引
            $table->timestamps();
        });

        DB::statement("ALTER TABLE `goods_cat` comment '商品扩展分类表'"); // 表注释

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('goods_cat');
    }
}
