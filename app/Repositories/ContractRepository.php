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

class ContractRepository
{
    use BaseRepository;

    protected $model;



    public function __construct()
    {
        $this->model = new Contract();
    }

    /**
     * 检查保障服务是否有店铺正在使用
     * 如果正在使用 不允许关闭或者删除
     *
     * @param $contract_id
     * @return bool
     */
    public function checkIsInUse($contract_id)
    {
        $res = ShopContract::where([['status',2],['is_enable',1]])->count();
        if ($res > 0) {
            return true;
        }
        return false;
    }

    /**
     * 检查店铺是否已经加入某个保障服务
     *
     * @param $contract_id
     * @param $shop_id
     * @return bool
     */
    public function checkIsJoined($contract_id, $shop_id)
    {
        $res = ShopContract::where([['status',2],['is_enable',1],['shop_id',$shop_id],['contract_id',$contract_id]])->count();
        if ($res > 0) {
            return true;
        }
        return false;
    }

    public function getSellerShopContract($shop_id)
    {
        // 列表
        $condition = [
            'where' => [],
            'sortname' => 'contract_sort',
            'sortorder' => 'asc',
        ];
        list($list, $total) = $this->model->getList($condition);
        $new_result = [];
        foreach ($list as $item) {
            $item->is_joined = $this->checkIsJoined($item->contract_id,$shop_id);
            $item->status = ShopContract::where([['shop_id',$shop_id],['contract_id',$item->contract_id]])->value('status');
            $new_result[$item->contract_type][] = $item;
        }

        return $new_result;
    }
}