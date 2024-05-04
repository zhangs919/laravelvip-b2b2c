<?php

namespace App\Models;


use Illuminate\Support\Facades\DB;

class Commission extends BaseModel
{
    const MONTH = 0; // 月结
    const WEEK = 1; // 周结
    const DAY = 2; // 日结
    const THREE_DAY = 3; // 3日结

    protected $table = 'commission';

    //{
    //        "shop_name": "123445",
    //        "shop_id": "511",
    //        "site_name": "北京站",
    //        "shop_status": "3",
    //        "order_count": "3",
    //        "order_amount": "159.80",
    //        "system_money": "0.00",
    //        "site_money": "0.00",
    //        "shop_money": "139.80",
    //        "shipping_fee": "0.00",
    //        "other_shipping_fee": "0.00",
    //        "packing_fee": "0.00",
    //        "alipay": "0.00",
    //        "weixin": "0.00",
    //        "union": "0.00",
    //        "is_cod": "0.00",
    //        "store_card": "0.00",
    //        "integral_money": "0.00",
    //        "surplus": "159.80",
    //        "activity_money": "0.00",
    //        "year": "2019",
    //        "group_time": "2019-12",
    //        "start_date": 1575129600,
    //        "end_date": 1577807999
    //      }
    protected $fillable = [
        'year','group_time'
    ];

    protected $primaryKey = 'commission_id';


    // 计算佣金
    public static function calcCommission()
    {
        
    }

    public static function pageList($shop_info)
    {
        
    }


    public static function getOrderCount($params)
    {
        $result = [
            'shop_status' => 3,
            'site_status' => 0,
            'store_status' => 0,
            'goods_amount' => '0.00',
            'shipping_fee' => '0.00',
            'commission' => '0.00',
            'shop_money' => '0.00',
            'store_card_amount' => '0.00',
            'is_cod' => 0,
            'date' => '2019-12-01~2019-12-31',
            'deposit_account' => false,
            'status' => '已结算',
            'stage_money' => '0.00',
            'order_count' => 0
        ];

        return $result;
    }


    public static function getOrders($params)
    {
        // $params['shop_id'] = seller_shop_info()->shop_id;
        //        $params['store_id'] = $store_id;
        //        $params['group_time'] = $group_time;
        //        $params['type'] = $type;
        //        $params['order_sn'] = $order_sn;
        $curPage = 1;
        $pageSize = 10;

        $where = [];
        $query = DB::table('commission as c')->where($where)
            ->leftJoin('order_info as o', 'o.shop_id','=', 'c.shop_id');

        $total = $query->count();
        $list = $query
            ->forPage($curPage, $pageSize)
            ->orderBy('c.add_time','DESC')
            ->get();

        return [$list,$total];
    }

}
