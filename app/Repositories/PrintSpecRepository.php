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
// | Date:2018-10-22
// | Description: 打印规格
// +----------------------------------------------------------------------

namespace App\Repositories;



use App\Models\PrintSpec;
use Illuminate\Support\Facades\DB;

class PrintSpecRepository
{
    use BaseRepository;

    protected $model;


    public function __construct()
    {
        $this->model = new PrintSpec();
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
            // 将其他默认打印机设置为非默认
            PrintSpec::where([['shop_id', $shop_id], ['id', '!=', $id]])->update(['is_default' => 0]);
            // 将该打印机设置为默认
            PrintSpec::where([['shop_id', $shop_id], ['id', '=', $id]])->update(['is_default' => 1]);
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