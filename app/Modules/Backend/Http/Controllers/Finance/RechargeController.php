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
// | Description:资金-充值管理
// +----------------------------------------------------------------------

namespace App\Modules\Backend\Http\Controllers\Finance;

use App\Modules\Base\Http\Controllers\Backend;
use App\Repositories\UserAccountRepository;
use Illuminate\Http\Request;

class RechargeController extends Backend
{

    private $links = [
        ['url' => 'finance/recharge/list', 'text' => '在线充值明细'],

    ];


    public function __construct()
    {
        parent::__construct();


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

        $title = '列表';
        $fixed_title = '充值管理 - ' . $title;

        $action_span = [];
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
        $search_arr = ['user_name', 'pay_code','status','start_time','end_time'];
        foreach ($search_arr as $v) {
            if (isset($params[$v]) && !empty($params[$v])) {
                if ($v == 'user_name') { // todo
//                    $where[] = [$v, 'like', "%{$params[$v]}%"];
                } /*elseif ($v == 'add_time_begin' || $v == 'add_time_end') {

                }*/
                else {
                    $where[] = [$v, $params[$v]];
                }
            }
        }


        // 列表

        // 获取数据
        list($list, $total) = [[], 0];
        $pageHtml = pagination($total);

        $compact = compact('title', 'list', 'total', 'pageHtml');

        if ($request->ajax()) {
            $render = view('finance.recharge.partials._list', $compact)->render();
            return result(0, $render);
        }

        return view('finance.recharge.list', $compact);
    }

}