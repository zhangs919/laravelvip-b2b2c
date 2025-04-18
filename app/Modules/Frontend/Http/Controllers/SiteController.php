<?php

namespace App\Modules\Frontend\Http\Controllers;

use App\Models\Article;
use App\Models\Collect;
use App\Models\Compare;
use App\Models\DefaultSearch;
use App\Models\GoodsComment;
use App\Models\HotSearch;
use App\Models\TemplateItem;
use App\Models\User;
use App\Modules\Base\Http\Controllers\Frontend;
use App\Repositories\GoodsRepository;
use App\Repositories\RegionRepository;
use App\Repositories\TemplateItemRepository;
use App\Repositories\ToolsRepository;
use App\Repositories\UploadVideoRepository;
use App\Repositories\UserCollectRepository;
use App\Repositories\UserFollowRepository;
use App\Repositories\UserMessageRepository;
use App\Repositories\UserPraiseRepository;
use App\Repositories\VideoDirRepository;
use App\Repositories\VideoRepository;
use App\Services\AddressParse;
use App\Services\AmapService;
use App\Services\ConnectApi;
use Gregwar\Captcha\CaptchaBuilder;
use Gregwar\Captcha\PhraseBuilder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SiteController extends Frontend
{

    protected $regions;
    protected $tools;
    protected $templateItem;
    protected $connectApi;
    protected $goods;
    protected $uploadVideo; // 上传视频
    protected $videoDir;
    protected $video;

    public function __construct(
        RegionRepository $regions
        ,ToolsRepository $tools
        ,TemplateItemRepository $templateItem
        ,ConnectApi $connectApi
        ,GoodsRepository $goods
        ,UploadVideoRepository $uploadVideoRepository
        ,VideoDirRepository $videoDirRepository
        ,VideoRepository $videoRepository
    )
    {
        parent::__construct();

        $this->regions = $regions;
        $this->tools = $tools;
        $this->templateItem = $templateItem;
        $this->connectApi = $connectApi;
        $this->goods = $goods;
        $this->uploadVideo = $uploadVideoRepository;
        $this->videoDir = $videoDirRepository;
        $this->video = $videoRepository;
    }

    public function user(Request $request)
    {
        $cat_id = $request->get('cat_id', '');

        // 默认搜索词
        $default_keywords = [];
        $default_search = (new DefaultSearch())->getCacheData();
        if (!empty($default_search)) {
            foreach ($default_search as $v) {
                if ($v->search_type == 1 && $cat_id) {
                    $url = "search.html?keyword=".$v->search_keywords;
                }
                if ($v->search_type == 1) {
                    if ($cat_id) {
                        $url = "search.html?keyword=".$v->search_keywords;
                    }else {
                        continue;
                    }
                } else {
                    $url = "search.html?keyword=".$v->search_keywords;
                }

                $default_keywords[] = [
                    'keyword' => $v->search_keywords,
                    'url' => $url,
                ];
            }
        }

        // 热搜词
        $show_keywords = [];
        $hot_search = (new HotSearch())->getCacheData();
        if (!$hot_search->isEmpty()) {
            foreach ($hot_search as $v) {
                $url = "search.html?keyword=".$v->keyword;
                $v->url = $url;
                $v->toArray();
            }
            $show_keywords = $hot_search[0];
        }
        // 搜索历史
        $search_records = !empty($_COOKIE['search_records']) ? unserialize($_COOKIE['search_records']) : [];

        $userMessage = new UserMessageRepository();
        $no_read_count = $userMessage->getMessageCount(1, $this->user_id);

        if (sysconf('site_open')) {
            // 站点开启
            $data = [
                'cart' => [
                    'goods_count' => $this->cart_goods_num
                ],
                'message' => [
                    'internal_count' => $no_read_count
                ],
                'default_keywords' => $default_keywords,
                'hot_keywords' => $hot_search,
                'search_records' => $search_records,
                'show_keywords' => $show_keywords,
                'site_id' => 2,
                'region_code' => "11,01",
                'site_status' => 1, // 0-当前站点无效 弹出站点选择框 1-当前站点正常
//                'site_change' => [], // 以英文首字母排序
                'site_change' => '<!--站点 start-->
<div class="SZY-SUBSITE">
        <ul class="fl">
        <li class="dorpdown" id="city-choice">
            <dt class="sc-icon">
                <div class="sc-choie">
                    <i class="iconfont color"></i>
                    <span class="ui-areamini-text" data-id="2" title="">北京站   </span>
                </div>
                <div class="dd-spacer"></div>
            </dt>
            <dd class="dorpdown-layer">
                <div class="ui-areamini-content-wrap" id="ui-content-wrap">
                    <!--当站点少的活，以dl下展示形式展示，如果展示多的话，以ul下的li展示形式展示-->
                    <dl>
                        <dt>站点</dt>
                        <dd>
                            <a href="/subsite/index.html?site_id=14">大同站点</a>
                        </dd>
                        <dd>
                            <a href="/subsite/index.html?site_id=21">dhds</a>
                        </dd>
                    </dl>
                </div>
            </dd>
        </li>
    </ul>
</div>
<!--站点 end-->', // 以英文首字母排序
            ];
        } else {
            // 站点未开启
            $data = [
                'cart' => [
                    'goods_count' => $this->cart_goods_num
                ],
                'message' => [
                    'internal_count' => $no_read_count
                ],
                'default_keywords' => $default_keywords,
                'hot_keywords' => $hot_search,
                'search_records' => $search_records,
                'show_keywords' => $show_keywords
            ];
        }


        // 判断是否登录
        if (is_login()) {
            $user = $this->user;
            $user_rank = $this->user_rank_info;
            $user_rank['rank_img'] = get_image_url($user_rank['rank_img']);
			if ($user_rank['level'] == -1) {
				return result(-1, '', '平台未设置默认会员等级');
			}
            // 如果是登录状态
            $data['user_name'] = $user->user_name;
            $data['user_id'] = $user->user_id;
            $data['headimg'] = get_image_url($user->headimg,'headimg');
            $data['last_time'] = $user->last_login;
            $data['last_ip'] = $user->last_ip;
            $data['last_region_code'] = '';
            $data['user_rank'] = $user_rank; // 用户等级
            $data['last_time_format'] = $user->last_login;
            $data['yikf_user_suffix'] = 1731;
            $data['sign_in_entry'] = "0"; // 签到入口是否开启 0-不显示 1-显示签到入口弹框
        }

        $data['session_id'] = $this->session_id;
        $data['sys_msg_cfg_url'] = get_ws_url('7272'); // 从后台配置读取

        return result(0, $data);
    }

    /**
     * 站点
     *
     * @param Request $request
     * @return array|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function subSiteLocation(Request $request)
    {

        $data = [
            'city' => '昆明市',
            'site_id' => 2
        ];
        return result(0, $data);
    }

    public function getSessionId(Request $request)
    {
        $session_id = $this->session_id; //md5($this->user_id); // todo 暂时用md5加密 用户id返回给前端 后面再看
        return result(0, $session_id);
    }

    /**
     * 首页新订单提醒
     * 模拟新订单提醒数量 调取订单中的数据模拟新订单提醒,如果想使用真实数据可以设置为0
     *
     * @param Request $request
     * @return array|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function getNewOrderList(Request $request)
    {

        $new_order_remind_num = sysconf('new_order_remind_num') ?? 0;
        $count = (int)$new_order_remind_num ?: 20;
        if ($new_order_remind_num > 0) { // 调取订单中的数据模拟新订单
            $data = [];
            for ($i=0; $i < $new_order_remind_num; $i++) {
                $data[] = [
                    'headimg' => get_image_url(sysconf('default_user_portrait')),
                    'user_name' => "乐融沃{$i}号门店管理员"
                ];
            }
        } else { // 使用真实数据
            $data = User::select('headimg','user_name')->limit($count)->get()->toArray();
            if (!empty($data)) {
                foreach ($data as &$v) {
                    $v['headimg'] = get_image_url($v['headimg'], 'headimg');
                }
            }
        }

        return result(0, $data, '', ['count'=>count($data)]);
    }

    /**
     * 发送短信验证码
     *
     * @param Request $request
     * @return mixed
     */
    public function smsCaptcha(Request $request)
    {
        $mobile = $request->get('mobile');
        $captcha = $request->get('captcha');
        $scene_id = $request->get('scene_id', 2); // 2-登录 6-常规验证类验证码

//        $cache_id = CACHE_KEY_SMS_CAPTCHA[0].':'.$this->user_id.':6';
//        $sms_captcha = cache()->get($cache_id);
//        dd($sms_captcha);
        // 发送频繁
//        return result(-1, ['show_captcha'=>1], '每60秒内只能发送一次短信验证码，请稍候重试', ['errors'=>['mobile' => ['每60秒内只能发送一次短信验证码，请稍候重试']]]);
        $ret = $this->connectApi->sendCaptcha($mobile, $scene_id);
        if ($ret['code'] != 0) {
            return result(-1, ['field'=>'mobile','show_captcha'=>0], $ret['message'], ['errors'=>['mobile' => [$ret['message']]]]);
        }
        return result(0, [], '发送成功');
    }

    /**
     * 生成图形验证码
     *
     * @param Request $request
     * @return false|string
     */
    public function captcha(Request $request)
    {

//        return json_encode(['hash1' => 438,'hash2' => '438', 'url' => '/site/captcha.html?v='.uniqid()]);
        $phraseBuilder = new PhraseBuilder(4, '0123456789'); // 只生成4位数字

        //生成验证码图片的Builder对象，配置相应属性
        $builder = new CaptchaBuilder(null, $phraseBuilder); // 只生成4位数字

        //可以设置图片宽高及字体
        $builder->build($width = 100, $height = 40, $font = null);
        // 设置干扰线
        $builder->setMaxBehindLines(0);
        //获取验证码的内容
        $phrase = $builder->getPhrase();

        //把内容存入session
        Session::put('captcha', $phrase);

        //生成图片
        header("Cache-Control: no-cache, must-revalidate");
        header('Content-Type: image/jpeg');

        if ($request->get('refresh')) { // 刷新验证码
            $data = $builder->inline();
            return json_encode(['hash1' => 447,'hash2' => '447', 'url' => $data]);
        }

        // 直接输出验证码
        $builder->output();
    }


    /**
     * 异步加载地区
     *
     * @param Request $request
     * @return mixed
     */
    public function regionList(Request $request)
    {

        return $this->regions->ajaxLoadRegions($request);
    }

    /**
     * 获取所有地区
     *
     * @param Request $request
     * @return array|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Foundation\Application|\Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function allRegionList(Request $request)
    {
        return result(0, $this->regions->getAllRegions(), '获取成功');
    }

    /**
     * 上传视频
     *
     * @param Request $request
     * @return array|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Foundation\Application|\Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function uploadVideo(Request $request)
    {
        // 上传视频
        $storePath = 'temp';
        if ($this->user_id) {
            $storePath = 'videos/user/'.$this->user_id; // 存储路径是动态的
        }
        $filename = $request->post('filename', 'name');
        $uploadRes = $this->uploadVideo->uploadVideo($request, $filename, $storePath);
        if (isset($uploadRes['error'])) {
            // 上传出错
            return result(-1, '', $uploadRes['error']);
        }
        return result(0, $uploadRes['data'], '上传成功！', ['count' => $uploadRes['count']]);
    }

    /**
     * 用户上传图片
     *
     * @param Request $request
     * @return array
     */
    public function uploadImage(Request $request)
    {
        $storePath = 'temp';
        if ($this->user_id) {
            $storePath = 'user/'.$this->user_id; // todo 存储路径是动态的
        }

        // 判断是否base64方式上传
        $isBase64 = $request->get('is_base64');
        if ($isBase64 || (is_mobile() && !is_app())) {
            // 手机端访问 针对微信端
            $filename = $request->post('img_base64', ''); // base64上传
            $base64Field = 'img_base64';
            $uploadRes = $this->tools->uploadPic($request, $filename, $storePath, false, $base64Field);
        } else {
            // PC端访问
            $filename = $request->post('filename', 'name');
//            if (empty($request->file($filename))) {
//                return result(-1, '', '请上传图片');
//            }
            $uploadRes = $this->tools->uploadPic($request, $filename, $storePath);
        }
        if (isset($uploadRes['data']['error'])) {
            // 上传出错
            return result(-1, '', $uploadRes['data']['error']);
        }
        return result(0, $uploadRes['data'], '上传成功！', ['count' => $uploadRes['count']]);
    }

    /**
     * PC端 异步加载对比商品列表
     *
     * @param Request $request
     * @return array
     */
    public function goodsCompareList(Request $request)
    {
        $this->need_auth = false;

        $goods_ids = explode(',', $request->get('goods_ids',''));
        $list = [];

        $compare_goods_ids = Compare::where('user_id', $this->user_id)->pluck('goods_id');
        foreach ($compare_goods_ids as $v) {
            if (in_array($v,$goods_ids)) {
                $list[$v] = "1";
            }
        }
        return result(0, $list, '');
    }

    /**
     * PC端 异步加载收藏商品列表
     *
     * @param Request $request
     * @return array
     */
    public function goodsCollectList(Request $request)
    {
        $this->need_auth = false; // 不需要登录验证
        $sku_ids = $request->get('sku_ids','');
        $goods_ids = explode(',', $request->get('goods_ids',''));
        $list = [];

        $collect_goods_ids = Collect::where([['user_id',$this->user_id],['collect_type',0]])->pluck('goods_id');
        foreach ($collect_goods_ids as $v) {
            if (in_array($v,$goods_ids)) {
                $list[$v] = "1";
            }
        }
        return result(0, $list, '');
    }

    /**
     * 异步加载模板内容
     *
     * @param Request $request
     * @return array
     * @throws \Throwable
     */
    public function ajaxRender(Request $request)
    {
        $uid = $request->get('uid');
        $tpl_file = $request->get('tpl_file'); // /0/goods/goods_floor.tpl
        $is_last = $request->get('is_last');
        $page = TemplateItem::where('uid', $uid)->select(['page'])->value('page');

        $render = $this->templateItem->getTemplateItemHtml($uid, $page);

        return result(0, $render);
    }

    /**
     * 异步加载模板数据
     *
     * @param Request $request
     * @return array
     */
    public function tplData(Request $request)
    {
        /*$tpl_code = $request->get('tpl_code');
        $act_goods_ids = $request->get('act_goods_ids', '');


        $data = [
            2788 => [
                'act_surplus' => 1,
                'act_total_sale' => 2,
                'id' => 2788, // 活动商品表主键id
                'rate' => 66.67 // 进度
            ]
        ];

        return result(0, $data);*/

        $tpl_code = $request->get('tpl_code', '');

        // 滚动商品
        $goods_ids = $request->get('goods_ids', 0);
        $output = $request->get('output', 0); // 是否渲染输出html
        $shop_id = $request->get('shop_id', '');
        $is_last = $request->get('is_last', '');

        // 附近店铺
        $lat = $request->get('lat', 0); // 经度
        $lng = $request->get('lng', 0); // 纬度


        // 列表
        $compact = [];
        if ($tpl_code == 'm_goods_list') {
            // 滚动商品
            $where = [];
            $where[] = ['goods_status',1]; // 商品状态 已发布
            $where[] = ['goods_audit',1]; // 审核通过
            if (!empty($shop_id)) {
                $where[] = ['shop_id',$shop_id];
            }
            $condition = [
                'where' => $where,
                'sortname' => 'goods_sort',
                'sortorder' => 'asc'
            ];

            if (!empty($goods_ids)) {
                $condition['in'] = [
                    'field' => 'goods_id',
                    'condition' => explode(',', $goods_ids)
                ];
            }

            list($m_goods_list, $m_goods_total) = $this->goods->getList($condition);
            $compact = compact('m_goods_list');
        }
//        dd($compact);
        $render = view('backend::site.'.$tpl_code, $compact)->render();
        return result(0, $render);
    }

    /**
     * 收货地址智能解析
     *
     * @param Request $request
     * @return array
     */
    public function addressParse(Request $request)
    {
        $address = $request->post('address'); // 粘帖收件人姓名、电话、地址、邮箱

        $parse_res = AddressParse::smart_parse($address);
        $data = [
            'mobile' => $parse_res['mobile'] ?? '',//,
            'tel' => $parse_res['tel'] ?? '',//,
            'email' => $parse_res['email'] ?? '',//,
            'province' => $parse_res['detail']['province'] ?? '',//'河北省',
            'province_code' => $parse_res['detail']['province_code'] ?? '',//'130000',
            'city' => $parse_res['detail']['city'] ?? '',//'秦皇岛市',
            'city_code' => $parse_res['detail']['city_code'] ?? '',//'130300',
            'district' => $parse_res['detail']['district'] ?? '',//'district',
            'district_code' => $parse_res['detail']['district_code'] ?? '',//'130306',
            'address_lng' => $parse_res['address_lng'] ?? '',//'119.217036',
            'address_lat' => $parse_res['address_lat'] ?? '',//'40.029065',
            'region_code' => $parse_res['detail']['region_code'] ?? '',//'13,03,06',
            'postcode' => $parse_res['postcode'] ?? '',//'066300',
            'person_name' => $parse_res['name'] ?? '',//'张s',
            'address' => $parse_res['detail']['address'] ?? '',//'河北省秦皇岛',
        ];
        return result(0, $data);
    }

    /**
     * 获取二维码登录信息
     *
     * @param Request $request
     * @return array
     */
    public function getQrcodeLoginKey(Request $request)
    {
        $data = [
            'user_id' => 'h7ci760hmcg3um28bmsv4o00us', // 26位 相当于token 用户标识
            'key' => 'F79FA86071C0DD4CBEE63415ED1090DE' // 32位 // 每隔一段时间刷新该值
        ];
        return result(0, $data);
    }

    /**
     * 二维码登录
     * 移动端页面（微信端、App客户端）授权登录页面
     *
     * @param Request $request
     */
    public function qrcodeLogin(Request $request)
    {
        $key = $request->get('k');

        // 验证k是否有效

        if ($request->method() == 'POST') {
            // 执行登录
            $user_id = $request->post('user_id');
            $key = $request->post('key');
            $handle = $request->post('handle'); // login-登录 cancel-取消

            //二维码已失效
            $qrcodeInvalid = true;
            if ($qrcodeInvalid) {
                $APIs = ["onMenuShareTimeline", "scanQRCode"];
                $wx_share_data = get_wx_share_data($APIs);
                $errCode = 0;
                if (!$wx_share_data) {
                    $errCode = -1;
                }
//                dd($wx_share_data);
                return view('site.qrcode_login_error', compact('wx_share_data', 'errCode'));
            }


        }


        return view('site.qrcode_login', compact('key'));
    }

    public function alioss(Request $request)
    {
        if ($this->user_id) {
            // 登录状态
            $dir = 'user/'.$this->user_id.'/files/'.format_time(time(), 'Y/m/d').'/';
        } else {
            // 未登录状态
            $dir = 'user/all/files/'.format_time(time(), 'Y/m/d').'/';
        }
        $data = [
            'accessid' =>sysconf('alioss_access_key_id'),
            'callback' => '',
            'dir' => $dir,
            'expire' => time(),
            'host' => get_oss_host(),
            'policy' => '',
            'signature' => '',
        ];

        return response()->json($data);
    }

    public function getExhibition(Request $request)
    {

        return result(0);
    }

    /**
     * App引导页
     *
     * @param Request $request
     * @return array
     */
    public function appGuide(Request $request)
    {
        $data = [
            'is_guide_open' => sysconf('is_guide_open'),
            'app_enter_button' => sysconf('app_enter_button'),
            'img_list' => explode('|', sysconf('app_guide_pic'))
        ];
        return result(0, $data);
    }

    /**
     * App全局数据
     *
     * @param Request $request
     * @return array
     */
    public function appInfo(Request $request)
    {

        $goods_nav_list = $this->template->getNavigationData('m_goods', 5, 3); // 底部导航菜单

        $data = [
            'lrw_version' => str_replace('v','',sysconf('lrw_version')),
            'is_open' => 0,
            "app_enable_forced_updates" => 1, // APP是否启动强制更新 0-非强制更新 1-强制更新

            // APP应用设置
            'app_ios_is_open' => sysconf('app_ios_is_open'),
            'app_ios_use_version' => sysconf('app_ios_use_version'),
            'app_android_is_open' => sysconf('app_android_is_open'),
            'app_android_use_version' => sysconf('app_android_use_version'),
            'app_close_reason' => sysconf('app_close_reason'),

            // APP下载设置
            'open_download_qrcode' => sysconf('open_download_qrcode'),
            'mall_android_app' => sysconf('mall_android_app'),
            'mall_ios_app' => sysconf('mall_ios_app'),

            'login_bgimg' => sysconf('app_login_bgimg'),
            'login_logo' => sysconf('app_login_logo'),
            'mall_phone' => sysconf('mall_phone'),
            'mall_qq' => sysconf('mall_qq'),
            'default_lazyload' => sysconf('default_lazyload_mobile'),
            'm_user_center_bgimage' => sysconf('m_user_center_bgimage'),
            'app_category_style' => "1", // sysconf('app_category_style'),
            'default_shop_image' => sysconf('default_shop_image'),
            'default_user_portrait' => sysconf('default_user_portrait'),
            'default_micro_shop_image' => sysconf('default_micro_shop_image'),
            'aliim_icon_show' => sysconf('app_aliim_icon_show'),
            'aliim_icon' => sysconf('app_aliim_icon'),
            'user_id' => $this->user_id,
            'session_id' => $this->session_id,
            'websocket_url' => get_ws_url('7272'),
            'host' => "http://".config('lrw.mobile_domain'),
            'aliim_enable' => sysconf('aliim_enable'),
            'aliim_headimg' => sysconf('default_user_portrait'),
            'image_url' => get_oss_host(),
            'version' => "1.1.0",
            'seller_version' => "1.0.0",
            'seller_update_url' => "",
            'use_weixin_login' => sysconf('use_weixin_login'),
            'wx_login_logo' => sysconf('wx_login_logo'),
            'SYS_SITE_MODE' => "0",
            'site_id' => null,
            'site_name' => null,
            'region_code' => null,
            'sys_shop_app_mode' => 0,
            'sys_store_app_mode' => 0,
            'is_freebuy_enable' => "0",
            'is_reachbuy_enable' => "0",
            'is_scancode_enable' => "0",
            'price_show_rule' => sysconf('price_show_rule'),
            'format_price' => sysconf('goods_price_format'),
            'site_nav_list' => [],
            'custom_style_enable_app' => "",
            'app_main_color' => "",
            'app_second_color' => "",
            'design_m_goods_shop_is_show' => "1",
            'design_m_goods_sale_is_show' => "1",
            'goods_nav_list' => $goods_nav_list,
            'new_order_remind_open' => sysconf('new_order_remind_open'),
            'yikf_url' => '', // "https://kf.xxxx.com/index/index/home?business_id=d7522d9e49167210aaad90d2a69af743&groupid=0&shop_id=0&goods_id=0&visiter_id=_1737&visiter_name=&avatar=http://xxxx/images/&domain=http://www.xxxx.com",
            'evaluate_show' => "1",
            'uc_capital_account_enable' => "1",
            'sys_recharge_card_enable' => "1",
            'sys_store_card_enable' => "1",
            'appid' => "wxxxxxxxx",
            'appsecret' => "wxxxxxxxxxxxxx",
            'integral_custom_name' => "积分",

        ];

//        // APP强制更新
        if (is_app('android')) {
            $data['app_version'] = sysconf('app_android_version');
            $data['app_update_url'] = sysconf('app_android_update_url');
            $data['app_update_content'] = sysconf('app_android_update_content');
        } elseif (is_app('ios')) {
            $data['app_version'] = sysconf('app_ios_version');
            $data['app_update_url'] = sysconf('app_ios_update_url');
            $data['app_update_content'] = sysconf('app_ios_update_content');
        }

        return result(0, $data);
    }

    public function getYikf(Request $request)
    {
        $shop_id = $request->get('shop_id'); //
        $goods_id = $request->get('goods_id', 0);

        $extra = [
            'tel' => '13333333333',
            'type' => 2
        ];
        return result(0, null, '', $extra);
    }

    public function giteeWebHooks(Request $request)
    {
        /* 数据校验省略，
           post过来的是json数据，
          一般只是验证密码是否与之前后台的一样
        */

//        file_put_contents('t1.txt', 'abb');
//        header('Content-type:text/html;charset=utf-8');
//        $output = shell_exec("cd /data/wwwroot/laravelvip-mall; sudo -u root git pull 2<&1");
//        echo "<pre>$output</pre>";
//        file_put_contents('t1.txt', $output, FILE_APPEND);

//        if(function_exists("shell_exec")){
////            $cute =  "cd /data/wwwroot/laravelvip-mall && git pull https://user:pass@gitee.com/user/project 1>&2";
//            $cute =  "cd /data/wwwroot/laravelvip-mall && git pull https://gitee.com/xxx/xxx.git 1>&2";
//            $exe = shell_exec($cute);
//            return "下拉完成-".date('Y-m-d H:i:s');
//        }else{
//            return '系统配置：shell_exec函数不可用';
//        }

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

    /**
     * 根据经纬度获取地区信息
     *
     * @param Request $request
     * @return array
     */
    public function regionGps(Request $request)
    {
        $lng = $request->get('lng'); // 经度
        $lat = $request->get('lat'); // 纬度
        if (!$lat || !$lng) {
            return result(-1, null, INVALID_PARAM);
        }
        $location = "$lng,$lat";
        $amapService = new AmapService();
        $info = $amapService->action_regeocode($location);
        $city = !empty($info['city']) ? $info['city'] : $info['province'];
        $formattedAddress = $info['province'] . $city . $info['district'] . $info['streetNumber']['street'];
        $region_name = $info['province'] . ' ' . $city . ' ' . $info['district'];
        $region_code = (new RegionRepository())->getRegionCodesByNames($region_name);
        $data = [
            'citycode' => $info['citycode'],
            'province' => $info['province'],
            'city' => $info['city'],
            'district' => $info['district'],
            'township' => $info['township'],
            'street' => $info['streetNumber']['street'],
            'streetNumber' => $info['streetNumber']['number'],
            'formattedAddress' => $formattedAddress,
            'region_code' => $region_code,
            'region_name' => $region_name,
            'is_last' => true,
        ];

        return result(0, $data);
    }

    public function userCenter(Request $request)
    {
        $seo_title = '用户主页';
        $user_id = $request->input('user_id', 0);
        $user_info = $this->userRep->getById($user_id, ['user_id', 'nickname', 'headimg', 'summary']);

        if (empty($user_info)) {
            return result(-1, [], INVALID_PARAM);
        }

        $user_info->headimg = get_image_url($user_info->headimg, 'headimg');

        $praise_count = (new UserPraiseRepository())->getUserPraiseCount($user_id, 0, 1);
        $collect_count = (new UserCollectRepository())->getUserCollectCount($user_id, 0, 1);
        $follow_count = (new UserFollowRepository())->getUserFollowCount($user_id, 1);
        $fans_count = (new UserFollowRepository())->getUserFansCount($user_id, 1);
        $live_status = Article::where([['user_id', $user_id], ['status', 1], ['article_type', 3]])
            ->orderBy('article_id', 'desc')
            ->value('live_status'); // 直播状态 0-未开始 1-直播总 2-已结束
        $is_followed = (new UserFollowRepository())->checkIsFollowed($this->user_id, $user_id);

        $compact = compact('seo_title',
            'user_info');

        $webData = []; // web端（pc、mobile）数据对象
        $data = [
            'app_prefix_data' => [
                'user_info' => $user_info,
                'praise_count' => $praise_count,
                'collect_count' => $collect_count,
                'follow_count' => $follow_count,
                'fans_count' => $fans_count,
                'live_status' => $live_status ?? 0,
                'is_followed' => $is_followed,

            ],
            'app_suffix_data' => [],
            'web_data' => $webData,
            'compact_data' => $compact,
            'tpl_view' => 'site.user_center'
        ];
        $this->setData($data); // 设置数据
        return $this->displayData(); // 模板渲染及APP客户端返回数据
    }

    /**
     * 获取会员中心数据
     *
     * @return array|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Foundation\Application|\Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function userCenterData()
    {
        $menus = [
            [
                'name' => '地址管理',
                'pic' => '',
                'url' => '/pages/users/user_address_list/index',
                'group_data_id' => 0,
                'group_mer_id' => 0,
            ]
        ];
        $data = [
            'banner' => [],
            'global_theme' => [
                'type' => 'purple',
                'theme_color' => '#905EFF',
                'assist_color' => '#FDA900',
                'theme' => '--view-theme: #905EFF;--view-assist:#FDA900;--view-priceColor:#FDA900;--view-bgColor:rgba(253, 169, 0,.1);--view-minorColor:rgba(144, 94, 255,.1);--view-bntColor11:#FFC552;--view-bntColor12:#FDB000;--view-bntColor21:#905EFF;--view-bntColor22:#A764FF;',
            ],
            'menu' => $menus
        ];
        return result(0, $data);
    }

    /**
     * 图片地址转base64
     *
     * @param Request $request
     * @return array|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Foundation\Application|\Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function imageBase64(Request $request)
    {
        $code = $request->input('code', '');
        $image = $request->input('image', '');

        $imageBase64 = base64_encode_image($image);

        $data = [
            'code' => false,
            'image' => $imageBase64
        ];

        return result(0, $data);
    }

    public function userList(Request $request)
    {
        $params = $request->all();

        // 获取数据
        $where = [];
        // 搜索条件 会员昵称
        $search_arr = ['keyword'];
        foreach ($search_arr as $v) {
            if (isset($params[$v]) && !empty($params[$v])) {
                if ($v == 'keyword') {
                    $where[] = ['nickname', 'like', "%{$params[$v]}%"];
                } else {
                    $where[] = [$v, $params[$v]];
                }
            }
        }

        $where[] = ['status', 1];
        // 列表
        $condition = [
            'where' => $where,
            'sortname' => 'user_id',
            'sortorder' => 'desc',
            'field' => ['user_id', 'nickname', 'headimg']
        ];

        list($list, $total) = $this->userRep->getList($condition);
        if ($list->isNotEmpty()) {
            foreach ($list as $item) {
                $item->headimg = get_image_url($item->headimg, 'headimg');
                $item->is_followed = (new UserFollowRepository())->checkIsFollowed($this->user_id, $item->user_id);
            }
        }
        $pageHtml = frontend_pagination($total);
        $page_array = frontend_pagination($total, true);

        $compact = compact('seo_title', 'pageHtml', 'list', 'page_json');

        if ($request->ajax() && !is_app()) { // web端访问 ajax请求
            $render = view('site.partials._user_list', $compact)->render();
            return result(0, $render);
        }

        $webData = []; // web端（pc、mobile）数据对象
        $data = [
            'app_prefix_data' => [
                'page' => $page_array,
                'list' => $list,
            ],
            'app_suffix_data' => [],
            'web_data' => $webData,
            'compact_data' => $compact,
            'tpl_view' => 'site.user_list'
        ];
        $this->setData($data); // 设置数据
        return $this->displayData(); // 模板渲染及APP客户端返回数据
    }

    /**
     * 用户相关协议
     */
    public function agreement($type)
    {
        if ($type == 'user_protocol') {
            $data = [
                'title' => '用户协议',
                'content' => sysconf('user_protocol')
            ];
        } else if ($type == 'private_protocol') {
            $data = [
                'title' => '隐私协议',
                'content' => sysconf('user_protocol')
            ];
        } else if ($type == 'integral_rules') {
            $data = [
                'title' => '积分规则',
                'content' => sysconf('user_protocol')
            ];
        }

        return result(0, $data);
    }

}
