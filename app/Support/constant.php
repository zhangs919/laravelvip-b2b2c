<?php

// +----------------------------------------------------------------------
// | laravelvip 乐融沃B2B2C商城系统
// +----------------------------------------------------------------------
// | Copyright (c) 2017-2027 http://www.laravelvip.com All rights reserved.
// +----------------------------------------------------------------------
// | Notice: This code is not open source, it is strictly prohibited
// |         to distribute the copy, otherwise it will pursue its
// |         legal responsibility.
// +----------------------------------------------------------------------
// | 版权所有 2015-2027 云南乐融沃网络科技有限公司，并保留所有权利。
// | 网站地址: http://www.laravelvip.com
// +----------------------------------------------------------------------
// | 这不是一个自由软件！禁止拷贝本软件副本，否则将追究其法律责任！
// | 如需使用，请移步官网购买正版授权。
// +----------------------------------------------------------------------
// | Author: 雲溪荏苒 <290648237@qq.com>
// | Date:2019-09-26
// | Description: 全局常量定义
// +----------------------------------------------------------------------

// 基本常量定义
define('MD5_KEY', md5('laravelvip')); // md5 加密key

if (!defined('CAL_GREGORIAN')) {
    define('CAL_GREGORIAN', 0); //
}
define('MOBILE_DRP', dirname(__DIR__) . '/Modules/Drp'); //微分销模块



define('OPERATE_SUCCESS', '操作成功！');
define('OPERATE_FAIL', '操作失败！');
define('NO_OPERATE_AUTH', '对不起，您现在还没有获得此操作的权限！');
define('INVALID_PARAM', '无效的参数！');
define('DATA_NOT_EXIST', '数据不存在！');



/**
 * 订单状态
 * 废弃
 */
//define('OS_NEW', 0);//订单已确认
//define('OS_FINISHED', 1);//交易成功(已付款)
//define('OS_SHOP_CANCEL', 2);//卖家取消
//define('OS_BUYER_CANCEL', 3);//买家取消
//define('OS_SYSTEM_CANCEL', 4);//系统自动取消
//define('OS_RUSHING',10);//抢单中

/* 订单取消状态 */
define('OC_UNAPPLY', 0); // 无取消申请
define('OC_WAIT_AUDIT', 1); // 等待商家审核
define('OC_AUDITED', 2); // 商家审核通过
define('OC_REFUSE_AUDIT', 3); // 商家拒绝通过

/* 订单评价状态 */
define('ES_UNEVALUATED', 0); // 未评价
define('ES_EVALUATED', 1); // 已评价
define('ES_EXPIRED', 2); // 已过期未评价

/* 订单状态 */
define('OS_UNCONFIRMED', 0); // 未确认
define('OS_CONFIRMED', 1); // 已确认
define('OS_CANCELED', 2); // 已取消
define('OS_INVALID', 3); // 无效
define('OS_RETURNED', 4); // 退货
define('OS_SPLITED', 5); // 已分单
define('OS_SPLITING_PART', 6); // 部分分单
define('OS_RETURNED_PART', 7); // 部分已退货
define('OS_ONLY_REFOUND', 8); // 仅退款


/* 支付类型 */
define('PAY_ORDER', 0); // 订单支付
define('PAY_SURPLUS', 1); // 会员预付款
define('PAY_APPLYGRADE', 2); // 商家升级付款  by kong grade
define('PAY_TOPUP', 3); // 商家账户充值
define('PAY_APPLYTEMP', 4); // 商家购买模板付款  by kong grade
define('PAY_WHOLESALE', 5); // 批发支付
define('PAY_REGISTERED', 6); // 购买成为分销商
define('PAY_TEAM_ORDER', 7); // 拼团购买
define('PAY_GROUPBUY_ORDER', 8); // 社区团购


/* 配送状态 */
define('SS_UNSHIPPED', 0); // 未发货
define('SS_SHIPPED', 1); // 已发货
define('SS_RECEIVED', 2); // 已收货
define('SS_PREPARING', 3); // 备货中
define('SS_SHIPPED_PART', 4); // 已发货(部分商品)
define('SS_SHIPPED_ING', 5); // 发货中(处理分单)
define('OS_SHIPPED_PART', 6); // 已发货(部分商品)
define('SS_PART_RECEIVED', 7); // 部分已收货
define('SS_TO_BE_SHIPPED', 8); // 待发货

/* 支付状态 */
define('PS_UNPAYED', 0); // 未付款
define('PS_PAYING', 1); // 付款中
define('PS_PAYED', 2); // 已付款
define('PS_PAYED_PART', 3); // 部分付款--预售定金
define('PS_REFOUND', 4); // 已退款
define('PS_REFOUND_PART', 5); // 部分退款
define('PS_MAIN_PAYED_PART', 6); // 部分已付款 //主订单

/* 综合状态 */
define('CS_AWAIT_PAY', 100); // 待付款：货到付款且已发货且未付款，非货到付款且未付款
define('CS_AWAIT_SHIP', 101); // 待发货：货到付款且未发货，非货到付款且已付款且未发货
define('CS_FINISHED', 102); // 已完成：已确认、已付款、已收货
define('CS_TO_CONFIRM', 103); // 待确认收货：已确认、已付款、已发货（待用户确认收货）
define('CS_CONFIRM_TAKE', 104); // 已确认收货：已确认、已付款、已发货 用户已收货
define('CS_ORDER_BACK', 105); // 未处理退换货
define('CS_NEW_ORDER', 106); // 新订单
define('CS_NEW_PAID_ORDER', 107); // 新付款订单
define('CS_WAIT_GOODS', 108); // 已完成：已确认、已付款、已收货

/* 发货单状态 */
define('DELIVERY_CREATE', 0); // 生成发货单
define('DELIVERY_SHIPPED', 1); // 已发货
define('DELIVERY_REFOUND', 2); // 退款

/* 缺货处理 */
define('OOS_WAIT', 0); // 等待货物备齐后再发
define('OOS_CANCEL', 1); // 取消订单
define('OOS_CONSULT', 2); // 与店主协商

/**
 * 支付来源
 */
const PAYMENT_SOURCE = [
    0 => '订单支付',
    1 => '商家入驻缴费支付'
];

/*缓存id START*/
/*todo 考虑将需要缓存的数据封装成一个公共方法 传入缓存id 缓存时间 闭包处理缓存数据 */
// 商城授权信息
const CACHE_KEY_MALL_AUTH = [
    'mall_auth', // 缓存名称
    30*24*60*60 // 缓存时间 单位：秒 缓存30天
];

// 平台方后台菜单
const CACHE_KEY_ADMIN_MENU = [
    'admin_menu', // 缓存名称
    30*60 // 缓存时间 单位：秒
];

// 帮助中心文章
const CACHE_KEY_HELP_CENTER_ARTICLES = [
    'help_center_articles', // 缓存名称
    30*60 // 缓存时间 单位：秒
];

const CACHE_KEY_COPYRIGHT_AUTH = [
    'copyright_auth', // 缓存名称
    30*60 // 缓存时间 单位：秒
];

const CACHE_KEY_FLINK_LIST = [
    'flink_list', // 缓存名称
    30*60 // 缓存时间 单位：秒
];

const CACHE_KEY_NAV_BANNER = [
    'nav_banner', // 缓存名称
    5*60 // 缓存时间 单位：秒
];

const CACHE_KEY_PAGE_TPL_HTML = [
    'page_tpl_html', // 缓存名称
    5*60 // 缓存时间 单位：秒
];

const CACHE_KEY_PAGE_TPL_ITEMS = [
    'page_tpl_items', // 缓存名称
    5*60 // 缓存时间 单位：秒
];

const CACHE_KEY_NAVIGATION = [
    'navigation', // 缓存名称
    30*60 // 缓存时间 单位：秒
];

const CACHE_KEY_NAV_CATEGORY = [
    'nav_category', // 缓存名称
    30*60 // 缓存时间 单位：秒
];

const CACHE_KEY_SHOP_QUESTIONS = [
    'shop_questions', // 缓存名称
    30*60 // 缓存时间 单位：秒
];

const CACHE_KEY_CATEGORY = [
    'category', // 缓存名称
    30*60 // 缓存时间 单位：秒
];

const CACHE_KEY_DEFAULT_SEARCH = [
    'default_search', // 缓存名称
    30*60 // 缓存时间 单位：秒
];

const CACHE_KEY_HOT_SEARCH = [
    'hot_search', // 缓存名称
    30*60 // 缓存时间 单位：秒
];

/*缓存id END*/
