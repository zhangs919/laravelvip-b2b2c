<?php

namespace App\Modules\Frontend\Http\Controllers\User;

use App\Modules\Base\Http\Controllers\UserCenter;
use Illuminate\Http\Request;

class MemberCardController extends UserCenter
{

    protected $memberCard;

    public function __construct()
    {
        parent::__construct();

    }



    public function lists(Request $request)
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

        list($shop_rank, $total) = [[], 0];

        $pageHtml = frontend_pagination($total);
        $page_array = frontend_pagination($total,true);
        $page_json = json_encode($page_array);

        $nav_default = 'member-card';

        $compact = compact('seo_title','pageHtml', 'shop_rank', 'page_json', 'nav_default');

        if ($request->ajax() && !is_app()) { // web端访问 ajax请求
            $render = view('user.member-card.partials._list', $compact)->render();
            return result(0, $render);
        }

        $webData = []; // web端（pc、mobile）数据对象
        $data = [
            'app_prefix_data' => [
                'shop_rank' => $shop_rank,
                'page' => $page_array,
                'nav_default' => $nav_default
            ],
            'app_suffix_data' => [],
            'web_data' => $webData,
            'compact_data' => $compact,
            'tpl_view' => 'user.member-card.list'
        ];
        $this->setData($data); // 设置数据
        return $this->displayData(); // 模板渲染及APP客户端返回数据
    }

}