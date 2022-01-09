<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('message', function (Blueprint $table) {
            $table->increments('msg_id');
            /*$table->integer('msg_id', false, true)->comment('msg id');
            $table->string('title')->nullable()->comment('消息标题');
            $table->text('content')->nullable()->comment('消息内容');
            $table->integer('send_time', false, true)->default(0)->comment('发送消息时间');
            $table->integer('reply_time', false, true)->default(0)->comment('回复消息时间');
            $table->integer('reply_user_id', false, true)->default(0)->comment('回复者用户id');
            $table->integer('from_user_id', false, true)->default(0)->comment('发送者用户id');
            $table->integer('to_user_id', false, true)->default(0)->comment('接收者用户id');
            $table->string('from_user_name')->nullable()->comment('发送者用户名');
            $table->string('to_user_name')->nullable()->comment('接收者用户名');
            $table->tinyInteger('msg_type', false, true)->default(0)->comment('消息类型 0为私信、1为系统消息、2为留言');
            $table->boolean('msg_status')->default(0)->commment('短消息状态，0为正常状态，1为发送人删除状态，2为接收人删除状态');
            $table->string('read_user_id', 1000)->nullable()->comment('已经读过该消息的会员id');
            $table->string('del_user_id', 1000)->nullable()->comment('已经删除该消息的会员id');
            $table->boolean('msg_open')->default(0)->commment('短消息打开状态 0未打开 1已打开');*/

            $table->unsignedInteger('sender')->default(0)->comment('消息发送者会员id');
            $table->unsignedInteger('send_time')->default(0)->comment('消息发送时间');
            $table->string('title')->nullable()->comment('消息标题');
            $table->text('content')->nullable()->comment('消息内容');
            $table->unsignedTinyInteger('type')->default(0)->comment('消息类型 默认0 1-会员消息 2-店铺消息');
            $table->string('push_type')->nullable()->comment('消息推送类型 消息模板表中的code');
            $table->string('push_value')->nullable()->comment('');

            $table->timestamps();
        });

        DB::statement("ALTER TABLE `message` comment '短消息表'"); // 表注释
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('message');
    }
}
