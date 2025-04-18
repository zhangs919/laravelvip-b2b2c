<?php

namespace App\Repositories;

use App\Models\UserAddress;
use Illuminate\Support\Facades\DB;

class UserAddressRepository
{
    use BaseRepository;

    protected $model;

    protected $userReal;

    public function __construct()
    {
        $this->model = new UserAddress();
        $this->userReal = new UserRealRepository();
    }

    public function saveData($post, $user_id)
    {
        DB::beginTransaction();
        try {

            if (!empty($post['address_id'])) {
                // 更新
                $this->update($post['address_id'], $post);
                $address_id = $post['address_id'];
            } else {
                // 新增
                $ret = $this->store($post);
                $address_id = $ret->address_id;
            }

            if (isset($post['is_default']) && $post['is_default']) {
                // 将其他默认地址设置为非默认
                UserAddress::where([['user_id', $user_id], ['address_id', '!=', $address_id]])->update(['is_default'=>0]);
                (new UserAddressRepository())->setDefault($address_id, $user_id);
            }

            DB::commit();
            return $address_id;
        }catch (\Exception $e){
            DB::rollback();//事务回滚
//            echo $e->getMessage();
//            echo $e->getCode();
            return false;
        }
    }

    /**
     * 设置默认地址
     *
     * @param $address_id
     * @param $user_id
     * @return bool
     */
    public function setDefault($address_id, $user_id)
    {
        if (!$address_id) {
            return false;
        }

        DB::beginTransaction();
        try {
            // 将其他默认地址设置为非默认
            UserAddress::where([['user_id', $user_id], ['address_id', '!=', $address_id]])->update(['is_default'=>0]);
            // 将该地址设置为默认
            UserAddress::where([['user_id', $user_id], ['address_id', '=', $address_id]])->update(['is_default'=>1]);
            DB::commit();
            return true;
        }catch (\Exception $e){
            DB::rollback();//事务回滚
//            echo $e->getMessage();
//            echo $e->getCode();
            return false;
        }
    }

    /**
     * 检查用户收货地址是否超过规定数量
     *
     * @param $user_id
     * @return bool
     */
    public function checkUserAddressLimit($user_id)
    {
        $count = UserAddress::where([['user_id', $user_id]])->select('user_id')->count();
        if ($count > 20) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * 根据地址id获取用户地址详情
     *
     * @param $user_id
     * @param $address_id
     * @return array
     */
    public function getUserAddressInfo($user_id, $address_id)
    {
        $info = UserAddress::where([['user_id',$user_id],['address_id',$address_id]])->first();
        if (empty($info)) {
            return [];
        }
        return $info->toArray();
    }

    /**
     * 获取用户收货地址列表
     *
     * @param $user_id
     * @param string $scene user_center:用户中心地址列表  buy:购物结算页面地址列表
     * @return mixed
     */
    public function getUserAddressList($user_id, $scene = 'user_center', $selected_address = 0)
    {
        $list = UserAddress::where([['user_id', $user_id]])->orderBy('is_default', 'desc')->get()->toArray();
        if (!empty($list)) {
            foreach ($list as &$item) {
                $regionName = get_region_names_by_region_code($item['region_code'], ' ');
                if ($scene == 'user_center') {
                    $item['region_code_format'] = $regionName;
                    $item['region_name'] = $regionName;
                } elseif ($scene == 'buy') {
                    // 是否实名认证
                    $userReal = $this->userReal->checkUserReal($user_id);
                    if ($userReal === false) {
                        $isReal = 0;
                        $realName = null;
                        $idCode = null;
                    } else {
                        $isReal = 1;
                        $realName = $userReal->real_name;
                        $idCode = $userReal->id_code;
                    }
                    $item['is_real'] = $isReal;
                    $item['real_name'] = $realName;
                    $item['id_code'] = $idCode;
                    if (!empty($selected_address)) {
                        if ($selected_address == $item['address_id']) {
                            $selected = 1;
                        } else {
                            $selected = 0;
                        }
                    } else { // 取默认地址
                        $selected = $item['is_default'];
                    }
                    $item['selected'] = $selected;
                    $item['region_name'] = $regionName;
                    $item['mobile_format'] = hide_tel($item['mobile']);
                    $item['id_code_format'] = hide_id_card($item['id_code']);
                }
            }
        }
        return $list;
    }
}