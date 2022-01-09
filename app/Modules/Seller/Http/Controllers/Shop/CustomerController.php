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
// | Description: 客服
// +----------------------------------------------------------------------

namespace app\Modules\Seller\Http\Controllers\Shop;

use App\Models\CustomerType;
use App\Modules\Base\Http\Controllers\Seller;
use App\Repositories\CustomerRepository;
use App\Repositories\ShopRepository;
use Illuminate\Http\Request;

/**
 * 客服管理
 * Class CustomerController
 * @package app\Modules\Seller\Http\Controllers\Shop
 */
class CustomerController extends Seller
{

    private $links = [
        ['url' => 'shop/customer/list', 'text' => '客服列表'],
        ['url' => 'shop/customer/customer-set', 'text' => '客服设置'],
        ['url' => 'shop/customer/add', 'text' => '添加'],
        ['url' => 'shop/customer/edit', 'text' => '编辑'],
    ];

    protected $customer;
    protected $shop;

    public function __construct()
    {
        parent::__construct();

        $this->customer = new CustomerRepository();
        $this->shop = new ShopRepository();

        $this->set_menu_select('account', 'shop-customer-list');
    }

    public function lists(Request $request)
    {
        $title = '列表';
        $fixed_title = '客服管理 - '.$title;
        $this->sublink($this->links, 'list', '', '', 'add,edit');

        $action_span = [
            [
                'url' => 'add',
                'icon' => 'fa-plus',
                'text' => '添加客服'
            ],
        ];

        $explain_panel = [
            '是否主客服：只能设置其中一个客服为主客服'
        ];
        $blocks = [
            'explain_panel' => $explain_panel,
            'fixed_title' => $fixed_title,
            'action_span' => $action_span
        ];

        $this->setLayoutBlock($blocks); // 设置block

        $params = $request->all();
        $where = [];
        $where[] = ['shop_id', seller_shop_info()->shop_id];

        $search_arr = ['customer_name'];
        foreach ($search_arr as $v) {
            if (isset($params[$v]) && !empty($params[$v])) {
                if ($v == 'customer_name') {
                    $where[] = [$v, 'like', "%{$params[$v]}%"];
                } else {
                    $where[] = [$v, $params[$v]];
                }
            }
        }

        // 列表
        $condition = [
            'where' => $where,
            'sortname' => 'customer_id',
            'sortorder' => 'desc'
        ];
        list($list, $total) = $this->customer->getList($condition);

        $pageHtml = pagination($total);
        
        $compact = compact('title', 'list', 'total', 'pageHtml');
        if ($request->ajax()) {
            $render = view('shop.customer.partials._list', $compact)->render();
            return result(0, $render);
        }
        return view('shop.customer.list', $compact);
    }

    public function add(Request $request)
    {
        $title = '添加';
        $id = $request->get('id', 0);

        $this->sublink($this->links, 'add', '', '', 'edit');

        if ($id) {
            // 更新操作
            $this->sublink($this->links, 'edit', '', '', 'add');

            $info = $this->customer->getById($id);
            view()->share('info', $info);
            $title = '编辑';
        }

        $fixed_title = '客服管理 - '.$title;

        $action_span = [
            [
                'url' => 'list',
                'icon' => 'fa-reply',
                'text' => '返回客服列表'
            ],
        ];

        $explain_panel = [];
        $blocks = [
            'explain_panel' => $explain_panel,
            'fixed_title' => $fixed_title,
            'action_span' => $action_span
        ];

        $this->setLayoutBlock($blocks); // 设置block

        $customer_type = CustomerType::where([['is_show', 1], ['shop_id', seller_shop_info()->shop_id]])->orderBy('type_sort', 'asc')->get();

        return view('shop.customer.add', compact('title', 'customer_type'));
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
        $post = $request->post('CustomerModel');

        if (!empty($post['customer_id'])) {
            // 编辑
            $ret = $this->customer->update($post['customer_id'], $post);
            $msg = '客服编辑';
        }else {
            // 添加
            $post['shop_id'] = seller_shop_info()->shop_id;
            $ret = $this->customer->store($post);
            $msg = '客服添加';
        }

        if ($ret === false) {
            // fail
            flash('error', $msg.'失败');
            return redirect('/shop/customer/list');
        }
        // success
        flash('success', $msg.'成功');
        return redirect('/shop/customer/list');
    }

    public function editCustomerInfo(Request $request)
    {
        $id = $request->post('customer_id');
        $title = $request->post('title');
        $value = $request->post('value');

        if (in_array($title, ['customer_sort'])) {
            $value = intval($value);
        }
        $ret = $this->customer->update($id, [$title => $value]);

        if ($ret === false) {
            return result(-1, '', '设置失败');
        }
        return result(0, '', '设置成功');
    }

    public function setIsMain(Request $request)
    {
        $id = $request->get('id');
        $ret = $this->customer->changeState($id, 'is_main');
        if ($ret === false) {
            return result(-1, '', '设置失败');
        }
        return result(0, $ret, '设置成功');
    }

    public function setIsShow(Request $request)
    {
        $id = $request->get('id');
        $ret = $this->customer->changeState($id, 'is_show');
        if ($ret === false) {
            return result(-1, '', '设置失败');
        }
        return result(0, $ret, '设置成功');
    }

    public function delete(Request $request)
    {
        $id = $request->post('id');
        $ret = $this->customer->del($id);
        if ($ret === false) {
            // Log
            shop_log('客服删除失败。ID：'.$id);
            return result(-1, '', '删除失败');
        }
        // Log
        shop_log('客服删除成功。ID：'.$id);
        return result(0, '', '删除成功');
    }

    public function batchDelete(Request $request)
    {
        $ids = $request->post('ids');
        $ret = $this->customer->batchDel($ids);

        $ids = implode(',', $ids);
        if ($ret === false) {
            // Log
            shop_log('客服批量删除失败。ID：'.$ids);
            return result(-1, '', '删除失败');
        }
        // Log
        shop_log('客服批量删除成功。ID：'.$ids);
        return result(0, '', '删除成功');
    }

    /**
     * 客服设置
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function customerSet(Request $request)
    {

        $title = '设置';

        $this->sublink($this->links, 'customer-set', '', '', 'add,edit');

        $fixed_title = '客服管理 - '.$title;

        $action_span = [];

        $explain_panel = [];
        $blocks = [
            'explain_panel' => $explain_panel,
            'fixed_title' => $fixed_title,
            'action_span' => $action_span
        ];

        $this->setLayoutBlock($blocks); // 设置block

        if ($request->method() == 'POST') {
            $post = $request->post('CustomerSetModel');
            $ret = $this->shop->update(seller_shop_info()->shop_id, $post);
            if ($ret === false) {
                // fail
                flash('error', '操作失败');
                return redirect('/shop/customer/customer-set');
            }
            // success
            flash('success', '操作成功');
            return redirect('/shop/customer/customer-set');
        }

        // 获取数据
        $model = $this->shop->getShopInfo(seller_shop_info()->shop_id)->toArray();

        $compact = compact('title', 'model');

        $webData = []; // web端（pc、mobile）数据对象
        $data = [
            'app_extra_data' => [],
            'app_prefix_data' => [
                'model' => $model
            ],
            'app_context_data' => $this->getAppContext(),
            'app_suffix_data' => [],
            'web_data' => $webData,
            'compact_data' => $compact,
            'tpl_view' => 'shop.customer.customer_set'
        ];
        $this->setData($data); // 设置数据
        return $this->displayData(); // 模板渲染及APP客户端返回数据

//        return view('shop.customer.customer_set', compact('title'));
    }

}