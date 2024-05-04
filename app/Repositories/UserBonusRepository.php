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
use App\Models\Member;
use App\Models\Shop;
use App\Models\UserBonus;
use Illuminate\Support\Facades\DB;

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

                $item['bonus_data'] = unserialize($item['bonus_data']);

                array_merge(unserialize($item['bonus_datas']), $item);

                $item['shop_name'] = Shop::where('shop_id', $item['shop_id'])->value('shop_name');

                $item['bonus_type_format'] = format_bonus_type($item['bonus_type']);
                $item['bonus_price_format'] = $item['bonus_price'];
                $item['used_time_format'] = format_time($item['used_time'], 'Y-m-d H:i:s');
                $item['receive_time_format'] = format_time($item['receive_time'], 'Y-m-d H:i:s');
                $item['start_time_format'] = format_time($item['start_time'], 'Y-m-d H:i:s');
                $item['end_time_format'] = format_time($item['end_time'], 'Y-m-d H:i:s');
                $item['search_url'] = '/shop/.'.$item['shop_id'].'html';
                $item['bonus_desc'] = '使用条件：店内通用 满￥'.$item['bonus_price'].'元可用 '
                    .str_replace([0,1], ['可与其他优惠、活动一起使用','限原价购买使用'], $item['is_original_price'])
                    .'</br>起始时间：'.$item['start_time_format']
                    .'</br>截至时间：'.$item['end_time_format'];
            }
        }

        return [$list, $total];
    }

    /**
     * 获取用户红包数量
     *
     * @param $where
     * @return mixed
     */
    public function getBonusCount($where)
    {
        return $this->model->where($where)->count();
    }


    /**
     * 领取红包
     *
     * @param $bonus_id
     * @param $user_id
     * @param $user_name
     * @return User|false
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
        $ret = $this->store($insert);

        return $ret;
    }

    /**
     * 派发红包
     *
     * @param $key
     * @param $shop_id
     * @param $params
     * @return bool
     * @throws \Exception
     */
    public function sendUserBonus($key, $shop_id, $params)
    {
        $bonus_id = $params['bonus_id'];
        if ($key == 'seller-send-user-bonus-by-rank') {
            // 按指定会员等级发放红包
            $model = Member::where([['shop_id', $shop_id], ['rank_id', $params['shop_rank_id']]]);

            $is_repeat = $params['is_repeat']; // 排除已领取此红包的会员 0-不排除 1-排除
            if ($is_repeat) {
                $received_user_ids = UserBonus::where([['bonus_id', $bonus_id], ['shop_id', $shop_id]])
                    ->pluck('user_id')->toArray();
                $model->whereNotIn('user_id', $received_user_ids);
            }

            $user_ids = $model
                ->pluck('username', 'user_id')->toArray();

        } elseif ($key == 'seller-send-user-bonus-by-user') {
            // 按指定会员发放红包
            $user_ids = explode(',', $params['user_ids']);
        }

        DB::beginTransaction();
        try{
            if (empty($user_ids)) {
                throw new \Exception('暂无满足条件的用户');
            }
            // 开始发放
            foreach ($user_ids as $user_id => $username) {
                $ret = self::receiveBonus($bonus_id, $user_id, $username);
                if (!$ret) {
                    throw new \Exception('红包发放失败');
                }
            }

            // 发送消息提醒

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();//事务回滚
            return $e->getMessage();
        }
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