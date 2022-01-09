<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLibCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lib_category', function (Blueprint $table) {
            $table->increments('cat_id');
            $table->char('cat_name')->comment('分类名称');
            $table->integer('parent_id')->unsigned()->default(0)->comment('上级分类');
            $table->boolean('is_show')->default(false)->comment('是否显示');
            $table->smallInteger('cat_sort')->unsigned()->default(255)->comment('排序');
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
        Schema::dropIfExists('lib_category');
    }
}
