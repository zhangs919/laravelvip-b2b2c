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
// | Date:2019-03-22
// | Description: 红包
// +----------------------------------------------------------------------

namespace App\Repositories;


use App\Models\Bonus;
use App\Models\Goods;
use App\Models\UserBonus;

class BonusRepository
{
    use BaseRepository;

    protected $model;


    public function __construct()
    {
        $this->model = new Bonus();
    }

    /**
     * 获取红包列表
     *
     * @param array $where 查询条件
     * @return array
     */
    public function getBonusList($where = [])
    {
        // 列表
        $condition = [
            'where' => $where,
            'sortname' => 'bonus_id',
            'sortorder' => 'desc',
        ];
        list($list, $total) = $this->getList($condition);
        $list = $list->toArray();
        if (!empty($list)) {
            foreach ($list as $key=>$item) {

                $list[$key]['start_time_format'] = format_time(strtotime($item['start_time']), 'Y-m-d');
                $list[$key]['end_time_format'] = format_time(strtotime($item['end_time']), 'Y-m-d');
                // 红包类型 默认0 1-主动领红包/到店送红包 2-收藏送红包 4-会员送红包 6-注册送红包 9-推荐送红包 10-积分兑换红包
                $list[$key]['bonus_type_name'] = format_bonus_type($item['bonus_type']);
                $list[$key]['min_goods_amount_format'] = '￥'.$item['min_goods_amount'];
                // 红包状态 0-正常 1-已抢完 2-已失效
                if (strtotime($item['end_time']) < time() && $item['bonus_type'] != 4) {/*不是4-会员送红包*/
                    // 已失效
                    $bonus_status = 2;
                    $bonus_status_format = '已失效';
                } elseif ($item['bonus_number'] == $item['receive_number'] && $item['bonus_type'] != 4) {/*不是4-会员送红包*/
                    // 已抢完
                    $bonus_status = 1;
                    $bonus_status_format = '已抢完';
                } else {
                    // 正常
                    $bonus_status = 0;
                    $bonus_status_format = '正常';
                }
                $list[$key]['bonus_status'] = $bonus_status;
                $list[$key]['bonus_status_format'] = $bonus_status_format;
                $list[$key]['bonus_amount_format'] = '￥'.$item['bonus_amount'];
                if (isset($item['bonus_data']['is_self_shop'])) {
                    $list[$key]['is_self_shop'] = $item['bonus_data']['is_self_shop'];
                }
                $list[$key]['goods_ids'] = $item['bonus_data']['goods_ids'];

            }
        }

        return [$list, $total];
    }

    /**
     * 获取红包商品列表
     *
     * @param array $goods_ids 商品ids
     * @return bool
     */
    public function getBonusGoodsList($goods_ids)
    {
        if (!$goods_ids) {
            return false;
        }

        $where = [];
        $where[] = ['goods_status',1]; // 商品状态 已发布
        $where[] = ['goods_audit',1]; // 审核通过
        $list = Goods::where($where)
            ->whereIn('goods_id', $goods_ids)
            ->select(['goods_id','goods_name','goods_image'])
            ->get()->toArray();
        return $list;
    }

    /**
     * 获取商品详情页红包列表
     *
     * @param int $goods_id 商品id
     * @param int $shop_id 店铺id 获取店铺内通用红包
     * @param int $user_id 当前用户id
     * @return bool
     */
    public function getGoodsDetailBonusList($goods_id, $shop_id = 0, $user_id = 0)
    {
        if (!$goods_id) {
            return false;
        }
        // todo 查询红包的条件不全 后期完善
        $where = [];
        if (!empty($shop_id)) { // 店铺内红包
            $where[] = ['shop_id', $shop_id];
            $where[] = ['use_range', 0];
        }
        $where[] = ['end_time', '>', time()]; // 红包发放截至时间大于当前时间 即为有效

        $data = Bonus::where($where)
            ->orWhereRaw('instr(`goods_ids`, ?)', [$goods_id])
            ->orderBy('bonus_id', 'asc')
            ->get()->toArray();

        if (!empty($data)) {
            foreach ($data as $key=>$item) {
                // 检查当前登录用户是否已经领取过该红包
                $is_receive = UserBonus::where([['bonus_id',$item['bonus_id']], ['user_id', $user_id]])->exists();

                $data[$key]['is_receive'] = $is_receive ? 1 : 0; // 是否已领取过
                $data[$key]['start_time_format'] = format_time(strtotime($item['start_time']), 'Y.m.d');
                $data[$key]['end_time_format'] = format_time(strtotime($item['end_time']), 'Y.m.d');
                $data[$key]['bonus_amount_format'] = '￥'.$item['bonus_amount'];
            }
        }

        return $data;
    }

}