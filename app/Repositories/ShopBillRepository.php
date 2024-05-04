<?php

namespace App\Repositories;


use App\Models\SellerBillGoods;
use App\Models\SellerBillOrder;
use App\Models\Shop;
use App\Models\ShopBill;
use App\Repositories\Common\TimeRepository;
use Illuminate\Support\Facades\DB;

/**
 * todo 当商家结算功能开发完成后，此类将作废
 * @since v4.0
 * Class ShopBillRepository
 * @package App\Repositories
 */
class ShopBillRepository
{
    use BaseRepository;

    protected $model;


    public function __construct()
    {
        $this->model = new ShopBill();
    }

    // 计算佣金
    public static function calcCommission()
    {

    }

    public function getList($condition = [])
    {
        $data = $this->model->getList($condition);
        if (!empty($data[0])) {
            foreach ($data[0] as $key=>$item) {

                $item->start_date = format_time($item->start_date, 'Y-m-d');
                $item->end_date = format_time($item->end_date, 'Y-m-d');
                $item->site_status_format = null;
                $item->shop_status_format = format_bill_shop_status($item->shop_status);
                $item->store_status_format = null;

            }
        }

        return $data;
    }


    public static function getOrderCount($params)
    {
        $result = [
            'shop_status' => 3,
            'site_status' => 0,
            'store_status' => 0,
            'goods_amount' => '0.00',
            'shipping_fee' => '0.00',
            'commission' => '0.00',
            'shop_money' => '0.00',
            'store_card_amount' => '0.00',
            'is_cod' => 0,
            'date' => '2019-12-01~2019-12-31',
            'deposit_account' => false,
            'status' => '已结算',
            'stage_money' => '0.00',
            'order_count' => 0
        ];

        return $result;
    }

    /**
     * 获取结算单订单列表
     *
     * @param $params array
     * @return array
     */
    public function getOrders($params)
    {
        // $params['shop_id'] = seller_shop_info()->shop_id;
        //        $params['store_id'] = $store_id;
        //        $params['group_time'] = $group_time; 2019-06
        //        $params['type'] = $type; 0-月结 1-周结 2-日结 3-3日结
        //        $params['order_sn'] = $order_sn;
        $pageArr = request()->all();
        $curPage = !empty($pageArr['page']['cur_page']) ? $pageArr['page']['cur_page'] : 1;
        $pageSize = !empty($pageArr['page']['page_size']) ? $pageArr['page']['page_size'] : 10;

        if (isset($condition['cur_page'])) {
            $curPage = $condition['cur_page'];
        }
        if (isset($condition['page_size'])) {
            $pageSize = $condition['page_size'];
        }
        // 查询条件 按订单完成时间来查询 end_time
        $where = [];

        $query = DB::table('order_info as o') // 订单已完成 超过售后期限
            ->where('order_status', 1)
            ->leftJoin('shop', 'shop.shop_id', '=', 'o.shop_id')
            ->leftJoin('user as u', 'u.user_id', '=', 'o.user_id')
            ->leftJoin('shop_bill as bill', 'bill.shop_id', '=', 'o.shop_id')
            ->selectRaw('o.order_id,o.order_sn,o.shop_id,shop.shop_name,o.add_time,
                o.confirm_time,o.end_time,o.bonus,o.shop_bonus,o.order_data,o.is_cod,
                bill.shop_status,bill.shop_status as site_status,bill.shop_status as store_status,
                bill.end_date as send_bill,
                o.change_amount,o.goods_amount,o.buy_type,o.shipping_fee,o.other_shipping_fee,
                o.packing_fee,o.integral_money,o.discount_fee,
                u.user_name,
                o.order_amount,o.store_card_price as store_card,o.surplus,
                o.pay_code,o.money_paid
            ')
            ->whereRaw('o.end_time > bill.start_date and o.end_time < bill.end_date');

        // todo
        if ($params['type'] == 3) {// 3日结

        } elseif ($params['type'] == 2) {//日结

        }elseif ($params['type'] == 1) {//周结

        } else {//0 月结

        }

        $total = $query->count();
        $list = $query
            ->forPage($curPage, $pageSize)
            ->orderBy('o.created_at', 'desc')
            ->get()->toArray();

        if (!empty($list)) {
            foreach ($list as &$item) {
                $item = (array)$item;

                $item['take_rate'] = null;
                $item['store_take_rate'] = null;

                $item['refund_money'] = '0.00';
                $item['system_money'] = '0.00';
                $item['site_money'] = '0.00';
                $item['shop_money'] = '0.00';
                $item['store_money'] = '0.00';
                $item['activity_money'] = '0.00';
                $item['commission_money'] = '0.00';
                // 支付方式缩写【不支持余额支付！！！】 cod货到付款 alipay支付宝 union银联支付 weixin微信支付 to_pay找人代付
                $item['alipay'] = $item['pay_code'] == 'alipay' ? $item['money_paid'] : '0.00';
                $item['weixin'] = $item['pay_code'] == 'weixin' ? $item['money_paid'] : '0.00';
                $item['union'] = $item['pay_code'] == 'union' ? $item['money_paid'] : '0.00';
                $item['sum_is_cod'] = '0.00';

                $item['site_status_format'] = '未出账';
                $item['shop_status_format'] = format_bill_shop_status($item['shop_status']);
                $item['store_status_format'] = '未出账';

            }
        }

        return [$list,$total];
    }

    /**
     * 账单商家列表缓存文件
     *
     * @return mixed
     * @throws \Exception
     */
    public function getCacheShopList()
    {
        $res = Shop::where('shop_audit', 1)->get()->toArray();
        if ($res) {
            cache()->forever('shop_list', $res);
        }

        return $res;
    }


    /**
     * 账单
     * 类型：按天数
     * 生成账单列表
     *
     * @param int $shop_id
     * @param int $cycle
     * @return array
     */
    public function getBillDaysNumber(int $shop_id = 0, $cycle = 0)
    {
        $bill = $this->getBillMinmaxTime($shop_id, $cycle);

        $mintime = 0;
        $maxtime = 0;

        $day_array = [];
        if ($bill) {
            $mintime = isset($bill['min_time']) & !empty($bill['min_time']) ? $bill['min_time'] : $mintime;
            $maxtime = isset($bill['max_time']) & !empty($bill['max_time']) ? $bill['max_time'] : $maxtime;
        }

        if ($mintime && $maxtime) {
            $min_time = format_time($mintime, "Y-m-d");
            $max_time = format_time($maxtime, "Y-m-d");

            $min_time = explode("-", $min_time);
            $max_time = explode("-", $max_time);

            $min_year = intval($min_time[0]);
            $max_year = intval($max_time[0]);
            $min_month = intval($min_time[1]);
            $max_month = intval($max_time[1]);
            $min_day = intval($min_time[2]);
            $max_day = intval($max_time[2]);

            $day_number = 0;
            $server_day_number = 3; // 3日结
//            $server_day_number = MerchantsServer::where('user_id', $shop_id)->value('day_number');

            $year_array = [];
            if ($min_year < $max_year) {

                //开始账单的时间年份比最大的账单结束时间年份要小
                $min_count = 12 - $min_month;
                if ($min_count > 0) {
                    for ($i = $min_month; $i <= 12; $i++) {

                        //获取当月天数
                        $days = TimeRepository::getCalDaysInMonth(CAL_GREGORIAN, $i, $min_year);
                        if (!($i == $min_month)) {
                            $day_number += $days;
                        } else {
                            if ($i == $min_month) {
                                $minDay = $days - $min_day;
                                $day_number += $minDay;
                            }
                        }
                    }
                } else {
                    $min_month_day = TimeRepository::getCalDaysInMonth(CAL_GREGORIAN, $min_month, $min_year);
                    $minDay = $min_month_day - $min_day;
                    $day_number += $minDay;
                }

                for ($i = 1; $i <= $max_month; $i++) {

                    /* 获取当月天数 */
                    $days = TimeRepository::getCalDaysInMonth(CAL_GREGORIAN, $i, $max_year);
                    if (!($i == $max_month)) {
                        $day_number += $days;
                    }

                    if ($i == $max_month) {
                        $maxday = $max_day;
                        $day_number += $maxday;
                    }
                }

                if ($day_number && $server_day_number && $day_number > $server_day_number) {
                    $number = round($day_number / $server_day_number);

                    for ($i = 0; $i <= $number; $i++) {
                        $year_start = TimeRepository::getLocalDate("Y-m-d", TimeRepository::getLocalStrtoTime(TimeRepository::getLocalDate("Y-m-d", $bill['min_time'])) + (($i + 1) * ($server_day_number - 1) - ($server_day_number) + 1) * 24 * 60 * 60);
                        $year_end = TimeRepository::getLocalDate("Y-m-d", TimeRepository::getLocalStrtoTime(TimeRepository::getLocalDate("Y-m-d", $bill['min_time'])) + ($i + 1) * ($server_day_number - 1) * 24 * 60 * 60);

                        $year_start = $year_start . " 00:00:00";
                        $year_end = $year_end . " 23:59:59";

                        $year_array[$i]['last_year_start'] = $year_start;
                        $year_array[$i]['last_year_end'] = $year_end;
                    }
                }
            } else {
                if ($min_month < $max_month) {
                    $m_count = $max_month - $min_month;
                    for ($i = 0; $i <= $m_count; $i++) {
                        $month = $min_month + $i;

                        /* 获取当月天数 */
                        $days = TimeRepository::getCalDaysInMonth(CAL_GREGORIAN, $month, $min_year);

                        if (!($month == $min_month || $month == $max_month)) {
                            $day_number += $days;
                        } else {
                            if ($month == $min_month) {
                                $minDay = $days - $min_day;
                                $day_number += $minDay;
                            }

                            if ($month == $max_month) {
                                $maxday = $max_day;
                                $day_number += $maxday;
                            }
                        }
                    }

                    if ($day_number && $server_day_number && $day_number > $server_day_number) {
                        $number = round($day_number / $server_day_number);

                        for ($i = 0; $i <= $number; $i++) {
                            $year_start = TimeRepository::getLocalDate("Y-m-d", TimeRepository::getLocalStrtoTime(TimeRepository::getLocalDate("Y-m-d", $bill['min_time'])) + (($i + 1) * ($server_day_number - 1) - ($server_day_number) + 1) * 24 * 60 * 60);
                            $year_end = TimeRepository::getLocalDate("Y-m-d", TimeRepository::getLocalStrtoTime(TimeRepository::getLocalDate("Y-m-d", $bill['min_time'])) + ($i + 1) * ($server_day_number - 1) * 24 * 60 * 60);

                            $year_start = $year_start . " 00:00:00";
                            $year_end = $year_end . " 23:59:59";

                            $year_array[$i]['last_year_start'] = $year_start;
                            $year_array[$i]['last_year_end'] = $year_end;
                        }
                    }
                }
            }

            if ($year_array) {
                foreach ($year_array as $key => $row) {
                    $year_start = TimeRepository::getLocalStrtoTime($row['last_year_start']);
                    $year_end = TimeRepository::getLocalStrtoTime($row['last_year_end']);

                    $bill_id = $this->getBillId($shop_id, $cycle, $year_start, $year_end);
                    if (!$bill_id && ($mintime < $year_start && $maxtime > $year_end)) {
                        $day_array[$key]['last_year_start'] = $row['last_year_start'];
                        $day_array[$key]['last_year_end'] = $row['last_year_end'];
                    }
                }
            }
        }

        return $day_array;
    }

    /**
     * 账单
     * 类型：每天
     * 生成账单列表
     *
     * @param int $shop_id
     * @param int $cycle
     * @param int $type
     * @return array
     */
    public function getBillPerDay($shop_id = 0, $cycle = 0, $type = 0)
    {
        $day_array = [];

        if ($type == 1) {
//            $bill = $this->getNegativeMinmaxTime($shop_id);
        } else {
            $bill = $this->getBillMinmaxTime($shop_id, $cycle);
        }

        $mintime = 0;
        $maxtime = 0;

        if ($bill) {
            $mintime = isset($bill['min_time']) & !empty($bill['min_time']) ? $bill['min_time'] : $mintime;
            $maxtime = isset($bill['max_time']) & !empty($bill['max_time']) ? $bill['max_time'] : $maxtime;
        }

        if ($mintime && $maxtime) {
            $min_time = TimeRepository::getLocalDate("Y-m-d", $mintime);
            $max_time = TimeRepository::getLocalDate("Y-m-d", $maxtime);

            $min_time = explode("-", $min_time);
            $max_time = explode("-", $max_time);

            $min_year = intval($min_time[0]);
            $max_year = intval($max_time[0]);
            $min_month = intval($min_time[1]);
            $max_month = intval($max_time[1]);
            $min_day = intval($min_time[2]);
            $max_day = intval($max_time[2]);

            $day_number = 0;
            if ($min_year < $max_year) {
                //开始账单的时间年份比最大的账单结束时间年份要小
                $min_count = 12 - $min_month;
                if ($min_count > 0) {
                    for ($i = $min_month; $i <= 12; $i++) {

                        //获取当月天数
                        $days = TimeRepository::getCalDaysInMonth(CAL_GREGORIAN, $i, $min_year);
                        if (!($i == $min_month)) {
                            $day_number += $days;
                        } else {
                            if ($i == $min_month) {
                                $min_day = $days - $min_day;
                                $day_number += $min_day;
                            }
                        }
                    }
                } else {
                    $min_month_day = TimeRepository::getCalDaysInMonth(CAL_GREGORIAN, $min_month, $min_year);
                    $min_day = $min_month_day - $min_day;
                    $day_number += $min_day;
                }

                for ($i = 1; $i <= $max_month; $i++) {

                    /* 获取当月天数 */
                    $days = TimeRepository::getCalDaysInMonth(CAL_GREGORIAN, $i, $max_year);
                    if (!($i == $max_month)) {
                        $day_number += $days;
                    }

                    if ($i == $max_month) {
                        $day_number += $max_day;
                    }
                }
            } else {
                if ($min_month < $max_month) {
                    //开始账单的时间月份比最大的账单结束时间月份要小
                    for ($i = $min_month; $i <= $max_month; $i++) {

                        /* 获取当月天数 */
                        $days = TimeRepository::getCalDaysInMonth(CAL_GREGORIAN, $i, $min_year);

                        if (!($i == $min_month || $i == $max_month)) {
                            $day_number += $days;
                        } else {
                            if ($i == $min_month) {
                                $min_day = $days - $min_day;
                                $day_number += $min_day;
                            }

                            if ($i == $max_month) {
                                $day_number += $max_day;
                            }
                        }
                    }
                } else {
                    if ($max_day > $min_day) {
                        $day_number = $max_day - $min_day - 1;
                    }
                }
            }

            if ($day_number > 0) {
                $idx = 0;
                for ($i = 1; $i <= $day_number; $i++) {
                    $bill_day = TimeRepository::getLocalDate("Y-m-d", $mintime + 24 * 60 * 60 * $i);
                    $bill_day_start = $bill_day . " 00:00:00";
                    $bill_day_end = $bill_day . " 23:59:59";

                    $day_start = TimeRepository::getLocalStrtoTime($bill_day_start);
                    $day_end = TimeRepository::getLocalStrtoTime($bill_day_end);

                    if ($type == 1) {
//                        $bill_id = $this->getNegativeBillId($shop_id, $day_start, $day_end);
                    } else {
                        $bill_id = $this->getBillId($shop_id, $cycle, $day_start, $day_end);
                    }

                    if (!$bill_id && ($mintime <= $day_start && $maxtime >= $day_end)) {
                        $day_array[$idx]['last_year_start'] = $bill_day_start;
                        $day_array[$idx]['last_year_end'] = $bill_day_end;
                    }

                    $idx++;
                }
            }
        }

        return $day_array;
    }

    /**
     * 账单
     * 类型：每周（七天）
     * 生成账单列表
     *
     * @param int $shop_id
     * @param int $cycle
     * @return array
     */
    public function getBillSevenDay($shop_id = 0, $cycle = 0)
    {
        $bill = $this->getBillMinmaxTime($shop_id, $cycle);

        $mintime = 0;
        $maxtime = 0;

        $day_array = [];
        if ($bill) {
            $mintime = isset($bill['min_time']) & !empty($bill['min_time']) ? $bill['min_time'] : $mintime;
            $maxtime = isset($bill['max_time']) & !empty($bill['max_time']) ? $bill['max_time'] : $maxtime;
        }

        $week_array = [];
        if ($mintime && $maxtime) {
            $min_time = TimeRepository::getLocalDate("Y-m-d", $mintime);
            $max_time = TimeRepository::getLocalDate("Y-m-d", $maxtime);

            $min_time = explode("-", $min_time);
            $max_time = explode("-", $max_time);

            $min_year = intval($min_time[0]);
            $max_year = intval($max_time[0]);
            $min_month = intval($min_time[1]);
            $max_month = intval($max_time[1]);

            $weeks = [];
            $min_weeks = [];
            $max_weeks = [];
            if ($min_year < $max_year) {
                $min_count = 12 - $min_month;
                for ($i = 0; $i <= $min_count; $i++) {
                    $minmonth = $min_month + $i;
                    $min_weeks[] = $this->getWeeksList($min_year . "-" . $minmonth);
                }

                for ($i = 1; $i <= $max_month; $i++) {
                    $max_weeks[] = $this->getWeeksList($max_year . "-" . $i);
                }

                if ($min_weeks && $max_weeks) {
                    $weeks = array_merge($min_weeks, $max_weeks);
                } elseif ($min_weeks) {
                    $weeks = $min_weeks;
                } elseif ($max_weeks) {
                    $weeks = $max_weeks;
                }
            } else {
                if ($min_month < $max_month) {
                    $m_count = $max_month - $min_month;
                    for ($i = 0; $i <= $m_count; $i++) {
                        $month = $min_month + $i;
                        $weeks[] = $this->getWeeksList($max_year . "-" . $month);
                    }
                }
            }

            $max = $maxtime + 7 * 24 * 3600;
            $time = TimeRepository::getGmTime();

            $newWeeks = [];
            if (empty($weeks) && $time > $max) {
                $between_time = $time - $maxtime;
                $differential_time = ($between_time + 1) / (24 * 3600);
                $diff_num = $differential_time > 0 ? $differential_time / 7 : 0;
                $diff_num = (int)$diff_num;

                if ($diff_num) {
                    for ($i = 1; $i <= $diff_num; $i++) {
                        $key = $i - 1;
                        $newWeeks[$key] = ($maxtime + $i * (7 * 24 * 3600));
                    }
                }
            } else {
                if (empty($weeks) && $mintime && $maxtime) {
                    $between_time = $maxtime - $mintime;
                    $differential_time = ($between_time + 1) / (24 * 3600);
                    $diff_num = $differential_time > 0 ? $differential_time / 7 : 0;

                    if ($diff_num) {
                        for ($i = 1; $i < $diff_num; $i++) {
                            if ($i > 1) {
                                $key = $i - 1;
                                $newWeeks[$key] = ($mintime + $i * (7 * 24 * 3600)) - 24 * 3600;
                            }
                        }
                    }
                }
            }

            if (!empty($newWeeks)) {
                foreach ($newWeeks as $key => $val) {
                    $last_year_start = $val - 6 * 24 * 3600;
                    $last_year_end = $val;

                    $day_array[$key]['last_year_start'] = TimeRepository::getLocalDate("Y-m-d", $last_year_start) . " 00:00:00";
                    $day_array[$key]['last_year_end'] = TimeRepository::getLocalDate("Y-m-d", $last_year_end) . " 23:59:59";
                }

                $day_array = array_values($day_array);
            } else {
                if ($weeks) {
                    $start_mintime = $mintime;
                    $end_mintime = $maxtime + 6 * 24 * 3600;

                    foreach ($weeks as $key => $row) {
                        foreach ($row as $keys => $rows) {
                            $start_time = TimeRepository::getLocalStrtoTime($rows[0]);
                            $end_time = TimeRepository::getLocalStrtoTime($rows[1]);

                            if ($start_mintime <= $start_time && $end_mintime >= $end_time) {
                                $week_array[] = $rows;
                            }
                        }
                    }
                }

                $idx = 0;
                if ($week_array) {
                    foreach ($week_array as $wkey => $wrow) {
                        $bill_day_start = $wrow[0] . " 00:00:00";
                        $bill_day_end = $wrow[1] . " 23:59:59";

                        $day_start = TimeRepository::getLocalStrtoTime($bill_day_start);
                        $day_end = TimeRepository::getLocalStrtoTime($bill_day_end);

                        $bill_id = $this->getBillId($shop_id, $cycle, $day_start, $day_end);
                        if (!$bill_id && ($mintime <= $day_start && $maxtime >= $day_end)) {
                            $day_array[$idx]['last_year_start'] = $bill_day_start;
                            $day_array[$idx]['last_year_end'] = $bill_day_end;
                        }

                        $idx++;
                    }
                }
            }
        }

        return $day_array;
    }

    /**
     * 账单
     * 类型：按月
     * 生成账单列表
     *
     * @param int $shop_id
     * @param int $cycle
     * @return array
     */
    public function getBillOneMonth($shop_id = 0, $cycle = 0)
    {
        $bill = $this->getBillMinmaxTime($shop_id, $cycle);

        $mintime = 0;
        $maxtime = 0;

        $day_array = [];
        if ($bill) {
            $mintime = isset($bill['min_time']) & !empty($bill['min_time']) ? $bill['min_time'] : $mintime;
            $maxtime = isset($bill['max_time']) & !empty($bill['max_time']) ? $bill['max_time'] : $maxtime;
        }

        if ($mintime && $maxtime) {
            $min_time = TimeRepository::getLocalDate("Y-m-d", $mintime);
            $max_time = TimeRepository::getLocalDate("Y-m-d", $maxtime);

            $min_time = explode("-", $min_time);
            $max_time = explode("-", $max_time);

            $min_year = intval($min_time[0]);
            $max_year = intval($max_time[0]);
            $min_month = intval($min_time[1]);
            $max_month = intval($max_time[1]);

            if ($min_year < $max_year) {

                //开始账单的时间年份比最大的账单结束时间年份要小
                $iidx = 0;
                $min_array = [];
                $min_count = 12 - $min_month;
                if ($min_count > 0) {
                    for ($i = $min_month; $i <= 12; $i++) {

                        /* 获取当月天数 */
                        $days = TimeRepository::getCalDaysInMonth(CAL_GREGORIAN, $i, $min_year);

                        $nowMonth = $i;
                        if ($nowMonth <= 9) {
                            $nowMonth = "0" . $nowMonth;
                        }

                        $last_year_start = $min_year . "-" . $nowMonth . "-01 00:00:00"; //上一个月的第一天
                        $last_year_end = $min_year . "-" . $nowMonth . "-" . $days . " 23:59:59"; //上一个月的最后一天

                        $day_start = TimeRepository::getLocalStrtoTime($last_year_start);
                        $day_end = TimeRepository::getLocalStrtoTime($last_year_end);

                        $bill_id = $this->getBillId($shop_id, $cycle, $day_start, $day_end);
                        if (!$bill_id && ($mintime <= $day_start && $maxtime >= $day_end)) {
                            $min_array[$iidx]['last_year_start'] = $last_year_start;
                            $min_array[$iidx]['last_year_end'] = $last_year_end;
                        }

                        $iidx++;
                    }
                } else {
                    $last_year_start = $min_year . "-12-01 00:00:00"; //上一个月的第一天
                    $last_year_end = $min_year . "-12-31 23:59:59"; //上一个月的最后一天
                    $day_start = TimeRepository::getLocalStrtoTime($last_year_start);
                    $day_end = TimeRepository::getLocalStrtoTime($last_year_end);

                    $bill_id = $this->getBillId($shop_id, $cycle, $day_start, $day_end);
                    if (!$bill_id && ($mintime <= $day_start && $maxtime >= $day_end)) {
                        $min_array[$iidx]['last_year_start'] = $last_year_start;
                        $min_array[$iidx]['last_year_end'] = $last_year_end;
                    }
                }

                $aidx = 0;
                $max_array = [];
                for ($i = 1; $i <= $max_month; $i++) {

                    /* 获取当月天数 */
                    $days = TimeRepository::getCalDaysInMonth(CAL_GREGORIAN, $i, $max_year);

                    $nowMonth = $i;
                    if ($nowMonth <= 9) {
                        $nowMonth = "0" . $nowMonth;
                    }

                    $last_year_start = $max_year . "-" . $nowMonth . "-01 00:00:00"; //上一个月的第一天
                    $last_year_end = $max_year . "-" . $nowMonth . "-" . $days . " 23:59:59"; //上一个月的最后一天

                    $day_start = TimeRepository::getLocalStrtoTime($last_year_start);
                    $day_end = TimeRepository::getLocalStrtoTime($last_year_end);

                    $bill_id = $this->getBillId($shop_id, $cycle, $day_start, $day_end);
                    if (!$bill_id && ($mintime <= $day_start && $maxtime >= $day_end)) {
                        $max_array[$aidx]['last_year_start'] = $last_year_start;
                        $max_array[$aidx]['last_year_end'] = $last_year_end;
                    }

                    $aidx++;
                }

                if ($min_array && $max_array) {
                    $day_array = array_merge($min_array, $max_array);
                } elseif ($min_array) {
                    $day_array = $min_array;
                } elseif ($max_array) {
                    $day_array = $max_array;
                }
            } else {
                if ($min_month < $max_month) {
                    $idx = 0;
                    //开始账单的时间月份比最大的账单结束时间月份要小
                    for ($i = $min_month; $i <= $max_month; $i++) {
                        /* 获取当月天数 */
                        $days = TimeRepository::getCalDaysInMonth(CAL_GREGORIAN, $i, $min_year);

                        $nowMonth = $i;
                        if ($nowMonth <= 9) {
                            $nowMonth = "0" . $nowMonth;
                        }

                        $last_year_start = $min_year . "-" . $nowMonth . "-01 00:00:00"; //上一个月的第一天
                        $last_year_end = $min_year . "-" . $nowMonth . "-" . $days . " 23:59:59"; //上一个月的最后一天

                        $day_start = TimeRepository::getLocalStrtoTime($last_year_start);
                        $day_end = TimeRepository::getLocalStrtoTime($last_year_end);

                        $bill_id = $this->getBillId($shop_id, $cycle, $day_start, $day_end);
                        if (!$bill_id && ($mintime <= $day_start && $maxtime >= $day_end)) {
                            $day_array[$idx]['last_year_start'] = $last_year_start;
                            $day_array[$idx]['last_year_end'] = $last_year_end;
                        }

                        $idx++;
                    }
                }
            }
        }

        return $day_array;
    }



    /**
     * 账单
     * 获取商家账单最小开始时间
     * 获取商家账单最大结束时间
     *
     * @param int $shop_id
     * @param int $cycle
     * @return mixed
     */
    public function getBillMinmaxTime($shop_id = 0, $cycle = 0)
    {
        $bill = ShopBill::selectRaw("MIN(start_date) AS min_time, MAX(end_date) AS max_time")
            ->where('shop_id', $shop_id)
//            ->where('bill_cycle', $cycle)
            ->get()->toArray();

        return $bill;
    }

    /**
     * 账单ID
     * 按类型，根据开始时间和结束时间
     *
     * @param $shop_id
     * @param $cycle
     * @param $day_start
     * @param $day_end
     * @return int
     */
    public function getBillId($shop_id, $cycle, $day_start, $day_end)
    {
        $id = ShopBill::where('start_date', $day_start)
            ->where('end_date', $day_end)
//            ->where('bill_cycle', $cycle)
            ->where('shop_id', $shop_id)
            ->value('id');
        $id = $id ? $id : 0;

        return $id;
    }

    /**
     * 账单
     * 当前月的周数列表
     * @param $month 
     * @return array
     */
    public function getWeeksList($month)
    {
        $weekinfo = [];
        $end_date = TimeRepository::getLocalDate('d', TimeRepository::getLocalStrtoTime($month . ' +1 month -1 day'));
        for ($i = 1; $i < $end_date; $i = $i + 7) {
            $w = TimeRepository::getLocalDate('N', TimeRepository::getLocalStrtoTime($month . '-' . $i));
            $weekinfo[] = [TimeRepository::getLocalDate('Y-m-d', TimeRepository::getLocalStrtoTime($month . '-' . $i . ' -' . ($w - 1) . ' days')), TimeRepository::getLocalDate('Y-m-d', TimeRepository::getLocalStrtoTime($month . '-' . $i . ' +' . (7 - $w) . ' days'))];
        }
        return $weekinfo;
    }


    /**
     * 运算订单的佣金金额
     *
     * @param $seller_id
     * @param $start_time
     * @param $end_time
     * @param $commission_model
     * @param $proportion
     * @param array $order_list
     * @return mixed
     */
    public function getBillOrderAmount($seller_id, $start_time, $end_time, $commission_model, $proportion, $order_list = [])
    {
        $chargeoff_status = isset($chargeoff_status) ?: 0;

        $list = SellerBillOrder::selectRaw("*, (" . $this->orderCommissionTotalField() . ") AS total_fee, (" . $this->orderCommissionField() . ") AS commission_total_fee, (" . $this->orderActivityFieldAdd() . ") AS activity_fee")
            ->where('seller_id', $seller_id)
            ->where('bill_id', 0)
            ->where('confirm_take_time', '>=', $start_time)
            ->where('confirm_take_time', '<=', $end_time);

        if (!empty($order_list)) {
            $order_list = BaseRepository::getExplode($order_list);
            $list = $list->whereIn('order_id', $order_list);
        } else {
            $list = $this->orderCommonService->orderQuerySelect($list, 'confirm_take');

            $list = $list->whereHasIn('getOrder', function ($query) {
                $query->where('is_settlement', 0);
            });
        }

        if ($chargeoff_status <= 1) {
            $list = $list->whereIn('chargeoff_status', [0, 1]);
        } else {
            $list = $list->where('chargeoff_status', $chargeoff_status);
        }

        $list = $list->with([
            'getSellerBillGoodsList' => function ($query) {
                $query->select('order_id', 'drp_money');
            }
        ]);

        $list = $list->orderBy('order_id', 'desc');

        $list = BaseRepository::getToArrayGet($list);

        $arr['gain_commission'] = 0;
        $arr['should_amount'] = 0;

        /* 格式话数据 */
        if ($list) {
            foreach ($list as $key => $value) {
                $goods_list = $value['get_seller_bill_goods_list'];
                $drp_money = BaseRepository::getSum($goods_list, 'drp_money');

                if (file_exists(MOBILE_DRP)) {
                    if ($value['drp_money'] <= 0 && $drp_money > 0) {
                        SellerBillOrder::where('order_id', $value['order_id'])->update([
                            'drp_money' => $drp_money
                        ]);

                        $value['drp_money'] = $drp_money;
                    }
                }

                /* 商品佣金比例 start */
                $order = [
                    'goods_amount' => $value['goods_amount'],
                    'activity_fee' => $value['activity_fee']
                ];

                $goods_rate = $this->getAloneGoodsRate($value['order_id'], 0, $order);

                if ($goods_rate) {
                    /**
                     * 减去商品单独佣金比例的商品总金额
                     * 剩余有效订单参与店铺佣金的金额
                     */
                    $value['commission_total_fee'] = $value['commission_total_fee'] - $goods_rate['total_fee'];

                    /**
                     * 扣除单独设置商品佣金比例的商品总金额
                     */
                    if ($goods_rate['total_fee']) {
                        if ($value['commission_total_fee'] < 0) {
                            $value['commission_total_fee'] = 0;
                        }
                    }
                }
                /* 商品佣金比例 end */

                $goods_rate['gain_commission'] = $goods_rate && isset($goods_rate['gain_commission']) ? $goods_rate['gain_commission'] : 0;
                $goods_rate['should_amount'] = $goods_rate && isset($goods_rate['should_amount']) ? $goods_rate['should_amount'] : 0;

                if ($commission_model > 0) {
                    /**
                     * 分类佣金
                     */
                    $cat_commission = $this->getCatGainShouldAmount($value);

                    $gain_commission = $cat_commission ? $cat_commission['gain_commission'] : 0;
                    $should_amount = $cat_commission ? $cat_commission['should_amount'] : 0;

                    $arr['gain_commission'] += $gain_commission + $goods_rate['gain_commission'];
                    $arr['should_amount'] += $should_amount + $goods_rate['should_amount'];
                } else {

                    /**
                     * 店铺佣金
                     */
                    $commission = $this->getGainShouldAmount($proportion, $value);

                    $commission['gain_commission'] = $commission ? $commission['gain_commission'] : 0;
                    $commission['should_amount'] = $commission ? $commission['should_amount'] : 0;

                    $arr['gain_commission'] += $commission['gain_commission'] + $goods_rate['gain_commission'];
                    $arr['should_amount'] += $commission['should_amount'] + $goods_rate['should_amount'];
                }
            }
        }

        return $arr;
    }

    /**
     * 获取账单金额明细
     *
     * @param int $bill_id
     * @param int $seller_id
     * @param int $proportion
     * @param int $start_time
     * @param int $end_time
     * @param int $chargeoff_status
     * @param int $commission_model
     * @return mixed
     */
    public function getBillAmountDetail($bill_id = 0, $seller_id = 0, $proportion = 100, $start_time = 0, $end_time = 0, $chargeoff_status = 0, $commission_model = 0)
    {
        /**
         * 订单信息
         */
        $order = SellerBillOrder::selectRaw("GROUP_CONCAT(order_id) AS order_list, SUM(drp_money) AS drp_money, SUM((" . $this->orderCommissionTotalField() . ")) AS total_fee, SUM((" . $this->orderCommissionField() . ")) AS commission_total_fee, SUM(return_amount) AS return_amount, SUM(shipping_fee) AS shipping_fee, SUM(return_shippingfee) AS return_shippingfee, SUM(return_rate_fee) AS return_rate_fee, SUM(goods_amount) AS goods_amount, SUM(discount) AS discount, SUM(coupons) AS coupons, SUM(integral_money) AS integral_money, SUM(bonus) AS bonus, SUM(value_card) AS value_card, SUM(rate_fee) AS rate_fee")
            ->where('seller_id', $seller_id)
            ->where('bill_id', 0)
            ->where('confirm_take_time', '>=', $start_time)
            ->where('confirm_take_time', '<=', $end_time);

        $order = $this->orderCommonService->orderQuerySelect($order, 'confirm_take');

        if ($chargeoff_status <= 1) {
            $order = $order->whereIn('chargeoff_status', [0, 1]);
        } else {
            $order = $order->where('chargeoff_status', $chargeoff_status);
        }

        $order = $order->whereHasIn('getOrder', function ($query) {
            $query->where('is_settlement', 0);
        });

        $order = BaseRepository::getToArrayFirst($order);

        if ($order) {
            $order_list = $order['order_list'] ?? [];

            $order['order_list'] = BaseRepository::getExplode($order_list);

            /* 微分销 */
//            if (file_exists(MOBILE_DRP) && $order_list && $order['drp_money'] <= 0) {
//                $drp_money = SellerBillGoods::selectRaw("SUM(drp_money) AS drp_money")->whereIn('order_id', $order['order_list'])->value('drp_money');
//                $drp_money = $drp_money ? $drp_money : 0;
//            } else {
//                $drp_money = 0;
//            }

            $order['drp_money'] = 0; //$drp_money;

            $order['bill_id'] = $bill_id; //账单ID
            $order['return_amount'] = isset($order['return_amount']) ? $order['return_amount'] : 0;
            $order['return_shippingfee'] = isset($order['return_shippingfee']) ? $order['return_shippingfee'] : 0;
            $order['return_rate_fee'] = isset($order['return_rate_fee']) ? $order['return_rate_fee'] : 0;
            $order['integral_money'] = isset($order['integral_money']) ? $order['integral_money'] : 0;
            $order['order_amount'] = isset($order['total_fee']) ? $order['total_fee'] - $order['discount'] : 0;
            $order['shipping_amount'] = isset($order['shipping_fee']) ? $order['shipping_fee'] : 0;
            $order['drp_money'] = isset($order['drp_money']) ? $order['drp_money'] : 0;
            $order['rate_fee'] = isset($order['rate_fee']) ? $order['rate_fee'] : 0;
            $order['commission_model'] = $commission_model;

            $bill_order = $this->getBillOrderAmount($seller_id, $start_time, $end_time, $commission_model, $proportion, $order['order_list']);
            $order['gain_commission'] = $bill_order['gain_commission'];
            $order['should_amount'] = $bill_order['should_amount'];

            $order['start_time_format'] = TimeRepository::getLocalDate($this->config['time_format'], $start_time);
            $order['end_time_format'] = TimeRepository::getLocalDate($this->config['time_format'], $end_time);
        }

        return $order;
    }

    /**
     * 生成查询佣金总金额的字段
     * @param string $alias order表的别名（包括.例如 o.）
     * @return  string
     *  + {$alias}shipping_fee  不含运费
     */
    public function orderCommissionField($alias = '')
    {
        return "   {$alias}goods_amount + {$alias}tax" .
            " + {$alias}insure_fee + {$alias}pay_fee + {$alias}pack_fee" .
            " + {$alias}card_fee - {$alias}discount - {$alias}coupons - {$alias}integral_money - {$alias}bonus ";
    }

    /**
     * 生成查询订单总金额的字段
     *
     * @return string
     */
    public function orderCommissionTotalField()
    {
        return " goods_amount + tax + shipping_fee + insure_fee + pay_fee + pack_fee + card_fee ";
    }
}