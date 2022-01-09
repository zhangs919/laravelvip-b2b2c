<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSelfPickupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('self_pickup', function (Blueprint $table) {
            $table->increments('pickup_id');
            $table->integer('shop_id',false,true)->comment('店铺id');
            $table->string('pickup_name')->comment('自提点名称');
            $table->string('region_code')->comment('联系地址');
            $table->string('pickup_address')->comment('详细地址');
            $table->string('address_lng')->comment('地图定位 经度');
            $table->string('address_lat')->comment('地图定位 纬度');
            $table->string('pickup_tel')->nullable()->comment('联系电话');
            $table->string('pickup_images')->comment('自提点照片');
            $table->boolean('is_show')->default(true)->comment('是否显示');
            $table->text('pickup_desc')->nullable()->comment('商家推荐');
            $table->unsignedInteger('sort')->default(255)->comment('排序');
            $table->boolean('is_delete')->default(true)->comment('删除状态');

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
        Schema::dropIfExists('self_pickup');
    }
}
