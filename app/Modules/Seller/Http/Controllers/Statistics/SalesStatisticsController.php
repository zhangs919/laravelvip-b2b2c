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
// | Date:2020-02-01
// | Description:营业统计
// +----------------------------------------------------------------------

namespace App\Modules\Seller\Http\Controllers\Statistics;

use App\Modules\Base\Http\Controllers\Seller;
use Illuminate\Http\Request;

/**
 * Class SalesStatisticsController
 * @package App\Modules\Seller\Http\Controllers\Statistics
 */
class SalesStatisticsController extends Seller
{

    private $links = [

    ];

    public function __construct()
    {
        parent::__construct();


        $this->set_menu_select('statistics', 'sales-statistics');
    }

    /**
     *
     *
     * @param Request $request
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Throwable
     */
    public function index(Request $request)
    {

        $title = '营业统计';
        $fixed_title = '营业统计 - '.$title;

        $action_span = [];
        $explain_panel = [
            '有效订单数：有效订单的下单时间在筛选时间内即可统计',
            '预计损失：交易关闭时间在筛选时间内、退款退货成功时间在筛选时间内即可统计'
        ];
        $blocks = [
            'fixed_title' => $fixed_title,
            'action_span' => $action_span,
            'explain_panel' => $explain_panel,
        ];
        $this->setLayoutBlock($blocks); // 设置block

        $compact = compact('title');

        $webData = []; // web端（pc、mobile）数据对象
        $data = [
            'app_extra_data' => [],
            'app_prefix_data' => [

            ],
            'app_context_data' => $this->getAppContext(),
            'app_suffix_data' => [],
            'web_data' => $webData,
            'compact_data' => $compact,
            'tpl_view' => 'statistics.sales-statistics.index'
        ];
        $this->setData($data); // 设置数据
        return $this->displayData(); // 模板渲染及APP客户端返回数据
    }

    /**
     * 获取数据概况
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getData(Request $request)
    {
        $from = $request->get('from');
        $to = $request->get('to');

        $data = get_seller_sales_statistics();

        return response()->json($data);
    }
}