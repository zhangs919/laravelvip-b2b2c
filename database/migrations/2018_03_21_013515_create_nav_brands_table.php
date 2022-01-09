<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNavBrandsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nav_brand', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('brand_id', false, true)->comment('品牌id');
            $table->boolean('is_show')->default(true)->comment('是否显示');
            $table->tinyInteger('brand_sort', false, true)->default(255)->comment('排序');
            $table->integer('category_id', false, true)->comment('首页分类ID 分类导航中的id');

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
        Schema::dropIfExists('nav_brand');
    }
}
