<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShopMessageTplsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shop_message_tpl', function (Blueprint $table) {
            $table->increments('shop_tpl_id');
            $table->boolean('is_open')->default(true)->comment('是否开启');
            $table->unsignedInteger('msg_tpl_id')->default(0)->comment('消息模板id');
            $table->unsignedInteger('shop_id')->default(0)->comment('店铺id');
            $table->char('mobile', 60)->nullable()->comment('手机号码');
            $table->string('email', 60)->nullable()->comment('邮件地址');
            $table->string('wx_id', 60)->nullable()->comment('微信号');
            $table->timestamps();
        });

        DB::statement("ALTER TABLE `shop_message_tpl` comment '店铺消息模板表'"); // 表注释

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shop_message_tpl');
    }
}
