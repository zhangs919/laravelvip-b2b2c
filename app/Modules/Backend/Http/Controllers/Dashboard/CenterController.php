<?php

namespace App\Modules\Backend\Http\Controllers\Dashboard;


use App\Modules\Base\Http\Controllers\Backend;

class CenterController extends Backend
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

        return view('dashboard.center.index', compact('title'));
    }

}