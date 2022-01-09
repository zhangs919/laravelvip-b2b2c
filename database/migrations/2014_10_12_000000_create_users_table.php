<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user', function (Blueprint $table) {
            $table->increments('user_id');
            $table->integer('role_id', false, true)->default(0)->comment('角色id 默认0');
            $table->char('user_name', 60)->unique()->comment('用户名');
            $table->string('nickname')->nullable()->comment('昵称');
            $table->tinyInteger('rank_id', false, true)->comment('等级id');
            $table->integer('rank_point', false, true)->default(0)->comment('成长值');
            $table->boolean('use_between')->default(false)->comment('享受时长 是否有限 0无限期 1有限');
            $table->date('rank_start_time')->nullable()->comment('开始时间');
            $table->date('rank_end_time')->nullable()->comment('结束时间');
            $table->string('password')->comment('密码');
            $table->tinyInteger('sex', false, true)->default(0)->comment('性别默认0 0保密 1男 2女');
            $table->date('birthday')->nullable()->comment('出生日期');
            $table->text('headimg')->nullable()->comment('会员头像');
            $table->text('faceimg1')->nullable()->comment('faceimg1');
            $table->text('faceimg2')->nullable()->comment('faceimg2');
//            $table->string('address_now')->nullable()->comment('现居地址');
//            $table->string('receive_address')->nullable()->comment('现居住地址');
            $table->string('address_code')->nullable()->comment('地址代码');
            $table->string('detail_address')->nullable()->comment('详细地址');
            $table->string('mobile')->nullable()->comment('手机号');
            $table->string('email')->nullable()->comment('邮箱');
            $table->boolean('status')->default(false)->comment('是否允许登录 默认0 0否 1是');
            $table->boolean('shopping_status')->default(false)->comment('是否允许购物 默认0 0否 1是');
            $table->boolean('comment_status')->default(false)->comment('是否允许评论 默认0 0否 1是');
            $table->decimal('user_money', 10, 2)->default('0.00')->comment('可提现余额');
            $table->decimal('user_money_limit', 10, 2)->default('0.00')->comment('不可提现余额');
            $table->decimal('frozen_money', 10, 2)->default('0.00')->comment('冻结资金');

            $table->timestamp('last_login')->nullable()->comment('上次登录时间');
            $table->ipAddress('last_ip')->nullable()->comment('最近登录IP');
            $table->ipAddress('reg_ip')->nullable()->comment('注册IP地址');
            $table->integer('visit_count', false, true)->default(0)->comment('登录次数');

            $table->boolean('is_real')->default(false)->comment('是否实名认证默认0 0否 1是');

            $table->timestamp('reg_time')->nullable()->comment('注册时间');
            $table->boolean('mobile_validated')->default(false)->comment('是否已验证手机默认0 0否 1是');
            $table->boolean('email_validated')->default(false)->comment('是否已验证邮箱默认0 0否 1是');
            $table->tinyInteger('type')->default(0)->comment('用户类型');
            $table->string('surplus_password')->nullable()->comment('余额支付密码');
            $table->string('pay_point')->default('0|0')->comment('消费积分 平台积分|店铺积分');
            $table->string('password_reset_token')->nullable()->comment('重置密码令牌');
            $table->string('auth_key')->nullable()->comment('授权码');
            $table->string('user_remark')->nullable()->comment('会员备注');
            $table->string('salt', 10)->nullable()->comment('混淆码');

            $table->integer('shop_id', false, true)->default(0)->comment('店铺id 默认0 店铺id');
            $table->integer('store_id', false, true)->default(0)->comment('网点idid 默认0 网点id');
            $table->tinyInteger('is_seller')->default(0)->comment('个人/店主默认0 0个人 1店主 2网点管理员');
            $table->tinyInteger('reg_from')->default(0)->comment('注册来源 0其他 1PC端 2WAP端 3微信端 4APP端 5后台添加');

            $table->integer('address_id', false, true)->default(0)->comment('默认收货地址id 默认0 0无默认收货地址');
            $table->string('mobile_supplier')->nullable()->comment('手机号运营商 如：中国移动');
            $table->string('mobile_province')->nullable()->comment('手机号运营商省份 如：云南');
            $table->string('mobile_city')->nullable()->comment('手机号运营商城市 如：昆明');
            $table->longText('auth_codes')->nullable()->comment('商家中心权限内容');
            $table->string('qq_key')->nullable()->comment('qq_key');
            $table->string('weibo_key')->nullable()->comment('weibo_key');
            $table->string('weixin_key')->nullable()->comment('weixin_key');
            $table->string('invite_code')->nullable()->comment('邀请码');
            $table->unsignedInteger('parent_id')->default(0)->comment('推荐人ID');
            $table->unsignedInteger('is_recommend')->default(0)->comment('是否被推荐 1 被推荐用户 0 不是被推荐用户');

//            $table->tinyInteger('security_level')->default(0)->comment('账户安全级别');


            $table->rememberToken();
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
        Schema::dropIfExists('user');
    }
}
