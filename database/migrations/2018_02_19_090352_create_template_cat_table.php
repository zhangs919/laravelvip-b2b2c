<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTemplateCatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('template_cat', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tpl_code')->comment('模板code');
            $table->integer('cat_id')->comment('模板分类id')->default('1');
            $table->integer('selector_type')->comment('模板选择器id');
            $table->integer('number')->comment('item数量');
            $table->integer('width')->comment('图片宽度');
            $table->integer('height')->comment('图片高度');
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
        Schema::dropIfExists('template_cat');
    }
}
