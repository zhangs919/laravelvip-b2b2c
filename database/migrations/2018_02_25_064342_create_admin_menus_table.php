<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_menu', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('pid')->comment('父id')->default('0');
            $table->string('title')->comment('菜单名称');
            $table->string('icon')->comment('图标');
            $table->string('url')->comment('链接');
            $table->string('target')->comment('打开方式')->default('_self');
            $table->integer('sort')->comment('排序')->default('255');
            $table->tinyInteger('status')->comment('状态')->default('1');
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
        Schema::dropIfExists('admin_menu');
    }
}
