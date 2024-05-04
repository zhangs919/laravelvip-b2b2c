<?php

namespace App\Repositories;


use App\Models\SellerCommissionBill;

class SellerCommissionBillRepository
{
    use BaseRepository;

    protected $model;


    public function __construct()
    {
        $this->model = new SellerCommissionBill();
    }

    public function getList($condition = [])
    {
        $data = $this->model->getList($condition);
        if (!empty($data[0])) {
            foreach ($data[0] as $key=>$item) {
                $item->start_date = format_time($item->start_time, 'Y-m-d');
                $item->end_date = format_time($item->end_time, 'Y-m-d');
                $item->chargeoff_status_format = format_bill_shop_status($item->chargeoff_status);


            }
        }

        return $data;
    }

}