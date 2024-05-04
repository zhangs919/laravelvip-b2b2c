<?php

namespace App\Models;


class WeixinMenu extends BaseModel
{
    protected $table = 'weixin_menu';

    protected $fillable = [
        'menu_name','parent_id','menu_type','menu_command',
        'menu_value','is_auto_login','auto_login_url',
        'menu_title','menu_img','menu_link','menu_desc',
        'menu_level','shop_id','menu_sort','appid','pagepath'
    ];

    protected $primaryKey = 'id';
}
