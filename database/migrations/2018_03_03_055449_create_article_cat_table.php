<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticleCatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('article_cat', function (Blueprint $table) {
            $table->increments('cat_id');
            $table->char('cat_name')->comment('分类名称');
            $table->integer('parent_id')->default('0')->unsigned()->comment('上级分类');
            $table->tinyInteger('cat_model')->unsigned()->comment('展示形式 1单网页展示 2普通展示');
            $table->tinyInteger('cat_type')->unsigned()->comment('分类类型');
            $table->tinyInteger('cat_level')->unsigned()->default('0')->comment('分类等级');
            $table->string('cat_image')->nullable()->comment('分类图片');
            $table->string('cat_desc')->nullable()->comment('分类描述');
            $table->string('meta_title')->nullable()->comment('META Title（分类标题）');
            $table->string('meta_keywords')->nullable()->comment('META Keywords（分类关键词）');
            $table->string('meta_desc')->nullable()->comment('META Description（分类描述）');
            $table->boolean('is_show')->default(true)->comment('是否显示');
            $table->integer('cat_sort')->unsigned()->default('255')->comment('排序');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('article_cat');
    }
}
