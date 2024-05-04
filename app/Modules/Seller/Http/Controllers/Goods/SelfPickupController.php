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
// | Date:2018-08-29
// | Description: 上门自提
// +----------------------------------------------------------------------

namespace App\Modules\Seller\Http\Controllers\Goods;

use App\Modules\Base\Http\Controllers\Seller;
use App\Repositories\SelfPickupRepository;
use Illuminate\Http\Request;

class SelfPickupController extends Seller
{

    private $links = [];

    protected $selfPickup;


    public function __construct(SelfPickupRepository $selfPickup)
    {
        parent::__construct();

        $this->selfPickup = $selfPickup;

        $this->set_menu_select('shop', 'self-pickup');

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
            '此功能一般用于同城交易，如您有线下店铺，或有线下自提点，可使用到店自提功能。买家下单后可获取到订单二维码，到店后向商家出示，商家发货并进行核销',
            '自提点将在店铺商品详情页和结算页面供消费者选择'
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
        // 搜索条件 自提点名称/地址
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

        if ($request->ajax()) {
            $render = view('goods.self-pickup.partials._list', compact('list', 'total', 'pageHtml'))->render();
            return result(0, $render);
        }
        return view('goods.self-pickup.list', compact('title', 'list', 'pageHtml'));
    }

    public function add(Request $request)
    {
        $title = '添加自提点';

        $id = $request->get('id', 0);

        if ($id) {
            // 更新操作
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
            ],
        ];

        $explain_panel = [];
        $blocks = [
            'explain_panel' => $explain_panel,
            'fixed_title' => $fixed_title,
            'action_span' => $action_span
        ];

        $this->setLayoutBlock($blocks); // 设置block

        return view('goods.self-pickup.add', compact('title', 'info'));
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
        $post = $request->post('SelfPickup');

        if (!empty($post['pickup_id'])) {
            // 编辑
            $ret = $this->selfPickup->update($post['pickup_id'], $post);
            $msg = '自提点编辑';
        }else {
            // 添加
            $post['shop_id'] = seller_shop_info()->shop_id;
            $ret = $this->selfPickup->store($post);
            $msg = '自提点添加';
        }

        if ($ret === false) {
            // fail
            return result(-1, null, $msg.'失败');
        }
        // success
        return result(0, null, $msg.'成功');
    }

    public function setIsShow(Request $request)
    {
        $id = $request->get('id');
        $ret = $this->selfPickup->changeState($id, 'is_show');
        if ($ret === false) {
            return result(-1, '', '设置失败');
        }
        return result(0, $ret, '设置成功');
    }

    /**
     * 删除
     * @param Request $request
     * @return mixed
     */
    public function delete(Request $request)
    {
        $id = $request->post('id');
        $ret = $this->selfPickup->del($id);

        if ($ret === false) {
            // Log
            return result(-1, null, '删除失败');
        }

        // Log
        return result(0, null, '删除成功');
    }

}