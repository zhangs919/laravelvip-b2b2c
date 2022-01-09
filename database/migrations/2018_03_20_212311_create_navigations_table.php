<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNavigationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('navigation', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nav_name')->comment('导航名称');
            $table->tinyInteger('nav_type', false, true)->default(0)->comment('导航类型');
            $table->string('nav_link')->nullable()->comment('导航链接');
            $table->tinyInteger('nav_position',false,true)->default(1)->comment('显示位置 默认1 1头部 2中间 3底部');
            $table->tinyInteger('nav_layout',false,true)->default(1)->comment('布局 默认1 1左侧 2右侧');
            $table->string('nav_icon')->nullable()->comment('导航图标');
            $table->string('nav_icon_active')->nullable()->comment('选中图标');
            $table->string('nav_class')->nullable()->comment('功能选择');
            $table->string('class_images')->nullable()->comment('样式图标');
            $table->boolean('is_show')->default(1)->comment('是否显示');
            $table->boolean('new_open')->default(1)->comment('新窗口打开');
            $table->tinyInteger('nav_sort',false,true)->default(255)->comment('排序');
            $table->char('nav_page', 30)->comment('所属页面');
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
        Schema::dropIfExists('navigation');
    }
}
