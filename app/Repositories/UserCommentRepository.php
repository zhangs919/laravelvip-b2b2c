<?php


namespace App\Repositories;


use App\Models\Article;
use App\Models\UserComment;
use App\Services\Tree;
use Illuminate\Support\Facades\DB;

class UserCommentRepository
{
    use BaseRepository;

    protected $model;
    protected $tree;


    public function __construct()
    {
        $this->model = new UserComment();
        $this->tree = new Tree();
    }

    public function getList($condition = [], $column = '', $toTree = false)
    {
        $data = $this->model->getList($condition, $column);

        if (!empty($data[0]) && $toTree) {
            // 是否转换为树形结构
            $list = [];
            foreach ($data[0] as $key=>$item) {
                $item->article_thumb = !empty($item->article_thumb) ? get_image_url($item->article_thumb) : '';
                $item->created_at_format = out_put_time(strtotime($item->created_at));
                if (!empty($item->user)) {
                    $item->user->headimg = get_image_url($item->user->headimg, 'headimg');
                }
                $list[$key] = $item->toArray();
            }
            $data[0] = $this->tree->list_to_tree($list, 'comment_id', 'pid', 'children');
        }
        return $data;
    }

    /**
     * 获取评论数量
     *
     * @param int $userId 会员id
     * @param int $targetId 目标ID
     * @param int $type 类型 1-文章点赞
     * @return mixed
     */
    public function getUserCommentCount($userId, $targetId = 0, $type = 1)
    {
        $where = [['type', $type]];
        if ($userId) {
            $where[] = ['user_id', $userId];
        }
        if ($targetId) {
            $where[] = ['target_id', $targetId];
        }
        $count = UserComment::where($where)->count();
        return $count;
    }

    /**
     * 发布评论
     *
     * @param $userId
     * @param $params
     * @return User|false
     * @throws \Exception
     */
    public function comment($userId, $params)
    {
        DB::beginTransaction();
        try {
            // 验证数据是否存在
            switch ($params['type']) {
                case 1:
                    $exist = Article::where('article_id', $params['target_id'])->first();
                    if (empty($exist)) {
                        throw new \Exception('数据不存在');
                    }
                    break;

                default:
                    break;
            }
            $insert = [];
            $insert['user_id'] = $userId;
            $insert['pid'] = $params['pid'];
            $insert['type'] = $params['type'];
            $insert['target_id'] = $params['target_id'];
            $insert['content'] = $params['content'];
            $result = $this->store($insert);
            // 返回

            DB::commit();
            return $result;
        } catch (\Exception $e) {
            DB::rollback();//事务回滚
//            echo $e->getMessage();
//            echo $e->getCode();
            throw new \Exception($e->getMessage());
        }
    }
}