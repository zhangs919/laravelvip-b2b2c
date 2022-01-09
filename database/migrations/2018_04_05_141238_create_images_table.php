<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('image', function (Blueprint $table) {
            $table->increments('img_id');
            $table->integer('dir_id')->unsigned()->comment('相册id');
            $table->string('dirname')->comment('目录名称');
            $table->string('extension')->comment('图片扩展名 如:jpg');
            $table->string('file_name')->comment('图片文件名 不带扩展名后缀');
            $table->text('path')->comment('图片路径');
            $table->string('name')->comment('图片原文件名 不带扩展名后缀');
            $table->integer('size')->unsigned()->default(0)->comment('图片大小');
            $table->integer('width')->unsigned()->default(0)->comment('图片宽度');
            $table->integer('height')->unsigned()->default(0)->comment('图片高度');
            $table->smallInteger('sort')->unsigned()->default(255)->comment('排序');
            $table->boolean('is_delete')->default(0)->comment('是否删除');
            $table->unsignedInteger('add_time')->default()->comment('添加时间');

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
        Schema::dropIfExists('image');
    }
}
