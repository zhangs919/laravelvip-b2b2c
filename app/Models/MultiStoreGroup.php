<?php

namespace App\Models;

/**
 * 门店分组模型
 * Class MultiStoreGroup
 * @package App\Models
 */
class MultiStoreGroup extends BaseModel
{
    protected $table = 'multi_store_group';

    protected $fillable = [
        'shop_id', 'group_name', 'group_sort',
        'group_activity_setting', 'group_related_goods', 'group_related_goods_num', 'store_count', 'goods_number'
    ];

    protected $primaryKey = 'group_id';

    protected $appends = [
        'group_related_goods_num', 'store_count', 'goods_number'
    ];

    /**
     * 一对多关联
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function multiStore()
    {
        return $this->hasMany(MultiStore::class, 'group_id', 'group_id');
    }
}
