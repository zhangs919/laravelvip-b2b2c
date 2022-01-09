<?php

namespace App\Models;


class TplBackup extends BaseModel
{
    protected $table = 'tpl_backup';

    protected $fillable = [
        'name', 'add_time', 'is_sys', 'shop_id', 'site_id', 'page', 'remark', 'type', 'topic_id', 'img', 'is_theme', 'ext_info'
    ];

    protected $primaryKey = 'back_id';
}
