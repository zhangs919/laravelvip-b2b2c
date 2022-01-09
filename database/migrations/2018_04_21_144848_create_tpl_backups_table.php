<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTplBackupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tpl_backup', function (Blueprint $table) {
            $table->increments('back_id');
            $table->char('name', 200)->comment('备份名称');
            $table->unsignedInteger('add_time')->default(0)->comment('添加时间');
            $table->boolean('is_sys')->default(0)->comment('是否为系统预置模板');
            $table->unsignedInteger('shop_id')->default(0)->comment('店铺id');
            $table->unsignedInteger('site_id')->default(0)->comment('站点id');
            $table->char('page', 32)->comment('站点页面');
            $table->string('remark')->nullable()->comment('备注信息');
            $table->unsignedTinyInteger('type')->default(0)->comment('0-模板及数据 1-仅备份模板');
            $table->unsignedInteger('topic_id')->default(0)->comment('专题id');
            $table->string('img')->nullable()->comment('主题封面');
            $table->boolean('is_theme')->default(0)->comment('是否设为主题');
            $table->longText('ext_info')->nullable()->comment('扩展信息');

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
        Schema::dropIfExists('tpl_backup');
    }
}
