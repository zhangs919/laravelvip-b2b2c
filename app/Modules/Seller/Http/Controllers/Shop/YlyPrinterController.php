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
// | Description: 易联云打印机
// +----------------------------------------------------------------------

namespace app\Modules\Seller\Http\Controllers\Shop;

use App\Modules\Base\Http\Controllers\Seller;
use App\Repositories\YlyPrinterRepository;
use Illuminate\Http\Request;

/**
 * 易联云打印机管理
 * Class YlyPrinterController
 * @package app\Modules\Seller\Http\Controllers\Shop
 */
class YlyPrinterController extends Seller
{

    private $links = [
        ['url' => 'shop/print-spec/spec_list', 'text' => '打印规格设置'],
        ['url' => 'shop/yly-printer/yly_list', 'text' => '易联云打印机'],
        ['url' => 'shop/yly-printer/add', 'text' => '添加打印机'],
        ['url' => 'shop/yly-printer/edit', 'text' => '编辑打印机'],
    ];

    protected $ylyPrinter;

    public function __construct()
    {
        parent::__construct();

        $this->ylyPrinter = new YlyPrinterRepository();

        $this->set_menu_select('shop', 'shop-print-spec');
    }

    public function lists(Request $request)
    {
        $title = '易联云打印机';
        $fixed_title = '打印设置 - '.$title;
        $this->sublink($this->links, 'yly_list', '', '', 'add,edit');

        $action_span = [
            [
                'url' => 'add',
                'icon' => 'fa-plus',
                'text' => '添加打印机'
            ],
        ];

        $explain_panel = [
            '易联云打印机需填写正确的打印机终端号和密钥方可添加成功，易联云（全网K4型号）可从官方进行购买'
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
        list($list, $total) = $this->ylyPrinter->getList($condition);

        $pageHtml = pagination($total);
        
        $compact = compact('title', 'list', 'total', 'pageHtml');
        if ($request->ajax()) {
            $render = view('shop.yly-printer.partials._list', $compact)->render();
            return result(0, $render);
        }
        return view('shop.yly-printer.list', $compact);
    }

    public function add(Request $request)
    {
        $title = '添加';
        $id = $request->get('id', 0);

        $this->sublink($this->links, 'add', '', '', 'spec_list,edit');

        if ($id) {
            // 更新操作
            $this->sublink($this->links, 'edit', '', '', 'spec_list,add');

            $info = $this->ylyPrinter->getById($id);
            view()->share('info', $info);
            $title = '编辑';
        }

        $fixed_title = '打印设置 - '.$title;

        $action_span = [
            [
                'url' => 'list',
                'icon' => 'fa-reply',
                'text' => '返回易联云打印机'
            ],
        ];

        $explain_panel = [];
        $blocks = [
            'explain_panel' => $explain_panel,
            'fixed_title' => $fixed_title,
            'action_span' => $action_span
        ];

        $this->setLayoutBlock($blocks); // 设置block

        return view('shop.yly-printer.add', compact('title'));
    }

    public function edit(Request $request)
    {
        return $this->add($request);
    }

    /**
     * 保存信息
     * todo 易联云打印机需填写正确的打印机终端号和密钥方可添加成功
     * @param Request $request
     * @return mixed
     */
    public function saveData(Request $request)
    {
        $post = $request->post('YlyPrinterModel');

        if (!empty($post['id'])) {
            // 编辑
            $ret = $this->ylyPrinter->update($post['id'], $post);
            $msg = '打印机编辑';
        }else {
            // 添加
            $post['shop_id'] = seller_shop_info()->shop_id;
            $ret = $this->ylyPrinter->store($post);
            $msg = '打印机添加';
        }

        if ($ret === false) {
            // fail
            flash('error', $msg.'失败');
            return redirect('/shop/yly-printer/list');
        }
        // success
        flash('success', $msg.'成功');
        return redirect('/shop/yly-printer/list');
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

        $ret = $this->ylyPrinter->setDefault($id, seller_shop_info()->shop_id);
        if ($ret === false) {
            return result(-1, null, '设置失败');
        }

        return result(0, null, '设置成功！');
    }

    public function delete(Request $request)
    {
        $id = $request->post('id');
        $ret = $this->ylyPrinter->del($id);
        if ($ret === false) {
            return result(-1, '', '删除失败');
        }
        return result(0, '', '删除成功');
    }

}