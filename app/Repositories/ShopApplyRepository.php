<?php

namespace App\Repositories;

use App\Models\Shop;
use App\Models\ShopApply;
use App\Models\ShopBindClass;
use Illuminate\Support\Facades\DB;

class ShopApplyRepository
{
    use BaseRepository;

    protected $model;

    protected $shop;

    public function __construct()
    {
        $this->model = new ShopApply();
        $this->shop = new ShopRepository();
    }


    public function addData($shopApplyModel)
    {
        DB::beginTransaction();
        try {
            $this->store($shopApplyModel);

            // 添加店铺所属分类表
            $cat_ids_arr = explode(',', $shopApplyModel['cat_ids']);
            if (!empty($cat_ids_arr)) {
                foreach ($cat_ids_arr as $item) {
                    $shopBindClassInsert = [
                        'shop_id' => $shopApplyModel['shop_id'],
                        'cls_id' => $item
                    ];
                    $shopBindClass = new ShopBindClass();
                    $shopBindClass->fill($shopBindClassInsert);
                    $shopBindClass->save();
                }
            }

            // 更新店铺名称
            $update = [
                'shop_name'=>$shopApplyModel['shop_name'],
                'system_fee' => $shopApplyModel['system_fee'],
                'insure_fee' => $shopApplyModel['insure_fee'],
            ];
            Shop::where('shop_id', $shopApplyModel['shop_id'])->update($update);

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            return false;
        }
    }

    /**
     * 撤销开店申请
     * @return bool
     */
    public function cancelShopApply()
    {
        $user_id = auth('user')->id();
        DB::beginTransaction();
        try {
            if (!$user_id) {
                throw new \Exception('对不起，无操作权限！');
            }

            $shop = DB::table('shop')->where('user_id', $user_id)->first();
            if (empty($shop)) {
                throw new \Exception('无开店申请！');
            }

            // 删除开店申请信息
            DB::table('shop_apply')->where('user_id', $user_id)->delete();
            // 删除店铺认证信息
            DB::table('shop_field_value')->where('shop_id', $shop->shop_id)->delete();

            // 删除店铺信息
            $this->shop->shopDelete($shop->shop_id);

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            return false;
        }
    }

    /**
     * 审核开店申请
     *
     * @param int $shop_id 店铺id
     * @param int $audit_status 店铺审核状态
     * @param string|null $fail_info 店铺审核不通过备注
     * @return bool
     */
    public function audit(int $shop_id, int $audit_status, string $fail_info = null)
    {
        DB::beginTransaction();
        try {
            // 审核通过 执行操作 修改审核状态
            DB::table('shop_apply')->where('shop_id', $shop_id)->update(['audit_status' => $audit_status, 'fail_info' => $fail_info]);
            DB::table('shop')->where('shop_id', $shop_id)->update(['shop_audit' => $audit_status, 'fail_info' => $fail_info]);

            // todo 给会员发送审核通过/拒绝通过提醒消息

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            return false;
        }
    }

    /**
     * 批量审核通过开店申请
     *
     * @param array $shop_ids 店铺id数组
     * @return bool
     */
    public function batchPass(array $shop_ids)
    {
        DB::beginTransaction();
        try {
            // 审核通过 执行操作 修改审核状态
            DB::table('shop_apply')->whereIn('shop_id', $shop_ids)->update(['audit_status' => 1]);
            DB::table('shop')->whereIn('shop_id', $shop_ids)->update(['shop_audit' => 1]);

            // todo 给会员发送审核通过/拒绝通过提醒消息

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            return false;
        }
    }
}