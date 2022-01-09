<?php

namespace App\Models;


class UserAddress extends BaseModel
{
    protected $table = 'user_address';

    protected $fillable = [
        'address_name','user_id','consignee','region_code','address_lng','address_lat',
        'address_detail','mobile','tel','email','zipcode','address_house','address_label','is_default',
//        'country','province','city','district','street',

    ];

    protected $primaryKey = 'address_id';
}
