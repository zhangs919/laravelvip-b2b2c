<?php

namespace App\Modules\Backend\Http\Controllers\User;


use App\Modules\Base\Http\Controllers\Backend;
use App\Repositories\ToolsRepository;
use App\Repositories\UserRankRepository;
use Illuminate\Http\Request;

class UserRankController extends Backend
{

    private $links = [
        ['url' => 'user/user-rank/list', 'text' => '列表'],
        ['url' => 'user/user-rank/add', 'text' => '添加'],
        ['url' => 'user/user-rank/edit', 'text' => '编辑'],
    ];

    protected $userRank;

    protected $tools;

    public function __construct(
        UserRankRepository $userRank
        ,ToolsRepository $tools
    )
    {
        parent::__construct();

        $this->userRank = $userRank;
        $this->tools = $tools;

    }

    public function index(Request $request)
    {
        return $this->lists($request);
    }

    public function lists(Request $request)
    {
        $title = '列表';
        $fixed_title = '会员等级 - '.$title;

        $this->sublink($this->links, 'list', '', '', 'add,edit');

        $action_span = [
            [
                'url' => 'add',
                'icon' => 'fa-plus',
                'text' => '添加会员等级'
            ],
        ];

        $explain_panel = [
            '会员等级：由“成长值”决定，成长值越高，会员等级越高',
            '成长值：是会员通过购物所获得的经验值，由累计购物金额计算获得，成长值获得根据确认收货时间计算。例如会员的订单是88.2元，消费金额与赠送成长值比例是10%，则确认收货后并无退款退货，即可得到8点成长值',
            '特殊会员等级的会员不会随着成长值的变化而变化'
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
        /*$search_arr = [];
        foreach ($search_arr as $v) {
            if (isset($params[$v]) && !empty($params[$v])) {

                if ($v == '') {
                    $where[] = ['', 'like', "%{$params[$v]}%"];
                } else {
                    $where[] = [$v, $params[$v]];
                }
            }
        }*/
        // 列表
        $condition = [
            'where' => $where,
            'sortname' => 'max_points',
            'sortorder' => 'asc',
        ];
        list($list, $total) = $this->userRank->getList($condition);
        $pageHtml = pagination($total);
        $compact = compact('title', 'list', 'total', 'pageHtml');
        if ($request->ajax()) {
            $render = view('user.user-rank.partials._list', $compact)->render();
            return result(0, $render);
        }
        return view('user.user-rank.list', $compact);
    }



    public function add(Request $request)
    {
        $title = '新增会员等级';
        $this->sublink($this->links, 'add', '', '', 'edit');

        $id = $request->get('id', 0);

        if ($id) {
            // 更新操作
            $extra = '?id='.$id;
            $info = $this->userRank->getById($id);
            view()->share('info', $info);
            $title = '编辑【'.$info->rank_name.'】';
            $this->sublink($this->links, 'edit', '', $extra, 'add');

        }

        $fixed_title = '会员等级 - '.$title;

        $action_span = [
            [
                'url' => 'list',
                'icon' => 'fa-reply',
                'text' => '返回会员等级列表'
            ]
        ];
        $explain_panel = [];
        $blocks = [
            'fixed_title' => $fixed_title,
            'action_span' => $action_span,
            'explain_panel' => $explain_panel
        ];
        $this->setLayoutBlock($blocks); // 设置block

        return view('user.user-rank.add', compact('title'));
    }

    public function edit(Request $request)
    {
        return $this->add($request);
    }


    public function saveData(Request $request)
    {
        $post = $request->post('UserRankModel');
        $rank_id = !empty($post['rank_id']) ? $post['rank_id'] : 0;
        if ($post['type'] == 1) { // 大于
            $post['max_points'] = 0;
        }

        if ($rank_id) {
            // 编辑
            $ret = $this->userRank->update($rank_id, $post);
            $msg = '会员等级编辑';
        }else {
            // 添加
            $ret = $this->userRank->store($post);
            $msg = '会员等级添加';
        }

        if ($ret === false) {
            // fail
            flash('error', $msg.'失败');
            return redirect('/user/user-rank/list');
        }
        // success
        flash('success', $msg.'成功');
        return redirect('/user/user-rank/list');
    }

    /**
     * 名称验证是否重复
     *
     * @param Request $request
     * @return mixed
     */
    public function clientValidate(Request $request)
    {
        $result = $this->userRank->clientValidate($request, 'UserRankModel');
        if (!$result['code']) {
            return result(-1, '', $result['message']);
        }
        return result(0);
    }

    public function delete(Request $request)
    {
        $id = $request->post('id');
        $ret = $this->userRank->del($id);
        if ($ret === false) {
            // Log
            admin_log('会员等级删除失败。ID：'.$id);
            flash('error', '删除失败');
            return redirect('/user/user-rank/list');
        }

        // Log
        admin_log('会员等级删除成功。ID：'.$id);
        // success
        flash('success', '删除成功');
        return redirect('/user/user-rank/list');
    }

    public function batchDelete(Request $request)
    {
        $ids = $request->post('ids');
        $ret = $this->userRank->batchDel($ids);

        $ids = implode(',', $ids);
        if ($ret === false) {
            // Log
            admin_log('会员等级删除失败。ID：'.$ids);
            return result(-1, '', '删除失败');
        }
        // Log
        admin_log('删除了多个会员等级。ID：'.$ids);
        return result(0, '', '删除成功');
    }

    public function uploadRankImage(Request $request)
    {
        $id = $request->post('id');

        $filename = $request->post('filename', 'name');
        $storePath = 'user/rank';
        $uploadRes = $this->tools->uploadPic($request, $filename, $storePath);

        if (isset($uploadRes['error'])) {
            // 上传出错
            return result(-1, '', $uploadRes['error']);
        }

        $ret = $this->userRank->update($id, ['rank_img' => $uploadRes['data']['path']]);
        if ($ret === false) {
            return result(-1, '', '设置失败！');
        }

        return result(0, $uploadRes['data'], '设置成功', ['count' => $uploadRes['count']]);
    }
}