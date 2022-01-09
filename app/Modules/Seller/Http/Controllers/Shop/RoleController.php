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
// | Date:2018-10-22
// | Description: 店铺角色管理
// +----------------------------------------------------------------------

namespace app\Modules\Seller\Http\Controllers\Shop;

use App\Models\ShopNode;
use App\Modules\Base\Http\Controllers\Seller;
use App\Repositories\ShopRoleRepository;
use App\Services\Tree;
use Illuminate\Http\Request;

class RoleController extends Seller
{
    private $links = [
        ['url' => 'shop/account/admin_list', 'text' => '管理员列表'],
        ['url' => 'shop/role/role_list', 'text' => '角色列表'],
        ['url' => 'shop/role/add', 'text' => '添加角色'],
        ['url' => 'shop/role/edit', 'text' => '编辑角色'],
    ];

    protected $tree;

    protected $shop_role;

    public function __construct()
    {
        parent::__construct();

        $this->tree = new Tree();
        $this->shop_role = new ShopRoleRepository();

        $this->set_menu_select('account', 'shop-account');
    }

    public function lists(Request $request)
    {
        $title = '角色列表';
        $fixed_title = '帐号管理 - 角色列表';
        $this->sublink($this->links, 'role_list', '', '', 'add,edit');
        $action_span = [
            [
                'url' => 'add',
                'icon' => 'fa-plus',
                'text' => '创建角色'
            ],
        ];
        $explain_panel = [
            '正在使用中的角色不可进行删除操作'
        ];
        $blocks = [
            'explain_panel' => $explain_panel,
            'fixed_title' => $fixed_title,
            'action_span' => $action_span
        ];
        $this->setLayoutBlock($blocks); // 设置block

        $params = $request->all();
        $where = [];
        // 搜索条件
        $search_arr = ['role_name'];
        foreach ($search_arr as $v) {
            if (isset($params[$v]) && !empty($params[$v])) {

                if ($v == 'role_name') {
                    $where[] = [$v, 'like', "%{$params[$v]}%"];
                } else {
                    $where[] = [$v, $params[$v]];
                }
            }
        }
        // 列表
        $condition = [
            'where' => $where,
            'sortname' => 'role_id',
            'sortorder' => 'asc'
        ];
        list($list, $total) = $this->shop_role->getList($condition);
        $pageHtml = pagination($total);

        $compact = compact('title', 'list', 'total', 'pageHtml');
        if ($request->ajax()) {
            $render = view('shop.role.partials._list', $compact)->render();
            return result(0, $render);
        }
        return view('shop.role.list', $compact);
    }

    public function add(Request $request)
    {
        $title = '添加角色';
        $this->sublink($this->links, 'add', '', '', 'edit');

        $id = $request->get('role_id', 0);
        $auth_codes = [];
        if ($id) {
            // 更新操作
            $title = '编辑角色';
            $this->sublink($this->links, 'edit', '', '', 'add');
            $info = $this->shop_role->getById($id);
            view()->share('info', $info);
            //解析已有权限
//            $auth_codes = unserialize(backend_decrypt($info->auth_codes, MD5_KEY.md5($info->role_name)));
            $auth_codes = unserialize(backend_decrypt($info->auth_codes, MD5_KEY));

            if (!$auth_codes) {
                $auth_codes = [];
            }
        }

        $fixed_title = '帐号管理 - '.$title;

        $action_span = [
            [
                'url' => 'list',
                'icon' => 'fa-reply',
                'text' => '返回角色列表'
            ]
        ];
        $explain_panel = [];
        $blocks = [
            'fixed_title' => $fixed_title,
            'action_span' => $action_span,
            'explain_panel' => $explain_panel
        ];
        $this->setLayoutBlock($blocks); // 设置block

        $nodes = ShopNode::orderBy('id', 'asc')->get()->toArray();
        $nodes = $this->tree->list_to_tree($nodes, 'id', 'parent_node_id');


        return view('shop.role.add', compact('title','nodes', 'auth_codes'));
    }

    public function edit(Request $request)
    {
        return $this->add($request);
    }

    public function saveData(Request $request)
    {
        $post = $request->post('ShopRoleModel');

        $permission = $request->post('role_auths');

        if (!empty($post['role_id'])) {
            // 编辑
//            $auth_info = $this->shop_role->getById($post['role_id']);
//            $post['auth_codes'] = backend_encrypt(serialize($permission),MD5_KEY.md5($auth_info->role_name));
            $post['auth_codes'] = backend_encrypt(serialize($permission),MD5_KEY);
            $ret = $this->shop_role->update($post['role_id'], $post);
            $msg = '角色编辑';
        }else {
            // 添加
//            $post['auth_codes'] = backend_encrypt(serialize($permission),MD5_KEY.md5($post['role_name']));
            $post['auth_codes'] = backend_encrypt(serialize($permission),MD5_KEY);
            $post['role_type'] = 1; // 角色类型 1店铺管理员 2网点管理员
            $ret = $this->shop_role->store($post);
            $msg = '角色添加';
        }

        if ($ret === false) {
            // fail
            return result(-1, '', $msg.'失败');
        }
        // success
        return result(0, '', $msg.'成功');
    }

    public function delete(Request $request)
    {
        $id = $request->get('id');
        $ret = $this->shop_role->del($id);
        if ($ret === false) {
            // Log
            shop_log('角色删除失败。ID：'.$id);
            return result(-1, '', '删除失败');
        }

        // Log
        shop_log('角色删除成功。ID：'.$id);
        return result(0, '', '删除成功');
    }
}