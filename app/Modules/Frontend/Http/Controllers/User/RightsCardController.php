<?php

namespace App\Modules\Frontend\Http\Controllers\User;

use App\Modules\Base\Http\Controllers\UserCenter;
use Illuminate\Http\Request;

class RightsCardController extends UserCenter
{

    protected $memberCard;

    public function __construct()
    {
        parent::__construct();

    }



    public function index(Request $request)
    {
        $seo_title = '用户中心';

        $params = $request->all();


        // 获取数据
        $where = [];
        // 搜索条件

        $where[] = ['user_id', $this->user_id];

        // 列表
        $condition = [
            'where' => $where,
            'sortname' => 'id',
            'sortorder' => 'desc'
        ];

        list($list, $total) = [[], 0];

        $pageHtml = frontend_pagination($total);
        $page_array = frontend_pagination($total,true);
        $page_json = json_encode($page_array);

        $nav_default = 'rights-card';

        $compact = compact('seo_title','pageHtml', 'list', 'page_json', 'nav_default');

        if ($request->ajax() && !is_app()) { // web端访问 ajax请求
            $render = view('user.rights-card.partials._list', $compact)->render();
            return result(0, $render);
        }

        $webData = []; // web端（pc、mobile）数据对象
        $data = [
            'app_prefix_data' => [
                'list' => $list,
                'page' => $page_array,
                'nav_default' => $nav_default
            ],
            'app_suffix_data' => [],
            'web_data' => $webData,
            'compact_data' => $compact,
            'tpl_view' => 'user.rights-card.index'
        ];
        $this->setData($data); // 设置数据
        return $this->displayData(); // 模板渲染及APP客户端返回数据
    }

    public function buyList(Request $request)
    {
        $seo_title = '用户中心';

        $params = $request->all();


        // 获取数据
        $where = [];
        // 搜索条件

        $where[] = ['user_id', $this->user_id];

        // 列表
        $condition = [
            'where' => $where,
            'sortname' => 'id',
            'sortorder' => 'desc'
        ];

        list($buy_list, $total) = [[], 0];

        $pageHtml = frontend_pagination($total);
        $page_array = frontend_pagination($total,true);
        $page_json = json_encode($page_array);

        $nav_default = 'rights-card';

        $compact = compact('seo_title','pageHtml', 'buy_list', 'page_json', 'nav_default');

        if ($request->ajax() && !is_app()) { // web端访问 ajax请求
            $render = view('user.rights-card.partials._buy_list', $compact)->render();
            return result(0, $render);
        }

        $webData = []; // web端（pc、mobile）数据对象
        $data = [
            'app_prefix_data' => [
                'buy_list' => $buy_list,
                'page' => $page_array,
                'nav_default' => $nav_default
            ],
            'app_suffix_data' => [],
            'web_data' => $webData,
            'compact_data' => $compact,
            'tpl_view' => 'user.rights-card.buy_list'
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
    public function info(Request $request)
    {
        $seo_title = '用户中心';

        $id = $request->get('id');


        // 获取数据
        $info = [1];
        if (empty($info)) {
            abort(200, '权益卡id无效');
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
            'tpl_view' => 'user.rights-card.info'
        ];
        $this->setData($data); // 设置数据
        return $this->displayData(); // 模板渲染及APP客户端返回数据
    }
}