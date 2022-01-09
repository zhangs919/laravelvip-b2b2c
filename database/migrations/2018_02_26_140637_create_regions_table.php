<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('region', function (Blueprint $table) {
            $table->increments('region_id');
            $table->char('region_name')->comment('地区名称');
            $table->char('region_code')->comment('地区代码');
            $table->char('parent_code')->nullable()->comment('上级区域代码');
            $table->char('region_type')->comment('地区类型');
            $table->char('center')->comment('地区经纬度');
            $table->char('city_code')->comment('城市代码');
            $table->tinyInteger('level')->comment('地区级别');
            $table->tinyInteger('is_enable')->comment('是否启用');
            $table->tinyInteger('is_scope')->comment('是否经营地区 1经营地区 0非经营地区');
            $table->integer('sort')->comment('排序');
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
        Schema::dropIfExists('region');
    }
}
