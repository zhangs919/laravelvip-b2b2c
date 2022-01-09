<?php

namespace app\Modules\Backend\Http\Controllers\System;


use App\Models\Admin;
use App\Models\AdminNode;
use App\Models\AdminRole;
use App\Modules\Base\Http\Controllers\Backend;
use App\Repositories\AdminRepository;
use App\Services\Tree;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Backend
{

    private $links = [
        ['url' => 'system/admin/admin_list', 'text' => '管理员列表'],
        ['url' => 'system/role/role_list', 'text' => '角色列表'],
    ];

    protected $systemConfig;

    protected $tree;

    protected $admin;

    public function __construct(Tree $tree, AdminRepository $adminRepository)
    {
        parent::__construct();

        $this->tree = $tree;
        $this->admin = $adminRepository;

//        $this->setLayoutBlock(['title' => $this->title]);
    }


    public function lists(Request $request)
    {
        $title = '管理员列表';
        $fixed_title = '管理员设置 - 管理员列表';
        $this->sublink($this->links, 'admin_list');
        $action_span = [
            [
                'url' => 'add',
                'icon' => 'fa-plus',
                'text' => '添加管理员'
            ],
        ];
        $explain_panel = [
            '商城支持自定义管理员角色，每个角色支持自定义权限，便于平台方更清晰的分配管理员职能',
            '平台方可以拥有多个管理员，所以更换管理员、更改登录帐号、管理员离职或更换，都可以通过增加或删除管理员的方式实现'
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
        $search_arr = ['user_name', 'real_name'];
        foreach ($search_arr as $v) {
            if (isset($params[$v]) && !empty($params[$v])) {

                if ($v == 'user_name' || $v = 'real_name') {
                    $where[] = [$v, 'like', "%{$params[$v]}%"];
                } else {
                    $where[] = [$v, $params[$v]];
                }
            }
        }
        // 列表
        $condition = [
            'where' => $where,
            'sortname' => 'created_at',
            'sortorder' => 'desc'
        ];
        list($list, $total) = $this->admin->getList($condition);
//        dd($list);
        $pageHtml = pagination($total);

        $compact = compact('title', 'list', 'total', 'pageHtml');
        if ($request->ajax()) {
            $render = view('system.admin.partials._list', $compact)->render();
            return result(0, $render);
        }
        return view('system.admin.list', $compact);
    }

    public function add(Request $request)
    {
        $title = '添加管理员';

        $id = $request->get('id', 0);
        if ($id) {
            // 更新操作
            $title = '编辑管理员';
            $info = $this->admin->getById($id);
            view()->share('info', $info);


        }

        $fixed_title = '管理员设置 - '.$title;

        $action_span = [
            [
                'url' => 'list',
                'icon' => 'fa-reply',
                'text' => '返回管理员列表'
            ]
        ];
        $explain_panel = [
            '商城支持自定义管理员角色，每个角色支持自定义权限，便于平台方更清晰的分配管理员职能',
            '平台方可以拥有多个管理员，所以更换管理员、更改登录帐号、管理员离职或更换，都可以通过增加或删除管理员的方式实现'
        ];
        $blocks = [
            'fixed_title' => $fixed_title,
            'action_span' => $action_span,
            'explain_panel' => $explain_panel
        ];
        $this->setLayoutBlock($blocks); // 设置block

        // 角色列表
        $role_list = AdminRole::where('status',1)->select(['role_id', 'role_name'])->pluck('role_name', 'role_id');

        return view('system.admin.add', compact('title','role_list'));
    }

    public function edit(Request $request)
    {
        return $this->add($request);
    }

    public function saveData(Request $request)
    {
        $post = $request->post('AdminModel');

        if (!empty($post['user_id'])) {
            // 编辑
            if (!empty($post['password'])) {
                $post['password'] = bcrypt($post['password']);
            } else {
                unset($post['password']); // 如果密码为空 则不修改密码
            }
            $ret = $this->admin->update($post['user_id'], $post);
            $msg = '管理员编辑';
        }else {
            // 添加
            $valid_time = strtotime($post['valid_time_format']);
            $post['valid_time'] = $valid_time;
            $post['password'] = bcrypt($post['password']);
            $ret = $this->admin->store($post);
            $msg = '管理员添加';
        }

        if ($ret === false) {
            // fail
            return result(-1, null, $msg.'失败');
        }
        // success
        return result(0, null, $msg.'成功');
    }

    /**
     * 异步加载角色列表
     *
     * @param Request $request
     * @return array
     */
    public function roleList(Request $request)
    {
        $data = AdminRole::where('status',1)->select(['role_id', 'role_name'])->pluck('role_name', 'role_id');
        return result(0, $data, '');
    }

    /**
     * 名称验证是否重复
     *
     * @param Request $request
     * @return mixed
     */
    public function clientValidate(Request $request)
    {
        $result = $this->admin->clientValidate($request, 'AdminModel');
        if (!$result['code']) {
            return result(-1, '', $result['message']);
        }
        return result(0);
    }

    public function delete(Request $request)
    {
        $id = $request->get('id');
        $ret = Admin::where('user_id', $id)->delete();
        if ($ret === false) {
            // Log
            admin_log('管理员删除失败。ID：'.$id);
            return result(-1, '', '删除失败');
        }

        // Log
        admin_log('管理员删除成功。ID：'.$id);
        return result(0, '', '删除成功');
    }

    /**
     * 设置权限
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function authSet(Request $request)
    {
        $title = '设置权限';

        $fixed_title = '管理员设置 - 设置权限';
        $action_span = [
            [
                'url' => 'list',
                'icon' => 'fa-reply',
                'text' => '返回管理员列表'
            ],
        ];
        $blocks = [
            'fixed_title' => $fixed_title,
            'action_span' => $action_span
        ];
        $this->setLayoutBlock($blocks); // 设置block

        $admin_id = $request->get('id');

        $nodes = AdminNode::get()->toArray();
        $nodes = $this->tree->list_to_tree($nodes, 'id', 'parent_node_id');
        $admin_info = $this->admin->getById($admin_id);
        $role_id = $admin_info->role_id; // 权限id
        $auth_info = AdminRole::where('role_id', $role_id)->select(['role_id', 'role_name', 'auth_codes'])->first();

        //解析已有权限
//        $auth_codes = unserialize(backend_decrypt($auth_info->auth_codes, MD5_KEY.md5($auth_info->role_name)));
        $auth_codes = unserialize(backend_decrypt($auth_info->auth_codes, MD5_KEY));
        if (empty($auth_codes)) {
            $auth_codes = [];
        }

        return view('system.admin.auth_set', compact('title', 'nodes', 'role_id', 'auth_codes'));
    }

    public function authSetSave(Request $request)
    {


        $role_id = $request->get('id'); // 权限id
        $auth_info = AdminRole::where('role_id', $role_id)->select(['role_id', 'role_name', 'auth_codes'])->first();

        $permission = $request->post('auth_codes');
//        $update['auth_codes'] = backend_encrypt(serialize($permission),MD5_KEY.md5($auth_info->role_name));
        $update['auth_codes'] = backend_encrypt(serialize($permission),MD5_KEY);

        $ret = AdminRole::where('role_id', $role_id)->update($update);
        if ($ret === false) {
            // Log
            admin_log('权限设置失败。ID：'.$role_id);
            // 失败
            return result(-1, '', '权限设置失败！');
        }
        // Log
        admin_log('权限设置成功。ID：'.$role_id);
        return result(0, '', '权限设置成功！');
    }

    /**
     * 修改密码
     *
     * @param Request $request
     * @return mixed
     * @throws \Throwable
     */
    public function editPassword(Request $request)
    {
        $uuid = make_uuid();

        if ($request->method() == 'POST') {
            $validateModel = $request->post('ValidateModel');
            $password = $validateModel['password']; // 原密码
            $newpassword = $validateModel['newpassword']; // 新密码
            $qrpassword = $validateModel['qrpassword']; // 新密码确认
            $passwdHash = auth('admin')->user()->getAuthPassword(); // 密码hash
            $adminId = auth('admin')->id();

            // 判断原密码是否正确
            if (!Hash::check($password, $passwdHash)) {
                return result(-1, null, '原密码输入错误');
            }
            // 验证两次输入的密码是否一致
            if ($newpassword != $qrpassword) {
                return result(-1, null, '确认密码与新密码不一致');
            }
            // 所有验证通过 执行修改
            $update = [
                'password' => bcrypt($newpassword)
            ];
            $ret = $this->admin->update($adminId, $update);
            if ($ret === false) {
                return result(-1, null, '密码修改失败');
            }
            // 退出登录
            auth('admin')->logout();
            return result(0, null, '密码修改成功，请重新登录！');
        }

        $render = view('system.admin.edit_password', compact('uuid'))->render();
        return result(0, $render);
    }

    public function setStatus(Request $request)
    {
        $id = $request->get('id');
        $ret = $this->admin->changeState($id, 'status');
        if ($ret === false) {
            return result(-1, '', '设置失败');
        }
        return result(0, $ret, '设置成功');
    }

}