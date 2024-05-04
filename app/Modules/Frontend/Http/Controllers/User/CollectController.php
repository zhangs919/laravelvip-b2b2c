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

use App\Models\Goods;
use App\Models\Shop;
use App\Modules\Base\Http\Controllers\UserCenter;
use App\Repositories\CollectRepository;
use Illuminate\Http\Request;

class CollectController extends UserCenter
{

    protected $collect;

    public function __construct(CollectRepository $collect)
    {
        parent::__construct();

        $this->collect = $collect;
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

        if ($tab == 'invalid_list') { // todo 无效商品
            list($list, $total) = [[], 0];
        }

        $pageHtml = frontend_pagination($total);
        $page_array = frontend_pagination($total, true);
        $page_json = json_encode($page_array);
        $goods_collect_count = $this->collect->getUserCollectCount($this->user_id, 0);
        $shop_collect_count = $this->collect->getUserCollectCount($this->user_id, 1);

        $compact = compact('seo_title', 'list','pageHtml', 'page_json', 'total','goods_collect_count','shop_collect_count','tab');


        if ($request->ajax()) {
            $render = view('user.collect.partials._'.$tab, $compact)->render();
            return result(0, $render);
        }

        $webData = []; // web端（pc、mobile）数据对象
        $data = [
            'app_prefix_data' => [
                'page' => $page_array,
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

    /**
     * 店铺收藏列表
     *
     * @param Request $request
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Throwable
     */
    public function shop(Request $request)
    {

        // 获取数据
        $seo_title = '用户中心';
        $tab = $request->get('tab','');
        $curPage = $request->get('curpage', 1);
        $pageSize = 10;

        list($list, $total) = $this->collect->getUserCollect($this->user_id, 1, $curPage, $pageSize);
        if (!empty($list)) {
            foreach ($list as &$item) {
                $goods_list = Goods::where('shop_id',$item['shop_id'])->select(['goods_id','goods_name','goods_image'])->limit(4)->get();
                $item['goods_list'] = $goods_list->toArray();
            }
        }

        if ($tab == 'buy_shop_list') { // todo 已购
            list($list, $total) = [[],0];
        }

        $pageHtml = frontend_pagination($total);
        $page_array = frontend_pagination($total, true);
        $page_json = json_encode($page_array);
        $goods_collect_count = $this->collect->getUserCollectCount($this->user_id, 0);
        $shop_collect_count = $this->collect->getUserCollectCount($this->user_id, 1);

        $compact = compact('seo_title', 'list','pageHtml','page_json', 'total','goods_collect_count','shop_collect_count');

        if ($tab == 'all_shop') {
            if ($request->get('type', 0) == 1) {
                $render = view('user.collect.partials._ajax_shop_list', $compact)->render();
                return result(0, $render);
            }

            $render = view('user.collect.partials._shop_list', $compact)->render();
            return result(0, $render);
        } elseif ($tab == 'buy_shop_list') {
            $render = view('user.collect.partials._buy_shop_list', $compact)->render();
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
     * 商品/店铺 关注/取消关注
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

        if ($shop_id) { // 店铺关注/取消关注
            if ($this->collect->checkIsCollected($this->user_id, 1, $shop_id)) {
                // 取消关注
                $msg = '取消关注';
            } else {
                // 关注
                $msg = '关注';
            }
            $ret = $this->collect->toggle($this->user_id, 1, $shop_id);
            if ($ret === false) {
                // 失败
                return result(-1, null, $msg.'失败');
            }
            if ($show_count == 1) {
                // 显示关注数量
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

    /**
     * 删除收藏
     * @param Request $request
     * @return array
     */
    public function deleteCollect(Request $request)
    {
        $id = $request->get('id');
        $id = explode(',', $id);

        $ret = $this->collect->batchDel($id);
        if ($ret === false) {
            return result(-1, null, '删除失败');
        }

        $extra = [
            'buy_count' => 0,
            'collect_count' => 0,
            'invalid_count' => 0,
            'shop_count' => 0,
            'shop_count_list' => 0
        ];
        return result(0, null, '删除成功！', $extra);
    }

}