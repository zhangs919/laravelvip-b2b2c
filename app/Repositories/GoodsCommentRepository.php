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
// | Date:2019-04-14
// | Description: 商品评价
// +----------------------------------------------------------------------

namespace App\Repositories;

use App\Models\Goods;
use App\Models\GoodsComment;
use App\Models\GoodsSku;
use App\Models\Shop;
use App\Models\User;

class GoodsCommentRepository
{
    use BaseRepository;

    protected $model;


    public function __construct()
    {
        $this->model = new GoodsComment();
    }

    public function getList($condition = [], $column = '')
    {
        $data = $this->model->getList($condition, $column);

        if (!$data[0]->isEmpty()) {

            foreach ($data[0] as $key=>$value) {
                $user_info = User::where('user_id', $value->user_id)
                    ->select(['rank_point', 'headimg','user_name','nickname'])->first();
                $value->rank_point = $user_info->rank_point;
                $value->headimg = get_image_url($user_info->headimg, 'headimg');
                $value->user_name = $user_info->user_name;
                $value->nickname = $user_info->nickname;

                $sku_info = GoodsSku::where('sku_id',$value->sku_id)->select(['spec_names'])->first();
                $value->spec_info = $sku_info->spec_names; // 产地:中国 净含量:200g

                $shop_info = Shop::where('shop_id', $value->shop_id)
                    ->select(['shop_name','shop_image','shop_logo'])->first();
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

                $comment_images = array_unique([$value->comment_img1, $value->comment_img2, $value->comment_img3,$value->comment_img4,$value->comment_img5]);
                $value->comment_images = $comment_images;
                $add_images = array_unique([$value->add_img1, $value->add_img2, $value->add_img3,$value->add_img4,$value->add_img5]);
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


}