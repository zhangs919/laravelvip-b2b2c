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
// | Date:2018-12-18
// | Description: 商品/店铺/品牌收藏
// +----------------------------------------------------------------------

namespace App\Repositories;


use App\Models\Collect;
use App\Models\Goods;
use App\Models\GoodsSku;
use App\Models\Shop;
use Illuminate\Support\Facades\DB;

class CollectRepository
{
    use BaseRepository;

    protected $model;


    public function __construct()
    {
        $this->model = new Collect();
    }

    /**
     * 获取会员收藏列表
     *
     * @param int $userId 会员id
     * @param int $collectType 收藏类型 0商品 1店铺
     * @param int $curPage
     * @param int $pageSize
     * @return array
     */
    public function getUserCollect($userId, $collectType = 0, $curPage = 1, $pageSize = 10)
    {
        $where = [];
        $where[] = ['c.user_id',$userId];
        $where[] = ['c.collect_type',$collectType]; // 收藏类型

        $query = DB::table('collect as c')->where($where)
            ->leftJoin('goods_sku as gs', 'gs.sku_id','=', 'c.sku_id');

        if ($collectType == 0) {
            // 商品收藏
            $query->leftJoin('goods as g', 'g.goods_id','=','c.goods_id');
        }

        // 店铺收藏
        $query->leftJoin('shop as s', 's.shop_id','=','c.shop_id');

        $total = $query->count();
        $list = $query
            ->forPage($curPage, $pageSize)
            ->orderBy('c.add_time','DESC')
            ->get();

        $res_list = [];
        if (!$list->isEmpty()) {
            foreach ($list as $v) {
                $v->collect_price = $v->goods_price; // todo
                $v->credit_name = '';
                $v->credit_img = '';
                $v->sale_num = '252';
                $v->cart_num = '0';
                $res_list[] = (array)$v;
            }
        }

        return [$res_list,$total];
    }

    /**
     * 获取会员商品/店铺收藏数量
     *
     * @param int $userId 会员id
     * @param int $collectType 收藏类型 0商品 1店铺
     * @return mixed
     */
    public function getUserCollectCount($userId, $collectType = 0)
    {
        $count = Collect::where([['user_id',$userId],['collect_type',$collectType]])->count();
        return $count;
    }

    /**
     * 检查是否已收藏
     *
     * @param $userId
     * @param int $collectType
     * @param int $shopId
     * @param int $goodsId
     * @return bool
     */
    public function checkIsCollected($userId, $collectType = 0, $shopId = 0, $goodsId = 0)
    {
        $where[] = ['user_id', $userId];
        $where[] = ['collect_type', $collectType];
        if ($collectType == 0) {
            $where[] = ['goods_id', $goodsId];
        } elseif ($collectType == 1) {
            $where[] = ['shop_id', $shopId];
        }

        $res = $this->model->where($where)->count();
        if ($res > 0) {
            // 已收藏
            return true;
        } else {
            // 未收藏
            return false;
        }
    }

    /**
     * 收藏/取消收藏
     *
     * @param $userId
     * @param int $collectType
     * @param int $shopId
     * @param int $goodsId
     * @param int $skuId
     * @return bool|int
     */
    public function toggle($userId, $collectType = 0, $shopId = 0, $goodsId = 0, $skuId = 0)
    {
        DB::beginTransaction();
        try {
            if ($this->checkIsCollected($userId, $collectType, $shopId, $goodsId)) {
                // 取消收藏
                $where[] = ['user_id', $userId];
                $where[] = ['collect_type', $collectType];
                if ($collectType == 0) {
                    $where[] = ['goods_id', $goodsId];
                    Goods::where('goods_id', $goodsId)->decrement('collect_num', 1);
                } elseif ($collectType == 1) {
                    $where[] = ['shop_id', $shopId];
                    Shop::where('shop_id', $shopId)->decrement('collect_num', 1);
                }
                $this->model->where($where)->delete();
                $result = 0;
            } else {
                // 收藏商品
                $insert['user_id'] = $userId;
                $insert['collect_type'] = $collectType;
                $insert['add_time'] = time();
                if ($collectType == 0) { // 商品收藏
                    $insert['goods_id'] = $goodsId;
                    $insert['sku_id'] = $skuId;
                    Goods::where('goods_id', $goodsId)->increment('collect_num', 1);
                } elseif ($collectType == 1) { // 店铺收藏
                    $insert['shop_id'] = $shopId;
                    Shop::where('shop_id', $shopId)->increment('collect_num', 1);
                }
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
}