<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNavBannersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nav_banner', function (Blueprint $table) {
            $table->increments('id');
            $table->string('banner_name')->comment('广告名称');
            $table->string('banner_image')->comment('广告图片');
            $table->string('banner_link')->comment('广告链接');
            $table->boolean('is_show')->default(true)->comment('是否显示');
            $table->tinyInteger('banner_sort', false, true)->default(255)->comment('排序');
            $table->string('banner_height')->nullable()->comment('广告高度');
            $table->integer('site_id', false, true)->default(0)->comment('站点ID');
            $table->string('nav_page')->comment('所属页面');
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
        Schema::dropIfExists('nav_banner');
    }
}
