<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_log', function (Blueprint $table) {
            $table->increments('id');
            $table->string('content')->comment('日志内容');
            $table->string('admin_name')->comment('操作者用户名');
            $table->integer('admin_id')->comment('操作者用户id');
            $table->ipAddress('ip')->comment('IP地址');
            $table->string('url')->comment('操作url');
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
        Schema::dropIfExists('admin_log');
    }
}
