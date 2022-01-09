<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNavCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nav_category', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->comment('导航分类名称');
            $table->char('nav_page', 30)->comment('所属页面');
            $table->char('nav_icon', 30)->nullable()->comment('导航图标');
            $table->longText('nav_json')->comment('导航分类json数据');
            $table->boolean('is_show')->default(true)->comment('是否显示');
            $table->integer('sort')->comment('排序')->default('255');
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
        Schema::dropIfExists('nav_category');
    }
}
