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
// | Date:2019-10-8
// | Description: 系统商品属性
// +----------------------------------------------------------------------

namespace App\Repositories;

use App\Models\LibGoodsAttr;

class LibGoodsAttrRepository
{
    use BaseRepository;

    protected $model;


    public function __construct()
    {
        $this->model = new LibGoodsAttr();
    }

    /**
     * 获取商品属性列表
     *
     * @param $goods_id
     * @return array
     */
    public function getGoodsAttrs($goods_id)
    {
        $goods_attrs = LibGoodsAttr::where('goods_id', $goods_id)->get()->toArray();
        $list = [];
        if (!empty($goods_attrs)) {
            foreach ($goods_attrs as $v) {
                $list[$v['attr_id']] = is_string(unserialize($v['attr_vid'])) ? [unserialize($v['attr_vid'])] : unserialize($v['attr_vid']);
            }
        }

        return $list;
    }

    /**
     * 获取商品属性列表
     *
     * @param $goods_id
     * @return array
     */
//    public function getAppGoodsAttrs($goods_id)
//    {
//        $goods_attrs = LibGoodsAttr::where('goods_id', $goods_id)->get()->toArray();
//        $list = [];
//        if (!empty($goods_attrs)) {
//            foreach ($goods_attrs as $v) {
//                $list[] = [
//                    'attr_id' => $v['attr_id'],
//                    'attr_vid' => unserialize($v['attr_vid'])
//                ];
//            }
//        }
//
//        return $list;
//    }
}