<?php

namespace App\Modules\Frontend\Http\Controllers\User;

use App\Models\User;
use App\Modules\Base\Http\Controllers\UserCenter;
use Illuminate\Http\Request;

class BindController extends UserCenter
{

    public function __construct()
    {
        parent::__construct();


    }

    public function index(Request $request)
    {
        $seo_title = '用户中心';

        $compact = compact('seo_title');

        return view('user.bind.index', $compact);
    }

    /**
     * 解除绑定
     *
     * @param Request $request
     * @return array|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function remove(Request $request)
    {
        $key = $request->get('key');

        $third_key = third_login_key($key);
        if (!$third_key) {
            return result(-1, null, '第三方登录方式未开启');
        }

        $update = [
            "{$third_key}_key" => null
        ];
        User::where('user_id', auth('user')->id())->update($update);

        return result(0, null, '解除绑定成功');
    }

}