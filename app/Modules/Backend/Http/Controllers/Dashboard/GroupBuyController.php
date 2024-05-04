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
// | Date:2020-4-6
// | Description:团购
// +----------------------------------------------------------------------

namespace App\Modules\Backend\Http\Controllers\Dashboard;

use App\Modules\Base\Http\Controllers\Backend;
use App\Repositories\ActivityCategoryRepository;
use App\Repositories\ActivityRepository;
use App\Repositories\BrandRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\GoodsRepository;
use App\Repositories\SystemConfigRepository;
use App\Repositories\ToolsRepository;
use Illuminate\Http\Request;

/**
 * 团购活动管理
 *
 * Class GroupBuyController
 * @package app\Modules\Seller\Http\Controllers\Dashboard
 */
class GroupBuyController extends Backend
{

    private $links = [
        ['url' => 'dashboard/group-buy/group-buy_list', 'text' => '团购列表'],
        ['url' => 'dashboard/activity-category/activity-category_list', 'text' => '团购分类'],
        ['url' => 'dashboard/group-buy/slide-config', 'text' => '幻灯片管理'],
    ];

    protected $activity;
    protected $activityCategory;
    protected $tools;
    protected $goods;
    protected $category;
    protected $brand;
    protected $systemConfig;

    public function __construct(
        ActivityRepository $activity
        ,ActivityCategoryRepository $activityCategory
        ,ToolsRepository $tools
        ,GoodsRepository $goods
        ,CategoryRepository $category
        ,BrandRepository $brand
        ,SystemConfigRepository $systemConfig
    )
    {
        parent::__construct();

        $this->activity = $activity;
        $this->activityCategory = $activityCategory;
        $this->tools = $tools;
        $this->goods = $goods;
        $this->category = $category;
        $this->brand = $brand;
        $this->systemConfig = $systemConfig;

    }


    public function lists(Request $request)
    {
        $title = '团购列表';
        $fixed_title = '营销中心 - '.$title;

        $this->sublink($this->links, 'group-buy_list');

        $action_span = [
            [
                'id' => '',
                'url' => '/dashboard/center/index',
                'icon' => 'fa-reply',
                'text' => '返回营销中心'
            ],
        ];

        $explain_panel = [
            '店铺发起团购活动，平台方进行审核处理',
            '团购活动删除后，已提交的团购订单仍然有效'
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
        $search_arr = ['act_name','status','act_status'];
        foreach ($search_arr as $v) {
            if (isset($params[$v]) && !empty($params[$v])) {

                if ($v == 'key_word') {
                    $where[] = ['act_name', 'like', "%{$params[$v]}%"];
                } else {
                    $where[] = [$v, $params[$v]];
                }
            }
        }
        // 列表
        list($list, $total) = $this->activity->getGroupBuyActivityList($where);

        $pageHtml = pagination($total);

        if ($request->ajax()) {
            $render = view('dashboard.group-buy.partials._list', compact('list', 'total', 'pageHtml'))->render();
            return result(0, $render);
        }

        $compact = compact('title', 'list', 'pageHtml');

        return view('dashboard.group-buy.list', $compact);
    }

    public function view(Request $request)
    {
        $title = '查看';

        $id = $request->get('id', 0);
        $fixed_title = '团购活动 - '.$title;

        $action_span = [
            [
                'url' => 'list',
                'icon' => 'fa-reply',
                'text' => '返回团购活动列表'
            ],
        ];

        $explain_panel = [];
        $blocks = [
            'explain_panel' => $explain_panel,
            'fixed_title' => $fixed_title,
            'action_span' => $action_span
        ];

        $this->setLayoutBlock($blocks); // 设置block

        $info = $this->activity->getById($id);
        if (empty($info)) {
            abort(404, INVALID_PARAM);
        }
        list($goods_activity, $total) = $this->activity->getGroupBuyActivityInfo($id);

        $pageHtml = pagination($total);

        if ($request->ajax()) {
            $render = view('dashboard.group-buy.partials._view_list', compact('goods_activity', 'total', 'pageHtml'))->render();
            return result(0, $render);
        }

        $compact = compact('title', 'info', 'goods_activity', 'pageHtml');

        return view('dashboard.group-buy.view', $compact);
    }

    public function slideConfig(Request $request)
    {
        $group = 'group_buy_slide';
        $title = '幻灯片管理';
        $fixed_title = '营销中心 - '.$title;

        $this->sublink($this->links, 'slide-config');

        $config_info = $this->systemConfig->getSpecialConfigsByGroup($group, 'code');

        $action_span = [];
        $explain_panel = [
            '该组幻灯片滚动图片应用于团购页面使用，最多可上传4张图片',
            'pc端图片要求使用1920*440像素；手机端要求使用1000*400像素jpg、gif、png格式的图片',
            '上传图片后请添加格式为“http://网址...”链接地址，设定后将在显示页面中点击幻灯片将以另打开窗口的形式跳转到指定网址',
        ];
        $blocks = [
            'fixed_title' => $fixed_title,
            'action_span' => $action_span,
            'explain_panel' => $explain_panel,
        ];
        $this->setLayoutBlock($blocks); // 设置block


        return view('dashboard.group-buy.slide_config', compact('title', 'group', 'config_info'));
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
            admin_log('团购活动删除失败。ID：'.$id);
            return result(-1, null, '删除失败');
        }

        // Log
        admin_log('团购活动删除成功。ID：'.$id);
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
            admin_log('团购活动删除失败。ID：'.$ids);
            return result(-1, '', '删除失败');
        }
        // Log
        admin_log('删除了多个团购活动。ID：'.$ids);
        return result(0, '', '删除成功');
    }

    public function changeSort(Request $request)
    {
        $id = $request->post('id');
        $title = $request->post('title');
        $value = $request->post('value');

        if ($title == 'sort') {
            $value = intval($value);
        }

        $ret = $this->activity->update($id, [$title => $value]);

        if ($ret === false) {
            return result(-1, '', '设置失败');
        }
        return result(0, '', '设置成功');
    }

    public function setIsRecommend(Request $request)
    {
        $id = $request->get('id');
        $ret = $this->activity->changeState($id, 'is_recommend');
        if ($ret === false) {
            return result(-1, '', '设置失败');
        }
        return result(0, $ret, '设置成功');
    }

}