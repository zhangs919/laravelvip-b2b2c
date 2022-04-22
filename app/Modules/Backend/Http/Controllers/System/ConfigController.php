<?php

namespace App\Modules\Backend\Http\Controllers\System;

use App\Http\Requests\SystemConfigRequest;
use App\Modules\Base\Http\Controllers\Backend;
use App\Repositories\SystemConfigRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ConfigController extends Backend
{
    private $site_links = [
        ['url' => 'system/config/index?group=website', 'text' => '网站设置'],
        ['url' => 'system/config/index?group=captcha', 'text' => '验证码设置'],
    ];

    private $img_links = [
        ['url' => 'system/config/index?group=default_image', 'text' => '默认图片'],
        ['url' => 'system/config/index?group=image_upload', 'text' => '上传参数'],
    ];

    private $custom_set_links = [
        ['url' => 'system/config/index?group=login_bg', 'text' => '登录注册主题'],
        ['url' => 'system/config/index?group=mall_top_ad', 'text' => '商城头部广告'],
        ['url' => 'system/config/index?group=mall_bottom_ad', 'text' => '商城底部广告'],
        ['url' => 'system/config/index?group=register_bg', 'text' => '入驻提交页广告'],
    ];

    private $sms_set_links = [
        ['url' => 'system/config/index?group=sms', 'text' => '短信设置'],
        ['url' => 'system/config/index?group=aliyunsms', 'text' => '阿里云短信设置'],
        ['url' => 'system/config/index?group=aliyusms', 'text' => '阿里大于短信设置'],
        ['url' => 'system/config/index?group=yunsms', 'text' => '云短信设置'],
    ];

    // ['website_login', 'qq_login', 'weibo_login', 'mobile_weibo_login', 'pc_weixin_login', 'mobile_weixin_login']
    private $website_login_links = [
        ['url' => 'system/config/index?group=website_login', 'text' => '设置'],
        ['url' => 'system/config/index?group=qq_login', 'text' => 'QQ登录'],
        ['url' => 'system/config/index?group=weibo_login', 'text' => 'PC微博登录'],
        ['url' => 'system/config/index?group=mobile_weibo_login', 'text' => '微商城微博登录'],
        ['url' => 'system/config/index?group=pc_weixin_login', 'text' => 'PC微信登录'],
        ['url' => 'system/config/index?group=mobile_weixin_login', 'text' => '微商城微信登录'],
    ];

    private $trade_links = [
        ['url' => 'system/config/index?group=trade', 'text' => '购物流程'],
        ['url' => 'system/config/index?group=evaluate', 'text' => '评价设置'],
        ['url' => 'system/config/index?group=order', 'text' => '订单设置'],
    ];

    private $distrib_links = [
        ['url' => 'system/config/index?group=distrib', 'text' => '分销设置'],
        ['url' => 'system/config/index?group=recommend_reg', 'text' => '推荐注册设置'],
    ];


    protected $systemConfig;

    public function __construct(SystemConfigRepository $systemConfig)
    {
        parent::__construct();
        $this->systemConfig = $systemConfig;
    }

    public function index(Request $request)
    {
        $group = $request->get('group', ''); // 当前配置分组
        $group_info = $this->systemConfig->getConfigList($group);
        $title = $fixed_title = $group_info['title'];
        $uuid = make_uuid();
        $script_render = view('system.config.partials.'.$group, compact('uuid'))->render();
//        dd($group);
        if ($request->ajax()) {
            $render = view('system.config.ajax_config', compact('uuid', 'group', 'group_info', 'script_render'))->render();
            return result(0, $render);
        }

        switch ($group) {
            // 图片设置
            case in_array($group, ['default_image', 'image_upload']):
                $this->sublink($this->img_links, $group, 'group');
            break;
            // 网站设置
            case in_array($group, ['website', 'captcha']):
                $this->sublink($this->site_links, $group, 'group');
                break;
            // 个性化设置
            case in_array($group, ['login_bg', 'mall_top_ad', 'mall_bottom_ad', 'register_bg']):
                $this->sublink($this->custom_set_links, $group, 'group');
                break;

            // 短信设置
            case in_array($group, ['sms', 'aliyunsms', 'aliyusms', 'yunsms']):
                $this->sublink($this->sms_set_links, $group, 'group');
                break;

            // 第三方登录
            case in_array($group, ['website_login', 'qq_login', 'weibo_login', 'mobile_weibo_login', 'pc_weixin_login', 'mobile_weixin_login']):
                $this->sublink($this->website_login_links, $group, 'group');
                break;

            // 交易设置
            case in_array($group, ['trade', 'evaluate', 'order']):
                $this->sublink($this->trade_links, $group, 'group');
                break;

            // 分销返利设置
            case in_array($group, ['distrib', 'recommend_reg']):
                $this->sublink($this->distrib_links, $group, 'group');
                break;
        }

        $blocks = [
            'explain_panel' => $group_info['explain'],
            'fixed_title' => $fixed_title,
        ];
        $this->setLayoutBlock($blocks); // 设置block

        $template = 'config'; // 默认使用公共模板
        // 特殊处理
        $special_groups = [
            'captcha',// 验证码设置
            'image_upload',// 上传参数
            'goods',// 商品设置
            'trade',// 购物流程
            'evaluate',// 购物流程
//            'user',// 会员设置
            'distrib',// 分销设置
        ];
        if (in_array($group, $special_groups)) {
            $template = $group;
            $group_info = $this->systemConfig->getSpecialConfigsByGroup($group, 'code');
        }
//        dd($group_info);
        $introduce_box = '';
        if ($group == 'sms') {
            $introduce_box = view('system.config.introduce-box.'.$group, compact('uuid'))->render();
        }

        return view('system.config.'.$template, compact('title', 'group', 'group_info', 'script_render', 'introduce_box'));
    }

    /**
     * 更新配置设置信息
     *
     * @param Request $request
     * @return RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function updateConfig(Request $request)
    {
        // system/config/ default_image/ default_floor_loading_0.jpg
        // backend/gallery/ 2019/01/19/ 15479117075520.jpg

        $group = $request->post('group', '');
        $backUrl = $request->input('back_url');
        $updateInfo = $request->post('SystemConfigModel');

        if ($group == 'integral_mall_index_set') {
            // todo 积分商城首页设置 图片上传待处理保存

        }

        $result = $this->systemConfig->update_sysconf($updateInfo);
        if ($request->ajax()) {
            // ajax post请求
            // 如果开启了PC自定义改色 则修改样式文件
            if (@$updateInfo['custom_style_enable'] == 1) {
                $style_path = public_path('frontend/css/custom/site-color-style-0.css');
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

            // 如果开启了Mobile自定义改色 则修改样式文件
            if (@$updateInfo['custom_style_enable_m_site'] == 1) {
                $style_path = public_path('mobile/css/custom/m_site-color-style-0.css');
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

            if ($result['code'] == -1) {
                // 记录失败日志
                admin_log('配置设置失败，配置分组：'.$group);
                return result(-1, '', $result['message']);
            }

            // 记录成功日志
            admin_log('配置设置成功，配置分组：'.$group);
            return result(0, '', $result['message']);
        }

        if ($result['code'] == -1) {
            // fail
            // todo 记录失败日志
            admin_log('配置设置失败，配置分组：'.$group);

            flash('error', $result['message']);
            return redirect($backUrl);
        }

        // success
        admin_log('配置设置成功，配置分组：'.$group);
        flash('success', $result['message']);
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
        $ret = $this->systemConfig->clear($code);
        if ($ret['code'] == -1) {
            // fail
            admin_log('配置值清空失败，配置code：'.$code);
            return result(-1, null, $ret['message']);
        }

        // success
        admin_log('配置值清空成功，配置code：'.$code);
        return result(0, null, $ret['message']);
    }
}