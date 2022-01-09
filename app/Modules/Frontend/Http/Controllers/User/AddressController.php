<?php

namespace App\Modules\Frontend\Http\Controllers\User;

use App\Models\Region;
use App\Modules\Base\Http\Controllers\UserCenter;
use App\Repositories\UserAddressRepository;
use Illuminate\Http\Request;

class AddressController extends UserCenter
{

    protected $userAddress;


    public function __construct()
    {
        parent::__construct();

        $this->userAddress = new UserAddressRepository();


    }

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

        if (!empty($address_list)) {
            foreach ($address_list as $v) {
                // 上级地区名称
//                $region_name = array_reverse(get_parent_region_list($v->region_code));
//                $region_name = array_column($region_name, 'region_name');
//                $v->region_name = implode(' ', $region_name);
                $v->region_name = get_region_names_by_region_code($v->region_code, ' ');
            }
        }
        $compact = compact('seo_title', 'address_list', 'address_total');
        return view('user.address.index', $compact);
    }

    public function add(Request $request)
    {
        $data = view('user.address.add', compact(''))->render();

        return result(0, $data);
    }

    public function edit(Request $request)
    {
        $address_id = $request->get('address_id');
        if (!$address_id) {
            return result(-1, null, '参数错误');
        }
        $address_info = $this->userAddress->getById($address_id);
        // 地区code去掉逗号
        $region_info = Region::where('region_code', $address_info->region_code)->first();
        $address_info->parent_code_str = str_replace(',', '', $region_info->parent_code);
        $data = view('user.address.edit', compact('address_info'))->render();

        return result(0, $data);
    }

    public function saveData(Request $request)
    {
        $post = $request->post('UserAddressModel');
        $address_id = $request->post('address_id', 0);

        if (!empty($address_id)) {
            // 编辑
            $ret = $this->userAddress->update($address_id, $post);
            $msg = '地址编辑';
        }else {
            // 添加
            // 判断用户收货地址是否超过20个
            if (!$this->userAddress->checkUserAddressLimit(auth('user')->id())) {
                return result(-1, null, '最多只能保存20条地址');
            }
            $post['user_id'] = auth('user')->id();
            $ret = $this->userAddress->store($post);
            $msg = '地址添加';
        }

        if ($ret === false) {
            // fail
            return result(-1, null, $msg.'失败');
        }
        // success
        return result(0, null, $msg.'成功');
    }

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

    public function delete(Request $request)
    {
        $address_id = $request->get('address_id');
        if (!$address_id) {
            return  result(-1, null, '参数错误');
        }

        $ret = $this->userAddress->del($address_id);
        if ($ret === false) {
            return result(-1, null, '删除失败');
        }

        return result(0, null, '删除成功！');
    }
}