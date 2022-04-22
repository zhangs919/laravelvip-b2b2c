<?php

namespace App\Models;


class ShopShipping extends BaseModel
{
    protected $table = 'shop_shipping';

    protected $fillable = [
        'shop_id', 'shipping_id', 'img_width', 'img_height', 'offset_top', 'offset_left', 'img_path', 'is_default', 'is_open', 'config_lable'
    ];

    protected $primaryKey = 'id';

    public function shipping()
    {
        return $this->belongsTo(Shipping::class, 'shipping_id', 'shipping_id');
    }
}
