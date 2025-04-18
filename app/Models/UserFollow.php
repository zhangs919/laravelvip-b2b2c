<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserFollow extends BaseModel
{
    use HasFactory;

    protected $table = 'user_follow';

    protected $fillable = [
        'user_id','type','target_id',
    ];

    protected $primaryKey = 'follow_id';
}
