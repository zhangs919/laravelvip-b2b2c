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
// | Date:2018-10-24
// | Description: 运费模板
// +----------------------------------------------------------------------

namespace App\Repositories;

use App\Models\Freight;
use App\Models\FreightFreeRecord;
use App\Models\FreightRecord;
use Illuminate\Support\Facades\DB;

class FreightRepository
{
    use BaseRepository;

    protected $model;


    public function __construct()
    {
        $this->model = new Freight();
    }

    /**
     * 新增运费模板
     *
     * @param array $postData 表单提交数据对象
     * @param int $shopId 店铺id
     * @return bool
     */
    public function addFreight($postData, $shopId = 0)
    {
        DB::beginTransaction();
        try {
            // 1. 插入 freight 表数据
            $freight_insert = $postData['freight'];
            $freight_insert['shop_id'] = $shopId;
            $freight_insert['add_time'] = time();
            $freight_insert['last_time'] = time();
            $freightRet = $this->store($freight_insert);

            // 2. 插入 freight_record 表数据
            if (!empty($postData['records'])) {
                foreach ($postData['records'] as $item) {
                    $item['freight_id'] = $freightRet->freight_id;
                    $item['add_time'] = time();
                    $item['last_time'] = time();
                    $freightRecord  = new FreightRecord();
                    $freightRecord->fill($item);
                    $freightRecord->save();
                }
            }

            // 3. 插入 freight_free_record 表数据
            if (!empty($postData['free_records'])) {
                foreach ($postData['free_records'] as $item) {
                    $item['freight_id'] = $freightRet->freight_id;
                    $item['add_time'] = time();
                    $item['last_time'] = time();
                    $freightFreeRecord  = new FreightFreeRecord();
                    $freightFreeRecord->fill($item);
                    $freightFreeRecord->save();
                }
            }

            DB::commit();
            return $freightRet->freight_id;
        } catch (\Exception $e) {
            DB::rollback();//事务回滚
            echo $e->getMessage();
            echo $e->getCode();
            return false;
        }
    }

    /**
     * 更新运费模板
     *
     * @param array $postData 表单提交数据对象
     * @return bool
     */
    public function modifyFreight($postData)
    {
        DB::beginTransaction();
        try {
            $freight_id = $postData['freight']['freight_id'];
            // 1. 更新 freight 表数据
            $freight_update = $postData['freight'];
            $freight_update['last_time'] = time();
            $freightRet = $this->update($freight_id, $freight_update);

            // 2. 插入或更新 freight_record 表数据
            if (!empty($postData['records'])) {
                $exist_record_ids = array_column($postData['records'], 'record_id');
                // a. 先删除除了post过来的freight_id数据
                FreightRecord::where([['freight_id', $freight_id]])->whereNotIn('record_id', $exist_record_ids)->delete();
                // 插入或更新数据
                foreach ($postData['records'] as $item) {
                    if (empty($item['record_id'])) { // 新增
                        $item['freight_id'] = $freightRet->freight_id;
                        $item['add_time'] = time();
                        $item['last_time'] = time();
                        $freightRecord  = new FreightRecord();
                        $freightRecord->fill($item);
                        $freightRecord->save();
                    } else { // 更新
                        $item['last_time'] = time();
                        FreightRecord::where([['freight_id', $freight_id], ['record_id', $item['record_id']]])->update($item);
                    }
                }
            }

            // 3. 插入或更新 freight_free_record 表数据
            if (!empty($postData['free_records'])) {
                $exist_record_ids = array_column($postData['free_records'], 'record_id');
                // a. 先删除除了post过来的freight_id数据
                FreightFreeRecord::where([['freight_id', $freight_id]])->whereNotIn('record_id', $exist_record_ids)->delete();
                // 插入或更新数据
                foreach ($postData['free_records'] as $item) {
                    if (empty($item['record_id'])) { // 新增
                        $item['freight_id'] = $freightRet->freight_id;
                        $item['add_time'] = time();
                        $item['last_time'] = time();
                        $freightRecord  = new FreightFreeRecord();
                        $freightRecord->fill($item);
                        $freightRecord->save();
                    } else { // 更新
                        $item['last_time'] = time();
                        FreightFreeRecord::where([['freight_id', $freight_id], ['record_id', $item['record_id']]])->update($item);
                    }
                }
            }

            DB::commit();
            return $freightRet->freight_id;
        } catch (\Exception $e) {
            DB::rollback();//事务回滚
            echo $e->getMessage();
            echo $e->getCode();
            return false;
        }
    }

}