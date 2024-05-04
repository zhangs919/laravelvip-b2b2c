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
// | Description:
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
 * 限时折扣管理
 *
 * Class LimitDiscountController
 * @package app\Modules\Seller\Http\Controllers\Dashboard
 */
class LimitDiscountController extends Backend
{

    private $links = [
        ['url' => 'dashboard/limit-discount/list', 'text' => '限时折扣列表'],
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
        $title = '限时折扣列表';
        $fixed_title = '营销中心 - '.$title;

        $action_span = [
            [
                'id' => '',
                'url' => '/dashboard/center/index',
                'icon' => 'fa-reply',
                'text' => '返回营销中心'
            ],
            [
                'id' => '',
                'url' => 'add',
                'icon' => 'fa-plus',
                'text' => '添加限时折扣'
            ],
        ];

        $explain_panel = [
            '商家可在某一特定时期，设置指定商品打折促销，用以刺激消费者购买，以此提升销售业绩',
            '当一个商品同时参加了会员折扣、限时折扣时，下单时以两者中最优惠的活动结算，不会『折上折』',
            '系统中同一个商品同时只能参与一个促销活动'
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
        list($list, $total) = $this->activity->getLimitDiscountActivityList($where);

        $pageHtml = pagination($total);
        $page = frontend_pagination($total, true);

        if ($request->ajax()) {
            $render = view('dashboard.limit-discount.partials._list', compact('list', 'total', 'pageHtml'))->render();
            return result(0, $render);
        }

        // 获取数据

        $compact = compact('title', 'list', 'pageHtml');

        return view('dashboard.limit-discount.list', $compact);
    }

    public function view(Request $request)
    {
        $title = '查看';

        $id = $request->get('id', 0);
        $fixed_title = '限时折扣 - '.$title;

        $action_span = [
            [
                'url' => 'list',
                'icon' => 'fa-reply',
                'text' => '返回限时折扣列表'
            ],
        ];

        $explain_panel = [];
        $blocks = [
            'explain_panel' => $explain_panel,
            'fixed_title' => $fixed_title,
            'action_span' => $action_span
        ];

        $this->setLayoutBlock($blocks); // 设置block

        $model = $this->activity->getById($id);
        if (empty($model)) {
            abort(404, INVALID_PARAM);
        }

        $compact = compact('title', 'model');

        return view('dashboard.limit-discount.view', $compact);
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
            admin_log('限时折扣删除失败。ID：'.$id);
            return result(-1, null, '删除失败');
        }

        // Log
        admin_log('限时折扣删除成功。ID：'.$id);
        return result(0, null, '删除成功');
    }

    public function batchDelete(Request $request)
    {
        $ids = $request->post('ids');
        $ret = $this->activity->deleteActivity(0, $ids);

        $ids = implode(',', $ids);
        if ($ret === false) {
            // Log
            admin_log('限时折扣删除失败。ID：'.$ids);
            return result(-1, '', '删除失败');
        }
        // Log
        admin_log('删除了多个限时折扣。ID：'.$ids);
        return result(0, '', '删除成功');
    }
}