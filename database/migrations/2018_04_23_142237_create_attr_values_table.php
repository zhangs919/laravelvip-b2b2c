<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttributeValuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attr_value', function (Blueprint $table) {
//            'attr_id', 'attr_vname', 'attr_vsort', 'is_delete'
            $table->increments('attr_vid');
            $table->integer('attr_id', false, true)->comment('属性id');
            $table->char('attr_vname')->comment('属性值名称');
            $table->integer('attr_vsort', false, true)->default(255)->comment('排序');
//            $table->boolean('is_delete')->default(false)->comment('是否删除');

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
        Schema::dropIfExists('attr_value');
    }
}
