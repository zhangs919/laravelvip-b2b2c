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
// | Description:
// +----------------------------------------------------------------------

namespace App\Modules\Seller\Http\Controllers\Goods;

use App\Modules\Base\Http\Controllers\Seller;
use App\Repositories\GoodsLayoutRepository;
use Illuminate\Http\Request;

class LayoutController extends Seller
{

    private $links = [
        ['url' => 'goods/goods-set/index', 'text' => '基本设置'],
        ['url' => 'goods/goods-tag/list', 'text' => '商品标签'],
        ['url' => 'goods/goods-unit/list', 'text' => '商品单位'],
        ['url' => 'goods/layout/list', 'text' => '详情版式'],
        ['url' => 'goods/questions/list', 'text' => '常见问题'],
        ['url' => 'goods/shop-shipper/list', 'text' => '商品发货方'],
    ];

    private $manage_links = [
        ['url' => 'goods/layout/list', 'text' => '详情版式列表'],
        ['url' => 'goods/layout/add', 'text' => '添加'],
        ['url' => 'goods/layout/edit', 'text' => '编辑'],
    ];

    protected $goodsLayout;


    public function __construct(GoodsLayoutRepository $goodsLayout)
    {
        parent::__construct();

        $this->goodsLayout = $goodsLayout;

        $this->set_menu_select('goods', 'goods-set');

    }

    public function lists(Request $request)
    {
        $title = '详情版式';
        $fixed_title = '商品设置 - '.$title;

        $this->sublink($this->links, 'goods/layout/list');

        $action_span = [
            [
                'url' => 'add',
                'icon' => 'fa-plus',
                'text' => '添加详情版式'
            ],
        ];

        $explain_panel = [
            '可设置前台商品详情页的头部和底部公用模板，以及前台商品详情页的包装清单和售后保障',
            '设置详情版式后，需在发布商品时管理设置的详情版式，这样前台商品详情页才展示',
            '店铺设置自己店铺的详情版式，仅供自己店铺商品使用',
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
        // 搜索条件
        $search_arr = ['layout_name','position'];
        foreach ($search_arr as $v) {
            if (isset($params[$v]) && !empty($params[$v])) {

                if ($v == 'layout_name') {
                    $where[] = [$v, 'like', "%{$params[$v]}%"];
                } else {
                    $where[] = [$v, $params[$v]];
                }
            }
        }
        // 列表
        $condition = [
            'where' => $where,
            'sortname' => 'layout_id',
            'sortorder' => 'desc',
        ];
        list($list, $total) = $this->goodsLayout->getList($condition);

        $pageHtml = pagination($total);
        if ($request->ajax()) {
            $render = view('goods.layout.partials._list', compact('list', 'total', 'pageHtml'))->render();
            return result(0, $render);
        }
        return view('goods.layout.list', compact('title', 'list', 'pageHtml'));
    }

    public function add(Request $request)
    {
        $title = '添加详情版式';
        $this->sublink($this->manage_links, 'add', '', '', 'edit');

        $id = $request->get('id', 0);

        if ($id) {
            // 更新操作
            $info = $this->goodsLayout->getById($id);
            view()->share('info', $info);
            $title = '编辑详情版式';
            $this->sublink($this->manage_links, 'edit', '', '', 'add');

        }

        $fixed_title = '商品设置 - '.$title;

        $action_span = [
            [
                'url' => 'list',
                'icon' => 'fa-reply',
                'text' => '返回详情版式列表'
            ],
        ];

        $explain_panel = [
            '详情顶部、详情底部展示在商品详情的头部和底部',
            '包装清单、售后保障在商品详情下方展示',
            '模板内容上传图片，建议上传宽度为800像素的图片',
        ];
        $blocks = [
            'explain_panel' => $explain_panel,
            'fixed_title' => $fixed_title,
            'action_span' => $action_span
        ];

        $this->setLayoutBlock($blocks); // 设置block

        return view('goods.layout.add', compact('title'));
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
        $post = $request->post('GoodsLayoutModel');

        if (!empty($post['layout_id'])) {
            // 编辑
            $ret = $this->goodsLayout->update($post['layout_id'], $post);
            $msg = '详情版式编辑';
        }else {
            // 添加
            $post['shop_id'] = seller_shop_info()->shop_id;
            $ret = $this->goodsLayout->store($post);
            $msg = '详情版式添加';
        }

        if ($ret === false) {
            // fail
            return result(-1, null, $msg.'失败');
        }
        // success
        return result(0, null, $msg.'成功');
    }

    /**
     * 名称验证是否重复
     *
     * @param Request $request
     * @return mixed
     */
    public function clientValidate(Request $request)
    {
        $result = $this->goodsLayout->clientValidate($request, 'GoodsLayoutModel');
        if (!$result['code']) {
            return result(-1, '', $result['message']);
        }
        return result(0);
    }

    /**
     * 删除
     * @param Request $request
     * @return mixed
     */
    public function delete(Request $request)
    {
        $id = $request->post('id');
        if (count(explode(',', $id)) > 1) {
            // 批量删除
            $ret = $this->goodsLayout->batchDel(explode(',', $id));
        } else {
            $ret = $this->goodsLayout->del($id);
        }
        if ($ret === false) {
            // Log
            return result(-1, null, '删除失败');
        }

        // Log
        return result(0, null, '删除成功');
    }

}