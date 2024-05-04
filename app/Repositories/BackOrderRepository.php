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
// | Date:2020-01-13
// | Description: 退款退货、换货维修等售后服务
// +----------------------------------------------------------------------

namespace App\Repositories;


use App\Models\BackLog;
use App\Models\BackOrder;
use App\Models\DeliveryGoods;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class BackOrderRepository
{
    use BaseRepository;

    protected $model;


    public function __construct()
    {
        $this->model = new BackOrder();
    }

    /**
     * 获取平台方后台 退款退货售后单列表
     *
     * @param array $condition
     * @param string $column
     * @return array
     */
    public function getBackendBackOrderList($condition = [], $column = '')
    {
        $data = $this->model->getList($condition, $column);

        if (!$data[0]->isEmpty()) {

            foreach ($data[0] as $key => $value) {
                $orderInfo = $value->orderInfo;
                $orderGoods = $value->orderGoods;
                $shopRep = new ShopRepository();

                $value->order_sn = $orderInfo->order_sn;
                $value->order_amount = $orderInfo->order_amount;
                $value->money_paid = $orderInfo->money_paid;
                $value->sku_name = $orderGoods->goods_name;
                $value->sku_image = get_image_url($orderGoods->goods_image);

                $value->shop = $shopRep->shopInfo($value->shop_id);
                $value->back_status_format = format_back_order_status($value->back_status, $value->back_type);
            }
        }

        $data[0] = $data[0]->toArray();

        return $data;
    }


    /**
     * 获取商家中心 退款退货售后单列表
     *
     * @param array $condition
     * @param string $column
     * @return array
     */
    public function getSellerBackOrderList($condition = [], $column = '')
    {
        $data = $this->model->getList($condition, $column);

        if (!$data[0]->isEmpty()) {

            foreach ($data[0] as $key => $value) {
                $orderInfo = $value->orderInfo;
                $orderGoods = $value->orderGoods;

                $value->order_sn = $orderInfo->order_sn;
                $value->order_amount = $orderInfo->order_amount;
                $value->consignee = $orderInfo->consignee;
                $value->sku_name = $orderGoods->goods_name;
                $value->sku_image = get_image_url($orderGoods->goods_image);
                $value->user_name = $value->user->user_name;
                $value->back_status_format = format_back_order_status($value->back_status, $value->back_type);
            }
        }

        $data[0] = $data[0]->toArray();

        return $data;
    }

    /**
     * 获取商家中心 退款退货售后单详情
     *
     * @param array $condition
     * @return bool|mixed
     */
    public function getSellerBackOrderInfo($condition)
    {
        $info = BackOrder::where($condition)->first();
        if (empty($info)) {
            return false;
        }
        $info->back_reason_format = format_refund_reason($info->back_reason);
        $info->back_status_format = format_back_order_status($info->back_status, $info->back_type);

        $info = $info->toArray();

        return $info;
    }


    /*获取前端数据*/

    /**
     * 获取前端会员中心 退款退货售后单列表
     *
     * @param array $condition
     * @param string $column
     * @return array
     */
    public function getUserCenterBackOrderList($condition = [], $column = '')
    {
        $data = $this->model->getList($condition, $column);

        if (!$data[0]->isEmpty()) {

            foreach ($data[0] as $key => $value) {
                $orderInfo = $value->orderInfo;
                $orderGoods = $value->orderGoods;
                $shopRep = new ShopRepository();

                $value->order_sn = $orderInfo->order_sn;
                $value->order_amount = $orderInfo->order_amount;
                $value->money_paid = $orderInfo->money_paid;
                $value->sku_name = $orderGoods->goods_name;
                $value->sku_image = get_image_url($orderGoods->goods_image);

                $value->shop = $shopRep->shopInfo($value->shop_id);
                $value->back_status_format = format_back_order_status($value->back_status, $value->back_type);
            }
        }

        $data[0] = $data[0]->toArray();

        return $data;
    }

    /**
     * 获取会员中心 退款退货售后单详情
     *
     * @param array $condition
     * @return bool|mixed
     */
    public function getUserCenterBackOrderInfo($condition)
    {
        $info = BackOrder::where($condition)->first();
        if (empty($info)) {
            return false;
        }
        $info->back_reason_format = format_refund_reason($info->back_reason);
        $info->address_info = []; // 退货地址
        $info->seller_back_desc = '';
        $info->counter = ($info->disabled_time - time())*1000;

        $info = $info->toArray();

//        dd($info);
        return $info;
    }

    /**
     * 获取退单详情页顶部步骤数据
     *
     * @param $backOrder
     *
     * @return array
     */
    public function getBackSchedules($backOrder)
    {
        $orderSchedules = [
            [
                'title' => '买家申请换货',
                'title_sub' => '买家申请换货',
                'time' => $backOrder['add_time'],
                'status' => $backOrder['add_time'] > 0 ? 1 : 0
            ],
            [
                'title' => '商家处理换货申请',
                'title_sub' => '商家处理换货申请',
                'time' => $backOrder['dismiss_time'],
                'status' => $backOrder['dismiss_time'] > 0 ? 1 : 0
            ],
            [
                'title' => '换货完成',
                'title_sub' => '换货完成',
                'time' => $backOrder['disabled_time'],
                'status' => $backOrder['disabled_time'] > 0 ? 1 : 0
            ],
        ];

        return $orderSchedules;
    }

    /**
     * 用户发起售后申请
     *
     * @param $params
     * @param $user_id
     * @return bool
     * @throws \Exception
     */
    public function applySave($params, $user_id)
    {
        DB::beginTransaction();
        try {
            $backOrderInput = $params['BackOrder'];
            $img_path = $params['img_path'];
            $img_path_arr = explode(',', $img_path); // 最多3张
            $id = $params['id']; // 订单ID
            $record_id = $params['record_id']; // 订单商品表ID
            $gid = $params['gid']; // 商品ID
            $sid = $params['sid']; // 商品SKU ID
            $back_type = $params['back_type']; // 1-仅退款 2-退货退款
            if (isset($backOrderInput['back_type'])) {
                $back_type = $backOrderInput['back_type'];
            }

            $condition = [
                ['order_id', $params['id']],
                ['user_id',$user_id]
            ];
            $orderInfoRep = new OrderInfoRepository();
            $order_info = $orderInfoRep->getFrontendOrderInfo($condition);
            if (empty($order_info)) {
                throw new \Exception('订单id无效');
            }
            $delivery_goods = DeliveryGoods::where([['order_id', $order_info['order_id']],
                ['record_id', $record_id],
                ['goods_id', $gid],
                ['sku_id', $sid]
                ])->first();
            if (empty($delivery_goods)) {
                throw new \Exception('订单发货单不不存在');
            }

            $post = [];
            $post['back_type'] = $back_type;
            $post['site_id'] = $order_info['site_id'];
            $post['shop_id'] = $order_info['shop_id'];
            $post['user_id'] = $user_id;
            $post['order_id'] = $id;
            $post['delivery_id'] = $delivery_goods->delivery_id;
            $post['record_id'] = $record_id;
            $post['goods_id'] = $gid;
            $post['sku_id'] = $sid;
            $post['back_number'] = $backOrderInput['back_number'];
            $post['add_time'] = time();
            $post['last_time'] = time();
            $post['disabled_time'] = time() + sysconf('seller_service_term') * 24 * 60 * 60;
            $post['back_status'] = 0;
            $post['back_reason'] = $backOrderInput['back_reason'];
            $post['refund_money'] = $backOrderInput['refund_money'];
            $post['refund_type'] = $backOrderInput['refund_type'];
            $post['refund_status'] = 0;
            $post['back_desc'] = $backOrderInput['back_desc'];
            $post['back_img1'] = $img_path_arr[0] ?? '';
            $post['back_img2'] = $img_path_arr[1] ?? '';
            $post['back_img3'] = $img_path_arr[2] ?? '';

            $post['back_sn'] = $this->makeBackSn();
            $ret = $this->store($post);

            // 添加售后协商记录
            $user = User::where('user_id', $user_id)->select('user_name','headimg')->first();
            $user_name = $user->user_name ?? '';
            $headimg = $user->headimg ?? '';
            $back_reason_format = format_refund_reason($post['back_reason']);
            $back_type_format = str_replace([1,2],['仅退款','退款退货'], $back_type);
            $refund_type_format = str_replace([0,1],['退回账户余额','退回原支付方式'], $post['refund_type']);
            $contents = "买家发起了{$back_type_format}申请，退款原因：{$back_reason_format} ，退款金额：{$post['refund_money']}元，退款方式：{$refund_type_format}，退款说明：{$post['back_desc']} 。";
            $title = "$user_name - 买家";
            BackLog::insert([
                'back_id' => $ret->back_id,
                'record_id' => $post['record_id'],
                'title' => $title,
                'contents' => $contents,
                'images' => $img_path,
                'headimg' => $headimg,
                'add_time' => time(),
            ]);

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();
            return false;
        }
    }

    /**
     * 用户修改售后申请
     * @param $params
     * @param $back_info
     * @return bool
     * @throws \Exception
     */
    public function editSave($params, $back_info)
    {
        DB::beginTransaction();
        try {
            $backOrderInput = $params['BackOrder'];
            $img_path = $params['img_path'];
            $img_path_arr = explode(',', $img_path); // 最多3张
            $back_type = $params['back_type']; // 1-仅退款 2-退货退款
            if (isset($backOrderInput['back_type'])) {
                $back_type = $backOrderInput['back_type'];
            }
            $condition = [
                ['order_id', $params['id']],
                ['user_id', $back_info['user_id']]
            ];
            $orderInfoRep = new OrderInfoRepository();
            $order_info = $orderInfoRep->getFrontendOrderInfo($condition);
            if (empty($order_info)) {
                throw new \Exception('订单id无效');
            }

            $post = [];
            $post['back_type'] = $back_type;
            $post['back_number'] = $backOrderInput['back_number'];
            $post['last_time'] = time();
            $post['disabled_time'] = time() + sysconf('seller_service_term') * 24 * 60 * 60;
            $post['back_status'] = 0;
            $post['back_reason'] = $backOrderInput['back_reason'];
            $post['refund_money'] = $backOrderInput['refund_money'];
            $post['refund_type'] = $backOrderInput['refund_type'];
            $post['refund_status'] = 0;
            $post['back_desc'] = $backOrderInput['back_desc'];
            $post['back_img1'] = $img_path_arr[0] ?? '';
            $post['back_img2'] = $img_path_arr[1] ?? '';
            $post['back_img3'] = $img_path_arr[2] ?? '';

            $this->update($params['id'], $post);

            // 添加售后协商记录
            $user = User::where('user_id', $back_info['user_id'])->select('user_name','headimg')->first();
            $user_name = $user->user_name ?? '';
            $headimg = $user->headimg ?? '';
            $back_reason_format = format_refund_reason($post['back_reason']);
            $back_type_format = str_replace([1,2],['仅退款','退款退货'], $back_type);
            $refund_type_format = str_replace([0,1],['退回账户余额','退回原支付方式'], $post['refund_type']);
            $contents = "买家修改了{$back_type_format}申请，退款原因：{$back_reason_format} ，退款金额：{$post['refund_money']}元，退款方式：{$refund_type_format}，退款说明：{$post['back_desc']} 。";
            $title = "$user_name - 买家";
            BackLog::insert([
                'back_id' => $back_info['back_id'],
                'record_id' => $back_info['record_id'],
                'title' => $title,
                'contents' => $contents,
                'images' => $img_path,
                'headimg' => $headimg,
                'add_time' => time(),
            ]);

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();
            return false;
        }
    }


    /**
     * 买家主动撤销申请
     *
     * @param $params
     * @param $back_info
     * @return bool
     * @throws \Exception
     */
    public function cancel($params, $back_info)
    {
        DB::beginTransaction();
        try {

            $post = [
                'back_status' => 7,
                'last_time' => time()
            ];
            $this->update($params['id'], $post);

            // 添加售后协商记录
            $user = User::where('user_id', $back_info['user_id'])->select('user_name','headimg')->first();
            $user_name = $user->user_name ?? '';
            $headimg = $user->headimg ?? '';
            $back_type_format = str_replace([1,2],['仅退款','退款退货'], $back_info['back_type']);
            $contents = "买家主动撤销了退款退货{$back_type_format}申请，退款关闭。";
            $title = "$user_name - 买家";
            BackLog::insert([
                'back_id' => $back_info['back_id'],
                'record_id' => $back_info['record_id'],
                'title' => $title,
                'contents' => $contents,
                'headimg' => $headimg,
                'add_time' => time(),
            ]);

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();
            return false;
        }
    }

    public function editOrder()
    {
        DB::beginTransaction();
        try {


            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();
            return false;
        }
    }

    public function confirmSys($back_info)
    {
        DB::beginTransaction();
        try {

            $post = [
                'back_status' => 1,
                'last_time' => time()
            ];
            $this->update($back_info['back_id'], $post);

            // 添加售后协商记录
            $user = User::where('user_id', $back_info['user_id'])->select('user_name','headimg')->first();
            $headimg = $user->headimg ?? '';
            $back_type_format = str_replace([1,2],['仅退款','退款退货'], $back_info['back_type']);
            $contents = "商家超时未处理，系统自动同意{$back_type_format}申请。";
            $title = '系统';
            BackLog::insert([
                'back_id' => $back_info['back_id'],
                'record_id' => $back_info['record_id'],
                'title' => $title,
                'contents' => $contents,
                'headimg' => $headimg,
                'add_time' => time(),
            ]);

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();
            return false;
        }
    }

    /**
     * 生成退款编号
     *
     * 长度 = 8位 + 5位 = 13位 如: 20190309 974040
     * 年月日        随机5位数
     * 20190309    97404
     *
     * @return string
     */
    public function makeBackSn()
    {
        return format_time(time(), 'Ymd')
            . mt_rand(10000, 99999);
    }
}