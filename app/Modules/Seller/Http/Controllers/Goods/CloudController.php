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
// | Date:2018-11-01
// | Description: 数据采集
// +----------------------------------------------------------------------

namespace App\Modules\Seller\Http\Controllers\Goods;

use App\Modules\Base\Http\Controllers\Seller;
use Illuminate\Http\Request;

class CloudController extends Seller
{

    private $links = [
        ['url' => 'goods/cloud/goods-list', 'text' => '云产品库采集'],
        ['url' => 'goods/collect/show', 'text' => '批量采集'],
        ['url' => 'goods/collect-comment/goods-list', 'text' => '评论采集'],
    ];


    public function __construct()
    {
        parent::__construct();


        $this->set_menu_select('goods', 'goods-cloud-manage');

    }

    public function cloudManage(Request $request)
    {
        $title = '数据采集';
        $fixed_title = $title;

        $action_span = [];

        $explain_panel = [];
        $blocks = [
            'explain_panel' => $explain_panel,
            'fixed_title' => $fixed_title,
            'action_span' => $action_span
        ];

        $this->setLayoutBlock($blocks); // 设置block

        return view('goods.cloud.cloud_manage', compact('title'));
    }

    public function goodsList(Request $request)
    {
        $title = '云产品库采集';
        $fixed_title = '数据采集 - '.$title;

        $this->sublink($this->links, 'goods/cloud/goods-list');

        $action_span = [
            [
                'url' => '',
                'id' => 'shopcollectinfo',
                'icon' => '',
                'text' => '查看我的采集数量'
            ],
        ];

        $explain_panel = [
            '采集到的商品数据请参考淘宝pc端和客户端（手机端）来对照，优先pc端',
            '为了在线采集稳定、准确、快速，强烈建议每页采集条数控制在20以下'
        ];
        $blocks = [
            'explain_panel' => $explain_panel,
            'fixed_title' => $fixed_title,
            'action_span' => $action_span
        ];

        $this->setLayoutBlock($blocks); // 设置block

        $where = [];
        $where[] = ['shop_id', seller_shop_info()->shop_id];
        // 搜索条件
        $search_arr = [
            'barcodes', // 条形码 多个请用逗号分隔
            'keyword', // 商品ID/名称
            'cat_id', // 分类id
            'brand_id' // 品牌id
        ];
        foreach ($search_arr as $v) {
            if (isset($params[$v]) && !empty($params[$v])) {

                if ($v == 'keyword') {
                    $where[] = [$v, 'like', "%{$params[$v]}%"];
                } else {
                    $where[] = [$v, $params[$v]];
                }
            }
        }
        // 列表
        $condition = [
            'where' => $where,
            'sortname' => 'id',
            'sortorder' => 'desc',
        ];
        list($list, $total) = [[1], 1]; //$this->goodsUnit->getList($condition);

        $pageHtml = pagination($total);

        if ($request->method() == 'POST') {
            $render = view('goods.cloud.partials._goods_list', compact('list', 'total', 'pageHtml'))->render();
            return result(0, $render);
        }
        return view('goods.cloud.goods_list', compact('title', 'list', 'pageHtml'));
    }

    /**
     * 查看我的采集数量
     *
     * @param Request $request
     * @return array
     * @throws \Throwable
     */
    public function ajaxCollectInfo(Request $request)
    {
        $collect_allow_number = seller_shop_info()->collect_allow_number; // 允许采集商品数量
        $collected_number = seller_shop_info()->collected_number; // 已采集商品数量

        $render = view('goods.cloud.ajax_collect_info', compact('collect_allow_number', 'collected_number'))->render();
        return result(0, $render);
    }

    /**
     * 导入商品
     *
     * @param Request $request
     * @return array
     * @throws \Throwable
     */
    public function ajaxSetting(Request $request)
    {
        $goods_ids = $request->post('goods_ids', '');

        // 判断是否有采集数量
        $collect_allow_number = seller_shop_info()->collect_allow_number; // 允许采集商品数量
        $collected_number = seller_shop_info()->collected_number; // 已采集商品数量
        $rest_collect_number = $collect_allow_number - $collected_number; // 剩余可采集商品数量

        if ($rest_collect_number <= 0 || count(explode(',', $goods_ids)) > $rest_collect_number) {
            return result(1, 0, '您已无可抓取数据条数，共抓取了<strong>0</strong>条数据，用了<strong>0</strong>条数据，还有<strong>0</strong>条数据!<br>请联系平台方购买采集条数！');
        }

        $render = view('goods.cloud.ajax_setting')->render();
        return result(0, $render);
    }

    /**
     * 执行导入商品操作
     *
     * @param Request $request
     * @return array
     */
    public function import(Request $request)
    {

        $data = "54"; // 导入成功的商品id
        $extra = [
            'setting' => false
        ];

        return result(1, $data, '导入成功', $extra);
    }

}