<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSmsLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sms_log', function (Blueprint $table) {
            $table->increments('log_id');
            $table->char('log_phone', 11)->comment('手机号');
            $table->char('log_captcha', 6)->comment('短信验证码');
            $table->string('log_ip', 15)->comment('请求ip');
            $table->text('log_msg')->comment('短信内容');
            $table->unsignedTinyInteger('log_type')->default(1)->comment('短信类型:1为注册,2为登录,3为找回密码,默认为1');
            $table->unsignedInteger('user_id')->default(0)->comment('会员id');
            $table->string('user_name')->nullable()->comment('会员名');
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
        Schema::dropIfExists('sms_log');
    }
}
