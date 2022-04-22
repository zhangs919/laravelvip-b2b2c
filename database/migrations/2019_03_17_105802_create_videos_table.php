<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('video', function (Blueprint $table) {
            $table->increments('video_id');
            $table->integer('dir_id')->unsigned()->comment('相册id');
            $table->string('dirname')->comment('目录名称');
            $table->string('extension')->comment('视频扩展名 如:jpg');
            $table->string('file_name')->comment('视频文件名 不带扩展名后缀');
            $table->text('path')->comment('视频路径');
            $table->string('name')->comment('视频原文件名 不带扩展名后缀');
            $table->integer('size')->unsigned()->default(0)->comment('视频大小');
            $table->integer('width')->unsigned()->default(0)->comment('视频宽度');
            $table->integer('height')->unsigned()->default(0)->comment('视频高度');
            $table->smallInteger('sort')->unsigned()->default(255)->comment('排序');
            $table->boolean('is_delete')->default(0)->comment('是否删除');
            $table->unsignedInteger('add_time')->default(0)->comment('添加时间');
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
        Schema::dropIfExists('video');
    }
}
