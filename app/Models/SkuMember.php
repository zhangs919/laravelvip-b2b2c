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
// | Date:2019-10-17
// | Description:
// +----------------------------------------------------------------------

namespace App\Models;

/**
 * 自定义会员价模型
 *
 * Class SkuMember
 * @package App\Models
 */
class SkuMember extends BaseModel
{
    protected $table = 'sku_member';

    protected $fillable = [
        'goods_id', 'sku_id', 'shop_id', 'shop_rank_id','goods_price', 'member_type', 'member_value', 'member_data'
    ];

    protected $primaryKey = 'sm_id';
}
