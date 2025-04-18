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
// | Date:2020-01-13
// | Description:店铺动态评价
// +----------------------------------------------------------------------

namespace App\Models;

/**
 * 店铺动态评价模型
 *
 * Class ShopComment
 * @package App\Models
 */
class ShopComment extends BaseModel
{
    protected $table = 'shop_comment';

    protected $fillable = [
        'user_id','shop_id','order_id',
        'shop_service','shop_speed','logistics_speed','shop_comment_add_time',
        'shop_comment_status','shop_is_delete','shop_is_show'
    ];

    protected $primaryKey = 'shop_comment_id';

    /**
     * 关联商家表
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function shop()
    {
        return $this->belongsTo(Shop::class,'shop_id','shop_id');
    }

    /**
     * 关联会员表
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class,'user_id','user_id');
    }

    /**
     * 关联订单表
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function orderInfo()
    {
        return $this->belongsTo(OrderInfo::class,'order_id','order_id');
    }

}
