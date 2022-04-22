<?php

namespace app\Modules\Backend\Http\Controllers\User;

use App\Exports\UsersExport;
use App\Imports\UsersImport;
use App\Models\UserRank;
use App\Modules\Base\Http\Controllers\Backend;
use App\Repositories\UserAddressRepository;
use App\Repositories\UserRealRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Backend
{

    private $links = [
        ['url' => 'user/user/list?type=all', 'text' => '全部'],
        ['url' => 'user/user/list?type=real', 'text' => '实名认证审核'],
    ];

    private $editLinks = [
        ['url' => 'user/user/edit', 'text' => '基本信息'],
        ['url' => 'user/user/real-info', 'text' => '认证信息'],
        ['url' => 'user/user/address-info', 'text' => '收货地址信息'],
    ];

    protected $user;

    protected $userReal;

    protected $userAddress;

    public function __construct()
    {
        parent::__construct();

        $this->user = new UserRepository();
        $this->userReal = new UserRealRepository();
        $this->userAddress = new UserAddressRepository();
    }

    /**
     * 会员列表
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Throwable
     */
    public function lists(Request $request)
    {
        $title = '会员列表';
        $fixed_title = '会员列表';
        $type = $request->get('type', 'all');
        $this->sublink($this->links, $type, 'type');

        $action_span = [
            [
                'url' => 'add?type=0',
                'icon' => 'fa-plus',
                'text' => '新增个人会员'
            ],
            [
                'url' => 'user-batch-upload',
                'icon' => 'fa-cloud-upload',
                'text' => '上传ecshop数据源'
            ],
            [
                'url' => 'batch-add',
                'icon' => 'fa-cloud-upload',
                'text' => '批量导入会员'
            ],
            [
                'id' => 'btn_update_user_rank',
                'url' => '',
                'icon' => 'fa-cloud-upload',
                'text' => '重建会员等级关联关系'
            ],
        ];

        $explain_panel = [
            '<span class="prompt-icon"><i class="fa card"></i>：未实名认证</span><span class="prompt-icon yes"><i class="fa card"></i>：已实名认证</span><span class="prompt-icon"><i class="fa fa-envelope-o"></i>：未验证邮箱</span><span class="prompt-icon yes"><i class="fa fa fa-envelope-o"></i>：已验证邮箱</span><span class="prompt-icon"><i class="fa fa-tablet"></i>：未验证手机</span><span class="prompt-icon yes"><i class="fa fa-tablet"></i>：已验证手机</span>'
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
        $search_arr = ['user_name', 'rank_id', 'is_seller', 'is_real',
            'reg_from', 'status', 'shopping_status', 'comment_status',
            'reg_time_begin', 'reg_time_end', 'last_time'];
        foreach ($search_arr as $v) {
            if (isset($params[$v]) && !empty($params[$v])) {

                if ($v == 'user_name') {
                    $where[] = [$v, 'like', "%{$params[$v]}%"];
                } else {
                    $where[] = [$v, $params[$v]];
                }
            }
        }

        // 排序
        $sortname = $request->get('sortname', 'created_at');
        $sortorder = $request->get('sortorder', 'desc');

        // 查询条件
        if ($type == 'real') {
            // 查询实名认证会员
            $where[] = ['is_real', 1];
        }
        // 列表
        $condition = [
            'where' => $where,
            'sortname' => $sortname,
            'sortorder' => $sortorder
        ];
        list($list, $total) = $this->user->getList($condition);

        $pageHtml = pagination($total);

        $compact = compact('title', 'list', 'total', 'pageHtml');
        if ($request->ajax()) {
            $render = view('user.user.partials._list', $compact)->render();
            return result(0, $render);
        }
        return view('user.user.list', $compact);
    }

    /**
     * 新增会员
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function add(Request $request)
    {
        $title = '新增会员';

        $fixed_title = '会员列表 - '.$title;

        $action_span = [
            [
                'url' => 'list',
                'icon' => 'fa-reply',
                'text' => '返回会员列表'
            ]
        ];
        $explain_panel = [];
        $blocks = [
            'fixed_title' => $fixed_title,
            'action_span' => $action_span,
            'explain_panel' => $explain_panel
        ];
        $this->setLayoutBlock($blocks); // 设置block

        // 会员等级列表
        $user_rank = UserRank::select(['rank_id', 'rank_name', 'min_points'])->orderBy('max_points', 'asc')->get();

        return view('user.user.add', compact('title', 'user_rank'));
    }

    /**
     * 编辑会员基本信息
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Request $request)
    {
        $title = '会员基本信息';
        $fixed_title = '会员列表 - '.$title;
        $id = $request->get('id');

        $this->sublink($this->editLinks, 'edit', '', '?id='.$id);

        $action_span = [
            [
                'url' => 'list',
                'icon' => 'fa-reply',
                'text' => '返回会员列表'
            ]
        ];
        $explain_panel = [];
        $blocks = [
            'fixed_title' => $fixed_title,
            'action_span' => $action_span,
            'explain_panel' => $explain_panel
        ];
        $this->setLayoutBlock($blocks); // 设置block


        $info = $this->user->getById($id);

        // 会员等级列表
        $user_rank = UserRank::select(['rank_id', 'rank_name', 'min_points'])->orderBy('max_points', 'asc')->get();

        return view('user.user.edit', compact('title', 'info', 'user_rank'));
    }

    /**
     * 保存信息
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function saveData(Request $request)
    {
        $post = $request->post('UserModel');

        if ($post['birthday'] == 0) {
            unset($post['birthday']);
        }
        $post['address_code'] = $request->post('receive_address');

        if (!empty($post['user_id'])) {
            // 编辑
            $ret = $this->user->modifyUser($post['user_id'], $post);
            $msg = '会员编辑';
        }else {
            // 添加
            $regFrom = 5; // 注册来源 5后台添加
            $ret = $this->user->register($post, $regFrom);
            $msg = '会员添加';
        }

        if ($ret === false) {
            // fail
            flash('error', $msg.'失败');
            return redirect('/user/user/list');
        }
        // success
        flash('success', $msg.'成功');
        return redirect('/user/user/list');
    }

    /**
     * 实名认证信息
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function realInfo(Request $request)
    {
        $title = '实名认证信息';
        $fixed_title = '会员列表 - '.$title;
        $id = $request->get('id');

        $this->sublink($this->editLinks, 'real-info', '', '?id='.$id);

        $action_span = [
            [
                'url' => 'list',
                'icon' => 'fa-reply',
                'text' => '返回会员列表'
            ]
        ];
        $explain_panel = [];
        $blocks = [
            'fixed_title' => $fixed_title,
            'action_span' => $action_span,
            'explain_panel' => $explain_panel
        ];
        $this->setLayoutBlock($blocks); // 设置block

        $info = $this->userReal->getByField('user_id', $id); // 根据会员id获取实名认证信息

        if ($request->method() == 'POST') {
            $post = $request->post('UserRealModel');

            $ret = $this->userReal->update($post['real_id'], $post);

            if ($ret === false) {
                // fail
                flash('error', '更新失败');
                return redirect('/user/user/list');
            }
            // success
            flash('success', '更新成功');
            return redirect('/user/user/list');
        }

        return view('user.user.real_info', compact('title', 'info'));
    }

    /**
     * 根据身份证号查询身份证信息
     * todo 需要连接身份证信息系统获取信息
     *
     * @param Request $request
     * @return array
     * @throws \Throwable
     */
    public function cardSearch(Request $request)
    {
        $id = $request->get('id');
        $uuid = make_uuid();

        $info = [
            'id' => $id,
            'status' => true,
            'sex' => '男',
            'birthday' => '1980年05月12日',
            'address' => '重庆市万州',
            'error' => '身份信息获取失败！'
        ];
        $render = view('user.user.card_search', compact('uuid', 'info'))->render();

        return result(0, $render);
    }

    /**
     * 收货地址信息
     *
     * @param Request $request
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Throwable
     */
    public function addressInfo(Request $request)
    {
        $title = '收货地址信息';
        $fixed_title = '会员列表 - '.$title;
        $id = $request->get('id');

        $this->sublink($this->editLinks, 'address-info', '', '?id='.$id);

        $action_span = [
            [
                'url' => 'list',
                'icon' => 'fa-reply',
                'text' => '返回会员列表'
            ]
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
        $search_arr = [];
        foreach ($search_arr as $v) {
            if (isset($params[$v]) && !empty($params[$v])) {

                if ($v == 'key') {
                    $where[] = [$v, 'like', "%{$params[$v]}%"];
                } else {
                    $where[] = [$v, $params[$v]];
                }
            }
        }

        $where[] = ['user_id', $id];
        // 列表
        $condition = [
            'where' => $where,
            'sortname' => 'created_at',
            'sortorder' => 'desc'
        ];
        list($list, $total) = $this->userAddress->getList($condition);

        $pageHtml = pagination($total);

        $compact = compact('title', 'list', 'total', 'pageHtml');
        if ($request->ajax()) {
            $render = view('user.user.partials._address_info', $compact)->render();
            return result(0, $render);
        }
        return view('user.user.address_info', $compact);
    }

    /**
     * 编辑会员备注信息
     *
     * @param Request $request
     * @return array
     * @throws \Throwable
     */
    public function editDesc(Request $request)
    {
        $id = $request->get('id');
        $uuid = make_uuid();

        $info = $this->user->getById($id);
        $render = view('user.user.edit_desc', compact('uuid', 'info'))->render();

        if ($request->method() == 'POST') {
            $post = $request->post();
            $update = [
                'user_remark' => $post['user_remark']
            ];
            $ret = $this->user->update($post['id'], $update);
            if ($ret === false) {
                return result(-1, '', '会员备注设置失败！');
            }
            return result(0, '', '会员备注设置成功！');
        }

        return result(0, $render);
    }

    /**
     * 设置状态
     *
     * @param Request $request
     * @return mixed
     */
    public function setStatus(Request $request)
    {
        $id = $request->get('id');
        $type = $request->get('type', 0);

        if (!$type) {
            return result(-1, '', '参数错误');
        }

        $ret = $this->user->changeState($id, $type);
        if ($ret === false) {
            return result(-1, $ret, '设置失败');
        }
        return result(0, $ret, '设置成功');
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
     * 删除
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function delete(Request $request)
    {
        $id = $request->post('id');
        $ret = $this->user->deleteUser($id);
        if ($ret === false) {
            // Log
            admin_log('会员删除失败。ID：'.$id);
            flash('error', '删除失败');
            return redirect('/user/user/list');
        }

        // Log
        admin_log('会员删除成功。ID：'.$id);
        // success
        flash('success', '删除成功');
        return redirect('/user/user/list');
    }

    /**
     * 重建会员等级关联关系
     * @param Request $request
     * @return array
     */
    public function updateUserRank(Request $request)
    {

        return result(0, null, '操作成功！');
    }

    /**
     * 导出excel
     *
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function export()
    {
        $filename = '乐融沃B2B2C商城演示站_会员列表-'.date('Ymdhis').'.xls';

        return Excel::download(new UsersExport(), $filename);
    }

    /**
     * 批量导入会员
     *
     * @param Request $request
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Throwable
     */
    public function batchAdd(Request $request)
    {
        $title = '批量导入会员';
        $fixed_title = '会员列表 - '.$title;

        $action_span = [
            [
                'url' => 'list',
                'icon' => 'fa-reply',
                'text' => '返回会员列表'
            ]
        ];

        $explain_panel = [
            '会员信息导入时，需要给所有会员设置初始密码',
            '系统根据手机号做唯一标识进行去重判断，上传文件中的手机号在会员列表中如果已存在，则将不被导入',
            '建议一次性最多导入4000条会员记录',
        ];
        $blocks = [
            'explain_panel' => $explain_panel,
            'fixed_title' => $fixed_title,
            'action_span' => $action_span
        ];

        $this->setLayoutBlock($blocks); // 设置block
        $compact = compact('title');

        if ($request->method() == 'POST') {
            $filename = $request->file('uploadfile'); // 导入文件
            $password = $request->post('password'); // 会员密码
            $success_count = $this->user->batchImport($filename, $password);

            // Log
            admin_log('会员批量导入成功。成功数量：'.$success_count);
            // success
            flash('success', '成功添加了'.$success_count.'个会员');
            return redirect('/user/user/list');
        }

        return view('user.user.batch_add', $compact);
    }

    public function userBatchUpload(Request $request)
    {
        $title = '批量导入用户信息';
        $fixed_title = '会员列表 - '.$title;

        $action_span = [
            [
                'url' => 'list',
                'icon' => 'fa-reply',
                'text' => '返回会员列表'
            ]
        ];

        $explain_panel = [
            '会员信息导入时，需要给所有会员设置初始密码',
        ];
        $blocks = [
            'explain_panel' => $explain_panel,
            'fixed_title' => $fixed_title,
            'action_span' => $action_span
        ];

        $this->setLayoutBlock($blocks); // 设置block
        $compact = compact('title');

        if ($request->method() == 'POST') {

            flash('error', '请提前清空原有用户等级数据！');
            return redirect('/user/user/user-batch-upload');

            //
            $ret = true;
            if ($ret === false) {
                // Log
                admin_log('会员批量导入失败。ID：');
                flash('error', '批量导入失败');
                return redirect('/user/user/list');
            }

            // Log
            admin_log('会员批量导入成功。ID：');
            // success
            flash('success', '成功添加了0个会员');
            return redirect('/user/user/list');
        }

        return view('user.user.user_batch_upload', $compact);
    }

    /**
     * 下载上传会员文件模板
     *
     * @param Request $request
     */
    public function download(Request $request)
    {

    }
}