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
// | Date:2018-11-17
// | Description:
// +----------------------------------------------------------------------

namespace App\Models;

/**
 * 商品评价模型
 *
 * Class GoodsComment
 * @package App\Models
 */
class GoodsComment extends BaseModel
{
    protected $table = 'goods_comment';

    protected $fillable = [
        'record_id','user_id','user_nick','user_rank_id','site_id','shop_id','order_id','goods_id','sku_id',
        'desc_mark','comment_desc','comment_img1','comment_img2','comment_img3','comment_img4','comment_img5','is_anonymous',
        'comment_time','comment_status','is_show','add_comment_desc','add_img1','add_img2','add_img3','add_img4','add_img5',
        'add_is_anonymous','add_time','add_status','add_is_show','seller_reply_desc','seller_reply_time','user_reply_desc',
        'user_reply_time','is_delete','evaluate_status',

        /*以下字段可不用存储*/
//        'back_id','back_number','goods_number','goods_name','goods_image',
//        'spec_info','order_add_time','confirm_time','order_status','user_comment_status',
//        'comment_images' 包括初次评价和追加评价的图片 不用存储
    ];

    protected $primaryKey = 'comment_id';

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

    /**
     * 关联订单商品表
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function orderGoods()
    {
        return $this->belongsTo(OrderGoods::class,'record_id','record_id');
    }
}
