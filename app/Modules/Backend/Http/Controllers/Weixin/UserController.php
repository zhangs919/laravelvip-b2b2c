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
// | Date:2020-08-09
// | Description: 微信关键词回复
// +----------------------------------------------------------------------

namespace App\Modules\Backend\Http\Controllers\Weixin;

use App\Modules\Base\Http\Controllers\Backend;
use App\Repositories\WeixinUserRepository;
use Illuminate\Http\Request;

class UserController extends Backend
{

    protected $weixinUser;


    public function __construct(WeixinUserRepository $weixinUser)
    {
        parent::__construct();
        
        $this->weixinUser = $weixinUser;
    }

    public function lists(Request $request)
    {
        $title = '列表';
        $fixed_title = '粉丝管理 - '. $title;

        $action_span = [
            
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
        $where[] = ['shop_id', 0]; // 只获取平台的
        // 搜索条件
        $search_arr = ['nickname'];
        foreach ($search_arr as $v) {
            if (isset($params[$v]) && !empty($params[$v])) {

                if ($v == 'nickname') {
                    $where[] = [$v, 'like', "%{$params[$v]}%"];
                } else {
                    $where[] = [$v, $params[$v]];
                }
            }
        }
        // 列表
        $condition = [
            'where' => $where,
            'sortname' => 'id',
            'sortorder' => 'asc',
        ];
        list($list, $total) = $this->weixinUser->getList($condition);

        // 获取数据
        $pageHtml = pagination($total, false);

        $compact = compact('title', 'list', 'pageHtml','total');
        if ($request->ajax()) {
            $render = view('weixin.user.partials._list', $compact)->render();
            return result(0, $render);
        }
        
        return view('weixin.user.list', $compact);
    }

   
}