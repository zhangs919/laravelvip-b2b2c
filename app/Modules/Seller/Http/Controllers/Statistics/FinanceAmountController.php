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
// | Description:财务统计
// +----------------------------------------------------------------------

namespace App\Modules\Seller\Http\Controllers\Statistics;

use App\Modules\Base\Http\Controllers\Seller;
use App\Repositories\CategoryRepository;
use Illuminate\Http\Request;

class FinanceAmountController extends Seller
{

    private $links = [
        ['url' => 'statistics/finance-amount/index?type=0', 'text' => '日统计'],
        ['url' => 'statistics/finance-amount/index?type=1', 'text' => '月统计'],
        ['url' => 'statistics/finance-amount/index?type=2', 'text' => '年统计'],
    ];

    protected $category;

    public function __construct(CategoryRepository $category)
    {
        parent::__construct();

        $this->category = $category;

        $this->set_menu_select('statistics', 'finance-amount');
    }

    /**
     * 财务统计
     *
     * @param Request $request
     * @return array|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     * @throws \Throwable
     */
    public function index(Request $request)
    {
        $type = $request->get('type',0);

        $title = str_replace([0,1,2],['日统计','月统计','年统计'], $type);
        $fixed_title = '财务统计 - ' . $title;
        $this->sublink($this->links, $type, 'type');

        $action_span = [];
        $explain_panel = [
            '按时间统计筛选商品销售情况，以商品付款时间进行判断，订单的付款时间在筛选时间范围内，并且商品未发生退款成功。如果商品发生退款，则统计的商品销售额、商品成本、营业收入中将自动将对应的金额减去；交易关闭的订单中的商品不统计，预售订单尾款未支付时不统计；统计的订单中的商品，订单包含普通订单、自由购订单、堂内点餐订单、社区店订单',
            '商品销售额：统计的是订单中各个商品的原价（非活动价）金额之和',
            '营业收入=商品销售额-店铺红包-平台红包-卖家优惠-满减优惠-活动优惠-积分抵扣+运费+包装费+额外配送费+团长配送费',
            '商品毛利：商品销售额-商品成本',
            '商品毛利率：商品毛利÷商品销售额',
            '实际商品毛利：商品销售额-平台红包-店铺红包-卖家优惠-满减优惠-活动优惠-积分抵扣',
            '实际商品毛利率：实际商品毛利/商品销售额',
            '营业毛利：营业收入-商品成本',
            '营业毛利率：营业毛利/营业收入',
            '卖家优惠：统计卖家人为调整优惠的金额',
            '满减优惠：统计满减送优惠的金额',
            '活动优惠：包含团购、限时折扣、砍价、拼团、预售、打包一口价、搭配套餐优惠的金额，金额=商品原价-活动价',
            '派送费：店铺通过嗖嗖派送付给骑手的配送费，如果商家使用的是第三方快递或自行配送，则不统计',
            '手续费=第三方支付金额*费率（微信及支付宝的手续费，调取后台设置的每种支付方式的费率，订单根据费率自动算出手续费，手续费按照四舍五入保留2位小数）',
            '实际入账=第三方支付金额-手续费',
            '客单价=营业收入÷订单数',
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
        $search_arr = ['add_time_begin', 'add_time_end'];
        foreach ($search_arr as $v) {
            if (isset($params[$v]) && !empty($params[$v])) {
                if ($v == 'keyword') { // todo
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
            'where' => $where,
            'sortname' => 'id',
            'sortorder' => 'asc'
        ];


        // 获取数据
        list($list, $total) = [0, 0]; //$this->userAccount->getList($condition);
//        $list = $list->toArray();

        $pageHtml = pagination($total);
        $page = frontend_pagination($total, true);

        $compact = compact('title', 'type', 'list', 'pageHtml');

        if ($request->ajax()) {
            $render = view('statistics.finance-amount.partials._index', $compact)->render();
            return result(0, $render);
        }

        $webData = []; // web端（pc、mobile）数据对象
        $data = [
            'app_extra_data' => [],
            'app_prefix_data' => [
                'list' => $list,
                'page' => $page,
                'type' => $type
            ],
            'app_context_data' => $this->getAppContext(),
            'app_suffix_data' => [],
            'web_data' => $webData,
            'compact_data' => $compact,
            'tpl_view' => 'statistics.finance-amount.index'
        ];
        $this->setData($data); // 设置数据
        return $this->displayData(); // 模板渲染及APP客户端返回数据
    }

}