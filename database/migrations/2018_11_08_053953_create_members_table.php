<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('member', function (Blueprint $table) {
            $table->increments('member_id');
            $table->unsignedInteger('shop_id')->defualt(0)->comment('店铺id');
            $table->unsignedInteger('user_id')->defualt(0)->comment('会员id');
            $table->string('username')->comment('会员名');
            $table->unsignedInteger('rank_id')->defualt(0)->comment('店铺会员等级id');
            $table->boolean('is_enable')->default(true)->comment('会员状态 默认1 1享受会员折扣 0不享受会员折扣');
            $table->string('member_remark')->nullable()->comment('会员备注');
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
        Schema::dropIfExists('member');
    }
}
