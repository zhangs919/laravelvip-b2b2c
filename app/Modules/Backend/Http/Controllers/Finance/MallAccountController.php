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
// | Date:2020-08-15
// | Description:平台进出账明细
// +----------------------------------------------------------------------

namespace App\Modules\Backend\Http\Controllers\Finance;

use App\Modules\Base\Http\Controllers\Backend;
use App\Repositories\MallAccountRepository;
use Illuminate\Http\Request;

class MallAccountController extends Backend
{

    private $links = [
        ['url' => 'finance/mall-account/list?type=income', 'text' => '商城进账明细'],
        ['url' => 'finance/mall-account/list?type=expend', 'text' => '商城出账明细'],

    ];

    protected $mallAccount;

    protected $type;

    public function __construct(MallAccountRepository $mallAccount)
    {
        parent::__construct();

        $this->mallAccount = $mallAccount;

        $this->type = \request()->get('type', 'income');
        $this->sublink($this->links, $this->type, 'type');

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
        $title = $this->type == 'income' ? '商城进账明细' : '商城出账明细';
        $fixed_title = '商城账户 - '.$title;

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
        $search_arr = ['from','to','account_type'];
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

        $adminId = auth('admin')->id();
        $where[] = ['admin_id', $adminId]; //
        if ($this->type == 'income') {
            $where[] = ['amount','>=',0];
        } else {
            $where[] = ['amount','<',0];
        }

        // 列表
        $condition = [
            'where' => $where,
            'sortname' => 'account_id',
            'sortorder' => 'asc'
        ];

        // 获取数据
        $income = $this->mallAccount->getIncome($adminId);
        $expend = $this->mallAccount->getExpend($adminId);

        list($list, $total) = $this->mallAccount->getList($condition);

        $pageHtml = pagination($total);

        $compact = compact('title', 'list', 'pageHtml', 'income', 'expend');

        if ($request->ajax()) {
            $render = view('finance.mall-account.partials._'.$this->type.'_list', $compact)->render();
            return result(0, $render);
        }

        return view('finance.mall-account.'.$this->type.'_list', $compact);
    }

}