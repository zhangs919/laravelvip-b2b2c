<?php

namespace App\Repositories;

use App\Models\GoodsLayout;

class GoodsLayoutRepository
{
    use BaseRepository;

    protected $model;


    public function __construct()
    {
        $this->model = new GoodsLayout();
    }


    /**
     * 根据详情版式位置id获取版式列表
     *
     * @param int $position
     * @return array
     */
    public function goodsLayoutByPosition($position = 0)
    {
        $condition = [
            ['shop_id',seller_shop_info()->shop_id],
            ['position',$position]
        ];
        $layout_list = GoodsLayout::where($condition)->select(['layout_id','layout_name'])->get();

        $list[0] = '--不使用--';
        if (!empty($layout_list)) {
            foreach ($layout_list as $v) {
                $list[$v->layout_id] = $v->layout_name;
            }
        }

        return $list;
    }

    /**
     * 获取商品详情版式列表
     *
     * @param $shop_id
     * @return array
     */
    public function getGoodsLayouts($shop_id)
    {
        $condition = [
            ['shop_id',$shop_id],
        ];

        $layout_list = GoodsLayout::where($condition)->select(['layout_id','layout_name','position'])->get()->toArray();

        $data = [];
        for ($i=0; $i<=3; $i++) {
            $data[$i][] = [
                'layout_id' => 0,
                'layout_name' => '--不使用--'
            ];
        }

        if (!empty($layout_list)) {
            foreach ($layout_list as $v) {
                $data[$v['position']][] = $v;
            }
        }

        return $data;
    }
}