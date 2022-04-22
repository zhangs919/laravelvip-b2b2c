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
// | Date:2019-04-5
// | Description: 用户红包
// +----------------------------------------------------------------------

namespace App\Repositories;


use App\Models\Bonus;
use App\Models\UserBonus;

class UserBonusRepository
{
    use BaseRepository;

    protected $model;


    public function __construct()
    {
        $this->model = new UserBonus();
    }

    /**
     * 获取用户红包列表
     *
     * @param array $where 查询条件
     * @return array
     */
    public function getUserBonusList($where = [])
    {
        // 列表
        $condition = [
            'where' => $where,
            'sortname' => 'user_bonus_id',
            'sortorder' => 'desc',
        ];
        list($list, $total) = $this->getList($condition);
        $list = $list->toArray();
        if (!empty($list)) {
            foreach ($list as $key=>&$item) {

                array_merge(unserialize($item['bonus_datas']), $item);
                $item['bonus_type_format'] = format_bonus_type($item['bonus_type']);
                $item['bonus_price_format'] = $item['bonus_price'];
                $item['used_time_format'] = format_time($item['used_time'], 'Y-m-d H:i:s');
                $item['receive_time_format'] = format_time($item['receive_time'], 'Y-m-d H:i:s');
                $item['start_time_format'] = format_time($item['start_time'], 'Y-m-d');
                $item['end_time_format'] = format_time($item['end_time'], 'Y-m-d');
                $item['search_url'] = '/shop/.'.$item['shop_id'].'html';
                $item['bonus_desc'] = '使用条件：店内通用 满￥'.$item['bonus_price'].'可用 '.str_replace([0,1], ['可与其他优惠、活动一起使用','仅限原价购买时使用'], $item['is_original_price']);
            }
        }

        return [$list, $total];
    }

    /**
     * 领取红包
     *
     * @param $bonus_id
     * @param $user_id
     * @param $user_name
     * @return bool
     */
    public function receiveBonus($bonus_id, $user_id, $user_name)
    {
        // 检查当前登录用户是否已经领取过该红包
        $is_receive = UserBonus::where([['bonus_id',$bonus_id], ['user_id', $user_id]])->exists();
        if ($is_receive) {
            // 已经领取过
            return false;
        }

        $bonus_info = Bonus::where('bonus_id', $bonus_id)->first();
        if (empty($bonus_info)) {
            return false;
        }
        $bonus_info = $bonus_info->toArray();

        $bonus_data = [
            'min_goods_amount' => $bonus_info['min_goods_amount'],
            'is_original_price' => $bonus_info['is_original_price'],
            'is_self_shop' => $bonus_info['bonus_data']['is_self_shop'] ?? 0,
            'cat_ids' => $bonus_info['bonus_data']['cat_ids'] ?? 0,
            'goods_ids' => $bonus_info['bonus_data']['goods_ids'] ?? null,
        ];
        $bonus_data = serialize($bonus_data);

        $bonus_datas = serialize($bonus_info['bonus_data']);
        $insert = [
            'user_id' => $user_id,
            'bonus_id' => $bonus_id,
            'bonus_sn' => $this->makeBonusSn(),
            'bonus_price' => $bonus_info['bonus_amount'],
            'bonus_data' => $bonus_data,
            'receive_time' => time(),
            'used_time' => 0,
            'start_time' => strtotime($bonus_info['start_time']),
            'end_time' => strtotime($bonus_info['end_time']),
            'add_time' => $bonus_info['add_time'],
            'order_sn' => 0,
            'bonus_status' => 0,
            'is_delete' => 0,
            'sales_id' => 0,
            'user_name' => $user_name,
            'shop_id' => $bonus_info['shop_id'],
            'bonus_type' => $bonus_info['bonus_type'],
            'use_range' => $bonus_info['use_range'],
            'bonus_datas' => $bonus_datas,
            'min_goods_amount' => $bonus_info['min_goods_amount'],
            'is_original_price' => $bonus_info['is_original_price'],
            'order_id' => null,
        ];
//        dd($insert);
        $ret = $this->store($insert);

        return $ret;
    }

    /**
     * 生成红包编号
     *
     * @return string
     */
    public function makeBonusSn()
    {
        $strs="QWERTYUIOPASDFGHJKLZXCVBNM1234567890qwertyuiopasdfghjklzxcvbnm";
        $bonus_sn = time()
            .str_pad(mt_rand(1, 9999), 4, '0', STR_PAD_LEFT)
            .strtoupper(substr(str_shuffle($strs),mt_rand(0,strlen($strs)-11),5));

        return $bonus_sn;
    }
}