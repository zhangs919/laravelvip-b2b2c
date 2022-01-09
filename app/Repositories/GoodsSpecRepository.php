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
// | Date:2018-12-9
// | Description: 商品规格
// +----------------------------------------------------------------------

namespace App\Repositories;

use App\Models\GoodsSpec;

class GoodsSpecRepository
{
    use BaseRepository;

    protected $model;


    public function __construct()
    {
        $this->model = new GoodsSpec();
    }

    /**
     * 获取商品规格列表
     *
     * @param $goods_id
     * @return array
     */
    public function getGoodsSpecs($goods_id)
    {
        $where[] = ['goods_id',$goods_id];
        $condition = [
            'where' => $where,
            'limit'=>0,
        ];
        list($goods_specs, $total) = $this->getList($condition, 'attr_id');
        $list = [];
        if (!empty($goods_specs)) {
            foreach ($goods_specs as $attr_id=>$v) {
                if (!empty($v)) {
                    foreach ($v as $av) {
                        $list[$attr_id][] = $av->attr_vid;
                    }
                }
            }
        }

        return $list;
    }

    /**
     * 获取商品规格描述 attr_desc
     *
     * @param $goods_id
     * @return array
     */
    public function getGoodsSpecsDesc($goods_id)
    {
        $where[] = ['goods_id',$goods_id];
        $condition = [
            'where' => $where,
            'limit'=>0,
        ];
        list($goods_specs, $total) = $this->getList($condition, 'attr_id');
        $list = [];
        if (!empty($goods_specs)) {
            foreach ($goods_specs as $attr_id=>$v) {
                if (!empty($v)) {
                    foreach ($v as $av) {
                        $list[$attr_id][$av->attr_vid] = $av->attr_desc;
                    }
                }
            }
        }

        return $list;
    }

}