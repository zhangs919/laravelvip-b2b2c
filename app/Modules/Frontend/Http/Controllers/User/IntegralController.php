<?php

namespace App\Modules\Frontend\Http\Controllers\User;

use App\Modules\Base\Http\Controllers\UserCenter;
use App\Repositories\IntegralOrderInfoRepository;
use App\Repositories\UserPointsLogRepository;
use Illuminate\Http\Request;

class IntegralController extends UserCenter
{
    protected $userPointsLog;
    protected $integralOrderInfo;

    public function __construct(
        UserPointsLogRepository $userPointsLog
        ,IntegralOrderInfoRepository $integralOrderInfo
    )
    {
        parent::__construct();

        $this->userPointsLog = $userPointsLog;
        $this->integralOrderInfo = $integralOrderInfo;

    }

    public function detail(Request $request)
    {
        $seo_title = '用户中心';

        // 获取数据
        $where = [];
        // 搜索条件
        $search_arr = ['reason'];
        foreach ($search_arr as $v) {
            if (isset($params[$v]) && !empty($params[$v])) {
                if ($v == 'reason') { // todo
                    $where[] = [$v, 'like', "%{$params[$v]}%"];
                }
                else {
                    $where[] = [$v, $params[$v]];
                }
            }
        }

        $where[] = ['user_id', $this->user_id];
        // 列表
        $condition = [
            'where' => $where,
            'sortname' => 'log_id',
            'sortorder' => 'desc'
        ];

        list($list, $total) = $this->userPointsLog->getList($condition);
        $list = $list->toArray();
        $pageHtml = frontend_pagination($total);
        $page_array = frontend_pagination($total,true);
        $page_json = json_encode($page_array);

        $user_points = '10';
        $exchanged_count = '0';
        $integral_model = '0';
        $erp_shop_exists = true;

        $compact = compact('seo_title', 'list','pageHtml','page_json','user_points',
            'exchanged_count','integral_model','erp_shop_exists');

        if ($request->ajax() && !is_app()) { // web端访问 ajax请求
            $render = view('user.integral.partials._detail', $compact)->render();
            return result(0, $render);
        }

        $webData = []; // web端（pc、mobile）数据对象
        $data = [
            'app_prefix_data' => [
                'page' => $page_array,
                'list' => $list,
                'user_points' => $user_points,
                'exchanged_count' => $exchanged_count,
                'integral_model' =>$integral_model,
                'erp_shop_exists' =>$erp_shop_exists

            ],
            'app_suffix_data' => [],
            'web_data' => $webData,
            'compact_data' => $compact,
            'tpl_view' => 'user.integral.detail'
        ];
        $this->setData($data); // 设置数据
        return $this->displayData(); // 模板渲染及APP客户端返回数据
    }

    /**
     * 查看各商家账户积分
     *
     * @return array|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     * @throws \Throwable
     */
    public function view()
    {
        $list = [];
        $render = view('user.integral.view', compact('list'))->render();

        return result(0, $render);
    }

    //将商家的线下积分转入商城
    public function getBalancePoints(Request $request)
    {

    }


    public function orderList(Request $request)
    {
        $seo_title = '用户中心';

        // 获取数据
        $where = [];
        // 搜索条件
        $search_arr = ['name'];
        foreach ($search_arr as $v) {
            if (isset($params[$v]) && !empty($params[$v])) {
                if ($v == 'name') {
                    $where[] = [$v, 'like', "%{$params[$v]}%"];
                }
                else {
                    $where[] = [$v, $params[$v]];
                }
            }
        }

        $where[] = ['user_id', $this->user_id];
        // 列表
        $condition = [
            'where' => $where,
            'sortname' => 'order_id',
            'sortorder' => 'desc'
        ];

        list($list, $total) = $this->integralOrderInfo->getList($condition);
        $list = $list->toArray();
        $pageHtml = frontend_pagination($total);
        $page_array = frontend_pagination($total,true);
        $page_json = json_encode($page_array);

        $order_count = $this->integralOrderInfo->getOrderCounts($this->user_id);
        $order_status_list = $this->integralOrderInfo->getOrderStatusList();
        $order_time_list = [
            '' => '全部',
            'ThreeMonth' => '近三个月订单',
            'ThisYear' => '今年内订单',
            'OneYear' => '2017年订单',
            'TwoYear' => '2016年订单',
            'ThreeYear' => '2015年订单',
            'OldYear' => '2015年以前订单',
        ];
        $pickup_list = [
            '全部' ,
            '普通快递' ,
            '上门自提' ,
        ];
        $integral_model = '0';
        $nav_default = 'integral';


        $compact = compact('seo_title', 'list','pageHtml','page_json',
            'order_count','order_status_list','order_time_list','pickup_list',
            'integral_model','nav_default');

        if ($request->ajax() && !is_app()) { // web端访问 ajax请求
            $render = view('user.integral.partials._order_list', $compact)->render();
            return result(0, $render);
        }

        $webData = []; // web端（pc、mobile）数据对象
        $data = [
            'app_prefix_data' => [
                'page' => $page_array,
                'list' => $list,
                'order_count' => $order_count,
                'order_status_list' => $order_status_list,
                'order_time_list' => $order_time_list,
                'pickup_list' => $pickup_list,
                'integral_model' =>$integral_model,
                'nav_default' =>$nav_default

            ],
            'app_suffix_data' => [],
            'web_data' => $webData,
            'compact_data' => $compact,
            'tpl_view' => 'user.integral.order_list'
        ];
        $this->setData($data); // 设置数据
        return $this->displayData(); // 模板渲染及APP客户端返回数据
    }

    /**
     * 订单详情
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function orderInfo(Request $request)
    {
        $seo_title = '用户中心';

        $id = $request->get('id');


        // 获取数据

        $condition = [
            ['order_id', $id],
            ['user_id', $this->user_id]
        ];
        $order_info = $this->integralOrderInfo->getFrontendOrderInfo($condition);
        if (empty($order_info)) {
            abort(200, '订单id无效');
        }

        $order_schedules = $this->integralOrderInfo->getOrderSchedules($order_info);

        $compact = compact('seo_title','order_info','order_schedules');
        $webData = []; // web端（pc、mobile）数据对象
        $data = [
            'app_prefix_data' => [
                'order_info' => $order_info,
                'order_schedules' => $order_schedules
            ],
            'app_suffix_data' => [],
            'web_data' => $webData,
            'compact_data' => $compact,
            'tpl_view' => 'user.order.info'
        ];
        $this->setData($data); // 设置数据
        return $this->displayData(); // 模板渲染及APP客户端返回数据
    }

}
