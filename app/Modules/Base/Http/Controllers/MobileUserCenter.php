<?php

namespace App\Modules\Base\Http\Controllers;



class MobileUserCenter extends Mobile
{

    public function __construct()
    {
        parent::__construct();

//        $this->load_helper('');

        // 用户中心 所有页面需要登录
        $this->middleware('auth.user:user');

    }




}