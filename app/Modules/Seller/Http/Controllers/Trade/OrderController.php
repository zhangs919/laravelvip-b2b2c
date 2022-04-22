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
// | Date:2019-03-20
// | Description:订单管理
// +----------------------------------------------------------------------

namespace App\Modules\Seller\Http\Controllers\Trade;

use App\Modules\Base\Http\Controllers\Seller;
use App\Repositories\OrderGoodsRepository;
use App\Repositories\OrderInfoRepository;
use Illuminate\Http\Request;

class OrderController extends Seller
{

    private $links = [
        ['url' => 'trade/order/list', 'text' => '订单列表'],
        ['url' => 'trade/order/view', 'text' => '核销'],
    ];

    protected $orderInfo;

    protected $orderGoods;

    public function __construct()
    {
        parent::__construct();

        $this->orderInfo = new OrderInfoRepository();
        $this->orderGoods = new OrderGoodsRepository();

        $this->set_menu_select('trade', 'trade-order-list');
    }

    /**
     * 订单列表
     *
     * @param Request $request
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Throwable
     */
    public function lists(Request $request)
    {
        $title = '订单列表';
        $fixed_title = '商品订单 - '.$title;

        $uid = $request->get('uid', ''); // 查看某个会员的所有订单
        $from = $request->get('from', '');

        $this->sublink($this->links, 'list');
        $action_span = [];
        $explain_panel = [];
        $blocks = [
            'fixed_title' => $fixed_title,
            'action_span' => $action_span,
            'explain_panel' => $explain_panel,
        ];
        $this->setLayoutBlock($blocks); // 设置block
        $this->sublink($this->links, 'list');

        $params = $request->all();
        $params['order_status'] = $request->get('order_status', '');

        $where = [];
        // 搜索条件 name 商品名称/订单编号/买家账号
        $search_arr = ['name', 'order_status', 'add_time_begin', 'add_time_end', 'shop_name', 'evaluate_status', 'pay_type',
            'service_type', 'pickup', 'order_type', 'user_mobile', 'consignee_name', 'consignee_mobile', 'consignee_address'];
        foreach ($search_arr as $v) {
            if (isset($params[$v]) && !empty($params[$v])) {
                if ($v == 'name') { // todo
//                    $where[] = [$v, 'like', "%{$params[$v]}%"];
                } elseif ($v == 'add_time_begin' || $v == 'add_time_end') {

                }
                else {
                    $where[] = [$v, $params[$v]];
                }
            }
        }

        if (!empty($uid)) {
            $where[] = ['user_id', $uid];
        }

        $where[] = ['shop_id', seller_shop_info()->shop_id]; // 店铺id

        // 列表
        $condition = [
            'with' => ['orderGoods'],
            'where' => $where,
            'sortname' => 'order_id',
            'sortorder' => 'asc'
        ];

        list($list, $total) = $this->orderInfo->getOrderList($condition);
        $pageHtml = pagination($total);
        $page = frontend_pagination($total, true);
//        dd($list);

        if ($request->ajax()) {
            $render = view('trade.order.partials._list', compact('list', 'total', 'pageHtml', 'params'))->render();
            return result(0, $render);
        }

        // 获取数据

        $compact = compact('title', 'list', 'pageHtml', 'params');

        $webData = []; // web端（pc、mobile）数据对象
        $data = [
            'app_extra_data' => [],
            'app_prefix_data' => [
                'list' => $list,
                'page' => $page,
                'order_counts' => $this->orderInfo->getOrderCounts(),
                'add_time_begin' => date('Y-m-d'), // 获取今日日期 '2019-02-19',
                'buy_type' => 0,
                'list_url' => '/trade/order/list.html'
            ],
            'app_context_data' => $this->getAppContext(),
            'app_suffix_data' => [],
            'web_data' => $webData,
            'compact_data' => $compact,
            'tpl_view' => 'trade.order.list'
        ];
        $this->setData($data); // 设置数据
        return $this->displayData(); // 模板渲染及APP客户端返回数据
    }

    /**
     * 订单详情
     *
     * @param Request $request
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function info(Request $request)
    {
        $title = '订单详情';
        $fixed_title = '订单管理 - '.$title;
        $order_id = $request->get('id');

        $action_span = [
            [
                'id' => '',
                'url' => 'javascript:history.go(-1);',
                'icon' => 'fa-reply',
                'text' => '返回订单列表'
            ],
            [
                'id' => 'btn_print',
                'url' => 'add',
                'icon' => 'fa-print',
                'text' => '打印订单'
            ],
        ];

        $explain_panel = [];
        $blocks = [
            'explain_panel' => $explain_panel,
            'fixed_title' => $fixed_title,
            'action_span' => $action_span
        ];

        $this->setLayoutBlock($blocks); // 设置block


        // 获取数据
        $condition = [
            ['order_id', $order_id],
        ];
        $info = $this->orderInfo->getOrderInfo($condition);
        if (empty($info)) {
            abort(200, '订单id无效');
        }

        $types = [
            "无需物流",
            "指配派送",
            "物流众包",
            "第三方物流",
            "达达物流"
        ];

        $compact = compact('title', 'info', 'types');

        $webData = []; // web端（pc、mobile）数据对象
        $data = [
            'app_extra_data' => [],
            'app_prefix_data' => [
                'info' => $info,
                'types' => $types,
                'order_schedules' => '',
                'shop_info' => null,
                'pay_term' => '1',
                'pay_term_unit' => '0',
                'store_count' => '5',
                'buy_type' => '1',
                'shop_address_count' => '1',
            ],
            'app_context_data' => $this->getAppContext(),
            'app_suffix_data' => [],
            'web_data' => $webData,
            'compact_data' => $compact,
            'tpl_view' => 'trade.order.info'
        ];
        $this->setData($data); // 设置数据
        return $this->displayData(); // 模板渲染及APP客户端返回数据
    }

    public function print(Request $request)
    {
        $order_id = $request->get('id'); // 多个订单：1,3 以逗号分隔
        $order_ids = explode(',', $order_id);

        // 获取数据
        $where[] = ['shop_id', seller_shop_info()->shop_id]; // 店铺id

        // 列表
        $condition = [
            'with' => ['orderGoods'],
            'where' => $where,
            'in' => [
                'field' => 'order_id',
                'condition' => $order_ids
            ],
            'sortname' => 'order_id',
            'sortorder' => 'asc'
        ];
        list($order_list, $order_total)= $this->orderInfo->getPrintOrderList($condition);

        $print_title = '购物清单';
        $logo = get_image_url(sysconf('mall_logo'));
        $delivery_id = 0; // todo
        $spec_list = [];
        $default_spec = [];
        $buy_type = 0;
        $is_exchange = false;
        $is_gift = false;
        $is_freebuy = false;
        $is_reachbuy = false;
        $mall_wx_qrcode = get_image_url(sysconf('mall_wx_qrcode'));
        $shop_wechat = '';
        $shop_qrcode = 'http://images.68mall.com/15164/gqrcode/shop/C4/qrcode_1.png';
        $qrcode_image = 'http://images.68mall.com/15164/oqrcode/83/qrcode_2,1.png';
        $store_logo = get_image_url($this->seller_info->shop->shop_logo);

        $compact = compact('title', 'order_list', 'print_title', 'order_id','logo','delivery_id',
            'spec_list','default_spec','buy_type','is_exchange','is_gift','is_freebuy','is_reachbuy',
            'mall_wx_qrcode','shop_wechat','shop_qrcode','qrcode_image','store_logo');

        $webData = []; // web端（pc、mobile）数据对象
        $data = [
            'app_extra_data' => [],
            'app_prefix_data' => [
                'order_list' => $order_list,
                'print_title' => $print_title,
                'logo' => $logo,
                'order_id' => $order_id,
                'delivery_id' => $delivery_id,
                'spec_list' => $spec_list,
                'default_spec' => $default_spec,
                'buy_type' => $buy_type,
                'is_exchange' => $is_exchange,
                'is_gift' => $is_gift,
                'is_freebuy' => $is_freebuy,
                'is_reachbuy' => $is_reachbuy,
                'mall_wx_qrcode' => $mall_wx_qrcode,
                'shop_wechat' => $shop_wechat,
                'shop_qrcode' => $shop_qrcode,
                'qrcode_image' => $qrcode_image,
                'store_logo' => $store_logo
            ],
            'app_context_data' => $this->getAppContext(),
            'app_suffix_data' => [],
            'web_data' => $webData,
            'compact_data' => $compact,
            'tpl_view' => 'trade.order.print'
        ];
        $this->setData($data); // 设置数据
        return $this->displayData(); // 模板渲染及APP客户端返回数据
    }

    public function getOrderCounts(Request $request)
    {
        $data = $this->orderInfo->getOrderCounts();

        return json_result($data);
    }
}