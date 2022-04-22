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

class LibGoodsController extends Seller
{

    private $links = [
        ['url' => 'goods/lib-goods/index', 'text' => '手动导入'],
        ['url' => 'goods/lib-goods/auto', 'text' => '批量智能导入'],
        ['url' => 'goods/lib-goods/file', 'text' => '文件导入'],
        ['url' => 'goods/lib-goods/scan', 'text' => '扫码导入'],

    ];


    public function __construct()
    {
        parent::__construct();


        $this->set_menu_select('goods', 'goods-cloud-manage');

    }

    public function index(Request $request)
    {
        return $this->list($request);
    }

    public function list(Request $request)
    {
        $title = '列表';
        $fixed_title = '数据采集 - '.$title;

        $this->sublink($this->links, 'index', '', '', 'file,scan');

        $action_span = [
            [
                'url' => '/goods/cloud/cloud-manage',
                'id' => '',
                'icon' => 'fa-reply',
                'text' => '返回数据采集'
            ],
        ];

        $explain_panel = [
            '产品库拥有最全的产品信息，店铺和供货商均可直接从产品库中复制商品上架至自己的店铺，从而省去发布商品的繁琐步骤',
            '产品库里的产品信息是公开的，由平台方添加'
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
            'goods_barcode', // 条形码
            'keyword', // 关键字 商品ID/货号/名称
            'cat_id', // 分类id
            'brand_id', // 品牌id
            'sales_model', // 销售模式
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
            $render = view('goods.lib-goods.partials._list', compact('list', 'total', 'pageHtml'))->render();
            return result(0, $render);
        }
        return view('goods.lib-goods.list', compact('title', 'list', 'pageHtml'));
    }

    /**
     * 商品导入
     *
     * @param Request $request
     * @return array
     * @throws \Throwable
     */
    public function import(Request $request)
    {

        $render = view('goods.lib-goods.import')->render();
        return result(0, $render);
    }

    public function skuList(Request $request)
    {

        $render = view('goods.lib-goods.sku_list')->render();
        return result(0, $render);
    }

    public function auto(Request $request)
    {
        $title = '选择导入类型';
        $fixed_title = '数据采集 - '.$title;

        $this->sublink($this->links, 'auto', '', '', 'file,scan');

        $action_span = [
            [
                'url' => '/goods/cloud/cloud-manage',
                'id' => '',
                'icon' => 'fa-reply',
                'text' => '返回数据采集'
            ],
        ];

        $explain_panel = [];
        $blocks = [
            'explain_panel' => $explain_panel,
            'fixed_title' => $fixed_title,
            'action_span' => $action_span
        ];

        $this->setLayoutBlock($blocks); // 设置block


        return view('goods.lib-goods.auto', compact('title'));
    }

    public function file(Request $request)
    {
        $title = '文件导入';
        $fixed_title = '数据采集 - '.$title;

        $this->sublink($this->links, 'file', '', '', 'index,scan');

        $action_span = [
            [
                'url' => 'auto',
                'id' => '',
                'icon' => 'fa-reply',
                'text' => '返回批量智能导入'
            ],
        ];

        $explain_panel = [
            '上传商品库文件，点击预览，即可查看要导入的商品。',
            '通过上传文件获得的商品库商品，商家可自行决定删除或导入，"已导入"色块标记该商品库商品已经被导入到自己店铺了，不会重复导入。'
        ];
        $blocks = [
            'explain_panel' => $explain_panel,
            'fixed_title' => $fixed_title,
            'action_span' => $action_span
        ];

        $this->setLayoutBlock($blocks); // 设置block

        if ($request->method() == 'POST') {

            //
            flash('error', '您未上传文件或上传了一个空文件');
            return redirect('/goods/lib-goods/file.html');
        }


        return view('goods.lib-goods.file', compact('title'));
    }

    public function scan(Request $request)
    {
        $title = '扫码导入';
        $fixed_title = '数据采集 - '.$title;

        $this->sublink($this->links, 'san', '', '', 'index,file');

        $action_span = [
            [
                'url' => 'auto',
                'id' => '',
                'icon' => 'fa-reply',
                'text' => '返回批量智能导入'
            ],
        ];

        $explain_panel = [
            '使用扫码枪扫描系统商品库商品条形码，或直接输入系统商品库条形码，回车换行输入，点击预览，即可查看要导入的系统商品库商品。',
            '下载预览结果：可将系统商品库中未有对应条形码的商品标记出来，方便提供给平台管理员进行维护无条形码的商品。',
            '通过扫描获得的系统商品库商品，商家可自行决定是否导入，"已导入"色块标记该商品已经被导入到店铺，不会重复导入。'
        ];
        $blocks = [
            'explain_panel' => $explain_panel,
            'fixed_title' => $fixed_title,
            'action_span' => $action_span
        ];

        $this->setLayoutBlock($blocks); // 设置block

        return view('goods.lib-goods.scan', compact('title'));
    }

    public function scanPreview(Request $request)
    {
        $title = '预览';
        $fixed_title = '数据采集 - '.$title;

        $action_span = [];

        $explain_panel = [];
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
            'goods_barcode', // 条形码
            'keyword', // 关键字 商品ID/货号/名称
            'cat_id', // 分类id
            'brand_id', // 品牌id
            'sales_model', // 销售模式
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
            $render = view('goods.lib-goods.partials._scan_preview', compact('list', 'total', 'pageHtml'))->render();
            return result(0, $render);
        }
        return view('goods.lib-goods.scan_preview', compact('title', 'list', 'pageHtml'));
    }
}