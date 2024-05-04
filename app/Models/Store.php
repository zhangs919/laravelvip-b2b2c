<?php

namespace App\Models;

/**
 * 网点模型
 * Class Store
 * @package App\Models
 */
class Store extends BaseModel
{
    protected $table = 'store';

    protected $fillable = [
        'shop_id','user_type','user_id','user_account','store_lng','store_lat','region_editable','group_id',
        'region_type','add_time','is_pickup','pickup_id','auto_order_taking','refuse_order_taking',
        'store_status','edit_info','store_name','region_code','address','tel','take_rate',
        'clearing_cycle','store_img','store_remark'
    ];

    protected $primaryKey = 'store_id';

    public function storeGroup()
    {
        return $this->belongsTo(StoreGroup::class, 'group_id','group_id');
    }
}
