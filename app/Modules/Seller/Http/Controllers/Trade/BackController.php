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
// | Date:2020-01-13
// | Description:退款/退货/售后管理
// +----------------------------------------------------------------------

namespace App\Modules\Seller\Http\Controllers\Trade;

use App\Models\BackLog;
use App\Models\OrderGoods;
use App\Models\OrderInfo;
use App\Models\ShopAddress;
use App\Modules\Base\Http\Controllers\Seller;
use App\Repositories\BackOrderRepository;
use App\Repositories\ComplaintRepository;
use Illuminate\Http\Request;

class BackController extends Seller
{

    private $links = [
        ['url' => 'trade/back/list', 'text' => '退款退货'],
    ];

    private $after_sale_links = [
        ['url' => 'trade/back/list?is_after_sale=1&type=0', 'text' => '退款退货'],
        ['url' => 'trade/back/list?is_after_sale=1&type=1', 'text' => '换货维修'],
    ];

    protected $backOrder;


    public function __construct(
        Request $request,
        BackOrderRepository $backOrder
    )
    {
        parent::__construct();

        $this->backOrder = $backOrder;

        // 退款/退货管理
        $this->set_menu_select('trade', 'trade-back-list');
        if ($request->get('is_after_sale') == 1) {
            // 售后管理
            $this->set_menu_select('trade', 'trade-after-sale-list');
        }
    }

    /**
     * 列表
     *
     * @param Request $request
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Throwable
     */
    public function lists(Request $request)
    {
        $is_after_sale = $request->get('is_after_sale',0); // 是否售后单 0-售前退款退货 1-售后退款退货/售后换货维修
        $type = $request->get('type',0); // 售后类型 0-退款退货 1-换货维修

        $where = [];
        $where[] = ['is_after_sale', $is_after_sale];
        if ($is_after_sale) { // 售后管理
            $mainTitle = '售后管理';
            if ($type) { // 换货维修
                $title = '换货维修';
                $condition['in'] = [
                    'field' => 'back_type',
                    'condition' => [3,4] // 换货、申请维修
                ];
            } else {
                $title = '退款退货';
                $where[] = ['back_type',2]; // 默认 退款退货
            }

            $this->sublink($this->after_sale_links, $type, 'type');
        } else { // 退款管理
            $mainTitle = '退款管理';
            $title = '退款退货';

            $this->sublink($this->links, 'list');
        }

        $fixed_title = "{$mainTitle} - {$title}";

        $action_span = [];
        $explain_panel = [];
        $blocks = [
            'fixed_title' => $fixed_title,
            'action_span' => $action_span,
            'explain_panel' => $explain_panel,
        ];
        $this->setLayoutBlock($blocks); // 设置block

        $params = $request->all();

        $where = [];
        // 搜索条件 name 商品名称/订单编号/买家账号
        $search_arr = ['keywords','add_time_begin','add_time_end'];
        foreach ($search_arr as $v) {
            if (isset($params[$v]) && !empty($params[$v])) {
                if ($v == 'keywords') { // todo
//                    $where[] = [$v, 'like', "%{$params[$v]}%"];
                } elseif ($v == 'add_time_begin' || $v == 'add_time_end') {

                } else {
                    $where[] = [$v, $params[$v]];
                }
            }
        }

        $where[] = ['shop_id', seller_shop_info()->shop_id]; // 店铺id

        // 列表
        $condition = [
            'where' => $where,
            'sortname' => 'back_id',
            'sortorder' => 'desc'
        ];

        list($list, $total) = $this->backOrder->getSellerBackOrderList($condition);
        $pageHtml = pagination($total);
        $page = frontend_pagination($total, true);


        // 获取数据

        $compact = compact('title', 'list', 'pageHtml', 'params','is_after_sale','type');
        if ($request->ajax()) {
            $render = view('trade.back.partials._list', $compact)->render();
            return result(0, $render);
        }

        $webData = []; // web端（pc、mobile）数据对象
        $data = [
            'app_extra_data' => [

            ],
            'app_prefix_data' => [
                'list' => $list,
                'page' => $page,
                'is_after_sale' => $is_after_sale,
                'type' => $type
            ],
            'app_context_data' => $this->getAppContext(),
            'app_suffix_data' => [],
            'web_data' => $webData,
            'compact_data' => $compact,
            'tpl_view' => 'trade.back.list'
        ];
        $this->setData($data); // 设置数据
        return $this->displayData(); // 模板渲染及APP客户端返回数据
    }

    /**
     * 详情
     *
     * @param Request $request
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function info(Request $request)
    {
        $title = '退款、退货详情';
        $fixed_title = '售后管理 - ' . $title;
        $id = $request->get('id');

        $action_span = [
            [
                'id' => '',
                'url' => '/trade/back/list',
                'icon' => 'fa-reply',
                'text' => '返回退款列表'
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
            ['back_id',$id],
            ['shop_id',seller_shop_info()->shop_id]
        ];
        $back_info = $this->backOrder->getSellerBackOrderInfo($condition);
        if (!$back_info) {
            abort(200,INVALID_PARAM);
        }
        $order_info = OrderInfo::where('order_id',$back_info['order_id'])->with(['user'])->first()->toArray();
        $goods_info = OrderGoods::where('record_id',$back_info['record_id'])->first()->toArray();
        $goods_info['goods_price_format'] = "￥".$goods_info['goods_price'];
        $goods_info['send_number'] = 1; //
        $goods_info['send_number_money'] = $goods_info['goods_price']; //
        $goods_info['all_number_money'] = $goods_info['goods_price']; //
        $goods_info['sku_img'] = get_image_url($goods_info['goods_image']); //
        $sku_info = [];
        $back_logs = BackLog::where('back_id', $id)->get()->toArray();
        $shop_address = ShopAddress::where('shop_id', $order_info['shop_id'])->where('is_default', 1)->first();
        $addr_info = "{$shop_address->region_names} {$shop_address->address_detail}（{$shop_address->consignee}收） {$shop_address->mobile}";
        $service_name = format_back_type($back_info['back_type']);

        $compact = compact('title', 'back_info','order_info','goods_info','sku_info',
            'back_logs','addr_info','service_name');

        $webData = []; // web端（pc、mobile）数据对象
        $data = [
            'app_extra_data' => [],
            'app_prefix_data' => [
                'back_info'=>$back_info,
                'order_info'=>$order_info,
                'goods_info'=>$goods_info,
                'sku_info'=>$sku_info,
                'back_logs'=>$back_logs,
                'addr_info'=>$addr_info,
                'service_name'=>$service_name
            ],
            'app_context_data' => $this->getAppContext(),
            'app_suffix_data' => [],
            'web_data' => $webData,
            'compact_data' => $compact,
            'tpl_view' => 'trade.back.info'
        ];
        $this->setData($data); // 设置数据
        return $this->displayData(); // 模板渲染及APP客户端返回数据
    }

    public function editOrder(Request $request)
    {
        $id = $request->post('id');
        $type = $request->post('type'); // confirm-同意申请，发送退货地址 shipped-确认收到货物 dismiss-拒绝申请

        $ret = $this->backOrder->editOrder($id, $type);

    }

    /**
     * 系统自动同意申请
     *
     * @param Request $request
     * @return array
     */
    public function confirmSys(Request $request)
    {
        $back_id = $request->get('back_id');
        // 获取数据
        $condition = [
            ['back_id',$back_id],
            ['shop_id',seller_shop_info()->shop_id]
        ];
        $back_info = $this->backOrder->getSellerBackOrderInfo($condition);
        if (!$back_info) {
            abort(200,INVALID_PARAM);
        }
        $ret = $this->backOrder->confirmSys($back_info);
        if (!$ret) {
            return result(-1, null, '操作失败');
        }

        return result(0, null, '操作成功');
    }

    // 导出数据
    public function export(Request $request)
    {

    }
}
