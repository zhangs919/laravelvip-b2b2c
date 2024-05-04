<?php

namespace App\Models;

/**
 * 门店商品SKU模型
 * Class MultiStoreGoodsSku
 * @package App\Models
 */
class MultiStoreGoodsSku extends BaseModel
{
    protected $table = 'multi_store_goods_sku';

    protected $fillable = [
        'shop_id', 'store_id', 'store_goods_id', 'goods_id', 'sku_id', 'store_sku_price', 'store_sku_number'
    ];

    protected $primaryKey = 'id';


    public function goodsSku()
    {
        return $this->belongsTo(GoodsSku::class, 'sku_id','sku_id');
    }
}
