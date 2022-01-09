<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTemplateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        $table->string('name');
//        $table->string('email')->unique();
//        $table->string('password');
        Schema::create('template', function (Blueprint $table) {
            $table->increments('id');
//            $table->integer('cat_id')->comment('模板分类id')->nullable();
//            $table->integer('selector_type')->comment('模板选择器id');
            $table->integer('tpl_client')->comment('模板客户端 1电脑端 2手机端');
            $table->string('tpl_name')->comment('模板名称');
            $table->string('code')->comment('模板code');
            $table->integer('type')->comment('模板类型');
            $table->integer('sort')->comment('排序');
            $table->string('remarks')->comment('备注')->nullable();
            $table->string('icon')->comment('图标');
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
        Schema::dropIfExists('template');
    }
}
