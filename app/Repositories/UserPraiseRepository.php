<?php


namespace App\Repositories;


use App\Models\Article;
use App\Models\UserPraise;
use Illuminate\Support\Facades\DB;

class UserPraiseRepository
{
    use BaseRepository;

    protected $model;


    public function __construct()
    {
        $this->model = new UserPraise();
    }

    /**
     * 获取会员点赞数量
     *
     * @param int $userId 会员id
     * @param int $targetId 目标ID
     * @param int $type 类型 1-文章点赞
     * @return mixed
     */
    public function getUserPraiseCount($userId, $targetId = 0, $type = 1)
    {
        $where = [['type', $type]];
        if ($userId) {
            $where[] = ['user_id', $userId];
        }
        if ($targetId) {
            $where[] = ['target_id', $targetId];
        }
        $count = UserPraise::where($where)->count();
        return $count;
    }

    /**
     * 检查是否已点赞
     *
     * @param $userId
     * @param $targetId
     * @param int $type
     * @return bool
     */
    public function checkIsPraiseed($userId, $targetId, $type = 1)
    {
        $where[] = ['user_id', $userId];
        $where[] = ['type', $type];
        $where[] = ['target_id', $targetId];

        $res = $this->model->where($where)->count();
        if ($res > 0) {
            // 已点赞
            return 1;
        } else {
            // 未点赞
            return 0;
        }
    }

    /**
     * 点赞/取消点赞
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
                    $exist = Article::where('article_id', $targetId)->first();
                    if (empty($exist)) {
                        throw new \Exception('数据不存在');
                    }
                    break;

                default:
                    break;
            }
            if ($this->checkIsPraiseed($userId, $targetId, $type)) {
                // 取消点赞
                $where[] = ['user_id', $userId];
                $where[] = ['type', $type];
                $where[] = ['target_id', $targetId];
                $this->model->where($where)->delete();
                $result = 0;
            } else {
                // 点赞
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