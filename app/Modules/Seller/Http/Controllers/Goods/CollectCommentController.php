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
// | Description: 评论采集
// +----------------------------------------------------------------------

namespace App\Modules\Seller\Http\Controllers\Goods;

use App\Modules\Base\Http\Controllers\Seller;
use Illuminate\Http\Request;

class CollectCommentController extends Seller
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

    public function goodsList(Request $request)
    {
        $title = '评论采集';
        $fixed_title = '数据采集 - '.$title;

        $this->sublink($this->links, 'goods/collect-comment/goods-list');

        $action_span = [
            [
                'url' => '',
                'id' => 'shopcollectinfo',
                'icon' => '',
                'text' => '查看我的采集数量'
            ],
        ];

        $explain_panel = [
            '评论采集，仅可对从云产品库、天猫、淘宝采集的目前还上架中的商品进行评论采集',
            '同一商品多次采集评论，评论累计会造成重复评论内容，建议合理采集评论'
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
            'keyword', // 关键字 商品ID/货号/名称
            'cat_id', // 分类id
            'goods_status', // 商品状态
            'goods_audit', // 审核状态
            'brand_id', // 品牌id
            'goods_barcode', // 条形码
            'store_id', // 隶属网点
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

        if ($request->ajax()) {
            $render = view('goods.collect-comment.partials._goods_list', compact('list', 'total', 'pageHtml'))->render();
            return result(0, $render);
        }
        return view('goods.collect-comment.goods_list', compact('title', 'list', 'pageHtml'));
    }


    /**
     * 采集评论设置
     *
     * @param Request $request
     * @return array
     * @throws \Throwable
     */
    public function ajaxSetting(Request $request)
    {
        $goods_ids = $request->post('goods_ids', '');

        // 判断是否有采集数量
        $comment_allow_number = seller_shop_info()->comment_allow_number; // 允许采集数量
        $comment_number = seller_shop_info()->comment_number; // 已采集数量
        $rest_comment_number = $comment_allow_number - $comment_number; // 剩余可采集数量

        if ($rest_comment_number <= 0 || count(explode(',', $goods_ids)) > $rest_comment_number) {
            return result(1, 0, '您已无可抓取数据条数，共抓取了<strong>0</strong>条数据，用了<strong>0</strong>条数据，还有<strong>0</strong>条数据!<br>请联系平台方购买采集条数！');
        }

        $render = view('goods.collect-comment.ajax_setting')->render();
        return result(0, $render);
    }

    /**
     * 开始采集评论
     *
     * @param Request $request
     * @return array
     */
    public function ajaxCollect(Request $request)
    {
        $data = false;
        $extra = [
            'goods_id' => "216"
        ];

        return result(1, $data, '商品编号[216]评论<font color=\'red\'>抓取失败</font>，请稍候重试', $extra);
    }


}