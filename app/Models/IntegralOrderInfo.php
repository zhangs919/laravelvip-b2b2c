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
// | Date:2018-11-23
// | Description:
// +----------------------------------------------------------------------

namespace App\Models;

/**
 * 积分兑换订单表
 *
 * Class IntegralOrderInfo
 * @package App\Models
 */
class IntegralOrderInfo extends BaseModel
{
    protected $table = 'integral_order_info';

    protected $fillable = [
        'order_sn','user_id','order_status','site_id','shop_id','pickup_id','shipping_status','pay_status','consignee',
        'region_code','region_name','address','address_lng','address_lat','receiving_mode','tel','email','postscript','best_time',
        'shipping_fee','order_from','add_time','shipping_time','confirm_time','delay_days','order_type','service_mark','send_mark',
        'shipping_mark','buyer_type','end_time','is_show','is_delete','close_reason','order_cancel','refuse_reason','order_points',
        'remark','last_time','shipping_id','express_sn','buy_type','user_name',


//        'shop_name','shop_type','customer_tool','customer_account',

        // 以下字段接口返回 不用存表
//        'order_status_format','order_from_format','goods_list'
    ];

    protected $primaryKey = 'order_id';

    /**
     * 一对多关联 订单商品表
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function integralOrderGoods()
    {
        return $this->hasMany(IntegralOrderGoods::class, 'order_id', 'order_id');
    }

    public function shop()
    {
        return $this->belongsTo(Shop::class, 'shop_id','shop_id');
    }
}
