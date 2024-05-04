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
// | Description: 发/退货地址库
// +----------------------------------------------------------------------

namespace App\Modules\Seller\Http\Controllers\Shop;

use App\Modules\Base\Http\Controllers\Seller;
use App\Repositories\ShopAddressRepository;
use Illuminate\Http\Request;

/**
 * 发/退货地址库管理
 * Class ShopAddressController
 * @package app\Modules\Seller\Http\Controllers\Shop
 */
class ShopAddressController extends Seller
{

    private $links = [
        ['url' => 'shop/config/index?group=trade', 'text' => '基本设置'],
        ['url' => 'shop/config/auto-delivery', 'text' => '自动发货设置'],
        ['url' => 'shop/shop-address/list', 'text' => '发/退货地址库'],
        ['url' => 'shop/shop-address/add', 'text' => '添加'],
        ['url' => 'shop/shop-address/edit', 'text' => '编辑'],
    ];

    protected $shopAddress;

    public function __construct(ShopAddressRepository $shopAddress)
    {
        parent::__construct();

        $this->shopAddress = $shopAddress;

        $this->set_menu_select('trade', 'trade-set');
    }

    public function lists(Request $request)
    {
        $title = '列表';
        $fixed_title = '发/退货地址库 - '.$title;
        $this->sublink($this->links, 'list', '', '', 'add,edit');

        $action_span = [
            [
                'url' => 'add',
                'icon' => 'fa-plus',
                'text' => '添加发/退货地址'
            ],
        ];

        $explain_panel = [
            '发/退货地址库，是供卖家发货时选择，标记卖家的发货地址，买家发生退货申请时，卖家给买家发送的寄回地址',
            '默认地址：卖家发货和卖家给买家发送寄回地址时自动调取默认地址'
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
            'sortname' => 'address_id',
            'sortorder' => 'desc'
        ];
        list($list, $total) = $this->shopAddress->getList($condition);

        $pageHtml = pagination($total);
        
        $compact = compact('title', 'list', 'total', 'pageHtml');
        if ($request->ajax()) {
            $render = view('shop.shop-address.partials._list', $compact)->render();
            return result(0, $render);
        }
        return view('shop.shop-address.list', $compact);
    }

    public function add(Request $request)
    {
        $title = '添加';
        $id = $request->get('id', 0);

        $this->sublink($this->links, 'add', '', '', 'edit');

        if ($id) {
            // 更新操作
            $this->sublink($this->links, 'edit', '', '', 'add');

            $info = $this->shopAddress->getById($id);
            view()->share('info', $info);
            $title = '编辑';
        }

        $fixed_title = '发/退货地址库 - '.$title;

        $action_span = [
            [
                'url' => 'list',
                'icon' => 'fa-reply',
                'text' => '返回地址库列表'
            ],
        ];

        $explain_panel = [];
        $blocks = [
            'explain_panel' => $explain_panel,
            'fixed_title' => $fixed_title,
            'action_span' => $action_span
        ];

        $this->setLayoutBlock($blocks); // 设置block

        return view('shop.shop-address.add', compact('title'));
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
        $post = $request->post('ShopAddressModel');

        if (!empty($post['address_id'])) {
            // 编辑
            $ret = $this->shopAddress->update($post['address_id'], $post);
            $msg = '发/退货地址库编辑';
        }else {
            // 添加
            $post['shop_id'] = seller_shop_info()->shop_id;
            $ret = $this->shopAddress->store($post);
            $msg = '发/退货地址库添加';
        }

        if ($ret === false) {
            // fail
            flash('error', $msg.'失败');
            return redirect('/shop/shop-address/list');
        }
        // success
        flash('success', $msg.'成功');
        return redirect('/shop/shop-address/list');
    }

    /**
     * 设置默认地址
     * @param Request $request
     * @return array
     */
    public function isDefault(Request $request)
    {
        $id = $request->get('id');
        if (!$id) {
            // fail
            flash('error', '参数错误');
            return redirect('/shop/shop-address/list');
        }

        $ret = $this->shopAddress->setDefault($id, seller_shop_info()->shop_id);
        if ($ret === false) {
            // fail
            flash('error', '设置失败！');
            return redirect('/shop/shop-address/list');
        }

        flash('success', '设置成功！');
        return redirect('/shop/shop-address/list');
    }

    public function delete(Request $request)
    {
        $id = $request->post('id');
        $ret = $this->shopAddress->del($id);
        if ($ret === false) {
            // Log
            shop_log('发/退货地址库删除失败。ID：'.$id);
            return result(-1, '', '删除失败');
        }
        // Log
        shop_log('发/退货地址库删除成功。ID：'.$id);
        return result(0, '', '删除成功');
    }

    public function batchDelete(Request $request)
    {
        $ids = $request->post('ids');
        $ret = $this->shopAddress->batchDel($ids);

        $ids = implode(',', $ids);
        if ($ret === false) {
            // Log
            shop_log('发/退货地址库批量删除失败。ID：'.$ids);
            return result(-1, '', '删除失败');
        }
        // Log
        shop_log('发/退货地址库批量删除成功。ID：'.$ids);
        return result(0, '', '删除成功');
    }

}