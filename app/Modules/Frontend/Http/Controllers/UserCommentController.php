<?php


namespace App\Modules\Frontend\Http\Controllers;

use App\Modules\Base\Http\Controllers\Frontend;
use App\Repositories\UserCommentRepository;
use Illuminate\Http\Request;

class UserCommentController extends Frontend
{

    protected $userComment;

    public function __construct(UserCommentRepository $userComment)
    {
        parent::__construct();

        $this->userComment = $userComment;
    }


    /**
     * 评论列表
     *
     * @param Request $request
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Throwable
     */
    public function lists(Request $request)
    {
        $type = $request->input('type', 1); // 类型 1-文章收藏
        $target_id = $request->input('target_id');
        if (!$target_id) {
            return result(-1, [], '目标ID不能为空');
        }
        $where[] = ['user_comment.type', $type];
        $where[] = ['user_comment.target_id', $target_id];

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
            'limit'=> 0,
            'sortname' => 'user_comment.comment_id',
            'sortorder' => 'desc',
            'field' => [
                'user_comment.*', 'article.article_id', 'article.title', 'article.article_thumb', 'article.article_type']
        ];
        list($list, $total) = $this->userComment->getList($condition, '', true);

//        $pageArr = frontend_pagination($total, true);

        $data = [
//            'page' => $pageArr,
            'list' => $list,
        ];
        return result(0, $data, '获取成功');
    }


}