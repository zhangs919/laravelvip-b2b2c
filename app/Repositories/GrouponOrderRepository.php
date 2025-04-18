<?php

namespace App\Repositories;


use App\Jobs\OrderCancel;
use App\Models\GrouponLog;
use Illuminate\Support\Facades\DB;

class GrouponOrderRepository
{
    use BaseRepository;

    protected $model;

    protected $tree;


    public function __construct()
    {
        $this->model = new GrouponLog();
    }

    public function addData($data)
    {
        $ret = $this->store($data);
        return $ret;
    }

    public function getList($condition = [], $column = '')
    {

        $data = $this->model->getList($condition, $column);

        $data[0]->each(function ($value) {
            $orderInfo = $value->orderInfo;
            $value->order_id = $orderInfo->order_id;
            $value->order_status = $orderInfo->order_status;
            $value->surplus = $orderInfo->surplus;
            $value->order_amount = $orderInfo->order_amount;
            $value->money_paid = $orderInfo->money_paid;
            $value->shop_id = $orderInfo->shop_id;
            $value->pay_name = $orderInfo->pay_name;
            $value->pay_id = $orderInfo->pay_id;
            $value->shipping_fee = $orderInfo->shipping_fee;

            $orderGoods = array_first($orderInfo->orderGoods);
            $value->goods_name = $orderGoods->goods_name;
            $value->sku_id = $orderGoods->sku_id;
            $value->goods_image = get_image_url($orderGoods->goods_image);
            $value->goods_price = $orderGoods->goods_price;
            $value->goods_number = $orderGoods->goods_number;
            $value->spec_info = $orderGoods->spec_info;
            $activity = $value->activity;
            $value->act_price = $activity->ext_info['act_price'];
            $value->ext_info = $activity->ext_info;
            $value->act_ext_info = $activity->act_ext_info;
            $value->start_time = $activity->start_time;
            $value->end_time = $activity->end_time;
            $value->user_name = $value->user->user_name;
            $value->join_num = $value->groupon_log_count;
            $value->fight_num = $activity->act_ext_info['fight_num'];
            $value->diff_num = $value->fight_num - $value->join_num; // 缺少人数=所需人数-已拼人数
            $value->shipping_count = 0;
            $value->goods_price_format = '￥'.$orderGoods->goods_price;
        });
        return $data;
    }

    public function getGrouponOrderList($group_sn)
    {
        $list = GrouponLog::where('group_sn', $group_sn)
            ->with(['orderInfo' => function ($query) {
                $query->select(['order_id', 'order_sn', 'order_status', 'pay_status','shipping_status','is_cod', 'order_amount']);
            },'orderInfo.orderGoods','user' => function ($query) {
                $query->select(['user_id', 'user_name','headimg']);
            }])->get()->each(function ($item) {
                $item->user_name = $item->user->user_name;
                $item->headimg = get_image_url($item->user->headimg, 'headimg');
                $item->order_id = $item->orderInfo->order_id;
                $item->order_status = $item->orderInfo->order_status;
                $item->pay_status = $item->orderInfo->pay_status;
                $item->shipping_status = $item->orderInfo->shipping_status;
                $item->is_cod = $item->orderInfo->is_cod;
                $item->order_amount = $item->orderInfo->order_amount;
                $item->order_status_format = format_order_status($item->orderInfo->order_status,$item->orderInfo->shipping_status,$item->orderInfo->pay_status);
                $item->groupon_status_format = str_replace([0,1,2], ['买家已付款，等待成团', '拼团成功', '拼团失败，交易取消'], $item->status);
            });

        return $list;
    }

    public function getOrderInfo($group_sn)
    {
        $info = GrouponLog::where('group_sn', $group_sn)
            ->where('user_type', 0)
            ->with(['orderInfo' => function ($query) {
                $query->select(['order_id', 'order_sn', 'order_status', 'pay_status','shipping_status','is_cod', 'order_amount']);
            },'orderInfo.orderGoods','user' => function ($query) {
                $query->select(['user_id', 'user_name','headimg']);
            },'activity' => function($query){
                $query->select(['act_id', 'ext_info', 'act_ext_info', 'start_time', 'end_time']);
            }])->withCount('grouponLog')->first()->toArray();
        $activity = $info['activity'];

        $act_price_arr = array_values($activity['ext_info']['act_price']);
        $min_act_price = min($act_price_arr);
        $max_act_price = max($act_price_arr);
        $act_price = $min_act_price != $max_act_price ? $min_act_price.'~'.$max_act_price : $min_act_price;

        $info['start_time'] = $activity['start_time'];
        $info['end_time'] = $activity['end_time'];
        $info['act_price'] = $act_price;
        $info['ext_info'] = $activity['ext_info'];
        $info['act_ext_info'] = $activity['act_ext_info'];

        $orderGoods = array_first($info['order_info']['order_goods']);
        $info['goods_name'] = $orderGoods['goods_name'];
        $info['goods_price'] = $orderGoods['goods_price'];


        $orderInfo = $info['order_info'];
        $info['order_id'] = $orderInfo['order_id'];
        $info['join_num'] = $info['groupon_log_count'];
        $info['fight_num'] = $activity['act_ext_info']['fight_num'];
        $info['groupon_status_format'] = str_replace([0,1,2], ['买家已付款，等待成团', '拼团成功', '拼团失败，交易取消'], $info['status']);
        $info['diff_num'] = $info['fight_num'] - $info['join_num']; // 缺少人数=所需人数-已拼人数

        $act_stock_arr = array_values($activity['ext_info']['act_stock']);
        $min_act_stock = min($act_stock_arr);
        $max_act_stock = max($act_stock_arr);
        $act_stock = $min_act_stock != $max_act_stock ? $min_act_stock.'~'.$max_act_stock : $min_act_stock;

        $info['data'] = [
            'ext_info' => $activity['ext_info'],
            'min_act_price' => $min_act_price,
            'max_act_price' => $max_act_price,
            'act_stock' => $act_stock,
            'min_goods_price' => $orderGoods['goods_price'],
            'max_goods_price' => $orderGoods['goods_price'],
            'create_time' => 0,
            'act_price' => $min_act_price != $max_act_price ? '￥'.$min_act_price.'~￥'.$max_act_price : '￥'.$min_act_price,
            'goods_price' => '￥'.$orderGoods['goods_price']
        ];

        $discount_price_arr = !empty($activity['ext_info']['discount_price']) ? array_values($activity['ext_info']['discount_price']) : [];
        $info['discount_price'] = $discount_price_arr ? min($discount_price_arr) : '';

        unset($info['order_info'], $info['user'], $info['activity'], $info['groupon_log_count']);
        return $info;
    }

    /**
     * 拼团超时 自动退款
     *
     * @param $group_sn
     * @return bool
     * @throws \Exception
     */
    public function refund($group_sn)
    {
        $groupon_logs = GrouponLog::where('group_sn', $group_sn)
            ->where('status', 0)
            ->with(['orderInfo', 'orderInfo.orderGoods'])
            ->orderBy('user_type', 'asc')->get()->toArray();
        if (empty($groupon_logs)) {
            return true;
        }
        DB::beginTransaction();
        try {
            foreach ($groupon_logs as $k=>$item) {
                $goods_list = [];
                if (!empty($item['order_info']['order_goods'])) {
                    foreach ($item['order_info']['order_goods'] as $goods) {
                        $goods_list[] = $goods;
                    }
                }
                $item['order_info']['goods_list'] = $goods_list;
                // 移除 order_goods 对象
                unset($item['order_info']['order_goods']);

                // 订单取消并退款
                $ret = OrderCancel::dispatch($item['order_info'],'system_cancel', '拼团失败');
                if ($ret === false) {
                    throw new \Exception('取消订单失败！');
                }
                // 更新拼团订单状态
                GrouponLog::where('log_id', $item['log_id'])->update(['status' => 2]);
            }
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            throw new \Exception($e->getMessage());
        }

    }
}