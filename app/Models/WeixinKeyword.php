<?php

namespace App\Models;


class WeixinKeyword extends BaseModel
{
    protected $table = 'weixin_keyword';

    protected $fillable = [
        'key_name','key_type','key_content','key_title',
        'key_img','key_link','key_desc','shop_id'
    ];

    protected $primaryKey = 'id';
}
