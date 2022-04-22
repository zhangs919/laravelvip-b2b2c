<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomFormTemplatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('custom_form_template', function (Blueprint $table) {
            $table->increments('id');
            $table->string('group')->nullable()->comment('模板类型');
            $table->string('code')->nullable()->comment('模板code');
            $table->string('preview_image')->nullable()->comment('预览大图');
            $table->string('thumb_image')->nullable()->comment('缩略图');
            $table->string('title')->nullable()->comment('模板标题');
            $table->longText('form_datas')->nullable()->comment('表单数据');
            $table->longText('global_form_datas')->nullable()->comment('表单全局数据');

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
        Schema::dropIfExists('custom_form_template');
    }
}
