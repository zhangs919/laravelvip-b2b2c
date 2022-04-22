<?php

namespace app\Modules\Backend\Http\Controllers\Goods;

use App\Models\LibCategory;
use App\Modules\Base\Http\Controllers\Backend;
use App\Repositories\LibCategoryRepository;
use App\Repositories\ToolsRepository;
use Illuminate\Http\Request;

class LibCategoryController extends Backend
{

    private $links = [
        ['url' => 'goods/category/list', 'text' => '管理'],
        ['url' => 'goods/category/add', 'text' => '添加'],
        ['url' => 'goods/category/edit', 'text' => '编辑']
    ];

    protected $libCategory;

    protected $tools;

    public function __construct(LibCategoryRepository $libCategoryRepository, ToolsRepository $toolsRepository)
    {
        parent::__construct();

        $this->libCategory = $libCategoryRepository;
        $this->tools = $toolsRepository;
    }


    public function lists(Request $request)
    {
        $title = '列表';
        $fixed_title = '商品库商品分类 - 列表';
        $this->sublink($this->links, 'list', '', '', 'add,edit');

        $action_span = [
            [
                'url' => 'add',
                'icon' => 'fa-plus',
                'text' => '添加商品分类'
            ]
        ];

        $explain_panel = [];
        $blocks = [
            'explain_panel' => $explain_panel,
            'fixed_title' => $fixed_title,
            'action_span' => $action_span
        ];

        $this->setLayoutBlock($blocks); // 设置block

        $params = $request->all();
        $where = [];
        // 搜索条件
        $search_arr = ['cat_name'];
        foreach ($search_arr as $v) {
            if (isset($params[$v]) && !empty($params[$v])) {

                if ($v == 'cat_name') {
                    $where[] = [$v, 'like', "%{$params[$v]}%"];
                } else {
                    $where[] = [$v, $params[$v]];
                }
            }
        }
        // 列表
        $condition = [
            'where' => $where,
            'limit' => 0, // 不分页
            'sortname' => 'created_at',
            'sortorder' => 'desc'
        ];
        list($list, $total) = $this->libCategory->getList($condition, '', true);

        $pageHtml = pagination($total, false);

        $compact = compact('title', 'list', 'total', 'pageHtml');
        if ($request->ajax()) {
            $render = view('goods.lib-category.partials._list', $compact)->render();
            return result(0, $render);
        }
        return view('goods.lib-category.list', $compact);
    }


    public function add(Request $request)
    {
        $title = '添加';
        $this->sublink($this->links, 'add', '', '', 'edit');

        $id = $request->get('id', 0);
        $parent_id = $request->get('parent_id', 0);

        $where[] = ['parent_id', 0];
        $parent_list = LibCategory::where($where)->get();

        $tpl = 'add';
        if ($id) {
            // 更新操作
            $tpl = 'edit';
            $info = $this->libCategory->getById($id);
            view()->share('info', $info);
            $title = '编辑';
            $this->sublink($this->links, 'edit', '', '', 'add');

            if ($info->parent_id > 0) {
                $where[] = ['parent_id', $info->parent_id];
                $parent_list = LibCategory::where($where)->get();
            } else {
                $parent_list = [];
            }

        }



        $fixed_title = '商品库商品分类 - '.$title;

        $action_span = [
            [
                'url' => 'list',
                'icon' => 'fa-reply',
                'text' => '返回商品库商品分类列表'
            ]
        ];
        $explain_panel = [];
        $blocks = [
            'fixed_title' => $fixed_title,
            'action_span' => $action_span,
            'explain_panel' => $explain_panel
        ];
        $this->setLayoutBlock($blocks); // 设置block

        return view('goods.lib-category.add', compact('title', 'parent_list', 'parent_id'));
    }

    public function edit(Request $request)
    {
        return $this->add($request);
    }

    public function saveData(Request $request)
    {
        $post = $request->post('LibCategory');
//        dd($post);
        if (!empty($post['cat_id'])) {
            // 编辑
            $ret = $this->libCategory->update($post['cat_id'], $post);
        }else {
            // 添加
            $ret = $this->libCategory->store($post);
        }

        if ($ret === false) {
            // fail
            return result(-1, null, '操作失败');
        }
        // success
        return result(0, null, '操作成功');
    }

    public function setShow(Request $request)
    {
        $id = $request->get('id');
        $ret = $this->libCategory->changeShow($id);
        if ($ret === false) {
            return result(-1, '', '设置失败');
        }
        return result(0, $ret, '设置成功');
    }

    public function editSort(Request $request)
    {
        $ret = $this->libCategory->editSort($request);

        if ($ret === false) {
            return result(-1, '', '设置失败');
        }
        return result(0, '', '设置成功');
    }

    public function delete(Request $request)
    {
        $id = $request->post('id');
        $info = $this->libCategory->getById($id);

        $ret = $this->libCategory->del($id);
        if ($ret === false) {
            // Log
            admin_log('商品库商品分类删除失败。ID：'.$id);
            return result(-1, '', '删除失败');
        }

        // Log
        admin_log('商品库商品分类删除成功。ID：'.$id);


        $extra = [
            'parent_id' => $info->parent_id
        ];
        return result(0, '', '删除成功', $extra);
    }
}