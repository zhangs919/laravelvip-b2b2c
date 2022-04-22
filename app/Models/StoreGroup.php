<?php

namespace App\Models;

/**
 * 网点分组模型
 * Class StoreGroup
 * @package App\Models
 */
class StoreGroup extends BaseModel
{
    protected $table = 'store_group';

    protected $fillable = [
        'shop_id','group_name','group_sort',
    ];

    protected $primaryKey = 'group_id';

    /**
     * 一对多关联
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function store()
    {
        return $this->hasMany(Store::class, 'group_id', 'group_id');
    }
}
