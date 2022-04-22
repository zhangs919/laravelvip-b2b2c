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
// | Date:2018-10-23
// | Description:
// +----------------------------------------------------------------------

namespace App\Models;

/**
 * 商品标签模型
 *
 * Class GoodsTag
 * @package App\Models
 */
class GoodsTag extends BaseModel
{
    protected $table = 'goods_tag';

    protected $fillable = [
        'shop_id','tag_name','tag_image','tag_shape','tag_position','sort','add_time'
    ];

    protected $primaryKey = 'tag_id';

    /**
     * 一对多关联 商品
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function goods()
    {
        return $this->hasMany(Goods::class, 'tag_id', 'tag_id');
    }

    /**
     * 获取商品标签图片路径
     * @return string
     */
    public function getTagImageAttribute()
    {
        return str_contains($this->attributes['tag_image'], 'superscript') ? '/assets/d2eace91'.$this->attributes['tag_image'] : get_image_url($this->attributes['tag_image']);
    }


}
