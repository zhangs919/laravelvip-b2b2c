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
// | Date:2018-09-22
// | Description:自提点管理
// +----------------------------------------------------------------------

namespace App\Modules\Backend\Http\Controllers\Mall;


use App\Modules\Base\Http\Controllers\Backend;
use App\Repositories\SelfPickupRepository;
use Illuminate\Http\Request;

class SelfPickupController extends Backend
{

    private $links = [];

    protected $selfPickup;


    public function __construct(SelfPickupRepository $selfPickup)
    {
        parent::__construct();

        $this->selfPickup = $selfPickup;

    }

    public function lists(Request $request)
    {
        $title = '上门自提列表';
        $fixed_title = '上门自提 - '.$title;


        $action_span = [
            [
                'url' => 'add',
                'icon' => 'fa-plus',
                'text' => '添加自提点'
            ],
        ];

        $explain_panel = [
            '自提点应用于平台方积分商城，供兑换平台积分商品的消费者选择自提点自提积分商品。'
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
        $search_arr = ['keyword'];
        foreach ($search_arr as $v) {
            if (isset($params[$v]) && !empty($params[$v])) {

                if ($v == 'keyword') {
                    $where[] = ['pickup_name', 'like', "%{$params[$v]}%"];
                } else {
                    $where[] = [$v, $params[$v]];
                }
            }
        }
        // 列表
        $condition = [
            'where' => $where,
            'sortname' => 'pickup_id',
            'sortorder' => 'desc',
        ];
        list($list, $total) = $this->selfPickup->getList($condition);
        $pageHtml = pagination($total);

        $compact = compact('title', 'list', 'total', 'pageHtml');
        if ($request->ajax()) {
            $render = view('mall.self-pickup.partials._list', $compact)->render();
            return result(0, $render);
        }
        return view('mall.self-pickup.list', $compact);
    }



    public function add(Request $request)
    {
        $title = '添加自提点';

        $id = $request->get('id', 0);

        if ($id) {
            // 更新操作
            $extra = '?id='.$id;
            $info = $this->selfPickup->getById($id);
            view()->share('info', $info);
            $title = '编辑自提点';

        }

        $fixed_title = '上门自提 - '.$title;

        $action_span = [
            [
                'url' => 'list',
                'icon' => 'fa-reply',
                'text' => '返回自提点列表'
            ]
        ];
        $explain_panel = [];
        $blocks = [
            'fixed_title' => $fixed_title,
            'action_span' => $action_span,
            'explain_panel' => $explain_panel
        ];
        $this->setLayoutBlock($blocks); // 设置block

        return view('mall.self-pickup.add', compact('title'));
    }

    public function edit(Request $request)
    {
        return $this->add($request);
    }


    public function saveData(Request $request)
    {
        $post = $request->post('SelfPickup');
        $pickup_id = !empty($post['pickup_id']) ? $post['pickup_id'] : 0;

        if ($pickup_id) {
            // 编辑
            $ret = $this->selfPickup->update($pickup_id, $post);
            $msg = '自提点编辑';
        }else {
            // 添加
            $ret = $this->selfPickup->store($post);
            $msg = '自提点添加';
        }

        if ($ret === false) {
            // fail
//            flash('error', $msg.'失败');
            return result(-1, '', $msg.'失败');
        }
        // success
//        flash('success', $msg.'成功');
        return result(0, '', $msg.'成功');
    }


    /**
     *
     *
     * @param Request $request
     * @return mixed
     */
    public function setIsShow(Request $request)
    {
        $id = $request->get('id');
        $ret = $this->selfPickup->changeState($id, 'is_show');
        if ($ret === false) {
            return result(-1, '', '设置失败');
        }
        return result(0, $ret, '设置成功');
    }

    public function delete(Request $request)
    {
        $id = $request->post('id');
        $ret = $this->selfPickup->del($id);
        if ($ret === false) {
            // Log
            admin_log('自提点删除失败。ID：'.$id);
            return result(-1, '', '删除失败');
        }

        // Log
        admin_log('自提点删除成功。ID：'.$id);
        return result(0, '', '删除成功');
    }

}