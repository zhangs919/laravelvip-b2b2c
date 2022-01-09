<?php

namespace App\Models;


class GoodsSku extends BaseModel
{
    protected $table = 'goods_sku';

    /**
     * specs 商品规格序列化
     * "specs":{
            "163":{
            "attr_id":"163",
            "attr_vid":"1077",
            "attr_vname":"订金",
            "attr_desc":""
            },
            "166":{
            "attr_id":"166",
            "attr_vid":"1114",
            "attr_vname":"125g装",
            "attr_desc":""
            }
            },
            "market_price":"100.00",
            "goods_price":"1000.00",
            "goods_number":"100",
            "warn_number":"5",
            "goods_sn":"",
            "goods_barcode":"",
            "goods_stockcode":""
     * @var array
     */
    protected $fillable = [
        'goods_id',
        'sku_name','sku_image','sku_images', // todo 该字段是否不用存储??
        'spec_ids','spec_vids', 'spec_names',
        'goods_price','mobile_price','market_price','goods_number','sku_number_version',
        'goods_sn', 'goods_barcode','warn_number','goods_stockcode','goods_weight','goods_volume',
        'pc_desc','mobile_desc','is_spu','is_enable'
    ];

    protected $primaryKey = 'sku_id';
}
