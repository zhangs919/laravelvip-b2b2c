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
// | Date:2019-03-14
// | Description: 万能表单模型
// +----------------------------------------------------------------------

namespace App\Models;


class Form extends BaseModel
{

    protected $table = 'form';

    protected $fillable = [
        'shop_id', 'site_id', 'user_id', 'fb_num','add_time','update_time','is_publish',
        'need_login','form_title','form_data','global_data','header_style','bottom_style','form_keyword',
        'form_desc','share_image',
        'commit_mode', 'start_time', 'end_time',
    ];

    protected $primaryKey = 'form_id';

    public function setStartTimeAttribute($value)
    {
        $this->attributes['start_time'] = is_int($value) ? $value : strtotime($value);
    }

    public function getStartTimeAttribute()
    {
        return format_time($this->attributes['start_time'], 'Y-m-d');
    }

    public function setEndTimeAttribute($value)
    {
        $this->attributes['end_time'] = is_int($value) ? $value : strtotime($value);
    }

    public function getEndTimeAttribute()
    {
        return format_time($this->attributes['end_time'], 'Y-m-d');
    }
}
