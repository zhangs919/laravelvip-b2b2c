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
// | Date:2018-08-17
// | Description: 积分商城
// +----------------------------------------------------------------------

namespace App\Modules\Frontend\Http\Controllers\Integralmall;

use App\Modules\Base\Http\Controllers\Frontend;
use App\Repositories\BonusRepository;
use App\Repositories\CollectRepository;
use App\Repositories\IntegralGoodsRepository;
use App\Repositories\SelfPickupRepository;
use App\Repositories\ShopRepository;
use Illuminate\Http\Request;

class IndexController extends Frontend
{

    protected $integralGoods;
    protected $collect;
    protected $bonus;
    protected $shop;
    protected $selfPickup;

    public function __construct(
        IntegralGoodsRepository $integralGoods
        ,CollectRepository $collect
        ,BonusRepository $bonus
        ,ShopRepository $shop
        ,SelfPickupRepository $selfPickup
    )
    {
        parent::__construct();

        $this->integralGoods = $integralGoods;
        $this->collect = $collect;
        $this->bonus = $bonus;
        $this->shop = $shop;
        $this->selfPickup = $selfPickup;

    }

    /**
     * 积分商城首页
     *
     * @param Request $request
     * @return mixed
     */
    public function index(Request $request)
    {
        $seo_title = '积分商城首页';

        // 获取数据
        $shop_id = '-1';
        $user = !empty($this->user) ? $this->user->toArray() : null;
        $user_rank = $this->user_rank_info;
        $exchanged_count = 0;
        $default_user_portrait = sysconf('default_user_portrait');
        $banner = [];

        $where = [];
        $where[] = ['bonus_type', 10]; // 红包类型 10-积分兑换红包
        $where[] = ['is_delete', 0]; // 未删除状态


        $condition = [
            'where' => $where,
            'sortname' => 'bonus_id',
            'sortorder' => 'desc',
        ];
        // 列表
        list($bonus_list, $bonus_total) = $this->bonus->getFrontendBonusList($condition);

        $points_list = null;

        // 积分商品列表
        $where = [];
        $where[] = ['goods_status', 1];

        // 列表
        $condition = [
            'where' => $where,
            'sortname' => 'goods_sort',
            'sortorder' => 'asc'
        ];
        list($list, $total) = $this->integralGoods->getGoodsList($condition);

        $pageHtml = frontend_pagination($total);
        $page_array = frontend_pagination($total, true);
        $json_page = json_encode($page_array);

        $sort = $request->get('sort',null);
        $order = $request->get('order',null);
        $can_exchange = $request->get('can_exchange',null);
        $integral_model = $request->get('integral_model',null);

        $compact = compact('seo_title',
                'shop_id','user','user_rank','exchanged_count','default_user_portrait',
                'banner','bonus_list','list','pageHtml','json_page','sort','order',
                'can_exchange','integral_model');

        $webData = []; // web端（pc、mobile）数据对象
        $data = [
            'app_prefix_data' => [
                'shop_id' => $shop_id,
                'user' => $user,
                'user_rank' => $user_rank,
                'exchanged_count' => $exchanged_count,
                'default_user_portrait' => $default_user_portrait,
                'banner' => $banner,
                'bonus_list' => $bonus_list,
                'points_list' => $points_list,
                'sort' => $sort,
                'order' => $order,
                'can_exchange' => $can_exchange,
                'integral_model' => $integral_model,
            ],
            'app_suffix_data' => [],
            'web_data' => $webData,
            'compact_data' => $compact,
            'tpl_view' => 'integralmall.index.index'
        ];
        $this->setData($data); // 设置数据
        return $this->displayData(); // 模板渲染及APP客户端返回数据
    }

    /**
     * 红包兑换
     *
     * @param Request $request
     * @return mixed
     */
    public function bonusList(Request $request)
    {
        $seo_title = '红包兑换';

        $compact = compact('seo_title');

        return view('integralmall.index.bonus_list', $compact);
    }

    /**
     * 积分商品详情
     *
     * @param Request $request
     * @param $goods_id
     * @return mixed
     */
    public function showGoods(Request $request, $goods_id)
    {
//        $seo_title = '积分商品详情';

        // 获取数据
        // 积分商品列表
        $where = [];
        $where[] = ['goods_status', 1];

        // 列表
        $condition = [
            'where' => $where,
            'sortname' => 'sale_num',
            'sortorder' => 'desc'
        ];
        list($hot_list, $hot_total) = $this->integralGoods->getGoodsList($condition);
        $goods = $this->integralGoods->getGoodsInfo($goods_id, $this->user_id);
        $shop_info = $this->shop->shopInfo($goods['shop_id']);

        $shop_goods_count = 0;
        $shop_collect_count = '0';
        // 自提点
        $condition = [
            'where' => [
                ['is_show', 1],
                ['is_delete',0],
                ['shop_id', $goods['shop_id']]
            ],
            'limit' => 0,
            'sortname' => 'pickup_id',
            'sortorder' => 'desc',
        ];
        list($pickup, $pickup_total) = $this->selfPickup->getList($condition);
        $pickup = $pickup->toArray();

        $user_info = !empty($this->user) ? $this->user->toArray() : null;
        $can_exchange = false;
        $can_exchange_msg = '积分不足';
        $yikf_url = null;

        $compact = compact('hot_list','shop_info','shop_goods_count','shop_collect_count',
            'pickup','user_info','goods','can_exchange','can_exchange_msg','yikf_url');
        $webData = []; // web端（pc、mobile）数据对象
        $data = [
            'app_prefix_data' => [
                'hot_list' => $hot_list,
                'shop_info' => $shop_info,
                'shop_goods_count' => $shop_goods_count,
                'shop_collect_count' => $shop_collect_count,
                'pickup' => $pickup,
                'user_info' => $user_info,
                'goods' => $goods,
                'can_exchange' => $can_exchange,
                'can_exchange_msg' => $can_exchange_msg,
                'yikf_url' => $yikf_url,
            ],
            'app_suffix_data' => [],
            'web_data' => $webData,
            'compact_data' => $compact,
            'tpl_view' => 'integralmall.index.show_goods'
        ];
        $this->setData($data); // 设置数据
        return $this->displayData(); // 模板渲染及APP客户端返回数据
    }

    /**
     * 积分兑换红包
     *
     * @param Request $request
     * @return mixed
     */
    public function bonusExchange(Request $request)
    {
        $pointEmpty = false; // 积分不足
        if ($pointEmpty) {
            return result(-1, null, '积分不足');
        }
        $extra = [
            'send_number' => 25,
            'pay_point' => 150
        ];

        return result(0, null, '兑换成功', $extra);
    }

    /**
     * 验证是否登录
     *
     * @param Request $request
     * @return mixed
     */
    public function validates(Request $request)
    {
        //code: 0
        //data: 0 总积分
        //frozen_point: 0 线上冻结积分
        //message: "校验成功"
        //pay_point: 0 线上可用积分

        if (!is_login()) {
            return result(-1, null, '校验失败');
        }
        $frozen_point = $this->user->frozen_point;
        $pay_point = $this->user->pay_point;
        return result(0, $this->user->pay_point, '校验成功', ['frozen_point'=>$frozen_point,'pay_point'=>$pay_point]);
    }


}