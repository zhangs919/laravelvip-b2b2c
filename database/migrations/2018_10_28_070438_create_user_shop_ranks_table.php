<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserShopRanksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_shop_rank', function (Blueprint $table) {
            $table->increments('rank_id');
            $table->string('rank_name')->comment('等级名称');
            $table->unsignedInteger('rank_level')->comment('等级级别 值范围1-10');
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
        Schema::dropIfExists('user_shop_rank');
    }
}
