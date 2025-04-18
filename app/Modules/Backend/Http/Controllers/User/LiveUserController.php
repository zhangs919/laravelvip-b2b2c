<?php

namespace App\Modules\Backend\Http\Controllers\User;


use App\Modules\Base\Http\Controllers\Backend;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class LiveUserController extends Backend
{

    private $links = [
        ['url' => 'user/live-user/list', 'text' => '所有列表'],
        ['url' => 'user/live-user/audit-list', 'text' => '待审核列表'],
    ];


    protected $userRep;

    public function __construct(UserRepository $userRep)
    {
        parent::__construct();

        $this->userRep = $userRep;
    }

    public function index(Request $request)
    {
        return $this->lists($request);
    }

    public function lists(Request $request, $type = 'list')
    {
        $title = '主播认证列表';
        $fixed_title = '用户管理 - ' . $title;

        $this->sublink($this->links, $type);

        $action_span = [

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
        $search_arr = ['keyword'];
        foreach ($search_arr as $v) {
            if (isset($params[$v]) && !empty($params[$v])) {

                if ($v == 'keyword') {
                    $where[] = ['', 'like', "%{$params[$v]}%"];
                } else {
                    $where[] = [$v, $params[$v]];
                }
            }
        }
        $in = [
            'field' => 'live_verified',
            'condition' => [1, 2, 3]
        ];
        if ($type == 'audit-list') {
            $where[] = ['live_verified', 2];
        }
        // 列表
        $condition = [
            'where' => $where,
            'in' => $in,
            'with' => ['userReal'],
            'sortname' => 'user_id',
            'sortorder' => 'asc',
        ];
        list($list, $total) = $this->userRep->getList($condition);
        $pageHtml = pagination($total);
        $compact = compact('title', 'list', 'total', 'pageHtml');
        if ($request->ajax()) {
            $render = view('user.live-user.partials._list', $compact)->render();
            return result(0, $render);
        }
        return view('user.live-user.list', $compact);
    }

    public function auditList(Request $request)
    {
        return $this->lists($request, 'audit-list');
    }

    public function audit(Request $request)
    {
        $id = $request->get('id', 0);
        $uuid = make_uuid();
        $info = $this->userRep->getById($id);

        if ($request->method() == 'POST') {
            $update = [
                'live_verified_remark' => $request->post('reason', ''),
                'live_verified' => (int)$request->post('is_pass'), // 审核状态
                'updated_at' => Carbon::now()->toDateTimeString()
            ];
            if ($update['live_verified'] == 1) {
                $update['live_verified_remark'] = '';
            }
            $ret = DB::table('user')->where('user_id', $id)->update($update);
//            $ret = $this->userRep->update($id, $update);

            if ($ret === false) {
                // 失败
                return result(-1, null, '主播认证审核失败');
            }
            // 成功
            admin_log('主播认证审核。ID：' . $id);
            return result(0, null, '主播认证审核成功！');
        }

        $render = view('user.live-user.audit', compact('info', 'uuid'))->render();
        return result(0, $render);
    }


}