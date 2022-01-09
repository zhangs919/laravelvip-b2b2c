<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNavAdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nav_ad', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ad_name')->comment('广告名称');
            $table->string('ad_image')->comment('广告图片');
            $table->string('ad_link')->comment('广告链接');
            $table->boolean('is_show')->default(true)->comment('是否显示');
            $table->tinyInteger('ad_sort', false, true)->default(255)->comment('排序');
            $table->string('ad_height')->nullable()->comment('广告高度');
            $table->string('category_id')->comment('首页分类ID');
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
        Schema::dropIfExists('nav_ad');
    }
}
