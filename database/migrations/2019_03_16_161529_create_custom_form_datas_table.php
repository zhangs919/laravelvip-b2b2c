<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomFormDatasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('custom_form_data', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('form_id')->default(0)->comment('表单id');
            $table->unsignedInteger('user_id')->default(0)->comment('会员id');
            $table->string('user_name')->nullable()->comment('会员名');
            $table->unsignedInteger('add_time')->default(0)->comment('提交时间');
            $table->string('address')->nullable()->comment('提交地点');
            $table->string('username')->nullable()->comment('姓名');
            $table->string('phone')->nullable()->comment('电话');
            $table->longText('form_data')->nullable()->comment('表单数据');
            $table->string('location')->nullable()->comment('所在地区 如：云南省昆明市');
            $table->ipAddress('ip')->nullable()->comment('ip地址');
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
        Schema::dropIfExists('custom_form_data');
    }
}
