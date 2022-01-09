<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSystemConfigTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('system_config', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code')->comment('配置code');
            $table->string('title')->comment('配置标题');
            $table->string('group')->comment('配置分组');
            $table->string('type')->comment('表单类型');
            $table->tinyInteger('required')->default('0')->comment('字段是否必须 0非必须 1必须');
            $table->string('anchor')->nullable()->comment('页面导航');
            $table->text('value')->comment('配置值')->nullable();
            $table->text('options')->comment('配置项')->nullable();
            $table->text('labels')->comment('配置项的label')->nullable();
            $table->text('tips')->comment('配置提示')->nullable();
            $table->integer('sort')->default('255')->comment('排序');
            $table->tinyInteger('status')->default('1')->comment('状态');
            $table->text('storage_dir')->comment('图片存储路径')->nullable();
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
        Schema::dropIfExists('system_config');
    }
}
