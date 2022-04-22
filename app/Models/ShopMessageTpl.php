<?php

namespace App\Models;


class ShopMessageTpl extends BaseModel
{
    protected $table = 'shop_message_tpl';

    protected $fillable = [
        'msg_tpl_id', 'is_open', 'shop_id', 'mobile', 'email', 'wx_id'
    ];

    protected $primaryKey = 'shop_tpl_id';
}
