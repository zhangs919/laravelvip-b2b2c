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
// | Date:2018-10-26
// | Description: 订单信息
// +----------------------------------------------------------------------

namespace App\Repositories;


use App\Models\BackOrder;
use App\Models\Goods;
use App\Models\GoodsSku;
use App\Models\GrouponLog;
use App\Models\OrderInfo;
use App\Models\SelfPickup;
use App\Models\Shop;
use App\Models\ShopFieldValue;
use App\Models\User;
use App\Services\Enum\ActTypeEnum;

class OrderInfoRepository
{
    use BaseRepository;

    protected $model;
    protected $customer;


    public function __construct()
    {
        $this->model = new OrderInfo();
        $this->customer = new CustomerRepository();
    }


    /**
     * 获取每个状态的订单数量并返回
     *
     * @param int $userId
     * @param int $shopId
     * @param int $type 0-平台方后台/商家方后台ajax获取  1-商家方后台APP接口/会员中心
     * @param int $is_delete 是否删除 默认0
     * @return array
     */
    public function getOrderCounts($userId = 0, $shopId = 0, $type = 0, $is_delete = 0)
    {
        // 订单状态 0-订单已确认 1-交易成功 2-卖家取消 3-买家取消 4-系统自动取消 10-抢单中
        // 配送状态 0-待发货 1-已发货 2-发货中 3-已提交物流系统
        // 支付状态 0-未支付 1-已支付
        // 用户提交取消申请状态 默认0 无取消申请 1等待商家审核 2商家审核通过 3商家拒绝通过

        $where = [];

        if ($userId) {
            $where[] = ['user_id', $userId];
        }

        if ($shopId) {
            $where[] = ['shop_id', $shopId];
        }

        // todo
        $where[] = ['is_delete', $is_delete];

        // 根据 3种状态来判断 商家中心订单列表状态

        // 全部订单
        $all = OrderInfo::where($where)->count();
        // 等待买家付款
        $unpayed = OrderInfo::where($where)
            ->whereIn('order_status', [OS_UNCONFIRMED, OS_CONFIRMED])
            ->where('pay_status', PS_UNPAYED)->count();
        // 待发货未指派
        $unshipped = OrderInfo::where($where)
            ->where('order_status', OS_CONFIRMED)
            ->where('shipping_status', SS_UNSHIPPED)
            ->whereIn('pay_status', [PS_PAYING, PS_PAYED])
            ->count();
        // todo 待发货已指派
        $assign = OrderInfo::where($where)
            ->whereIn('order_status', [OS_SPLITED, OS_SPLITING_PART, OS_RETURNED_PART])
            ->whereIn('shipping_status', [SS_PREPARING, SS_SHIPPED_PART, SS_SHIPPED_ING])
            ->whereIn('pay_status', [PS_PAYING, PS_PAYED, PS_REFOUND_PART])
            ->count();
        // 已发货
        $shipped = OrderInfo::where($where)
            ->whereIn('order_status', [OS_CONFIRMED, OS_SPLITED])
            ->where('shipping_status', SS_SHIPPED)
            ->where('pay_status', PS_PAYED)
            ->count();
        // 退款中的订单 todo
        $backing = OrderInfo::where($where)
            ->where('order_status', OS_ONLY_REFOUND)
            ->count();
        // unevaluate
        $unevaluate = OrderInfo::where($where)
            ->whereIn('order_status', [OS_CONFIRMED, OS_SPLITED, OS_RETURNED_PART, OS_ONLY_REFOUND])
            ->where('pay_status', PS_PAYED)
            ->where('evaluate_status', ES_UNEVALUATED)
            ->count();

        // 交易成功
        $finished = OrderInfo::where($where)
            ->whereIn('order_status', [OS_CONFIRMED, OS_SPLITED, OS_RETURNED_PART, OS_ONLY_REFOUND])
            ->where('shipping_status', SS_RECEIVED)
            ->where('pay_status', PS_PAYED)
            ->count();
        // 发货中
        $shipped_part = OrderInfo::where($where)
            ->whereIn('order_status', [OS_SPLITED, OS_SPLITING_PART, OS_RETURNED_PART])
            ->whereIn('shipping_status', [SS_PREPARING, SS_SHIPPED_PART, SS_SHIPPED_ING])
            ->whereIn('pay_status', [PS_PAYING, PS_PAYED, PS_REFOUND_PART])
            ->count();
        // 交易关闭
        $closed = OrderInfo::where($where)
            ->whereIn('order_status', [OS_CANCELED, OS_INVALID])
            ->count();
        // 取消订单申请
        $cancel = OrderInfo::where($where)
            ->where('order_status', OS_CONFIRMED)
            ->where('order_cancel', OC_WAIT_AUDIT)
            ->count();
        // 待接单 todo
        $pending = OrderInfo::where($where)
            ->where('order_status', OS_CONFIRMED)
            ->count();

        $data = [
            'all' => $all,
            'unpayed' => $unpayed,
            'unshipped' => $unshipped,
            'assign' => $assign,
            'shipped' => $shipped,
            'unevaluate' => $unevaluate,
			'backing' => $backing,
			'finished' => $finished,
            'shipped_part' => $shipped_part,
            'closed' => $closed,
            'cancel' => $cancel,
        ];

        if ($type == 0) {
            $data['pending'] = $pending;
        }

        return $data;
    }

	public function getOrderStateFormat()
	{
		$data = [
			'all' => '所有订单',
			'unpayed' => '待付款',
			'unshipped' => '待发货',
			'assign' => '待发货已指派',
			'shipped' => '待收货',
			'unevaluate' => '待评价',
			'backing' => '退款',
			'finished' => '交易成功',
			'shipped_part' => '发货中',
			'closed' => '交易关闭',
			'cancel' => '订单取消',
			'pending' => '待接单',
		];
		return $data;
	}

    /**
     * 商家后台 订单列表 格式化输出（json）
     * @param $condition
     * @return array
     */
    public function getOrderList($condition)
    {
        list($list, $total) = $this->model->getList($condition);

        $list = $list->toArray();
        if (!empty($list)) {
            foreach ($list as &$v) {
                // 拼接其他字段
                // 自提点信息
//                $pickup_info = SelfPickup::select('pickup_name','pickup_address','pickup_tel')->find($v['pickup_id']);
                $pickup_info = $v['pickup'];

                // 会员信息
                $user_info = User::select(['user_name','nickname','mobile','email'])->find($v['user_id']);

                // 店铺信息
                $shop_info = Shop::select(['shop_name','shop_type','take_rate'])->find($v['shop_id']);

                // 客服信息
                $customer_info = $this->customer->getCustomerMain($v['shop_id']);

                $v['pickup_name'] = $pickup_info['pickup_name'] ?? null;
                $v['pickup_address'] = $pickup_info['pickup_address'] ?? null;
                $v['pickup_tel'] = $pickup_info['pickup_tel'] ?? null;
                $v['pickup_region_code'] = $pickup_info['region_code'] ?? null;

                $v['user_name'] = $user_info->user_name ?? null;
                $v['nickname'] = $user_info->nickname ?? null;
                $v['mobile'] = $user_info->mobile ?? null;
                $v['user_email'] = $user_info->email ?? null;
                $v['shop_name'] = $shop_info->shop_name ?? null;
                $v['shop_type'] = $shop_info->shop_type ?? null;
                $v['customer_tool'] = $customer_info->customer_tool ?? null;
                $v['customer_account'] = $customer_info->customer_account ?? null;
                $v['store_name'] = null;

                // 发票信息
                $v['inv_id'] = null;
                $v['inv_type'] = null;
                $v['inv_title'] = null;
                $v['inv_content'] = null;
                $v['inv_company'] = null;
                $v['inv_taxpayers'] = null;
                $v['inv_address'] = null;
                $v['inv_tel'] = null;
                $v['inv_account'] = null;
                $v['inv_bank'] = null;
                $v['inv_money'] = null;
                $v['goods_number'] = count($v['order_goods']); // 该订单商品总数
                $v['comstore_name'] = null; // todo
                $v['owner_name'] = null; // todo
                $v['cs_region_name'] = null; // todo
                $v['cs_address'] = null; // todo
                $v['cs_user_id'] = null; // todo
                // 订单活动数据
                $order_data = !empty($v['order_data']) ? json_decode($v['order_data'], true) : [];
                if (!empty($order_data)) {
                    $v = array_merge($v, $order_data);
                }
                $v['order_number'] = 1; // 该会员下单总数
                $v['order_status_format'] = format_order_status($v['order_status'],$v['shipping_status'],$v['pay_status']); //'交易关闭'; // todo
                $v['shipping_status_format'] = format_shipping_status($v['shipping_status']); //'待发货'; // todo
                $v['order_from_format'] = format_order_from($v['order_from']);  // WAP端
                $v['shipping_type'] = '普通快递'; // todo
                $v['comment_type'] = 3; //todo
                $v['back_list'] = null; // todo 获取售后信息
                $v['commission'] = 0; // todo 平台佣金
                $v['shop_remark_array'] = false; // todo

                $v['mall_remark'] = unserialize($v['mall_remark']);
                $v['site_remark'] = unserialize($v['site_remark']);
                $v['shop_remark'] = unserialize($v['shop_remark']);
                $v['store_remark'] = unserialize($v['store_remark']);

                $v['goods_list'] = [];
                if (!empty($v['order_goods'])) {
                    foreach ($v['order_goods'] as $goods) {
//                        $goods_info = Goods::select(['shop_id'])->find($goods['goods_id']);
                        $goods_contracts = json_decode($goods['goods_contracts'],true);
                        $sku_info = GoodsSku::select(['goods_id','market_price','goods_number'])->find($goods['sku_id']);
//                        $sku_info = $goods['goods_sku'];
//                        dd($goods);
                        // 拼接其他字段
//                        $goods['take_rate'] = $shop_info->take_rate;
//                        $goods['shop_rate'] = '2.00'; // 店铺分佣比例
//                        $goods['goods_barcode'] = $sku_info->goods_barcode;
//                        $goods['goods_stockcode'] = $sku_info->goods_stockcode;

                        $goods['shop_id'] = $v['shop_id'];
                        $goods['order_status'] = $v['order_status'];
                        $goods['pay_status'] = $v['pay_status'];
                        $goods['is_cod'] = $v['is_cod'];
                        $goods['shop_bonus'] = $v['shop_bonus'];
                        $goods['buy_type'] = $v['buy_type'];
                        $goods['contract_ids'] = !empty($goods_contracts) ? implode(',', array_column($goods_contracts, 'contract_id')) : '';
                        $goods['market_price'] = $sku_info->market_price;
                        $goods['goods_stock'] = $sku_info->goods_number; // 商品库存
                        $goods['back_id'] = null;
                        $goods['back_status'] = null;
                        $goods['back_number'] = null;
                        $goods['third_id'] = null;
                        $goods['url'] = null;
                        $goods['saleservice'] = $goods_contracts; // 根据contract_ids查询保障服务信息
                        $goods['goods_back_format'] = '';
                        $goods['goods_status_format'] = format_order_status($v['order_status'],$v['shipping_status'],$v['pay_status']); // 取订单状态

                        $goods['act_labels'] = $this->getActLabels($v);

                        $v['goods_list'][] = $goods;
                    }
                }

                // 移除 order_goods 对象
                unset($v['order_goods']);
                $v['countdown'] = $this->getOrderCountdown($v); // 倒计时

                // 其他字段
                $v['rowspan'] = count($v['goods_list']);
                $v['order_final'] = $v['order_amount'] - $v['commission'];
                $delivery_info = !empty($v['delivery_list']['goods_list']) ? array_first($v['delivery_list']['goods_list']) : [];
                $v['buttons'] = get_order_all_operate_state($v, $delivery_info, 'shop');

                $groupon_log = GrouponLog::where('order_sn', $v['order_sn'])->first();
                $v['groupon_status'] = !empty($groupon_log) ? $groupon_log->status : null;
                $v['groupon_status_format'] = !empty($groupon_log) ? str_replace([0,1,2], ['买家已付款，等待成团', '拼团成功', '拼团失败，交易取消'], $v['groupon_status']) : null;
                $v['order_status_text'] = format_order_status($v['order_status'],$v['shipping_status'],$v['pay_status']); // 取订单状态

            }
        }

        return [$list, $total];
    }

    /**
     * 获取订单活动标签
     * 商家后台
     *
     * @param $order_type
     * @return array
     */
    public function getActLabels($v)
    {
        $act_labels = [];
        if (empty($v['order_type'])) {
            return $act_labels;
        }
        switch ($v['order_type']) {
            case ActTypeEnum::ACT_TYPE_FIGHT_GROUP:
                $act_label = [
                    'code' => 'fight-group',
                    'name' => '拼团',
                    'color' => '#FA8E1D',
                ];
                if (!empty($v['group_sn'])) {
                    $act_label['url'] = '/dashboard/groupon-order/info?group_sn='.$v['group_sn'];
                    $act_label['title'] = '点击查看看拼团详情';
                    $act_label['group_sn'] = $v['group_sn'];
                }
                $act_labels[] = $act_label;
                break;

            case ActTypeEnum::ACT_TYPE_BARGAIN:
                $act_labels[] = [
                    'code' => 'bargain',
                    'name' => '砍价',
                    'color' => '#F0AA4A',
                ];
                break;

            case ActTypeEnum::ACT_TYPE_LIMIT_DISCOUNT:
                $act_labels[] = [
                    'code' => 'limited-discount',
                    'name' => '限时抢',
                    'color' => '#FD7622',
                ];
                break;

            default:

                break;
        }

        return $act_labels;

    }

    /**
     * 前端会员中心 订单列表 格式化输出（json）
     * @param $condition
     * @return array
     */
    public function getFrontendOrderList($condition)
    {
        list($list, $total) = $this->model->getList($condition);

        $list = $list->toArray();

        if (!empty($list)) {
            foreach ($list as &$v) {
                // 拼接其他字段
                // 自提点信息
                $pickup_info = $v['pickup'];

                // 会员信息
//                $user_info = User::select(['user_name','nickname','mobile','email'])->find($v['user_id']);

                // 店铺信息
                $shop_info = Shop::select(['shop_name','shop_type'])->find($v['shop_id']);

                // 客服信息
                $customer_info = $this->customer->getCustomerMain($v['shop_id']);

                $v['pay_time'] = format_time($v['pay_time']);
                $v['shipping_time'] = format_time($v['shipping_time']);
                $v['confirm_time'] = format_time($v['confirm_time']);
                $v['evaluate_time'] = format_time($v['evaluate_time']);
                $v['end_time'] = format_time($v['end_time']);
                $v['pickup_name'] = $pickup_info['pickup_name'] ?? null;
                $v['shop_name'] = $shop_info->shop_name ?? null;
                $v['shop_type'] = $shop_info->shop_type ?? null;
                $v['customer_tool'] = $customer_info->customer_tool ?? null;
                $v['customer_account'] = $customer_info->customer_account ?? null;
                $v['complaint_id'] = null;
                $v['complaint_status'] = null;
                $v['comstore_name'] = null;
                $v['sn'] = $v['order_sn'];
                $v['order_amount_format'] = '￥'.$v['order_amount'];
                $v['order_status_format'] = format_order_status($v['order_status'],$v['shipping_status'],$v['pay_status']); //'交易关闭'; // todo
                $v['order_from_format'] = format_order_from($v['order_from']);  // WAP端
                $v['comment_type'] = 3; //todo
                $v['shop_url'] = "/shop/{$v['shop_id']}.html";
                $v['complainted'] = -1; // todo


                $v['goods_list'] = [];
                $v['group_name'] = [];
                $v['group_num'] = [];
                if (!empty($v['order_goods'])) {
                    foreach ($v['order_goods'] as $goods) {
//                        $goods_info = Goods::select(['shop_id'])->find($goods['goods_id']);
                        $goods_contracts = json_decode($goods['goods_contracts'],true);
//                        $sku_info = GoodsSku::select(['goods_id','market_price','sku_image'])->find($goods['sku_id']);

                        // 拼接其他字段
                        $goods['shop_id'] = $v['shop_id'];
                        $goods['contract_ids'] = !empty($goods_contracts) ? implode(',', array_column($goods_contracts, 'contract_id')) : '';
                        $goods['market_price'] = $goods['original_price'];
                        $goods['sku_image'] = get_image_url($goods['goods_image']);
                        $goods['goods_image'] = get_image_url($goods['goods_image']);

                        $goods['back_id'] = null;
                        $goods['back_status'] = null;
                        $goods['back_number'] = null;

                        $goods['saleservice'] = $goods_contracts; // 根据contract_ids查询保障服务信息
                        $goods['goods_back_format'] = '';
                        $goods['goods_price_format'] = '￥'.$goods['goods_price'];
                        $goods['market_price_format'] = '￥'.$goods['original_price'];
                        $goods['gifts_list'] = null; // todo
                        $goods['act_labels'] = $this->getActLabels($v);

                        $v['goods_list'][] = $goods;

                        $v['group_name'][] = $goods['goods_name'];
                        $v['group_num'][] = $goods['goods_number'];
                    }
                }
                $v['group_name'] = implode(',', $v['group_name']);
                $v['group_num'] = implode(',', $v['group_num']);

                // 移除 order_goods 对象
                unset($v['order_goods']);

                // 其他字段
                $v['rowspan'] = count($v['goods_list']);
                $v['rowspan_all'] = count($v['goods_list']);
                $v['aliim_enable'] = "";
                //https://kf.xxx.com/index/index/home?business_id=xxxxxx&groupid=0&shop_id=309&goods_id=0&visiter_id=2711_1737&visiter_name=qdm&avatar=https://xxx.oss-cn-beijing.aliyuncs.com/images/system/config/default_image/default_user_portrait_0.png&domain=https://www.xxx.com&product=&goods_type=0
                $v['yikf_url'] = null;
                $v['system_aliim_enable'] = "";
                $v['goods_num'] = array_sum(array_column($v['goods_list'], 'goods_number'));
                $v['groupon_status'] = null;
                $v['groupon_status_format'] = null;
                $v['group_sn'] = null;
                $v['has_backing_goods'] = false;
                $v['countdown'] = $this->getOrderCountdown($v); // 倒计时

                // 按钮显示控制
                $v['buttons'] = get_order_all_operate_state($v, [], 'buyer');
//                $v['buttons'] = [
//                    'cancel_order',
//                    'to_pay',
//                    'zr_to_pay'
//                ];
            }
        }

        return [$list, $total];
    }

    /**
     * 商家后台 获取订单信息
     * @param $condition
     * @return array
     */
    public function getOrderInfo($condition)
    {
        $info = $this->model->where($condition)->with(['orderGoods','pickup','shop','deliveryOrder'])->first();
        if (empty($info)) {
            return [];
        }
        $info = $info->toArray();
//        $info['terminal_no'] = null;

        // 自提点信息
//        $pickup_info = SelfPickup::select('pickup_name','pickup_address','pickup_tel')->find($info['pickup_id']);
        $pickup_info = $info['pickup'];

        // 会员信息
        $user_info = User::select(['user_name','nickname','mobile','email'])->find($info['user_id']);

        // 店铺信息
        $shop_info = Shop::select(['shop_name','shop_type','take_rate'])->find($info['shop_id']);

        /*自提点信息*/
        $info['pickup_name'] = $pickup_info['pickup_name'] ?? null;
        $info['pickup_address'] = $pickup_info['pickup_address'] ?? null;
        $info['pickup_tel'] = $pickup_info['pickup_tel'] ?? null;
        $info['pickup_region_code'] = $pickup_info['pickup_region_code'] ?? null;
        /*自提点信息*/

        $info['user_name'] = $user_info->user_name ?? null;
        $info['shop_name'] = $shop_info->shop_name ?? null;

        /*发票信息*/
        $info['inv_id'] = null;
        $info['inv_type'] = null;
        $info['inv_title'] = null;
        $info['inv_content'] = null;
        $info['inv_company'] = null;
        $info['inv_taxpayers'] = null;
        $info['inv_address'] = null;
        $info['inv_tel'] = null;
        $info['inv_account'] = null;
        $info['inv_bank'] = null;
        $info['inv_money'] = null;
        /*发票信息*/

        // 订单活动数据
        $order_data = !empty($info['order_data']) ? json_decode($info['order_data'], true) : [];
        if (!empty($order_data)) {
            $info = array_merge($info, $order_data);
        }
        $info['back_id'] = null;
        $info['order_status_code'] = format_order_status($info['order_status'],$info['shipping_status'],$info['pay_status'],null,1);
        $info['order_status_format'] = format_order_status($info['order_status'],$info['shipping_status'],$info['pay_status']); //'交易关闭 | 订单已确认，等待买家付款'; // todo
        $info['shipping_type'] = '普通快递'; // todo
        $info['bonus_all'] = '￥'.($info['bonus']+$info['shop_bonus']);
        // 商品总金额：￥24.80 goods_amount
        // + 运费：￥1.00 shipping_fee
        // - 店铺红包：￥3.00 shop_bonus
        // - 平台红包：￥0.00 bonus
        // - 积分抵扣：￥0.00 integral_money
        // - 卖家优惠：￥2.00 discount_fee
        // = 订单总金额：￥20.80 order_amount
        // ￥2.00 final_amount
        // 余额支付：15.79 + 在线支付：0.01 = 15.80

        // todo 计算公式需再确认
        $info['final_amount'] = '￥'.($info['order_amount']);
        $info['amount_unship'] = '￥'.$info['order_amount'];
        $info['all_delivery'] = false; // 是否一键发货
        $info['delivery_num'] = 0; // 已发货数量
        $info['delivery_number'] = 0; // 总发货数量

        $info['goods_list'] = [];
        if (!empty($info['order_goods'])) {
            foreach ($info['order_goods'] as &$goods) {
//                $goods_info = Goods::select(['shop_id'])->find($goods['goods_id']);
                $goods_contracts = json_decode($goods['goods_contracts'],true);
                $sku_info = GoodsSku::select(['goods_id','market_price','goods_number'])->find($goods['sku_id']);

                // 拼接其他字段
//                        $goods['take_rate'] = $shop_info->take_rate;
//                        $goods['shop_rate'] = '2.00'; // 店铺分佣比例
//                        $goods['goods_barcode'] = $sku_info->goods_barcode;
//                        $goods['goods_stockcode'] = $sku_info->goods_stockcode;

                $goods['shop_id'] = $info['shop_id'];
                $goods['order_status'] = $info['order_status'];
                $goods['pay_status'] = $info['pay_status'];
                $goods['is_cod'] = $info['is_cod'];
                $goods['shop_bonus'] = $info['shop_bonus'];
                $goods['buy_type'] = $info['buy_type'];
                $goods['contract_ids'] = !empty($goods_contracts) ? implode(',', array_column($goods_contracts, 'contract_id')) : '';
                $goods['market_price'] = $sku_info->market_price;
                $goods['goods_stock'] = $sku_info->goods_number; // 商品库存

                // 获取售后信息
                $goods['back_id'] = null;
                $goods['back_status'] = null;
                $goods['back_number'] = null;
                $goods['goods_back_format'] = '';

                $back_order = BackOrder::where([['record_id', $goods['record_id']]])->select(['back_id', 'back_status', 'back_number', 'back_type'])->first();

                if (!empty($back_order)) {
                    $goods['back_id'] = $back_order->back_id;
                    $goods['back_status'] = $back_order->back_status;
                    $goods['back_number'] = $back_order->back_number;
                    $goods['goods_back_format'] = format_back_order_status($back_order->back_status, $back_order->back_type);
                }

                $goods['third_id'] = null;
                $goods['url'] = null;
                $goods['saleservice'] = $goods_contracts; // 根据contract_ids查询保障服务信息
                $goods['goods_status_format'] = format_order_status($info['order_status'],$info['shipping_status'],$info['pay_status']); // 取订单状态
                $goods['act_labels'] = $this->getActLabels($info);

                $info['goods_list'][] = $goods;
            }
        }
        // 移除 order_goods 对象
        unset($info['order_goods']);

        // 获取发货单物流列表
        $info['delivery_list'] = [];
        if (!empty($info['delivery_order'])){
            $deliveryOrder = $info['delivery_order'];
            $deliveryGoodsList = [];
            if (!empty($deliveryOrder['delivery_goods'])) {
                foreach ($deliveryOrder['delivery_goods'] as $deliveryGood) {

                    $goods_contracts = json_decode($deliveryGood['order_goods']['goods_contracts'],true);

                    $deliveryGoodsList[] = [
                        'id' => $deliveryGood['id'],
                        'goods_id' => $deliveryGood['goods_id'],
                        'sku_id' => $deliveryGood['sku_id'],
                        'send_number' => $deliveryGood['send_number'],

                        /*从发货单订单表读取数据*/
                        'delivery_id' => $deliveryGood['delivery_id'],
                        'delivery_sn' => $deliveryOrder['delivery_sn'],
                        'order_id' => $deliveryOrder['order_id'],
                        'user_id' => $deliveryOrder['user_id'],
                        'shipping_id' => $deliveryOrder['shipping_id'],
                        'shipping_code' => $deliveryOrder['shipping_code'],
                        'shipping_name' => $deliveryOrder['shipping_name'],
                        'shipping_type' => $deliveryOrder['shipping_type'],
                        'delivery_charge' => $deliveryOrder['delivery_charge'],
                        'sender_id' => $deliveryOrder['sender_id'],
                        'region_code' => $deliveryOrder['region_code'],
                        'name' => $deliveryOrder['name'],
                        'address' => $deliveryOrder['address'],
                        'tel' => $deliveryOrder['tel'],
                        'express_sn' => $deliveryOrder['express_sn'],
                        'delivery_status' => $deliveryOrder['delivery_status'],
                        'add_time' => $deliveryOrder['add_time'],
                        'send_time' => $deliveryOrder['send_time'],
                        'icode' => $deliveryOrder['icode'],
                        'is_show' => $deliveryOrder['is_show'],
                        'is_arrived' => $deliveryOrder['is_arrived'],
                        'exception_reason' => $deliveryOrder['exception_reason'],

                        /*从订单商品表读取数据*/
                        'goods_image' => get_image_url($deliveryGood['order_goods']['goods_image']),
                        'goods_name' => $deliveryGood['order_goods']['goods_name'],
                        'spec_info' => $deliveryGood['order_goods']['spec_info'],
                        'goods_price' => $deliveryGood['order_goods']['goods_price'],
                        'other_price' => $deliveryGood['order_goods']['other_price'],
                        'pay_change' => $deliveryGood['order_goods']['pay_change'],
                        'contract_ids' => !empty($goods_contracts) ? implode(',', array_column($goods_contracts, 'contract_id')) : '',
                        'saleservice' => $goods_contracts, // 根据contract_ids查询保障服务信息
                    ];

                }
                $info['delivery_list']['goods_list'][] = $deliveryGoodsList;
                // todo
                $info['delivery_list']['base_info'] = array_first($deliveryGoodsList);
            }
        }
        // 移除 delivery_order 对象
        unset($info['delivery_order']);
        $info['countdown'] = $this->getOrderCountdown($info); // 倒计时



        // 其他字段
        $info['comment_type'] = 3;
        $delivery_info = !empty($info['delivery_list']['goods_list']) ? array_first($info['delivery_list']['goods_list']) : [];
        $info['buttons'] = get_order_all_operate_state($info, $delivery_info, 'shop');

        $groupon_log = GrouponLog::where('order_sn', $info['order_sn'])->first();
        $info['groupon_status'] = !empty($groupon_log) ? $groupon_log->status : null;
        $info['groupon_status_format'] = !empty($groupon_log) ? str_replace([0,1,2], ['买家已付款，等待成团', '拼团成功', '拼团失败，交易取消'], $info['groupon_status']) : null;
//        $info['buttons'] = [
//            "cancel_order",
//            "change_order"
//        ];

        return $info;
    }

    /**
     * 前端会员中心 获取订单信息
     * @param $condition
     * @return bool
     */
    public function getFrontendOrderInfo($condition)
    {
        $info = $this->model->where($condition)->with(['orderGoods', 'deliveryOrder', 'deliveryOrder.deliveryGoods', 'deliveryOrder.deliveryGoods.orderGoods'])->first();
        if (empty($info)) {
            return false;
        }
        $info = $info->toArray();
        $info['terminal_no'] = null;

        // 自提点信息
        $pickup_info = SelfPickup::select('pickup_name','pickup_address','pickup_tel')->find($info['pickup_id']);

        // 会员信息
        $user_info = User::select(['user_name','nickname','mobile','email'])->find($info['user_id']);

        // 店铺信息
        $shop_info = Shop::select(['shop_name','shop_type','take_rate','service_tel'])->find($info['shop_id']);
        // 卖家入驻认证信息
        $shop_real = ShopFieldValue::where('shop_id', $info['shop_id'])
            ->select(['real_name','card_no','hand_card','card_side_a','card_side_b','address','special_aptitude'])
            ->first();

        // 客服信息
        $customer_info = $this->customer->getCustomerMain($info['shop_id']);

        $info['pay_time'] = format_time($info['pay_time']);
        $info['shipping_time'] = format_time($info['shipping_time']);
        $info['confirm_time'] = format_time($info['confirm_time']);
        $info['evaluate_time'] = format_time($info['evaluate_time']);
        $info['end_time'] = format_time($info['end_time']);

        /*自提点信息*/
        $info['pickup_name'] = $pickup_info->pickup_name ?? null;
        $info['pickup_address'] = $pickup_info->pickup_address ?? null;
        $info['pickup_tel'] = $pickup_info->pickup_tel ?? null;
        $info['pickup_desc'] = $pickup_info->pickup_desc ?? null;
        $info['pickup_images'] = $pickup_info->pickup_images ?? null;
        /*自提点信息*/

        /*发票信息*/
        $info['inv_id'] = null;
        $info['inv_type'] = null;
        $info['inv_title'] = null;
        $info['inv_content'] = null;
        $info['inv_company'] = null;
        $info['inv_taxpayers'] = null;
        $info['inv_address'] = null;
        $info['inv_tel'] = null;
        $info['inv_account'] = null;
        $info['inv_bank'] = null;
        $info['inv_money'] = null;
        /*发票信息*/

        $info['ship_time'] = $info['shipping_time'];
        $info['comment_id'] = '155'; // todo
        $info['shop_name'] = $shop_info->shop_name;
        $info['shop_type'] = $shop_info->shop_type;
        $info['service_tel'] = $shop_info->service_tel;
        $info['customer_tool'] = $customer_info->customer_tool ?? null;
        $info['customer_account'] = $customer_info->customer_account ?? null;

        $info['back_id'] = null;
        $info['parent_id'] = null;
        $info['complaint_id'] = null;
        $info['complaint_status'] = null;

        $info['order_status_code'] = format_order_status($info['order_status'],$info['shipping_status'],$info['pay_status'],null,1);
        $info['order_status_format'] = format_order_status($info['order_status'],$info['shipping_status'],$info['pay_status']); //'交易关闭 | 订单已确认，等待买家付款'; // todo
        $info['goods_amount_format'] = '￥'.$info['goods_amount'];
        $info['inv_fee_format'] = '￥'.$info['inv_fee'];
        $info['shipping_fee_format'] = '￥'.$info['shipping_fee'];
        $info['cash_more_format'] = '￥'.$info['cash_more'];
        $info['discount_fee_format'] = '￥'.$info['discount_fee'];
        $info['change_amount_format'] = '￥'.$info['change_amount'];
        $info['shipping_change_format'] = '￥'.$info['shipping_change'];
        $info['user_surplus_format'] = '￥'.$info['user_surplus'];
        $info['store_card_price_format'] = '￥'.$info['store_card_price'];
        $info['integral_money_format'] = '￥'.$info['integral_money'];
        $info['surplus_format'] = '￥'.$info['surplus'];
        $info['order_amount_format'] = '￥'.$info['order_amount'];
        $info['money_paid_format'] = '￥'.$info['money_paid'];
        $info['comment_type'] = 2; // todo

        $info['aliim_enable'] = '';
        $info['system_aliim_enable'] = null;
        $info['qrcode_image'] = 'http://images.xxxx.com/15164/oqrcode/BC/qrcode_86.png'; // todo
        $info['shop_real'] = !empty($shop_real) ? $shop_real->toArray() : [];
        $info['all_bonus_format'] = '￥0';
        $info['favorable'] = 0;
        $info['favorable_format'] = '￥0';
        $info['real_payment'] = 0;
        $info['real_payment_format'] = '￥0';

        // 获取发货单物流列表
        $info['delivery_list'] = [];
        if (!empty($info['delivery_order'])){
            $deliveryOrder = $info['delivery_order'];
            if ($deliveryOrder['delivery_status'] == 0) {
                $deliveryGoodsList = [];
                if (!empty($deliveryOrder['delivery_goods'])) {
                    foreach ($deliveryOrder['delivery_goods'] as $deliveryGood) {

                        $goods_contracts = json_decode($deliveryGood['order_goods']['goods_contracts'],true);
//                        dd($deliveryGood);

                        $deliveryGoodsList[] = [
                            'id' => $deliveryGood['id'],
                            'goods_id' => $deliveryGood['goods_id'],
                            'sku_id' => $deliveryGood['sku_id'],
                            'send_number' => $deliveryGood['send_number'],

                            /*从发货单订单表读取数据*/
                            'delivery_id' => $deliveryGood['delivery_id'],
                            'delivery_sn' => $deliveryOrder['delivery_sn'],
                            'order_id' => $deliveryOrder['order_id'],
                            'user_id' => $deliveryOrder['user_id'],
                            'shipping_id' => $deliveryOrder['shipping_id'],
                            'shipping_code' => $deliveryOrder['shipping_code'],
                            'shipping_name' => $deliveryOrder['shipping_name'],
                            'shipping_type' => $deliveryOrder['shipping_type'],
                            'delivery_charge' => $deliveryOrder['delivery_charge'],
                            'sender_id' => $deliveryOrder['sender_id'],
                            'region_code' => $deliveryOrder['region_code'],
                            'name' => $deliveryOrder['name'],
                            'address' => $deliveryOrder['address'],
                            'tel' => $deliveryOrder['tel'],
                            'express_sn' => $deliveryOrder['express_sn'],
                            'delivery_status' => $deliveryOrder['delivery_status'],
                            'add_time' => $deliveryOrder['add_time'],
                            'send_time' => $deliveryOrder['send_time'],
                            'icode' => $deliveryOrder['icode'],
                            'is_show' => $deliveryOrder['is_show'],
                            'is_arrived' => $deliveryOrder['is_arrived'],
                            'exception_reason' => $deliveryOrder['exception_reason'],

                            /*从订单商品表读取数据*/
                            'goods_image' => get_image_url($deliveryGood['order_goods']['goods_image']),
                            'goods_name' => $deliveryGood['order_goods']['goods_name'],
                            'spec_info' => $deliveryGood['order_goods']['spec_info'],
                            'goods_price' => $deliveryGood['order_goods']['goods_price'],
                            'other_price' => $deliveryGood['order_goods']['other_price'],
                            'pay_change' => $deliveryGood['order_goods']['pay_change'],
                            'contract_ids' => !empty($goods_contracts) ? implode(',', array_column($goods_contracts, 'contract_id')) : '',
                            'saleservice' => $goods_contracts, // 根据contract_ids查询保障服务信息
                        ];

                    }
                    $info['delivery_list']['goods_list'] = $deliveryGoodsList;
                    // todo
                    $info['delivery_list']['base_info'] = array_first($deliveryGoodsList);
                }
            }
        }
        // 移除 delivery_order 对象
        unset($info['delivery_order']);

        $out_delivery = null;
        $back_goods = null;

        $info['out_delivery'] = $out_delivery;
        $info['back_goods'] = $back_goods;
        $info['pay_status_format'] = '实付款';
        $info['complainted'] = -1;

        $info['goods_list'] = [];
        if (!empty($info['order_goods'])) {
            foreach ($info['order_goods'] as $goods) {
//                $goods_info = Goods::select(['goods_barcode','goods_stockcode','shop_id'])->find($goods['goods_id']);
                // 拼接其他字段
                $goods['take_rate'] = $shop_info->take_rate;
                $goods['shop_rate'] = '2.00'; // 店铺分佣比例
//                $goods['goods_barcode'] = $goods_info->goods_barcode;
//                $goods['goods_stockcode'] = $goods_info->goods_stockcode;
                $goods['shop_id'] = $info['shop_id'];
                $goods['order_status'] = $info['order_status'];
                $goods['pay_status'] = $info['pay_status'];
                $goods['is_cod'] = $info['is_cod'];
                $goods['shop_bonus'] = $info['shop_bonus'];
                $goods['goods_image'] = get_image_url($goods['goods_image']);


                $goods['contract_ids'] = "1";
                $goods['market_price'] = '0.00';
                $goods['goods_stock'] = '999';
                $goods['back_id'] = null;
                $goods['back_status'] = null;
                $goods['back_number'] = null;
                $goods['third_id'] = null;
                $goods['url'] = null;
                $goods['saleservice'] = []; // 根据contract_ids查询保障服务信息
                $goods['goods_back_format'] = '';
                $goods['goods_status_format'] = format_order_status($info['order_status'],$info['shipping_status'],$info['pay_status']); // 取订单状态
                $goods['act_labels'] = $this->getActLabels($info);

                $info['goods_list'][] = $goods;
            }
        }

        // 移除 order_goods 对象
        unset($info['order_goods']);
        $info['countdown'] = $this->getOrderCountdown($info); // 倒计时;

        // 其他字段
        // 订单操作按钮
        $delivery_info = !empty($info['delivery_list']['goods_list']) ? array_first($info['delivery_list']['goods_list']) : [];
        $info['buttons'] = get_order_all_operate_state($info, $delivery_info);
//        $info['buttons'] = [
//            "cancel_order",
//            "change_order",
//            "del_order",
//            "view_logistics",
//            "again_buy"
//        ];

        return $info;
    }

    /**
     * 获取打印订单列表
     * 商家后台
     * @param $condition
     * @return array
     */
    public function getPrintOrderList($condition)
    {
        list($list, $total) = $this->model->getList($condition);

        $list = $list->toArray();

        if (!empty($list)) {
            foreach ($list as &$v) {
                // 拼接其他字段
                // 自提点信息
                $pickup_info = SelfPickup::select('pickup_name','pickup_address','pickup_tel')->find($v['pickup_id']);

                // 会员信息
                $user_info = User::select(['user_name','nickname','mobile','email'])->find($v['user_id']);

                // 店铺信息
                $shop_info = Shop::select(['shop_name','shop_type'])->find($v['shop_id']);

                $v['terminal_no'] = null;
                $v['s_mobile'] = null; // 店铺联系电话
                $v['shop_name'] = $shop_info->shop_name ?? null;
                $v['shop_nickname'] = null; // 店主昵称
                $v['nickname'] = $user_info->nickname ?? null;
                $v['user_name'] = $user_info->user_name ?? null;
                $v['user_mobile'] = $user_info->mobile ?? null;
                // 发票信息
                $v['inv_id'] = null;
                $v['inv_type'] = null;
                $v['inv_title'] = null;
                $v['inv_content'] = null;
                $v['inv_company'] = null;
                $v['inv_taxpayers'] = null;
                $v['inv_address'] = null;
                $v['inv_tel'] = null;
                $v['inv_account'] = null;
                $v['inv_bank'] = null;
                $v['inv_money'] = null;

                $v['pickup_address'] = $pickup_info->pickup_address ?? null;
                $v['consignee_address'] = $v['region_name'].' '.$v['address'] ?? null;
                $v['order_status_format'] = format_order_status($v['order_status'],$v['shipping_status'],$v['pay_status']); //'交易关闭'; // todo
                $v['final_amount'] = '￥50'; // todo
                $v['rank_name'] = null; // 店铺会员等级 todo
                $v['u_shop_name'] = '无'; // 购买者隶属店铺名称 todo
                $v['delivery_address'] = '';

                $v['goods_list'] = [];
                if (!empty($v['order_goods'])) {
                    foreach ($v['order_goods'] as $goods) {
                        $goods_info = Goods::select(['goods_barcode','goods_stockcode','shop_id'])->find($goods['goods_id']);
                        // 拼接其他字段
                        $goods['goods_barcode'] = $goods_info->goods_barcode;
                        $goods['goods_stockcode'] = $goods_info->goods_stockcode;
                        $goods['goods_price_all'] = 50; // todo

                        $v['goods_list'][] = $goods;
                    }
                }


                // 其他字段
                $v['goods_number'] = count($v['order_goods']); // 该订单商品总数

                // 移除 order_goods 对象
                unset($v['order_goods']);
            }
        }

        return [$list, $total];
    }

    /**
     * 获取订单详情页顶部步骤数据
     *
     * @param $orderInfo
     * @param int $type 类型 0-商家中心订单详情 1-买家中心订单详情
     *
     * @return array
     */
    public function getOrderSchedules($orderInfo, $type = 0)
    {
        if ($type == 1) {//买家中心订单详情
            if (in_array($orderInfo['order_status'], [OS_CANCELED])) {
                $orderSchedules = [
                    [
                        'title' => '成交时间',
                        'time' => $orderInfo['add_time'],
                        'status' => '1'
                    ],
                    [
                        'title' => '完结时间',
                        'time' => $orderInfo['end_time'],
                        'status' => '1'
                    ],
                ];
            } else {
                $orderSchedules = [
                    [
                        'title' => '拍下商品',
                        'title_sub' => '下单时间',
                        'time' => $orderInfo['add_time'],
                        'status' => $orderInfo['add_time'] > 0 ? 1 : 0
                    ],
                    [
                        'title' => '买家付款',
                        'title_sub' => '买家付款时间',
                        'time' => $orderInfo['pay_time'],
                        'status' => $orderInfo['pay_time'] > 0 ? 1 : 0
                    ],
                    [
                        'title' => '商家发货',
                        'title_sub' => '商家发货时间',
                        'time' => $orderInfo['shipping_time'],
                        'status' => $orderInfo['shipping_time'] > 0 ? 1 : 0
                    ],
                    [
                        'title' => '确认收货',
                        'title_sub' => '确认收货时间',
                        'time' => $orderInfo['end_time'],
                        'status' => $orderInfo['end_time'] > 0 ? 1 : 0
                    ],
                    [
                        'title' => '买家评价',
                        'title_sub' => '完成时间',
                        'time' => $orderInfo['evaluate_time'],
                        'status' => $orderInfo['evaluate_status'] > 0 ? ES_EVALUATED : ES_UNEVALUATED
                    ],
                ];
            }
        } else {//商家中心订单详情
            if (in_array($orderInfo['order_status'], [OS_CANCELED])) {
                $orderSchedules = [
                    [
                        'title' => '下单时间',
                        'time' => $orderInfo['add_time'],
                        'status' => '1'
                    ],
                    [
                        'title' => '关闭时间',
                        'time' => $orderInfo['end_time'],
                        'status' => '1'
                    ],
                ];
            } else {
                $orderSchedules = [
                    [
                        'title' => '拍下商品',
                        'title_sub' => '下单时间',
                        'time' => $orderInfo['add_time'],
                        'status' => $orderInfo['add_time'] > 0 ? 1 : 0
                    ],
                    [
                        'title' => '买家付款',
                        'title_sub' => '买家付款时间',
                        'time' => $orderInfo['pay_time'],
                        'status' => $orderInfo['pay_time'] > 0 ? 1 : 0
                    ],
                    [
                        'title' => '商家发货',
                        'title_sub' => '商家发货时间',
                        'time' => $orderInfo['shipping_time'],
                        'status' => $orderInfo['shipping_time'] > 0 ? 1 : 0
                    ],
                    [
                        'title' => '确认收货',
                        'title_sub' => '确认收货时间',
                        'time' => $orderInfo['end_time'],
                        'status' => $orderInfo['end_time'] > 0 ? 1 : 0
                    ],
                ];
            }
        }


        return $orderSchedules;
    }


    /**
     * 获取前端购买步骤数据
     *
     * @param array $selected
     * @return array
     */
    public function getPaySteps($selected)
    {
        $data = [
            [
                'step' =>1,
                'name'=>'我的购物车',
                'url'=>'/cart.html',
                'selected' =>in_array(1, $selected)
            ],
            [
                'step' =>2,
                'name'=>'确认订单',
                'url'=>'/checkout.html',
                'selected' =>in_array(2, $selected)
            ],
            [
                'step' =>3,
                'name'=>'付款',
                'selected' =>in_array(3, $selected)
            ],
            [
                'step' =>4,
                'name'=>'支付成功',
                'selected' =>in_array(4, $selected)
            ],
        ];

        return $data;
    }

    /**
     * 获取订单倒计时
     * 待付款状态：付款期限 倒计时
     * 待收货状态：确认收货期限 倒计时
     * 开启接单模式：接单期限 倒计时
     *
     * @param $orderInfo
     * @return float|int|null
     */
    public function getOrderCountdown($orderInfo) {
        // 订单状态 0-订单已确认 1-交易成功 2-卖家取消 3-买家取消 4-系统自动取消 10-抢单中
        // 配送状态 0-待发货 1-已发货 2-发货中 3-已提交物流系统
        $countdown = 0;
        if ($orderInfo['order_status'] == OS_CONFIRMED && $orderInfo['pay_status'] == PS_UNPAYED) {
            // 付款期限 倒计时
            $countdown = ($orderInfo['add_time'] - (time() - get_order_pay_term())) > 0 ? ($orderInfo['add_time'] - (time() - get_order_pay_term())) : null;
        } elseif ($orderInfo['order_status'] == OS_CONFIRMED && $orderInfo['pay_status'] == PS_PAYED && $orderInfo['shipping_status'] == SS_SHIPPED) {
            // 确认收货期限 倒计时
            $countdown = ($orderInfo['confirm_time'] - time()) > 0
                ? ($orderInfo['confirm_time'] - time()) : null;
        }

        return $countdown;
    }

    /**
     * 获取待系统自动取消订单列表
     * @return array
     */
    public function getSystemCancelOrderList()
    {
        $condition = [
            'where' => [
                ['is_delete',0],
                ['order_status', OS_CONFIRMED],
                ['pay_status', PS_UNPAYED],
                ['add_time', '<=', time() - get_order_pay_term()], // 超过xx分钟未付款，系统自动取消订单
            ],
            'with' => ['orderGoods'],
        ];
        list($list, $total) = $this->model->getList($condition);

        $list = $list->toArray();
        if (!empty($list)) {
            foreach ($list as &$v) {
                $v['goods_list'] = [];
                if (!empty($v['order_goods'])) {
                    foreach ($v['order_goods'] as $goods) {
                        $v['goods_list'][] = $goods;
                    }
                }

                // 移除 order_goods 对象
                unset($v['order_goods']);
            }
        }

        return [$list, $total];
    }
}
