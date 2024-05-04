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
// | Description: 微信自定义菜单
// +----------------------------------------------------------------------

namespace App\Modules\Backend\Http\Controllers\Weixin;

use App\Modules\Base\Http\Controllers\Backend;
use App\Repositories\WeixinMenuRepository;
use Illuminate\Http\Request;

class MenuController extends Backend
{

    protected $weixinMenu;


    public function __construct(WeixinMenuRepository $weixinMenu)
    {
        parent::__construct();
        
        $this->weixinMenu = $weixinMenu;

    }

    public function lists(Request $request)
    {
        $title = '列表';
        $fixed_title = '微信菜单 - '.$title;

        $action_span = [
            [
                'url' => 'add',
                'icon' => 'fa-plus',
                'text' => '添加自定义菜单'
            ],
        ];

        $explain_panel = [
            '微信菜单一共是两级菜单，一级菜单不能多于3个，字数不能超过5个字',
            '每个一级菜单下不能多于5个二级菜单，二级菜单字数不能超过7个字，添加菜单时，请不要超出规定',
            '自定义菜单“客服”功能，需要点击“客服”自定义菜单后方可与客服人员沟通，如未点击菜单，消息显示为微信公众号粉丝留言中',
            '创建自定义菜单后，需点击下方“同步到微信”按钮，实时同步修改。如微信未更新菜单，建议微信中取消关注微信公众号，再次关注，则可看到最新菜单',
        ];
        $blocks = [
            'explain_panel' => $explain_panel,
            'fixed_title' => $fixed_title,
            'action_span' => $action_span
        ];

        $this->setLayoutBlock($blocks); // 设置block

        $params = $request->all();

        $where = [];
        $where[] = ['shop_id', 0];
        // 搜索条件
        $search_arr = ['menu_name'];
        foreach ($search_arr as $v) {
            if (isset($params[$v]) && !empty($params[$v])) {

                if ($v == 'menu_name') {
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
        list($list, $total) = $this->weixinMenu->getList($condition, '', true);

        // 获取数据
        $pageHtml = pagination($total, false);

        $compact = compact('title', 'list', 'pageHtml','total');
        if ($request->ajax()) {
            $render = view('weixin.menu.partials._list', $compact)->render();
            return result(0, $render);
        }

        return view('weixin.menu.list', $compact);
    }

    public function add(Request $request)
    {
        $title = '添加';

        $id = $request->get('id', 0);
        $parent_id = $request->get('parent_id', 0);

        $model = [
            'menu_sort' => 255,
            'appid' => '', // todo 小程序appid 默认获取平台的小程序appid
            'pagepath' => '', // /pages/index/index?return_url=https://m.lrw.com/mn7axs7/shop/511.html
            'menu_link' => '', // https://m.lrw.com/mn7axs7/shop/511.html
            'menu_value' => '1',
            'parent_id' => 0,
            'menu_type' => 0
        ];
        if ($id) {
            // 更新操作
            $model = $this->weixinMenu->getById($id);
            $parent_id = $model->parent_id;
            view()->share('model', $model);
            $title = '编辑';
        }

        $fixed_title = '微信自定义菜单 - '.$title;

        $action_span = [
            [
                'url' => 'list',
                'icon' => 'fa-reply',
                'text' => '返回自定义菜单列表'
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
        // 一级分类列表
        $where = [];
        $where[] = ['shop_id', 0];
        $where[] = ['parent_id', 0]; // 只获取一级分类
        $condition = [
            'where' => $where,
            'sortname' => 'id',
            'sortorder' => 'asc',
            'limit' => 0
        ];
        list($menu_list, $total) = $this->weixinMenu->getList($condition);

        $compact = compact('title', 'model', 'parent_id', 'menu_list');

        return view('weixin.menu.add', $compact);
    }

    public function edit(Request $request)
    {
        return $this->add($request);
    }

    public function saveData(Request $request)
    {
        $post = $request->post('WeixinMenu');

        if ($post['parent_id'] > 0) {
            $post['menu_level'] = 2;
        }
        if (!empty($post['id'])) {
            // 编辑
            $ret = $this->weixinMenu->update($post['id'], $post);
            $msg = '微信自定义菜单编辑';
        }else {
            // 添加
            $ret = $this->weixinMenu->store($post);
            $msg = '微信自定义菜单添加';
        }

        if ($ret === false) {
            // fail
            flash('error', $msg.'失败');
            return back();
        }
        // success
        flash('success', $msg.'成功');
        return redirect('/weixin/menu/list');
    }

    public function changeType(Request $request)
    {
        $menu_type = $request->get('menu_type', 0);

        $render = view('weixin.menu.change_type_'.$menu_type, compact('menu_type'))->render();

        return result(0,$render);
    }

    public function changeSort(Request $request)
    {
        $ret = $this->weixinMenu->editSort($request);
        if ($ret === false) {
            return result(-1, '', '设置失败');
        }
        return result(0, '', '设置成功');
    }

    /**
     * 同步自定义菜单到微信
     *
     * @param Request $request
     * @return array|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function syncToWeixin(Request $request)
    {
        // 判断是否对接微信
        if (!sysconf('appid')
            || !sysconf('appsecret')) {
            return result(-1, null, '请先对接微信');
        }

        // 调用微信接口 同步菜单
        $ret = $this->weixinMenu->syncToWeixin();
        if (!empty($ret['errcode'])) {
            return result(-1, null, $ret['errmsg']);
        }

        return result(0, null, '同步成功');
    }

    public function delete(Request $request)
    {
        $id = $request->post('id');
        $ret = $this->weixinMenu->del($id);
        if ($ret === false) {
            // Log
            return result(-1, '', '删除失败');
        }

        // Log
        return result(0, '', '删除成功');
    }

   
}