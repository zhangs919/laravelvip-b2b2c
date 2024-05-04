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
// | Date:2018-12-15
// | Description:
// +----------------------------------------------------------------------

namespace App\Repositories;



use App\Models\Compare;
use Illuminate\Support\Facades\DB;

class CompareRepository
{
    use BaseRepository;

    protected $model;



    public function __construct()
    {
        $this->model = new Compare();
    }

    public function checkIsCompared($userId, $goodsId)
    {
        $where[] = ['user_id', $userId];
        $where[] = ['goods_id', $goodsId];
        $res = $this->model->where($where)->count();
        if ($res > 0) {
            // 已加入对比
            return true;
        } else {
            // 未加入对比
            return false;
        }
    }

    /**
     * 加入对比/移除对比
     *
     * @param $userId
     * @param int $goodsId
     * @return false|int
     */
    public function toggle($userId, $goodsId = 0)
    {
        DB::beginTransaction();
        try {
            if ($this->checkIsCompared($userId, $goodsId)) {
                // 移除对比
                $this->remove($userId, $goodsId);
                $result = 0;
            } else {
                // 加入对比
                $insert['user_id'] = $userId;
                $insert['goods_id'] = $goodsId;
                $this->store($insert);
                $result = 1;
            }
            // 返回

            DB::commit();
            return $result;
        }catch (\Exception $e){
            DB::rollback();//事务回滚
//            echo $e->getMessage();
//            echo $e->getCode();
            return false;
        }
    }

    /**
     * 移除对比
     *
     * @param $userId
     * @param $goodsId
     * @return mixed
     */
    public function remove($userId, $goodsId)
    {
        $where[] = ['user_id', $userId];
        $where[] = ['goods_id', $goodsId];
        return $this->model->where($where)->delete();
    }

    /**
     * 清空对比
     *
     * @param $userId
     * @return mixed
     */
    public function clear($userId)
    {
        $where[] = ['user_id', $userId];
        return $this->model->where($where)->delete();
    }
}