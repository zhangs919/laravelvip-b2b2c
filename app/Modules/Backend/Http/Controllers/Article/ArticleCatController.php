<?php

namespace App\Modules\Backend\Http\Controllers\Article;


use App\Http\Requests\ArticleCatRequest;
use App\Models\ArticleCat;
use App\Modules\Base\Http\Controllers\Backend;
use App\Repositories\ArticleCatRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ArticleCatController extends Backend
{


    private $links = [
        ['url' => 'article/article-cat/list', 'text' => '文章分类列表'],
        ['url' => 'article/article-cat/add', 'text' => '添加文章分类'],
        ['url' => 'article/article-cat/edit', 'text' => '普通展示'],
    ];

    protected $articleCat;

    public function __construct(ArticleCatRepository $articleCat)
    {
        parent::__construct();

        $this->articleCat = $articleCat;
    }


    public function lists(Request $request)
    {

        $title = '分类列表';
        $fixed_title = '文章分类 - '.$title;

        $action_span = [
            [
                'url' => 'add-category',
                'icon' => 'fa-plus',
                'text' => '添加文章分类'
            ]
        ];
        $explain_panel = [
            '通过修改排序数字可以控制前台显示顺序，数字越小越靠前',
        ];
        $blocks = [
            'fixed_title' => $fixed_title,
            'action_span' => $action_span,
            'explain_panel' => $explain_panel,
        ];
        $this->setLayoutBlock($blocks); // 设置block

        $params = $request->all();

        // 分类类型
        $cat_types = article_cat_type();

        $where = [];
        // 搜索条件
        $search_arr = ['cat_type', 'cat_name', 'cat_id'];
        foreach ($search_arr as $v) {
            if (isset($params[$v]) && !empty($params[$v])) {

                if ($v == 'cat_name') {
                    $where[] = [$v, 'like', "%{$params[$v]}%"];
                } else {
                    $where[] = [$v, $params[$v]];
                }
            }
        }
        // 分类列表
        $condition = [
            'where' => $where,
            'relation' => 'article',
            'limit' => 0
        ];
        list($list, $total) = $this->articleCat->getList($condition, '', true);

        $pageHtml = pagination($total, false);
//        dd($list);
        if ($request->ajax()) {
            $render = view('article.article-cat.partials._list', compact('list', 'total', 'pageHtml'))->render();
            return result(0, $render);
        }

        return view('article.article-cat.list', compact('title', 'cat_types', 'list', 'pageHtml'));
    }

    public function add(Request $request)
    {
        $title = '分类添加';
        $fixed_title = '文章分类 - '.$title;
        $this->sublink($this->links, 'add', '', '', 'edit');
        $parent_id = $request->get('parent_id', 0);

        $action_span = [
            [
                'url' => 'list',
                'icon' => 'fa-reply',
                'text' => '返回文章分类列表'
            ]
        ];
        $blocks = [
            'fixed_title' => $fixed_title,
            'action_span' => $action_span
        ];
        $this->setLayoutBlock($blocks); // 设置block

        // 获取上级分类列表 展示形式为单网页展示 分类parent_id=0 一级分类
        $parent_cat = $this->getParentCat();

        // 分类类型
        $cat_types = article_cat_type();

        // 如果有上级分类参数 则获取上级分类的信息
        $parent_info = [];
        if ($parent_id) {
            $parent_info = $this->articleCat->getById($parent_id);
        }

        return view('article.article-cat.add', compact('title', 'parent_cat', 'cat_types', 'parent_info'));
    }

    public function edit(Request $request)
    {
        $title = '分类编辑';
        $fixed_title = '文章分类 - '.$title;

        $cat_model = $request->get('cat_model', 1);
        $cat_id = $request->get('cat_id');
        if ($cat_model == 1) {
            // 单网页展示
            $linkTitle = '单网页展示';
        } else {
            // 普通展示
            $linkTitle = '普通展示';
        }
        $this->links[2]['text'] = $linkTitle;
        $this->sublink($this->links, 'edit', '', '', 'add');

        $action_span = [
            [
                'url' => 'list',
                'icon' => 'fa-reply',
                'text' => '返回文章分类列表'
            ]
        ];
        $blocks = [
            'fixed_title' => $fixed_title,
            'action_span' => $action_span
        ];
        $this->setLayoutBlock($blocks); // 设置block

        // 获取分类信息
        $cat_info = $this->articleCat->getById($cat_id);
        $parent_cat_name = ArticleCat::where('cat_id', $cat_info['parent_id'])->value('cat_name');
        $cat_info->parent_cat_name = $parent_cat_name;

        return view('article.article-cat.edit', compact('title', 'cat_info'));
    }

    public function saveData(ArticleCatRequest $request)
    {
        $post = $request->post('ArticleCatModel');
        $parent_id = $post['parent_id'];

        if (!empty($post['cat_id'])) {
            // 编辑
            $ret = $this->articleCat->update($post['cat_id'], $post);
            $msg = '编辑';
        }else {
            // 添加
            if (empty($parent_id)) {
                $post['cat_level'] = 1; // 一级分类标识
            } else {
                $post['cat_level'] = 2; // 二级分类标识
            }
            $ret = $this->articleCat->store($post);
            $msg = '添加';
        }

        if ($ret === false) {
            // fail
            flash('error', $msg.'失败');
            return redirect('/article/article-cat/list');
        }

        // Log
        admin_log($msg.'了一条文章分类。ID：'.$ret->cat_id);

        // success
        flash('success', $msg.'成功');
        return redirect('/article/article-cat/list');
    }

    public function selectCatModel(Request $request)
    {
        $cat_model = $request->get('cat_model', 1); // 展示形式 1单网页展示 2普通展示
        $act = $request->get('act', 'add');

        // 获取上级分类列表 展示形式为单网页展示/普通展示 分类parent_id=0 一级分类
        $parent_cat = $this->getParentCat($cat_model);

        // 分类类型
        $cat_types = article_cat_type();

        $select_parent_cat_render = view('article.article-cat.select_parent_cat', compact('parent_cat'))->render();
        $meta_title_render = view('article.article-cat.meta_title', compact('cat_model'))->render();
        $select_cat_type_render = view('article.article-cat.select_cat_type', compact('cat_types'))->render();
        $render = [
            $select_parent_cat_render,
            $meta_title_render,
            $select_cat_type_render
        ];
        return result(0, $render);
    }

    public function selectCatType(Request $request)
    {
        $cat_id = $request->get('cat_id', 0); // 分类id
        $cat_info = $cat_id ? $this->articleCat->getById($cat_id) : [];
        $cat_type_info = [];
        if (!empty($cat_info)) {
            // 如果有分类id则获取该分类的分类类型
            $cat_type_info = [
                'cat_type_id' => $cat_info->cat_type,
                'cat_type_name' => article_cat_type($cat_info->cat_type),
            ];
        }

        // 分类类型
        $cat_types = article_cat_type();

        $select_cat_type_render = view('article.article-cat.select_cat_type', compact('cat_types', 'cat_type_info'))->render();
        return result(0, $select_cat_type_render);
    }

    public function getParentCat($catModel = 1)
    {
        // 获取上级分类列表 展示形式为单网页展示 分类parent_id=0 一级分类
        $where = [
            ['cat_model', $catModel],
            ['parent_id', 0]
        ];
        $condition = [
            'where' => $where,
            'limit' => 0
        ];
        list($parent_cat, $total) = $this->articleCat->getList($condition, '', false, true);

        return $parent_cat;
    }

    public function setShow(Request $request)
    {
        $id = $request->get('id');
        $ret = $this->articleCat->changeShow($id);
        if ($ret === false) {
            return result(-1, '', '设置失败');
        }
        return result(0, $ret, '设置成功');
    }

    public function editCatInfo(Request $request)
    {
        $id = $request->post('cat_id');
        $title = $request->post('title');
        $value = $request->post('value');

        if ($title == 'cat_sort') {
            $value = intval($value);
        }
        $ret = $this->articleCat->update($id, [$title => $value]);

        if ($ret === false) {
            return result(-1, '', '设置失败');
        }
        return result(0, '', '设置成功');
    }

    /**
     * 删除分类
     *
     * @param Request $request
     * @return mixed
     */
    public function delCategory(Request $request)
    {
        $id = $request->post('cat_id');
        $ret = $this->articleCat->del($id);
        if ($ret === false) {
            // Log
            admin_log('文章分类删除失败。ID：'.$id);
            return result(-1, '', '删除失败');
        }

        // Log
        admin_log('删除了一条文章分类。ID：'.$id);
        return result(0, '', '删除成功');
    }
}