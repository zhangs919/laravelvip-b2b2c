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
// | Date:2018-08-29
// | Description: 品牌
// +----------------------------------------------------------------------

namespace App\Modules\Seller\Http\Controllers\Goods;

use App\Modules\Base\Http\Controllers\Seller;
use App\Repositories\BrandRepository;
use App\Repositories\ToolsRepository;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Excel;

class BrandController extends Seller
{


    protected $brand;

    protected $tools;

    protected $excel;


    public function __construct(
        BrandRepository $brandRepository
        , ToolsRepository $toolsRepository
        , Excel $excel
    )
    {
        parent::__construct();

        $this->brand = $brandRepository;
        $this->tools = $toolsRepository;
        $this->excel = $excel; // 导出excel
    }

    /**
     * 品牌选择器
     *
     * @param Request $request
     * @return mixed
     * @throws \Throwable
     */
    public function picker(Request $request)
    {
        $page_id = make_uuid();
        $pagination_id = $request->get('page')['page_id'];
        $output = $request->get('output');
        $selected_ids = $request->get('selected_ids', '');
        $selected_ids = explode(',', $selected_ids);
        $brand_name = $request->get('brand_name', '');

        // 查询条件
        if (!empty($brand_name)) {
            $where[] = ['brand_name', 'like', "%{$brand_name}%"];
        }
        $where[] = ['is_show', 1];
        $where[] = ['brand_logo', '<>', null];
        $whereIn = [];

        $tpl = 'picker';
        if (!$output) {
            // ajax 输出列表
            $tpl = 'partials._picker_brand_list';
        }

        $condition = [
            'where' => $where,
            'in' => $whereIn,
            'sortname' => 'brand_id',
            'sortorder' => 'desc'
        ];
        list($list, $total) = $this->brand->getList($condition);
        $pageHtml = short_pagination($total);
        // 调用平台后台的品牌选择器模板
        $render = view('backend::goods.brand.' . $tpl, compact('page_id', 'pagination_id', 'list', 'pageHtml', 'selected_ids'))->render();
        return result(0, $render);
    }
}