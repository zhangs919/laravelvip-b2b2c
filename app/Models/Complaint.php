<?php

namespace App\Models;


class Complaint extends BaseModel
{
    protected $table = 'complaint';

    protected $fillable = [
        'complaint_sn', // 投诉编号
        'order_id', // 投诉的订单ID
        'order_sn', // 投诉的订单编号
        'goods_id', // 投诉的商品ID
        'sku_id', // 投诉的商品Sku ID
        'shop_id', // 投诉的店铺ID
        'user_id', // 投诉的用户ID
        'parent_id', // 上级投诉ID
        'role_type', // 角色类型
        'complaint_type', // 投诉原因
        'complaint_mobile', // 联系电话
        'complaint_images', // 上传投诉凭证图片
        'complaint_desc', // 投诉说明
        'complaint_status', // 投诉处理状态 0- 等待卖家处理  1 - 卖家已回复  2-买家撤销投诉 3 - 平台方介入 4-平台方仲裁中  5- 仲裁成功  6-仲裁失败
        'add_time', // 创建时间
        'close_time',
        /*平台仲裁*/
        'deduct_money', // 店铺罚款
        'deduct_credit', // 店铺扣分
    ];

    protected $primaryKey = 'complaint_id';

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

}
