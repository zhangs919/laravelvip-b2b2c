<?php

namespace App\Models;

/**
 * 商家角色模型
 * Class ShopRole
 * @package App\Models
 */
class ShopRole extends BaseModel
{
    protected $table = 'shop_role';

    protected $fillable = [
        'shop_id','role_name','auth_codes','role_type','role_alias','role_desc'
    ];

    protected $primaryKey = 'role_id';

    public function user()
    {
        return $this->hasMany(User::class, 'role_id');
    }
}