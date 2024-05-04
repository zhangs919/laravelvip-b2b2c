<?php

namespace App\Repositories;

use App\Models\Goods;
use App\Models\ShopCategory;
use App\Services\Tree;

class ShopCategoryRepository
{
    use BaseRepository;

    protected $model;

    protected $tree;


    public function __construct()
    {
        $this->model = new ShopCategory();
        $this->tree = new Tree();
    }

    public function getList($condition = [], $column = '', $toTree = false, $toFormatTree = false)
    {
        $data = $this->model->getList($condition, $column);

        if (!empty($data[0]) && $toTree) {
            // 是否转换为树形结构
            $list = [];
            foreach ($data[0] as $key=>$value) {
//                $value->shop_count = DB::table('shop')->where('cat_id', $value->cls_id)->count();
                $list[$key] = $value->toArray();
            }
            $data[0] = $this->tree->list_to_tree($list, 'cat_id', 'parent_id');
        }

        if (!empty($data[0]) && $toFormatTree) {
            // 是否转换为树形结构
            $list = [];
            foreach ($data[0] as $key=>$value) {
//                $value->shop_count = DB::table('shop')->where('cat_id', $value->cls_id)->count();
                $list[$key] = $value->toArray();
            }
            $data[0] = $this->tree->toFormatTree($list, 'cat_name', 'cat_id', 'parent_id');
        }
        return $data;
    }

    /**
     * 格式化输出列表
     *
     * @param $shop_id
     * @return mixed
     */
    public function getShopCategoryList($shop_id)
    {
        $list = ShopCategory::where([['is_show',1],['shop_id',$shop_id]])
            ->orderBy('cat_sort','asc')
            ->select(['cat_id','cat_name','parent_id','shop_id','keywords','cat_desc','cat_sort','is_show'])
            ->get()->toArray();

        if (!empty($list)) {
            foreach ($list as &$v) {
                $v['cat_level'] = $v['parent_id'] == 0 ? 1 : 2;
                $v['code'] = str_pad($v['cat_id'], 5, "0", STR_PAD_LEFT);
            }
        }

        return $list;
    }

    /**
     * 获取格式化后的店铺内分类列表
     *
     * 以树形结构的方式返回
     * APP或微信端店铺首页-商品分类异步加载用到
     *
     * @param int $shop_id 店铺id
     * @param int $cat_id 分类id 查询指定分类的子分类
     * @return array
     */
    public function getFormatShopCategory($shop_id, $cat_id = 0)
    {
        $where = [['is_show',1],['shop_id',$shop_id]];
        if ($cat_id > 0) {
            $where[] = ['parent_id', $cat_id];

        }
        $condition = [
            'where' => $where,
            'limit' => 0,
            'sortname' => 'cat_sort',
            'sortorder' => 'asc',
        ];
        list($listData, $total) = $this->model->getList($condition);


        // 是否转换为树形结构
        $listRes = [];
        foreach ($listData as $key=>$value) {
//                $value->shop_count = DB::table('shop')->where('cat_id', $value->cls_id)->count();
            $listRes[$key] = $value->toArray();
        }
        $list = $this->tree->list_to_tree($listRes, 'cat_id', 'parent_id');
//        list($list, $total) = $this->getList($condition,'',true);
//        $list = $this->model->where($where)->orderBy('cat_sort', 'asc')->get()->toArray();
//        dd($list);
        if (!empty($list)) {
            foreach ($list as &$v) {
                $goods_count = Goods::where([['cat_id',$v['cat_id']],['goods_status',1],['goods_audit',1]])->count();
                $v['goods_count'] = $goods_count;
                if (!empty($v['_child'])) {
                    $chr_list = [];
                    foreach ($v['_child'] as &$vv) {
                        $sub_goods_count = Goods::where([['cat_id',$vv['cat_id']],['goods_status',1],['goods_audit',1]])->count();
                        $vv['goods_count'] = $sub_goods_count;
                        unset($vv['_child'], $vv['childs'],$vv['created_at'],$vv['updated_at']);
                        $chr_list[] = $vv;
                    }
                    $v['chr_list'] = $chr_list;
                }
                unset($v['_child'], $v['childs'],$v['created_at'],$v['updated_at']);
            }
        }
        return $list;
    }

}