<?php

namespace App\Models;


class ShopFieldValue extends BaseModel
{
    protected $table = 'shop_field_value';

    protected $fillable = [
        'shop_id','real_name','card_no','hand_card','address',
        'company_name','unified_social_credi','artificial_person','license','special_aptitude','card_type','card_side_a','card_side_b'
    ];

    protected $primaryKey = 'id';


}
