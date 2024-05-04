<?php

namespace App\Modules\Backend\Http\Controllers\App;


use App\Modules\Base\Http\Controllers\Backend;
use Illuminate\Http\Request;

class StorePushMessageController extends Backend
{

    private $links = [
        ['url' => 'app/store-push-message/index', 'text' => '消息推送'],
        ['url' => 'system/config/index?group=store_app_push', 'text' => '推送设置'],
    ];

    public function __construct()
    {
        parent::__construct();
    }

    public function index(Request $request)
    {
        $title = '消息推送';

        $action_span = [];
        $explain_panel = [
            '使用前提：请确认“推送设置”已配置完成，否则推送无作用',
            '推送作用： 用于平台方向APP用户实时发送消息',
            '提醒方式：手机系统通知栏提示和APP应用中“消息”模块未读提醒',
        ];
        $this->sublink($this->links, 'index', 'group');

        $fixed_title = '消息推送 - '.$title;

        $blocks = [
            'explain_panel' => $explain_panel,
            'fixed_title' => $fixed_title,
            'action_span' => $action_span
        ];

        $this->setLayoutBlock($blocks); // 设置block

        if ($request->method() == 'POST') {
            $pushMessageModel = $request->input('PushMessageModel');

            return result(0, null, '推送成功');
        }

        $compact = compact('title');
        return view('app.seller-push-message.index', $compact);
    }



}