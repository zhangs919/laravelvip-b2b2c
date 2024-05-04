<?php

namespace App\Modules\Seller\Http\Controllers\Dashboard;


use App\Modules\Base\Http\Controllers\Seller;

class CenterController extends Seller
{



    public function __construct()
    {
        parent::__construct();

    }


    public function index()
    {
        $title = '营销中心';
        $fixed_title = $title;

        $action_span = [];
        $explain_panel = [];
        $blocks = [
            'fixed_title' => $fixed_title,
            'action_span' => $action_span,
            'explain_panel' => $explain_panel,
        ];
        $this->setLayoutBlock($blocks); // 设置block

        $shop_id = seller_shop_info()->shop_id;
        $shop_auth = !empty(shopconf('shop_auth', false, $shop_id)) ? unserialize(shopconf('shop_auth', false, $shop_id)) : []; // 店铺营销权限

        return view('dashboard.center.index', compact('title', 'shop_auth'));
    }

}