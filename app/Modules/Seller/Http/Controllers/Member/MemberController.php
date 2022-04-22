<?php

namespace App\Modules\Seller\Http\Controllers\Member;

use App\Models\Member;
use App\Models\ShopRank;
use App\Models\UserRank;
use App\Modules\Base\Http\Controllers\Seller;
use App\Repositories\MemberRepository;
use App\Repositories\UserAddressRepository;
use App\User;
use Illuminate\Http\Request;

class MemberController extends Seller
{

    private $list_links = [
        ['url' => 'member/member/user-list?type=1', 'text' => '成交会员'],
        ['url' => 'member/member/user-list?type=2', 'text' => '未成交会员'],
        ['url' => 'member/member/user-list?type=3', 'text' => '其他客户'],
        ['url' => 'member/member/user-list?type=4', 'text' => '手工录入会员'],
    ];

    private $add_links = [
        ['url' => 'member/member/user-list', 'text' => '成交会员'],
        ['url' => 'member/member/add', 'text' => '添加'],
    ];

    private $extend_links = [
        ['url' => 'member/member/user-info', 'text' => '会员信息'],
        ['url' => 'member/member/user-address', 'text' => '收货地址'],
    ];

    protected $member;

    protected $userAddress;

    public function __construct()
    {
        parent::__construct();

        $this->member = new MemberRepository();

        $this->userAddress = new UserAddressRepository();

        $this->set_menu_select('member', 'member-list');

    }

    public function userList(Request $request)
    {
        $type = $request->get('type', 1);

        $title = $this->list_links[$type - 1]['text'];
        $fixed_title = '会员列表 - '.$title;

        $this->sublink($this->list_links, $type, 'type');

        $action_span = [
            [
                'url' => 'add',
                'icon' => 'fa-plus',
                'text' => '手工录入会员'
            ],
            [
                'url' => 'batch-add',
                'icon' => 'fa-cloud-upload',
                'text' => '批量导入会员'
            ],
        ];
        switch ($type) {
            case 1: // 成交会员
                $explain_panel = [
                    '成交会员：在店铺交易成功的会员，包含订单：普通订单、自由购订单、堂内点餐订单、提货券订单、线下未退款订单',
                    '交易笔数，统计的是交易成功的订单数量，包含订单：普通订单、自由购订单、堂内点餐订单、提货券订单、线下未退款订单'
                ];
                break;

            case 2: // 未成交会员
                $explain_panel = [
                    '在店铺下过单，但交易关闭的客户。未成交客户不是店铺会员，不可享受店铺等级优惠'
                ];
                break;

            case 3: // 其他客户
                $explain_panel = [
                    '从未在店铺下过单，但收藏过本店铺或者本店商品的客户，其他客户不是店铺会员，不可享受店铺等级优惠'
                ];
                break;

            case 4: // 手工录入会员
                $explain_panel = [
                    '店铺管理员可后台设置商城会员成为店铺会员 ，并为其设置享受的会员等级'
                ];
                break;

            default:
                $explain_panel = [];
                break;
        }

        $blocks = [
            'explain_panel' => $explain_panel,
            'fixed_title' => $fixed_title,
            'action_span' => $action_span
        ];

        $this->setLayoutBlock($blocks); // 设置block

        $params = $request->all();

        $where = [];
        $where[] = ['shop_id', seller_shop_info()->shop_id];
        // 搜索条件
        $search_arr = ['question_name'];
        foreach ($search_arr as $v) {
            if (isset($params[$v]) && !empty($params[$v])) {

                if ($v == 'question_name') {
                    $where[] = ['question', 'like', "%{$params[$v]}%"];
                } else {
                    $where[] = [$v, $params[$v]];
                }
            }
        }
        // 列表
        $condition = [
            'where' => $where,
            'sortname' => 'member_id',
            'sortorder' => 'desc',
        ];
        list($list, $total) = $this->member->getList($condition);

        $pageHtml = pagination($total);

        if ($request->ajax()) {
            $render = view('member.member.partials._user_list'.$type, compact('list', 'total', 'pageHtml'))->render();
            return result(0, $render);
        }

        $shop_rank_list = ShopRank::where([['shop_id', seller_shop_info()->shop_id], ['is_enable', 1]])->select(['rank_id', 'rank_name'])->get();

        return view('member.member.user_list'.$type, compact('title', 'list', 'pageHtml', 'shop_rank_list'));
    }

    public function add(Request $request)
    {
        $title = '手工录入会员';
        $fixed_title = '会员列表 - '.$title;
        $this->sublink($this->add_links, 'add');

        $action_span = [
            [
                'url' => 'user-list',
                'icon' => 'fa-reply',
                'text' => '返回成交会员列表'
            ],
        ];

        $explain_panel = [
            '店铺管理员可后台设置商城会员成为店铺会员 ，并为其设置享受的会员等级。'
        ];
        $blocks = [
            'explain_panel' => $explain_panel,
            'fixed_title' => $fixed_title,
            'action_span' => $action_span
        ];

        $this->setLayoutBlock($blocks); // 设置block

        $shop_rank_list = ShopRank::where([['shop_id', seller_shop_info()->shop_id], ['is_enable', 1]])->select(['rank_id', 'rank_name'])->get();

        return view('member.member.add', compact('title', 'shop_rank_list'));
    }

    /**
     * 保存信息
     *
     * @param Request $request
     * @return mixed
     */
    public function saveData(Request $request)
    {
        $post = $request->post('MemberModel');

        // 判断会员是否已经录入到店铺会员
        $isExist = Member::where([['shop_id', seller_shop_info()->shop_id], ['username', $post['username']]])->first();
        $userInfo = User::where('user_name', $post['username'])->first();
        if (empty($userInfo)) {
            $userInfo = User::where('mobile', $post['username'])->first();
        }
        if (empty($userInfo)) {
            session()->flash('err', '您输入的账户不存在。');
            return redirect()->back()->withInput($post);
        }

        if (!empty($isExist)) {
            session()->flash('err', '此用户已经是本店会员，不能重复添加');
            return redirect()->back()->withInput($post);
        }

        $insert = [
            'user_id' => $userInfo->user_id,
            'username' => $post['username'],
            'rank_id' => $post['rank'],
            'shop_id' => seller_shop_info()->shop_id
        ];

        $ret = $this->member->store($insert);

        if ($ret === false) {
            // fail
            flash('error', '添加失败');
            return redirect('/member/member/user-list');
        }
        // success
        flash('success', '添加成功');
        return redirect('/member/member/user-list');
    }

    public function batchAdd(Request $request)
    {
        $title = '批量导入会员';
        $fixed_title = '会员列表 - '.$title;

        $action_span = [
            [
                'url' => 'user-list?type=1',
                'icon' => 'fa-reply',
                'text' => '返回会员列表'
            ],
        ];

        $explain_panel = [
            '会员信息导入时，需要给所有会员设置初始密码',
            '系统根据手机号做唯一标识进行去重判断，上传文件中的手机号在会员列表中如果已存在，则将不被导入',
            '建议一次性最多导入4000条会员记录'
        ];
        $blocks = [
            'explain_panel' => $explain_panel,
            'fixed_title' => $fixed_title,
            'action_span' => $action_span
        ];

        $this->setLayoutBlock($blocks); // 设置block

        return view('member.member.batch_add', compact('title'));
    }

    /**
     * 会员信息
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function userInfo(Request $request)
    {
        $title = '会员信息';
        $fixed_title = '会员列表 - '.$title;
        $id = $request->get('id');

        $this->sublink($this->extend_links, 'user-info', '', '?id='.$id);

        $info = $this->member->getByField('user_id', $id);
        $info->platform_rank_name = UserRank::where('rank_id', $info->user->rank_id)->value('rank_name');
        view()->share('info', $info);

        $action_span = [
            [
                'url' => 'user-list?type=1',
                'icon' => 'fa-reply',
                'text' => '返回会员列表'
            ],
        ];

        $explain_panel = [];
        $blocks = [
            'explain_panel' => $explain_panel,
            'fixed_title' => $fixed_title,
            'action_span' => $action_span
        ];

        $this->setLayoutBlock($blocks); // 设置block

        $shop_rank_list = ShopRank::where([['shop_id', seller_shop_info()->shop_id], ['is_enable', 1]])->select(['rank_id', 'rank_name'])->get();


        return view('member.member.user_info', compact('title', 'shop_rank_list'));
    }

    /**
     * 保存会员信息
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function userInfoSave(Request $request)
    {
        $post = $request->post();
        $update = [
            'rank_id' => $post['rank_id'],
            'is_enable' => $post['is_enable']
        ];
        $ret = Member::where('user_id', $post['user_id'])->update($update);
        if ($ret === false) {
            // fail
            flash('error', '修改失败');
            return redirect()->back();
        }
        // success
        flash('success', '修改成功');
        return redirect()->back();
    }

    /**
     * 会员收货地址列表
     *
     * @param Request $request
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Throwable
     */
    public function userAddress(Request $request)
    {
        $title = '收货地址';
        $fixed_title = '会员列表 - '.$title;

        $id = $request->get('id');

        $action_span = [
            [
                'url' => 'user-list?type=1',
                'icon' => 'fa-reply',
                'text' => '返回会员列表'
            ],
        ];

        $explain_panel = [];
        $blocks = [
            'explain_panel' => $explain_panel,
            'fixed_title' => $fixed_title,
            'action_span' => $action_span
        ];

        $this->setLayoutBlock($blocks); // 设置block

        $where = [];
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
            $render = view('member.member.partials._user_address', $compact)->render();
            return result(0, $render);
        }
        return view('member.member.user_address', $compact);
    }
}