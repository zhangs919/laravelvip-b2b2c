<?php

namespace App\Models;


class UserReal extends BaseModel
{
    protected $table = 'user_real';

    protected $fillable = [
        'user_id', 'real_name', 'id_code', 'card_pic1', 'card_pic2', 'card_pic3', 'address_now', 'reason', 'status'
    ];

    protected $primaryKey = 'real_id';

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
}
