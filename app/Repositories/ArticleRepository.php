<?php

namespace App\Repositories;

use App\Models\Article;
use App\Models\ArticleCat;
use App\Services\AlibabaCloudLiveService;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class ArticleRepository
{
    use BaseRepository;

    protected $model;
    protected $articleCat;
    protected $aliLiveService;

    public function __construct()
    {
        $this->model = new Article();
        $this->articleCat = new ArticleCatRepository();
        $this->aliLiveService = new AlibabaCloudLiveService();

    }


    /**
     * 获取帮助中心文章列表
     *
     * @return mixed
     */
    public function getHelpCenterArticle()
    {

        $cache_id = CACHE_KEY_HELP_CENTER_ARTICLES[0];
        if ($class_list = cache()->get($cache_id)) {
            return $class_list;
        }
        // 帮助中心文章分类
        $class_list = $this->articleCat->getHelpCenterClass();
        if (!empty($class_list)) {
            foreach ($class_list as &$item) {
                $aCondition = [
                    'where' => [
                        ['status', 1],
                        ['cat_id', $item['cat_id']]
                    ],
                    'limit' => 0,
                ];
                list($articles, $articleTotal) = $this->model->getList($aCondition);
                $item['article'] = $articles->toArray();
            }
        }
        cache()->put($cache_id, $class_list, CACHE_KEY_HELP_CENTER_ARTICLES[1]);

        return $class_list;
    }

    /**
     * 获取上一篇/下一篇
     *
     * @param int $id 文章id
     * @return array
     */
    public function getFrontAfterArticle($id)
    {
        //上一篇
        $previous = $this->model->select($this->getAppArticleFields())
            ->where([['article_id', '<', $id]])->orderBy('article_id', 'desc')->limit(1)->first();
        if (!empty($previous)) {
            $previous->toArray();
        }
        //下一篇
        $next = $this->model->select($this->getAppArticleFields())
            ->where([['article_id', '>', $id]])->orderBy('article_id', 'asc')->limit(1)->first();
        if (!empty($next)) {
            $next->toArray();
        }
        return [$previous, $next];
    }


    /**
     * 获取app端文章字段
     *
     * @return array
     */
    public function getAppArticleFields()
    {
        $data = [
            'article_id', 'title', 'cat_id', 'content', 'keywords',
//            'jurisdiction',
            'article_thumb',
            'add_time', 'is_comment', 'click_number', 'is_show', 'user_id', 'status', 'link', 'source',
            'summary', 'goods_ids', 'shop_id', 'extend_cat', 'sort', 'is_recommend'
        ];

        return $data;
    }

    /**
     * 获取店铺入驻文章列表
     *
     * @param $cat_id
     * @param int $size
     * @param string $ordertype
     * @param string $articleFields
     * @return mixed
     */
    public function getShopApplyArticles($cat_id, $size = 5, $ordertype = 'asc', $articleFields = '')
    {
        if ($articleFields == '') {
            $articleFields = ['article_id', 'title', 'content', 'keywords', 'article_thumb', 'add_time', 'link', 'summary'];
        }
        // 入驻指南文章 asc排序
        $condition = [
            'where' => [
                ['status', 1],
                ['cat_id', $cat_id],
            ],
            'sortname' => 'sort',
            'sortorder' => $ordertype,
            'page_size' => $size,
            'field' => $articleFields,
        ];
        list($list, $total) = $this->getList($condition);
        $list = $list->toArray();
        if (!empty($list)) {
            foreach ($list as &$v) {
                if (isset($v['article_thumb'])) {
                    $v['article_thumb'] = get_image_url($v['article_thumb']);
                }
            }
        }

        return $list;
    }

    /**
     * 根据分类类型id获取文章列表
     *
     * @param int $cat_type 分类类型id 如：2-商城公告
     * @param int $size
     * @param string $ordertype
     * @param string $articleFields
     * @return mixed
     */
    public function getArticlesByCatType($cat_type, $size = 5, $ordertype = 'asc', $articleFields = '')
    {
        if ($articleFields == '') {
            $articleFields = ['article_id', 'title', 'content', 'keywords', 'article_thumb', 'add_time', 'link', 'summary'];
        }
        // 入驻指南文章 asc排序
        $condition = [
            'where' => [
                ['status', 1],
                ['cat_type', $cat_type],
            ],
            'sortname' => 'sort',
            'sortorder' => $ordertype,
            'page_size' => $size,
            'field' => $articleFields,
        ];
        list($list, $total) = $this->getList($condition);
        $list = $list->toArray();
        if (!empty($list)) {
            foreach ($list as &$v) {
                if (isset($v['article_thumb'])) {
                    $v['article_thumb'] = get_image_url($v['article_thumb']);
                }
            }
        }

        return $list;
    }

    /**
     * 获取用户发布的文章详情
     *
     * @param $user_id
     * @param $article_id
     * @return array|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Foundation\Application|\Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function userArticleInfo($user_id, $article_id)
    {
        $info = Article::where('article_id', $article_id)
            ->with(['user' => function ($query) {
                $query->select(['user_id', 'nickname', 'headimg']);
            }])->first();

        if (empty($info)) {
            return result(-1, [], '文章id无效');
        }
        if ($info->status != 1) {
            return result(-1, [], '文章状态无效');
        }
        $info->article_thumb = !empty($info->article_thumb) ? get_image_url($info->article_thumb) : '';
        $info->video = !empty($info->video) ? get_image_url($info->video) : '';
        $images = [];
        if (!empty($info->images)) {
            $images = explode('|', $info->images);
            foreach ($images as $k => $i) {
                $images[$k] = get_image_url($i);
            }
        }
        $info->images = $images;

        if (!empty($info->user)) {
            $info->user->headimg = get_image_url($info->user->headimg, 'headimg');
        }
        $info->is_followed = (new UserFollowRepository())->checkIsFollowed($user_id, $info->user_id);
        $info->is_praised = (new UserPraiseRepository())->checkIsPraiseed($user_id, $article_id);
        $info->is_collected = (new UserCollectRepository())->checkIsCollected($user_id, $article_id);
//        $info->follow_count = (new UserFollowRepository())->getUserFollowCount($user_id);
        $info->praise_count = (new UserPraiseRepository())->getUserPraiseCount(0, $info->article_id);
        $info->collect_count = (new UserCollectRepository())->getUserCollectCount(0, $info->article_id);
        $info->live_user_count = 0;
        $info->comment_count = (new UserCommentRepository())->getUserCommentCount(0, $info->article_id);
        $info->push_stream = !empty($info->push_stream) ? json_decode($info->push_stream) : [];
        $info->pull_stream = !empty($info->pull_stream) ? json_decode($info->pull_stream) : [];

        Article::where('article_id', $article_id)->increment('click_number', 1); // 统计点击数+1

        return $info;
    }

    /**
     * 发布帖子/视频/直播
     *
     * @param $user_id
     * @param $post
     * @return User
     * @throws \Throwable
     */
    public function publish($user_id, $post)
    {
        DB::beginTransaction();
        try {
            $cat_id = $post['cat_id'];
            switch ($post['article_type']) {
                case 1: // 帖子
                    unset($post['video']);
                    $cat_type = 15;

                    break;
                case 2: // 视频
                    unset($post['images']);
                    $cat_type = 15;

                    break;
                case 3: // 直播
                    unset($post['video'], $post['images']);
                    $cat_type = 17;
                    $cat_id = ArticleCat::where('cat_type', $cat_type)->value('cat_id') ?? 0;
                    break;
                default:
                    throw new \Exception('发布类型无效');
                    break;
            }
            // 处理images
            $images = explode('|', $post['images']);
            $images = array_filter($images);
            $images = implode('|', $images);
            $post['images'] = $images;
            $post['content'] = $post['content'] ?? '';
            $post['location'] = $post['location'] ?? '';
            $post['cat_id'] = $cat_id;
            $post['user_id'] = $user_id;
            $post['cat_type'] = $cat_type;
            $post['cat_model'] = 2;
            $post['add_time'] = Carbon::now()->toDateTimeString();
            $post['status'] = 1; // 默认审核通过
            $ret = $this->store($post);

            if ($post['article_type'] == 3) {
                $stream = $this->getStream($ret->article_id);
                $ret->push_stream = array_get($stream, 'push_stream');
                $ret->pull_stream = array_get($stream, 'pull_stream');
            }

            DB::commit();
            return $ret;
        } catch (\Exception $e) {
            DB::rollBack();
            throw new \Exception($e->getMessage());
        }
    }

    public function changeLiveStatus($user_id, $id, $status)
    {
        DB::beginTransaction();
        try {
            $info = Article::where([['user_id', $user_id], ['article_id', $id]])->first();
            if (empty($info)) {
                throw new \Exception('数据不存在');
            }
            $post = [];
            if ($status == 1) {
                // 开启直播
                $post = [
                    'live_status' => 1,
                    'start_time' => Carbon::now()->toDateTimeString(),
                    'push_stream' => $this->aliLiveService->createStreamUrl($id, 0, 'user')
                ];
                // 视频直播接口调用
                $this->aliLiveService->resumeLiveStream('user', 'room'.$id);
            } elseif ($status == 2) {
                // 关闭直播
                $post = [
                    'live_status' => 2,
                    'end_time' => Carbon::now()->toDateTimeString(),
                ];
                // 视频直播接口调用
                $this->aliLiveService->forbidLiveStream('user', 'room'.$id);
            }
            $ret = $this->update($id, $post);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            throw new \Exception($e->getMessage());
        }
    }

    /**
     * 获取推流/拉流地址
     *
     * @param Request $request
     * @return array|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     * @throws \Throwable
     */
    public function getStream($id)
    {
        // 重置推流/拉流地址
        $data = [
            'id' => $id,
            'push_stream' => $this->aliLiveService->createStreamUrl($id, 0, 'user'),
            'pull_stream' => $this->aliLiveService->createStreamUrl($id, 1, 'user'),
            //"rtmp://livepush.xxxx.com/ysc/room60?auth_key=1581246921-0-0-9566a8d603e63b3fd9172ec42ee7ee45"
        ];
        // 更新推流地址/拉流地址
        $ret = $this->update($id, ['push_stream' => json_encode($data['push_stream']), 'pull_stream' => json_encode($data['pull_stream'])]);
        if ($ret === false) {
            throw new \Exception(OPERATE_FAIL);
        }
        return $data;
    }
}