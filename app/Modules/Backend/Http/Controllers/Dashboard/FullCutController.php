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
// | Date:2019-1-13
// | Description:满减/送
// +----------------------------------------------------------------------

namespace App\Modules\Backend\Http\Controllers\Dashboard;

use App\Models\Activity;
use App\Models\Bonus;
use App\Models\Goods;
use App\Modules\Base\Http\Controllers\Backend;
use App\Repositories\ActivityCategoryRepository;
use App\Repositories\ActivityRepository;
use App\Repositories\BrandRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\GoodsRepository;
use Illuminate\Http\Request;

/**
 * 满减/送管理
 *
 * Class FullCutController
 * @package app\Modules\Seller\Http\Controllers\Dashboard
 */
class FullCutController extends Backend
{

    private $links = [
        ['url' => 'dashboard/full-cut/list', 'text' => '列表'],
        ['url' => 'dashboard/full-cut/add', 'text' => '添加'],
        ['url' => 'dashboard/full-cut/edit', 'text' => '编辑'],
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
        $title = '列表';
        $fixed_title = '营销中心 - '.$title;

        $action_span = [
            [
                'id' => '',
                'url' => '/dashboard/center/index',
                'icon' => 'fa-reply',
                'text' => '返回营销中心'
            ]
        ];

        $explain_panel = [
            '满减/送是给商家提供的一个店铺营销工具，通过这个营销工具可以实现满金额送多种优惠，还可以设置多级/按件满减，让商家的店铺促销活动更加丰富',
            '在全部商品参与活动时，一次只能设置一个活动，如果有多级促销，可在设置时选择“多级优惠”即可',
            '在参与活动商品只有部分时，可以同时设置第二个活动，但第二个活动里面的商品不能包含第一个活动里的商品',
            '批发型商品不参与满减/送活动',
            '满减送活动赠送的积分，在消费者支付成功后即送出，消费者取消订单、或者卖家发货之后申请退款退货成功、或者卖家申请售后中的退款退货并且退款成功后，赠送的积分被退回。',
        ];
        $blocks = [
            'explain_panel' => $explain_panel,
            'fixed_title' => $fixed_title,
            'action_span' => $action_span
        ];

        $this->setLayoutBlock($blocks); // 设置block

        $params = $request->all();

        $where = [];
        $where[] = ['shop_id', seller_shop_info()->shop_id];
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
        list($list, $total) = $this->activity->getFullCutActivityList($where);

        $pageHtml = pagination($total);
        $page = frontend_pagination($total, true);

        if ($request->ajax()) {
            $render = view('dashboard.full-cut.partials._list', compact('list', 'total', 'pageHtml'))->render();
            return result(0, $render);
        }

        // 获取数据

        $compact = compact('title', 'list', 'pageHtml');

        return view('dashboard.full-cut.list',$compact);
    }


    /**
     * 删除
     * @param Request $request
     * @return mixed
     */
    public function delete(Request $request)
    {
        $id = $request->post('id');
        $ret = $this->activity->deleteActivity(0, [$id]);

        if ($ret === false) {
            // Log
            admin_log('满减/送删除失败。ID：'.$id);
            return result(-1, null, '删除失败');
        }

        // Log
        admin_log('满减/送删除成功。ID：'.$id);
        return result(0, null, '删除成功');
    }

    public function batchDelete(Request $request)
    {
        $ids = $request->post('ids');
        $ret = $this->activity->deleteActivity(0, $ids);

        $ids = implode(',', $ids);
        if ($ret === false) {
            // Log
            admin_log('满减/送删除失败。ID：'.$ids);
            return result(-1, '', '删除失败');
        }
        // Log
        admin_log('删除了多个满减/送。ID：'.$ids);
        return result(0, '', '删除成功');
    }

}