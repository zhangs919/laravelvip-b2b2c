<?php

namespace App\Modules\Frontend\Http\Controllers\User;

use App\Models\User;
use App\Modules\Base\Http\Controllers\UserCenter;
use App\Services\ConnectApi;
use Illuminate\Http\Request;

class SecurityController extends UserCenter
{

    protected $connectApi;

    public function __construct(ConnectApi $connectApi)
    {
        parent::__construct();

        $this->connectApi = $connectApi;
    }

    public function security(Request $request)
    {
        $seo_title = '用户中心';

        $compact = compact('seo_title');

        return view('user.security.security', $compact);
    }

    /**
     * 修改密码
     *
     * @param Request $request
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editPassword(Request $request)
    {
        // 获取数据
        $type = $request->get('type', 'password');
        $service_type = 'edit_password';
        if ($request->ajax()) {
            return result(0, null);
        }

        $model = [
            'type' => $type,
            'service_type' => $service_type,
            'captcha' => null,
            'sms_captcha' => null,
            'password' => null,
            'mobile' => $this->user->mobile,
            'email_captcha' => null,
            'email' => null,
            'valid' => false,
            'success_tpl' => 'edit_password_2.tpl',
            'error_tpl' => 'edit_password_1.tpl',
            'token' => false,
            'exprie_interval' => 1800,
            'captcha_required' => true,
            'clientRuleCache' => 'cache',
        ];
        $validate_page = json_encode([]);

        $compact = compact('model', 'type', 'service_type');
        $webData = []; // web端（pc、mobile）数据对象
        $data = [
            'app_prefix_data' => [
                'model' => $model,
                'type' => $type,
                'service_type' => $service_type,
                'nav_default' => 'security',
                'no_load_form' => true,
                'validate_page' => $validate_page
            ],
            'app_suffix_data' => [],
            'web_data' => $webData,
            'compact_data' => $compact,
            'tpl_view' => 'user.security.edit_password'
        ];
        $this->setData($data); // 设置数据
        return $this->displayData(); // 模板渲染及APP客户端返回数据
    }

    /**
     * 修改密码保存数据
     *
     * @param Request $request
     * @return array|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     * @throws \Throwable
     */
    public function editPasswordSave(Request $request)
    {
        $editPasswordModel = $request->post('EditPasswordModel');
        $password = $editPasswordModel['password'];
        $type='password';

        $render = view('user.security.edit_password_2', compact('type'))->render();
        // 验证密码是否重复
        if (auth('user')->validate(['user_name'=>$this->user->user_name,'password'=>$password])) {

            return result(-1, $render, '新密码不能与原密码重复');
        }

        // 验证通过 修改密码
        $userData['password'] = $password;
        $ret = $this->userRep->modifyUser($this->user_id, $userData);
        if ($ret === false) {
            return result(-1, $render, '密码修改失败');
        }

        $render = view('user.security.edit_password_success', compact('type'))->render();
        return result(0, $render);
    }


    public function editMobile(Request $request)
    {
        // 获取数据
        $type = $request->get('type', 'password');
        $service_type = 'edit_mobile';
        if ($request->ajax()) {
            return result(0, null);
        }

        $model = [
            'type' => $type,
            'service_type' => $service_type,
            'captcha' => null,
            'sms_captcha' => null,
            'password' => null,
            'mobile' => $this->user->mobile,
            'email_captcha' => null,
            'email' => null,
            'valid' => false,
            'success_tpl' => 'edit_password_2.tpl',
            'error_tpl' => 'edit_password_1.tpl',
            'token' => false,
            'exprie_interval' => 1800,
            'captcha_required' => true,
            'clientRuleCache' => 'cache',
        ];
        $validate_page = json_encode([]);

        $compact = compact('model','type', 'service_type');
        $webData = []; // web端（pc、mobile）数据对象
        $data = [
            'app_prefix_data' => [
                'model' => $model,
                'type' => $type,
                'service_type' => $service_type,
                'nav_default' => 'security',
                'no_load_form' => true,
                'validate_page' => $validate_page
            ],
            'app_suffix_data' => [],
            'web_data' => $webData,
            'compact_data' => $compact,
            'tpl_view' => 'user.security.edit_mobile'
        ];
        $this->setData($data); // 设置数据
        return $this->displayData(); // 模板渲染及APP客户端返回数据
    }

    public function editMobileSave(Request $request)
    {
        $editPasswordModel = $request->post('EditMobileModel');
        $type='mobile';

        $mobile = $editPasswordModel['mobile'];
        $captcha = $editPasswordModel['captcha'] ?? '';
        $sms_captcha = $editPasswordModel['sms_captcha'] ?? '';

        $render = view('user.security.edit_mobile_2', compact('type'))->render();

        // todo 验证手机验证码
        $sms_captcha_validate = true;
        if (!$sms_captcha_validate) {
            return result(-1, $render, '验证码输入错误');
        }

        // 验证手机号是否存在
        $user_info = User::where('mobile', $mobile)->first();
        if (!empty($user_info)) {
            return result(-1, $render, '新手机号码与原手机号码重复');
        }

        // 验证通过 修改手机号
        $userData['mobile'] = $mobile;
        $ret = $this->userRep->update($this->user_id, $userData);
        if ($ret === false) {
            return result(-1, $render, '手机号修改失败');
        }

        $render = view('user.security.edit_mobile_success', compact('type'))->render();
        return result(0, $render);
    }


    public function editEmail(Request $request)
    {
        // 获取数据
        $type = $request->get('type', 'password');
        $service_type = 'edit_email';
        if ($request->ajax()) {
            return result(0, null);
        }

        $model = [
            'type' => $type,
            'service_type' => $service_type,
            'captcha' => null,
            'sms_captcha' => null,
            'password' => null,
            'mobile' => $this->user->mobile,
            'email_captcha' => null,
            'email' => null,
            'valid' => false,
            'success_tpl' => 'edit_password_2.tpl',
            'error_tpl' => 'edit_password_1.tpl',
            'token' => false,
            'exprie_interval' => 1800,
            'captcha_required' => true,
            'clientRuleCache' => 'cache',
        ];
        $validate_page = json_encode([]);

        $compact = compact('model','type', 'service_type');
        $webData = []; // web端（pc、mobile）数据对象
        $data = [
            'app_prefix_data' => [
                'model' => $model,
                'type' => $type,
                'service_type' => $service_type,
                'nav_default' => 'security',
                'no_load_form' => true,
                'validate_page' => $validate_page
            ],
            'app_suffix_data' => [],
            'web_data' => $webData,
            'compact_data' => $compact,
            'tpl_view' => 'user.security.edit_email'
        ];
        $this->setData($data); // 设置数据
        return $this->displayData(); // 模板渲染及APP客户端返回数据
    }

    public function editEmailSave(Request $request)
    {
        $editPasswordModel = $request->post('EditEmailModel');
        $type='email';

        $email = $editPasswordModel['email'];
        $captcha = $editPasswordModel['captcha'] ?? '';
        $sms_captcha = $editPasswordModel['sms_captcha'] ?? '';

        $render = view('user.security.edit_email_2', compact('type'))->render();

        //
        if ($captcha != session('captcha')) {
            return result(-1, $render, '验证码输入错误');
        }
        // todo 验证手机验证码
        $sms_captcha_validate = true;
        if (!$sms_captcha_validate) {
            return result(-1, $render, '验证码输入错误');
        }

        // 验证手机号是否存在
        $user_info = User::where('email', $email)->first();
        if (!empty($user_info)) {
            return result(-1, $render, '新邮箱与原邮箱重复');
        }

        // 验证通过
        // 发送邮件验证 todo

        // todo 暂时先修改邮箱
        $userData['email'] = $email;
        $ret = $this->userRep->update($this->user_id, $userData);
        if ($ret === false) {
            return result(-1, $render, '邮箱修改失败');
        }

        $render = view('user.security.edit_email_success', compact('type'))->render();
        return result(0, $render);
    }


    /**
     * 发送短信验证码
     *
     * @param Request $request
     * @return mixed
     */
    public function smsCaptcha(Request $request)
    {
        $mobile = $request->get('mobile'); // 无手机号参数 验证身份；有手机号参数，绑定验证手机号码
        $captcha = $request->get('captcha');
        $log_type = 6; // 常规验证类验证码
        if (empty($mobile)) {
            $mobile = $this->user->mobile;
        }

        // 发送频繁
//        return result(-1, ['show_captcha'=>1], '每60秒内只能发送一次短信验证码，请稍候重试', ['errors'=>['mobile' => ['每60秒内只能发送一次短信验证码，请稍候重试']]]);
        $ret = $this->connectApi->sendCaptcha($mobile, $log_type);
        if (!$ret['code']) {
            return result(-1, null, $ret['message']);
        }
        return result(0, null, '发送成功');
    }

    public function validateData(Request $request)
    {

        if (str_contains(url()->previous(), 'edit-mobile')) {
            $tmp_type = 'edit_mobile_2';
            $service_type = 'edit_mobile';
        } else if (str_contains(url()->previous(), 'edit-email')) {
            $tmp_type = 'edit_email_2';
            $service_type = 'edit_email';
        } else if (str_contains(url()->previous(), 'edit-password')) {
            $tmp_type = 'edit_password_2';
            $service_type = 'edit_password';
        } else if (str_contains(url()->previous(), 'edit-surplus-password')) {
            $tmp_type = 'edit_surplus_password_2';
            $service_type = 'edit_surplus_password';
        } else if (str_contains(url()->previous(), 'close-surplus-password')) {
            $tmp_type = 'close_surplus_password_success';
            $service_type = 'close_surplus_password';
        }

        if ($request->method() == 'POST') {

            $validateModel = $request->post('ValidateModel');
            $type = $validateModel['type'];
            if ($type == 'password') { // 登录密码验证
                $password = $validateModel['password'];
                if (!auth('user')->validate(['user_name'=>$this->user->user_name,'password'=>$password])) {
                    $data = [
                        'field' => 'captcha',
                        'show_captcha' => true
                    ];
                    return result(-1, $data, '密码错误');
                }
            } elseif ($type == 'mobile') { // 设置手机验证
                $sms_captcha = $validateModel['sms_captcha'];
                // todo 验证手机验证码
                $sms_captcha_validate = true;
                if (!$sms_captcha_validate) {
                    $data = [
                        'field' => 'captcha',
                        'show_captcha' => false
                    ];
                    return result(-1, $data, '验证码输入错误');
                }
            }

            // 验证通过
            if ($service_type == 'close_surplus_password') { // 置空余额支付密码
                //
                $userData['surplus_password'] = null;
                $ret = $this->userRep->modifyUser($this->user_id, $userData);
                if ($ret === false) {
                    return result(-1, null, '密码修改失败');
                }
            }

            $render = view('user.security.'.$tmp_type, compact('type','service_type'))->render();
            return result(0, $render);
        }


        // 验证身份方式：手机验证
        $type = $request->get('type', 'mobile');
        $render = view('user.security.edit_password_1', compact('type','service_type'))->render();
        return result(0, $render);
    }

    /**
     * 名称验证是否重复
     *
     * @param Request $request
     * @return mixed
     */
    public function clientValidate(Request $request)
    {
        $result = $this->userRep->clientValidate($request, 'EditMobileModel');
        if (!$result['code']) {
            return result(-1, '', '新手机号码与原手机号码重复');
        }
        return result(0, null);
    }

    public function editSurplusPassword(Request $request)
    {
        // 获取数据
        $type = $request->get('type', 'password');
        $service_type = 'edit_surplus_password';
        if ($request->ajax()) {
            return result(0, null);
        }

        $model = [
            'type' => $type,
            'service_type' => $service_type,
            'captcha' => null,
            'sms_captcha' => null,
            'password' => null,
            'mobile' => $this->user->mobile,
            'email_captcha' => null,
            'email' => null,
            'valid' => false,
            'success_tpl' => 'edit_password_2.tpl',
            'error_tpl' => 'edit_password_1.tpl',
            'token' => false,
            'exprie_interval' => 1800,
            'captcha_required' => true,
            'clientRuleCache' => 'cache',
        ];
        $validate_page = json_encode([]);
        $compact = compact('model', 'type','service_type');

        $webData = []; // web端（pc、mobile）数据对象
        $data = [
            'app_prefix_data' => [
                'model' => $model,
                'type' => $type,
                'service_type' => $service_type,
                'nav_default' => 'security',
                'no_load_form' => true,
                'validate_page' => $validate_page
            ],
            'app_suffix_data' => [],
            'web_data' => $webData,
            'compact_data' => $compact,
            'tpl_view' => 'user.security.edit_surplus_password'
        ];
        $this->setData($data); // 设置数据
        return $this->displayData(); // 模板渲染及APP客户端返回数据
    }

    /**
     * 修改支付密码保存数据
     *
     * @param Request $request
     * @return array|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     * @throws \Throwable
     */
    public function editSurplusPasswordSave(Request $request)
    {
        $editPasswordModel = $request->post('EditSurplusPasswordModel');
        $password = $editPasswordModel['surplus_password'];
        $type='password';

        $render = view('user.security.edit_surplus_password_2', compact('type'))->render();
        // 验证密码是否重复


        // 验证通过 修改密码
        $userData['surplus_password'] = $password;
        $ret = $this->userRep->modifyUser($this->user_id, $userData);
        if ($ret === false) {
            return result(-1, $render, '密码修改失败');
        }

        $render = view('user.security.edit_surplus_password_success', compact('type'))->render();
        return result(0, $render);
    }

    public function closeSurplusPassword(Request $request)
    {
        // 获取数据
        $type='password';
        $service_type = 'close_surplus_password';
        $action = '/user/security/close-surplus-password.html';
        if ($request->ajax()) {
            return result(0, null);
        }

        $model = [
            'type' => $type,
            'service_type' => $service_type,
            'captcha' => null,
            'sms_captcha' => null,
            'password' => null,
            'mobile' => $this->user->mobile,
            'email_captcha' => null,
            'email' => null,
            'valid' => false,
            'success_tpl' => 'edit_password_3.tpl',
            'error_tpl' => 'edit_password_1.tpl',
            'token' => false,
            'exprie_interval' => 1800,
            'captcha_required' => true,
            'clientRuleCache' => 'cache',
        ];
        $validate_page = json_encode([]);

        $compact = compact('model', 'type','service_type', 'action');
        $webData = []; // web端（pc、mobile）数据对象
        $data = [
            'app_prefix_data' => [
                'model' => $model,
                'type' => $type,
                'service_type' => $service_type,
                'nav_default' => 'security',
                'no_load_form' => true,
                'validate_page' => $validate_page
            ],
            'app_suffix_data' => [],
            'web_data' => $webData,
            'compact_data' => $compact,
            'tpl_view' => 'user.security.close_surplus_password'
        ];
        $this->setData($data); // 设置数据
        return $this->displayData(); // 模板渲染及APP客户端返回数据
    }

    /**
     * 注销账户
     * 将账户设置为禁止登陆状态
     *
     * @param Request $request
     * @return array|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function cancel(Request $request)
    {
        $ret = $this->userRep->update($this->user_id, ['status'=>0]);
        if (!$ret) {
            return result(-1, null, OPERATE_FAIL);
        }

        // 退出登录
        auth('user')->logout();

        return result(0,null, '注销成功！');
    }

}