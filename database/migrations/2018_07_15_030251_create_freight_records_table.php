<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFreightRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('freight_record', function (Blueprint $table) {
            $table->increments('record_id');
            $table->integer('freight_id',false,true)->comment('运费模板id');
            $table->boolean('is_default')->default(0)->comment('是否默认运费 0否 1是');
            $table->char('region_codes')->nullable()->comment('region_codes');
            $table->char('region_names')->nullable()->comment('region_names');
            $table->char('region_path')->nullable()->comment('region_path');
            $table->string('region_desc')->nullable()->comment('region_desc');
            $table->string('region_color')->nullable()->comment('region_color');
            $table->integer('start_num',false,true)->default(0)->comment('首体积 不能小于0.1 必须不大于9999.9');
            $table->integer('start_money',false,true)->default(0)->comment('首费');
            $table->integer('plus_num',false,true)->default(1)->comment('续件');
            $table->integer('plus_money',false,true)->default(0)->comment('续费');
            $table->boolean('is_cash')->default(0)->comment('是否支持货到付款 0否 1是');
            $table->integer('cash_more',false,true)->default(0)->comment('货到付款加价');
            $table->integer('sort',false,true)->default(255)->comment('排序');
            $table->integer('add_time',false,true)->default(0)->comment('添加时间');
            $table->integer('last_time',false,true)->default(0)->comment('修改时间');

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
        Schema::dropIfExists('freight_record');
    }
}
