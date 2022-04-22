<?php

namespace app\Modules\Backend\Http\Controllers\System;


use App\Models\AdminNode;
use App\Models\AdminRole;
use App\Modules\Base\Http\Controllers\Backend;
use App\Repositories\AdminRoleRepository;
use App\Services\Tree;
use Illuminate\Http\Request;

class RoleController extends Backend
{
    private $links = [
        ['url' => 'system/admin/admin_list', 'text' => '管理员列表'],
        ['url' => 'system/role/role_list', 'text' => '角色列表'],
    ];

    protected $tree;

    protected $admin_role;

    public function __construct(Tree $tree, AdminRoleRepository $adminRole)
    {
        parent::__construct();

        $this->tree = $tree;
        $this->admin_role = $adminRole;
    }

    public function lists(Request $request)
    {
        $title = '角色列表';
        $fixed_title = '管理员设置 - 角色列表';
        $this->sublink($this->links, 'role_list');
        $action_span = [
            [
                'url' => 'add',
                'icon' => 'fa-plus',
                'text' => '创建角色'
            ],
        ];
        $blocks = [
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
            'sortname' => 'sort',
            'sortorder' => 'asc'
        ];
        list($list, $total) = $this->admin_role->getList($condition);
        $pageHtml = pagination($total);

        $compact = compact('title', 'list', 'total', 'pageHtml');
        if ($request->ajax()) {
            $render = view('system.role.partials._list', $compact)->render();
            return result(0, $render);
        }
        return view('system.role.list', $compact);
    }

    public function add(Request $request)
    {
        $title = '添加角色';

        $id = $request->get('role_id', 0);
        $auth_codes = [];
        if ($id) {
            // 更新操作
            $title = '编辑角色';
            $info = $this->admin_role->getById($id);
            view()->share('info', $info);
            //解析已有权限
//            $auth_codes = unserialize(backend_decrypt($info->auth_codes, MD5_KEY.md5($info->role_name)));
            $auth_codes = unserialize(backend_decrypt($info->auth_codes, MD5_KEY));

            if (!$auth_codes) {
                $auth_codes = [];
            }
        }

        $fixed_title = '管理员设置 - '.$title;

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

        $nodes = AdminNode::orderBy('id', 'asc')->get()->toArray();
        $nodes = $this->tree->list_to_tree($nodes, 'id', 'parent_node_id');


        return view('system.role.add', compact('title','nodes', 'auth_codes'));
    }

    public function edit(Request $request)
    {
        return $this->add($request);
    }

    public function saveData(Request $request)
    {
        $post = $request->post('RoleModel');

        $permission = $request->post('auth_codes');


        if (!empty($post['role_id'])) {
            // 编辑
            $auth_info = $this->admin_role->getById($post['role_id']);
//            $post['auth_codes'] = backend_encrypt(serialize($permission),MD5_KEY.md5($auth_info->role_name));
            $post['auth_codes'] = backend_encrypt(serialize($permission),MD5_KEY);
            $ret = $this->admin_role->update($post['role_id'], $post);
            $msg = '角色编辑';
        }else {
            // 添加
//            $post['auth_codes'] = backend_encrypt(serialize($permission),MD5_KEY.md5($post['role_name']));
            $post['auth_codes'] = backend_encrypt(serialize($permission),MD5_KEY);
            $ret = $this->admin_role->store($post);
            $msg = '角色添加';
        }

        if ($ret === false) {
            // fail
            return result(-1, null, $msg.'失败');
        }
        // success
        return result(0, null, $msg.'成功');
    }

    /**
     * 名称验证是否重复
     *
     * @param Request $request
     * @return mixed
     */
    public function clientValidate(Request $request)
    {
        $result = $this->admin_role->clientValidate($request, 'RoleModel');
        if (!$result['code']) {
            return result(-1, '', $result['message']);
        }
        return result(0);
    }

    public function delete(Request $request)
    {
        $id = $request->get('id');
        $ret = $this->admin_role->del($id);
        if ($ret === false) {
            // Log
            admin_log('角色删除失败。ID：'.$id);
            return result(-1, '', '删除失败');
        }

        // Log
        admin_log('角色删除成功。ID：'.$id);
        return result(0, '', '删除成功');
    }
}