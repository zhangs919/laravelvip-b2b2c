<?php

namespace App\Services\Order;

//use App\Exceptions\HttpException;
use App\Models\BackOrder;
//use App\Models\BonusType;
//use App\Models\OrderReturn;
//use App\Models\OrderReturnExtend;
use App\Models\Payment;
//use App\Models\ReturnGoods;
//use App\Models\ReturnImages;
use App\Models\UserBonus;
//use App\Models\ValueCard;
//use App\Models\ValueCardRecord;
use App\Repositories\Common\BaseRepository;
//use App\Repositories\Common\CommonRepository;
use App\Repositories\Common\LrwRepository;
use App\Repositories\Common\TimeRepository;
//use App\Services\Goods\GoodsDataHandleService;

class OrderRefoundService
{
//    protected $commonRepository;
    protected $lrwRepository;
    protected $config;

    public function __construct(
//        CommonRepository $commonRepository,
        LrwRepository $lrwRepository
    )
    {
//        $this->commonRepository = $commonRepository;
        $this->lrwRepository = $lrwRepository;
//        $this->config = config('shop');
    }

    /**
     * 获取退换货图片列表
     *
     * @param array $where
     * @return mixed
     */
//    public function getReturnImagesList($where = [])
//    {
//        $res = ReturnImages::whereRaw(1);
//
//        if (isset($where['user_id'])) {
//            $res = $res->where('user_id', $where['user_id']);
//        }
//
//        if (isset($where['rec_id'])) {
//            $res = $res->where('rec_id', $where['rec_id']);
//        }
//
//        $res = $res->orderBy('id', 'desc');
//
//        $res = BaseRepository::getToArrayGet($res);
//
//        if ($res) {
//            foreach ($res as $key => $image) {
//                $res[$key]['img'] = $image['img_file'];
//                $res[$key]['img_file'] = $this->lrwRepository->getImagePath($image['img_file']);
//            }
//        }
//
//        return $res;
//    }

    /**
     * 是否显示原路退款
     *
     * @param int $pay_id
     * @return bool
     */
//    public function showReturnOnline($pay_id = 0)
//    {
//        if (empty($pay_id)) {
//            return false;
//        }
//
//        $pay_arr = ['alipay', 'wxpay'];
//        $pay_arr_not = ['balance', 'chunsejinrong'];
//        $pay_code = Payment::where('pay_id', $pay_id)->where('enabled', 1)->where('is_online', 1)->value('pay_code');
//
//        if (in_array($pay_code, $pay_arr) && !in_array($pay_code, $pay_arr_not)) {
//            return true;
//        }
//
//        return false;
//    }

    /**
     * 在线退款申请 （第三方在线支付)
     * 说明： 走退换货流程订单
     * @param string $return_sn
     * @param int $refund_amount
     * @param int $refound_surplus 使用余额
     * @return bool
     * @throws HttpException
     */
//    public function refundApply($return_sn = '', $refund_amount = 0, $refound_surplus = 0)
//    {
//        if (empty($return_sn)) {
//            throw new HttpException(trans('admin/order.return_sn_required'), 422);
//        }
//
//        /**
//         * 判断订单是否是在线支付 且 是否支付完成 已退款
//         * 如果支付完成 则可以发起退款申请 接口
//         */
//        $model = OrderReturn::where('return_sn', $return_sn)->where('refound_status', 0); // 未退款的
//        $model = $model->with([
//            'orderInfo' => function ($query) {
//                $query->select('order_id', 'order_sn', 'pay_id', 'pay_status', 'money_paid', 'referer');
//            }
//        ]);
//        $model = $model->first();
//        $return_order = $model ? $model->toArray() : [];
//
//        if (empty($return_order)) {
//            throw new HttpException(trans('admin/order.return_order_not_exists'), 422);
//        }
//
//        $return_order = collect($return_order)->merge($return_order['order_info'])->except('order_info')->all();
//
//        // 是否支持原路退款的 在线支付方式
//        $can_refund = $this->showReturnOnline($return_order['pay_id']);
//        if ($can_refund === false) {
//            throw new HttpException(trans('admin/order.return_order_pay_not_supported'), 422);
//        }
//
//        $pay_status = [
//            PS_PAYED,
//            PS_PAYED_PART,
//            PS_REFOUND_PART
//        ];
//        if (in_array($return_order['pay_status'], $pay_status)) {
//            $pay_code = Payment::where('pay_id', $return_order['pay_id'])->value('pay_code');
//            $pay_code = $pay_code ? $pay_code : '';
//
//            if ($pay_code && strpos($pay_code, 'pay_') === false) {
//                $payObject = CommonRepository::paymentInstance($pay_code);
//                if (!is_null($payObject) && is_callable([$payObject, 'refund'])) {
//                    // 扣除使用余额部分
//                    if ($refund_amount > 0 && $refound_surplus > 0) {
//                        $refund_amount = $refund_amount - $refound_surplus;
//                    }
//
//                    // 同意申请的同时提交退款申请到在线支付官方退款接口 等待结果
//                    $return_order['should_return'] = $refund_amount > 0 ? $refund_amount : $return_order['should_return'];
//
//                    $respond = $payObject->refund($return_order);
//                    if ($respond === true) {
//                        return true;
//                    } else {
//                        throw new HttpException($payObject->errMsg, $payObject->errCode);
//                    }
//                } else {
//                    throw new HttpException(trans('admin/order.return_order_pay_not_exists'), 422);
//                }
//            } else {
//                throw new HttpException(trans('admin/order.return_order_pay_not_exists'), 422);
//            }
//        }
//
//        throw new HttpException(trans('admin/order.return_order_no_pay'), 422);
//    }

    /**
     * 支付原路退款
     * 说明：可以不用走退换货申请流程,但必须要有支付日志 pay_log  pay_trade_data
     *
     * @param array $refundOrder
     * $refundOrder = [
     *      'order_id' => '2018011111',
     *      'pay_id' => '1',
     *      'pay_status' => '2',
     *      'referer' => 'wxapp'
     * ];
     *
     * @param int $refund_amount
     * @return bool
     */
//    public function refoundPay($refundOrder = [], $refund_amount = 0)
//    {
//        if (empty($refundOrder)) {
//            return false;
//        }
//
//        // 是否支持原路退款的 在线支付方式
//        $can_refund = $this->showReturnOnline($refundOrder['pay_id']);
//
//        // 已支付订单
//        if ($can_refund == true && $refundOrder['pay_status'] == PS_PAYED) {
//            $pay_code = Payment::where('pay_id', $refundOrder['pay_id'])->value('pay_code');
//            $pay_code = $pay_code ? $pay_code : '';
//
//            if ($pay_code && strpos($pay_code, 'pay_') === false) {
//                $payObject = CommonRepository::paymentInstance($pay_code);
//                if (!is_null($payObject) && is_callable([$payObject, 'refund'])) {
//                    // 同意申请的同时提交退款申请到在线支付官方退款接口 等待结果
//                    $refundOrder['should_return'] = $refund_amount;
//
//                    $refund = $payObject->refund($refundOrder);
//                    $refund = is_null($refund) ? false : $refund;
//
//                    return $refund;
//                }
//            }
//        }
//
//        return false;
//    }

    /**
     * 订单退款 如果使用储值卡 退还储值卡金额
     * @param int $order_id
     * @return int|mixed
     */
//    public function returnValueCardMoney($order_id = 0)
//    {
//        $row = ValueCardRecord::where('order_id', $order_id)->first();
//        $row = $row ? $row->toArray() : [];
//
//        if ($row) {
//            /* 更新储值卡金额 */
//            ValueCard::where('vid', $row['vc_id'])->increment('card_money', $row['use_val']);
//
//            /* 更新订单使用储值卡金额 */
//            ValueCardRecord::where('vc_id', $row['vc_id'])->where('order_id', $order_id)->where('use_val', '>=', $row['use_val'])->decrement('use_val', $row['use_val']);
//
//            return $row['use_val'];
//        }
//
//        return 0;
//    }

    /**
     * 获取订单退款金额
     * use
     * @param int $order_id
     * @return array
     */
    public function orderReturnAmount($order_id = 0)
    {
        $order_id = BaseRepository::getExplode($order_id);

        $return_amount = 0;
        $return_rate_price = 0;
        $ret_id = [];

        if ($order_id) {
            $row = BackOrder::selectRaw("GROUP_CONCAT(back_id) AS ret_id, SUM(refund_money) AS actual_return, SUM(return_rate_price) AS return_rate_price")
                ->whereIn('order_id', $order_id)
                ->whereIn('back_type', [1, 2]) // 1-退款 2-退款退货
                ->where('refund_status', 1);

            $row = BaseRepository::getToArrayFirst($row);

            if ($row) {
                $row['ret_id'] = $row['ret_id'] ?? [];
                $row['actual_return'] = $row['actual_return'] ?? 0;
                $row['return_rate_price'] = $row['return_rate_price'] ?? 0;

                $return_amount = $row['actual_return'] - $row['return_rate_price'];
                $return_rate_price = $row['return_rate_price'];
                $ret_id = !empty($row['ret_id']) ? BaseRepository::getExplode($row['ret_id']) : [];
            }
        }

        $arr = [
            'return_amount' => $return_amount,
            'return_rate_price' => $return_rate_price,
            'ret_id' => $ret_id
        ];

        return $arr;
    }

    /**
     * 判断退款时需要退回的储值卡余额
     * @param float $refound_amount 退回的余额
     * @param float $should_return
     * @return array               储值卡数组
     */
//    public function judgeValueCardMoney($refound_amount, $should_return, $order_id)
//    {
//        //查询出订单使用的储值卡金额
//        $res = ValueCardRecord::where('order_id', $order_id);
//        $value_card = BaseRepository::getToArrayFirst($res);
//        //查询已经返还的储值卡金额
//        $add_val = ValueCardRecord::where('order_id', $order_id)->sum('add_val');
//        if ($value_card) {
//            $value_card['use_val'] = $value_card['use_val'] - $add_val; //减去已经返还的金额
//            if ($value_card['use_val'] > $should_return) {
//                $value_card['use_val'] = $should_return;
//            }
//            if ($refound_amount < $value_card['use_val'] && empty($add_val)) {
//                //退款金额小于储值卡金额
//                $value_card['use_val'] = $refound_amount;
//            }
//        }
//        return $value_card;
//    }

    /**
     * @param int $return_order_id 退款|退货订单ID
     * @param int $return_order_user_id 退款|退货订单用户ID
     * @param int $return_goods_id 退款|退货订单商品ID
     * @param int $total_fee 订单总金额
     * @param int $refund_amount 应退金额
     * @return bool
     */
//    function return_order_delete_bonus($return_order_id = 0, $return_order_user_id = 0, $return_goods_id = 0, $total_fee = 0, $refund_amount = 0)
//    {
//        if (empty($return_order_user_id)) {
//            return false;
//        }
//
//        //查询和订单相关的红包且未使用的
//        $user_bonus = UserBonus::where('return_order_id', $return_order_id)
//            ->where('user_id', $return_order_user_id)
//            ->where('used_time', '');
//        $user_bonus = BaseRepository::getToArrayGet($user_bonus);
//        if (empty($user_bonus)) {
//            return false;
//        }
//
//        //订单已经退款的金额
//        $actual_return = OrderReturn::where('order_id', $return_order_id)->sum('actual_return');
//        $actual_return = floatval($actual_return);
//
//        foreach ($user_bonus as $value) {
//            $bonus_type = BonusType::where('type_id', $value['bonus_type_id']);
//            $bonus_type = BaseRepository::getToArrayFirst($bonus_type);
//            if (empty($bonus_type)) {
//                continue;
//            }
//
//            //删除按商品发放红包
//            if ($bonus_type['send_type'] == 1 && $value['return_goods_id'] == $return_goods_id) {
//                UserBonus::where('bonus_id', $value['bonus_id'])->delete();
//            } elseif ($bonus_type['send_type'] == 2) {
//                $surplus_order_fee = $total_fee - $refund_amount - $actual_return;
//                //退货或者退款 之后的订单金额小于红包发放金额则删除红包
//                if ($surplus_order_fee < $bonus_type['min_amount']) {
//                    UserBonus::where('bonus_id', $value['bonus_id'])->delete();
//                }
//            }
//        }
//    }

    /**
     * 取得用户退换货商品
     *
     * @param int $user_id
     * @param int $size
     * @param int $start
     * @return array
     * @throws \Exception
     */
//    public function userReturnOrderList($user_id = 0, $size = 0, $start = 0)
//    {
//        $activation_number_type = (intval($this->config['activation_number_type']) > 0) ? intval($this->config['activation_number_type']) : 2;
//
//        $res = OrderReturn::where('user_id', $user_id);
//
//        $res = $res->orderBy('ret_id', 'desc');
//
//        if ($start > 0) {
//            $res = $res->skip($start);
//        }
//        if ($size > 0) {
//            $res = $res->take($size);
//        }
//
//        $res = BaseRepository::getToArrayGet($res);
//
//        $goods_list = [];
//        if ($res) {
//
//            $goods_id = BaseRepository::getKeyPluck($res, 'goods_id');
//            $goodsList = GoodsDataHandleService::GoodsDataList($goods_id, ['goods_id', 'goods_thumb', 'goods_name']);
//
//            $rec_id = BaseRepository::getKeyPluck($res, 'rec_id');
//            $returnGoodsList = OrderDataHandleService::getReturnGoodsDataList($rec_id, ['rec_id', 'goods_name']);
//
//            foreach ($res as $row) {
//
//                $goods = $goodsList[$row['goods_id']] ?? [];
//
//                $row = BaseRepository::getArrayMerge($row, $goods);
//
//                $row['goods_thumb'] = $row['goods_thumb'] ?? '';
//
//                $goods_name = $returnGoodsList[$row['rec_id']]['goods_name'];
//                $row['goods_name'] = $goods_name ? $goods_name : $row['goods_name'] ?? '';
//
//                $row['goods_thumb'] = $this->lrwRepository->getImagePath($row['goods_thumb']);
//                $row['apply_time'] = TimeRepository::getLocalDate($this->config['time_format'], $row['apply_time']);
//                $row['should_return'] = $this->lrwRepository->getPriceFormat($row['should_return'], false);
//
//                $row['order_status'] = '';
//                if ($row['return_status'] == 0 && $row['refound_status'] == 0) {
//                    //  提交退换货后的状态 由用户寄回
//                    $row['order_status'] .= "<span>" . lang('user.user_return') . "</span>";
//                } elseif ($row['return_status'] == 1) {
//                    //退换商品收到
//                    $row['order_status'] .= "<span>" . lang('user.get_goods') . "</span>";
//                } elseif ($row['return_status'] == 2) {
//                    //换货商品寄出 （分单）
//                    $row['order_status'] .= "<span>" . lang('user.send_alone') . "</span>";
//                } elseif ($row['return_status'] == 3) {
//                    //换货商品寄出
//                    $row['order_status'] .= "<span>" . lang('user.send') . "</span>";
//                } elseif ($row['return_status'] == 4) {
//                    //完成
//                    $row['order_status'] .= "<span>" . lang('user.complete') . "</span>";
//                } elseif ($row['return_status'] == 6) {
//                    //被拒
//                    $row['order_status'] .= "<span>" . lang('user.rf.' . $row['return_status']) . "</span>";
//                } else {
//                    //其他
//                }
//
//                //维修-退款-换货状态
//                if ($row['return_type'] == 0) {
//                    if ($row['return_status'] == 4) {
//                        $row['reimburse_status'] = $GLOBALS['_LANG']['ff'][FF_MAINTENANCE];
//                    } else {
//                        $row['reimburse_status'] = $GLOBALS['_LANG']['ff'][FF_NOMAINTENANCE];
//                    }
//                } elseif ($row['return_type'] == 1) {
//                    if ($row['refound_status'] == 1) {
//                        $row['reimburse_status'] = $GLOBALS['_LANG']['ff'][FF_REFOUND];
//                    } else {
//                        $row['reimburse_status'] = $GLOBALS['_LANG']['ff'][FF_NOREFOUND];
//                    }
//                } elseif ($row['return_type'] == 2) {
//                    if ($row['return_status'] == 4) {
//                        $row['reimburse_status'] = $GLOBALS['_LANG']['ff'][FF_EXCHANGE];
//                    } else {
//                        $row['reimburse_status'] = $GLOBALS['_LANG']['ff'][FF_NOEXCHANGE];
//                    }
//                } elseif ($row['return_type'] == 3) {
//                    if ($row['refound_status'] == 1) {
//                        $row['reimburse_status'] = $GLOBALS['_LANG']['ff'][FF_REFOUND];
//                    } else {
//                        $row['reimburse_status'] = $GLOBALS['_LANG']['ff'][FF_NOREFOUND];
//                    }
//                }
//                $row['activation_type'] = 0;
//                //判断是否支持激活
//                if ($row['return_status'] == 6) {
//                    if ($row['activation_number'] < $activation_number_type) {
//                        $row['activation_type'] = 1;
//                    }
//                }
//
//                $goods_list[] = $row;
//            }
//        }
//
//        return $goods_list;
//    }


    /**
     * 编辑退换货快递信息
     *
     * @param int $user_id
     * @param int $ret_id
     * @param int $back_shipping_name
     * @param string $back_other_shipping
     * @param string $back_invoice_no
     * @return bool
     * @throws HttpException
     */
//    public function editExpress($user_id = 0, $ret_id = 0, $back_shipping_name = 0, $back_other_shipping = '', $back_invoice_no = '')
//    {
//        if (empty($user_id) || empty($ret_id)) {
//            throw new HttpException('parameters of illegal.', 1);
//        }
//
//        $other = [
//            'back_shipping_name' => $back_shipping_name,
//            'back_other_shipping' => $back_other_shipping,
//            'back_invoice_no' => $back_invoice_no
//        ];
//        OrderReturn::where('ret_id', $ret_id)->where('user_id', $user_id)->update($other);
//        return true;
//    }

    /**
     * 取消退换货订单
     *
     * @param int $user_id
     * @param int $ret_id
     * @return bool
     * @throws HttpException
     */
//    public function cancelReturnOrder($user_id = 0, $ret_id = 0)
//    {
//        if (empty($user_id) || empty($ret_id)) {
//            throw new HttpException('parameters of illegal.', 1);
//        }
//
//        /* 查询订单信息，检查状态 */
//        $order = OrderReturn::where('ret_id', $ret_id);
//        $order = BaseRepository::getToArrayFirst($order);
//
//        if (empty($order)) {
//            throw new HttpException(lang('user.return_exist'), 1);
//        }
//
//        // 如果用户ID大于0，检查订单是否属于该用户
//        if ($user_id > 0 && $order['user_id'] != $user_id) {
//            throw new HttpException(lang('user.no_priv'), 1);
//        }
//
//        // 订单状态只能是用户寄回和未退款状态
//        if ($order['return_status'] != RF_APPLICATION && $order['refound_status'] != FF_NOREFOUND) {
//            throw new HttpException(lang('user.return_not_unconfirmed'), 1);
//        }
//
//        //一旦由商家收到退换货商品，不允许用户取消
//        if ($order['return_status'] == RF_RECEIVE) {
//            throw new HttpException(lang('user.current_os_already_receive'), 1);
//        }
//
//        // 商家已发送退换货商品
//        if ($order['return_status'] == RF_SWAPPED_OUT_SINGLE || $order['return_status'] == RF_SWAPPED_OUT) {
//            throw new HttpException(lang('user.already_out_goods'), 1);
//        }
//
//        // 如果付款状态是“已付款”、“付款中”，不允许取消，要取消和商家联系
//        if ($order['refound_status'] == FF_REFOUND) {
//            throw new HttpException(lang('user.have_refound'), 1);
//        }
//
//        //将用户订单设置为取消
//        $del = OrderReturn::where('ret_id', $ret_id)->where('user_id', $user_id)->delete();
//
//        if ($del) {
//            // 删除退换货商品
//            ReturnGoods::where('rec_id', $order['rec_id'])->delete();
//
//            $where = [
//                'user_id' => $user_id,
//                'rec_id' => $order['rec_id']
//            ];
//            $img_list = $this->getReturnImagesList($where);
//
//            if ($img_list) {
//                foreach ($img_list as $key => $row) {
//                    dsc_unlink(storage_public($row['img_file']));
//                }
//
//                ReturnImages::where('user_id', $user_id)->where('rec_id', $order['rec_id'])->delete();
//            }
//
//            /* 删除扩展记录  by kong*/
//            OrderReturnExtend::where('ret_id', $ret_id)->delete();
//
//            /* 记录log */
//            return_action($ret_id, 0, 0, lang('user.cancel_return'), lang('common.buyer'));
//
//            return true;
//        } else {
//            throw new HttpException(lang('admin/common.fail'), 1);
//        }
//    }

    /**
     * 退换货订单确认收货
     *
     * @param int $user_id
     * @param int $ret_id
     * @return bool
     * @throws HttpException
     */
//    public function receivedReturnOrder($user_id = 0, $ret_id = 0)
//    {
//        if (empty($user_id) || empty($ret_id)) {
//            throw new HttpException('parameters of illegal.', 1);
//        }
//
//        /* 查询订单信息，检查状态 */
//        $return_order = OrderReturn::where('ret_id', $ret_id);
//        $return_order = BaseRepository::getToArrayFirst($return_order);
//
//        if (empty($return_order)) {
//            throw new HttpException(lang('user.return_exist'), 1);
//        }
//
//        // 如果用户ID大于 0 。检查订单是否属于该用户
//        if ($user_id > 0 && $return_order['user_id'] != $user_id) {
//            throw new HttpException(lang('user.no_priv'), 1);
//        }
//
//        /* 检查订单 */
//        if ($return_order['return_status'] == 4) {
//            throw new HttpException(lang('order.order_confirm_receipt'), 1);
//        }
//
//        /* 修改退换货订单状态为"收到退换货" */
//        $res = OrderReturn::where('user_id', $user_id)->where('ret_id', $ret_id)->update(['return_status' => 4]);
//
//        if ($res) {
//            /* 记录log */
//            return_action($ret_id, 4, $return_order['refound_status'], lang('user.received'), lang('common.buyer'));
//
//            return true;
//        } else {
//            throw new HttpException(lang('admin/common.fail'), 1);
//        }
//    }

    /**
     * 激活退换货订单
     *
     * @param int $user_id
     * @param int $ret_id
     * @return bool
     * @throws HttpException
     */
//    public function activeReturnOrder($user_id = 0, $ret_id = 0)
//    {
//        if (empty($user_id) || empty($ret_id)) {
//            throw new HttpException('parameters of illegal.', 1);
//        }
//
//        $active_num = (int)$this->config['activation_number_type'];
//        $activation_number_type = ($active_num > 0) ? $active_num : 2;
//
//        $activation_number = OrderReturn::where('ret_id', $ret_id)->where('user_id', $user_id)->value('activation_number');
//
//        if ($activation_number_type > $activation_number) {
//            $other = [
//                'return_status' => 0
//            ];
//            OrderReturn::where('ret_id', $ret_id)->where('user_id', $user_id)->increment('activation_number', 1, $other);
//
//            return true;
//        } else {
//            throw new HttpException(sprintf(lang('user.activation_number_msg'), $activation_number_type), 1);
//        }
//    }

    /**
     * 删除已完成退换货订单
     *
     * @param int $user_id
     * @param int $ret_id
     * @return bool
     * @throws HttpException
     */
//    public function deleteReturnOrder($user_id = 0, $ret_id = 0)
//    {
//        if (empty($user_id) || empty($ret_id)) {
//            throw new HttpException('parameters of illegal.', 1);
//        }
//
//        /* 查询订单信息，检查状态 */
//        $order = OrderReturn::where('ret_id', $ret_id);
//        $order = BaseRepository::getToArrayFirst($order);
//
//        if (empty($order)) {
//            throw new HttpException(lang('user.return_exist'), 1);
//        }
//
//        // 如果用户ID大于0，检查订单是否属于该用户
//        if ($user_id > 0 && $order['user_id'] != $user_id) {
//            throw new HttpException(lang('user.no_priv'), 1);
//        }
//
//        // 只能删除已完成退换货订单
//        if ($order['return_status'] != 4) {
//            throw new HttpException(lang('admin/common.fail'), 1);
//        }
//
//        // 删除退换货订单
//        $del = OrderReturn::where(['ret_id' => $ret_id, 'user_id' => $user_id])->delete();
//        if ($del) {
//            // 删除退换货商品
//            ReturnGoods::where('ret_id', $ret_id)->delete();
//
//            /* 删除扩展记录  by kong */
//            OrderReturnExtend::where('ret_id', $ret_id)->delete();
//
//            return true;
//        } else {
//            throw new HttpException(lang('admin/common.fail'), 1);
//        }
//    }
}
