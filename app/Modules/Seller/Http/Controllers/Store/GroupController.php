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
// | Date:2018-10-19
// | Description:
// +----------------------------------------------------------------------

namespace app\Modules\Seller\Http\Controllers\Store;

use App\Modules\Base\Http\Controllers\Seller;
use App\Repositories\StoreGroupRepository;
use Illuminate\Http\Request;

/**
 * 网点分组管理
 *
 * Class GroupController
 * @package app\Modules\Seller\Http\Controllers\Store
 */
class GroupController extends Seller
{

    private $links = [];

    protected $storeGroup;

    public function __construct(StoreGroupRepository $storeGroup)
    {
        parent::__construct();

        $this->storeGroup = $storeGroup;

        $this->set_menu_select('store', 'store-group-list');
    }


    public function lists(Request $request)
    {
        $title = '列表';
        $fixed_title = '网点分组管理 - '.$title;

        $action_span = [
            [
                'id' => 'btn_add_store_group',
                'url' => '',
                'icon' => 'fa-plus',
                'text' => '添加分组'
            ],
        ];

        $explain_panel = [
            '网点分组是为线下网点划分组别之用'
        ];
        $blocks = [
            'explain_panel' => $explain_panel,
            'fixed_title' => $fixed_title,
            'action_span' => $action_span
        ];

        $this->setLayoutBlock($blocks); // 设置block

        $where = [];
        $where[] = ['shop_id', seller_shop_info()->shop_id];

        // 列表
        $condition = [
            'where' => $where,
            'relation' => 'store',
            'sortname' => 'group_id',
            'sortorder' => 'asc'
        ];
        list($list, $total) = $this->storeGroup->getList($condition);

        $pageHtml = pagination($total);
        
        $compact = compact('title', 'list', 'total', 'pageHtml');
        if ($request->ajax()) {
            $render = view('store.group.partials._list', $compact)->render();
            return result(0, $render);
        }
        return view('store.group.list', $compact);
    }

    public function add(Request $request)
    {
        $id = $request->get('id');
        if ($id) {
            $info = $this->storeGroup->getById($id);
            view()->share('info', $info);
        }
        $uuid = make_uuid();

        $render = view('store.group.add', compact('uuid'))->render();

        return result(0, $render);
    }

    public function edit(Request $request)
    {
        return $this->add($request);
    }

    /**
     * 保存信息
     *
     * @param Request $request
     * @return mixed
     */
    public function saveData(Request $request)
    {
        $post = $request->post('StoreGroup');

        if (!empty($post['group_id'])) {
            // 编辑
            $ret = $this->storeGroup->update((int)$post['group_id'], $post);
            $msg = '编辑';
        }else {
            // 添加
            $msg = '添加';
            $ret = $this->storeGroup->store($post);
        }

        if ($ret === false) {
            // fail
            return result(-1, '', $msg.'失败');
        }

        // Log
        // success
        return result(0, '', $msg.'成功');
    }

    /**
     * 名称验证是否重复
     *
     * @param Request $request
     * @return mixed
     */
    public function clientValidate(Request $request)
    {
        $result = $this->storeGroup->clientValidate($request, 'StoreGroup');
        if (!$result['code']) {
            return result(-1, '', $result['message']);
        }
        return result(0);
    }

    public function editGroupInfo(Request $request)
    {
        $ret = $this->storeGroup->editSort($request);
        if ($ret === false) {
            return result(-1, '', '设置失败');
        }
        return result(0, '', '设置成功');
    }

    public function delete(Request $request)
    {
        $id = $request->post('id');
        $ret = $this->storeGroup->del($id);
        if ($ret === false) {
            return result(-1, '', '删除失败');
        }
        return result(0, '', '删除成功');
    }

}