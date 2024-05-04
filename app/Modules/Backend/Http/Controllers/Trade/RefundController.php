<?php

namespace App\Modules\Backend\Http\Controllers\Trade;

use App\Models\BackLog;
use App\Models\OrderGoods;
use App\Models\OrderInfo;
use App\Models\ShopAddress;
use App\Models\User;
use App\Modules\Base\Http\Controllers\Backend;
use App\Repositories\BackOrderRepository;
use Illuminate\Http\Request;

class RefundController extends Backend
{

    private $links = [
        ['url' => 'trade/refund/list', 'text' => '退款退货'],
    ];

    private $after_sale_links = [
        ['url' => 'trade/refund/list?is_after_sale=1&type=0', 'text' => '退款退货'],
        ['url' => 'trade/refund/list?is_after_sale=1&type=1', 'text' => '换货维修'],
    ];

    protected $backOrder;

    public function __construct(
        BackOrderRepository $backOrder
    )
    {
        parent::__construct();

        $this->backOrder = $backOrder;
    }


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
        $explain_panel = [
            '退款退货受交易设置处的退款申请是否需要审核控制，如果需要审核，则平台方需要对退款退货信息进行核实和确认'
        ];
        $blocks = [
            'fixed_title' => $fixed_title,
            'action_span' => $action_span,
            'explain_panel' => $explain_panel,
        ];
        $this->setLayoutBlock($blocks); // 设置block

        $params = $request->all();

        // 搜索条件
        $search_arr = ['shop_name', 'order_sn','back_sn','user_name','begin','end','back_status'];
        foreach ($search_arr as $v) {
            if (isset($params[$v]) && !empty($params[$v])) {
                if ($v == 'shop_name') { // todo
                    $where[] = [$v, 'like', "%{$params[$v]}%"];
                } elseif ($v == 'begin' || $v == 'end') {

                }
                else {
                    $where[] = [$v, $params[$v]];
                }
            }
        }

        // 列表
        $condition = [
            'where' => $where,
            'sortname' => 'back_id',
            'sortorder' => 'desc'
        ];

        list($list, $total) = $this->backOrder->getBackendBackOrderList($condition);
        $pageHtml = pagination($total);

        $compact = compact('title','list', 'total', 'pageHtml', 'params','is_after_sale','type');
        if ($request->ajax()) {
            $render = view('trade.refund.partials._list', $compact)->render();
            return result(0, $render);
        }

        return view('trade.refund.list', $compact);
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
        $fixed_title = '退款管理 - '.$title;
        $id = $request->get('id');

        $action_span = [
            [
                'id' => '',
                'url' => 'list',
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
            ['back_id', $id],
        ];
        $back_info = $this->backOrder->getSellerBackOrderInfo($condition);
        if (empty($back_info)) {
            abort(200, INVALID_PARAM);
        }
        $back_schedules = $this->backOrder->getBackSchedules($back_info);
        $order_info = OrderInfo::where('order_id',$back_info['order_id'])->first()->toArray();
        $goods_info = OrderGoods::where('record_id',$back_info['record_id'])->first()->toArray();
        $goods_info['goods_price_format'] = "￥".$goods_info['goods_price'];
        $goods_info['send_number'] = 1; //
        $goods_info['send_number_money'] = $goods_info['goods_price']; //
        $goods_info['all_number_money'] = $goods_info['goods_price']; //
        $goods_info['sku_img'] = get_image_url($goods_info['goods_image']); //

        $user_info = User::where('user_id',$back_info['user_id'])->first()->toArray();
        //申请退款卖家确认期限
        $back_seller_term = sysconf('back_seller_term');
        $back_logs = BackLog::where('back_id', $id)->get()->toArray();
        $default_user_portrait = get_image_url(sysconf('default_user_portrait'));
        $right_title = '申请售后';
        $nav_default = 'service';
        $shop_address = ShopAddress::where('shop_id', $order_info['shop_id'])->where('is_default', 1)->first();
        $addr_info = "{$shop_address->region_names} {$shop_address->address_detail}（{$shop_address->consignee}收） {$shop_address->mobile}";
        $service_name = format_back_type($back_info['back_type']);

        $compact = compact('seo_title', 'back_info','back_schedules','order_info',
            'goods_info','user_info','back_seller_term','back_logs','default_user_portrait','right_title','nav_default',
            'addr_info','service_name');

       return view('trade.refund.info', $compact);
    }

    /**
     * 退款操作
     *
     * @param Request $request
     */
    public function editOrder(Request $request)
    {
        // 记录卖家账户明细

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
