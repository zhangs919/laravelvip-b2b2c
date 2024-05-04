<?php

namespace App\Models;


class WeixinMaterialGroup extends BaseModel
{
    //
    protected $table = 'weixin_material_group';

    protected $fillable = [
        'site_id','media_id','local_url','article_id','is_deleted','type'
    ];

    protected $primaryKey = 'id';


}
