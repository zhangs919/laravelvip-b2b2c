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
// | Date:2019-5-13
// | Description:
// +----------------------------------------------------------------------

namespace App\Models;

/**
 * 店铺进出账明细模型
 *
 * Class SellerAccount
 * @package App\Models
 */
class SellerAccount extends BaseModel
{
    protected $table = 'seller_account';

    protected $fillable = [
        'account_sn',
        'user_id', // 订单买家id
        'admin_id', // 店主id
        'amount','add_time',
        'note','account_type','status','order_sn','back_sn'
    ];

    protected $primaryKey = 'log_id';

    // 账户分类
    const ACCOUNT_TYPE_TRADE_ORDER = 11; // 交易订单
    const ACCOUNT_TYPE_REFUND_ORDER = 12; // 退款订单
    const ACCOUNT_TYPE_CANCEL_ORDER = 13; // 取消订单
    const ACCOUNT_TYPE_SMS_BUY = 14; // 短信购买
    const ACCOUNT_TYPE_SM_CASHIER = 15; // 神码收银
    const ACCOUNT_TYPE_REFUND_SHIPPING = 16; // 退还运费
    const ACCOUNT_TYPE_REFUND_DELIVERY_PACKING_FEE = 17; // 退还配送费和包装费
    const ACCOUNT_TYPE_SHOP_CARD = 18; // 售卖店铺购物卡
}
