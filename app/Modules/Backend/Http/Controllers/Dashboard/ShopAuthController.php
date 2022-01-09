<?php

namespace app\Modules\Backend\Http\Controllers\Dashboard;


use App\Modules\Base\Http\Controllers\Backend;
use App\Repositories\ShopRepository;
use Illuminate\Http\Request;

class ShopAuthController extends Backend
{

    protected $shop;

    public function __construct()
    {
        parent::__construct();

        $this->shop = new ShopRepository();
    }


    public function index(Request $request)
    {
        $title = '店铺营销权限';
        $fixed_title = '店铺营销权限 - '.$title;

        $action_span = [];
        $explain_panel = [
            '平台方控制每个店铺具有的营销工具'
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
        $search_arr = ['pay_name'];
        foreach ($search_arr as $v) {
            if (isset($params[$v]) && !empty($params[$v])) {

                if ($v == 'pay_name') {
                    $where[] = [$v, 'like', "%{$params[$v]}%"];
                } else {
                    $where[] = [$v, $params[$v]];
                }
            }
        }

        // 列表
        $condition = [
            'where' => $where,
            'sortname' => 'shop_sort',
            'sortorder' => 'asc',
        ];
        list($list, $total) = $this->shop->getList($condition);

        $pageHtml = pagination($total);
        if ($request->ajax()) {
            $render = view('dashboard.shop-auth.partials._list', compact('list', 'total', 'pageHtml'))->render();
            return result(0, $render);
        }

        return view('dashboard.shop-auth.index', compact('title', 'list', 'pageHtml'));
    }

    public function view(Request $request)
    {
        $title = '查看营销权限';
        $fixed_title = '店铺营销权限 - '.$title;

        $action_span = [
            [
                'url' => 'index',
                'icon' => 'fa-reply',
                'text' => '返回店铺列表'
            ]
        ];
        $explain_panel = [];
        $blocks = [
            'fixed_title' => $fixed_title,
            'action_span' => $action_span,
            'explain_panel' => $explain_panel,
        ];
        $this->setLayoutBlock($blocks); // 设置block

        return view('dashboard.shop-auth.view', compact('title'));
    }

    public function setAuth(Request $request)
    {
        $title = '营销权限设置';
        $fixed_title = '店铺营销权限 - '.$title;
        $shop_id = $request->get('shop_id');
        $shop_auth_info = [
            'bonus' => 1
        ];

        $shop_info = $this->shop->getById($shop_id);

        $action_span = [
            [
                'url' => 'index',
                'icon' => 'fa-reply',
                'text' => '返回店铺列表'
            ]
        ];
        $explain_panel = [];
        $blocks = [
            'fixed_title' => $fixed_title,
            'action_span' => $action_span,
            'explain_panel' => $explain_panel,
        ];
        $this->setLayoutBlock($blocks); // 设置block

        return view('dashboard.shop-auth.set_auth', compact('title', 'shop_auth_info', 'shop_info'));
    }
}