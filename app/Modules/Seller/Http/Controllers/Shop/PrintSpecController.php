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
// | Date:2018-10-22
// | Description: 打印设置
// +----------------------------------------------------------------------

namespace app\Modules\Seller\Http\Controllers\Shop;

use App\Modules\Base\Http\Controllers\Seller;
use App\Repositories\PrintSpecRepository;
use Illuminate\Http\Request;

/**
 * 打印规格管理
 *
 * Class PrintSpecController
 * @package app\Modules\Seller\Http\Controllers\Store
 */
class PrintSpecController extends Seller
{

    private $links = [
        ['url' => 'shop/print-spec/spec_list', 'text' => '打印规格设置'],
        ['url' => 'shop/yly-printer/yly_list', 'text' => '易联云打印机'],
        ['url' => 'shop/print-spec/add', 'text' => '添加'],
        ['url' => 'shop/print-spec/edit', 'text' => '编辑'],
    ];

    protected $printSpec;

    public function __construct()
    {
        parent::__construct();

        $this->printSpec = new PrintSpecRepository();

        $this->set_menu_select('shop', 'shop-print-spec');
    }

    public function lists(Request $request)
    {
        $title = '打印规格设置';
        $fixed_title = '打印设置 - '.$title;
        $this->sublink($this->links, 'spec_list', '', '', 'add,edit');

        $action_span = [
            [
                'url' => 'add',
                'icon' => 'fa-plus',
                'text' => '添加打印规格'
            ],
        ];

        $explain_panel = [
            '仅可设置一种打印规格为默认，在打印订单、打印发货单中，则会以默认打印规格进行展示',
            '自动打印订单，将调取默认打印规格进行打印，使用前，请确定好打印机打印的尺寸与设置的默认打印规格是否一致，否则将无法自动打印'
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
            'sortname' => 'id',
            'sortorder' => 'desc'
        ];
        list($list, $total) = $this->printSpec->getList($condition);

        $pageHtml = pagination($total);
        
        $compact = compact('title', 'list', 'total', 'pageHtml');
        if ($request->ajax()) {
            $render = view('shop.print-spec.partials._list', $compact)->render();
            return result(0, $render);
        }
        return view('shop.print-spec.list', $compact);
    }

    public function add(Request $request)
    {
        $title = '添加';
        $id = $request->get('id', 0);

        $this->sublink($this->links, 'add', '', '', 'edit');

        if ($id) {
            // 更新操作
            $this->sublink($this->links, 'edit', '', '', 'add');

            $info = $this->printSpec->getById($id);
            view()->share('info', $info);
            $title = '编辑';
        }

        $fixed_title = '打印设置 - '.$title;

        $action_span = [
            [
                'url' => 'list',
                'icon' => 'fa-reply',
                'text' => '返回打印规格列表'
            ],
        ];

        $explain_panel = [];
        $blocks = [
            'explain_panel' => $explain_panel,
            'fixed_title' => $fixed_title,
            'action_span' => $action_span
        ];

        $this->setLayoutBlock($blocks); // 设置block

        return view('shop.print-spec.add', compact('title'));
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
        $post = $request->post('PrintSpecModel');

        if (!empty($post['id'])) {
            // 编辑
            $ret = $this->printSpec->update($post['id'], $post);
            $msg = '打印规格编辑';
        }else {
            // 添加
            $post['shop_id'] = seller_shop_info()->shop_id;
            $ret = $this->printSpec->store($post);
            $msg = '打印规格添加';
        }

        if ($ret === false) {
            // fail
            flash('error', $msg.'失败');
            return redirect('/shop/print-spec/list');
        }
        // success
        flash('success', $msg.'成功');
        return redirect('/shop/print-spec/list');
    }

    /**
     * 设置默认打印机
     * @param Request $request
     * @return array
     */
    public function setIsDefault(Request $request)
    {
        $id = $request->get('id');
        if (!$id) {
            return  result(-1, null, '参数错误');
        }

        $ret = $this->printSpec->setDefault($id, seller_shop_info()->shop_id);
        if ($ret === false) {
            return result(-1, null, '设置失败');
        }

        return result(0, null, '设置成功！');
    }

    /**
     * 配置打印机
     *
     * @param Request $request
     * @return array
     * @throws \Throwable
     */
    public function configPrinter(Request $request)
    {
        $id = $request->get('id', 0);
        $info = $this->printSpec->getById($id);

        $render = view('shop.print-spec.config_printer', compact('id', 'info'))->render();

        return result(0, $render);

    }

    /**
     * 配置打印机保存数据
     *
     * @param Request $request
     * @return array
     */
    public function configPrinterSave(Request $request)
    {
        $post = $request->post('PrintSpecModel');
        $ret = $this->printSpec->update($post['id'], $post);
        if ($ret === false) {
            return result(-1, null, '打印机配置失败！');
        }

        return result(0, null, '打印机配置成功！');
    }

    public function delete(Request $request)
    {
        $id = $request->post('id');
        $ret = $this->printSpec->del($id);
        if ($ret === false) {
            return result(-1, '', '删除失败');
        }
        return result(0, '', '删除成功');
    }

}