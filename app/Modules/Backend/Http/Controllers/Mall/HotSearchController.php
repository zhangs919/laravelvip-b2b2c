<?php

namespace App\Modules\Backend\Http\Controllers\Mall;


use App\Modules\Base\Http\Controllers\Backend;
use App\Repositories\HotSearchRepository;
use Illuminate\Http\Request;

class HotSearchController extends Backend
{

    private $links = [
        ['url' => 'mall/search/default-search', 'text' => '默认搜索'],
        ['url' => 'mall/hot-search/list', 'text' => '热门搜索'],
        ['url' => 'mall/hot-search/add', 'text' => '添加'], // 列表时不显示
        ['url' => 'mall/hot-search/edit', 'text' => '编辑'] // 列表时不显示
    ];

    protected $hotSearch;

    public function __construct(HotSearchRepository $hotSearch)
    {
        parent::__construct();

        $this->hotSearch = $hotSearch;
    }


    public function lists(Request $request)
    {
        $title = '热门搜索';
        $fixed_title = '搜索设置 - '.$title;
        $this->sublink($this->links, 'list', '', '', 'add,edit');

        $action_span = [
            [
                'url' => 'add',
                'icon' => 'fa-plus',
                'text' => '添加热搜词'
            ],
        ];

        $explain_panel = [
            '热门搜索词设置后，将显示在前台搜索框作为默认值随机出现',
            '每个热搜词包括搜索词和显示词两部分，搜索词参与搜索，显示词不参与搜索，只起显示作用',
            '是否热门搜索，将显示在搜索框展示层中，系统默认只允许设置10个，超过之后，不可继续设置为是热门搜索',
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
        $search_arr = [];
        foreach ($search_arr as $v) {
            if (isset($params[$v]) && !empty($params[$v])) {

                if ($v == '') {
                    $where[] = ['', 'like', "%{$params[$v]}%"];
                } else {
                    $where[] = [$v, $params[$v]];
                }
            }
        }
        // 列表
        $condition = [
            'where' => $where,
            'sortname' => 'id',
            'sortorder' => 'asc'
        ];
        list($list, $total) = $this->hotSearch->getList($condition);

        $pageHtml = pagination($total);

        $compact = compact('title', 'list', 'total', 'pageHtml');
        if ($request->ajax()) {
            $render = view('mall.hot-search.partials._list', $compact)->render();
            return result(0, $render);
        }
        return view('mall.hot-search.list', $compact);
    }

    public function add(Request $request)
    {
        $title = '添加热搜词';
        $this->sublink($this->links, 'add', '', '', 'default-search,edit');

        $id = $request->get('id', 0);
        if ($id) {
            // 更新操作
            $title = '编辑热搜词';
            $info = $this->hotSearch->getById($id);
            view()->share('info', $info);

            $this->sublink($this->links, 'edit', '', '', 'default-search,add');
        }

        $fixed_title = '热门搜索 - '.$title;

        $action_span = [
            [
                'url' => 'list',
                'icon' => 'fa-reply',
                'text' => '返回热搜词列表'
            ]
        ];
        $explain_panel = [];
        $blocks = [
            'fixed_title' => $fixed_title,
            'action_span' => $action_span,
            'explain_panel' => $explain_panel
        ];
        $this->setLayoutBlock($blocks); // 设置block

        return view('mall.hot-search.add', compact('title'));
    }

    public function edit(Request $request)
    {
        return $this->add($request);
    }

    public function saveData(Request $request)
    {
        $post = $request->post('HotSearchModel');

        if (!empty($post['id'])) {
            // 编辑
            $ret = $this->hotSearch->update($post['id'], $post);
            $msg = '热搜词编辑';
        }else {
            // 添加
            $ret = $this->hotSearch->store($post);
            $msg = '热搜词添加';
        }

        if ($ret === false) {
            // fail
            flash('error', $msg.'失败');
            return redirect('/mall/hot-search/list');
        }
        // success
        flash('success', $msg.'成功');
        return redirect('/mall/hot-search/list');
    }

    public function setIsShow(Request $request)
    {
        $id = $request->get('id');
        $ret = $this->hotSearch->changeState($id, 'is_show');
        if ($ret === false) {
            return result(-1, '', '设置失败');
        }
        return result(0, $ret, '设置成功');
    }

    public function editSort(Request $request)
    {
        $id = $request->post('id');
        $title = $request->post('title');
        $value = $request->post('value');

        if ($title == 'sort') {
            $value = intval($value);
        }
        $ret = $this->hotSearch->update($id, [$title => $value]);

        if ($ret === false) {
            return result(-1, '', '设置失败');
        }
        return result(0, '', '设置成功');
    }

    /**
     * 删除
     *
     * @param Request $request
     * @return mixed
     */
    public function delete(Request $request)
    {
        $ids = $request->post('id');

        $ids_arr = explode(',', $ids);
        if (count($ids_arr) > 1) {
            $ret = $this->hotSearch->batchDel($ids);
        } else {
            $ret = $this->hotSearch->del($ids);
        }

        if ($ret === false) {
            // Log
            admin_log('热搜词删除失败。ID：'.$ids);
            return result(-1, '', '删除失败');
        }

        // Log
        admin_log('删除了一个热搜词。ID：'.$ids);
        return result(0, '', '删除成功');
    }

    public function batchDelete(Request $request)
    {
        $ids = $request->post('ids');

        $ret = $this->hotSearch->batchDel($ids);

        $ids = implode(',', $ids);
        if ($ret === false) {
            // Log
            admin_log('搜索词删除失败。ID：'.$ids);
            return result(-1, '', '删除失败');
        }
        // Log
        admin_log('删除了多个热搜词。ID：'.$ids);
        return result(0, '', '删除成功');
    }
}