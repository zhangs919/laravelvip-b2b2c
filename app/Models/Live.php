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
// | Date:2020-09-28
// | Description:直播模型
// +----------------------------------------------------------------------

namespace App\Models;


class Live extends BaseModel
{
    //
    protected $table = 'live';

    protected $fillable = [
        'act_id','live_name','live_img', 'start_time','end_time',
        'cat_id','status','is_delete', 'shop_id','is_recommend',
        'region_code','keywords', 'description','address','sort',
        'online_number','view_number',
        'share_img',

        'push_stream', // todo 推流地址 考虑是否需要存表
        'pull_stream', // todo 拉流地址 考虑是否需要存表

//        'live_goods', // todo 另建表 存储直播关联商品活动数据
    ];

    protected $appends = [
        'region_name'
    ];

    protected $primaryKey = 'id';

    /**
     * 关联直播分类
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function liveCategory()
    {
        return $this->belongsTo(LiveCategory::class, 'cat_id');
    }

    /**
     * 关联店铺
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function shop()
    {
        return $this->belongsTo(Shop::class, 'shop_id');
    }

    /**
     * 关联地区信息
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function region()
    {
        return $this->belongsTo(Region::class, 'region_code','region_code');
    }

    public function setStartTimeAttribute($value)
    {
        $this->attributes['start_time'] = is_int($value) ? $value : strtotime($value);
    }

    public function getStartTimeAttribute()
    {
        return format_time($this->attributes['start_time'], 'Y-m-d H:i:s');
    }

    public function setEndTimeAttribute($value)
    {
        $this->attributes['end_time'] = is_int($value) ? $value : strtotime($value);
    }

    public function getEndTimeAttribute()
    {
        return format_time($this->attributes['end_time'], 'Y-m-d H:i:s');
    }

    public function getRegionNameAttribute()
    {
        return $this->attributes['region']['region_name'] ?? '';
    }
}
