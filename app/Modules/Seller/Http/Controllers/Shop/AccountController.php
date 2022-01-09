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
// | Date:2018-10-18
// | Description: 账号管理
// +----------------------------------------------------------------------

namespace App\Modules\Seller\Http\Controllers\Shop;

use App\Models\ShopNode;
use App\Models\ShopRole;
use App\Models\Store;
use App\Modules\Base\Http\Controllers\Seller;
use App\Repositories\UserRepository;
use App\Services\Tree;
use Illuminate\Http\Request;

class AccountController extends Seller
{

    private $links = [
        ['url' => 'shop/account/admin_list', 'text' => '管理员列表'],
        ['url' => 'shop/role/role_list', 'text' => '角色列表'],
        ['url' => 'shop/account/add', 'text' => '添加管理员'],
        ['url' => 'shop/account/edit', 'text' => '编辑管理员'],
        ['url' => 'shop/account/auth-set', 'text' => '权限'],
    ];

    protected $user;
    protected $tree;

    public function __construct()
    {
        parent::__construct();

        $this->user = new UserRepository();
        $this->tree = new Tree();

        $this->set_menu_select('account', 'shop-account');

    }

    public function lists(Request $request)
    {
        $title = '管理员列表';
        $fixed_title = '帐号管理 - '.$title;
        $this->sublink($this->links, 'admin_list', '', '', 'add,edit,auth-set');

        $action_span = [
            [
                'url' => 'add',
                'icon' => 'fa-plus',
                'text' => '添加管理员'
            ],
        ];

        $explain_panel = [
            '状态：控制子账号的使用状态，状态为"禁用"，表示此子账号不允许登录店铺后台或网点后台',
            '网点管理员绑定功能进行调整，修改为：添加网点时，可设置网点管理员既可以是注册会员，也可以是店铺子管理员，添加网点时绑定店铺子管理员作为网点管理员，该子管理员仅可用于登录网点后台，不可登录商城前台和卖家中心，添加网点时绑定注册会员作为网点管理员，该会员是可以登录商城前台。'
        ];
        $blocks = [
            'explain_panel' => $explain_panel,
            'fixed_title' => $fixed_title,
            'action_span' => $action_span
        ];

        $this->setLayoutBlock($blocks); // 设置block

        $params = $request->all();

        $where = [];
        $where[] = ['shop_id', seller_shop_info()->shop_id]; // 店铺id


        /**
         * 搜索条件
         * user_name 登录名
         * role_id 角色id
         * type 类型 1店铺管理员 2网点管理员
         * status 状态 1启用 0禁用
         */
        if (!empty($params['type'])) {
            $where[] = ['is_seller',$params['type']];
        } else {
            $where[] = ['is_seller', '>', 0];
        }
        $search_arr = ['user_name', 'role_id', 'status'];
        foreach ($search_arr as $v) {
            if (isset($params[$v]) && !empty($params[$v])) {
                if ($v == 'user_name') {
                    $where[] = ['user_name', 'like', "%{$params[$v]}%"];
                } elseif(!in_array($params[$v], [0, -1])) {
                    $where[] = [$v, $params[$v]];
                }
            }
        }

        // 列表
        $condition = [
            'where' => $where,
            'relation' => 'shopRole',
            'sortname' => 'user_id',
            'sortorder' => 'desc',
        ];
        list($list, $total) = $this->user->getList($condition);

        if (!empty($list)) {
            foreach ($list as $item) {
                $item->store_id = 0;
                $item->store_name = '';

                if ($item->is_seller == 2) {
                    // 网点管理员 获取网点id及网点名称
                    $storeInfo = Store::where('user_id', $item->user_id)->select(['store_id', 'store_name'])->first();
                    $item->store_id = @$storeInfo->store_id;
                    $item->store_name = @$storeInfo->store_name;
                }
            }
        }

        $pageHtml = pagination($total);

        if ($request->ajax()) {
            $render = view('shop.account.partials._list', compact('list', 'total', 'pageHtml'))->render();
            return result(0, $render);
        }
        return view('shop.account.list', compact('title', 'list', 'pageHtml'));
    }

    public function add(Request $request)
    {
        $title = '添加管理员';

        $id = $request->get('id', 0);

        $this->sublink($this->links, 'add', '', '', 'edit,auth-set');

        if ($id) {
            // 更新操作
            $this->sublink($this->links, 'edit', '', '', 'add,auth-set');

            $info = $this->user->getById($id);
            view()->share('info', $info);
            $title = '编辑管理员';
        }

        $fixed_title = '帐号管理 - '.$title;

        $action_span = [
            [
                'url' => 'list',
                'icon' => 'fa-reply',
                'text' => '返回管理员列表'
            ],
        ];

        $explain_panel = [];
        $blocks = [
            'explain_panel' => $explain_panel,
            'fixed_title' => $fixed_title,
            'action_span' => $action_span
        ];

        $this->setLayoutBlock($blocks); // 设置block

        // 角色列表
        $role_list = ShopRole::where('shop_id', seller_shop_info()->shop_id)->select(['role_id', 'role_name'])->pluck('role_name', 'role_id');

        return view('shop.account.add', compact('title', 'role_list'));
    }

    public function edit(Request $request)
    {
        return $this->add($request);
    }

    /**
     * 保存信息
     *
     * @param Request $request
     * @return mixed
     */
    public function saveData(Request $request)
    {
        $post = $request->post('UserModel');

        if (!empty($post['password'])) {
            $post['password'] = bcrypt($post['password']);
        }

        if (!empty($post['user_id'])) {
            // 编辑
            $ret = $this->user->update($post['user_id'], $post);
            $msg = '管理员编辑';
        }else {
            // 添加
            $post['shop_id'] = seller_shop_info()->shop_id;
            $post['is_seller'] = 1; // 默认添加的管理员为店铺管理员
            $ret = $this->user->store($post);
            $msg = '管理员添加';
        }

        if ($ret === false) {
            // fail
            flash('error', $msg.'失败');
            return redirect('/shop/account/list');
        }
        // success
        flash('success', $msg.'成功');
        return redirect('/shop/account/list');
    }

    /**
     * 名称验证是否重复
     *
     * @param Request $request
     * @return mixed
     */
    public function clientValidate(Request $request)
    {
        $result = $this->user->clientValidate($request, 'UserModel');
        if (!$result['code']) {
            return result(-1, '', $result['message']);
        }
        return result(0);
    }

    /**
     * 异步加载角色列表
     *
     * @param Request $request
     * @return array
     */
    public function roleList(Request $request)
    {
        $data = ShopRole::where('shop_id', seller_shop_info()->shop_id)->select(['role_id', 'role_name'])->pluck('role_name', 'role_id');
        return result(0, $data);
    }

    public function setStatus(Request $request)
    {
        $id = $request->get('id');
        $ret = $this->user->changeState($id, 'status');
        if ($ret === false) {
            return result(-1, '', '设置失败');
        }
        return result(0, $ret, '设置成功');
    }

    /**
     * 删除
     * @param Request $request
     * @return mixed
     */
    public function delete(Request $request)
    {
        $id = $request->post('id');
        $ret = $this->user->del($id);

        if ($ret === false) {
            // Log
            return result(-1, null, '删除失败');
        }

        // Log
        return result(0, null, '删除成功');
    }

    public function authSet(Request $request)
    {
        $title = '管理员授权';
        $fixed_title = '帐号管理 - '.$title;

        $this->sublink($this->links, 'auth-set', '', '', 'add,edit');

        $action_span = [
            [
                'url' => 'list',
                'icon' => 'fa-reply',
                'text' => '返回管理员列表'
            ],
        ];

        $explain_panel = [];
        $blocks = [
            'explain_panel' => $explain_panel,
            'fixed_title' => $fixed_title,
            'action_span' => $action_span
        ];

        $this->setLayoutBlock($blocks); // 设置block

        $user_id = $request->get('id');

        $nodes = ShopNode::get()->toArray();
        $nodes = $this->tree->list_to_tree($nodes, 'id', 'parent_node_id');
        $seller_info = $this->user->getById($user_id);
        $role_id = $seller_info->role_id; // 权限id
        $auth_info = ShopRole::where('role_id', $role_id)->select(['role_id', 'role_name', 'auth_codes'])->first();

        //解析已有权限
//        $auth_codes = unserialize(backend_decrypt($auth_info->auth_codes, MD5_KEY.md5($auth_info->role_name)));
        $auth_codes = unserialize(backend_decrypt($auth_info->auth_codes, MD5_KEY));
        if (empty($auth_codes)) {
            $auth_codes = [];
        }
        return view('shop.account.auth_set', compact('title', 'role_id', 'nodes', 'auth_codes'));
    }

    public function authSetSave(Request $request)
    {
        $role_id = $request->get('id'); // 权限id
        $auth_info = ShopRole::where('role_id', $role_id)->select(['role_id', 'role_name', 'auth_codes'])->first();

        $permission = $request->post('role_auths');
//        $update['auth_codes'] = backend_encrypt(serialize($permission),MD5_KEY.md5($auth_info->role_name));
        $update['auth_codes'] = backend_encrypt(serialize($permission),MD5_KEY);
        $ret = ShopRole::where('role_id', $role_id)->update($update);
        if ($ret === false) {
            // Log
            shop_log('权限设置失败。ID：'.$role_id);
            // 失败
            flash('error', '权限设置失败！');
            return redirect('/shop/account/list');
        }
        // Log
        shop_log('权限设置成功。ID：'.$role_id);
        flash('error', '权限设置成功！');
        return redirect('/shop/account/list');
    }

}