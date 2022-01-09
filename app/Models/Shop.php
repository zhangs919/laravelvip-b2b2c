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
        'rebate_days', 'rebate_setting', 'rebate_begin_time', 'wx_barcode',

        // todo 不太确定的字段 暂时用着
        'collect_num', 'is_own_shop', 'user_name'
    ];

    protected $primaryKey = 'shop_id';

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
     * 一对多关联 店铺所属分类表
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function shopBindClass()
    {
        return $this->hasMany(ShopBindClass::class, 'shop_id', 'shop_id');
    }
}
