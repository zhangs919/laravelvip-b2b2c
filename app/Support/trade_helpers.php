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
// | Date:2020-01-01
// | Description: 订单相关助手函数
// +----------------------------------------------------------------------


/*********************** 订单相关 函数 ************************/

/**
 * 格式化数据订单来源
 *
 * @param int $order_from
 * @return mixed|string
 */
function format_order_from($order_from = 1)
{
    $data = [
        1 => 'PC端',
        2 => 'WAP端',
        3 => 'Android客户端',
        4 => 'iOS客户端',
        5 => '小程序端'
    ];
    if (!isset($data[$order_from])) {
        return '';
    }
    return $data[$order_from];
}

/**
 * 格式化订单状态
 *
 * @param int $order_status 订单状态
 * @param int $shipping_status 配送状态
 * @param int $pay_status 支付状态
 * @param int $order_cancel 用户提交取消申请状态
 * @param int $returnType 返回数据类型 0-返回state_msg 1-返回state_code
 * @return int
 */
function format_order_status($order_status, $shipping_status, $pay_status, $order_cancel = null, $returnType = 0)
{
    // 订单状态 0-订单已确认 1-交易成功 2-卖家取消 3-买家取消 4-系统自动取消 10-抢单中
    // 配送状态 0-待发货 1-已发货 2-发货中 3-已提交物流系统

    // 新版-订单状态 0-未确认 1-已确认 2-已取消 3-无效 4-退货 5-已分单 6-部分分单 7-部分已退货 8-仅退款
    // 新版-配送状态 0-未发货 1-已发货 2-已收货 3-备货中 4-已发货(部分商品) 5-发货中(处理分单) 6-已发货(部分商品) 7-部分已收货 8-待发货
    // 新版-支付状态 0-未付款 1-付款中 2-已付款 3-部分付款--预售定金 4-已退款 5-部分退款 6-部分已付款 主订单
    // 用户提交取消申请状态 默认0 无取消申请 1等待商家审核 2商家审核通过 3商家拒绝通过

    // 根据 3种状态来判断 商家中心订单列表状态
    if (in_array($order_status, [OS_UNCONFIRMED, OS_CONFIRMED])
        && in_array($shipping_status, [SS_UNSHIPPED, SS_PREPARING])
        && $pay_status == PS_UNPAYED) { // unpayed-订单已确认，等待买家付款
        $state_code = 'unpayed';
        $state_msg = '订单已确认，等待买家付款';
    } elseif (in_array($order_status, [OS_CONFIRMED])
        && in_array($shipping_status, [SS_UNSHIPPED])
        && in_array($pay_status, [PS_PAYING, PS_PAYED])) { // payed-买家已付款，待发货
        $state_code = 'payed';
        $state_msg = '买家已付款，待发货';
    }/* elseif ($order_status == 1 && $shipping_status == 3) { // assign-待发货已指派
        $state = 'assign';
    }*/elseif (in_array($order_status, [OS_SPLITED, OS_SPLITING_PART, OS_RETURNED_PART])
        && in_array($shipping_status, [SS_PREPARING, SS_SHIPPED_PART, SS_SHIPPED_ING])
        && in_array($pay_status, [PS_PAYING, PS_PAYED, PS_REFOUND_PART])) { // shipped_part-请前往发货单管理发货
        $state_code = 'shipped_part';
        $state_msg = '请前往发货单管理发货';
    }elseif (in_array($order_status, [OS_CONFIRMED, OS_SPLITED])
        && $shipping_status == SS_SHIPPED
        && $pay_status == PS_PAYED) { // shipped-已发货，等待买家收货
        $state_code = 'shipped';
        $state_msg = '已发货，等待买家收货';
    }elseif (in_array($order_status, [OS_CONFIRMED, OS_SPLITED, OS_RETURNED_PART, OS_ONLY_REFOUND])
        && $shipping_status == SS_RECEIVED
        && $pay_status == PS_PAYED) { // finished-交易成功
        $state_code = 'finished';
        $state_msg = '交易成功';
    }elseif ($order_status == OS_CANCELED) { // disable-卖家取消订单
        $state_code = 'disable';
        $state_msg = '取消订单'; // 卖家取消订单
    }elseif ($order_status == OS_CANCELED) { // cancel-买家取消订单
        $state_code = 'cancel';
        $state_msg = '取消订单'; // 买家取消订单
    }elseif ($order_status == OS_CANCELED) { // disable_sys-系统取消订单
        $state_code = 'disable_sys';
        $state_msg = '取消订单'; // 系统取消订单
    }

    else { // 默认为0
        $state_code = '';
        $state_msg = '';
    }

    if ($returnType == 0) {
        return $state_msg;
    } else {
        return $state_code;
    }
}

/**
 * 格式化输出商家中心订单列表状态
 *
 * @param int $order_status 订单状态
 * @param int $shipping_status 配送状态
 * @param int $pay_status 支付状态
 * @param int $order_cancel 用户提交取消申请状态
 * @return int
 */
function format_order_status_seller($order_status, $shipping_status, $pay_status, $order_cancel)
{
    // 订单状态 0-订单已确认 1-交易成功 2-卖家取消 3-买家取消 4-系统自动取消 10-抢单中
    // 配送状态 0-待发货 1-已发货 2-发货中 3-已提交物流系统
    // 支付状态 0-未支付 1-已支付

    // 新版-订单状态 0-未确认 1-已确认 2-已取消 3-无效 4-退货 5-已分单 6-部分分单 7-部分已退货 8-仅退款
    // 新版-配送状态 0-未发货 1-已发货 2-已收货 3-备货中 4-已发货(部分商品) 5-发货中(处理分单) 6-已发货(部分商品) 7-部分已收货 8-待发货
    // 新版-支付状态 0-未付款 1-付款中 2-已付款 3-部分付款--预售定金 4-已退款 5-部分退款 6-部分已付款 主订单
    // 用户提交取消申请状态 默认0 无取消申请 1等待商家审核 2商家审核通过 3商家拒绝通过

    // 根据 3种状态来判断 商家中心订单列表状态
    if (in_array($order_status, [OS_UNCONFIRMED, OS_CONFIRMED]) && in_array($shipping_status, [SS_UNSHIPPED, SS_PREPARING]) && $pay_status == PS_UNPAYED) { // unpayed-等待买家付款
        $state = 'unpayed';
    } elseif (in_array($order_status, [OS_CONFIRMED])
        && in_array($shipping_status, [SS_UNSHIPPED])
        && in_array($pay_status, [PS_PAYING, PS_PAYED])) { // todo unshipped-待发货未指派
        $state = 'unshipped';
    } elseif (in_array($order_status, [OS_SPLITED, OS_SPLITING_PART, OS_RETURNED_PART])
        && in_array($shipping_status, [SS_PREPARING, SS_SHIPPED_PART, SS_SHIPPED_ING])
        && in_array($pay_status, [PS_PAYING, PS_PAYED, PS_REFOUND_PART])) { // todo assign-待发货已指派
        $state = 'assign';
    }elseif (in_array($order_status, [OS_SPLITED, OS_SPLITING_PART, OS_RETURNED_PART])
        && in_array($shipping_status, [SS_PREPARING, SS_SHIPPED_PART, SS_SHIPPED_ING])
        && in_array($pay_status, [PS_PAYING, PS_PAYED, PS_REFOUND_PART])) { // shipped_part-发货中
        $state = 'shipped_part';
    }elseif (in_array($order_status, [OS_CONFIRMED, OS_SPLITED])
        && $shipping_status == SS_SHIPPED
        && $pay_status == PS_PAYED) { // shipped-已发货
        $state = 'shipped';
    }elseif (in_array($order_status, [OS_CONFIRMED, OS_SPLITED, OS_RETURNED_PART, OS_ONLY_REFOUND])
        && $shipping_status == SS_RECEIVED
        && $pay_status == PS_PAYED) { // finished-交易成功
        $state = 'finished';
    }elseif (in_array($order_status, [OS_CANCELED, OS_INVALID])) { // closed-交易关闭
        $state = 'closed';
    }elseif ($order_status == OS_ONLY_REFOUND) { // todo backing-退款中的订单
        $state = 'backing';
    }elseif ($order_status == OS_CONFIRMED && $order_cancel == OC_WAIT_AUDIT) { // cancel-取消订单申请
        $state = 'cancel';
    }

    else { // 默认为0
        $state = 0;
    }


    return $state;
}

/**
 * 格式化输出印章订单状态样式
 *
 * @param int $order_status 订单状态
 * @param int $shipping_status 配送状态
 * @param int $pay_status 支付状态
 * @return int
 */
function format_seal_state($order_status, $shipping_status, $pay_status)
{
    // 订单状态 0-订单已确认 1-交易成功 2-卖家取消 3-买家取消 4-系统自动取消 10-抢单中
    // 配送状态 0-待发货 1-已发货 2-发货中 3-已提交物流系统
    // 支付状态 0-未支付 1-已支付

    // 新版-订单状态 0-未确认 1-已确认 2-已取消 3-无效 4-退货 5-已分单 6-部分分单 7-部分已退货 8-仅退款
    // 新版-配送状态 0-未发货 1-已发货 2-已收货 3-备货中 4-已发货(部分商品) 5-发货中(处理分单) 6-已发货(部分商品) 7-部分已收货 8-待发货
    // 新版-支付状态 0-未付款 1-付款中 2-已付款 3-部分付款--预售定金 4-已退款 5-部分退款 6-部分已付款 主订单

    // 根据 3种状态来判断 印章订单状态样式
    if (in_array($order_status, [OS_UNCONFIRMED, OS_CONFIRMED])
        && in_array($shipping_status, [SS_UNSHIPPED, SS_PREPARING])
        && $pay_status == PS_UNPAYED) { // 0-订单已确认，等待买家付款
        $seal_state = 0;
    } elseif (in_array($order_status, [OS_CONFIRMED])
        && in_array($shipping_status, [SS_UNSHIPPED])
        && in_array($pay_status, [PS_PAYING, PS_PAYED])) { // 1-买家已付款，待发货
        $seal_state = 1;
    } elseif (in_array($order_status, [OS_CONFIRMED])
        && in_array($shipping_status, [SS_UNSHIPPED])
        && in_array($pay_status, [PS_PAYING, PS_PAYED])) { // todo 2-订单已确认，待发货   注：余额支付
        $seal_state = 2;
    }elseif (in_array($order_status, [OS_SPLITED, OS_SPLITING_PART, OS_RETURNED_PART])
        && in_array($shipping_status, [SS_PREPARING, SS_SHIPPED_PART, SS_SHIPPED_ING])
        && in_array($pay_status, [PS_PAYING, PS_PAYED, PS_REFOUND_PART])) { // 3-请前往发货单，管理发货
        $seal_state = 3;
    }elseif (in_array($order_status, [OS_CONFIRMED, OS_SPLITED])
        && $shipping_status == SS_SHIPPED
        && $pay_status == PS_PAYED) { // 4-已发货，等待买家收货
        $seal_state = 4;
    }elseif (in_array($order_status, [OS_CONFIRMED, OS_SPLITED, OS_RETURNED_PART, OS_ONLY_REFOUND])
        && $shipping_status == SS_RECEIVED
        && $pay_status == PS_PAYED) { // 5-交易成功
        $seal_state = 5;
    }elseif (in_array($order_status, [OS_CANCELED, OS_INVALID])) { // 6-交易关闭
        $seal_state = 6;
    }
    /*elseif ($pay_status == 1 && ???) { // 8-买家已付款，等待卖家核销   todo 注：自由购 后期再做
        $seal_state = 8;
    }*/

    else { // 默认为0
        $seal_state = 0;
    }


    return $seal_state;
}

/**
 * 格式化输出订单状态提醒信息
 *
 * @param int $order_status 订单状态
 * @param int $shipping_status 订单物流状态
 * @param string $close_reason 订单关闭原因
 * @param int $returnType 是否带“交易已关闭” 0-带 1-不带
 * @return array
 */
function format_order_status_reminder($order_status, $shipping_status,$pay_status, $close_reason = '', $returnType = 0)
{
    // 订单状态 0-订单已确认 1-交易成功 2-卖家取消 3-买家取消 4-系统自动取消 10-抢单中
    // 配送状态 0-待发货 1-已发货 2-发货中 3-已提交物流系统

    // 新版-订单状态 0-未确认 1-已确认 2-已取消 3-无效 4-退货 5-已分单 6-部分分单 7-部分已退货 8-仅退款
    // 新版-配送状态 0-未发货 1-已发货 2-已收货 3-备货中 4-已发货(部分商品) 5-发货中(处理分单) 6-已发货(部分商品) 7-部分已收货 8-待发货

    $reminder = [];
    if (in_array($order_status, [OS_UNCONFIRMED, OS_CONFIRMED])
        && in_array($shipping_status, [SS_UNSHIPPED, SS_PREPARING])
        && $pay_status == PS_UNPAYED) { // unpayed-订单已确认，等待买家付款
        $reminder = [
            '如果商品被恶意拍下了，您可以关闭订单。'
        ];
    } elseif (in_array($order_status, [OS_CONFIRMED, OS_SPLITED, OS_RETURNED_PART, OS_ONLY_REFOUND])
        && $shipping_status == SS_RECEIVED
        && $pay_status == PS_PAYED) { // finished-交易成功
        $reminder = [
            '交易已成功，如果买家提出售后要求，需卖家与买家协商，做好售后服务。'
        ];
    } elseif ($order_status == OS_CANCELED) { // cancel-买家取消订单
        $reminder = [
            '交易已关闭',
            '关闭类型： 买家取消订单',
            "关闭原因： {$close_reason}"
        ];
        if ($returnType == 1) {
            unset($reminder[0]);
        }
    } else {
        $reminder = [];
    }

//    switch ($order_status){
//        case 0: // 订单已确认
//            if ($shipping_status == SS_UNSHIPPED) {
//                $reminder = [
//                    '如果商品被恶意拍下了，您可以关闭订单。'
//                ];
//            }
//
//            break;
//        case 1: // 交易成功
//            $reminder = [
//                '交易已成功，如果买家提出售后要求，需卖家与买家协商，做好售后服务。'
//            ];
//            break;
//        case 2: // 卖家取消
//            $reminder = [
//                '交易已关闭',
//                '关闭类型： 卖家取消订单',
//                "关闭原因： {$close_reason}"
//            ];
//            if ($returnType == 1) {
//                unset($reminder[0]);
//            }
//            break;
//        case 3: // 买家取消
//            $reminder = [
//                '交易已关闭',
//                '关闭类型： 买家取消订单',
//                "关闭原因： {$close_reason}"
//            ];
//            if ($returnType == 1) {
//                unset($reminder[0]);
//            }
//            break;
//        case 4: // 系统自动取消
//            $reminder = [
//                '交易已关闭',
//                '关闭类型： 系统取消订单',
//                "关闭原因： {$close_reason}"
//            ];
//            if ($returnType == 1) {
//                unset($reminder[0]);
//            }
//            break;
//
//        case 10: // todo 抢单中
//            $reminder = [
//
//            ];
//            break;
//
//        default:
//            $reminder = [];
//            break;
//    }

    return $reminder;
}

/**
 * 格式化订单状态
 *
 * @param $k
 * @return mixed|string
 */
//function format_order_status($k)
//{
//    // 订单状态 0-订单已确认 1-交易成功 2-卖家取消 3-买家取消 4-系统自动取消 10-抢单中
//    $data = [
//        0 => '订单已确认，等待买家付款',
//        1 => '交易成功',
//        2 => '卖家取消',
//        3 => '买家取消',
//        4 => '系统自动取消', // 交易关闭
//        /*todo 中间有可能还有其他状态*/
//        10 => '抢单中'
//    ];
//    if (!isset($data[$k])) {
//        return '';
//    }
//    return $data[$k];
//}

/**
 * 格式化退款、售后状态
 * TODO 该方法还有问题
 *
 * @param $backStatus
 * @param int $backType 售后类型 1仅退款 2退货退款 3换货 4维修
 * @return mixed|string
 */
function format_back_order_status($backStatus, $backType = 1)
{
    /*{{--退换货单状态 0-待处理 1-同意申请 2-货物已发出 3-货物已收到 4-处理完成 5-被驳回 6-已失效 7-已撤销--}}
                        <select id="back_status" name="back_status" class="form-control">
                            <option value="null">全部</option>
                            <option value="wait">买家申请退款退货，等待卖家确认</option>
                            <option value="dismiss">卖家不同意协议，等待买家修改</option>
                            <option value="refund">退款申请达成，等待买家发货</option>
                            <option value="shipping">买家已退货，等待卖家确认收货</option>
                            <option value="backing">卖家已确认，等待平台退款</option>
                            <option value="shipped">卖家已收货，等待平台方退款</option>
                            <option value="close">退款关闭</option>
                            <option value="finished">退款成功</option>
                        </select>*/
    // 退换货单状态 0-待处理 1-同意申请 2-货物已发出 3-货物已收到 4-处理完成 5-被驳回 6-已失效 7-已撤销
    // 售后状态 back_status  默认0 0买家申请售后，等待卖家确认 1退款申请达成，等待买家发货 2买家已退货，等待卖家确认收货
    // 3卖家已收货，等待平台方退款 4退款成功 5卖家不同意，等待买家修改 6卖家拒绝了买家申请，退款关闭 7买家主动撤销了退款退货申请，退款关闭
    // 售后状态 back_status
    switch ($backType) {
        case 1: // 仅退款
            $data = [
                0 => '买家申请售后，等待卖家确认',
                1 => '卖家同意售后申请，等待买家确认完成',
                2 => '',
                3 => '',
                4 => '退款成功',
                5 => '卖家不同意，等待买家修改',
                6 => '卖家拒绝了买家申请，退款关闭',
                7 => '买家主动撤销了退款申请，退款关闭',
            ];
            break;

        case 2: // 退货退款
            $data = [
                0 => '买家申请售后，等待卖家确认',
                1 => '退款申请达成，等待买家发货',
                2 => '买家已退货，等待卖家确认收货',
                3 => '卖家已收货，等待平台方退款',
                4 => '退货退款成功',
                5 => '卖家不同意，等待买家修改',
                6 => '卖家拒绝了买家申请，售后关闭',
                7 => '买家主动撤销了退款申请，售后关闭',
            ];
            break;

        case 3: // 换货 TODO
            $data = [
                0 => '买家申请售后，等待卖家确认',
                1 => '换货申请达成，等待买家发货',
                2 => '买家已退货，等待卖家确认收货',
                3 => '',
                4 => '换货成功',
                5 => '卖家不同意，等待买家修改',
                6 => '卖家拒绝了买家申请，售后关闭',
                7 => '买家主动撤销了换货申请，售后关闭',
            ];
            break;

        case 4: // 维修 TODO
            $data = [
                0 => '买家申请售后，等待卖家确认',
                1 => '维修申请达成，等待买家发货',
                2 => '买家已退货，等待卖家确认收货',
                3 => '',
                4 => '维修成功',
                5 => '卖家不同意，等待买家修改',
                6 => '卖家拒绝了买家申请，售后关闭',
                7 => '买家主动撤销了维修申请，售后关闭',
            ];
            break;

        default:
            $data = [];
            break;
    }
    /*$data = [
        0 => [
            't1' => '待处理',
            't2' => 'wait',
            't3' => '买家申请退款退货，等待卖家确认'
        ],
        1 => [
            't1' => '同意申请',
            't2' => 'refund',
            't3' => '退款申请达成，等待买家发货',
        ],
        2 => [
            't1' => '货物已发出',
            't2' => 'shipping',
            't3' => '买家已退货，等待卖家确认收货',
        ],
        3 => [
            't1' => '货物已收到',
            't2' => 'shipped',
            't3' => '卖家已收货，等待平台方退款',
        ],
        4 => [
            't1' => '处理完成',
            't2' => 'finished',
            't3' => '退款成功',
        ],
        5 => [
            't1' => '被驳回',
            't2' => 'dismiss',
            't3' => '卖家不同意协议，等待买家修改',
        ],
        6 => [
            't1' => '已失效',
            't2' => '',
            't3' => '',
        ],
        7 => [
            't1' => '已撤销',
            't2' => 'close',
            't3' => '退款关闭',
        ],

    ];*/
    if (!isset($data[$backStatus])) {
        return '';
    }
    return $data[$backStatus];
}

/**
 * 格式化投诉处理状态
 *
 * @param $k
 * @return mixed|string
 */
function format_complaint_status($k = -1, $type = 0) {
    $data = [
        0 => '等待卖家处理',
        1 => '卖家已回复',
        2 => '买家撤销投诉',
        3 => '平台方介入',
        4 => '平台方仲裁中',
        5 => '仲裁成功',
        6 => '仲裁失败',
    ];

    if ($type == 1) {
        $data = [
            0 => '买家提起投诉，等待卖家处理',
            1 => '协商处理中', // 卖家已提交协商处理，请及时处理协商结果
            2 => '投诉已撤销',
            3 => '申请平台方介入',
            5 => '平台方已仲裁，投诉成立',
            6 => '平台方已仲裁，投诉不成立',
        ];
    }

    if ($k == '-1') {
        return $data;
    }
    if (!isset($data[$k])) {
        return '';
    }
    return $data[$k];
}

/**
 * 格式化输出投诉原因
 *
 * @param int $k
 * @return array|string
 */
function format_complaint_type($k = -1)
{
    $data = explode("\r\n", sysconf('complaint_reason'));
    if (empty($data)) {
        return '';
    }
    if ($k == '-1') {
        return $data;
    }
    if (!isset($data[$k])) {
        return '';
    }
    return $data[$k];
}

/**
 * 格式化输出退款原因
 *
 * @param int $k
 * @return array|string
 */
function format_refund_reason($k = -1)
{
    $data = explode("\r\n", sysconf('refund_reason'));
    if (empty($data)) {
        return '';
    }
    if ($k == '-1') {
        return $data;
    }
    if (!isset($data[$k])) {
        return '';
    }
    return $data[$k];
}

/**
 * 格式化输出换货原因
 *
 * @param int $k
 * @return array|string
 */
function format_exchange_reason($k = -1)
{
    $data = explode("\r\n", sysconf('exchange_reason'));
    if (empty($data)) {
        return '';
    }
    if ($k == '-1') {
        return $data;
    }
    if (!isset($data[$k])) {
        return '';
    }
    return $data[$k];
}

/**
 * 格式化输出维修原因
 *
 * @param int $k
 * @return array|string
 */
function format_repair_reason($k = -1)
{
    $data = explode("\r\n", sysconf('repair_reason'));
    if (empty($data)) {
        return '';
    }
    if ($k == '-1') {
        return $data;
    }
    if (!isset($data[$k])) {
        return '';
    }
    return $data[$k];
}

/**
 * 格式化配送状态
 *
 * @param $k
 * @return mixed|string
 */
function format_refund_type($k)
{
//    退款方式 0-退回账户余额 1-退回原支付方式
    $data = [
        0 => '退回账户余额',
        1 => '退回原支付方式',
    ];
    if (!isset($data[$k])) {
        return '';
    }
    return $data[$k];
}

/**
 * 格式化配送状态
 *
 * @param $k
 * @return mixed|string
 */
function format_shipping_status($k)
{
//    配送状态 0-待发货 1-已发货
    $data = [
        0 => '待发货',
        1 => '已发货',
    ];
    if (!isset($data[$k])) {
        return '';
    }
    return $data[$k];
}

/**
 * 格式化红包类型
 *
 * 红包类型 默认0 1-主动领红包/到店送红包 2-收藏送红包 4-会员送红包 6-注册送红包 9-推荐送红包 10-积分兑换红包
 * @param int $bonus_type
 * @return mixed|string
 */
function format_bonus_type($bonus_type = 0)
{
    $data = [
        1 => '到店送红包',
        2 => '收藏送红包',
        4 => '会员送红包',
        6 => '注册送红包',
        9 => '推荐送红包',
        10 => '积分兑换红包'
    ];
    if (!isset($data[$bonus_type])) {
        return '';
    }
    return $data[$bonus_type];
}

/**
 * 检查订单来源
 *
 * @return int
 */
function check_order_from()
{
    if (is_app('weapp')) { // 微信小程序端访问
        return 5;
    } elseif (is_app('ios')) { // Ios端访问
        return 4;
    } elseif (is_app('android')) { // Android端访问
        return 3;
    } elseif (is_mobile() && !is_app()) { // 手机端访问 针对微信端
        return 2;
    } else { // PC端
        return 1;
    }
}

/**
 * 格式化数据订单配送方式
 *
 * @param int $pickup
 * @return mixed|string
 */
function format_order_pickup($pickup = 0)
{
    $data = [
        0 => '普通配送',
        1 => '上门自提'
    ];
    if (!isset($data[$pickup])) {
        return '';
    }
    return $data[$pickup];
}

/**
 * 格式化数据订单支付方式
 *
 * @param string $pay_type
 * @return mixed|string
 */
function format_pay_type($pay_type = '')
{
    $data = [
        'alipay' => '支付宝',
        'union' => '银联支付',
        'weixin' => '微信支付',
        'balance' => '余额支付',
        'cod' => '货到付款',
    ];
    if (!isset($data[$pay_type])) {
        return '';
    }
    return $data[$pay_type];
}

/**
 * 返回是否允许某些订单相关操作（返回所有操作）
 *
 * @param $orderInfo
 * @param array $deliveryInfo
 * @param string $operate_type
 * @return string[]
 */
function get_order_all_operate_state($orderInfo, $deliveryInfo = [], $operate_type = 'buyer') {
    $buyer_operate_arr = [
        'buyer_cancel',
        'buyer_complaint',
        'buyer_confirm_receipt',
        'buyer_delay',
        'buyer_view_logistics',
        'buyer_evaluate',
        'buyer_evaluate_again',
        'buyer_payment',
        'buyer_delete',
        'buyer_drop',
        'buyer_restore',
        'buyer_refund',
    ];

    $shop_operate_arr = [
        'shop_cancel',
        'shop_audit_cancel',
        'shop_batch_received_pay',
        'shop_received_pay',
        'shop_edit_order_price',
        'shop_edit_address',
        'shop_assign',
        'shop_assign_cancel',
        'shop_delivery',
        'shop_to_shipping',
        'shop_quick_delivery',
        'shop_view_logistics',
        'shop_delay',
        'shop_delivery_cancel',
        'shop_order_print',
        'shop_delivery_print',
        'shop_shipping_print',
        'shop_sheet_print',
    ];

    $system_operate_arr = [
        'system_cancel',
    ];
    $data = [];
    if ($operate_type == 'buyer') {
        foreach ($buyer_operate_arr as $item) {
            if (get_order_operate_state($item, $orderInfo, $deliveryInfo)) {
                $data[] = $item;
            }
        }
    } elseif ($operate_type == 'shop') {
        foreach ($shop_operate_arr as $item) {
            if (get_order_operate_state($item, $orderInfo, $deliveryInfo)) {
                $data[] = $item;
            }
        }
    } elseif ($operate_type == 'system') {
        foreach ($system_operate_arr as $item) {
            if (get_order_operate_state($item, $orderInfo, $deliveryInfo)) {
                $data[] = $item;
            }
        }
    }

    return $data;
}

/**
 * 返回是否允许某些订单相关操作
 *
 * 参考综合状态常量：如：CS_AWAIT_PAY
 *
 * @param string $operate 操作名称 如：buyer_cancel-是否允许买家取消订单
 * @param array $orderInfo 订单信息
 * @return bool
 */
function get_order_operate_state($operate, $orderInfo, $deliveryInfo = [])
{
    if (empty($orderInfo)) {
        return false;
    }

//    if(isset($orderInfo['if_'.$operate])) {
//        return $orderInfo['if_'.$operate];
//    }

//    $orderStatus = $orderInfo['order_status']; // 旧版-订单状态 0-订单已确认 1-交易成功 2-卖家取消 3-买家取消 4-系统自动取消 10-抢单中
//    $payStatus = $orderInfo['pay_status']; // 旧版-支付状态 0-未付款 1-已付款
    $orderStatus = $orderInfo['order_status']; // 新版-订单状态 0-未确认 1-已确认 2-已取消 3-无效 4-退货 5-已分单 6-部分分单 7-部分已退货 8-仅退款
    $payStatus = $orderInfo['pay_status']; // 新版-支付状态 0-未付款 1-付款中 2-已付款 3-部分付款--预售定金 4-已退款 5-部分退款 6-部分已付款 主订单
    $orderCancel = $orderInfo['order_cancel']; // 用户提交取消申请状态 默认0 无取消申请 1等待商家审核 2商家审核通过 3商家拒绝通过
//    $shippingStatus = $orderInfo['shipping_status']; // 旧版-配送状态 0-待发货 1-已发货 2-发货中 3-已提交物流系统
    $shippingStatus = $orderInfo['shipping_status']; // 新版-配送状态 0-未发货 1-已发货 2-已收货 3-备货中 4-已发货(部分商品) 5-发货中(处理分单) 6-已发货(部分商品) 7-部分已收货 8-待发货
    $evaluateStatus = $orderInfo['evaluate_status']; // 评价状态 默认0 0未评价，1已评价，2已过期未评价
    $isCod = $orderInfo['is_cod']; //是否为货到付款 0 否 1 是
    $isDelete = $orderInfo['is_delete']; // 订单删除状态 默认0 0-正常 1-放入回收站 2-彻底删除

    // 拼团 拼团成功 才能发货
    $fight_group_status = true;
    if ($orderInfo['order_type'] == \App\Services\Enum\ActTypeEnum::ACT_TYPE_FIGHT_GROUP
        && !empty($orderInfo['group_sn'])) {
        $groupon_log = DB::table('groupon_log')->where('group_sn', $orderInfo['group_sn'])->first();
        if (!empty($groupon_log) && $groupon_log->status != 1) {
            $fight_group_status = false;
        }
    }

    switch ($operate){
        /****买家操作****/
        // 买家-取消订单
        case 'buyer_cancel':
            $state = (in_array($orderStatus, [OS_UNCONFIRMED, OS_CONFIRMED]) && $orderCancel == OC_UNAPPLY && $shippingStatus == SS_UNSHIPPED) ||
                ($isCod && $payStatus == PS_PAYED);
            break;

        // 买家-投诉
        case 'buyer_complaint':
            $state = in_array($orderStatus, [OS_CONFIRMED,OS_CANCELED])
                && (intval($orderInfo['confirm_time']) > (time() - get_complaint_seller_term()));
            break;

        // 买家-确认收货
        case 'buyer_confirm_receipt':
            $state = ($orderStatus == OS_CONFIRMED && $shippingStatus == SS_SHIPPED
                && intval($orderInfo['shipping_time']) < (time() - get_order_receiving_term() - get_order_delay_days_term($orderInfo['delay_days'])));
            break;

        // 买家-延迟收货时间
        case 'buyer_delay':
            $state = ($orderStatus == OS_CONFIRMED
                && $payStatus == PS_PAYED
                && $shippingStatus == SS_SHIPPED
                && $orderInfo['countdown'] > 0
                && $orderInfo['delay_days'] == 0);
            break;

        // 买家-查看物流 todo
        case 'buyer_view_logistics':
            $state = (in_array($orderStatus, [OS_UNCONFIRMED, OS_CONFIRMED])
                && $payStatus == PS_PAYED
                && $shippingStatus == SS_SHIPPED);
            break;

        // 买家-评价
        case 'buyer_evaluate':
            $state = ($evaluateStatus == ES_UNEVALUATED
                && in_array('order_status', [OS_CONFIRMED, OS_SPLITED, OS_RETURNED_PART, OS_ONLY_REFOUND])
                && intval($orderInfo['end_time']) > (time() - sysconf('mark_term') * 24*60*60)
            );
            break;

        // 买家-追加评价 todo
        case 'buyer_evaluate_again':
            $state = ($evaluateStatus == ES_EVALUATED
                && in_array('order_status', [OS_CONFIRMED, OS_SPLITED, OS_RETURNED_PART, OS_ONLY_REFOUND])
                && intval($orderInfo['end_time']) > (time() - sysconf('chase_term') * 24*60*60)
            );
            break;

        // 买家-购买
        case 'buyer_payment':
            $state = ($orderStatus == OS_CONFIRMED && $orderInfo['countdown'] > 0 && $orderCancel == OC_UNAPPLY && !$isCod && $payStatus == PS_UNPAYED);
            break;

        // 买家-删除订单（移入回收站）
        case 'buyer_delete':
            $state = (in_array($orderStatus, [OS_CONFIRMED,OS_CANCELED])
                && $isDelete == 0);
            break;

        // 买家-删除订单（彻底删除、从回收站还原）
        case 'buyer_drop':
        case 'buyer_restore':
            $state = (in_array($orderStatus, [OS_CONFIRMED,OS_CANCELED])
                && $isDelete == 1);
            break;

        // 买家-提交退款申请 申请售后期限 默认为15天：自买家确认收货起15天内，可且申请退款（仅退款/退款退货）、换货维修服务
        case 'buyer_refund':
            $state = $orderStatus == OS_CONFIRMED
                && (intval($orderInfo['confirm_time']) > (time() - sysconf('customer_service_term') * 24*60*60));
            break;


        /****商家操作****/
        // 商家-取消订单
        case 'shop_cancel':
            $state = (in_array($orderStatus, [OS_UNCONFIRMED, OS_CONFIRMED])
                && $payStatus == PS_UNPAYED
                && $orderCancel == OC_UNAPPLY);
            break;

        // 商家-审核取消订单
        case 'shop_audit_cancel':
            $state = (in_array($orderStatus, [OS_UNCONFIRMED, OS_CONFIRMED])
                && $orderCancel == OC_WAIT_AUDIT);
            break;

        // 商家-批量收到货款
//            case 'shop_batch_received_pay':
//
//                break;

        // 商家-收到货款
        case 'shop_received_pay':
            $state = (in_array($orderStatus, [OS_UNCONFIRMED, OS_CONFIRMED])
                && $payStatus == PS_UNPAYED
                && !$isCod && $orderInfo['pay_time']);
            break;

        // 商家-修改订单价格
        case 'shop_edit_order_price':
            $state = (in_array($orderStatus, [OS_UNCONFIRMED, OS_CONFIRMED])
                && $payStatus == PS_UNPAYED
                && $orderCancel == OC_UNAPPLY);
            break;

        // 商家-修改收货人信息
        case 'shop_edit_address':
            $state = (in_array($orderStatus, [OS_UNCONFIRMED, OS_CONFIRMED])
                && $payStatus == PS_UNPAYED
                && $orderCancel == OC_UNAPPLY);
            break;

        // 商家-订单指派网点
        case 'shop_assign':
            $state = (in_array($orderStatus, [OS_UNCONFIRMED, OS_CONFIRMED])
                && $payStatus == PS_PAYED
                && $shippingStatus == SS_UNSHIPPED
                && $fight_group_status
            );
            break;

        // 商家-取消指派
        case 'shop_assign_cancel':
            $state = (in_array($orderStatus, [OS_UNCONFIRMED, OS_CONFIRMED])
                && $payStatus == PS_PAYED
                && $shippingStatus == 3); // todo 已提交物流系统
            break;

        // 商家-拆单发货 待发货(去发货) 生成发货单
        case 'shop_delivery':
            $state = (in_array($orderStatus, [OS_UNCONFIRMED, OS_CONFIRMED])
                && $payStatus == PS_PAYED
                && $shippingStatus == SS_UNSHIPPED
                && $fight_group_status
            );
            break;

        // 商家-拆单发货 发货中
        case 'shop_to_shipping':
            $state = (in_array($orderStatus, [OS_UNCONFIRMED, OS_CONFIRMED])
                && $payStatus == PS_PAYED
                && $shippingStatus == SS_SHIPPED_ING);
            break;

        // 商家-一键发货
        case 'shop_quick_delivery':
            $state = (in_array($orderStatus, [OS_UNCONFIRMED, OS_CONFIRMED])
                && $payStatus == PS_PAYED
                && $shippingStatus == SS_UNSHIPPED
                && $fight_group_status
            );
            break;

        // 商家-查看物流 todo
        case 'shop_view_logistics':
            $state = (in_array($orderStatus, [OS_UNCONFIRMED, OS_CONFIRMED])
                && $payStatus == PS_PAYED
                && $shippingStatus == SS_SHIPPED);
            break;

        // 商家-延迟收货时间 todo
        case 'shop_delay':
            $state = (in_array($orderStatus, [OS_UNCONFIRMED, OS_CONFIRMED])
                && $payStatus == PS_PAYED
                && $shippingStatus == SS_SHIPPED
                && $orderInfo['countdown'] > 0
                && $orderInfo['delay_days'] == 0);
            break;

        // 商家-取消发货单
        case 'shop_delivery_cancel':
            $state = (in_array($orderStatus, [OS_UNCONFIRMED, OS_CONFIRMED])
                && $payStatus == PS_PAYED
                && $shippingStatus == SS_SHIPPED_ING
                && $deliveryInfo['delivery_status'] == DELIVERY_CREATE);
            break;

        // 商家-打印订单
        case 'shop_order_print':
            $state = true;

            break;

        // 商家-打印发货单
        case 'shop_delivery_print':
            $state = ($payStatus == PS_PAYED
                && $shippingStatus > SS_UNSHIPPED);

            break;

        // 商家-打印快递单 todo
        case 'shop_shipping_print':
            $state = ($payStatus == PS_PAYED
                && $shippingStatus == SS_SHIPPED
                && $deliveryInfo['shipping_type'] > 0);

            break;

        // 商家-打印电子面单 todo
        case 'shop_sheet_print':
            $state = ($payStatus == PS_PAYED
                && $shippingStatus == SS_SHIPPED
                && $deliveryInfo['shipping_type'] > 0);

            break;



        /****平台（系统）操作****/
        // 平台-取消订单
        case 'system_cancel':
            $state = ((in_array($orderStatus, [OS_UNCONFIRMED, OS_CONFIRMED])
                    && $payStatus == PS_UNPAYED
                    && $orderCancel == OC_UNAPPLY) || ($isCod && $payStatus == PS_PAYED));
            break;

        default:
            $state = false;
            break;
    }

    return $state;
}

/**
 * 返回是否允许某些售后订单相关操作
 *
 * @param string $operate 操作名称 如：
 * @param array $back_info
 * @return false
 */
function back_order_operate_state($operate, $order_info, $back_info = [])
{
    if (empty($order_info)) {
        return false;
    }

    // 售后状态 默认0 0买家申请售后，等待卖家确认
    // 1退款申请达成，等待买家发货
    // 2买家已退货，等待卖家确认收货
    // 3卖家已收货，等待平台方退款
    // 4退款成功
    // 5卖家不同意，等待买家修改
    // 6卖家拒绝了买家申请，退款关闭
    // 7买家主动撤销了退款退货申请，退款关闭

//    $back_status = $back_info['back_status'];
//    // 售后类型 1仅退款 2退货退款 3换货 4维修
//    $back_type = $back_info['back_type'];
//    // 退款方式 0退回账户余额 1退回原支付方式
//    $refund_type = $back_info['refund_type'];


    // 退换货单状态
    // 0-待处理
    // 1-同意申请
    // 2-货物已发出
    // 3-货物已收到
    // 4-处理完成
    // 5-被驳回
    // 6-已失效
    // 7-已撤销

    // confirm-同意申请，发送退货地址 shipped-确认收到货物 dismiss-拒绝申请
    switch ($operate) {
        /****买家操作****/
        // 买家-售后申请提交
        case 'buyer_apply':
            // 售后期限、未申请
            $customer_service_term = sysconf('customer_service_term') ?? 15; // 申请售后期限 默认：15天
            if (time() - $order_info['shipping_time'] < $customer_service_term * 86400 && empty($back_info)) {
                $state = true;
            }
            break;
        // 买家-售后申请修改
        case 'buyer_wait':
            // 售后期限、已申请未处理
            $customer_service_term = sysconf('customer_service_term') ?? 15; // 申请售后期限 默认：15天
            if (time() - $order_info['shipping_time'] < $customer_service_term * 86400
                && !empty($back_info)
                && $back_info['back_status'] == 0) {
                $state = true;
            }
            break;
        // 买家-撤销售后申请
        case 'buyer_cancel':
            // 已申请未处理
            if (!empty($back_info)
                && $back_info['back_status'] == 0) {
                $state = true;
            }
            break;
        // 买家-退款退货 货物待发出
        case 'buyer_shipping':
            // 商家已同意申请
            if (!empty($back_info)
                && $back_info['back_status'] == 1) {
                $state = true;
            }
            break;

        /****商家操作****/
        // 商家-同意申请，发送退货地址
        case 'shop_confirm':
            // 已申请未处理
            if (!empty($back_info)
                && $back_info['back_status'] == 0) {
                $state = true;
            }
            break;
        // 商家-确认收到货物
        case 'shop_shipped':
            // 买家已发回货物
            if (!empty($back_info)
                && $back_info['back_status'] == 2) {
                $state = true;
            }
            break;
        // 商家-卖家已确认，等待平台退款
        case 'shop_backing':
            // 仅退款-卖家同意申请
            if (!empty($back_info)
                && $back_info['back_status'] == 3) {
                $state = true;
            }
            break;
        // 商家-拒绝申请
        case 'shop_dismiss':
            // 已申请未处理
            if (!empty($back_info)
                && $back_info['back_status'] == 0) {
                $state = true;
            }
            break;

        /****平台（系统）操作****/
        // 平台-系统自动取消申请
        case 'system_cancel':
            // 1. 自卖家拒绝退款申请起7天内，买家未修改退款申请信息，系统自动取消申请
            $buyer_update_back_term = sysconf('buyer_update_back_term') ?? 7; // 卖家拒绝退款申请，买家修改退款期限 默认：7天
            if (time() - $back_info['dismiss_time'] < $buyer_update_back_term * 86400) {
                $state = true;
            }
            // 2. 自卖家（系统）同意退款退货申请起7天内，买家尚未发货的，系统会自动取消申请
            $back_buyer_send_term = sysconf('back_buyer_send_term') ?? 7; // 退款退货买家发货期限 默认：7天
            if (time() - $back_info['dismiss_time'] < $back_buyer_send_term * 86400) {
                $state = true;
            }
            break;
        // 平台-系统同意申请
        case 'system_confirm':
            //自买家申请退款（仅退款/退款退货）起7天内，卖家尚未操作的，系统会自动同意申请
            $back_seller_term = sysconf('back_seller_term') ?? 7; // 申请退款卖家确认期限 默认：7天
            if (time() - $back_info['add_time'] < $back_seller_term * 86400) {
                $state = true;
            }
            break;
        // 平台-系统自动将退款退货信息推送至平台方
        case 'system_push_back_info':
            //自买家寄回退货商品起7天内，卖家尚未确认收货的，系统会自动将退款退货信息推送至平台方
            $back_seller_recive_term = sysconf('back_seller_recive_term') ?? 7; // 退款退货卖家确认收货期限 默认：7天
            if (time() - $back_info['send_time'] < $back_seller_recive_term * 86400) {
                $state = true;
            }
            break;
        default:
            $state = false;
            break;

    }

    return $state;
}

/**
 * 返回是否允许某些投诉相关操作
 *
 * @param string $operate 操作名称
 * @param array $complaintInfo 投诉信息
 * @return bool
 */
function get_complaint_operate_state($operate, $complaintInfo)
{
    switch ($operate) {
        // 商家-处理投诉
        case 'shop_handle_complaint':
            $seller_ps_complain_term = sysconf('seller_ps_complain_term'); // 天
            $state = ($complaintInfo['complaint_status'] == 0
                && intval($complaintInfo['add_time']) > (time() - $seller_ps_complain_term * 24 * 60 * 60));

            break;

        default:
            $state = false;
            break;
    }

    return $state;
}

/**
 * 格式化输出订单商品类型
 * todo 暂时未用到该方法
 *
 * @param int $goodsType 商品类型
 * @param int $formatType 返回格式类型 0-商品类型中文描述 1-商品类型英文class名称
 * @return mixed|string
 */
function format_order_goods_type($goodsType, $formatType = 0)
{
    // 商品交易类型 0-普通商品 1-拍卖 2-预售 3-团购 5-积分兑换 6-拼团 8-砍价 10-搭配套餐 11-限时折扣 12-满减送 13-赠品活动 99-电子秤商品
    switch ($goodsType) {
        case 99:
            $class = 'freebuy';
            $label = '电子秤商品';
            break;
        case 13:
            $class = 'gift';
            $label = '赠品活动';
            break;
        case 12:
            $class = 'fullsubtraction';
            $label = '满减送';
            break;
        case 11:
            $class = 'limited-discount';
            $label = '限时抢';
            break;
        case 10:
            $class = '';
            $label = '搭配套餐';
            break;
        case 8:
            $class = 'bargain';
            $label = '砍价';
            break;
        case 6:
            $class = '';
            $label = '拼团';
            break;
        case 5:
            $class = 'exchange';
            $label = '积分兑换';
            break;
        case 3:
            $class = 'group-buy';
            $label = '团购';
            break;
        case 2:
            $class = 'pre-sale';
            $label = '预售';
            break;
        case 1:
            $class = 'auction';
            $label = '拍卖';
            break;
        default:
            $class = '';
            $label = '普通商品';
            break;
    }
    if ($formatType == 1) {
        // 返回英文class 名称
        return $class;
    } else {
        // 返回中文描述
        return $label;
    }
}

/**
 * 格式化输出发货单状态
 *
 * @param int $deliveryStatus 发货单状态
 * @return mixed|string
 */
function format_delivery_status($deliveryStatus)
{
    //发货单状态 0-待发货 1-已发货 2-已退款
    if (empty($deliveryStatus)) {
        return '';
    }

    return str_replace(
        [0,1,2],
        ['待发货','已发货','已退款'],
        $deliveryStatus
    );
}

/**
 * 格式化输出 用户提交取消申请状态
 *
 * @param $orderCancel
 * @return mixed|string
 */
function format_order_cancel($orderCancel)
{
    //用户提交取消申请状态 默认0 无取消申请 1等待商家审核 2商家审核通过 3商家拒绝通过
    if (empty($orderCancel)) {
        return '';
    }

    return str_replace(
        [0,1,2,3],
        ['无取消申请','等待商家审核取消订单申请','商家审核通过','商家拒绝通过'],
        $orderCancel
    );
}

/**
 * 获取订单付款期限时间戳
 *
 * @return float|int
 */
function get_order_pay_term()
{
    $term = sysconf('pay_term'); // 付款期限不能小于15分钟，默认为1天
    $pay_term_unit = sysconf('pay_term_unit'); // 付款期限单位 0-天 1-小时 2-分钟
    if ($term <=0) {
        return 0;
    }

    if ($pay_term_unit == 1) { // 小时
        $timestamp = 60*60;
    } elseif ($pay_term_unit == 2) { // 分钟
        $timestamp = 60;
    } else { // 默认天
        $timestamp = 24*60*60;
    }

    return $term * $timestamp;
}

/**
 * 获取订单确认收货期限时间戳
 *
 * @return float|int
 */
function get_order_receiving_term()
{
    $term = sysconf('receiving_term'); // 确认收货期限 默认为7天

    // 默认天
    $timestamp = 24*60*60;

    return $term * $timestamp;
}

/**
 * 获取订单延长收货时间时间戳
 *
 * @param int $delay_days
 * @return float|int
 */
function get_order_delay_days_term($delay_days = 0)
{
    // 默认天
    $timestamp = 24*60*60;

    return $delay_days * $timestamp;
}

/**
 * 获取投诉卖家期限时间戳
 *
 * @return float|int
 */
function get_complaint_seller_term()
{
    $term = sysconf('complaint_seller_term'); // 投诉卖家期限 默认为15天

    // 默认天
    $timestamp = 24*60*60;

    return $term * $timestamp;
}

/**
 * 格式化输出配送方式
 *
 * @param int $shipping_type 配送方式
 * @return mixed
 */
function format_shipping_type($shipping_type)
{
    return str_replace([0,1,2,3], ['无需物流','指派','众包','第三方物流'], $shipping_type);
}

/**
 * 获取评分描述
 *
 * @param string $type 评分类型 如：service_desc
 * @param bool $except_desc_eval 是否排除评分描述分值 默认true
 * @param bool $str_format 是否返回字符串格式化的结果
 * @return array|mixed
 */
function get_score_desc($type = '', $except_desc_eval = true, $str_format = false)
{
    $score_desc_obj = \Illuminate\Support\Facades\DB::table('system_config')
        ->where([['status',1]])
        ->whereIn('group', ['service_desc','send_desc','shipping_desc','desc_conform'])
        ->orderBy('sort','asc')
        ->get();

    $score_desc = [];
    foreach ($score_desc_obj as $item) {
        preg_match('/\d+/', $item->code, $code_arr);
        $key = $code_arr[0];

        if ($item->group == 'service_desc') {
            if ($str_format) {
                $score_desc['service_desc'][] = $key."分：".$item->value;
            } else {
                $score_desc['service_desc'][$key] = $item->value;
            }

        }
        if ($item->group == 'send_desc') {
            if ($str_format) {
                $score_desc['send_desc'][] = $key."分：".$item->value;
            } else {
                $score_desc['send_desc'][$key] = $item->value;
            }
        }
        if ($item->group == 'shipping_desc') {
            if ($str_format) {
                $score_desc['logistics_speed'][] = $key."分：".$item->value;
            } else {
                $score_desc['logistics_speed'][$key] = $item->value;
            }
        }
        if ($item->group == 'desc_conform') {
            if (!str_contains($item->code, '_eval')) {
                if ($str_format) {
                    $score_desc['desc'][] = $key."分：".$item->value;
                } else {
                    $score_desc['desc'][$key] = $item->value;
                }
            } else {
                if ($str_format) {
                    $score_desc['desc_eval'][] = $key."分：".$item->value;
                } else {
                    $score_desc['desc_eval'][$key] = $item->value;
                }
            }
        }
    }

    if ($except_desc_eval) {
        unset($score_desc['desc_eval']);
    }

    if (!empty($type) && isset($score_desc[$type])) {
        return $score_desc[$type];
    }

    return $score_desc;
}

/**
 * 格式化售后业务类型
 *
 * @param $back_type
 * @return mixed|string
 */
function format_back_type($back_type)
{
    //业务类型 0-无状态 1-退款 2-退款退货 3-换货 4-申请维修 5-线下业务
    if (empty($back_type)) {
        return '';
    }

    return str_replace(
        [0,1,2,3,4,5],
        ['','退款','退款退货','换货','申请维修','线下业务'],
        $back_type
    );
}

/**
 * 格式化卖家账户分类
 *
 * @param int $account_type 账户分类 11-交易订单 12-退款订单 13-取消订单 14-短信购买 15-神码收银 16-退还运费 17-退还配送费和包装费 18-售卖店铺购物卡
 * @return mixed|string
 */
function format_seller_account_type($account_type)
{
    //账户类型
    if (empty($account_type)) {
        return '';
    }

    return str_replace(
        [0,11,12,13,14,15,16,17,18],
        ['','交易订单','退款订单','取消订单','短信购买','神码收银','退还运费','退还配送费和包装费','售卖店铺购物卡'],
        $account_type
    );
}

/**
 * 格式化账户变动类型
 *
 * @param int $process_type 账户变动类型
 * @return mixed|string
 */
function format_process_type(int $process_type)
{
    //账户类型
    if (empty($process_type)) {
        return '';
    }

    //1-充值
    //            4-提现
    //            5-调节账户资金
    //            8-购物-余额支付
    //            10-取消-余额支付
    //            11-退款-余额支付
    //            15-推荐分成
    //            16-撤销推荐分成
    //            17-分销账户提现到余额
    //            18-拒绝提现
    //            19-平台结算进账
    //            20-神码收银
    //            21-购买短信
    //            22-储值卡充值
    //            23-退款成功退还运费
    //            24-取消提现
    //            25-线下消费余额
    //            26-提现手续费
    //            27-线下收款
    return str_replace(
        [0,1,4,5,8,10,11,15,16,17,18,19,20,21,22,23,24,25,26,27],
        ['','充值','提现','调节账户资金','购物-余额支付','取消-余额支付','退款-余额支付','推荐分成','撤销推荐分成'
            ,'分销账户提现到余额','拒绝提现','平台结算进账','神码收银','购买短信','储值卡充值'
            ,'退款成功退还运费','取消提现','线下消费余额','提现手续费','线下收款'],
        $process_type
    );
}

/**
 * 格式化店铺结算状态
 *
 * @param $chargeoff_status
 * @return string|string[]
 */
function format_bill_shop_status($chargeoff_status = -1)
{
    //shop_status 结算状态 0-未出账 2-已出账，待结算 3-已出账，已结算 4-部分账单已出账，已结算
    // 出账状态 0:未出账 1:已出账 2:账单结束 3:关闭账单
    if ($chargeoff_status == -1) {
        return '';
    }

    return str_replace(
        [0,1,2,3],
        ['未出账','已出账','账单结束','关闭账单'],
        $chargeoff_status
    );
}

/**
 * 格式化会员资金提现状态
 *
 * @param int $status
 * @return string
 */
function format_user_capital_status($status = 0)
{
    $data = [
        0 => '待审核',
        1 => '审核通过，转账中',
        2 => '提现成功',
        3 => '已取消',
        4 => '已拒绝',
    ];
    if (!isset($data[$status])) {
        return '';
    }
    return $data[$status];
}

/**
 * 生成订单编号
 *
 * 长度 = 8位 + 2位 + 4位 + 6位 = 20位 如: 20190309 10 0059 974040
 *
 * @return string
 */
function make_order_sn()
{
    return format_time(time(), 'Ymd')
    . sprintf('%02d', mt_rand(0, 10)) // 0-10取两位 不足两位前面加0补两位
    . format_time(time(), 'is')
    . mt_rand(100000, 999999);
}
