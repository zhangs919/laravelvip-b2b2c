<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_address', function (Blueprint $table) {
            $table->increments('address_id');
            $table->string('address_name')->nullable()->comment('地址别名');
            $table->unsignedInteger('user_id')->comment('会员id');
            $table->char('consignee', 20)->nullable()->comment('收货人');
            $table->string('region_code')->nullable()->comment('收货地址');
            $table->string('address_lng')->nullable()->comment('地址经度');
            $table->string('address_lat')->nullable()->comment('地址纬度');
            $table->string('address_detail')->nullable()->comment('详细地址');
            $table->char('mobile', 60)->nullable()->comment('手机号码');
            $table->string('tel', 60)->nullable()->comment('固定电话');
            $table->string('email', 60)->nullable()->comment('邮件地址');
            $table->string('zipcode', 60)->nullable()->comment('邮编');
            $table->string('address_house')->nullable()->comment('门牌号');
            $table->string('address_label')->nullable()->comment('标签');
            $table->boolean('is_default')->default(false)->comment('是否默认收货地址');

//            $table->smallInteger('country', false, true)->nullable()->comment('国家');
//            $table->smallInteger('province', false, true)->nullable()->comment('省份');
//            $table->smallInteger('city', false, true)->nullable()->comment('城市');
//            $table->smallInteger('district', false, true)->nullable()->comment('地区');
//            $table->smallInteger('street', false, true)->nullable()->comment('街道');
            $table->timestamps();
        });

        DB::statement("ALTER TABLE `user_address` comment '用户收货地址表'"); // 表注释

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_address');
    }
}
