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
// | Date:2018-08-17
// | Description: 全部分类
// +----------------------------------------------------------------------

namespace App\Modules\Mobile\Http\Controllers;

use App\Models\Category;
use App\Modules\Base\Http\Controllers\Mobile;
use App\Repositories\CategoryRepository;
use Illuminate\Http\Request;


class CategoryController extends Mobile
{

    protected $category; // 商品分类

    public function __construct()
    {
        parent::__construct();

        $this->category = new CategoryRepository();
    }

    public function index(Request $request)
    {

        $seo_title = '全部分类';
        $cat_id = $request->get('cat_id', 0);

        $field = ['cat_id', 'parent_id', 'cat_name','cat_image', 'link_type', 'cat_link'];
        // 左侧1级分类
        $left_cat_list = Category::select($field)->where([['parent_id', 0], ['is_show', 1]])->limit(100)->orderBy('cat_sort', 'asc')->get();
        $right_cat_list = get_goods_category_tree();
        if (!$left_cat_list->isEmpty()) {
//            // 右侧2 3级分类
            $cur_cat_id = !empty($cat_id) ? $cat_id : $left_cat_list[0]->cat_id;

            // 列表
            $where[] = ['is_show', 1];
            $condition = [
                'where' => $where,
                'limit' => 0, // 不分页
                'sortname' => 'cat_sort',
                'sortorder' => 'asc',
                'field' => $field
            ];
            list($right_cat_list, $total) = $this->category->getList($condition, '', true);
        }

//        dd($right_cat_list);
        return view('category.index', compact('seo_title', 'left_cat_list', 'right_cat_list', 'cur_cat_id'));
    }
}