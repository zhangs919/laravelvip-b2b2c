<?php

namespace App\Modules\Frontend\Http\Controllers\User;

use App\Models\OrderGoods;
use App\Modules\Base\Http\Controllers\UserCenter;
use App\Repositories\ComplaintRepository;
use App\Repositories\ShopRepository;
use Illuminate\Http\Request;

class ComplaintController extends UserCenter
{

    protected $complaint;
    protected $shop;

    public function __construct(ComplaintRepository $complaint,ShopRepository $shop)
    {
        parent::__construct();

        $this->complaint = $complaint;
        $this->shop = $shop;
    }

    public function lists(Request $request)
    {
        $seo_title = '用户中心';

        $params = $request->all();

        // 获取数据
        $where = [];
        // 搜索条件
        $search_arr = ['order_id', 'complaint_id', 'complaint_status', 'complaint_time'];
        foreach ($search_arr as $v) {
            if (isset($params[$v]) && !empty($params[$v])) {
                if ($v == 'order_id') {
                    $where[] = ['order_sn', 'like', "%{$params[$v]}%"];
                } elseif ($v == 'complaint_id') {
                    $where[] = ['complaint_sn', 'like', "%{$params[$v]}%"];
                } else {
                    $where[] = [$v, $params[$v]];
                }
            }
        }

        $where[] = ['user_id', $this->user_id];
        $where[] = ['parent_id', 0];

        // 列表
        $condition = [
            'where' => $where,
            'sortname' => 'complaint_id',
            'sortorder' => 'desc'
        ];

        list($list, $total) = $this->complaint->getComplaintList($condition);
        $pageHtml = frontend_pagination($total);
        $page_array = frontend_pagination($total,true);
        $page_json = json_encode($page_array);

        $complaint_item = format_complaint_type();

        $complaint_status_list = format_complaint_status('-1', 1);
        $involve_time = sysconf('complaint_seller_term');
        $nav_default = 'complaint';

        $compact = compact('seo_title','pageHtml', 'list', 'page_json',
            'complaint_item', 'complaint_status_list', 'involve_time', 'nav_default');

        if ($request->ajax() && !is_app()) { // web端访问 ajax请求
            $render = view('user.complaint.partials._list', $compact)->render();
            return result(0, $render);
        }

        $webData = []; // web端（pc、mobile）数据对象
        $data = [
            'app_prefix_data' => [
                'page' => $page_array,
                'list' => $list,
                'complaint_item' => $complaint_item,
                'complaint_status_list' => $complaint_status_list,
                'involve_time' => $involve_time,
                'nav_default' => $nav_default
            ],
            'app_suffix_data' => [],
            'web_data' => $webData,
            'compact_data' => $compact,
            'tpl_view' => 'user.complaint.list'
        ];
        $this->setData($data); // 设置数据
        return $this->displayData(); // 模板渲染及APP客户端返回数据
    }

    /**
     * 详情
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function view(Request $request)
    {
        $seo_title = '用户中心';

        // 获取数据
        $model = null;
        $id = $request->get('complaint_id');
        $complaint_view = $this->complaint->getUserCenterViewData($id);
        if (empty($complaint_view)) {
            abort(200, '投诉id无效');
        }

        $complaint_reply = $this->complaint->getComplaintReplyList($id);
        $complaint_item = format_complaint_type();
        $involve_time = 0;
        $involve_status = [
            'show' => 1
        ];
        $nav_default = 'complaint';

        $compact = compact('seo_title', 'model','id','complaint_view',
            'complaint_reply','complaint_item','involve_time','involve_status','nav_default');
        $webData = []; // web端（pc、mobile）数据对象
        $data = [
            'app_prefix_data' => [
                'complaint_view' => $complaint_view,
                'complaint_reply' => $complaint_reply,
                'complaint_item' => $complaint_item,
                'involve_time' => $involve_time,
                'involve_status' => $involve_status,
                'nav_default' => $nav_default,
            ],
            'app_suffix_data' => [],
            'web_data' => $webData,
            'compact_data' => $compact,
            'tpl_view' => 'user.complaint.view'
        ];
        $this->setData($data); // 设置数据
        return $this->displayData(); // 模板渲染及APP客户端返回数据
    }


    /**
     * 投诉商家
     *
     * @param Request $request
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function add(Request $request)
    {
        $seo_title = '用户中心';

        $order_id = $request->get('order_id');
        $sku_id = $request->get('sku_id');


        // 获取数据
        $model = null;
        $images = json_encode([]);

        $complaint_order = $this->complaint->getUserCenterAddData($order_id,$sku_id);

        $complaint_item = explode("\r\n", sysconf('complaint_reason'));
        $complaint_seller_term = sysconf('complaint_seller_term');
        $nav_default = 'complaint';

        $compact = compact('seo_title', 'model','images','complaint_order',
            'complaint_item','complaint_seller_term','nav_default');
        $webData = []; // web端（pc、mobile）数据对象
        $data = [
            'app_prefix_data' => [
                'model' => $model,
                'images' => $images,
                'complaint_order' => $complaint_order,
                'complaint_item' => $complaint_item,
                'complaint_seller_term' => $complaint_seller_term,
                'nav_default' => $nav_default,
            ],
            'app_suffix_data' => [],
            'web_data' => $webData,
            'compact_data' => $compact,
            'tpl_view' => 'user.complaint.add'
        ];
        $this->setData($data); // 设置数据
        return $this->displayData(); // 模板渲染及APP客户端返回数据
    }

    /**
     * 投诉商家 保存数据
     *
     * @param Request $request
     * @return array|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function addSaveData(Request $request)
    {
        $order_id = $request->get('order_id');
        $sku_id = $request->get('sku_id');
        $complaintModel = $request->post('ComplaintModel');

        $complaint_order = OrderGoods::where([['order_id', $order_id],['sku_id',$sku_id]])
            ->with('orderInfo')
            ->first();
        if (empty($complaint_order)) {
            return result(-1,null,INVALID_PARAM);
        }

        $ret = $this->complaint->addData($complaint_order, $complaintModel);

        if (!$ret) {
            return result(-1,null,'保存失败！');
        }

        return result(0,null,'保存成功！');
    }
}