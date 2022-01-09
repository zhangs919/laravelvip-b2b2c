<?php

namespace App\Modules\Seller\Http\Controllers\Shop;

use App\Modules\Base\Http\Controllers\Seller;
use App\Repositories\ShopConfigFieldRepository;
use App\Repositories\ShopRepository;
use Illuminate\Http\Request;

class ShopSetController extends Seller
{


    private $links = [
        ['url' => 'shop/shop-set/edit', 'text' => '基本设置'],
        ['url' => 'shop/shop-set/other', 'text' => '高级设置'],
    ];

    protected $shop;
    protected $shopConfigField;


    public function __construct()
    {
        parent::__construct();

        $this->shop = new ShopRepository();
        $this->shopConfigField = new ShopConfigFieldRepository();

        $this->set_menu_select('shop', 'shop-set');

    }

    public function edit(Request $request)
    {
        $title = '店铺设置';
        $fixed_title = $title;
        $this->sublink($this->links, 'edit');

        $shop_id = seller_shop_info()->shop_id;

        $action_span = [];

        $explain_panel = [
            '您填写的信息将在店铺前台展示给买家，请认真填写',
        ];
        $blocks = [
            'explain_panel' => $explain_panel,
            'fixed_title' => $fixed_title,
            'action_span' => $action_span
        ];

        $this->setLayoutBlock($blocks); // 设置block

        $info = $this->shop->getShopInfo($shop_id);

//        dd(get_hour_minutes());
        $compact = compact('title', 'info');

        if ($request->method() == 'POST') {
//            dd($request->post());
            $shopModel = $request->post()['ShopModel'];
            $opening_hour = $request->post()['opening_hour'];
            $shopModel['opening_hour'] = serialize($opening_hour);
            $ret = $this->shop->update($shop_id, $shopModel);
            if ($ret == false) {
                flash('error', '设置失败');
                return redirect('/shop/shop-set/edit');
            }
            flash('success', '设置成功');
            return redirect('/shop/shop-set/edit');
        }
//        dd($info);

        return view('shop.shop-set.edit', $compact);
    }

    /**
     * 名称验证是否重复
     *
     * @param Request $request
     * @return mixed
     */
    public function clientValidate(Request $request)
    {
        $result = $this->shop->clientValidate($request, 'ShopModel');
        if (!$result['code']) {
            return result(-1, '', $result['message']);
        }
        return result(0);
    }

    public function other(Request $request)
    {
        $title = '高级设置';
        $fixed_title = '店铺设置 - '.$title;
        $this->sublink($this->links, 'other');


        $action_span = [];

        $explain_panel = [];
        $blocks = [
            'explain_panel' => $explain_panel,
            'fixed_title' => $fixed_title,
            'action_span' => $action_span
        ];

        $this->setLayoutBlock($blocks); // 设置block

        $group = 'shop_other'; // 当前配置分组
        $config_info = $this->shopConfigField->getSpecialConfigsByGroup($group, 'code');
        $compact = compact('title', 'config_info', 'group');

        return view('shop.shop-set.other', $compact);
    }
}