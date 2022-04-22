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
 * 会员红包模型
 *
 * Class UserBonus
 * @package App\Models
 */
class UserBonus extends BaseModel
{
    protected $table = 'user_bonus';

    protected $fillable = [
        'user_id','bonus_id','bonus_sn','bonus_price','bonus_data',
        'receive_time','used_time','start_time','end_time','add_time','order_sn',
        'bonus_status', // 红包状态 0-正常 1-已使用 2-已失效
        'is_delete','sales_id','user_name','shop_id','bonus_type','use_range',
        'bonus_datas',// 序列化存储
        'min_goods_amount','is_original_price','order_id',
        'goods_ids'
    ];

    protected $primaryKey = 'user_bonus_id';
}
