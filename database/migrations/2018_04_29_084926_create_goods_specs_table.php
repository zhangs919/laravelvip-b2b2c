<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoodsSpecsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('goods_spec', function (Blueprint $table) {
            $table->increments('spec_id');
//            'goods_id', 'attr_id', 'attr_vid', 'attr_name', 'attr_vname', 'attr_desc' attr_sort
//            $table->unsignedInteger('goods_id')->comment('商品SPU id');
//            $table->unsignedInteger('attr_id')->default(0)->comment('规格id');
//            $table->unsignedInteger('attr_vid')->comment('规格值id');
//            $table->char('attr_name', 200)->comment('规格名称');
//            $table->char('attr_vname', 200)->comment('规格值名称');
//            $table->string('attr_desc')->nullable()->comment('规格描述');
//            $table->unsignedInteger('attr_sort')->default(0)->comment('排序');

            /*$table->unsignedInteger('goods_id')->comment('商品SPU id');
            $table->unsignedInteger('cat_id')->comment('商品分类id');
            $table->unsignedInteger('attr_id')->default(0)->comment('规格id');
            $table->unsignedInteger('attr_sort')->default(0)->comment('排序');
            $table->char('attr_name', 200)->comment('规格名称');
            $table->boolean('is_default')->default(false)->comment('是否默认 默认0');*/

            //        'goods_id', 'attr_id', 'attr_vid','cat_id','attr_value', 'attr_desc', 'is_checked','spec_sort'
            $table->unsignedInteger('goods_id')->comment('商品SPU id');
            $table->unsignedInteger('attr_id')->default(0)->comment('规格id');
            $table->unsignedInteger('attr_vid')->comment('规格值id');
            $table->unsignedInteger('cat_id')->comment('商品分类id');
            $table->char('attr_value', 200)->comment('规格值名称');
            $table->string('attr_desc')->nullable()->comment('规格描述');
            $table->boolean('is_checked')->default(false)->comment('是否选中 默认否');
            $table->unsignedInteger('spec_sort')->default(0)->comment('排序');


            $table->timestamps();
        });

        DB::statement("ALTER TABLE `goods_spec` comment '商品规格表'"); // 表注释

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('goods_spec');
    }
}
