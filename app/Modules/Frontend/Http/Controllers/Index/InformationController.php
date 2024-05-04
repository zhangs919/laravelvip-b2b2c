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
            return result(-1, null, '请在微信中打开');
        }

        $url = $request->get('url');

//        $APIs = ["onMenuShareTimeline", "onMenuShareAppMessage", "scanQRCode"];
        $APIs = [
//        	"onMenuShareTimeline", "onMenuShareAppMessage",
			'updateTimelineShareData', 'updateAppMessageShareData','scanQRCode'];
        $data = get_wx_share_data($APIs, $url);

        if (!$data) {
            return result(-1, null, '微信分享配置异常');
        }
        // 'errCode'=>0 为校验成功 -1为失败


        $data['url'] = $url;

//        return result(0, $data, '',['errCode'=>-1]);
        return result(0, $data, '',['jsApiList'=>$data['jsApiList'],'errCode'=>0]);
    }

    public function amap(Request $request)
    {
        $dest = $request->get('dest');
        $title = $request->get('title');

        $seo_title = $title;

        return view('index.information.amap', compact('dest', 'seo_title', 'title'));
    }

    /**
     * 过滤结果,非本站的二维码不可以扫描
     *
     * @param Request $request
     * @return array|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function go(Request $request)
    {
        //
        $url = $request->get('url');
        if (empty($url)) {
            return result(-1, null, '扫码结果为空');
        }
        // 判断是否是本站二维码
        if (!in_array(parse_url($url, PHP_URL_HOST), [config('lrw.frontend_domain'), config('lrw.mobile_domain')])) {
            return result(-1, null, '非本站的二维码不可以扫描');
        }

        $data = [
            'url' => $url
        ];

        return result(0, $data);
    }
}
