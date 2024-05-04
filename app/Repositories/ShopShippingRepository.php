<?php

namespace App\Repositories;


use App\Models\ShopShipping;
use Illuminate\Support\Facades\DB;

class ShopShippingRepository
{
    use BaseRepository;

    protected $model;


    public function __construct()
    {
        $this->model = new ShopShipping();
    }

    /**
     * 设置默认
     * @param int $id 主键id
     * @param int $shop_id 店铺id
     * @return bool
     */
    public function setDefault($id, $shop_id)
    {
        if (!$id) {
            return false;
        }

        DB::beginTransaction();
        try {
            // 将其他默认快递设置为非默认
            ShopShipping::where([['shop_id', $shop_id], ['id', '!=', $id]])->update(['is_default' => 0]);
            // 将该快递设置为默认
            ShopShipping::where([['shop_id', $shop_id], ['id', '=', $id]])->update(['is_default' => 1]);
            DB::commit();
            return true;
        }catch (\Exception $e){
            DB::rollback();//事务回滚
//            echo $e->getMessage();
//            echo $e->getCode();
            return false;
        }
    }
}