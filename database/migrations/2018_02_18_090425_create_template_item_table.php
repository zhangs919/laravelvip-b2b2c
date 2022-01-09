<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTemplateItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*
         * 'code' => $tplItem['code'],
                'data' => '',
                'ext_info' => null,
                'file' => $render,
                'format_is_valid' => '隐藏',
                'is_valid' => '1',
                'page' => $page,
                'shop_id' => '0',
                'site_id' => '0',
                'sort' => '14',
                'tpl_id' => null,
                'tpl_name' => $tplInfo['tpl_name'],
                'tpl_title' => null,
                'type' => $tplInfo['type'],
                'uid' => $uid
         */
        Schema::create('template_item', function (Blueprint $table) {
            $table->increments('id')->comment('模板id');
            $table->uuid('uid')->unique('uid')->comment('唯一id');
            $table->string('code')->comment('模板code');
            $table->longText('data')->nullable();
            $table->longText('ext_info')->nullable();
            $table->longText('file')->nullable();
            $table->char('is_valid')->default('1');
            $table->string('page')->comment('备注');
            $table->string('shop_id')->default('0');
            $table->string('site_id')->default('0');
            $table->string('topic_id')->comment('专题id')->nullable();
            $table->integer('sort')->comment('排序');
            $table->integer('tpl_id')->nullable();
            $table->string('tpl_title')->nullable();
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
        Schema::dropIfExists('template_item');
    }
}
