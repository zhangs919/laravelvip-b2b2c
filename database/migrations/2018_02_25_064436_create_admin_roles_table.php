<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_role', function (Blueprint $table) {
            $table->increments('role_id');
            $table->string('role_name')->comment('权限组名称');
            $table->string('role_desc')->comment('权限组描述');
            $table->longText('auth_codes')->nullable()->comment('权限内容');
            $table->tinyInteger('role_type')->comment('角色类型')->default(0);
            $table->integer('sort')->comment('排序')->default('255');
            $table->tinyInteger('status')->comment('状态')->default(1);
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
        Schema::dropIfExists('admin_role');
    }
}
