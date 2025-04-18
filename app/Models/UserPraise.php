<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserPraise extends BaseModel
{
    use HasFactory;

    protected $table = 'user_praise';

    protected $fillable = [
        'user_id','type','target_id',
    ];

    protected $primaryKey = 'praise_id';
}
