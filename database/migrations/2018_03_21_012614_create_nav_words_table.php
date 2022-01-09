<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNavWordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nav_words', function (Blueprint $table) {
            $table->increments('id');
            $table->string('words_name')->comment('推荐词名称');
            $table->tinyInteger('words_type',false,true)->default(0)->comment('推荐词类型');
            $table->boolean('new_open')->default(true)->comment('是否新窗口打开');
            $table->boolean('is_show')->default(true)->comment('是否显示');
            $table->tinyInteger('words_sort',false,true)->default(255)->comment('推荐词排序');
            $table->string('words_link')->nullable()->comment('推荐词链接');
            $table->tinyInteger('category_id',false,true)->default(0)->comment('首页分类ID 分类导航中的id');

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
        Schema::dropIfExists('nav_words');
    }
}
