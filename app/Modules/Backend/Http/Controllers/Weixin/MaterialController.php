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
// | Description: 微信素材回复
// +----------------------------------------------------------------------

namespace App\Modules\Backend\Http\Controllers\Weixin;

use App\Modules\Base\Http\Controllers\Backend;
use App\Repositories\WeixinMaterialGroupRepository;
use App\Repositories\WeixinMaterialRepository;
use Illuminate\Http\Request;

class MaterialController extends Backend
{

    private $links = [
        ['url' => 'weixin/material/list', 'text' => '单图文素材'],
        ['url' => 'weixin/material/more-list', 'text' => '多图文素材'],
    ];

    private $add_links = [
        ['url' => 'weixin/material/list', 'text' => '单图文素材'],
        ['url' => 'weixin/material/add', 'text' => '添加'],
        ['url' => 'weixin/material/edit', 'text' => '编辑'],
    ];

    private $more_add_links = [
        ['url' => 'weixin/material/more-list', 'text' => '多图文素材'],
        ['url' => 'weixin/material/more-add', 'text' => '添加'],
        ['url' => 'weixin/material/more-edit', 'text' => '编辑'],
    ];

    protected $weixinMaterial;
    protected $weixinMaterialGroup;


    public function __construct(WeixinMaterialRepository $weixinMaterial, WeixinMaterialGroupRepository $weixinMaterialGroup)
    {
        parent::__construct();
        
        $this->weixinMaterial = $weixinMaterial;
        $this->weixinMaterialGroup = $weixinMaterialGroup;
    }

    public function lists(Request $request)
    {
        $title = '列表';
        $fixed_title = '微信素材 - '. $title;

        $this->sublink($this->links, 'list');

        $action_span = [
            [
                'url' => 'add',
                'icon' => 'fa-plus',
                'text' => '添加单图文素材'
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
        $where[] = ['type', 0]; // 单图文
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
        list($list, $total) = $this->weixinMaterialGroup->getList($condition);

        // 获取数据
        $pageHtml = pagination($total, false);

        $compact = compact('title', 'list', 'pageHtml','total');
        if ($request->ajax()) {
            $render = view('weixin.material.partials._list', $compact)->render();
            return result(0, $render);
        }
        
        return view('weixin.material.list', $compact);
    }

    public function add(Request $request)
    {
        $title = '添加';

        $this->sublink($this->add_links, 'add','','','edit');

        $id = $request->get('id', 0);

        $info = [];
        if ($id) {
            // 更新操作
            $this->sublink($this->add_links, 'edit','','','add');

            $info = $this->weixinMaterialGroup->getInfo($id);
            view()->share('info', $info);
            $title = '编辑';
        }

        $fixed_title = '微信素材 - '.$title;

        $action_span = [
            [
                'url' => 'list',
                'icon' => 'fa-reply',
                'text' => '返回单图文素材列表'
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
        $compact = compact('title', 'info');

        return view('weixin.material.add', $compact);
    }

    public function edit(Request $request)
    {
        return $this->add($request);
    }

    public function saveData(Request $request)
    {
        $post = $request->post('MaterialModel');
        $id = $request->post('id');
        if ($id) {
            // 编辑
            $ret = $this->weixinMaterialGroup->modifyData($id, $post);
            $msg = '素材编辑';
        }else {
            // 添加
            $ret = $this->weixinMaterialGroup->addData($post);
            $msg = '素材添加';
        }

        if ($ret === false) {
            // fail
            return result(-1, null, $msg.'失败');
        }
        // success
        return result(0, null, $msg.'成功');
    }


    public function moreLists(Request $request)
    {
        $title = '列表';
        $fixed_title = '微信素材 - '. $title;

        $this->sublink($this->links, 'more-list');

        $action_span = [
            [
                'url' => 'more-add',
                'icon' => 'fa-plus',
                'text' => '添加多图文素材'
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
        $where[] = ['type', 1]; // 多图文

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
        list($list, $total) = $this->weixinMaterialGroup->getList($condition);
        // 获取数据
        $pageHtml = pagination($total, false);

        $compact = compact('title', 'list', 'pageHtml','total');
        if ($request->ajax()) {
            $render = view('weixin.material.partials._more_list', $compact)->render();
            return result(0, $render);
        }

        return view('weixin.material.more_list', $compact);
    }

    public function moreAdd(Request $request)
    {
        $title = '添加';

        $this->sublink($this->more_add_links, 'more-add','','','more-edit');

        $id = $request->get('id', 0);

        if ($id) {
            // 更新操作
            $this->sublink($this->more_add_links, 'more-edit','','','more-add');

            $info = $this->weixinMaterialGroup->getInfo($id);
            view()->share('info', $info);

            // data json
            $dataJson = $info->items;
            view()->share('dataJson', json_encode($dataJson));

            $title = '编辑';
        }

        $fixed_title = '微信素材 - '.$title;

        $action_span = [
            [
                'url' => 'more-list',
                'icon' => 'fa-reply',
                'text' => '返回多图文素材列表'
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
        $compact = compact('title');

        return view('weixin.material.more_add', $compact);
    }

    public function moreEdit(Request $request)
    {
        return $this->moreAdd($request);
    }

    public function saveMoreData(Request $request)
    {
        $post = $request->post('data');
        $id = $request->get('id');
        if ($id) {
            // 编辑
            $ret = $this->weixinMaterialGroup->modifyData($id, $post, 1);
            $msg = '素材编辑';
        }else {
            // 添加
            $ret = $this->weixinMaterialGroup->addData($post, 1);
            $msg = '素材添加';
        }

        if ($ret === false) {
            // fail
            return result(-1, null, $msg.'失败');
        }
        // success
        return result(0, null, $msg.'成功');
    }


    public function delete(Request $request)
    {
        $id = $request->post('id');
        $ret = $this->weixinMaterial->del($id);
        if ($ret === false) {
            // Log
            return result(-1, '', '删除失败');
        }

        // Log
        return result(0, '', '删除成功');
    }

   
}