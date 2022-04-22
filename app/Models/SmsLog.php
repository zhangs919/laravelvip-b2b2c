<?php

namespace App\Models;


class SmsLog extends BaseModel
{
    protected $table = 'sms_log';

    protected $fillable = [
        'log_phone', 'log_captcha', 'log_ip', 'log_msg', 'log_type', 'user_id', 'user_name'
    ];

    protected $primaryKey = 'log_id';
}
