<?php

namespace App\Repositories;


use App\Models\Attribute;
use App\Models\AttrValue;
use App\Models\Category;
use App\Models\Goods;
use App\Models\GoodsAttr;
use App\Models\GoodsImage;
use App\Models\GoodsSku;
use App\Models\GoodsSpec;
use App\Models\Shop;
use App\Models\SpecAlias;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class GoodsRepository_20181115_商品规格逻辑重写前备份
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

    protected $goodsCollect;

    public function __construct()
    {
        $this->model = new Goods();
        $this->goodsSku = new GoodsSku();
        $this->categoryRep = new CategoryRepository();
        $this->goodsHistoryRep = new GoodsHistoryRepository();
        $this->shopQuestions = new ShopQuestionsRepository();
        $this->goodsCollect = new GoodsCollectRepository();

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

        if (!empty($data[0])) {

            foreach ($data[0] as $key=>$value) {
                $value->shop_name = Shop::where('shop_id', $value->shop_id)->value('shop_name');
                // 是否收藏商品
                $value->is_collected = false;
                if ($this->goodsCollect->checkIsCollected($value->goods_id, $user_id)) {
                    // 已收藏
                    $value->is_collected = true;
                }
            }
        }
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
            $goodsInsert['shop_cat_ids'] = !empty($postData['shop_cat_ids']) ? implode(',',$postData['shop_cat_ids']) : null; // todo
            $goodsInsert['other_cat_ids'] = !empty($postData['other_cat_ids']) ? implode(',',$postData['other_cat_ids']) : null; // todo
            $goodsInsert['contract_ids'] = serialize($goodsInsert['contract_ids']);
            $goodsInsert['mobile_desc'] = serialize($goodsInsert['mobile_desc']);
            $goodsInsert['other_attrs'] = serialize($postData['other_attrs']);  // 店铺自定义属性
            $goodsInsert['add_time'] = time();
            $goodsRet = $this->store($goodsInsert);

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
                ];
                $goodsSku = new GoodsSku();
                $goodsSku->fill($goodsSkuInsert);
                $goodsSku->save();
            } else {
                // 如果设置了规格 在商品SKU表中新增所有规格的SKU信息
                foreach ($postData['sku_list'] as $skuKey=>$item) {

                    $item['goods_id'] = $goodsRet->goods_id;
                    // 商品规格id 和规格名称处理
                    $key_name = [];
                    foreach ($item['specs'] as $s) {
                        $attr_name = Attribute::where('attr_id', $s['attr_id'])->value('attr_name');
                        $attr_vname = $s['attr_vname'];
                        $key_name[] = $attr_name.':'.$attr_vname;
                    }
                    $spec_id_str = implode('|', array_column($item['specs'], 'attr_vid'));
                    $item['key'] = $spec_id_str; // 规格值id attr_vid 多个以 _ 分隔 格式：12_21
                    $item['key_name'] = implode(' ', $key_name); // 规格键值对名称 attr_name 多个以空格分隔 格式：网络:4G 内存:32G 颜色:金色

                    $item['specs'] = serialize($item['specs']); // 规格序列化 todo 该字段是否可以用key key_name 替换
                    if (empty($item['warn_number'])) {
                        $item['warn_number'] = 0;
                    }
                    $goodsSku = new GoodsSku();
                    $goodsSku->fill($item);
                    $goodsSku->save();
                }
            }

            $default_sku_id = GoodsSku::where('goods_id', $goodsRet->goods_id)->select(['sku_id','goods_id'])->orderBy('sku_id', 'asc')->value('sku_id');
            // 更新商品表 sku_id 为goods_sku 第一个
            Goods::where('goods_id', $goodsRet->goods_id)->update(['sku_id'=>$default_sku_id]);

            // 3. 插入商品属性表 goods_attr
            if (!empty($postData['goods_attrs'])) {
                foreach ($postData['goods_attrs'] as $item) {
                    $item['goods_id'] = $goodsRet->goods_id;
                    $attr_info =  Attribute::where('attr_id', $item['attr_id'])->first();
                    $attr_vid = $item['attr_vid'];
                    if (empty($attr_vid)) {
                        continue;
                    }
                    if ($attr_info->attr_style > 0) {
                        // 单选 文本
                        $attr_condition = [
                            ['attr_id', $item['attr_id']],
                            ['attr_vid', $attr_vid],
                        ];
                        $attr_vname = AttrValue::where($attr_condition)->orderBy('attr_vsort', 'asc')->pluck('attr_vname');
                    } else {
                        // 多选
                        $attr_vname = AttrValue::where('attr_id', $item['attr_id'])->whereIn('attr_vid', $attr_vid)->orderBy('attr_vsort', 'asc')->pluck('attr_vname');
                    }
                    $attr_vname = $attr_vname->toArray();
                    $item['attr_name'] = $attr_info->attr_name;
                    $item['attr_vid'] = serialize($attr_vid);
                    $item['attr_vname'] = serialize($attr_vname);
                    $goodsAttr = new GoodsAttr();
                    $goodsAttr->fill($item);
                    $goodsAttr->save();
                }
            }

            // 4. 插入商品规格表 goods_spec
            if (!empty($postData['goods_specs'])) {
                foreach ($postData['goods_specs'] as $item) {
                    $item['goods_id'] = $goodsRet->goods_id;
                    $attr_info =  Attribute::where('attr_id', $item['attr_id'])->first();
                    $item['attr_name'] = $attr_info->attr_name;
                    $goodsSpec = new GoodsSpec();
                    $goodsSpec->fill($item);
                    $goodsSpec->save();
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


            DB::commit();
            return $goodsRet;
        }catch (\Exception $e){
            DB::rollback();//事务回滚
            echo $e->getMessage();
            echo $e->getCode();
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
//            $cat_arr = $this->categoryRep->getCatIds($goodsUpdate['cat_id']);
//            $goodsInsert['cat_id1'] = $cat_arr['cat_id1'];
//            $goodsInsert['cat_id2'] = $cat_arr['cat_id2'];
//            $goodsInsert['cat_id3'] = $cat_arr['cat_id3'];
            $goodsUpdate['goods_unit'] = !empty($goodsUpdate['goods_unit']) ? $goodsUpdate['goods_unit'] : 0;

//            dd($postData);
            $goodsUpdate['shop_cat_ids'] = $postData['shop_cat_ids']; // todo
            $goodsUpdate['other_cat_ids'] = implode(',',$postData['other_cat_ids']); // todo
            $goodsUpdate['contract_ids'] = serialize($goodsUpdate['contract_ids']);
            $goodsUpdate['mobile_desc'] = serialize($goodsUpdate['mobile_desc']);
            $goodsUpdate['other_attrs'] = serialize($postData['other_attrs']);  // 店铺自定义属性
            $goodsUpdate['last_time'] = time();
            if ($goodsUpdate['goods_freight_type'] == 0) {
                $goodsUpdate['freight_id'] = 0;
            }

            $goodsRet = $this->update($goods_id, $goodsUpdate);

            // 2. 插入/更新商品SKU表
            if (!empty($postData['sku_list'])) {
                //
                $specs = [];
                $postData['sku_list'] = array_filter($postData['sku_list']);
                foreach ($postData['sku_list'] as $item) {
                    $spec_id_str = implode('|', array_column($item['specs'], 'attr_vid'));
                    $specs[] = $spec_id_str; // 规格值id attr_vid 多个以 | 分隔 格式：12_21
                }
                // 将不在此数组内的商品sku checked状态改为0
                GoodsSku::where('goods_id', $goods_id)->whereNotIn('key', $specs)->update(['checked' => 0]);

                // 如果设置了规格 在商品SKU表中新增/更新规格的SKU信息
                foreach ($postData['sku_list'] as $item) {

                    $item['goods_id'] = $goodsRet->goods_id;
                    $item['checked'] = 1; // 默认将商品sku选中

                    // 商品规格id 和规格名称处理
                    $key_name = [];
                    foreach ($item['specs'] as $s) {
                        $attr_name = Attribute::where('attr_id', $s['attr_id'])->select(['attr_id','attr_name'])->value('attr_name');
                        $attr_vname = $s['attr_vname'];
                        $key_name[] = $attr_name.':'.$attr_vname;
                    }

                    $spec_id_str = implode('|', array_column($item['specs'], 'attr_vid'));
                    $item['key'] = $spec_id_str; // 规格值id attr_vid 多个以 | 分隔 格式：12_21
                    $item['key_name'] = implode(' ', $key_name); // 规格键值对名称 attr_name 多个以空格分隔 格式：网络:4G 内存:32G 颜色:金色

                    $item['specs'] = serialize($item['specs']); // 规格序列化 todo 该字段是否可以用key key_name 替换
                    if (empty($item['warn_number'])) {
                        $item['warn_number'] = 0;
                    }

                    // 检查该规格是否存在 如果存在则更新 否则新增
                    // TODO 2018.4.30 0:45 如何知道商品库存表中已经存在该种规格的SKU信息？？？
                    $skuKeyExist = GoodsSku::where([['goods_id', $goods_id], ['key', $spec_id_str]])->count();
                    if ($skuKeyExist > 0) {
                        // 已经存在 更新
                        GoodsSku::where([['goods_id', $goods_id], ['key', $spec_id_str]])->update($item);
                    } else {
                        // 不存在 新增
                        $goodsSku = new GoodsSku();
                        $goodsSku->fill($item);
                        $goodsSku->save();
                    }
                }
            }
//            dd($postData);
            // 3. 插入商品属性表 goods_attr
            if (!empty($postData['goods_attrs'])) {
                // 删除原有的商品属性
                GoodsAttr::where('goods_id', $goods_id)->delete();
                // 插入新的数据
                foreach ($postData['goods_attrs'] as $item) {
                    $item['goods_id'] = $goodsRet->goods_id;
                    $attr_info =  Attribute::where('attr_id', $item['attr_id'])->first();
                    $attr_vid = $item['attr_vid'];
                    if (empty($attr_vid)) {
                        continue;
                    }
                    // 属性样式 attr_style 0多选 1单选 2文本
                    $attr_vname = '';
                    if ($attr_info->attr_style == 2) {
                        // 文本
                        $attr_vname = [$attr_vid];
                    } elseif($attr_info->attr_style == 1) {
                        // 单选
                        $attr_condition = [
                            ['attr_id', $item['attr_id']],
                            ['attr_vid', $attr_vid],
                        ];
                        $attr_vname = AttrValue::where($attr_condition)->orderBy('attr_vsort', 'asc')->pluck('attr_vname');
                        $attr_vname = $attr_vname->toArray();
                    } elseif($attr_info->attr_style == 0) {
                        // 多选
                        $attr_vname = AttrValue::where('attr_id', $item['attr_id'])->whereIn('attr_vid', $attr_vid)->orderBy('attr_vsort', 'asc')->pluck('attr_vname');
                        $attr_vname = $attr_vname->toArray();
                    }

//                    $attr_vname = $attr_vname->toArray();
                    $item['attr_name'] = $attr_info->attr_name;
                    $item['attr_vid'] = serialize($attr_vid);
                    $item['attr_vname'] = serialize($attr_vname);
                    $goodsAttr = new GoodsAttr();
                    $goodsAttr->fill($item);
                    $goodsAttr->save();
                }
            }

            // 4. 插入商品规格表 goods_spec
            if (!empty($postData['goods_specs'])) {
                // 删除原有的商品规格
                GoodsSpec::where([['goods_id',$goods_id]])->delete();
//                dd($postData['goods_specs']);
                foreach ($postData['goods_specs'] as $item) {
                    $item['goods_id'] = $goodsRet->goods_id;
                    $attr_info =  Attribute::where('attr_id', $item['attr_id'])->first();

                    $item['attr_name'] = $attr_info->attr_name;
                    $goodsSpec = new GoodsSpec();
                    $goodsSpec->fill($item);
                    $goodsSpec->save();

                }
            }

            // 5. 插入商品规格别名表 spec_alias
            if (!empty($postData['spec_alias'])) {
                // 删除原有的商品规格别名
                SpecAlias::where([['goods_id',$goods_id]])->delete();

                foreach ($postData['spec_alias'] as $item) {
                    $item['goods_id'] = $goodsRet->goods_id;
                    $specAlias = new SpecAlias();
                    $specAlias->fill($item);
                    $specAlias->save();
                }
            }


            DB::commit();
            return $goodsRet;
        }catch (\Exception $e){
            DB::rollback();//事务回滚
            echo $e->getMessage();
            echo $e->getCode();
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
     * todo sku_id 应该是存在goods表中的sku_id字段
     * todo 添加商品时，要保存一个默认的sku_id到goods表
     * @param $goods_id
     * @return mixed
     */
    public function getSkuId($goods_id)
    {
        $sku_id = Goods::where('goods_id', $goods_id)->select(['goods_id','sku_id'])->value('sku_id');
//        if(!$sku_id) {
//            // todo 如果没有值 暂时从goods_sku表中取一个 添加商品的时候，保存默认的sku_id到goods表中 做好后 删除以下代码
//            $sku_id = GoodsSku::where('goods_id', $goods_id)->orderBy('sku_id', 'asc')->value('sku_id');
//        }

        return $sku_id;
    }

    /**
     * 根据商品id获取sku列表 以字段key为下标返回结果
     *
     * @param $goods_id
     * @return mixed
     */
    public function getSellerSkuList($goods_id)
    {
        $where[] = ['goods_id',$goods_id];
        $condition = [
            'where' => $where,
            'limit'=>0,
        ];
        $resData = [];
        list($data, $total) = $this->goodsSku->getList($condition, 'key');
        if (!empty($data)) {
            foreach ($data as $k=>$v) {
                $item = [
                    'checked' => $v->checked == 1 ? 'true' : 'false',
                    'goods_barcode' => $v->goods_barcode,
                    'goods_number' => $v->goods_number,
                    'goods_price' => $v->goods_price,
                    'goods_sn' => $v->goods_sn,
                    'market_price' => $v->market_price,
                    'mobile_price' => $v->mobile_price,
                    'warn_number' => $v->warn_number,
                    'goods_stockcode' => $v->goods_stockcode,
                    'goods_weight' => $v->goods_weight,
                    'goods_volume' => $v->goods_volume,
                ];
                if (!empty($v->key)) {
                    // 有规格
                    $resData[$v->key] = $item;
                } else {
                    // 无规格
                    $resData[""] = $item;
                }
            }
        }
        return $resData;
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
        $condition = [
            'where' => $where,
            'limit'=>0,
        ];
        list($data, $total) = $this->goodsSku->getList($condition);
        if (!empty($data)) {
            foreach ($data as $item) {
                $specs = unserialize($item->specs);

                $sku_image = '';
                if (!empty($specs)) {
                    foreach ($specs as $k=>$spec) {
                        $specs[$k]['attr_name'] = Attribute::where('attr_id', $k)->select(['attr_id','attr_name'])->value('attr_name');
                        // 规格图片 有规格
                        $sku_image = GoodsImage::where([['goods_id',$goods_id],['spec_id',$spec['attr_vid']]])->orderBy('is_default', 'asc')->value('path');
                    }
                } else {
                    // 无规格 获取商品默认主图
                    $sku_image = GoodsImage::where('goods_id',$goods_id)->orderBy('is_default', 'asc')->value('path');
                }
                $item->specs = $specs;
                $item->sku_image = $sku_image;
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
            $catArr = $catAll[$goodsCat['cat_id']]['tmenu'];
            $goodsCat['parent_name'] = $goodsCat['cat_name'];
            $goodsCat['select_id'] = 0;
        } elseif ($goodsCat['cat_level'] == 2) {
            $catArr = $catAll[$goodsCat['parent_id']]['tmenu'];
            $goodsCat['parent_name'] = $catAll[$goodsCat['parent_id']]['cat_name']; // 顶级分类名称
            $goodsCat['open_id'] = $goodsCat['cat_id']; // 默认展开分类
            $goodsCat['select_id'] = 0;
        } else {
            $parent = Category::where([['is_show',1],['cat_id', $goodsCat['parent_id']]])->orderBy('cat_sort', 'desc')->first(); // 父类
            $catArr = $catAll[$parent->parent_id]['tmenu'];
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
    public function getHotSaleGoods($cat_id_arr, $num = 4)
    {
        $where = [];
        $where[] = ['goods_status',1]; // 商品状态 已发布
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
     * 销量排行
     *
     * @param $cat_id_arr
     * @param int $num
     * @return mixed
     */
    public function getSaleRankGoods($cat_id_arr = [], $num = 4, $shop_id = 0)
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
            'sortname' => 'sale_num',
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
     * 商品收藏排行
     *
     * @param $cat_id_arr
     * @param int $num
     * @param int $shop_id
     * @return mixed
     */
    public function getCollectRankGoods($cat_id_arr, $num = 4, $shop_id = 0)
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
            'sortname' => 'collect_num',
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
        $condition = [
            'where' => $where,
            'limit'=>0,
        ];
        list($data, $total) = $this->goodsSku->getList($condition);
        $resData = [];
        if (!empty($data)) {
            foreach ($data as $item) {
                $specs = unserialize($item->specs);

                if (!empty($specs)) {
                    $spec_ids = implode('|', array_column($specs, 'attr_vid'));
                    $spec_names = [];
                    foreach ($specs as $k=>$spec) {
                        $attr_name = Attribute::where('attr_id', $k)->select(['attr_id','attr_name'])->value('attr_name');
                        $spec_names[] = $attr_name.":".$spec['attr_vname'];
                    }
                    $spec_names = implode('|', $spec_names);
                    $selected_spec_id = array_column($specs, 'attr_vid')[0];
                    $sku_images = $this->getGoodsImages(0, $selected_spec_id);
                    $resData[$spec_ids] = [
                        'sku_id' => $item->sku_id,
                        'spec_ids' => $spec_ids,
                        'goods_price' => $item->goods_price,
                        'goods_number' => $item->goods_number,
                        'spec_names' => $spec_names,
                        'sku_image' => get_image_url($sku_images[0]['path']),
                        'sku_image_thumb' => get_image_url($sku_images[0]['path']).'?x-oss-process=image\/resize,m_pad,limit_0,h_220,w_220',
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
     * 商品规格列表
     *
     * @param $goods_id
     * @return array
     */
    public function getGoodsSpecList($goods_id)
    {
        $where[] = ['goods_id',$goods_id];
        $condition = [
            'where' => $where,
            'limit'=>0,
        ];
        list($data, $total) = $this->goodsSpec->getList($condition);
        if (empty($data)) {
            return [];
        }
        $resData = [];
        foreach ($data as $item) {
            $resData[$item->attr_id][] = $item;
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
            $item->attr_vname = implode(' ', unserialize($item->attr_vname)); // 多个值以空格分隔
            $item->attr_vid = unserialize($item->attr_vid);
            $resData[] = $item;
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
    public function getGoodsImages($goods_id = 0, $spec_id = 0)
    {
        if ($goods_id) {
            return GoodsImage::where('goods_id', $goods_id)->orderBy('is_default', 'desc')->orderBy('sort', 'asc')->get();
        } else {
            return GoodsImage::where('spec_id', $spec_id)->orderBy('is_default', 'desc')->orderBy('sort', 'asc')->get();
        }
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
        ];
        list($list, $total) = $this->shopQuestions->getList($condition);
        return $list;
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
}