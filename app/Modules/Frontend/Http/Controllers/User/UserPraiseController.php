<?php


namespace App\Modules\Frontend\Http\Controllers\User;

use App\Modules\Base\Http\Controllers\UserCenter;
use App\Repositories\UserCollectRepository;
use App\Repositories\UserCommentRepository;
use App\Repositories\UserFollowRepository;
use App\Repositories\UserPraiseRepository;
use Illuminate\Http\Request;

class UserPraiseController extends UserCenter
{

    protected $userPraise;

    public function __construct(UserPraiseRepository $userPraise)
    {
        parent::__construct();

        $this->userPraise = $userPraise;
    }

    /**
     * 我点赞的
     *
     * @param Request $request
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Throwable
     */
    public function lists(Request $request)
    {
        $type = $request->input('type', 1); // 类型 1-文章点赞
        $where[] = ['user_praise.user_id', $this->user_id];
        $where[] = ['user_praise.type', $type];

        $condition = [
            'join' => [
                [
                    'join_table' => 'article',
                    'join_first' => 'user_praise.target_id',
                    'join_operator' => '=',
                    'join_second' => 'article.article_id',
                    'join_type' => 'left',
                    'join_where' => false,
                ],
                [
                    'join_table' => 'user',
                    'join_first' => 'article.user_id',
                    'join_operator' => '=',
                    'join_second' => 'user.user_id',
                    'join_type' => 'left',
                    'join_where' => false,
                ]
            ],
            'where' => $where,
            'sortname' => 'user_praise.praise_id',
            'sortorder' => 'desc',
            'field' => [
                'user_praise.*', 'article.article_id', 'article.title', 'article.article_thumb', 'article.article_type',
                'user.user_id as target_user_id', 'user.nickname as target_nickname', 'user.headimg as target_headimg']
        ];
        list($list, $total) = $this->userPraise->getList($condition);
        if ($list->isNotEmpty()) {
            foreach ($list as $item) {
                $item->article_thumb = !empty($item->article_thumb) ? get_image_url($item->article_thumb) : '';
                if (!empty($item->target_user_id)) {
                    $item->user = collect([
                        'user_id' => $item->target_user_id,
                        'nickname' => $item->target_nickname,
                        'headimg' => get_image_url($item->target_headimg, 'headimg'),
                    ]);
                }
                unset($item->target_user_id,$item->target_nickname,$item->target_headimg);

                $item->is_followed = (new UserFollowRepository())->checkIsFollowed($this->user_id, $item->user_id);
                $item->is_praised = (new UserPraiseRepository())->checkIsPraiseed($this->user_id, $item->article_id);
                $item->is_collected = (new UserCollectRepository())->checkIsCollected($this->user_id, $item->article_id);
                $item->praise_count = (new UserPraiseRepository())->getUserPraiseCount(0, $item->article_id);
                $item->collect_count = (new UserCollectRepository())->getUserCollectCount(0, $item->article_id);
                $item->live_user_count = 0;
                $item->comment_count = (new UserCommentRepository())->getUserCommentCount(0, $item->article_id);
            }
        }
        $pageArr = frontend_pagination($total, true);

        $data = [
            'page' => $pageArr,
            'list' => $list,
        ];
        return result(0, $data, '获取成功');
    }

    /**
     * 点赞/取消点赞
     *
     * @param Request $request
     * @return array
     */
    public function toggle(Request $request)
    {
        $type = $request->input('type', 1);
        $target_id = $request->input('target_id', 0);

        if ($type == 1) { // 文章
            if ($this->userPraise->checkIsPraiseed($this->user_id, $target_id, $type)) {
                // 取消关注
                $msg = '取消点赞';
            } else {
                // 关注
                $msg = '点赞';
            }
            $ret = $this->userPraise->toggle($this->user_id, $target_id, $type);
        } else {
            // 其他类型 ...

            $ret = 1;
            $msg = '点赞';
        }
        if ($ret === false) {
            // 失败
            return result(-1, [], $msg . '失败');
        }
        // 成功
        return result(0, ['result' => $ret], $msg . '成功');
    }
}