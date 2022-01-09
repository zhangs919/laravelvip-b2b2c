<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoodsAttrsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('goods_attr', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('goods_id',false,true)->comment('商品SPU id');
            $table->integer('attr_id',false,true)->default(0)->comment('属性id');
            $table->string('attr_vid')->nullable()->comment('属性值的id 只有分类绑定的平台属性才有');
            $table->char('attr_name', 200)->comment('属性名称');
            $table->text('attr_vname')->comment('属性值的名称');
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
        Schema::dropIfExists('goods_attr');
    }
}
