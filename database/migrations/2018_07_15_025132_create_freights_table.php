<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFreightsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('freight', function (Blueprint $table) {
            $table->increments('freight_id');
            $table->integer('shop_id',false,true)->comment('商家编号');
            $table->tinyInteger('freight_type',false,true)->default(0)->comment('运费模板类型 默认0 0全国运费模板 1同城运费模板');
            $table->char('title')->comment('模板名称');
            $table->char('region_code')->comment('商品所在地');
            $table->boolean('is_free')->default(0)->comment('是否包邮 0自定义运费 1卖家承担运费');
            $table->tinyInteger('valuation',false,true)->default(0)->comment('计价方式 0件数 1重量 2体积');
            $table->boolean('limit_sale')->default(0)->comment('是否支持区域限售 0不支持 1支持');
            $table->boolean('free_set')->default(0)->comment('是否指定条件包邮 0否 1是');
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
        Schema::dropIfExists('freight');
    }
}
