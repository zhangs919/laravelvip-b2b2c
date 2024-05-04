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
// | Date:2018-11-10
// | Description: 积分兑换商品
// +----------------------------------------------------------------------

namespace App\Repositories;


use App\Models\IntegralGoods;
use App\Models\Shop;

class IntegralGoodsRepository
{
    use BaseRepository;

    protected $model;

    protected $collect;

    public function __construct()
    {
        $this->model = new IntegralGoods();
        $this->collect = new CollectRepository();
    }

    public function getGoodsList($condition = [])
    {
        list($list, $total) = $this->getList($condition);
        $list = $list->toArray();
        if (!empty($list)) {
            foreach ($list as $key => $item) {
                $list[$key]['diff'] = '-1';
                $list[$key]['shop_name'] = Shop::where('shop_id', $item['shop_id'])->select(['shop_name'])->value('shop_name');
            }
        }

        return [$list, $total];
    }

    public function getHotGoodsList($condition = [])
    {
        list($list, $total) = $this->getList($condition);
        $list = $list->toArray();

        return [$list, $total];
    }

    /**
     * 前端获取商品详情
     *
     * @param $goods_id
     * @param int $user_id
     * @return mixed
     */
    public function getGoodsInfo($goods_id, $user_id = 0)
    {
        $goods_info = $this->getById($goods_id);
        if (empty($goods_info)) {
            abort(404, '积分商品不存在');
        }
        $res_images = [];
        $goods_info = $goods_info->toArray();

        if (!empty($goods_info['goods_images'])) {
            $goods_images = explode('|', $goods_info['goods_images']);
            foreach ($goods_images as $v) {
                $res_images[] = [
                    get_image_url($v) . '?x-oss-process=image\/resize,m_pad,limit_0,h_320,w_320',
                    get_image_url($v) . '?x-oss-process=image\/resize,m_pad,limit_0,h_450,w_450',
                    get_image_url($v)
                ];
            }
        }
        $goods_info['goods_images'] = $res_images;

        $goods_info['goods_price_format'] = '￥' . $goods_info['goods_price'];
        $goods_info['shop_collect'] = false;
        if ($user_id && $this->collect->checkIsCollected($user_id, 1, $goods_info['shop_id'])) {
            // 已收藏
            $goods_info['shop_collect'] = true;
        }

        return $goods_info;
    }


}