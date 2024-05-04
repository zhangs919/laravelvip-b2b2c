<?php

namespace App\Models;

/**
 * 门店商品模型
 * Class MultiStoreGoods
 * @package App\Models
 */
class MultiStoreGoods extends BaseModel
{
    protected $table = 'multi_store_goods';

    protected $fillable = [
        'shop_id', 'store_id', 'goods_id', 'store_goods_price', 'store_goods_number', 'is_sell', 'is_self_mention',
        'sale_num', 'act_id', 'order_act_id', 'goods_url', 'goods_image_qrcode',
    ];

    protected $primaryKey = 'id';

    public function multiStoreGoodsSku()
    {
        return $this->hasMany(MultiStoreGoodsSku::class, 'store_goods_id')->with(['goodsSku']);
    }

    public function goods()
    {
        return $this->belongsTo(Goods::class, 'goods_id')->with(['goodsSkuMain','goodsSpec']);
    }

    public function multiStore()
    {
        return $this->belongsTo(MultiStore::class, 'store_id');
    }

}
