<?php

namespace App\Models;


class Freight extends BaseModel
{
    protected $table = 'freight';

    protected $fillable = [
        'shop_id','freight_type','title','region_code','is_free','valuation','limit_sale','free_set','add_time','last_time'
    ];

    protected $primaryKey = 'freight_id';

    /**
     * 一对多关联
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function freightRecord()
    {
        return $this->hasMany(FreightRecord::class, 'freight_id', 'freight_id');
    }

    /**
     * 一对多关联
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function freightFreeRecord()
    {
        return $this->hasMany(FreightFreeRecord::class, 'freight_id', 'freight_id');
    }
}
