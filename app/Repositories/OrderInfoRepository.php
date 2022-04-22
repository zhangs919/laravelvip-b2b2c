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


use App\Models\Goods;
use App\Models\GoodsSku;
use App\Models\OrderInfo;
use App\Models\SelfPickup;
use App\Models\Shop;
use App\Models\ShopFieldValue;
use App\Models\User;

class OrderInfoRepository
{
    use BaseRepository;

    protected $model;


    public function __construct()
    {
        $this->model = new OrderInfo();
    }


    // todo 获取每个状态的订单数量并返回
    public function getOrderCounts()
    {
        $data = [
            'all' => "0",
            'assign' => "0",
            'backing' => "0",
            'cancel' => "0",
            'closed' => "0",
            'finished' => "0",
            'pending' => "0",
            'shipped' => "0",
            'shipped_part' => "0",
            'unevaluate' => "0",
            'unpayed' => "0",
            'unshipped' => "0",
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
                $pickup_info = SelfPickup::select('pickup_name','pickup_address','pickup_tel')->find($v['pickup_id']);
                
                // 会员信息
                $user_info = User::select(['user_name','nickname','mobile','email'])->find($v['user_id']);
                
                // 店铺信息
                $shop_info = Shop::select(['shop_name','shop_type','take_rate'])->find($v['shop_id']);
                
                // 客服信息
                $customerRep = new CustomerRepository();
                $customer_info = $customerRep->getCustomerMain($v['shop_id']);
                
                $v['terminal_no'] = null;
                $v['pickup_name'] = $pickup_info->pickup_name ?? null;
                $v['pickup_address'] = $pickup_info->pickup_address ?? null;
                $v['pickup_tel'] = $pickup_info->pickup_tel ?? null;
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
                $v['order_number'] = 1; // 该会员下单总数
                $v['order_status_format'] = format_order_status($v['order_status']); //'交易关闭'; // todo
                $v['shipping_status_format'] = format_shipping_status($v['shipping_status']); //'待发货'; // todo
                $v['order_from_format'] = format_order_from($v['order_from']);  // WAP端
                $v['shipping_type'] = '普通快递'; // todo
                $v['comment_type'] = 3; //todo
                $v['back_list'] = null; // todo 获取售后信息
                $v['shop_remark_array'] = false; // todo
                
                $v['goods_list'] = [];
                if (!empty($v['order_goods'])) {
                    foreach ($v['order_goods'] as $goods) {
//                        $goods_info = Goods::select(['shop_id'])->find($goods['goods_id']);
                        $goods_contracts = json_decode($goods['goods_contracts'],true);
                        $sku_info = GoodsSku::select(['goods_id','market_price','goods_number'])->find($goods['sku_id']);

                        // 拼接其他字段
                        $goods['take_rate'] = $shop_info->take_rate;
                        $goods['shop_rate'] = '2.00'; // 店铺分佣比例
                        $goods['goods_barcode'] = $sku_info->goods_barcode;
                        $goods['goods_stockcode'] = $sku_info->goods_stockcode;
                        $goods['shop_id'] = $v['shop_id'];
                        $goods['order_status'] = $v['order_status'];
                        $goods['pay_status'] = $v['pay_status'];
                        $goods['is_cod'] = $v['is_cod'];
                        $goods['shop_bonus'] = $v['shop_bonus'];


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
                        $goods['goods_status_format'] = '待付款';

                        $v['goods_list'][] = $goods;
                    }
                }
                
                // 移除 order_goods 对象
                unset($v['order_goods']);
                
                // 其他字段
                $v['rowspan'] = 1;
                $v['commission'] = 0.98;
                $v['order_final'] = 47.92;
                $v['buttons'] = [];
                $v['groupon_status'] = null;
                $v['groupon_status_format'] = null;
                $v['countdown'] = ($v['add_time'] - time()) > 0 ? ($v['add_time'] - time()) : null; // 倒计时
            }
        }
        
        return [$list, $total];
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
                $pickup_info = SelfPickup::select('pickup_name','pickup_address','pickup_tel')->find($v['pickup_id']);

                // 会员信息
//                $user_info = User::select(['user_name','nickname','mobile','email'])->find($v['user_id']);

                // 店铺信息
                $shop_info = Shop::select(['shop_name','shop_type'])->find($v['shop_id']);

                // 客服信息
                $customerRep = new CustomerRepository();
                $customer_info = $customerRep->getCustomerMain($v['shop_id']);

                $v['terminal_no'] = null;
                $v['pickup_name'] = $pickup_info->pickup_name ?? null;
                $v['shop_name'] = $shop_info->shop_name ?? null;
                $v['shop_type'] = $shop_info->shop_type ?? null;
                $v['customer_tool'] = $customer_info->customer_tool ?? null;
                $v['customer_account'] = $customer_info->customer_account ?? null;
                $v['complaint_id'] = null;
                $v['complaint_status'] = null;
                $v['sn'] = $v['order_sn'];
                $v['order_amount_format'] = '￥'.$v['order_amount'];
                $v['order_status_format'] = format_order_status($v['order_status']); //'交易关闭'; // todo
                $v['order_from_format'] = format_order_from($v['order_from']);  // WAP端
                $v['comment_type'] = 3; //todo
                $v['complainted'] = -1; // todo
                // todo 按钮显示控制
                $v['buttons'] = [
                    'cancel_order',
                    'to_pay',
                    'zr_to_pay'
                ];

                $v['goods_list'] = [];
                if (!empty($v['order_goods'])) {
                    foreach ($v['order_goods'] as $goods) {
//                        $goods_info = Goods::select(['shop_id'])->find($goods['goods_id']);
                        $goods_contracts = json_decode($goods['goods_contracts'],true);
                        $sku_info = GoodsSku::select(['goods_id','market_price','sku_image'])->find($goods['sku_id']);

                        // 拼接其他字段
                        $goods['shop_id'] = $v['shop_id'];
                        $goods['contract_ids'] = !empty($goods_contracts) ? implode(',', array_column($goods_contracts, 'contract_id')) : '';
                        $goods['market_price'] = $sku_info->market_price;
                        $goods['sku_image'] = $sku_info->sku_image;

                        $goods['back_id'] = null;
                        $goods['back_status'] = null;
                        $goods['back_number'] = null;

                        $goods['saleservice'] = $goods_contracts; // 根据contract_ids查询保障服务信息
                        $goods['goods_back_format'] = '';
                        $goods['goods_price_format'] = '￥'.$sku_info->goods_price;
                        $goods['market_price_format'] = '￥'.$sku_info->market_price;
                        $goods['gifts_list'] = null; // todo
                        $v['goods_list'][] = $goods;
                    }
                }

                // 移除 order_goods 对象
                unset($v['order_goods']);

                // 其他字段
                $v['rowspan'] = count($v['goods_list']);
                $v['rowspan_all'] = count($v['goods_list']);
                $v['aliim_enable'] = "";
                $v['system_aliim_enable'] = "";
                $v['goods_num'] = array_sum(array_column($v['goods_list'], 'goods_number'));
                $v['groupon_status'] = null;
                $v['groupon_status_format'] = null;
                $v['group_sn'] = null;
                $v['has_backing_goods'] = false;
                $v['countdown'] = ($v['add_time'] - time()) > 0 ? ($v['add_time'] - time()) : null; // 倒计时
            }
        }

        return [$list, $total];
    }

    /**
     * 商家后台 获取订单信息
     * @param $condition
     * @return bool
     */
    public function getOrderInfo($condition)
    {
        $info = $this->model->where($condition)->with(['orderGoods'])->first();
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
        $shop_info = Shop::select(['shop_name','shop_type','take_rate'])->find($info['shop_id']);
        
        /*自提点信息*/
        $info['pickup_name'] = $pickup_info->pickup_name ?? null;
        $info['pickup_address'] = $pickup_info->pickup_address ?? null;
        $info['pickup_tel'] = $pickup_info->pickup_tel ?? null;
        $info['pickup_desc'] = $pickup_info->pickup_desc ?? null;
        $info['pickup_images'] = $pickup_info->pickup_images ?? null;
        $info['sort'] = $pickup_info->sort ?? null;
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
        
        $info['back_id'] = null;
        $info['order_status_code'] = 'unpayed';
        $info['order_status_format'] = format_order_status($info['order_status']); //'交易关闭 | 订单已确认，等待买家付款'; // todo
        $info['shipping_type'] = '普通快递'; // todo
        $info['bonus_all'] = '￥0';
        $info['final_amount'] = '￥50';
        $info['amount_unship'] = '￥50';
        $info['all_delivery'] = false;
        $info['delivery_num'] = 0;

        $info['goods_list'] = [];
        if (!empty($info['order_goods'])) {
            foreach ($info['order_goods'] as $goods) {
                $goods_info = Goods::select(['goods_barcode','goods_stockcode','shop_id'])->find($goods['goods_id']);
                // 拼接其他字段
                $goods['take_rate'] = $shop_info->take_rate;
                $goods['shop_rate'] = '2.00'; // 店铺分佣比例
                $goods['goods_barcode'] = $goods_info->goods_barcode;
                $goods['goods_stockcode'] = $goods_info->goods_stockcode;
                $goods['shop_id'] = $goods_info->shop_id;
                $goods['order_status'] = $info['order_status'];
                $goods['pay_status'] = $info['pay_status'];
                $goods['is_cod'] = $info['is_cod'];
                $goods['shop_bonus'] = $info['shop_bonus'];


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
                $goods['goods_status_format'] = '待付款';

                $info['goods_list'][] = $goods;
            }
        }

        // 移除 order_goods 对象
        unset($info['order_goods']);


        // 其他字段
        $info['delivery_list'] = null;
        $info['comment_type'] = 3;
        $info['buttons'] = [
            "cancel_order",
            "change_order"
        ];
        $info['countdown'] = 86271;

        return $info;
    }

    /**
     * 前端会员中心 获取订单信息
     * @param $condition
     * @return bool
     */
    public function getFrontendOrderInfo($condition)
    {
        $info = $this->model->where($condition)->with(['orderGoods'])->first();
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
        $customerRep = new CustomerRepository();
        $customer_info = $customerRep->getCustomerMain($info['shop_id']);

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

        $info['order_status_code'] = 'unpayed';
        $info['order_status_format'] = format_order_status($info['order_status']); //'交易关闭 | 订单已确认，等待买家付款'; // todo
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
        $info['buttons'] = [
            "del_order",
            "view_logistics",
            "again_buy"
        ];
        $info['aliim_enable'] = '';
        $info['system_aliim_enable'] = null;
        $info['qrcode_image'] = 'http://images.68mall.com/15164/oqrcode/BC/qrcode_86.png'; // todo
        $info['shop_real'] = !empty($shop_real) ? $shop_real->toArray() : [];
        $info['all_bonus_format'] = '￥0';
        $info['favorable'] = 0;
        $info['favorable_format'] = '￥0';
        $info['real_payment'] = 0;
        $info['real_payment_format'] = '￥0';

        // todo
        $delivery_list = [];
        $out_delivery = null;
        $back_goods = null;

        $info['delivery_list'] = $delivery_list;
        $info['out_delivery'] = $out_delivery;
        $info['back_goods'] = $back_goods;
        $info['pay_status_format'] = '实付款';
        $info['complainted'] = -1;
        $info['countdown'] = ($info['add_time'] - time()) > 0 ? ($info['add_time'] - time()) : null; // 倒计时;

        $info['goods_list'] = [];
        if (!empty($info['order_goods'])) {
            foreach ($info['order_goods'] as $goods) {
                $goods_info = Goods::select(['goods_barcode','goods_stockcode','shop_id'])->find($goods['goods_id']);
                // 拼接其他字段
                $goods['take_rate'] = $shop_info->take_rate;
                $goods['shop_rate'] = '2.00'; // 店铺分佣比例
                $goods['goods_barcode'] = $goods_info->goods_barcode;
                $goods['goods_stockcode'] = $goods_info->goods_stockcode;
                $goods['shop_id'] = $goods_info->shop_id;
                $goods['order_status'] = $info['order_status'];
                $goods['pay_status'] = $info['pay_status'];
                $goods['is_cod'] = $info['is_cod'];
                $goods['shop_bonus'] = $info['shop_bonus'];


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
                $goods['goods_status_format'] = '待付款';

                $info['goods_list'][] = $goods;
            }
        }

        // 移除 order_goods 对象
        unset($info['order_goods']);


        // 其他字段
        $info['delivery_list'] = null;
        $info['comment_type'] = 3;
        $info['buttons'] = [
            "cancel_order",
            "change_order"
        ];
        $info['countdown'] = 86271;

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
                $v['order_status_format'] = format_order_status($v['order_status']); //'交易关闭'; // todo
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
}