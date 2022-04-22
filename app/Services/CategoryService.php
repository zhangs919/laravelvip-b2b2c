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
// | Date:2019-01-07
// | Description: 递归方法获取商品分类
// +----------------------------------------------------------------------

namespace App\Services;

use App\Models\Category;

class CategoryService
{

    /**
     * 通过递归方法获取商品分类
     *
     * @param null $parentId 参数代表要获取子类目的父类目 ID，null 代表获取所有根类目
     * @param null $allCategories 参数代表数据库中所有的类目，如果是 null 代表需要从数据库中查询
     *
     * @return Category[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Support\Collection
     */
    public function getCategoryTree($parentId = null, $allCategories = null)
    {
        if (is_null($allCategories)) {
            // 从数据库查询所有分类
            $allCategories = Category::all();
        }

        return $allCategories
            // 从所有分类中挑选出父分类 ID 为 $parentId 的分类
            ->where('parent_id', $parentId)
            // 遍历这些分类,并用返回值构建一个新的集合
            ->map(function (Category $category) use ($allCategories) {
                $data = ['cat_id' => $category->cat_id, 'cat_name' => $category->cat_name];
                // 如果当前分类不是父分类,将返回值放入 children 对象中
                if (!$category->is_parent) {
                    return $data;
                }
                $data['children'] = $this->getCategoryTree($category->cat_id, $allCategories);

                return $data;
            });
    }
}