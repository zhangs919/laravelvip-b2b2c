<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFreightFreeRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('freight_free_record', function (Blueprint $table) {
            $table->increments('record_id');
            $table->integer('freight_id',false,true)->comment('运费模板id');
            $table->boolean('is_default')->default(0)->comment('是否默认运费 0否 1是');
            $table->char('region_codes')->nullable()->comment('region_codes');
            $table->char('region_names')->nullable()->comment('region_names');
            $table->char('region_path')->nullable()->comment('region_path');
            $table->integer('free_money',false,true)->default(0)->comment('包邮条件 满多少元');
            $table->integer('free_number',false,true)->default(0)->comment('包邮条件 满多少件');
            $table->tinyInteger('free_mode',false,true)->default(0)->comment('包邮模式 0件数 1金额 2件数+金额 3件数或金额');
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
        Schema::dropIfExists('freight_free_record');
    }
}
