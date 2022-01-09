<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBrandsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('brand', function (Blueprint $table) {
            $table->increments('brand_id');
            $table->char('brand_name')->comment('品牌名称');
            $table->char('brand_letter', 1)->nullable()->comment('品牌首字母');
            $table->string('site_url')->nullable()->comment('品牌网址');
            $table->string('brand_logo')->nullable()->comment('品牌logo');
            $table->string('brand_banner')->nullable()->comment('品牌banner图');
            $table->string('promotion_image')->nullable()->comment('品牌推广图');
            $table->text('brand_desc')->nullable()->comment('品牌描述');
            $table->boolean('is_show')->default(true)->comment('是否显示');
            $table->boolean('is_recommend')->default(false)->comment('是否推荐');
            $table->boolean('brand_apply')->default(false)->comment('审核是否通过');
            $table->integer('brand_sort')->unsigned()->default('255')->comment('排序');

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
        Schema::dropIfExists('brand');
    }
}
