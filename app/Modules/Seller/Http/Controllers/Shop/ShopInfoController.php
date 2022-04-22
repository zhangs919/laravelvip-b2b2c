<?php

namespace App\Modules\Seller\Http\Controllers\Shop;

use App\Models\ShopFieldValue;
use App\Modules\Base\Http\Controllers\Seller;
use App\Repositories\ShopRepository;
use Illuminate\Http\Request;

class ShopInfoController extends Seller
{

    private $links = [
        ['url' => 'shop/shop-info/shop-info', 'text' => '店铺信息'],
        ['url' => 'shop/shop-info/renew-list', 'text' => '续签日志'],
        ['url' => 'shop/shop-info/renew-add', 'text' => '申请续签'],
    ];

    protected $shop;


    public function __construct()
    {
        parent::__construct();

        $this->shop = new ShopRepository();

        $this->set_menu_select('shop', 'shop-info');

    }

    public function shopInfo(Request $request)
    {
        $title = '店铺信息';
        $fixed_title = $title;
        $this->sublink($this->links, 'shop-info', '', '', 'renew-add');

        $shop_id = seller_shop_info()->shop_id;

        $action_span = [];

        $explain_panel = [
            '界面展示店主基本信息、店铺经营等信息，仅供查看',
        ];
        $blocks = [
            'explain_panel' => $explain_panel,
            'fixed_title' => $fixed_title,
            'action_span' => $action_span
        ];

        $this->setLayoutBlock($blocks); // 设置block

        $info = $this->shop->getById($shop_id);
        $shop_field_value = ShopFieldValue::where('shop_id', $shop_id)->first();
        // 身份证正面
        if (empty($shop_field_value->card_side_a)) {
            $shop_field_value->card_side_a = get_idcard_demo_image()[0];
        }
        // 身份证背面
        if (empty($shop_field_value->card_side_b)) {
            $shop_field_value->card_side_b = get_idcard_demo_image()[1];
        }
        // 手持身份证
        if (empty($shop_field_value->hand_card)) {
            $shop_field_value->hand_card = get_idcard_demo_image()[2];
        }

        $compact = compact('title', 'info', 'shop_field_value');
//        dd($shop_field_value);


        return view('shop.shop-info.shop_info', $compact);
    }

    public function renewList(Request $request)
    {
        $title = '续签日志';
        $fixed_title = '店铺信息 - '.$title;
        $this->sublink($this->links, 'renew-list', '', '', 'renew-add');


        $action_span = [
            [
                'url' => 'renew-add',
                'icon' => 'fa-plus',
                'text' => '续签'
            ],
        ];

        $explain_panel = [
            '续签流程：卖家申请续签->卖家线下向平台方缴纳使用费->平台方审核，确认收到使用费后，审核通过->卖家申请续签成功，使用有效期自动延长'
        ];
        $blocks = [
            'explain_panel' => $explain_panel,
            'fixed_title' => $fixed_title,
            'action_span' => $action_span
        ];

        $this->setLayoutBlock($blocks); // 设置block

        $where = [];
        // 搜索条件

        // 列表
        /*$condition = [
            'where' => $where,
            'sortname' => 'nav_id',
            'sortorder' => 'desc'
        ];*/
        list($list, $total) = [[], 0]; //$this->shopNavigation->getList($condition);
        $pageHtml = pagination($total);

        $compact = compact('title', 'list', 'total', 'pageHtml');
        if ($request->ajax()) {
            $render = view('shop.shop-info.partials._renew_list', $compact)->render();
            return result(0, $render);
        }

        return view('shop.shop-info.renew_list', $compact);
    }

    public function renewAdd(Request $request)
    {
        $title = '申请续签';
        $fixed_title = '店铺信息 - '.$title;
        $this->sublink($this->links, 'renew-add');


        $action_span = [
            [
                'url' => 'renew-list',
                'icon' => 'fa-reply',
                'text' => '返回续签日志'
            ],
        ];

        $explain_panel = [];
        $blocks = [
            'explain_panel' => $explain_panel,
            'fixed_title' => $fixed_title,
            'action_span' => $action_span
        ];

        $this->setLayoutBlock($blocks); // 设置block


        $compact = compact('title');

        return view('shop.shop-info.renew_add', $compact);
    }
}