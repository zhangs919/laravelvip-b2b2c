<?php

namespace app\Modules\Backend\Http\Controllers\Oauth;


use App\Modules\Base\Http\Controllers\Backend;
use App\Repositories\PaymentRepository;
use App\Repositories\ToolsRepository;
use Illuminate\Http\Request;

class OauthController extends Backend
{
//    private $title;



    public function __construct()
    {
        parent::__construct();

    }


    public function index()
    {
        $title = '对接周边系统';
        $fixed_title = $title;

        $action_span = [];
        $explain_panel = [];
        $blocks = [
            'fixed_title' => $fixed_title,
            'action_span' => $action_span,
            'explain_panel' => $explain_panel,
        ];
        $this->setLayoutBlock($blocks); // 设置block

        return view('oauth.oauth.index', compact('title'));
    }

    public function toOauth(Request $request)
    {
        $type = $request->get('type');

        $render = view('oauth.oauth.to_oauth')->render();

        return result(0, $render);
    }

    public function delOauth(Request $request)
    {

        return result(0, '取消对接');
    }
}