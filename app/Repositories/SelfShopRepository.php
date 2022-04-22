<?php

namespace App\Repositories;

use App\Models\SelfShop;
use App\Models\ShopFieldValue;
use Illuminate\Support\Facades\DB;

class SelfShopRepository
{
    use BaseRepository;

    protected $model;


    public function __construct()
    {
        $this->model = new SelfShop();
    }

    public function addShop($shopInsert, $shopFieldValueInsert = [])
    {

        DB::beginTransaction();
        try {
            // 检查店铺是否存在
            $shop_result = DB::table('self_shop')->where('user_id',$shopInsert['user_id'])->first();

            if (empty($shop_result)) {
                // 插入店铺表（shop)
                $shop_result = $this->store($shopInsert);
                if (!$shop_result) {
                    return false;
                }

                // 更新会员is_seller为1
                DB::table('user')->where('user_id', $shopInsert['user_id'])->update(['is_seller'=>1]);

            }

            // 检查店铺认证信息是否存在
            $shop_auth_info = DB::table('shop_field_value')->where('shop_id', $shop_result->shop_id)->first();
            if (empty($shop_auth_info)) {
                // 插入店铺认证信息表（shop_field_value）
                $shopFieldValueModel = new ShopFieldValue();
                $shopFieldValueInsertData = $shopFieldValueInsert['ShopFieldValueModel'];
                // 上传企业营业执照和法人代表证件照片
                foreach ($shopFieldValueInsert as $key=>$item) {
                    if (str_contains($key, 'check-') && !empty($item)) {
                        $filename = request()->post($key, 'name');
                        $field = str_replace('check-', '', $key);
                        $file = request()->file()['ShopFieldValueModel'][$field];
                        $storePath = 'shop/'.$shop_result->shop_id.'/field'; //

                    $tools = new ToolsRepository();
                    $uploadRes = $tools->upfile($file, request(), $storePath);
                    if (isset($uploadRes['error'])) {
                        return false;
                    }
                    $shopFieldValueInsertData[$field] = $uploadRes['path'];
                    }
                }

                $shopFieldValueInsertData['shop_id'] = $shop_result->shop_id;

                $shopFieldValueModel->fill($shopFieldValueInsertData);
                $shopFieldValueModel->save();
            }

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();//事务回滚
            echo $e->getMessage();
            echo $e->getCode();
            return false;
        }
    }
}