<?php

namespace app\Modules\Backend\Http\Controllers\User;


use App\Models\UserShopRank;
use App\Modules\Base\Http\Controllers\Backend;
use App\Repositories\UserShopRankRepository;
use Illuminate\Http\Request;

class ShopController extends Backend
{

    private $links = [
        ['url' => 'user/shop/list', 'text' => '列表'],
        ['url' => 'user/shop/add', 'text' => '添加'],
        ['url' => 'user/shop/edit', 'text' => '编辑'],
    ];

    protected $userShopRank;

    public function __construct()
    {
        parent::__construct();

        $this->userShopRank = new UserShopRankRepository();

    }

    public function lists(Request $request)
    {
        $title = '列表';
        $fixed_title = '店铺会员等级 - '.$title;

        $this->sublink($this->links, 'list', '', '', 'add,edit');

        $action_span = [
            [
                'url' => 'add',
                'icon' => 'fa-plus',
                'text' => '添加店铺会员等级'
            ],
        ];

        $explain_panel = [
            '店铺会员等级是由店铺推出的买家成长体系（区别于平台方设置的会员等级）',
            '店铺使用的会员等级级别由平台方预定义，店铺按照预定义级别设置店铺会员等级条件以及会员权益'
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
            'sortname' => 'rank_level',
            'sortorder' => 'asc',
        ];
        list($list, $total) = $this->userShopRank->getList($condition);
        $pageHtml = pagination($total);
        $compact = compact('title', 'list', 'total', 'pageHtml');
        if ($request->ajax()) {
            $render = view('user.shop.partials._list', $compact)->render();
            return result(0, $render);
        }
        return view('user.shop.list', $compact);
    }



    public function add(Request $request)
    {
        $title = '添加';
        $this->sublink($this->links, 'add', '', '', 'edit');

        $id = $request->get('id', 0);
        $rank_levels = UserShopRank::select(['rank_level'])->pluck('rank_level')->toArray();

        if ($id) {
            // 更新操作
            $info = $this->userShopRank->getById($id);
            view()->share('info', $info);
            $title = '编辑';
            $this->sublink($this->links, 'edit', '', '', 'add');

            $rank_levels = UserShopRank::select(['rank_level'])->where([['rank_id', '!=', $id]])->pluck('rank_level')->toArray();
        }

        $fixed_title = '店铺会员等级 - '.$title;

        $action_span = [
            [
                'url' => 'list',
                'icon' => 'fa-reply',
                'text' => '返回店铺会员等级列表'
            ]
        ];
        $explain_panel = [
            '店铺会员等级是由店铺推出的买家成长体系（区别于平台方设置的会员等级）',
            '店铺使用的会员等级级别由平台方预定义，店铺按照预定义级别设置店铺会员等级条件以及会员权益'
        ];
        $blocks = [
            'fixed_title' => $fixed_title,
            'action_span' => $action_span,
            'explain_panel' => $explain_panel
        ];
        $this->setLayoutBlock($blocks); // 设置block

        $rank_level_list = range(1, 10); // 1-10数组

        foreach ($rank_level_list as $k=>$v) {
            if (in_array($v, $rank_levels)) {
                unset($rank_level_list[$k]);
            }
        }
        return view('user.shop.add', compact('title', 'rank_level_list'));
    }

    public function edit(Request $request)
    {
        return $this->add($request);
    }


    public function saveData(Request $request)
    {
        $post = $request->post('UserShopRank');

        if (!empty($post['rank_id'])) {
            // 编辑
            $ret = $this->userShopRank->update($post['rank_id'], $post);
            $msg = '店铺会员等级编辑';
        }else {
            // 添加
            $ret = $this->userShopRank->store($post);
            $msg = '店铺会员等级添加';
        }

        if ($ret === false) {
            // fail
            flash('error', $msg.'失败');
            return redirect('/user/shop/list');
        }
        // success
        flash('success', $msg.'成功');
        return redirect('/user/shop/list');
    }

    /**
     * 名称验证是否重复
     *
     * @param Request $request
     * @return mixed
     */
    public function clientValidate(Request $request)
    {
        $result = $this->userShopRank->clientValidate($request, 'UserShopRankModel');
        if (!$result['code']) {
            return result(-1, '', $result['message']);
        }
        return result(0);
    }

    public function delete(Request $request)
    {
        $id = $request->post('id');
        $ret = $this->userShopRank->del($id);
        if ($ret === false) {
            // Log
            admin_log('店铺会员等级删除失败。ID：'.$id);
            flash('error', '删除失败');
            return redirect('/user/shop/list');
        }

        // Log
        admin_log('店铺会员等级删除成功。ID：'.$id);
        // success
        flash('success', '删除成功');
        return redirect('/user/shop/list');
    }
}