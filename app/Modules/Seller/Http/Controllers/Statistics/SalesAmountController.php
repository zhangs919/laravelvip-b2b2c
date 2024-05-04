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
// | Description:销售统计
// +----------------------------------------------------------------------

namespace App\Modules\Seller\Http\Controllers\Statistics;

use App\Modules\Base\Http\Controllers\Seller;
use App\Repositories\CategoryRepository;
use Illuminate\Http\Request;

class SalesAmountController extends Seller
{

    private $links = [
        ['url' => 'statistics/sales-amount/index', 'text' => '销售统计'],
    ];

    protected $category;

    public function __construct(CategoryRepository $category)
    {
        parent::__construct();

        $this->category = $category;

        $this->set_menu_select('statistics', 'sales-amount');
    }

    /**
     * 销售统计
     *
     * @param Request $request
     * @return array|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     * @throws \Throwable
     */
    public function index(Request $request)
    {

        $title = '销售统计';
        $fixed_title = '销售统计 - ' . $title;
        $this->sublink($this->links, 'index');

        $action_span = [];
        $explain_panel = [
            '按时间统计筛选商品销售情况，以订单的付款时间进行判断，订单的付款时间在筛选时间范围内，并且商品未发生退款成功。如果商品发生退款，则统计的商品总金额、商品成本、订单总金额中将自动将对应的金额减去；交易关闭的订单中的商品不统计，预售订单尾款未支付时不统计；统计的订单中的商品，订单包含普通订单、自由购订单、堂内点餐订单、社区店订单',
            '商品总金额：统计的是订单中各个商品的原价（非活动价）金额之和',
            '订单总金额=商品总金额-店铺红包-平台红包-卖家优惠-满减优惠-活动优惠-积分抵扣+运费+包装费+额外配送费+团长配送费',
            '商品毛利：商品总金额-商品成本',
            '商品毛利率：商品毛利÷商品总金额',
            '订单毛利：订单总金额-商品成本-派送费',
            '订单毛利率=订单毛利÷订单总金额',
            '派送费：店铺通过嗖嗖派送付给骑手的配送费，如果商家使用的是第三方快递或自行配送，则不统计',
            '卖家优惠：统计卖家人为调整优惠的金额',
            '满减优惠：统计满减送优惠的金额',
            '活动优惠：包含会员价、团购、限时折扣、砍价、拼团、预售、打包一口价、搭配套餐优惠的金额，金额=商品原价-活动价',
            '实际商品毛利：商品总金额-店铺红包-平台红包-卖家优惠-满减优惠-活动优惠-积分抵扣',
            '实际商品毛利率：实际商品毛利/商品总金额',
            '手续费=第三方支付金额*费率（微信及支付宝的手续费，调取后台设置的每种支付方式的费率，订单根据费率自动算出手续费，手续费按照四舍五入保留2位小数）',
            '实际入账=第三方支付金额-手续费',
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
        $search_arr = ['keyword','add_time_begin', 'add_time_end'];
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

        $compact = compact('title', 'list', 'pageHtml');

        if ($request->ajax()) {
            $render = view('statistics.sales-amount.partials._sales', $compact)->render();
            return result(0, $render);
        }

        $webData = []; // web端（pc、mobile）数据对象
        $data = [
            'app_extra_data' => [],
            'app_prefix_data' => [
                'list' => $list,
                'page' => $page,
            ],
            'app_context_data' => $this->getAppContext(),
            'app_suffix_data' => [],
            'web_data' => $webData,
            'compact_data' => $compact,
            'tpl_view' => 'statistics.sales-amount.index'
        ];
        $this->setData($data); // 设置数据
        return $this->displayData(); // 模板渲染及APP客户端返回数据
    }

}