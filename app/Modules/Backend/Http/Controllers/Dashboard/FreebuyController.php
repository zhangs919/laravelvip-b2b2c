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
// | Date:2019-10-14
// | Description:
// +----------------------------------------------------------------------

namespace App\Modules\Backend\Http\Controllers\Dashboard;

use App\Modules\Base\Http\Controllers\Backend;
use Illuminate\Http\Request;

/**
 * Class FreebuyController
 * @package App\Modules\Backend\Http\Controllers\Dashboard
 */
class FreebuyController extends Backend
{

    private $links = [
    ];


    public function __construct(
    )
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
        $title = '自由购订单列表';
        $fixed_title = '自由购订单 - '.$title;

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
        // 搜索条件
        $search_arr = ['buy_type','name','order_status'];
        foreach ($search_arr as $v) {
            if (isset($params[$v]) && !empty($params[$v])) {
//                if ($v == 'name') {
//                    $where[] = [$v, 'like', "%{$params[$v]}%"];
//                } else {
//                    $where[] = [$v, $params[$v]];
//                }
            }
        }

        // 列表
        $condition = [
            'where' => $where,
            'sortname' => 'id',
            'sortorder' => 'asc'
        ];

        list($list, $total) = [1,2];

        $pageHtml = pagination($total);
        if ($request->ajax()) {
            $render = view('dashboard.freebuy.partials._list', compact('list', 'total', 'pageHtml'))->render();
            return result(0, $render);
        }

        return view('dashboard.freebuy.list', compact('title', 'list', 'pageHtml'));
    }


}