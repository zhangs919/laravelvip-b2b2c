<?php

namespace app\Modules\Seller\Http\Controllers\Article;


use App\Modules\Base\Http\Controllers\Seller;
use App\Repositories\ArticleCatRepository;
use App\Repositories\ArticleRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ArticleController extends Seller
{
//    private $title;

    private $links = [
        ['url' => 'article/article/list?status=1', 'text' => '全部文章'],
        ['url' => 'article/article/list?status=2', 'text' => '待审核文章'],
        ['url' => 'article/article/list?status=3', 'text' => '已发布文章'],
        ['url' => 'article/article/list?status=4', 'text' => '未通过文章'],
    ];

    private $edit_links = [
        ['url' => 'article/article/list?status=1', 'text' => '全部文章'],
        ['url' => 'article/article/list?status=2', 'text' => '待审核文章'],
        ['url' => 'article/article/list?status=3', 'text' => '已发布文章'],
        ['url' => 'article/article/list?status=4', 'text' => '未通过文章'],
        ['url' => 'article/article/add', 'text' => '添加单网页文章'],
        ['url' => 'article/article/edit', 'text' => '文章编辑'],
    ];

    protected $article;

    protected $articleCat;


    public function __construct(ArticleRepository $articleRepository, ArticleCatRepository $articleCatRepository)
    {
        parent::__construct();

        $this->article = $articleRepository;
        $this->articleCat = $articleCatRepository;

        $this->set_menu_select('shop', 'shop-article-list');

    }


    public function lists(Request $request)
    {
        $status = $request->get('status', 1);

        $title = $this->links[$status - 1]['text'];
        $fixed_title = '文章列表 - '.$title;

        $action_span = [
            [
                'url' => 'add?cat_model=2',
                'icon' => 'fa-plus',
                'text' => '添加普通文章'
            ],
        ];
        $explain_panel = [
            '店铺仅可发布文章分类类型为“普通分类”的文章分类下的文章，如果发布文章时，未有文章分类，请联系平台方进行添加',
            '店铺发布文章流程：店铺发布文章->平台方审核->审核通过后，该文章即可在前台文章列表中显示'
        ];
        $blocks = [
            'fixed_title' => $fixed_title,
            'action_span' => $action_span,
            'explain_panel' => $explain_panel,
        ];
        $this->setLayoutBlock($blocks); // 设置block
        $this->sublink($this->links, $status, 'status');

        $params = $request->all();


        $where = [];
        $whereBetween = [];

        // 根据文章分类类型筛选
        if (isset($params['show_cat_type'])) {
            $where[] = ['cat_type', $params['show_cat_type']];
        }

        // 搜索条件
        $search_arr = ['cat_model', 'cat_id', 'title'];
        if (!empty($request->get('begin')) && !empty($request->get('end'))) {
            $whereBetween = [
                'field' => 'add_time',
                'condition' => [$request->get('begin'), $request->get('end')]
            ];
//            $where[] = ['add_time', 'between', [strtotime($request->get('begin')), strtotime($request->get('end'))]];
        } elseif (!empty($request->get('begin')) && empty($request->get('end'))) {
            $where[] = ['add_time', '>', $request->get('begin')];
        } elseif (empty($request->get('begin')) && !empty($request->get('end'))) {
            $where[] = ['add_time', '<', $request->get('end')];
        }
        foreach ($search_arr as $v) {
            if (isset($params[$v]) && !empty($params[$v])) {

                if ($v == 'title') {
                    $where[] = [$v, 'like', "%{$params[$v]}%"];
                } else {
                    $where[] = [$v, $params[$v]];
                }
            }
        }
        // 根据审核状态查询 status
        if ($status == 1) {
            // 查询所有
        } elseif ($status == 2) {
            // 查询待审核
            $where[] = ['status', 0];
        } elseif ($status == 3) {
            // 查询已审核
            $where[] = ['status', 1];
        } elseif ($status == 4) {
            // 查询未通过
            $where[] = ['status', 2];
        }

//        dd($condition);
        $where[] = ['shop_id', seller_shop_info()->shop_id]; // 店铺id

        // 文章列表
        $condition = [
            'where' => $where,
            'between' => $whereBetween
        ];

        list($list, $total) = $this->article->getList($condition);

        if (!empty($list)) {
            foreach ($list as $item) {
                $item->cat_name = DB::table('article_cat')->where('cat_id', $item->cat_id)->value('cat_name');
            }
        }

        $pageHtml = pagination($total);
        if ($request->ajax()) {
            $render = view('article.article.partials._list', compact('list', 'total', 'pageHtml'))->render();
            return result(0, $render);
        }

        //分类列表
        $where = [];
        $catCondition = [
            'where' => $where,
            'limit' => 0, // 不分页
            'sortname' => 'cat_sort',
            'sortorder' => 'asc'
        ];
        list($cat_list, $cat_total) = $this->articleCat->getList($catCondition, '', false, true);

        return view('article.article.list', compact('title', 'list', 'pageHtml', 'cat_list'));
    }

    public function selectCatType(Request $request)
    {
        $cat_model = $request->get('cat_model', 1);
        // 分类列表
        $where = [
            ['cat_model', $cat_model]
        ];
        $catCondition = [
            'where' => $where,
            'limit' => 0, // 不分页
            'sortname' => 'cat_sort',
            'sortorder' => 'asc'
        ];
        list($cat_list, $total) = $this->articleCat->getList($catCondition, '', false, true);
        $render = view('article.article.select_cat_type', compact('cat_list'))->render();

        return result(0, $render);
    }

    public function add(Request $request)
    {
        $title = '文章添加';
        $fixed_title = '文章列表 - '.$title;
        $cat_model = $request->get('cat_model', 2);

        $action_span = [
            [
                'url' => 'list',
                'icon' => 'fa-reply',
                'text' => '返回文章列表'
            ]
        ];
        $blocks = [
            'fixed_title' => $fixed_title,
            'action_span' => $action_span
        ];
        $this->setLayoutBlock($blocks); // 设置block

        if ($cat_model == 1) {
            // 单网页文章
            $linkTitle = '添加单网页文章';
        } else {
            // 普通文章
            $linkTitle = '添加普通文章';
        }
        $this->edit_links[4]['text'] = $linkTitle;
        $this->sublink($this->edit_links, 'add', '', '', 'edit');

        $article_cat_type = article_cat_type();
        $show_cat_type = implode(',', array_keys($article_cat_type));

        $cat_type = 1; // 只获取普通分类
        // 获取分类列表
        $cat_list = $this->articleCat->getCatListByCatModel($cat_model, true, $cat_type);

        return view('article.article.add', compact('title', 'cat_model', 'show_cat_type', 'cat_list'));
    }

    public function edit(Request $request)
    {
        $title = '文章编辑';
        $fixed_title = '文章列表 - '.$title;
//        $cat_model = $request->get('cat_model', 1);
        $id = $request->get('id');

        $action_span = [
            [
                'url' => 'list',
                'icon' => 'fa-reply',
                'text' => '返回文章列表'
            ]
        ];
        $blocks = [
            'fixed_title' => $fixed_title,
            'action_span' => $action_span
        ];
        $this->setLayoutBlock($blocks); // 设置block

//        if ($cat_model == 1) {
//            // 单网页文章
//            $linkTitle = '添加单网页文章';
//        } else {
//            // 普通文章
//            $linkTitle = '添加普通文章';
//        }
        $this->edit_links[4]['text'] = $title;
        $this->sublink($this->edit_links, 'edit', '', '', 'add');

        $article_cat_type = article_cat_type();
        $show_cat_type = implode(',', array_keys($article_cat_type));

        // 文章信息
        $info = $this->article->getById($id);

        // 获取分类列表
        $cat_list = $this->articleCat->getCatListByCatModel($info->cat_model, true);



        return view('article.article.edit', compact('title', 'cat_model', 'show_cat_type', 'cat_list', 'info'));
    }

    public function saveData(Request $request)
    {
        $post = $request->post('ArticleModel');

        if (!empty($post['article_id'])) {
            // 编辑
            $ret = $this->article->update($post['article_id'], $post);
            $msg = '编辑';
        }else {
            // 添加
            $cat_info = $this->articleCat->getById($post['cat_id']);
            $post['cat_model'] = $cat_info->cat_model;
            $post['cat_type'] = $cat_info->cat_type;
            $post['user_id'] = auth('seller')->id();
            $post['status'] = 0; // 默认发布的文章状态为：未审核
            $post['user_id'] = auth('seller')->id();
            $post['shop_id'] = seller_shop_info()->shop_id;
            $ret = $this->article->store($post);
            $msg = '添加';
        }

        if ($ret === false) {
            // fail
            flash('error', $msg.'失败');
            return redirect('/article/article/list');
        }

        // Log
//        admin_log($msg.'了一篇文章。ID：'.$ret->article_id);

        // success
        flash('success', $msg.'成功');
        return redirect('/article/article/list');
    }


    public function setIsRecommend(Request $request)
    {
        $id = $request->get('id');
        $ret = $this->article->changeState($id, 'is_recommend');
        if ($ret === false) {
            return result(-1, '', '设置失败');
        }
        return result(0, $ret, '设置成功');
    }

    public function setShow(Request $request)
    {
        $id = $request->get('id');
        $ret = $this->article->changeShow($id);
        if ($ret === false) {
            return result(-1, '', '设置失败');
        }
        return result(0, $ret, '设置成功');
    }

    public function editArticleInfo(Request $request)
    {
        $id = $request->post('article_id');
        $title = $request->post('title');
        $value = $request->post('value');

        if (in_array($title, ['click_number', 'sort'])) {
            $value = intval($value);
        }
        $ret = $this->article->update($id, [$title => $value]);

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
        $id = $request->post('id');
        $ret = $this->article->del($id);
        if ($ret === false) {
            // Log
            admin_log('文章删除失败。ID：'.$id);
            return result(-1, '', '删除失败');
        }

        // Log
        admin_log('删除了一篇文章。ID：'.$id);
        return result(0, '', '删除成功');
    }

    public function batchDelete(Request $request)
    {
        $ids = $request->post('ids');
        $ret = $this->article->batchDel($ids);

        $ids = implode(',', $ids);
        if ($ret === false) {
            // Log
            admin_log('文章删除失败。ID：'.$ids);
            return result(-1, '', '删除失败');
        }
        // Log
        admin_log('删除了多篇文章。ID：'.$ids);
        return result(0, '', '删除成功');
    }


    public function picker(Request $request)
    {
        $page_id = make_uuid();
        $pagination_id = $request->get('page')['page_id'];
        $output = $request->get('output');
        $cat_type = $request->get('cat_type', '');
        $selected_ids = $request->get('selected_ids', '');
        $selected_ids = explode(',', $selected_ids);

        // 查询条件
        $where[] = ['status', 1];
        $whereIn = [];

        $tpl = 'picker';
        if (!$output) {
            // ajax 输出文章列表
            $tpl = 'partials._picker_article_list';
//            if (!empty($selected_ids)) {
//                $whereIn = [
//                    'field' => 'article_id',
//                    'condition' => $selected_ids
//                ];
//            }
        }

        $condition = [
            'where' => $where,
            'in' => $whereIn,
            'sortname' => 'article_id',
            'sortorder' => 'desc'
        ];
        list($list, $total) = $this->article->getList($condition);
        $pageHtml = short_pagination($total);

        $render = view('article.article.'.$tpl, compact('page_id', 'pagination_id', 'list', 'pageHtml', 'selected_ids'))->render();
        return result(0, $render);
    }

}