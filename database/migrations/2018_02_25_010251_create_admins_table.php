<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin', function (Blueprint $table) {
            $table->increments('user_id');
            $table->integer('role_id')->comment('角色id');
            $table->tinyInteger('user_type')->comment('管理员类型 0-平台管理员 1-站点管理员不能为空。')->default('0');
            $table->string('user_name')->comment('用户名')->unique(); // 唯一
            $table->string('password')->comment('密码');
            $table->string('real_name')->nullable()->comment('真实姓名');
            $table->string('mobile')->nullable()->comment('手机');
            $table->string('email')->nullable()->comment('邮箱');
            $table->string('tel')->nullable()->comment('固话');
            $table->tinyInteger('status')->comment('状态')->default('1');
            $table->integer('visit_count')->comment('登录次数')->default('0');
            $table->integer('valid_time')->comment('有效截止时间 时间戳');
            $table->timestamp('valid_time_format')->comment('格式化的有效截止时间 yyyy-mm-dd hh:ii');
            $table->timestamp('last_time')->nullable()->comment('最后访问时间');
            $table->ipAddress('last_ip')->comment('最后登录IP');
            $table->string('access_token')->comment('授权认证只能包含至多200个字符。')->defaut('i-USLS15iK2dPbWMNUS-_4tpg1r02QKw');
            $table->string('auth_key')->comment('授权Key只能包含至多200个字符。')->default('KpAvMncqYwUElRq9');
            $table->text('auth_codes')->comment('授权项 超级为all必须是一条字符串。');
            $table->char('ec_salt')->comment('混淆码只能包含至多10个字符。');
            $table->rememberToken();
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
        Schema::dropIfExists('admin');
    }
}
