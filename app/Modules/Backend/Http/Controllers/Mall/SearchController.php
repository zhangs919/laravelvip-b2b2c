<?php

namespace App\Modules\Backend\Http\Controllers\Mall;


use App\Models\Category;
use App\Modules\Base\Http\Controllers\Backend;
use App\Repositories\DefaultSearchRepository;
use Illuminate\Http\Request;

class SearchController extends Backend
{

    private $links = [
        ['url' => 'mall/search/default-search', 'text' => '默认搜索'],
        ['url' => 'mall/hot-search/list', 'text' => '热门搜索'],
        ['url' => 'mall/search/add', 'text' => '添加'], // 列表时不显示
        ['url' => 'mall/search/edit', 'text' => '编辑'] // 列表时不显示
    ];

    protected $defaultSearch;

    public function __construct(DefaultSearchRepository $defaultSearch)
    {
        parent::__construct();

        $this->defaultSearch = $defaultSearch;
    }


    public function defaultSearch(Request $request)
    {
        $title = '默认搜索';
        $fixed_title = '搜索设置 - '.$title;
        $this->sublink($this->links, 'default-search', '', '', 'add,edit');

        $action_span = [
            [
                'url' => 'add',
                'icon' => 'fa-plus',
                'text' => '添加搜索词'
            ],
        ];

        $explain_panel = [
            '默认搜索词是商城自定义的搜索词汇，便于商城产品与活动的推广，搜索词显示在前台搜索框下方',
            '一条搜索词记录可定义多个关键词，前台展示时会有截取，超出显示范围将不展示，建议词保持在25个字左右',
            '所属类型：可以是默认，也可以是具体某一商品分类',
            '如未对某一商品分类设置默认搜索词，则对应的商品列表页面展示的默认搜索词为所属类型是"默认"的搜索词',
            '同一所属类型的搜索词，只能开启一个',
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
        list($list, $total) = $this->defaultSearch->getList($condition);

        $pageHtml = pagination($total);

        $compact = compact('title', 'list', 'total', 'pageHtml');
        if ($request->ajax()) {
            $render = view('mall.search.partials._list', $compact)->render();
            return result(0, $render);
        }
        return view('mall.search.default_search', $compact);
    }

    public function add(Request $request)
    {
        $title = '添加搜索词';
        $this->sublink($this->links, 'add', '', '', 'list,edit');

        $id = $request->get('id', 0);
        if ($id) {
            // 更新操作
            $title = '编辑搜索词';
            $info = $this->defaultSearch->getById($id);
            view()->share('info', $info);

            $this->sublink($this->links, 'edit', '', '', 'list,add');

        }

        $fixed_title = '默认搜索 - '.$title;

        $action_span = [
            [
                'url' => 'default-search',
                'icon' => 'fa-reply',
                'text' => '返回默认搜索词列表'
            ]
        ];
        $explain_panel = [
            '可设置默认搜索词，供未对某一商品分类设置默认搜索词使用',
            '可以针对具体的商品分类设置默认搜索词，将显示在前台对应商品分类页面的搜索框下面，前台点击时可直接作为关键词进行搜索'
        ];
        $blocks = [
            'fixed_title' => $fixed_title,
            'action_span' => $action_span,
            'explain_panel' => $explain_panel
        ];
        $this->setLayoutBlock($blocks); // 设置block

        // 获取商品分类
        $category_list = Category::where([['parent_id',0],['is_show',1]])->get();

        return view('mall.search.add', compact('title','category_list'));
    }

    public function edit(Request $request)
    {
        return $this->add($request);
    }

    public function saveData(Request $request)
    {
        $post = $request->post('DefaultSearchModel');

        if (!empty($post['id'])) {
            // 编辑
            $ret = $this->defaultSearch->update($post['id'], $post);
            $msg = '搜索词编辑';
        }else {
            // 添加
            $ret = $this->defaultSearch->store($post);
            $msg = '搜索词添加';
        }

        if ($ret === false) {
            // fail
            return result(-1, null, $msg.'失败');
        }
        // success
        return result(0, null, $msg.'成功');
    }

    public function setIsShow(Request $request)
    {
        $id = $request->get('id');
        $ret = $this->defaultSearch->changeState($id, 'is_show');
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
        $ids = $request->post('id');

        $ids_arr = explode(',', $ids);
        if (count($ids_arr) > 1) {
            $ret = $this->defaultSearch->batchDel($ids);
        } else {
            $ret = $this->defaultSearch->del($ids);
        }

        if ($ret === false) {
            // Log
            admin_log('搜索词删除失败。ID：'.$ids);
            return result(-1, '', '删除失败');
        }

        // Log
        admin_log('删除了一个搜索词。ID：'.$ids);
        return result(0, '', '删除成功');
    }

    /*public function batchDelete(Request $request)
    {
        $ids = $request->post('ids');
        $ret = $this->defaultSearch->batchDel($ids);

        $ids = explode(',', $ids);
        if ($ret === false) {
            // Log
            admin_log('搜索词删除失败。ID：'.$ids);
            return result(-1, '', '删除失败');
        }
        // Log
        admin_log('删除了多个搜索词。ID：'.$ids);
        return result(0, '', '删除成功');
    }*/
}