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
// | Date:2018-12-26
// | Description:
// +----------------------------------------------------------------------

namespace App\Models;

/**
 * 商品活动关联表 一对一
 *
 * Class GoodsActivity
 * @package App\Models
 */
class GoodsActivity extends BaseModel
{
    //
    protected $table = 'goods_activity';

    protected $fillable = [
        'act_id','shop_id','act_type','sku_id','goods_id','cat_id','sale_base','act_price','act_stock','ext_info','click_count','sort'
    ];

    protected $primaryKey = 'id';


    /**
     * 设置活动商品扩展数据 json_encode
     *
     * @param $value
     */
    public function setExtInfoAttribute($value)
    {
        $this->attributes['ext_info'] = json_encode($value);
    }

    /**
     * 获取活动商品扩展数据 json_decode
     *
     * @return mixed
     */
    public function getExtInfoAttribute()
    {
        return json_decode($this->attributes['ext_info'],true);
    }

    public function goods()
    {
        return $this->belongsTo(Goods::class,'goods_id','goods_id');
    }

    public function goodsSku()
    {
        return $this->hasMany(GoodsSku::class, 'goods_id', 'goods_id');
    }
}
