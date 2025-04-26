<?php

namespace App\Services\Order;

use App\Models\OrderGoods;
use App\Repositories\Common\BaseRepository;
use App\Repositories\Common\LrwRepository;

class OrderGoodsService
{
    protected $lrwRepository;

    public function __construct(
        LrwRepository $lrwRepository,
    )
    {
        $this->lrwRepository = $lrwRepository;
    }

    /**
     * 获取订单商品列表
     *
     * @access  public
     * @param  $where
     * @return  array
     */
    public function getOrderGoodsList($where = [])
    {
        $res = OrderGoods::selectRaw("*, goods_number AS num")
            ->whereRaw(1);

        if (isset($where['order_id']) && !empty($where['order_id'])) {
            $where['order_id'] = !is_array($where['order_id']) ? explode(",", $where['order_id']) : $where['order_id'];

            $res = $res->whereIn('order_id', $where['order_id']);
        }

        if (isset($where['sort']) && isset($where['order'])) {
            $res = $res->orderBy($where['sort'], $where['order']);
        }

        if (isset($where['size'])) {
            if (isset($where['page'])) {
                $start = ($where['page'] - 1) * $where['size'];

                if ($start > 0) {
                    $res = $res->skip($start);
                }
            }

            if ($where['size'] > 0) {
                $res = $res->take($where['size']);
            }
        }

        $res = BaseRepository::getToArrayGet($res);

        return $res;
    }
}
