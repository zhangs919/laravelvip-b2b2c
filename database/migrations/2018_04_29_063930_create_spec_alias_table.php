<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpecAliasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spec_alias', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('goods_id',false,true)->comment('商品SPU id');
            $table->integer('attr_id',false,true)->comment('规格id');
            $table->string('attr_name')->nullable()->comment('规格别名值');
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
        Schema::dropIfExists('spec_alias');
    }
}
