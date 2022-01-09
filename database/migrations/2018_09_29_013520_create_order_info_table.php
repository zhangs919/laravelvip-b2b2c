<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('order_info', function (Blueprint $table) {
            // 'order_sn', 'parent_sn', 'user_id', 'order_status', 'shop_id', 'site_id', 'store_id',
            //        'pickup_id', 'shipping_status', 'pay_status', 'consignee', 'region_code', 'region_name', 'address',
            //        'address_lng', 'address_lat', 'receiving_mode', 'tel', 'email', 'postscript', 'best_time', 'pay_id',
            //        'pay_code', 'pay_name', 'pay_sn', 'is_cod', 'order_amount', 'order_points', 'money_paid', 'goods_amount',
            //        'inv_fee', 'shipping_fee', 'cash_more', 'discount_fee', 'change_amount', 'shipping_change', 'surplus',
            //        'user_surplus', 'user_surplus_limit', 'bonus_id', 'shop_bonus_id', 'bonus', 'shop_bonus', 'store_card_id',
            //        'store_card_price', 'integral', 'integral_money', 'give_integral', 'order_from', 'add_time', 'take_time',
            //        'take_countdown', 'pay_time', 'shipping_time', 'confirm_time', 'delay_days', 'order_type', 'service_mark',
            //        'send_mark', 'shipping_mark', 'buyer_type', 'evaluate_status', 'evaluate_time', 'end_time', 'is_distrib',
            //        'distrib_status', 'is_show', 'is_delete', 'order_data', 'mall_remark', 'site_remark', 'shop_remark', 'store_remark',
            //        'close_reason', 'cash_user_id', 'last_time', 'order_cancel', 'refuse_reason', 'sub_order_id', 'buy_type', 'reachbuy_code',
            //        'growth_value', 'virtual_code', 'pickup_name', 'shop_name', 'shop_type', 'customer_tool', 'customer_account',
            //        'complaint_id', 'complaint_status',
            $table->increments('order_id');
            $table->string('order_sn', 60)->default('')->comment('订单号');
            $table->string('parent_sn', 60)->default('')->comment('父订单号');
            $table->unsignedInteger('user_id')->default(0)->comment('买家id');
            $table->unsignedTinyInteger('order_status')->default(0)
                ->comment('订单状态 0-订单已确认 1-交易成功 2-卖家取消 3-买家取消 4-系统自动取消 10-抢单中');
//                ->comment('订单状态 默认0 0shipped_part卖家发货中 1finished交易成功 2 3cancel交易关闭 4disable_sys交易关闭');
//                ->comment('订单状态 默认0 0 等待买家付款 unpayed 1 待发货未指派 unshipped 2 待发货已指派 assign 3 待接单 pending 4 已发货 shipped 5 交易成功 finished 6 交易关闭 closed 7 退款中的订单 backing 8 取消订单申请 cancel');
            $table->unsignedInteger('shop_id')->default(0)->comment('店铺id');
            $table->unsignedInteger('site_id')->default(0)->comment('站点id');
            $table->unsignedInteger('store_id')->default(0)->comment('网点id');
            $table->unsignedInteger('pickup_id')->default(0)->comment('自提点id');
            $table->unsignedTinyInteger('shipping_status')->default(0)->comment('配送状态 0-待发货 1-已发货 2-发货中 3-已提交物流系统');
            $table->unsignedTinyInteger('pay_status')->default(0)->comment('支付状态 0-未支付 1-已支付');
            $table->string('consignee')->default('')->comment('收货人姓名');
            $table->string('region_code')->nullable()->comment('收货地址');
            $table->string('region_name')->nullable()->comment('收货人地址region_name');
            $table->string('address')->default('')->comment('收货人详细地址');
            $table->string('address_lng')->comment('地图定位 经度');
            $table->string('address_lat')->comment('地图定位 纬度');
            $table->unsignedTinyInteger('receiving_mode')->default(0)->comment('收货方式 默认0');
            $table->string('tel', 60)->nullable()->comment('收货人联系方式');
            $table->string('email', 60)->nullable()->comment('收货人邮箱');
            $table->string('postscript')->nullable()->comment('买家留言');
            $table->string('best_time')->nullable()->comment('最佳送货时间 默认空 可选：工作日/周末/假日均可');
            $table->unsignedTinyInteger('pay_id')->default(0)->comment('支付方式id 默认0 -1货到付款 0余额支付 1支付宝 2银联支付 3微信支付 99找人代付');
            $table->string('pay_code')->nullable()->comment('支付方式缩写【不支持余额支付！！！】 cod货到付款 alipay支付宝 union银联支付 weixin微信支付 to_pay找人代付');
            $table->string('pay_name')->nullable()->comment('支付名称 货到付款 余额支付 支付宝 银联支付 微信支付 找人代付');
            $table->string('pay_sn')->default('0')->comment('支付单号 默认0');
            $table->boolean('is_cod')->default(false)->comment('是否为货到付款 0 否 1 是');
            $table->decimal('order_amount', 10, 2)->default(0.00)->comment('订单总金额');
            $table->unsignedInteger('order_points')->default(0)->comment('订单兑换积分');
            $table->decimal('money_paid', 10, 2)->default(0.00)->comment('订单实付金额');
            $table->decimal('goods_amount', 10, 2)->default(0.00)->comment('商品总金额');
            $table->decimal('inv_fee', 10, 2)->default(0.00)->comment('发票总费用');
            $table->decimal('shipping_fee', 10, 2)->default(0.00)->comment('配送总费用');
            $table->decimal('cash_more', 10, 2)->default(0.00)->comment('货到付款加价');
            $table->decimal('discount_fee', 10, 2)->default(0.00)->comment('活动优惠金额');
            $table->decimal('change_amount', 10, 2)->default(0.00)->comment('订单改价总金额');
            $table->decimal('shipping_change', 10, 2)->default(0.00)->comment('运费改价金额');
            $table->decimal('surplus', 10, 2)->default(0.00)->comment('余额支付');
            $table->decimal('user_surplus', 10, 2)->default(0.00)->comment('可提现余额支付');
            $table->decimal('user_surplus_limit', 10, 2)->default(0.00)->comment('不可提现余额支付');
            $table->unsignedInteger('bonus_id')->default(0)->comment('用户全网红包id');
            $table->unsignedInteger('shop_bonus_id')->default(0)->comment('用户店铺红包id');
            $table->decimal('bonus', 10, 2)->default(0.00)->comment('全网红包金额');
            $table->decimal('shop_bonus', 10, 2)->default(0.00)->comment('店铺红包金额');
            $table->unsignedInteger('store_card_id')->default(0)->comment('店铺储值卡ID');
            $table->decimal('store_card_price', 10, 2)->default(0.00)->comment('店铺储值卡金额');
            $table->unsignedInteger('integral')->default(0)->comment('积分数量');
            $table->decimal('integral_money', 10, 2)->default(0.00)->comment('积分金额');
            $table->unsignedInteger('give_integral')->default(0)->comment('订单赠送的积分');
            $table->unsignedInteger('order_from')->default(1)->comment('订单来源 默认1 1PC端 2WAP端 ...');
            $table->unsignedInteger('add_time')->default(0)->comment('订单添加时间 默认0');
            $table->unsignedInteger('take_time')->default(0)->comment('订单完成时间 默认0');
            $table->unsignedInteger('take_countdown')->default(0)->comment('订单完成倒计时时间 默认0');
            $table->unsignedInteger('pay_time')->default(0)->comment('支付时间 默认0');
            $table->unsignedInteger('shipping_time')->default(0)->comment('订单配送时间');
            $table->unsignedInteger('confirm_time')->default(0)->comment('确认收货截止时间');
            $table->unsignedInteger('delay_days')->default(0)->comment('延迟收货天数 默认0 0正常收货');
            $table->unsignedInteger('order_type')->default(0)->comment('交易类型 0-普通商品 1-拍卖 2-预售 3-团购 5-积分兑换 6-拼团 8-砍价 10-搭配套餐 11-限时折扣 12-满减送 13-赠品活动 99-电子秤商品');
            $table->unsignedInteger('service_mark')->default(0)->comment('服务态度 默认0');
            $table->unsignedInteger('send_mark')->default(0)->comment('发货速度 默认0');
            $table->unsignedInteger('shipping_mark')->default(0)->comment('物流速度 默认0');
            $table->unsignedInteger('buyer_type')->default(0)->comment('买家类型 0-个人 1-店铺');
            $table->unsignedTinyInteger('evaluate_status')->default(0)->comment('评价状态 默认0 0未评价，1已评价，2已过期未评价');
            $table->unsignedInteger('evaluate_time')->default(0)->comment('评价时间 默认0');
            $table->unsignedInteger('end_time')->default(0)->comment('订单终止时间 默认0');
            $table->boolean('is_distrib')->default(false)->comment('是否为分销商品 0 否 1 是');
            $table->unsignedTinyInteger('distrib_status')->default(0)->comment('分销订单状态 默认0 ');
            $table->string('is_show')->nullable()->comment('是否显示 如："1,2,3,4"');
            $table->boolean('is_delete')->default(false)->comment('是否被删除 默认0');
            $table->longText('order_data')->nullable()->comment('订单活动数据 序列化存储');
            $table->longText('mall_remark')->nullable()->comment('平台方订单备注 序列化存储');
            $table->longText('site_remark')->nullable()->comment('站点订单备注 序列化存储');
            $table->longText('shop_remark')->nullable()->comment('店铺订单备注 序列化存储');
            $table->longText('store_remark')->nullable()->comment('网点备注 序列化存储');
            $table->string('close_reason')->nullable()->comment('关闭订单原因');
            $table->unsignedInteger('cash_user_id')->default(0)->comment('cash user id 默认0');
            $table->unsignedInteger('last_time')->default(0)->comment('订单最后修改时间 默认0');
            $table->unsignedTinyInteger('order_cancel')->default(0)->comment('用户提交取消申请状态 默认0 无取消申请 1等待商家审核 2商家审核通过 3商家拒绝通过');
            $table->string('refuse_reason')->nullable()->comment('商家拒绝取消订单申请理由 默认空');
            $table->unsignedInteger('sub_order_id')->default(1)->comment('子订单id 默认1');
            $table->unsignedTinyInteger('buy_type')->default(0)->comment('购买类型 0-加入购物车购买 1-立即购买 2-去结算 3-兑换 4-自由购 5-到店购 6-礼品提货');
            $table->string('reachbuy_code')->default('0')->comment('自由购下单码号码');
            $table->unsignedInteger('growth_value')->default(0)->comment('会员等级成长值 默认0');
            $table->string('virtual_code')->nullable()->comment('virtual code');
            $table->string('pickup_name')->nullable()->comment('自提点名称');
            $table->string('shop_name')->nullable()->comment('店铺名称');
            $table->unsignedTinyInteger('shop_type')->default(0)->comment('店铺类型 默认0 0自营店铺 1个人店铺 2企业店铺');
            $table->unsignedTinyInteger('customer_tool')->default(0)->comment('客服工具 默认0 0无客服 1QQ 2旺旺');
            $table->string('customer_account')->nullable()->comment('客服账号 默认空 QQ号码或旺旺号码');
            $table->unsignedInteger('complaint_id')->nullable()->comment('默认空 投诉id');
            $table->unsignedTinyInteger('complaint_status')->nullable()->comment('默认空 0等待卖家处理 1卖家已回复 2买家撤销投诉 3平台方介入 4平台方仲裁中 5仲裁成功 6仲裁失败');


            /*$table->increments('order_id');
            $table->unsignedInteger('main_order_id')->comment('主订单id');
            $table->char('user_name', 60)->default('')->comment('会员名');
            $table->string('user_mobile', 60)->default('')->comment('会员绑定手机号');
            $table->string('user_nickname')->default('')->comment('会员昵称');
            $table->unsignedInteger('shop_id')->comment('店铺id');
            $table->string('shop_name')->comment('店铺名称');
            $table->unsignedTinyInteger('order_status')->default(0)
                ->comment('订单状态 默认0 0 等待买家付款 unpayed 1 待发货未指派 unshipped 2 待发货已指派 assign 3 待接单 pending 4 已发货 shipped 5 交易成功 finished 6 交易关闭 closed 7 退款中的订单 backing 8 取消订单申请 cancel');
            $table->unsignedTinyInteger('shipping_status')->default(0)->comment('物流状态 ');
            $table->unsignedTinyInteger('pay_status')->default(0)->comment('订单状态 ');

            $table->string('pay_type')->nullable()->comment('支付方式 alipay支付宝 union银联支付 weixin微信支付 balance余额支付 cod货到付款');
            $table->unsignedTinyInteger('service_type')->default(0)->comment('售后服务 默认0 0正常订单（无任何售后服务） 1 退款中 refunding 2 换货中 replacement 3 维修中 repairing');
            $table->unsignedTinyInteger('pickup')->default(0)->comment('配送方式 1普通快递 2上门自提');
            $table->unsignedTinyInteger('order_type')->default(0)->comment('订单类型 默认0 0普通订单 2预售订单 3团购订单 6拼团订单 8砍价订单');
            $table->unsignedTinyInteger('buy_type')->default(0)->comment('购买类型 默认0');




            $table->string('best_time', 120)->default('')->comment('');
            $table->text('shipping_id')->comment('物流id');
            $table->text('shipping_name')->comment('物流公司名称');
            $table->text('shipping_code')->comment('物流公司代号');
            $table->text('shipping_type')->comment('物流类型');
            $table->tinyInteger('pay_id', false, true)->default(0)->comment('支付方式id');
            $table->string('pay_name', 120)->default('')->comment('支付方式名称');
            $table->string('how_oos', 120)->default('')->comment('');
            $table->string('how_surplus', 120)->default('')->comment('');
            $table->string('pack_name', 120)->default('')->comment('');
            $table->string('card_name', 120)->default('')->comment('');
            $table->string('card_message')->default('')->comment('');
            $table->string('inv_payee', 120)->default('')->comment('发票抬头 如：个人');
            $table->string('inv_content', 120)->default('')->comment('发票内容');
            $table->decimal('cost_amount', 10, 2)->default(0.00)->comment('订单成本');
            $table->decimal('insure_fee', 10, 2)->default(0.00)->comment('');
            $table->decimal('pay_fee', 10, 2)->default(0.00)->comment('');
            $table->decimal('pack_fee', 10, 2)->default(0.00)->comment('');
            $table->decimal('card_fee', 10, 2)->default(0.00)->comment('');

            $table->integer('integral', false, true)->default(0)->comment('');
            $table->decimal('integral_money', 10, 2)->default(0.00)->comment('');
            $table->decimal('bonus', 10, 2)->default(0.00)->comment('红包金额');

            $table->decimal('return_amount', 10, 2)->default(0.00)->comment('订单整站退款金额');
            $table->smallInteger('from_ad', false, true)->default(0)->comment('');
            $table->string('referer')->default('')->comment('');
            $table->integer('add_time', false, true)->default(0)->comment('下单时间');
            $table->integer('confirm_time', false, true)->default(0)->comment('订单确认时间');
            $table->integer('pay_time', false, true)->default(0)->comment('订单支付时间');
            $table->integer('shipping_time', false, true)->default(0)->comment('订单发货时间');
            $table->integer('confirm_take_time', false, true)->default(0)->comment('订单确认收货时间');
            $table->integer('auto_delivery_time', false, true)->default(15)->comment('自动发货天数');
            $table->tinyInteger('pack_id', false, true)->default(0)->comment('');
            $table->tinyInteger('card_id', false, true)->default(0)->comment('');
            $table->integer('bonus_id', false, true)->default(0)->comment('');
            $table->string('invoice_no')->default('')->comment('');
            $table->string('extension_code', 30)->default('')->comment('');
            $table->integer('extension_id', false, true)->default(0)->comment('');
            $table->string('to_buyer')->default('')->comment('');
            $table->string('pay_note')->default('')->comment('');
            $table->integer('agency_id', false, true)->comment('');
            $table->string('inv_type', 60)->comment('');
            $table->decimal('tax', 10, 2)->comment('');
            $table->tinyInteger('is_separate', false ,true)->default(0)->comment('');
            $table->integer('parent_id', false, true)->default(0)->comment('');
            $table->decimal('discount', 10, 2)->comment('');
            $table->decimal('discount_all', 10, 2)->comment('');
            $table->tinyInteger('is_delete', false, true)->default(0)->comment('');
            $table->tinyInteger('is_settlement')->default(0)->comment('');
            $table->bigInteger('sign_time')->nullable()->comment('');
            $table->tinyInteger('is_single', false, true)->default(0)->comment('');
            $table->string('point_id')->default('')->comment('');
            $table->string('shipping_dateStr')->comment('');
            $table->integer('supplier_id', false, true)->default(0)->comment('');
            $table->decimal('coupons', 10, 2)->default(0.00)->unsigned()->comment('');
            $table->integer('uc_id', false, true)->default(0)->comment('');
            $table->integer('is_zc_order', false, true)->default(0)->comment('');
            $table->integer('zc_goods_id', false, true)->comment('');
            $table->boolean('is_frozen')->default(false)->comment('');
            $table->tinyInteger('chargeoff_status', false, true)->default(0)->comment('');
            $table->tinyInteger('invoice_type', false, true)->default(0)->comment('');
            $table->integer('vat_id', false, true)->default(0)->comment('增值税发票信息ID 关联 users_vat_invoices_info表自增ID');
            $table->string('tax_id')->default('')->comment('');
            $table->boolean('is_update_sale')->default(false)->comment('');*/

//            // 唯一索引
//            $table->unique('order_sn', 'order_sn'); // 唯一key
//            // 索引
//            $table->index('user_id', 'user_id');
//            $table->index('order_status', 'order_status');
//            $table->index('shipping_status', 'shipping_status');
//            $table->index('pay_status', 'pay_status');
////            $table->index('shipping_id', 'shipping_id');
//            $table->index('pay_id', 'pay_id');
//            $table->index(['extension_code', 'extension_id'], 'extension_code');
//            $table->index('agency_id', 'agency_id');
//            $table->index('main_order_id', 'main_order_id');
//            $table->index('uc_id', 'uc_id');
//            $table->index('parent_id', 'parent_id');
//            $table->index('supplier_id', 'supplier_id');
//            $table->index('is_zc_order', 'is_zc_order');
//            $table->index('zc_goods_id', 'zc_goods_id');
//            $table->index('chargeoff_status', 'chargeoff_status');



//            $table->index('country', 'country');
//            $table->index('province', 'province');
//            $table->index('city', 'city');
//            $table->index('district', 'district');
//            $table->index('street', 'street');


            /**
             * 以下后期优化设置
             * UNIQUE KEY `order_sn` (`order_sn`),
            KEY `user_id` (`user_id`),
            KEY `order_status` (`order_status`),
            KEY `shipping_status` (`shipping_status`),
            KEY `pay_status` (`pay_status`),
            KEY `shipping_id` (`shipping_id`(333)),
            KEY `pay_id` (`pay_id`),
            KEY `extension_code` (`extension_code`,`extension_id`),
            KEY `agency_id` (`agency_id`),
            KEY `main_order_id` (`main_order_id`),
            KEY `uc_id` (`uc_id`),
            KEY `parent_id` (`parent_id`),
            KEY `supplier_id` (`supplier_id`),
            KEY `is_zc_order` (`is_zc_order`),
            KEY `zc_goods_id` (`zc_goods_id`),
            KEY `chargeoff_status` (`chargeoff_status`),
            KEY `country` (`country`),
            KEY `province` (`province`),
            KEY `city` (`city`),
            KEY `district` (`district`),
            KEY `street` (`street`)
             */

            $table->timestamps();
        });

        DB::statement("ALTER TABLE `order_info` comment '订单表'"); // 表注释
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_info');
    }
}
