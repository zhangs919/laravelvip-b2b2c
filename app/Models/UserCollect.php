<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserCollect extends BaseModel
{
    use HasFactory;

    protected $table = 'user_collect';

    protected $fillable = [
        'user_id','type','target_id',
    ];

    protected $primaryKey = 'collect_id';
}
