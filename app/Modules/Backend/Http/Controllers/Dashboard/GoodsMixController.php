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
// | Date:2019-3/23
// | Description:搭配套餐
// +----------------------------------------------------------------------

namespace App\Modules\Backend\Http\Controllers\Dashboard;

use App\Modules\Base\Http\Controllers\Backend;
use App\Repositories\ActivityCategoryRepository;
use App\Repositories\ActivityRepository;
use App\Repositories\BrandRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\GoodsRepository;
use Illuminate\Http\Request;

/**
 * 搭配套餐管理
 *
 * Class GoodsMixController
 * @package app\Modules\Seller\Http\Controllers\Dashboard
 */
class GoodsMixController extends Backend
{

    private $links = [
        ['url' => 'dashboard/goods-mix/list', 'text' => '列表'],
        ['url' => 'dashboard/goods-mix/check', 'text' => '查看'],
    ];

    protected $activity;
    protected $activityCategory;
    protected $goods;
    protected $category;
    protected $brand;

    public function __construct(
        ActivityRepository $activity
        ,ActivityCategoryRepository $activityCategory
        ,GoodsRepository $goods
        ,CategoryRepository $category
        ,BrandRepository $brand
    )
    {
        parent::__construct();

        $this->activity = $activity;
        $this->activityCategory = $activityCategory;
        $this->goods = $goods;
        $this->category = $category;
        $this->brand = $brand;

    }


    public function lists(Request $request)
    {
        $title = '搭配套餐列表';
        $fixed_title = '营销中心 - '.$title;

        $action_span = [
            [
                'id' => '',
                'url' => '/dashboard/center/index',
                'icon' => 'fa-reply',
                'text' => '返回营销中心'
            ],

        ];

        $explain_panel = [
            '商家可以将几种商品组合成套餐，并设置套餐价来销售，通过这种优惠套餐的形式让买家一次性购买更多商品。以此提升销售业绩，提高购买转化率，提升销售笔数，增加商品曝光率',
            '参与满减送活动的商品不能参与搭配套餐，如果商品享受会员折扣，以套餐价购买',
            '系统中同一个商品同时只能参与一个促销活动',
            '参与搭配套餐的商品，在套餐有效期内，商品无法修改规格和价格',
        ];
        $blocks = [
            'explain_panel' => $explain_panel,
            'fixed_title' => $fixed_title,
            'action_span' => $action_span
        ];

        $this->setLayoutBlock($blocks); // 设置block

        $params = $request->all();

        $where = [];
        // 搜索条件
        $search_arr = ['act_name','begin','end','act_status'];
        foreach ($search_arr as $v) {
            if (isset($params[$v]) && !empty($params[$v])) {

                if ($v == 'act_name') {
                    $where[] = ['act_name', 'like', "%{$params[$v]}%"];
                } else {
                    $where[] = [$v, $params[$v]];
                }
            }
        }
        // 列表
        list($list, $total) = $this->activity->getGoodsMixActivityList($where);
        $pageHtml = pagination($total);

        if ($request->ajax()) {
            $render = view('dashboard.goods-mix.partials._list', compact('list', 'total', 'pageHtml'))->render();
            return result(0, $render);
        }

        // 获取数据

        $compact = compact('title', 'list', 'pageHtml');

        return view('dashboard.goods-mix.list', $compact);
    }


    public function check(Request $request)
    {
        $title = '查看';

        $id = $request->get('id', 0);
        $this->sublink($this->links, 'check', '', '', 'add');
        $fixed_title = '搭配套餐 - '.$title;

        $start_time = date('Y-m-d H:i:s', time());
        $end_time = date("Y-m-d H:i:s",strtotime("+7 day"));

        $action_span = [
            [
                'url' => 'list',
                'icon' => 'fa-reply',
                'text' => '返回搭配套餐列表'
            ],
        ];

        $explain_panel = [];
        $blocks = [
            'explain_panel' => $explain_panel,
            'fixed_title' => $fixed_title,
            'action_span' => $action_span
        ];

        $this->setLayoutBlock($blocks); // 设置block

        // 获取数据
        $min_price = '';
        $max_price = null;

        $model = $this->activity->getById($id, ['sort','act_id','act_name','act_title','act_img','start_time','end_time','purchase_num','shop_id','ext_info']);
        $model = $model->toArray();

        $ext_info = $model['ext_info'];
        $model['price_mode'] = $ext_info['price_mode'] ?? 0;
        $model['act_price'] = $ext_info['act_price'] ?? '';
        $model['discount_show'] = $ext_info['discount_show'] ?? 0;

        $goods_list = []; // 赠品商品列表
        $values = [];

        $compact = compact('title', 'model', 'goods_list', 'end_time', 'values');

        return view('dashboard.goods-mix.check', $compact);
    }

    /**
     * 删除
     * @param Request $request
     * @return mixed
     */
    public function delete(Request $request)
    {
        $id = $request->post('id');
        $ret = $this->activity->del($id);

        if ($ret === false) {
            // Log
            return result(-1, null, '删除失败');
        }

        // Log
        return result(0, null, '删除成功');
    }

}