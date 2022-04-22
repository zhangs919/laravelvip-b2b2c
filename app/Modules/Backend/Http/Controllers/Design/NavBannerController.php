<?php


namespace app\Modules\Backend\Http\Controllers\Design;

use App\Modules\Base\Http\Controllers\Backend;
use App\Repositories\CategoryRepository;
use App\Repositories\NavBannerRepository;
use App\Repositories\NavCategoryRepository;
use App\Repositories\SystemConfigRepository;
use Illuminate\Http\Request;

class NavBannerController extends Backend
{

    private $links = [
        ['url' => 'design/nav-banner/list', 'text' => '首页焦点图'],
        ['url' => 'design/nav-banner/setting', 'text' => '设置'],
    ];



    protected $navBanner;

    protected $category;

    protected $systemConfig;

    public function __construct(NavBannerRepository $navBannerRepository, SystemConfigRepository $systemConfigRepository)
    {
        parent::__construct();
//        setcookie('theme_style', "true"); // todo 设置theme_style 改变整体样式

        $this->navBanner = $navBannerRepository; // 首页焦点图
        $this->systemConfig = $systemConfigRepository; // 系统配置
    }

    public function lists(Request $request)
    {
        $title = '首页焦点图';
        $fixed_title = $title;
        $nav_page = $request->get('nav_page', 'site');

        $this->sublink($this->links, 'list', '', '?nav_page='.$nav_page);

        $action_span = [
            [
                'url' => 'add?nav_page='.$nav_page,
                'icon' => 'fa-plus',
                'text' => '添加首页焦点图'
            ]
        ];

        $explain_panel = [
            '首页轮播图建议不要超出5张',
            '添加的广告图的高度要一致，高度一致有利于广告的展示美感'
        ];
        $blocks = [
            'explain_panel' => $explain_panel,
            'fixed_title' => $fixed_title,
            'action_span' => $action_span
        ];

        $this->setLayoutBlock($blocks); // 设置block

        $params = $request->all();
        $where = [];
        // 搜索条件
        $search_arr = ['banner_name'];
        foreach ($search_arr as $v) {
            if (isset($params[$v]) && !empty($params[$v])) {

                if ($v == 'banner_name') {
                    $where[] = [$v, 'like', "%{$params[$v]}%"];
                } else {
                    $where[] = [$v, $params[$v]];
                }
            }
        }

        // 排序
        $sortname = $request->get('sortname', 'banner_sort');
        $sortorder = $request->get('sortorder', 'asc');

        // 根据nav_page查询
        $where[] = ['nav_page', $nav_page];
        // 列表
        $condition = [
            'where' => $where,
            'sortname' => $sortname,
            'sortorder' => $sortorder
        ];
        list($list, $total) = $this->navBanner->getList($condition);
        $pageHtml = pagination($total);

        $compact = compact('title', 'list', 'total', 'pageHtml', 'nav_page');
        if ($request->ajax()) {
            $render = view('design.nav-banner.partials._list', $compact)->render();
            return result(0, $render);
        }
        return view('design.nav-banner.list', $compact);
    }

    public function add(Request $request)
    {
        $title = '焦点图添加';

        $id = $request->get('id', 0);
        $nav_page = $request->get('nav_page', 'site');
        $form_action = '/design/nav-banner/add?nav_page='.$nav_page; // 添加action

        if ($id) {
            // 更新操作
            $form_action = '/design/nav-banner/edit?id='.$id.'&nav_page='.$nav_page; // 编辑action
            $info = $this->navBanner->getById($id);
            view()->share('info', $info);
            $title = '焦点图编辑';
        }

        $fixed_title = '首页焦点图管理 - '.$title;
        $action_span = [
            [
                'url' => 'list?nav_page='.$nav_page,
                'icon' => 'fa-reply',
                'text' => '返回焦点图列表'
            ]
        ];
        $explain_panel = [];
        $blocks = [
            'fixed_title' => $fixed_title,
            'action_span' => $action_span,
            'explain_panel' => $explain_panel
        ];
        $this->setLayoutBlock($blocks); // 设置block

        return view('design.nav-banner.add', compact('title', 'nav_page', 'form_action'));
    }

    public function edit(Request $request)
    {
        return $this->add($request);
    }

    public function saveData(Request $request)
    {
        $post = $request->post('NavBannerModel');
        $nav_page = $request->get('nav_page');

        if (!empty($post['id'])) {
            // 编辑
            $ret = $this->navBanner->update($post['id'], $post);

            $msg = '焦点图编辑';
        }else {
            // 添加
            $post['nav_page'] = $nav_page;
            $ret = $this->navBanner->store($post);
            $msg = '焦点图添加';
        }
        $extra = '?nav_page='.$nav_page;
        if ($ret === false) {
            // fail
            flash('error', $msg.'失败');
            return redirect('/design/nav-banner/list'.$extra);
        }
        // success
        flash('success', $msg.'成功');
        return redirect('/design/nav-banner/list'.$extra);
    }

    /**
     * 设置
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Throwable
     */
    public function setting(Request $request)
    {
        $nav_page = $request->get('nav_page', 'site');
        $this->sublink($this->links, 'setting', '', '?nav_page='.$nav_page);

        switch ($nav_page){
            case 'site':
                // pc首页导航
                $group = 'nav_banner_site';
                break;
            case 'm_site':
                // mobile首页导航
                $group = '';
                break;

            default:
                $group = '';

                break;
        }
        $group_info = $this->systemConfig->getConfigList($group);
        $title = $fixed_title = $group_info['title'];
        $uuid = make_uuid();
        $script_render = view('system.config.partials.'.$group, compact('uuid'))->render();

//        if ($request->ajax()) {
//            $render = view('system.config.ajax_config', compact('uuid', 'group', 'group_info', 'script_render'))->render();
//            return result(0, $render);
//        }

        $blocks = [
            'explain_panel' => $group_info['explain'],
            'fixed_title' => $fixed_title,
        ];
        $this->setLayoutBlock($blocks); // 设置block
        return view('system.config.config', compact('title', 'group', 'group_info', 'script_render'));
    }

    /**
     * 更新信息
     *
     * @param Request $request
     * @return mixed
     */
    public function editBannerInfo(Request $request)
    {
        $id = $request->post('id');
        $title = $request->post('title');
        $value = $request->post('value');

        if ($title == 'banner_sort') {
            $value = intval($value);
        }

        $ret = $this->navBanner->update($id, [$title => $value]);

        if ($ret === false) {
            return result(-1, '', '设置失败');
        }
        return result(0, '', '设置成功');
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
        $ret = $this->navBanner->changeShow($id);
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
        $ret = $this->navBanner->del($id);
        if ($ret === false) {
            // Log
            admin_log('首页焦点图删除失败。ID：'.$id);
            return result(-1, '', '删除失败');
        }

        // Log
        admin_log('首页焦点图删除成功。ID：'.$id);
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
        $ret = $this->navBanner->batchDel($ids);

        $ids = implode(',', $ids);
        if ($ret === false) {
            // Log
            admin_log('首页焦点图批量删除失败。ID：'.$ids);
            return result(-1, '', '删除失败');
        }
        // Log
        admin_log('首页焦点图批量删除成功。ID：'.$ids);
        return result(0, '', '删除成功');
    }
}