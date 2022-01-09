<?php

namespace App\Models;


class UserRank extends BaseModel
{
    protected $table = 'user_rank';

    protected $fillable = [
        'rank_name','rank_img','is_special','point_type','min_points','max_points','type'
    ];

    protected $primaryKey = 'rank_id';
}