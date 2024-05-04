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
// | Date:2020-01-12
// | Description: 买家投诉
// +----------------------------------------------------------------------

namespace App\Repositories;

use App\Models\Complaint;
use App\Models\OrderGoods;
use Illuminate\Support\Facades\DB;

class ComplaintRepository
{
    use BaseRepository;

    protected $model;


    public function __construct()
    {
        $this->model = new Complaint();
    }


    /**
     * 投诉卖家/卖家回复 保存数据
     *
     * @param object $complaint_order 投诉订单信息
     * @param array $post 表单提交信息
     * @param int $role_type 角色类型 0-买家 1-卖家 2-平台
     * @return bool
     */
    public function addData($complaint_order, $post, $role_type = 0)
    {
        DB::beginTransaction();
        try {
            $post['complaint_sn'] = $this->makeComplaintSn();
            $post['order_id'] = $complaint_order->order_id;
            $post['goods_id'] = $complaint_order->goods_id;
            $post['sku_id'] = $complaint_order->sku_id;
            $post['shop_id'] = $complaint_order->orderInfo->shop_id;
            $post['user_id'] = $complaint_order->orderInfo->user_id;
            $post['role_type'] = $role_type;

            $post['add_time'] = time();
            $this->store($post);

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();
            return false;
        }
    }

    /**
     * 生成投诉编号
     *
     * 长度 = 8位 + 2位 + 4位 + 5位 = 19位 如: 20190309 10 0059 97404
     * 年月日     (00-10) 分秒   随机5位数
     * 20190309    10     0059   97404
     *
     * @return string
     */
    public function makeComplaintSn()
    {
        return format_time(time(), 'Ymd')
            . sprintf('%02d', mt_rand(0, 10)) // 0-10取两位 不足两位前面加0补两位
            . format_time(time(), 'is')
            . mt_rand(10000, 99999);
    }

    /**
     * 获取投诉商家数据
     *
     *
     * @param array $condition
     * @param int $from 0-前端会员中心 1-商家中心 2-平台方后台
     * @return array
     */
    public function getComplaintList($condition = [], $from = 0)
    {
        $data = $this->model->getList($condition);

        if (!$data[0]->isEmpty()) {

            foreach ($data[0] as $key => $value) {

                $order_info = $value->orderInfo;
                $shopRep = new ShopRepository();
                $shop_info = $shopRep->shopInfo($order_info->shop_id);

                if ($from == 0) { /*前端会员中心*/
                    $value->user_name = $shop_info['shop']['user_name'];
                    $value->shop_name = $shop_info['shop']['shop_name'];
                    $value->order_sn = $order_info->order_sn;
                    $value->customer_main = $shop_info['customer_main'];
                    $value->aliim_enable = $shop_info['aliim_enable'];
                    $value->system_aliim_enable = null;
                    $value->yikf_url = null;
                } elseif ($from == 1) {
                    $value->user_name = $order_info->user_name;
                    $value->consignee = $order_info->consignee;
                    $value->order_sn = $order_info->order_sn;
                } elseif ($from == 2) {
                    $value->user_name = $order_info->user_name;
                    $value->consignee = $order_info->consignee;
                    $value->shop_name = $shop_info['shop']['shop_name'];
                    $value->order_sn = $order_info->order_sn;
                }

                unset($value->orderInfo);
            }
        }

        $data[0] = $data[0]->toArray();

        return $data;
    }

    /**
     * 获取会员中心 新增投诉页面数据
     *
     * @param $order_id
     * @param $sku_id
     * @return mixed
     */
    public function getUserCenterAddData($order_id,$sku_id)
    {
        $complaint_order = OrderGoods::where([['order_id', $order_id],['sku_id',$sku_id]])
            ->with('orderInfo')
            ->first();
        if (empty($complaint_order)) {
            abort(200,INVALID_PARAM);
        }

        $shopRep = new ShopRepository();
        $shop_info = $shopRep->shopInfo($complaint_order->orderInfo->shop_id);

        $complaint_order->amount = '0.00';
        $complaint_order->order_sn = $complaint_order->orderInfo->order_sn;
        $complaint_order->order_amount = $complaint_order->orderInfo->order_amount;
        $complaint_order->shipping_fee = $complaint_order->orderInfo->shipping_fee;
        $complaint_order->shop_id = $complaint_order->orderInfo->shop_id;
        $complaint_order->pay_time = $complaint_order->orderInfo->pay_time;
        $complaint_order->add_time = $complaint_order->orderInfo->add_time;
        $complaint_order->shop_name = $shop_info['shop']['shop_name'];
        $complaint_order->customer_main = $shop_info['customer_main'];
        $complaint_order->aliim_enable = $shop_info['aliim_enable'];
        $complaint_order->system_aliim_enable = null;
        $complaint_order->yikf_url = null;

        unset($complaint_order->orderInfo);
        $complaint_order = $complaint_order->toArray();

        return $complaint_order;
    }

    /**
     * 获取会员中心 投诉详情页面数据
     *
     * @param $complaint_id
     * @return mixed
     */
    public function getUserCenterViewData($complaint_id)
    {
        $info = $this->getById($complaint_id);
        if (empty($info)) {
            abort(200,INVALID_PARAM);
        }

        $shopRep = new ShopRepository();
        $shop_info = $shopRep->shopInfo($info->orderInfo->shop_id);

        $info->amount = '0.00';
        $info->order_sn = $info->orderInfo->order_sn;
        $info->order_amount = $info->orderInfo->order_amount;
        $info->shipping_fee = $info->orderInfo->shipping_fee;
        $info->shop_id = $info->orderInfo->shop_id;
        $info->pay_time = $info->orderInfo->pay_time;
        $info->order_add_time = $info->orderInfo->add_time;
        $info->shop_name = $shop_info['shop']['shop_name'];
        $info->customer_main = $shop_info['customer_main'];
        $info->aliim_enable = $shop_info['aliim_enable'];
        $info->system_aliim_enable = null;
        $info->yikf_url = null;

        unset($info->orderInfo);
        $info = $info->toArray();

        return $info;
    }

    /**
     * 获取商家后台 投诉详情页面数据
     * todo
     * @param $complaint_id
     * @return mixed
     */
    public function getSellerComplaintInfo($complaint_id)
    {
        $info = $this->getById($complaint_id);
        if (empty($info)) {
            abort(200,INVALID_PARAM);
        }
        $shopRep = new ShopRepository();
        $shop_info = $shopRep->shopInfo($info->orderInfo->shop_id);

        $orderGoods = $info->orderInfo->orderGoods[0];
        $info->goods_image = get_image_url($orderGoods->goods_image);
        $info->goods_name = $orderGoods->goods_name;
        $info->spec_info = $orderGoods->spec_info;
        $info->goods_price = $orderGoods->goods_price;
        $info->goods_number = $orderGoods->goods_number;
        $info->order_sn = $info->orderInfo->order_sn;
        $info->order_status = $info->orderInfo->order_status;
        $info->shipping_status = $info->orderInfo->shipping_status;
        $info->shipping_fee = $info->orderInfo->shipping_fee;

        $info->user_name = $info->user->user_name;
        $info->shop_name = $shop_info['shop']['shop_name'];
        $info->images = array_filter(explode(',',$info->complaint_images));

        unset($info->user,$info->orderInfo);

        $info->cargo_status = [
            'code' => 'cancel',
            'backend' => '交易关闭',
            'store' => '交易关闭',
            'seller' => '交易关闭',
            'frontend' => '交易关闭',
            'frontend_info' => '交易关闭',
        ];
        $info = $info->toArray();

        return $info;
    }

    /**
     * 获取投诉协商记录列表
     *
     * @param $complaint_id
     * @return array
     */
    public function getComplaintReplyList($complaint_id)
    {
        $complaint_info = $this->getById($complaint_id);
        if (empty($complaint_info)) {
            abort(200,INVALID_PARAM);
        }

        $reply_list = Complaint::where([['complaint_sn', $complaint_info->complaint_sn]])
            ->orderBy('add_time','desc')
            ->get();

        if ($reply_list->isEmpty()) {
            return [];
        }
        foreach ($reply_list as $item) {
            $item->user_name = $item->user->user_name;
            $item->headimg = $item->user->headimg;
            $item->images = array_filter(explode(',',$item->complaint_images));

            unset($item->user);
        }
        $reply_list = $reply_list->toArray();

        return $reply_list;
    }
}