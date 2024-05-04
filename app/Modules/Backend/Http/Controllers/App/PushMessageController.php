<?php

namespace App\Modules\Backend\Http\Controllers\App;


use App\Modules\Base\Http\Controllers\Backend;
use App\Services\UniPushService;
use Illuminate\Http\Request;

class PushMessageController extends Backend
{

    private $links = [
        ['url' => 'app/push-message/index', 'text' => '消息推送'],
        ['url' => 'system/config/index?group=app_push', 'text' => '推送设置'],
    ];

    public function __construct()
    {
        parent::__construct();
    }

    public function index(Request $request)
    {
        $title = '消息推送';

        $from = $request->get('from'); // dashboard
        $type = $request->get('type'); // 5-定向运营

        $action_span = [];
        if ($from == 'dashboard' && $type == 5) {
            $title = '定向运营';
            $action_span[] = [
                'url' => '/dashboard/customer-analysis/index',
                'icon' => 'fa-reply',
                'text' => '返回客户分析'
            ];
            $action_span[] = [
                'url' => '/dashboard/customer-analysis/sales',
                'icon' => 'fa-reply',
                'text' => '返回智能营销'
            ];

            $explain_panel = [];
            $action = "/app/push-message/index?from={$from}&type={$type}&group_id=";
        } else {
            $explain_panel = [
                '使用前提：请确认“推送设置”已配置完成，否则推送无作用',
                '推送作用： 用于平台方向APP用户实时发送消息',
                '提醒方式：手机系统通知栏提示和APP应用中“消息”模块未读提醒',
            ];
            $this->sublink($this->links, 'index', 'group');
            $action = "/app/push-message/index";
        }

        $fixed_title = '消息推送 - '.$title;

        $blocks = [
            'explain_panel' => $explain_panel,
            'fixed_title' => $fixed_title,
            'action_span' => $action_span
        ];

        $this->setLayoutBlock($blocks); // 设置block

        if ($request->method() == 'POST') {
            $model = $request->input('PushMessageModel');
            $select_sku_id = $request->input('select_sku_id');

            $uniPushService = new UniPushService();

            if ($model['target_type'] == 'all') {
                $params = [
                    'title' => $model['title'],
                    'body' => $model['content'],
                    'click_type' => 'none',
//                    'big_text' => '乐融沃',
                ];
                $res = $uniPushService->pushAll($params);

            } else {
                // 按设备别名
                $alia_list = $model['target_text'];
                if (empty($alia_list)) {
                    return result(-1, null, '设备别名不能为空');
                }
                $alia_list = explode(',', $alia_list);
                $params = [
                    'is_async' => false,
                    'task_id' => '', //
                    'title' => $model['title'],
                    'body' => $model['content'],
                    'alias_list' => $alia_list,
                    'click_type' => 'none',
                    'platforms' => $model['platforms']
                ];
                $res = $uniPushService->pushListByAlias($params);
            }
            if ($res['code'] != 0) {
                return result(-1, $res['data'], $res['msg']);
            }

            return result(0, $res['data'], '推送成功');
        }

        $compact = compact('title','from','type','action');
        return view('app.push-message.index', $compact);
    }



}