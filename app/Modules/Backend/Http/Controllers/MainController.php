<?php

namespace App\Modules\Backend\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Base\Http\Controllers\Backend;
use Illuminate\Http\Request;

class MainController extends Backend
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index(Request $request)
    {
        $title = sysconf('site_name').'平台管理中心';
        return view('layouts.iframe_layout', compact('title'));
    }
}