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
// | Description: 批量采集
// +----------------------------------------------------------------------

namespace App\Modules\Seller\Http\Controllers\Goods;

use App\Modules\Base\Http\Controllers\Seller;
use Illuminate\Http\Request;

class CollectController extends Seller
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

    public function show(Request $request)
    {
        $title = '批量采集';
        $fixed_title = '数据采集 - '.$title;

        $this->sublink($this->links, 'goods/collect/show');

        $action_span = [
            [
                'url' => '/goods/cloud/goods-list',
                'id' => '',
                'icon' => 'fa-reply',
                'text' => '返回数据采集'
            ],
            [
                'url' => '',
                'id' => 'shopcollectinfo',
                'icon' => '',
                'text' => '查看我的采集数量'
            ],
        ];

        $explain_panel = [
            '为了在线采集稳定、准确、快速，强烈建议一次采集少于10个商品',
            '<font color="red">采集机制更换，时时采集在线数据，保证数据的准确性，及时性，同时保证稳定，采集速度有所下降，请谅解！</font>'
        ];
        $blocks = [
            'explain_panel' => $explain_panel,
            'fixed_title' => $fixed_title,
            'action_span' => $action_span
        ];

        $this->setLayoutBlock($blocks); // 设置block

        return view('goods.collect.show', compact('title'));
    }


}