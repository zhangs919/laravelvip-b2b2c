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
// | Date:2018-10-23
// | Description: 客服类型
// +----------------------------------------------------------------------

namespace app\Modules\Seller\Http\Controllers\Shop;

use App\Modules\Base\Http\Controllers\Seller;
use App\Repositories\CustomerTypeRepository;
use Illuminate\Http\Request;

/**
 * 客服类型管理
 * Class CustomerTypeController
 * @package app\Modules\Seller\Http\Controllers\Shop
 */
class CustomerTypeController extends Seller
{

    private $links = [
        ['url' => 'shop/customer-type/list', 'text' => '列表'],
        ['url' => 'shop/customer-type/add', 'text' => '添加'],
        ['url' => 'shop/customer-type/edit', 'text' => '编辑'],
    ];

    protected $customerType;

    public function __construct()
    {
        parent::__construct();

        $this->customerType = new CustomerTypeRepository();

        $this->set_menu_select('account', 'shop-customer-type-list');
    }

    public function lists(Request $request)
    {
        $title = '列表';
        $fixed_title = '客服类型 - '.$title;
        $this->sublink($this->links, 'list', '', '', 'add,edit');

        $action_span = [
            [
                'url' => 'add',
                'icon' => 'fa-plus',
                'text' => '添加客服类型'
            ],
        ];

        $explain_panel = [
            '是否启用：控制客服类型是否被使用'
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
            'sortname' => 'type_id',
            'sortorder' => 'desc'
        ];
        list($list, $total) = $this->customerType->getList($condition);

        $pageHtml = pagination($total);
        
        $compact = compact('title', 'list', 'total', 'pageHtml');
        if ($request->ajax()) {
            $render = view('shop.customer-type.partials._list', $compact)->render();
            return result(0, $render);
        }
        return view('shop.customer-type.list', $compact);
    }

    public function add(Request $request)
    {
        $title = '添加';
        $id = $request->get('id', 0);

        $this->sublink($this->links, 'add', '', '', 'edit');

        if ($id) {
            // 更新操作
            $this->sublink($this->links, 'edit', '', '', 'add');

            $info = $this->customerType->getById($id);
            view()->share('info', $info);
            $title = '编辑';
        }

        $fixed_title = '客服类型 - '.$title;

        $action_span = [
            [
                'url' => 'list',
                'icon' => 'fa-reply',
                'text' => '返回客服类型列表'
            ],
        ];

        $explain_panel = [];
        $blocks = [
            'explain_panel' => $explain_panel,
            'fixed_title' => $fixed_title,
            'action_span' => $action_span
        ];

        $this->setLayoutBlock($blocks); // 设置block

        return view('shop.customer-type.add', compact('title'));
    }

    public function edit(Request $request)
    {
        return $this->add($request);
    }

    /**
     * 保存信息
     * @param Request $request
     * @return mixed
     */
    public function saveData(Request $request)
    {
        $post = $request->post('CustomerTypeModel');

        if (!empty($post['type_id'])) {
            // 编辑
            $ret = $this->customerType->update($post['type_id'], $post);
            $msg = '客服类型编辑';
        }else {
            // 添加
            $post['shop_id'] = seller_shop_info()->shop_id;
            $ret = $this->customerType->store($post);
            $msg = '客服类型添加';
        }

        if ($ret === false) {
            // fail
            flash('error', $msg.'失败');
            return redirect('/shop/customer-type/list');
        }
        // success
        flash('success', $msg.'成功');
        return redirect('/shop/customer-type/list');
    }

    /**
     * 名称验证是否重复
     *
     * @param Request $request
     * @return mixed
     */
    public function clientValidate(Request $request)
    {
        $result = $this->customerType->clientValidate($request, 'CustomerTypeModel');
        if (!$result['code']) {
            return result(-1, '', $result['message']);
        }
        return result(0);
    }

    public function editCustomerInfo(Request $request)
    {
        $id = $request->post('type_id');
        $title = $request->post('title');
        $value = $request->post('value');

        if (in_array($title, ['type_sort'])) {
            $value = intval($value);
        }
        $ret = $this->customerType->update($id, [$title => $value]);

        if ($ret === false) {
            return result(-1, '', '设置失败');
        }
        return result(0, '', '设置成功');
    }

    public function setIsShow(Request $request)
    {
        $id = $request->get('id');
        $ret = $this->customerType->changeState($id, 'is_show');
        if ($ret === false) {
            return result(-1, '', '设置失败');
        }
        return result(0, $ret, '设置成功');
    }

    public function delete(Request $request)
    {
        $id = $request->post('id');
        $ret = $this->customerType->del($id);
        if ($ret === false) {
            // Log
            shop_log('客服类型删除失败。ID：'.$id);
            return result(-1, '', '删除失败');
        }
        // Log
        shop_log('客服类型删除成功。ID：'.$id);
        return result(0, '', '删除成功');
    }

    public function batchDelete(Request $request)
    {
        $ids = $request->post('ids');
        $ret = $this->customerType->batchDel($ids);

        $ids = implode(',', $ids);
        if ($ret === false) {
            // Log
            shop_log('客服类型批量删除失败。ID：'.$ids);
            return result(-1, '', '删除失败');
        }
        // Log
        shop_log('客服类型批量删除成功。ID：'.$ids);
        return result(0, '', '删除成功');
    }

}