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
// | Date:2018-12-4
// | Description:
// +----------------------------------------------------------------------

namespace app\Modules\Seller\Http\Controllers\Dashboard;

use App\Models\Goods;
use App\Modules\Base\Http\Controllers\Seller;
use App\Repositories\ActivityCategoryRepository;
use App\Repositories\ActivityRepository;
use Illuminate\Http\Request;

/**
 * 团购活动管理
 *
 * Class GroupBuyController
 * @package app\Modules\Seller\Http\Controllers\Dashboard
 */
class GroupBuyController extends Seller
{

    private $links = [
        ['url' => 'dashboard/group-buy/list', 'text' => '列表'],
        ['url' => 'dashboard/group-buy/add', 'text' => '添加'],
        ['url' => 'dashboard/group-buy/edit', 'text' => '编辑'],
    ];

    protected $activity;
    protected $activityCategory;

    public function __construct()
    {
        parent::__construct();

        $this->activity = new ActivityRepository();
        $this->activityCategory = new ActivityCategoryRepository();

        $this->set_menu_select('dashboard', 'dashboard-center');
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
            ],
            [
                'id' => '',
                'url' => 'add',
                'icon' => 'fa-plus',
                'text' => '添加团购活动'
            ],
        ];

        $explain_panel = [
            '商家添加团购活动->平台方审核->审核通过->团购活动在前台团购页面展示',
            '团购活动结束之后，将会在前台团购页面消失'
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
        $condition = [
            'where' => $where,
            'sortname' => 'act_id',
            'sortorder' => 'asc',
        ];
        list($list, $total) = $this->activity->getList($condition);

        $pageHtml = pagination($total);

        if ($request->ajax()) {
            $render = view('dashboard.group-buy.partials._list', compact('list', 'total', 'pageHtml'))->render();
            return result(0, $render);
        }
        return view('dashboard.group-buy.list', compact('title', 'list', 'pageHtml'));
    }

    public function add(Request $request)
    {
        $title = '添加';

        $id = $request->get('id', 0);
        $this->sublink($this->links, 'add');

        if ($id) {
            // 更新操作
            $info = $this->activity->getById($id);
            view()->share('info', $info);
            $title = '编辑';
            $this->sublink($this->links, 'edit');
        }

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

        return view('dashboard.group-buy.add', compact('title', 'info'));
    }

    public function edit(Request $request)
    {
        return $this->add($request);
    }

    /**
     * 保存信息
     *
     * @param Request $request
     * @return mixed
     */
    public function saveData(Request $request)
    {
        $post = $request->post('ActivityModel');

        if (!empty($post['act_id'])) {
            // 编辑
            $ret = $this->activity->update($post['store_id'], $post);
            $msg = '团购活动编辑';
        }else {
            // 添加
            $post['shop_id'] = seller_shop_info()->shop_id;

            $ret = $this->activity->store($post);
            $msg = '团购活动添加';
        }

        if ($ret === false) {
            // fail
            return result(-1, null, $msg.'失败');
        }
        // success
        return result(0, null, $msg.'成功');
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

    public function batchDelete(Request $request)
    {
        $ids = $request->post('ids');
        $ret = $this->activity->batchDel($ids);

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

    /**
     * 选中商品时 异步加载商品信息
     *
     * @param Request $request
     * @return array
     * @throws \Throwable
     */
    public function goodsInfo(Request $request)
    {
        $goods_id = $request->post('goods_id');
        $goods_info = Goods::where('goods_id',$goods_id)->first();
        if (empty($goods_info)) {
            return result(-1, null, '商品ID无效');
        }
        if ($goods_info->goods_number <= 0) {
            return result(-1, null, '该商品库存不足，不可选择！');
        }

        // 查询活动分类列表（树形）
        $where = [];
        $where[] = ['is_show',1];
        $condition = [
            'where' => $where,
            'limit' => 0, // 不分页
            'sortname' => 'created_at',
            'sortorder' => 'desc',
        ];
        list($category_list, $category_total) = $this->activityCategory->getList($condition, '', false, true);

        $render = view('dashboard.group-buy.goods_info', compact('goods_info', 'category_list'))->render();
        return result(0, $render, '');
    }

}