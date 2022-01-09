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
// | Date:2018-10-29
// | Description:采集控制
// +----------------------------------------------------------------------

namespace app\Modules\Backend\Http\Controllers\Shop;


use App\Models\Shop;
use App\Modules\Base\Http\Controllers\Backend;
use App\Repositories\CollectRepository;
use App\Repositories\ShopRepository;
use App\Repositories\SystemConfigRepository;
use Illuminate\Http\Request;

/**
 * 采集控制管理
 *
 * Class CollectController
 * @package app\Modules\Backend\Http\Controllers\Shop
 */
class CollectController extends Backend
{

    private $links = [
        ['url' => 'shop/collect/list', 'text' => '店铺采集控制'],
        ['url' => 'shop/collect/set', 'text' => '设置'],
        ['url' => 'shop/collect/add', 'text' => '添加'],
        ['url' => 'shop/collect/edit', 'text' => '编辑'],
    ];

    protected $shop;

    protected $systemConfig;

    public function __construct()
    {
        parent::__construct();

        $this->shop = new ShopRepository();
        $this->systemConfig = new SystemConfigRepository();

    }

    public function lists(Request $request)
    {
        $title = '列表';
        $fixed_title = '采集控制 - '.$title;

        $this->sublink($this->links, 'list', '', '', 'add,edit');

        $action_span = [
            [
                'url' => 'add',
                'icon' => 'fa-plus',
                'text' => '批量添加采集店铺'
            ],
        ];

        $explain_panel = [
            '平台管理员为店铺开启采集商品功能并设置每个店铺最多采集商品数量',
            '平台管理员为店铺开启采集功能后，店铺在卖家中心即可采集商品'
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
        $search_arr = ['key_word', 'shop_type'];
        foreach ($search_arr as $v) {
            if (isset($params[$v]) && !empty($params[$v])) {

                if ($v == 'key_word') { // 店铺ID/店铺名称/店主账号 todo
                    $where[] = ['', 'like', "%{$params[$v]}%"];
                } else {
                    $where[] = [$v, $params[$v]];
                }
            }
        }
        // 列表
        $condition = [
            'where' => $where,
            'sortname' => 'shop_sort',
            'sortorder' => 'asc',
        ];
        list($list, $total) = $this->shop->getList($condition);
        $pageHtml = pagination($total);
        $compact = compact('title', 'list', 'total', 'pageHtml');
        if ($request->ajax()) {
            $render = view('shop.collect.partials._list', $compact)->render();
            return result(0, $render);
        }
        return view('shop.collect.list', $compact);
    }


    public function add(Request $request)
    {
        $title = '添加';
        $this->sublink($this->links, 'add', '', '', 'edit');

        $tpl = 'add';
        $id = $request->get('id', 0);

        if ($id) {
            // 更新操作
            $tpl = 'edit';
            $info = $this->shop->getById($id);
            view()->share('info', $info);
            $title = '编辑';
            $this->sublink($this->links, 'edit', '', '', 'add');
        }

        $fixed_title = '采集控制 - '.$title;

        $action_span = [
            [
                'url' => 'list',
                'icon' => 'fa-reply',
                'text' => '返回采集控制列表'
            ]
        ];
        $explain_panel = [];
        $blocks = [
            'fixed_title' => $fixed_title,
            'action_span' => $action_span,
            'explain_panel' => $explain_panel
        ];
        $this->setLayoutBlock($blocks); // 设置block

        // 获取店铺列表 只查询允许采集商品数量及允许采集评论次数为0的店铺
        $where[] = ['shop_status', 1];
        $where[] = ['collect_allow_number', 0];
        $where[] = ['comment_allow_number', 0];
        $condition = [
            'where' => $where,
            'sortname' => 'shop_sort',
            'sortorder' => 'asc',
            'field' => ['shop_id', 'shop_name']
        ];
        list($shop_list, $total) = $this->shop->getList($condition);

        return view('shop.collect.'.$tpl, compact('title', 'shop_list'));
    }

    public function edit(Request $request)
    {
        return $this->add($request);
    }

    public function saveData(Request $request)
    {
        $post = $request->post('CollectModel');
        $shop_id = $request->get('id', 0);
        if ($shop_id > 0) {
            // 编辑单个店铺
            $info = $this->shop->getById($shop_id); // 获取采集控制信息

            // 处理数据
            $change_type = $post['change_type']; // 调整采集商品数量 调整类型 0增加 1减少 2覆盖
            $change_number = $post['change_number']; // 调整采集商品数量
            if ($change_type == 0) {
                $post['collect_allow_number'] = $info->collect_allow_number + $change_number;
            } elseif ($change_type == 1) {
                $post['collect_allow_number'] = $info->collect_allow_number - $change_number;
            } elseif ($change_type == 2) {
                $post['collect_allow_number'] = $change_number;
            }
            $change_comment_type = $post['change_comment_type']; // 调整采集评论次数 调整类型 0增加 1减少 2覆盖
            $change_comment_number = $post['change_comment_number']; // 调整采集评论次数
            if ($change_comment_type == 0) {
                $post['comment_allow_number'] = $info->comment_allow_number + $change_comment_number;
            } elseif ($change_comment_type == 1) {
                $post['comment_allow_number'] = $info->comment_allow_number - $change_comment_number;
            } elseif ($change_comment_type == 2) {
                $post['comment_allow_number'] = $change_comment_number;
            }

            $ret = $this->shop->update($shop_id, $post);
            $msg = '采集控制编辑';
        }else {
            // 批量添加采集店铺
            $shop_ids = $post['shop_id'];
            unset($post['shop_id']);
            $ret = Shop::whereIn('shop_id', $shop_ids)->update($post);
            $msg = '采集控制添加';
        }

        if ($ret === false) {
            // fail
            flash('error', $msg.'失败');
            return redirect('/shop/collect/list');
        }
        // success
        flash('success', $msg.'成功');
        return redirect('/shop/collect/list');
    }

    public function set(Request $request)
    {
        $group = 'shop_collect'; // 当前配置分组
        $group_info = $this->systemConfig->getConfigList($group);
        $uuid = make_uuid();
        $script_render = view('system.config.partials.'.$group, compact('uuid'))->render();

        $title = '设置';
        $fixed_title = '采集控制 - '.$title;
        $this->sublink($this->links, 'set', '', '', 'add,edit');

        $action_span = [];
        $explain_panel = [
            '修改设置后，需清理缓存方可起作用',
        ];
        $blocks = [
            'fixed_title' => $fixed_title,
            'action_span' => $action_span,
            'explain_panel' => $explain_panel,
        ];
        $this->setLayoutBlock($blocks); // 设置block

        $introduce_box = '';

        return view('system.config.config', compact('title', 'group', 'group_info', 'script_render', 'introduce_box'));
    }


}