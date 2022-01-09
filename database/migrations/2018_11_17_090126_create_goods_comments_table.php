<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoodsCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('goods_comment', function (Blueprint $table) {
            $table->increments('comment_id');
            $table->unsignedInteger('record_id')->default(0)->comment('订单商品表主键id');
            $table->unsignedInteger('user_id')->default(0)->comment('会员id');
            $table->string('user_nick')->nullable()->comment('会员昵称');
            $table->unsignedInteger('user_rank_id')->default(0)->comment('会员等级id');
            $table->unsignedInteger('site_id')->default(0)->comment('站点id');
            $table->unsignedInteger('shop_id')->default(0)->comment('店铺id');
            $table->unsignedInteger('order_id')->default(0)->comment('订单id');
            $table->unsignedInteger('goods_id')->default(0)->comment('商品id');
            $table->unsignedInteger('sku_id')->default(0)->comment('商品SKU id');
            $table->unsignedTinyInteger('desc_mark')->default(0)->comment('描述相符 默认0');

            $table->text('comment_desc')->nullable()->comment('评价内容');
            $table->string('comment_img1')->nullable()->comment('晒图片1');
            $table->string('comment_img2')->nullable()->comment('晒图片2');
            $table->string('comment_img3')->nullable()->comment('晒图片3');
            $table->string('comment_img4')->nullable()->comment('晒图片4');
            $table->string('comment_img5')->nullable()->comment('晒图片5');
            $table->boolean('is_anonymous')->default(false)->comment('是否匿名评价 默认0');
            $table->unsignedInteger('comment_time')->default(0)->comment('评价时间');
            $table->unsignedTinyInteger('comment_status')->default(0)->comment('评价状态 默认0 0待审核 1审核通过 2审核拒绝');
            $table->boolean('is_show')->default(false)->comment('是否显示评价 默认0 0不显示 1显示');

            $table->text('add_comment_desc')->nullable()->comment('追加评价内容');
            $table->string('add_img1')->nullable()->comment('追加晒图片1');
            $table->string('add_img2')->nullable()->comment('追加晒图片2');
            $table->string('add_img3')->nullable()->comment('追加晒图片3');
            $table->string('add_img4')->nullable()->comment('追加晒图片4');
            $table->string('add_img5')->nullable()->comment('追加晒图片5');
            $table->boolean('add_is_anonymous')->default(false)->comment('是否匿名追加评价 默认0');
            $table->unsignedInteger('add_time')->default(0)->comment('追加评价时间');
            $table->unsignedTinyInteger('add_status')->default(0)->comment('追加评价状态 默认0 0待审核 1审核通过 2审核拒绝');
            $table->boolean('add_is_show')->default(false)->comment('是否显示追加评价 默认0 0不显示 1显示');

            $table->text('seller_reply_desc')->nullable()->comment('卖家回复内容');
            $table->unsignedInteger('seller_reply_time')->default(0)->comment('卖家回复时间');
            $table->text('user_reply_desc')->nullable()->comment('买家回复内容');
            $table->unsignedInteger('user_reply_time')->default(0)->comment('买家回复时间');
            $table->boolean('is_delete')->default(false)->comment('是否删除 默认0 0正常 1已删除');
            $table->unsignedTinyInteger('evaluate_status')->default(0)->comment('评价状态 默认0 待评价 1初次评价完成 2追加评价完成');
            $table->unsignedInteger('back_id')->default(0)->comment('退款退货或换货维修id');
            $table->unsignedInteger('back_number')->default(0)->comment('退款退货或换货维修数量');
            $table->unsignedInteger('goods_number')->default(0)->comment('退款退货或换货维修商品数量');
            $table->string('goods_name')->nullable()->comment('商品名称');
            $table->string('goods_image')->nullable()->comment('商品图片');
            $table->text('spec_info')->nullable()->comment('商品规格 如：重量：kg|尺码：XS');
            $table->unsignedInteger('order_add_time')->default(0)->comment('订单添加时间');
            $table->unsignedInteger('confirm_time')->default(0)->comment('订单确认时间');
            $table->unsignedTinyInteger('order_status')->default(0)->comment('订单状态');
            $table->unsignedTinyInteger('user_comment_status')->default(0)->comment('买家评价状态 默认0 待评价 1已评价 初次评价就算已评价');

            $table->timestamps();
        });

        DB::statement("ALTER TABLE `goods_comment` comment '商品买家评价表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('goods_comment');
    }
}
