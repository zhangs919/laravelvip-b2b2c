<?php

namespace App\Repositories;

use App\Models\WeixinMaterial;
use App\Models\WeixinMaterialGroup;
use Illuminate\Support\Facades\DB;

class WeixinMaterialGroupRepository
{
    use BaseRepository;

    protected $model;

    protected $weixinMaterial;


    public function __construct()
    {
        $this->model = new WeixinMaterialGroup();
        $this->weixinMaterial = new WeixinMaterialRepository();
    }

    /**
     * 获取图文列表
     *
     * @param array $condition
     * @return array
     */
    public function getList($condition = [])
    {
        $data = $this->model->getList($condition);
        if (!empty($data[0])) {
            foreach ($data[0] as $key=>$value) {
                // 查询图文素材列表
                $value->items = $this->getWeixinMaterialList($value->article_id);
            }
        }

        return $data;
    }

    private function getWeixinMaterialList($articleIds) {
        if (!$articleIds) {
            return [];
        }
        $articleIds = json_decode($articleIds, true);
        $articleIds = is_array($articleIds) ? $articleIds : [$articleIds];
        return WeixinMaterial::whereIn('id', $articleIds)
            ->select(['title','author','cover','abstract','content','link','created_at'])
            ->get();
    }

    public function getInfo($id)
    {
        $info = $this->getById($id);
        // 查询图文素材列表
        $info->items = $this->getWeixinMaterialList($info->article_id);

        return $info;
    }

    /**
     * 插入图文数据
     *
     * @param $post
     * @param $type integer 图文类型 0-单图文 1-多图文
     * @return bool
     */
    public function addData($post, $type = 0)
    {
        try {
            DB::beginTransaction();

            if ($type == 1) { // 多图文
                $weixinMaterialInsert = array_column($post, 'MaterialModel');
                $articleIds = [];
                foreach ($weixinMaterialInsert as $item) {
                    $articleIds[] = WeixinMaterial::insertGetId($item);
                }
                $articleIds = json_encode($articleIds);
            } else { // 单图文
                // 插入素材文章表
                $weixinMaterialInsert = $post;
                $ret = $this->weixinMaterial->store($weixinMaterialInsert);

                // 插入素材表
                $weixinMaterialGroupInsert = [
                    'article_id' => $ret->id,
                    'type' => 0 // 单图文
                ];
                $this->store($weixinMaterialGroupInsert);

                $articleIds = $ret->id;
            }

            // 插入素材表
            $weixinMaterialGroupInsert = [
                'article_id' => $articleIds,
                'type' => $type // 图文类型
            ];
            $this->store($weixinMaterialGroupInsert);

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();
            return false;
        }
    }

    /**
     * 更新图文数据
     *
     * @param $id
     * @param $post
     * @param $type integer 图文类型 0-单图文 1-多图文
     * @return bool
     */
    public function modifyData($id, $post, $type = 0)
    {

        try {
            DB::beginTransaction();

            if ($type == 1) { // 多图文
                // 先删除图文文章
                $oldArticleIds = $this->model->where('id', $id)->value('article_id');
                $oldArticleIds = json_decode($oldArticleIds, true);
                $this->weixinMaterial->batchDel($oldArticleIds);

                // 插入图文文章
                $weixinMaterialInsert = array_column($post, 'MaterialModel');
                $articleIds = [];
                foreach ($weixinMaterialInsert as $item) {
                    $articleIds[] = WeixinMaterial::insertGetId($item);
                }
                $articleIds = json_encode($articleIds);

                // 插入素材表
                $weixinMaterialGroupUpdate = [
                    'article_id' => $articleIds,
                    'type' => $type // 图文类型
                ];
                $this->update($id, $weixinMaterialGroupUpdate);
            } else { // 单图文
                // 更新素材文章表
                $wmCondition = [['id',$post['id']]];
                WeixinMaterial::where($wmCondition)->update($post);
            }

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();
            return false;
        }
    }
}