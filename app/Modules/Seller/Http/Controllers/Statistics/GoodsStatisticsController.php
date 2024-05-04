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
// | Description:单品统计
// +----------------------------------------------------------------------

namespace App\Modules\Seller\Http\Controllers\Statistics;

use App\Models\Category;
use App\Modules\Base\Http\Controllers\Seller;
use App\Repositories\CategoryRepository;
use App\Repositories\GoodsStatisticsRepository;
use Illuminate\Http\Request;

/**
 * Class GoodsStatisticsController
 * @package App\Modules\Seller\Http\Controllers\Statistics
 */
class GoodsStatisticsController extends Seller
{

    private $links = [
        ['url' => 'statistics/goods-statistics/sales', 'text' => '单品销售明细统计'],
    ];

    protected $category;
    protected $goodsStatistics;

    public function __construct(CategoryRepository $category, GoodsStatisticsRepository $goodsStatistics)
    {
        parent::__construct();

        $this->category = $category;
        $this->goodsStatistics = $goodsStatistics;

        $this->set_menu_select('statistics', 'goods-statistics');
    }

    /**
     * 单品销售明细统计
     *
     * @param Request $request
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Throwable
     */
    public function sales(Request $request)
    {

        $title = '单品销售明细统计';
        $fixed_title = '单品统计 - '.$title;
        $this->sublink($this->links, 'sales');

        $action_span = [];
        $explain_panel = [
            '单品销售统计：统计下单时间在筛选时间内，有销售记录的商品信息，其中包含普通订单（团购订单、拼团订单、预售订单、砍价订单）、自由购订单、堂内点餐、线下收银订单',
            '有销售记录的商品：指交易成功的订单中的商品信息，未交易成功的订单中的商品信息不在统计范围内',
            '优惠金额：包含该商品使用平台红包、店铺红包分摊的金额、商家人为调整商品优惠的金额',
            '店铺价：指该商品未参与店铺任何活动时，正常的销售价格',
            '销售单价：指该商品消费者购买时的购买单价',
        ];
        $blocks = [
            'fixed_title' => $fixed_title,
            'action_span' => $action_span,
            'explain_panel' => $explain_panel,
        ];
        $this->setLayoutBlock($blocks); // 设置block

        $params = $request->all();

        $where = [];
        // 搜索条件 name 商品名称/订单编号/买家账号
        $search_arr = [];
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
            'where' => $where,
            'sortname' => 'id',
            'sortorder' => 'asc'
        ];


        // 获取数据
        list($list, $total) = $this->goodsStatistics->pageList($condition);

        $pageHtml = pagination($total);
        $page = frontend_pagination($total, true);

        $searchModel = null;
        $shop_cat_list = [
            "" => "-- 请选择分类 --",
        ];

        $compact = compact('title', 'list', 'pageHtml','searchModel','shop_cat_list');

        if ($request->ajax()) {
            $render = view('statistics.goods-statistics.partials._sales', $compact)->render();
            return result(0, $render);
        }

        $webData = []; // web端（pc、mobile）数据对象
        $data = [
            'app_extra_data' => [],
            'app_prefix_data' => [
                'list' => $list,
                'page' => $page,
                'searchModel' => $searchModel,
                'shop_cat_list' => $shop_cat_list
            ],
            'app_context_data' => $this->getAppContext(),
            'app_suffix_data' => [],
            'web_data' => $webData,
            'compact_data' => $compact,
            'tpl_view' => 'statistics.goods-statistics.sales'
        ];
        $this->setData($data); // 设置数据
        return $this->displayData(); // 模板渲染及APP客户端返回数据
    }


}