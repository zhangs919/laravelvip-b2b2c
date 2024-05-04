<?php

namespace App\Models;


class WeixinMaterial extends BaseModel
{
    //
    protected $table = 'weixin_material';

    protected $fillable = [
        'site_id',
        'title','author',
        'local_url',
        'cover','abstract','link','content',
        'read_num'
    ];

    protected $primaryKey = 'id';
}
