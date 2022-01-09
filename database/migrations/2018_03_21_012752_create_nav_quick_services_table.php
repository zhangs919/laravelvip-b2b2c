<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNavQuickServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nav_quick_service', function (Blueprint $table) {
            $table->increments('id');
            $table->string('qs_name')->comment('快捷服务名称');
            $table->string('qs_icon')->comment('快捷服务图标');
            $table->string('qs_link')->default('#')->comment('快捷服务链接');
            $table->boolean('is_show')->default(true)->comment('是否显示');
            $table->tinyInteger('sort', false, true)->default(255)->comment('排序');
            $table->integer('site_id')->comment('站点id');
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
        Schema::dropIfExists('nav_quick_service');
    }
}
