<?php

namespace App\Models;


class ShopLog extends BaseModel
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'shop_log';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'content', 'user_name', 'user_id', 'ip', 'url'
    ];

    protected $primaryKey = 'id';
}
