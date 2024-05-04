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
// | Date:2024-03-02
// | Description:资金-会员账户
// +----------------------------------------------------------------------

namespace App\Modules\Backend\Http\Controllers\Finance;

use App\Modules\Base\Http\Controllers\Backend;
use App\Repositories\UserAccountRepository;
use Illuminate\Http\Request;

class UserAccountController extends Backend
{

    private $links = [
        ['url' => 'finance/user-account/list', 'text' => '会员账户'],

    ];

    protected $userAccount;


    public function __construct(UserAccountRepository $userAccount)
    {
        parent::__construct();

        $this->userAccount = $userAccount;


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
        $this->sublink($this->links, 'list');

        $title = '会员账户';
        $fixed_title = '商城账户 - '.$title;

        $action_span = [];
        $explain_panel = [
            '同一个会员可以是某一个站点绑定的会员，也可以是某一个店铺的店主，也可以作为一个普通会员购买商城商品'
        ];
        $blocks = [
            'fixed_title' => $fixed_title,
            'action_span' => $action_span,
            'explain_panel' => $explain_panel,
        ];
        $this->setLayoutBlock($blocks); // 设置block

        $params = $request->all();

        $where = [];
        // 搜索条件 name 商品名称/订单编号/买家账号
        $search_arr = ['from','to'];
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


        // 列表
        $condition = [
            'with' => [
                'user' => function($q) {
                    $q->select(['user_id','rank_id','user_name', 'nickname','mobile']);
                },
                'user.userReal' => function($q) {
                    $q->select(['user_id','real_name']);
                },
                'user.userRank' => function($q) {
                    $q->select(['rank_id','rank_name']);
                }
            ],
            'where' => $where,
            'sortname' => 'id',
            'sortorder' => 'asc'
        ];

        // 获取数据
        list($list, $total) = $this->userAccount->getList($condition);
        $pageHtml = pagination($total);

        $compact = compact('title', 'list', 'total', 'pageHtml');

        if ($request->ajax()) {
            $render = view('finance.user-account.partials._list', $compact)->render();
            return result(0, $render);
        }

        return view('finance.user-account.list', $compact);
    }

}