<?php

namespace App\Models;


use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Seller extends Authenticatable
//class User extends BaseModel
{
    use Notifiable;

    protected $table = 'user';

    protected $fillable = [
        'user_name', 'nickname', 'rank_id', 'user_between', 'rank_start_time', 'rank_end_time', 'password', 'sex', 'birthday',
        'headimg', 'address_code', 'detail_address', 'mobile', 'email', 'status', 'shopping_status',
        'comment_status', 'user_money', 'user_money_limit', 'last_login', 'last_ip', 'reg_ip',
        'visit_count', 'is_real', 'reg_time', 'mobile_validated', 'email_validated', 'type', 'surplus_password',
        'pay_point', 'password_reset_token', 'auth_key', 'user_remark', 'salt', 'is_seller', 'reg_source'
    ];

    protected $hidden = [
        'password' => 'remember_token',
    ];

    protected $primaryKey = 'user_id';

    /**
     * 应被转化为日期的属性
     * @var array
     */
    protected $dates = [
        'birthday',
        'rank_start_time',
        'rank_end_time'
    ];

    const CREATED_AT = 'reg_time';

//    public function getBirthdayAttribute($value)
//    {
//        return $this->attributes['birthday'] = strtotime($value);
//    }
}
