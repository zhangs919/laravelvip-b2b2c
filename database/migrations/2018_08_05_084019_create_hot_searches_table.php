<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHotSearchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hot_search', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('site_id',false,true)->nullable()->comment('站点id');
            $table->string('keyword')->comment('搜索词参与搜索');
            $table->string('show_words')->comment('显示词不参与搜索，只起显示作用');
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
        Schema::dropIfExists('hot_search');
    }
}
