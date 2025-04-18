<?php

namespace App\Repositories;



use App\Models\SellerBillOrder;

class SellerBillOrderRepository
{
    use BaseRepository;

    protected $model;


    public function __construct()
    {
        $this->model = new SellerBillOrder();
    }

    public function getList($condition = [])
    {
        $data = $this->model->getList($condition);
        if (!empty($data[0])) {
            foreach ($data[0] as $key=>$item) {
                $item->confirm_take_time = format_time($item->confirm_take_time);
                $item->chargeoff_status_format = format_bill_shop_status($item->chargeoff_status);

            }
        }

        return $data;
    }

    public function getSumData($condition)
    {
        $info = SellerBillOrder::where($condition)
            ->selectRaw('IFNULL(SUM(order_amount), 0.00) as total_order_amount,IFNULL(SUM(money_paid),0.00) as total_money_paid')
            ->first();

        return $info;
    }

}