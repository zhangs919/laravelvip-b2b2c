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



use App\Repositories\SmsLogRepository;
use App\Tools\IP;
use App\User;

class ConnectApi
{

    protected $ip;
    protected $smsLog;

    public function __construct()
    {
        $ipService = new IP(request());
        $this->ip = $ipService->get();
        $this->smsLog = new SmsLogRepository();

    }

    /**
     * 发送手机验证码
     * @param string $phone
     * @param string $log_type
     * @return array
     */
    public function sendCaptcha($phone, $log_type){
//        $model_sms_log = model('sms_log');
        $state = true;
        $msg = '手机验证码发送成功';
        $sms_log = $this->ipCaptcha($log_type);
        if(!empty($sms_log) && (strtotime($sms_log->created_at) > time() - sysconf('captcha_sms_ip_time')*60)) {//同一IP[n]秒内只能发一条短信
            $state = false;
            $msg = '同一IP地址'.(sysconf('captcha_sms_ip_time')*60).'秒内，请勿多次获取验证码！';
        }

        $where = [];
        $where[] = ['log_phone', $phone];
        $where[] = ['log_type', $log_type];
        $sms_log = $this->smsLog->getSmsLogInfo($where);
        if($state && !empty($sms_log) && (strtotime($sms_log->created_at) > time() - sysconf('captcha_sms_mobile_time')*60)) {//同一手机号IP[n]秒内只能发一条短信
            $state = false;
            $msg = '同一手机号'.(sysconf('captcha_sms_mobile_time')*60).'秒内，请勿多次获取验证码！';
        }
        $time24 = time()-60*60*24;
        $where = [];
        $where[] = ['log_phone', $phone];
        $where[] = ['created_at', '>=', $time24];
        $num = $this->smsLog->getSmsLogCount($where);
        if($state && $num >= 5) {//同一手机号24小时内只能发5条短信 暂时设置成5条
            $state = false;
            $msg = '同一手机号24小时内，请勿多次获取验证码！';
        }

        $log_ip = $this->ip;
        $where = [];
        $where[] = ['log_ip', $log_ip];
        $where[] = ['created_at', '>=', $time24];
        $num = $this->smsLog->getSmsLogCount($where);
        if($state && $num >= 20) {//同一IP24小时内只能发20条短信 暂时设置成20条
            $state = false;
            $msg = '同一IP24小时内，请勿多次获取验证码！';
        }
        if($state == true) {
            $log_array = array();
            $user_info = User::where('mobile', $phone)->first();
            $captcha = rand(100000, 999999); // 6位验证码

            $log_msg = '您于'.date("Y-m-d");
            switch ($log_type) {
                case '1':
                    if(!in_array(1, explode(',', sysconf('register_type')))) {
                        $state = false;
                        $msg = '系统没有开启手机注册功能';
                    }
                    if(!empty($user_info)) {//检查手机号是否已被注册
                        $state = false;
                        $msg = '当前手机号已被注册，请更换其他号码。';
                    }
                    $log_msg .= '申请注册会员，验证码：'.$captcha.'。';
                    break;
                case '2':
//                    if(sysconf('') != 1) {
//                        $state = false;
//                        $msg = '系统没有开启手机登录功能';
//                    }
                    if(empty($user_info)) {//检查手机号是否已绑定会员
                        $state = false;
                        $msg = '当前手机号未注册，请检查号码是否正确。';
                    }
                    $log_msg .= '申请登录，验证码：'.$captcha.'。';
                    $log_array['user_id'] = $user_info->user_id;
                    $log_array['user_name'] = $user_info->user_name;
                    break;
                case '3':
//                    if(sysconf('') != 1) {
//                        $state = false;
//                        $msg = '系统没有开启手机找回密码功能';
//                    }
                    if(empty($user_info)) {//检查手机号是否已绑定会员
                        $state = false;
                        $msg = '当前手机号未注册，请检查号码是否正确。';
                    }
                    $log_msg .= '申请重置登录密码，验证码：'.$captcha.'。';
                    $log_array['user_id'] = $user_info->user_id;
                    $log_array['user_name'] = $user_info->user_name;
                    break;

                case '4':
                    if(!empty($user_info)) {//检查手机号是否已绑定会员
                        $state = false;
                        $msg = '新手机号已被注册，请更换其他号码。';
                    }
                    $log_msg .= '申请更换手机号，验证码：'.$captcha.'。';
                    $log_array['user_id'] = $user_info->user_id;
                    $log_array['user_name'] = $user_info->user_name;
                    break;

                case '5':
                    // 更换手机号 验证旧手机号
//                    if(sysconf('') != 1) {
//                        $state = false;
//                        $msg = '系统没有开启手机找回密码功能';
//                    }
                    if(empty($user_info)) {//检查手机号是否已绑定会员
                        $state = false;
                        $msg = '当前手机号未注册，请检查号码是否正确。';
                    }
                    $log_msg .= '申请更换手机号，验证旧手机号，验证码：'.$captcha.'。';
                    $log_array['user_id'] = $user_info->user_id;
                    $log_array['user_name'] = $user_info->user_name;
                    break;
                default:
                    $state = false;
                    $msg = '参数错误';
                    break;
            }
            if($state == true){
                $sms = new SmsService();
                $result = $sms->send($phone,$log_msg);

                if($result){ // 短信发送成功 新增短信日志记录
                    $log_array['log_phone'] = $phone;
                    $log_array['log_captcha'] = $captcha;
                    $log_array['log_ip'] = $this->ip;
                    $log_array['log_msg'] = $log_msg;
                    $log_array['log_type'] = $log_type;
                    $this->smsLog->store($log_array);
                } else {
                    $state = false;
                    $msg = '手机短信发送失败';
                }
            }
        }

        return result($state, null, $msg, [], false);
    }

    /**
     * 按IP查询手机验证码
     * @param string $log_type
     * @return array
     */
    public function ipCaptcha($log_type = ''){
        $ipService = new IP(request());
        $where[] = ['log_ip', $ipService->get()];

        $log_type = intval($log_type);
        if ($log_type > 0) {
            $where[] = ['log_type', $log_type]; //短信类型:1为注册,2为登录,3为找回密码
        }
        $sms_log = $this->smsLog->getSmsLogInfo($where);
        return $sms_log;
    }
}