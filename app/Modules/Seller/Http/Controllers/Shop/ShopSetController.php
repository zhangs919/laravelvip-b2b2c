<?php

namespace App\Modules\Seller\Http\Controllers\Shop;

use App\Models\Topic;
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


    public function __construct(
        ShopRepository $shop
        ,ShopConfigFieldRepository $shopConfigField
    )
    {
        parent::__construct();

        $this->shop = $shop;
        $this->shopConfigField = $shopConfigField;

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


        if ($request->method() == 'POST') {
            $shopModel = $request->post()['ShopModel'];
            $opening_hour = $request->post()['opening_hour'];
            $shopModel['opening_hour'] = serialize($opening_hour);

            $shipping_time = $request->post('shipping_time');
            $shopModel['shipping_time'] = serialize($shipping_time);

            $ret = $this->shop->update($shop_id, $shopModel);
            if ($ret == false) {
                flash('error', '设置失败');
                return redirect('/shop/shop-set/edit');
            }
            flash('success', '设置成功');
            return redirect('/shop/shop-set/edit');
        }



        // 获取数据

        $model = $this->shop->getShopInfo($shop_id);
        $region_name = get_region_names_by_region_code($model['region_code']);

		$qrcode = $this->shop->getShopQrCode($shop_id);

        $compact = compact('title', 'model', 'region_name', 'qrcode');

        $webData = []; // web端（pc、mobile）数据对象
        $data = [
            'app_extra_data' => [],
            'app_prefix_data' => [
                'model' => $model,
                'region_name' => $region_name,
                'qrcode' => $qrcode
            ],
            'app_context_data' => $this->getAppContext(),
            'app_suffix_data' => [],
            'web_data' => $webData,
            'compact_data' => $compact,
            'tpl_view' => 'shop.shop-set.edit'
        ];
        $this->setData($data); // 设置数据
        return $this->displayData(); // 模板渲染及APP客户端返回数据
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


        // 获取数据
        $group = 'shop_other'; // 当前配置分组
        $model = $this->shopConfigField->getSpecialConfigsByGroup($group, 'code', true);
        $back_url = $request->fullUrl();

        // 专题列表
        $topic_list = Topic::where([['is_delete',0],['shop_id', seller_shop_info()->shop_id]])->orderBy('topic_id', 'asc')->get()->toArray();
        $compact = compact('title', 'model', 'back_url', 'topic_list');

        $webData = []; // web端（pc、mobile）数据对象
        $data = [
            'app_extra_data' => [],
            'app_prefix_data' => [
                'model' => $model,
                'back_url' => $back_url,
            ],
            'app_context_data' => $this->getAppContext(),
            'app_suffix_data' => [],
            'web_data' => $webData,
            'compact_data' => $compact,
            'tpl_view' => 'shop.shop-set.other'
        ];
        $this->setData($data); // 设置数据
        return $this->displayData(); // 模板渲染及APP客户端返回数据
    }
}
