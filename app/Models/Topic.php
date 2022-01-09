<?php

namespace App\Models;


class Topic extends BaseModel
{
    protected $table = 'topic';

    protected $fillable = [
        'topic_name','keywords','header_style','bottom_style','describe','is_delete','site_id','shop_id',
        'bg_image','bg_color','m_bg_image','m_bg_color','share_image'
    ];

    protected $primaryKey = 'topic_id';
}
