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
// | Date:2019-05-15
// | Description:店铺账户明细
// +----------------------------------------------------------------------

namespace App\Modules\Seller\Http\Controllers\Finance;

use App\Models\User;
use App\Modules\Base\Http\Controllers\Seller;
use App\Repositories\UserAccountRepository;
use Illuminate\Http\Request;

class AccountDetailController extends Seller
{

    private $links = [

    ];

    protected $userAccount;

    public function __construct(UserAccountRepository $userAccount)
    {
        parent::__construct();

        $this->userAccount = $userAccount;

        $this->set_menu_select('finance', 'finance-account-detail');
    }

    /**
     * 列表
     *
     * @param Request $request
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Throwable
     */
    public function lists(Request $request)
    {
        $title = '店铺账户明细';
        $fixed_title = $title;

        $action_span = [
            [
                'url' => '',
                'id' => 'deposit',
                'icon' => 'fa-money',
                'text' => '提现'
            ],
        ];
        $explain_panel = [];
        $blocks = [
            'fixed_title' => $fixed_title,
            'action_span' => $action_span,
            'explain_panel' => $explain_panel,
        ];
        $this->setLayoutBlock($blocks); // 设置block

        $params = $request->all();

        $where = [];
        // 搜索条件 name 商品名称/订单编号/买家账号
        $search_arr = ['from','to','process_type','min_amount','max_amount','key_word','pay_code'];
        foreach ($search_arr as $v) {
            if (isset($params[$v]) && !empty($params[$v])) {
                if ($v == 'key_word') { // todo
//                    $where[] = [$v, 'like', "%{$params[$v]}%"];
                } /*elseif ($v == 'add_time_begin' || $v == 'add_time_end') {

                }*/
                else {
                    $where[] = [$v, $params[$v]];
                }
            }
        }

        $where[] = ['user_id', seller_shop_info()->user_id];

        // 列表
        $condition = [
            'where' => $where,
            'sortname' => 'id',
            'sortorder' => 'asc'
        ];


        // 获取数据
        $user = User::where('user_id', seller_shop_info()->user_id)->first()->toArray();

        list($list, $total) = $this->userAccount->getList($condition);
        $list = $list->toArray();

        $pageHtml = pagination($total);
        $page = frontend_pagination($total, true);

        $trade_type_items = [
            'trans-detail' => '交易明细',
            'income' => '收入',
            'expend' => '支出'
        ];
        $is_deposit = '1';
        $is_recharge = '1';
        $nav_default = 'capital-account';
        $erp_shop_exists = false;

        $compact = compact('title', 'list', 'pageHtml', 'user', 'trade_type_items','is_deposit','is_recharge','nav_default','erp_shop_exists');

        if ($request->ajax()) {
            $render = view('finance.account-detail.partials._list', $compact)->render();
            return result(0, $render);
        }


        $webData = []; // web端（pc、mobile）数据对象
        $data = [
            'app_extra_data' => [],
            'app_prefix_data' => [
                'user' => $user,
                'list' => $list,
                'page' => $page,
                'trade_type_items' => $trade_type_items,
                'is_deposit' => $is_deposit,
                'is_recharge' => $is_recharge,
                'nav_default' => $nav_default,
                'erp_shop_exists' => $erp_shop_exists,
            ],
            'app_context_data' => $this->getAppContext(),
            'app_suffix_data' => [],
            'web_data' => $webData,
            'compact_data' => $compact,
            'tpl_view' => 'finance.account-detail.list'
        ];
        $this->setData($data); // 设置数据
        return $this->displayData(); // 模板渲染及APP客户端返回数据
    }

}