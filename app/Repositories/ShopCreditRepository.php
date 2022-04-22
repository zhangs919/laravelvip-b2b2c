<?php

namespace App\Repositories;

use App\Models\ShopCredit;

class ShopCreditRepository
{
    use BaseRepository;

    protected $model;



    public function __construct()
    {
        $this->model = new ShopCredit();
    }


    /**
     * 根据店铺信誉分数获取店铺信誉信息
     *
     * @param int $score
     * @return mixed
     */
    public function getCreditInfoByScore($score = 0)
    {
        $where[] = ['min_point', '<=', $score];
        $where[] = ['max_point', '>', $score];
        $info = ShopCredit::where($where)
            ->select(['credit_id','credit_name','credit_img','min_point','max_point','remark'])
            ->first();
        if (!empty($info)) {
            $info = $info->toArray();
        }
        return $info;
    }
}