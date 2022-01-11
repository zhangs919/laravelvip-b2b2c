<?php

namespace App\Repositories;


use App\Models\Attribute;
use App\Models\AttrValue;
use App\Models\Brand;
use App\Models\BrandCategory;
use App\Models\CatAttribute;
use App\Models\Category;
use App\Models\Collect;
use App\Models\Contract;
use App\Models\Goods;
use App\Models\GoodsAttr;
use App\Models\GoodsCat;
use App\Models\GoodsHistory;
use App\Models\GoodsImage;
use App\Models\GoodsSku;
use App\Models\GoodsSpec;
use App\Models\Shop;
use App\Models\SpecAlias;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class GoodsRepository
{
    use BaseRepository;

    protected $model;

    protected $goodsSku;

    protected $categoryRep;

    protected $goodsHistoryRep;

    protected $shopQuestions;

    protected $goodsAttr;

    protected $goodsSpec;

    protected $specAlias;

    protected $collect;

    public function __construct()
    {
        $this->model = new Goods();
        $this->goodsSku = new GoodsSku();
        $this->categoryRep = new CategoryRepository();
        $this->goodsHistoryRep = new GoodsHistoryRepository();
        $this->shopQuestions = new ShopQuestionsRepository();
        $this->collect = new CollectRepository();

        $this->goodsAttr = new GoodsAttr();
        $this->goodsSpec = new GoodsSpec();
        $this->specAlias = new SpecAlias();
    }

    /******************************* 后端逻辑代码 *******************************/

    /**
     * @param array $condition
     * @param string $column
     * @param null $user_id
     * @return array
     */
    public function getList($condition = [], $column = '', $user_id = null)
    {
        $data = $this->model->getList($condition, $column);

//        if (!$data[0]->isEmpty()) {

//            foreach ($data[0] as $key=>$value) {
//                $value->shop_name = Shop::where('shop_id', $value->shop_id)->value('shop_name');
//                // 是否收藏商品
//                $value->is_collect = false;
//                if ($this->collect->checkIsCollected($user_id, 0, 0, $value->goods_id)) {
//                    // 已收藏
//                    $value->is_collect = true;
//                }
//            }
//        }
        return $data;
    }

    /**
     * 商家后台 新增商品
     *
     * @param $postData
     * @param int $shopId
     * @return User|bool
     */
    public function addGoods($postData, $shopId = 0)
    {
        $goodsInsert = $postData['GoodsModel'];

        DB::beginTransaction();
        try {

            // 1. 插入商品表
            $goodsInsert['shop_id'] = $shopId; // 店铺id
            $cat_arr = $this->categoryRep->getCatIds($goodsInsert['cat_id']);
            $goodsInsert['cat_id1'] = $cat_arr['cat_id1'];
            $goodsInsert['cat_id2'] = $cat_arr['cat_id2'];
            $goodsInsert['cat_id3'] = $cat_arr['cat_id3'];
            $goodsInsert['goods_unit'] = !empty($goodsInsert['goods_unit']) ? $goodsInsert['goods_unit'] : 0;
            $goodsInsert['shop_cat_ids'] = $postData['shop_cat_ids']; //!empty($postData['shop_cat_ids']) ? implode(',',$postData['shop_cat_ids']) : null; // todo
//            $goodsInsert['other_cat_ids'] = !empty($postData['other_cat_ids']) ? implode(',',$postData['other_cat_ids']) : null; // todo 暂时不确定什么意思
            $goodsInsert['contract_ids'] = serialize($goodsInsert['contract_ids']);
            $goodsInsert['mobile_desc'] = serialize($goodsInsert['mobile_desc']);
            $goodsInsert['other_attrs'] = serialize($postData['other_attrs']);  // 店铺自定义属性
            $goodsInsert['add_time'] = time();

            $goodsRet = $this->store($goodsInsert);

            // 4. 插入商品规格表 goods_spec
            if (!empty($postData['goods_specs'])) {
                foreach ($postData['goods_specs'] as $gsKey=>$item) {
                    $goodsSpecInsert = [
                        'goods_id' => $goodsRet->goods_id,
                        'attr_id' => $item['attr_id'],
                        'attr_vid' => $item['attr_vid'],
                        'cat_id' => $goodsInsert['cat_id'],
                        'attr_value' => $item['attr_vname'],
                        'attr_desc' => null,
                        'is_checked' => 1,
                        'spec_sort' => $gsKey
                    ];
                    $goodsSpec = new GoodsSpec();
                    $goodsSpec->fill($goodsSpecInsert);
                    $goodsSpec->save();
                }
            }

            // 2. 插入商品SKU表
            if (empty($postData['sku_list'])) {
                // 如果没有设置规格 则新增一条商品SKU信息
                $goodsSkuInsert = [
                    'goods_id' => $goodsRet->goods_id,
                    'market_price' => $goodsInsert['market_price'],
                    'goods_price' => $goodsInsert['goods_price'],
                    'goods_number' => $goodsInsert['goods_number'],
                    'warn_number' => $goodsInsert['warn_number'],
                    'goods_sn' => $goodsInsert['goods_sn'],
                    'goods_barcode' => $goodsInsert['goods_barcode'],
                    'goods_stockcode' => $goodsInsert['goods_stockcode'],
                    'is_spu' => 1 // 无规格商品 是SPU商品
                ];
                $goodsSku = new GoodsSku();
                $goodsSku->fill($goodsSkuInsert);
                $goodsSku->save();
            } else {
                // 如果设置了规格 在商品SKU表中新增所有规格的SKU信息
                foreach ($postData['sku_list'] as $skuKey=>$item) {

                    $item['goods_id'] = $goodsRet->goods_id;
                    // 商品规格id 和规格名称处理
                    $spec_ids = [];
                    $attr_vids = [];
                    $spec_names = [];
                    foreach ($item['specs'] as $s) {
                        $spec_ids[] = GoodsSpec::where([['goods_id', $goodsRet->goods_id], ['attr_vid', $s['attr_vid']]])->value('spec_id');
                        $attr_vids[] = $s['attr_vid'];
                        $attr_name = Attribute::where('attr_id', $s['attr_id'])->value('attr_name');
                        $attr_vname = $s['attr_vname'];
                        $spec_names[] = $attr_name.':'.$attr_vname;
                    }
                    $item['spec_ids'] = implode('|', $spec_ids);
                    $item['spec_vids'] = implode('|', $attr_vids);
                    $item['spec_names'] = implode(' ', $spec_names); // 规格键值对名称 attr_name 多个以空格分隔 格式：网络:4G 内存:32G 颜色:金色
                    if (empty($item['warn_number'])) {
                        $item['warn_number'] = 0;
                    }

                    $item['is_spu'] = 0; // 商品有规格 不是SPU商品

                    $goodsSku = new GoodsSku();
                    $goodsSku->fill($item);
                    $goodsSku->save();
                }
            }

            // 设置默认sku_id
            $default_sku_id = GoodsSku::where([['goods_id',$goodsRet->goods_id],['is_enable',1]])->select(['sku_id','goods_id'])->orderBy('sku_id', 'asc')->value('sku_id');
            // 更新商品表 sku_id 为goods_sku 第一个
            Goods::where('goods_id', $goodsRet->goods_id)->update(['sku_id'=>$default_sku_id]);


            // 3. 插入商品属性表 goods_attr
            if (!empty($postData['goods_attrs'])) {
                foreach ($postData['goods_attrs'] as $item) {
                    $item['goods_id'] = $goodsRet->goods_id;
                    $attr_info =  Attribute::where('attr_id', $item['attr_id'])->first();
                    $attr_vid = is_string($item['attr_vid']) ? [$item['attr_vid']] : $item['attr_vid']; // 如果是字符串 则放入数组中
                    if (empty($attr_vid)) {
                        continue;
                    }

                    // TODO attr_vname值获取异常 后面解决
                    $attr_vname = AttrValue::where('attr_id', $item['attr_id'])->whereIn('attr_vid', $attr_vid)->orderBy('attr_vsort', 'asc')->pluck('attr_vname')->toArray();
                    $item['attr_name'] = $attr_info->attr_name;
                    $item['attr_vid'] = serialize($attr_vid);
                    $item['attr_vname'] = serialize($attr_vname);
                    $goodsAttr = new GoodsAttr();
                    $goodsAttr->fill($item);
                    $goodsAttr->save();
                }
            }



            // 5. 插入商品规格别名表 spec_alias
            if (!empty($postData['spec_alias'])) {
                foreach ($postData['spec_alias'] as $item) {
                    $item['goods_id'] = $goodsRet->goods_id;
                    $specAlias = new SpecAlias();
                    $specAlias->fill($item);
                    $specAlias->save();
                }
            }

            // 6. 插入商品扩展分类表 goods_cat
            if (!empty($postData['other_cat_ids'])) {
                foreach ($postData['other_cat_ids'] as $item) {
                    $other_cat['goods_id'] = $goodsRet->goods_id;
                    $other_cat['cat_id'] = $item;
                    $goodsCat = new GoodsCat();
                    $goodsCat->fill($other_cat);
                    $goodsCat->save();
                }
            }


            DB::commit();
            return $goodsRet;
        }catch (\Exception $e){
            DB::rollback();//事务回滚
//            echo $e->getMessage();
//            echo $e->getCode();
            return false;
        }
    }

    /**
     * 商家后台 修改商品
     *
     * @param $postData
     * @param $goods_id
     * @return User|bool
     */
    public function modifyGoods($postData, $goods_id)
    {
        $goodsUpdate = $postData['GoodsModel'];

        DB::beginTransaction();
        try {

            // 1. 更新商品表
            $cat_arr = $this->categoryRep->getCatIds($goodsUpdate['cat_id']);
            $goodsUpdate['cat_id1'] = $cat_arr['cat_id1'];
            $goodsUpdate['cat_id2'] = $cat_arr['cat_id2'];
            $goodsUpdate['cat_id3'] = $cat_arr['cat_id3'];
            $goodsUpdate['goods_unit'] = !empty($goodsUpdate['goods_unit']) ? $goodsUpdate['goods_unit'] : 0;

            $goodsUpdate['shop_cat_ids'] = $postData['shop_cat_ids']; // todo
//            $goodsUpdate['other_cat_ids'] = implode(',',$postData['other_cat_ids']); // todo

            $goodsUpdate['contract_ids'] = serialize($goodsUpdate['contract_ids']);
            $goodsUpdate['mobile_desc'] = serialize($goodsUpdate['mobile_desc']);
            $goodsUpdate['other_attrs'] = serialize($postData['other_attrs']);  // 店铺自定义属性
            $goodsUpdate['last_time'] = time();
            if ($goodsUpdate['goods_freight_type'] == 0) {
                $goodsUpdate['freight_id'] = 0;
            }

            $goodsRet = $this->update($goods_id, $goodsUpdate);

            // 4. 插入商品规格表 goods_spec
            if (!empty($postData['goods_specs'])) {

                // 将该商品所有spec is_checked 状态改为0
                GoodsSpec::where('goods_id', $goods_id)->update(['is_checked' => 0]);

                foreach ($postData['goods_specs'] as $gsKey=>$item) {
                    // 检查是否存在
                    $goodsSpecCondition = [['goods_id', $goods_id], ['attr_id', $item['attr_id']], ['attr_vid', $item['attr_vid']]];
                    $isExist = GoodsSpec::where($goodsSpecCondition)->get()->toArray();
                    if (count($isExist) > 0) {
                        // 存在 更新数据
                        $goodsSpecUpdate = [
                            'goods_id' => $goods_id,
                            'attr_id' => $item['attr_id'],
                            'attr_vid' => $item['attr_vid'],
                            'attr_value' => $item['attr_vname'],
                            'attr_desc' => null,
                            'is_checked' => 1,
                            'spec_sort' => $gsKey
                        ];
                        GoodsSpec::where($goodsSpecCondition)->update($goodsSpecUpdate);
                    } else {
                        // 不存在 新增数据
                        $goodsSpecInsert = [
                            'goods_id' => $goods_id,
                            'attr_id' => $item['attr_id'],
                            'attr_vid' => $item['attr_vid'],
                            'cat_id' => $goodsUpdate['cat_id'],
                            'attr_value' => $item['attr_vname'],
                            'attr_desc' => null,
                            'is_checked' => 1,
                            'spec_sort' => $gsKey
                        ];
                        $goodsSpec = new GoodsSpec();
                        $goodsSpec->fill($goodsSpecInsert);
                        $goodsSpec->save();
                    }
                }
            }

            // 2. 插入/更新商品SKU表
            if (!empty($postData['sku_list'])) {

                // 将该商品所有sku checked状态改为0
                GoodsSku::where('goods_id', $goods_id)->update(['is_enable' => 0]);

                $postData['sku_list'] = array_filter($postData['sku_list']);
                // 如果设置了规格 在商品SKU表中新增/更新规格的SKU信息
                foreach ($postData['sku_list'] as $item) {
                    $attr_vids = array_column($item['specs'], 'attr_vid'); // 规格值id数组
                    $spec_ids = GoodsSpec::where('goods_id', $goods_id)
                        ->whereIn('attr_vid', $attr_vids)->pluck('spec_id')->toArray();

                    $item['goods_id'] = $goods_id;
                    $item['is_enable'] = 1; // 默认将商品sku选中

                    // 商品规格id 和规格名称处理
                    $spec_names = [];
                    foreach ($item['specs'] as $s) {
                        $attr_name = Attribute::where('attr_id', $s['attr_id'])->value('attr_name');
                        $attr_vname = $s['attr_vname'];
                        $spec_names[] = $attr_name.':'.$attr_vname;
                    }
                    $item['spec_ids'] = implode('|', $spec_ids);
                    $item['spec_vids'] = implode('|', $attr_vids);
                    $item['spec_names'] = implode(' ', $spec_names); // 规格键值对名称 attr_name 多个以空格分隔 格式：网络:4G 内存:32G 颜色:金色
                    if (empty($item['warn_number'])) {
                        $item['warn_number'] = 0;
                    }

                    // 检查该规格是否存在 如果存在则更新 否则新增
                    $goodsSkuCondition = [['goods_id', $goods_id], ['spec_ids', $item['spec_ids']]];
                    $isExist = GoodsSku::where($goodsSkuCondition)->get()->toArray();

                    unset($item['specs']);

                    if (count($isExist) > 0) {
                        // 已经存在 更新
                        GoodsSku::where($goodsSkuCondition)->update($item);
                    } else {
                        // 不存在 新增
                        $goodsSku = new GoodsSku();
                        $goodsSku->fill($item);
                        $goodsSku->save();
                    }
                }
            }

            $default_sku_id = GoodsSku::where([['goods_id',$goods_id],['is_enable',1]])->select(['sku_id','goods_id'])->orderBy('sku_id', 'asc')->value('sku_id');
            // 更新商品表 sku_id 为goods_sku 第一个
            Goods::where('goods_id', $goods_id)->update(['sku_id'=>$default_sku_id]);


            // 3. 插入商品属性表 goods_attr
            if (!empty($postData['goods_attrs'])) {
                // 删除原有的商品属性
                GoodsAttr::where('goods_id', $goods_id)->delete();
                // 插入新的数据
                foreach ($postData['goods_attrs'] as $item) {
                    $item['goods_id'] = $goods_id;
                    $attr_info =  Attribute::where('attr_id', $item['attr_id'])->first();
                    $attr_vid = is_string($item['attr_vid']) ? [$item['attr_vid']] : $item['attr_vid']; // 如果是字符串 则放入数组中

                    if (empty($attr_vid)) {
                        continue;
                    }

                    // TODO attr_vname值获取异常 后面解决
                    $attr_vname = AttrValue::where('attr_id', $item['attr_id'])->whereIn('attr_vid', $attr_vid)->orderBy('attr_vsort', 'asc')->pluck('attr_vname')->toArray();
                    // 属性样式 attr_style 0多选 1单选 2文本
//                    $attr_vname = '';
//                    if ($attr_info->attr_style == 2) {
//                        // 文本
//                        $attr_vname = [$attr_vid];
//                    } elseif($attr_info->attr_style == 1) {
//                        // 单选
////                        $attr_condition = [
////                            ['attr_id', $item['attr_id']],
////                            ['attr_vid', $attr_vid],
////                        ];
//                        $attr_vname = AttrValue::where('attr_id', $item['attr_id'])->whereIn('attr_vid', $attr_vid)->orderBy('attr_vsort', 'asc')->pluck('attr_vname')->toArray();
////                        $attr_vname = AttrValue::where($attr_condition)->orderBy('attr_vsort', 'asc')->pluck('attr_vname');
//                        $attr_vname = $attr_vname->toArray();
//                    } elseif($attr_info->attr_style == 0) {
//                        // 多选
//                        $attr_vname = AttrValue::where('attr_id', $item['attr_id'])->whereIn('attr_vid', $attr_vid)->orderBy('attr_vsort', 'asc')->pluck('attr_vname')->toArray();
//                    }

                    $item['attr_name'] = $attr_info->attr_name;
                    $item['attr_vid'] = serialize($attr_vid);
                    $item['attr_vname'] = serialize($attr_vname);
                    $goodsAttr = new GoodsAttr();
                    $goodsAttr->fill($item);
                    $goodsAttr->save();
                }
            }



            // 5. 插入商品规格别名表 spec_alias
            if (!empty($postData['spec_alias'])) {
                // 删除原有的商品规格别名
                SpecAlias::where([['goods_id',$goods_id]])->delete();

                foreach ($postData['spec_alias'] as $item) {
                    $item['goods_id'] = $goods_id;
                    $specAlias = new SpecAlias();
                    $specAlias->fill($item);
                    $specAlias->save();
                }
            }

            // 6. 插入商品扩展分类表 goods_cat
            if (!empty($postData['other_cat_ids'])) {
                // 删除原有的商品扩展分类
                GoodsCat::where([['goods_id',$goods_id]])->delete();

                foreach ($postData['other_cat_ids'] as $item) {
                    $other_cat['goods_id'] = $goods_id;
                    $other_cat['cat_id'] = $item;
                    $goodsCat = new GoodsCat();
                    $goodsCat->fill($other_cat);
                    $goodsCat->save();
                }
            }


            DB::commit();
            return $goodsRet;
        }catch (\Exception $e){
            DB::rollback();//事务回滚
//            echo $e->getMessage();
//            echo $e->getCode();
            return false;
        }
    }

    /**
     * 根据sku_id获取商品id
     *
     * @param $sku_id
     * @return mixed
     */
    public function getGoodsId($sku_id)
    {
        $goods_id = DB::table('goods_sku')->where('sku_id', $sku_id)->orderBy('sku_id', 'asc')->value('goods_id');

        return $goods_id;
    }

    /**
     * 根据商品id获取sku_id
     *
     * @param $goods_id
     * @return mixed
     */
    public function getSkuId($goods_id)
    {
        $sku_id = Goods::where('goods_id', $goods_id)->select(['goods_id','sku_id'])->value('sku_id');
        return $sku_id;
    }



    /**
     * 根据商品id获取sku列表
     *
     * @param $goods_id
     * @return mixed
     */
    public function getSkuList($goods_id)
    {
        $where[] = ['goods_id',$goods_id];
        $where[] = ['is_enable', 1]; // 选中的Sku
        $condition = [
            'where' => $where,
            'limit'=>0,
        ];
        list($data, $total) = $this->goodsSku->getList($condition);

        if (!empty($data)) {
            foreach ($data as $item) {

                if (!empty($item->spec_ids)) {
                    // 规格图片 有规格


                    $selected_spec_ids = explode('|', $item->spec_ids);
                    $selected_spec_id = $selected_spec_ids[0];

                    $sku_images = $this->getGoodsImages($item->goods_id, $selected_spec_id);
                    $sku_image = '';
                    if (!$sku_images->isEmpty()) {
                        $sku_image = $sku_images[0]['path'];
                    }
                    $item->sku_image = $sku_image;
                } else {
                    // 无规格 获取商品默认主图
                    $item->sku_image = GoodsImage::where('goods_id',$goods_id)->orderBy('is_default', 'asc')->value('path');
                }
            }
        }

        return $data;
    }

    /**
     * 修改商品sku信息
     *
     * @param Request $request
     * @return bool
     */
    public function editGoodsSkuInfo(Request $request)
    {

        DB::beginTransaction();
        try {
            $sku_id = $request->post('sku_id', 0);
            if (!$sku_id) {
                return false;
            }
            $sku_info = GoodsSku::where('sku_id', $sku_id)->select(['goods_id','goods_price','goods_number'])->first();
            $postTitle = $request->post('title');
            if ($postTitle == 'goods_number') {
                // 更新商品库存
                $changedNumber = $request->post('value') - $sku_info->goods_number; // 与原来的值差值
                if ($changedNumber > 0) {
                    // 如果大于0 则增加商品表库存
                    $this->model->where('goods_id', $sku_info->goods_id)->increment('goods_number', $changedNumber);
                } elseif ($changedNumber < 0) {
                    // 如果小于0 则减少商品表库存
                    $this->model->where('goods_id', $sku_info->goods_id)->decrement('goods_number', abs($changedNumber));
                }
            } else {
                // 更新其他信息
                $this->model->where('goods_id', $sku_info->goods_id)->update([$postTitle=>$request->post('value')]);
            }

            // 更新goods_sku表中数据
            $this->goodsSku->editInfo($request);

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
     * 将商品移入回收站
     *
     * @param $ids
     * @return bool
     */
    public function softDeleteGoods($ids)
    {
        if (empty($ids) || !is_array($ids)) {
            return false;
        }
        $ret = $this->model->whereIn('goods_id', $ids)->update(['is_delete'=>1]);
        return $ret;
    }

    /**
     * 商品(批量)彻底删除
     *
     * @param int $shop_id 店铺id
     * @param array $goods_ids 商品id
     * @return array|bool
     */
    public function foreverDeleteGoods($shop_id = 0, $goods_ids = [])
    {
        if (empty($shop_id) && empty($goods_ids)) {
            return false;
        }

        DB::beginTransaction();
        try {

            // 商品关联数据
            if (!empty($shop_id)) {
                // 删除店铺所有商品
                $goods_ids = Goods::where('shop_id', $shop_id)->select(['goods_id'])->pluck('goods_id')->toArray();
            }

            Goods::whereIn('goods_id', $goods_ids)->delete(); // 商品表 goods
            GoodsAttr::whereIn('goods_id', $goods_ids)->delete(); // 商品属性 goods_attr
            GoodsCat::whereIn('goods_id', $goods_ids)->delete(); // 商品扩展分类 goods_cat
            GoodsHistory::whereIn('goods_id', $goods_ids)->delete(); // 商品历史记录 goods_history
            GoodsImage::whereIn('goods_id', $goods_ids)->delete(); // 商品相册 goods_image
            GoodsSku::whereIn('goods_id', $goods_ids)->delete(); // 商品SKU goods_sku
            GoodsSpec::whereIn('goods_id', $goods_ids)->delete(); // 商品规格 goods_sku
            Collect::whereIn('goods_id', $goods_ids)->delete(); // 商品收藏 collect

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
     * 还原商品
     *
     * @param $ids
     * @return bool
     */
    public function recoverGoods($ids)
    {
        if (empty($ids) || !is_array($ids)) {
            return false;
        }
        $ret = $this->model->whereIn('goods_id', $ids)->update(['is_delete'=>0]);
        return $ret;
    }

    /**
     * 获取商品模型信息
     *
     * @param $goods_id
     * @return mixed
     */
    public function getGoodsModelInfo($goods_id)
    {
        $field = ['mobile_price','cost_price','market_price','invoice_type','is_repair','user_discount','stock_mode','top_layout_id','bottom_layout_id','warn_number','goods_number','goods_sort','freight_id','pricing_mode','sales_model','goods_status','goods_id','goods_name','cat_id','cat_id1','cat_id2','cat_id3','shop_id','sku_open','sku_id','goods_subname','goods_price','give_integral','goods_sn','goods_barcode','goods_image',
            'goods_images', // 不确定是否有用 存储的是图片信息序列化
            'goods_video','brand_id','pc_desc','mobile_desc','packing_layout_id','service_layout_id','click_count','keywords','goods_info','comment_num','sale_num','collect_num','goods_audit','goods_reason','is_delete','is_virtual','is_best','is_new','is_hot','is_promote','contract_ids','supplier_id','goods_freight_type','goods_freight_fee','goods_stockcode','goods_volume','goods_weight','goods_remark','add_time','last_time','audit_time','edit_items','act_id','goods_moq','lib_goods_id','other_attrs','filter_attr_ids','filter_attr_vids','button_name','button_url','goods_unit','order_act_id','goods_mode','ext_info','remark',
            'shop_cat_ids'
            ];
        $info = $this->getById($goods_id, $field);

        $info->goods_images = unserialize($info->goods_images);
        $info->mobile_desc = unserialize($info->mobile_desc);
        $info->other_attrs = unserialize($info->other_attrs);
        $info->contract_ids = unserialize($info->contract_ids);


        return $info->toArray();
    }


    /******************************* 前端逻辑代码 *******************************/

    /**
     * 传入当前分类 如果当前是 2级 找一级
     * 如果当前是 3级 找2 级 和 一级
     *
     * @param $goodsCat
     * @return array
     */
    public function getGoodsCat(&$goodsCat)
    {
        if (empty($goodsCat)) return [];
        $catAll = get_goods_category_tree();
        if ($goodsCat['cat_level'] == 1) {
            $catArr = $catAll[$goodsCat['cat_id']]['items'];
            $goodsCat['parent_name'] = $goodsCat['cat_name'];
            $goodsCat['select_id'] = 0;
        } elseif ($goodsCat['cat_level'] == 2) {
            $catArr = $catAll[$goodsCat['parent_id']]['items'];
            $goodsCat['parent_name'] = $catAll[$goodsCat['parent_id']]['cat_name']; // 顶级分类名称
            $goodsCat['open_id'] = $goodsCat['cat_id']; // 默认展开分类
            $goodsCat['select_id'] = 0;
        } else {
            $parent = Category::where([['is_show',1],['cat_id', $goodsCat['parent_id']]])->orderBy('cat_sort', 'desc')->first(); // 父类
            $catArr = $catAll[$parent->parent_id]['items'];
            $goodsCat['parent_name'] = $catAll[$parent->parent_id]['cat_name']; // 顶级分类名称
            $goodsCat['open_id'] = $parent->cat_id;
            $goodsCat['select_id'] = $goodsCat['cat_id']; // 默认选中分类
        }
        return $catArr;
    }

    /**
     * 热卖商品
     *
     * @param $cat_id_arr
     * @param int $num
     * @return mixed
     */
    public function getHotSaleGoods($cat_id_arr = [], $num = 4)
    {
        $where = [];
        $where[] = ['goods_status',1]; // 商品状态 已上架
        $where[] = ['goods_audit',1]; // 审核通过
        $where[] = ['is_hot',1]; // 是否热卖
        $condition = [
            'where' => $where,
            'limit' => $num,
            'sortname' => 'goods_id',
            'sortorder' => 'desc'
        ];
        if (!empty($cat_id_arr)) {
            $condition['in'] = [
                'field' => 'cat_id',
                'condition' => $cat_id_arr
            ];
        }
        list($list, $total) = $this->getList($condition);
        return $list;
    }

    /**
     * 新品推荐
     *
     * @param $cat_id_arr
     * @param int $num
     * @return mixed
     */
    public function getNewGoods($cat_id_arr = [], $num = 4)
    {
        $where = [];
        $where[] = ['goods_status',1]; // 商品状态 已发布
        $where[] = ['goods_audit',1]; // 审核通过$where[] = ['goods_status',1]; // 商品状态 已发布
        $where[] = ['goods_audit',1]; // 审核通过
        $where[] = ['is_new',1]; // 是否新品
        $condition = [
            'where' => $where,
            'limit' => $num,
            'sortname' => 'goods_id',
            'sortorder' => 'desc'
        ];
        if (!empty($cat_id_arr)) {
            $condition['in'] = [
                'field' => 'cat_id',
                'condition' => $cat_id_arr
            ];
        }
        list($list, $total) = $this->getList($condition);
        return $list;
    }

    /**
     * 获取排行商品(销售量/收藏数)
     *
     * @param string $sort sale_num-销售量 collect_num-收藏数
     * @param array $cat_id_arr
     * @param int $num
     * @param int $shop_id 店内排行榜
     * @return mixed
     */
    public function getTopGoods($sort = 'sale_num', $cat_id_arr = [], $num = 4, $shop_id = 0)
    {
        $where = [];
        $where[] = ['goods_status',1]; // 商品状态 已发布
        $where[] = ['goods_audit',1]; // 审核通过
        if ($shop_id) {
            $where[] = ['shop_id', $shop_id]; // 店内排行
        }
        $condition = [
            'where' => $where,
            'limit' => $num,
            'sortname' => $sort,
            'sortorder' => 'desc',
            'field' => [
                'sku_id','goods_id','goods_number',
                'sale_num','goods_name','market_price',
                'comment_num','collect_num','goods_price',
                'goods_image','shop_id'
            ]
        ];
        if (!empty($cat_id_arr)) {
            $condition['in'] = [
                'field' => 'cat_id',
                'condition' => $cat_id_arr
            ];
        }
        list($list, $total) = $this->getList($condition);
        $list = $list->toArray();
        if (!empty($list)) {
            foreach ($list as &$item) {
                $shop_info = Shop::where('shop_id', $item['shop_id'])
                    ->select(['show_price','show_content','button_content'])
                    ->first();
                $item['show_price'] = $shop_info->show_price;
                $item['show_content'] = $shop_info->show_content;
                $item['button_content'] = $shop_info->button_content;
                $item['price_show'] = [
                    'code' => 1, // todo
                ];
                $item['goods_price_format'] = '￥'.$item['goods_price'];
            }
        }
        return $list;
    }

    /**
     * 猜你喜欢
     *
     * @param int $page
     * @param int $num
     * @return mixed
     */
    public function getGuessLikeGoods($page = 1, $num = 6)
    {
        $where = [];
        $where[] = ['goods_status',1]; // 商品状态 已发布
        $where[] = ['goods_audit',1]; // 审核通过
        $condition = [
            'where' => $where,
            'field' => ['goods_id','goods_name','goods_image','goods_price','comment_num','shop_id'],
            'cur_page' => $page,
            'page_size' => $num,
            'sortname' => 'click_count',
            'sortorder' => 'desc'
        ];
        $data = $this->getList($condition);
        return $data;
    }

    /**
     * 浏览历史
     *
     * @param array $cat_id_arr
     * @param int $num
     * @param array $where
     * @return mixed
     */
    public function getGoodsHistory($cat_id_arr = [], $num = 6, $where = [])
    {

        $condition = [
            'where' => $where,
            'limit' => $num,
            'sortname' => 'created_at',
            'sortorder' => 'desc'
        ];
        if (!empty($cat_id_arr)) {
            $condition['in'] = [
                'field' => 'cat_id',
                'condition' => $cat_id_arr
            ];
        }
        $data = $this->goodsHistoryRep->getList($condition);
        return $data;
    }

    /**
     * 看了又看
     *
     * @param $goods
     * @param int $limit
     * @return mixed
     */
    public function getLookSee($goods, $limit = 12)
    {
        $where = [];
        $where[] = ['goods_status',1]; // 商品状态 已发布
        $where[] = ['goods_audit',1]; // 审核通过
        $where[] = ['goods_id', '<>', $goods->goods_id];
        $where[] = ['cat_id', '<>', $goods->cat_id];
        $list = $this->model->where($where)->limit(0,$limit)->get();
        return $list;
    }

    /**
     * 根据商品id获取sku列表
     *
     * @param $goods_id
     * @return array|false|string
     */
    public function getFrontendSkuList($goods_id)
    {
        $where[] = ['goods_id',$goods_id];
        $where[] = ['is_enable',1];
        $condition = [
            'where' => $where,
            'limit'=>0,
        ];
        list($data, $total) = $this->goodsSku->getList($condition);
        $resData = [];
        if (!empty($data)) {
            foreach ($data as $item) {
                $spec_ids_str = $item->spec_ids;
                $spec_names_str = $item->spec_names;

                if (!empty($spec_ids_str)) {
                    $resData[$spec_ids_str] = [
                        'sku_id' => $item->sku_id,
                        'spec_ids' => $spec_ids_str,
                        'goods_price' => $item->goods_price,
                        'goods_number' => $item->goods_number,
                        'spec_names' => $spec_names_str,
                    ];
                } else {
                    $resData[""] = [
                        'sku_id' => $item->sku_id,
                        'spec_ids' => "",
                        'goods_price' => $item->goods_price,
                        'goods_number' => $item->goods_number,
                        'spec_names' => null
                    ];
                }
            }
        }
        return $resData;
    }

    /**
     * 商品规格列表 (前端调用)
     *
     * @param $goods_info
     * @return array
     */
    public function getGoodsSpecList($goods_info)
    {
        $goods_id = $goods_info->goods_id;
        $cat_id = $goods_info->cat_id;

        $where[] = ['goods_id',$goods_id];
        $condition = [
            'where' => $where,
            'limit'=>0,
        ];
        list($data, $total) = $this->goodsSpec->getList($condition, 'attr_id');
        if (empty($data)) {
            return [];
        }
        $resData = [];
        $i = 0;
        foreach ($data as $attr_id=>$item) {
            $attr_name = Attribute::where('attr_id', $attr_id)->value('attr_name');

            $attr_values = [];
            foreach ($item as $av) {
                $spec_image = '';
                if ($i == 0) {
                    // 规格缩略图
                    $spec_image = GoodsImage::where([['goods_id', $goods_id], ['spec_id', $av->spec_id]])->orderBy('sort', 'asc')->pluck('path')->toArray();
                    $spec_image = !empty($spec_image) ? $spec_image[0] : '';
                }

                $attr_values[] = [
                    'spec_id' => $av->spec_id,
                    'spec_image' => $spec_image,
                    'attr_vid' => $av->attr_vid,
                    'attr_value' => $av->attr_value,
                    'attr_desc' => $av->attr_desc,
//                    'is_invalid' => 0
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

        return $resData;
    }

    /**
     * 商品详情 获取商品属性列表
     *
     * @param $goods_id
     * @return array
     */
    public function getGoodsAttrList($goods_id)
    {
        $where[] = ['goods_id',$goods_id];
        $condition = [
            'where' => $where,
            'limit'=>0,
        ];
        list($data, $total) = $this->goodsAttr->getList($condition);
        if (empty($data)) {
            return [];
        }
        $resData = [];
        foreach ($data as $item) {
            $resData[] = [
                'attr_name' => $item->attr_name,
                'is_brand' => 0, // todo
                'attr_values' => implode(' ', unserialize($item->attr_vname)) // 多个值以空格分隔
            ];
        }
        return $resData;
    }

    /**
     * 获取商品详情页相册图片
     *
     * @param int $goods_id
     * @param int $spec_id
     * @return mixed
     */
    public function getGoodsImages($goods_id, $spec_id = 0)
    {
        $where[] = ['goods_id', $goods_id];
        if ($spec_id > 0) {
            $where[] = ['spec_id', $spec_id];
        }
        $goodsImages = GoodsImage::where($where)->orderBy('is_default', 'desc')->orderBy('sort', 'asc')->get();
        return $goodsImages;
    }

    /**
     * 商品详情 获取商品售后服务保障列表
     *
     * @param $shop_id
     * @param array $contract_ids
     * @return mixed
     */
    public function getGoodsContractList($shop_id, $contract_ids = [])
    {
        if (empty($contract_ids)) {
            return [];
        }
        $list = Contract::whereIn('contract_id', $contract_ids)
            ->select(['contract_id','contract_name','contract_fee','contract_image','contract_type'
            ,'contract_desc','is_open','contract_sort'])->get()->toArray();
        if (!empty($list)) {
            foreach ($list as &$item) {
                $item['shop_id'] = $shop_id;
            }
        }

        return $list;
    }

    /**
     * 商品详情 获取店铺常见问题列表
     *
     * @param $shop_id
     * @param int $limit
     * @return mixed
     */
    public function getShopQuestions($shop_id, $limit = 5)
    {
        $where = [];
        $where[] = ['shop_id', $shop_id];
        // 列表
        $condition = [
            'where' => $where,
            'limit' => $limit,
            'sortname' => 'sort',
            'sortorder' => 'asc',
            'field' => ['questions_id','shop_id','question','answer','sort']
        ];
        list($list, $total) = $this->shopQuestions->getList($condition);
        return $list->toArray();
    }

    /**
     * 生成商品二维码
     *
     * @param int $good_id 商品id
     * @return \Illuminate\Http\Response
     */
    public function generateGoodsQrCode($good_id)
    {
        $url = route('mobile_show_goods', ['goods_id'=>$good_id]);

        $qrCode = QrCode::errorCorrection('L')
            ->format('png')
            ->size(124)
//            ->merge('/public/qrcodes/water.png',.15) // 合并水印图片到二维码
            ->margin(0)
//            ->color(255,0,255)
//            ->backgroundColor(125,245,0)
            ->encoding('UTF-8')
            ->generate($url);
        return response()->make($qrCode, 200, ['Content-Type' => 'image/png']);
    }

    /**
     * 获取筛选条件数据
     *
     * @param $params
     * @param $goodsPriceData
     * @return array
     */
    public function goodsFilterData($params, $goodsPriceData)
    {
        // 初始化请求参数
        /*$go = $request->get('go',1);//当前页
        $sort = $request->get('sort',4); // 排序方式 综合/销量/新品/评论/价格/人气
        $price_min = $request->get('price_min',1);
        $is_stock = $request->get('is_stock',1);
        $brand_id = $request->get('brand_id',0);
        $filter_attr = $request->get('filter_attr',''); //根据属性筛选
        $is_free = $request->get('is_free',0); // 包邮
        $cat_id = $request->get('cat_id',0); // 分类id
        $is_cash = $request->get('is_cash',0); // 是否货到付款
        $is_self = $request->get('is_self',0); // 是否自营店铺
        $price_max = $request->get('price_max','');
        $order = $request->get('order','ASC'); // 排序类型 ASC-顺序 DESC-倒序*/
//        $region = $request->get('region',0);

        extract($params);
        $cat_id = isset($cat_id) ? $cat_id : 0;
        $region_code = !empty($region) ? str_replace('_', ',', $region) : null;

        $filter_condition = []; // 初始化选中的筛选条件

        // 品牌筛选
        $brand_items = null;
        $brand_letters = null;
        $brand_where = [];
        if (isset($cat_id) && !empty($cat_id) && $cat_id != '{0}') {
            $brand_where[] = ['cat_id', $cat_id];
        }
        $brand_list = BrandCategory::where($brand_where)->get()->toArray();

        if (!empty($brand_list)) {
            $brand_items = [];
            $selected_brand_items = [];
            foreach ($brand_list as $v) {
                $brand_info = Brand::where('brand_id', $v['brand_id'])->first();
                $selected_brand_ids = !empty($brand_id) && $brand_id != '{0}' ? explode('_', $brand_id) : [];
                if (in_array($v['brand_id'], $selected_brand_ids)) {
                    $selected_brand_items[] = [
                        'name' => $brand_info->brand_name,
                        'value' => $v['brand_id'],
                        'letter' => $brand_info->brand_letter,
                        'image' => $brand_info->brand_logo,
                        'url' => build_goods_uri($params, ['brand_id'=>$v['brand_id']]),
                        'selected' => 1
                    ];
                } else {
                    $brand_items[] = [
                        'name' => $brand_info->brand_name,
                        'value' => $v['brand_id'],
                        'letter' => $brand_info->brand_letter,
                        'image' => $brand_info->brand_logo,
                        'url' => build_goods_uri($params, ['brand_id'=>$v['brand_id']]),
                        'selected' => 0
                    ];
                }

            }

            if (isset($brand_id) && !empty($brand_id) && $brand_id != '{0}') {
                // 选中的筛选品牌
                $brand_items = $selected_brand_items;
                $filter_condition[] = [
                    'name' => '品牌',
                    'value' => implode(',',array_column($selected_brand_items,'name')),
                    'url' => build_goods_uri($params,['brand_id'=>0])
                ];
            }

            $brand_letters = array_unique(array_column($brand_items, 'letter'));
        }

        $brand = [
            'name' => '品牌',
            'param' => 'brand_id',
            'url' => build_goods_uri($params,['brand_id'=>'{0}']),
            'items' => $brand_items,
            'letters' => $brand_letters,
            'selected' => !empty($brand_id) && $brand_id != '{0}' ? 1 : 0
        ];

        // 价格区间筛选
        $price_items = null;
        $price_min = (isset($price_min) && !empty($price_min)) ? $price_min : 0;
        $price_max = (isset($price_max) && !empty($price_max)) ? $price_max : 0;
        $price_range = null;
        if (!empty($goodsPriceData) && $goodsPriceData['price_max'] > 0) {
            $price_range = price_range($goodsPriceData['price_min'], $goodsPriceData['price_max'], $goodsPriceData['price_str']);
        }

        $p_min = 0;
        $p_max = 0;
        if (!empty($price_range)) {
            foreach ($price_range as $v) {
                $price_items[] = [
                    'name' => $v['start_end'],
                    'goods_num' => 0, //$goods_num 如何计算商品数量
                    'start' => $v['start'],
                    'end' => $v['end'],
                    'start_format' => '￥'.$v['start'],
                    'end_format' => '￥'.$v['end'],
                    'url' => build_goods_uri($params,['price_min'=>$v['start'],'price_max'=>$v['end']]),
                    'selected' => 0
                ];
                if ($price_min == $v['start'] && $price_max == $v['end'] && $price_min > 0 && $price_max > 0) {
                    // 选中的筛选价格
                    $filter_condition[] = [
                        'name' => '价格',
                        'value' => $v['start'].'-'.$v['end'],
                    'url' => build_goods_uri($params,['price_min'=>0,'price_max'=>0])
                ];
                }
            }
            $p_min = min(array_column($price_items,'start'));
            $p_max = max(array_column($price_items,'end'));
        }
        $price = [
            'name' => '价格',
            'param' => 'price_min,price_max',
            'start' => $price_min,
            'end' => $price_max,
            'start_format' => '￥'.$price_min,
            'end_format' => '￥'.$price_max,
            'url' => build_goods_uri($params,['price_min'=>'{0}','price_max'=>'{1}']),
            'items' => $price_items,
            'selected' => 0,
            'price_min' => $p_min,
            'price_max' => $p_max,
            'url_no_price' => build_goods_uri($params,['price_min'=>0,'price_max'=>0])
        ];

        // 属性筛选
        $filter_attr_param = [
            'name' => '属性',
            'param' => 'filter_attr'
        ];
        if ($cat_id > 0) {
            // 分类下的筛选属性
            if (isset($filter_attr)) {
                $filter_attr_vids_arr = explode('-',$filter_attr);
                $filter_attr_ids = AttrValue::whereIn('attr_vid', $filter_attr_vids_arr)->pluck('attr_id')->toArray();
                $fa_items = CatAttribute::where([['cat_id',$cat_id],['is_spec',0]])->whereNotIn('attr_id', $filter_attr_ids)->with('attr_value')->limit(5)->get()->toArray();
            } else {
                $fa_items = CatAttribute::where([['cat_id',$cat_id],['is_spec',0]])->limit(5)->get()->toArray();
            }
            $filter_attr_items = [];
            if (!empty($fa_items)) {
                foreach ($fa_items as $v) {
                    $attr_name = Attribute::where('attr_id',$v['attr_id'])->value('attr_name');
                    $attr_value_items = [];
                    $attr_values = AttrValue::where('attr_id',$v['attr_id'])->get()->toArray();
                    if ($attr_values) {
                        foreach ($attr_values as $ak=>$av) {
                            if (isset($filter_attr)) {
                                // 选中的筛选属性
                                $filter_condition[] = [
                                    'name' => $attr_name,
                                    'value' => $av['attr_vname'],
                                    'url' => build_goods_uri($params,['filter_attr'=>str_replace('{0}','0',$filter_attr)])
                                ];
                            }
                            $attr_value_items[] = [
                                'name' => $av['attr_vname'],
                                'value' => $av['attr_vid'],
                                'url' => build_goods_uri($params, ['filter_attr'=>$av['attr_vid'].'-0-0-0-0']),
                                'selected' => 0
                            ];
                        }
                    }
                    $filter_attr_items[] = [
                        'name' => $attr_name,
                        'url' => build_goods_uri($params,['filter_attr'=>'{0}-0-0-0-0']),
                        'items' => $attr_value_items
                    ];
                }

                $filter_attr_param['items'] = $filter_attr_items;
            }
        }

        // 排序
        $sorts = [];
        $sort = isset($sort) ? $sort : 0;
        $order = isset($order) ? $order : null;
        foreach (get_goods_sort_array() as $v) {

            if ($sort == $v['value'] && $order == 'ASC') {
                $v['order'] = $order;
                $v['selected'] = 1;
                $v['url'] = build_goods_uri($params, ['sort'=>$v['value'],'order'=>'DESC']);
            } elseif ($sort == $v['value'] && $order == 'DESC') {
                $v['order'] = $order;
                $v['selected'] = 1;
                $v['url'] = build_goods_uri($params, ['sort'=>$v['value'],'order'=>'ASC']);

            } else {
                $v['selected'] = 0;
                $v['url'] = build_goods_uri($params, ['sort'=>$v['value'],'order'=>$v['order']]);
            }

            // 综合排序
            if ($sort == 0 && $v['value'] == 0) {
                $v['order'] = null;
                $v['selected'] = 1;
            }


            $sorts[] = $v;
        }

        // 其他筛选
        $is_self = isset($is_self) && $is_self == 1 ? 1 : 0;
        $is_free = isset($is_free) && $is_free == 1 ? 1 : 0;
        $is_cash = isset($is_cash) && $is_cash == 1 ? 1 : 0;
        $is_stock = isset($is_stock) && $is_stock == 1 ? 1 : 0;
        $others = [
            [
                'name' => '平台自营',
                'param' => 'is_self',
                'value' => $is_self,
                'selected' => $is_self,
                'url' => build_goods_uri($params,['is_self'=>!$is_self])
            ],
            [
                'name' => '包邮',
                'param' => 'is_free',
                'value' => $is_free,
                'selected' => $is_free,
                'url' => build_goods_uri($params,['is_free'=>!$is_free])
            ],
            [
                'name' => '支持货到付款',
                'param' => 'is_cash',
                'value' => $is_cash,
                'selected' => $is_cash,
                'url' => build_goods_uri($params,['is_cash'=>!$is_cash])
            ],
            [
                'name' => '仅显示有货',
                'param' => 'is_stock',
                'value' => $is_stock,
                'selected' => $is_stock,
                'url' => build_goods_uri($params,['is_stock'=>!$is_stock])
            ]
        ];

        // 配送至
        $region = [
            'name' => '配送至',
            'param' => 'region',
            'value' => $region_code,
            'url' => build_goods_uri($params,['region'=>'{0}'])
        ];

        // 关键词搜索
        $keyword = [
            'name' => '关键词',
            'param' => 'keyword',
            'value' => !empty($keyword) ? $keyword : null,
            'url' => build_goods_uri($params, ['keyword'=>'{0}'])
        ];

        // 商品列表显示模式
        $style = !isset($style) ? 'grid' : $style;
        $styles = [
            [
                'name' => '大图模式',
                'param' => 'style',
                'value' => 'grid',
                'url' => build_goods_uri($params, ['style'=>'grid']),
                'selected' => isset($style) && $style == 'grid' ? 1 : 0,
            ],
            [
                'name' => '列表模式',
                'param' => 'style',
                'value' => 'list',
                'url' => build_goods_uri($params, ['style'=>'list']),
                'selected' => isset($style) && $style == 'list' ? 1 : 0,
            ],
        ];

        // 分页
        $page = [
            'name' => '分页',
            'param' => 'go',
            'value' => isset($go) ? $go : '1',
            'url' => build_goods_uri($params,['go'=>'{0}']),
            'items' => null // todo
        ];

        $filter = [
            'brand' => $brand,
            'price' => $price,
            'filter_attr' => $filter_attr_param,
            'sorts' => $sorts,
            'others' => $others,
            'region' => $region,
            'keyword' => $keyword,
            'styles' => $styles,
            'page' => $page, // 顶部简洁分页（只有上一页/下一页）
            'url' => '/list-'.$cat_id.'.html'
        ];

        return [$filter, $filter_condition];
    }

    /**
     * 拼接商品列表筛选条件 查询条件
     *
     * @param $params
     * @return array
     */
    public function splice_goods_list_condition($params)
    {
        extract($params);
        /*$go = $request->get('go',1);//当前页
       $sort = $request->get('sort',4); // 排序方式 综合/销量/新品/评论/价格/人气
       $price_min = $request->get('price_min',1);
       $is_stock = $request->get('is_stock',1);
       $brand_id = $request->get('brand_id',0);
       $filter_attr = $request->get('filter_attr',''); //根据属性筛选
       $is_free = $request->get('is_free',0); // 包邮
       $cat_id = $request->get('cat_id',0); // 分类id
       $is_cash = $request->get('is_cash',0); // 是否货到付款
       $is_self = $request->get('is_self',0); // 是否自营店铺
       $price_max = $request->get('price_max','');
       $order = $request->get('order','ASC'); // 排序类型 ASC-顺序 DESC-倒序*/
        $where = [];
        $whereBetween = [];
        $whereIn = [];

        $where[] = ['goods_status',1]; // 商品状态 已发布
        $where[] = ['goods_audit',1]; // 审核通过

        // 价格
        if (!empty($price_min) && $price_min != '{0}' && empty($price_max)) {
            $where[] = ['goods_price', '>', $price_min];
        }
        if (empty($price_min) && !empty($price_max) && $price_max != '{0}') {
            $where[] = ['goods_price', '<', $price_max];
        }
        if (!empty($price_min) && $price_min != '{0}' && !empty($price_max) && $price_max != '{0}') {
            $whereBetween[] = ['goods_price', [$price_min, $price_max]];
        }

        // 显示有货 库存大于0
        if (isset($is_stock) && $is_stock != '{0}') {
            $where[] = ['goods_number', '>', 0];
        }
        // 品牌
        if (!empty($brand_id) && $brand_id != '{0}') {
            $whereIn['brand_id'] = is_string(explode('_', $brand_id)) ? [$brand_id] : explode('_', $brand_id);
        }

        // 属性

        // 包邮
        if (isset($is_free) && $is_free != '{0}') {
            $where[] = ['goods_freight_fee', 0];
        }

        // 分类id
        if (isset($cat_id) && $cat_id != '{0}') {
            $cat_id_arr = get_cat_grandson($cat_id); // 获取该分类下的所有分类id
            $whereIn['cat_id'] = $cat_id_arr;
        }

        // 货到付款 todo
        if (isset($is_cash) && $is_cash != '{0}') {
//            $where[] = ['is_cash', $is_cash];
        }

        // 自营店铺 todo
        if (isset($is_self)) {
//            $where[] = ['is_self', $is_self];
        }

        // 关键词搜索 keyword
        if (isset($keyword) && $keyword != '' && $keyword != '{0}') {
            $where[] = ['goods_name','like', "{$keyword}"];
        }

        // 配送至 todo
        if (isset($region) && $region != '{0}') {
//            $region_code = str_replace('_', ',', $region['region']);

        }

        return [$where, $whereBetween, $whereIn];
    }

    /**
     * 获取商品收藏量
     *
     * @param $goodsId
     * @return mixed
     */
    public function getGoodsCollectCount($goodsId)
    {
        $count = Goods::where('goods_id',$goodsId)->value('collect_num');
        return $count;
    }

    /**
     * 获取在售商品信息
     *
     * @param $goodsId
     * @return mixed
     */
    public function getOnSaleGoodsInfo($goodsId)
    {
        $where[] = ['goods_status',1]; // 商品状态 已发布
        $where[] = ['goods_audit',1]; // 审核通过
        $info = Goods::where($where)->first();

        return $info;
    }
}