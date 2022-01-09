<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoodsImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('goods_image', function (Blueprint $table) {
            $table->increments('img_id');
            $table->integer('goods_id',false,true)->comment('商品id');
            $table->integer('spec_id',false,true)->default(0)->comment('规格id');
            $table->string('path')->nullable()->comment('图片路径');
            $table->boolean('is_default')->default(0)->comment('是否默认');
            $table->tinyInteger('sort',false,true)->default(1)->comment('排序');
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
        Schema::dropIfExists('goods_image');
    }
}
