<?php

namespace App\Modules\Frontend\Http\Controllers\User;

use App\Modules\Base\Http\Controllers\UserCenter;
use Illuminate\Http\Request;

class SecurityController extends UserCenter
{

    public function __construct()
    {
        parent::__construct();


    }

    public function security(Request $request)
    {
        $seo_title = '用户中心';

        $compact = compact('seo_title');

        return view('user.security.security', $compact);
    }


}