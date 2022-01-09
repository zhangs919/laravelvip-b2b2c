<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoodsHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('goods_history', function (Blueprint $table) {
            $table->increments('history_id');
            $table->integer('goods_id',false,true)->comment('商品id');
            $table->integer('user_id',false,true)->comment('会员id');
            $table->integer('cat_id',false,true)->comment('商品分类id');
            $table->integer('cat_id1',false,true)->default(0)->comment('商品一级分类');
            $table->integer('cat_id2',false,true)->default(0)->comment('商品二级分类');
            $table->integer('cat_id3',false,true)->default(0)->comment('商品三级分类');
            $table->decimal('history_price', 10, 2)->default(0.00)->comment('历史价格');
            $table->unsignedInteger('look_time')->default(0)->comment('当前登录用户查看时间');
            $table->unsignedInteger('look_count')->default(0)->comment('当前登录用户查看次数');
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
        Schema::dropIfExists('goods_history');
    }
}
