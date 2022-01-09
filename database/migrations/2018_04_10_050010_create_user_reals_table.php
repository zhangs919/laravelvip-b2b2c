<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserRealsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_real', function (Blueprint $table) {
            $table->increments('real_id');
            $table->unsignedInteger('user_id')->comment('会员id');
            $table->string('real_name')->nullable()->comment('真实姓名');
            $table->string('id_code')->nullable()->comment('身份证号');
            $table->string('card_pic1')->nullable()->comment('身份证正面');
            $table->string('card_pic2')->nullable()->comment('身份证反面');
            $table->string('card_pic3')->nullable()->comment('手持身份证');
            $table->string('address_now', 60)->nullable()->comment('现居住地址');
            $table->string('reason')->nullable()->comment('审核原因');
            $table->unsignedTinyInteger('status')->default(0)->comment('是否通过实名认证 0未认证 1已认证');
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
        Schema::dropIfExists('user_real');
    }
}
