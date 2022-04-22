<?php

namespace App\Modules\Frontend\Http\Controllers\User;

use App\Modules\Base\Http\Controllers\UserCenter;
use App\Repositories\ComplaintRepository;
use App\Repositories\OrderGoodsRepository;
use App\Repositories\OrderInfoRepository;
use Illuminate\Http\Request;

class ComplaintController extends UserCenter
{

    protected $complaint;

    public function __construct()
    {
        parent::__construct();

        $this->complaint = new ComplaintRepository();
    }

//    public function index(Request $request)
//    {
//        return $this->lists($request);
//    }

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

        // 列表
        $condition = [
            'where' => $where,
            'sortname' => 'complaint_id',
            'sortorder' => 'desc'
        ];

        list($list, $total) = $this->complaint->getList($condition);
        $list = $list->toArray();

        $pageHtml = frontend_pagination($total);
        $page_array = frontend_pagination($total,true);
        $page_json = json_encode($page_array);

        $complaint_item = [
            "承诺的没做到\r",
            "未按约定时间发货\r",
            "未按成交价格进行交易\r",
            "恶意骚扰\r",
            "拒绝提供售后服务"
        ];
        $complaint_status_list = [
            "0" => "买家提起投诉，等待卖家处理",
            "1" => "协商处理中",
            "2" => "投诉已撤销",
            "3" => "申请平台方介入",
            "5" => "平台方已仲裁，投诉成立",
            "6" => "平台方已仲裁，投诉不成立"
        ];
        $involve_time = '15';
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

        $complaint_id = $request->get('complaint_id');


        // 获取数据

        /*$condition = [
            ['complaint_id', $complaint_id],
        ];*/
        $info = $this->complaint->getById($complaint_id);
        if (empty($info)) {
            abort(200, '投诉id无效');
        }

        $compact = compact('seo_title', 'info');
        $webData = []; // web端（pc、mobile）数据对象
        $data = [
            'app_prefix_data' => [
                // TODO
                'info' => $info
            ],
            'app_suffix_data' => [],
            'web_data' => $webData,
            'compact_data' => $compact,
            'tpl_view' => 'user.complaint.view'
        ];
        $this->setData($data); // 设置数据
        return $this->displayData(); // 模板渲染及APP客户端返回数据
    }


}