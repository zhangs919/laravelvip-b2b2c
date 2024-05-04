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
// | Description:投诉管理
// +----------------------------------------------------------------------

namespace App\Modules\Seller\Http\Controllers\Trade;

use App\Models\OrderGoods;
use App\Modules\Base\Http\Controllers\Seller;
use App\Repositories\ComplaintRepository;
use Illuminate\Http\Request;

class ComplaintController extends Seller
{

    private $links = [
        ['url' => 'trade/complaint/list', 'text' => '投诉列表'],
    ];

    protected $complaint;


    public function __construct(
        ComplaintRepository $complaint
    )
    {
        parent::__construct();

        $this->complaint = $complaint;

        $this->set_menu_select('trade', 'trade-complaint-manage');
    }

    /**
     * 投诉列表
     *
     * @param Request $request
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Throwable
     */
    public function lists(Request $request)
    {
        $title = '投诉列表';
        $fixed_title = '投诉管理 - ' . $title;

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

        $where = [];
        // 搜索条件 name 商品名称/订单编号/买家账号
        $search_arr = ['keywords','begin','end','complaint_type'];
        $complaint_status = $request->get('complaint_status', '-1');
        if ($complaint_status != '-1') {
            $where[] = ['complaint_status', $complaint_status];
        }
        foreach ($search_arr as $v) {
            if (isset($params[$v]) && !empty($params[$v])) {
                if ($v == 'keywords') { // todo
//                    $where[] = [$v, 'like', "%{$params[$v]}%"];
                } elseif ($v == 'begin' || $v == 'end') {

                } else {
                    $where[] = [$v, $params[$v]];
                }
            }
        }

        $where[] = ['parent_id', 0];
        $where[] = ['shop_id', seller_shop_info()->shop_id]; // 店铺id

        // 列表
        $condition = [
            'where' => $where,
            'sortname' => 'complaint_id',
            'sortorder' => 'desc'
        ];

        list($list, $total) = $this->complaint->getComplaintList($condition, 1);
        $pageHtml = pagination($total);
        $page = frontend_pagination($total, true);

        // 获取数据
        $complaint_item = format_complaint_type();
        $complaint_status_list = format_complaint_status('-1', 1);
        $complaint_status = null;

        $compact = compact('title', 'list', 'pageHtml', 'params'
            ,'complaint_item','complaint_status_list','complaint_status');
        if ($request->ajax()) {
            $render = view('trade.complaint.partials._list', $compact)->render();
            return result(0, $render);
        }

        $webData = []; // web端（pc、mobile）数据对象
        $data = [
            'app_extra_data' => [

            ],
            'app_prefix_data' => [
                'list' => $list,
                'page' => $page,
                'complaint_item' => $complaint_item,
                'complaint_status_list' => $complaint_status_list,
                'complaint_status' => $complaint_status,
            ],
            'app_context_data' => $this->getAppContext(),
            'app_suffix_data' => [],
            'web_data' => $webData,
            'compact_data' => $compact,
            'tpl_view' => 'trade.complaint.list'
        ];
        $this->setData($data); // 设置数据
        return $this->displayData(); // 模板渲染及APP客户端返回数据
    }

    /**
     * 投诉详情
     *
     * @param Request $request
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function info(Request $request)
    {
        $title = '投诉详情';
        $fixed_title = '投诉管理 - ' . $title;
        $complaint_id = $request->get('complaint_id');

        $action_span = [
            [
                'id' => '',
                'url' => '/trade/complaint/list',
                'icon' => 'fa-reply',
                'text' => '返回投诉列表'
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
        $complaint_info = $this->complaint->getSellerComplaintInfo($complaint_id);
        $model = [
            'complaint_status' => $complaint_info['complaint_status'],
            'complaint_sn' => $complaint_info['complaint_sn'],
        ];
        $deduct_money = $complaint_info['deduct_money'];
        $deduct_credit = $complaint_info['deduct_credit'];
        $complaint_reply = $this->complaint->getComplaintReplyList($complaint_id);
        $complaint_item = format_complaint_type();
        $seller_ps_complain_term = sysconf('seller_ps_complain_term');

        $compact = compact('title', 'model','deduct_money','deduct_credit','complaint_reply',
            'complaint_info','complaint_item','seller_ps_complain_term');

        $webData = []; // web端（pc、mobile）数据对象
        $data = [
            'app_extra_data' => [],
            'app_prefix_data' => [
                'model' => $model,
                'deduct_money' => $deduct_money,
                'deduct_credit' => $deduct_credit,
                'complaint_reply' => $complaint_reply,
                'complaint_info' => $complaint_info,
                'complaint_item' => $complaint_item,
                'seller_ps_complain_term' => $seller_ps_complain_term,
            ],
            'app_context_data' => $this->getAppContext(),
            'app_suffix_data' => [],
            'web_data' => $webData,
            'compact_data' => $compact,
            'tpl_view' => 'trade.complaint.info'
        ];
        $this->setData($data); // 设置数据
        return $this->displayData(); // 模板渲染及APP客户端返回数据
    }

    public function saveInfo(Request $request)
    {
        $id = $request->get('complaint_id');
        $info = $this->complaint->getById($id);
        if (empty($info)) {
            return result(-1, null, INVALID_PARAM);
        }
        $complaintModel = $request->post('ComplaintModel');

        $complaint_order = OrderGoods::where([['order_id', $info->order_id],['sku_id',$info->sku_id]])
            ->with('orderInfo')
            ->first();
        if (empty($complaint_order)) {
            return result(-1,null,INVALID_PARAM);
        }

        $complaintModel['complaint_sn'] = $info->complaint_sn;
        $complaintModel['parent_id'] = $id;
        $complaintModel['complaint_status'] = 1; // 卖家回复

        $ret = $this->complaint->addData($complaint_order, $complaintModel, 1);
        if (!$ret) {
            return result(-1,null,'保存失败！');
        }

        return result(0,null,'保存成功！');
    }

}