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
// | Description: 首页控制器
// +----------------------------------------------------------------------

namespace App\Modules\Frontend\Http\Controllers;

use App\Modules\Base\Http\Controllers\Frontend;
use App\Repositories\BonusRepository;
use Illuminate\Http\Request;


class BonusController extends Frontend
{


    protected $bonus;

    public function __construct(
        BonusRepository $bonus
    )
    {
        parent::__construct();


        $this->bonus = $bonus;
    }



    /**
     * 红包集市
     *
     * @param Request $request
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function lists(Request $request, $filter_str = '')
    {
        if (!empty($filter_str)) {
            $filter_param = explode('-', $filter_str);

            $params['sort'] = isset($filter_param[1]) ? $filter_param[1] : 0; // 排序字段 综合/金额
            $params['order'] = isset($filter_param[2]) ? $filter_param[2] : 4; // 排序方式 3-asc 4-desc
            $params['go'] = isset($filter_param[3]) ? $filter_param[3] : 1; // 页面跳转
            $params['keyword'] = isset($params['keyword']) ? $params['keyword'] : ''; // 关键词搜索
        } else { // url拼接地址 &
            $params = $request->all();
        }

        extract($params);


        $where = [];
        $where[] = ['is_delete', 0]; // 未删除状态
        $where[] = ['bonus_type', 1]; // 店铺红包
        // 搜索条件
        $search_arr = ['keywords'];
        foreach ($search_arr as $v) {
            if (isset($params[$v]) && !empty($params[$v])) {

                if ($v == 'keywords') {
                    $where[] = ['bonus_name', 'like', "%{$params[$v]}%"];
                } else {
                    $where[] = [$v, $params[$v]];
                }
            }
        }


        $curPage = isset($go) ? $go : 1;
        $pageSize = isset($size) ? $size : 20;
        $sortname = isset($sort) ? $sort : 1;
        if (!empty($order)) {
            $sortorder = str_replace([3,4], ['ASC','DESC'], $order);
        } else {
            $sortorder = 'DESC';
        }

        // 列表
        $condition = [
            'where' => $where,
            'sortname' => get_bonus_sort_array($sortname),
            'sortorder' => $sortorder,
        ];
        list($list, $total) = $this->bonus->getFrontendBonusList($condition, $this->user_id);
        $pageHtml = frontend_pagination($total);
        $page_array = frontend_pagination($total,true);
        $page_json = json_encode($page_array);

        if ($request->ajax()) {
            $render = view('bonus.partials._list', compact('list', 'total', 'pageHtml', 'page_json'))->render();
            return result(0, $render);
        }

        $seo_title = '红包集市';

        // 获取数据
        $shop_id = 0;
        $go = 1;
        $sort = 0;
        $order = 0;
        $keyword = null;
        $filter = $this->bonus->bonusFilterData($params);

		// todo 从店铺后台-营销中心-红包-红包设置处读取 或者直接在平台后台配置同样的值 从平台后台获取
        $slide_list = [];
        $guide_ad = '/images/coupon-market.jpg';
        $act_name = '红包集市';
        $scroll = 1;
        $act_type = 'bonus_list';
        $share = [
            'seo_title' => $seo_title,
            'seo_discription' => $seo_title,
            'seo_image' => ''
        ];

        $compact = compact('seo_title','list','total','pageHtml','page_json',
            'shop_id','go','sort','order','keyword','filter','slide_list','guide_ad',
            'act_name','scroll','act_type','share');

        $this->show_seo('seo_index', ['name' => $seo_title]); // SEO

        $webData = []; // web端（pc、mobile）数据对象
        $data = [
            'app_prefix_data' => [
                'shop_id' => $shop_id,
                'go' => $go,
                'sort' => $sort,
                'order' => $order,
                'keyword' => $keyword,
                'filter' => $filter,
                'slide_list' => $slide_list,
                'guide_ad' => $guide_ad,
                'act_name' => $act_name,
                'list' => $list,
                'page' => $page_array,
                'scroll' => $scroll,
                'act_type' => $act_type,
                'share' => $share,
            ],
            'app_suffix_data' => [],
            'web_data' => $webData,
            'compact_data' => $compact,
            'tpl_view' => 'bonus.list'
        ];
        $this->setData($data); // 设置数据
        return $this->displayData(); // 模板渲染及APP客户端返回数据
    }

}
