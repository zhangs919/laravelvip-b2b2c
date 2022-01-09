<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminAuthNodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_auth_node', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('auth_id')->comment('权限节点id');
            $table->string('auth_group')->comment('权限节点组');
            $table->string('node_path')->comment('权限节点路径');
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
        Schema::dropIfExists('admin_auth_node');
    }
}
