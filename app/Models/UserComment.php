<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserComment extends BaseModel
{
    use HasFactory;

    protected $table = 'user_comment';

    protected $fillable = [
        'user_id', 'pid', 'type', 'target_id', 'content',
    ];

    protected $primaryKey = 'comment_id';

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
