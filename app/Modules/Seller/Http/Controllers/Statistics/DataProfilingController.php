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
// | Description:数据概况
// +----------------------------------------------------------------------

namespace App\Modules\Seller\Http\Controllers\Statistics;

use App\Modules\Base\Http\Controllers\Seller;
use Carbon\Carbon;
use Illuminate\Http\Request;

/**
 * Class DataProfilingController
 * @package App\Modules\Seller\Http\Controllers\Finance
 */
class DataProfilingController extends Seller
{

    private $links = [

    ];

    public function __construct()
    {
        parent::__construct();


        $this->set_menu_select('statistics', 'data-profiling');
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

        $title = '数据概况';
        $fixed_title = '数据概况 - '.$title;

        $action_span = [];
        $explain_panel = [];
        $blocks = [
            'fixed_title' => $fixed_title,
            'action_span' => $action_span,
            'explain_panel' => $explain_panel,
        ];
        $this->setLayoutBlock($blocks); // 设置block

        $search_data = [
            'start_date' => Carbon::now()->subDays(6)->format('Y-m-d 00:00:00'),
            'end_date' => Carbon::now()->format('Y-m-d 23:59:59')
        ];
        list($series, $xAxis_data) = get_seller_statistic_recent_trending($search_data);

        $compact = compact('title', 'series','xAxis_data');

        $webData = []; // web端（pc、mobile）数据对象
        $data = [
            'app_extra_data' => [],
            'app_prefix_data' => [
                'series' => $series,
                'xAxis_data' => $xAxis_data,
            ],
            'app_context_data' => $this->getAppContext(),
            'app_suffix_data' => [],
            'web_data' => $webData,
            'compact_data' => $compact,
            'tpl_view' => 'statistics.data-profiling.index'
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
        $data = get_seller_statistic_data_profiling($this->shop_id);

        return response()->json($data);
    }
}