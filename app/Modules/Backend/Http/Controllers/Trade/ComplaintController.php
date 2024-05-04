<?php

namespace App\Modules\Backend\Http\Controllers\Trade;

use App\Modules\Base\Http\Controllers\Backend;
use App\Repositories\ComplaintRepository;
use Illuminate\Http\Request;

class ComplaintController extends Backend
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
    }


    public function lists(Request $request)
    {
        $title = '投诉列表';
        $fixed_title = '投诉管理 - '.$title;

        $action_span = [];
        $explain_panel = [
            '所有的投诉信息均需要平台方进行审核操作，平台方需要对商城投诉信息进行核实并确认'
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
        $search_arr = ['order_id','complaint_id','shop_name','complaint_type'];
        $complaint_status = $request->get('complaint_status', '-1');
        if ($complaint_status != '-1') {
            $where[] = ['complaint_status', $complaint_status];
        }
        foreach ($search_arr as $v) {
            if (isset($params[$v]) && !empty($params[$v])) {
                if ($v == 'shop_name') {
                    $where[] = [$v, 'like', "%{$params[$v]}%"];
                } elseif ($v == 'begin' || $v == 'end') {

                }
                else {
                    $where[] = [$v, $params[$v]];
                }
            }
        }

        $where[] = ['parent_id', 0];

        // 列表
        $condition = [
            'where' => $where,
            'sortname' => 'complaint_id',
            'sortorder' => 'desc'
        ];

        list($list, $total) = $this->complaint->getComplaintList($condition, 2);
        $pageHtml = pagination($total);

        $complaint_item = format_complaint_type();
        $complaint_status_list = format_complaint_status('-1', 1);
        $complaint_status = null;

        $compact = compact('title', 'list', 'pageHtml', 'params'
            ,'complaint_item','complaint_status_list','complaint_status');
        if ($request->ajax()) {
            $render = view('trade.complaint.partials._list', $compact)->render();
            return result(0, $render);
        }

        return view('trade.complaint.list', $compact);
    }

    /**
     * 详情
     *
     * @param Request $request
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function info(Request $request)
    {
        $title = '投诉详情';
        $fixed_title = '投诉管理 - '.$title;
        $complaint_id = $request->get('complaint_id');

        $action_span = [
            [
                'id' => '',
                'url' => 'list',
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

        $compact = compact('title', 'model','deduct_money','deduct_credit','complaint_reply',
            'complaint_info','complaint_item');

       return view('trade.complaint.info', $compact);
    }

    public function edit(Request $request)
    {
        $id = $request->get('id');
        $uuid = make_uuid();
        $info = $this->complaint->getById($id);
        $render = view('trade.complaint.edit', compact('uuid', 'info'))->render();

        return result(0, $render);
    }

    public function editPost(Request $request)
    {
        $post = $request->post('ComplaintModel');
        return result(0, '', '裁决成功');
    }

}