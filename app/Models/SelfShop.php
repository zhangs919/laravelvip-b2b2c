<?php

namespace App\Models;


class SelfShop extends BaseModel
{
    protected $table = 'self_shop';

    protected $fillable = [
        'is_supply','shop_name',

        'shop_image','shop_logo','shop_poster','shop_sign','shop_sign_m','detail_introduce','shop_keywords','shop_description',
        'start_price','opening_hour','shop_lng','shop_lat','address','show_price','show_content','button_content',


        'shop_type','clearing_cycle','cat_id','user_id','user_name',
        'duration','system_fee', 'insure_fee','take_rate','qrcode_take_rate','close_info','fail_info',

        'goods_status','show_credit','login_status',
        'goods_is_show','show_in_street','shop_status','shop_sort','region_code',
        'cat_ids'
    ];

    protected $primaryKey = 'shop_id';
}
