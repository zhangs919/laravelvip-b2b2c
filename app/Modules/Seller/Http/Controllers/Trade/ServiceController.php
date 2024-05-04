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
// | Date:2020-01-12
// | Description:评价管理
// +----------------------------------------------------------------------

namespace App\Modules\Seller\Http\Controllers\Trade;

use App\Modules\Base\Http\Controllers\Seller;
use App\Repositories\GoodsCommentRepository;
use App\Repositories\ShopCommentRepository;
use App\Repositories\ShopCreditRepository;
use Illuminate\Http\Request;

class ServiceController extends Seller
{

    private $links = [
        ['url' => 'trade/service/evaluate-buyer-list', 'text' => '来自买家的评价'],
        ['url' => 'trade/service/evaluate-shop-list', 'text' => '店铺动态评价'],
    ];

    protected $goodsComment;
    protected $shopComment;
    protected $shopCredit;

    public function __construct(
        GoodsCommentRepository $goodsComment
        , ShopCommentRepository $shopComment
        , ShopCreditRepository $shopCredit
    )
    {
        parent::__construct();

        $this->goodsComment = $goodsComment;
        $this->shopComment = $shopComment;
        $this->shopCredit = $shopCredit;

        $this->set_menu_select('trade', 'trade-evaluate-buyer-list');
    }

    /**
     * 来自买家的评价
     *
     * @param Request $request
     * @return array|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     * @throws \Throwable
     */
    public function evaluateBuyerList(Request $request)
    {
        $title = '来自买家的评价';
        $fixed_title = '评价管理 - ' . $title;

        $this->sublink($this->links, 'evaluate-buyer-list','','?status=1');
        $action_span = [];
        $explain_panel = [
            '删除评价记录只删除了“宝贝与描述相符”及其对应的评价内容（删除后将不再计入评分），不会影响“卖家的服务态度、卖家的发货速度、物流公司的服务”三项内容',
            '遇到买家恶意评价，卖家可联系平台方处理，如证据充足，平台管理员可删除买家评价'
        ];
        $blocks = [
            'fixed_title' => $fixed_title,
            'action_span' => $action_span,
            'explain_panel' => $explain_panel,
        ];
        $this->setLayoutBlock($blocks); // 设置block

        $params = $request->all();

        $where = [];
        // 搜索条件 name 商品名称/订单编号/买家账号
        $search_arr = ['keywords', 'add_time_begin', 'add_time_end'];
        foreach ($search_arr as $v) {
            if (isset($params[$v]) && !empty($params[$v])) {
                if ($v == 'keywords') { // todo
//                    $where[] = [$v, 'like', "%{$params[$v]}%"];
                } elseif ($v == 'add_time_begin' || $v == 'add_time_end') {

                } else {
                    $where[] = [$v, $params[$v]];
                }
            }
        }


        $where[] = ['goods_comment.shop_id', seller_shop_info()->shop_id]; // 店铺id

        // 列表
        $condition = [
            'join' => [
                [
                    'join_table' => 'user',
                    'join_first' => 'goods_comment.user_id',
                    'join_operator' => '=',
                    'join_second' => 'user.user_id',
                    'join_type' => 'left',
                    'join_where' => false,
                ],
                [
                    'join_table' => 'order_info',
                    'join_first' => 'goods_comment.order_id',
                    'join_operator' => '=',
                    'join_second' => 'order_info.order_id',
                    'join_type' => 'left',
                    'join_where' => false,
                ],
                [
                    'join_table' => 'order_goods',
                    'join_first' => 'goods_comment.record_id',
                    'join_operator' => '=',
                    'join_second' => 'order_goods.record_id',
                    'join_type' => 'left',
                    'join_where' => false,
                ],
                [
                    'join_table' => 'goods_sku',
                    'join_first' => 'goods_comment.sku_id',
                    'join_operator' => '=',
                    'join_second' => 'goods_sku.sku_id',
                    'join_type' => 'left',
                    'join_where' => false,
                ],
                [
                    'join_table' => 'goods',
                    'join_first' => 'goods_comment.goods_id',
                    'join_operator' => '=',
                    'join_second' => 'goods.goods_id',
                    'join_type' => 'left',
                    'join_where' => false,
                ],
            ],
            'where' => $where,
            'sortname' => 'comment_id',
            'sortorder' => 'desc',
            'field' => ['goods_comment.*', 'user.*', 'order_info.*', 'order_goods.*', 'goods_sku.*', 'goods.*', 'order_info.add_time as ot']
        ];

        list($list, $total) = $this->goodsComment->getSellerCenterCommentList($condition);
        $pageHtml = pagination($total);
        $page = frontend_pagination($total, true);

        // 店铺信誉
        $credit = $this->shopCredit->getCreditInfoByScore(seller_shop_info()->credit);

        $count = [
            'best' => [ // 好评
                'best_count' => 2, // 好评数量
                'sis_M' => [/*具体的好评分数和时间*/
                    [
                        'desc_mark' => "5",
                        'comment_time' => "1544507811",
                    ],
                    [
                        'desc_mark' => "5",
                        'comment_time' => "1544507811",
                    ],
                ]
            ],
            'midle' => [ // 中评
                'midle_count' => 0, // 中评数量
            ],
            'bad' => [ // 差评
                'bad_count' => 0, // 差评数量
            ],
            'six_M_B' => 0, // 6个月前
            'six_M' => 0, // 最近6个月
            'three_M' => 0, // 最近3个月
            'one_M' => 0, // 最近1周
            'one_W' => 0, // 最近1个月
            'count' => 2, // 总评价数量
            'per_best_one' => 100, // 好评率
            'rank' => get_image_url($credit['credit_img']), // 卖家信用等级图标
            'rank_num' => seller_shop_info()->credit, // 卖家信用分
            'rank_name' => $credit['credit_name'], // 卖家信用等级名称
        ];
        $type = $request->get('type', 'all');
        $compact = compact('title', 'list', 'pageHtml', 'params', 'count', 'type');
        if ($request->ajax()) {
            $render = view('trade.service.partials._evaluate_buyer_list', $compact)->render();
            return result(0, $render);
        }

        // 获取数据

        $webData = []; // web端（pc、mobile）数据对象
        $data = [
            'app_extra_data' => [],
            'app_prefix_data' => [
                'list' => $list,
                'page' => $page,
                'count' => $count,
                'type' => $type
            ],
            'app_context_data' => $this->getAppContext(),
            'app_suffix_data' => [],
            'web_data' => $webData,
            'compact_data' => $compact,
            'tpl_view' => 'trade.service.evaluate_buyer_list'
        ];
        $this->setData($data); // 设置数据
        return $this->displayData(); // 模板渲染及APP客户端返回数据
    }

    /**
     * 卖家回复
     *
     * @param Request $request
     * @return array|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function reply(Request $request)
    {
        $comment_id = $request->get('id');
        $content = $request->get('content');

        $ret = $this->goodsComment->sellerReply($comment_id, $content);
        if (!$ret) {
            return result(-1, null, '回复失败！');
        }
        return result(0, null, '回复成功！');
    }

    /**
     * 店铺动态评价
     *
     * @param Request $request
     * @return array|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     * @throws \Throwable
     */
    public function evaluateShopList(Request $request)
    {
        $title = '店铺动态评价';
        $fixed_title = '评价管理 - ' . $title;

        $this->sublink($this->links, 'evaluate-shop-list', '', '?tab_status=0');
        $action_span = [];
        $explain_panel = [
            '删除店铺评分记录只删除了“卖家的服务态度、卖家的发货速度、物流公司的服务”三项内容（删除后将不再计入评分），不会影响“宝贝与描述相符”',
            '遇到买家恶意评分，卖家可联系平台方处理，如证据充足，平台管理员可删除买家评分'
        ];
        $blocks = [
            'fixed_title' => $fixed_title,
            'action_span' => $action_span,
            'explain_panel' => $explain_panel,
        ];
        $this->setLayoutBlock($blocks); // 设置block

        $params = $request->all();

        // 获取数据

        $where = [];
        // 搜索条件 name 商品名称/订单编号/买家账号
        $search_arr = ['order_sn', 'comment_time'];
        foreach ($search_arr as $v) {
            if (isset($params[$v]) && !empty($params[$v])) {
                if ($v == 'order_sn') { // todo
                    $where[] = [$v, 'like', "%{$params[$v]}%"];
                } elseif ($v == 'comment_time') {

                } else {
                    $where[] = [$v, $params[$v]];
                }
            }
        }

        $where[] = ['shop_comment.shop_id', seller_shop_info()->shop_id]; // 店铺id

        // 列表
        $condition = [
            'join' => [
                [
                    'join_table' => 'user',
                    'join_first' => 'shop_comment.user_id',
                    'join_operator' => '=',
                    'join_second' => 'user.user_id',
                    'join_type' => 'left',
                    'join_where' => false,
                ],
                [
                    'join_table' => 'order_info',
                    'join_first' => 'shop_comment.order_id',
                    'join_operator' => '=',
                    'join_second' => 'order_info.order_id',
                    'join_type' => 'left',
                    'join_where' => false,
                ],
            ],
            'where' => $where,
            'sortname' => 'shop_comment_id',
            'sortorder' => 'desc',
            'field' => ['shop_comment.*','user.*', 'order_info.*', 'order_info.*']
        ];

        list($list, $total) = $this->shopComment->getSellerCommentList($condition);
        $pageHtml = pagination($total);
        $page = frontend_pagination($total, true);


        $sum = [
            'sum' => '5.00',
            'desc' => '5.00',
            'shop_service' => '5.00',
            'shop_speed' => '5.00',
            'logistics_speed' => '5.00',
            'sum_left' => '100',
            'desc_left' => '100',
            'service_left' => '100',
            'speed_left' => '100',
            'logistics_left' => '100',
            'acount' => '0',
            'count' => '0',
        ];
        $month = sysconf('mark_cycle'); // 评分周期
        $raty = get_score_desc('', false);
        $type = $request->get('type', 'all');
        $divide = [
            '1' => [
                'name' => '差评',
                'icon' => '2'
            ],
            '2' => [
                'name' => '差评',
                'icon' => '2'
            ],
            '3' => [
                'name' => '中评',
                'icon' => '1'
            ],
            '4' => [
                'name' => '好评',
                'icon' => '0'
            ],
            '5' => [
                'name' => '好评',
                'icon' => '0'
            ],
        ];

        $compact = compact('title', 'params','sum','month','list','pageHtml','raty','type','divide');

        if ($request->ajax()) {
            $render = view('trade.service.partials._evaluate_shop_list', $compact)->render();
            return result(0, $render);
        }

        $webData = []; // web端（pc、mobile）数据对象
        $data = [
            'app_extra_data' => [],
            'app_prefix_data' => [
                'sum' => $sum,
                'month' => $month,
                'list' => $list,
                'page' => $page,
                'raty'=>$raty,
                'type'=>$type,
                'divide'=>$divide
            ],
            'app_context_data' => $this->getAppContext(),
            'app_suffix_data' => [],
            'web_data' => $webData,
            'compact_data' => $compact,
            'tpl_view' => 'trade.service.evaluate_shop_list'
        ];
        $this->setData($data); // 设置数据
        return $this->displayData(); // 模板渲染及APP客户端返回数据
    }

}