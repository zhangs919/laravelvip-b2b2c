<?php

namespace App\Models;


class LibGoods extends BaseModel
{
    protected $table = 'lib_goods';

    /**
     * 与Goods表差不多
     *
     * mobile_desc [0=>['content'=>'图片,'type'=>1],0=>['content'=>'文字','type'=>0]]
     * @var array
     */
    protected $fillable = [
        'goods_id','goods_name','cat_id','cat_id1','cat_id2','cat_id3','shop_id','sku_open',
        'sku_id','goods_subname','goods_price','market_price','cost_price','mobile_price',
        'give_integral','goods_number','warn_number','goods_sn','goods_barcode','goods_image',
        'goods_images','goods_video','brand_id','pc_desc','mobile_desc','top_layout_id',
        'bottom_layout_id','packing_layout_id','service_layout_id','click_count','keywords',
        'goods_info','invoice_type','is_repair','user_discount','stock_mode','comment_num',
        'sale_num','collect_num','goods_audit','goods_status','goods_reason','is_delete',
        'is_virtual','is_best','is_new','is_hot','is_promote',
        'contract_ids','supplier_id',
        'freight_id',
//        'goods_freight_type','goods_freight_fee','goods_stockcode',
        'goods_volume','goods_weight','goods_remark','goods_sort','add_time','last_time',
//        'audit_time',
//        'edit_items',
        'act_id','lib_cat_id',

//        'goods_moq',
//        'lib_goods_id',
        'other_attrs',
//        'filter_attr_ids','filter_attr_vids','button_name','button_url',
        'pricing_mode','goods_unit','tag_id','sales_model',
//        'order_act_id','goods_mode',
//        'ext_info','remark',
//        'shop_cat_ids',
    ];

    protected $primaryKey = 'goods_id';

    /**
     * 一对多关联 系统商品属性表
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function libGoodsAttr()
    {
        return $this->hasMany(LibGoodsAttr::class, 'goods_id', 'goods_id');
    }

    /**
     * 一对多关联 系统商品图片表
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function libGoodsImage()
    {
        return $this->hasMany(LibGoodsImage::class, 'goods_id', 'goods_id');
    }

    /**
     * 一对多关联 系统商品SKU表
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function libGoodsSku()
    {
        return $this->hasMany(LibGoodsSku::class, 'goods_id', 'goods_id');
    }

    /**
     * 一对多关联 系统商品规格表
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function libGoodsSpec()
    {
        return $this->hasMany(LibGoodsSpec::class, 'goods_id', 'goods_id');
    }

    /**
     * 手机端描述
     *
     * @return array|mixed
     */
    public function getMobileDescAttribute()
    {
        $mobile_desc = unserialize($this->attributes['mobile_desc']);

        if (empty($mobile_desc)) {
            return [];
        }

        return $mobile_desc;
    }

    public function getOtherAttrsAttribute()
    {
        $other_attrs = unserialize($this->attributes['other_attrs']);

        if (empty($other_attrs)) {
            return [];
        }

        return $other_attrs;
    }

    public function getContractIdsAttribute()
    {
        $contract_ids = unserialize($this->attributes['contract_ids']);

        if (empty($contract_ids)) {
            return [];
        }

        return $contract_ids;
    }

    public function getGoodsImagesAttribute()
    {
        $goods_images = unserialize($this->attributes['goods_images']);

        if (empty($goods_images)) {
            return [];
        }

        return $goods_images;
    }
}
