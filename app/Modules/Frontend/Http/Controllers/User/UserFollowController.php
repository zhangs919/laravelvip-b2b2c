<?php


namespace App\Modules\Frontend\Http\Controllers\User;

use App\Modules\Base\Http\Controllers\UserCenter;
use App\Repositories\UserFollowRepository;
use Illuminate\Http\Request;

class UserFollowController extends UserCenter
{

    protected $userFollow;

    public function __construct(UserFollowRepository $userFollow)
    {
        parent::__construct();

        $this->userFollow = $userFollow;
    }

    /**
     * 我关注的
     *
     * @param Request $request
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Throwable
     */
    public function lists(Request $request)
    {
        $type = $request->input('type', 1); // 类型 1-关注用户
        $where[] = ['user_follow.user_id', $this->user_id];
        $where[] = ['user_follow.type', $type];

        $condition = [
            'join' => [
                [
                    'join_table' => 'user',
                    'join_first' => 'user_follow.target_id',
                    'join_operator' => '=',
                    'join_second' => 'user.user_id',
                    'join_type' => 'left',
                    'join_where' => false,
                ]
            ],
            'where' => $where,
            'sortname' => 'user_follow.follow_id',
            'sortorder' => 'desc',
            'field' => [
                'user_follow.*', 'user.nickname', 'user.headimg']
        ];
        list($list, $total) = $this->userFollow->getList($condition);
        if ($list->isNotEmpty()) {
            foreach ($list as $item) {
                $item->headimg = get_image_url($item->headimg, 'headimg');
                $item->is_followed = $this->userFollow->checkIsFollowed($this->user_id, $item->target_id);
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
     * 我的粉丝
     *
     * @param Request $request
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Throwable
     */
    public function fansList(Request $request)
    {
        $type = $request->input('type', 1); // 类型 1-关注用户
        $where[] = ['user_follow.target_id', $this->user_id];
        $where[] = ['user_follow.type', $type];

        $condition = [
            'join' => [
                [
                    'join_table' => 'user',
                    'join_first' => 'user_follow.user_id',
                    'join_operator' => '=',
                    'join_second' => 'user.user_id',
                    'join_type' => 'left',
                    'join_where' => false,
                ]
            ],
            'where' => $where,
            'sortname' => 'user_follow.follow_id',
            'sortorder' => 'desc',
            'field' => [
                'user_follow.*', 'user.nickname', 'user.headimg']
        ];
        list($list, $total) = $this->userFollow->getList($condition);
        if ($list->isNotEmpty()) {
            foreach ($list as $item) {
                $item->headimg = get_image_url($item->headimg, 'headimg');
                $item->is_followed = $this->userFollow->checkIsFollowed($this->user_id, $item->user_id);
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
     * 关注/取消关注
     *
     * @param Request $request
     * @return array
     */
    public function toggle(Request $request)
    {
        $type = $request->input('type', 1);
        $target_id = $request->input('target_id', 0);

        if ($type == 1) { // 用户
            if ($this->userFollow->checkIsFollowed($this->user_id, $target_id, $type)) {
                // 取消关注
                $msg = '取消关注';
            } else {
                // 关注
                $msg = '关注';
            }
            $ret = $this->userFollow->toggle($this->user_id, $target_id, $type);
        } else {
            // 其他类型 ...

            $ret = 1;
            $msg = '关注';
        }
        if ($ret === false) {
            // 失败
            return result(-1, [], $msg . '失败');
        }
        // 成功
        return result(0, ['result' => $ret], $msg . '成功');
    }
}