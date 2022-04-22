<?php


namespace app\Modules\Backend\Http\Controllers\Design;

use App\Modules\Base\Http\Controllers\Backend;
use App\Repositories\CategoryRepository;
use App\Repositories\NavCategoryRepository;
use App\Repositories\SystemConfigRepository;
use Illuminate\Http\Request;

class NavCategoryController extends Backend
{

    private $links = [
        ['url' => 'design/nav-category/list', 'text' => '分类导航列表'],
        ['url' => 'design/nav-category/setting', 'text' => '设置'],
    ];

    private $editLinks = [
        ['url' => 'design/nav-category/edit', 'text' => '分类导航'],
        ['url' => 'design/nav-words/list', 'text' => '分类推荐词'],
        ['url' => 'design/nav-brand/list', 'text' => '分类推荐品牌'],
        ['url' => 'design/nav-ad/list', 'text' => '分类推荐广告'],
    ];

    protected $navCategory;

    protected $category;

    protected $systemConfig;

    public function __construct(
        NavCategoryRepository $navCategoryRepository,
        CategoryRepository $categoryRepository,
        SystemConfigRepository $systemConfigRepository)
    {
        parent::__construct();
//        setcookie('theme_style', "true"); // todo 设置theme_style 改变整体样式

        $this->navCategory = $navCategoryRepository; // 分类导航
        $this->category = $categoryRepository; // 商品分类
        $this->systemConfig = $systemConfigRepository; // 系统配置
    }

    public function lists(Request $request)
    {
        $title = '分类导航';
        $fixed_title = $title;
        $nav_page = $request->get('nav_page', 'site');

        $this->sublink($this->links, 'list', '', '?nav_page='.$nav_page);

        $action_span = [
            [
                'url' => 'add?nav_page='.$nav_page,
                'icon' => 'fa-plus',
                'text' => '添加分类导航'
            ]
        ];

        $explain_panel = [
            '分类导航——默认样式：前台页面最多可展示13个分类导航栏，可自主编辑分类项的名称、推荐词、推荐品牌、推荐广告位',
            '分类导航——经典样式：前台页面最多可展示7个分类导航栏，可自主编辑分类项的名称、推荐词、推荐品牌、推荐广告位',
            '所有相关设置完成，请清除缓存，前台展示页面才会变化',
            '商品分类成功添加后，可选择某一导航分类，为此导航分类关联已成功添加的商品分类'
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
        $search_arr = ['name'];
        foreach ($search_arr as $v) {
            if (isset($params[$v]) && !empty($params[$v])) {

                if ($v == 'name') {
                    $where[] = [$v, 'like', "%{$params[$v]}%"];
                } else {
                    $where[] = [$v, $params[$v]];
                }
            }
        }

        // 排序
        $sortname = $request->get('sortname', 'sort');
        $sortorder = $request->get('sortorder', 'asc');

        // 根据nav_page查询
        $where[] = ['nav_page', $nav_page];
        // 列表
        $condition = [
            'where' => $where,
            'sortname' => $sortname,
            'sortorder' => $sortorder
        ];
        list($list, $total) = $this->navCategory->getList($condition);
        $pageHtml = pagination($total);

        $compact = compact('title', 'list', 'total', 'pageHtml', 'nav_page');
        if ($request->ajax()) {
            $render = view('design.nav-category.partials._list', $compact)->render();
            return result(0, $render);
        }
        return view('design.nav-category.list', $compact);
    }

    /**
     * 添加分类导航
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function add(Request $request)
    {
        $title = '添加';
        $this->sublink($this->editLinks, 'edit', '', '', 'list');
        $nav_page = $request->get('nav_page');

        if ($request->ajax()) {

            $data = $request->get('data');
            $nav_json = json_encode($data);
            $name = implode('、', array_column($data, 'name'));
            $nav_icon = array_first(array_column($data, 'icon'));
            $insert = [
                'name' => $name,
                'nav_page' => $nav_page,
                'nav_json' => $nav_json,
                'nav_icon' => $nav_icon
            ];
            // 添加
            $ret = $this->navCategory->store($insert);
            $msg = '分类导航添加';

            if ($ret === false) {
                // Log
                admin_log($msg.'失败。ID：'.$ret->id);
                // fail
                return result(-1);
            }

            // Log
            admin_log($msg.'成功。ID：'.$ret->id);
            // success
            return result(0);
        }

        $fixed_title = '分类导航 - '.$title;

        $action_span = [
            [
                'url' => 'list',
                'icon' => 'fa-reply',
                'text' => '返回分类导航列表'
            ]
        ];
        $explain_panel = [
            '分类导航名称不得大于30个字',
            '链接类型：可为新增的导航词添加链接，点击该词后会进入链接的页面',
            '搜索推荐词类型：指点击新增的导航名称时，系统自动根据推荐词搜索相应的商品，进入搜索结果页',
            '关联分类类型：指为新增加的分类导航绑定一个商场的分类，当用户点击此词时进入相应的分类商品列表页面',
        ];
        $blocks = [
            'fixed_title' => $fixed_title,
            'action_span' => $action_span,
            'explain_panel' => $explain_panel
        ];
        $this->setLayoutBlock($blocks); // 设置block

        return view('design.nav-category.add', compact('title', 'nav_page'));
    }

    /**
     * 编辑分类导航
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Request $request)
    {
        $title = '分类导航';


        $id = $request->get('pid', 0);
        if (!$id) {
            $id = $request->get('cid', 0);
        }
        $extra = '?cid='.$id;
        $this->sublink($this->editLinks, 'edit', '', $extra);
        $info = $this->navCategory->getById($id);

        view()->share('info', $info);
//        dd(json_decode($info->nav_json));
        if ($request->ajax()) {
//            $nav_page = $request->get('nav_page');
            $data = $request->get('data');
            $nav_json = json_encode($data);
            $name = implode('、', array_column($data, 'name'));
            $nav_icon = array_first(array_column($data, 'icon'));
            $update = [
                'id' => $id,
                'name' => $name,
//                'nav_page' => $nav_page,
                'nav_json' => $nav_json,
                'nav_icon' => $nav_icon
            ];
//            dd($update);
            // 编辑
            $ret = $this->navCategory->update($id, $update);
            $msg = '分类导航编辑';

            if ($ret === false) {
                // Log
                admin_log($msg.'失败。ID：'.$ret->id);
                // fail
                return result(-1);
            }

            // Log
            admin_log($msg.'成功。ID：'.$ret->id);
            // success
            return result(0);
        }

        $fixed_title = '分类导航 - '.$title;

        $action_span = [
            [
                'url' => 'list',
                'icon' => 'fa-reply',
                'text' => '返回分类导航列表'
            ]
        ];
        $explain_panel = [
            '分类导航名称不得大于30个字',
            '链接类型：可为新增的导航词添加链接，点击该词后会进入链接的页面',
            '搜索推荐词类型：指点击新增的导航名称时，系统自动根据推荐词搜索相应的商品，进入搜索结果页',
            '关联分类类型：指为新增加的分类导航绑定一个商场的分类，当用户点击此词时进入相应的分类商品列表页面',
        ];
        $blocks = [
            'fixed_title' => $fixed_title,
            'action_span' => $action_span,
            'explain_panel' => $explain_panel
        ];
        $this->setLayoutBlock($blocks); // 设置block

        // 获取商品分类列表
        $where = [];
        $condition = [
            'where' => $where,
            'limit' => 0, // 不分页
            'sortname' => 'created_at',
            'sortorder' => 'desc'
        ];
        list($cat_list, $total) = $this->category->getList($condition, '', false, true);

        return view('design.nav-category.edit', compact('title', 'cat_list'));
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
                $group = 'nav_category_site';
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
     * 选择图标
     *
     * @param Request $request
     * @return mixed
     * @throws \Throwable
     */
    public function selectIcon(Request $request)
    {
        $params = $request->all();
//        $tpl = 'select-icon';
//        if (!isset($params['output'])) {
//            $tpl = 'select-icon-list';
//        }
//        $render = view('design.nav-category.include.'.$tpl)->render();
        $render = view('design.nav-category.icon_list')->render();

        return result(0, $render);
    }

    /**
     * ajax获取商品分类列表
     * @param Request $request
     * @return mixed
     * @throws \Throwable
     */
    public function getCatList(Request $request)
    {
        $where = [];
        $condition = [
            'where' => $where,
            'limit' => 0, // 不分页
            'sortname' => 'created_at',
            'sortorder' => 'desc'
        ];
        list($cat_list, $total) = $this->category->getList($condition, '', false, true);

        $render = view('design.nav-category.partials._cat_list', compact('cat_list'))->render();
        return result(0, $render);
    }

    /**
     * 更新信息
     *
     * @param Request $request
     * @return mixed
     */
    public function editCategoryInfo(Request $request)
    {
        $id = $request->post('id');
        $title = $request->post('title');
        $value = $request->post('value');

        if ($title == 'sort') {
            $value = intval($value);
        }

        $ret = $this->navCategory->update($id, [$title => $value]);

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
        $ret = $this->navCategory->changeShow($id);
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
        $id = $request->post('pid');
        $ret = $this->navCategory->del($id);
        if ($ret === false) {
            // Log
            admin_log('分类导航删除失败。ID：'.$id);
            return result(-1, '', '删除失败');
        }

        // Log
        admin_log('分类导航删除成功。ID：'.$id);
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
        $ret = $this->category->batchDel($ids);

        $ids = implode(',', $ids);
        if ($ret === false) {
            // Log
            admin_log('分类导航批量删除失败。ID：'.$ids);
            return result(-1, '', '删除失败');
        }
        // Log
        admin_log('分类导航批量删除成功。ID：'.$ids);
        return result(0, '', '删除成功');
    }
}