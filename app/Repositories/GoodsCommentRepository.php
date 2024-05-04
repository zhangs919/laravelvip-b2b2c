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
// | Description: 商品评价
// +----------------------------------------------------------------------

namespace App\Repositories;


use App\Models\GoodsComment;
use App\Models\GoodsSku;
use App\Models\OrderGoods;
use App\Models\OrderInfo;
use App\Models\Shop;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class GoodsCommentRepository
{
    use BaseRepository;

    protected $model;


    public function __construct()
    {
        $this->model = new GoodsComment();
    }

    /**
     * 获取商家中心商品评价数据
     * url:/user/evaluate/index
     *
     * @param array $condition
     * @param string $column
     * @return array
     */
    public function getSellerCenterCommentList($condition = [], $column = '')
    {
        $data = $this->model->getList($condition, $column);

        if (!$data[0]->isEmpty()) {

            foreach ($data[0] as $key => $value) {

                // 会员等级信息
                $userRep = new UserRepository();
                $userRankInfo = $userRep->getUserRank($value->rank_point);

                $value->goods_image = get_image_url($value->goods_image);
                // 其他额外信息
                $value->ct = "0";
                $value->cs = $value->user_id; // 会员id
                $value->us = $value->user_id; // 会员id
                $value->com_s = "1";
                $value->comment_sort = [
                    $value->add_time => 'add_comment',
                    $value->comment_time => 'comment'
                ];
                $value->user_rank_icon = get_image_url($userRankInfo['rank_img']);
                $value->user_rank_name = $userRankInfo['rank_name'];
                $value->score = '好评';
                $value->score_icon = 'icon-3';

                $comment_images = [];
                $comment_images_arr = array_filter(array_unique([$value->comment_img1, $value->comment_img2, $value->comment_img3, $value->comment_img4, $value->comment_img5]));
                if (!empty($comment_images_arr)) {
                    foreach ($comment_images_arr as $image) {
                        $comment_images[] = get_image_url($image);
                    }
                }
                $value->comment_images = $comment_images;

                $add_comment_images = [];
                $add_comment_images_arr = array_filter(array_unique([$value->add_img1, $value->add_img2, $value->add_img3, $value->add_img4, $value->add_img5]));
                if (!empty($add_comment_images_arr)) {
                    foreach ($add_comment_images_arr as $image) {
                        $add_comment_images[] = get_image_url($image);
                    }
                }
                $value->add_comment_images = $add_comment_images;

                // 平台方后台增加额外信息
                $value->shop_name = $value->shop->shop_name;
                $value->seller_user_name = $value->shop->user->user_name;
            }
        }

        $data[0] = $data[0]->toArray();

        return $data;
    }



    /**
     * 获取前端商品页面评论数据
     *
     * @param array $condition
     * @param string $column
     * @return array
     */
    public function getGoodsPageCommentList($condition = [], $column = '')
    {
        $data = $this->model->getList($condition, $column);

        if (!$data[0]->isEmpty()) {

            foreach ($data[0] as $key => $value) {
                $user_info = User::where('user_id', $value->user_id)
                    ->select(['rank_point', 'headimg', 'user_name', 'nickname'])->first();
                $value->rank_point = $user_info->rank_point;
                $value->headimg = get_image_url($user_info->headimg, 'headimg');
                $value->user_name = $user_info->user_name;
                $value->nickname = $user_info->nickname;

                $sku_info = GoodsSku::where('sku_id', $value->sku_id)->select(['spec_names'])->first();
                $value->spec_info = $sku_info->spec_names; // 产地:中国 净含量:200g

                $shop_info = Shop::where('shop_id', $value->shop_id)
                    ->select(['shop_name', 'shop_image', 'shop_logo'])->first();
                $value->shop_name = $shop_info->shop_name;
                $value->shop_image = $shop_info->shop_image;
                $value->shop_logo = $shop_info->shop_logo;

                // 会员等级信息
                $userRep = new UserRepository();
                $userRankInfo = $userRep->getUserRank($user_info->rank_point);
                $value->rank_name = $userRankInfo['rank_name'];
                $value->rank_img = $userRankInfo['rank_img'];

                $value->comment_sort = [
                    $value->user_reply_time = 'user_reply',
                    $value->add_time => 'add_comment',
                    $value->comment_time => 'comment'
                ];

                $comment_images = array_unique([$value->comment_img1, $value->comment_img2, $value->comment_img3, $value->comment_img4, $value->comment_img5]);
                $value->comment_images = $comment_images;
                $add_images = array_unique([$value->add_img1, $value->add_img2, $value->add_img3, $value->add_img4, $value->add_img5]);
                $value->add_images = $add_images;

                $user_name_encrypt = $value->is_anonymous ? substr_cut($value->user_name) : $value->user_name;
                $nickname_encrypt = $value->is_anonymous ? substr_cut($value->nickname) : $value->nickname;
                $value->user_name_encrypt = $user_name_encrypt;
                $value->nickname_encrypt = $nickname_encrypt;
            }
        }

        $data[0] = $data[0]->toArray();

        return $data;
    }

    /**
     * 获取前端会员中心商品评价数据
     * url:/user/evaluate/index
     *
     * @param array $condition
     * @param string $column
     * @return array
     */
    public function getUserCenterCommentList($condition = [], $column = '')
    {
        $data = $this->model->getList($condition, $column);

        if (!$data[0]->isEmpty()) {

            foreach ($data[0] as $key => $value) {

                $orderInfo = $value->orderInfo;
                $orderGoods = $value->orderGoods;
                $user_info = $value->user;
                $shop_info = $value->shop;

                $value->goods_name = $orderGoods->goods_name;
                $value->goods_image = get_image_url($orderGoods->goods_image);
                $value->spec_info = $orderGoods->spec_info;
                $value->order_add_time = $orderInfo->add_time;
                $value->confirm_time = $orderInfo->confirm_time;
                $value->order_status = $orderInfo->order_status;
                $value->user_comment_status = $orderInfo->evaluate_status; // 会员评价状态
                $value->shop_name = $shop_info->shop_name;
                $value->shop_image = $shop_info->shop_image;
                $value->shop_type = $shop_info->shop_type;
                $value->user_name = $user_info->user_name;
                $value->headimg = $user_info->headimg;

                // 会员等级信息
                $userRep = new UserRepository();
                $userRankInfo = $userRep->getUserRank($user_info->rank_point);
                $value->rank_name = $userRankInfo['rank_name'];
                $value->rank_img = $userRankInfo['rank_img'];
                $value->score_icon = 'icon-3';
                $value->score_desc = '好评';

                $comment_images = [];
                $comment_images_arr = array_filter(array_unique([$value->comment_img1, $value->comment_img2, $value->comment_img3, $value->comment_img4, $value->comment_img5]));
                if (!empty($comment_images_arr)) {
                    foreach ($comment_images_arr as $image) {
                        $comment_images[] = get_image_url($image);
                    }
                }
                $value->comment_images = $comment_images;

                $add_comment_images = [];
                $add_comment_images_arr = array_filter(array_unique([$value->add_img1, $value->add_img2, $value->add_img3, $value->add_img4, $value->add_img5]));
                if (!empty($add_comment_images_arr)) {
                    foreach ($add_comment_images_arr as $image) {
                        $add_comment_images[] = get_image_url($image);
                    }
                }
                $value->add_comment_images = $add_comment_images;

                unset($value->orderInfo,$value->orderGoods,$value->user,$value->shop);
            }
        }

        $data[0] = $data[0]->toArray();

        return $data;
    }

    /**
     * 获取前端会员中心 评价晒单页面数据
     * url:/user/evaluate/info
     * 
     * @param $orderInfo
     * @param $user_id
     * @return array|bool
     */
    public function getUserCenterCommentInfo($orderInfo, $user_id)
    {

        if (empty($orderInfo)) {
            return false;
        }

        $order_id = $orderInfo->order_id;

        $commentList = [];
        // 判断评价状态
        if ($orderInfo->evaluate_status == 2) {
            // 已过期未评价
            return false;
        } elseif ($orderInfo->evaluate_status == 1) {
            // 已评价
            $where[] = ['order_id', $order_id];
            $where[] = ['user_id', $user_id];
            $condition = [
                'with' => ['orderInfo','orderGoods'],
                'where' => $where,
                'sortname' => 'comment_id',
                'sortorder' => 'desc',
                'limit' => 0
            ];
            list($data, $total) = $this->model->getList($condition);


            if (!$data->isEmpty()) {

                foreach ($data as $key => $value) {

                    $orderInfo = $value->orderInfo;
                    $orderGoods = $value->orderGoods;

                    $value->back_id = null; // 退款退货或换货维修id
                    $value->back_number = null; // 退款退货或换货维修数量
                    $value->goods_number = $orderGoods->goods_number;
                    $value->goods_name = $orderGoods->goods_name;
                    $value->goods_image = get_image_url($orderGoods->goods_image);
                    $value->spec_info = $orderGoods->spec_info;
                    $value->order_add_time = $orderInfo->add_time;
                    $value->confirm_time = $orderInfo->confirm_time;
                    $value->order_status = $orderInfo->order_status;
                    $value->user_comment_status = $orderInfo->evaluate_status; // 会员评价状态

                    $comment_images = [];
                    $comment_images_arr = array_filter(array_unique([$value->comment_img1, $value->comment_img2, $value->comment_img3, $value->comment_img4, $value->comment_img5]));
                    if (!empty($comment_images_arr)) {
                        foreach ($comment_images_arr as $image) {
                            $comment_images[] = get_image_url($image);
                        }
                    }
                    $value->comment_images = $comment_images;

                    $add_comment_images = [];
                    $add_comment_images_arr = array_filter(array_unique([$value->add_img1, $value->add_img2, $value->add_img3, $value->add_img4, $value->add_img5]));
                    if (!empty($add_comment_images_arr)) {
                        foreach ($add_comment_images_arr as $image) {
                            $add_comment_images[] = get_image_url($image);
                        }
                    }
                    $value->add_comment_images = $add_comment_images;

                    unset($value->orderInfo, $value->orderGoods);
                }
            }

            $commentList = $data->toArray();
        } else {
            // 未评价
            foreach ($orderInfo->orderGoods as $item) {
                $commentList[] = [
                    'comment_id' => null,
                    'record_id' => $item->record_id,
                    'user_id' => null,
                    'user_nick' => null,
                    'user_rank_id' => null,
                    'site_id' => null,
                    'shop_id' => $orderInfo->shop_id,
                    'order_id' => $order_id,
                    'goods_id' => $item->goods_id,
                    'sku_id' => $item->sku_id,
                    'desc_mark' => null,
                    'comment_desc' => null,
                    'comment_img1' => null,
                    'comment_img2' => null,
                    'comment_img3' => null,
                    'comment_img4' => null,
                    'comment_img5' => null,
                    'is_anonymous' => null,
                    'comment_time' => null,
                    'comment_status' => null,
                    'is_show' => null,
                    'add_comment_desc' => null,
                    'add_img1' => null,
                    'add_img2' => null,
                    'add_img3' => null,
                    'add_img4' => null,
                    'add_img5' => null,
                    'add_is_anonymous' => null,
                    'add_time' => null,
                    'add_status' => null,
                    'add_is_show' => null,
                    'seller_reply_desc' => null,
                    'seller_reply_time' => null,
                    'user_reply_desc' => null,
                    'user_reply_time' => null,
                    'is_delete' => null,
                    'evaluate_status' => 0,

                    'back_id' => null,
                    'back_number' => null,
                    'goods_number' => $item->goods_number,
                    'goods_name' => $item->goods_name,
                    'goods_image' => get_image_url($item->goods_image),
                    'spec_info' => $item->spec_info,
                    'order_add_time' => $orderInfo->order_add_time,
                    'confirm_time' => $orderInfo->confirm_time,
                    'order_status' => $orderInfo->order_status,
                    'user_comment_status' => $orderInfo->evaluate_status, // // 会员评价状态
                ];
            }
        }
        return $commentList;
    }

    /**
     * 评价商品保存数据
     *
     * @param $user_info
     * @param $user_rank
     * @param $order_info
     * @param $post
     * @return bool
     */
    public function evalGoods($user_info,$user_rank, $order_info, $post)
    {

        DB::beginTransaction();
        try {

            $orderGoodsInfo = OrderGoods::where('record_id', $post['record_id'])->first();
            $comment_images = explode(',', $post['images']);

            $goodsComment = GoodsComment::where([['order_id',$order_info->order_id],['record_id',$post['record_id']]])->first();

            if (!empty($goodsComment)) {
                // 追加评价
                // 1.更新商品评价信息
                $update = [
                    'add_comment_desc' => $post['content'],
                    'add_img1' => $comment_images[0] ?? null,
                    'add_img2' => $comment_images[1] ?? null,
                    'add_img3' => $comment_images[2] ?? null,
                    'add_img4' => $comment_images[3] ?? null,
                    'add_img5' => $comment_images[4] ?? null,
                    'add_is_anonymous' => $goodsComment->is_anonymous,
                    'add_time' => time(),

                    'add_status' => 1, // 审核通过
                    'add_is_show' => 1, // 显示评价
                    'evaluate_status' => 2, // 追加评价完成
                ];
                if (sysconf('mark_audit')) {
                    // 如果评价需要审核
                    $input['add_status'] = 0;
                    $input['add_is_show'] = 0;
                    $input['evaluate_status'] = 1;
                }
                $this->update($goodsComment->comment_id, $update);
            } else {
                // 初次评价


                // 1.新增商品评价信息
                $input = [
                    'record_id' => $post['record_id'],
                    'user_id' => $user_info->user_id,
                    'user_nick'=> !$post['is_anonymous'] ? $user_info->nickname : null,
                    'user_rank_id'=>$user_rank['rank_id'],
                    'site_id'=>$order_info->site_id,
                    'shop_id'=>$order_info->shop_id,
                    'order_id'=>$order_info->order_id,
                    'goods_id'=>$orderGoodsInfo->goods_id,
                    'sku_id'=>$orderGoodsInfo->sku_id,

                    'desc_mark' => $post['score'],
                    'comment_desc' => $post['content'],
                    'comment_img1' => $comment_images[0] ?? null,
                    'comment_img2' => $comment_images[1] ?? null,
                    'comment_img3' => $comment_images[2] ?? null,
                    'comment_img4' => $comment_images[3] ?? null,
                    'comment_img5' => $comment_images[4] ?? null,
                    'is_anonymous' => $post['is_anonymous'],
                    'comment_time' => time(),

                    'comment_status' => 1, // 审核通过
                    'is_show' => 1, // 显示评价
                    'evaluate_status' => 1, // 初次评价完成
                ];
                if (sysconf('mark_audit')) {
                    // 如果评价需要审核
                    $input['comment_status'] = 0;
                    $input['is_show'] = 0;
                    $input['evaluate_status'] = 0;

                    $orderUpdate = [
                        'evaluate_status' => 1,
                        'evaluate_time' => time(),
                        'last_time' => time(),
                    ];
                    // 2.更新订单评价状态
                    OrderInfo::where('order_id', $order_info->order_id)->update($orderUpdate);
                }
                $this->store($input);
            }


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
     * 卖家回复
     *
     * @param $comment_id
     * @param $content
     * @return bool
     */
    public function sellerReply($comment_id, $content)
    {
        $update = [
            'seller_reply_desc' => $content,
            'seller_reply_time' => time()
        ];
        $ret = GoodsComment::where('comment_id', $comment_id)->update($update);
        return $ret;
    }

    /**
     * 买家回复
     *
     * @param $comment_id
     * @param $content
     * @return bool
     */
    public function userReply($comment_id, $content)
    {
        $update = [
            'user_reply_desc' => $content,
            'user_reply_time' => time()
        ];
        $ret = GoodsComment::where('comment_id', $comment_id)->update($update);
        return $ret;
    }
}