<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderSettlementLog extends BaseModel
{
    use HasFactory;

    protected $table = 'order_settlement_log';

    public $timestamps = false;

    protected $fillable = [
        'order_id',
        'ru_id',
        'is_settlement',
        'actual_amount',
        'type',
        'add_time',
        'update_time'
    ];
}
