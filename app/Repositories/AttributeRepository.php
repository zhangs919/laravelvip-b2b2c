<?php

namespace App\Repositories;

use App\Models\Attribute;
use App\Models\AttrValue;
use App\Models\CatAttribute;
use App\Models\Category;
use App\Models\GoodsAttr;
use App\Models\GoodsSpec;
use Illuminate\Support\Facades\DB;

class AttributeRepository
{
    use BaseRepository;

    protected $model;

    protected $attr_value;


    public function __construct()
    {
        $this->model = new Attribute();
        $this->attr_value = new AttrValue();
    }

    public function getAttrInfo($attr_id)
    {
        $attr_info = $this->getById($attr_id);
        $attr_values = $this->model->find($attr_id)->attr_value()->where('is_delete', 0)->orderBy('attr_vsort')->get();
        $attr_info->attr_values = $attr_values;

        return $attr_info;
    }

    public function storeAttr($attr_insert, $attr_values)
    {
        DB::beginTransaction();
        try {
            unset($attr_insert['attr_id']);
            $attr = $this->store($attr_insert);
            // 批量插入attr_value表
            if (!empty($attr_values)) {
                foreach ($attr_values as $k=>$item) {
                    $item['attr_id'] = $attr->attr_id;
                    $item['attr_vsort'] = $k+1;
                    $attr_value_model  = new AttrValue();
                    $attr_value_model->fill($item);
                    $attr_value_model->save();
                }
            }

            DB::commit();
            return $attr;
        }catch (\Exception $e){
            DB::rollback();//事务回滚
            echo $e->getMessage();
            echo $e->getCode();
            return false;
        }
    }

    public function updateAttr($attr_update, $attr_values)
    {
        DB::beginTransaction();
        try {
            $attr = $this->update($attr_update['attr_id'], $attr_update);
            // 批量插入或更新attr_value表 如果attr_vid = 0 则是新增否则是更新
            if (!empty($attr_values)) {
                foreach ($attr_values as $k=>$item) {
                    $item['attr_id'] = $attr->attr_id;
                    $item['attr_vsort'] = $k+1;
//                    $value = (array)$item;
//                    dd($attr_values);

                    if (intval($item['is_delete'])) {
                        // 删除
                        $this->attr_value->del($item['attr_vid']);
                    }else {
                        if (intval($item['attr_vid'])) {
                            // 更新
                            $this->attr_value->where('attr_vid', $item['attr_vid'])->update($item);
                        } else {
                            // 新增
                            $this->attr_value->addAll($item);
//                            $this->attr_value->fill($item);
//                            $this->attr_value->save();
                        }
                    }
                }
            }

            DB::commit();
            return true;
        }catch (\Exception $e){
            DB::rollback();//事务回滚
//            echo $e->getMessage();
//            echo $e->getCode();
            return false;
        }
    }

    /**
     * 批量删除/单个删除
     *
     * @param $ids
     * @param bool $confirm
     * @return array|bool
     */
    public function deleteAttribute($ids, $confirm = false)
    {
        $ids_arr = explode(',', $ids);

        DB::beginTransaction();
        try {
            if (count($ids_arr) > 1) {
                // 批量删除
                foreach ($ids_arr as $id) {
                    // 检查属性是否被分类或商品使用
                    $goodsAttrCount = GoodsAttr::where('attr_id', $id)->get()->groupBy('goods_id')->count();
                    $goodsSpecCount = GoodsSpec::where('attr_id', $id)->get()->groupBy('goods_id')->count();
                    $catAttribute = CatAttribute::where('attr_id', $id)->select(['cat_id'])->get()->groupBy('cat_id');
                    $catAttributeCount = $catAttribute->count();
                    if ($catAttributeCount > 0) {
                        $cat_id = array_first($catAttribute->toArray())[0]['cat_id'];
                        $cat_name = Category::where('cat_id', $cat_id)->value('cat_name');

                        return arr_result(-1, null, '属性#'.$id.'已经被分类#'.$cat_id.'【'.$cat_name.'】引用，无法删除');
                    }
                }

                // 检查通过 执行删除操作
                // 1. 删除属性关联数据
                $this->delAttrRelatedData($ids_arr);
                // 2. 删除属性
                $this->batchDel($ids_arr);
            } else {
                // 单个删除
                // 检查属性是否被商品使用
                $goodsAttrCount = GoodsAttr::where('attr_id', $ids)->get()->groupBy('goods_id')->count();
                $goodsSpecCount = GoodsAttr::where('attr_id', $ids)->get()->groupBy('goods_id')->count();
                if (($goodsAttrCount > 0 || $goodsSpecCount) > 0 && !$confirm) {
                    // 等待确认
                    return arr_result(1, null, '<b style="color: red;">属性已被'.($goodsAttrCount + $goodsSpecCount).'个商品引用！</b>您是否确定继续删除此属性！');
                }

                // 检查通过 执行删除操作
                // 1. 删除属性关联数据
                $this->delAttrRelatedData($ids_arr);
                // 2. 删除属性
                $this->batchDel($ids_arr);
            }

            DB::commit();
            return true;
        }catch (\Exception $e){
            DB::rollback();//事务回滚
            return false;
        }
    }

    /**
     * 获取app端属性数据
     *
     * @param int $cat_id
     * @return array
     */
    public function getAppAttrsData($cat_id = 0)
    {
        $attr_list = CatAttribute::where([['cat_id', $cat_id], ['is_spec', 0]])
            ->orderBy('sort', 'asc')
//            ->select(['cat_id', 'attr_id', 'is_required','is_show','is_filter','group_name','sort','created_at'])
            ->get();

        $data = [];
        if (!empty($attr_list)) {
            foreach ($attr_list as $item) {
                $attr_info =  Attribute::where('attr_id', $item['attr_id'])->first();
                $attr_values = $item->attr_value;
                $attr_value_list = [];
                foreach ($attr_values as $av) {
                    $attr_value_list[] = [
                        'id' => $av->attr_vid,
                        'value' => $av->attr_vname
                    ];
                }

                $data[] = [
                    'attr_name' => $attr_info->attr_name,
                    'attr_style' => $attr_info->attr_style,
                    'attr_id' => $attr_info->attr_id,
                    'attr_values' => $attr_value_list,
                ];
            }
        }

        return $data;
    }

    /**
     * 获取属性列表
     *
     * @param int $cat_id 分类id 分类绑定属性
     * @return mixed
     */
    public function getAttrList($cat_id = 0)
    {
        $attr_list = CatAttribute::where([['cat_id', $cat_id], ['is_spec', 0]])
            ->orderBy('sort', 'asc')
            ->select(['cat_id', 'attr_id', 'is_required','is_show','is_filter','group_name','sort','created_at'])
            ->get()->toArray();

        if (!empty($attr_list)) {
            foreach ($attr_list as &$item) {
                $cat_name = Category::where('cat_id', $cat_id)->value('cat_name');
                $attr_info =  Attribute::where('attr_id', $item['attr_id'])->first();
                $attr_value = AttrValue::where('attr_id', $item['attr_id'])
                    ->orderBy('attr_vsort', 'asc')
                    ->select(['attr_vid','attr_vname'])
                    ->get()->toArray();

                $item['attr_name'] = $attr_info->attr_name;
                $item['attr_style'] = $attr_info->attr_style;
                $item['cat_name'] = $cat_name;
                $item['attr_vids'] = implode(',', array_column($attr_value, 'attr_vid'));
                $item['attr_vnames'] = implode(',', array_column($attr_value, 'attr_vname'));
            }
        }

        return $attr_list;
    }

    /**
     * 获取规格列表
     *
     * @param int $cat_id 分类id 分类绑定规格
     * @param int $shop_id 店铺id 店铺绑定规格
     * @return mixed
     */
    public function getSpecList($cat_id = 0, $shop_id = 0)
    {
        //分类关联的规格
        $cat_spec_list = CatAttribute::where([['cat_id', $cat_id], ['is_spec', 0]])
            ->orderBy('sort', 'asc')
            ->select(['cat_id', 'attr_id', 'is_default','is_input','is_alias','is_desc','is_filter','sort','created_at'])
            ->get()->toArray();
        $cat_list = [];
        if (!empty($cat_spec_list)) {
            foreach ($cat_spec_list as $item) {
                $cat_name = Category::where('cat_id', $cat_id)->value('cat_name');
                $attr_info =  Attribute::where('attr_id', $item['attr_id'])->first();
                $attr_value = AttrValue::where('attr_id', $item['attr_id'])
                    ->orderBy('attr_vsort', 'asc')
                    ->select(['attr_id','attr_vid','attr_vname'])
                    ->get()->toArray();

                $item['attr_name'] = $attr_info->attr_name;
                $item['attr_style'] = $attr_info->attr_style;
                $item['cat_name'] = $cat_name;
                $item['shop_id'] = $shop_id;
                $item['attrs'] = $attr_value;

                $cat_list[] = $item;
            }
        }

        // 店铺关联的规格
        // 获取店铺关联的规格列表
        $shop_spec_list = Attribute::where([['shop_id', $shop_id], ['is_spec', 1]])
            ->orderBy('attr_sort', 'asc')
            ->select(['attr_id','attr_name','attr_style','shop_id'])
            ->get()->toArray();
        $shop_spec = [];
        if (!empty($shop_spec_list)) {
            foreach ($shop_spec_list as $item) {
                $attr_value = AttrValue::where('attr_id', $item['attr_id'])
                    ->orderBy('attr_vsort', 'asc')
                    ->select(['attr_id','attr_vid','attr_vname'])
                    ->get()->toArray();

                $shop_spec[] = [
                    'cat_id' => 0,
                    'attr_id' => $item['attr_id'],
                    'is_default' => 0,
                    'is_input' => 1,
                    'is_alias' => 1,
                    'is_desc' => 0,
                    'is_filter' => 0,
                    'sort' => 255,
                    'add_time' => 0,
                    'attr_name' => $item['attr_name'],
                    'attr_style' => $item['attr_style'],
                    'cat_name' => null,
                    'shop_id' => $item['shop_id'],
                    'attrs' => $attr_value
                ];
            }
        }

        $spec_list = array_merge($cat_list, $shop_spec);
        return $spec_list;
    }

    /**
     * 删除属性关联数据
     *
     * @param array $attr_ids 属性id
     */
    protected function delAttrRelatedData($attr_ids)
    {
        // 1. 删除分类关联属性
        CatAttribute::whereIn('attr_id', $attr_ids)->delete();
        // 2. 删除商品属性关联属性
        GoodsAttr::whereIn('attr_id', $attr_ids)->delete();
        // 3. 删除商品规格关联属性
        GoodsSpec::whereIn('attr_id', $attr_ids)->delete();
    }
}