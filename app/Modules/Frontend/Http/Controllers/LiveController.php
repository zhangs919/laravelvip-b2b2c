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
// | Date:2020-02-09
// | Description:直播
// +----------------------------------------------------------------------

namespace App\Modules\Frontend\Http\Controllers;

use App\Modules\Base\Http\Controllers\Frontend;
use App\Repositories\ActivityRepository;
use App\Repositories\CollectRepository;
use App\Repositories\LiveCategoryRepository;
use App\Repositories\LiveRepository;
use App\Services\AlibabaCloudLiveService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class LiveController extends Frontend
{

    protected $live;
    protected $liveCategory;
    protected $aliLiveService;
    protected $activity;
    protected $collect;


    public function __construct(
        LiveRepository $live
        ,LiveCategoryRepository $liveCategory
        ,AlibabaCloudLiveService $aliLiveService
        ,ActivityRepository $activity
        ,CollectRepository $collect
    )
    {
        parent::__construct();

        $this->live = $live;
        $this->liveCategory = $liveCategory;
        $this->aliLiveService = $aliLiveService;
        $this->activity = $activity;
        $this->collect = $collect;
    }

    /**
     * 直播列表
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function live(Request $request)
    {
        // 获取数据
        $params = $request->all();
        $cat_id = $request->get('cat_id', 0);

        $where = [];
        $where[] = ['status', 1];
        // 搜索条件
        $search_arr = ['cat_id'];
        foreach ($search_arr as $v) {
            if (isset($params[$v]) && !empty($params[$v])) {

                if ($v == 'keyword') {
                    $where[] = ['live_name', 'like', "%{$params[$v]}%"];
                } else {
                    $where[] = [$v, $params[$v]];
                }
            }
        }
        // 列表
        $condition = [
            'where' => $where,
            'sortname' => 'created_at',
            'sortorder' => 'desc',
        ];
        list($list, $total) = $this->live->getList($condition, '', $this->user_id);
        $pageHtml = frontend_pagination($total);
        $page_array = frontend_pagination($total, true);
        $json_page = json_encode($page_array);

        // 直播活动商品分类列表
        // 查询活动分类列表（树形）
        $where = [];
        $where[] = ['is_open',1];
        $condition = [
            'where' => $where,
            'limit' => 0, // 不分页
            'sortname' => 'created_at',
            'sortorder' => 'desc',
        ];
        list($cat_list, $cat_total) = $this->liveCategory->getList($condition);

        $session_id = '8lcss7dfc7lkdrg8v74ku8nn2f';
        $shop_name = null;
        $sort = 0;
        $order = 'desc';

        $seo_title = '直播列表 - '.sysconf('site_name');

        $compact = compact('seo_title','list','pageHtml','json_page','cat_id','cat_list',
            'session_id','shop_name','sort','order');

        $this->show_seo('seo_index', ['name'=>'直播列表']); // SEO

        $webData = []; // web端（pc、mobile）数据对象
        $data = [
            'app_prefix_data' => [
                'list' => $list,
                'page' => $page_array,
                'cat_id'=>$cat_id,
                'cat_list' => $cat_list,
                'session_id' => $session_id,
                'shop_name' => $shop_name,
                'sort' => $sort,
                'order' => $order
            ],
            'app_suffix_data' => [],
            'web_data' => $webData,
            'compact_data' => $compact,
            'tpl_view' => 'live.live'
        ];
        $this->setData($data); // 设置数据
        return $this->displayData(); // 模板渲染及APP客户端返回数据
    }

    public function detail(Request $request, $id)
    {
        // 获取数据
        $is_tourist = $this->user_id ? false : true;
        $live = $this->live->getById($id);
        if (empty($live)) {
            abort(404, INVALID_PARAM);
        }


        $region = $live->region;
        $shop_info = $live->shop;
        $shop_master = $shop_info->user; // 会员信息


        // 判断 不能登录自己的直播间!
        if ($shop_master->user_id == $this->user_id) {
//            abort(200, '不能登录自己的直播间!');
        }

        $is_collect = $this->collect->checkIsCollected($this->user_id, 1, $live->shop_id);
        $user = [
            'birthday' => $this->user->birthday ?? 0,
            'user_id' => $this->user->user_id ?? $this->session_id,
            'user_name' => $this->user->user_name ?? '游客_'.substr($this->session_id, 0, 10)
        ];

        $room_id = $id;
        $pull_stream = $this->aliLiveService->createStreamUrl($id, 1);
//        $pull_stream = "http://image.laravelvip.com/images/videos/site/1/gallery/2019/03/17/15528319959755.mp4";
        // 直播活动商品列表
        $goods_list = $this->activity->getLiveGoodsActivityInfo($live->act_id);
        $cart_goods_count = $this->cart_goods_num;

        $seo_title = $live->live_name;

        $app_prefix_data = [
            'is_tourist' => $is_tourist,
            'live' => $live,
            'region' => $region,
            'shop_info' => $shop_info,
            'shop_master' => $shop_master,
            'is_collect' => $is_collect,
            'user' => $user,
            'room_id' => $room_id,
            'pull_stream' => $pull_stream,
            'goods_list' => $goods_list,
            'cart_goods_count' => $cart_goods_count,
        ];
        $compact_data = $app_prefix_data;
        $compact_data['seo_title'] = $seo_title;
        $this->show_seo('seo_index', ['name'=>$live->live_name,'image'=>$live->live_img]); // SEO
        $webData = []; // web端（pc、mobile）数据对象
        $data = [
            'app_prefix_data' => $app_prefix_data,
            'app_suffix_data' => [],
            'web_data' => $webData,
            'compact_data' => $compact_data,
            'tpl_view' => 'live.detail'
        ];
        $this->setData($data); // 设置数据
        return $this->displayData(); // 模板渲染及APP客户端返回数据
    }

    /**
     * 更新在线人数
     *
     * @param Request $request
     * @return array|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function editOnlineNumber(Request $request)
    {
        $id = $request->input('id');
        $online_num = $request->input('online_num');
        $view_num = $request->input('view_num');
        if (!$id) {
            return result(-1, null, INVALID_PARAM);
        }

        // 更新在线人数
        $ret = $this->live->update($id, ['online_number' => $online_num, 'view_number' => $view_num+1]);
        if ($ret === false) {
            return result(-1, null, '更新失败');
        }
        return result(0, null, '更新成功');
    }
}