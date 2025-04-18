<?php

namespace App\Modules\Frontend\Http\Controllers\User;

use App\Models\Article;
use App\Modules\Base\Http\Controllers\Frontend;
use App\Modules\Base\Http\Controllers\UserCenter;
use App\Repositories\ArticleCatRepository;
use App\Repositories\ArticleRepository;
use App\Repositories\UserCollectRepository;
use App\Repositories\UserFollowRepository;
use App\Repositories\UserPraiseRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ArticleController extends UserCenter
{

    protected $articleCat;

    protected $article;

    protected $class_list;

    public function __construct(
        ArticleCatRepository $articleCat
        , ArticleRepository $article
    )
    {
        parent::__construct();

        $this->articleCat = $articleCat;
        $this->article = $article;

    }

    /**
     * 发布帖子/视频/直播
     * @param Request $request
     * @return array|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Foundation\Application|\Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function publish(Request $request)
    {
        $post = $request->only(['article_type', 'cat_id', 'title', 'article_thumb', 'content', 'images', 'video', 'location']);
        try {
            $ret = $this->article->publish($this->user_id, $post);
        } catch (\Exception $e) {
            return result(-1, '', $e->getMessage());
        }

        return result(0, $ret, '发布成功');
    }

    /**
     * 我发布的
     *
     * @param Request $request
     * @return array|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Http\JsonResponse|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function lists(Request $request)
    {
        $seo_title = '我发布的';

        $params = $request->all();
        $type = $request->input('type', 1); // 文章类型 1-帖子/视频 2-我关注人的帖子/视频 3-直播
        $cat_id = $request->input('cat_id'); // 文章分类ID
        $keyword = $request->input('keyword'); // 文章标题

        // 获取数据
        $where = [];
        // 搜索条件 订单编号/退款退货单编号
        $search_arr = [];
        foreach ($search_arr as $v) {
            if (isset($params[$v]) && !empty($params[$v])) {
                if ($v == 'keyword') {
                    $where[] = ['title', 'like', "%{$params[$v]}%"];
                } else {
                    $where[] = [$v, $params[$v]];
                }
            }
        }

        $where[] = ['user_id', $this->user_id];
//        $where[] = ['status', 1];

        // 列表
        $condition = [
            'where' => $where,
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
                $item->praise_count = (new UserPraiseRepository())->getUserPraiseCount($this->user_id, $item->article_id);
                $item->collect_count = (new UserCollectRepository())->getUserCollectCount($this->user_id, $item->article_id);
                $item->live_user_count = 0;
            }
        }
        $pageHtml = frontend_pagination($total);
        $page_array = frontend_pagination($total, true);
        $page_json = json_encode($page_array);

        $compact = compact('seo_title', 'pageHtml', 'list', 'page_json');

        if ($request->ajax() && !is_app()) { // web端访问 ajax请求
            $render = view('user.article.partials._list', $compact)->render();
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
            'tpl_view' => 'user.article.list'
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

    public function changeLiveStatus(Request $request)
    {
        $article_id = $request->post('article_id', 0);
        $live_status = $request->post('live_status', 0);
        try {
            $this->article->changeLiveStatus($this->user_id, $article_id, $live_status);
        } catch (\Exception $e) {
            return result(-1, [], $e->getMessage());
        }

        return result(0, [], '操作成功');
    }

    /**
     * 删除文章
     *
     * @param Request $request
     * @return array|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Foundation\Application|\Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $article_id = $request->input('article_id');
        if (!$article_id) {
            return  result(-1, [], '参数错误');
        }
        $info = Article::where('user_id', $this->user_id)->where('article_id',$article_id)->first();
        if (empty($info)) {
            return result(-1, [], '参数错误');
        }
        $ret = Article::where('user_id', $this->user_id)->where('article_id',$article_id)->delete();
        if (!$ret) {
            return result(-1, [], '删除失败');
        }
        return result(0, [], '删除成功！');
    }

}