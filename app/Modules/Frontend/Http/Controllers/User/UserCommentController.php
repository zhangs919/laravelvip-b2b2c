<?php


namespace App\Modules\Frontend\Http\Controllers\User;

use App\Modules\Base\Http\Controllers\UserCenter;
use App\Repositories\UserCommentRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserCommentController extends UserCenter
{

    protected $userComment;

    public function __construct(UserCommentRepository $userComment)
    {
        parent::__construct();

        $this->userComment = $userComment;
    }

    /**
     * 我发布的评论
     *
     * @param Request $request
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Throwable
     */
    public function myList(Request $request)
    {
        $type = $request->input('type', 1); // 类型 1-文章收藏
        $where[] = ['user_comment.user_id', $this->user_id];
        $where[] = ['user_comment.type', $type];

        $condition = [
            'join' => [
                [
                    'join_table' => 'article',
                    'join_first' => 'user_comment.target_id',
                    'join_operator' => '=',
                    'join_second' => 'article.article_id',
                    'join_type' => 'left',
                    'join_where' => false,
                ]
            ],
            'with' => ['user' => function ($query) {
                $query->select(['user_id', 'nickname', 'headimg']);
            }],
            'where' => $where,
            'sortname' => 'user_comment.comment_id',
            'sortorder' => 'desc',
            'field' => [
                'user_comment.*', 'article.article_id', 'article.title', 'article.article_thumb', 'article.article_type']
        ];
        list($list, $total) = $this->userComment->getList($condition);
        $pageArr = frontend_pagination($total, true);

        $data = [
            'page' => $pageArr,
            'list' => $list,
        ];
        return result(0, $data, '获取成功');
    }

    /**
     * 发布评论
     *
     * @param Request $request
     * @return array
     */
    public function comment(Request $request)
    {
        $defaults = [
            'type' => 1,
            'pid' => 0
        ];
        $params = $request->only(['type', 'target_id', 'pid', 'content']);
        $params = array_merge($defaults, $params);
        $rules = [
            'type' => 'integer|in:1',
            'target_id' => 'required|integer',
            'pid' => 'integer',
            'content' => 'required|max:1000',
        ];
        $validator = Validator::make($params, $rules);

        if ($validator->fails()) {
            return result(-1, [], $validator->errors()->first());
        }

        if ($params['type'] == 1) { // 文章
            try {
                $ret = $this->userComment->comment($this->user_id, $params);
            } catch (\Exception $e) {
                return result(-1, [], $e->getMessage());
            }
        } else {
            // 其他类型 ...
        }
        if ($ret === false) {
            // 失败
            return result(-1, [], '提交失败');
        }
        // 成功
        return result(0, $ret, '提交成功');
    }
}