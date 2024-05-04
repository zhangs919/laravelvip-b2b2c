<?php

namespace App\Models;


use Laravel\Scout\Searchable;

class Goods extends BaseModel
{
//    use Searchable;

    protected $table = 'goods';

//    protected $fillable = [
//        'cat_id','goods_sn','bar_code','goods_barcode','goods_name','click_count','brand_id','goods_number',
//        'goods_weight','default_shipping','market_price','cost_price','shop_price','promote_price',
//        'promote_start_date','promote_end_date','warn_number','keywords','goods_subname','pricing_mode','goods_unit','goods_brief','goods_desc',
//        'goods_moq','goods_price','pc_desc','bottom_layout_id','packing_layout_id','service_layout_id','goods_volume','goods_freight_type','freight_id',
//        'invoice_type','contract_ids','user_discount','stock_mode','goods_status',
//        'desc_mobile','goods_thumb','goods_img','goods_image','goods_video','original_img','is_real','extension_code','is_on_sale',
//
//    ];

    /**
     * cat_id
     * cat_id1
     * cat_id2
     * cat_id3
     * shop_id 店铺ID
     * add_time 商品发布时间
     * last_time 最后一次更新时间
     *
     * goods_name 商品名称
     * keywords 关键词
     * goods_subname 商品卖点
     * pricing_mode 计价方式
     * goods_unit 商品单位
     * brand_id 商品品牌
     * goods_moq 最小起订量
     * goods_price 店铺价
     * market_price 市场价
     * cost_price 成本价
     * goods_number 商品库存
     * warn_number 库存警告数量
     * goods_sn 商品货号
     * goods_barcode 商品条形码
     * goods_image 商品主图
     * goods_video 主图视频
     * pc_desc 商品电脑端描述
     * mobile_desc 商品手机端描述
     * top_layout_id 顶部模板
     * bottom_layout_id 底部模板
     * packing_layout_id 包装清单版式
     * service_layout_id 售后保证版式
     * goods_weight 物流重量(Kg)
     * goods_volume 物流体积(m3)
     * goods_freight_type 运费设置
     * goods_freight_fee 固定运费
     * freight_id 运费模板
     * invoice_type 发票类型
     * contract_ids 保障服务
     * contract_ids[2] 品质承诺
     * contract_ids[1] 7天无理由退换货
     * contract_ids[3] 破损补寄
     * user_discount 会员打折
     * stock_mode 库存计数 0拍下减库存 1付款减库存 2出库减库存
     * goods_status 立刻发布
     *
     * filter_attr_ids Filter Attr Ids 商品属性ids
     * filter_attr_vids Filter Attr Vids
     * goods_stockcode 商品库位码
     * click_count 商品浏览次数
     * goods_audit 审核是否通过
     * is_delete 是否已删除
     * is_virtual Is Virtual
     * is_best 是否精品
     * is_new 是否新品
     * is_hot 是否热卖
     * is_promote 是否促销
     * supplier_id 供货商ID
     * goods_sort Goods Sort
     * audit_time Audit Time
     * comment_num 商品评论次数
     * sale_num 商品销售数量
     * collect_num 商品收藏数量
     * sales_model 销售模式
     * goods_images Goods Images
     * button_name 按钮名称
     * button_url 按钮链接
     * mobile_price 移动端专项价
     * todo new give_integral 赠送积分 默认“0”
     * goods_info 商品简介
     * goods_reason Goods Reason
     * goods_remark 商品备注
     *
     * shop_cat_ids 店铺分类ids 序列化
     *
     * sku_open Sku Open必须是整数
     * sku_id Sku Id
     * is_repair 保修必须是整数
     *
     * @var array
     */
    protected $fillable = [
        'goods_id','goods_name','cat_id','cat_id1','cat_id2','cat_id3','shop_id','sku_open', 'sku_id',
        'sku_mode','prop_open','street_sort', //
        'goods_subname','goods_price','market_price','cost_price','mobile_price',
        'give_integral','goods_number','warn_number','goods_sn','goods_barcode','cover_image','goods_image',
        'goods_images','goods_video','brand_id','pc_desc','mobile_desc','top_layout_id',
        'bottom_layout_id','packing_layout_id','service_layout_id','click_count','keywords',
        'goods_info','invoice_type','is_repair','user_discount','stock_mode','comment_num', 'sale_num',
        'multi_store_sale_num', //
        'collect_num','goods_audit','goods_status','goods_reason','is_delete',
        'is_virtual','is_best','is_new','is_hot','is_promote', 'tag_id', 'contract_ids','supplier_id',
        'freight_id', 'goods_freight_type','goods_freight_fee','goods_stockcode',
        'goods_volume','goods_weight','goods_remark','goods_sort','add_time','last_time',
        'audit_time',
        'edit_items',
        'act_id',
        'goods_moq','lib_goods_id',
        'other_attrs',
        'filter_attr_ids','filter_attr_vids','button_name','button_url',
        'pricing_mode','goods_unit', 'sales_model',
        'sales_area', //
        'order_act_id','goods_mode',
        'ext_info','remark',

        /*4.9版本 新增字段*/
        'erp_goods_id',
        'goods_from', //
        'is_cross_border',
        'shipper_id',

        'is_sync_stock','is_sync_price','is_sync_onoff','cs_dg_id','is_pickup', //
        'is_common_package','pickup_timeout','pickup_timeout_type', //

        'shop_cat_ids',


//        'other_cat_ids' // 考虑另建表存储
//        'goods_price_format',
    ];

    protected $primaryKey = 'goods_id';

    protected $appends = [
        'status_name'
    ];

//    // 定义索引里面的类型，上文我们说过，可以把type理解成一个数据表。我们现在要做的就是把我们所有的要全文搜索的字段都存入到es中的一个叫'_doc'的表中。
//    public function searchableAs()
//    {
//        return 'goods';
//    }
//    // 定义有那些字段需要搜索
//    public function toSearchableArray()
//    {
//        $array = $this->toArray();
//
//        return $array;
//    }

    public function goodsUnit()
    {
        return $this->hasOne(GoodsUnit::class, 'unit_id');
    }

    public function goodsTag()
    {
        return $this->hasOne(GoodsTag::class, 'tag_id');
    }

    public function shop()
    {
        return $this->belongsTo(Shop::class, 'shop_id','shop_id');
    }

    /**
     * 一对多关联 商品属性表
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function goodsAttr()
    {
        return $this->hasMany(GoodsAttr::class, 'goods_id', 'goods_id');
    }

    /**
     * 一对多关联 商品扩展分类表
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function goodsCat()
    {
        return $this->hasMany(GoodsCat::class, 'goods_id', 'goods_id');
    }

    /**
     * 一对多关联 商品历史记录表
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function goodsHistory()
    {
        return $this->hasMany(GoodsHistory::class, 'goods_id', 'goods_id');
    }

    /**
     * 一对多关联 商品相册表
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function goodsImage()
    {
        return $this->hasMany(GoodsImage::class, 'goods_id', 'goods_id');
    }

    /**
     * 一对多关联 商品SKU表
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function goodsSku()
    {
        return $this->hasMany(GoodsSku::class, 'goods_id', 'goods_id')->where('checked', 1);
    }

    /**
     * 关联商品默认SKU
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function goodsSkuMain()
    {
        return $this->belongsTo(GoodsSku::class, 'sku_id');
    }

    /**
     * 一对多关联 商品规格表
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function goodsSpec()
    {
        return $this->hasMany(GoodsSpec::class, 'goods_id', 'goods_id');
    }

    /**
     * 一对多关联 收藏表(商品收藏)
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function goodsCollect()
    {
        return $this->hasMany(Collect::class, 'goods_id', 'goods_id');
    }

    /**
     * 手机端描述
     *
     * @return array|mixed
     */
    public function getMobileDescAttribute()
    {
        if (empty($this->attributes['mobile_desc'])) {
            return [];
        }
		$mobile_desc = json_decode($this->attributes['mobile_desc'], true) ?? [];

        return $mobile_desc;
    }

    public function getOtherAttrsAttribute()
    {
		if (empty($this->attributes['other_attrs'])) {
			return [];
		}
        $other_attrs = json_decode($this->attributes['other_attrs'], true);

        return $other_attrs;
    }

    public function getContractIdsAttribute()
    {
		if (empty($this->attributes['contract_ids'])) {
			return [];
		}
        $contract_ids = json_decode($this->attributes['contract_ids'], true);

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

    public function getStatusNameAttribute()
    {
        $statusName = '';
        if (empty($this->attributes['goods_audit'])) {
            return $statusName;
        }
        if ($this->attributes['goods_audit'] == 0) {
            $statusName = '待审核';
        } else {
            if($this->attributes['goods_status'] == 0) {
                $statusName = '已下架';
            } elseif ($this->attributes['goods_status'] == 1) {
                $statusName = '出售中';
            } elseif ($this->attributes['goods_status'] == 2) {
                $statusName = '违规下架';
            }
        }
        return $statusName;
    }
}
