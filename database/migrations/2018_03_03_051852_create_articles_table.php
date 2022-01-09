<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('article', function (Blueprint $table) {
            $table->increments('article_id');
            $table->integer('cat_id')->unsigned()->comment('分类id');
            $table->tinyInteger('cat_model',false,true)->comment('展示形式');
            $table->tinyInteger('cat_type',false,true)->comment('分类类型');
            $table->char('extend_cat')->nullable()->comment('附加分类');
            $table->integer('user_id')->unsigned()->comment('发布人id');
            $table->integer('shop_id')->unsigned()->default(0)->comment('店铺id');
            $table->char('goods_ids')->nullable()->comment('商品ids');
            $table->string('title')->comment('文章标题');
            $table->string('keywords')->nullable()->comment('关键字');
            $table->timestamp('add_time')->nullable()->comment('发布时间');
            $table->string('source')->nullable()->comment('文章来源');
            $table->boolean('is_show')->default(true)->comment('是否显示');
            $table->boolean('is_recommend')->default(false)->comment('是否推荐');
            $table->boolean('is_comment')->default(true)->comment('是否允许评论');
            $table->string('article_thumb')->nullable()->comment('文章缩略图');
            $table->string('summary')->nullable()->comment('文章摘要');
            $table->text('content')->comment('文章内容');
            $table->string('link')->nullable()->comment('转向连接');
            $table->integer('sort')->unsigned()->default('255')->comment('排序');
            $table->tinyInteger('status')->unsigned()->default(0)->comment('审核状态 0未审核 1已通过 2未通过');
            $table->integer('click_number')->unsigned()->default(0)->comment('点击量');
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
        Schema::dropIfExists('article');
    }
}
