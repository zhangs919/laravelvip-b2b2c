<?php

namespace App\Models;


class AdminRole extends BaseModel
{

    protected $table = 'admin_role';

    protected $fillable = [
        'role_name', 'auth_codes', 'role_desc', 'sort', 'role_type', 'status'
    ];

    protected $primaryKey = 'role_id'; // 主键id

    public function admin()
    {
        return $this->hasMany('App\Models\Admin', 'role_id');
    }
}
