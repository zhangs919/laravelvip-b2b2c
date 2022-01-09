<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessageTemplatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('message_template', function (Blueprint $table) {
            $table->increments('id');
            $table->char('name',30)->comment('模板名称');
            $table->string('code')->comment('模板标识');
            $table->integer('type',false,true)->default(0)->comment('模板类型');
            $table->integer('msg_type',false,true)->default(0)->comment('消息类型');
            $table->boolean('sys_open')->default(true)->comment('站内信开关');
            $table->boolean('sms_open')->default(true)->comment('短信开关');
            $table->boolean('email_open')->default(true)->comment('邮件开关');
            $table->boolean('wx_open')->default(true)->comment('微信开关');
            $table->integer('last_modify',false,true)->default(0)->comment('最后修改时间');
            $table->string('aliyu_code')->nullable()->comment('阿里云短信模板代码');
            $table->string('sys_content')->nullable()->comment('站内信模板内容');
            $table->string('sms_content')->nullable()->comment('短信模板内容');
            $table->string('email_content')->nullable()->comment('邮件模板内容');
            $table->string('wx_content')->nullable()->comment('微信模板内容');
            $table->string('explain')->nullable()->comment('模板说明');
            $table->string('email_title')->nullable()->comment('邮件标题(邮件)');
            $table->string('sys_spec')->nullable()->comment('站内信说明');
            $table->string('sms_spec')->nullable()->comment('短信模板说明');
            $table->string('email_spec')->nullable()->comment('邮件模板说明');
            $table->string('wx_spec')->nullable()->comment('微信模板说明');

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
        Schema::dropIfExists('message_template');
    }
}
