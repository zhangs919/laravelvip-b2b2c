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
// | Date:2019-05-16
// | Description: 我的资金账户
// +----------------------------------------------------------------------

namespace App\Modules\Frontend\Http\Controllers\User;

use App\Modules\Base\Http\Controllers\UserCenter;
use App\Repositories\UserAccountRepository;
use Illuminate\Http\Request;

class CapitalAccountController extends UserCenter
{

    protected $userAccount;

    public function __construct(UserAccountRepository $userAccount)
    {
        parent::__construct();

        $this->userAccount = $userAccount;

    }



    public function lists(Request $request)
    {
        $seo_title = '用户中心';

        $params = $request->all();


        // 获取数据
        $user = $this->user;

        $where = [];
        // 搜索条件

        $where[] = ['user_id', $this->user_id];

        // 列表
        $condition = [
            'where' => $where,
            'sortname' => 'id',
            'sortorder' => 'desc'
        ];

        list($list, $total) = $this->userAccount->getList($condition);
        $list = $list->toArray();

        $pageHtml = frontend_pagination($total);
        $page_array = frontend_pagination($total,true);
        $page_json = json_encode($page_array);

        $trade_type_items = [
            'trans-detail' => '交易明细',
            'income' => '收入',
            'expend' => '支出'
        ];
        $is_deposit = sysconf('is_deposit'); // "1"; 是否开启提现功能
        $is_recharge = 1;//sysconf('is_recharge'); // "1"; 是否开启充值功能
        $nav_default = 'capital-account';
        $erp_shop_exists = true;

        $compact = compact('seo_title','pageHtml', 'user', 'list', 'page_json',
            'trade_type_items','is_deposit','is_recharge','nav_default','erp_shop_exists');

        if ($request->ajax() && !is_app()) { // web端访问 ajax请求
            $render = view('user.capital-account.partials._list', $compact)->render();
            return result(0, $render);
        }

        $webData = []; // web端（pc、mobile）数据对象
        $data = [
            'app_prefix_data' => [
                'user' => $user,
                'page' => $page_array,
                'list' => $list,
                'trade_type_items' => $trade_type_items,
                'is_deposit' => $is_deposit,
                'is_recharge' => $is_recharge,
                'nav_default' => $nav_default,
                'erp_shop_exists' => $erp_shop_exists,
            ],
            'app_suffix_data' => [],
            'web_data' => $webData,
            'compact_data' => $compact,
            'tpl_view' => 'user.capital-account.list'
        ];
        $this->setData($data); // 设置数据
        return $this->displayData(); // 模板渲染及APP客户端返回数据
    }

    public function getData()
    {
        $result = [
            'balance' => '￥'.format_price($this->user->user_money + $this->user->user_money_limit),
            'points' => $this->user->pay_point ?? 0 // 线下会员积分
        ];
        return response()->json($result);
    }

    public function view(Request $request)
    {
        $compact = [];
        $render = view('user.capital-account.view', compact($compact))->render();
        return result(0, $render);
    }
}