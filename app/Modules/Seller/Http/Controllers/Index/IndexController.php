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
// | Date:2018-08-29
// | Description:
// +----------------------------------------------------------------------

namespace App\Modules\Seller\Http\Controllers\Index;

use App\Models\Member;
use App\Models\OrderInfo;
use App\Models\ShopPayment;
use App\Models\ShopRank;
use App\Modules\Base\Http\Controllers\Seller;
use App\Repositories\ArticleRepository;
use App\Repositories\ContractRepository;
use App\Repositories\ShopRepository;
use App\Repositories\UserMessageRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class IndexController extends Seller
{

    protected $shop;
    protected $article;
    protected $userMessage;
    protected $contract;

    public function __construct(
        ShopRepository $shop
        ,ArticleRepository $article
        ,UserMessageRepository $userMessage
        ,ContractRepository $contract
    )
    {
        parent::__construct();

        $this->shop = $shop;
        $this->article = $article;
        $this->userMessage = $userMessage;
        $this->contract = $contract;
		$this->set_menu_select('index', 'index-welcome');

    }

    /**
     * 欢迎页
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function welcome(Request $request)
    {
        $title = '欢迎页';

        // 获取数据
		$shop_id = $this->shop_id;

        // 保障服务
        $contract_list = $this->contract->getSellerShopContract($shop_id, 1);

        $shop_info = $this->shop->shopInfo($shop_id);
		$shop_info['shop']['qrcode'] = $this->shop->getShopQrCode($shop_id);

        $pay_info = ShopPayment::where('shop_id', $shop_id)->orderBy('apply_time','desc')->first(); // 店铺开通/续费信息
        $pay_info = !empty($pay_info) ? $pay_info->toArray() : null;
        $user_info = auth('seller')->user()->toArray();

        // 系统消息列表
        $where = [];
        $where[] = ['status',1];
        $where[] = ['cat_id',20]; // 商家公告
        // 列表
        $condition = [
            'where' => $where,
            'field' => ['article_id','title','add_time','link'],
            'limit' => 5
        ];
        list($system_message_list, $total) = $this->article->getList($condition);
        $system_message_list = $system_message_list->toArray();

        // 站内信
        $where = [];
        $where[] = ['receiver', $this->seller_id];
        $where[] = ['type', 2]; // 店铺消息
        $condition = [
            'join' => [
                [
                    'join_table' => 'message',
                    'join_first' => 'user_message.msg_id',
                    'join_operator' => '=',
                    'join_second' => 'message.msg_id',
                    'join_type' => 'left',
                    'join_where' => false,
                ]
            ],
            'where' => $where,
//            'sortname' => 'rec_id',
//            'sortorder' => 'desc',
            'field' => ['user_message.rec_id','user_message.msg_id','user_message.status','user_message.read_time','message.send_time','message.content'],
            'limit' => 5
        ];
        list($internal_message_list, $total) = $this->userMessage->getList($condition);
        $internal_message_list = $internal_message_list->toArray();

        // 最近10天销售情况
        $sell_x = [];
        $sell_y = [];
        $i = 9;
        while ($i >= 0) {
            $time = strtotime("-{$i} day");
            $sell_x[] = date('m月d日', $time);
            $i--;
            $sell_y[] = OrderInfo::where([['shop_id',$this->shop_id]])
                ->whereDate('created_at', date('Y-m-d', $time))
                ->sum('order_amount');
        }

        // 客户等级
        $shop_Ranks = ShopRank::where('shop_id', $this->shop_id)->select(['rank_id', 'rank_name'])->get();
        $customer_data = [];
        $customer_text = [];
        foreach ($shop_Ranks as $v) {
            $value = Member::where([['shop_id', $this->shop_id],['rank_id', $v->rank_id]])->count();
            $customer_text[] = $v->rank_name;
            $customer_data[] = [
                'name' => $v->rank_name,
                'value' => $value
            ];
        }

        $unread_msg_cnt = '0';
        $shop_name = null;
        $end_time = null;
        $user_role_codes = null;
        $user_auth_codes = 'all';

        $compact = compact('contract_list','shop_info', 'pay_info', 'user_info', 'system_message_list', 'internal_message_list'
                , 'sell_x', 'sell_y','customer_text','customer_data'
                , 'unread_msg_cnt','shop_name','end_time','user_role_codes','user_auth_codes');

        $webData = []; // web端（pc、mobile）数据对象
        $data = [
            'app_extra_data' => [],
            'app_prefix_data' => [
                'shop_info' => $shop_info,
                'pay_info' => $pay_info,
                'user_info' => $user_info,
                'system_message_list' => $system_message_list,
                'internal_message_list' => $internal_message_list,
                'sell_x' => $sell_x,
                'sell_y' => $sell_y,
                'customer_text' => $customer_text,
                'customer_data' => $customer_data,
                'unread_msg_cnt' => $unread_msg_cnt,
                'shop_name' => $shop_name,
                'end_time' => $end_time,
                'user_role_codes' => $user_role_codes,
                'user_auth_codes' => $user_auth_codes,
                'free-buy-order-list' => 1,
                'free-buy-order-edit' => 1,
                'free-buy-order-export' => 1,
                'free-buy-order-veri' => 1,
                'reach-buy-order-list' => 1,
                'reach-buy-order-edit' => 1,
                'reach-buy-order-export' => 1,
                'reach-buy-order-veri' => 1,
                'user-validate' => 1,
                'scan-code-cashier' => 1,
                'is_freebuy_enable' => 1,
                'is_reachbuy_enable' => 1,
                'is_scancode_enable' => 1,
                'site' => null,
            ],
            'app_context_data' => $this->getAppContext(),
            'app_suffix_data' => [],
            'web_data' => $webData,
            'compact_data' => $compact,
            'tpl_view' => 'index.index.welcome'
        ];
        $this->setData($data); // 设置数据
        return $this->displayData(); // 模板渲染及APP客户端返回数据
    }

    public function getData()
    {

        $data = [
            'after_sale_order_count'=> '0',
            'backing_order_count' => '0',
            'exchange_order_count'=> '0',
            'illegal_goods_count' => '0',
            'involve_complaint_count' => '0',
            'live_enable' => false,
            'offsale_goods_count' => '0',
            'onsale_goods_count' => '0',
            'today_gains' => 0,
            'today_order_count' => '0',
            'today_users_count' => '0',
            'unevaluate_order_count' => '0',
            'unpayed_order_count' => '0',
            'unshipping_order_count' => '0',
            'wait_audit_goods_count' => '0',
            'wait_complaint_count' => '0',
        ];
        return $data;
    }

    public function showMessage()
    {

        return result(0, 1);
    }

    /**
     * 续费提醒
     *
     * @return array|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function expirationReminding()
    {
        // 检查店铺是否缴费或过期
        // 1个月内即将过期
        $isExpired = DB::table('shop')->where('shop_id',$this->shop_id)->whereBetween('end_time', [Carbon::parse('-1 months')->timestamp, time()])->count();
        if ($isExpired) {
            // 未缴费/过期
            $data = [
                'end_time' => null,
                'shop_name' => sysconf('site_name')
            ];
            return result(0, $data);
        }

        // 店铺正常
        return result(1);
    }

    /**
     * 可删
     *
     */
    /*public function guide()
    {
        $title = '新手向导';
        $fixed_title = '新手向导';
        $blocks = [
            'fixed_title' => $fixed_title,
        ];

        $this->setLayoutBlock($blocks); // 设置block

        return view('index.index.guide', compact('title'));
    }*/

    /**
     * 店铺指引
     *
     * @param Request $request
     * @return array|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     * @throws \Throwable
     */
    public function sellerGuide(Request $request)
    {
        $render = view('index.index.seller_guide')->render();
        return result(0, $render);
    }

    /**
     * 设置店铺指引下次打开页面是否再显示
     *
     * @param Request $request
     */
    public function guideShow(Request $request)
    {
        $data = $request->get('data');
        if ($data == 1) {
            //  店铺指引 设置不显示

        } else {
            // data = 0 店铺指引 设置显示

        }
    }
}
