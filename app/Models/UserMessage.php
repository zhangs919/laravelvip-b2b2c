<?php

namespace App\Models;


class UserMessage extends BaseModel
{
    protected $table = 'user_message';

    protected $fillable = [
        'msg_id','status','read_time','receiver'
    ];

    protected $primaryKey = 'rec_id';

    /**
     * 时间戳格式化
     *
     * @param $value
     * @return false|string
     */
    public function getReadTimeAttribute($value)
    {
        return date('Y-m-d H:i:s', $value);
    }

    /**
     * 时间戳格式化
     *
     * @param $value
     * @return false|string
     */
    public function getSendTimeAttribute($value)
    {
        return date('Y-m-d H:i:s', $value);
    }
}
