<?php

// +----------------------------------------------------------------------
// | Laravelvip 乐融沃B2B2C商城系统
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
// | Date:2018-07-26
// | Description:
// +----------------------------------------------------------------------

namespace App\Modules\Seller\Http\Controllers\Goods;

use App\Modules\Base\Http\Controllers\Seller;
use App\Repositories\GoodsTagRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class GoodsTagController extends Seller
{

    private $links = [
        ['url' => 'goods/goods-set/index', 'text' => '基本设置'],
        ['url' => 'goods/goods-tag/list', 'text' => '商品标签'],
        ['url' => 'goods/goods-unit/list', 'text' => '商品单位'],
        ['url' => 'goods/layout/list', 'text' => '详情版式'],
        ['url' => 'goods/questions/list', 'text' => '常见问题'],
        ['url' => 'goods/shop-shipper/list', 'text' => '商品发货方'],
    ];


    protected $goodsTag;

    public function __construct(GoodsTagRepository $goodsTag)
    {
        parent::__construct();

        $this->goodsTag = $goodsTag;

        $this->set_menu_select('goods', 'goods-set');

    }

    public function lists(Request $request)
    {
        $title = '商品标签';
        $fixed_title = '商品设置 - '.$title;

        $this->sublink($this->links, 'goods/goods-tag/list');

        $action_span = [
            [
                'url' => 'add',
                'icon' => 'fa-plus',
                'text' => '添加商品标签'
            ],
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
        $where[] = ['shop_id', seller_shop_info()->shop_id];
        // 搜索条件
        $search_arr = ['keyword','tag_position'];
        foreach ($search_arr as $v) {
            if (isset($params[$v]) && !empty($params[$v])) {

                if ($v == 'keyword') {
                    $where[] = ['tag_name', 'like', "%{$params[$v]}%"];
                } else {
                    $where[] = [$v, $params[$v]];
                }
            }
        }
        // 列表
        $condition = [
            'where' => $where,
            'sortname' => 'tag_id',
            'sortorder' => 'desc',
        ];
        list($list, $total) = $this->goodsTag->getList($condition);

        $pageHtml = pagination($total);

        if ($request->ajax()) {
            $render = view('goods.goods-tag.partials._list', compact('list', 'total', 'pageHtml'))->render();
            return result(0, $render);
        }

        $tagPosition = $this->tagPosition();

        return view('goods.goods-tag.list', compact('title', 'list', 'pageHtml', 'tagPosition'));
    }

    public function add(Request $request)
    {
        $title = '添加商品标签';

        $id = $request->get('id', 0);

        if ($id) {
            // 更新操作
            $info = $this->goodsTag->getById($id);
            if (Str::contains($info->tag_image, 'superscript')) {
//                $info->tag_image = '/assets/d2eace91'.$info->tag_image;
                $info->self_img = false;
            } else {
//                $info->tag_image = get_image_url($info->tag_image);
                $info->self_img = true;
            }
            view()->share('info', $info);
            $title = '编辑商品标签';
        }

        $fixed_title = '商品设置 - '.$title;

        $action_span = [
            [
                'url' => 'list',
                'icon' => 'fa-reply',
                'text' => '返回商品标签列表'
            ],
        ];

        $explain_panel = [];
        $blocks = [
            'explain_panel' => $explain_panel,
            'fixed_title' => $fixed_title,
            'action_span' => $action_span
        ];

        $this->setLayoutBlock($blocks); // 设置block

        $tagPosition = $this->tagPosition();

        return view('goods.goods-tag.add', compact('title', 'tagPosition'));
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
        $post = $request->post('GoodsTag');

        if (!empty($post['tag_id'])) {
            // 编辑
            $ret = $this->goodsTag->update($post['tag_id'], $post);
            $msg = '商品标签编辑';
        }else {
            // 添加
            $post['shop_id'] = seller_shop_info()->shop_id;
            $ret = $this->goodsTag->store($post);
            $msg = '商品标签添加';
        }

        if ($ret === false) {
            // fail
            return result(-1, null, $msg.'失败');
        }
        // success
        return result(0, null, $msg.'成功');
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
            $ret = $this->goodsTag->batchDel(explode(',', $id));
        } else {
            $ret = $this->goodsTag->del($id);
        }
        if ($ret === false) {
            // Log
            return result(-1, null, '删除失败');
        }

        // Log
        return result(0, null, '删除成功');
    }

    /**
     * 标签位置列表
     *
     * @param $key
     * @return array|mixed
     */
    private function tagPosition($key = '')
    {
        $data = [
            '左上角',
            '右上角',
            '左下角',
            '右下角',
            '中间'
        ];

        return !empty($id) ? $data[$key] : $data;
    }

}