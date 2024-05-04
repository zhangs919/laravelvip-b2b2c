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
// | Date:2018-10-23
// | Description: 客服
// +----------------------------------------------------------------------

namespace App\Repositories;



use App\Models\Customer;
use App\Models\CustomerType;

class CustomerRepository
{
    use BaseRepository;

    protected $model;


    public function __construct()
    {
        $this->model = new Customer();
    }

    /**
     * 获取店铺主客服信息
     *
     * @param $shopId
     * @return mixed
     */
    public function getCustomerMain($shopId)
    {
        $info = Customer::where([['shop_id',$shopId],['is_main',1],['is_show',1]])
            ->select(['customer_name','customer_account','customer_tool','shop_id'])
            ->first();
        if (!empty($info)) {
            $info->shop_type = 1; // todo 暂时不知道从值哪来的
            $info = $info->toArray();
        }

        return $info;
    }

    /**
     * 获取商品详情店铺客服列表
     *
     * @param $shopId
     * @return mixed
     */
    public function getCustomerList($shopId)
    {
        $list = Customer::where([['shop_id',$shopId],['is_show',1]])
            ->select(['type_id','customer_name','customer_account','customer_tool','shop_id'])
            ->get()->toArray();
        if (!empty($list)) {
            foreach ($list as &$item) {
                $item['shop_type'] = 1; // todo 暂时不知道从值哪来的
                $item['customer_type_name'] = CustomerType::where('type_id', $item['type_id'])->value('type_name');
            }
        }

        return $list;
    }
}