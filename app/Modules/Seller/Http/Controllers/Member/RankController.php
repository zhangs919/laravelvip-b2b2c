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
// | Date:2018-11-08
// | Description: 店铺会员等级管理
// +----------------------------------------------------------------------

namespace App\Modules\Seller\Http\Controllers\Member;

use App\Models\ShopRank;
use App\Models\UserShopRank;
use App\Modules\Base\Http\Controllers\Seller;
use App\Repositories\ShopRankRepository;
use Illuminate\Http\Request;

class RankController extends Seller
{
    private $links = [
        ['url' => 'member/rank/list', 'text' => '列表'],
        ['url' => 'member/rank/add', 'text' => '添加'],
        ['url' => 'member/rank/edit', 'text' => '编辑'],
    ];

    protected $shopRank;

    public function __construct(ShopRankRepository $shopRank)
    {
        parent::__construct();

        $this->shopRank = $shopRank;

        $this->set_menu_select('member', 'member-level');
    }

    public function lists(Request $request)
    {
        $title = '列表';
        $fixed_title = '会员等级 - '.$title;
        $this->sublink($this->links, 'list', '', '', 'add,edit');
        $action_span = [
            [
                'url' => 'add',
                'icon' => 'fa-plus',
                'text' => '添加会员等级'
            ],
        ];
        $explain_panel = [
            '非特殊会员等级：会员等级按照累计交易次数或累计消费金额的变化自动升级',
            '特殊会员等级的会员不会随着累计交易次数或累计消费金额的变化而变化',
            '是否启用：是，则会员等级可供使用；否：则会员等级不可用',
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
        $search_arr = [];
//        foreach ($search_arr as $v) {
//            if (isset($params[$v]) && !empty($params[$v])) {
//
//                if ($v == 'role_name') {
//                    $where[] = [$v, 'like', "%{$params[$v]}%"];
//                } else {
//                    $where[] = [$v, $params[$v]];
//                }
//            }
//        }
        // 列表
        $condition = [
            'where' => $where,
            'sortname' => 'rank_id',
            'sortorder' => 'desc'
        ];
        list($list, $total) = $this->shopRank->getList($condition);
        $pageHtml = pagination($total);

        $compact = compact('title', 'list', 'total', 'pageHtml');
        if ($request->ajax()) {
            $render = view('member.rank.partials._list', $compact)->render();
            return result(0, $render);
        }
        return view('member.rank.list', $compact);
    }

    public function add(Request $request)
    {
        $title = '添加';
        $this->sublink($this->links, 'add', '', '', 'edit');

        $id = $request->get('id', 0);
        $is_special = $request->get('is_special', 0); // 是否特殊会员等级

        $rank_levels = ShopRank::where('shop_id', seller_shop_info()->shop_id)->select(['rank_level'])->pluck('rank_level')->toArray();
        $shop_rank_list = ShopRank::where('shop_id', seller_shop_info()->shop_id)->select(['rank_id', 'rank_name'])->get();

        if ($id) {
            // 更新操作
            $title = '编辑';
            $this->sublink($this->links, 'edit', '', '', 'add');
            $info = $this->shopRank->getById($id);
            view()->share('info', $info);

            $rank_levels = ShopRank::select(['rank_level'])
                ->where([['shop_id', seller_shop_info()->shop_id], ['rank_id', '!=', $info->rank_id]])
                ->pluck('rank_level')->toArray();
            $shop_rank_list = ShopRank::where([['shop_id', seller_shop_info()->shop_id], ['rank_id', '!=', $info->rank_id]])->select(['rank_id', 'rank_name'])->get();

            $is_special = $info->is_special;
        }

        $tpl = 'add';
        if ($is_special) {
            // 如果是特殊会员等级
            $tpl = 'add_special';
        }

        $fixed_title = '会员等级 - '.$title;

        $action_span = [
            [
                'url' => 'list',
                'icon' => 'fa-reply',
                'text' => '返回会员等级列表'
            ]
        ];
        $explain_panel = [];
        $blocks = [
            'fixed_title' => $fixed_title,
            'action_span' => $action_span,
            'explain_panel' => $explain_panel
        ];
        $this->setLayoutBlock($blocks); // 设置block

        $rank_level_list = UserShopRank::select(['rank_level'])->pluck('rank_level')->toArray();

        foreach ($rank_level_list as $k=>$v) {
            if (in_array($v, $rank_levels)) {
                unset($rank_level_list[$k]);
            }
        }

        return view('member.rank.'.$tpl, compact('title', 'rank_level_list', 'shop_rank_list'));
    }

    public function edit(Request $request)
    {
        return $this->add($request);
    }

    public function saveData(Request $request)
    {
        $post = $request->post('ShopRankModel');

        if (!empty($post['rank_id'])) {
            // 编辑
            $ret = $this->shopRank->update($post['rank_id'], $post);
            $msg = '编辑';
        }else {
            // 添加
            $ret = $this->shopRank->store($post);
            $msg = '添加';
        }

        if ($ret === false) {
            // fail
            flash('error', $msg.'失败');
            return redirect('/member/rank/list');
        }
        // success
        flash('success', $msg.'成功');
        return redirect('/member/rank/list');
    }

    /**
     * 获取会员等级名称
     *
     * @param Request $request
     * @return array
     */
    public function getLevelName(Request $request)
    {
        $level = $request->get('level');
        $levelName = UserShopRank::where('rank_level', $level)->value('rank_name');

        return result(0, $levelName);
    }

    /**
     * 名称验证是否重复
     *
     * @param Request $request
     * @return mixed
     */
    public function clientValidate(Request $request)
    {
        $result = $this->shopRank->clientValidate($request, 'ShopRankModel');
        if (!$result['code']) {
            return result(-1, '', $result['message']);
        }
        return result(0);
    }

    public function setIsEnable(Request $request)
    {
        $id = $request->get('id');
        $ret = $this->shopRank->changeEnable($id);
        if ($ret === false) {
            return result(-1, '', '设置失败');
        }
        return result(0, $ret, '设置成功');
    }

    public function delete(Request $request)
    {
        $id = $request->get('id');
        $ret = $this->shopRank->del($id);
        if ($ret === false) {
            // Log
            shop_log('店铺会员等级删除失败。ID：'.$id);
            return result(-1, '', '删除失败');
        }

        // Log
        shop_log('店铺会员等级删除成功。ID：'.$id);
        return result(0, '', '删除成功');
    }
}