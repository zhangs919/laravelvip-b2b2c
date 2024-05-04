<?php


namespace App\Modules\Backend\Http\Controllers\Design;

use App\Modules\Base\Http\Controllers\Backend;
use App\Repositories\CategoryRepository;
use App\Repositories\LinkTypeRepository;
use App\Repositories\NavBannerRepository;
use App\Repositories\NavCategoryRepository;
use App\Repositories\NavigationRepository;
use App\Repositories\SystemConfigRepository;
use Illuminate\Http\Request;

class NavigationController extends Backend
{

    private $links = [
        ['url' => 'design/navigation/list', 'text' => '商城导航列表'],
        ['url' => 'design/navigation/add', 'text' => '商城导航添加'],
//        ['url' => 'design/navigation/edit', 'text' => '商城导航编辑'],
    ];



    protected $navigation;

    protected $linkType;

    public function __construct(
        NavigationRepository $navigation
        ,LinkTypeRepository $linkType
    )
    {
        parent::__construct();

        $this->navigation = $navigation;
        $this->linkType = $linkType;
    }

    public function lists(Request $request)
    {
        $nav_page = $request->get('nav_page', 'site');
        $nav_position = $request->get('nav_position', 0); // 导航位置
//        $show_all = $request->get('show_all'); // 是否显示全部
//        dd($nav_page);
        $explain_panel = [];
        $tpl = '_list';

        $prefix = '';
        if ($nav_page == 'site') {
            $explain_panel = [
                '导航分为顶部导航、中间导航、底部导航。顶部导航：在商城头部的欢迎栏中展示；中间导航：是商城的主导航，在头部的搜索框下的主导航显示；底部导航：在商城的最底部显示',
                '中间导航分左右布局展示，右侧最多展示两个，按排序数字越小越优先展示',
                '商城导航最多展示十个导航，按排序数字越小越优先展示'
            ];
            $tpl = '_list';
            $prefix = '商城导航';
        } elseif ($nav_page == 'm_site') {
            $explain_panel = [];
            $tpl = '_mobile_list';
            $prefix = '微商城导航';
        } elseif ($nav_page == 'news') {
            $explain_panel = [
                '资讯频道导航最多展示前6个，按排序数字越小越优先展示'
            ];
            $tpl = '_news_list';
            $prefix = '资讯频道导航';
        } elseif ($nav_page == 'm_news') {
            $explain_panel = [];
            $tpl = '_mobile_news_list';
            $prefix = '资讯频道导航';
        }

        $title = $prefix.'列表';
        $fixed_title = $title;

        if ($nav_position) {
            $form_action = '?nav_page='.$nav_page.'&nav_position='.$nav_position.'&show_all=0'; // 添加action
        } else {
            $form_action = '?nav_page='.$nav_page;
        }

        $this->sublink($this->links, 'list', '', $form_action, 'add,edit');

        $action_span = [
            [
                'url' => 'add'.$form_action,
                'icon' => 'fa-plus',
                'text' => '添加'.$prefix
            ]
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
        $search_arr = ['nav_name', 'nav_position'];
        foreach ($search_arr as $v) {
            if (isset($params[$v]) && !empty($params[$v])) {

                if ($v == 'nav_name') {
                    $where[] = [$v, 'like', "%{$params[$v]}%"];
                } else {
                    $where[] = [$v, $params[$v]];
                }
            }
        }

        // 排序
        $sortname = $request->get('sortname', 'nav_sort');
        $sortorder = $request->get('sortorder', 'asc');

        // 根据nav_page查询
        $where[] = ['nav_page', $nav_page];
        // 列表
        $condition = [
            'where' => $where,
            'sortname' => $sortname,
            'sortorder' => $sortorder
        ];
        list($list, $total) = $this->navigation->getList($condition);
        $pageHtml = pagination($total);
//        dd($list);
        $compact = compact('title', 'list', 'total', 'pageHtml', 'nav_page', 'nav_position', 'tpl');
        if ($request->ajax()) {
            $render = view('design.navigation.partials.'.$tpl, $compact)->render();
            return result(0, $render);
        }
        return view('design.navigation.list', $compact);
    }


    public function add(Request $request)
    {
        $title = '添加';

        $id = $request->get('id', 0);
        $nav_page = $request->get('nav_page', 'site');
        $nav_position = $request->get('nav_position', 0); // 导航位置
        $show_all = $request->get('show_all', 1); // 是否显示全部
        $form_action = '/design/navigation/add?nav_page='.$nav_page.'&nav_position='.$nav_position.'&show_all='.$show_all; // 添加action
        $this->sublink($this->links, 'add', '', '?nav_page='.$nav_page.'&nav_position='.$nav_position.'&show_all='.$show_all, 'edit');

        if ($id) {
            // 更新操作
            $info = $this->navigation->getById($id);
            $form_action = '/design/navigation/edit?id='.$id.'&nav_page='.$nav_page.'&nav_position='.$info['nav_position'].'&show_all='.$show_all; // 编辑action
            $this->links[1]['text'] = '编辑';
            $this->sublink($this->links, 'add', '', '?nav_page='.$nav_page.'&nav_position='.$info['nav_position'].'&show_all='.$show_all);
            view()->share('info', $info);
            $title = '编辑';
        }

        $fixed_title = '商城导航管理 - '.$title;
        $action_span = [
            [
                'url' => 'list?nav_page='.$nav_page,
                'icon' => 'fa-reply',
                'text' => '返回导航列表'
            ]
        ];
        $explain_panel = [];
        $blocks = [
            'fixed_title' => $fixed_title,
            'action_span' => $action_span,
            'explain_panel' => $explain_panel
        ];
        $this->setLayoutBlock($blocks); // 设置block

        return view('design.navigation.add', compact('title', 'nav_page', 'form_action', 'nav_position'));
    }

    public function edit(Request $request)
    {
        return $this->add($request);
    }

    public function saveData(Request $request)
    {
        $nav_position = $request->get('nav_position', 0);

        $post = $request->post('NavigationModel');
        $nav_page = $request->get('nav_page');
        if (empty($nav_position)) {
            $nav_position = $post['nav_position'];
        }

        if (!empty($post['id'])) {
            // 编辑
            $ret = $this->navigation->update($post['id'], $post);

            $msg = '商城导航编辑';
        }else {
            // 添加
            $post['nav_page'] = $nav_page;
            $post['nav_position'] = $nav_position;
//            dd($post);
            $ret = $this->navigation->store($post);
            $msg = '商城导航添加';
        }
        $extra = '?nav_page='.$nav_page.'&nav_position='.$nav_position.'&show_all=0';
		// 重新设置缓存
		$cache_id = CACHE_KEY_NAVIGATION[0].'_'.$nav_page.'_'.$nav_position; // 缓存id
		cache()->forget($cache_id);

        if ($ret === false) {
            // fail
            flash('error', $msg.'失败');
            return redirect('/design/navigation/list'.$extra);
        }
        // success
        flash('success', $msg.'成功');
        return redirect('/design/navigation/list'.$extra);
    }

    /**
     * 更新信息
     *
     * @param Request $request
     * @return mixed
     */
    public function editNavInfo(Request $request)
    {
        $id = $request->post('nav_id');
        $title = $request->post('title');
        $value = $request->post('value');

        if ($title == 'nav_sort') {
            $value = intval($value);
        }

        $ret = $this->navigation->update($id, [$title => $value]);

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
        $ret = $this->navigation->changeShow($id);
        if ($ret === false) {
            return result(-1, '', '设置失败');
        }
        return result(0, $ret, '设置成功');
    }

    public function setNewOpen(Request $request)
    {
        $id = $request->get('id');
        $ret = $this->navigation->changeState($id, 'new_open');
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
        $ret = $this->navigation->del($id);
        if ($ret === false) {
            // Log
            admin_log('商城导航删除失败。ID：'.$id);
            return result(-1, '', '删除失败');
        }

        // Log
        admin_log('商城导航删除成功。ID：'.$id);
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
        $ret = $this->navigation->batchDel($ids);

        $ids = implode(',', $ids);
        if ($ret === false) {
            // Log
            admin_log('商城导航批量删除失败。ID：'.$ids);
            return result(-1, '', '删除失败');
        }
        // Log
        admin_log('商城导航批量删除成功。ID：'.$ids);
        return result(0, '', '删除成功');
    }

    /**
     * 改变链接类型
     *
     * @param Request $request
     * @return mixed
     * @throws \Throwable
     */
    public function getTypeList(Request $request)
    {
        $nav_type = $request->get('nav_type', 0); // 链接类型
        $nav_link = $request->get('nav_link', '');
        $link_data = $this->linkType->getLinkTypeData($nav_type);
        $render = view('design.navigation.partials._get_type_list', compact('nav_type', 'nav_link', 'link_data'))->render();

        return result(0, $render);
    }
}
