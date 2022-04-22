<?php

namespace App\Modules\Frontend\Http\Controllers;

use App\Modules\Base\Http\Controllers\Frontend;
use Illuminate\Http\Request;

class SubSiteController extends Frontend
{



    public function __construct()
    {
        parent::__construct();


    }

    public function index(Request $request)
    {
        $site_id = $request->get('site_id');
        // todo 获取站点信息
        $subsite_info = [];
        $subsite_domain = __HTTP__.env('FRONTEND_DOMAIN');
        return redirect($subsite_domain);
    }

}