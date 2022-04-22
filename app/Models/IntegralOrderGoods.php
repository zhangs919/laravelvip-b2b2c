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
 * 积分兑换订单商品表
 *
 * Class IntegralOrderGoods
 * @package App\Models
 */
class IntegralOrderGoods extends BaseModel
{
    protected $table = 'integral_order_goods';

    protected $fillable = [
        'order_id','goods_id','goods_name','goods_image','goods_price','goods_points','goods_number',
        'stock_dropped','goods_contracts','is_delete','order_status','goods_integral','goods_stock'
    ];

    protected $primaryKey = 'record_id';
}
