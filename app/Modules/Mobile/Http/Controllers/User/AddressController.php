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
// | Date:2018-08-17
// | Description: 收货地址
// +----------------------------------------------------------------------

namespace App\Modules\Mobile\Http\Controllers\User;

use App\Models\UserAddress;
use App\Modules\Base\Http\Controllers\MobileUserCenter;
use App\Repositories\UserAddressRepository;
use Illuminate\Http\Request;

class AddressController extends MobileUserCenter
{

    protected $userAddress;

    public function __construct()
    {
        parent::__construct();

        $this->userAddress = new UserAddressRepository();
    }

    /**
     * 收货地址列表
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $seo_title = '用户中心';


        $condition = [
            'where' => [
                ['user_id', $this->user_id]
            ],
            'sortname' => 'is_default',
            'sortorder' => 'desc',
            'limit' => 20
        ];
        list($address_list, $address_total) = $this->userAddress->getList($condition);

        $compact = compact('seo_title', 'address_list', 'address_total');
        return view('user.address.index', $compact);
    }

    /**
     * 新增地址
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function add(Request $request)
    {
        $seo_title = '用户中心';
        $address_id = $request->get('address_id', 0);
        $tpl = 'add';

        if ($address_id) {
            // 更新地址
            $address_info = $this->userAddress->getById($address_id);
            view()->share('address_info', $address_info);
            $tpl = 'edit';
        }

        $compact = compact('seo_title');
        return view('user.address.'.$tpl, $compact);
    }

    /**
     * 编辑地址
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Request $request)
    {
        return $this->add($request);
    }

    /**
     * 添加/编辑地址保存数据
     *
     * @param Request $request
     * @return array
     */
    public function saveData(Request $request)
    {
        $post = $request->post('UserAddressModel');
        $address_id = $request->post('address_id', 0);

        if ($address_id) {
            // 编辑
            $ret = $this->userAddress->update($address_id, $post);
        }else {
            // 添加
            // 判断用户收货地址是否超过20个
            if (!$this->userAddress->checkUserAddressLimit($this->user_id)) {
                return result(-1, null, '最多只能保存20条地址');
            }
            $post['user_id'] = $this->user_id;
            $ret = $this->userAddress->store($post);
        }

        if ($ret === false) {
            // fail
            return result(-1, null, '操作失败！');
        }
        // success
        return result(0, null, '操作成功！');
    }

    /**
     * 设置默认地址
     *
     * @param Request $request
     * @return array
     */
    public function setDefault(Request $request)
    {
        $address_id = $request->get('address_id');
        if (!$address_id) {
            return  result(-1, null, '参数错误');
        }

        $ret = $this->userAddress->setDefault($address_id, auth('user')->id());
        if ($ret === false) {
            return result(-1, null, '设置失败');
        }

        return result(0, null, '设置成功！');
    }

    /**
     * 删除
     *
     * @param Request $request
     * @return array
     */
    public function delete(Request $request)
    {
        $address_id = $request->get('address_id', 0);
        if (!$address_id) {
            return result(-1, null, '参数错误！');
        }
        $ret = $this->userAddress->del($address_id);
        if ($ret === false) {
            return result(-1, null, '删除失败！');
        }
        $count = UserAddress::where('user_id', $this->user_id)->count();
        return result(0, $count, '删除成功！');
    }

}