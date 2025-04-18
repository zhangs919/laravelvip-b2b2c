/*
 Navicat Premium Data Transfer

 Source Server         : 本地宝塔
 Source Server Type    : MySQL
 Source Server Version : 80029
 Source Host           : localhost:3306
 Source Schema         : shop

 Target Server Type    : MySQL
 Target Server Version : 80029
 File Encoding         : 65001

 Date: 17/01/2024 11:22:50
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for activity
-- ----------------------------
DROP TABLE IF EXISTS `activity`;
CREATE TABLE `activity`  (
  `act_id` int(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `act_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '活动名称',
  `act_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '活动标题',
  `act_type` tinyint(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '活动类型 默认0 ',
  `act_img` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '活动图片',
  `start_time` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '活动开始时间',
  `end_time` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '活动结束时间',
  `is_finish` tinyint(0) NOT NULL DEFAULT 0 COMMENT '活动状态 默认0 0未开始 1进行中 2已结束',
  `purchase_num` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '限购数量',
  `status` tinyint(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '审核状态 默认0 0待审核 1已审核 2审核不通过',
  `is_recommend` tinyint(1) NOT NULL DEFAULT 0 COMMENT '活动是否推荐 默认0 0未推荐 1已推荐',
  `create_user_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '创建人用户id',
  `shop_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '店铺id',
  `site_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '站点id',
  `ext_info` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL COMMENT '扩展字段',
  `use_range` tinyint(1) NOT NULL DEFAULT 0,
  `sort` int(0) UNSIGNED NOT NULL DEFAULT 255 COMMENT '排序',
  `reason` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '审核原因',
  `act_ext_info` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL COMMENT '活动扩展字段',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`act_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 13 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = '活动表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for activity_category
-- ----------------------------
DROP TABLE IF EXISTS `activity_category`;
CREATE TABLE `activity_category`  (
  `id` int(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `cat_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '分类名称',
  `parent_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '上级分类id',
  `cat_level` tinyint(0) UNSIGNED NOT NULL DEFAULT 1 COMMENT '分类层级 默认1',
  `is_show` tinyint(1) NOT NULL DEFAULT 1 COMMENT '是否显示',
  `cat_sort` int(0) UNSIGNED NOT NULL DEFAULT 255 COMMENT '排序',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = '活动分类表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for admin
-- ----------------------------
DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin`  (
  `user_id` int(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `role_id` int(0) NOT NULL COMMENT '角色id',
  `user_type` tinyint(0) NOT NULL DEFAULT 0 COMMENT '管理员类型 0-平台管理员 1-站点管理员不能为空。',
  `user_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '用户名',
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '密码',
  `real_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '真实姓名',
  `mobile` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '手机',
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '邮箱',
  `tel` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '固话',
  `status` tinyint(0) NOT NULL DEFAULT 1 COMMENT '状态',
  `visit_count` int(0) NOT NULL DEFAULT 0 COMMENT '登录次数',
  `valid_time` int(0) NOT NULL COMMENT '有效截止时间 时间戳',
  `valid_time_format` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0) ON UPDATE CURRENT_TIMESTAMP(0) COMMENT '格式化的有效截止时间 yyyy-mm-dd hh:ii',
  `last_time` timestamp(0) NULL DEFAULT NULL COMMENT '最后访问时间',
  `last_ip` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '最后登录IP',
  `access_token` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '授权认证只能包含至多200个字符。',
  `auth_key` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'KpAvMncqYwUElRq9' COMMENT '授权Key只能包含至多200个字符。',
  `auth_codes` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '授权项 超级为all必须是一条字符串。',
  `ec_salt` char(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '混淆码只能包含至多10个字符。',
  `weixin_key` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT 'weixin_key',
  `weixin_info` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL COMMENT '微信信息',
  `remember_token` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`user_id`) USING BTREE,
  UNIQUE INDEX `admins_user_name_unique`(`user_name`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for admin_auth_node
-- ----------------------------
DROP TABLE IF EXISTS `admin_auth_node`;
CREATE TABLE `admin_auth_node`  (
  `id` int(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `auth_id` int(0) NOT NULL COMMENT '权限节点id',
  `auth_group` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '权限节点组',
  `node_path` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '权限节点路径',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for admin_log
-- ----------------------------
DROP TABLE IF EXISTS `admin_log`;
CREATE TABLE `admin_log`  (
  `id` int(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `content` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '日志内容',
  `admin_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '操作者用户名',
  `admin_id` int(0) NOT NULL COMMENT '操作者用户id',
  `ip` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT 'IP地址',
  `url` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '操作url',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3781 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for admin_menu
-- ----------------------------
DROP TABLE IF EXISTS `admin_menu`;
CREATE TABLE `admin_menu`  (
  `id` int(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '菜单标题',
  `icon` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '图标',
  `pid` int(0) NOT NULL DEFAULT 0 COMMENT '父id',
  `parent_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'root' COMMENT '父菜单名称',
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '菜单名称',
  `url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '链接',
  `route` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '路由',
  `target` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '_self' COMMENT '打开方式',
  `sort` int(0) NOT NULL DEFAULT 255 COMMENT '排序',
  `is_show` tinyint(1) NOT NULL DEFAULT 1 COMMENT '是否显示 默认显示',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 184 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for admin_node
-- ----------------------------
DROP TABLE IF EXISTS `admin_node`;
CREATE TABLE `admin_node`  (
  `id` int(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `parent_node_id` int(0) NOT NULL DEFAULT 0 COMMENT '父节点id',
  `parent_node` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '父节点',
  `node_title` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '节点标题',
  `node_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '节点名称',
  `routes` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '节点绑定路由 支持多个以英文逗号分隔',
  `description` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '节点描述',
  `is_menu` tinyint(0) NOT NULL DEFAULT 0 COMMENT '是否可设置为菜单',
  `is_auth` tinyint(0) NOT NULL DEFAULT 1 COMMENT '是启启动RBAC权限控制',
  `is_show` tinyint(0) NOT NULL DEFAULT 1 COMMENT '状态 1开启 0关闭',
  `sort` int(0) UNSIGNED NOT NULL DEFAULT 255 COMMENT '排序',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 351 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for admin_role
-- ----------------------------
DROP TABLE IF EXISTS `admin_role`;
CREATE TABLE `admin_role`  (
  `role_id` int(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `role_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '权限组名称',
  `auth_codes` longtext CHARACTER SET utf8 COLLATE utf8_general_ci NULL COMMENT '权限内容',
  `role_desc` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '权限组描述',
  `sort` int(0) NOT NULL DEFAULT 255 COMMENT '排序',
  `role_type` tinyint(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT 'role_type',
  `status` tinyint(0) NOT NULL DEFAULT 1 COMMENT '状态',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`role_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for article
-- ----------------------------
DROP TABLE IF EXISTS `article`;
CREATE TABLE `article`  (
  `article_id` int(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `cat_id` int(0) UNSIGNED NOT NULL COMMENT '分类id',
  `cat_model` tinyint(0) UNSIGNED NOT NULL COMMENT '展示形式',
  `cat_type` tinyint(0) NOT NULL DEFAULT 0 COMMENT '分类类型',
  `extend_cat` char(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '附加分类',
  `user_id` int(0) UNSIGNED NOT NULL COMMENT '发布人id',
  `shop_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '店铺id',
  `goods_ids` char(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '商品ids',
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '文章标题',
  `keywords` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '关键字',
  `add_time` timestamp(0) NULL DEFAULT NULL COMMENT '发布时间',
  `source` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '文章来源',
  `is_show` tinyint(1) NOT NULL DEFAULT 1 COMMENT '是否显示',
  `is_recommend` tinyint(1) NOT NULL DEFAULT 0 COMMENT '是否推荐',
  `is_comment` tinyint(1) NOT NULL DEFAULT 1 COMMENT '是否允许评论',
  `article_thumb` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '文章缩略图',
  `summary` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '文章摘要',
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '文章内容',
  `link` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '转向连接',
  `sort` int(0) UNSIGNED NOT NULL DEFAULT 255 COMMENT '排序',
  `status` tinyint(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '审核状态 0未审核 1已通过 2未通过',
  `click_number` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '点击量',
  `video` varchar(255) NOT NULL DEFAULT '' COMMENT '视频',
  `images` text COMMENT '多图 以\"|\"分隔',
  `location` varchar(255) NOT NULL DEFAULT '' COMMENT '位置',
  `live_status` tinyint(3) NOT NULL DEFAULT '0' COMMENT '直播状态 0-未直播 1-直播中 2-直播关闭',
  `push_stream` varchar(255) DEFAULT NULL COMMENT '推流地址',
  `pull_stream` varchar(500) DEFAULT NULL COMMENT '拉流地址',
  `article_type` tinyint(2) NOT NULL DEFAULT '0' COMMENT '文章类型 1-帖子 2-视频 3-直播',
  `start_time` timestamp(0) NULL DEFAULT NULL COMMENT '直播开始时间',
  `end_time` timestamp(0) NULL DEFAULT NULL COMMENT '直播结束时间',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`article_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 88 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for article_cat
-- ----------------------------
DROP TABLE IF EXISTS `article_cat`;
CREATE TABLE `article_cat`  (
  `cat_id` int(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `cat_name` char(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '分类名称',
  `parent_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '上级分类',
  `cat_model` tinyint(0) UNSIGNED NOT NULL COMMENT '展示形式 1单网页展示 2普通展示',
  `cat_type` tinyint(0) UNSIGNED NOT NULL COMMENT '分类类型',
  `cat_level` tinyint(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '分类等级',
  `cat_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '分类图片',
  `cat_desc` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '分类描述',
  `meta_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT 'META Title（分类标题）',
  `meta_keywords` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT 'META Keywords（分类关键词）',
  `meta_desc` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT 'META Description（分类描述）',
  `is_show` tinyint(1) NOT NULL DEFAULT 1 COMMENT '是否显示',
  `cat_sort` int(0) UNSIGNED NOT NULL DEFAULT 255 COMMENT '排序',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`cat_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 30 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for attr_value
-- ----------------------------
DROP TABLE IF EXISTS `attr_value`;
CREATE TABLE `attr_value`  (
  `attr_vid` int(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `attr_id` int(0) UNSIGNED NOT NULL COMMENT '属性id',
  `attr_vname` char(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '属性值名称',
  `attr_vsort` tinyint(0) UNSIGNED NOT NULL DEFAULT 255 COMMENT '排序',
  `is_delete` tinyint(1) NOT NULL DEFAULT 0 COMMENT '是否删除',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`attr_vid`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 331 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for attribute
-- ----------------------------
DROP TABLE IF EXISTS `attribute`;
CREATE TABLE `attribute`  (
  `attr_id` int(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `type_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '类型id',
  `attr_name` char(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '属性名称',
  `attr_remark` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '属性描述',
  `is_index` tinyint(1) NOT NULL DEFAULT 0 COMMENT '是否检索',
  `is_show` tinyint(1) NOT NULL DEFAULT 0 COMMENT '是否显示',
  `attr_style` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '属性样式 默认0 0多选 1单选 2文本',
  `attr_values` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL COMMENT '属性值',
  `attr_sort` int(0) UNSIGNED NOT NULL DEFAULT 255 COMMENT '排序',
  `shop_id` int(0) UNSIGNED NULL DEFAULT 0 COMMENT 'Shop id',
  `par_attr_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '上级属性或规格ID',
  `is_spec` tinyint(1) NOT NULL DEFAULT 0 COMMENT '是否规格',
  `is_linked` tinyint(1) NOT NULL DEFAULT 0 COMMENT '是否链接',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`attr_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 59 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for back_log
-- ----------------------------
DROP TABLE IF EXISTS `back_log`;
CREATE TABLE `back_log`  (
  `log_id` bigint(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `back_id` int unsigned NOT NULL DEFAULT 0 COMMENT '退款单id',
  `record_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '订单商品表主键id',
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '日志标题',
  `contents` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL COMMENT '日志内容',
  `images` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL COMMENT '日志图片',
  `headimg` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '会员头像',
  `add_time` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '添加时间',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`log_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for back_order
-- ----------------------------
DROP TABLE IF EXISTS `back_order`;
CREATE TABLE `back_order`  (
  `back_id` int(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `back_sn` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '售后编号',
  `back_type` tinyint(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '业务类型 0-无状态 1-退款 2-退款退货 3-换货 4-申请维修 5-线下业务',
  `site_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '站点id',
  `shop_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '店铺id',
  `user_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '买家id',
  `order_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '订单id',
  `delivery_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '发货单id',
  `record_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '订单商品记录编号',
  `goods_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '商品id',
  `sku_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '商品SKU ID',
  `back_number` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '退换商品数量',
  `add_time` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '添加时间',
  `last_time` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '买家最后修改时间',
  `dismiss_time` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '卖家处理时间',
  `disabled_time` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '超时时间',
  `back_status` tinyint(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '退换货单状态 0-待处理 1-同意申请 2-货物已发出 3-货物已收到 4-处理完成 5-被驳回 6-已失效 7-已撤销',
  `back_reason` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '退换货原因 1-退款不退货 2-退款退货 3-换货 4-申请维修 5-下线业务',
  `refund_money` decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '退款金额',
  `should_return` decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '应退款金额',
  `actual_return` decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '实际退款金额',
  `return_shipping_fee` decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '退款运费金额',
  `refund_type` tinyint(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '退款方式 默认0 0退回账户余额 1退回原支付方式',
  `refund_status` tinyint(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT 'Refund status 默认0',
  `back_desc` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '退换货说明',
  `back_img1` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT 'Back Img1',
  `back_img2` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT 'Back Img2',
  `back_img3` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT 'Back Img3',
  `send_time` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT 'Send Time',
  `shipping_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '买家寄出商品物流公司ID',
  `shipping_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '买家寄出商品物流公司代码',
  `shipping_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '买家寄出商品物流公司名称',
  `shipping_sn` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '买家寄出商品物流单号',
  `seller_reason` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT 'Seller Reason',
  `seller_desc` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '退货说明',
  `seller_img1` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT 'Seller Img1',
  `seller_img2` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT 'Seller Img2',
  `seller_img3` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT 'Seller Img3',
  `seller_address` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '卖家收货地址',
  `reminder_times` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT 'Reminder Times',
  `exchange_reason` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '申请换货的原因',
  `repair_reason` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '申请维修的原因',
  `user_address` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '买家收货地址',
  `exchange_desc` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '换货说明',
  `repair_desc` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '维修说明',
  `is_after_sale` tinyint(1) NOT NULL DEFAULT 0 COMMENT '是否售后 默认0 0售前 1售后',
  `update_time` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '更新时间',
  `negative_id` int(0) NOT NULL DEFAULT 0 COMMENT '负账单ID',
  `return_rate_price` decimal(10, 2) NOT NULL COMMENT '退税金额',
  `chargeoff_status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '账单 (0:未结账 1:已出账 2:已结账单)',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`back_id`) USING BTREE,
  INDEX `negative_id`(`negative_id`) USING BTREE,
  INDEX `chargeoff_status`(`chargeoff_status`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for bonus
-- ----------------------------
DROP TABLE IF EXISTS `bonus`;
CREATE TABLE `bonus`  (
  `bonus_id` int(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `shop_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '店铺id',
  `bonus_type` tinyint(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '红包类型 默认0 1-主动领红包/到店送红包 2-收藏送红包 4-会员送红包 6-注册送红包 9-推荐送红包 10-积分兑换红包',
  `bonus_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '红包名称',
  `bonus_desc` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '红包描述',
  `bonus_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '红包图片',
  `send_type` tinyint(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT 'send type',
  `bonus_amount` decimal(10, 2) NOT NULL COMMENT '红包面值',
  `receive_count` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '每人限领数量',
  `bonus_number` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '红包发放数量',
  `use_range` tinyint(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '使用范围 默认0 0-全部商品 1-指定商品',
  `bonus_data` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL COMMENT '红包扩展数据 序列化存储',
  `min_goods_amount` decimal(10, 2) NOT NULL COMMENT '最小订单金额限制',
  `is_original_price` tinyint(1) NOT NULL DEFAULT 1 COMMENT '仅限原价购买时使用 0-可与其他优惠、活动一起使用 1-仅限原价购买时使用',
  `start_time` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '红包发放起始时间',
  `end_time` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '红包发放截至时间',
  `is_enable` tinyint(1) NOT NULL DEFAULT 1 COMMENT '是否有效 0-无效 1-有效',
  `is_delete` tinyint(1) NOT NULL DEFAULT 0 COMMENT '是否删除 0-未删除 1-已删除',
  `add_time` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '红包添加时间',
  `sort` int(0) UNSIGNED NOT NULL DEFAULT 255 COMMENT '排序',
  `receive_number` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '已领取数量',
  `used_number` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '已使用数量',
  `goods_ids` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '红包商品ids 多个以逗号分隔',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`bonus_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 23 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = '红包表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for brand
-- ----------------------------
DROP TABLE IF EXISTS `brand`;
CREATE TABLE `brand`  (
  `brand_id` int(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `brand_name` char(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '品牌名称',
  `brand_letter` char(1) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '品牌首字母',
  `site_url` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '品牌网址',
  `brand_logo` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '品牌logo',
  `brand_banner` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '品牌banner图',
  `promotion_image` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '品牌推广图',
  `brand_desc` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL COMMENT '品牌描述',
  `is_show` tinyint(1) NOT NULL DEFAULT 1 COMMENT '是否显示',
  `is_recommend` tinyint(1) NOT NULL DEFAULT 0 COMMENT '是否推荐',
  `brand_apply` tinyint(1) NOT NULL DEFAULT 0 COMMENT '审核是否通过',
  `brand_sort` int(0) UNSIGNED NOT NULL DEFAULT 255 COMMENT '排序',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`brand_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 23 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for brand_category
-- ----------------------------
DROP TABLE IF EXISTS `brand_category`;
CREATE TABLE `brand_category`  (
  `bc_id` int(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `brand_id` int(0) UNSIGNED NOT NULL COMMENT '品牌id',
  `cat_id` int(0) UNSIGNED NOT NULL COMMENT '商品分类id',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`bc_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 123 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for brand_libraries
-- ----------------------------
DROP TABLE IF EXISTS `brand_libraries`;
CREATE TABLE `brand_libraries`  (
  `id` int(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for cart
-- ----------------------------
DROP TABLE IF EXISTS `cart`;
CREATE TABLE `cart`  (
  `cart_id` int(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(0) UNSIGNED NOT NULL COMMENT '会员id',
  `session_id` char(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'session',
  `shop_id` int(0) UNSIGNED NOT NULL COMMENT '店铺id',
  `goods_id` int(0) UNSIGNED NOT NULL COMMENT '商品id',
  `sku_id` int(0) UNSIGNED NOT NULL COMMENT '商品id',
  `cart_act_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '商品活动id 默认0 无活动',
  `goods_name` char(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '商品名称',
  `goods_number` int(0) UNSIGNED NOT NULL COMMENT '购买数量',
  `goods_price` decimal(11, 2) NOT NULL COMMENT '本店价',
  `goods_type` int(0) UNSIGNED NOT NULL DEFAULT 0,
  `parent_id` int(0) UNSIGNED NOT NULL DEFAULT 0,
  `is_gift` tinyint(1) NOT NULL DEFAULT 0 COMMENT '是否赠品',
  `buyer_type` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '买家类型 0-个人 1-店铺',
  `add_time` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '添加时间',
  `select` tinyint(0) NOT NULL DEFAULT 1 COMMENT '购物车选中状态',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`cart_id`) USING BTREE,
  INDEX `session_id`(`session_id`) USING BTREE,
  INDEX `user_id`(`user_id`) USING BTREE,
  INDEX `goods_id`(`goods_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 130 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = '购物车表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for cat_attribute
-- ----------------------------
DROP TABLE IF EXISTS `cat_attribute`;
CREATE TABLE `cat_attribute`  (
  `cat_attr_id` int(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `cat_id` int(0) UNSIGNED NOT NULL COMMENT '商品分类id',
  `attr_id` int(0) UNSIGNED NOT NULL COMMENT '属性规格id',
  `is_required` tinyint(1) NOT NULL DEFAULT 0 COMMENT '是否必填',
  `is_show` tinyint(1) NOT NULL DEFAULT 1 COMMENT '是否显示',
  `is_default` tinyint(1) NOT NULL DEFAULT 1 COMMENT '是否默认',
  `is_input` tinyint(1) NOT NULL DEFAULT 0 COMMENT '是否允许输入平台方未提供的规格',
  `is_alias` tinyint(1) NOT NULL DEFAULT 0 COMMENT '是否启用别名 启用后此规格的名称可以被店铺修改',
  `is_spec` tinyint(1) NOT NULL DEFAULT 0 COMMENT '是否规格 0属性 1规格',
  `is_desc` tinyint(1) NOT NULL DEFAULT 0 COMMENT '是否可以为规格添加备注',
  `is_filter` tinyint(1) NOT NULL DEFAULT 0 COMMENT '是否作为筛选条件展示',
  `group_name` char(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '分组名称',
  `sort` int(0) UNSIGNED NOT NULL DEFAULT 255 COMMENT '排序',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`cat_attr_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = '分类属性规格表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for category
-- ----------------------------
DROP TABLE IF EXISTS `category`;
CREATE TABLE `category`  (
  `cat_id` int(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `cat_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '分类名称',
  `parent_id` smallint(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '上级分类，商品分类最多支持三级',
  `cat_level` smallint(0) NOT NULL DEFAULT 1 COMMENT '分类级别',
  `cat_image` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '分类图标',
  `cat_name_pinyin_short` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '分类名称拼音首字母简写',
  `cat_name_pinyin` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '分类名称全拼',
  `ext_info` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '分类扩展字段',
  `cat_desc` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '分类描述',
  `take_rate` decimal(5, 2) UNSIGNED NOT NULL COMMENT '佣金比例',
  `sync_take_rate` tinyint(1) NOT NULL DEFAULT 0 COMMENT '佣金比例是否关联到子分类',
  `show_mode` smallint(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '商品列表页商品展示方式',
  `is_parent` tinyint(1) NOT NULL DEFAULT 0 COMMENT '是否允许新增下级分类',
  `is_show` tinyint(1) NULL DEFAULT 1 COMMENT '是否显示',
  `show_virtual` tinyint(1) NOT NULL DEFAULT 0 COMMENT '是否允许发布虚拟商品',
  `sync_show_virtual` tinyint(1) NOT NULL DEFAULT 0 COMMENT '发布虚拟商品是否关联到子分类',
  `link_type` smallint(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '链接类型',
  `cat_link` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '分类链接',
  `image_link` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `cat_sort` int(0) UNSIGNED NOT NULL DEFAULT 255 COMMENT '排序',
  `brand_ids` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '关联品牌ids',
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT 'seo title',
  `keywords` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT 'seo keywords',
  `discription` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT 'seo discription',
  `code` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '分类code',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`cat_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 106 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for chat_message
-- ----------------------------
DROP TABLE IF EXISTS `chat_message`;
CREATE TABLE `chat_message` (
    `message_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '消息ID',
    `sender_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '发送者ID',
    `receiver_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '接收者ID',
    `scene_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '业务场景 1-普通消息 2-邀请同行 3-私信消息 4-直播弹幕',
    `target_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '目标ID',
    `message` varchar(255) NOT NULL DEFAULT '' COMMENT '消息内容',
    `extra` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL COMMENT '额外信息',
    `read_at` timestamp NULL DEFAULT NULL COMMENT '消息已读时间',
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`message_id`),
    KEY `chat_message_scene_id_index` (`scene_id`),
    KEY `chat_message_receiver_id_index` (`receiver_id`),
    KEY `chat_message_sender_id_index` (`sender_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='聊天消息表';

-- ----------------------------
-- Table structure for collect
-- ----------------------------
DROP TABLE IF EXISTS `collect`;
CREATE TABLE `collect`  (
  `collect_id` int(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '会员id',
  `collect_type` tinyint(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '收藏类型 默认0 0商品收藏 1店铺收藏 2品牌收藏',
  `goods_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '商品id',
  `sku_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '商品SKU id',
  `goods_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '商品名称',
  `collect_price` decimal(10, 2) NOT NULL COMMENT '收藏商品价格',
  `is_buyed` tinyint(1) NOT NULL DEFAULT 0 COMMENT '是否购买过',
  `shop_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '店铺id',
  `add_time` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '收藏时间',
  `collect_from` tinyint(0) UNSIGNED NOT NULL DEFAULT 1 COMMENT '收藏来源 1PC端 2微信端 3Android端 4IOS端',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`collect_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 13 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = '商品或店铺收藏表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for compare
-- ----------------------------
DROP TABLE IF EXISTS `compare`;
CREATE TABLE `compare`  (
  `compare_id` int(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '会员id',
  `goods_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '商品id',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`compare_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 54 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for complaint
-- ----------------------------
DROP TABLE IF EXISTS `complaint`;
CREATE TABLE `complaint`  (
  `complaint_id` int(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `complaint_sn` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '投诉编号',
  `order_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '投诉的订单ID',
  `goods_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '投诉的商品ID',
  `sku_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '投诉的商品Sku ID',
  `shop_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '投诉的店铺ID',
  `user_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '投诉的用户ID',
  `parent_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '上级投诉ID',
  `role_type` tinyint(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '角色类型 0-买家 1-卖家 2-平台',
  `complaint_type` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '投诉原因',
  `complaint_mobile` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '联系电话',
  `complaint_images` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL COMMENT '上传投诉凭证图片',
  `complaint_desc` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL COMMENT '投诉说明',
  `complaint_status` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '投诉处理状态 0- 等待卖家处理  1 - 卖家已回复  2-买家撤销投诉 3 - 平台方介入 4-平台方仲裁中  5- 仲裁成功  6-仲裁失败',
  `add_time` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '创建时间',
  `close_time` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '关闭时间',
  `deduct_credit` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '店铺扣分',
  `deduct_money` decimal(10, 2) NOT NULL COMMENT '店铺罚款',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`complaint_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for contract
-- ----------------------------
DROP TABLE IF EXISTS `contract`;
CREATE TABLE `contract`  (
  `contract_id` int(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `contract_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '保障服务名称',
  `contract_fee` decimal(10, 2) NOT NULL COMMENT '保证金',
  `contract_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '保障服务图标',
  `contract_type` tinyint(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '保障类型',
  `contract_desc` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '保障服务描述',
  `is_open` tinyint(1) NOT NULL DEFAULT 1 COMMENT '是否开启',
  `contract_sort` int(0) UNSIGNED NOT NULL DEFAULT 255 COMMENT '排序',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`contract_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for copyright_auth
-- ----------------------------
DROP TABLE IF EXISTS `copyright_auth`;
CREATE TABLE `copyright_auth`  (
  `auth_id` int(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `auth_name` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '资质名称',
  `auth_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '资质图标',
  `links_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '链接地址',
  `is_show` tinyint(1) NOT NULL DEFAULT 0 COMMENT '是否显示',
  `auth_sort` int(0) UNSIGNED NOT NULL DEFAULT 255 COMMENT '排序',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`auth_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for custom_form_data
-- ----------------------------
DROP TABLE IF EXISTS `custom_form_data`;
CREATE TABLE `custom_form_data`  (
  `id` int(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `form_id` int(0) NOT NULL DEFAULT 0 COMMENT '表单id',
  `user_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '会员id',
  `user_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '会员名',
  `add_time` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '提交时间',
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '提交地点',
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '姓名',
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '电话',
  `form_data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL COMMENT '表单数据',
  `location` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '所在地区 如：云南省昆明市',
  `ip` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT 'ip地址',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for custom_form_template
-- ----------------------------
DROP TABLE IF EXISTS `custom_form_template`;
CREATE TABLE `custom_form_template`  (
  `id` int(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `group` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '模板类型',
  `code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '模板code',
  `preview_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '预览大图',
  `thumb_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '缩略图',
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '模板标题',
  `form_datas` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL COMMENT '表单数据',
  `global_form_datas` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL COMMENT '表单全局数据',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 17 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for customer
-- ----------------------------
DROP TABLE IF EXISTS `customer`;
CREATE TABLE `customer`  (
  `customer_id` int(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `shop_id` int(0) UNSIGNED NOT NULL COMMENT '店铺id',
  `type_id` int(0) UNSIGNED NOT NULL COMMENT '客服类型id',
  `customer_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '客服名称',
  `customer_tool` tinyint(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '客服工具 默认0 1QQ 2旺旺 3翼客服',
  `customer_account` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '客服账号',
  `is_main` tinyint(1) NOT NULL DEFAULT 0 COMMENT '是否主客服',
  `is_show` tinyint(1) NOT NULL DEFAULT 1 COMMENT '是否显示',
  `customer_sort` int(0) UNSIGNED NOT NULL DEFAULT 255 COMMENT '排序',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`customer_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for customer_type
-- ----------------------------
DROP TABLE IF EXISTS `customer_type`;
CREATE TABLE `customer_type`  (
  `type_id` int(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `shop_id` int(0) UNSIGNED NOT NULL COMMENT '店铺id',
  `type_name` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '客服类型名称',
  `type_desc` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '客服类型描述',
  `is_show` tinyint(1) NOT NULL DEFAULT 1 COMMENT '是否显示',
  `type_sort` int(0) UNSIGNED NOT NULL DEFAULT 255 COMMENT '排序',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`type_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for default_search
-- ----------------------------
DROP TABLE IF EXISTS `default_search`;
CREATE TABLE `default_search`  (
  `id` int(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `search_type` tinyint(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '搜索类型 0默认 1商品分类',
  `type_id` int(0) UNSIGNED NULL DEFAULT NULL COMMENT '分类id',
  `search_keywords` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '搜索词参与搜索，按回车区分词',
  `is_show` tinyint(1) NOT NULL DEFAULT 1 COMMENT '是否显示',
  `sort` int(0) UNSIGNED NOT NULL DEFAULT 255 COMMENT '排序',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for delivery_goods
-- ----------------------------
DROP TABLE IF EXISTS `delivery_goods`;
CREATE TABLE `delivery_goods`  (
  `id` int(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `order_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '订单id',
  `delivery_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '发货单id',
  `record_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '订单商品表主键id',
  `goods_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '商品id',
  `sku_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '商品SKU id',
  `send_number` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '发货数量',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = '发货单商品表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for delivery_order
-- ----------------------------
DROP TABLE IF EXISTS `delivery_order`;
CREATE TABLE `delivery_order`  (
  `delivery_id` int(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `delivery_sn` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '发货单sn',
  `order_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '订单id',
  `user_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '买家id',
  `shipping_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '物流公司id',
  `shipping_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '物流公司代号',
  `shipping_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '物流公司名称',
  `shipping_type` tinyint(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '新配送方式 0 无需物流 1 指派 2 众包 3 第三方物流',
  `delivery_charge` decimal(10, 2) NOT NULL COMMENT 'delivery_charge',
  `sender_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '发货店铺id',
  `region_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '发货地址code',
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '发货人名称',
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '发货人详细地址',
  `tel` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '发货人联系方式',
  `express_sn` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '物流编号',
  `delivery_status` tinyint(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '发货单状态 0-待发货 1-已发货 2-发货中 3-已提交物流系统',
  `add_time` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '发货单添加时间',
  `send_time` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '发货时间',
  `icode` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT 'icode',
  `is_show` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '是否显示 如：\"1,2,3,4\"',
  `is_arrived` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'is arrived 默认0',
  `exception_reason` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '异常原因',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`delivery_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = '发货单订单表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for deposit_account
-- ----------------------------
DROP TABLE IF EXISTS `deposit_account`;
CREATE TABLE `deposit_account`  (
  `id` int(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `account_type` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '提现方式 银行转账 支付宝',
  `account_name` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '收款人姓名',
  `account` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '银行卡号或支付宝账号',
  `bank_account` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '开户行',
  `user_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '会员id',
  `shop_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '店铺id',
  `site_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '站点id',
  `store_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '网点id',
  `is_default` tinyint(1) NOT NULL DEFAULT 0 COMMENT '是否默认提现账户 默认0 0-否 1-是',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = '会员提现账户表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for failed_jobs
-- ----------------------------
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs`  (
  `id` bigint(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 87 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for form
-- ----------------------------
DROP TABLE IF EXISTS `form`;
CREATE TABLE `form`  (
  `form_id` int(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `shop_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '店铺id',
  `site_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '网点id',
  `user_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '用户id',
  `fb_num` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '反馈数',
  `add_time` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '添加时间',
  `update_time` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '更新时间',
  `is_publish` tinyint(1) NOT NULL DEFAULT 0 COMMENT '是否发布 0-否 1-是',
  `need_login` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '是否需要登录 0-否 1-是',
  `form_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '表单标题',
  `form_data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL COMMENT '表单设计数据',
  `global_data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL COMMENT '表单设计全局数据',
  `header_style` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '去除头部（PC端）',
  `bottom_style` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '去除底部（PC端）',
  `form_keyword` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '关键词',
  `form_desc` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '描述',
  `share_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '分享推广图',
  `commit_mode` tinyint(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '允许用户提交次数 默认0 0-只允许提交一次 1-可参与多次（取最后一次为结果） 2-可参与多次（每天最多可以投10次，投票结果可以累加）',
  `start_time` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '有效期开始时间',
  `end_time` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '有效期结束时间',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`form_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for freight
-- ----------------------------
DROP TABLE IF EXISTS `freight`;
CREATE TABLE `freight`  (
  `freight_id` int(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `shop_id` int(0) UNSIGNED NOT NULL COMMENT '商家编号',
  `freight_type` tinyint(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '运费模板类型 默认0 0全国运费模板 1同城运费模板',
  `title` char(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '模板名称',
  `region_code` char(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '商品所在地',
  `is_free` tinyint(1) NOT NULL DEFAULT 0 COMMENT '是否包邮 0自定义运费 1卖家承担运费',
  `valuation` tinyint(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '计价方式 0件数 1重量 2体积',
  `limit_sale` tinyint(1) NOT NULL DEFAULT 0 COMMENT '是否支持区域限售 0不支持 1支持',
  `free_set` tinyint(1) NOT NULL DEFAULT 0 COMMENT '是否指定条件包邮 0否 1是',
  `add_time` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '添加时间',
  `last_time` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '修改时间',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`freight_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for freight_free_record
-- ----------------------------
DROP TABLE IF EXISTS `freight_free_record`;
CREATE TABLE `freight_free_record`  (
  `record_id` int(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `freight_id` int(0) UNSIGNED NOT NULL COMMENT '运费模板id',
  `is_default` tinyint(1) NOT NULL DEFAULT 0 COMMENT '是否默认运费 0否 1是',
  `region_codes` char(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT 'region_codes',
  `region_names` char(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT 'region_names',
  `region_path` char(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT 'region_path',
  `free_money` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '包邮条件 满多少元',
  `free_number` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '包邮条件 满多少件',
  `free_mode` tinyint(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '包邮模式 0件数 1金额 2件数+金额 3件数或金额',
  `add_time` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '添加时间',
  `last_time` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '修改时间',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`record_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for freight_record
-- ----------------------------
DROP TABLE IF EXISTS `freight_record`;
CREATE TABLE `freight_record`  (
  `record_id` int(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `freight_id` int(0) UNSIGNED NOT NULL COMMENT '运费模板id',
  `is_default` tinyint(1) NOT NULL DEFAULT 0 COMMENT '是否默认运费 0否 1是',
  `region_codes` char(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT 'region_codes',
  `region_names` char(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT 'region_names',
  `region_path` char(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT 'region_path',
  `region_desc` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT 'region_desc',
  `region_color` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT 'region_color',
  `start_num` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '首体积 不能小于0.1 必须不大于9999.9',
  `start_money` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '首费',
  `plus_num` int(0) UNSIGNED NOT NULL DEFAULT 1 COMMENT '续件',
  `plus_money` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '续费',
  `is_cash` tinyint(1) NOT NULL DEFAULT 0 COMMENT '是否支持货到付款 0否 1是',
  `cash_more` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '货到付款加价',
  `sort` int(0) UNSIGNED NOT NULL DEFAULT 255 COMMENT '排序',
  `add_time` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '添加时间',
  `last_time` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '修改时间',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`record_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for goods
-- ----------------------------
DROP TABLE IF EXISTS `goods`;
CREATE TABLE `goods`  (
  `goods_id` int(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `goods_name` char(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '商品名称',
  `cat_id` int(0) UNSIGNED NOT NULL COMMENT '商品分类',
  `cat_id1` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '商品一级分类',
  `cat_id2` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '商品二级分类',
  `cat_id3` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '商品三级分类',
  `shop_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '店铺ID',
  `sku_open` tinyint(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT 'Sku Open',
  `sku_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT 'Sku Id',
  `sku_mode` tinyint(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT 'SKU 模式',
  `prop_open` tinyint(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '属性开关',
  `street_sort` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '店铺街排序',
  `goods_subname` char(140) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '商品卖点',
  `goods_price` decimal(10, 2) NOT NULL COMMENT '店铺价',
  `market_price` decimal(10, 2) NOT NULL COMMENT '市场价',
  `cost_price` decimal(10, 2) NOT NULL COMMENT '成本价',
  `mobile_price` decimal(10, 2) NOT NULL COMMENT '移动端专项价',
  `give_integral` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '赠送积分',
  `goods_number` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '商品库存',
  `warn_number` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '库存警告数量',
  `goods_sn` char(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '商品货号',
  `goods_barcode` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL COMMENT '商品条形码 支持一品多码，多个条形码之间用逗号分隔',
  `cover_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '商品封面图',
  `goods_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '商品主图',
  `goods_images` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL COMMENT '商品图片',
  `goods_video` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '主图视频',
  `brand_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '商品品牌',
  `pc_desc` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL COMMENT '商品电脑端描述',
  `mobile_desc` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL COMMENT '商品手机端描述',
  `top_layout_id` smallint(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '顶部模板',
  `bottom_layout_id` smallint(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '底部模板',
  `packing_layout_id` smallint(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '包装清单版式',
  `service_layout_id` smallint(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '售后保证版式',
  `click_count` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '商品浏览次数',
  `keywords` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '关键词',
  `goods_info` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '商品简介',
  `invoice_type` tinyint(0) NOT NULL DEFAULT 0 COMMENT '发票类型 默认 0 0无 1增值税普通发票 2增值税专用发票 3增值税普通发票 和 增值税专用发票选择“无”则将不提供发票',
  `is_repair` tinyint(1) NOT NULL DEFAULT 0 COMMENT '是否保修',
  `user_discount` tinyint(0) NOT NULL DEFAULT 0 COMMENT '会员打折',
  `stock_mode` tinyint(0) NOT NULL DEFAULT 0 COMMENT '库存计数 0拍下减库存 1付款减库存 2出库减库存',
  `comment_num` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '商品评论次数',
  `sale_num` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '商品销售数量',
  `multi_store_sale_num` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '门店销量',
  `collect_num` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '商品收藏数量',
  `goods_audit` tinyint(1) NOT NULL DEFAULT 0 COMMENT '审核是否通过 默认0 0-待审核 1-审核通过 2-审核未通过',
  `goods_status` tinyint(0) NOT NULL DEFAULT 0 COMMENT '商品状态 默认1 0-已下架(定时发布) 1-出售中(立即发布) 2-违规下架(放入仓库)',
  `goods_reason` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT 'Goods Reason',
  `is_delete` tinyint(1) NOT NULL DEFAULT 0 COMMENT '是否已删除',
  `is_virtual` tinyint(1) NOT NULL DEFAULT 0 COMMENT '是否虚拟商品',
  `is_best` tinyint(1) NOT NULL DEFAULT 0 COMMENT '是否精品',
  `is_new` tinyint(1) NOT NULL DEFAULT 0 COMMENT '是否新品',
  `is_hot` tinyint(1) NOT NULL DEFAULT 0 COMMENT '是否热卖',
  `is_promote` tinyint(1) NOT NULL DEFAULT 0 COMMENT '是否促销',
  `tag_id` int(0) NOT NULL DEFAULT 0 COMMENT '标签id',
  `shipper_id` int(0) NOT NULL DEFAULT 0 COMMENT '商品发货方ID',
  `contract_ids` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '保障服务',
  `supplier_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '供货商ID',
  `freight_id` smallint(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '运费模板',
  `goods_freight_type` tinyint(0) NOT NULL DEFAULT 0 COMMENT '运费设置',
  `goods_freight_fee` decimal(10, 2) NOT NULL COMMENT '固定运费',
  `goods_stockcode` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '商品库位码',
  `goods_volume` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '物流体积(m3)',
  `goods_weight` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '物流重量(Kg)',
  `goods_remark` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL COMMENT '商品备注 序列化存储',
  `goods_sort` int(0) UNSIGNED NOT NULL DEFAULT 255 COMMENT '商品排序',
  `add_time` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '商品发布时间',
  `last_time` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '最后一次更新时间',
  `audit_time` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '商品审核时间',
  `edit_items` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL COMMENT '更多商品编辑项',
  `act_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '活动id 默认0 0无活动',
  `goods_moq` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '最小起订量',
  `lib_goods_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '商品库商品id',
  `other_attrs` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL COMMENT '店铺自定义属性',
  `filter_attr_ids` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '商品属性ids',
  `filter_attr_vids` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '商品属性值ids',
  `button_name` char(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '按钮名称',
  `button_url` char(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '按钮链接',
  `pricing_mode` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '计价方式 默认0 0计件 1计重',
  `goods_unit` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '商品单位',
  `sales_model` tinyint(0) NOT NULL DEFAULT 0 COMMENT '销售模式 默认0 0零售 1批发',
  `sales_area` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '销售区域',
  `order_act_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT 'order act id',
  `goods_mode` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '商品类别 默认0 0实物商品（物流发货） 1电子卡券（无需物流） 2服务商品（无需物流）',
  `ext_info` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL COMMENT '扩展字段信息',
  `remark` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL COMMENT '备注信息',
  `shop_cat_ids` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '店铺内商品分类',
  `erp_goods_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT 'erp_goods_id',
  `goods_from` char(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '商品来源',
  `is_cross_border` tinyint(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '是否跨境商品',
  `is_sync_stock` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'is_sync_stock',
  `is_sync_price` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'is_sync_price',
  `is_sync_onoff` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'is_sync_onoff',
  `cs_dg_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT 'cs_dg_id',
  `is_pickup` tinyint(1) NOT NULL DEFAULT 0 COMMENT '是否自提',
  `is_common_package` tinyint(1) NOT NULL DEFAULT 0 COMMENT '是否普通快递',
  `pickup_timeout` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '商品自提超时期限',
  `pickup_timeout_type` tinyint(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '商品自提超时期限类型 0-分钟 1-小时 2-天',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`goods_id`) USING BTREE,
  INDEX `goods_cat_id_shop_id_sku_id_brand_id_index`(`cat_id`, `shop_id`, `sku_id`, `brand_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 44 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for goods_activity
-- ----------------------------
DROP TABLE IF EXISTS `goods_activity`;
CREATE TABLE `goods_activity`  (
  `id` int(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `shop_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '店铺ID',
  `store_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '门店ID',
  `act_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '活动表主键id',
  `sku_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '商品SKU ID',
  `act_type` tinyint(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '活动类型 默认0 ',
  `goods_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '商品id',
  `cat_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '活动分类id',
  `sale_base` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '销量基数',
  `act_price` decimal(10, 2) NOT NULL COMMENT '活动价格',
  `act_stock` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '活动库存',
  `is_enable` tinyint(3) NOT NULL DEFAULT '0' COMMENT '是否有效 0-已取消 1-有效',
  `ext_info` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL COMMENT '扩展字段',
  `sort` int(0) UNSIGNED NOT NULL DEFAULT 255 COMMENT '排序',
  `click_count` int(0) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = '活动表关联商品表 一对一' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for goods_attr
-- ----------------------------
DROP TABLE IF EXISTS `goods_attr`;
CREATE TABLE `goods_attr`  (
  `id` int(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `goods_id` int(0) UNSIGNED NOT NULL COMMENT '商品SPU id',
  `attr_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '属性id',
  `attr_vid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '属性值的id 只有分类绑定的平台属性才有',
  `attr_name` char(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '属性名称',
  `attr_vname` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '属性值的名称',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 129 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for goods_cat
-- ----------------------------
DROP TABLE IF EXISTS `goods_cat`;
CREATE TABLE `goods_cat`  (
  `goods_id` int(0) NOT NULL DEFAULT 0 COMMENT '商品id',
  `cat_id` int(0) NOT NULL DEFAULT 0 COMMENT '分类id',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`goods_id`, `cat_id`) USING BTREE,
  INDEX `goods_id`(`goods_id`) USING BTREE,
  INDEX `cat_id`(`cat_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = '商品扩展分类表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for goods_comment
-- ----------------------------
DROP TABLE IF EXISTS `goods_comment`;
CREATE TABLE `goods_comment`  (
  `comment_id` int(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `record_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '订单商品表主键id',
  `user_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '会员id',
  `user_nick` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '会员昵称',
  `user_rank_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '会员等级id',
  `site_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '站点id',
  `shop_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '店铺id',
  `order_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '订单id',
  `goods_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '商品id',
  `sku_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '商品SKU id',
  `desc_mark` tinyint(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '描述相符 默认0',
  `comment_desc` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL COMMENT '评价内容',
  `comment_img1` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '晒图片1',
  `comment_img2` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '晒图片2',
  `comment_img3` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '晒图片3',
  `comment_img4` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '晒图片4',
  `comment_img5` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '晒图片5',
  `is_anonymous` tinyint(1) NOT NULL DEFAULT 0 COMMENT '是否匿名评价 默认0',
  `comment_time` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '评价时间',
  `comment_status` tinyint(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '评价状态 默认0 0待审核 1审核通过 2审核拒绝',
  `is_show` tinyint(1) NOT NULL DEFAULT 0 COMMENT '是否显示评价 默认0 0不显示 1显示',
  `add_comment_desc` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL COMMENT '追加评价内容',
  `add_img1` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '追加晒图片1',
  `add_img2` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '追加晒图片2',
  `add_img3` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '追加晒图片3',
  `add_img4` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '追加晒图片4',
  `add_img5` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '追加晒图片5',
  `add_is_anonymous` tinyint(1) NOT NULL DEFAULT 0 COMMENT '是否匿名追加评价 默认0',
  `add_time` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '追加评价时间',
  `add_status` tinyint(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '追加评价状态 默认0 0待审核 1审核通过 2审核拒绝',
  `add_is_show` tinyint(1) NOT NULL DEFAULT 0 COMMENT '是否显示追加评价 默认0 0不显示 1显示',
  `seller_reply_desc` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL COMMENT '卖家回复内容',
  `seller_reply_time` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '卖家回复时间',
  `user_reply_desc` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL COMMENT '买家回复内容',
  `user_reply_time` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '买家回复时间',
  `is_delete` tinyint(1) NOT NULL DEFAULT 0 COMMENT '是否删除 默认0 0正常 1已删除',
  `evaluate_status` tinyint(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '评价状态 默认0 待评价 1初次评价完成 2追加评价完成',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`comment_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = '商品买家评价表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for goods_history
-- ----------------------------
DROP TABLE IF EXISTS `goods_history`;
CREATE TABLE `goods_history`  (
  `history_id` int(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `goods_id` int(0) UNSIGNED NOT NULL COMMENT '商品id',
  `user_id` int(0) UNSIGNED NOT NULL COMMENT '会员id',
  `cat_id` int(0) UNSIGNED NOT NULL COMMENT '商品分类id',
  `cat_id1` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '商品一级分类',
  `cat_id2` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '商品二级分类',
  `cat_id3` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '商品三级分类',
  `history_price` decimal(10, 2) NOT NULL COMMENT '历史价格',
  `look_time` int(0) NOT NULL DEFAULT 0 COMMENT '当前登录用户查看时间',
  `look_count` int(0) NOT NULL DEFAULT 0 COMMENT '当前登录用户查看次数',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`history_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 56 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for goods_image
-- ----------------------------
DROP TABLE IF EXISTS `goods_image`;
CREATE TABLE `goods_image`  (
  `img_id` int(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `goods_id` int(0) UNSIGNED NOT NULL COMMENT '商品id',
  `spec_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '规格id',
  `path` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '图片路径',
  `is_default` tinyint(1) NOT NULL DEFAULT 0 COMMENT '是否默认',
  `sort` tinyint(0) UNSIGNED NOT NULL DEFAULT 1 COMMENT '排序',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`img_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 637 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for goods_layout
-- ----------------------------
DROP TABLE IF EXISTS `goods_layout`;
CREATE TABLE `goods_layout`  (
  `layout_id` int(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `shop_id` int(0) UNSIGNED NOT NULL COMMENT '店铺id',
  `layout_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '模板名称',
  `position` tinyint(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '模板位置',
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '模板内容',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`layout_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for goods_sku
-- ----------------------------
DROP TABLE IF EXISTS `goods_sku`;
CREATE TABLE `goods_sku`  (
  `sku_id` int(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `goods_id` int(0) UNSIGNED NOT NULL COMMENT '商品SPU id',
  `sku_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '商品SKU名称',
  `sku_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '商品SKU图片',
  `sku_images` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL COMMENT '商品SKU相册图片 序列化存储',
  `spec_ids` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '商品规格表主键id spec_id 多个以\"|\"分隔 格式：12|21|32',
  `spec_vids` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '商品规格表规格值id attr_vid 多个以\"|\"分隔 格式：232|332|224',
  `spec_names` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '商品规格表规格值名称键值对 attr_name:attr_value 多个以\"|\"分隔 格式：网络:4G|内存:32G|颜色:金色',
  `goods_price` decimal(10, 2) NOT NULL COMMENT '店铺价',
  `mobile_price` decimal(10, 2) NOT NULL COMMENT '手机端价格',
  `market_price` decimal(10, 2) NOT NULL COMMENT '市场价',
  `cost_price` decimal(10, 2) UNSIGNED NOT NULL COMMENT '成本价',
  `goods_number` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '商品库存',
  `sku_number_version` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '商品SKU库存数量版本号 默认0',
  `goods_sn` char(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '商品货号',
  `goods_barcode` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL COMMENT '商品条形码 支持一品多码，多个条形码之间用逗号分隔',
  `warn_number` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '库存警告数量',
  `goods_stockcode` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '商品库位码',
  `goods_weight` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '物流重量(Kg)',
  `goods_volume` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '物流体积(m3)',
  `pc_desc` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL COMMENT '商品电脑端描述',
  `mobile_desc` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL COMMENT '商品手机端描述',
  `is_spu` tinyint(1) NOT NULL DEFAULT 1 COMMENT '是否SPU 默认1',
  `checked` tinyint(1) NOT NULL DEFAULT 1 COMMENT '是否可用 默认1',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`sku_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 55 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = '商品SKU表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for goods_spec
-- ----------------------------
DROP TABLE IF EXISTS `goods_spec`;
CREATE TABLE `goods_spec`  (
  `spec_id` int(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `goods_id` int(0) UNSIGNED NOT NULL COMMENT '商品SPU id',
  `attr_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '规格id',
  `attr_vid` int(0) UNSIGNED NOT NULL COMMENT '规格值id',
  `cat_id` int(0) UNSIGNED NOT NULL COMMENT '商品分类id',
  `attr_value` char(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '规格值名称',
  `attr_desc` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '规格描述',
  `is_checked` tinyint(1) NOT NULL DEFAULT 0 COMMENT '是否选中 默认否',
  `spec_sort` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '排序',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`spec_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 34 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = '商品规格表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for goods_tag
-- ----------------------------
DROP TABLE IF EXISTS `goods_tag`;
CREATE TABLE `goods_tag`  (
  `tag_id` int(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `shop_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '店铺id',
  `tag_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '标签名称',
  `tag_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '标签图片',
  `tag_shape` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '标签形状',
  `tag_position` tinyint(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '标签位置 默认0 0-左上角 1-右上角 2-左下角 3-右下角 4-中间',
  `sort` int(0) UNSIGNED NOT NULL DEFAULT 255 COMMENT '排序',
  `add_time` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '添加时间',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`tag_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = '商品标签' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for goods_type
-- ----------------------------
DROP TABLE IF EXISTS `goods_type`;
CREATE TABLE `goods_type`  (
  `type_id` int(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `type_name` char(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '类型名称',
  `type_desc` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '类型描述',
  `type_sort` int(0) UNSIGNED NOT NULL DEFAULT 255 COMMENT '排序',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`type_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for goods_unit
-- ----------------------------
DROP TABLE IF EXISTS `goods_unit`;
CREATE TABLE `goods_unit`  (
  `unit_id` int(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `shop_id` int(0) UNSIGNED NOT NULL COMMENT '店铺id',
  `unit_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '商品单位名称',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`unit_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 13 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for groupon_log
-- ----------------------------
DROP TABLE IF EXISTS `groupon_log`;
CREATE TABLE `groupon_log` (
   `log_id` int unsigned NOT NULL AUTO_INCREMENT,
   `shop_id` int unsigned NOT NULL DEFAULT '0' COMMENT '店铺ID',
   `goods_id` int unsigned NOT NULL DEFAULT '0' COMMENT '商品ID',
   `act_id` int unsigned NOT NULL DEFAULT '0' COMMENT '活动ID',
   `user_id` int unsigned NOT NULL DEFAULT '0' COMMENT '用户ID',
   `user_type` tinyint unsigned NOT NULL DEFAULT '0' COMMENT '用户类型 0-团长 1-参团会员',
   `group_sn` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '拼团编号',
   `order_sn` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '订单编号',
   `add_time` int unsigned NOT NULL DEFAULT '0' COMMENT '添加时间',
   `status` tinyint unsigned NOT NULL DEFAULT '0' COMMENT '拼团状态 0-拼团中 1-拼团成功 2-拼团失败',
   `start_time` int unsigned NOT NULL DEFAULT '0' COMMENT '开始时间',
   `end_time` int unsigned NOT NULL DEFAULT '0' COMMENT '结束时间',
   `created_at` timestamp NULL DEFAULT NULL,
   `updated_at` timestamp NULL DEFAULT NULL,
   `deleted_at` timestamp NULL DEFAULT NULL,
   PRIMARY KEY (`log_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='拼团记录表';

-- ----------------------------
-- Table structure for hot_search
-- ----------------------------
DROP TABLE IF EXISTS `hot_search`;
CREATE TABLE `hot_search`  (
  `id` int(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `site_id` int(0) UNSIGNED NULL DEFAULT NULL COMMENT '站点id',
  `keyword` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '搜索词参与搜索',
  `show_words` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '显示词不参与搜索，只起显示作用',
  `is_show` tinyint(1) NOT NULL DEFAULT 1 COMMENT '是否显示',
  `sort` int(0) UNSIGNED NOT NULL DEFAULT 255 COMMENT '排序',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for image
-- ----------------------------
DROP TABLE IF EXISTS `image`;
CREATE TABLE `image`  (
  `img_id` int(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `dir_id` int(0) UNSIGNED NOT NULL COMMENT '相册id',
  `dirname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '目录名称',
  `extension` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '图片扩展名 如:jpg',
  `file_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '图片文件名 不带扩展名后缀',
  `path` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '图片路径',
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '图片原文件名 不带扩展名后缀',
  `size` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '图片大小',
  `width` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '图片宽度',
  `height` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '图片高度',
  `sort` smallint(0) UNSIGNED NOT NULL DEFAULT 255 COMMENT '排序',
  `is_delete` tinyint(0) NOT NULL DEFAULT 0 COMMENT '是否删除',
  `add_time` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '添加时间',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`img_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 828 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for image_dir
-- ----------------------------
DROP TABLE IF EXISTS `image_dir`;
CREATE TABLE `image_dir`  (
  `dir_id` int(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `shop_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '店铺id',
  `site_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '站点id',
  `dir_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '目录名称',
  `dir_group` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '相册分组 shop店铺相册 site站点相册 backend平台方相册',
  `dir_cover` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '相册封面图',
  `dir_desc` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '描述',
  `dir_sort` smallint(0) UNSIGNED NOT NULL DEFAULT 255 COMMENT '排序',
  `is_default` tinyint(1) NOT NULL DEFAULT 0 COMMENT '是否默认相册',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`dir_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 101 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for integral_goods
-- ----------------------------
DROP TABLE IF EXISTS `integral_goods`;
CREATE TABLE `integral_goods`  (
  `goods_id` int(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `shop_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '店铺id 当平台开启店铺积分商城时才有值',
  `goods_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '商品名称',
  `goods_price` decimal(10, 2) NOT NULL COMMENT '商品价格',
  `market_price` decimal(10, 2) NOT NULL COMMENT '市场价格（组合价格）',
  `goods_number` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '可兑换商品库存',
  `goods_integral` int(0) UNSIGNED NOT NULL COMMENT '所需积分',
  `exchange_number` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '已兑换量',
  `start_time` date NULL DEFAULT NULL COMMENT '开始时间',
  `end_time` date NULL DEFAULT NULL COMMENT '结束时间',
  `add_time` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '添加时间',
  `goods_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '商品图片 取商品图片的第一张',
  `goods_images` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL COMMENT '商品图片 多个图片以“丨”分隔',
  `goods_video` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '商品视频',
  `pc_desc` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL COMMENT '商品电脑端描述',
  `mobile_desc` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL COMMENT '商品手机端描述',
  `click_count` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '点击量',
  `keywords` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '关键词',
  `sale_num` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '销量',
  `collect_num` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '收藏量',
  `goods_sort` int(0) UNSIGNED NOT NULL DEFAULT 255 COMMENT '商品排序',
  `is_delete` tinyint(1) NOT NULL DEFAULT 0 COMMENT '是否删除',
  `goods_status` tinyint(0) UNSIGNED NOT NULL DEFAULT 1 COMMENT '商品状态 默认1 1出售中 0已下架',
  `erp_goods_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT 'erp 商品id',
  `is_limit` tinyint(1) NOT NULL DEFAULT 0 COMMENT '限制兑换时间 默认0 1限制 0不限制',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`goods_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = '积分兑换商品表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for integral_order_goods
-- ----------------------------
DROP TABLE IF EXISTS `integral_order_goods`;
CREATE TABLE `integral_order_goods`  (
  `record_id` int(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `order_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '订单id',
  `goods_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '积分商品id',
  `goods_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '积分商品名称',
  `goods_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '积分商品图片',
  `goods_price` decimal(10, 2) NOT NULL COMMENT '商品价格',
  `goods_points` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '商品积分',
  `goods_number` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '购买商品数量',
  `stock_dropped` tinyint(1) NOT NULL DEFAULT 0 COMMENT '库存是否已减 默认0 0未减库存 1已减库存',
  `goods_contracts` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `is_delete` tinyint(1) NOT NULL DEFAULT 0 COMMENT '是否删除 默认0',
  `order_status` tinyint(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '订单状态 默认0 ',
  `goods_integral` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '所需积分',
  `goods_stock` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '商品库存',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`record_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = '积分兑换订单商品表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for integral_order_info
-- ----------------------------
DROP TABLE IF EXISTS `integral_order_info`;
CREATE TABLE `integral_order_info`  (
  `order_id` int(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `order_sn` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '订单号',
  `user_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '买家id',
  `order_status` tinyint(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '订单状态 默认0 0shipped发货中 1finished交易成功',
  `site_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '站点id',
  `shop_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '店铺id',
  `pickup_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '自提点id',
  `shipping_status` tinyint(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '物流状态 ',
  `pay_status` tinyint(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '支付状态 ',
  `consignee` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '收货人姓名',
  `region_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '收货地址',
  `region_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '收货人地址region_name',
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '收货人详细地址',
  `address_lng` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '地图定位 经度',
  `address_lat` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '地图定位 纬度',
  `receiving_mode` tinyint(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '收货方式 默认0',
  `tel` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '收货人联系方式',
  `email` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '收货人邮箱',
  `postscript` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '买家留言',
  `best_time` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '最佳送货时间 默认空 可选：工作日/周末/假日均可',
  `shipping_fee` decimal(10, 2) NOT NULL COMMENT '配送总费用',
  `order_from` int(0) UNSIGNED NOT NULL DEFAULT 1 COMMENT '订单来源 默认1 1PC端 2WAP端 ...',
  `add_time` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '订单添加时间 默认0',
  `shipping_time` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '发货时间 默认0',
  `confirm_time` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '确认收货时间 默认0',
  `delay_days` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '延迟收货天数 默认0 0正常收货',
  `order_type` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '交易类型 默认0',
  `service_mark` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '服务态度 默认0',
  `send_mark` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '发货速度 默认0',
  `shipping_mark` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '物流速度 默认0',
  `buyer_type` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '买家类型 默认0',
  `end_time` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '订单终止时间 默认0',
  `is_show` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '是否显示 如：\"1,2,3,4\"',
  `is_delete` tinyint(1) NOT NULL DEFAULT 0 COMMENT '是否删除 默认0',
  `close_reason` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '订单关闭原因',
  `order_cancel` tinyint(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '用户提交取消申请状态 默认0 无取消申请 1等待商家审核 2商家审核通过 3商家拒绝通过',
  `refuse_reason` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '商家拒绝取消订单申请理由 默认空',
  `order_points` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '订单积分 默认0',
  `remark` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL COMMENT '备注 序列化存储',
  `last_time` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '订单最后修改时间 默认0',
  `shipping_id` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '物流id',
  `express_sn` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '物流单号',
  `buy_type` tinyint(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT 'buy_type 默认0 ',
  `user_name` char(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '会员名',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`order_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = '积分兑换订单表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for jobs
-- ----------------------------
DROP TABLE IF EXISTS `jobs`;
CREATE TABLE `jobs`  (
  `id` bigint(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint(0) UNSIGNED NOT NULL,
  `reserved_at` int(0) UNSIGNED NULL DEFAULT NULL,
  `available_at` int(0) UNSIGNED NOT NULL,
  `created_at` int(0) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `jobs_queue_index`(`queue`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for lib_category
-- ----------------------------
DROP TABLE IF EXISTS `lib_category`;
CREATE TABLE `lib_category`  (
  `cat_id` int(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `cat_name` char(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '分类名称',
  `parent_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '上级分类',
  `is_show` tinyint(1) NOT NULL DEFAULT 0 COMMENT '是否显示',
  `cat_sort` smallint(0) UNSIGNED NOT NULL DEFAULT 255 COMMENT '排序',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`cat_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for lib_goods
-- ----------------------------
DROP TABLE IF EXISTS `lib_goods`;
CREATE TABLE `lib_goods`  (
  `goods_id` int(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `goods_name` char(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '商品名称',
  `cat_id` int(0) UNSIGNED NOT NULL COMMENT '商品分类',
  `cat_id1` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '商品一级分类',
  `cat_id2` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '商品二级分类',
  `cat_id3` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '商品三级分类',
  `shop_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '店铺ID',
  `sku_open` tinyint(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT 'Sku Open',
  `sku_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT 'Sku Id',
  `goods_subname` char(140) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '商品卖点',
  `goods_price` decimal(10, 2) NOT NULL COMMENT '店铺价',
  `market_price` decimal(10, 2) NOT NULL COMMENT '市场价',
  `cost_price` decimal(10, 2) NOT NULL COMMENT '成本价',
  `mobile_price` decimal(10, 2) NOT NULL COMMENT '移动端专项价',
  `give_integral` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '赠送积分',
  `goods_number` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '商品库存',
  `warn_number` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '库存警告数量',
  `goods_sn` char(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '商品货号',
  `goods_barcode` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL COMMENT '商品条形码 支持一品多码，多个条形码之间用逗号分隔',
  `goods_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '商品主图',
  `goods_images` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL COMMENT '商品图片',
  `goods_video` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '主图视频',
  `brand_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '商品品牌',
  `pc_desc` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL COMMENT '商品电脑端描述',
  `mobile_desc` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL COMMENT '商品手机端描述',
  `top_layout_id` smallint(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '顶部模板',
  `bottom_layout_id` smallint(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '底部模板',
  `packing_layout_id` smallint(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '包装清单版式',
  `service_layout_id` smallint(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '售后保证版式',
  `click_count` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '商品浏览次数',
  `keywords` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '关键词',
  `goods_info` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '商品简介',
  `invoice_type` tinyint(0) NOT NULL DEFAULT 0 COMMENT '发票类型 默认 0 0无 1增值税普通发票 2增值税专用发票 3增值税普通发票 和 增值税专用发票选择“无”则将不提供发票',
  `is_repair` tinyint(1) NOT NULL DEFAULT 0 COMMENT '是否保修',
  `user_discount` tinyint(0) NOT NULL DEFAULT 0 COMMENT '会员打折',
  `stock_mode` tinyint(0) NOT NULL DEFAULT 0 COMMENT '库存计数 0拍下减库存 1付款减库存 2出库减库存',
  `comment_num` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '商品评论次数',
  `sale_num` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '商品销售数量',
  `collect_num` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '商品收藏数量',
  `goods_audit` tinyint(1) NOT NULL DEFAULT 0 COMMENT '审核是否通过 默认0 0-待审核 1-审核通过 2-审核未通过',
  `goods_status` tinyint(0) NOT NULL DEFAULT 0 COMMENT '商品状态 默认1 0-已下架(定时发布) 1-出售中(立即发布) 2-违规下架(放入仓库)',
  `goods_reason` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT 'Goods Reason',
  `is_delete` tinyint(1) NOT NULL DEFAULT 0 COMMENT '是否已删除',
  `is_virtual` tinyint(1) NOT NULL DEFAULT 0 COMMENT '是否虚拟商品',
  `is_best` tinyint(1) NOT NULL DEFAULT 0 COMMENT '是否精品',
  `is_new` tinyint(1) NOT NULL DEFAULT 0 COMMENT '是否新品',
  `is_hot` tinyint(1) NOT NULL DEFAULT 0 COMMENT '是否热卖',
  `is_promote` tinyint(1) NOT NULL DEFAULT 0 COMMENT '是否促销',
  `contract_ids` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '保障服务',
  `supplier_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '供货商ID',
  `freight_id` smallint(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '运费模板',
  `goods_volume` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '物流体积(m3)',
  `goods_weight` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '物流重量(Kg)',
  `goods_remark` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL COMMENT '商品备注 序列化存储',
  `goods_sort` int(0) UNSIGNED NOT NULL DEFAULT 255 COMMENT '商品排序',
  `add_time` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '商品发布时间',
  `last_time` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '最后一次更新时间',
  `act_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '活动id 默认0 0无活动',
  `lib_cat_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '系统商品分类id',
  `other_attrs` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL COMMENT '店铺自定义属性',
  `pricing_mode` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '计价方式 默认0 0计件 1计重',
  `goods_unit` int(0) UNSIGNED NULL DEFAULT NULL COMMENT '商品单位',
  `tag_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '商品标签',
  `sales_model` tinyint(0) NOT NULL DEFAULT 0 COMMENT '销售模式 默认0 0零售 1批发',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`goods_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 772 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for lib_goods_attr
-- ----------------------------
DROP TABLE IF EXISTS `lib_goods_attr`;
CREATE TABLE `lib_goods_attr`  (
  `id` int(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `goods_id` int(0) UNSIGNED NOT NULL COMMENT '商品SPU id',
  `attr_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '属性id',
  `attr_vid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '属性值的id 只有分类绑定的平台属性才有',
  `attr_name` char(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '属性名称',
  `attr_vname` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '属性值的名称',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3865 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for lib_goods_image
-- ----------------------------
DROP TABLE IF EXISTS `lib_goods_image`;
CREATE TABLE `lib_goods_image`  (
  `img_id` int(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `goods_id` int(0) UNSIGNED NOT NULL COMMENT '商品id',
  `spec_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '规格id',
  `path` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '图片路径',
  `is_default` tinyint(1) NOT NULL DEFAULT 0 COMMENT '是否默认',
  `sort` tinyint(0) UNSIGNED NOT NULL DEFAULT 1 COMMENT '排序',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`img_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3850 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for lib_goods_sku
-- ----------------------------
DROP TABLE IF EXISTS `lib_goods_sku`;
CREATE TABLE `lib_goods_sku`  (
  `sku_id` int(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `goods_id` int(0) UNSIGNED NOT NULL COMMENT '商品SPU id',
  `sku_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '商品SKU名称',
  `sku_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '商品SKU图片',
  `sku_images` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL COMMENT '商品SKU相册图片 序列化存储',
  `spec_ids` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '商品规格表主键id spec_id 多个以\"|\"分隔 格式：12|21|32',
  `spec_vids` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '商品规格表规格值id attr_vid 多个以\"|\"分隔 格式：232|332|224',
  `spec_names` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '商品规格表规格值名称键值对 attr_name:attr_value 多个以\"|\"分隔 格式：网络:4G|内存:32G|颜色:金色',
  `goods_price` decimal(10, 2) NOT NULL COMMENT '店铺价',
  `mobile_price` decimal(10, 2) NOT NULL COMMENT '手机端价格',
  `market_price` decimal(10, 2) NOT NULL COMMENT '市场价',
  `goods_number` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '商品库存',
  `sku_number_version` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '商品SKU库存数量版本号 默认0',
  `goods_sn` char(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '商品货号',
  `goods_barcode` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL COMMENT '商品条形码 支持一品多码，多个条形码之间用逗号分隔',
  `warn_number` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '库存警告数量',
  `goods_stockcode` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '商品库位码',
  `goods_weight` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '物流重量(Kg)',
  `goods_volume` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '物流体积(m3)',
  `pc_desc` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL COMMENT '商品电脑端描述',
  `mobile_desc` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL COMMENT '商品手机端描述',
  `is_spu` tinyint(1) NOT NULL DEFAULT 1 COMMENT '是否SPU 默认1',
  `checked` tinyint(1) NOT NULL DEFAULT 1 COMMENT '是否可用 默认1',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`sku_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 841 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = '系统商品SKU表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for lib_goods_spec
-- ----------------------------
DROP TABLE IF EXISTS `lib_goods_spec`;
CREATE TABLE `lib_goods_spec`  (
  `spec_id` int(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `goods_id` int(0) UNSIGNED NOT NULL COMMENT '商品SPU id',
  `attr_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '规格id',
  `attr_vid` int(0) UNSIGNED NOT NULL COMMENT '规格值id',
  `cat_id` int(0) UNSIGNED NOT NULL COMMENT '商品分类id',
  `attr_value` char(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '规格值名称',
  `attr_desc` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '规格描述',
  `is_checked` tinyint(1) NOT NULL DEFAULT 0 COMMENT '是否选中 默认否',
  `spec_sort` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '排序',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`spec_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 263 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = '系统商品规格表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for lib_spec_alias
-- ----------------------------
DROP TABLE IF EXISTS `lib_spec_alias`;
CREATE TABLE `lib_spec_alias`  (
  `id` int(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `goods_id` int(0) UNSIGNED NOT NULL COMMENT '商品SPU id',
  `attr_id` int(0) UNSIGNED NOT NULL COMMENT '规格id',
  `attr_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '规格别名值',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for links
-- ----------------------------
DROP TABLE IF EXISTS `links`;
CREATE TABLE `links`  (
  `links_id` int(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `links_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '友情链接名称',
  `links_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '友情链接地址',
  `is_show` tinyint(1) NOT NULL DEFAULT 1 COMMENT '是否显示',
  `links_sort` int(0) UNSIGNED NOT NULL DEFAULT 255 COMMENT '排序',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`links_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for live
-- ----------------------------
DROP TABLE IF EXISTS `live`;
CREATE TABLE `live`  (
  `id` int(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `act_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '活动id',
  `live_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '直播标题',
  `live_img` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '直播封面',
  `start_time` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '直播开始时间',
  `end_time` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '直播结束时间',
  `cat_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '分类id',
  `status` tinyint(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '直播状态 0-未开始 1-直播中 2-已结束',
  `is_delete` tinyint(1) NOT NULL DEFAULT 0 COMMENT '是否删除',
  `shop_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '店铺id',
  `is_recommend` tinyint(1) NOT NULL DEFAULT 0 COMMENT '是否推荐',
  `region_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '直播所在地',
  `keywords` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '直播关键词',
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL COMMENT '直播描述',
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '直播地址',
  `sort` int(0) UNSIGNED NOT NULL DEFAULT 255 COMMENT '排序',
  `online_number` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '在线数量',
  `view_number` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '关注人数',
  `share_img` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '分享推广图',
  `push_stream` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '推流地址',
  `pull_stream` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '拉流地址',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = '直播表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for live_auth
-- ----------------------------
DROP TABLE IF EXISTS `live_auth`;
CREATE TABLE `live_auth` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `shop_id` int unsigned NOT NULL DEFAULT '0' COMMENT '店铺id',
  `all_number` int unsigned NOT NULL DEFAULT '0' COMMENT '允许创建直播活动数量',
  `use_number` int unsigned NOT NULL DEFAULT '0' COMMENT '已创建直播活动数量',
  `start_time` int unsigned NOT NULL DEFAULT '0' COMMENT '允许直播开始时间',
  `end_time` int unsigned NOT NULL DEFAULT '0' COMMENT '允许直播结束时间',
  `all_hours` int unsigned NOT NULL DEFAULT '0' COMMENT '允许直播时长（小时）',
  `time_limit` int unsigned NOT NULL DEFAULT '0' COMMENT '已直播时长（小时）',
  `is_open` int unsigned NOT NULL DEFAULT '0' COMMENT '是否开启 0-关闭 1-开启',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='直播店铺信息表';

-- ----------------------------
-- Table structure for live_category
-- ----------------------------
DROP TABLE IF EXISTS `live_category`;
CREATE TABLE `live_category`  (
  `cat_id` int(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `cat_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '分类名称',
  `parent_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '上级分类id',
  `cat_sort` int(0) UNSIGNED NOT NULL DEFAULT 255 COMMENT '排序',
  `is_open` tinyint(1) NOT NULL DEFAULT 1 COMMENT '是否开启',
  `cat_level` tinyint(0) UNSIGNED NOT NULL DEFAULT 1 COMMENT '分类层级 默认1',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`cat_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = '直播分类表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for mall_account
-- ----------------------------
DROP TABLE IF EXISTS `mall_account`;
CREATE TABLE `mall_account`  (
  `account_id` int(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `account_sn` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '流水号',
  `user_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '会员id',
  `admin_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '店主id',
  `amount` decimal(10, 2) NOT NULL COMMENT '账户变动金额',
  `add_time` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '账户变动时间',
  `note` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL COMMENT '名称/备注',
  `account_type` tinyint(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '账户分类',
  `pay_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '账户类型',
  `status` tinyint(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '交易订单状态 默认0 0-进行中 1-交易成功 2-交易关闭 3-退款成功',
  `order_sn` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '订单编号',
  `back_sn` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '售后编号',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`account_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = '平台进出账明细表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for member
-- ----------------------------
DROP TABLE IF EXISTS `member`;
CREATE TABLE `member`  (
  `member_id` int(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `shop_id` int(0) NOT NULL DEFAULT 0 COMMENT '店铺id',
  `user_id` int(0) UNSIGNED NOT NULL COMMENT '会员id',
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '会员名',
  `rank_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '店铺会员等级id',
  `is_enable` tinyint(1) NOT NULL DEFAULT 1 COMMENT '会员状态 默认1 1享受会员折扣 0不享受会员折扣',
  `member_remark` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '会员备注',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`member_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = '店铺会员表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for message
-- ----------------------------
DROP TABLE IF EXISTS `message`;
CREATE TABLE `message`  (
  `msg_id` int(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `sender` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '消息发送者会员id',
  `send_time` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '消息发送时间',
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '消息标题',
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL COMMENT '消息内容',
  `type` tinyint(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '消息类型 默认0 1-会员消息 2-店铺消息',
  `push_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '消息推送类型 消息模板表中的code',
  `push_value` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`msg_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = '短消息表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for message_template
-- ----------------------------
DROP TABLE IF EXISTS `message_template`;
CREATE TABLE `message_template`  (
  `id` int(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` char(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '模板名称',
  `code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '模板标识',
  `type` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '模板类型',
  `msg_type` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '消息类型',
  `sys_open` tinyint(1) NOT NULL DEFAULT 1 COMMENT '站内信开关',
  `sms_open` tinyint(1) NOT NULL DEFAULT 1 COMMENT '短信开关',
  `email_open` tinyint(1) NOT NULL DEFAULT 1 COMMENT '邮件开关',
  `wx_open` tinyint(1) NOT NULL DEFAULT 1 COMMENT '微信开关',
  `last_modify` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '最后修改时间',
  `aliyu_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '阿里云短信模板代码',
  `sys_content` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '站内信模板内容',
  `sms_content` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '短信模板内容',
  `email_content` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '邮件模板内容',
  `wx_content` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '微信模板内容',
  `explain` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '模板说明',
  `email_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '邮件标题(邮件)',
  `sys_spec` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '站内信说明',
  `sms_spec` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '短信模板说明',
  `email_spec` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '邮件模板说明',
  `wx_spec` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '微信模板说明',
  `wx_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '微信模板id',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 72 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations`  (
  `id` int(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `batch` int(0) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 285 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for multi_store
-- ----------------------------
DROP TABLE IF EXISTS `multi_store`;
CREATE TABLE `multi_store`  (
  `store_id` int(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `shop_id` int(0) UNSIGNED NOT NULL COMMENT '店铺id',
  `group_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '门店分组id',
  `store_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '门店名称',
  `user_id` int(0) UNSIGNED NOT NULL COMMENT '会员id',
  `user_type` tinyint(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '用户类型 0会员 1店铺管理员',
  `region_code` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '门店地址 地区code',
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '详细地址',
  `store_lng` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '经度',
  `store_lat` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '纬度',
  `store_img` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '门店主图',
  `region_type` tinyint(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '销售/配送范围 默认0 0全国模板 1同城模板',
  `region_editable` tinyint(1) NOT NULL DEFAULT 1 COMMENT '是否允许门店修改销售/配送范围',
  `tel` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '门店电话',
  `opening_type` tinyint(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '营业时间类型 0全天 1每天重复 2每周重复',
  `opening_hour` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '营业时间',
  `store_remark` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '门店备注',
  `take_rate` decimal(10, 2) NOT NULL COMMENT '店铺分佣比例',
  `clearing_cycle` tinyint(0) UNSIGNED NOT NULL COMMENT '结算周期 0一个月 1一周 2一天 3三天',
  `pickup_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '自提点id',
  `store_status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '门店状态 默认0',
  `edit_info` tinyint(1) NOT NULL DEFAULT 0 COMMENT '是否允许门店修改基本信息 默认0',
  `add_time` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '添加时间',
  `city_code` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `city_letter` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `is_diy` tinyint(1) NOT NULL DEFAULT 0 COMMENT '是否开启门店自定义装修首页',
  `is_master` tinyint(1) NOT NULL DEFAULT 0 COMMENT '主店',
  `store_logo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '门店logo',
  `yl_settle_mode` tinyint(0) UNSIGNED NOT NULL COMMENT '银联结算模式',
  `reserve_money` decimal(10, 2) NOT NULL COMMENT '银联商户预留金额',
  `is_allowed_related_goods` tinyint(1) NOT NULL DEFAULT 0 COMMENT '是否允许门店自主关联商品 默认0 0否 1是',
  `close_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '门店打烊提示图',
  `goods_count` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '商品数量',
  `out_openhour_order_enable` tinyint(1) NOT NULL DEFAULT 0 COMMENT '非营业时间是否支持下单 默认0 0否 1是',
  `close_tips` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '非营业时间下单提示',
  `is_other_shpping_fee` tinyint(1) NOT NULL DEFAULT 0 COMMENT '门店统一额外配送费 默认0 0否 1是',
  `is_packing_fee` tinyint(1) NOT NULL DEFAULT 0 COMMENT '门店统一包装费 默认0 0否 1是',
  `other_shipping_fee` decimal(10, 2) NOT NULL COMMENT '额外增加配送费',
  `packing_fee` decimal(10, 2) NOT NULL COMMENT '包装费',
  `shipping_time` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '下单时间不在指定范围内',
  `start_price` decimal(10, 2) NOT NULL COMMENT '起送价',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`store_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for multi_store_goods
-- ----------------------------
DROP TABLE IF EXISTS `multi_store_goods`;
CREATE TABLE `multi_store_goods`  (
  `id` int(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `shop_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '店铺ID',
  `store_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '门店ID',
  `goods_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '商品ID',
  `store_goods_price` decimal(10, 2) UNSIGNED NOT NULL COMMENT '门店独立价格',
  `store_goods_number` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '门店独立库存',
  `is_sell` tinyint(1) NOT NULL DEFAULT 0 COMMENT '商品状态 0-已下架 1-出售中',
  `is_self_mention` tinyint(1) NOT NULL DEFAULT 0 COMMENT '是否开启自提 0-关闭 1-开启',
  `sale_num` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '门店销量',
  `act_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '门店活动ID',
  `order_act_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT 'order_act_id',
  `goods_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '门店商品URL',
  `goods_image_qrcode` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '门店商品二维码地址',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 96 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = '门店商品表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for multi_store_goods_sku
-- ----------------------------
DROP TABLE IF EXISTS `multi_store_goods_sku`;
CREATE TABLE `multi_store_goods_sku`  (
  `id` int(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `shop_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '店铺ID',
  `store_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '门店ID',
  `store_goods_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '门店商品关联ID',
  `goods_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '商品ID',
  `sku_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '商品SKU ID',
  `store_sku_price` decimal(10, 2) UNSIGNED NOT NULL COMMENT '门店商品SKU价格',
  `store_sku_number` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '门店商品SKU库存',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 139 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = '门店商品SKU表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for multi_store_group
-- ----------------------------
DROP TABLE IF EXISTS `multi_store_group`;
CREATE TABLE `multi_store_group`  (
  `group_id` int(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `shop_id` int(0) UNSIGNED NOT NULL COMMENT '店铺id',
  `group_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '分组名称',
  `group_sort` int(0) UNSIGNED NOT NULL DEFAULT 255 COMMENT '排序',
  `group_activity_setting` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '活动参与设置',
  `group_related_goods` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '关联商品',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`group_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for nav_ad
-- ----------------------------
DROP TABLE IF EXISTS `nav_ad`;
CREATE TABLE `nav_ad`  (
  `id` int(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `ad_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '广告名称',
  `ad_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '广告图片',
  `ad_link` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '广告链接',
  `is_show` tinyint(1) NOT NULL DEFAULT 1 COMMENT '是否显示',
  `ad_sort` tinyint(0) UNSIGNED NOT NULL DEFAULT 255 COMMENT '排序',
  `ad_height` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '广告高度',
  `category_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '首页分类ID',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for nav_banner
-- ----------------------------
DROP TABLE IF EXISTS `nav_banner`;
CREATE TABLE `nav_banner`  (
  `id` int(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `banner_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '广告名称',
  `banner_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '广告图片',
  `banner_link` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '广告链接',
  `is_show` tinyint(1) NOT NULL DEFAULT 1 COMMENT '是否显示',
  `banner_sort` tinyint(0) UNSIGNED NOT NULL DEFAULT 255 COMMENT '排序',
  `banner_height` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '广告高度',
  `site_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '站点ID',
  `nav_page` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '所属页面',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for nav_brand
-- ----------------------------
DROP TABLE IF EXISTS `nav_brand`;
CREATE TABLE `nav_brand`  (
  `id` int(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `brand_id` int(0) UNSIGNED NOT NULL COMMENT '品牌id',
  `is_show` tinyint(1) NOT NULL DEFAULT 1 COMMENT '是否显示',
  `brand_sort` tinyint(0) UNSIGNED NOT NULL DEFAULT 255 COMMENT '排序',
  `category_id` int(0) UNSIGNED NOT NULL COMMENT '首页分类ID 分类导航中的id',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for nav_category
-- ----------------------------
DROP TABLE IF EXISTS `nav_category`;
CREATE TABLE `nav_category`  (
  `id` int(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '导航分类名称',
  `nav_page` char(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '网站page',
  `nav_icon` char(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '导航图标',
  `nav_json` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '导航分类json数据',
  `is_show` tinyint(1) NOT NULL DEFAULT 1 COMMENT '是否显示',
  `sort` int(0) NOT NULL DEFAULT 255 COMMENT '排序',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for nav_quick_service
-- ----------------------------
DROP TABLE IF EXISTS `nav_quick_service`;
CREATE TABLE `nav_quick_service`  (
  `id` int(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `qs_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '快捷服务名称',
  `qs_icon` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '快捷服务图标',
  `qs_link` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '#' COMMENT '快捷服务链接',
  `is_show` tinyint(1) NOT NULL DEFAULT 1 COMMENT '是否显示',
  `sort` tinyint(0) UNSIGNED NOT NULL DEFAULT 255 COMMENT '排序',
  `site_id` int(0) NOT NULL COMMENT '站点id',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for nav_words
-- ----------------------------
DROP TABLE IF EXISTS `nav_words`;
CREATE TABLE `nav_words`  (
  `id` int(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `words_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '推荐词名称',
  `words_type` tinyint(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '推荐词类型',
  `new_open` tinyint(1) NOT NULL DEFAULT 1 COMMENT '是否新窗口打开',
  `is_show` tinyint(1) NOT NULL DEFAULT 1 COMMENT '是否显示',
  `words_sort` tinyint(0) UNSIGNED NOT NULL DEFAULT 255 COMMENT '推荐词排序',
  `words_link` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '推荐词链接',
  `category_id` tinyint(0) UNSIGNED NOT NULL DEFAULT 255 COMMENT '首页分类ID',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for navigation
-- ----------------------------
DROP TABLE IF EXISTS `navigation`;
CREATE TABLE `navigation`  (
  `id` int(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nav_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '导航名称',
  `nav_type` tinyint(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '导航类型',
  `nav_link` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '导航链接',
  `nav_position` tinyint(0) UNSIGNED NOT NULL DEFAULT 1 COMMENT '显示位置 默认1 1头部 2中间 3底部',
  `nav_layout` tinyint(0) UNSIGNED NOT NULL DEFAULT 1 COMMENT '布局 默认1 1左侧 2右侧',
  `nav_icon` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '导航图标',
  `nav_icon_active` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '选中图标',
  `nav_class` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '功能选择',
  `class_images` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '样式图标',
  `is_show` tinyint(1) NOT NULL DEFAULT 1 COMMENT '是否显示',
  `new_open` tinyint(1) NOT NULL DEFAULT 1 COMMENT '新窗口打开',
  `nav_sort` tinyint(0) UNSIGNED NOT NULL DEFAULT 255 COMMENT '排序',
  `nav_page` char(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '所属页面',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 29 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for order_action
-- ----------------------------
DROP TABLE IF EXISTS `order_action`;
CREATE TABLE `order_action`  (
  `action_id` int(0) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '自增ID号',
  `order_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '订单ID',
  `action_user` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '操作管理员',
  `order_status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '订单状态',
  `shipping_status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '配送状态',
  `pay_status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '付款状态',
  `action_place` tinyint(1) NOT NULL DEFAULT 0 COMMENT '（取消订单记录，值为1）',
  `action_note` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '操作备注',
  `log_time` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '操作时间',
  PRIMARY KEY (`action_id`) USING BTREE,
  INDEX `order_id`(`order_id`) USING BTREE,
  INDEX `action_user`(`action_user`) USING BTREE,
  INDEX `order_status`(`order_status`) USING BTREE,
  INDEX `shipping_status`(`shipping_status`) USING BTREE,
  INDEX `pay_status`(`pay_status`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 94 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = '订单操作记录' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for order_goods
-- ----------------------------
DROP TABLE IF EXISTS `order_goods`;
CREATE TABLE `order_goods`  (
  `record_id` int(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `order_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '订单id',
  `goods_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '商品id',
  `sku_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '商品id',
  `spec_info` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL COMMENT '商品规格 如：重量：kg|尺码：XS',
  `goods_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '商品名称',
  `goods_sn` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '商品sn',
  `sku_sn` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT 'sku sn 相当于 商品sn',
  `goods_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '商品图片',
  `goods_price` decimal(10, 2) NOT NULL COMMENT '商品价格',
  `original_price` decimal(10, 2) NOT NULL COMMENT '商品原价',
  `cost_price` decimal(10, 2) NOT NULL COMMENT '商品成本价',
  `goods_points` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '商品积分',
  `distrib_price` decimal(10, 2) NOT NULL COMMENT '分销价格',
  `goods_number` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '购买商品数量',
  `other_price` decimal(10, 2) NOT NULL COMMENT '其他价格（包括：full_cut_amount gift point bonus）',
  `pay_change` decimal(10, 2) NOT NULL COMMENT '卖家优惠价格 如：-100.00',
  `parent_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT 'parent id',
  `is_gift` tinyint(1) NOT NULL DEFAULT 0 COMMENT '是否礼物商品 默认0',
  `is_evaluate` tinyint(1) NOT NULL DEFAULT 0 COMMENT '是否评价 默认0',
  `goods_status` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '商品状态 0-无状态 1-仅退款 2-退款退货 3-换货 4-申请维修 5-线下业务',
  `give_integral` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT 'give integral',
  `stock_mode` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '库存计数 默认0 0拍下减库存 1付款减库存 2出库减库存',
  `stock_dropped` tinyint(1) NOT NULL DEFAULT 0 COMMENT '库存是否已减 默认0 0未减库存 1已减库存',
  `act_type` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '活动类型 默认null null无活动 1-拍卖 2-预售 3-团购 5-积分兑换 6-拼团 8-砍价 10-搭配套餐 11-限时折扣 12-满减送 13-赠品活动',
  `goods_type` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '商品交易类型 0-普通商品 1-拍卖 2-预售 3-团购 5-积分兑换 6-拼团 8-砍价 10-搭配套餐 11-限时折扣 12-满减送 13-赠品活动 99-电子秤商品',
  `is_distrib` tinyint(1) NOT NULL DEFAULT 0 COMMENT '是否分销商品 默认0',
  `discount` decimal(10, 2) NOT NULL COMMENT '折扣价格',
  `profits` decimal(10, 2) NOT NULL COMMENT '利润价格',
  `distrib_money` decimal(10, 2) NOT NULL COMMENT '分销价格',
  `goods_contracts` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL COMMENT '保障服务内容 json对象',
  `ext_info` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL COMMENT '商品活动数据 json对象',
  `goods_mode` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '商品类别 默认0 0实物商品（物流发货） 1电子卡券（无需物流） 2服务商品（无需物流）',
  `cs_take_rate` decimal(10, 2) NOT NULL COMMENT 'cs_take_rate',
  `cs_take_rate_mode` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT 'cs_take_rate_mode',
  `cs_take_money` decimal(10, 2) NOT NULL COMMENT 'cs_take_money',
  `tax` decimal(10, 2) NOT NULL COMMENT 'tax',
  `integral_money` decimal(10, 2) NOT NULL COMMENT 'integral_money',
  `custom_ifield` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT 'custom_ifield',
  `custom_sfield` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT 'custom_sfield',
  `take_rate` decimal(10, 2) NOT NULL COMMENT 'take_rate',
  `shop_rate` decimal(10, 2) NOT NULL COMMENT 'shop_rate',
  `goods_barcode` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL COMMENT '商品条形码 支持一品多码，多个条形码之间用逗号分隔',
  `goods_stockcode` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '商品库位码',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`record_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 59 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = '订单商品表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for order_info
-- ----------------------------
DROP TABLE IF EXISTS `order_info`;
CREATE TABLE `order_info`  (
  `order_id` int(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `order_sn` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '订单号',
  `parent_sn` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '父订单号',
  `user_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '买家id',
  `order_status` tinyint(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '订单状态 0-未确认 1-已确认 2-已取消 3-无效 4-退货 5-已分单 6-部分分单 7-部分已退货 8-仅退款',
  `shop_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '店铺id',
  `site_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '站点id',
  `store_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '网点id',
  `pickup_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '自提点id',
  `shipping_status` tinyint(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '配送状态 0-未发货 1-已发货 2-已收货 3-备货中 4-已发货(部分商品) 5-发货中(处理分单) 6-已发货(部分商品) 7-部分已收货 8-待发货',
  `pay_status` tinyint(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '支付状态 0-未支付 1-已支付',
  `consignee` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '收货人姓名',
  `region_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT '' COMMENT '收货地址',
  `region_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT '' COMMENT '收货人地址region_name',
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '收货人详细地址',
  `address_lng` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '地图定位 经度',
  `address_lat` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '地图定位 纬度',
  `receiving_mode` tinyint(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '收货方式 默认0 0-普通快递 2-上门自提',
  `tel` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT '' COMMENT '收货人联系方式',
  `email` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT '' COMMENT '收货人邮箱',
  `postscript` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT '' COMMENT '买家留言',
  `best_time` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT '' COMMENT '最佳送货时间 默认空 可选：工作日/周末/假日均可',
  `pay_id` tinyint(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '支付方式id 默认0  id值根据后台增加的支付方式而不同 1货到付款 0余额支付 1支付宝 2银联支付 3微信支付 99找人代付',
  `pay_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT '' COMMENT '支付方式缩写【不支持余额支付！！！】 cod货到付款 alipay支付宝 union银联支付 weixin微信支付 to_pay找人代付',
  `pay_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT '' COMMENT '支付名称 货到付款 余额支付 支付宝 银联支付 微信支付 找人代付',
  `pay_sn` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0' COMMENT '支付单号 默认0 第三方支付平台编号',
  `is_cod` tinyint(1) NOT NULL DEFAULT 0 COMMENT '是否为货到付款 0 否 1 是',
  `order_amount` decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '订单总金额',
  `order_points` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '订单兑换积分',
  `money_paid` decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '订单实付金额',
  `goods_amount` decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '商品总金额',
  `inv_fee` decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '发票总费用',
  `shipping_fee` decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '配送总费用',
  `other_shipping_fee` decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '额外配送费',
  `packing_fee` decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '包装费',
  `cash_more` decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '货到付款加价',
  `discount_fee` decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '活动优惠金额',
  `change_amount` decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '订单改价总金额',
  `shipping_change` decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '运费改价金额',
  `surplus` decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '余额支付',
  `user_surplus` decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '可提现余额支付',
  `user_surplus_limit` decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '不可提现余额支付',
  `bonus_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '用户全网红包id',
  `shop_bonus_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '用户店铺红包id',
  `bonus` decimal(10, 2) NOT NULL COMMENT '全网红包金额',
  `shop_bonus` decimal(10, 2) NOT NULL COMMENT '店铺红包金额',
  `store_card_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '店铺储值卡ID',
  `store_card_price` decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '店铺储值卡金额',
  `integral` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '积分数量',
  `integral_money` decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '积分金额',
  `give_integral` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '订单赠送的积分',
  `order_from` int(0) UNSIGNED NOT NULL DEFAULT 1 COMMENT '订单来源 默认1 1PC端 2WAP端 ...',
  `add_time` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '订单添加时间 默认0',
  `take_time` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '订单完成时间 默认0',
  `take_countdown` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '订单完成倒计时时间 默认0',
  `pay_time` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '支付时间 默认0',
  `shipping_time` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '订单配送时间',
  `confirm_time` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '确认收货截止时间',
  `delay_days` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '延迟收货天数 默认0 0正常收货',
  `order_type` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '交易类型 0-普通商品 1-拍卖 2-预售 3-团购 5-积分兑换 6-拼团 8-砍价 10-搭配套餐 11-限时折扣 12-满减送 13-赠品活动 99-电子秤商品',
  `service_mark` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '服务态度 默认0',
  `send_mark` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '发货速度 默认0',
  `shipping_mark` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '物流速度 默认0',
  `buyer_type` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '买家类型 0-个人 1-店铺',
  `evaluate_status` tinyint(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '评价状态 默认0 0未评价，1已评价，2已过期未评价',
  `evaluate_time` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '评价时间 默认0',
  `end_time` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '订单终止时间 默认0',
  `is_distrib` tinyint(1) NOT NULL DEFAULT 0 COMMENT '是否为分销商品 0 否 1 是',
  `distrib_status` tinyint(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '分销订单状态 默认0 ',
  `is_show` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '是否显示 如：\"1,2,3,4\"',
  `is_delete` tinyint(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '订单删除状态 默认0 0-正常 1-放入回收站 2-彻底删除',
  `order_data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL COMMENT '订单活动数据 序列化存储',
  `mall_remark` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL COMMENT '平台方订单备注 序列化存储',
  `site_remark` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL COMMENT '站点订单备注 序列化存储',
  `shop_remark` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL COMMENT '店铺订单备注 序列化存储',
  `store_remark` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL COMMENT '网点备注 序列化存储',
  `close_reason` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '关闭订单原因',
  `cash_user_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT 'cash user id 默认0',
  `last_time` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '订单最后修改时间 默认0',
  `order_cancel` tinyint(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '用户提交取消申请状态 默认0 无取消申请 1等待商家审核 2商家审核通过 3商家拒绝通过',
  `refuse_reason` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '商家拒绝取消订单申请理由 默认空',
  `sub_order_id` int(0) UNSIGNED NOT NULL DEFAULT 1 COMMENT '子订单id 默认1 按单次购买商品总量数量递增',
  `buy_type` tinyint(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '购买类型 0-加入购物车购买 1-立即购买 2-去结算 3-兑换 4-自由购 5-到店购 6-礼品提货',
  `reachbuy_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0' COMMENT '自由购下单码号码',
  `growth_value` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0' COMMENT '会员等级成长值 默认0',
  `cs_take_status` tinyint(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT 'cs_take_status',
  `cs_take_amount` decimal(10, 2) NOT NULL COMMENT 'cs_take_amount',
  `cs_confirm_time` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT 'cs_confirm_time',
  `cs_settlement_time` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT 'cs_settlement_time',
  `cs_delivery_fee` decimal(10, 2) NOT NULL COMMENT 'cs_delivery_fee',
  `cs_delivery_enable` tinyint(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT 'cs_delivery_enable',
  `cs_take_time` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT 'cs_take_time',
  `revision_user_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT 'revision_user_id 默认0',
  `terminal_no` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT 'virtual code',
  `virtual_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT 'virtual code',
  `card_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT 'card_id',
  `is_cross_border` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT 'is_cross_border',
  `inital_request` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT 'inital_request',
  `inital_response` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT 'inital_response',
  `import_duty` decimal(10, 2) NOT NULL COMMENT 'import_duty',
  `shipping_tax` decimal(10, 2) NOT NULL COMMENT 'shipping_tax',
  `goods_tax` decimal(10, 2) NOT NULL COMMENT 'goods_tax',
  `push_pay_order_status` tinyint(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT 'push_pay_order_status',
  `push_order_status` tinyint(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT 'push_order_status',
  `push_logistics_order_status` tinyint(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT 'push_logistics_order_status',
  `is_send_weixin_message` tinyint(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT 'is_send_weixin_message',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `is_settlement` tinyint(0) UNSIGNED NULL DEFAULT 0 COMMENT '账单结算状态：0 未结算 1 已结算',
  `chargeoff_status` tinyint(0) UNSIGNED NULL DEFAULT 0 COMMENT '账单 (0:未结账 1:已出账 2:已结账单)',
  PRIMARY KEY (`order_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 49 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = '订单表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for order_pay
-- ----------------------------
DROP TABLE IF EXISTS `order_pay`;
CREATE TABLE `order_pay`  (
  `pay_id` int(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '用户ID',
  `pay_no` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '支付号',
  `trade_no` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT ' 支付平台单号',
  `order_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '订单ID',
  `payment_name` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '支付方式',
  `order_type` tinyint(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '支付类型 1-订单 2-充值',
  `order_amount` decimal(9, 2) UNSIGNED NOT NULL COMMENT '总金额',
  `order_balance` decimal(9, 2) UNSIGNED NOT NULL COMMENT '余额支付',
  `is_paid` tinyint(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '支付状态',
  `pay_time` timestamp(0) NULL DEFAULT NULL COMMENT '支付时间',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`pay_id`) USING BTREE,
  UNIQUE INDEX `order_pay_pay_no_unique`(`pay_no`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 40 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = '订单支付表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for order_settlement_log
-- ----------------------------
DROP TABLE IF EXISTS `order_settlement_log`;
CREATE TABLE `order_settlement_log`  (
  `id` int(0) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `order_id` int(0) NOT NULL DEFAULT 0 COMMENT '订单ID',
  `ru_id` int(0) NOT NULL DEFAULT 0 COMMENT '商家ID',
  `is_settlement` int(0) NOT NULL DEFAULT 0 COMMENT '是否结算',
  `gain_amount` decimal(10, 2) NOT NULL COMMENT '实际收取金额',
  `actual_amount` decimal(10, 2) NOT NULL COMMENT '实际结算金额',
  `type` tinyint(0) NOT NULL DEFAULT 0 COMMENT '触发结算类型：1、订单结算 2、账单结算',
  `add_time` int(0) NOT NULL DEFAULT 0 COMMENT '添加时间',
  `update_time` int(0) NOT NULL DEFAULT 0 COMMENT '更新时间',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `order_id`(`order_id`) USING BTREE,
  INDEX `ru_id`(`ru_id`) USING BTREE,
  INDEX `is_settlement`(`is_settlement`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = '账单结算记录（用于统计已计算和未结算金额）表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for password_resets
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets`  (
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  INDEX `password_resets_email_index`(`email`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for payment
-- ----------------------------
DROP TABLE IF EXISTS `payment`;
CREATE TABLE `payment`  (
  `pay_id` int(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `pay_code` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '支付方式代码',
  `pay_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '支付方式名称',
  `pay_desc` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '支付方式说明',
  `pay_sort` int(0) NOT NULL DEFAULT 255 COMMENT '排序',
  `pay_config` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL COMMENT '支付方式配置',
  `is_enable` tinyint(1) NOT NULL DEFAULT 0 COMMENT '是否启用',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`pay_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for personal_access_tokens
-- ----------------------------
DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE `personal_access_tokens`  (
  `id` bigint(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(0) UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `last_used_at` timestamp(0) NULL DEFAULT NULL,
  `expires_at` timestamp(0) NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `personal_access_tokens_token_unique`(`token`) USING BTREE,
  INDEX `personal_access_tokens_tokenable_type_tokenable_id_index`(`tokenable_type`, `tokenable_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 58 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for print_spec
-- ----------------------------
DROP TABLE IF EXISTS `print_spec`;
CREATE TABLE `print_spec`  (
  `id` int(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `shop_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '店铺id',
  `printer` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '打印机名称',
  `print_spec` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '打印机规格',
  `is_default` tinyint(1) NOT NULL DEFAULT 0 COMMENT '是否默认打印机 默认0',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `tpl_data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL COMMENT '模板数据',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for programs_qrcode
-- ----------------------------
DROP TABLE IF EXISTS `programs_qrcode`;
CREATE TABLE `programs_qrcode`  (
  `id` bigint(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `shop_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '店铺id',
  `content` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '自定义内容',
  `qrcode` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '小程序码',
  `img` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '自定义logo',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = '微信小程序码表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for push_message
-- ----------------------------
DROP TABLE IF EXISTS `push_message`;
CREATE TABLE `push_message`  (
  `id` bigint(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '推送标题',
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL COMMENT '推送内容',
  `push_type` tinyint(0) UNSIGNED NOT NULL DEFAULT 7 COMMENT '推送类型 默认7 0-商品 1-店铺主页 2-文章详情 3-分类商品 4-团购活动 5-品牌专题 6-自定义链接',
  `shop` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '店铺id',
  `article` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '文章id',
  `category` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '商品分类id',
  `group` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '团购活动id',
  `brand` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '品牌id',
  `link` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '自定义链接',
  `platforms` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '推送对象平台 ios-IOS android-Android 多个以逗号分隔',
  `target_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '推送对象条件 all-广播（所有人） alias-设备别名(Alias) ',
  `target_text` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '推送对象 如有多个设备标签或别名请用英文半角逗号(,)隔开',
  `sales_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '智能营销策略 5-定向运营',
  `sales_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '计划名称',
  `group_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '选择人群 如：interested-定向运营',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = 'app 消息推送表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for qcode
-- ----------------------------
DROP TABLE IF EXISTS `qcode`;
CREATE TABLE `qcode`  (
  `id` bigint(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `qcode_type` tinyint(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '二维码类型 0-商品二维码 1-文章二维码',
  `qcode_content` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '二维码内容 商品ID或文章ID',
  `qcode` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '二维码',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = '微信二维码表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for region
-- ----------------------------
DROP TABLE IF EXISTS `region`;
CREATE TABLE `region`  (
  `region_id` int(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `region_name` char(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '地区名称',
  `region_code` char(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '地区代码',
  `parent_code` char(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '0' COMMENT '上级区域代码',
  `region_type` char(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '地区类型',
  `center` char(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '地区经纬度',
  `city_code` char(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '城市代码',
  `level` tinyint(0) NOT NULL DEFAULT 0 COMMENT '地区级别',
  `is_enable` tinyint(0) NOT NULL COMMENT '是否启用',
  `is_scope` tinyint(0) NOT NULL DEFAULT 1,
  `sort` int(0) NOT NULL COMMENT '排序',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`region_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3226 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for self_pickup
-- ----------------------------
DROP TABLE IF EXISTS `self_pickup`;
CREATE TABLE `self_pickup`  (
  `pickup_id` int(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `shop_id` int(0) UNSIGNED NOT NULL COMMENT '店铺id',
  `pickup_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '自提点名称',
  `region_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '联系地址',
  `pickup_address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '详细地址',
  `address_lng` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '地图定位 经度',
  `address_lat` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '地图定位 纬度',
  `pickup_tel` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '联系电话',
  `pickup_images` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '自提点照片',
  `is_show` tinyint(1) NOT NULL DEFAULT 1 COMMENT '是否显示',
  `pickup_desc` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL COMMENT '商家推荐',
  `sort` int(0) NOT NULL DEFAULT 255 COMMENT '排序',
  `is_delete` tinyint(1) NOT NULL DEFAULT 0 COMMENT '删除状态',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`pickup_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for self_shop
-- ----------------------------
DROP TABLE IF EXISTS `self_shop`;
CREATE TABLE `self_shop`  (
  `shop_id` int(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `is_supply` tinyint(1) NOT NULL DEFAULT 0 COMMENT '是否供应',
  `shop_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '店铺名称',
  `shop_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '店铺头像',
  `shop_logo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '店铺LOGO',
  `shop_poster` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '店铺海报',
  `shop_sign` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '店铺招牌',
  `shop_sign_m` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '店铺招牌(微)',
  `detail_introduce` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '店铺公告',
  `shop_keywords` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '店铺关键词',
  `shop_description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '店铺简介',
  `start_price` decimal(10, 2) NOT NULL COMMENT '起送金额',
  `opening_hour` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '营业时间',
  `shop_lng` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '经度',
  `shop_lat` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '纬度',
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '详细地址',
  `show_price` tinyint(1) NOT NULL DEFAULT 1 COMMENT '店铺价格是否显示',
  `show_content` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '店铺价格显示内容',
  `button_content` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '购买按钮显示内容',
  `shop_type` tinyint(0) UNSIGNED NULL DEFAULT NULL COMMENT '店铺类型',
  `clearing_cycle` tinyint(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '结算周期',
  `cat_id` int(0) UNSIGNED NOT NULL COMMENT '店铺分类',
  `user_id` int(0) UNSIGNED NOT NULL COMMENT '绑定店主帐号',
  `user_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '会员名',
  `duration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '开店时长',
  `system_fee` decimal(10, 2) NOT NULL COMMENT '平台使用费',
  `insure_fee` decimal(10, 2) NOT NULL COMMENT '平台保证金',
  `take_rate` decimal(10, 2) NOT NULL COMMENT '佣金比例',
  `qrcode_take_rate` decimal(10, 2) NOT NULL COMMENT '神码佣金比例',
  `close_info` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '店铺状态修改备注',
  `fail_info` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '审核失败原因',
  `goods_status` tinyint(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '店铺商品是否需要审核',
  `show_credit` tinyint(1) NOT NULL DEFAULT 1 COMMENT '是否显示店铺信誉',
  `login_status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '是否允许登录卖家中心',
  `goods_is_show` tinyint(1) NOT NULL DEFAULT 1 COMMENT '店铺商品能否在商城展示',
  `show_in_street` tinyint(1) NOT NULL DEFAULT 1 COMMENT '店铺能否在商城展示',
  `shop_status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '店铺状态',
  `shop_sort` int(0) UNSIGNED NOT NULL DEFAULT 255 COMMENT '排序',
  `region_code` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '联系地址 地区code',
  `cat_ids` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '店铺经营类目',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`shop_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for seller_account
-- ----------------------------
DROP TABLE IF EXISTS `seller_account`;
CREATE TABLE `seller_account`  (
  `account_id` int(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `account_sn` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '流水号',
  `user_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '订单买家id',
  `admin_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '店主id',
  `amount` decimal(10, 2) NOT NULL COMMENT '账户变动金额',
  `add_time` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '账户变动时间',
  `note` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL COMMENT '名称/备注',
  `account_type` tinyint(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '账户分类',
  `status` tinyint(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '交易订单状态 默认0 0-进行中 1-交易成功 2-交易关闭 3-退款成功',
  `order_sn` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '订单编号',
  `back_sn` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '售后编号',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`account_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 19 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = '店铺进出账明细表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for seller_bill_back_order
-- ----------------------------
DROP TABLE IF EXISTS `seller_bill_back_order`;
CREATE TABLE `seller_bill_back_order`  (
  `id` bigint(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `order_id` int(0) NOT NULL DEFAULT 0 COMMENT '账单订单ID',
  `ret_id` int(0) NOT NULL DEFAULT 0 COMMENT '单品退单ID',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `order_id`(`order_id`) USING BTREE,
  INDEX `ret_id`(`ret_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for seller_bill_goods
-- ----------------------------
DROP TABLE IF EXISTS `seller_bill_goods`;
CREATE TABLE `seller_bill_goods`  (
  `id` int(0) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `rec_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '商品订单id',
  `order_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '订单id',
  `goods_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '商品id',
  `cat_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '分类id',
  `proportion` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '分类佣金百分比',
  `goods_price` decimal(10, 2) UNSIGNED NOT NULL COMMENT '商品价格',
  `dis_amount` decimal(10, 2) UNSIGNED NOT NULL COMMENT '商品单品满减优惠金额',
  `goods_number` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '商品数量',
  `goods_attr` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL COMMENT '商品属性',
  `drp_money` decimal(10, 2) UNSIGNED NOT NULL COMMENT '分销价额',
  `commission_rate` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '佣金比例',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `rec_id`(`rec_id`) USING BTREE,
  INDEX `order_id`(`order_id`) USING BTREE,
  INDEX `goods_id`(`goods_id`) USING BTREE,
  INDEX `cat_id`(`cat_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = '商家账单订单商品' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for seller_bill_order
-- ----------------------------
DROP TABLE IF EXISTS `seller_bill_order`;
CREATE TABLE `seller_bill_order`  (
  `id` int(0) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `bill_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '商家账单id',
  `user_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '订单会员id',
  `shop_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '商家id',
  `order_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '订单id',
  `order_sn` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '订单编号',
  `order_status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '订单状态',
  `shipping_status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '配送状态',
  `pay_status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '支付状态',
  `order_amount` decimal(10, 2) UNSIGNED NOT NULL COMMENT '订单总额',
  `return_amount` decimal(10, 2) UNSIGNED NOT NULL COMMENT '退款总额',
  `return_shippingfee` decimal(10, 2) UNSIGNED NOT NULL COMMENT '订单退货运费',
  `goods_amount` decimal(10, 2) UNSIGNED NOT NULL COMMENT '商品总额',
  `tax` decimal(10, 2) UNSIGNED NOT NULL COMMENT '税额',
  `shipping_fee` decimal(10, 2) UNSIGNED NOT NULL COMMENT '运费金额',
  `other_shipping_fee` decimal(10, 2) UNSIGNED NOT NULL COMMENT '额外运费金额',
  `insure_fee` decimal(10, 2) UNSIGNED NOT NULL COMMENT '保价费用',
  `pay_fee` decimal(10, 2) UNSIGNED NOT NULL COMMENT '支付费用',
  `packing_fee` decimal(10, 2) UNSIGNED NOT NULL COMMENT '包装费用',
  `card_fee` decimal(10, 2) UNSIGNED NOT NULL COMMENT '贺卡费用',
  `bonus` decimal(10, 2) UNSIGNED NOT NULL COMMENT '红包金额',
  `shop_bonus` decimal(10, 2) UNSIGNED NOT NULL COMMENT '店铺红包金额',
  `integral_money` decimal(10, 2) UNSIGNED NOT NULL COMMENT '积分金额',
  `coupons` decimal(10, 2) UNSIGNED NOT NULL COMMENT '优惠券',
  `discount_fee` decimal(10, 2) UNSIGNED NOT NULL COMMENT '优惠金额',
  `store_card_price` decimal(10, 2) UNSIGNED NOT NULL COMMENT '储值卡',
  `money_paid` decimal(10, 2) UNSIGNED NOT NULL COMMENT '已支付金额',
  `surplus` decimal(10, 2) UNSIGNED NOT NULL COMMENT '余额支付金额',
  `drp_money` decimal(10, 2) UNSIGNED NOT NULL COMMENT '分销金额',
  `confirm_take_time` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '确认收货时间',
  `chargeoff_status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '账单 (0:未结账 1:已出账 2:已结账单)',
  `return_rate_fee` decimal(10, 2) NOT NULL COMMENT '跨境税费退款金额',
  `rate_fee` decimal(10, 2) NOT NULL COMMENT '跨境税费',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `order_id`(`order_id`) USING BTREE,
  UNIQUE INDEX `order_sn`(`order_sn`) USING BTREE,
  INDEX `bill_id`(`bill_id`) USING BTREE,
  INDEX `user_id`(`user_id`) USING BTREE,
  INDEX `shop_id`(`shop_id`) USING BTREE,
  INDEX `order_status`(`order_status`) USING BTREE,
  INDEX `shipping_status`(`shipping_status`) USING BTREE,
  INDEX `confirm_take_time`(`confirm_take_time`) USING BTREE,
  INDEX `chargeoff_status`(`chargeoff_status`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = '商家账单订单' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for seller_commission_bill
-- ----------------------------
DROP TABLE IF EXISTS `seller_commission_bill`;
CREATE TABLE `seller_commission_bill`  (
  `id` int(0) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `shop_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '商家id',
  `bill_sn` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '账单编号',
  `order_amount` decimal(10, 2) UNSIGNED NOT NULL COMMENT '订单总额',
  `shipping_amount` decimal(10, 2) UNSIGNED NOT NULL COMMENT '运费总金额',
  `return_amount` decimal(10, 2) UNSIGNED NOT NULL COMMENT '退款总额',
  `return_shippingfee` decimal(10, 2) UNSIGNED NOT NULL COMMENT '订单退货运费',
  `drp_money` decimal(10, 2) UNSIGNED NOT NULL COMMENT '分销金额',
  `proportion` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '佣金比例',
  `commission_model` tinyint(1) NOT NULL DEFAULT -1 COMMENT '佣金模式（0：按商家比例 1：按平台分类比例）',
  `gain_commission` decimal(10, 2) UNSIGNED NOT NULL COMMENT '收取佣金金额',
  `should_amount` decimal(10, 2) UNSIGNED NOT NULL COMMENT '本期结算',
  `actual_amount` decimal(10, 2) UNSIGNED NOT NULL COMMENT '实结金额（账单结束）',
  `chargeoff_time` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '出账时间',
  `settleaccounts_time` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '结账时间',
  `start_time` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '开始时间',
  `end_time` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '结束时间',
  `chargeoff_status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '出账状态 0:未出账 1:已出账 2:账单结束 3:关闭账单',
  `bill_cycle` tinyint(1) NOT NULL DEFAULT 2 COMMENT '账单结算周期类型',
  `bill_apply` tinyint(1) NOT NULL DEFAULT 0 COMMENT '商家申请账单 (0:未申请 1:已申请)',
  `apply_note` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '申请描述',
  `apply_time` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '申请时间',
  `operator` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '触发产生账单管理员',
  `check_status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '审核账单状态（0：待处理 1：同意 2：拒绝）',
  `reject_note` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '拒绝账单内容',
  `check_time` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '审核账单时间',
  `frozen_money` decimal(10, 2) UNSIGNED NOT NULL COMMENT '账单冻结资金',
  `frozen_data` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '账单冻结时间（天）',
  `frozen_time` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '操作冻结时间',
  `negative_amount` decimal(10, 2) UNSIGNED NOT NULL COMMENT '负账单金额',
  `return_rate_fee` decimal(10, 2) NOT NULL COMMENT '跨境税费退款金额',
  `rate_fee` decimal(10, 2) NOT NULL COMMENT '跨境税费',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `shop_id`(`shop_id`) USING BTREE,
  INDEX `bill_sn`(`bill_sn`) USING BTREE,
  INDEX `chargeoff_time`(`chargeoff_time`) USING BTREE,
  INDEX `start_time`(`start_time`) USING BTREE,
  INDEX `end_time`(`end_time`) USING BTREE,
  INDEX `chargeoff_status`(`chargeoff_status`) USING BTREE,
  INDEX `bill_cycle`(`bill_cycle`) USING BTREE,
  INDEX `bill_apply`(`bill_apply`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = '商家账单' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for seller_negative_bill
-- ----------------------------
DROP TABLE IF EXISTS `seller_negative_bill`;
CREATE TABLE `seller_negative_bill`  (
  `id` int(0) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '自增ID号',
  `bill_sn` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '负账单单号',
  `commission_bill_sn` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '账单编号',
  `commission_bill_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '账单ID',
  `shop_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '商家ID',
  `return_amount` decimal(8, 2) UNSIGNED NOT NULL COMMENT '负账单总金额',
  `return_shippingfee` decimal(8, 2) UNSIGNED NOT NULL COMMENT '负账单退款总金额',
  `return_rate_price` decimal(10, 2) NOT NULL COMMENT '跨境税费退款金额',
  `actual_deducted` decimal(10, 2) NOT NULL COMMENT '实际扣除总金额',
  `chargeoff_status` tinyint(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '账单状态（0 未处理， 1已处理）',
  `start_time` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '负账单开始时间',
  `end_time` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '负账单结束时间',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `commission_bill_id`(`commission_bill_id`) USING BTREE,
  INDEX `shop_id`(`shop_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = '商家负账单表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for seller_negative_order
-- ----------------------------
DROP TABLE IF EXISTS `seller_negative_order`;
CREATE TABLE `seller_negative_order`  (
  `id` int(0) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '自增ID号',
  `negative_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '负账单ID',
  `order_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '订单ID',
  `order_sn` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '订单单号',
  `ret_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '单品退货订单ID',
  `return_sn` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '退货订单单号',
  `seller_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '商家ID',
  `return_amount` decimal(8, 2) UNSIGNED NOT NULL COMMENT '退款金额',
  `return_rate_price` decimal(10, 2) NOT NULL COMMENT '跨境税费退款金额',
  `return_shippingfee` decimal(8, 2) UNSIGNED NOT NULL COMMENT '退运费金额',
  `seller_proportion` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0' COMMENT '店铺佣金利率百分比',
  `cat_proportion` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0' COMMENT '商品分类佣金利率百分比',
  `commission_rate` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0' COMMENT '商品佣金利率百分比',
  `gain_commission` decimal(10, 2) NOT NULL COMMENT '收取退款佣金金额',
  `should_amount` decimal(10, 2) NOT NULL COMMENT '应结退款佣金金额',
  `settle_accounts` tinyint(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '账单订单结算状态（0 未结算， 1已结算， 2作废）',
  `add_time` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '添加时间',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `negative_id`(`negative_id`) USING BTREE,
  INDEX `order_id`(`order_id`) USING BTREE,
  INDEX `ret_id`(`ret_id`) USING BTREE,
  INDEX `seller_id`(`seller_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = '商家负账单订单表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for sheet_config
-- ----------------------------
DROP TABLE IF EXISTS `sheet_config`;
CREATE TABLE `sheet_config`  (
  `sheet_config_id` int(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `shipping_code` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '系统物流代码',
  `customer_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '商家ID',
  `customer_pwd` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '商家接口密码',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`sheet_config_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for shipping
-- ----------------------------
DROP TABLE IF EXISTS `shipping`;
CREATE TABLE `shipping`  (
  `shipping_id` int(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `shipping_name` char(120) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '快递公司名称',
  `shipping_code` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '快递100物流公司代码',
  `img_width` int(0) UNSIGNED NULL DEFAULT 0 COMMENT '背景图片宽度',
  `img_height` int(0) UNSIGNED NULL DEFAULT 0 COMMENT '背景图片高度',
  `offset_top` int(0) UNSIGNED NULL DEFAULT 0 COMMENT '上偏移量',
  `offset_left` int(0) UNSIGNED NULL DEFAULT 0 COMMENT '左偏移量',
  `img_path` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '模板图片',
  `is_open` tinyint(1) NOT NULL DEFAULT 0 COMMENT '平台方是否开启此快递 0-否 1-是',
  `is_sheet` tinyint(1) NOT NULL DEFAULT 0 COMMENT '是否支持电子面单',
  `is_system` tinyint(1) NOT NULL DEFAULT 0 COMMENT '是否系统默认',
  `shipping_sort` int(0) NOT NULL DEFAULT 255 COMMENT '排序',
  `config_lable` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL COMMENT '配置标签',
  `logo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '快递公司logo',
  `site_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '快递公司网址',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`shipping_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for shop
-- ----------------------------
DROP TABLE IF EXISTS `shop`;
CREATE TABLE `shop`  (
  `shop_id` int(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(0) UNSIGNED NOT NULL COMMENT '绑定店主帐号',
  `site_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '站点id',
  `shop_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '店铺名称',
  `shop_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '店铺头像',
  `shop_logo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '店铺LOGO',
  `shop_poster` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '店铺海报',
  `shop_sign` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '店铺招牌',
  `shop_type` tinyint(0) UNSIGNED NOT NULL DEFAULT 2 COMMENT '店铺类型 1个人店铺 2企业店铺 默认2',
  `is_supply` tinyint(1) NOT NULL DEFAULT 0 COMMENT '是否供货商 0-否 1-是',
  `cat_id` int(0) UNSIGNED NOT NULL COMMENT '店铺分类',
  `credit` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '店铺信誉 默认0',
  `desc_score` decimal(10, 2) NOT NULL DEFAULT 5.00 COMMENT '店铺评分（描述）',
  `service_score` decimal(10, 2) NOT NULL DEFAULT 5.00 COMMENT '店铺评分（服务）',
  `send_score` decimal(10, 2) NOT NULL DEFAULT 5.00 COMMENT '店铺评分（发货）',
  `logistics_score` decimal(10, 2) NOT NULL DEFAULT 5.00 COMMENT '店铺评分（物流）',
  `region_code` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '地区代码',
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '详细地址',
  `shop_lng` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '经度',
  `shop_lat` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '纬度',
  `opening_hour` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL COMMENT '营业时间',
  `close_tips` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '店铺关闭备注',
  `add_time` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '添加时间',
  `pass_time` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '审核通过时间',
  `duration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '开店时长',
  `unit` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT 'unit',
  `clearing_cycle` tinyint(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '结算周期',
  `open_time` int(0) NOT NULL DEFAULT 0 COMMENT '店铺开始时间',
  `end_time` int(0) NOT NULL DEFAULT 0 COMMENT '店铺到期时间',
  `system_fee` decimal(10, 2) NOT NULL COMMENT '平台使用费',
  `insure_fee` decimal(10, 2) NOT NULL COMMENT '平台保证金',
  `goods_status` tinyint(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '商品是否需要审核 0-默认 1-必须审核 2-无需审核 3-仅第一次上架需要审核',
  `shop_status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '店铺状态 默认0 0关闭 1开启',
  `close_info` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '店铺关闭备注',
  `shop_sort` int(0) UNSIGNED NOT NULL DEFAULT 255 COMMENT '排序',
  `shop_audit` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '店铺审核状态 默认0 0待审核 1审核通过 2审核不通过',
  `fail_info` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '店铺审核不通过备注',
  `simply_introduce` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '店铺简要介绍',
  `shop_keywords` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '店铺关键词',
  `shop_description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '店铺简介',
  `detail_introduce` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '店铺公告',
  `service_tel` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '店铺服务电话',
  `service_hours` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '店铺服务时间 如：AM 08:30 - PM 17:30',
  `shop_sign_m` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '店铺招牌(微)',
  `take_rate` decimal(10, 2) NOT NULL COMMENT '佣金比例',
  `qrcode_take_rate` decimal(10, 2) NOT NULL COMMENT '神码佣金比例',
  `collect_allow_number` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '允许采集商品数量',
  `collected_number` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '已采集商品数量',
  `comment_allow_number` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '允许采集评论次数',
  `comment_number` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '已采集评论次数',
  `store_allow_number` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '每个店铺可添加网点数量',
  `store_number` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '店铺已添加网点数量',
  `login_status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '是否允许登录卖家中心',
  `show_credit` tinyint(1) NOT NULL DEFAULT 1 COMMENT '是否显示店铺信誉',
  `show_in_street` tinyint(1) NOT NULL DEFAULT 1 COMMENT '店铺能否在商城展示',
  `goods_is_show` tinyint(1) NOT NULL DEFAULT 1 COMMENT '店铺商品能否在商城展示',
  `control_price` tinyint(1) NOT NULL DEFAULT 1 COMMENT '店铺商品能否control_price',
  `show_price` tinyint(1) NOT NULL DEFAULT 1 COMMENT '店铺价格是否显示',
  `show_content` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '店铺价格显示内容',
  `button_content` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '购买按钮显示内容',
  `button_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '购买按钮链接',
  `start_price` decimal(10, 2) NOT NULL COMMENT '起送金额',
  `shop_sn` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '第三方组织编号',
  `rebate_enable` tinyint(1) NOT NULL DEFAULT 0 COMMENT '店铺是否开启折扣 默认0 0否 1是',
  `rebate_days` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '店铺折扣天数',
  `rebate_setting` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '店铺折扣设置',
  `rebate_begin_time` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '店铺折扣开始时间 默认0',
  `is_other_shpping_fee` tinyint(1) NOT NULL DEFAULT 0 COMMENT '店铺是否统一额外配送费 默认0 0-否 1-是',
  `other_shipping_fee` decimal(10, 2) NOT NULL COMMENT '额外增加配送费',
  `is_packing_fee` tinyint(1) NOT NULL DEFAULT 0 COMMENT '店铺是否统一包装费 默认0 0-否 1-是',
  `packing_fee` decimal(10, 2) NOT NULL COMMENT '店铺统一包装费',
  `shipping_time` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL COMMENT '下单时间不在某个范围内额外增加运费',
  `multi_store_number` int(0) NOT NULL DEFAULT 0 COMMENT '多网点数量',
  `multi_store_allow_number` int(0) NOT NULL DEFAULT 0 COMMENT '允许添加的多网点数量',
  `is_cross_border` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'is_cross_border',
  `wx_barcode` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL COMMENT '微信二维码 如：https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket=gQ',
  `collect_num` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '店铺关注量',
  `is_own_shop` tinyint(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '是否自营店铺 0非自营 1自营 默认0',
  `user_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '会员名',
  `back_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '模板备份id',
  `m_back_id` int(0) NOT NULL DEFAULT 0 COMMENT '微信端店铺首页模板备份id',
  `app_back_id` int(0) NOT NULL DEFAULT 0 COMMENT 'APP端店铺首页模板备份id',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`shop_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 32 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for shop_address
-- ----------------------------
DROP TABLE IF EXISTS `shop_address`;
CREATE TABLE `shop_address`  (
  `address_id` int(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `shop_id` int(0) UNSIGNED NOT NULL COMMENT '店铺id',
  `consignee` char(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '收货人',
  `region_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '收货地址',
  `address_detail` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '详细地址',
  `mobile` char(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '手机号码',
  `tel` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '固定电话',
  `email` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '邮件地址',
  `is_default` tinyint(1) NOT NULL DEFAULT 0 COMMENT '是否默认地址',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`address_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = '发/退货地址库表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for shop_apply
-- ----------------------------
DROP TABLE IF EXISTS `shop_apply`;
CREATE TABLE `shop_apply`  (
  `apply_id` int(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(0) NOT NULL DEFAULT 0 COMMENT '会员id',
  `shop_id` int(0) NOT NULL DEFAULT 0 COMMENT '店铺id',
  `site_id` int(0) NOT NULL DEFAULT 0 COMMENT '站点id',
  `shop_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '店铺名称',
  `cat_id` int(0) UNSIGNED NOT NULL COMMENT '店铺分类',
  `duration` int(0) NOT NULL DEFAULT 0 COMMENT '开店时长',
  `unit` int(0) NOT NULL DEFAULT 0 COMMENT '开店时长单位 默认0 0-年 1-月 2-天',
  `system_fee` decimal(10, 2) NOT NULL COMMENT '平台使用费',
  `insure_fee` decimal(10, 2) NOT NULL COMMENT '平台保证金',
  `cat_ids` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '店铺经营类目',
  `audit_status` tinyint(0) NOT NULL DEFAULT 0 COMMENT '审核状态 默认0 0-待审核 1-审核通过 2-审核拒绝',
  `fail_info` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '审核失败原因',
  `pay_status` tinyint(0) NOT NULL DEFAULT 0 COMMENT '开店款项付款状态 默认0 0-待付款 1-已付款',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`apply_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for shop_auth
-- ----------------------------
DROP TABLE IF EXISTS `shop_auth`;
CREATE TABLE `shop_auth`  (
  `id` int(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for shop_bill
-- ----------------------------
DROP TABLE IF EXISTS `shop_bill`;
CREATE TABLE `shop_bill`  (
  `bill_id` bigint(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `shop_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '店铺名称',
  `shop_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '店铺id',
  `site_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '站点名称',
  `site_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '站点id',
  `order_ids` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '订单ids',
  `shop_status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '结算状态 0-未出账 2-已出账，待结算 3-已出账，已结算 4-部分账单已出账，已结算',
  `order_count` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '订单总数量',
  `order_amount` decimal(10, 2) NOT NULL COMMENT '本期应结',
  `system_money` decimal(10, 2) NOT NULL COMMENT '平台佣金',
  `site_money` decimal(10, 2) NOT NULL COMMENT '站点佣金',
  `shop_money` decimal(10, 2) NOT NULL COMMENT '店铺付款金额',
  `shipping_fee` decimal(10, 2) NOT NULL COMMENT '运费',
  `other_shipping_fee` decimal(10, 2) NOT NULL COMMENT '额外配送费',
  `packing_fee` decimal(10, 2) NOT NULL COMMENT '包装费',
  `alipay` decimal(10, 2) NOT NULL COMMENT '支付宝支付',
  `weixin` decimal(10, 2) NOT NULL COMMENT '微信支付',
  `union` decimal(10, 2) NOT NULL COMMENT '银联支付',
  `is_cod` decimal(10, 2) NOT NULL COMMENT '货到付款',
  `store_card` decimal(10, 2) NOT NULL COMMENT '店铺购物卡支付',
  `integral_money` decimal(10, 2) NOT NULL COMMENT '积分抵扣',
  `surplus` decimal(10, 2) NOT NULL COMMENT '余额支付',
  `activity_money` decimal(10, 2) NOT NULL COMMENT '平台承担活动款',
  `year` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '年份',
  `group_time` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '年月',
  `start_date` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '账单开始时间',
  `end_date` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '账单结束时间',
  `finish_money` decimal(10, 2) NOT NULL COMMENT '已结金额',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`bill_id`) USING BTREE,
  INDEX `shop_bill_shop_id_index`(`shop_id`) USING BTREE,
  INDEX `shop_bill_site_id_index`(`site_id`) USING BTREE,
  INDEX `shop_bill_shop_status_index`(`shop_status`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = '店铺结算表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for shop_bind_class
-- ----------------------------
DROP TABLE IF EXISTS `shop_bind_class`;
CREATE TABLE `shop_bind_class`  (
  `bind_cls_id` int(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `shop_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '店铺id',
  `cls_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '平台店铺分类id',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`bind_cls_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 14 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for shop_category
-- ----------------------------
DROP TABLE IF EXISTS `shop_category`;
CREATE TABLE `shop_category`  (
  `cat_id` int(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `cat_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '分类名称',
  `parent_id` smallint(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '上级分类，店铺商品分类最多支持二级',
  `shop_id` int(0) UNSIGNED NOT NULL COMMENT '店铺id',
  `keywords` char(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT 'Keywords',
  `cat_desc` char(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '分类描述',
  `is_show` tinyint(1) NOT NULL DEFAULT 0 COMMENT '是否显示',
  `cat_sort` int(0) UNSIGNED NOT NULL DEFAULT 255 COMMENT '排序',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`cat_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 17 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for shop_class
-- ----------------------------
DROP TABLE IF EXISTS `shop_class`;
CREATE TABLE `shop_class`  (
  `cls_id` int(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `cls_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '分类名称',
  `parent_id` smallint(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '上级分类，店铺分类最多支持三级',
  `cls_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '分类图标',
  `is_hot` tinyint(1) NOT NULL DEFAULT 0 COMMENT '是否热门',
  `is_show` tinyint(1) NOT NULL DEFAULT 0 COMMENT '是否显示',
  `cls_sort` int(0) UNSIGNED NOT NULL DEFAULT 255 COMMENT '排序',
  `keywords` char(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT 'Keywords',
  `cls_desc` char(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT 'Cls Desc',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`cls_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for shop_comment
-- ----------------------------
DROP TABLE IF EXISTS `shop_comment`;
CREATE TABLE `shop_comment`  (
  `shop_comment_id` int(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '会员id',
  `shop_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '店铺id',
  `order_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '订单id',
  `shop_service` tinyint(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '卖家服务态度 默认0',
  `shop_speed` tinyint(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '卖家发货速度 默认0',
  `logistics_speed` tinyint(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '物流公司的服务 默认0',
  `shop_comment_add_time` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '店铺动态评价时间 默认0',
  `shop_comment_status` tinyint(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '店铺评价状态 默认0 0待审核 1审核通过 2审核拒绝',
  `shop_is_delete` tinyint(1) NOT NULL DEFAULT 0 COMMENT '是否删除 默认0 0正常 1已删除',
  `shop_is_show` tinyint(1) NOT NULL DEFAULT 0 COMMENT '是否显示评价 默认0 0不显示 1显示',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`shop_comment_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = '店铺动态评价表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for shop_config
-- ----------------------------
DROP TABLE IF EXISTS `shop_config`;
CREATE TABLE `shop_config`  (
  `id` int(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `shop_config_id` int(0) UNSIGNED NOT NULL COMMENT '店铺配置id',
  `shop_id` int(0) UNSIGNED NOT NULL COMMENT '店铺id',
  `config_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '配置code',
  `value` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL COMMENT '配置值',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 691 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for shop_config_field
-- ----------------------------
DROP TABLE IF EXISTS `shop_config_field`;
CREATE TABLE `shop_config_field`  (
  `id` int(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '配置code',
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '配置标题',
  `group` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '配置分组',
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '表单类型',
  `required` tinyint(0) NOT NULL DEFAULT 0 COMMENT '字段是否必须 0非必须 1必须',
  `anchor` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '页面导航',
  `default_value` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL COMMENT '默认值 默认空',
  `options` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL COMMENT '配置项',
  `labels` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL COMMENT '配置项的label',
  `tips` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL COMMENT '配置提示',
  `sort` int(0) NOT NULL DEFAULT 255 COMMENT '排序',
  `status` tinyint(0) NOT NULL DEFAULT 1 COMMENT '状态',
  `storage_dir` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL COMMENT '图片存储路径',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 83 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for shop_contract
-- ----------------------------
DROP TABLE IF EXISTS `shop_contract`;
CREATE TABLE `shop_contract`  (
  `id` int(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `contract_id` int(0) UNSIGNED NOT NULL COMMENT '保障服务id',
  `shop_id` int(0) UNSIGNED NOT NULL COMMENT '店铺id',
  `status` tinyint(0) UNSIGNED NOT NULL DEFAULT 1 COMMENT '审核状态 1等待审核 2审核通过 3审核未通过',
  `audit_time` int(0) NOT NULL DEFAULT 0 COMMENT '审核时间',
  `is_enable` tinyint(1) NOT NULL DEFAULT 1 COMMENT '是否启用 默认启用',
  `remark` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '审核意见',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for shop_credit
-- ----------------------------
DROP TABLE IF EXISTS `shop_credit`;
CREATE TABLE `shop_credit`  (
  `credit_id` int(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `credit_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '店铺信誉名称',
  `credit_img` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '店铺信誉图标',
  `min_point` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '信誉值下限',
  `max_point` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '信誉值上限',
  `remark` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '备注',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`credit_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 12 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for shop_field_value
-- ----------------------------
DROP TABLE IF EXISTS `shop_field_value`;
CREATE TABLE `shop_field_value`  (
  `id` int(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `shop_id` int(0) UNSIGNED NOT NULL COMMENT '店铺id',
  `real_name` char(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '真实姓名',
  `card_no` char(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '身份证号码',
  `hand_card` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '手持身份证照片',
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '联系地址',
  `company_name` char(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '公司名称',
  `unified_social_credi` char(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '统一社会信用代码',
  `artificial_person` char(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '法人代表姓名',
  `license` char(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '企业法人营业执照',
  `special_aptitude` char(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '特殊行业资质',
  `card_type` char(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '身份证类型',
  `card_side_a` char(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '身份证正面',
  `card_side_b` char(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '身份证背面（国徽页）',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for shop_log
-- ----------------------------
DROP TABLE IF EXISTS `shop_log`;
CREATE TABLE `shop_log`  (
  `id` int(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `content` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '日志内容',
  `user_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '操作者用户名',
  `user_id` int(0) NOT NULL COMMENT '操作者用户id',
  `shop_id` int(0) NOT NULL DEFAULT 0 COMMENT '店铺id',
  `ip` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'IP地址',
  `url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '操作url',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1513 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for shop_message_tpl
-- ----------------------------
DROP TABLE IF EXISTS `shop_message_tpl`;
CREATE TABLE `shop_message_tpl`  (
  `shop_tpl_id` int(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `is_open` tinyint(1) NOT NULL DEFAULT 1 COMMENT '是否开启',
  `msg_tpl_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '消息模板id',
  `shop_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '店铺id',
  `mobile` char(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '手机号码',
  `email` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '邮件地址',
  `wx_id` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '微信号',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`shop_tpl_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 12 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = '店铺消息模板表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for shop_navigation
-- ----------------------------
DROP TABLE IF EXISTS `shop_navigation`;
CREATE TABLE `shop_navigation`  (
  `nav_id` int(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nav_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '导航名称',
  `nav_type` tinyint(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '导航类型',
  `nav_link` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '导航链接',
  `is_show` tinyint(1) NOT NULL DEFAULT 1 COMMENT '是否显示',
  `new_open` tinyint(1) NOT NULL DEFAULT 1 COMMENT '新窗口打开',
  `nav_sort` tinyint(0) UNSIGNED NOT NULL DEFAULT 255 COMMENT '排序',
  `shop_id` int(0) UNSIGNED NOT NULL COMMENT '店铺id',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`nav_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = '店铺导航表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for shop_node
-- ----------------------------
DROP TABLE IF EXISTS `shop_node`;
CREATE TABLE `shop_node`  (
  `id` int(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `parent_node_id` int(0) NOT NULL DEFAULT 0 COMMENT '父节点id',
  `parent_node` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '父节点',
  `node_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '节点标题',
  `node_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '节点名称',
  `routes` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '节点绑定路由 支持多个以英文逗号分隔',
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '节点描述',
  `is_menu` tinyint(0) NOT NULL DEFAULT 0 COMMENT '是否可设置为菜单',
  `is_auth` tinyint(0) NOT NULL DEFAULT 1 COMMENT '是启启动RBAC权限控制',
  `status` tinyint(0) NOT NULL DEFAULT 1 COMMENT '状态 1开启 0关闭',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 274 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for shop_payment
-- ----------------------------
DROP TABLE IF EXISTS `shop_payment`;
CREATE TABLE `shop_payment`  (
  `pay_id` int(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `shop_id` int(0) UNSIGNED NOT NULL COMMENT '店铺id',
  `apply_time` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '申请时间',
  `pay_time` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '付款时间',
  `pay_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '付款方式',
  `pay_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '付款方式',
  `begin_time` timestamp(0) NULL DEFAULT NULL COMMENT '店铺起始时间',
  `end_time` timestamp(0) NULL DEFAULT NULL COMMENT '店铺到期时间',
  `duration` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '开店时长',
  `unit` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '开店时长单位',
  `system_fee` decimal(10, 2) NOT NULL COMMENT '平台使用费',
  `insure_fee` decimal(10, 2) NOT NULL COMMENT '平台保证金',
  `is_frozen` tinyint(1) NOT NULL DEFAULT 0 COMMENT '是否冻结费用 默认0',
  `pay_status` tinyint(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '付款状态 默认0 0未付款 1已付款',
  `is_renew` tinyint(1) NOT NULL DEFAULT 0 COMMENT '是否续费 默认0 0-开店申请付款 1-店铺续费',
  `remark` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL COMMENT '备注',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`pay_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = '店铺付款信息表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for shop_questions
-- ----------------------------
DROP TABLE IF EXISTS `shop_questions`;
CREATE TABLE `shop_questions`  (
  `questions_id` int(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `shop_id` int(0) UNSIGNED NOT NULL COMMENT '店铺id',
  `question` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '问题',
  `answer` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '答案',
  `sort` int(0) UNSIGNED NOT NULL DEFAULT 255 COMMENT '排序',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`questions_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for shop_rank
-- ----------------------------
DROP TABLE IF EXISTS `shop_rank`;
CREATE TABLE `shop_rank`  (
  `rank_id` int(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `shop_id` int(0) UNSIGNED NOT NULL COMMENT '店铺id',
  `rank_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '等级名称',
  `rank_level` int(0) UNSIGNED NOT NULL COMMENT '等级级别',
  `is_special` tinyint(1) NOT NULL DEFAULT 0 COMMENT '是否特殊会员级别 默认0',
  `discount` decimal(10, 2) NOT NULL COMMENT '折扣率',
  `min_amount` decimal(10, 2) NOT NULL COMMENT '累计消费金额',
  `min_times` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '累计成功交易笔数',
  `expired_level` int(0) UNSIGNED NOT NULL COMMENT '过期后调整至会员级别',
  `use_between` tinyint(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '会员等级有效期 默认0 0无期限 1时间段内 2成为会员后多少天内有效',
  `start_time` date NULL DEFAULT NULL COMMENT '会员等级有效期开始时间',
  `end_time` date NULL DEFAULT NULL COMMENT '会员等级有效期结束时间',
  `valid_days` tinyint(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '成为等级会员后多少天内有效',
  `is_enable` tinyint(0) NOT NULL DEFAULT 1 COMMENT '是否启用 默认是',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`rank_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 12 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for shop_role
-- ----------------------------
DROP TABLE IF EXISTS `shop_role`;
CREATE TABLE `shop_role`  (
  `role_id` int(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `shop_id` int(0) UNSIGNED NOT NULL COMMENT '店铺id',
  `role_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '角色名称',
  `auth_codes` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL COMMENT '权限内容',
  `role_type` tinyint(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '角色类型',
  `role_alias` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '角色别名',
  `role_desc` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '角色说明',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`role_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for shop_shipper
-- ----------------------------
DROP TABLE IF EXISTS `shop_shipper`;
CREATE TABLE `shop_shipper`  (
  `id` bigint(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `shop_id` int(0) NOT NULL DEFAULT 0 COMMENT '店铺ID',
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '发货方名称',
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '发货方图标',
  `sort` int(0) UNSIGNED NOT NULL DEFAULT 255 COMMENT '排序',
  `last_time` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '修改时间',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = '商品发货方表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for shop_shipping
-- ----------------------------
DROP TABLE IF EXISTS `shop_shipping`;
CREATE TABLE `shop_shipping`  (
  `id` int(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `shop_id` int(0) UNSIGNED NOT NULL COMMENT '店铺id',
  `shipping_id` int(0) UNSIGNED NOT NULL COMMENT '快递公司id',
  `img_width` int(0) UNSIGNED NULL DEFAULT 0 COMMENT '背景图片宽度',
  `img_height` int(0) UNSIGNED NULL DEFAULT 0 COMMENT '背景图片高度',
  `offset_top` int(0) UNSIGNED NULL DEFAULT 0 COMMENT '上偏移量',
  `offset_left` int(0) UNSIGNED NULL DEFAULT 0 COMMENT '左偏移量',
  `img_path` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '模板图片',
  `is_default` tinyint(1) NOT NULL DEFAULT 0 COMMENT '是否默认 默认0',
  `is_open` tinyint(1) NOT NULL DEFAULT 0 COMMENT '是否启用 默认0',
  `config_lable` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL COMMENT '配置标签',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for sku_member
-- ----------------------------
DROP TABLE IF EXISTS `sku_member`;
CREATE TABLE `sku_member`  (
  `sm_id` int(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `goods_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '商品ID',
  `sku_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT 'SKU ID',
  `shop_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '店铺ID',
  `shop_rank_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '店铺会员等级ID',
  `goods_price` decimal(8, 2) NOT NULL COMMENT '商品价格',
  `member_type` tinyint(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '优惠类型 默认0 0-打折 1-减价 2-指定价格',
  `member_value` decimal(8, 2) NOT NULL COMMENT '优惠金额或折扣',
  `member_data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL COMMENT '会员价数据',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`sm_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for sms_log
-- ----------------------------
DROP TABLE IF EXISTS `sms_log`;
CREATE TABLE `sms_log`  (
  `log_id` int(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `log_phone` char(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '手机号',
  `log_captcha` char(6) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '短信验证码',
  `log_ip` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '请求ip',
  `log_msg` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '短信内容',
  `log_type` tinyint(0) UNSIGNED NOT NULL DEFAULT 1 COMMENT '短信类型:1为注册,2为登录,3为找回密码,默认为1',
  `user_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '会员id',
  `user_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '会员名',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`log_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for spec_alias
-- ----------------------------
DROP TABLE IF EXISTS `spec_alias`;
CREATE TABLE `spec_alias`  (
  `id` int(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `goods_id` int(0) UNSIGNED NOT NULL COMMENT '商品SPU id',
  `attr_id` int(0) UNSIGNED NOT NULL COMMENT '规格id',
  `attr_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '规格别名值',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 48 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for store
-- ----------------------------
DROP TABLE IF EXISTS `store`;
CREATE TABLE `store`  (
  `store_id` int(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `shop_id` int(0) UNSIGNED NOT NULL COMMENT '店铺id',
  `user_type` tinyint(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '用户类型 0会员 1店铺管理员',
  `user_id` int(0) UNSIGNED NOT NULL COMMENT '会员id',
  `user_account` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '会员帐号/手机号/邮箱',
  `store_lng` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '经度',
  `store_lat` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '纬度',
  `region_editable` tinyint(1) NOT NULL DEFAULT 1 COMMENT '是否允许网点修改销售/配送范围',
  `group_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '网点分组id',
  `region_type` tinyint(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '销售/配送范围 默认0 0全国模板 1同城模板',
  `add_time` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '添加时间',
  `is_pickup` tinyint(1) NOT NULL DEFAULT 1 COMMENT '网点是否作为自提点',
  `pickup_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '自提点id',
  `auto_order_taking` tinyint(1) NOT NULL DEFAULT 0 COMMENT '网点是否自动接单 默认0',
  `refuse_order_taking` tinyint(1) NOT NULL DEFAULT 0 COMMENT '网点是否支持拒绝接单 默认0',
  `store_status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '网点状态 默认0',
  `edit_info` tinyint(1) NOT NULL DEFAULT 0 COMMENT '是否允许网点修改基本信息 默认0',
  `store_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '网点名称',
  `region_code` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '网点地址 地区code',
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '详细地址',
  `tel` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '网点电话',
  `take_rate` decimal(10, 2) NOT NULL COMMENT '店铺分佣比例',
  `clearing_cycle` tinyint(0) UNSIGNED NOT NULL COMMENT '结算周期 0一个月 1一周 2一天 3三天',
  `store_img` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '网点主图',
  `store_remark` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '网点备注',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`store_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for store_group
-- ----------------------------
DROP TABLE IF EXISTS `store_group`;
CREATE TABLE `store_group`  (
  `group_id` int(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `shop_id` int(0) UNSIGNED NOT NULL COMMENT '店铺id',
  `group_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '分组名称',
  `group_sort` int(0) UNSIGNED NOT NULL DEFAULT 255 COMMENT '排序',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`group_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for sub_site
-- ----------------------------
DROP TABLE IF EXISTS `sub_site`;
CREATE TABLE `sub_site`  (
  `site_id` bigint(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `site_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '站点名称',
  `site_logo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '站点Logo',
  `region_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '站点地区',
  `clearing_cycle` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '结算周期',
  `site_admin` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '站点管理员',
  `site_manager` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '站点负责人',
  `site_domain` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '站点域名',
  `end_time` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0) ON UPDATE CURRENT_TIMESTAMP(0) COMMENT '到期时间',
  `site_expenses` decimal(8, 2) NOT NULL COMMENT '站点费用',
  `take_rate` decimal(8, 2) NOT NULL COMMENT '佣金比例',
  `site_qq` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT 'QQ客服',
  `site_phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '电话号码',
  `site_email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '站点邮箱',
  `site_wangwang` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '旺旺客服',
  `site_status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '是否启用站点',
  `is_default` tinyint(1) NOT NULL DEFAULT 0 COMMENT '是否默认站点',
  `close_reason` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '关闭原因',
  `site_sort` int(0) UNSIGNED NOT NULL DEFAULT 255 COMMENT '站点排序',
  `add_time` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '创建时间',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`site_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = '站点表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for system_config
-- ----------------------------
DROP TABLE IF EXISTS `system_config`;
CREATE TABLE `system_config`  (
  `id` int(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `code` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '配置code',
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '配置标题',
  `unit` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '配置单位 如：元',
  `group` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '配置分组',
  `type` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '表单类型',
  `required` tinyint(0) NOT NULL DEFAULT 0 COMMENT '字段是否必须 0非必须 1必须',
  `anchor` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '页面导航',
  `value` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL COMMENT '配置值',
  `options` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL COMMENT '配置项',
  `labels` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL COMMENT '配置项的label',
  `tips` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL COMMENT '配置提示',
  `sort` int(0) NOT NULL DEFAULT 255 COMMENT '排序',
  `status` tinyint(0) NOT NULL DEFAULT 1 COMMENT '状态',
  `storage_dir` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL COMMENT '图片存储路径',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 510 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for template
-- ----------------------------
DROP TABLE IF EXISTS `template`;
CREATE TABLE `template`  (
  `id` int(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `tpl_client` int(0) NOT NULL,
  `tpl_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '模板名称',
  `code` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '模板code',
  `type` int(0) NOT NULL COMMENT '模板类型',
  `sort` int(0) NOT NULL DEFAULT 255 COMMENT '排序',
  `remarks` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '备注',
  `icon` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '图标',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 83 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for template_cat
-- ----------------------------
DROP TABLE IF EXISTS `template_cat`;
CREATE TABLE `template_cat`  (
  `id` int(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `tpl_code` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '模板code',
  `selector_type` int(0) NOT NULL COMMENT '模板选择器id',
  `cat_id` int(0) NOT NULL DEFAULT 1 COMMENT '模板分类id',
  `number` int(0) NOT NULL COMMENT 'item数量',
  `width` int(0) NOT NULL COMMENT '图片宽度',
  `height` int(0) NOT NULL COMMENT '图片高度',
  `explain_msg` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL COMMENT '温馨提示信息',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 30 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for template_item
-- ----------------------------
DROP TABLE IF EXISTS `template_item`;
CREATE TABLE `template_item`  (
  `id` int(0) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '模板id',
  `uid` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '唯一id',
  `code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '模板code',
  `data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `ext_info` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `file` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `is_valid` char(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `page` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '备注',
  `shop_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `site_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `topic_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '专题id',
  `sort` int(0) NOT NULL COMMENT '排序',
  `tpl_id` int(0) NULL DEFAULT NULL,
  `tpl_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `uid`(`uid`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 454 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for template_page
-- ----------------------------
DROP TABLE IF EXISTS `template_page`;
CREATE TABLE `template_page`  (
  `id` int(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `code` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '模板code',
  `page` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '模板页面类型 site topic news',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 21 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for template_selector
-- ----------------------------
DROP TABLE IF EXISTS `template_selector`;
CREATE TABLE `template_selector`  (
  `id` int(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `selector_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '模板选择器名称',
  `code` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '模板选择器code',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 99 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for topic
-- ----------------------------
DROP TABLE IF EXISTS `topic`;
CREATE TABLE `topic`  (
  `topic_id` int(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `topic_name` char(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '活动名称',
  `keywords` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '关键字',
  `header_style` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '去除头部（PC端）',
  `bottom_style` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '去除底部（PC端）',
  `describe` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '描述',
  `is_delete` tinyint(1) NOT NULL DEFAULT 0 COMMENT '是否删除',
  `site_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '站点id',
  `shop_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '店铺id',
  `bg_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '背景图片',
  `bg_color` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '背景颜色',
  `m_bg_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '手机端背景图片',
  `m_bg_color` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '手机端背景颜色',
  `share_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '分享推广图',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`topic_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 15 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for tpl_backup
-- ----------------------------
DROP TABLE IF EXISTS `tpl_backup`;
CREATE TABLE `tpl_backup`  (
  `back_id` int(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` char(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '备份名称',
  `add_time` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '添加时间',
  `is_sys` tinyint(1) NOT NULL DEFAULT 0 COMMENT '是否为系统预置模板',
  `shop_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '店铺id',
  `site_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '站点id',
  `page` char(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '站点页面',
  `remark` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '备注信息',
  `type` tinyint(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '0-模板及数据 1-仅备份模板',
  `topic_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '专题id',
  `img` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '主题封面',
  `is_theme` tinyint(1) NOT NULL DEFAULT 0 COMMENT '是否设为主题',
  `ext_info` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL COMMENT '扩展信息',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`back_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for trade_snapshot
-- ----------------------------
DROP TABLE IF EXISTS `trade_snapshot`;
CREATE TABLE `trade_snapshot`  (
  `trade_id` int(0) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `order_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '订单ID',
  `order_sn` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '订单号',
  `user_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '会员id',
  `goods_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '商品id',
  `goods_name` varchar(120) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '商品名称',
  `goods_sn` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '商品货号',
  `shop_price` decimal(10, 2) UNSIGNED NOT NULL COMMENT '商城价格',
  `goods_number` int(0) UNSIGNED NOT NULL DEFAULT 1 COMMENT '商品数量',
  `shipping_fee` decimal(10, 2) UNSIGNED NOT NULL COMMENT '运费',
  `rz_shopName` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '商家名称',
  `goods_weight` decimal(10, 3) UNSIGNED NOT NULL COMMENT '商品重量',
  `add_time` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '添加时间',
  `goods_attr` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '商品属性',
  `goods_attr_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '商品属性id',
  `ru_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '商家id',
  `goods_desc` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL COMMENT '商品描述',
  `goods_img` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '商品图片',
  `snapshot_time` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '快照新增时间',
  PRIMARY KEY (`trade_id`) USING BTREE,
  INDEX `order_id`(`order_id`) USING BTREE,
  INDEX `order_sn`(`order_sn`) USING BTREE,
  INDEX `user_id`(`user_id`) USING BTREE,
  INDEX `goods_id`(`goods_id`) USING BTREE,
  INDEX `ru_id`(`ru_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = '交易快照' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user`  (
  `user_id` int(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `role_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '角色id 默认0',
  `user_name` char(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '用户名',
  `nickname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '昵称',
  `rank_id` tinyint(0) UNSIGNED NOT NULL COMMENT '等级id',
  `rank_point` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '成长值',
  `use_between` tinyint(1) NOT NULL DEFAULT 0 COMMENT '享受时长 是否有限 0无限期 1有限',
  `rank_start_time` date NULL DEFAULT NULL COMMENT '开始时间',
  `rank_end_time` date NULL DEFAULT NULL COMMENT '结束时间',
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '密码',
  `sex` tinyint(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '性别默认0 0保密 1男 2女',
  `birthday` date NULL DEFAULT NULL COMMENT '出生日期',
  `headimg` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL COMMENT '会员头像',
  `faceimg1` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL COMMENT 'faceimg1',
  `faceimg2` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL COMMENT 'faceimg2',
  `address_now` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '地址代码',
  `detail_address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '详细地址',
  `mobile` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '手机号',
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '邮箱',
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '是否允许登录 默认0 0否 1是',
  `shopping_status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '是否允许购物 默认0 0否 1是',
  `comment_status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '是否允许评论 默认0 0否 1是',
  `user_money` decimal(10, 2) NOT NULL COMMENT '可提现余额',
  `user_money_limit` decimal(10, 2) NOT NULL COMMENT '不可提现余额',
  `frozen_money` decimal(10, 2) NOT NULL COMMENT '冻结资金',
  `last_login` timestamp(0) NULL DEFAULT NULL COMMENT '上次登录时间',
  `last_ip` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '最近登录IP',
  `reg_ip` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '注册IP地址',
  `visit_count` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '登录次数',
  `is_real` tinyint(1) NOT NULL DEFAULT 0 COMMENT '是否实名认证默认0 0否 1是',
  `reg_time` timestamp(0) NULL DEFAULT NULL COMMENT '注册时间',
  `mobile_validated` tinyint(1) NOT NULL DEFAULT 0 COMMENT '是否已验证手机默认0 0否 1是',
  `email_validated` tinyint(1) NOT NULL DEFAULT 0 COMMENT '是否已验证邮箱默认0 0否 1是',
  `type` tinyint(0) NOT NULL DEFAULT 0 COMMENT '用户类型',
  `surplus_password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '余额支付密码',
  `pay_point` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0|0' COMMENT '消费积分 平台积分|店铺积分',
  `frozen_point` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '冻结积分',
  `password_reset_token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '重置密码令牌',
  `auth_key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '授权码',
  `user_remark` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '会员备注',
  `salt` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '混淆码',
  `shop_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '店铺id 默认0',
  `store_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '网点id 默认0',
  `multi_store_id` int(0) NOT NULL DEFAULT 0 COMMENT '多网点id 默认0',
  `is_seller` tinyint(0) NOT NULL DEFAULT 0 COMMENT '个人/店主默认0 0个人 1店主 2网点管理员',
  `reg_from` tinyint(0) NOT NULL DEFAULT 0 COMMENT '注册来源 0其他 1PC端 2WAP端 3微信端 4APP端 5后台添加',
  `address_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '默认收货地址id 默认0 0无默认收货地址',
  `mobile_supplier` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '手机号运营商 如：中国移动',
  `mobile_province` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '手机号运营商省份 如：云南',
  `mobile_city` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '手机号运营商城市 如：昆明',
  `auth_codes` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL COMMENT '商家中心权限内容',
  `qq_key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT 'qq_key',
  `weibo_key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT 'weibo_key',
  `weixin_key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT 'weixin_key',
  `github_key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT 'github_key',
  `qq_info` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL COMMENT 'QQ信息',
  `weibo_info` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL COMMENT '微博信息',
  `weixin_info` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL COMMENT '微信信息',
  `invite_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '邀请码',
  `parent_id` int(0) NOT NULL DEFAULT 0 COMMENT '推荐人ID',
  `is_recommend` int(0) NOT NULL DEFAULT 0 COMMENT '是否被推荐 1 被推荐用户 0 不是被推荐用户',
  `customs_money` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT 'customs_money',
  `security_level` tinyint(0) NOT NULL DEFAULT 0 COMMENT '安全级别',
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `summary` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '个人简介',
  `live_verified` tinyint(3) unsigned DEFAULT '0' COMMENT '主播认证状态 0-未认证 1-已认证 2-认证中 3-已拒绝',
  `live_verified_remark` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '主播认证备注',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`user_id`) USING BTREE,
  UNIQUE INDEX `user_user_name_unique`(`user_name`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 16 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for user_account
-- ----------------------------
DROP TABLE IF EXISTS `user_account`;
CREATE TABLE `user_account`  (
  `id` int(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `account_sn` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '流水号',
  `user_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '会员id',
  `admin_user` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '店主id',
  `amount` decimal(10, 2) NOT NULL COMMENT '账户变动金额',
  `cur_balance` decimal(10, 2) NOT NULL COMMENT '当前账户余额',
  `add_time` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '账户变动时间',
  `last_time` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '账户最后变动时间',
  `note` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL COMMENT '名称/备注',
  `process_type` tinyint(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '账户变动类型',
  `payment_code` tinyint(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '支付方式id',
  `payment_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '支付方式名称',
  `trade_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '交易类型',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = '用户账户明细表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for user_address
-- ----------------------------
DROP TABLE IF EXISTS `user_address`;
CREATE TABLE `user_address`  (
  `address_id` int(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `address_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '地址别名',
  `user_id` int(0) UNSIGNED NOT NULL COMMENT '会员id',
  `consignee` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '收货人',
  `region_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '收货地址',
  `address_lng` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '地址经度',
  `address_lat` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '地址纬度',
  `address_detail` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '详细地址',
  `mobile` char(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '手机号码',
  `tel` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '固定电话',
  `email` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '邮件地址',
  `zipcode` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '邮编',
  `address_house` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '门牌号',
  `address_label` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '标签',
  `is_default` tinyint(1) NOT NULL DEFAULT 0 COMMENT '是否默认收货地址',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`address_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 18 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = '用户收货地址表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for user_bonus
-- ----------------------------
DROP TABLE IF EXISTS `user_bonus`;
CREATE TABLE `user_bonus`  (
  `user_bonus_id` int(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '会员id',
  `bonus_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '红包id',
  `bonus_sn` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '红包sn',
  `bonus_price` decimal(10, 2) NOT NULL COMMENT '红包金额',
  `bonus_data` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL COMMENT '红包扩展数据 序列化存储',
  `receive_time` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '红包领取时间',
  `used_time` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '红包使用时间',
  `start_time` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '红包发放起始时间',
  `end_time` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '红包发放截至时间',
  `add_time` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '红包添加时间',
  `order_sn` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '订单sn',
  `bonus_status` tinyint(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '红包状态 默认0 0-正常 1-已使用 2-已失效',
  `is_delete` tinyint(1) NOT NULL DEFAULT 0 COMMENT '是否删除 0-未删除 1-已删除',
  `sales_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT 'sales id',
  `user_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '会员名',
  `shop_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '店铺id',
  `bonus_type` tinyint(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '红包类型 默认0 1-主动领红包/到店送红包 2-收藏送红包 4-会员送红包 6-注册送红包 9-推荐送红包 10-积分兑换红包',
  `use_range` tinyint(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '使用范围 默认0 0-全部商品 1-指定商品',
  `bonus_datas` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL COMMENT '红包扩展数据 序列化存储',
  `min_goods_amount` decimal(10, 2) NOT NULL COMMENT '最小订单金额限制',
  `is_original_price` tinyint(1) NOT NULL DEFAULT 1 COMMENT '仅限原价购买时使用 0-可与其他优惠、活动一起使用 1-仅限原价购买时使用',
  `order_id` int(0) UNSIGNED NULL DEFAULT NULL COMMENT '订单id',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`user_bonus_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 20 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = '会员红包表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for user_capital
-- ----------------------------
DROP TABLE IF EXISTS `user_capital`;
CREATE TABLE `user_capital`  (
  `id` int(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `recharge_sn` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'recharge sn',
  `user_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '会员id',
  `amount` decimal(10, 2) NOT NULL COMMENT '提现金额',
  `admin_user` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '操作人',
  `admin_note` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '管理员留言',
  `update_time` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '更新时间',
  `user_note` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '给网站留言',
  `account_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '提现账户id',
  `add_time` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '添加时间',
  `status` tinyint(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '提现申请状态',
  `process_type` tinyint(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '提现类型',
  `payment_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '提现支付方式 code',
  `payment_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '提现支付方式名称',
  `pay_time` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '支付时间',
  `trade_no` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '交易号',
  `note` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '名称/备注',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = '会员资金表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for user_comment
-- ----------------------------
DROP TABLE IF EXISTS `user_comment`;
CREATE TABLE `user_comment` (
    `comment_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `user_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '用户ID',
    `pid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '父ID',
    `type` tinyint unsigned NOT NULL DEFAULT '0' COMMENT '类型 1-文章评论',
    `target_id` int unsigned NOT NULL DEFAULT '0' COMMENT '目标ID',
    `content` text COLLATE utf8mb4_unicode_ci COMMENT '评论内容',
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL,
    `deleted_at` timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`comment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='用户评论表';

-- ----------------------------
-- Table structure for user_follow
-- ----------------------------
DROP TABLE IF EXISTS `user_follow`;
CREATE TABLE `user_follow` (
   `follow_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
   `user_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '用户ID',
   `type` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '类型 1-关注用户',
   `target_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '目标ID',
   `created_at` timestamp NULL DEFAULT NULL,
   `updated_at` timestamp NULL DEFAULT NULL,
   `deleted_at` timestamp NULL DEFAULT NULL,
   PRIMARY KEY (`follow_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='用户关注粉丝表';

-- ----------------------------
-- Table structure for user_praise
-- ----------------------------
DROP TABLE IF EXISTS `user_praise`;
CREATE TABLE `user_praise` (
   `praise_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
   `user_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '用户ID',
   `type` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '类型 1-文章点赞',
   `target_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '目标ID',
   `created_at` timestamp NULL DEFAULT NULL,
   `updated_at` timestamp NULL DEFAULT NULL,
   `deleted_at` timestamp NULL DEFAULT NULL,
   PRIMARY KEY (`praise_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='用户点赞表';

-- ----------------------------
-- Table structure for user_collect
-- ----------------------------
DROP TABLE IF EXISTS `user_collect`;
CREATE TABLE `user_collect` (
    `collect_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `user_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '用户ID',
    `type` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '类型 1-收藏文章',
    `target_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '目标ID',
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL,
    `deleted_at` timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`collect_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='用户收藏表';

-- ----------------------------
-- Table structure for user_log
-- ----------------------------
DROP TABLE IF EXISTS `user_log`;
CREATE TABLE `user_log`  (
  `log_id` int(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '会员id',
  `admin_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '当前登录管理员id',
  `change_time` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '变更时间',
  `change_type` tinyint(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '操作类型',
  `ip_address` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT 'IP地址',
  `change_city` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '参考地点',
  `logon_service` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pc' COMMENT '登录业务 如：pc',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`log_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 296 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = '用户操作日志表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for user_message
-- ----------------------------
DROP TABLE IF EXISTS `user_message`;
CREATE TABLE `user_message`  (
  `rec_id` int(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `msg_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '消息id 消息表主键id',
  `status` tinyint(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '消息状态 默认0 0-未读 1-已读',
  `read_time` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '消息读取时间 默认0 0-未读',
  `receiver` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '消息接收者会员id',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`rec_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = '用户消息表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for user_points_log
-- ----------------------------
DROP TABLE IF EXISTS `user_points_log`;
CREATE TABLE `user_points_log`  (
  `log_id` int(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '会员id',
  `current_points` int(0) NOT NULL DEFAULT 0 COMMENT '当前可用积分',
  `changed_points` int(0) NOT NULL DEFAULT 0 COMMENT '变更积分',
  `reason` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL COMMENT '原因',
  `add_time` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '添加时间',
  `note` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL COMMENT '描述',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`log_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = '会员积分明细表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for user_push
-- ----------------------------
DROP TABLE IF EXISTS `user_push`;
CREATE TABLE `user_push`  (
  `id` bigint(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '用户id',
  `cid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '客户端id',
  `client` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '客户端类型 android ios等',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for user_rank
-- ----------------------------
DROP TABLE IF EXISTS `user_rank`;
CREATE TABLE `user_rank`  (
  `rank_id` int(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `rank_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '等级名称',
  `rank_img` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '等级图标',
  `is_special` tinyint(1) NOT NULL DEFAULT 0 COMMENT '是否特殊等级 默认否',
  `point_type` tinyint(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '成长值范围类型 默认0 0介于 1大于',
  `min_points` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '成长值下限',
  `max_points` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '成长值上限',
  `type` tinyint(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '等级类型',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`rank_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for user_rank_log
-- ----------------------------
DROP TABLE IF EXISTS `user_rank_log`;
CREATE TABLE `user_rank_log`  (
  `id` bigint(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '会员id',
  `growth_value` int(0) NOT NULL DEFAULT 0 COMMENT '成长值',
  `target_type` tinyint(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '类型 1-订单 2-退单',
  `target_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '订单id或退款id',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = '会员成长值记录表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for user_real
-- ----------------------------
DROP TABLE IF EXISTS `user_real`;
CREATE TABLE `user_real`  (
  `real_id` int(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(0) UNSIGNED NOT NULL COMMENT '会员id',
  `real_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '真实姓名',
  `id_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '身份证号',
  `card_pic1` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '身份证正面',
  `card_pic2` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '身份证反面',
  `card_pic3` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '手持身份证',
  `address_now` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '现居住地址',
  `reason` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '审核原因',
  `status` tinyint(0) NOT NULL DEFAULT 0 COMMENT '是否通过实名认证 0未认证 1已认证',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`real_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 16 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for user_shop_rank
-- ----------------------------
DROP TABLE IF EXISTS `user_shop_rank`;
CREATE TABLE `user_shop_rank`  (
  `rank_id` int(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `rank_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '等级名称',
  `rank_level` int(0) UNSIGNED NOT NULL COMMENT '等级级别 值范围1-10',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`rank_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for video
-- ----------------------------
DROP TABLE IF EXISTS `video`;
CREATE TABLE `video`  (
  `video_id` int(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `dir_id` int(0) UNSIGNED NOT NULL COMMENT '相册id',
  `dirname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '目录名称',
  `extension` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '视频扩展名 如:jpg',
  `file_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '视频文件名 不带扩展名后缀',
  `path` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '视频路径',
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '视频原文件名 不带扩展名后缀',
  `size` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '视频大小',
  `width` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '视频宽度',
  `height` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '视频高度',
  `sort` smallint(0) UNSIGNED NOT NULL DEFAULT 255 COMMENT '排序',
  `is_delete` tinyint(1) NOT NULL DEFAULT 0 COMMENT '是否删除',
  `add_time` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '添加时间',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`video_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for video_dir
-- ----------------------------
DROP TABLE IF EXISTS `video_dir`;
CREATE TABLE `video_dir`  (
  `dir_id` int(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `shop_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '店铺id',
  `site_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '站点id',
  `dir_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '目录名称',
  `dir_group` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '视频分组 shop店铺视频 site站点视频 backend平台方视频',
  `dir_cover` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '视频相册封面图',
  `dir_desc` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '描述',
  `dir_sort` smallint(0) UNSIGNED NOT NULL DEFAULT 255 COMMENT '排序',
  `is_default` tinyint(1) NOT NULL DEFAULT 0 COMMENT '是否默认视频文件夹',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`dir_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 30 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for weixin_keyword
-- ----------------------------
DROP TABLE IF EXISTS `weixin_keyword`;
CREATE TABLE `weixin_keyword`  (
  `id` bigint(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `key_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '关键词名称',
  `key_type` tinyint(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '关键词类型 0-自定义文字 1-自定义图文',
  `key_content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL COMMENT '关键词回复内容',
  `key_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '自定义图文标题',
  `key_img` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '自定义图文图片',
  `key_link` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '自定义图文链接',
  `key_desc` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL COMMENT '自定义图文描述',
  `shop_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '店铺id',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = '微信关键词回复表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for weixin_material
-- ----------------------------
DROP TABLE IF EXISTS `weixin_material`;
CREATE TABLE `weixin_material`  (
  `id` bigint(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `site_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '站点id',
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '素材标题',
  `author` char(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '作者',
  `local_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '永久素材显示url',
  `cover` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '图文封面',
  `abstract` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL COMMENT '摘要内容',
  `link` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '转向链接',
  `content` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL COMMENT '图文内容',
  `read_num` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '阅读数量',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 20 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = '微信图文素材表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for weixin_material_group
-- ----------------------------
DROP TABLE IF EXISTS `weixin_material_group`;
CREATE TABLE `weixin_material_group`  (
  `id` bigint(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `site_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '站点id',
  `media_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '永久素材MediaID',
  `local_url` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '永久素材外网URL',
  `article_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '关联图文ID(用英文逗号做分割)',
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0 COMMENT '删除状态(0未删除,1已删除)',
  `type` tinyint(1) NOT NULL DEFAULT 0 COMMENT '图文类型 0-单图文 1-多图文',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 12 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = '微信图文表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for weixin_menu
-- ----------------------------
DROP TABLE IF EXISTS `weixin_menu`;
CREATE TABLE `weixin_menu`  (
  `id` bigint(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `menu_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '菜单名称',
  `parent_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '父id',
  `menu_type` tinyint(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '菜单类型 0-命令 1-链接 2-自定义图文 3-关联小程序',
  `menu_command` char(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '菜单命令 info-个人信息 wdzh-我的账户 ddcx-订单查询 kefu-微信客服',
  `menu_value` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '链接值',
  `is_auto_login` tinyint(1) NOT NULL DEFAULT 0 COMMENT '是否自动登录',
  `auto_login_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '自动登录url',
  `menu_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '菜单标题',
  `menu_img` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '菜单图片',
  `menu_link` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '菜单链接地址或小程序备用页面链接',
  `menu_desc` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL COMMENT '菜单描述',
  `menu_level` tinyint(0) UNSIGNED NOT NULL DEFAULT 1 COMMENT '菜单级别 默认1',
  `shop_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '店铺id',
  `menu_sort` int(0) UNSIGNED NOT NULL DEFAULT 255 COMMENT '排序',
  `appid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '小程序appid',
  `pagepath` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '小程序页面路径',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = '微信自定义菜单表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for weixin_user
-- ----------------------------
DROP TABLE IF EXISTS `weixin_user`;
CREATE TABLE `weixin_user`  (
  `id` bigint(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `site_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '站点id',
  `shop_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '店铺id',
  `appid` char(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '公众号APPID',
  `unionid` char(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '粉丝unionid',
  `openid` char(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '粉丝openid',
  `tagid_list` char(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '粉丝标签id',
  `is_black` tinyint(1) NOT NULL DEFAULT 0 COMMENT '是否为黑名单状态',
  `subscribe` tinyint(1) NOT NULL DEFAULT 0 COMMENT '关注状态(0未关注,1已关注)',
  `nickname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '用户昵称',
  `sex` tinyint(1) NOT NULL DEFAULT 0 COMMENT '用户性别(1男性,2女性,0未知)',
  `country` char(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '用户所在国家',
  `province` char(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '用户所在省份',
  `city` char(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '用户所在城市',
  `language` char(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '用户的语言(zh_CN)',
  `headimgurl` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '用户头像',
  `subscribe_time` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '关注时间',
  `remark` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '备注',
  `subscribe_scene` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '扫码关注场景',
  `qr_scene` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '二维码场景值',
  `qr_scene_str` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '二维码场景内容',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `weixin_user_openid_index`(`openid`) USING BTREE,
  INDEX `weixin_user_unionid_index`(`unionid`) USING BTREE,
  INDEX `weixin_user_is_black_index`(`is_black`) USING BTREE,
  INDEX `weixin_user_subscribe_index`(`subscribe`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = '微信粉丝用户表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for yly_printer
-- ----------------------------
DROP TABLE IF EXISTS `yly_printer`;
CREATE TABLE `yly_printer`  (
  `id` int(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `shop_id` int(0) UNSIGNED NOT NULL COMMENT '店铺id',
  `machine_code` varchar(16) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '打印机终端号',
  `msign` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '打印机密钥',
  `print_name` varchar(16) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '打印机名称',
  `phone` varchar(16) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '手机号',
  `is_default` tinyint(1) NOT NULL COMMENT '是否默认',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = '易联云打印机表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for yun_collect_stage
-- ----------------------------
DROP TABLE IF EXISTS `yun_collect_stage`;
CREATE TABLE `yun_collect_stage`  (
  `ycs_id` bigint(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `site_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '站点ID',
  `shop_id` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '店铺ID',
  `third_goods_id` int(0) UNSIGNED NOT NULL COMMENT '第三方商品ID编号',
  `goods_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '第三方商品名称',
  `goods_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '商品封面图',
  `goods_price` decimal(8, 2) NOT NULL COMMENT '商品价格',
  `comment_num` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '评论数量',
  `link_url` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL COMMENT '第三方商品链接',
  `collect_status` tinyint(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '采集状态 默认0 0-待采集 1-待导入 2-已导入',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`ycs_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = '云采集商品暂存表' ROW_FORMAT = Dynamic;

SET FOREIGN_KEY_CHECKS = 1;
