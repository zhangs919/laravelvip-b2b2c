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
// | Date:2018-11-22
// | Description:
// +----------------------------------------------------------------------

namespace App\Models;

/**
 * 售后订单模型
 *
 * Class BackOrder
 * @package App\Models
 */
class BackOrder extends BaseModel
{
    protected $table = 'back_order';

    /**
     * 售后类型 back_type // 1仅退款 2退货退款 3换货 4维修
     * 退款方式 refund_type // 0退回账户余额 1退回原支付方式
     * 售后状态 back_status //  默认0 0买家申请售后，等待卖家确认 1退款申请达成，等待买家发货 2 3 4退款成功 5卖家不同意，等待买家修改 6卖家拒绝了买家申请，退款关闭 7买家主动撤销了退款退货申请，退款关闭
     *
     * <option value="0">买家申请售后，等待卖家确认</option>
        <option value="5">卖家不同意，等待买家修改</option>
        <option value="1">卖家同意售后申请，等待买家确认完成</option>
        <option value="4">售后成功</option>
        <option value="6">售后关闭</option>
     *
     * <option value="wait">买家申请退款退货，等待卖家确认</option>
        <option value="dismiss">卖家不同意协议，等待买家修改</option>
        <option value="refund">退款申请达成，等待买家发货</option>
        <option value="shipping">买家已退货，等待卖家确认收货</option>
        <option value="backing">卖家已确认，等待平台退款</option>
        <option value="shipped">卖家已收货，等待平台方退款</option>
        <option value="close">退款关闭</option>
        <option value="finished">退款成功</option>
     * @var array
     */
    protected $fillable = [
        'back_id','back_sn','back_type','site_id','shop_id','user_id','order_id','delivery_id','record_id','goods_id','sku_id',
        'back_number','add_time','last_time','dismiss_time','disabled_time','back_status','back_reason','refund_money','refund_type',
        'refund_status','back_desc','back_img1','back_img2','back_img3','send_time','shipping_id','shipping_code','shipping_name',
        'shipping_sn','seller_reason','seller_desc','seller_img1','seller_img2','seller_img3','seller_address','reminder_times',
        'exchange_reason','repair_reason','user_address','exchange_desc','repair_desc','is_after_sale','update_time',

        // 以下字段app接口返回 不用存表
//        'back_reason_format', 'address_info','seller_back_desc'
    ];

    protected $primaryKey = 'back_id';
}
