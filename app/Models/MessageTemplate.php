<?php

namespace App\Models;


class MessageTemplate extends BaseModel
{
    protected $table = 'message_template';

    protected $fillable = [
        'name','code','type','msg_type','sys_open','sms_open','email_open','wx_open','last_modify','aliyu_code','sys_content',
        'sms_content','email_content','wx_content','explain','email_title','sys_spec','sms_spec','email_spec','wx_spec'
    ];

    protected $primaryKey = 'id';
}
