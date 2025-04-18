<?php

namespace App\Modules\Frontend\Http\Controllers;

use App\Models\Article;
use App\Modules\Base\Http\Controllers\Frontend;
use App\Repositories\ArticleCatRepository;
use App\Repositories\ArticleRepository;
use App\Repositories\UserCollectRepository;
use App\Repositories\UserCommentRepository;
use App\Repositories\UserFollowRepository;
use App\Repositories\UserPraiseRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ArticleController extends Frontend
{

    protected $articleCat;

    protected $article;

    protected $class_list;

    public function __construct(
        ArticleCatRepository $articleCat
        ,ArticleRepository $article
    )
    {
        parent::__construct();

        $this->articleCat = $articleCat;
        $this->article = $article;

        // 帮助中心 文章分类
        $this->class_list = $this->articleCat->getHelpCenterClass();
    }

    /**
     * 帮助中心 文章搜索
     *
     * @param Request $request
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function defaultSearch(Request $request)
    {
        $cat_ids = array_column($this->class_list, 'cat_id');

        $type = $request->post('type', ''); // 搜索类型
        $keyword = $request->post('keyword', ''); // 搜索关键词

        $condition = [
            'where' => [
                ['status', 1],
                ['title', 'like', "%{$keyword}%"],
            ],
            'in' => [
                'field' => 'cat_id',
                'condition' => $cat_ids
            ],
            'field' => ['article_id','title','summary'],
            'limit' => 0,
        ];
        list($list, $total) = $this->article->getList($condition);
        $class_list = $this->class_list;

        $compact = compact('list', 'class_list', 'keyword');
        $webData = []; // web端（pc、mobile）数据对象
        $data = [
            'app_prefix_data' => [
                'article_cat' => $class_list,
                'article_content' => false,
                'search_content' => $list->toArray()
            ],
            'app_suffix_data' => [],
            'web_data' => $webData,
            'compact_data' => $compact,
            'tpl_view' => 'article.default_search'
        ];
        $this->setData($data); // 设置数据
        return $this->displayData(); // 模板渲染及APP客户端返回数据
    }

    /**
     * 帮助中心 文章详情
     *
     * @param Request $request
     * @param $article_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showHelp(Request $request, $article_id = 0)
    {
        if (empty($article_id)) { // /help/default/info?article_id=$article_id请求
            $article_id = $request->get('article_id');
        }
        if (!$article_id) {
            abort(404, '文章id无效');
        }

        $class_list = $this->article->getHelpCenterArticle();
        $article_info = $this->article->getById($article_id);

        $this->show_seo('seo_article_info',['name'=>$article_info->title]); // SEO

        $compact = compact('article_info', 'class_list');
        $webData = []; // web端（pc、mobile）数据对象
        $data = [
            'app_prefix_data' => [
                'article_cat' => $class_list,
                'article_content' => [
                    'title' => $article_info->title,
                    'cat_id' => $article_info->cat_id,
                    'content' => $article_info->content
                ],
                'article_id' => $article_id
            ],
            'app_suffix_data' => [],
            'web_data' => $webData,
            'compact_data' => $compact,
            'tpl_view' => 'article.show_help'
        ];
        $this->setData($data); // 设置数据
        return $this->displayData(); // 模板渲染及APP客户端返回数据
    }

//    public function showShop(Request $request, $article_id)
//    {
//        // 商家指南 文章分类
//        $condition = [
//            'where' => [
//                ['is_show', 1],
////                ['cat_type', ['in' => [3,11,12]]]
//            ],
//            'in' => [
//                'field' => 'cat_type',
//                'condition' => [3,11,12]
//            ],
//            'limit' => 0,
//        ];
//        list($class_list, $total) = $this->articleCat->getList($condition, '', true);
////        dd($class_list);
//        $article_info = $this->article->getById($article_id);
//
////        dd($article_info);
//        return view('article.show_shop', compact('article_info', 'class_list'));
//    }

    /**
     * 所有文章分类下的文章详情展示
     *
     * @param Request $request
     * @param $article_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showArticle(Request $request, $article_id)
    {

        $articleCatFields = $this->articleCat->getAppArticleCatFields();
        $articleFields = $this->article->getAppArticleFields();

        $condition = [
            'where' => [
                ['is_show', 1],
            ],
            'limit' => 0,
            'field' => $articleCatFields
        ];
        list($cat_list, $total) = $this->articleCat->getList($condition, '', true);
        $article_info = $this->article->getById($article_id, $articleFields);
        if (empty($article_info)) {
            abort(404, '文章id无效');
        }
        $article_info = $article_info->toArray();

        Article::where('article_id', $article_id)->increment('click_number', 1); // 统计点击数+1

        // 当前文章所属分类信息
        $cat = $this->articleCat->getById($article_info['cat_id'], $articleCatFields);
        // 上一篇、下一篇文章
        list($article_pre, $article_next) = $this->article->getFrontAfterArticle($article_id);

        $this->show_seo('seo_article_info',['name'=>$article_info['title']]); // SEO

        $compact = compact('cat_list','article_info','cat','article_pre','article_next');
        $webData = []; // web端（pc、mobile）数据对象
        $data = [
            'app_prefix_data' => [
                'article' => $article_info,
                'article_pre' => $article_pre,
                'article_next' => $article_next,
                'cat_list' => $cat_list,
                'cat_id' => $article_info['cat_id'],
                'shop_id' => $article_info['shop_id'],
                'cat' => $cat->toArray(),
                'list_title' => "",
                'url' => 'article'
            ],
            'app_suffix_data' => [],
            'web_data' => $webData,
            'compact_data' => $compact,
            'tpl_view' => 'article.show_article'
        ];
        $this->setData($data); // 设置数据
        return $this->displayData(); // 模板渲染及APP客户端返回数据
    }

    /**
     * 显示文章列表
     *
     * @param Request $request
     * @param $cat_id
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Throwable
     */
    public function showArticleList(Request $request, $cat_id = 0)
    {
        $seo_title = '文章列表';
        $articleCatFields = $this->articleCat->getAppArticleCatFields();
        $articleFields = $this->article->getAppArticleFields();

        // 文章列表
        $keyword = $request->get('keyword', '');
        $condition = [
            'where' => [
                ['status', 1],
                ['title', 'like', "%{$keyword}%"],
            ],
            'field' => $articleFields,
        ];
        $cat = [];
        if ($cat_id) {
            $cat_ids = get_article_cat_grandson($cat_id);
            $condition['in'] = [
                'field' => 'cat_id',
                'condition' => $cat_ids
            ];
            // 当前文章所属分类信息
            $cat = $this->articleCat->getById($cat_id, $articleCatFields);
            $seo_title = $cat['cat_name'];
        }
        list($list, $total) = $this->article->getList($condition);
        $list = $list->toArray();
        $pageHtml = frontend_pagination($total);
        if ($request->ajax()) {
            $render = view('article.partials._article_list', compact('list', 'total', 'pageHtml'))->render();
            return result(0,$render);
        }

        // 分类列表
        $condition = [
            'where' => [
                ['is_show', 1],
            ],
            'limit' => 0,
            'field' => $articleCatFields
        ];
        list($cat_list, $cat_total) = $this->articleCat->getList($condition, '', true);

        $this->show_seo('seo_article_cat',['name'=>$seo_title]); // SEO

        $compact = compact('list','pageHtml','cat_list','cat');
        $webData = []; // web端（pc、mobile）数据对象
        $data = [
            'app_prefix_data' => [
                'list' => $list,
                'page' => frontend_pagination($total, true),
                'cat_list' => $cat_list,
                'cat_id' => $cat_id,
                'shop_id' => 0,
                'cat' => $cat,
                'list_title' => "",
                'url' => 'article'
            ],
            'app_suffix_data' => [],
            'web_data' => $webData,
            'compact_data' => $compact,
            'tpl_view' => 'article.article_list'
        ];
        $this->setData($data); // 设置数据
        return $this->displayData(); // 模板渲染及APP客户端返回数据
    }

    /**
     * 文章分类
     *
     * @param Request $request
     * @return array|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Foundation\Application|\Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function catList(Request $request)
    {
        // 文章分类
        $cat_type = $request->input('cat_type', 1);
        $condition = [
            'where' => [
                ['is_show', 1],
                ['cat_type', $cat_type],
            ],
//            'in' => [
//                'field' => 'cat_type',
//                'condition' => [3,11,12]
//            ],
            'limit' => 0,
            'field' => ['cat_id', 'cat_name', 'parent_id', 'cat_type', 'cat_image', 'created_at']
        ];
        list($class_list, $total) = $this->articleCat->getList($condition, '', true);

        return result(0, $class_list, '获取成功');
    }

    /**
     * 帖子/视频/直播列表
     *
     * @param Request $request
     * @return array|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Http\JsonResponse|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function lists(Request $request)
    {
        $seo_title = '文章列表';

        $params = $request->all();
        $type = $request->input('type', 1); // 文章类型 1-帖子/视频 2-我关注人的帖子/视频 3-直播
        $cat_type = $request->input('cat_type'); // 文章分类类型
        $cat_id = $request->input('cat_id'); // 文章分类ID
        $keyword = $request->input('keyword'); // 文章标题
        $user_id = $request->input('user_id'); // 用户ID
        $shop_id = $request->input('shop_id'); // 店铺ID


        // 获取数据
        $where = [];
        $in = [];
        // 搜索条件 订单编号/退款退货单编号
        $search_arr = ['type', 'cat_id', 'keyword', 'user_id'];
        foreach ($search_arr as $v) {
            if (isset($params[$v]) && !empty($params[$v])) {
                if ($v == 'keyword') {
                    $where[] = ['title', 'like', "%{$params[$v]}%"];
                } elseif ($v == 'type') {
                    if ($type == 1) {
                        $in = [
                            'field' => 'article_type',
                            'condition' => [1,2]
                        ];
                    } elseif ($type == 2) {
                        // 我关注人的帖子/视频
                        if ($this->user_id) {
                            $follow_user_ids = DB::table('user_follow')->where([['type', 1],['user_id', $this->user_id]])->pluck('target_id')->toArray();
                            if (!empty($follow_user_ids)) {
                                $in = [
                                    'field' => 'user_id',
                                    'condition' => $follow_user_ids
                                ];
                            } else {
                                $where[] = ['user_id', []];
                            }
                        } else {
                            $where[] = ['user_id', []];
                        }
                    }
                    elseif ($type == 3) {
                        $where[] = ['article_type', 3];
                        $where[] = ['live_status', 1];
                    }
                } else {
                    $where[] = [$v, $params[$v]];
                }
            }
        }
        if (!$shop_id) {
            // 不是店铺文章
            $where[] = ['shop_id', 0];
        }

        $where[] = ['status', 1];
        $where[] = ['cat_type', $cat_type];
        // 列表
        $condition = [
            'where' => $where,
            'in' => $in,
            'with' => ['user' => function ($query) {
                $query->select(['user_id', 'nickname', 'headimg']);
            }],
            'sortname' => 'article_id',
            'sortorder' => 'desc'
        ];

        list($list, $total) = $this->article->getList($condition);
        if ($list->isNotEmpty()) {
            foreach ($list as $item) {
                $item->article_thumb = !empty($item->article_thumb) ? get_image_url($item->article_thumb) : '';
                $item->video = !empty($item->video) ? get_image_url($item->video) : '';
                $images = [];
                if (!empty($item->images)) {
                    $images = explode('|', $item->images);
                    foreach ($images as $k => $i) {
                        $images[$k] = get_image_url($i);
                    }
                }
                $item->images = $images;

                if (!empty($item->user)) {
                    $item->user->headimg = get_image_url($item->user->headimg, 'headimg');
                }
                $item->is_followed = (new UserFollowRepository())->checkIsFollowed($this->user_id, $item->user_id);
                $item->is_praised = (new UserPraiseRepository())->checkIsPraiseed($this->user_id, $item->article_id);
                $item->is_collected = (new UserCollectRepository())->checkIsCollected($this->user_id, $item->article_id);
                $item->praise_count = (new UserPraiseRepository())->getUserPraiseCount(0, $item->article_id);
                $item->collect_count = (new UserCollectRepository())->getUserCollectCount(0, $item->article_id);
                $item->live_user_count = 0;
                $item->comment_count = (new UserCommentRepository())->getUserCommentCount(0, $item->article_id);
            }
        }
        $pageHtml = frontend_pagination($total);
        $page_array = frontend_pagination($total, true);
        $page_json = json_encode($page_array);

        $compact = compact('seo_title', 'pageHtml', 'list', 'page_json');

        if ($request->ajax() && !is_app()) { // web端访问 ajax请求
            $render = view('article.partials._list', $compact)->render();
            return result(0, $render);
        }

        $webData = []; // web端（pc、mobile）数据对象
        $data = [
            'app_prefix_data' => [
                'page' => $page_array,
                'list' => $list,
            ],
            'app_suffix_data' => [],
            'web_data' => $webData,
            'compact_data' => $compact,
            'tpl_view' => 'article.list'
        ];
        $this->setData($data); // 设置数据
        return $this->displayData(); // 模板渲染及APP客户端返回数据
    }

    /**
     * 文章详情
     *
     * @param Request $request
     * @return array|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Foundation\Application|\Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function info(Request $request)
    {
        $article_id = $request->input('article_id', 0);
        $info = $this->article->userArticleInfo($this->user_id, $article_id);

        return result(0, $info, '获取成功');
    }
}
