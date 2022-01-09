<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminNodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_node', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parent_node_id', false, true)->default(0)->comment('父节点id');
            $table->string('parent_node')->comment('父节点');
            $table->string('node_title')->comment('节点标题');
            $table->string('node_name')->comment('节点名称'); // 字段唯一
            $table->string('routes')->nullable()->comment('节点绑定路由 支持多个以英文逗号分隔');
            $table->string('description')->comment('节点描述')->nullable();
            $table->tinyInteger('is_menu')->comment('是否可设置为菜单')->default('0');
            $table->tinyInteger('is_auth')->comment('是启启动RBAC权限控制')->default('1');
            $table->tinyInteger('is_default')->comment('是否默认选中 默认0 0不选中 1选中')->default(0);
            $table->tinyInteger('status')->comment('状态 1开启 0关闭')->default('1');
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
        Schema::dropIfExists('admin_node');
    }
}
