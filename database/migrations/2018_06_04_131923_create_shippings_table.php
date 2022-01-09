<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShippingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipping', function (Blueprint $table) {
            $table->increments('shipping_id');
            $table->char('shipping_name',120)->comment('快递公司名称');
            $table->char('shipping_code',20)->comment('快递100物流公司代码');
            $table->integer('img_width', false, true)->default(0)->nullable()->comment('背景图片宽度');
            $table->integer('img_height', false, true)->default(0)->nullable()->comment('背景图片高度');
            $table->integer('offset_top', false, true)->default(0)->nullable()->comment('上偏移量');
            $table->integer('offset_left', false, true)->default(0)->nullable()->comment('左偏移量');
            $table->string('img_path')->nullable()->comment('模板图片');
            $table->boolean('is_open')->default(false)->comment('平台方是否开启此快递 0-否 1-是');
            $table->boolean('is_sheet')->default(false)->comment('是否支持电子面单');
            $table->boolean('is_system')->default(false)->comment('是否系统默认');
            $table->integer('shipping_sort')->default('255')->comment('排序');
            $table->text('config_lable')->nullable()->comment('配置标签');
            $table->string('logo')->nullable()->comment('快递公司logo');
            $table->string('site_url')->nullable()->comment('快递公司网址');
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
        Schema::dropIfExists('shipping');
    }
}
