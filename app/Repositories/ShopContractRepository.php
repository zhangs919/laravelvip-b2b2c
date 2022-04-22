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
// | Date:2018-08-11
// | Description:
// +----------------------------------------------------------------------

namespace App\Repositories;


use App\Models\Contract;
use App\Models\ShopContract;

class ShopContractRepository
{
    use BaseRepository;

    protected $model;



    public function __construct()
    {
        $this->model = new ShopContract();
    }


    /**
     * 获取店铺服务保障列表
     *
     * @param $shop_id
     * @return array
     */
    public function getShopContract($shop_id)
    {
        $shopContract = ShopContract::where([['shop_id',1],['status',2],['is_enable',1]])->get()->toArray();
        $list = [];
        if (!empty($shopContract)) {
            foreach ($shopContract as $v) {
                $contractInfo = Contract::where([['contract_id',$v['contract_id']]])->first();
                $list[] = [
                    'shop_id' => $shop_id,
                    'contract_id' => $v['contract_id'],
                    'contract_name' => $contractInfo->contract_name,
                    'contract_fee' => $contractInfo->contract_fee,
                    'contract_image' => get_image_url($contractInfo->contract_image),
                    'contract_type' => $contractInfo->contract_type,
                    'contract_desc' => $contractInfo->contract_desc,
                    'is_open' => $contractInfo->is_open,
                    'contract_sort' => $contractInfo->contract_sort,
                ];
            }
        }

        return $list;
    }
}