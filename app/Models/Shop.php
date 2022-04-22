<?php

namespace App\Models;


class Shop extends BaseModel
{
    protected $table = 'shop';

    protected $fillable = [
        /*'is_supply','shop_name',
        'shop_image','shop_logo','shop_poster','shop_sign','shop_sign_m','detail_introduce','shop_keywords','shop_description',
        'start_price','opening_hour','shop_lng','shop_lat','address','show_price','show_content','button_content',
        'is_own_shop','collect_num','shop_type','clearing_cycle','cat_id','user_id','user_name','duration','system_fee',
        'insure_fee','take_rate','qrcode_take_rate','close_info','fail_info','goods_status','show_credit','login_status',
        'goods_is_show','show_in_street','shop_status','shop_sort','region_code', 'cat_ids',
        'collect_allow_number', 'collected_number', 'comment_allow_number', 'comment_number', 'store_allow_number', 'store_number',
        'credit', 'score', 'begin_time', 'end_time',*/

        // 重新整理的字段 2018.11.16
        'user_id', 'site_id', 'shop_name', 'shop_image', 'shop_logo', 'shop_poster', 'shop_sign', 'shop_type', 'is_supply',
        'cat_id', 'credit', 'desc_score', 'service_score', 'send_score', 'logistics_score', 'region_code', 'address', 'shop_lng',
        'shop_lat', 'opening_hour', 'close_tips', 'add_time', 'pass_time', 'duration', 'unit', 'clearing_cycle', 'open_time',
        'end_time', 'system_fee', 'insure_fee', 'goods_status', 'shop_status', 'close_info', 'shop_sort', 'shop_audit', 'fail_info',
        'simply_introduce', 'shop_keywords', 'shop_description', 'detail_introduce', 'service_tel', 'service_hours', 'shop_sign_m', 'take_rate', 'qrcode_take_rate',
        'collect_allow_number', 'collected_number', 'store_allow_number', 'store_number', 'comment_allow_number', 'comment_number', 'login_status', 'show_credit', 'show_in_street',
        'goods_is_show', 'control_price', 'show_price', 'show_content', 'button_content', 'button_url', 'start_price', 'shop_sn', 'rebate_enable',
        'rebate_days', 'rebate_setting', 'rebate_begin_time',
        'is_other_shpping_fee','other_shipping_fee','is_packing_fee','packing_fee',
        'shipping_time', // json
        'multi_store_number','multi_store_allow_number',

        'wx_barcode',

        // todo 不太确定的字段 暂时用着
        'collect_num', 'is_own_shop', 'user_name',

        'back_id', // 模板备份id
    ];

    protected $primaryKey = 'shop_id';


    /**
     * 一对多关联 积分商品表
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function integralGoods()
    {
        return $this->hasMany(IntegralGoods::class, 'shop_id', 'shop_id');
    }

    /**
     * 一对多关联 店铺绑定分类表
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function shopBindClass()
    {
        return $this->hasMany(ShopBindClass::class, 'shop_id', 'shop_id');
    }

    /**
     * 一对多关联 店铺内分类表
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function shopCategory()
    {
        return $this->hasMany(ShopCategory::class, 'shop_id', 'shop_id');
    }

    /**
     * 一对多关联 店铺会员表
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function member()
    {
        return $this->hasMany(Member::class, 'shop_id', 'shop_id');
    }

    /**
     * 一对多关联 店铺打印规格表
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function printSpec()
    {
        return $this->hasMany(PrintSpec::class, 'shop_id', 'shop_id');
    }

    /**
     * 一对多关联 店铺自提点表
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function selfPickup()
    {
        return $this->hasMany(SelfPickup::class, 'shop_id', 'shop_id');
    }

    /**
     * 一对多关联 店铺活动表 需要关联活动商品表-goods_activity
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function activity()
    {
        return $this->hasMany(Activity::class, 'shop_id', 'shop_id');
    }

    /**
     * 一对多关联 店铺客服表
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function customer()
    {
        return $this->hasMany(Customer::class, 'shop_id', 'shop_id');
    }

    /**
     * 一对多关联 店铺客服类型表
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function customerType()
    {
        return $this->hasMany(CustomerType::class, 'shop_id', 'shop_id');
    }

    /**
     * 一对多关联 运费模板表 需要关联表-freight_free_record freight_record
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function freight()
    {
        return $this->hasMany(Freight::class, 'shop_id', 'shop_id');
    }

    /**
     * 一对多关联 店铺发货地址表
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function shopAddress()
    {
        return $this->hasMany(ShopAddress::class, 'shop_id', 'shop_id');
    }

    /**
     * 一对一关联 店铺入驻申请表
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function shopApply()
    {
        return $this->hasOne(ShopApply::class, 'shop_id', 'shop_id');
    }

    /**
     * 一对多关联 店铺权限表 todo 该功能未完成
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function shopAuth()
    {
        return $this->hasMany(ShopAuth::class, 'shop_id', 'shop_id');
    }

    /**
     * 一对多关联 店铺动态评价表
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function shopComment()
    {
        return $this->hasMany(ShopComment::class, 'shop_id', 'shop_id');
    }

    /**
     * 一对多关联 店铺系统配置表
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function shopConfig()
    {
        return $this->hasMany(ShopConfig::class, 'shop_id', 'shop_id');
    }

    /**
     * 一对多关联 店铺消费保障表
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function shopContract()
    {
        return $this->hasMany(ShopContract::class, 'shop_id', 'shop_id');
    }

    /**
     * 一对一关联 店铺认证信息表
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function shopFieldValue()
    {
        return $this->hasOne(ShopFieldValue::class, 'shop_id', 'shop_id');
    }

    /**
     * 一对多关联 店铺操作日志表
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function shopLog()
    {
        return $this->hasMany(ShopLog::class, 'shop_id', 'shop_id');
    }

    /**
     * 一对多关联 店铺消息模板表
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function shopMessageTpl()
    {
        return $this->hasMany(ShopMessageTpl::class, 'shop_id', 'shop_id');
    }

    /**
     * 一对多关联 店铺导航表
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function shopNavigation()
    {
        return $this->hasMany(ShopNavigation::class, 'shop_id', 'shop_id');
    }

    /**
     * 一对多关联 店铺付款信息表
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function shopPayment()
    {
        return $this->hasMany(ShopPayment::class, 'shop_id', 'shop_id');
    }

    /**
     * 一对多关联 店铺问答表
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function shopQuestions()
    {
        return $this->hasMany(ShopQuestions::class, 'shop_id', 'shop_id');
    }

    /**
     * 一对多关联 店铺会员等级表
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function shopRank()
    {
        return $this->hasMany(ShopRank::class, 'shop_id', 'shop_id');
    }

    /**
     * 一对多关联 店铺账号角色表
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function shopRole()
    {
        return $this->hasMany(ShopRole::class, 'shop_id', 'shop_id');
    }

    /**
     * 一对多关联 店铺物流运单表
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function shopShipping()
    {
        return $this->hasMany(ShopShipping::class, 'shop_id', 'shop_id');
    }

    /**
     * 一对多关联 店铺网点表
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function stores()
    {
        return $this->hasMany(Store::class, 'shop_id', 'shop_id');
    }

    /**
     * 一对多关联 店铺网点分组表
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function storeGroup()
    {
        return $this->hasMany(StoreGroup::class, 'shop_id', 'shop_id');
    }

    /**
     * 一对多关联 店铺装修表
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function templateItem()
    {
        return $this->hasMany(TemplateItem::class, 'shop_id', 'shop_id');
    }

    /**
     * 一对多关联 店铺专题表
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function topic()
    {
        return $this->hasMany(Topic::class, 'shop_id', 'shop_id');
    }

    /**
     * 一对多关联 店铺装修备份表
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tplBackup()
    {
        return $this->hasMany(TplBackup::class, 'shop_id', 'shop_id');
    }

    /**
     * 一对多关联 易联云打印机配置表
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ylyPrinter()
    {
        return $this->hasMany(YlyPrinter::class, 'shop_id', 'shop_id');
    }

    /**
     * 一对多关联 店铺商品单位表
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function goodsUnit()
    {
        return $this->hasMany(GoodsUnit::class, 'shop_id', 'shop_id');
    }

    /**
     * 一对多关联 店铺商品详情版式表
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function goodsLayout()
    {
        return $this->hasMany(GoodsLayout::class, 'shop_id', 'shop_id');
    }

    /**
     * 一对多关联 店铺商品标签表
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function goodsTag()
    {
        return $this->hasMany(GoodsTag::class, 'shop_id', 'shop_id');
    }
}
