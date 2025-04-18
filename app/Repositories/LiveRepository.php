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
// | Date:2020-09-28
// | Description: 直播
// +----------------------------------------------------------------------

namespace App\Repositories;


use App\Models\Live;
use App\Services\AlibabaCloudLiveService;
use Illuminate\Support\Facades\DB;

class LiveRepository
{
    use BaseRepository;

    protected $model;

    protected $activity;

    protected $aliLiveService;


    public function __construct()
    {
        $this->model = new Live();
        $this->activity = new ActivityRepository();
        $this->aliLiveService = new AlibabaCloudLiveService();
    }

    public function getList($condition = [], $column = '', $user_id = 0)
    {
        $data = $this->model->getList($condition, $column);

        if (!$data[0]->isEmpty()) {

            foreach ($data[0] as $key => $value) {
                $value->cat_name = $value->liveCategory->cat_name ?: '';

                // 店铺信息
                $shopInfo = $value->shop;
                $value->shop_name = @$shopInfo->shop_name;
                $value->shop_image = @$shopInfo->shop_image;
                $value->shop_logo = @$shopInfo->shop_logo;

                // 店铺卖家信息
                $sellerInfo = @$shopInfo->user;
                $value->user_name = @$sellerInfo->user_name;
                $value->nickname = @$sellerInfo->nickname;
                $value->headimg = @$sellerInfo->headimg;

                // 商品信息
                $value->goods_info = [];

//                dd($value);
                // 所在地信息
                $region = $value->region;
                $value->region = $region;

                // 是否关注 todo
                $value->is_collect = false;
            }
        }
        $data[0] = $data[0]->toArray();
        return $data;
    }

    /**
     * 创建直播
     *
     * @param $postModel
     * @param $activityData
     * @param $goodsActivityData
     * @return User|false
     */
    public function addData($postModel, $activityData, $goodsActivityData)
    {
        DB::beginTransaction();
        try {
            $actRet = $this->activity->addActivity($activityData, $goodsActivityData);

            $postModel['act_id'] = $actRet->act_id;
            $ret = $this->store($postModel);


            DB::commit();
            return $ret;
        } catch (\Exception $e) {
            DB::rollBack();
//            echo $e->getMessage();
            return false;
        }
    }

    /**
     * 更新直播
     *
     * @param $postModel
     * @param $activityData
     * @param $goodsActivityData
     * @return User|false
     */
    public function modifyData($postModel, $activityData, $goodsActivityData)
    {
        DB::beginTransaction();
        try {
            $ret = $this->update($postModel['id'], $postModel);
            $this->activity->modifyActivity($activityData, $goodsActivityData);

            DB::commit();
            return $ret;
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();
            return false;
        }
    }

    /**
     * 设置直播状态 开始直播/关闭直播
     *
     * @param int $id 直播id
     * @return mixed
     * @throws \Exception
     */
    public function changeLiveStatus(int $id)
    {
        $isValid = $this->checkState($id, 'status', 'id'); // 查询当前状态
        if ($isValid) {
            // 当前状态是1，则设置为关闭状态 2
            $update = [
                'status' => 2,
                'end_time' => time(),
            ];
            return $this->model->where('id', $id)->update($update);
        } else {
            // 当前状态是0，则设置为开始直播 1
            $update = [
                'status' => 1,
                'start_time' => time(),
                'push_stream' => $this->aliLiveService->createStreamUrl($id, 0)
            ];
            return $this->model->where('id', $id)->update($update);
        }
    }

}