<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCopyrightAuthsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('copyright_auth', function (Blueprint $table) {
            $table->increments('auth_id');
            $table->char('auth_name',20)->comment('资质名称');
            $table->string('auth_image')->comment('资质图标');
            $table->string('links_url')->nullable()->comment('链接地址');
            $table->boolean('is_show')->default(false)->comment('是否显示');
            $table->integer('auth_sort', false, true)->default(255)->comment('排序');
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
        Schema::dropIfExists('copyright_auth');
    }
}
