<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCatAttributesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cat_attribute', function (Blueprint $table) {

            $table->increments('cat_attr_id');
            $table->integer('cat_id', false, true)->comment('商品分类id');
            $table->integer('attr_id', false, true)->comment('属性规格id');
            $table->boolean('is_required')->default(0)->comment('是否必填');
            $table->boolean('is_show')->default(1)->comment('是否显示');
            $table->boolean('is_default')->default(1)->comment('是否默认');
            $table->boolean('is_input')->default(0)->comment('是否允许输入平台方未提供的规格');
            $table->boolean('is_alias')->default(0)->comment('是否启用别名 启用后此规格的名称可以被店铺修改');
            $table->boolean('is_spec')->default(0)->comment('是否规格 0属性 1规格');
            $table->boolean('is_desc')->default(0)->comment('是否可以为规格添加备注');
            $table->boolean('is_filter')->default(0)->comment('是否作为筛选条件展示');
            $table->char('group_name', 100)->nullable()->comment('分组名称');
            $table->integer('sort', false, true)->default(255)->comment('排序');

            $table->timestamps();
        });

        DB::statement("ALTER TABLE `cat_attribute` comment '分类属性规格表'"); // 表注释

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cat_attribute');
    }
}
