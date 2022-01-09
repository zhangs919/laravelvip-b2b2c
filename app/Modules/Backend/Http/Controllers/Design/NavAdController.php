<?php


namespace app\Modules\Backend\Http\Controllers\Design;

use App\Modules\Base\Http\Controllers\Backend;
use App\Repositories\NavAdRepository;
use App\Repositories\NavCategoryRepository;
use Illuminate\Http\Request;

class NavAdController extends Backend
{

    private $editLinks = [
        ['url' => 'design/nav-category/edit', 'text' => '分类导航'],
        ['url' => 'design/nav-words/nav-words_list', 'text' => '分类推荐词'],
        ['url' => 'design/nav-brand/nav-brand_list', 'text' => '分类推荐品牌'],
        ['url' => 'design/nav-ad/nav-ad_list', 'text' => '分类推荐广告'],
    ];

    protected $navAd;
    protected $navCategory;

    public function __construct(NavCategoryRepository $navCategoryRepository,NavAdRepository $navAdRepository)
    {

        parent::__construct();

//        setcookie('theme_style', "true"); // todo 设置theme_style 改变整体样式

        $this->navCategory = $navCategoryRepository;
        $this->navAd = $navAdRepository;
    }

    public function lists(Request $request)
    {
        $title = '分类推荐广告';
        $fixed_title = $title;

        $cid = $request->get('cid');
        $nav_cat_info = $this->navCategory->getById($cid);
        $nav_page = $nav_cat_info->nav_page;

        $this->sublink($this->editLinks, 'nav-ad_list', '', '?cid='.$cid);

        $action_span = [
            [
                'url' => '/design/nav-category/list?nav_page='.$nav_page,
                'icon' => 'fa-reply',
                'text' => '返回分类导航列表'
            ],
            [
                'url' => 'add?cid='.$cid,
                'icon' => 'fa-plus',
                'text' => '添加推荐广告'
            ],
        ];

        $explain_panel = [
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
        $search_arr = ['name'];
        foreach ($search_arr as $v) {
            if (isset($params[$v]) && !empty($params[$v])) {

                if ($v == 'name') {
                    $where[] = ['ad_name', 'like', "%{$params[$v]}%"];
                } else {
                    $where[] = [$v, $params[$v]];
                }
            }
        }

        // 排序
        $sortname = $request->get('sortname', 'ad_sort');
        $sortorder = $request->get('sortorder', 'asc');

        // 根据分类导航id查询
        $where[] = ['category_id', $cid];
        // 列表
        $condition = [
            'where' => $where,
            'sortname' => $sortname,
            'sortorder' => $sortorder
        ];
        list($list, $total) = $this->navAd->getList($condition);
        $pageHtml = pagination($total);

        $compact = compact('title', 'list', 'total', 'pageHtml', 'nav_page', 'cid');
        if ($request->ajax()) {
            $render = view('design.nav-ad.partials._list', $compact)->render();
            return result(0, $render);
        }
        return view('design.nav-ad.list', $compact);
    }


    public function add(Request $request)
    {
        $title = '推荐广告添加';

        $id = $request->get('id', 0);
        $cid = $request->get('cid', 0);
        $form_action = '/design/nav-ad/add?cid='.$cid; // 添加action

        if ($id) {
            // 更新操作
            $form_action = '/design/nav-ad/edit?id='.$id; // 编辑action
            $info = $this->navAd->getById($id);
            view()->share('info', $info);
            $title = '推荐广告编辑';
            $cid = $info->category_id;
        }

        $fixed_title = '推荐广告管理 - '.$title;
        $action_span = [
            [
                'url' => 'list?cid='.$cid,
                'icon' => 'fa-reply',
                'text' => '返回推荐广告列表'
            ]
        ];
        $explain_panel = [];
        $blocks = [
            'fixed_title' => $fixed_title,
            'action_span' => $action_span,
            'explain_panel' => $explain_panel
        ];
        $this->setLayoutBlock($blocks); // 设置block

        return view('design.nav-ad.add', compact('title', 'cid', 'form_action'));
    }

    public function edit(Request $request)
    {
        return $this->add($request);
    }

    public function saveData(Request $request)
    {
        $post = $request->post('NavAdModel');

        if (!empty($post['id'])) {
            // 编辑
            $ret = $this->navAd->update($post['id'], $post);
            $cid = $ret->category_id;
            $msg = '推荐广告编辑';
        }else {
            // 添加
            $cid = $request->get('cid');
            $post['category_id'] = $cid;
            $ret = $this->navAd->store($post);
            $msg = '推荐广告添加';
        }
        $extra = '?cid='.$cid;
        if ($ret === false) {
            // fail
            flash('error', $msg.'失败');
            return redirect('/design/nav-ad/list'.$extra);
        }
        // success
        flash('success', $msg.'成功');
        return redirect('/design/nav-ad/list'.$extra);
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
        $ret = $this->navAd->changeShow($id);
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
        $ret = $this->navAd->del($id);
        if ($ret === false) {
            // Log
            admin_log('分类推荐广告删除失败。ID：'.$id);
            return result(-1, '', '删除失败');
        }

        // Log
        admin_log('分类推荐广告删除成功。ID：'.$id);
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
        $ret = $this->navAd->batchDel($ids);

        $ids = implode(',', $ids);
        if ($ret === false) {
            // Log
            admin_log('分类推荐广告批量删除失败。ID：'.$ids);
            return result(-1, '', '删除失败');
        }
        // Log
        admin_log('分类推荐广告批量删除成功。ID：'.$ids);
        return result(0, '', '删除成功');
    }
}