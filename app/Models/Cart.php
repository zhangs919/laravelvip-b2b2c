<?php

namespace App\Models;


class Cart extends BaseModel
{
    protected $table = 'cart';

    protected $fillable = [
//        'shop_id','user_id','session_id','goods_id','goods_sn','goods_name','market_price',
//        'goods_price','member_goods_price','goods_num','spec_key','spec_key_name',
//        'goods_barcode','selected','prom_type','prom_id','sku',
//        'goods_attr','goods_attr_id',

        'user_id','session_id','shop_id','goods_id','sku_id','cart_act_id','goods_name','goods_number',
        'goods_price','goods_type','parent_id','is_gift','buyer_type','add_time','select'

//        'buy_type',
//        'ext_info','cart_key',

        // 以下字段 接口拼接返回
        /*'basic_goods_name',
        'cat_id','brand_id','goods_sn','goods_status','goods_audit','is_delete','goods_image','give_integral',
        'invoice_type','stock_mode','spu_number','contract_ids','act_id','order_act_id','goods_moq','sales_model','sku_name',
        'sku_image','sku_number','market_price','spec_names','sku_sn','original_price','sku_enable','shop_status','goods_min_number',
        'goods_max_number','select','activity','order_activity','goods_price_format','market_price_format','original_price_format',
        'add_time_format','goods_amount','goods_amount_format','contract_list','gift_list','discount_fee','shop_bonus_amount','other_price'*/
    ];

    protected $primaryKey = 'cart_id';

    /**
     * 关联商品
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function goods()
    {
        return $this->hasOne(Goods::class, 'goods_id', 'goods_id');
    }

    /**
     * 关联店铺
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function shop()
    {
        return $this->hasOne(Shop::class, 'shop_id', 'shop_id');
    }

    public function sku()
    {
        return $this->hasOne(GoodsSku::class, 'sku_id','sku_id');
    }
}
