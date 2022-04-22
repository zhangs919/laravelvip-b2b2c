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
// | Date:2019-2-18
// | Description:
// +----------------------------------------------------------------------

namespace App\Models;

/**
 * 红包模型
 *
 * Class Bonus
 * @package App\Models
 */
class Bonus extends BaseModel
{
    protected $table = 'bonus';

    protected $fillable = [
        'shop_id','bonus_type','bonus_name','bonus_desc','bonus_image','send_type',
        'bonus_amount','receive_count','bonus_number','use_range','bonus_data',
        'min_goods_amount','is_original_price','start_time','end_time',
        'is_enable','is_delete','add_time','sort',
        'receive_number','used_number',
        'goods_ids'
    ];

    protected $primaryKey = 'bonus_id';

    public function setStartTimeAttribute($value)
    {
        $this->attributes['start_time'] = is_int($value) ? $value : strtotime($value);
    }

    public function getStartTimeAttribute()
    {
        return date('Y-m-d H:i:s', $this->attributes['start_time']);
    }

    public function setEndTimeAttribute($value)
    {
        $this->attributes['end_time'] = is_int($value) ? $value : strtotime($value);
    }

    public function getEndTimeAttribute()
    {
        return date('Y-m-d H:i:s', $this->attributes['end_time']);
    }

    /**
     * 获取红包数据 json_decode
     *
     * @return mixed
     */
    public function getBonusDataAttribute()
    {
        return unserialize($this->attributes['bonus_data']);
    }
}
