<?php

namespace App\Modules\Backend\Http\Controllers\Shop;


use App\Modules\Base\Http\Controllers\Backend;
use App\Repositories\SystemConfigRepository;
use Illuminate\Http\Request;

class ShopSettingController extends Backend
{

    private $links = [
        ['url' => 'shop/shop-setting/basic-set', 'text' => '基本设置'],
        ['url' => 'shop/shop-setting/banner-set', 'text' => '入驻轮播图'],
    ];

    protected $systemConfig;


    public function __construct(SystemConfigRepository $systemConfigRepository)
    {
        parent::__construct();

        $this->systemConfig = $systemConfigRepository;
    }

    /**
     * 开店设置-基本设置
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $group = 'open_shop';
        $title = '基本设置';
        $fixed_title = '开店设置 - '.$title;

        $this->sublink($this->links, 'basic-set');

        $config_info = $this->systemConfig->getSpecialConfigsByGroup($group, 'code');

        $action_span = [];
        $explain_panel = [
            '平台在此处统一设置店铺需缴纳费用、到期警告提醒等',
        ];
        $blocks = [
            'fixed_title' => $fixed_title,
            'action_span' => $action_span,
            'explain_panel' => $explain_panel,
        ];
        $this->setLayoutBlock($blocks); // 设置block


        return view('shop.shop-setting.index', compact('title', 'group', 'config_info'));
    }

    /**
     * 开店设置-入驻轮播图
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Throwable
     */
    public function bannerSet(Request $request)
    {
        $group = 'shop_apply_banner'; // 当前配置分组
        $group_info = $this->systemConfig->getConfigList($group);
        $uuid = make_uuid();
        $script_render = view('system.config.partials.'.$group, compact('uuid'))->render();

        $title = '入驻轮播图';
        $fixed_title = '开店设置 - '.$title;
        $this->sublink($this->links, 'banner-set');

        $action_span = [];
        $explain_panel = [
            '网站前台入驻页面轮播图，最多可上传4张图片',
        ];
        $blocks = [
            'fixed_title' => $fixed_title,
            'action_span' => $action_span,
            'explain_panel' => $explain_panel,
        ];
        $this->setLayoutBlock($blocks); // 设置block

        $introduce_box = '';

        return view('system.config.config', compact('title', 'group', 'group_info', 'script_render', 'introduce_box'));
    }

}