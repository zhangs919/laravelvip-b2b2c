<?php

namespace App\Models;


class ShopCredit extends BaseModel
{
    protected $table = 'shop_credit';

    protected $fillable = [
        'credit_name','credit_img','min_point','max_point','remark'
    ];

    protected $primaryKey = 'credit_id';
}
