<?php

namespace App\Modules\Frontend\Http\Controllers\Index;

use App\Modules\Base\Http\Controllers\Frontend;
use Illuminate\Http\Request;
use EasyWeChat\Factory;

/**
 * 微信端控制器
 *
 * Class InformationController
 * @package App\Modules\Frontend\Http\Controllers\Index
 */
class InformationController extends Frontend
{

    public function __construct()
    {
        parent::__construct();

    }

    /**
     * 判断是否是微信访问
     *
     * @param Request $request
     * @return mixed
     */
    public function isWeixin(Request $request)
    {
        if (!is_weixin()) {
            return result(-1, null);
        }
        return result(0, null, '');
    }

    /**
     *
     *
     * @param Request $request
     * @return mixed
     */
    public function isFollow(Request $request)
    {
        // todo 可以通过微信公众号接口获取当前微信用户是否已经关注该公众号
        $is_show = 1;

        if (!is_weixin() || !sysconf('m_follow_wechat')) { // 如果不是微信客户端访问或者平台后台是否显示引导关注微信公众号已关闭 隐藏不显示
            $is_show = 0;
        }

        return result(0, null, '',['is_show'=>$is_show]);
    }

    /**
     * 搜索历史
     *
     * @param Request $request
     * @return mixed
     */
    public function searchRecord(Request $request)
    {

        return result(0, []);
    }

    public function getWeiXinConfig(Request $request)
    {
        if (!is_weixin()) {
            return result(-1, null, '');
        }
        
        $config = [
            'app_id' => sysconf('appid'), //'wx9b2758846c6e64be',
            'secret' => sysconf('appsecret'), //'c563e41aa2a6ea9824135af59146c856',

            // 指定 API 调用返回结果的类型：array(default)/collection/object/raw/自定义类名
            'response_type' => 'array',

            //...
        ];
        $APIs = ["onMenuShareTimeline", "onMenuShareAppMessage", "scanQRCode"];
        $app = Factory::officialAccount($config);
        $res = $app->jssdk->buildConfig($APIs, $debug = false, $beta = false, $json = true);
        $res = json_decode($res, true);
        $data = [
            'appId' => $res['appId'],
            'timestamp' => $res['timestamp'],
            'nonceStr' => $res['nonceStr'],
            'signature' => $res['signature'],
            'jsApiList' => $res['jsApiList'],
        ];

        return result(0, $data, '',['jsApiList'=>$res['jsApiList']]);
    }

    public function amap(Request $request)
    {
        $dest = $request->get('dest');
        $title = $request->get('title');

        $seo_title = $title;

        return view('index.information.amap', compact('dest', 'seo_title', 'title'));
    }
}
