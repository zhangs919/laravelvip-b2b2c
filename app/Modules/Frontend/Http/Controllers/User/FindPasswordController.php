<?php


namespace App\Modules\Frontend\Http\Controllers\User;


use App\Models\User;
use App\Modules\Base\Http\Controllers\Frontend;
use App\Services\ConnectApi;
use Illuminate\Http\Request;

class FindPasswordController extends Frontend
{
    protected $connectApi;

    public function __construct(ConnectApi $connectApi)
    {
        parent::__construct();

        $this->connectApi = $connectApi;
    }

    public function findPassword(Request $request)
    {
        if ($request->method() == 'POST') {
            $accountModel = $request->post('AccountModel');
            if (session('captcha') != $accountModel['captcha']) {
                return redirect('/user/find-password.html')->with('error', '验证码不正确');
            }

            $userInfo = User::where('mobile', $accountModel['username'])
                ->OrWhere('user_name', $accountModel['username'])
                ->first();
            if (empty($userInfo)) {
                return redirect('/user/find-password.html')->with('error', '您输入的账户不存在');
            }
            if (empty($userInfo->mobile) && empty($userInfo->email)) {
                return redirect('/user/find-password.html')->with('error', '您的账号未绑定手机号或邮箱，请联系网站管理员');
            }

            session(['find_password_mobile' => $accountModel['username']]);
            return redirect('/user/find-password/validate');
        }

        return view('user.find-password.find_password');
    }

    public function validates(Request $request)
    {
        if ($request->method() == 'POST') {
            $accountModel = $request->post('AccountModel');
            if (session('sms_captcha') != $accountModel['sms_captcha']) {
                return redirect('/user/find-password/validate')->with('error', '验证码不正确');
            }

            $userInfo = User::where('mobile', session('find_password_mobile'))
                ->OrWhere('user_name', session('find_password_mobile'))
                ->first();
            if (empty($userInfo)) {
                return redirect('/user/find-password/validate')->with('error', '您输入的账户不存在');
            }
            if (empty($userInfo->mobile) && empty($userInfo->email)) {
                return redirect('/user/find-password/validate')->with('error', '您的账号未绑定手机号或邮箱，请联系网站管理员');
            }

            // 验证通过
            return redirect('/user/find-password/reset');

        }

        return view('user.find-password.validate');
    }

    public function reset(Request $request)
    {
        if ($request->method() == 'POST') {
            $accountModel = $request->post('AccountModel');
            $password = $accountModel['password'];

            // 验证通过 修改密码
            $userData['password'] = bcrypt($password);
            $ret = User::where('mobile', session('find_password_mobile'))->update($userData);
            if ($ret === false) {
                return redirect('/user/find-password/reset')->with('error', '密码修改失败');
            }

            // 验证通过
            return view('user.find-password.success');
        }

        return view('user.find-password.reset');
    }

    /**
     * 发送短信验证码
     *
     * @param Request $request
     * @return mixed
     */
    public function smsCaptcha(Request $request)
    {
        $mobile = session('find_password_mobile'); // $request->get('mobile');
        $captcha = $request->get('captcha');
        $log_type = 6; // 找回密码
        // 发送频繁
//        return result(-1, ['show_captcha'=>1], '每60秒内只能发送一次短信验证码，请稍候重试', ['errors'=>['mobile' => ['每60秒内只能发送一次短信验证码，请稍候重试']]]);
        $ret = $this->connectApi->sendCaptcha($mobile, $log_type);
        if ($ret['code'] != 0) {
            return result(-1, null, $ret['message']);
        }

        $data['show_captcha'] = 0; // 是否显示图形验证码
        return result(0, $data, '发送成功');
    }
}
