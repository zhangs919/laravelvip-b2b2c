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
// | Date:2018-10-30
// | Description: 店铺付款信息表
// +----------------------------------------------------------------------

namespace App\Repositories;


use App\Models\Shop;
use App\Models\ShopPayment;
use Illuminate\Support\Facades\DB;

class ShopPaymentRepository
{
    use BaseRepository;

    protected $model;


    public function __construct()
    {
        $this->model = new ShopPayment();
    }

    /**
     * 添加/编辑店铺付款信息
     *
     * @param array $post 请求数据对象
     * @param bool $isUpdate 是否更新数据 默认false
     * @return bool
     */
    public function addShopPayment($post, $isUpdate = false)
    {
        DB::beginTransaction();
        try {
            // 判断付款状态
            if (isset($post['pay_status']) && $post['pay_status'] == 1) {
                // 已付款 更新店铺到期信息
                $shopUpdate = [
                    'end_time' => strtotime($post['end_time']),
                    'duration' => $post['duration'],
                    'system_fee' => $post['system_fee'],
                    'insure_fee' => $post['insure_fee'],
                    'shop_status' => 1, // 店铺状态 开启
                ];
                if (ShopPayment::where([['shop_id',$post['shop_id']],['pay_status',1]])->count() <= 0) {
                    $shopUpdate['open_time'] = strtotime($post['begin_time']);
                }
                Shop::where('shop_id', $post['shop_id'])->update($shopUpdate);
            }
            // 插入/更新店铺付款信息表
            if ($isUpdate) {
                // 编辑
                $ret = $this->update($post['pay_id'], $post);
            }else {
                // 添加
                $ret = $this->store($post);
            }

            DB::commit();
            return arr_result(0,['pay_id'=>$ret->pay_id]);
        } catch (\Exception $e) {
            DB::rollback();//事务回滚
            echo $e->getMessage();
            echo $e->getCode();
            return false;
        }
    }

    /**
     * 判断店铺是否存在未付款信息
     *
     * @param int $shop_id 店铺id
     * @return bool 不存在true|存在false
     */
    public function isExistUnpaid($shop_id)
    {
        $ret = $this->model->select(['shop_id', 'pay_status'])->where([['shop_id', $shop_id], ['pay_status', 0]])->count();
        if ($ret > 0) {
            return true;
        }
        return false;
    }

}