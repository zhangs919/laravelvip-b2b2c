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
// | Description: 系统商品规格别名
// +----------------------------------------------------------------------

namespace App\Repositories;


use App\Models\LibSpecAlias;

class LibSpecAliasRepository
{
    use BaseRepository;

    protected $model;


    public function __construct()
    {
        $this->model = new LibSpecAlias();
    }


    /**
     * 获取商品规格别名列表
     *
     * @param $goods_id
     * @return mixed
     */
    public function getSpecAlias($goods_id)
    {
        $spec_alias = LibSpecAlias::where('goods_id', $goods_id)->select(['attr_id','attr_name'])->pluck('attr_name','attr_id')->toArray();

        return $spec_alias;

    }

}