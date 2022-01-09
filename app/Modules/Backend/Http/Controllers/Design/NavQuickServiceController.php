<?php


namespace app\Modules\Backend\Http\Controllers\Design;

use App\Modules\Base\Http\Controllers\Backend;
use App\Repositories\NavQuickServiceRepository;
use Illuminate\Http\Request;

class NavQuickServiceController extends Backend
{


    private $links = [
        ['url' => 'design/nav-quick-service/list', 'text' => '快捷服务'],
    ];

    protected $navQuickService;

    public function __construct(NavQuickServiceRepository $navQuickServiceRepository)
    {

        parent::__construct();
        setcookie('theme_style', "true"); // todo 设置theme_style 改变整体样式
        $this->navQuickService = $navQuickServiceRepository;
    }

    /**
     * 快捷服务列表
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Throwable
     */
    public function lists(Request $request)
    {
        $title = '快捷服务';
        $fixed_title = '快捷服务';
        $this->sublink($this->links, 'list');

        $action_span = [
            [
                'url' => 'add',
                'icon' => 'fa-plus',
                'text' => '添加快捷服务'
            ]
        ];

        $explain_panel = [
            '系统只允许显示出9条快捷服务，按顺序排序进行展示'
        ];
        $blocks = [
            'explain_panel' => $explain_panel,
            'fixed_title' => $fixed_title,
            'action_span' => $action_span
        ];

        $this->setLayoutBlock($blocks); // 设置block

        $where = [];

        // 排序
        $sortname = $request->get('sortname', 'sort');
        $sortorder = $request->get('sortorder', 'asc');

        // 列表
        $condition = [
            'where' => $where,
            'sortname' => $sortname,
            'sortorder' => $sortorder
        ];
        list($list, $total) = $this->navQuickService->getList($condition);

        $pageHtml = pagination($total);

        $compact = compact('title', 'list', 'total', 'pageHtml');
        if ($request->ajax()) {
            $render = view('design.nav-quick-service.partials._list', $compact)->render();
            return result(0, $render);
        }
        return view('design.nav-quick-service.list', $compact);
    }

    public function add(Request $request)
    {
        $title = '添加快捷服务';

        $id = $request->get('id', 0);

        if ($id) {
            // 更新操作
            $title = '编辑快捷服务';
            $info = $this->navQuickService->getById($id);
            view()->share('info', $info);
        }

        $fixed_title = $title;

        $action_span = [
            [
                'url' => 'list',
                'icon' => 'fa-reply',
                'text' => '返回快捷服务列表'
            ]
        ];
        $explain_panel = [
            '系统只允许9条快捷服务在前台首页显示',
            '商城前台首页将显示快捷服务名称、快捷服务图标，鼠标点击新窗口打开快捷服务链接'
        ];
        $blocks = [
            'fixed_title' => $fixed_title,
            'action_span' => $action_span,
            'explain_panel' => $explain_panel
        ];
        $this->setLayoutBlock($blocks); // 设置block

        return view('design.nav-quick-service.add', compact('title'));
    }

    public function edit(Request $request)
    {
        return $this->add($request);
    }

    public function saveData(Request $request)
    {
        $post = $request->post('NavQuickServiceModel');
        $site_id = 1; // 站点id暂时固定位 1

        if (!empty($post['id'])) {
            // 编辑
            $ret = $this->navQuickService->update($post['id'], $post);
            $msg = '快捷服务编辑';
        }else {
            // 添加
            $post['site_id'] = $site_id;// 站点id
            $ret = $this->navQuickService->store($post);
            $msg = '快捷服务添加';
        }

        if ($ret === false) {
            // fail
            flash('error', $msg.'失败');
            return redirect('/design/nav-quick-service/list');
        }
        // success
        flash('success', $msg.'成功');
        return redirect('/design/nav-quick-service/list');
    }

    /**
     * 设置是否显示
     *
     * @param Request $request
     * @return mixed
     */
    public function setIsShow(Request $request)
    {
        $id = $request->get('id');
        $ret = $this->navQuickService->changeShow($id);
        if ($ret === false) {
            return result(-1, '', '设置失败');
        }
        return result(0, $ret, '设置成功');
    }

    /**
     * 删除
     *
     * @param Request $request
     * @return mixed
     */
    public function delete(Request $request)
    {
        $id = $request->post('id');
        $ret = $this->navQuickService->del($id);
        if ($ret === false) {
            // Log
            admin_log('快捷服务删除失败。ID：'.$id);
            return result(-1, '', '删除失败');
        }

        // Log
        admin_log('快捷服务删除成功。ID：'.$id);
        return result(0, '', '删除成功');
    }

    /**
     * 批量删除
     *
     * @param Request $request
     * @return mixed
     */
    public function batchDelete(Request $request)
    {
        $ids = $request->post('ids');
        $ret = $this->navQuickService->batchDel($ids);

        $ids = implode(',', $ids);
        if ($ret === false) {
            // Log
            admin_log('快捷服务批量删除失败。ID：'.$ids);
            return result(-1, '', '删除失败');
        }
        // Log
        admin_log('快捷服务批量删除成功。ID：'.$ids);
        return result(0, '', '删除成功');
    }
}