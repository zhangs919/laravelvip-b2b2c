<?php

namespace App\Modules\Seller\Http\Controllers\Shop;

use App\Modules\Base\Http\Controllers\Seller;
use App\Repositories\ShopConfigFieldRepository;
use App\Repositories\ShopRepository;
use Illuminate\Http\Request;

class WeixinConfigController extends Seller
{


    private $links = [];

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

        $this->set_menu_select('weixin', 'shop-weixin-config');

    }


    public function index(Request $request)
    {
        $title = '微信对接';
        $fixed_title = '微信设置 - '.$title;

        $action_span = [];

        $explain_panel = [
            '引导用户关注公众号成为你的粉丝，进行后续的粉丝运营',
            '必须绑定认证的服务号，否则将无法正常使用微信自定义菜单、关键词自动回复',
            '微商城里面的微信支付统一用平台的微信支付'
        ];
        $blocks = [
            'explain_panel' => $explain_panel,
            'fixed_title' => $fixed_title,
            'action_span' => $action_span
        ];

        $this->setLayoutBlock($blocks); // 设置block

        // 获取数据

        $group = 'weixin'; // 当前配置分组
        $uuid = make_uuid();
        $script_render = view('shop.config.partials.'.$group, compact('uuid'))->render();
        $model = $this->shopConfigField->getSpecialConfigsByGroup($group, 'code', true);

        $back_url = $request->fullUrl();
        $shop_id = seller_shop_info()->shop_id;
        $weixin_url = request()->getScheme().'://'.config('lrw.mobile_domain').'/wxapi/index?shop_id='.$shop_id;
        $weixin_token = 'weixin';
		$shop_qrcode = $this->shop->getShopQrCode($this->shop_id);
        $compact = compact('title', 'script_render', 'model', 'back_url', 'shop_id', 'weixin_url', 'weixin_token', 'shop_qrcode');

        $webData = []; // web端（pc、mobile）数据对象
        $data = [
            'app_extra_data' => [],
            'app_prefix_data' => [
                'model' => $model,
                'back_url' => $back_url
            ],
            'app_context_data' => $this->getAppContext(),
            'app_suffix_data' => [],
            'web_data' => $webData,
            'compact_data' => $compact,
            'tpl_view' => 'shop.weixin-config.index'
        ];
        $this->setData($data); // 设置数据
        return $this->displayData(); // 模板渲染及APP客户端返回数据
    }

    public function clear(Request $request)
    {

        return result(0, '', '清除成功！');
    }
}
