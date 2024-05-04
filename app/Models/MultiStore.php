<?php

namespace App\Models;

/**
 * 门店模型
 * Class MultiStore
 * @package App\Models
 */
class MultiStore extends BaseModel
{
    protected $table = 'multi_store';

    protected $fillable = [
        'shop_id', 'group_id', 'store_name', 'user_id', 'user_type',
        'region_code', 'address', 'store_lng', 'store_lat', 'store_img',
        'region_type', 'region_editable', 'tel', 'opening_type', 'opening_hour', 'store_remark',
        'take_rate', 'clearing_cycle', 'pickup_id', 'store_status', 'edit_info', 'add_time',
        'city_code', 'city_letter', 'is_diy', 'is_master', 'store_logo', 'yl_settle_mode',
        'reserve_money', 'is_allowed_related_goods', 'close_image', 'goods_count',
        'out_openhour_order_enable', 'close_tips', 'is_other_shpping_fee', 'is_packing_fee',
        'other_shipping_fee', 'packing_fee', 'shipping_time', 'start_price',
    ];

    protected $primaryKey = 'store_id';

    protected $appends = [
        'user_name'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function storeGroup()
    {
        return $this->belongsTo(MultiStoreGroup::class, 'group_id', 'group_id');
    }

    public function getUserNameAttribute()
    {
        return $this->user->user_name ?? '';
    }

}
