<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category', function (Blueprint $table) {
            $table->increments('cat_id');
            $table->string('cat_name')->comment('分类名称');
            $table->smallInteger('parent_id')->default('0')->unsigned()->comment('上级分类，商品分类最多支持三级');
            $table->integer('cat_level', false, true)->default('0')->comment('分类级别');
            $table->string('cat_image')->nullable()->comment('分类图标');
            $table->string('cat_letter')->nullable()->comment('分类名称全拼');
            $table->string('ext_info')->nullable()->comment('分类扩展字段');
            $table->string('cat_desc')->nullable()->comment('分类描述');
            $table->decimal('take_rate', 5, 2)->default('0.00')->unsigned()->comment('佣金比例');
            $table->boolean('sync_take_rate')->default(false)->comment('佣金比例是否关联到子分类');
            $table->smallInteger('show_mode')->default('0')->unsigned()->comment('商品列表页商品展示方式');
            $table->boolean('is_parent')->default(false)->comment('是否允许新增下级分类');
            $table->boolean('is_show')->default(false)->comment('是否显示');
            $table->boolean('show_virtual')->default(false)->comment('是否允许发布虚拟商品');
            $table->boolean('sync_show_virtual')->default(false)->comment('发布虚拟商品是否关联到子分类');
            $table->smallInteger('link_type')->default('0')->unsigned()->comment('链接类型');
            $table->string('cat_link')->nullable()->comment('分类链接');
            $table->string('image_link')->nullable()->comment('Image link');
            $table->integer('cat_sort', false, true)->default('255')->comment('排序');
            $table->string('brand_ids')->nullable()->comment('关联品牌ids');
            $table->string('title')->nullable()->comment('seo title');
            $table->string('keywords')->nullable()->comment('seo keywords');
            $table->string('discription')->nullable()->comment('seo discription');
            $table->string('code')->nullable()->comment('分类code');
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
        Schema::dropIfExists('category');
    }
}
