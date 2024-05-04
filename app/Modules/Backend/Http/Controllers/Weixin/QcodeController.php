<?php

// +----------------------------------------------------------------------
// | laravelvip 乐融沃B2B2C商城系统
// +----------------------------------------------------------------------
// | Copyright (c) 2017-2027 http://www.laravelvip.com All rights reserved.
// +----------------------------------------------------------------------
// | Notice: This code is not open source, it is strictly prohibited
// |         to distribute the copy, otherwise it will pursue its
// |         legal responsibility.
// +----------------------------------------------------------------------
// | 版权所有 2015-2027 云南乐融沃网络科技有限公司，并保留所有权利。
// | 网站地址: http://www.laravelvip.com
// +----------------------------------------------------------------------
// | 这不是一个自由软件！禁止拷贝本软件副本，否则将追究其法律责任！
// | 如需使用，请移步官网购买正版授权。
// +----------------------------------------------------------------------
// | Author: 雲溪荏苒 <290648237@qq.com>
// | Date:2021-06-20
// | Description: 二维码管理
// +----------------------------------------------------------------------

namespace App\Modules\Backend\Http\Controllers\Weixin;

use App\Models\Qcode;
use App\Modules\Base\Http\Controllers\Backend;
use App\Repositories\QcodeRepository;
use App\Services\WechatSDKService;
use Illuminate\Http\Request;

class QcodeController extends Backend
{

    protected $qcode;


    public function __construct(QcodeRepository $qcode)
    {
        parent::__construct();

        $this->qcode = $qcode;
    }

    public function lists(Request $request)
    {
        $title = '列表';
        $fixed_title = '二维码管理 - '. $title;

        $action_span = [
            [
                'url' => 'add',
                'icon' => 'fa-plus',
                'text' => '添加二维码'
            ],
        ];

        $explain_panel = [];
        $blocks = [
            'explain_panel' => $explain_panel,
            'fixed_title' => $fixed_title,
            'action_span' => $action_span
        ];

        $this->setLayoutBlock($blocks); // 设置block

        $params = $request->all();

        $where = [];
        // 搜索条件
        $search_arr = ['qcode_type','qcode_content'];
        foreach ($search_arr as $v) {
            if (isset($params[$v]) && !empty($params[$v])) {

                if ($v == 'qcode_content') {
                    $where[] = [$v, 'like', "%{$params[$v]}%"];
                } else {
                    $where[] = [$v, $params[$v]];
                }
            }
        }
        // 列表
        $condition = [
            'where' => $where,
            'sortname' => 'id',
            'sortorder' => 'asc',
        ];
        list($list, $total) = $this->qcode->getList($condition);

        // 获取数据
        $pageHtml = pagination($total, false);

        $compact = compact('title', 'list', 'pageHtml','total');
        if ($request->ajax()) {
            $render = view('weixin.qcode.partials._list', $compact)->render();
            return result(0, $render);
        }

        return view('weixin.qcode.list', $compact);
    }

    public function add(Request $request)
    {
        $title = '添加';

        $id = $request->get('id', 0);

        $model = [
            'key_type' => 0
        ];
        if ($id) {
            // 更新操作
            $model = $this->qcode->getById($id);
            view()->share('model', $model);
            $title = '编辑';
        }

        $fixed_title = '二维码管理 - '.$title;

        $action_span = [
            [
                'url' => 'list',
                'icon' => 'fa-reply',
                'text' => '返回列表'
            ],
        ];

        $explain_panel = [
            '可以根据您的需要，为商城商品、文章生成永久二维码，生成后用户使用微信扫描后，会收到商品、文章的详细信息'
        ];
        $blocks = [
            'explain_panel' => $explain_panel,
            'fixed_title' => $fixed_title,
            'action_span' => $action_span
        ];

        $this->setLayoutBlock($blocks); // 设置block

        // 获取数据
        $compact = compact('title', 'model');

        return view('weixin.qcode.add', $compact);
    }

    public function edit(Request $request)
    {
        return $this->add($request);
    }

    public function saveData(Request $request)
    {
        $post = $request->post('QcodeModel');

        // 生成微信二维码
        $sceneValue = Qcode::getSceneValue($post['qcode_content'], $post['qcode_type']); // 场景值 具体的url 如商品详情页url
		$wechatSDKService = new WechatSDKService();
		$response = $wechatSDKService->getQRCode($sceneValue, 3, 6 * 24 * 3600); // 临时二维码 6天 最长30天

        if (!empty($response['ticket'])) {
            $post['qcode'] = $response['ticket'];
        }
        if (!empty($post['id'])) {
            // 编辑
            $ret = $this->qcode->update($post['id'], $post);
            $msg = '二维码编辑';
        }else {
            // 添加
            $ret = $this->qcode->store($post);
            $msg = '二维码添加';
        }

        if ($ret === false) {
            // fail
            flash('error', $msg.'失败');
            return back();
        }
        // success
        flash('success', $msg.'成功');
        return redirect('/weixin/qcode/list');
    }

    public function delete(Request $request)
    {
        $id = $request->post('id');
        $ret = $this->qcode->del($id);
        if ($ret === false) {
            // Log
            return result(-1, '', '删除失败');
        }

        // Log
        return result(0, '', '删除成功');
    }


}
