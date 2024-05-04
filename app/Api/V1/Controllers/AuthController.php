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
// | Date:2024-01-13
// | Description: APP、小程序端：登录、退出登录
// +----------------------------------------------------------------------

namespace App\Api\V1\Controllers;

use App\Api\Foundation\Controllers\BaseController;
use App\Repositories\UserRepository;
use App\Services\ConnectApi;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

/**
 * APP、小程序端：登录、退出登录
 */
class AuthController extends BaseController
{

    protected $userRep;
    protected $connectApi;

    public function __construct(UserRepository $userRep, ConnectApi $connectApi)
    {
        parent::__construct();

        $this->userRep = $userRep;
        $this->connectApi = $connectApi;

        $this->middleware('auth:sanctum')->except('login', 'logout');
    }

    /**
     * 用户登录
     *
     * 用户登录获取token值
     *
     * @Post("/auth/login")
     * @Versions({"v1"})
     * @Request({"user_name": "foo", "password": "bar"})
     * @Response(200, body={"access_token": "aasdasdasda", "token_type": "bearer", "expires_in": 3600,})
     */
    public function login(Request $request)
    {


        // 验证参数
        try {
            if ($request->input('SmsLoginModel.mobile')) {
                $this->validate($request, [
                    'SmsLoginModel.mobile' => 'required|string',
                    'SmsLoginModel.smsCaptcha' => 'required|string',
                ], [
                    'SmsLoginModel.mobile.required' => '手机号不能为空',
                    'SmsLoginModel.smsCaptcha.required' => '验证码不能为空',
                ]);
            } elseif ($request->input('LoginModel.username')) {
                $this->validate($request, [
                    'LoginModel.username' => 'required|string',
                    'LoginModel.password' => 'required|string',
                    'LoginModel.device_name' => 'required|string',
                ], [
                    'LoginModel.username.required' => '用户名不能为空',
                    'LoginModel.password.required' => '密码不能为空',
                    'LoginModel.device_name.required' => '设备名称不能为空',
                ]);
            }
        } catch (ValidationException $e) {
            return $this->error($e->getMessage());
        }
        $res = $this->connectApi->attemptLogin($request);
        if (isset($res['code']) && $res['code'] == -1) {
            return $this->error($res['message']);
        }

        $data = $res['data'];
        return $this->success($data, '登录成功');
    }

    /**
     * 退出登录
     *
     * 退出登录
     *
     * @Post("/auth/logout")
     * @Versions({"v1"})
     */
    public function logout(Request $request)
    {
        $user = $request->user('sanctum');
        if (!$user) {
            return $this->success([], '退出登录成功');
        }
        $request->user('sanctum')->tokens()->where('tokenable_id', $user->user_id)->delete();
        return $this->success([], '退出登录成功');
    }
}