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
// | Date:2020-08-09
// | Description: 微信关键词回复
// +----------------------------------------------------------------------

namespace App\Modules\Backend\Http\Controllers\Weixin;

use App\Modules\Base\Http\Controllers\Backend;
use App\Repositories\WeixinKeywordRepository;
use Illuminate\Http\Request;

class KeywordController extends Backend
{

    protected $weixinKeyword;


    public function __construct(WeixinKeywordRepository $weixinKeyword)
    {
        parent::__construct();
        
        $this->weixinKeyword = $weixinKeyword;
    }

    public function lists(Request $request)
    {
        $title = '列表';
        $fixed_title = '关键词回复 - '. $title;

        $action_span = [
            [
                'url' => 'add',
                'icon' => 'fa-plus',
                'text' => '添加关键词'
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
        $where[] = ['shop_id', 0]; // 只获取平台的
        // 搜索条件
        $search_arr = ['key_name'];
        foreach ($search_arr as $v) {
            if (isset($params[$v]) && !empty($params[$v])) {

                if ($v == 'key_name') {
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
        list($list, $total) = $this->weixinKeyword->getList($condition);

        // 获取数据
        $pageHtml = pagination($total, false);

        $compact = compact('title', 'list', 'pageHtml','total');
        if ($request->ajax()) {
            $render = view('weixin.keyword.partials._list', $compact)->render();
            return result(0, $render);
        }
        
        return view('weixin.keyword.list', $compact);
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
            $model = $this->weixinKeyword->getById($id);
            view()->share('model', $model);
            $title = '编辑';
        }

        $fixed_title = '关键词回复 - '.$title;

        $action_span = [
            [
                'url' => 'list',
                'icon' => 'fa-reply',
                'text' => '返回关键词列表'
            ],
        ];

        $explain_panel = [];
        $blocks = [
            'explain_panel' => $explain_panel,
            'fixed_title' => $fixed_title,
            'action_span' => $action_span
        ];

        $this->setLayoutBlock($blocks); // 设置block

        // 获取数据
        $compact = compact('title', 'model');

        return view('weixin.keyword.add', $compact);
    }

    public function edit(Request $request)
    {
        return $this->add($request);
    }

    public function saveData(Request $request)
    {
        $post = $request->post('WeixinKeyword');

        if (!empty($post['id'])) {
            // 编辑
            $ret = $this->weixinKeyword->update($post['id'], $post);
            $msg = '关键词编辑';
        }else {
            // 添加
            $ret = $this->weixinKeyword->store($post);
            $msg = '关键词添加';
        }

        if ($ret === false) {
            // fail
            flash('error', $msg.'失败');
            return back();
        }
        // success
        flash('success', $msg.'成功');
        return redirect('/weixin/keyword/list');
    }

    public function changeType(Request $request)
    {
        $key_type = $request->get('key_type', 0);

        $render = view('weixin.keyword.change_type_'.$key_type, compact('key_type'))->render();

        return result(0,$render);
    }

    public function delete(Request $request)
    {
        $id = $request->post('id');
        $ret = $this->weixinKeyword->del($id);
        if ($ret === false) {
            // Log
            return result(-1, '', '删除失败');
        }

        // Log
        return result(0, '', '删除成功');
    }

   
}