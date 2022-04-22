<?php

namespace App\Modules\Mobile\Http\Controllers\User;

use App\Modules\Base\Http\Controllers\MobileUserCenter;
use App\Repositories\ToolsRepository;
use App\Repositories\UserRealRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class ProfileController extends MobileUserCenter
{

    protected $userRep;
    protected $userReal;
    protected $tools;

    public function __construct()
    {
        parent::__construct();

        $this->userRep = new UserRepository();
        $this->userReal = new UserRealRepository();
        $this->tools = new ToolsRepository();
    }

    public function index(Request $request)
    {
        $seo_title = '用户中心';

        // 会员实名认证信息
        $user_real = $this->userReal->getByField('user_id', $this->user_id);

        $compact = compact('seo_title', 'user_real');

        return view('user.profile.index', $compact);
    }

    /**
     * 编辑个人基本信息保存
     *
     * @param Request $request
     * @return array
     */
    public function editProfileInfo(Request $request)
    {
        $item = $request->post('item');
        $value = $request->post('value');
        $title = $request->post('title');
        $update[$item] = $value;
        $ret = $this->userRep->update($this->user_id, $update);
        if ($ret === false) {
            result(-1, null, '设置'.$title.'失败');
        }
        return result(0, null, '设置'.$title.'成功');
    }

    /**
     * 编辑个人基本信息保存
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function editBase(Request $request)
    {
        $address_code = $request->post('address_code'); // 地址编号
        $userUpdate = $request->post('UserModel');
        $userUpdate['address_code'] = $address_code;
        $userUpdate['birthday'] = format_time($userUpdate['birthday'], 'Y-m-d');
        $ret = $this->userRep->update($this->user_id, $userUpdate);
        if ($ret === false) {
            flash('error', '更新失败！');
            return redirect('/user/profile.html');
        }
        // 更新会员信息缓存
//        $user = auth('user')->user();
//        $request->session()->put('user', $user);

        flash('success', '更新成功！');
        return redirect('/user/profile.html');
    }

    /**
     * 实名认证
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function editReal(Request $request)
    {
        $userRealUpdate = $request->post('UserRealModel');
        $user_real = $this->userReal->getByField('user_id', $this->user_id);
        if (!empty($user_real)) { // 更新
            $ret = $this->userReal->update($user_real->real_id, $userRealUpdate);
        } else { // 新增
            $userRealUpdate['user_id'] = $this->user_id;
            $ret = $this->userReal->store($userRealUpdate);
        }
        if ($ret === false) {
            flash('error', '更新失败！');
            return redirect('/user/profile.html');
        }

        flash('success', '更新成功！');
        return redirect('/user/profile.html');
    }

    /**
     * 名称验证是否重复
     *
     * @param Request $request
     * @return mixed
     */
    public function clientValidate(Request $request)
    {
        $result = $this->userRep->clientValidate($request, 'UserModel', $this->user_id);
        if (!$result['code']) {
            return result(-1, '', $result['message']);
        }
        return result(0);
    }

    /**
     * 设置用户头像
     *
     * @param Request $request
     * @return array
     */
    public function upload(Request $request)
    {
        $filename = $request->post('load_img');
        $storePath = 'user/'.$this->user_id;
        $uploadRes = $this->tools->uploadPic($request, $filename, $storePath);

        if (isset($uploadRes['error'])) {
            // 上传出错
            return result(-1, '', $uploadRes['error']);
        }

        $ret = $this->userRep->update($this->user_id, ['headimg' => $uploadRes['data']['path']]);
        if ($ret === false) {
            return result(-1, '', '设置头像失败！');
        }

        return result(0, null, '设置头像成功', ['path' => $uploadRes['data']['path'],'url' => $uploadRes['data']['url']]);
    }


}