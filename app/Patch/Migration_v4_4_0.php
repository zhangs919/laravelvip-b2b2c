<?php

namespace App\Patch;

use Eloquent;
use Exception;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;

class Migration_v4_4_0
{
    public function run()
    {
        try {

            // $this->cart();

            // 执行sql文件（菜单权限数据 或 表结构有更改，并可清空数据的表适用）
            $this->runSql();

            // 执行迁移-migrate
//            Artisan::call('migrate');

            // 执行迁移-migrate
            // 其他对数据库表的操作 - 新增表、字段、原有数据更新操作等
            $this->migration();

            // 执行填充-seed
            $this->runSeed();

            // 系统配置 清空缓存
            $this->systemConfig();

        } catch (Exception $e) {
            Log::error($e->getMessage());
        }
    }

    private function migration()
    {
        $this->activity();
        $this->article();
        $this->back_order();
        $this->chat_message();
        $this->goods_activity();
        $this->groupon_log();
        $this->order_info();
        $this->seller_bill_order();
        $this->user();
        $this->user_comment();
        $this->user_follow();
        $this->user_praise();
        $this->user_collect();
    }

    public function activity()
    {
        $name = 'activity';
        if (!Schema::hasTable($name)) {
            return false;
        }

        if (!Schema::hasColumn($name, 'create_user_id')) {
            Schema::table($name, function (Blueprint $table) {
                $table->unsignedInteger('create_user_id')->default(0)->comment("创建人用户id")->after('is_recommend');
            });
        }
        if (!Schema::hasColumn($name, 'act_ext_info')) {
            Schema::table($name, function (Blueprint $table) {
                $table->longText('act_ext_info')->nullable()->comment("活动扩展字段")->after('reason');
            });
        }
    }

    public function article()
    {
        $name = 'article';
        if (!Schema::hasTable($name)) {
            return false;
        }

        if (!Schema::hasColumn($name, 'video')) {
            Schema::table($name, function (Blueprint $table) {
                $table->string('video')->default('')->comment("视频")->after('click_number');
            });
        }
        if (!Schema::hasColumn($name, 'images')) {
            Schema::table($name, function (Blueprint $table) {
                $table->text('images')->nullable()->comment("多图 以\"|\"分隔")->after('video');
            });
        }
        if (!Schema::hasColumn($name, 'location')) {
            Schema::table($name, function (Blueprint $table) {
                $table->string('location')->default('')->comment("位置")->after('images');
            });
        }
        if (!Schema::hasColumn($name, 'live_status')) {
            Schema::table($name, function (Blueprint $table) {
                $table->unsignedTinyInteger('live_status')->default(0)->comment("直播状态 0-未直播 1-直播中 2-直播关闭")->after('location');
            });
        }
        if (!Schema::hasColumn($name, 'push_stream')) {
            Schema::table($name, function (Blueprint $table) {
                $table->string('push_stream')->default('')->comment("推流地址")->after('live_status');
            });
        }
        if (!Schema::hasColumn($name, 'pull_stream')) {
            Schema::table($name, function (Blueprint $table) {
                $table->string('pull_stream', 500)->default('')->comment("拉流地址")->after('push_stream');
            });
        }
        if (!Schema::hasColumn($name, 'article_type')) {
            Schema::table($name, function (Blueprint $table) {
                $table->unsignedTinyInteger('article_type')->default(0)->comment("文章类型 1-帖子 2-视频 3-直播")->after('pull_stream');
            });
        }
        if (!Schema::hasColumn($name, 'start_time')) {
            Schema::table($name, function (Blueprint $table) {
                $table->timestamp('start_time')->nullable()->comment("直播开始时间")->after('article_type');
            });
        }
        if (!Schema::hasColumn($name, 'end_time')) {
            Schema::table($name, function (Blueprint $table) {
                $table->timestamp('end_time')->nullable()->comment("直播结束时间")->after('start_time');
            });
        }
    }

    public function back_order()
    {
        $name = 'back_order';
        if (!Schema::hasTable($name)) {
            return false;
        }

        // 修改字段结构
        if (Schema::hasColumn($name, 'refund_money')) {
            Schema::table($name, function (Blueprint $table) {
                $table->decimal('refund_money', 10)->default(0.00)->comment("退款金额")->change();
            });
        }
    }

    public function chat_message()
    {
        $name = 'chat_message';
        if (Schema::hasTable($name)) {
            return false;
        }

        Schema::create($name, function (Blueprint $table) {
            $table->increments('message_id')->comment('消息ID');
            $table->unsignedInteger('sender_id')->default(0)->comment('发送者ID');
            $table->unsignedInteger('receiver_id')->default(0)->comment('接收者ID');
            $table->unsignedInteger('scene_id')->default(0)->comment('业务场景 1-普通消息 3-私信消息 4-直播弹幕');
            $table->unsignedInteger('target_id')->default(0)->comment('目标ID');
            $table->string('message')->default('')->comment('消息内容');
            $table->text('extra')->nullable()->comment('额外信息');
            $table->timestamp('read_at')->nullable()->comment('消息已读时间');
            $table->timestamps();

            // 索引
            $table->index('scene_id');
            $table->index('receiver_id');
            $table->index('sender_id');
        });
        $prefix = config('database.connections.mysql.prefix');
        DB::statement("ALTER TABLE `" . $prefix . $name . "` comment '聊天消息表'");
    }

    public function goods_activity()
    {
        $name = 'goods_activity';
        if (!Schema::hasTable($name)) {
            return false;
        }

        if (!Schema::hasColumn($name, 'shop_id')) {
            Schema::table($name, function (Blueprint $table) {
                $table->unsignedInteger('shop_id')->default(0)->comment("店铺ID")->after('id');
            });
        }
        if (!Schema::hasColumn($name, 'store_id')) {
            Schema::table($name, function (Blueprint $table) {
                $table->unsignedInteger('store_id')->default(0)->comment("门店ID")->after('shop_id');
            });
        }
        if (!Schema::hasColumn($name, 'act_type')) {
            Schema::table($name, function (Blueprint $table) {
                $table->unsignedTinyInteger('act_type')->default(0)->comment("活动类型 默认0")->after('sku_id');
            });
        }

        if (!Schema::hasColumn($name, 'is_enable')) {
            Schema::table($name, function (Blueprint $table) {
                $table->unsignedTinyInteger('is_enable')->default(0)->comment("是否有效 0-已取消 1-有效")->after('act_stock');
            });
        }
        if (!Schema::hasColumn($name, 'sort')) {
            Schema::table($name, function (Blueprint $table) {
                $table->unsignedInteger('sort')->default(255)->comment("排序")->after('ext_info');
            });
        }
    }

    public function groupon_log()
    {
        $name = 'groupon_log';
        if (Schema::hasTable($name)) {
            return false;
        }

        Schema::create($name, function (Blueprint $table) {
            $table->increments('log_id');
            $table->unsignedInteger('shop_id')->default(0)->comment('店铺ID');
            $table->unsignedInteger('goods_id')->default(0)->comment('商品ID');
            $table->unsignedInteger('act_id')->default(0)->comment('活动ID');
            $table->unsignedInteger('user_id')->default(0)->comment('用户ID');
            $table->unsignedTinyInteger('user_type')->default(0)->comment('用户类型 0-团长 1-参团会员');
            $table->string('group_sn', 60)->default('')->comment('拼团编号');
            $table->string('order_sn', 60)->default('')->comment('订单编号');
            $table->unsignedInteger('add_time')->default(0)->comment('添加时间');
            $table->unsignedTinyInteger('status')->default(0)->comment('拼团状态 0-拼团中 1-拼团成功 2-拼团失败');
            $table->unsignedInteger('start_time')->default(0)->comment('开始时间');
            $table->unsignedInteger('end_time')->default(0)->comment('结束时间');

            $table->timestamps();
            $table->softDeletes();
        });
        $prefix = config('database.connections.mysql.prefix');
        DB::statement("ALTER TABLE `" . $prefix . $name . "` comment '拼团记录表'");
    }

    public function order_info()
    {
        $name = 'order_info';
        if (!Schema::hasTable($name)) {
            return false;
        }

        // 修改字段结构
        if (Schema::hasColumn($name, 'region_code')) {
            Schema::table($name, function (Blueprint $table) {
                $table->string('region_code')->default('')->comment("收货地址")->change();
            });
        }
        if (Schema::hasColumn($name, 'region_name')) {
            Schema::table($name, function (Blueprint $table) {
                $table->string('region_name')->default('')->comment("收货人地址region_name")->change();
            });
        }
        if (Schema::hasColumn($name, 'address_lng')) {
            Schema::table($name, function (Blueprint $table) {
                $table->string('address_lng')->default('')->comment("地图定位 经度")->change();
            });
        }
        if (Schema::hasColumn($name, 'address_lat')) {
            Schema::table($name, function (Blueprint $table) {
                $table->string('address_lat')->default('')->comment("地图定位 纬度")->change();
            });
        }
        if (Schema::hasColumn($name, 'tel')) {
            Schema::table($name, function (Blueprint $table) {
                $table->string('tel', 60)->default('')->comment("收货人联系方式")->change();
            });
        }
        if (Schema::hasColumn($name, 'email')) {
            Schema::table($name, function (Blueprint $table) {
                $table->string('email', 60)->default('')->comment("收货人邮箱")->change();
            });
        }
        if (Schema::hasColumn($name, 'postscript')) {
            Schema::table($name, function (Blueprint $table) {
                $table->string('postscript')->default('')->comment("买家留言")->change();
            });
        }
        if (Schema::hasColumn($name, 'best_time')) {
            Schema::table($name, function (Blueprint $table) {
                $table->string('best_time')->default('')->comment("最佳送货时间 默认空 可选：工作日/周末/假日均可")->change();
            });
        }
        if (Schema::hasColumn($name, 'pay_code')) {
            Schema::table($name, function (Blueprint $table) {
                $table->string('pay_code')->default('')->comment("支付方式缩写【不支持余额支付！！！】 cod货到付款 alipay支付宝 union银联支付 weixin微信支付 to_pay找人代付")->change();
            });
        }
        if (Schema::hasColumn($name, 'pay_name')) {
            Schema::table($name, function (Blueprint $table) {
                $table->string('pay_name')->default('')->comment("支付名称 货到付款 余额支付 支付宝 银联支付 微信支付 找人代付")->change();
            });
        }
        if (Schema::hasColumn($name, 'order_amount')) {
            Schema::table($name, function (Blueprint $table) {
                $table->decimal('order_amount', 10)->default(0.00)->comment("订单总金额")->change();
            });
        }
        if (Schema::hasColumn($name, 'money_paid')) {
            Schema::table($name, function (Blueprint $table) {
                $table->decimal('money_paid', 10)->default(0.00)->comment("订单实付金额")->change();
            });
        }
        if (Schema::hasColumn($name, 'goods_amount')) {
            Schema::table($name, function (Blueprint $table) {
                $table->decimal('goods_amount', 10)->default(0.00)->comment("商品总金额")->change();
            });
        }
        if (Schema::hasColumn($name, 'inv_fee')) {
            Schema::table($name, function (Blueprint $table) {
                $table->decimal('inv_fee', 10)->default(0.00)->comment("发票总费用")->change();
            });
        }
        if (Schema::hasColumn($name, 'shipping_fee')) {
            Schema::table($name, function (Blueprint $table) {
                $table->decimal('shipping_fee', 10)->default(0.00)->comment("配送总费用")->change();
            });
        }
        if (Schema::hasColumn($name, 'other_shipping_fee')) {
            Schema::table($name, function (Blueprint $table) {
                $table->decimal('other_shipping_fee', 10)->default(0.00)->comment("额外配送费")->change();
            });
        }
        if (Schema::hasColumn($name, 'packing_fee')) {
            Schema::table($name, function (Blueprint $table) {
                $table->decimal('packing_fee', 10)->default(0.00)->comment("包装费")->change();
            });
        }
        if (Schema::hasColumn($name, 'cash_more')) {
            Schema::table($name, function (Blueprint $table) {
                $table->decimal('cash_more', 10)->default(0.00)->comment("货到付款加价")->change();
            });
        }
        if (Schema::hasColumn($name, 'discount_fee')) {
            Schema::table($name, function (Blueprint $table) {
                $table->decimal('discount_fee', 10)->default(0.00)->comment("活动优惠金额")->change();
            });
        }
        if (Schema::hasColumn($name, 'change_amount')) {
            Schema::table($name, function (Blueprint $table) {
                $table->decimal('change_amount', 10)->default(0.00)->comment("订单改价总金额")->change();
            });
        }
        if (Schema::hasColumn($name, 'shipping_change')) {
            Schema::table($name, function (Blueprint $table) {
                $table->decimal('shipping_change', 10)->default(0.00)->comment("运费改价金额")->change();
            });
        }
        if (Schema::hasColumn($name, 'surplus')) {
            Schema::table($name, function (Blueprint $table) {
                $table->decimal('surplus', 10)->default(0.00)->comment("余额支付")->change();
            });
        }
        if (Schema::hasColumn($name, 'user_surplus')) {
            Schema::table($name, function (Blueprint $table) {
                $table->decimal('user_surplus', 10)->default(0.00)->comment("可提现余额支付")->change();
            });
        }
        if (Schema::hasColumn($name, 'user_surplus_limit')) {
            Schema::table($name, function (Blueprint $table) {
                $table->decimal('user_surplus_limit', 10)->default(0.00)->comment("不可提现余额支付")->change();
            });
        }
        if (Schema::hasColumn($name, 'store_card_price')) {
            Schema::table($name, function (Blueprint $table) {
                $table->decimal('store_card_price', 10)->default(0.00)->comment("店铺储值卡ID")->change();
            });
        }
        if (Schema::hasColumn($name, 'integral_money')) {
            Schema::table($name, function (Blueprint $table) {
                $table->decimal('integral_money', 10)->default(0.00)->comment("积分金额")->change();
            });
        }

    }

    public function seller_bill_order()
    {
        $name = 'seller_bill_order';
        if (!Schema::hasTable($name)) {
            return false;
        }

        if (!Schema::hasColumn($name, 'other_shipping_fee')) {
            Schema::table($name, function (Blueprint $table) {
                $table->unsignedDecimal('other_shipping_fee', 10)->default(0.00)->comment("额外运费金额")->after('shipping_fee');
            });
        }
        if (Schema::hasColumn($name, 'pack_fee')) {
            Schema::table($name, function (Blueprint $table) {
                $table->renameColumn("pack_fee", "packing_fee");
            });
        }
        if (!Schema::hasColumn($name, 'shop_bonus')) {
            Schema::table($name, function (Blueprint $table) {
                $table->unsignedDecimal('shop_bonus', 10)->default(0.00)->comment("红包金额")->after('bonus');
            });
        }
        if (Schema::hasColumn($name, 'discount')) {
            Schema::table($name, function (Blueprint $table) {
                $table->renameColumn("discount", "discount_fee");
            });
        }
        if (Schema::hasColumn($name, 'value_card')) {
            Schema::table($name, function (Blueprint $table) {
                $table->renameColumn("value_card", "store_card_price");
            });
        }

    }

    public function user()
    {
        $name = 'user';
        if (!Schema::hasTable($name)) {
            return false;
        }

        if (!Schema::hasColumn($name, 'summary')) {
            Schema::table($name, function (Blueprint $table) {
                $table->string('summary')->default('')->comment("个人简介")->after('remember_token');
            });
        }
        if (!Schema::hasColumn($name, 'live_verified')) {
            Schema::table($name, function (Blueprint $table) {
                $table->unsignedTinyInteger('live_verified')->default(0)->comment("主播认证状态 0-未认证 1-已认证 2-认证中 3-已拒绝")->after('summary');
            });
        }
        if (!Schema::hasColumn($name, 'live_verified_remark')) {
            Schema::table($name, function (Blueprint $table) {
                $table->string('live_verified_remark')->default('')->comment("主播认证备注")->after('live_verified');
            });
        }
    }

    public function user_comment()
    {
        $name = 'user_comment';
        if (Schema::hasTable($name)) {
            return false;
        }

        Schema::create($name, function (Blueprint $table) {
            $table->increments('comment_id');
            $table->unsignedInteger('user_id')->default(0)->comment('用户ID');
            $table->unsignedInteger('pid')->default(0)->comment('父ID');
            $table->unsignedTinyInteger('type')->default(0)->comment('类型 1-文章评论');
            $table->unsignedInteger('target_id')->default(0)->comment('目标ID');
            $table->text('content')->nullable()->comment('评论内容');
            $table->timestamps();
            $table->softDeletes();
        });
        $prefix = config('database.connections.mysql.prefix');
        DB::statement("ALTER TABLE `" . $prefix . $name . "` comment '用户评论表'");
    }

    public function user_follow()
    {
        $name = 'user_follow';
        if (Schema::hasTable($name)) {
            return false;
        }

        Schema::create($name, function (Blueprint $table) {
            $table->increments('follow_id');
            $table->unsignedInteger('user_id')->default(0)->comment('用户ID');
            $table->unsignedTinyInteger('type')->default(0)->comment('类型 1-关注用户');
            $table->unsignedInteger('target_id')->default(0)->comment('目标ID');

            $table->timestamps();
            $table->softDeletes();
        });
        $prefix = config('database.connections.mysql.prefix');
        DB::statement("ALTER TABLE `" . $prefix . $name . "` comment '用户关注表'");
    }

    public function user_praise()
    {
        $name = 'user_praise';
        if (Schema::hasTable($name)) {
            return false;
        }

        Schema::create($name, function (Blueprint $table) {
            $table->increments('praise_id');
            $table->unsignedInteger('user_id')->default(0)->comment('用户ID');
            $table->unsignedTinyInteger('type')->default(0)->comment('类型 1-文章点赞');
            $table->unsignedInteger('target_id')->default(0)->comment('目标ID');

            $table->timestamps();
            $table->softDeletes();
        });
        $prefix = config('database.connections.mysql.prefix');
        DB::statement("ALTER TABLE `" . $prefix . $name . "` comment '用户点赞表'");
    }

    public function user_collect()
    {
        $name = 'user_collect';
        if (Schema::hasTable($name)) {
            return false;
        }

        Schema::create($name, function (Blueprint $table) {
            $table->increments('collect_id');
            $table->unsignedInteger('user_id')->default(0)->comment('用户ID');
            $table->unsignedTinyInteger('type')->default(0)->comment('类型 1-收藏文章');
            $table->unsignedInteger('target_id')->default(0)->comment('目标ID');

            $table->timestamps();
            $table->softDeletes();
        });
        $prefix = config('database.connections.mysql.prefix');
        DB::statement("ALTER TABLE `" . $prefix . $name . "` comment '用户收藏表'");
    }

    public function runSql()
    {
        Eloquent::unguard();

        // 导入菜单权限及系统配置
        $path = base_path('data/backend.sql'); // sql文件路径
        DB::unprepared(file_get_contents($path));
    }

    /**
     * 执行填充-seed
     */
    public function runSeed()
    {
        // 如： Artisan::call('UserTableSeeder');
    }

    // public function cart()
    // {
    //     $table_name = 'cart';
    //     if (!Schema::hasTable($table_name)) {
    //         return false;
    //     }

    //     if (!Schema::hasColumn($table_name, 'goods_favourable')) {
    //         Schema::table($table_name, function (Blueprint $table) {
    //             $table->decimal('goods_favourable', 10, 2)->default(0)->comment('优惠活动均摊金额');
    //         });
    //     }
    // }


    /**
     * 更新版本
     *
     * @throws Exception
     */
    private function systemConfig()
    {
//        sysconf('lrw_version', 'v4.4.0');

        $this->clearCache();
    }

    /**
     * @throws Exception
     */
    private function clearCache()
    {
        cache()->flush();
    }
}
