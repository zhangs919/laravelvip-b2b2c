<?php

namespace App\Modules\Mobile\Http\Controllers;

use App\Modules\Base\Http\Controllers\Mobile;
use Illuminate\Http\Request;

class IndexController extends Mobile
{

    protected $goods; // 商品模型

    protected $cart;


    public function __construct()
    {
        parent::__construct();


    }

    /**
     * 高德地图查看详情
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function amap(Request $request)
    {
        $dest = $request->get('dest', '');
        $title = $request->get('title', '');

        return view('index.information.amap', compact('dest', 'title'));
   }
}