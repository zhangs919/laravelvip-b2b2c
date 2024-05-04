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
// | Date:2019-4-5
// | Description:用户红包管理
// +----------------------------------------------------------------------

namespace App\Modules\Seller\Http\Controllers\Dashboard;

use App\Models\ShopRank;
use App\Modules\Base\Http\Controllers\Seller;
use App\Repositories\UserBonusRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;

/**
 * 用户红包管理
 *
 * Class UserBonusController
 * @package app\Modules\Seller\Http\Controllers\Dashboard
 */
class UserBonusController extends Seller
{

    private $links = [
        ['url' => 'dashboard/bonus/list', 'text' => '红包列表'],
        ['url' => 'dashboard/bonus/add', 'text' => '派发红包'],
    ];

    protected $userBonus;
    protected $user;

    public function __construct(UserBonusRepository $userBonus,
                                UserRepository $user)
    {
        parent::__construct();

        $this->userBonus = $userBonus;
        $this->user = $user;

        $this->set_menu_select('dashboard', 'dashboard-center');
    }


    public function lists(Request $request)
    {
        $title = '用户红包列表';
        $fixed_title = '营销中心 - ' . $title;

        $this->sublink($this->links, 'list');

        $bonus_id = $request->get('bonus_id', 0);

        $action_span = [
            [
                'id' => '',
                'url' => '/dashboard/bonus/list',
                'icon' => 'fa-reply',
                'text' => '返回红包列表'
            ],
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
        $where[] = ['shop_id', seller_shop_info()->shop_id];
        if ($bonus_id) {
            $where[] = ['bonus_id', $bonus_id];
        }
        // 搜索条件
        $search_arr = ['keywords', 'bonus_status', 'receive_status', 'bonus_type'];
        foreach ($search_arr as $v) {
            if (isset($params[$v]) && !empty($params[$v])) {

                if ($v == 'keywords') {
                    $where[] = ['bonus_sn', 'like', "%{$params[$v]}%"];
                } else {
                    $where[] = [$v, $params[$v]];
                }
            }
        }
        // 列表
        list($list, $total) = $this->userBonus->getUserBonusList($where);

        $pageHtml = pagination($total);
        $page = frontend_pagination($total, true);

        if ($request->ajax()) {
            $render = view('dashboard.user-bonus.partials._list', compact('list', 'total', 'pageHtml'))->render();
            return result(0, $render);
        }

        // 获取数据
        $bonus_types = [
            1 => '到店送红包',
            2 => '收藏送红包',
            4 => '会员送红包',
            6 => '注册送红包',
            9 => '推荐送红包',
            10 => '积分兑换红包',
            '' => '全部'
        ];

        $compact = compact('title', 'list', 'pageHtml', 'bonus_id', 'bonus_types');

        $webData = []; // web端（pc、mobile）数据对象
        $data = [
            'app_extra_data' => [],
            'app_prefix_data' => [
                'list' => $list,
                'page' => $page,
                'bonus_id' => $bonus_id,
                'bonus_types' => $bonus_types
            ],
            'app_context_data' => $this->getAppContext(),
            'app_suffix_data' => [],
            'web_data' => $webData,
            'compact_data' => $compact,
            'tpl_view' => 'dashboard.user-bonus.list'
        ];
        $this->setData($data); // 设置数据
        return $this->displayData(); // 模板渲染及APP客户端返回数据
    }

    /**
     * 派发红包
     *
     * @param Request $request
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function add(Request $request)
    {
        $title = '派发红包';
        $fixed_title = '营销中心 - ' . $title;

        $this->sublink($this->links, 'add');

        $bonus_id = $request->get('bonus_id', 0);

        $action_span = [
            [
                'id' => '',
                'url' => '/dashboard/bonus/list',
                'icon' => 'fa-reply',
                'text' => '返回红包列表'
            ],
            [
                'id' => '',
                'url' => '/dashboard/user-bonus/list',
                'icon' => 'fa-th',
                'text' => '已发放列表'
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
        $shop_rank_list = ['' => '--全部--'];
        $shop_ranks = ShopRank::where([['shop_id', $this->shop_id]])->pluck('rank_name', 'rank_id')->toArray();
        if (!empty($shop_ranks)) {
            foreach ($shop_ranks as $key => $value) {
                $shop_rank_list[$key] = $value;
            }
        }

        $compact = compact('title', 'shop_rank_list', 'bonus_id');

        $webData = []; // web端（pc、mobile）数据对象
        $data = [
            'app_extra_data' => [],
            'app_prefix_data' => [
                'shop_rank_list' => $shop_rank_list,
                'bonus_id' => $bonus_id,
            ],
            'app_context_data' => $this->getAppContext(),
            'app_suffix_data' => [],
            'web_data' => $webData,
            'compact_data' => $compact,
            'tpl_view' => 'dashboard.user-bonus.add'
        ];
        $this->setData($data); // 设置数据
        return $this->displayData(); // 模板渲染及APP客户端返回数据
    }

    /**
     * 派发红包 保存数据
     *
     * @param Request $request
     * @return array
     */
    public function addSave(Request $request)
    {
        $key = $request->get('key');
        $post = $request->post();
        try {
            $this->userBonus->sendUserBonus($key, $this->shop_id, $post);
            shop_log('派发红包。红包ID：' . $post['bonus_id']);
            return result(0, null, '派发红包成功');
        } catch (\Exception $e) {
            return result(-1, null, '派发红包失败');
        }
    }


    /**
     * 搜索会员
     *
     * @param Request $request
     * @return array
     */
    public function searchUser(Request $request)
    {
        $keyword = $request->get('keyword', '');

        // 获取会员列表
        // TODO 后期优化 获取店铺会员
        $where = [];
        // 根据关键词搜索 根据 会员账号/手机号码/邮箱模糊搜索
        $multiLike = '';
        if ($keyword != '') {
            $multiLike = "(concat(IFNULL(user_name,''),IFNULL(mobile,''),IFNULL(email,'')) like '%".$keyword."%')";
        }
        $condition = [
            'where' => $where,
            'multi_like' => $multiLike,
            'sortname' => 'user_id',
            'sortorder' => 'desc',
            'field' => ['user_id', 'user_name', 'mobile', 'email']
        ];
        list($user_list, $total) = $this->user->getList($condition);

        $data = $user_list->toArray();

        return result(0, $data);
    }

}