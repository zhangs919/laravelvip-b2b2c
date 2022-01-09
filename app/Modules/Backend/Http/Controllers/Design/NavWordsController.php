<?php


namespace app\Modules\Backend\Http\Controllers\Design;

use App\Modules\Base\Http\Controllers\Backend;
use App\Repositories\CategoryRepository;
use App\Repositories\NavCategoryRepository;
use App\Repositories\NavWordsRepository;
use Illuminate\Http\Request;

class NavWordsController extends Backend
{

    private $editLinks = [
        ['url' => 'design/nav-category/edit', 'text' => '分类导航'],
        ['url' => 'design/nav-words/nav-words_list', 'text' => '分类推荐词'],
        ['url' => 'design/nav-brand/nav-brand_list', 'text' => '分类推荐品牌'],
        ['url' => 'design/nav-ad/nav-ad_list', 'text' => '分类推荐广告'],
    ];

    protected $navWords;
    protected $navCategory;
    protected $category;

    public function __construct(NavWordsRepository $navWordsRepository, NavCategoryRepository $navCategoryRepository)
    {

        parent::__construct();

//        setcookie('theme_style', "true"); // todo 设置theme_style 改变整体样式

        $this->navWords = $navWordsRepository;
        $this->navCategory = $navCategoryRepository;
        $this->category = new CategoryRepository();
    }

    public function lists(Request $request)
    {
        $title = '分类推荐词';
        $fixed_title = $title;

        $cid = $request->get('cid');
        $nav_cat_info = $this->navCategory->getById($cid);
        $nav_page = $nav_cat_info->nav_page;

        $this->sublink($this->editLinks, 'nav-words_list', '', '?cid='.$cid);

        $action_span = [
            [
                'url' => '/design/nav-category/list?nav_page='.$nav_page,
                'icon' => 'fa-reply',
                'text' => '返回分类导航列表'
            ],
            [
                'url' => 'add?cid='.$cid,
                'icon' => 'fa-plus',
                'text' => '添加推荐词'
            ],
        ];

        $explain_panel = [
            '建议每个分类导航设置5个推荐词，每个推荐词字数建议5个字，保证页面布局完美',
            '所有相关设置完成，请清除缓存，前台展示页面才会变化'
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
                    $where[] = ['words_name', 'like', "%{$params[$v]}%"];
                } else {
                    $where[] = [$v, $params[$v]];
                }
            }
        }

        // 排序
        $sortname = $request->get('sortname', 'words_sort');
        $sortorder = $request->get('sortorder', 'asc');

        // 根据分类导航id查询
        $where[] = ['category_id', $cid];
        // 列表
        $condition = [
            'where' => $where,
            'sortname' => $sortname,
            'sortorder' => $sortorder
        ];
        list($list, $total) = $this->navWords->getList($condition);
        $pageHtml = pagination($total);

        $compact = compact('title', 'list', 'total', 'pageHtml', 'nav_page', 'cid');
        if ($request->ajax()) {
            $render = view('design.nav-words.partials._list', $compact)->render();
            return result(0, $render);
        }
        return view('design.nav-words.list', $compact);
    }


    public function add(Request $request)
    {
        $title = '添加';
//        $this->sublink($this->links, 'add');

        $id = $request->get('id', 0);
        $cid = $request->get('cid', 0);
        $form_action = '/design/nav-words/add?cid='.$cid; // 添加action

        if ($id) {
            // 更新操作
            $form_action = '/design/nav-words/edit?id='.$id; // 编辑action
//            $extra = '?id='.$id;
            $info = $this->navWords->getById($id);
            view()->share('info', $info);
            $title = '编辑【'.$info->words_name.'】';
//            $this->sublink($this->edit_links, 'edit', '', $extra);
            $cid = $info->category_id;
        }

        $fixed_title = '推荐词管理 - '.$title;
        $action_span = [
            [
                'url' => 'list?cid='.$cid,
                'icon' => 'fa-reply',
                'text' => '返回推荐词列表'
            ]
        ];
        $explain_panel = [];
        $blocks = [
            'fixed_title' => $fixed_title,
            'action_span' => $action_span,
            'explain_panel' => $explain_panel
        ];
        $this->setLayoutBlock($blocks); // 设置block

        return view('design.nav-words.add', compact('title', 'cid', 'form_action'));
    }

    public function edit(Request $request)
    {
        return $this->add($request);
    }

    public function saveData(Request $request)
    {
        $post = $request->post('NavWordsModel');

        if (!empty($post['id'])) {
            // 编辑
            $ret = $this->navWords->update($post['id'], $post);
            $cid = $ret->category_id;
            $msg = '推荐词编辑';
        }else {
            // 添加
            $cid = $request->get('cid');
            $post['category_id'] = $cid;
            $ret = $this->navWords->store($post);
            $msg = '推荐词添加';
        }
        $extra = '?cid='.$cid;
        if ($ret === false) {
            // fail
            flash('error', $msg.'失败');
            return redirect('/design/nav-words/list'.$extra);
        }
        // success
        flash('success', $msg.'成功');
        return redirect('/design/nav-words/list'.$extra);
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
        $ret = $this->navWords->changeShow($id);
        if ($ret === false) {
            return result(-1, '', '设置失败');
        }
        return result(0, $ret, '设置成功');
    }

    public function setNewOpen(Request $request)
    {
        $id = $request->get('id');
        $ret = $this->navWords->changeState($id, 'new_open');
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
        $ret = $this->navWords->del($id);
        if ($ret === false) {
            // Log
            admin_log('分类推荐词删除失败。ID：'.$id);
            return result(-1, '', '删除失败');
        }

        // Log
        admin_log('分类推荐词删除成功。ID：'.$id);
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
        $ret = $this->navWords->batchDel($ids);

        $ids = implode(',', $ids);
        if ($ret === false) {
            // Log
            admin_log('分类推荐词批量删除失败。ID：'.$ids);
            return result(-1, '', '删除失败');
        }
        // Log
        admin_log('分类推荐词批量删除成功。ID：'.$ids);
        return result(0, '', '删除成功');
    }

    public function openWordsLink(Request $request)
    {
        $type = $request->get('type',0); // 推荐词类型
        $link = $request->get('link',''); // 链接地址

        $where = [];
        $condition = [
            'where' => $where,
            'limit' => 0, // 不分页
            'sortname' => 'created_at',
            'sortorder' => 'desc'
        ];
        list($cat_list, $total) = $this->category->getList($condition, '', false, true);

        $render = view('design.nav-words.open_words_link', compact('type','link','cat_list'))->render();

        return result(0, $render);
    }
}