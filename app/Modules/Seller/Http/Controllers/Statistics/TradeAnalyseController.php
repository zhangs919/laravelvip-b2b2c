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
// | Date:2020-02-02
// | Description:交易分析
// +----------------------------------------------------------------------

namespace App\Modules\Seller\Http\Controllers\Statistics;

use App\Modules\Base\Http\Controllers\Seller;
use App\Repositories\CategoryRepository;
use App\Repositories\OrderInfoRepository;
use Illuminate\Http\Request;

class TradeAnalyseController extends Seller
{

    private $links = [
        ['url' => 'statistics/trade-analyse/index', 'text' => '交易概况'],
        ['url' => 'statistics/trade-analyse/sales', 'text' => '销售统计'],
        ['url' => 'statistics/trade-analyse/area', 'text' => '地域分布'],
    ];

    protected $category;
    protected $orderInfo;

    public function __construct(CategoryRepository $category, OrderInfoRepository $orderInfo)
    {
        parent::__construct();

        $this->category = $category;
        $this->orderInfo = $orderInfo;

        $this->set_menu_select('statistics', 'trade-analyse');
    }

    /**
     * 交易概况
     *
     * @param Request $request
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Throwable
     */
    public function index(Request $request)
    {

        $title = '交易概况';
        $fixed_title = '交易分析 - ' . $title;
        $this->sublink($this->links, 'index');

        $action_span = [];
        $explain_panel = [
            '交易概况：按时间筛选，筛选的是订单下单时间和订单付款时间在筛选的时间内的订单的统计。',
            '有效订单量、有效订单金额按时间筛选，只要下单时间在筛选的时间内，即可被统计出来',
            '有效订单金额：订单中部分商品退款成功，统计的有效订单金额中去掉成功退款的金额',
            '退款数量、退款金额按时间筛选，只要退款成功时间在筛选时间内，即可被统计出来，退款数量和退款金额包含确认收货后的退款统计',
        ];
        $blocks = [
            'fixed_title' => $fixed_title,
            'action_span' => $action_span,
            'explain_panel' => $explain_panel,
        ];
        $this->setLayoutBlock($blocks); // 设置block

        $compact = compact('title');

        if ($request->ajax()) {
            $extra = [
                'back_amount' => 0,
                'back_count' => 0,
                'order_amount' => '0.00',
                'order_amount_valid' => '0.00',
                'order_count' => 0,
                'order_count_valid' => 0,
                'pay_goods_count' => 0,
                'pay_order_amount' => '0.00',
                'pay_order_count' => 0,
                'pay_user_count' => 0,
                'user_count' => 0,
            ];
            return result(0, null, '', $extra);
        }

        $webData = []; // web端（pc、mobile）数据对象
        $data = [
            'app_extra_data' => [],
            'app_prefix_data' => [],
            'app_context_data' => $this->getAppContext(),
            'app_suffix_data' => [],
            'web_data' => $webData,
            'compact_data' => $compact,
            'tpl_view' => 'statistics.trade-analyse.index'
        ];
        $this->setData($data); // 设置数据
        return $this->displayData(); // 模板渲染及APP客户端返回数据
    }

    /**
     * 获取交易概况图表数据
     *
     * @param Request $request
     * @return array|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function indexData(Request $request)
    {
        $begin_date = $request->get('begin_date');
        $end_date = $request->get('end_date');

        $x = $this->getBeginEndDates($begin_date, $end_date);

        $extra = [
            'x' => $x,
            'y1' => [0],
            'y2' => [0],
            'y3' => [0],
        ];

        return result(0, null, '', $extra);
    }

    /**
     * 获取交易构成数据
     *
     * @param Request $request
     * @return array|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function usersData(Request $request)
    {
        $cur_date = date('Y-m-d');
        $begin_date = $request->get('begin_date', $cur_date);
        $end_date = $request->get('end_date');

        $extra = [
            'new_amount' => '0.00',
            'new_count' => 0,
            'old_amount' => '0.00',
            'old_count' => 0,
        ];

        return result(0, null, '', $extra);
    }

    /**
     * 销售统计
     *
     * @param Request $request
     * @return array|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     * @throws \Throwable
     */
    public function sales(Request $request)
    {

        $title = '销售统计';
        $fixed_title = '交易分析 - ' . $title;
        $this->sublink($this->links, 'sales');

        $action_span = [];
        $explain_panel = [
            '符合以下任何一种条件的订单即为有效订单：1）采用在线支付方式支付并且已付款；2）采用货到付款方式支付并且交易已完成',
            '统计图展示了符合搜索条件的订单中的下单总金额和下单数量在时间段内的走势情况及与前一个时间段的趋势对比',
            '统计表显示了符合搜索条件的全部有效订单记录并可以点击"导出"将订单记录导出为Excel文件',
            '总下单量、总下单金额：下单时间在筛选时间内即可被统计',
            '退款金额：退款成功时间在筛选时间内即可被统计',
        ];
        $blocks = [
            'fixed_title' => $fixed_title,
            'action_span' => $action_span,
            'explain_panel' => $explain_panel,
        ];
        $this->setLayoutBlock($blocks); // 设置block

        $params = $request->all();

        $where = [];
        // 搜索条件
        $search_arr = ['add_time_begin', 'add_time_end', 'order_status'];
        foreach ($search_arr as $v) {
            if (isset($params[$v]) && !empty($params[$v])) {
                if ($v == 'key_word') { // todo
//                    $where[] = [$v, 'like', "%{$params[$v]}%"];
                } /*elseif ($v == 'add_time_begin' || $v == 'add_time_end') {

                }*/
                else {
                    $where[] = [$v, $params[$v]];
                }
            }
        }

        $where[] = ['user_id', seller_shop_info()->user_id];

        // 列表
        $condition = [
            'with' => ['pickup','orderGoods','deliveryOrder', 'deliveryOrder.deliveryGoods'],
            'where' => $where,
            'sortname' => 'order_id',
            'sortorder' => 'desc'
        ];


        // 获取数据
        list($list, $total) = $this->orderInfo->getOrderList($condition);

        $pageHtml = pagination($total);
        $page = frontend_pagination($total, true);

        $order_status_list = [
            "" => '全部',
            'unpayed' => '待发货未指派',
            'assign' => '待发货已指派',
            'shipped' => '卖家已发货',
            'finished' => '交易成功',
            'closed' => '交易关闭',
            'backing' => '退款中的订单',
            'cancel' => '取消订单申请',
        ];

        $compact = compact('title', 'list', 'pageHtml', 'order_status_list');

        if ($request->ajax()) {
            $render = view('statistics.trade-analyse.partials._sales', $compact)->render();
            return result(0, $render);
        }

        $webData = []; // web端（pc、mobile）数据对象
        $data = [
            'app_extra_data' => [],
            'app_prefix_data' => [
                'list' => $list,
                'page' => $page,
                'order_status_list' => $order_status_list
            ],
            'app_context_data' => $this->getAppContext(),
            'app_suffix_data' => [],
            'web_data' => $webData,
            'compact_data' => $compact,
            'tpl_view' => 'statistics.trade-analyse.sales'
        ];
        $this->setData($data); // 设置数据
        return $this->displayData(); // 模板渲染及APP客户端返回数据
    }

    /**
     * 获取销售统计图表数据
     *
     * @param Request $request
     * @return array|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function getData(Request $request)
    {

        $type = $request->get('type');
        $add_time_begin = $request->get('add_time_begin');
        $add_time_end = $request->get('add_time_end');
        $order_status = $request->get('order_status');

        // todo x轴、y轴值是根据搜索条件的开始结束下单时间取得
        $x = $this->getBeginEndDates($add_time_begin, $add_time_end);

        if ($type == 'amount') {
            // 下单金额统计
            $y = [];
            if (!empty($x)) {
                foreach ($x as $item) {
                    $y[] = rand(0, 100); //'0.00';
                }
            }
            $extra = [
                'x' => $x,
                'y' => $y
            ];
        } elseif ($type == 'count') {
            // 下单量统计
            $y = [];
            if (!empty($x)) {
                foreach ($x as $item) {
                    $y[] = rand(0, 100); // 0;
                }
            }
            $extra = [
                'x' => $x,
                'y' => $y
            ];
        } else {
            // 汇总数据
            $extra = [
                'sum_amount' => '0.00',
                'sum_back' => '0.00',
                'sum_count' => 0,
            ];
        }

        return result(0, null, '', $extra);
    }

    /**
     * 地域分布
     *
     * @param Request $request
     * @return array|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function area(Request $request)
    {

        $title = '地域分布';
        $fixed_title = '交易分析 - ' . $title;
        $this->sublink($this->links, 'area');

        $action_span = [];
        $explain_panel = [
            '统计线上普通订单、提货券订单中的下单会员数、下单总金额和下单数量在各个地区的分布情况，根据查询条件统计不同订单状态下的数据',
        ];
        $blocks = [
            'fixed_title' => $fixed_title,
            'action_span' => $action_span,
            'explain_panel' => $explain_panel,
        ];
        $this->setLayoutBlock($blocks); // 设置block

        $order_status_list = [
            "" => '全部',
            'unpayed' => '待发货未指派',
            'assign' => '待发货已指派',
            'shipped' => '卖家已发货',
            'finished' => '交易成功',
            'closed' => '交易关闭',
            'backing' => '退款中的订单',
            'cancel' => '取消订单申请',
        ];

        $page = null;
        $list = null;

        $compact = compact('title', 'order_status_list', 'page', 'list');

        $webData = []; // web端（pc、mobile）数据对象
        $data = [
            'app_extra_data' => [],
            'app_prefix_data' => [
                'order_status_list' => $order_status_list,
                'page' => $page,
                'list' => $list,
            ],
            'app_context_data' => $this->getAppContext(),
            'app_suffix_data' => [],
            'web_data' => $webData,
            'compact_data' => $compact,
            'tpl_view' => 'statistics.trade-analyse.area'
        ];
        $this->setData($data); // 设置数据
        return $this->displayData(); // 模板渲染及APP客户端返回数据
    }

    public function getAreaData(Request $request)
    {
        $type = $request->get('type');
        $add_time_begin = $request->get('add_time_begin');
        $add_time_end = $request->get('add_time_end');
        $order_status = $request->get('order_status');

        // todo x轴、y轴值是根据搜索条件的开始结束下单时间取得
        $x = []; //$this->getBeginEndDates($add_time_begin, $add_time_end);
        $y = [];
        $extra = [];
        if ($type == 'user') {
            // 地区下单会员数统计
            $y = [];
            if (!empty($x)) {
                foreach ($x as $item) {
                    $y[] = rand(0, 100); // 0;
                }
            }
            $extra = [
                'x' => $x,
                'y' => $y
            ];
        } elseif ($type == 'amount') {
            // 地区下单金额统计
            $y = [];
            if (!empty($x)) {
                foreach ($x as $item) {
                    $y[] = rand(0, 100); //'0.00';
                }
            }
            $extra = [
                'x' => $x,
                'y' => $y
            ];
        } elseif ($type == 'count') {
            // 地区下单量统计
            $y = [];
            if (!empty($x)) {
                foreach ($x as $item) {
                    $y[] = rand(0, 100); // 0;
                }
            }
            $extra = [
                'x' => $x,
                'y' => $y
            ];
        }

        return result(0, null, '', $extra);

    }

    /**
     * 根据开始结束日期获取日期数组
     *
     * @param null $beginDate
     * @param null $endDate
     * @return array
     */
    private function getBeginEndDates($beginDate = null, $endDate = null)
    {
        $cur_date = date('Y-m-d');

        if (!$beginDate && !$endDate) {
            $x = [$cur_date];
        } elseif ($beginDate && !$endDate) {
            if ($beginDate > $cur_date) {
                $x = [$cur_date];
            } else {
                // 获取 $add_time_begin 到 当前日期的所有日期数组
                $x = get_dates_between($beginDate, $cur_date);
            }
        } elseif (!$beginDate && $endDate) {
            if ($endDate > $cur_date) {
                $x = [$cur_date];
            } else {
                // 获取 $add_time_end 到 当前日期的所有日期数组
                $x = get_dates_between($beginDate, $cur_date);
            }
        } elseif ($beginDate && $endDate) {
            $x = get_dates_between($beginDate, $endDate);
        } else {
            $x = [];
        }

        return $x;
    }
}