<?php

namespace App\Repositories;



use App\Models\UserReal;

class UserRealRepository
{
    use BaseRepository;

    protected $model;


    public function __construct()
    {
        $this->model = new UserReal();
    }

    /**
     * 检查是否完成实名认证
     *
     * @param $user_id
     * @return bool
     */
    public function checkUserReal($user_id)
    {
        $ret = UserReal::where([['user_id',$user_id],['status',1]])->first();

        return !empty($ret) ? $ret : false;
    }
}