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
// | Date:2019-3-23
// | Description:赠品
// +----------------------------------------------------------------------

namespace App\Modules\Backend\Http\Controllers\Dashboard;

use App\Models\Goods;
use App\Models\GoodsSku;
use App\Modules\Base\Http\Controllers\Backend;
use App\Repositories\ActivityCategoryRepository;
use App\Repositories\ActivityRepository;
use App\Repositories\BrandRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\GoodsRepository;
use Illuminate\Http\Request;

/**
 * 赠品活动管理
 *
 * Class GiftController
 * @package app\Modules\Seller\Http\Controllers\Dashboard
 */
class GiftController extends Backend
{

    private $links = [
        ['url' => 'dashboard/gift/list', 'text' => '列表'],
        ['url' => 'dashboard/gift/add', 'text' => '添加'],
        ['url' => 'dashboard/gift/edit', 'text' => '编辑'],
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
            '赠品活动目前应用于满减/送促销活动中作为优惠条件，抽奖类活动作为赠品领取',
            '作为赠品的商品，赠品价格为0，如作为赠品的商品有设置运费，抽奖类活动需要支付运费，满减/送促销活动不需要支付运费',
            '已赠送：表示抽奖类活动已赠送出去的赠品活动次数；已领取：表示抽奖类活动已赠送出去并已领取的赠品活动次数',
            '虚拟商品不参与赠品活动'
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
        list($list, $total) = $this->activity->getGiftActivityList($where);

        $pageHtml = pagination($total);
        $page = frontend_pagination($total, true);

        if ($request->ajax()) {
            $render = view('dashboard.gift.partials._list', compact('list', 'total', 'pageHtml'))->render();
            return result(0, $render);
        }

        // 获取数据

        $compact = compact('title', 'list', 'pageHtml');

        return view('dashboard.gift.list',$compact);
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
            admin_log('赠品活动删除失败。ID：'.$id);
            return result(-1, null, '删除失败');
        }

        // Log
        admin_log('赠品活动删除成功。ID：'.$id);
        return result(0, null, '删除成功');
    }

    public function batchDelete(Request $request)
    {
        $ids = $request->post('ids');
        $ids = !is_array($ids) ? [$ids] : $ids;
        $ret = $this->activity->deleteActivity(0, $ids);

        $ids = implode(',', $ids);
        if ($ret === false) {
            // Log
            admin_log('赠品活动删除失败。ID：' . $ids);
            return result(-1, '', '删除失败');
        }
        // Log
        admin_log('删除了多个赠品活动。ID：' . $ids);
        return result(0, '', '删除成功');
    }

}