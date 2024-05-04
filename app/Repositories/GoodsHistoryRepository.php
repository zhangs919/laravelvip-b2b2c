<?php

namespace App\Repositories;

use App\Models\Goods;
use App\Models\GoodsHistory;

class GoodsHistoryRepository
{
    use BaseRepository;

    protected $model;


    public function __construct()
    {
        $this->model = new GoodsHistory();
    }

    public function getList($condition = [], $column = '')
    {
        $data = $this->model->getList($condition, $column);

        if (!$data[0]->isEmpty()) {

            foreach ($data[0] as $key=>$value) {
                $goods_info = Goods::where('goods_id',$value->goods_id)->select(['goods_price','goods_name','goods_image'])->first();
                if (!empty($goods_info)) {
					$value->goods_price = $goods_info['goods_price'];
					$value->goods_name = $goods_info['goods_name'];
					$value->goods_image = $goods_info['goods_image'];
				}
            }
        }
        return $data;
    }

    /**
     * 添加用户浏览记录
     *
     * @param $user_id
     * @param $goods
     */
    public function addHistoryLog($user_id, $goods)
    {
        $record = $this->model->where([['user_id',$user_id],['goods_id',$goods['goods_id']]])->first();
        if (!empty($record)) {
            $this->model->where([['user_id',$user_id], ['goods_id',$goods['goods_id']]])->update(['created_at'=>date('Y-m-d H:i:s', time()), 'look_time' => time(),  'look_count' => $record->look_count+1]);
        } else {
            $history = [
                'user_id'=>$user_id,
                'goods_id'=>$goods['goods_id'],
                'cat_id' =>$goods['cat_id'],
                'cat_id1' =>$goods['cat_id1'],
                'cat_id2' =>$goods['cat_id2'],
                'cat_id3' =>$goods['cat_id3'],
                'history_price' => $goods['goods_price'],
                'look_time' => time(),
                'look_count' => 1
            ];
            $this->store($history);
        }
    }

}
