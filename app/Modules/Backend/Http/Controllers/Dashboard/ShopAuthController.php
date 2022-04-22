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

    /**
     * 查看营销权限
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function view(Request $request)
    {
        $title = '查看营销权限';
        $fixed_title = '店铺营销权限 - '.$title;
        $shop_id = $request->get('shop_id');

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

        $shop_info = $this->shop->getById($shop_id);

        $shop_auth = !empty(shopconf('shop_auth', false, $shop_id)) ? unserialize(shopconf('shop_auth', false, $shop_id)) : []; // 店铺营销权限

        $shop_application_list = get_shop_application_list(); // 店铺所有营销权限

        return view('dashboard.shop-auth.view', compact('title', 'shop_info', 'shop_auth', 'shop_application_list'));
    }

    /**
     * 营销权限设置
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function setAuth(Request $request)
    {
        $title = '营销权限设置';
        $fixed_title = '店铺营销权限 - '.$title;
        $shop_id = $request->get('shop_id');

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

        $shop_info = $this->shop->getById($shop_id);

        $shop_auth = !empty(shopconf('shop_auth', false, $shop_id)) ? unserialize(shopconf('shop_auth', false, $shop_id)) : []; // 店铺营销权限

        $shop_application_list = get_shop_application_list(); // 店铺所有营销权限

        if ($request->method() == 'POST') {
            // 保存设置
            $postData = $request->post();
            unset($postData['_token'], $postData['ShopConfig']);
            $postData = serialize(array_keys($postData));
            $ret = shopconf('shop_auth', $postData, $shop_id);
            if ($ret === false) {
                // Log
                admin_log('店铺营销权限设置。ID：'.$shop_id);
                flash('error', '店铺营销权限设置失败');
                return redirect('/dashboard/shop-auth/index');
            }

            // Log
            admin_log('店铺营销权限设置。ID：'.$shop_id);
            flash('success', '店铺营销权限设置成功');
            return redirect('/dashboard/shop-auth/index');
        }

        return view('dashboard.shop-auth.set_auth', compact('title', 'shop_info', 'shop_auth', 'shop_application_list'));
    }

    /**
     * 设置/取消全部权限
     *
     * @param Request $request
     * @return array
     * @throws \Throwable
     */
    public function allAuth(Request $request)
    {
        $is_all = $request->get('is_all', 0); // 是否设置全部权限
        $shop_id = $request->get('shop_id'); // 店铺id

        $shop_auth = serialize($is_all == 1 ? 'all_auth' : []);
        $ret = shopconf('shop_auth', $shop_auth, $shop_id);

        if ($ret === false) {
            admin_log('店铺营销权限设置。ID：'.$shop_id);
            return result(-1, null, '设置失败');
        }

        admin_log('店铺营销权限设置。ID：'.$shop_id);
        return result(0);

    }
}