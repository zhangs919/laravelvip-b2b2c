<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDefaultSearchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('default_search', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('search_type',false,true)->default(0)->comment('搜索类型 0默认 1商品分类');
            $table->integer('type_id',false,true)->nullable()->comment('分类id');
            $table->string('search_keywords')->comment('搜索词参与搜索，按回车区分词');
            $table->boolean('is_show')->default(true)->comment('是否显示');
            $table->integer('sort',false,true)->default(255)->comment('排序');
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
        Schema::dropIfExists('default_search');
    }
}
