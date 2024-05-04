<?php

namespace App\Models;


use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * 用户模型
 *
 * Class UserModel
 * @package App\Models
 */
//class User extends Authenticatable
class UserModel extends BaseModel
{
    use Notifiable;

    protected $table = 'user';

    protected $fillable = [
        'role_id', 'user_name', 'nickname', 'rank_id', 'rank_point', 'user_between', 'rank_start_time', 'rank_end_time', 'password', 'sex', 'birthday',
        'headimg', 'faceimg1', 'faceimg2',
        'address_now', //'address_code', todo
        'detail_address', 'mobile', 'email', 'status', 'shopping_status',
        'comment_status', 'user_money', 'user_money_limit', 'frozen_money', 'last_login', 'last_ip', 'reg_ip',
        'visit_count', 'is_real', 'reg_time', 'mobile_validated', 'email_validated', 'type', 'surplus_password',
        'pay_point',
        'frozen_point', // 冻结积分 todo
        'password_reset_token', 'auth_key', 'user_remark', 'salt', 'shop_id', 'store_id',
        'multi_store_id', // todo
        'is_seller', 'reg_from',
        'address_id', 'mobile_supplier', 'mobile_province', 'mobile_city', 'auth_codes',
        'qq_key', 'weibo_key', 'weixin_key','github_key',
//        'qq_info','weibo_info','weixin_info',
        'invite_code', 'parent_id', 'is_recommend',
        'customs_money', // todo

        'security_level' // 这个应该是算出来 不能存数据

        /*
         * 新加字段
         * rank_point
         * address_now 相当于address_code 不用再加
         * faceimg1
         * faceimg2
         * store_id
         * address_id 默认收货地址id？？
         * mobile_supplier 中国移动
         * mobile_province 河北
         * mobile_city 秦皇岛
         * auth_codes “all” 感觉是店铺权限  普通会员此字段是“”
         *
         *
         * todo --字段待定--
         * "company_name": null,
            "company_region_code": null,
            "company_address": null,
            "purpose_type": null,
            "referral_mobile": null,
            "employees": null,
            "industry": null,
            "nature": null,
            "contact_name": null,
            "department": null,
            "company_tel": null,
            todo --字段待定--

            "qq_key": "",
            "weibo_key": "",
            "weixin_key": "",
            "invite_code": "M7C3",
            "parent_id": 0,
            "is_recommend": 0
         */
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

    protected $hidden = [ 'password', 'remember_token', ];

//    const CREATED_AT = 'reg_time';

//    public function getBirthdayAttribute($value)
//    {
//        return $this->attributes['birthday'] = strtotime($value);
//    }

    public function shopRole()
    {
        return $this->belongsTo(ShopRole::class, 'role_id', 'role_id');
    }

    /**
     * 一对一关联 会员实名认证表
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function userReal()
    {
        return $this->hasOne(UserReal::class, 'user_id', 'user_id');
    }

    public function shop()
    {
        return $this->hasOne(Shop::class, 'shop_id', 'shop_id');
    }

    public function store()
    {
        return $this->hasOne(Store::class, 'user_id', 'user_id');
    }
}
