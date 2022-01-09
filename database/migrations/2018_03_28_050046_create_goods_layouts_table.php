<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoodsLayoutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('goods_layout', function (Blueprint $table) {
            $table->increments('layout_id');
            $table->integer('shop_id',false,true)->comment('店铺id');
            $table->string('layout_name')->comment('模板名称');
            $table->tinyInteger('position',false,true)->default(0)->comment('模板位置');
            $table->text('content')->comment('模板内容');
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
        Schema::dropIfExists('goods_layout');
    }
}
