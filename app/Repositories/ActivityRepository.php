<?php

namespace App\Repositories;


use App\Models\Activity;
use App\Models\GoodsActivity;
use Illuminate\Support\Facades\DB;

class ActivityRepository
{
    use BaseRepository;

    protected $model;


    public function __construct()
    {
        $this->model = new Activity();
    }

    /**
     * 活动(批量)删除
     *
     * @param int $shop_id 店铺id
     * @param array $act_ids 活动id
     * @return bool
     */
    public function deleteActivity($shop_id = 0, $act_ids = [])
    {
        if (empty($shop_id) && empty($act_ids)) {
            return false;
        }

        DB::beginTransaction();
        try {

            // 活动关联数据
            if (!empty($shop_id)) {
                // 删除店铺所有活动
                $act_ids = Activity::where('shop_id', $shop_id)->select(['act_id'])->pluck('act_id')->toArray();
            }

            Activity::whereIn('act_id', $act_ids)->delete(); // 活动表 activity
            GoodsActivity::whereIn('act_id', $act_ids)->delete(); // 商品活动表 goods_activity

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack(); // 事务回滚
            echo $e->getMessage();
            echo $e->getCode();
            return false;
        }
    }
}