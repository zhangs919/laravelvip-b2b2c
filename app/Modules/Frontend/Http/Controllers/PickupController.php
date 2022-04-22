<?php

namespace App\Modules\Frontend\Http\Controllers;


use App\Modules\Base\Http\Controllers\Frontend;
use App\Repositories\SelfPickupRepository;
use Illuminate\Http\Request;

class PickupController extends Frontend
{

    protected $selfPickup;

    public function __construct()
    {
        parent::__construct();

        $this->selfPickup = new SelfPickupRepository();

    }

    public function pickup(Request $request, $shop_id)
    {

        // 获取数据
        $where[] = ['is_show', 1];
        $where[] = ['shop_id', $shop_id];
        $condition = [
            'where' => $where,
            'limit' => 0,
            'sortname' => 'pickup_id',
            'sortorder' => 'asc',
        ];
        list($pickup, $total) = $this->selfPickup->getList($condition);
        $pickup = $pickup->toArray();
        $compact = compact('pickup', 'shop_id');
        $webData = []; // web端（pc、mobile）数据对象
        $data = [
            'app_prefix_data' => [
                'pickup' => $pickup,
                'shop_id' => $shop_id
            ],
            'app_suffix_data' => [],
            'web_data' => $webData,
            'compact_data' => $compact,
            'tpl_view' => 'pickup.pickup'
        ];
        $this->setData($data); // 设置数据
        return $this->displayData(); // 模板渲染及APP客户端返回数据
    }

}