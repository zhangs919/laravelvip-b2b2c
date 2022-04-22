<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form', function (Blueprint $table) {
            $table->increments('form_id');
            $table->unsignedInteger('shop_id')->default(0)->comment('店铺id');
            $table->unsignedInteger('site_id')->default(0)->comment('网点id');
            $table->unsignedInteger('user_id')->default(0)->comment('用户id');
            $table->unsignedInteger('fb_num')->default(0)->comment('反馈数');
            $table->unsignedInteger('add_time')->default(0)->comment('添加时间');
            $table->unsignedInteger('update_time')->default(0)->comment('更新时间');
            $table->boolean('is_publish')->default(0)->comment('是否发布 0-否 1-是');
            $table->unsignedInteger('need_login')->default(0)->comment('是否需要登录 0-否 1-是');
            $table->string('form_title')->comment('表单标题');
            $table->longText('form_data')->nullable()->comment('表单设计数据');
            $table->longText('global_data')->nullable()->comment('表单设计全局数据');
            $table->string('header_style')->nullable()->comment('去除头部（PC端）');
            $table->string('bottom_style')->nullable()->comment('去除底部（PC端）');
            $table->string('form_keyword')->nullable()->comment('关键词');
            $table->string('form_desc')->nullable()->comment('描述');
            $table->string('share_image')->nullable()->comment('分享推广图');

            $table->unsignedTinyInteger('commit_mode')->default(0)->comment('允许用户提交次数 默认0 0-只允许提交一次 1-可参与多次（取最后一次为结果） 2-可参与多次（每天最多可以投10次，投票结果可以累加）');
            $table->unsignedInteger('start_time')->default(0)->comment('有效期开始时间');
            $table->unsignedInteger('end_time')->default(0)->comment('有效期结束时间');


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
        Schema::dropIfExists('form');
    }
}
