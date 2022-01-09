<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserRanksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_rank', function (Blueprint $table) {
            $table->increments('rank_id');
            $table->string('rank_name')->comment('等级名称');
            $table->string('rank_img')->comment('等级图标');
            $table->boolean('is_special')->default(false)->comment('是否特殊等级 默认否');
            $table->tinyInteger('point_type', false, true)->default('0')->comment('成长值范围类型 默认0 0介于 1大于');
            $table->integer('min_points', false, true)->default('0')->comment('成长值下限');
            $table->integer('max_points', false, true)->default('0')->comment('成长值上限');
            $table->tinyInteger('type', false, true)->default('0')->comment('等级类型');

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
        Schema::dropIfExists('user_rank');
    }
}
