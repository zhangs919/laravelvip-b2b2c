<?php

// +----------------------------------------------------------------------
// | laravelvip 乐融沃B2B2C商城系统
// +----------------------------------------------------------------------
// | Copyright (c) 2017-2027 http://www.laravelvip.com All rights reserved.
// +----------------------------------------------------------------------
// | Notice: This code is not open source, it is strictly prohibited
// |         to distribute the copy, otherwise it will pursue its
// |         legal responsibility.
// +----------------------------------------------------------------------
// | 版权所有 2015-2027 云南乐融沃网络科技有限公司，并保留所有权利。
// | 网站地址: http://www.laravelvip.com
// +----------------------------------------------------------------------
// | 这不是一个自由软件！禁止拷贝本软件副本，否则将追究其法律责任！
// | 如需使用，请移步官网购买正版授权。
// +----------------------------------------------------------------------
// | Author: 雲溪荏苒 <290648237@qq.com>
// | Date:2018-10-31
// | Description: 短信发送
// +----------------------------------------------------------------------

namespace App\Services;


use App\Models\User;
use App\Repositories\MessageTemplateRepository;
use App\Repositories\SmsLogRepository;
use App\Repositories\UserRepository;
use App\Services\Enum\MessageTemplateMsgTypeEnum;
use App\Services\IP;
use App\Services\Statistics\UserStat;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;

class ConnectApi
{

    protected $ipService;
    protected $smsLog;
    protected $userRep;
    protected $messageTemplateRep;


    public function __construct(IP $ipService
        ,SmsLogRepository $smsLog
        ,UserRepository $userRep
        ,MessageTemplateRepository $messageTemplateRep
    )
    {
        $this->ipService = $ipService;
        $this->smsLog = $smsLog;
        $this->userRep = $userRep;
        $this->messageTemplateRep = $messageTemplateRep;

    }

    /**
     * 发送手机验证码
     * @param string $phone
     * @param string $log_type
     * @return array
     */
    public function sendCaptcha($phone, $log_type)
    {
//        $model_sms_log = model('sms_log');
        $state = true;
        $msg = '手机验证码发送成功';
        $sms_log = $this->ipCaptcha($log_type);
        if (!empty($sms_log) && (strtotime($sms_log->created_at) > time() - sysconf('captcha_sms_ip_time') * 60)) {//同一IP[n]秒内只能发一条短信
            $state = false;
            $msg = '同一IP地址' . (sysconf('captcha_sms_ip_time') * 60) . '秒内，请勿多次获取验证码！';
        }
        $where = [];
        $where[] = ['log_phone', $phone];
        $where[] = ['log_type', $log_type];
        $sms_log = $this->smsLog->getSmsLogInfo($where);
        if ($state && !empty($sms_log) && (strtotime($sms_log->created_at) > time() - sysconf('captcha_sms_mobile_time') * 60)) {//同一手机号IP[n]秒内只能发一条短信
            $state = false;
            $msg = '同一手机号' . (sysconf('captcha_sms_mobile_time') * 60) . '秒内，请勿多次获取验证码！';
        }
        $time24 = time() - 60 * 60 * 24;
        $where = [];
        $where[] = ['log_phone', $phone];
        $where[] = ['created_at', '>=', $time24];
        $num = $this->smsLog->getSmsLogCount($where);
        if ($state && $num >= 5) {//同一手机号24小时内只能发5条短信 暂时设置成5条
            $state = false;
            $msg = '同一手机号24小时内，请勿多次获取验证码！';
        }

        $log_ip = $this->ipService->get();
        $where = [];
        $where[] = ['log_ip', $log_ip];
        $where[] = ['created_at', '>=', $time24];
        $num = $this->smsLog->getSmsLogCount($where);
        if ($state && $num >= 20) {//同一IP24小时内只能发20条短信 暂时设置成20条
            $state = false;
            $msg = '同一IP24小时内，请勿多次获取验证码！';
        }
        if ($state == true) {
            $log_array = array();
            $user_info = User::where('mobile', $phone)->first();
            $captcha = rand(100000, 999999); // 6位验证码

            $log_msg = '您于' . date("Y-m-d");
            switch ($log_type) {
                case '1':
                    if (!in_array(1, explode(',', sysconf('register_type')))) {
                        $state = false;
                        $msg = '系统没有开启手机注册功能';
                    }
                    if (!empty($user_info)) {//检查手机号是否已被注册
                        $state = false;
                        $msg = '当前手机号已被注册，请更换其他号码。';
                    }
                    $log_msg .= '申请注册会员，验证码：' . $captcha . '。';
                    $templateCode = 'register_captcha';
                    break;
                case '2':
//                    if(sysconf('') != 1) {
//                        $state = false;
//                        $msg = '系统没有开启手机登录功能';
//                    }
                    if (empty($user_info)) {//检查手机号是否已绑定会员
                        $state = false;
                        $msg = '当前手机号未注册，请检查号码是否正确。';
                    }
                    $log_msg .= '申请登录，验证码：' . $captcha . '。';
                    $log_array['user_id'] = $user_info->user_id;
                    $log_array['user_name'] = $user_info->user_name;

                    $templateCode = 'login_captcha';
                    break;
                case '3':
//                    if(sysconf('') != 1) {
//                        $state = false;
//                        $msg = '系统没有开启手机找回密码功能';
//                    }
                    if (empty($user_info)) {//检查手机号是否已绑定会员
                        $state = false;
                        $msg = '当前手机号未注册，请检查号码是否正确。';
                    }
                    $log_msg .= '申请重置登录密码，验证码：' . $captcha . '。';
                    $log_array['user_id'] = $user_info->user_id;
                    $log_array['user_name'] = $user_info->user_name;

                    $templateCode = 'find_pwd_captcha';
                    break;

                case '4':
                    if (!empty($user_info)) {//检查手机号是否已绑定会员
                        $state = false;
                        $msg = '新手机号已被注册，请更换其他号码。';
                    }
                    $log_msg .= '申请更换手机号，验证码：' . $captcha . '。';
                    $log_array['user_id'] = $user_info->user_id;
                    $log_array['user_name'] = $user_info->user_name;

                    $templateCode = 'login_captcha';
                    break;

                case '5':
                    // 更换手机号 验证旧手机号
//                    if(sysconf('') != 1) {
//                        $state = false;
//                        $msg = '系统没有开启手机找回密码功能';
//                    }
                    if (empty($user_info)) {//检查手机号是否已绑定会员
                        $state = false;
                        $msg = '当前手机号未注册，请检查号码是否正确。';
                    }
                    $log_msg .= '申请更换手机号，验证旧手机号，验证码：' . $captcha . '。';
                    $log_array['user_id'] = $user_info->user_id;
                    $log_array['user_name'] = $user_info->user_name;

                    $templateCode = 'login_captcha';
                    break;

                case '6':
                    // 常规验证类验证码
                    $log_msg = '您的验证码是：' . $captcha . '，请不要把验证码泄露给其他人。如非本人操作，可不用理会！';
                    $log_array['user_id'] = $user_info->user_id;
                    $log_array['user_name'] = $user_info->user_name;

                    $templateCode = 'login_captcha';
                    break;

                default:
                    $state = false;
                    $msg = '参数错误';
                    $templateCode = '';
                    break;
            }
            if ($state == true) {
                try {
                    // 短信模版信息
                    $messageTemplate = $this->messageTemplateRep->getTemplateConfig($templateCode, MessageTemplateMsgTypeEnum::TYPE_SMS);
                    // 定义替换数据（变量名 => 实际值）
                    $params = [
                        'code'    => $captcha,
                    ];

                    // 批量替换占位符
                    $log_msg = preg_replace_callback(
                        '/\$\{(\w+)\}/',
                        function ($matches) use ($params) {
                            $varName = $matches[1]; // 提取变量名（如 'code'）
                            return isset($params[$varName]) ? $params[$varName] : $matches[0]; // 存在则替换，否则保留原占位符
                        },
                        $messageTemplate['content']
                    );

                    // 缓存验证码
//                session(['sms_captcha' => $captcha]);
                    $cache_id = CACHE_KEY_SMS_CAPTCHA[0].':'.$user_info->user_id.':'.$log_type;
                    cache()->put($cache_id, $captcha, CACHE_KEY_SMS_CAPTCHA[1]);
                    $sms = new SmsService();
                    // 阿里云短信模版id
                    $template_id = $messageTemplate['aliyu_code'] ?? '';
                    $result = $sms->send($phone, $log_msg, $template_id,$params);

                    if ($result === true) { // 短信发送成功 新增短信日志记录
                        $log_array['log_phone'] = $phone;
                        $log_array['log_captcha'] = $captcha;
                        $log_array['log_ip'] = $this->ipService->get();
                        $log_array['log_msg'] = $log_msg;
                        $log_array['log_type'] = $log_type;
                        $this->smsLog->store($log_array);
                    } else {
                        $state = false;
                        $msg = env('APP_ENV') != 'production' ? $result : '手机短信发送失败';
                    }
                } catch (\Exception $e) {
                    $msg = env('APP_ENV') != 'production' ? $e->getMessage() : '手机短信发送失败';
                    return arr_result(-1, [], $msg);
                }
            }
        }
        return arr_result(($state ? 0 : -1), [], $msg);
    }

    /**
     * 按IP查询手机验证码
     * @param string $log_type
     * @return array
     */
    public function ipCaptcha($log_type = '')
    {
        $where[] = ['log_ip', $this->ipService->get()];

        $log_type = intval($log_type);
        if ($log_type > 0) {
            $where[] = ['log_type', $log_type]; //短信类型:1为注册,2为登录,3为找回密码
        }
        $sms_log = $this->smsLog->getSmsLogInfo($where);
        return $sms_log;
    }

    /**
     * 第三方应用用户登录商城
     *
     * @param Request $request
     * @return array|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Foundation\Application|\Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function attemptThirdLogin(Request $request)
    {
        $app_secret = $request->input('app_secret');
        $mobile = $request->input('mobile');
        $req_ip = request()->ip();
        // 验证请求IP地址是否合法
        if (!in_array($req_ip, THIRD_APP_AUTH_IP)) {
            return arr_result(1, [], '非法请求');
        }
        if ($app_secret != THIRD_APP_SECRET) {
            return arr_result(1, [], '授权密钥无效');
        }

        $u = User::where('mobile', $mobile)->first();
        // 验证手机号是否存在
        if (empty($u)) {
            return arr_result(1, [], '手机号码不存在');
        }
        if (!$u->status) {
            return arr_result(1, [], '账户已经禁用');
        }
        $device_name = $request->input('device_name');
        $tokenData = $u->createToken($device_name,
//                ['server:limited']
            ['*'],
            Carbon::now()->addDays(7) // token有效期：7天
        );

        $loginData = [
            'mobile' => $mobile,
            'access_token' => $tokenData->plainTextToken,
            'expires_at' => $tokenData->accessToken->expires_at->toDateTimeString()
        ];
        return arr_result(0, $loginData);
    }

    /**
     * 执行登录
     *
     * @param Request $request
     * @return mixed
     */
    public function attemptLogin(Request $request)
    {
        if ($mobile = $request->input('SmsLoginModel.mobile')) { // 动态密码登录
            $u = User::where('mobile', $mobile)->first();
            // 验证手机号是否存在
            if (empty($u)) {
                return arr_result(-1, null, '手机号码不存在', ['redirect' => '/login.html']);
            }
            if (!$u->status) {
                return arr_result(-1, null, '账户已经禁用', ['redirect' => '/login.html']);
            }

            // 验证手机验证码
			$sms_captcha = $request->input('SmsLoginModel.sms_captcha');
            $cache_id = CACHE_KEY_SMS_CAPTCHA[0].':'.$u->user_id.':2';
            $cache_sms_captcha = cache()->get($cache_id);
            if (config('app.env') == 'production' && $cache_sms_captcha != $sms_captcha) {
                return arr_result(-1, null, '手机验证码有误', ['redirect' => '/login.html']);
            }
            // 验证通过 手动认证登录
 			auth('user')->login($u);
			$loginData = [
				'mobile' => $mobile,
				'sms_captcha' => $sms_captcha,
			];
        } elseif ($username = $request->input('LoginModel.username')) { // 普通登录
            if (check_is_mobile($username)) { // 手机号登录
                $username_field = 'mobile';
            } elseif (check_is_email($username)) { // 邮箱登录
                $username_field = 'email';
            } else { // 默认用户名登录
                $username_field = 'user_name';
            }
            // 验证账号是否已禁用
            $u = User::where($username_field, $request->input('LoginModel.username'))->first();
            if (!empty($u) && !$u->status) {
                return arr_result(-1, null, '账户已经禁用', ['redirect' => '/login.html']);
            }

            // 验证密码是否正确
            if (! $u || ! Hash::check($request->input('LoginModel.password'), $u->password)) {
                return arr_result(-1, null, '用户名或密码无效', ['redirect' => '/login.html']);
            }


            $loginData = [
                $username_field => $request->input('LoginModel.username'),
                'password' => $request->input('LoginModel.password')
            ];

            if (!empty($request->input('LoginModel.verifyCode'))) {
                // 验证图形验证码
                if (session('captcha') != $request->input('LoginModel.verifyCode')) {
                    return arr_result(-1, null, '验证码有误', ['redirect' => '/login.html']);
                }
            }
        }

        // app或小程序访问
        if (is_app()) {
            $device_name = $request->input('device_name');
            $tokenData = $u->createToken($device_name,
//                ['server:limited']
            );
            $loginData['access_token'] = $tokenData->plainTextToken;
            // $loginData['expires_at'] = $tokenData->accessToken->expires_at;
            $loginData['expires_at'] = time() + 525600 * 60; // 365天
            $loginData['token_type'] = 'bearer';
            $loginData['user_id'] = $u->user_id;
            $loginData['user'] = $u;

            unset($loginData[$username_field], $loginData['password']);
        }
        return arr_result(0, $loginData);
    }

    /**
     * 执行注册
     *
     * @param Request $request
     * @param $reg_type
     * @return array|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function attemptRegister(Request $request, $reg_type)
    {
//        $ref_url = route('pc_home'); // 暂时默认跳转回网站首页
        $remember = $request->input('remember', 0); // 是否同意用户注册协议


        if ($reg_type == 'mobile') {
            // 手机注册
            $registerModel = $request->input('MobileRegisterModel');
			if (empty($registerModel['password'])) {
				// 设置默认密码 手机号后6位
				$registerModel['password'] = substr($registerModel['mobile'], -6);
			}
            $extra = ['register_model'=>$registerModel,'redirect' => '/register.html'];

            if (!$remember) {
//                return arr_result(-1, null, '请先同意用户注册协议',$extra);
            }

            // 验证图片验证码
            if (isset($registerModel['captcha'])) {
                $inputImgCaptcha = $registerModel['captcha'];
                $imgCaptcha = session('captcha'); // 图片验证码
                if ($inputImgCaptcha != $imgCaptcha) {
                    return arr_result(-1, null, '验证码有误', $extra);
                }
            }

            // 验证手机验证码
            if (config('app.env') == 'production' && $registerModel['sms_captcha'] != session('sms_captcha')) {
                return arr_result(-1, null, '手机验证码有误', $extra);
            }

            // 保存注册信息
            $ret = $this->userRep->register($registerModel, 1);
            if (!$ret) {
                return arr_result(-1, null, '注册信息保存失败。', $extra);
            }
            $loginData = [
                'mobile' => $registerModel['mobile'],
                'password' => $registerModel['password']
            ];

        } elseif ($reg_type == 'email') {
            // 邮箱注册
            $registerModel = $request->input('EmailRegisterModel');
            $extra = ['register_model'=>$registerModel,'redirect' => '/register.html'];
            if (!$remember) {
//                return arr_result(-1, null, '请先同意用户注册协议',$extra);
            }
            // todo 验证手机验证码

            // 保存注册信息
            $ret = $this->userRep->register($registerModel, 1);
            if (!$ret) {
                return arr_result(-1, null, '注册信息保存失败。', $extra);
            }
            $loginData = [
                'email' => $request->input('EmailRegisterModel.email'),
                'password' => $request->input('EmailRegisterModel.password')
            ];
        } else {
            return arr_result(-1, null, '不支持的注册方式');
        }
        // 注册成功 统计新增用户
        UserStat::incr($ret);

        return arr_result(0, $loginData, '注册成功');
    }
}
