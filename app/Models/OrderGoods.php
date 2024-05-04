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
// | Date:2018-10-26
// | Description:
// +----------------------------------------------------------------------

namespace App\Models;

/**
 * 订单商品模型
 * Class OrderGoods
 * @package App\Models
 */
class OrderGoods extends BaseModel
{

    protected $table = 'order_goods';

    /**
     * other_price 其他价格（包括：full_cut_amount gift point bonus）
     * ext_info "{\"full_cut_amount\":0,\"gift\":0,\"point\":0,\"bonus\":0}",
     * "spec_info": "尺寸：S|尺码：150*180cm",
     * @var array
     */
    protected $fillable = [
        'record_id', 'order_id', 'goods_id', 'sku_id', 'spec_info', 'goods_name',
        'goods_sn', 'sku_sn', // 两个字段值是一样的 sku_sn的值 直接取goods_sn的值即可
        'goods_image', 'goods_price','original_price','cost_price', 'goods_points', 'distrib_price', 'goods_number', 'other_price',
        'pay_change', 'parent_id', 'is_gift', 'is_evaluate', 'goods_status', 'give_integral', 'stock_mode',
        'stock_dropped', 'act_type', 'goods_type', 'is_distrib', 'discount', 'profits', 'distrib_money',


        'goods_contracts',
        // ext_info:"{\"full_cut_amount\":0,\"gift\":0,\"point\":0,\"bonus\":0}"
        'ext_info', // --此字段不需要存储 关联查询即可 todo 暂时先存起来

        'goods_mode',

        'cs_take_rate','cs_take_rate_mode','cs_take_money','tax',
        'integral_money','custom_ifield','custom_sfield','take_rate',
        'shop_rate','goods_barcode','goods_stockcode',


//        'shop_id', 'contract_ids', 'market_price', 'sku_image',
//        'back_id', 'back_status', 'back_number',
//        'saleservice', // 此字段不需要存储 根据contract_ids查询保障服务信息即可
//        'goods_back_format', 'goods_price_format', 'market_price_format', // 此字段不需要存储 根据状态格式化返回 "goods_back_format": "换货中" "goods_price_format": "￥13.80", "market_price_format": "￥26.00",
//        'gifts_list', 此字段不需要存储 从礼物表中关联查询即可

        // 以下字段 用于退款退货、换货维修
//        'send_number','send_number_money','all_number_money'
//"send_number": 1,
//      "send_number_money": 222,
//      "all_number_money": 222,
    ];

    protected $primaryKey = 'record_id';

    /**
     * 一对一关联商品表
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function goods()
    {
        return $this->belongsTo(Goods::class, 'goods_id', 'goods_id');
    }

    public function orderInfo()
    {
        return $this->belongsTo(OrderInfo::class,'order_id','order_id');
    }


}
