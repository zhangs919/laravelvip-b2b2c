<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImageDirsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('image_dir', function (Blueprint $table) {
            $table->increments('dir_id');
            $table->integer('shop_id')->unsigned()->default(0)->comment('店铺id');
            $table->integer('site_id')->unsigned()->default(0)->comment('站点id');
            $table->string('dir_name')->comment('目录名称');
            $table->string('dir_group')->comment('相册分组 shop店铺相册 site站点相册 backend平台方相册');
            $table->string('dir_cover')->nullable()->comment('相册封面图');
            $table->string('dir_desc')->nullable()->comment('描述');
            $table->smallInteger('dir_sort')->unsigned()->default(255)->comment('排序');
            $table->boolean('is_default')->default(false)->comment('是否默认相册');
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
        Schema::dropIfExists('image_dir');
    }
}
