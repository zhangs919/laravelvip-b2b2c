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
// | Date:2024-03-01
// | Description: 数据统计助手函数
// +----------------------------------------------------------------------

use App\Repositories\Common\TimeRepository;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Date;


/*********************** 数据统计 函数 ************************/

/**
 * 新增会员[按天统计]
 *
 * @param array $search_data
 * @return array
 */
function get_statistic_new_user($search_data = [])
{
    $date_start = $search_data['start_date'];
    $date_end = $search_data['end_date'];
    $day_num = (new Carbon(date('Y-m-d', strtotime($date_end))))->diffInDays((new Carbon(date('Y-m-d', strtotime($date_start)))));

    $result = DB::table('user')
        ->select(DB::raw("DATE(reg_time) as day"), DB::raw("COUNT(*) as count"))
        ->whereBetween('reg_time', [$date_start, $date_end])
        ->groupBy('day')
        ->get();
    $series_data = [];
    $xAxis_data = [];
    if (!$result->isEmpty()) {
        foreach ($result as $item) {
            $series_data[$item->day] = intval($item->count);
        }
    }

    $end_time = TimeRepository::getLocalDate('Y-m-d', strtotime($date_end) - 86400);
    for ($i = 1; $i <= $day_num; $i++) {
        $day = TimeRepository::getLocalDate("Y-m-d", TimeRepository::getLocalStrtoTime($end_time . " - " . ($day_num - $i) . " days"));
        if (empty($series_data[$day])) {
            $series_data[$day] = 0;
        }
        //输出时间
        $day = TimeRepository::getLocalDate("m-d", TimeRepository::getLocalStrtoTime($day));
        $xAxis_data[] = $day;
    }

    return [$series_data, $xAxis_data];
}

/**
 * 新增会员[按小时统计]
 *
 * @param $date
 * @return array
 */
function get_statistic_new_user_hour($date)
{
    $date_start = $date . ' 00:00:00';
    $date_end = $date . ' 23:59:59';
    $result = DB::table('user')
        ->select(DB::raw("DATE_FORMAT(reg_time, '%k') as hour"), DB::raw("COUNT(*) as count"))
        ->whereBetween('reg_time', [$date_start, $date_end])
        ->groupBy('hour')
        ->pluck('count', 'hour')->toArray();
    $series_data = [];
    $xAxis_data = [];
    for ($i = 0; $i <= 24; $i++) {
        $series_data[$i] = $result[$i] ?? 0;
        $xAxis_data[] = $i;
    }
    return [$series_data, $xAxis_data];
}

/**
 * 会员等级统计
 * @return array
 */
function get_statistic_user_rank()
{
    $arr = DB::table('user_rank')->select(['rank_id', 'rank_name'])->get()->toArray();

    foreach ($arr as $key => $item) {
        $user_ranks[$key] = (array)$item;
        $user_ranks[$key]['user_num'] = DB::table('user')->where('rank_id', $item->rank_id)->count();
    }
    $no_rank_user_num = DB::table('user')->where('rank_id', 0)->count();
    $no_rank = array(
        'rank_id' => 0,
        'rank_name' => '无等级',
        'user_num' => $no_rank_user_num
    );
    $user_ranks[] = $no_rank;

    // 会员总数
    $user_count = DB::table('user')->count();

    $data['list'] = [];
    foreach ($user_ranks as $key => $val) {
        $data['list'][] = [
            'name' => $val['rank_name'],
            'value' => $val['user_num']
        ];
        //数据标题
        $data['text'][] = $val['rank_name'];
        //占比处理
        $user_ranks[$key]['percent'] = round($val['user_num'] / $user_count, 4) * 100;
    }

    $data['user_ranks'] = $user_ranks;

    return $data;
}

/**
 * 有效销售额[按小时统计]
 *
 * @param $date
 * @return array
 */
function get_statistic_order_amount_hour($date)
{
    $date_start = $date . ' 00:00:00';
    $date_end = $date . ' 23:59:59';
    $result = DB::table('order_info')
        ->select(DB::raw("DATE_FORMAT(created_at, '%k') as hour"), DB::raw("SUM(money_paid + surplus) as total_fee"))
        ->where('pay_status', PS_PAYED)
        ->whereBetween('created_at', [$date_start, $date_end])
        ->groupBy('hour')
        ->pluck('total_fee', 'hour')->toArray();
    $series_data = [];
    $xAxis_data = [];
    for ($i = 0; $i <= 24; $i++) {
        $series_data[$i] = $result[$i] ?? 0;
        $xAxis_data[] = $i;
    }
    return [$series_data, $xAxis_data];
}

/**
 * 有效销售量[按小时统计]
 *
 * @param $date
 * @return array
 */
function get_statistic_order_count_hour($date)
{
    $date_start = $date . ' 00:00:00';
    $date_end = $date . ' 23:59:59';
    $result = DB::table('order_info')
        ->select(DB::raw("DATE_FORMAT(created_at, '%k') as hour"), DB::raw("count(distinct order_id) as order_count"))
        ->where('pay_status', PS_PAYED)
        ->whereBetween('created_at', [$date_start, $date_end])
        ->groupBy('hour')
        ->pluck('order_count', 'hour')->toArray();
    $series_data = [];
    $xAxis_data = [];
    for ($i = 0; $i <= 24; $i++) {
        $series_data[$i] = $result[$i] ?? 0;
        $xAxis_data[] = $i;
    }
    return [$series_data, $xAxis_data];
}

/**
 * 统计-数据概况
 * @return array
 */
function get_statistic_data_profiling()
{
    $goods_count = DB::table('goods')->where('goods_status', 1)->count();
    $shops_count = DB::table('shop')->where('shop_status', 1)->count();
    $users_count = DB::table('user')->count();
    $today_new_goods_count = DB::table('goods')->where('goods_status', 1)
        ->whereDate('created_at', today())->count();
    $today_new_shops_count = DB::table('shop')->where('shop_status', 1)
        ->whereDate('created_at', today())->count();
    $today_new_users_count = DB::table('user')
        ->whereDate('created_at', today())->count();
    $today_order_amount = DB::table('order_info')
        ->where('pay_status', PS_PAYED)
        ->whereDate('created_at', today())
        ->selectRaw('SUM(money_paid + surplus) as total_fee')->value('total_fee');
    $today_order_count = DB::table('order_info')
        ->where('pay_status', PS_PAYED)
        ->whereDate('created_at', today())
        ->distinct('order_id')->count();

    $today_order_users_count = DB::table('order_info')
        ->where('pay_status', PS_PAYED)
        ->whereDate('created_at', today())
        ->distinct('user_id')->count();

    $data = [
        'goods_count' => $goods_count,//平台所有商品的数量
        'shops_count' => $shops_count,//平台所有店铺的数量
        'users_count' => $users_count,//平台所有会员的数量
        'today_new_goods_count' => $today_new_goods_count,//今日新增商品总数
        'today_new_shops_count' => $today_new_shops_count,//今日新注册店铺总数
        'today_new_users_count' => $today_new_users_count,//今日新注册会员总数
        'today_order_amount' => $today_order_amount ?? '0.00',//今日有效订单的总金额
        'today_order_count' => $today_order_count,//今日有效订单的总数量
        'today_order_goods_count' => "0",//今日有效订单包含的商品总数量
        'today_order_users_count' => $today_order_users_count,//今日有效订单的下单会员总数
        'today_order_goods_average_price' => "0.00",//平均价格-今日有效订单包含商品的平均单价（元）
        'today_order_user_average_amount' => "0.00",//平均客单价-今日有效订单的平均每单的金额（元）
    ];

    return $data;
}

/**
 * 订单趋势[按天统计]
 * 如：最近7天
 *
 * @param array $search_data
 * @return array
 */
function get_seller_statistic_recent_trending($search_data = [])
{
    $date_start = $search_data['start_date'];
    $date_end = $search_data['end_date'];
    $day_num = (new Carbon($date_end))->diffInDays($date_start) + 1;
    $xAxis_data_arr = [];
    $end_time = TimeRepository::getLocalDate('Y-m-d', strtotime($date_end));
    for ($i = 1; $i <= $day_num; $i++) {
        $day = TimeRepository::getLocalDate("Y-m-d", TimeRepository::getLocalStrtoTime($end_time . " - " . ($day_num - $i) . " days"));
        //输出时间
        $day = TimeRepository::getLocalDate("Y-m-d", TimeRepository::getLocalStrtoTime($day));
        $xAxis_data_arr[] = $day;
    }
    $xAxis_data = json_encode($xAxis_data_arr);
    $series_arr = [
        [
            'name' => '总订单',
            'type' => 'line',
            'data' => ''
        ],
        [
            'name' => '已成功',
            'type' => 'line',
            'data' => ''
        ],
        [
            'name' => '已发货',
            'type' => 'line',
            'data' => ''
        ],
        [
            'name' => '未发货',
            'type' => 'line',
            'data' => ''
        ],
        [
            'name' => '未付款',
            'type' => 'line',
            'data' => ''
        ],
        [
            'name' => '已关闭',
            'type' => 'line',
            'data' => ''
        ],
    ];
    foreach ($series_arr as $k=>$v) {
        // 处理查询条件
        $where = [
            ['is_delete', 0]
        ];
        if ($v['name'] == '总订单') {

        } elseif ($v['name'] == '已成功') {
            $where[] = ['order_status', [OS_CONFIRMED, OS_SPLITED, OS_RETURNED_PART, OS_ONLY_REFOUND]];
            $where[] = ['shipping_status', SS_RECEIVED];
            $where[] = ['pay_status', PS_PAYED];
        } elseif ($v['name'] == '已发货') {
            $where[] = ['order_status', [OS_CONFIRMED, OS_SPLITED]];
            $where[] = ['shipping_status', SS_RECEIVED];
            $where[] = ['pay_status', PS_PAYED];
        } elseif ($v['name'] == '未发货') {
            $where[] = ['order_status', OS_CONFIRMED];
            $where[] = ['shipping_status', SS_UNSHIPPED];
            $where[] = ['pay_status', [PS_PAYING, PS_PAYED]];
        } elseif ($v['name'] == '未付款') {
            $where[] = ['order_status', [OS_UNCONFIRMED, OS_CONFIRMED]];
            $where[] = ['shipping_status', [SS_UNSHIPPED, SS_PREPARING]];
            $where[] = ['pay_status', PS_UNPAYED];
        } elseif ($v['name'] == '已关闭') {
            $where[] = ['order_status', [OS_CANCELED, OS_INVALID]];
        }

        $result = DB::table('order_info')
            ->select(DB::raw("DATE_FORMAT(created_at, '%Y-%m-%d') as day"), DB::raw("COUNT(*) as count"))
            ->whereBetween('created_at', [$date_start, $date_end])
            ->where($where)
            ->groupBy('day')
            ->pluck('count', 'day');
        $series_data = [];
        $end_time = TimeRepository::getLocalDate('Y-m-d', strtotime($date_end));
        for ($i = 1; $i <= $day_num; $i++) {
            $day = TimeRepository::getLocalDate("Y-m-d", TimeRepository::getLocalStrtoTime($end_time . " - " . ($day_num - $i) . " days"));
            $series_data[$day] = $result[$day] ?? 0;
        }
        $series_arr[$k]['data'] = array_values($series_data);
    }

    $series = json_encode($series_arr);

    return [$series, $xAxis_data];
}

/**
 * 商家后台 统计-数据概况
 * @return array
 */
function get_seller_statistic_data_profiling($shop_id)
{
    $yesterday = Date::yesterday();
    $yesterday_start = $yesterday->toDateString()." 00:00:00";
    $yesterday_end = $yesterday->toDateString()." 23:59:59";

    $today_back_count = DB::table('back_order')->where('shop_id', $shop_id)
        ->whereDate('created_at', today())
        ->distinct('order_id')->count();
    $today_back_money = DB::table('back_order')->where('shop_id', $shop_id)
        ->whereDate('created_at', today())
        ->sum('refund_money');
    $today_payed_count = DB::table('order_info')->where('shop_id', $shop_id)
        ->where('pay_status', PS_PAYED)
        ->whereDate('created_at', today())
        ->distinct('order_id')->count();
    $today_payed_goods_count = DB::table('order_info as o')->where('o.shop_id', $shop_id)
        ->where('o.pay_status', PS_PAYED)
        ->whereDate('o.created_at', today())
        ->selectRaw('sum(og.goods_number) as payed_goods_count')
        ->leftJoin('order_goods as og', 'og.order_id', '=', 'o.order_id')
        ->value('payed_goods_count');
    $today_payed_money = DB::table('order_info')->where('shop_id', $shop_id)
        ->where('pay_status', PS_PAYED)
        ->whereDate('created_at', today())
        ->selectRaw('sum(money_paid + surplus) as today_payed_money')
        ->value('today_payed_money');

    $yesterday_back_count = DB::table('back_order')->where('shop_id', $shop_id)
        ->whereDate('created_at', $yesterday)
        ->distinct('order_id')->count();
    $yesterday_back_money = DB::table('back_order')->where('shop_id', $shop_id)
        ->whereDate('created_at', $yesterday)
        ->sum('refund_money');
    $yesterday_order_count = DB::table('order_info')->where('shop_id', $shop_id)
        ->whereDate('created_at', $yesterday)
        ->distinct('order_id')->count();
    $yesterday_payed_count = DB::table('order_info')->where('shop_id', $shop_id)
        ->where('pay_status', PS_PAYED)
        ->whereDate('created_at', $yesterday)
        ->distinct('order_id')->count();
    $yesterday_payed_money = DB::table('order_info')->where('shop_id', $shop_id)
        ->where('pay_status', PS_PAYED)
        ->whereDate('created_at', $yesterday)
        ->selectRaw('sum(money_paid + surplus) as yesterday_payed_money')
        ->value('yesterday_payed_money');
    $yesterday_send_count = DB::table('order_info')->where('shop_id', $shop_id)
        ->where('pay_status', PS_PAYED)
        ->whereDate('shipping_time', $yesterday)
        ->whereBetween('shipping_time', [$yesterday_start, $yesterday_end])
        ->distinct('order_id')->count();

    $data = [
        'today_back_count' => $today_back_count,//今日退款订单数
        'today_back_money' => $today_back_money ?? '0.00',//今日退款金额
        'today_payed_count' => $today_payed_count,//今日付款订单数
        'today_payed_goods_count' => $today_payed_goods_count,//今日付款商品件数
        'today_payed_money' => $today_payed_money ?? '0.00',//今日付款金额
        'yesterday_back_count' => $yesterday_back_count,//昨日退款订单数
        'yesterday_back_money' => $yesterday_back_money ?? '0.00',//昨日退款金额
        'yesterday_order_count' => $yesterday_order_count,//昨日下单数量
        'yesterday_payed_count' => $yesterday_payed_count,//昨日付款订单数
        'yesterday_payed_money' => $yesterday_payed_money ?? '0.00',//昨日付款金额
        'yesterday_send_count' => $yesterday_send_count//昨日发货订单数
    ];

    return $data;
}

/**
 * 新增店铺[按小时统计]
 *
 * @param $date
 * @return array
 */
function get_statistic_new_shop_hour($date)
{
    $date_start = $date . ' 00:00:00';
    $date_end = $date . ' 23:59:59';
    $result = DB::table('shop')
        ->select(DB::raw("DATE_FORMAT(created_at, '%k') as hour"), DB::raw("COUNT(*) as count"))
        ->whereBetween('created_at', [$date_start, $date_end])
        ->groupBy('hour')
        ->pluck('count', 'hour')->toArray();
    $series_data = [];
    $xAxis_data = [];
    for ($i = 0; $i <= 24; $i++) {
        $series_data[$i] = $result[$i] ?? 0;
        $xAxis_data[] = $i;
    }
    return [$series_data, $xAxis_data];
}

// 商家后台 统计-营业统计
function get_seller_sales_statistics()
{
    $data = [
        'buy_sms' => '0.00',
        'cancel_count' => 0,
        'cash_on_delivery' => '0.00',
        'cash_on_delivery_count' => 0,
        'cashier_commission' => '0.00',
        'cashier_payment' => '0.00',
        'commission' => '0.00',
        'gift_card_count' => 0,
        'income' => '0.00',
        'losses' => '0.00',
        'offline_income' => '0.00',
        'offline_losses' => '0.00',
        'offline_payment' => '0.00',
        'offline_payment_count' => 0,
        'online_cashier_count' => 0,
        'online_freebuy_count' => 0,
        'online_income' => '0.00',
        'online_losses' => '0.00',
        'online_normal_count' => 0,
        'online_payment' => '0.00',
        'online_payment_count' => 0,
        'online_reachbuy_count' => 0,
        'payment' => '0.00',
        'payment_count' => 0,
        'sales_amount' => '0.00',
        'seller_cancel_count' => 0,
        'shop_bonus' => '0.00',
        'shop_discount' => '0.00',
        'system_cancel_count' => 0,
        'user_cancel_count' => 0,
        'user_offline_cancel_count' => 0,
    ];

    return $data;
}