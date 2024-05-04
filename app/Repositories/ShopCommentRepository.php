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
// | Date:2020-01-11
// | Description: 店铺评价
// +----------------------------------------------------------------------

namespace App\Repositories;


use App\Models\ShopComment;
use Illuminate\Support\Facades\DB;

class ShopCommentRepository
{
    use BaseRepository;

    protected $model;


    public function __construct()
    {
        $this->model = new ShopComment();
    }

    /**
     * 店铺动态评分 保存数据
     *
     * @param $user_info
     * @param $order_info
     * @param $post
     * @return bool
     */
    public function evalShop($user_info, $order_info, $post)
    {

        DB::beginTransaction();
        try {

            $input = [
                'shop_comment_status' => 1,
                'shop_is_show' => 1,
                'user_id' => $user_info->user_id,
                'shop_id' => $order_info->shop_id,
                'order_id' => $post['order_id'],
                'shop_service' => $post['service_desc_score'],
                'shop_speed' => $post['send_desc_score'],
                'logistics_speed' => $post['logistics_speed_score'],
                'shop_comment_add_time' => time(),
            ];

            if (sysconf('mark_audit')) {
                // 如果评价需要审核
                $input['shop_comment_status'] = 0;
                $input['shop_is_show'] = 0;
            }
            $this->store($input);


            // 新增订单日志

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();
            echo $e->getCode();
            return false;
        }
    }

    /**
     * 获取商家中心店铺动态评价数据
     *
     * @param array $condition
     * @param string $column
     * @return array
     */
    public function getSellerCommentList($condition = [], $column = '')
    {
        $data = $this->model->getList($condition, $column);

        if (!$data[0]->isEmpty()) {

            foreach ($data[0] as $key => $value) {
                // 会员等级信息
                $userRep = new UserRepository();
                $userRankInfo = $userRep->getUserRank($value->rank_point);

                $value->user_rank_icon = get_image_url($userRankInfo['rank_img']);
                $value->user_rank_name = $userRankInfo['rank_name'];

                // 平台方后台增加额外信息
                $value->shop_name = $value->shop->shop_name;
                $value->seller_user_name = $value->shop->user->user_name;
            }
        }

        $data[0] = $data[0]->toArray();

        return $data;
    }
}