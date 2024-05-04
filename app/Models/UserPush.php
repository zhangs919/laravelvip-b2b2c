<?php

namespace App\Models;


class UserPush extends BaseModel
{
    protected $table = 'user_push';

    protected $fillable = [
        'user_id', 'cid', 'client'
    ];

    protected $primaryKey = 'id';

    public static function getPushCidArr($str_ids)
    {
        $arr = explode(',', $str_ids);
        $cids = self::whereIn('user_id', $arr)
            ->whereIn('client', ['android', 'ios'])
            ->get()
            ->pluck('cid', 'user_id')
            ->toArray();
        return $cids;
    }
}
