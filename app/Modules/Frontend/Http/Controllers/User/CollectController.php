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
// | Date:2018-12-18
// | Description:商品/店铺 收藏/取消收藏
// +----------------------------------------------------------------------

namespace App\Modules\Frontend\Http\Controllers\User;

use App\Models\Collect;
use App\Models\Goods;
use App\Models\Shop;
use App\Modules\Base\Http\Controllers\UserCenter;
use App\Repositories\CollectRepository;
use Illuminate\Http\Request;

class CollectController extends UserCenter
{

    protected $collect;

    public function __construct()
    {
        parent::__construct();

        $this->collect = new CollectRepository();
    }

    /**
     * 商品收藏列表
     *
     * @param Request $request
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Throwable
     */
    public function index(Request $request)
    {
        // 获取数据
        $seo_title = '用户中心';
        $tab = $request->get('tab','');
        $curPage = $request->get('curpage', 1);
        $pageSize = 10;

        list($list, $total) = $this->collect->getUserCollect($this->user_id, 0, $curPage, $pageSize);
        $pageHtml = frontend_pagination($total);
        $page_json = frontend_pagination($total, true);
        $goods_collect_count = $this->collect->getUserCollectCount($this->user_id, 0);
        $shop_collect_count = $this->collect->getUserCollectCount($this->user_id, 1);

        $compact = compact('seo_title', 'list','pageHtml', 'total','goods_collect_count','shop_collect_count');

        if ($tab == 'goods_list') {
            $render = view('user.collect.partials._goods_list', $compact)->render();
            return result(0, $render);
        }

        $webData = []; // web端（pc、mobile）数据对象
        $data = [
            'app_prefix_data' => [
                'page' => $page_json,
                'list' => $list,
                'nav_default' => 'collect',
                'goods_collect_count' => $goods_collect_count,
                'shop_collect_count' => $shop_collect_count
            ],
            'app_suffix_data' => [],
            'web_data' => $webData,
            'compact_data' => $compact,
            'tpl_view' => 'user.collect.goods'
        ];
        $this->setData($data); // 设置数据
        return $this->displayData(); // 模板渲染及APP客户端返回数据
    }

    public function shop(Request $request)
    {

        // 获取数据
        $seo_title = '用户中心';
        $tab = $request->get('tab','');
        $curPage = $request->get('curpage', 1);
        $pageSize = 10;

        list($list, $total) = $this->collect->getUserCollect($this->user_id, 1, $curPage, $pageSize);
        $pageHtml = frontend_pagination($total);
        $page_json = frontend_pagination($total, true);
        $goods_collect_count = $this->collect->getUserCollectCount($this->user_id, 0);
        $shop_collect_count = $this->collect->getUserCollectCount($this->user_id, 1);

        $compact = compact('seo_title', 'list','pageHtml', 'total','goods_collect_count','shop_collect_count');

        if ($tab == 'all_shop') {
            $render = view('user.collect.partials._shop_list', $compact)->render();
            return result(0, $render);
        }

        $webData = []; // web端（pc、mobile）数据对象
        $data = [
            'app_prefix_data' => [
                'page' => $page_json,
                'list' => $list,
                'nav_default' => 'collect',
                'collect_count' => $shop_collect_count,
                'goods_collect_count' => $goods_collect_count,
                'shop_collect_count' => $shop_collect_count
            ],
            'app_suffix_data' => [],
            'web_data' => $webData,
            'compact_data' => $compact,
            'tpl_view' => 'user.collect.shop'
        ];
        $this->setData($data); // 设置数据
        return $this->displayData(); // 模板渲染及APP客户端返回数据
    }

    /**
     * 商品/店铺 收藏/取消收藏
     *
     * @param Request $request
     * @return array
     */
    public function toggle(Request $request)
    {

        $goods_id = $request->input('goods_id', 0);
        $sku_id = $request->input('sku_id', 0);
        $show_count = $request->input('show_count', 0);
        $shop_id = $request->input('shop_id', 0);

        $collect_count = null;

        if ($shop_id) { // 店铺收藏/取消收藏
            if ($this->collect->checkIsCollected($this->user_id, 1, $shop_id)) {
                // 取消收藏
                $msg = '取消收藏';
            } else {
                // 收藏
                $msg = '收藏';
            }
            $ret = $this->collect->toggle($this->user_id, 1, $shop_id);
            if ($ret === false) {
                // 失败
                return result(-1, null, $msg.'失败');
            }
            if ($show_count == 1) {
                // 显示收藏数量
                $collect_count = Shop::where('shop_id', $shop_id)->value('collect_num');
            }
        } elseif ($goods_id && $sku_id) { // 商品收藏/取消收藏
            if ($this->collect->checkIsCollected($this->user_id, 0, 0, $goods_id)) {
                // 取消收藏
                $msg = '取消收藏';
            } else {
                // 收藏
                $msg = '收藏';
            }

            $ret = $this->collect->toggle($this->user_id, 0, 0, $goods_id, $sku_id);
            if ($ret === false) {
                // 失败
                return result(-1, null, $msg.'失败');
            }
            if ($show_count == 1) {
                // 显示收藏数量
                $collect_count = Goods::where('goods_id', $goods_id)->value('collect_num');
            }
        } else {
            // todo ...

            $ret = 1;
            $msg = '收藏';
        }

        // 成功
        $extra = [
            'bonus_info' => null,
            'collect_count' => $collect_count,
            'show_collect_count' =>"1"
        ];
        return result(0, $ret, $msg.'成功', $extra);
    }



}