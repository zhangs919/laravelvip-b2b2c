<?php

// +----------------------------------------------------------------------
// | laravelvip 乐融沃B2B2C商城系统
// +----------------------------------------------------------------------
// | Copyright (c) 2017-2027 http://www.laravelvip.com All rights reserved.
// +----------------------------------------------------------------------
// | Notice: This code is not open source, it is strictly prohibited
// |         to distribute the copy, otherwise it will pursue its
// |         legal responsibility.
// +----------------------------------------------------------------------
// | 版权所有 2015-2027 云南乐融沃网络科技有限公司，并保留所有权利。
// | 网站地址: http://www.laravelvip.com
// +----------------------------------------------------------------------
// | 这不是一个自由软件！禁止拷贝本软件副本，否则将追究其法律责任！
// | 如需使用，请移步官网购买正版授权。
// +----------------------------------------------------------------------
// | Author: 雲溪荏苒 <290648237@qq.com>
// | Date:2018-08-10
// | Description:友情链接
// +----------------------------------------------------------------------

namespace App\Repositories;

use App\Models\Attribute;
use App\Models\Goods;
use App\Models\GoodsImage;
use App\Models\MultiStore;
use App\Models\MultiStoreGoods;
use App\Models\MultiStoreGoodsSku;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class MultiStoreGoodsRepository
{
    use BaseRepository;

    protected $model;


    public function __construct()
    {
        $this->model = new MultiStoreGoods();
    }

    public function addGoods($storeId, $goodsId)
    {
        // key: update:multistore:goods:relation:396
        // type: 1
        // store_id: 396
        // group_id: 0
        // select_goods_ids: 71764,71765,72154,72174,72176,
        // add_goods_ids: 72176
        // remove_goods_ids:
        // related_goods_type: 4 1-店铺全部商品 2-店铺出售中商品 3-店铺已下架商品 4-店铺指定商品 根据不同类型条件来筛选商品添加到门店中
        $goods = Goods::where('goods_id', $goodsId)->with(['goodsSku'])->first();
        if (empty($goods)) {
            return false;
        }
        // 验证是否已添加
        if ($this->model->where([['store_id',$storeId],['goods_id',$goodsId]])->count()) {
            return false;
        }

        DB::beginTransaction();
        try {
            $ret = $this->model->create([
                'shop_id' => $goods->shop_id,
                'store_id' => $storeId,
                'goods_id' => $goodsId,
                'store_goods_price' => $goods->goods_price // 默认为店铺价格
            ]);
            $skuList = [];
            foreach ($goods->goodsSku as $item) {
                $skuList[] = [
                    'shop_id' => $goods->shop_id,
                    'store_id' => $storeId,
                    'store_goods_id' => $ret->id,
                    'goods_id' => $goodsId,
                    'sku_id' => $item->sku_id,
                    'store_sku_price' => $item->goods_price // 默认为店铺价格
                ];
            }
            $ret->multiStoreGoodsSku()->createMany($skuList);

            MultiStore::where('store_id', $storeId)->increment('goods_count');
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack(); // 事务回滚
            echo $e->getMessage();
            echo $e->getCode();
            return false;
        }
    }

    /**
     * 删除门店商品
     * @param $storeId
     * @param string|int $goodsIds
     * @return bool
     * @throws \Exception
     */
    public function deleteGoods($storeId, $goodsIds)
    {
        if (empty($goodsIds)) {
            return false;
        }
        if (!is_array($goodsIds)) {
            $goodsIds = explode(',', $goodsIds);
        }

        DB::beginTransaction();
        try {

            MultiStoreGoods::where('store_id', $storeId)->whereIn('goods_id', $goodsIds)->delete();
            MultiStoreGoodsSku::where('store_id', $storeId)->whereIn('goods_id', $goodsIds)->delete();
            MultiStore::where('store_id', $storeId)->decrement('goods_count', count($goodsIds));
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack(); // 事务回滚
            echo $e->getMessage();
            echo $e->getCode();
            return false;
        }

    }

    /**
     * 更新状态字段
     * @param $storeId int 门店ID
     * @param $spuId int 商品SPU ID
     * @param $statusField string 字段名称
     */
    public function changeState($storeId, $spuId, $statusField)
    {
        $info = $this->model->where('store_id', $storeId)->where('goods_id', $spuId)->first();
        $info->$statusField = $info->$statusField ? 0 : 1; // 取反
        $info->save();

        return $info->$statusField ?? false;
    }

    /**
     * 批量更新状态字段
     * @param $storeId int 门店ID
     * @param $shopId int 店铺ID
     * @param $status int 状态值
     * @param $spuIds array|int 商品SPU ID 
     * @param $statusField string 字段名称
     */
    public function batchChangeState($storeId, $shopId, $spuIds, $status, $statusField)
    {
        $query = $this->model->where([['store_id', $storeId], ['shop_id', $shopId]]);
        if (is_array($spuIds)) {
            // 如果是数组 批量处理
            $query->whereIn('goods_id', $spuIds);
        } else {
            $query->where('goods_id', $spuIds);
        }

        $ret = $query->update([$statusField => $status]);
        return $ret;
    }

    /**
     * 编辑商品库存、价格
     */
    public function editGoods($post)
    {
        // $store_id = $request->post('store_id');
        // $shop_id = $request->post('shop_id');
        // $goods_id = $request->post('goods_id'); // 商品id
        // $price = $request->post('price'); // 提交的要保存的价格数据
        // $number = $request->post('number'); // 提交的要保存的库存数据

        // price[0][sku_id]: 74374
        // price[0][store_sku_price]: 0.01
        // number[0][sku_id]: 74374
        // number[0][store_sku_number]: 2
        // goods_id: 72174
        // shop_id: 309
        // store_id: 396
        // 处理批量


        DB::beginTransaction();
        try {
            $price = $post['price'];
            $number = $post['number'];

            $this->model
                ->where([['store_id', $post['store_id']], ['shop_id', $post['shop_id']],['goods_id', $post['goods_id']]])
                ->update(['store_goods_price' => Arr::first($price)['store_sku_price'], 'store_goods_number'=>array_sum(array_column($number, 'store_sku_number'))]); // 取sku中第一个价格和库存

            // 更新门店商品SKU
            foreach($price as $key=>$item) {
                $skuUpdate = [
                    'store_sku_price' => $item['store_sku_price'],
                    'store_sku_number' => $number[$key]['store_sku_number'],
                ];
                MultiStoreGoodsSku::where([['store_id', $post['store_id']], ['shop_id', $post['shop_id']],['goods_id', $post['goods_id']],['sku_id',$item['sku_id']]])->update($skuUpdate);
            }

            DB::commit();
            return true;
        }catch (\Exception $e){
            DB::rollback();//事务回滚
            echo $e->getMessage();
            echo $e->getCode();
            return false;
        }
    }

    /**
     * 批量编辑商品库存、价格
     */
    public function batchEditGoods($post, &$index, &$count)
    {
        // $store_id = $request->post('store_id');
        // $shop_id = $request->post('shop_id');
        // $goods_id = $request->post('goods_id'); // 商品id
        // $price = $request->post('price'); // 提交的要保存的价格数据
        // $number = $request->post('number'); // 提交的要保存的库存数据

        // price[0][sku_id]: 74374
        // price[0][spu_id]: 743724
        // price[0][store_sku_price]: 0.01
        // number[0][sku_id]: 74374
        // number[0][store_sku_number]: 2
        // goods_id: 72174
        // shop_id: 309
        // store_id: 396
        // 处理批量
        $count = explode(',', trim($post['spu_ids'], ','));
        $price = json_decode($post['price'],true);
        $number = json_decode($post['number'],true);
        foreach ($price as $key=>$item) {

            $postData[$item['spu_id']]['store_id'] = $post['store_id'];
            $postData[$item['spu_id']]['shop_id'] = $post['shop_id'];
            $postData[$item['spu_id']]['goods_id'] = $item['spu_id'];
            $postData[$item['spu_id']]['price'][$item['sku_id']] = [
                'sku_id' =>$item['sku_id'],
                'store_sku_price' =>$item['store_sku_price']
            ];
            $postData[$item['spu_id']]['number'][$item['sku_id']] = [
                'sku_id' =>$item['sku_id'],
                'store_sku_number' =>$number[$key]['store_sku_number']
            ];
        }
        $postData = array_values($postData);
        foreach ($postData as &$item) {

            $item['price'] = array_values($item['price']);
            $item['number'] = array_values($item['number']);

            $this->editGoods($item);
            $index++;
        }
    }

    /**
     * 获取门店已选择的商品
     * @param $storeId int 门店id
     */
    public function getSelectedGoods($storeId)
    {
        $list = $this->model->where('store_id', $storeId)->select(['goods_id'])->get()->toArray();
        return $list;
    }

    /**
     * 门店关联商品
     * @param $post
     * @param $index
     * @throws \Exception
     */
    public function storeRelatedGoods($post, &$index, &$count)
    {
        // key: update:multistore:goods:relation:396
        // type: 1
        // store_id: 396
        // group_id: 0
        // select_goods_ids: 71764,71765,72154,72174,72176,
        // add_goods_ids: 72176
        // remove_goods_ids:
        // related_goods_type: 4

        $add_goods_ids = explode(',', trim($post['add_goods_ids'], ',')); // 添加
        $remove_goods_ids = explode(',', trim($post['remove_goods_ids'], ',')); // 移除
        $count = count($add_goods_ids) + count($remove_goods_ids);
        if (!empty($add_goods_ids)) {
            foreach ($add_goods_ids as $goods_id) {
                $this->addGoods($post['store_id'], $goods_id);
                $index++;
            }
        }
        if (!empty($remove_goods_ids)) {
            foreach ($remove_goods_ids as $goods_id) {
                $this->deleteGoods($post['store_id'], $goods_id);
                $index++;
            }
        }
    }

    /**
     * 获取门店商品sku列表
     *
     * @param $store_id
     * @param $goods_id
     * @return array|false|string
     */
    public function getSkuList($storeGoods)
    {
        if (empty($storeGoods)) {
            return false;
        }
        $resData = [];
        foreach ($storeGoods->multiStoreGoodsSku as $item) {
            $goodsSku = $item->goodsSku;
            $spec_ids_str = $goodsSku->spec_ids;
            $spec_vids_str = $goodsSku->spec_vids;
            $spec_names_str = $goodsSku->spec_names;

            if (!empty($spec_ids_str)) {
                $resData[] = [
                    'sku_id' => $item->sku_id,
                    'spec_ids' => $spec_ids_str,
                    'spec_vids' => $spec_vids_str,
                    'goods_price' => $goodsSku->goods_price,
                    'goods_number' => $goodsSku->goods_number,
                    'spec_names' => $spec_names_str,
                    'goods_id' => $item->goods_id,
                    'checked' => $goodsSku->checked,
                    'store_sku_price' => $item->store_sku_price,
                    'store_sku_number' => $item->store_sku_number,
                    'stock_code' => null
                ];
            } else {
                $resData[] = [
                    'sku_id' => $item->sku_id,
                    'spec_ids' => null,
                    'spec_vids' => null,
                    'goods_price' => $goodsSku->goods_price,
                    'goods_number' => $goodsSku->goods_number,
                    'spec_names' => null,
                    'goods_id' => $item->goods_id,
                    'checked' => $goodsSku->checked,
                    'store_sku_price' => $item->store_sku_price,
                    'store_sku_number' => $item->store_sku_number,
                    'stock_code' => ''
                ];
            }
        }

        return $resData;
    }

    /**
     * 获取商品规格
     * 适用：商家端-编辑门店商品
     * @param $goods_info
     * @return array
     */
    public function getGoodsSpecList($goods_info)
    {
        $goods_id = $goods_info->goods_id;
        $cat_id = $goods_info->cat_id;

        $where[] = ['goods_id',$goods_id];
        $where[] = ['is_checked',1];
        $condition = [
            'where' => $where,
            'limit'=>0,
            'sortname' => 'spec_sort',
            'sortorder'=>'asc'
        ];
        list($data, $total) = (new GoodsSpecRepository())->getList($condition, 'attr_id');
        $resData = [];
        if (empty($data)) {
            $resData[] = [
                'attr_id' => 0,
                'attr_name' => '规格',
                'is_default' => 1,
                'attr_values' => [
                    [
                        'attr_vid' => null,
                        'spec_id' => null,
                        'spec_vid' => null,
                        'attr_value' => '无',
                    ]
                ]
            ];
            return $resData;
        }

        $i = 0;
        if (!empty($data)) {
            foreach ($data as $attr_id=>$item) {
                $attr_name = Attribute::where('attr_id', $attr_id)->value('attr_name');

                $attr_values = [];
                foreach ($item as $avKey=>$av) {
                    $spec_image = '';
                    if ($i == 0) {
                        // 规格缩略图
                        $spec_image = GoodsImage::where([['goods_id', $goods_id], ['spec_id', $av->spec_id]])->orderBy('sort', 'asc')->pluck('path')->toArray();
                        $spec_image = !empty($spec_image) ? $spec_image[0] : '';
                    }
                    $attr_values[$av->spec_id] = [
                        'spec_id' => $av->spec_id,
                        'spec_image' => $spec_image,
                        'attr_vid' => $av->attr_vid,
                        'attr_value' => $av->attr_value,
                        'attr_desc' => $av->attr_desc,
                    ];
                }
                $resData[] = [
                    'cat_id' => $cat_id,
                    'attr_id' => $attr_id,
                    'attr_sort' => $i,
                    'attr_name' => $attr_name,
                    'is_default' => $i == 0 ? 1 : 0,
                    'attr_values' => $attr_values
                ];
                $i++;
            }
        }
        return $resData;
    }
}