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
// | Description:商品分析
// +----------------------------------------------------------------------

namespace App\Modules\Seller\Http\Controllers\Statistics;

use App\Models\Category;
use App\Modules\Base\Http\Controllers\Seller;
use App\Repositories\CategoryRepository;
use Illuminate\Http\Request;

/**
 * Class GoodsAnalyseController
 * @package App\Modules\Seller\Http\Controllers\Statistics
 */
class GoodsAnalyseController extends Seller
{

    private $links = [
        ['url' => 'statistics/goods-analyse/index', 'text' => '商品概况'],
        ['url' => 'statistics/goods-analyse/sales-chart', 'text' => '商品销量排行'],
        ['url' => 'statistics/goods-analyse/industry', 'text' => '行业分析'],
        ['url' => 'statistics/goods-analyse/purchase-rate', 'text' => '访问购买率'],
    ];

    protected $category;

    public function __construct(CategoryRepository $category)
    {
        parent::__construct();

        $this->category = $category;

        $this->set_menu_select('statistics', 'goods-analyse');
    }

    /**
     * 商品概况
     *
     * @param Request $request
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Throwable
     */
    public function index(Request $request)
    {

        $title = '商品概况';
        $fixed_title = '商品分析 - '.$title;
        $this->sublink($this->links, 'index');

        $action_span = [];
        $explain_panel = [];
        $blocks = [
            'fixed_title' => $fixed_title,
            'action_span' => $action_span,
            'explain_panel' => $explain_panel,
        ];
        $this->setLayoutBlock($blocks); // 设置block

        $x_axis = json_encode(get_lately_time('month'));
        $d = [0,0,0,0,0,0,0,0,0,0,
            0,0,0,0,0,0,0,0,0,0,
            0,0,0,0,0,0,0,0,0,0,];
        $all = json_encode($d);
        $payed = json_encode($d);
        $y_axis = [
            'all' => $all,
            'payed' => $payed,
        ];

        $compact = compact('title', 'x_axis','y_axis');

        $webData = []; // web端（pc、mobile）数据对象
        $data = [
            'app_extra_data' => [],
            'app_prefix_data' => [
                'x_axis' => $x_axis,
                'y_axis' => $y_axis,
            ],
            'app_context_data' => $this->getAppContext(),
            'app_suffix_data' => [],
            'web_data' => $webData,
            'compact_data' => $compact,
            'tpl_view' => 'statistics.goods-analyse.index'
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

        $data = [
            'offsale' => 0,
            'onsale' => 0,
            'waitaudit' => 0,
        ];

        return response()->json($data);
    }

    public function salesChart(Request $request)
    {
        $title = '商品销量排行';
        $fixed_title = '商品分析 - '.$title;
        $this->sublink($this->links, 'sales-chart');

        $action_span = [];
        $explain_panel = [
            '销售数量：统计非交易关闭的已付款的线上、线下订单中的商品总数量，包含的订单有普通订单、自由购订单、堂内点餐订单、线下订单、提货券订单。比如一笔订单中A商品购买两件，那销售数量即是2，销售额是销售数量*当时购买A商品的单价',
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
        //"goods_id": "48077",
        //                "goods_name": "11111",
        //                "goods_number": "1",
        //                "goods_price": "100.00"

        list($list, $total) = [0,0]; //$this->userAccount->getList($condition);
//        $list = $list->toArray();

        $pageHtml = pagination($total);
        $page = frontend_pagination($total, true);

        $shop_cat_list = [
            "" => "-- 请选择分类 --",
        ];

        $compact = compact('title', 'list', 'pageHtml','shop_cat_list');

        if ($request->ajax()) {
            $render = view('statistics.goods-analyse.partials._sales_chart', $compact)->render();
            return result(0, $render);
        }


        $webData = []; // web端（pc、mobile）数据对象
        $data = [
            'app_extra_data' => [],
            'app_prefix_data' => [
                'list' => $list,
                'page' => $page,
                'shop_cat_list' => $shop_cat_list,
            ],
            'app_context_data' => $this->getAppContext(),
            'app_suffix_data' => [],
            'web_data' => $webData,
            'compact_data' => $compact,
            'tpl_view' => 'statistics.goods-analyse.sales_chart'
        ];
        $this->setData($data); // 设置数据
        return $this->displayData(); // 模板渲染及APP客户端返回数据
    }

    public function industry(Request $request)
    {

        $title = '行业分析';
        $fixed_title = '商品分析 - '.$title;
        $this->sublink($this->links, 'industry');

        $action_span = [];
        $explain_panel = [
            '符合以下任何一种条件的订单即为有效订单：1）采用在线支付方式支付并且已付款；2）采用货到付款方式支付并且交易已完成',
            '总销售额：统计的是所有线上、线下订单中的商品总金额，包括各种订单状态的订单（订单包含：普通订单、自由购订单、堂内点餐订单、线下订单）；',
            '总下单量：选择的时间内线上、线下订单中的总商品数量',
        ];
        $blocks = [
            'fixed_title' => $fixed_title,
            'action_span' => $action_span,
            'explain_panel' => $explain_panel,
        ];
        $this->setLayoutBlock($blocks); // 设置block

        $params = $request->all();
        $cat_id1 = $request->get('cat_id1'); // 一级分类id
        $cat_id2 = $request->get('cat_id2'); // 二级分类id

        $where = [];
        if ($cat_id1) {
            $where[] = ['parent_id', $cat_id1];
        } elseif ($cat_id2) {
            $where[] = ['parent_id', $cat_id2];
        } else {
            $where[] = ['parent_id', 0];
        }

        // 搜索条件
        $search_arr = ['key_word'];
        foreach ($search_arr as $v) {
            if (isset($params[$v]) && !empty($params[$v])) {

                if ($v == 'key_word') {
                    $where[] = ['store_name', 'like', "%{$params[$v]}%"];
                } else {
                    $where[] = [$v, $params[$v]];
                }
            }
        }
        // 列表
        $condition = [
            'where' => $where,
            'field' => ['cat_id','cat_name'],
            'sortname' => 'cat_id',
            'sortorder' => 'asc',
        ];
        list($list, $total) = $this->category->getList($condition);
        $list = $list->toArray();
        if (!empty($list)) {
            foreach ($list as &$item) {
                $item['goods_number'] = 0;
                $item['goods_amount_valid'] = '0.00';
                $item['order_count_valid'] = 0;
                $item['users_count'] = 0;
                $item['goods_amount'] = '0.00';
                $item['order_count'] = 0;
                $item['goods_number_saled'] = 0;
                $item['goods_number_unsale'] = 0;
            }
        }

        $pageHtml = pagination($total);
        $page = frontend_pagination($total, true);

        $cat_list = Category::where('is_parent', 1)->orderBy('cat_id','asc')->get()->toArray();

        $compact = compact('title', 'list','pageHtml','cat_list');

        if ($request->ajax()) {
            $render = view('statistics.goods-analyse.partials._industry', $compact)->render();
            return result(0, $render);
        }
        $webData = []; // web端（pc、mobile）数据对象
        $data = [
            'app_extra_data' => [],
            'app_prefix_data' => [
                'list' =>$list,
                'page'=>$page,
                'cat_list' => $cat_list
            ],
            'app_context_data' => $this->getAppContext(),
            'app_suffix_data' => [],
            'web_data' => $webData,
            'compact_data' => $compact,
            'tpl_view' => 'statistics.goods-analyse.industry'
        ];
        $this->setData($data); // 设置数据
        return $this->displayData(); // 模板渲染及APP客户端返回数据
    }

    public function industryData(Request $request)
    {
        $type = $request->get('type');
        $from = $request->get('from');
        $to = $request->get('to');
        $cat_id1 = $request->get('cat_id1'); // 一级分类id
        $cat_id2 = $request->get('cat_id2'); // 二级分类id

        $where = [];
        if ($cat_id1) {
            $where[] = ['parent_id', $cat_id1];
        } elseif ($cat_id2) {
            $where[] = ['parent_id', $cat_id2];
        } else {
            $where[] = ['parent_id', 0];
        }

        $cat_list = Category::where($where)->orderBy('cat_id','asc')->get();
        $x = [];
        $y = [];
        if (!$cat_list->isEmpty()) {
            foreach ($cat_list as $item) {
                $x[] = rand(0,20);
                $y[] = $item->cat_name;
            }
        }

        $extra = [
            'x' => $x,
            'y'=>$y
        ];

        return result(0, null, '', $extra);
    }

    public function industryExport()
    {
        
    }

    public function purchaseRate(Request $request)
    {
        $title = '访问购买率';
        $fixed_title = '商品分析 - '.$title;
        $this->sublink($this->links, 'purchase-rate');

        $action_span = [];
        $explain_panel = [
            '访问购买率=销售量/访问人气',
            '访问人气：商品被浏览的总次数，同一个人浏览多次，数量累加不去重',
            '销售量：统计线上已付款商品数量，包含已付款的商品取消订单或申请退款退货成功的数量（包含的订单普通订单、货到付款确认收货订单、自由购订单、堂内点餐订单、提货券订单)',
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
        //"goods_id": "48038",
        //                "goods_name": "2ipad钢化膜2018新款air2苹果mini4平板pro9.7英寸10.5电脑11新12.9版",
        //                "goods_number": "3",
        //                "click_count": "28"

        list($list, $total) = [0,0]; //$this->userAccount->getList($condition);
//        $list = $list->toArray();

        $pageHtml = pagination($total);
        $page = frontend_pagination($total, true);

        $shop_cat_list = [
            "" => "-- 请选择分类 --",
        ];

        $compact = compact('title', 'list', 'pageHtml','shop_cat_list');

        if ($request->ajax()) {
            $render = view('statistics.goods-analyse.partials._purchase_rate', $compact)->render();
            return result(0, $render);
        }


        $webData = []; // web端（pc、mobile）数据对象
        $data = [
            'app_extra_data' => [],
            'app_prefix_data' => [
                'list' => $list,
                'page' => $page,
                'shop_cat_list' => $shop_cat_list,
            ],
            'app_context_data' => $this->getAppContext(),
            'app_suffix_data' => [],
            'web_data' => $webData,
            'compact_data' => $compact,
            'tpl_view' => 'statistics.goods-analyse.purchase_rate'
        ];
        $this->setData($data); // 设置数据
        return $this->displayData(); // 模板渲染及APP客户端返回数据
    }

    public function catList(Request $request)
    {
        $cat_id1 = $request->get('cat_id1');

        $where[] = ['parent_id', $cat_id1];
        $cat_list = Category::where($where)->select(['cat_id','cat_name'])->orderBy('cat_id','asc')->get();

        return view('statistics.goods-analyse.partials._cat_list', compact('cat_list'));
    }
}