<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttributesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attribute', function (Blueprint $table) {
            $table->increments('attr_id');
            $table->integer('type_id', false, true)->comment('类型id');
            $table->char('attr_name')->comment('属性名称');
            $table->string('attr_remark')->nullable()->comment('属性描述');
            $table->boolean('is_index')->default(false)->comment('是否检索');
            $table->boolean('is_show')->default(false)->comment('是否显示');
            $table->integer('attr_style', false, true)->default(0)->comment('属性样式 默认0 0多选 1单选 2文本');
            $table->text('attr_values')->comment('属性值');
            $table->integer('attr_sort', false, true)->default(255)->comment('排序');
            $table->integer('shop_id', false, true)->default(0)->comment('Shop id');
            $table->integer('par_attr_id', false, true)->default(0)->comment('上级属性或规格ID');
            $table->boolean('is_spec')->default(false)->comment('是否规格');
            $table->boolean('is_linked')->default(false)->comment('是否链接');



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
        Schema::dropIfExists('attribute');
    }
}
