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
        $subsite_domain = request()->getScheme().'://'.config('lrw.frontend_domain');
        return redirect($subsite_domain);
    }

    public function change()
    {

        return view('subsite.change');
    }

    /**
     * 站点选择弹出框
     *
     * @param Request $request
     * @return array|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     * @throws \Throwable
     */
    public function selector(Request $request)
    {
        $site_id = 1;
        $site_name = '北京站';
        $site_list = [];
        $site_letters = [
            "B"
        ];
        if (is_app()) {
            $data = [
                'site_id' => $site_id,
                'site_name' => $site_name,
                'site_list' => $site_list,
                'site_letters' => $site_letters
            ];
            return result(0,$data);
        } else {
            $compact = compact('site_id','site_name','site_list','site_letters');
            $render = view('subsite.selector', $compact)->render();
            return result(0, $render);
        }
    }

}