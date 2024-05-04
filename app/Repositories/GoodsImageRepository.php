<?php

namespace App\Repositories;


use App\Models\GoodsImage;
use App\Models\GoodsSku;
use App\Models\GoodsSpec;
use Illuminate\Support\Facades\DB;

class GoodsImageRepository
{
    use BaseRepository;

    protected $model;


    public function __construct()
    {
        $this->model = new GoodsImage();
    }

    public function addGoodsImage($postGoodsImage, $goods_id)
    {
        DB::beginTransaction();
        try {

            if (isset($postGoodsImage['default'])) {
                // 商品无规格
                // 删除原来的图片
                $this->model->where([['goods_id',$goods_id], ['spec_id', 0]])->delete();
                $imageInsert = $postGoodsImage['default'];
                foreach ($imageInsert as &$item) {
                    $item['goods_id'] = $goods_id;
                }
                $this->model->addAll($imageInsert);

                // 更新商品SKU表图片
                GoodsSku::where('goods_id', $goods_id)
                    ->where('spec_ids', '=', null)
                    ->where('checked', 1)
                    ->update([
                        'sku_image' => current($imageInsert)['path'],
                        'sku_images' => implode('|', array_column($imageInsert,'path'))
                    ]);
            } else {
                // 商品有规格
                foreach ($postGoodsImage as $spec_id=>$item) {
                    // 删除原来的图片
                    $this->model->where([['goods_id',$goods_id], ['spec_id', $spec_id]])->delete();
                    $imageInsert = [];
                    foreach ($item as $k=>$v) {
                        $imageInsert[] = [
                            'path' => $v['path'],
                            'goods_id' => $goods_id,
                            'spec_id' => $spec_id,
                            'is_default' => $k == 0 ? 1 : 0,
                            'sort' => $k+1
                        ];
                    }
                    $this->model->addAll($imageInsert);

//                    dd(GoodsSku::where('goods_id', $goods_id)
//                        ->where('spec_ids', 'like', "%|{$spec_id}")
//                        ->orWhere('spec_ids', 'like', "{$spec_id}|%")
////                        ->whereRaw("FIND_IN_SET({$spec_id},spec_ids)")
//                        ->where('checked', 1)->count());
                    // 更新商品SKU表图片
                    GoodsSku::where('goods_id', $goods_id)
                        ->where('spec_ids', 'like', "%|{$spec_id}")
                        ->orWhere('spec_ids', 'like', "{$spec_id}|%")
                        ->orWhere('spec_ids', '=', $spec_id)
//                        ->whereRaw("FIND_IN_SET({$spec_id},spec_ids)")
                        ->where('checked', 1)
                        ->update([
                            'sku_image' => current($item)['path'],
                            'sku_images' => implode('|', array_column($item,'path'))
                    ]);
                }
            }

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();//事务回滚
            echo $e->getMessage();
            echo $e->getCode();
            return false;
        }



    }

    /**
     * 获取商品图片列表
     * 以spec_id为键名
     *
     * @param $goods_id
     * @return mixed
     */
    public function getGoodsImages($goods_id)
    {
        $goodsSpecs = GoodsSpec::where('goods_id', $goods_id)->select(['spec_id'])->get()->toArray();
        $list = [];
        if (!empty($goodsSpecs)) { // 有规格
            foreach ($goodsSpecs as $v) {
                $goodsImages = GoodsImage::where([['goods_id',$goods_id],['spec_id',$v['spec_id']]])->orderBy('sort','asc')->pluck('path')->toArray();
                if (empty($goodsImages)) {
                    $goodsImages = ["","","","",""];
                }
                $list[$v['spec_id']] = $goodsImages;
            }
        } else {
            // 无规格
            $goodsImages = GoodsImage::where([['goods_id',$goods_id],['spec_id',0]])->orderBy('sort','asc')->pluck('path')->toArray();
            if (empty($goodsImages)) {
                $goodsImages = ["","","","",""];
            }
            $list['default'] = $goodsImages;
        }

        return $list;
    }
}