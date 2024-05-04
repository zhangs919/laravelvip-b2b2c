<?php

namespace App\Models;


class ShopApply extends BaseModel
{
    protected $table = 'shop_apply';

    protected $fillable = [
        'user_id','shop_id','site_id','shop_name','cat_id','duration','unit','system_fee','insure_fee','cat_ids','audit_status','fail_info','pay_status'
    ];

    protected $primaryKey = 'apply_id';

    public function shopClass()
    {
        return $this->belongsTo(ShopClass::class, 'cat_id', 'cls_id');
    }

    public function shop()
    {
        return $this->belongsTo(Shop::class,'shop_id','shop_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id','user_id');
    }
}
