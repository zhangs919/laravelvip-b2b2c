<?php

namespace App\Models;


class Shipping extends BaseModel
{
    protected $table = 'shipping';

    protected $fillable = [
        'shipping_name','shipping_code','img_width','img_height','offset_top', 'offset_left',
        'img_path','is_open','is_sheet','shipping_sort','config_lable','logo', 'site_url'
    ];

    protected $primaryKey = 'shipping_id';


    /**
     * 一对多关联
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function shipping()
    {
        return $this->hasMany(ShopShipping::class, 'shipping_id', 'shipping_id');
    }
}
