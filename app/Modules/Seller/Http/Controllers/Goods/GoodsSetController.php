<?php

namespace App\Modules\Seller\Http\Controllers\Goods;

use App\Modules\Base\Http\Controllers\Seller;
use App\Repositories\ShopConfigFieldRepository;
use Illuminate\Http\Request;

class GoodsSetController extends Seller
{

    protected $shopConfigField;

    private $links = [
        ['url' => 'goods/goods-set/index', 'text' => '基本设置'],
        ['url' => 'goods/goods-unit/list', 'text' => '商品单位'],
        ['url' => 'goods/layout/list', 'text' => '详情版式'],
        ['url' => 'goods/questions/list', 'text' => '常见问题'],
    ];


    public function __construct()
    {
        parent::__construct();

        $this->shopConfigField = new ShopConfigFieldRepository();

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
        $group_info = $this->shopConfigField->getConfigList($group);
        $uuid = make_uuid();
        $script_render = view('shop.config.partials.'.$group, compact('uuid'))->render();

        return view('shop.config.config', compact('title', 'group', 'group_info', 'script_render'));
    }
}