<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class GrouponLog extends BaseModel
{
    use HasFactory;

    protected $table = 'groupon_log';

    protected $fillable = [
        'shop_id', 'goods_id', 'act_id', 'user_id','user_type','group_sn',
        'order_sn','add_time','status','start_time','end_time'
    ];

    protected $primaryKey = 'log_id';

    public function activity()
    {
        return $this->belongsTo(Activity::class, 'act_id', 'act_id');
    }

    public function orderInfo()
    {
        return $this->belongsTo(OrderInfo::class, 'order_sn', 'order_sn');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function grouponLog()
    {
        return $this->hasMany(GrouponLog::class, 'group_sn', 'group_sn');
    }
}
