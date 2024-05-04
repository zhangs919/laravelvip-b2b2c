/*
 Navicat Premium Data Transfer

 Source Server         : dev-homestead
 Source Server Type    : MySQL
 Source Server Version : 80023
 Source Host           : 192.168.10.10:3306
 Source Schema         : laravelmall

 Target Server Type    : MySQL
 Target Server Version : 80023
 File Encoding         : 65001

 Date: 14/06/2021 21:50:32
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for order_settlement_log
-- ----------------------------
DROP TABLE IF EXISTS `order_settlement_log`;
CREATE TABLE `order_settlement_log` (
  `id` int unsigned NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `order_id` int NOT NULL DEFAULT '0' COMMENT '订单ID',
  `ru_id` int NOT NULL DEFAULT '0' COMMENT '商家ID',
  `is_settlement` int NOT NULL DEFAULT '0' COMMENT '是否结算',
  `gain_amount` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '实际收取金额',
  `actual_amount` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '实际结算金额',
  `type` tinyint NOT NULL DEFAULT '0' COMMENT '触发结算类型：1、订单结算 2、账单结算',
  `add_time` int NOT NULL DEFAULT '0' COMMENT '添加时间',
  `update_time` int NOT NULL DEFAULT '0' COMMENT '更新时间',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `order_id` (`order_id`),
  KEY `ru_id` (`ru_id`),
  KEY `is_settlement` (`is_settlement`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='账单结算记录（用于统计已计算和未结算金额）表';

-- ----------------------------
-- Table structure for seller_bill_back_order
-- ----------------------------
DROP TABLE IF EXISTS `seller_bill_back_order`;
CREATE TABLE `seller_bill_back_order` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `order_id` int NOT NULL DEFAULT '0' COMMENT '账单订单ID',
  `ret_id` int NOT NULL DEFAULT '0' COMMENT '单品退单ID',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `order_id` (`order_id`),
  KEY `ret_id` (`ret_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Table structure for seller_negative_bill
-- ----------------------------
DROP TABLE IF EXISTS `seller_negative_bill`;
CREATE TABLE `seller_negative_bill` (
  `id` int unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID号',
  `bill_sn` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '负账单单号',
  `commission_bill_sn` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '账单编号',
  `commission_bill_id` int unsigned NOT NULL DEFAULT '0' COMMENT '账单ID',
  `shop_id` int unsigned NOT NULL DEFAULT '0' COMMENT '商家ID',
  `return_amount` decimal(8,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '负账单总金额',
  `return_shippingfee` decimal(8,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '负账单退款总金额',
  `return_rate_price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '跨境税费退款金额',
  `actual_deducted` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '实际扣除总金额',
  `chargeoff_status` tinyint unsigned NOT NULL DEFAULT '0' COMMENT '账单状态（0 未处理， 1已处理）',
  `start_time` int unsigned NOT NULL DEFAULT '0' COMMENT '负账单开始时间',
  `end_time` int unsigned NOT NULL DEFAULT '0' COMMENT '负账单结束时间',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `commission_bill_id` (`commission_bill_id`),
  KEY `shop_id` (`shop_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='商家负账单表';

-- ----------------------------
-- Table structure for seller_negative_order
-- ----------------------------
DROP TABLE IF EXISTS `seller_negative_order`;
CREATE TABLE `seller_negative_order` (
  `id` int unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID号',
  `negative_id` int unsigned NOT NULL DEFAULT '0' COMMENT '负账单ID',
  `order_id` int unsigned NOT NULL DEFAULT '0' COMMENT '订单ID',
  `order_sn` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '订单单号',
  `ret_id` int unsigned NOT NULL DEFAULT '0' COMMENT '单品退货订单ID',
  `return_sn` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '退货订单单号',
  `seller_id` int unsigned NOT NULL DEFAULT '0' COMMENT '商家ID',
  `return_amount` decimal(8,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '退款金额',
  `return_rate_price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '跨境税费退款金额',
  `return_shippingfee` decimal(8,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '退运费金额',
  `seller_proportion` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0' COMMENT '店铺佣金利率百分比',
  `cat_proportion` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0' COMMENT '商品分类佣金利率百分比',
  `commission_rate` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0' COMMENT '商品佣金利率百分比',
  `gain_commission` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '收取退款佣金金额',
  `should_amount` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '应结退款佣金金额',
  `settle_accounts` tinyint unsigned NOT NULL DEFAULT '0' COMMENT '账单订单结算状态（0 未结算， 1已结算， 2作废）',
  `add_time` int unsigned NOT NULL DEFAULT '0' COMMENT '添加时间',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `negative_id` (`negative_id`),
  KEY `order_id` (`order_id`),
  KEY `ret_id` (`ret_id`),
  KEY `seller_id` (`seller_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='商家负账单订单表';

-- ----------------------------
-- Table structure for seller_bill_goods
-- ----------------------------
DROP TABLE IF EXISTS `seller_bill_goods`;
CREATE TABLE `seller_bill_goods` (
  `id` int unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `rec_id` int unsigned NOT NULL DEFAULT '0' COMMENT '商品订单id',
  `order_id` int unsigned NOT NULL DEFAULT '0' COMMENT '订单id',
  `goods_id` int unsigned NOT NULL DEFAULT '0' COMMENT '商品id',
  `cat_id` int unsigned NOT NULL DEFAULT '0' COMMENT '分类id',
  `proportion` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '分类佣金百分比',
  `goods_price` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '商品价格',
  `dis_amount` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '商品单品满减优惠金额',
  `goods_number` int unsigned NOT NULL DEFAULT '0' COMMENT '商品数量',
  `goods_attr` text COLLATE utf8mb4_unicode_ci COMMENT '商品属性',
  `drp_money` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '分销价额',
  `commission_rate` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '佣金比例',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `rec_id` (`rec_id`),
  KEY `order_id` (`order_id`),
  KEY `goods_id` (`goods_id`),
  KEY `cat_id` (`cat_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='商家账单订单商品';

-- ----------------------------
-- Table structure for seller_bill_order
-- ----------------------------
DROP TABLE IF EXISTS `seller_bill_order`;
CREATE TABLE `seller_bill_order` (
  `id` int unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `bill_id` int unsigned NOT NULL DEFAULT '0' COMMENT '商家账单id',
  `user_id` int unsigned NOT NULL DEFAULT '0' COMMENT '订单会员id',
  `shop_id` int unsigned NOT NULL DEFAULT '0' COMMENT '商家id',
  `order_id` int unsigned NOT NULL DEFAULT '0' COMMENT '订单id',
  `order_sn` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '订单编号',
  `order_status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '订单状态',
  `shipping_status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '配送状态',
  `pay_status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '支付状态',
  `order_amount` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '订单总额',
  `return_amount` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '退款总额',
  `return_shippingfee` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '订单退货运费',
  `goods_amount` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '商品总额',
  `tax` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '税额',
  `shipping_fee` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '运费金额',
  `insure_fee` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '保价费用',
  `pay_fee` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '支付费用',
  `pack_fee` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '包装费用',
  `card_fee` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '贺卡费用',
  `bonus` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '红包金额',
  `integral_money` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '积分金额',
  `coupons` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '优惠券',
  `discount` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '优惠金额',
  `value_card` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '储值卡',
  `money_paid` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '已支付金额',
  `surplus` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '余额支付金额',
  `drp_money` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '分销金额',
  `confirm_take_time` int unsigned NOT NULL DEFAULT '0' COMMENT '确认收货时间',
  `chargeoff_status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '账单 (0:未结账 1:已出账 2:已结账单)',
  `return_rate_fee` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '跨境税费退款金额',
  `rate_fee` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '跨境税费',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `order_id` (`order_id`),
  UNIQUE KEY `order_sn` (`order_sn`),
  KEY `bill_id` (`bill_id`),
  KEY `user_id` (`user_id`),
  KEY `shop_id` (`shop_id`),
  KEY `order_status` (`order_status`),
  KEY `shipping_status` (`shipping_status`),
  KEY `confirm_take_time` (`confirm_take_time`),
  KEY `chargeoff_status` (`chargeoff_status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='商家账单订单';

-- ----------------------------
-- Table structure for seller_commission_bill
-- ----------------------------
DROP TABLE IF EXISTS `seller_commission_bill`;
CREATE TABLE `seller_commission_bill` (
  `id` int unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `shop_id` int unsigned NOT NULL DEFAULT '0' COMMENT '商家id',
  `bill_sn` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '账单编号',
  `order_amount` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '订单总额',
  `shipping_amount` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '运费总金额',
  `return_amount` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '退款总额',
  `return_shippingfee` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '订单退货运费',
  `drp_money` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '分销金额',
  `proportion` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '佣金比例',
  `commission_model` tinyint(1) NOT NULL DEFAULT '-1' COMMENT '佣金模式（0：按商家比例 1：按平台分类比例）',
  `gain_commission` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '收取佣金金额',
  `should_amount` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '本期结算',
  `actual_amount` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '实结金额（账单结束）',
  `chargeoff_time` int unsigned NOT NULL DEFAULT '0' COMMENT '出账时间',
  `settleaccounts_time` int unsigned NOT NULL DEFAULT '0' COMMENT '结账时间',
  `start_time` int unsigned NOT NULL DEFAULT '0' COMMENT '开始时间',
  `end_time` int unsigned NOT NULL DEFAULT '0' COMMENT '结束时间',
  `chargeoff_status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '出账状态 0:未出账 1:已出账 2:账单结束 3:关闭账单',
  `bill_cycle` tinyint(1) NOT NULL DEFAULT '2' COMMENT '账单结算周期类型',
  `bill_apply` tinyint(1) NOT NULL DEFAULT '0' COMMENT '商家申请账单 (0:未申请 1:已申请)',
  `apply_note` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '申请描述',
  `apply_time` int unsigned NOT NULL DEFAULT '0' COMMENT '申请时间',
  `operator` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '触发产生账单管理员',
  `check_status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '审核账单状态（0：待处理 1：同意 2：拒绝）',
  `reject_note` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '拒绝账单内容',
  `check_time` int unsigned NOT NULL DEFAULT '0' COMMENT '审核账单时间',
  `frozen_money` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '账单冻结资金',
  `frozen_data` int unsigned NOT NULL DEFAULT '0' COMMENT '账单冻结时间（天）',
  `frozen_time` int unsigned NOT NULL DEFAULT '0' COMMENT '操作冻结时间',
  `negative_amount` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '负账单金额',
  `return_rate_fee` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '跨境税费退款金额',
  `rate_fee` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '跨境税费',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `shop_id` (`shop_id`),
  KEY `bill_sn` (`bill_sn`),
  KEY `chargeoff_time` (`chargeoff_time`),
  KEY `start_time` (`start_time`),
  KEY `end_time` (`end_time`),
  KEY `chargeoff_status` (`chargeoff_status`),
  KEY `bill_cycle` (`bill_cycle`),
  KEY `bill_apply` (`bill_apply`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='商家账单';

-- ----------------------------
-- Table structure for back_order
-- ----------------------------
DROP TABLE IF EXISTS `back_order`;
CREATE TABLE `back_order` (
  `back_id` int unsigned NOT NULL AUTO_INCREMENT,
  `back_sn` char(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '售后编号',
  `back_type` tinyint unsigned NOT NULL DEFAULT '0' COMMENT '业务类型 0-无状态 1-退款 2-退款退货 3-换货 4-申请维修 5-线下业务',
  `site_id` int unsigned NOT NULL DEFAULT '0' COMMENT '站点id',
  `shop_id` int unsigned NOT NULL DEFAULT '0' COMMENT '店铺id',
  `user_id` int unsigned NOT NULL DEFAULT '0' COMMENT '买家id',
  `order_id` int unsigned NOT NULL DEFAULT '0' COMMENT '订单id',
  `delivery_id` int unsigned NOT NULL DEFAULT '0' COMMENT '发货单id',
  `record_id` int unsigned NOT NULL DEFAULT '0' COMMENT '订单商品记录编号',
  `goods_id` int unsigned NOT NULL DEFAULT '0' COMMENT '商品id',
  `sku_id` int unsigned NOT NULL DEFAULT '0' COMMENT '商品SKU ID',
  `back_number` int unsigned NOT NULL DEFAULT '0' COMMENT '退换商品数量',
  `add_time` int unsigned NOT NULL DEFAULT '0' COMMENT '添加时间',
  `last_time` int unsigned NOT NULL DEFAULT '0' COMMENT '买家最后修改时间',
  `dismiss_time` int unsigned NOT NULL DEFAULT '0' COMMENT '卖家处理时间',
  `disabled_time` int unsigned NOT NULL DEFAULT '0' COMMENT '超时时间',
  `back_status` tinyint unsigned NOT NULL DEFAULT '0' COMMENT '退换货单状态 0-待处理 1-同意申请 2-货物已发出 3-货物已收到 4-处理完成 5-被驳回 6-已失效 7-已撤销',
  `back_reason` int unsigned NOT NULL DEFAULT '0' COMMENT '退换货原因 1-退款不退货 2-退款退货 3-换货 4-申请维修 5-下线业务',
  `refund_money` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '退款金额',
  `refund_type` tinyint unsigned NOT NULL DEFAULT '0' COMMENT '退款方式 默认0 0退回账户余额 1退回原支付方式',
  `refund_status` tinyint unsigned NOT NULL DEFAULT '0' COMMENT 'Refund status 默认0',
  `back_desc` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '退换货说明',
  `back_img1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Back Img1',
  `back_img2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Back Img2',
  `back_img3` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Back Img3',
  `send_time` int unsigned NOT NULL DEFAULT '0' COMMENT 'Send Time',
  `shipping_id` int unsigned NOT NULL DEFAULT '0' COMMENT '买家寄出商品物流公司ID',
  `shipping_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '买家寄出商品物流公司代码',
  `shipping_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '买家寄出商品物流公司名称',
  `shipping_sn` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '买家寄出商品物流单号',
  `seller_reason` int unsigned NOT NULL DEFAULT '0' COMMENT 'Seller Reason',
  `seller_desc` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '退货说明',
  `seller_img1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Seller Img1',
  `seller_img2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Seller Img2',
  `seller_img3` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Seller Img3',
  `seller_address` int unsigned NOT NULL DEFAULT '0' COMMENT '卖家收货地址',
  `reminder_times` int unsigned NOT NULL DEFAULT '0' COMMENT 'Reminder Times',
  `exchange_reason` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '申请换货的原因',
  `repair_reason` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '申请维修的原因',
  `user_address` int unsigned NOT NULL DEFAULT '0' COMMENT '买家收货地址',
  `exchange_desc` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '换货说明',
  `repair_desc` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '维修说明',
  `is_after_sale` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否售后 默认0 0售前 1售后',
  `update_time` int unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `negative_id` int NOT NULL DEFAULT '0' COMMENT '负账单ID',
  `return_rate_price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '退税金额',
  `chargeoff_status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '账单 (0:未结账 1:已出账 2:已结账单)',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`back_id`),
  KEY `negative_id` (`negative_id`),
  KEY `chargeoff_status` (`chargeoff_status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Table structure for order_info
-- ----------------------------
DROP TABLE IF EXISTS `order_info`;
CREATE TABLE `order_info` (
  `order_id` int unsigned NOT NULL AUTO_INCREMENT,
  `order_sn` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '订单号',
  `parent_sn` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '父订单号',
  `user_id` int unsigned NOT NULL DEFAULT '0' COMMENT '买家id',
  `order_status` tinyint unsigned NOT NULL DEFAULT '0' COMMENT '订单状态 0-未确认 1-已确认 2-已取消 3-无效 4-退货 5-已分单 6-部分分单 7-部分已退货 8-仅退款',
  `shop_id` int unsigned NOT NULL DEFAULT '0' COMMENT '店铺id',
  `site_id` int unsigned NOT NULL DEFAULT '0' COMMENT '站点id',
  `store_id` int unsigned NOT NULL DEFAULT '0' COMMENT '网点id',
  `pickup_id` int unsigned NOT NULL DEFAULT '0' COMMENT '自提点id',
  `shipping_status` tinyint unsigned NOT NULL DEFAULT '0' COMMENT '配送状态 0-未发货 1-已发货 2-已收货 3-备货中 4-已发货(部分商品) 5-发货中(处理分单) 6-已发货(部分商品) 7-部分已收货 8-待发货',
  `pay_status` tinyint unsigned NOT NULL DEFAULT '0' COMMENT '支付状态 0-未支付 1-已支付',
  `consignee` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '收货人姓名',
  `region_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '收货地址',
  `region_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '收货人地址region_name',
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '收货人详细地址',
  `address_lng` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '地图定位 经度',
  `address_lat` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '地图定位 纬度',
  `receiving_mode` tinyint unsigned NOT NULL DEFAULT '0' COMMENT '收货方式 默认0 0-普通快递 2-上门自提',
  `tel` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '收货人联系方式',
  `email` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '收货人邮箱',
  `postscript` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '买家留言',
  `best_time` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '最佳送货时间 默认空 可选：工作日/周末/假日均可',
  `pay_id` tinyint unsigned NOT NULL DEFAULT '0' COMMENT '支付方式id 默认0  id值根据后台增加的支付方式而不同 1货到付款 0余额支付 1支付宝 2银联支付 3微信支付 99找人代付',
  `pay_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '支付方式缩写【不支持余额支付！！！】 cod货到付款 alipay支付宝 union银联支付 weixin微信支付 to_pay找人代付',
  `pay_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '支付名称 货到付款 余额支付 支付宝 银联支付 微信支付 找人代付',
  `pay_sn` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0' COMMENT '支付单号 默认0 第三方支付平台编号',
  `is_cod` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否为货到付款 0 否 1 是',
  `order_amount` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '订单总金额',
  `order_points` int unsigned NOT NULL DEFAULT '0' COMMENT '订单兑换积分',
  `money_paid` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '订单实付金额',
  `goods_amount` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '商品总金额',
  `inv_fee` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '发票总费用',
  `shipping_fee` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '配送总费用',
  `other_shipping_fee` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '额外配送费',
  `packing_fee` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '包装费',
  `cash_more` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '货到付款加价',
  `discount_fee` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '活动优惠金额',
  `change_amount` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '订单改价总金额',
  `shipping_change` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '运费改价金额',
  `surplus` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '余额支付',
  `user_surplus` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '可提现余额支付',
  `user_surplus_limit` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '不可提现余额支付',
  `bonus_id` int unsigned NOT NULL DEFAULT '0' COMMENT '用户全网红包id',
  `shop_bonus_id` int unsigned NOT NULL DEFAULT '0' COMMENT '用户店铺红包id',
  `bonus` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '全网红包金额',
  `shop_bonus` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '店铺红包金额',
  `store_card_id` int unsigned NOT NULL DEFAULT '0' COMMENT '店铺储值卡ID',
  `store_card_price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '店铺储值卡金额',
  `integral` int unsigned NOT NULL DEFAULT '0' COMMENT '积分数量',
  `integral_money` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '积分金额',
  `give_integral` int unsigned NOT NULL DEFAULT '0' COMMENT '订单赠送的积分',
  `order_from` int unsigned NOT NULL DEFAULT '1' COMMENT '订单来源 默认1 1PC端 2WAP端 ...',
  `add_time` int unsigned NOT NULL DEFAULT '0' COMMENT '订单添加时间 默认0',
  `take_time` int unsigned NOT NULL DEFAULT '0' COMMENT '订单完成时间 默认0',
  `take_countdown` int unsigned NOT NULL DEFAULT '0' COMMENT '订单完成倒计时时间 默认0',
  `pay_time` int unsigned NOT NULL DEFAULT '0' COMMENT '支付时间 默认0',
  `shipping_time` int unsigned NOT NULL DEFAULT '0' COMMENT '订单配送时间',
  `confirm_time` int unsigned NOT NULL DEFAULT '0' COMMENT '确认收货截止时间',
  `delay_days` int unsigned NOT NULL DEFAULT '0' COMMENT '延迟收货天数 默认0 0正常收货',
  `order_type` int unsigned NOT NULL DEFAULT '0' COMMENT '交易类型 0-普通商品 1-拍卖 2-预售 3-团购 5-积分兑换 6-拼团 8-砍价 10-搭配套餐 11-限时折扣 12-满减送 13-赠品活动 99-电子秤商品',
  `service_mark` int unsigned NOT NULL DEFAULT '0' COMMENT '服务态度 默认0',
  `send_mark` int unsigned NOT NULL DEFAULT '0' COMMENT '发货速度 默认0',
  `shipping_mark` int unsigned NOT NULL DEFAULT '0' COMMENT '物流速度 默认0',
  `buyer_type` int unsigned NOT NULL DEFAULT '0' COMMENT '买家类型 0-个人 1-店铺',
  `evaluate_status` tinyint unsigned NOT NULL DEFAULT '0' COMMENT '评价状态 默认0 0未评价，1已评价，2已过期未评价',
  `evaluate_time` int unsigned NOT NULL DEFAULT '0' COMMENT '评价时间 默认0',
  `end_time` int unsigned NOT NULL DEFAULT '0' COMMENT '订单终止时间 默认0',
  `is_distrib` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否为分销商品 0 否 1 是',
  `distrib_status` tinyint unsigned NOT NULL DEFAULT '0' COMMENT '分销订单状态 默认0 ',
  `is_show` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '是否显示 如："1,2,3,4"',
  `is_delete` tinyint unsigned NOT NULL DEFAULT '0' COMMENT '订单删除状态 默认0 0-正常 1-放入回收站 2-彻底删除',
  `order_data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT '订单活动数据 序列化存储',
  `mall_remark` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT '平台方订单备注 序列化存储',
  `site_remark` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT '站点订单备注 序列化存储',
  `shop_remark` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT '店铺订单备注 序列化存储',
  `store_remark` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT '网点备注 序列化存储',
  `close_reason` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '关闭订单原因',
  `cash_user_id` int unsigned NOT NULL DEFAULT '0' COMMENT 'cash user id 默认0',
  `last_time` int unsigned NOT NULL DEFAULT '0' COMMENT '订单最后修改时间 默认0',
  `order_cancel` tinyint unsigned NOT NULL DEFAULT '0' COMMENT '用户提交取消申请状态 默认0 无取消申请 1等待商家审核 2商家审核通过 3商家拒绝通过',
  `refuse_reason` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '商家拒绝取消订单申请理由 默认空',
  `sub_order_id` int unsigned NOT NULL DEFAULT '1' COMMENT '子订单id 默认1 按单次购买商品总量数量递增',
  `buy_type` tinyint unsigned NOT NULL DEFAULT '0' COMMENT '购买类型 0-加入购物车购买 1-立即购买 2-去结算 3-兑换 4-自由购 5-到店购 6-礼品提货',
  `reachbuy_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0' COMMENT '自由购下单码号码',
  `growth_value` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0' COMMENT '会员等级成长值 默认0',
  `cs_take_status` tinyint unsigned NOT NULL DEFAULT '0' COMMENT 'cs_take_status',
  `cs_take_amount` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT 'cs_take_amount',
  `cs_confirm_time` int unsigned NOT NULL DEFAULT '0' COMMENT 'cs_confirm_time',
  `cs_settlement_time` int unsigned NOT NULL DEFAULT '0' COMMENT 'cs_settlement_time',
  `cs_delivery_fee` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT 'cs_delivery_fee',
  `cs_delivery_enable` tinyint unsigned NOT NULL DEFAULT '0' COMMENT 'cs_delivery_enable',
  `cs_take_time` int unsigned NOT NULL DEFAULT '0' COMMENT 'cs_take_time',
  `revision_user_id` int unsigned NOT NULL DEFAULT '0' COMMENT 'revision_user_id 默认0',
  `terminal_no` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'virtual code',
  `virtual_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'virtual code',
  `card_id` int unsigned NOT NULL DEFAULT '0' COMMENT 'card_id',
  `is_cross_border` int unsigned NOT NULL DEFAULT '0' COMMENT 'is_cross_border',
  `inital_request` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'inital_request',
  `inital_response` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'inital_response',
  `import_duty` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT 'import_duty',
  `shipping_tax` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT 'shipping_tax',
  `goods_tax` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT 'goods_tax',
  `push_pay_order_status` tinyint unsigned NOT NULL DEFAULT '0' COMMENT 'push_pay_order_status',
  `push_order_status` tinyint unsigned NOT NULL DEFAULT '0' COMMENT 'push_order_status',
  `push_logistics_order_status` tinyint unsigned NOT NULL DEFAULT '0' COMMENT 'push_logistics_order_status',
  `is_send_weixin_message` tinyint unsigned NOT NULL DEFAULT '0' COMMENT 'is_send_weixin_message',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_settlement` tinyint unsigned DEFAULT '0' COMMENT '账单结算状态：0 未结算 1 已结算',
  `chargeoff_status` tinyint unsigned DEFAULT '0' COMMENT '账单 (0:未结账 1:已出账 2:已结账单)',
  PRIMARY KEY (`order_id`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='订单表';

-- ----------------------------
-- Table structure for order_action
-- ----------------------------
DROP TABLE IF EXISTS `order_action`;
CREATE TABLE `order_action` (
  `action_id` int unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID号',
  `order_id` int unsigned NOT NULL DEFAULT '0' COMMENT '订单ID',
  `action_user` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '操作管理员',
  `order_status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '订单状态',
  `shipping_status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '配送状态',
  `pay_status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '付款状态',
  `action_place` tinyint(1) NOT NULL DEFAULT '0' COMMENT '（取消订单记录，值为1）',
  `action_note` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '操作备注',
  `log_time` int unsigned NOT NULL DEFAULT '0' COMMENT '操作时间',
  PRIMARY KEY (`action_id`),
  KEY `order_id` (`order_id`),
  KEY `action_user` (`action_user`),
  KEY `order_status` (`order_status`),
  KEY `shipping_status` (`shipping_status`),
  KEY `pay_status` (`pay_status`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='订单操作记录';

-- ----------------------------
-- Table structure for order_goods
-- ----------------------------
DROP TABLE IF EXISTS `order_goods`;
CREATE TABLE `order_goods` (
  `record_id` int unsigned NOT NULL AUTO_INCREMENT,
  `order_id` int unsigned NOT NULL DEFAULT '0' COMMENT '订单id',
  `goods_id` int unsigned NOT NULL DEFAULT '0' COMMENT '商品id',
  `sku_id` int unsigned NOT NULL DEFAULT '0' COMMENT '商品id',
  `spec_info` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT '商品规格 如：重量：kg|尺码：XS',
  `goods_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '商品名称',
  `goods_sn` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '商品sn',
  `sku_sn` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'sku sn 相当于 商品sn',
  `goods_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '商品图片',
  `goods_price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '商品价格',
  `original_price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '商品原价',
  `cost_price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '商品成本价',
  `goods_points` int unsigned NOT NULL DEFAULT '0' COMMENT '商品积分',
  `distrib_price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '分销价格',
  `goods_number` int unsigned NOT NULL DEFAULT '0' COMMENT '购买商品数量',
  `other_price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '其他价格（包括：full_cut_amount gift point bonus）',
  `pay_change` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '卖家优惠价格 如：-100.00',
  `parent_id` int unsigned NOT NULL DEFAULT '0' COMMENT 'parent id',
  `is_gift` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否礼物商品 默认0',
  `is_evaluate` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否评价 默认0',
  `goods_status` int unsigned NOT NULL DEFAULT '0' COMMENT '商品状态 0-无状态 1-仅退款 2-退款退货 3-换货 4-申请维修 5-线下业务',
  `give_integral` int unsigned NOT NULL DEFAULT '0' COMMENT 'give integral',
  `stock_mode` int unsigned NOT NULL DEFAULT '0' COMMENT '库存计数 默认0 0拍下减库存 1付款减库存 2出库减库存',
  `stock_dropped` tinyint(1) NOT NULL DEFAULT '0' COMMENT '库存是否已减 默认0 0未减库存 1已减库存',
  `act_type` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '活动类型 默认null null无活动 1-拍卖 2-预售 3-团购 5-积分兑换 6-拼团 8-砍价 10-搭配套餐 11-限时折扣 12-满减送 13-赠品活动',
  `goods_type` int unsigned NOT NULL DEFAULT '0' COMMENT '商品交易类型 0-普通商品 1-拍卖 2-预售 3-团购 5-积分兑换 6-拼团 8-砍价 10-搭配套餐 11-限时折扣 12-满减送 13-赠品活动 99-电子秤商品',
  `is_distrib` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否分销商品 默认0',
  `discount` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '折扣价格',
  `profits` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '利润价格',
  `distrib_money` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '分销价格',
  `goods_contracts` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT '保障服务内容 json对象',
  `ext_info` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT '商品活动数据 json对象',
  `goods_mode` int unsigned NOT NULL DEFAULT '0' COMMENT '商品类别 默认0 0实物商品（物流发货） 1电子卡券（无需物流） 2服务商品（无需物流）',
  `cs_take_rate` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT 'cs_take_rate',
  `cs_take_rate_mode` int unsigned NOT NULL DEFAULT '0' COMMENT 'cs_take_rate_mode',
  `cs_take_money` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT 'cs_take_money',
  `tax` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT 'tax',
  `integral_money` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT 'integral_money',
  `custom_ifield` int unsigned NOT NULL DEFAULT '0' COMMENT 'custom_ifield',
  `custom_sfield` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'custom_sfield',
  `take_rate` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT 'take_rate',
  `shop_rate` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT 'shop_rate',
  `goods_barcode` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT '商品条形码 支持一品多码，多个条形码之间用逗号分隔',
  `goods_stockcode` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '商品库位码',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`record_id`)
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='订单商品表';

-- ----------------------------
-- Table structure for order_pay
-- ----------------------------
DROP TABLE IF EXISTS `order_pay`;
CREATE TABLE `order_pay` (
  `pay_id` int unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int unsigned NOT NULL DEFAULT '0' COMMENT '用户ID',
  `pay_no` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '支付号',
  `trade_no` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT ' 支付平台单号',
  `order_id` int unsigned NOT NULL DEFAULT '0' COMMENT '订单ID',
  `payment_name` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '支付方式',
  `order_type` tinyint unsigned NOT NULL DEFAULT '0' COMMENT '支付类型 1-订单 2-充值',
  `order_amount` decimal(9,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '总金额',
  `order_balance` decimal(9,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '余额支付',
  `is_paid` tinyint unsigned NOT NULL DEFAULT '0' COMMENT '支付状态',
  `pay_time` timestamp NULL DEFAULT NULL COMMENT '支付时间',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`pay_id`),
  UNIQUE KEY `order_pay_pay_no_unique` (`pay_no`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='订单支付表';

SET FOREIGN_KEY_CHECKS = 1;
