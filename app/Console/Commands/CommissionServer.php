<?php

namespace App\Console\Commands;

use App\Models\BackOrder;
use App\Models\OrderAction;
use App\Models\OrderInfo;
use App\Models\OrderSettlementLog;
use App\Models\SellerBillGoods;
use App\Models\SellerBillOrder;
use App\Models\SellerCommissionBill;
use App\Models\SellerNegativeBill;
use App\Models\Shop;
use App\Repositories\Common\BaseRepository;
use App\Repositories\Common\LrwRepository;
use App\Repositories\Common\TimeRepository;
use App\Services\Commission\CommissionManageService;
use App\Services\Commission\CommissionService;
use App\Services\Order\OrderCommonService;
use App\Services\Order\OrderRefoundService;
use Illuminate\Console\Command;

class CommissionServer extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:commission {action=bill} {--show=0}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Commission command';

    protected $commissionService;
    protected $commissionManageService;
    protected $orderCommonService;
    protected $lrwRepository;
    protected $orderRefoundService;
    protected $config;

    public function __construct(
        CommissionService $commissionService,
        CommissionManageService $commissionManageService,
        OrderCommonService $orderCommonService,
        LrwRepository $lrwRepository,
        OrderRefoundService $orderRefoundService
    ) {
        parent::__construct();
        $this->commissionService = $commissionService;
        $this->commissionManageService = $commissionManageService;
        $this->orderCommonService = $orderCommonService;
        $this->lrwRepository = $lrwRepository;
        $this->orderRefoundService = $orderRefoundService;
//        $this->config = config('shop');
    }

    /**
     * @throws \Exception
     */
    public function handle()
    {
        $action = $this->argument('action');
        $show = (int)$this->option('show'); // 用--开头指定参数名

        if ($action == 'bill') {
            $this->checkBill();
        } elseif ($action == 'charge') {
            $this->commissionBillList();
        } elseif ($action == 'settlement') {
            $this->commissionOrderSettlement($show);
        } elseif ($action == 'sorder') {
            $this->getSellerOrder();
        } elseif ($action == 'replacement') {
            /* 账单补单[补账单记录]功能 */
            $this->CommissionReplacementOrder();
        } elseif ($action == 'addCommission') {
            /* 账单补单[补账单生成订单信息]功能 */
            $this->OneOrderCommissionAdd();
        } elseif ($action == 'confirmTakeTime') {
            $this->setBillOrderConfirmTakeTime();
        } elseif ($action == 'orderDrpMoney') {
            $this->setBillOrderDrpMoney();
        }
    }

    public function checkBill($shop_id = 0, $shipping_time = 0)
    {
        $arr = $this->getShopList($shop_id);
        $shop_list = $arr['shop_list'];
        $operator = $arr['operator'];

        $last_year_start = 0;
        $last_year_end = 0;

        $notime = TimeRepository::getGmTime();
        $year = TimeRepository::getLocalDate("Y", $notime); //当前年份

        $now_date = TimeRepository::getLocalDate("Y-m-d", $notime); //当前年月份
        $year_exp = explode("-", $now_date);
        $nowYear = intval($year_exp[0]); //当前年份
        $nowMonth = intval($year_exp[1]); //当前月份
        $nowDay = intval($year_exp[2]); //当前日期

        if ($shop_list) {
            foreach ($shop_list as $key => $row) {

//                if (empty($row['percent_value'])) {
//                    $merchants_percent = MerchantsPercent::where('percent_value', 100);
//                    $merchants_percent = BaseRepository::getToArrayFirst($merchants_percent);
//
//                    if (!$merchants_percent) {
//                        $merchants_percent = MerchantsPercent::selectRaw('percent_id, IF(percent_value < 100, MAX(percent_value), 100) AS percent_value')
//                            ->where('percent_value', '<>', 100)
//                            ->orderBy('percent_id', 'desc');
//                        $merchants_percent = BaseRepository::getToArrayFirst($merchants_percent);
//                    }
//
//                    $serverOther = array(
//                        'user_id' => $row['shop_id'],
//                        'suppliers_percent' => $merchants_percent['percent_id'],
//                        'suppliers_desc' => '',
//                        'commission_model' => 0,
//                        'cycle' => 0,
//                        'bill_freeze_day' => 7
//                    );
//
//                    $row['percent_value'] = $merchants_percent['percent_value'];
//                    $row['cycle'] = $serverOther['cycle'];
//
//                    MerchantsServer::insert($serverOther);
//                }

                $is_charge = 1;

                /* ------------------------------------------------------ */
                //-- 按天数 3日结
                /* ------------------------------------------------------ */
                if ($row['cycle'] == SellerCommissionBill::THREE_DAY) {
                    $day_array = $this->commissionManageService->getBillDaysNumber($row['shop_id'], $row['cycle']);

                    if (empty($day_array)) {
                        $end_time = SellerCommissionBill::where('shop_id', $row['shop_id'])
                            ->where('bill_cycle', $row['cycle'])
                            ->max('end_time');
                        $end_time = $end_time ? $end_time : 0;
                        if ($end_time) {
                            $row['bill_time'] = $end_time;
                        }

                        $last_year_start = TimeRepository::getLocalDate("Y-m-d 00:00:00", $row['bill_time']);
                        $bill_time = $row['bill_time'] + ($row['day_number'] - 1) * 24 * 60 * 60;
                        $last_year_end = TimeRepository::getLocalDate("Y-m-d 23:59:59", $bill_time);

                        $thistime = TimeRepository::getGmTime();
                        $bill_end_time = TimeRepository::getLocalStrtoTime($last_year_end);

                        if ($thistime <= $bill_end_time) {
                            $is_charge = 0;
                        }

                        $day_array[0]['last_year_start'] = $last_year_start;
                        $day_array[0]['last_year_end'] = $last_year_end;
                    }
                }

                /* ------------------------------------------------------ */
                //-- 按年
                /* ------------------------------------------------------ */
//                elseif ($row['cycle'] == 6) {
//                    $day_array = $this->commissionManageService->getBillOneYear($row['shop_id'], $row['cycle']);
//
//                    if (empty($day_array)) {
//                        $last_year_start = ($year - 1) . "-01-01 00:00:00"; //去年开始的第一天
//                        $last_year_end = ($year - 1) . "-12-31 23:59:59";   //去年结束的最后一天
//
//                        $day_array[0]['last_year_start'] = $last_year_start;
//                        $day_array[0]['last_year_end'] = $last_year_end;
//                    }
//                }

                /* ------------------------------------------------------ */
                //-- 6个月
                /* ------------------------------------------------------ */
//                elseif ($row['cycle'] == 5) {
//                    $day_array = $this->commissionManageService->getBillHalfYear($row['shop_id'], $row['cycle']);
//
//                    if (empty($day_array)) {
//                        /* 判断当前月份是否大于6月份，是否已是七月份 */
//                        if ($nowMonth > 6) {
//                            $last_year_start = $year . "-01-01 00:00:00"; //当前年份开始的第一天
//                            $last_year_end = $year . "-06-30 23:59:59";   //当前年份结束的最后一天
//                        } else {
//
//                            /* 获取去年下半年的时间段 */
//                            $lastYear = $nowYear - 1;
//
//                            $last_year_start = $lastYear . "-07-01 00:00:00"; //去年后半年开始的第一天
//                            $last_year_end = $lastYear . "-12-31 23:59:59";   //后半年结束的最后一天
//                        }
//
//                        $day_array[0]['last_year_start'] = $last_year_start;
//                        $day_array[0]['last_year_end'] = $last_year_end;
//                    }
//                }

                /* ------------------------------------------------------ */
                //-- 1个季度
                /* ------------------------------------------------------ */
//                elseif ($row['cycle'] == 4) {
//                    $day_array = $this->commissionManageService->getBillQuarter($row['shop_id'], $row['cycle']);
//
//                    if (empty($day_array)) {
//                        if ($nowMonth > 3 && $nowMonth <= 6) {
//                            /* 当前第一季度时间段 */
//                            $last_year_start = $nowYear . "-01-01 00:00:00"; //当前第一季度开始的第一天
//                            $last_year_end = $nowYear . "-03-31 23:59:59";   //当前第一季度结束的最后一天
//                        } elseif ($nowMonth > 6 && $nowMonth <= 9) {
//                            /* 当前第二季度时间段 */
//                            $last_year_start = $nowYear . "-04-01 00:00:00"; //当前第二季度开始的第一天
//                            $last_year_end = $nowYear . "-06-30 23:59:59";   //当前第二季度结束的最后一天
//                        } elseif ($nowMonth > 9 && $nowMonth <= 12) {
//                            /* 当前第三季度时间段 */
//                            $last_year_start = $nowYear . "-07-01 00:00:00"; //当前第三季度开始的第一天
//                            $last_year_end = $nowYear . "-09-30 23:59:59";   //当前第三季度结束的最后一天
//                        } elseif ($nowMonth <= 3) {
//                            /* 当前第四季度时间段 */
//                            $last_year_start = $nowYear - 1 . "-10-01 00:00:00"; //当前第四季度开始的第一天
//                            $last_year_end = $nowYear - 1 . "-12-31 23:59:59";   //当前第四季度结束的最后一天
//                        }
//
//                        $day_array[0]['last_year_start'] = $last_year_start;
//                        $day_array[0]['last_year_end'] = $last_year_end;
//                    }
//                }



                /* ------------------------------------------------------ */
                //-- 15天（半个月）
                /* ------------------------------------------------------ */
//                elseif ($row['cycle'] == 2) {
//                    $day_array = $this->commissionManageService->getBillHalfMonth($row['shop_id'], $row['cycle']);
//
//                    if (empty($day_array)) {
//                        $lastDay = TimeRepository::getLocalDate('Y-m-t');
//                        $lastDay = explode("-", $lastDay);
//                        $halfDay = intval($lastDay[2] / 2);
//
//                        if ($nowDay > $halfDay) {
//                            $last_year_start = $lastDay[0] . "-" . $lastDay[1] . "-01 00:00:00"; //当前月开始的第一天
//                            $last_year_end = $lastDay[0] . "-" . $lastDay[1] . "-" . $halfDay . " 23:59:59"; //当前月开始的第一天
//                        } else {
//                            $lastMonth_firstDay = $nowYear . "-" . $nowMonth . "-01 00:00:00";
//                            $lastMonth_lastDay = TimeRepository::getLocalDate('Y-m-d', TimeRepository::getLocalStrtoTime("$lastMonth_firstDay +1 month -1 day")) . " 23:59:59";
//
//                            $lastMonth = TimeRepository::getLocalDate('Y-m-d', TimeRepository::getLocalStrtoTime("$lastMonth_firstDay +1 month -1 day"));
//                            $lastMonth = explode("-", $lastMonth);
//                            $halfMonth = intval($lastMonth[2] / 2);
//                            $middleMonth = $lastMonth[0] . "-" . $lastMonth[1] . "-" . ($halfMonth + 1);
//
//                            $middleMonth_firstDay = $middleMonth . " 00:00:00";
//                            $last_year_start = $middleMonth_firstDay;   //当前月月中的天数日期
//                            $last_year_end = $lastMonth_lastDay;    //上一个月的最后一天（以当前是5月15号之前运算）
//                        }
//                        $day_array[0]['last_year_start'] = $last_year_start;
//                        $day_array[0]['last_year_end'] = $last_year_end;
//                    }
//                }

                /* ------------------------------------------------------ */
                //-- 七天(按一个礼拜)
                /* ------------------------------------------------------ */
                elseif ($row['cycle'] == SellerCommissionBill::WEEK) {
                    $day_array = $this->commissionManageService->getBillSevenDay($row['shop_id'], $row['cycle']);

                    if (empty($day_array)) {
                        $week = TimeRepository::getLocalDate('w'); //当前月的日期本周
                        $thisWeekMon = TimeRepository::getLocalStrtoTime("+ 1 - {$week} days"); //本周礼拜一
                        $lastWeekMon = 7 * 24 * 60 * 60; //上个礼拜一的时间
                        $lastWeeksun = 1 * 24 * 60 * 60; //上个礼拜日的时间

                        $lastWeekMon = $thisWeekMon - $lastWeekMon;
                        $lastWeeksun = $thisWeekMon - $lastWeeksun;

                        $last_year_start = TimeRepository::getLocalDate('Y-m-d 00:00:00', $lastWeekMon);
                        $last_year_end = TimeRepository::getLocalDate('Y-m-d 23:59:59', $lastWeeksun);
                        $day_array[0]['last_year_start'] = $last_year_start;
                        $day_array[0]['last_year_end'] = $last_year_end;
                    }
                }

                /* ------------------------------------------------------ */
                //-- 每天
                /* ------------------------------------------------------ */
                elseif ($row['clearing_cycle'] == SellerCommissionBill::DAY) {
                    $day_array = $this->commissionManageService->getBillPerDay($row['shop_id'], $row['cycle']);

                    if (empty($day_array)) {
                        $last_year_start = TimeRepository::getLocalDate("Y-m-d 00:00:00", TimeRepository::getLocalStrtoTime("-1 day"));
                        $last_year_end = TimeRepository::getLocalDate("Y-m-d 23:59:59", TimeRepository::getLocalStrtoTime("-1 day"));
                        $day_array[0]['last_year_start'] = $last_year_start;
                        $day_array[0]['last_year_end'] = $last_year_end;
                    }
                }

                /* ------------------------------------------------------ */
                //-- 1个月
                /* ------------------------------------------------------ */
                else {
                    $day_array = $this->commissionManageService->getBillOneMonth($row['shop_id'], $row['cycle']);

                    if (empty($day_array)) {
                        if ($nowMonth > 1) {
                            $nowMonth = $nowMonth - 1;
                        }

                        /* 获取当月天数 */
                        $days = TimeRepository::getCalDaysInMonth(CAL_GREGORIAN, $nowMonth, $nowYear);

                        if ($nowMonth <= 9) {
                            $newNowMonth = "0" . $nowMonth;
                        } else {
                            $newNowMonth = $nowMonth;
                        }

                        $last_year_start = $nowYear . "-" . $newNowMonth . "-01 00:00:00"; //上一个月的第一天
                        $last_year_end = $nowYear . "-" . $newNowMonth . "-" . $days . " 23:59:59"; //上一个月的最后一天

                        $day_array[0]['last_year_start'] = $last_year_start;
                        $day_array[0]['last_year_end'] = $last_year_end;
                    }
                }

                $day_array = $this->CommissionData($row['shop_id'], $shipping_time, $row['cycle'], $day_array, $row['day_number']);

                if ($day_array) {
                    $list = BaseRepository::getArrayChunk($day_array, 5);

                    foreach ($list as $idx => $item) {
                        foreach ($item as $keys => $rows) {
                            $last_year_start = TimeRepository::getLocalStrtoTime($rows['last_year_start']); //时间戳
                            $last_year_end = TimeRepository::getLocalStrtoTime($rows['last_year_end']); //时间戳

                            $bill_count = SellerCommissionBill::where('shop_id', $row['shop_id'])
                                ->where('bill_cycle', $row['cycle'])
                                ->where('start_time', '>=', $last_year_start)
                                ->where('end_time', '<=', $last_year_end)
                                ->count();

                            if ($is_charge == 1 && ($last_year_start > 0 && $last_year_end > 0 && $last_year_start < $last_year_end)) {
                                if ($bill_count <= 0) {
                                    $bill_sn = $this->commissionManageService->getBillOrderSn();

                                    /* 处理重复订单账单号 */
                                    $sn_count = SellerCommissionBill::where('bill_sn', $bill_sn)->count();
                                    if ($sn_count > 0) {
                                        $bill_sn += 1;
                                    }

                                    $other = [
                                        'shop_id' => $row['shop_id'],
                                        'bill_sn' => $bill_sn,
                                        'proportion' => $row['take_rate'], // 佣金比例
                                        'commission_model' => $row['commission_model'] ?? -1, // todo 佣金模式（0：按商家比例 1：按平台分类比例）
                                        'start_time' => $last_year_start,
                                        'end_time' => $last_year_end,
                                        'bill_cycle' => $row['cycle'],
                                        'operator' => $operator
                                    ];
                                    (new SellerCommissionBill())->add($other);
                                }
                            }
                        }

                        sleep(0.3);
                    }
                }

                // todo 暂不执行此处逻辑
//                $this->commissionManageService->negativeBill($row['shop_id']);

                if ($shop_id == 0) {
                    sleep(0.2);
                }
            }
        }
    }

    /**
     * 账单列表
     *
     * @param int $shop_id
     */
    public function commissionBillList($shop_id = 0)
    {
        /* 查询 */
        $row = SellerCommissionBill::where('chargeoff_status', 0);

        if ($shop_id > 0) {
            $row = $row->where('shop_id', $shop_id);
        }

        $time = TimeRepository::getGmTime();

        $row->chunk(10, function ($list) use ($time) {
            foreach ($list as $key => $value) {
                if ($value) {
                    $value = collect($value)->toArray();

                    //未出账单
                    if (empty($value['chargeoff_status'])) {
                        $detail = $this->commissionService->getBillAmountDetail($value['id'], $value['shop_id'], $value['proportion'], $value['start_time'], $value['end_time'], $value['chargeoff_status'], $value['commission_model']);

                        $order_list = $detail['order_list'] ?? [];
                        if (!empty($order_list)) {
                            $this->updateCommission($detail, $value, $time);
                        }
                    }
                }
            }
        });
    }

    /**
     * 更新账单订单佣金
     *
     * @param int $show_string
     */
    public function commissionOrderSettlement($show_string = 0)
    {
        $list = OrderInfo::select('order_id', 'shop_id', 'order_sn', 'is_settlement');
//            ->where('main_count', 0);

        if ($show_string == 0) {
            $list = $list->where('chargeoff_status', '<', 2);
        }

        $list = $this->orderCommonService->orderQuerySelect($list, 'confirm_take');

        $list = BaseRepository::getToArrayGet($list);

        if ($list) {
            foreach ($list as $key => $row) {
                $filter = [
                    'order_sn' => $row['order_sn']
                ];

                /* 微分销 */
                if (file_exists(MOBILE_DRP)) {
//                    $no_settlement = $this->commissionService->merchantsIsSettlement($row['shop_id'], '', $filter);
                } else {
                    $no_settlement = $this->commissionService->merchantsIsSettlement($row['shop_id'], '', $filter);
                }

                $gain_amount = $no_settlement['all_gain_commission'] ?? 0;
                $gain_amount = $this->lrwRepository->changeFloat($gain_amount);

                $actual_amount = $no_settlement['all_price'] ?? 0;
                $actual_amount = $this->lrwRepository->changeFloat($actual_amount);

                $log = [
                    'order_id' => $row['order_id'],
                    'ru_id' => $row['shop_id'],
                    'gain_amount' => $gain_amount,
                    'actual_amount' => $actual_amount,
                    'is_settlement' => $row['is_settlement'],
                    'add_time' => TimeRepository::getGmTime()
                ];

                $count = OrderSettlementLog::where('order_id', $row['order_id'])->count();

                if ($show_string == 1) {
                    if ($count < 1) {
                        (new OrderSettlementLog())->add($log);
                        $this->info("账单订单结算记录数据执行成功。");
                    } else {
                        $this->info("账单订单结算记录数据执行失败，已存在。");
                    }
                } else {
                    if ($count < 1) {
                        (new OrderSettlementLog())->add($log);
                    } else {
                        $log['update_time'] = TimeRepository::getGmTime();
                        OrderSettlementLog::where('order_id', $row['order_id'])->where('is_settlement', 0)
                            ->update($log);
                    }
                }
            }
        }
    }

    /**
     * 查询账单订单数据是否存在
     *
     * 不存在重新插入
     */
    public function getSellerOrder()
    {
        $order_status = [
            defined(OS_CONFIRMED) ? OS_CONFIRMED : 1,
            defined(OS_SPLITED) ? OS_SPLITED : 5,
            defined(OS_RETURNED_PART) ? OS_RETURNED_PART : 7,
            defined(OS_ONLY_REFOUND) ? OS_ONLY_REFOUND : 8
        ];

        $shipping_status = defined(SS_RECEIVED) ? SS_RECEIVED : 2;
        $pay_status = defined(PS_PAYED) ? PS_PAYED : 2;

        $res = OrderInfo::whereIn('order_status', $order_status)
            ->where('shipping_status', $shipping_status)
            ->where('pay_status', $pay_status);
//            ->where('main_count', 0);

        $res = $res->doesntHave('getSellerBillOrder');

        $res = $res->with([
            'getSellerNegativeOrder'
        ]);

        $res = BaseRepository::getToArrayGet($res);

        if ($res) {
            $list = BaseRepository::getArrayChunk($res, 10);
            foreach ($list as $row) {
                foreach ($row as $key => $value) {
                    $value_card = $value['get_value_card_record']['use_val'] ?? '';

                    if (empty($value['get_seller_negative_order'])) {
                        $return_amount_info = $this->orderRefoundService->orderReturnAmount($value['order_id']);
                    } else {
                        $return_amount_info['return_amount'] = 0;
                        $return_amount_info['return_rate_price'] = 0;
                        $return_amount_info['ret_id'] = [];
                    }

                    if ($value['take_time']) { // 确认收货时间
                        $confirm_take_time = $value['take_time'];
                    } else {
                        $log_time = OrderAction::where('order_id', $value['order_id'])->where('shipping_status', $value['shipping_status'])->value('log_time');
                        $log_time = $log_time ? $log_time : 0;

                        if ($log_time) {
                            $confirm_take_time = $log_time;
                        } else {
                            $confirm_take_time = TimeRepository::getGmTime();
                        }

                        OrderInfo::where('order_id', $value['order_id'])->update([
                            'take_time' => $confirm_take_time
                        ]);
                    }

                    if ($value['order_amount'] > 0 && $value['order_amount'] > $value['rate_fee']) {
                        $order_amount = $value['order_amount'] - $value['rate_fee'];
                    } else {
                        $order_amount = $value['order_amount'];
                    }

                    $other = array(
                        'user_id' => $value['user_id'],
                        'shop_id' => $value['shop_id'],
                        'order_id' => $value['order_id'],
                        'order_sn' => $value['order_sn'],
                        'order_status' => $value['order_status'],
                        'shipping_status' => $value['shipping_status'],
                        'pay_status' => $value['pay_status'],
                        'order_amount' => $order_amount,
                        'return_amount' => $return_amount_info['return_amount'],
                        'goods_amount' => $value['goods_amount'],
                        'tax' => $value['tax'],
                        'shipping_fee' => $value['shipping_fee'],
                        'insure_fee' => $value['insure_fee'],
                        'pay_fee' => $value['pay_fee'] ?? 0,
                        'pack_fee' => $value['pack_fee'] ?? 0,
                        'card_fee' => $value['card_fee'] ?? 0,
                        'bonus' => $value['bonus'],
                        'integral_money' => $value['integral_money'] ?? 0,
                        'coupons' => $value['coupons'],
                        'discount' => $value['discount'],
                        'value_card' => $value_card ? $value_card : 0,
                        'money_paid' => $value['money_paid'],
                        'surplus' => $value['surplus'],
                        'confirm_take_time' => $confirm_take_time,
                        'rate_fee' => $value['rate_fee'],
                        'return_rate_fee' => $return_amount_info['return_rate_price']
                    );

                    if ($value['user_id']
//                        && $value['main_count'] == 0
                    ) {
                        $this->commissionService->getOrderBillLog($other);
                        $this->commissionService->setBillOrderReturn($return_amount_info['ret_id'], $other['order_id']);
                    }
                }

                sleep(0.2);
            }
        }
    }

    /**
     * 补单
     *
     * @param int $shop_id
     * @throws \Exception
     */
    private function CommissionReplacementOrder($shop_id = 0)
    {
        $arr = $this->getShopList($shop_id);
        $shop_list = $arr['shop_list'];

        $shop_list = BaseRepository::getArrayChunk($shop_list, 10);

        if ($shop_list) {
            foreach ($shop_list as $key => $val) {
                foreach ($val as $idx => $item) {
                    SellerCommissionBill::where('shop_id', $item['user_id'])->chunk(10, function ($bill) {
                        foreach ($bill as $k => $v) {
                            $order = $this->commissionService->getBillAmountDetail(0, $v['shop_id'], $v['proportion'], $v['start_time'], $v['end_time'], 0, $v['commission_model']);
                            $order_list = $order['order_list'] ?? [];

                            if ($order_list) {
                                $order['shop_id'] = $v['shop_id'];

                                $bill_sn = $this->commissionManageService->getBillOrderSn();

                                /* 处理重复订单账单号 */
                                $sn_count = SellerCommissionBill::where('bill_sn', $bill_sn)->count();
                                if ($sn_count > 0) {
                                    $bill_sn += 1;
                                }

                                $operator = "补充账单";
                                $other = [
                                    'shop_id' => $v['shop_id'],
                                    'bill_sn' => $bill_sn,
                                    'proportion' => $v['proportion'],
                                    'commission_model' => $v['commission_model'],
                                    'start_time' => $v['start_time'],
                                    'end_time' => $v['end_time'],
                                    'bill_cycle' => $v['bill_cycle'],
                                    'operator' => $operator
                                ];

                                $sn_count = SellerCommissionBill::where('shop_id', $v['shop_id'])
                                    ->where('bill_cycle', $v['bill_cycle'])
                                    ->where('start_time', $v['start_time'])
                                    ->where('end_time', $v['end_time'])
                                    ->where('operator', $operator)
                                    ->count();

                                if ($sn_count == 0) {
                                    $bill_id = SellerCommissionBill::insertGetId($other);
                                    $other['id'] = $bill_id;
                                    $other['bill_sn'] = $bill_sn;

                                    $gmtime = TimeRepository::getGmTime();
                                    $this->updateCommission($order, $other, $gmtime);

                                    $this->info($bill_id . '--' . $bill_sn . '--【' . $v['shop_id'] . '】');
                                }
                            }

                            sleep(0.2);
                        }
                    });
                }
            }
        }
    }

    /**
     * 获取商家列表
     *
     * @param int $shop_id
     * @return array
     * @throws \Exception
     */
    private function getShopList($shop_id = 0)
    {
        if ($shop_id > 0) {
            $operator = lang('common.manually_create');

            $res = Shop::where('user_id', $shop_id);
            $shop_list = BaseRepository::getToArrayGet($res);
        } else {
            $count = Shop::where('shop_audit', 1)->count();

            $shop_list = cache('shop_list');
            $shop_list = !is_null($shop_list) ? $shop_list : false;

            $cache_count = $shop_list ? count($shop_list) : 0;

            $is_cache = 0;
            if ($count && $cache_count && $count > $cache_count) {
                cache()->forget('shop_list');
                $is_cache = 1;
            }

            if ($is_cache == 1 || $shop_list === false) {
                $shop_list = $this->commissionService->getCacheShopList();
            }

            $operator = lang('order.order_action_user');
        }

        return $arr = [
            'shop_list' => $shop_list,
            'operator' => $operator
        ];
    }

    /**
     * 更新账单
     *
     * @param array $detail
     * @param array $value
     * @param int $gmtime
     */
    private function updateCommission($detail = [], $value = [], $gmtime = 0)
    {
        $order_list = $detail['order_list'] ?? [];
        $order_list = BaseRepository::getExplode($order_list);

        //出账单，绑定满足账单订单 start
        if ($detail && !empty($order_list) && $value['end_time'] < $gmtime) {
            $other['chargeoff_status'] = 1;
            $other['order_amount'] = $detail['order_amount'];
            $other['shipping_amount'] = $detail['shipping_amount'];
            $other['return_amount'] = $detail['return_amount'];
            $other['return_shippingfee'] = $detail['return_shippingfee'];
            $other['return_rate_fee'] = $detail['return_rate_fee'];
            $other['gain_commission'] = $detail['gain_commission'];
            $other['should_amount'] = $detail['should_amount'];
            $other['drp_money'] = $detail['drp_money'];
            $other['commission_model'] = $detail['commission_model'];
            $other['chargeoff_time'] = TimeRepository::getGmTime();
            $other['rate_fee'] = $detail['rate_fee'];

            SellerCommissionBill::where('id', $value['id'])->update($other);

            /* 更新负账单 */
            if ($other['should_amount'] > 0) {
                $negative_bill = $this->commissionService->getNegativeBllTotal($value['shop_id'], $value['end_time']);

                if (isset($negative_bill['negative_id']) && !empty($negative_bill['negative_id'])) {
                    $is_negative = 0;
                    if ($other['should_amount'] >= $negative_bill['total']) {
                        $negative_id = BaseRepository::getExplode($negative_bill['negative_id']);

                        $negativeOther = [
                            'commission_bill_id' => $value['id'],
                            'commission_bill_sn' => $value['bill_sn']
                        ];

                        $is_negative = SellerNegativeBill::whereIn('id', $negative_id)
                            ->update($negativeOther);
                    }

                    if ($is_negative > 0) {
                        if (isset($negative_bill['total']) && $negative_bill['total'] > 0) {
                            $negativeBillOther['negative_amount'] = $negative_bill['total'];
                            $negativeBillOther['should_amount'] = $other['should_amount'] - $negative_bill['total'];
                            SellerCommissionBill::where('id', $value['id'])->update($negativeBillOther);
                        }
                    }
                }
            }

            $list = SellerBillOrder::select('order_id')->where('confirm_take_time', '>=', $value['start_time'])
                ->where('confirm_take_time', '<=', $value['end_time'])
                ->where('shop_id', $value['shop_id'])
                ->where('chargeoff_status', '<>', 2)
                ->where('bill_id', 0);

            if (!empty($order_list)) {
                $list = $list->whereIn('order_id', $order_list);
            } else {
                $list = $list->whereHasIn('getOrder', function ($query) {
                    $query->where('is_settlement', 0);
                });

                $list = $this->orderCommonService->orderQuerySelect($list, 'confirm_take');
            }

            $list = $list->pluck('order_id');
            $order_list = BaseRepository::getToArray($list);

            if ($order_list) {
                SellerBillOrder::whereIn('order_id', $order_list)->update([
                    'bill_id' => $value['id'],
                    'chargeoff_status' => $other['chargeoff_status']
                ]);

                OrderInfo::whereIn('order_id', $order_list)->update([
                    'chargeoff_status' => $other['chargeoff_status']
                ]);

                BackOrder::whereIn('order_id', $order_list)->update([
                    'chargeoff_status' => $other['chargeoff_status']
                ]);
            }
        }
        //出账单，绑定满足账单订单 end
    }

    public function OneOrderCommissionAdd($shop_id = 0)
    {
        $arr = $this->getShopList($shop_id);
        $shop_list = $arr['shop_list'];

        $shop_list = BaseRepository::getArrayChunk($shop_list, 10);

        if ($shop_list) {
            foreach ($shop_list as $key => $row) {
                foreach ($row as $item => $value) {
                    $shippingTime = SellerBillOrder::where('shop_id', $value['shop_id'])->min('confirm_take_time');

                    $this->checkBill($value['shop_id'], $shippingTime);

                    sleep(0.3);
                }
            }
        }
    }

    /**
     * 返回订单确认收货的账单生成时间
     *
     * @param int $shop_id
     * @param int $shipping_time
     * @param int $cycle
     * @param array $day_array
     * @param int $day_number
     * @return array
     */
    private function CommissionData($shop_id = 0, $shipping_time = 0, $cycle = -1, $day_array = [], $day_number = 0)
    {
        $last_year_start = '';
        $last_year_end = '';
        if ($shipping_time > 0) {
            $year = TimeRepository::getLocalDate("Y", $shipping_time);
            $month = TimeRepository::getLocalDate("m", $shipping_time);
            $year = intval($year);
            $month = intval($month);

            if ($cycle == SellerCommissionBill::DAY) {
                /* 每天 */
                $shipping_time = $shipping_time - (24 * 60 * 60);
                $last_year_start = TimeRepository::getLocalDate("Y-m-d 00:00:00", $shipping_time);
                $last_year_end = TimeRepository::getLocalDate("Y-m-d 23:59:59", $shipping_time);
            } elseif ($cycle == SellerCommissionBill::WEEK) {
                /* 七天(按一个礼拜) */
                $time = TimeRepository::getLocalDate("Y-m-d", $shipping_time);
                $time = TimeRepository::transitionDate($time);

                if ($time === '二') {
                    $shipping_time = $shipping_time - (1 * 24 * 60 * 60);
                } elseif ($time === '三') {
                    $shipping_time = $shipping_time - (2 * 24 * 60 * 60);
                } elseif ($time === '四') {
                    $shipping_time = $shipping_time - (3 * 24 * 60 * 60);
                } elseif ($time === '五') {
                    $shipping_time = $shipping_time - (4 * 24 * 60 * 60);
                } elseif ($time === '六') {
                    $shipping_time = $shipping_time - (5 * 24 * 60 * 60);
                } elseif ($time === '日') {
                    $shipping_time = $shipping_time - (6 * 24 * 60 * 60);
                }

                $last_year_start = $shipping_time - (7 * 24 * 60 * 60);
                $last_year_end = $last_year_start + (6 * 24 * 60 * 60);

                $last_year_start = TimeRepository::getLocalDate("Y-m-d 00:00:00", $last_year_start);
                $last_year_end = TimeRepository::getLocalDate("Y-m-d 23:59:59", $last_year_end);
            }
//            elseif ($cycle == 2) {
//                /* 15天（半个月）*/
//                $day = TimeRepository::getLocalDate("d", $shipping_time);
//
//                if ($day < 15) {
//                    $time = TimeRepository::getLocalDate("Y-m", $shipping_time);
//
//                    $last_year_start = $time . "-01 00:00:00";
//                } else {
//                    if ($month != 1) {
//                        $month = $month - 1;
//                        $last_year_start = $year . '-' . $month . "-01 00:00:00";
//                    } else {
//                        $year = $year - 1;
//                        $last_year_start = $year . '-12-01 00:00:00';
//                    }
//                }
//
//                $time = TimeRepository::getLocalStrtoTime($last_year_start);
//                $time = $time + 14 * 24 * 60 * 60;
//                $last_year_end = TimeRepository::getLocalDate("Y-m-d", $time);
//                $last_year_end = $last_year_end . " 23:59:59";
//            }
            elseif ($cycle == SellerCommissionBill::MONTH) {
                /* 1个月 */
                $time = TimeRepository::getLocalDate("Y-m", $shipping_time);
                $last_year_start = $time . "-01 00:00:00";

                if ($month == 12) {
                    $year = $year + 1;
                    $time = TimeRepository::getLocalStrtoTime($year . "-01-01 00:00:00");
                } else {
                    $month = $month + 1;
                    $time = TimeRepository::getLocalStrtoTime($year . "-" . $month . "-01 00:00:00");
                }

                $time = $time - 24 * 3600;
                $last_year_end = TimeRepository::getLocalDate("Y-m-d 23:59:59", $time);
            }
//            elseif ($cycle == 4) {
//                /* 1个季度 */
//                $last_year_start = $year . "01-01 00:00:00";
//                $last_year_end = $year . "03-31 23:59:59";
//            } elseif ($cycle == 5) {
//                /* 6个月 */
//                $last_year_start = $year . "01-01 00:00:00";
//                $last_year_end = $year . "06-30 23:59:59";
//            } elseif ($cycle == 6) {
//                /* 按年 */
//                $last_year_start = $year . "01-01 00:00:00";
//                $last_year_end = $year . "12-31 23:59:59";
//            }
            elseif ($cycle == SellerCommissionBill::THREE_DAY) {
                /* 按天数 3日结 */
            }

            if ($last_year_start && $last_year_end) {
                $new_day_array[0]['last_year_start'] = $last_year_start;
                $new_day_array[0]['last_year_end'] = $last_year_end;

                $day_array = $new_day_array;
            }
        }

        return $day_array;
    }

    /**
     * 更新账单订单确认收货时间为0订单
     */
    public function setBillOrderConfirmTakeTime()
    {
        SellerBillOrder::where('confirm_take_time', 0)->chunk(10, function ($list) {
            foreach ($list as $key => $value) {
                $confirm_take_time = OrderInfo::where('order_id', $value['order_id'])->value('confirm_take_time');

                SellerBillOrder::where('order_id', $value['order_id'])->update([
                    'take_time' => $confirm_take_time
                ]);

                sleep(0.2);
            }
        });
    }

    /**
     * 更新账单订单分销金额
     */
    private function setBillOrderDrpMoney()
    {
        $res = SellerBillOrder::where('chargeoff_status', '<', 2)->orWhere('bill_id', 0);

        $res->chunk(10, function ($list) {
            foreach ($list as $k => $v) {
                $drp_money = SellerBillGoods::where('order_id', $v->order_id)->sum('drp_money');
                $drp_money = $drp_money ? $drp_money : 0;

                if ($drp_money > 0) {
                    SellerBillOrder::where('id', $v->id)->update([
                        'drp_money' => $drp_money
                    ]);
                }

                sleep(0.2);
            }
        });
    }
}
