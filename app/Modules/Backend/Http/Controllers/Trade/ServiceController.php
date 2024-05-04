<?php

namespace App\Modules\Backend\Http\Controllers\Trade;

use App\Modules\Base\Http\Controllers\Backend;
use App\Repositories\ComplaintRepository;
use App\Repositories\GoodsCommentRepository;
use App\Repositories\ShopCommentRepository;
use App\Repositories\ShopCreditRepository;
use Illuminate\Http\Request;

class ServiceController extends Backend
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
        $fixed_title = '评价管理 - '.$title;

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
        // 搜索条件
        $search_arr = ['desc_mark','comment_desc','reply_desc','shop_name','goods_name','comment_desc1','order_sn','comment_time'];
        foreach ($search_arr as $v) {
            if (isset($params[$v]) && !empty($params[$v])) {
                if ($v == 'shop_name') {
                    $where[] = [$v, 'like', "%{$params[$v]}%"];
                } elseif ($v == 'comment_time') {

                }
                else {
                    $where[] = [$v, $params[$v]];
                }
            }
        }

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
        $type = $request->get('type', 'all');
        $compact = compact('title','list', 'total', 'pageHtml', 'params','type');
        if ($request->ajax()) {
            $render = view('trade.service.partials._evaluate_buyer_list', $compact)->render();
            return result(0, $render);
        }

        return view('trade.service.evaluate_buyer_list', $compact);
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
        $fixed_title = '评价管理 - '.$title;

        $this->sublink($this->links, 'evaluate-shop-list', '', '?tab_status=0');
        $action_span = [];
        $explain_panel = [
            '删除店铺评分记录只删除了“卖家的服务态度、卖家的发货速度、物流公司的服务”三项内容（删除后将不再计入评分），不会影响“宝贝与描述相符',
            '遇到买家恶意评分，卖家可联系平台方处理，如证据充足，平台管理员可删除买家评分'
        ];
        $blocks = [
            'fixed_title' => $fixed_title,
            'action_span' => $action_span,
            'explain_panel' => $explain_panel,
        ];
        $this->setLayoutBlock($blocks); // 设置block

        $params = $request->all();
        $type = $request->get('type', 'all');

        $where = [];
        // 搜索条件
        $search_arr = ['order_sn','shop_name','comment_time'];
        foreach ($search_arr as $v) {
            if (isset($params[$v]) && !empty($params[$v])) {
                if ($v == 'order_sn' || $v == 'shop_name') {
                    $where[] = [$v, 'like', "%{$params[$v]}%"];
                } elseif ($v == 'comment_time') {

                }
                else {
                    $where[] = [$v, $params[$v]];
                }
            }
        }

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

        $raty = get_score_desc('', false);

        $compact = compact('title','list', 'total', 'pageHtml', 'params','type','raty');
        if ($request->ajax()) {
            $render = view('trade.service.partials._evaluate_shop_list', $compact)->render();
            return result(0, $render);
        }

        return view('trade.service.evaluate_shop_list', $compact);
    }

    /**
     * 替换文字
     *
     * @param Request $request
     * @return array|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     * @throws \Throwable
     */
    public function ajaxReplace(Request $request)
    {

        $render = view('trade.service.ajax_replace')->render();

        return result(0, $render);
    }

    /**
     * 替换文字
     *
     * @param Request $request
     * @return array|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function replace(Request $request)
    {
        $post = $request->post('ReplaceModel');

        return result(0,'','替换成功');
    }

    /**
     * 平台审核店铺动态评价
     *
     * @param Request $request
     * @return array|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function shopOperation(Request $request)
    {
        $btn = $request->get('btn'); // pass refuse
        $type = $request->get('type'); // un
        $id = $request->get('id');

        $shop_comment_status = 0;
        if ($btn == 'pass') {
            $shop_comment_status = 1;
        } elseif ($btn == 'refuse') {
            $shop_comment_status = 2;
        }
        $ret = $this->shopComment->update($id,['shop_comment_status'=>$shop_comment_status]);
        if ($ret === false) {
            return result(-1,null,'操作失败！');
        }
        return result(0,null,'操作成功！');
    }

}