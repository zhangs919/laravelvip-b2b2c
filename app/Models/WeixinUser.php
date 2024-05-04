<?php

namespace App\Models;


class WeixinUser extends BaseModel
{
    //
    protected $table = 'weixin_user';

    protected $fillable = [
        'site_id','shop_id',
        'appid','unionid','openid','tagid_list','is_black',
        'subscribe','nickname','sex','country','province','city',
        'language','headimgurl','subscribe_time',
        'remark','subscribe_scene','qr_scene','qr_scene_str'
    ];

    protected $primaryKey = 'id';

    public function shop()
    {
        return $this->belongsTo(Shop::class, 'shop_id');
    }
}
