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
use App\Repositories\ShopConfigFieldRepository;
use Illuminate\Http\Request;

class GoodsSetController extends Seller
{

    protected $shopConfigField;

    private $links = [
        ['url' => 'goods/goods-set/index', 'text' => '基本设置'],
        ['url' => 'goods/goods-tag/list', 'text' => '商品标签'],
        ['url' => 'goods/goods-unit/list', 'text' => '商品单位'],
        ['url' => 'goods/layout/list', 'text' => '详情版式'],
        ['url' => 'goods/questions/list', 'text' => '常见问题'],
        ['url' => 'goods/shop-shipper/list', 'text' => '商品发货方'],
    ];


    public function __construct(ShopConfigFieldRepository $shopConfigField)
    {
        parent::__construct();

        $this->shopConfigField = $shopConfigField;

        $this->set_menu_select('goods', 'goods-set');

    }

    public function index(Request $request)
    {
        $title = '基本设置';
        $fixed_title = '商品设置 - '.$title;

        $this->sublink($this->links, 'goods/goods-set/index');

        $action_span = [];

        $explain_panel = [];
        $blocks = [
            'explain_panel' => $explain_panel,
            'fixed_title' => $fixed_title,
            'action_span' => $action_span
        ];

        $this->setLayoutBlock($blocks); // 设置block

        $group = 'goods'; // 当前配置分组
        $group_info = $this->shopConfigField->getConfigList($group, seller_shop_info()->shop_id);
        $uuid = make_uuid();
        $script_render = view('shop.config.partials.'.$group, compact('uuid'))->render();

        return view('shop.config.config', compact('title', 'group', 'group_info', 'script_render'));
    }
}