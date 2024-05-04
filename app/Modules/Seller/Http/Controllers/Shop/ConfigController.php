<?php

namespace App\Modules\Seller\Http\Controllers\Shop;

use App\Modules\Base\Http\Controllers\Seller;
use App\Repositories\ShopConfigFieldRepository;
use App\Repositories\ShopConfigRepository;
use App\Repositories\ShopRepository;
use App\Repositories\ToolsRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ConfigController extends Seller
{

    private $goods_links = [
        ['url' => 'goods/goods-set/index', 'text' => '基本设置'],
        ['url' => 'goods/goods-unit/list', 'text' => '商品单位'],
        ['url' => 'goods/layout/list', 'text' => '详情版式'],
        ['url' => 'goods/questions/list', 'text' => '常见问题'],
    ];

    private $trade_links = [
        ['url' => 'shop/config/index?group=trade', 'text' => '基本设置'],
        ['url' => 'shop/config/auto-delivery', 'text' => '自动发货设置'],
        ['url' => 'shop/shop-address/list', 'text' => '发/退货地址库'],
    ];

    private $shop_other_links = [
        ['url' => 'shop/shop-set/edit', 'text' => '基本设置'],
        ['url' => 'shop/shop-set/other', 'text' => '高级设置'],
    ];

    private $freight_links = [
        ['url' => 'shop/freight/list', 'text' => '运费模板列表'],
        ['url' => 'shop/freight/default', 'text' => '店铺统一运费'],
        ['url' => 'shop/freight/calculate', 'text' => '运费模拟计算'],
    ];

    private $bonus_links = [
        ['url' => 'dashboard/bonus/list', 'text' => '红包列表'],
        ['url' => 'dashboard/bonus/config', 'text' => '红包设置'],
    ];

    private $multi_store_links = [
        ['url' => 'dashboard/multi-store/index', 'text' => '门店列表'],
        ['url' => 'dashboard/multi-store/goods-manage', 'text' => '门店商品管理'],
        ['url' => 'dashboard/multi-store-group/list', 'text' => '门店分组'],
        ['url' => 'finance/bill/multi-store-bill', 'text' => '门店结算'],
        ['url' => 'dashboard/multi-store/site', 'text' => '门店设置'],
    ];

    protected $shopConfig;
    protected $shopConfigField;
    protected $tools;

    public function __construct(
        ShopConfigRepository $shopConfig
        ,ShopConfigFieldRepository $shopConfigField
        ,ToolsRepository $tools
    )
    {
        parent::__construct();

        $this->shopConfig = $shopConfig;
        $this->shopConfigField = $shopConfigField;
        $this->tools = $tools;
    }

    public function index(Request $request)
    {
        $is_layer = $request->get('is_layer', 0); // 是否弹出层
        $group = $request->get('group', ''); // 当前配置分组
        $group_info = $this->shopConfigField->getConfigList($group, seller_shop_info()->shop_id);
        $title = $fixed_title = $group_info['title'];
        $uuid = make_uuid();
        $script_render = view('shop.config.partials.'.$group, compact('uuid'))->render();

        if ($request->ajax() || $is_layer) {
            $ajax_tpl = 'ajax_config'; // 默认使用公共模板
            // 特殊处理
            $ajax_special_groups = [
                'm_shop_header', // 店铺头部设置
                'app_shop_header', // APP店铺头部设置
                'bonus', // 红包设置
            ];
            if (in_array($group, $ajax_special_groups)) {
                $ajax_tpl = $group;
                $group_info = $this->shopConfigField->getSpecialConfigsByGroup($group, 'code');
            }

            $render = view('shop.config.'.$ajax_tpl, compact('uuid', 'group', 'group_info', 'script_render'))->render();
            return result(0, $render);
        }

        switch ($group) {

            case in_array($group, ['goods']): // 商品设置
                $this->sublink($this->goods_links, $group, 'group');
                $this->set_menu_select('goods', 'goods-set');

                break;


            case in_array($group, ['trade']): // 交易设置
                $this->sublink($this->trade_links, $group, 'group');
                $this->set_menu_select('trade', 'trade-set');

                break;

            case in_array($group, ['shop_other']):
                $this->sublink($this->shop_other_links, $group, 'group');
                $this->set_menu_select('shop', 'shop-set');

                break;

            case in_array($group, ['multi_store']):
                $this->sublink($this->multi_store_links, $group, 'group');

                break;

            case in_array($group, ['freight']):
                $this->sublink($this->shop_other_links, $group, 'group');
                $this->set_menu_select('goods', 'freight');

                break;

            case in_array($group, ['aliim']): // 阿里云旺

                $this->set_menu_select('account', 'shop-config-aliim');

                break;

            case in_array($group, ['bonus']): // 红包设置

                $this->set_menu_select('dashboard', 'dashboard-center');

                break;

            case in_array($group, ['weixin']): // 微信配置

                $this->set_menu_select('weixin', 'shop-weixin-config');
				$shop = new ShopRepository();
				$qrcode = $shop->getShopQrCode($this->shop_id);
				view()->share('qrcode', $qrcode);

                break;
        }

        $blocks = [
            'explain_panel' => $group_info['explain'],
            'fixed_title' => $fixed_title,
        ];

        $template = 'config'; // 默认使用公共模板
        // 特殊处理
        $special_groups = [
            'freight', // 运费设置
            'weixin',
//            'm_shop_header', // 店铺头部设置
//            'app_shop_header', // APP店铺头部设置
//            'bonus', // 红包设置
        ];
        if (in_array($group, $special_groups)) {
            $template = $group;
            $group_info = $this->shopConfigField->getSpecialConfigsByGroup($group, 'code');
        }

        $this->setLayoutBlock($blocks); // 设置block
        return view('shop.config.'.$template, compact('title', 'group', 'group_info', 'script_render'));
    }

    /**
     * 更新配置设置信息
     *
     * @param Request $request
     * @return mixed
     */
    public function updateConfig(Request $request)
    {
        $group = $request->post('group', '');
        $backUrl = $request->input('back_url');
        $updateInfo = $request->post('ShopConfigModel');

        if ($group == 'bonus') {
            // 红包设置
            foreach ($updateInfo as $k=>$v) {

                if (Str::contains($k,'bonus_img') && !empty($v)) {

                    $filename = $request->post('filename', 'name');
                    $storePath = 'shop/'.$this->seller_info->shop_id.'/config/bonus';
                    $uploadRes = $this->tools->uploadPic($request, $filename, $storePath);

                    if (isset($uploadRes['error'])) {
                        // 上传出错
                        return result(-1, '', $uploadRes['error']);
                    }
                    $updateInfo[$k] = $uploadRes['data'][0]['path'];
                }
            }
        }
        $result = $this->shopConfig->update_shopconf($updateInfo);

        if ($request->ajax()) {
            // ajax post请求
            // 如果开启了Mobile自定义改色 则修改样式文件
            if (@$updateInfo['custom_style_enable_m_shop'] == 1) {
                $style_path = public_path('frontend/web_mobile/css/custom/m_shop-color-style-'.seller_shop_info()->shop_id.'.css');
                foreach ($updateInfo as $k=>$v) {
                    if ($v == '') {
                        break;
                    }
                    $custom_site_color_style = file_get_contents($style_path);
                    $result_custom_site_color_style = str_replace_style($k, $v, $custom_site_color_style);
                    ob_get_clean(); // 清空文件内容
                    file_put_contents($style_path, $result_custom_site_color_style);
                }
            }

            if ($result === false) {
                // 记录失败日志
                shop_log('配置设置失败，配置分组：'.$group);
                return result(-1, '', '设置失败');
            }

            // 记录成功日志
            shop_log('配置设置成功，配置分组：'.$group);
            return result(0, '', '设置成功！');
        }

        if ($result === false) {
            // fail
            shop_log('配置设置失败，配置分组：'.$group);

            flash('error', '设置失败');
            return redirect($backUrl);
        }

        // success
        shop_log('配置设置成功，配置分组：'.$group);
        flash('success', '设置成功！');
        return redirect($backUrl);
    }

    /**
     * 配置值清空
     *
     * @param Request $request
     * @return array
     */
    public function clear(Request $request)
    {
        $code = $request->post('code'); // integral_slide_img1|integral_slide_link1
        $ret = $this->shopConfig->clear($code, $this->seller_info->shop_id);
        if ($ret['code'] == -1) {
            // fail
            shop_log('配置值清空失败，配置code：'.$code);
            return result(-1, null, $ret['message']);
        }

        // success
        shop_log('配置值清空成功，配置code：'.$code);
        return result(0, null, $ret['message']);
    }

    /**
     * 自动发货设置
     *
     * @param Request $request
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function autoDelivery(Request $request)
    {
        $title = '自动发货设置';
        $fixed_title = '交易设置 - '.$title;
        $this->sublink($this->trade_links, 'auto-delivery');
        $this->set_menu_select('trade', 'trade-set');

        $action_span = [];

        $explain_panel = [
            '店铺订单自动发货，可设置自动无需物流、指派或众包，解决商家发货的繁琐步骤，一步即可完成订单的发货'
        ];
        $blocks = [
            'explain_panel' => $explain_panel,
            'fixed_title' => $fixed_title,
            'action_span' => $action_span
        ];

        $this->setLayoutBlock($blocks); // 设置block
        $compact = compact('title');

        if ($request->method() == 'POST') {

            $ret = true;
            if ($ret === false) {
                // 记录失败日志
                shop_log('自动发货设置失败');
                return result(-1, null, '设置失败');
            }

            // 记录成功日志
            shop_log('自动发货设置成功');
            return result(0, null, '设置成功');
        }
        return view('shop.config.auto_delivery', $compact);
    }

}
