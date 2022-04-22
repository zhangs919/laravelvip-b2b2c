<?php

namespace App\Modules\Frontend\Http\Controllers\User;

use App\Modules\Base\Http\Controllers\UserCenter;
use Illuminate\Http\Request;

class BindController extends UserCenter
{

    public function __construct()
    {
        parent::__construct();


    }

    public function index(Request $request)
    {
        $seo_title = '用户中心';

        $compact = compact('seo_title');

        return view('user.bind.index', $compact);
    }


}