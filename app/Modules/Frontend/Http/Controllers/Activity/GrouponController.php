<?php

namespace App\Modules\Frontend\Http\Controllers\Activity;

use App\Modules\Base\Http\Controllers\Frontend;
use Illuminate\Http\Request;

class GrouponController extends Frontend
{


    public function __construct()
    {
        parent::__construct();

    }

    /**
     * 参团详情
     *
     * @param Request $request
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function join(Request $request)
    {
        $group_sn = $request->get('group_sn');
        if (!$group_sn) {
            abort(404, INVALID_PARAM);
        }

        $groupon_log = [];
        $goods = [];
        $sku = [];
        $fight_num = 0;
        $groupon_log_list = [];
        $end_time = '';

        $compact = compact('groupon_log', 'sku', 'groupon_log_list');
        $webData = []; // web端（pc、mobile）数据对象
        $data = [
            'app_prefix_data' => [
                'groupon_log' => $groupon_log,
//                'groupon_info' => $groupon_info,
                'goods' => $goods,
                'sku' => $sku,
                'fight_num' => $fight_num,
                'groupon_log_list' => $groupon_log_list,
                'end_time' => $end_time,
//                'diff_num' => $diff_num,
//                'groupon_log_count' => $groupon_log_count,
//                'is_wechat' => false,
//                'is_share' => 0,
//                'show_stock' => '1',
//                'order_list' => $order_list,
//                'sum_cash_back_amount' => 0,
//                'full_cut' => null,
//                'share' => $share,
                'act_type' => 'join',
            ],
            'app_suffix_data' => [],
            'web_data' => $webData,
            'compact_data' => $compact,
            'tpl_view' => 'activity.groupon.join'
        ];
        $this->setData($data); // 设置数据
        return $this->displayData(); // 模板渲染及APP客户端返回数据
    }

}