<?php

namespace App\Models;


class PushMessage extends BaseModel
{
    protected $table = 'push_message';

    protected $fillable = [
        'title','content','push_type','shop','article','category','group','brand','link',
        'platforms','target_type','target_text','sales_type','sales_name','group_id'
    ];

    protected $primaryKey = 'push_id';
}
