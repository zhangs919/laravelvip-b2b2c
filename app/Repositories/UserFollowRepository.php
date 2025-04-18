<?php


namespace App\Repositories;


use App\Models\User;
use App\Models\UserFollow;
use Illuminate\Support\Facades\DB;

class UserFollowRepository
{
    use BaseRepository;

    protected $model;


    public function __construct()
    {
        $this->model = new UserFollow();
    }

    /**
     * 获取会员关注数量
     *
     * @param int $userId 会员id
     * @param int $type 关注类型 1-关注用户
     * @return mixed
     */
    public function getUserFollowCount($userId, $type = 1)
    {
        $count = UserFollow::where([['user_id', $userId], ['type', $type]])->count();
        return $count;
    }

    /**
     * 获取会员粉丝数量
     *
     * @param int $userId 会员id
     * @param int $type 关注类型 1-关注用户
     * @return mixed
     */
    public function getUserFansCount($userId, $type = 1)
    {
        $count = UserFollow::where([['target_id', $userId], ['type', $type]])->count();
        return $count;
    }

    /**
     * 检查是否已关注
     *
     * @param $userId
     * @param $targetId
     * @param int $type
     * @return bool
     */
    public function checkIsFollowed($userId, $targetId, $type = 1)
    {
        $where[] = ['user_id', $userId];
        $where[] = ['type', $type];
        $where[] = ['target_id', $targetId];

        $res = $this->model->where($where)->count();
        if ($res > 0) {
            // 已关注
            return 1;
        } else {
            // 未关注
            return 0;
        }
    }

    /**
     * 关注/取消关注
     *
     * @param $userId
     * @param $targetId
     * @param int $type
     * @return false|int
     * @throws \Exception
     */
    public function toggle($userId, $targetId, $type = 1)
    {
        DB::beginTransaction();
        try {
            // 验证数据是否存在
            switch ($type) {
                case 1:
                    $exist = User::where('user_id', $targetId)->first();
                    if (empty($exist)) {
                        throw new \Exception('数据不存在');
                    }
                    break;

                default:
                    break;
            }
            if ($this->checkIsFollowed($userId, $targetId, $type)) {
                // 取消关注
                $where[] = ['user_id', $userId];
                $where[] = ['type', $type];
                $where[] = ['target_id', $targetId];
                $this->model->where($where)->delete();
                $result = 0;
            } else {
                // 关注
                $insert['user_id'] = $userId;
                $insert['type'] = $type;
                $insert['target_id'] = $targetId;
                $this->store($insert);
                $result = 1;
            }
            // 返回

            DB::commit();
            return $result;
        } catch (\Exception $e) {
            DB::rollback();//事务回滚
//            echo $e->getMessage();
//            echo $e->getCode();
            return false;
        }
    }
}