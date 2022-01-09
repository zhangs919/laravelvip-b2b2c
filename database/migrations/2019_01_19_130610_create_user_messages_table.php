<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_message', function (Blueprint $table) {
            $table->increments('rec_id');
            $table->unsignedInteger('msg_id')->default(0)->comment('消息id 消息表主键id');
            $table->unsignedTinyInteger('status')->default(0)->comment('消息状态 默认0 0-未读 1-已读');
            $table->unsignedInteger('read_time')->default(0)->comment('消息读取时间 默认0 0-未读');
            $table->unsignedInteger('receiver')->default(0)->comment('消息接收者会员id');
            $table->timestamps();
        });

        DB::statement("ALTER TABLE `user_message` comment '用户消息表'"); // 表注释
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_message');
    }
}
