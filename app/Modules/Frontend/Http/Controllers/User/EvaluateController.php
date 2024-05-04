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
// | Date:2020-01-11
// | Description:商品评价
// +----------------------------------------------------------------------

namespace App\Modules\Frontend\Http\Controllers\User;

use App\Models\OrderGoods;
use App\Models\OrderInfo;
use App\Models\ShopComment;
use App\Modules\Base\Http\Controllers\UserCenter;
use App\Repositories\GoodsCommentRepository;
use App\Repositories\ShopCommentRepository;
use App\Repositories\ShopRepository;
use Illuminate\Http\Request;

class EvaluateController extends UserCenter
{

    protected $goodsComment;
    protected $shopComment;
    protected $shop;

    public function __construct(
        GoodsCommentRepository $goodsComment
        ,ShopCommentRepository $shopComment
        ,ShopRepository $shop
    )
    {
        parent::__construct();

        $this->goodsComment = $goodsComment;
        $this->shopComment = $shopComment;
        $this->shop = $shop;
    }

    public function index(Request $request)
    {
        return $this->lists($request);
    }

    public function lists(Request $request)
    {
        $seo_title = '用户中心';

        $params = $request->all();
        $comment_level = $request->get('comment_level', 0);


        // 获取数据
        $where = [];
        // 搜索条件 comment_level comment_content
        $search_arr = ['comment_content'];
        foreach ($search_arr as $v) {
            if (isset($params[$v]) && !empty($params[$v])) {
                if ($v == 'name') { // todo
//                    $where[] = [$v, 'like', "%{$params[$v]}%"];
                } elseif ($v == 'comment_level') { // 好评率 0-全部 1-好评 2-中评 3-差评


                }
                else {
                    $where[] = [$v, $params[$v]];
                }
            }
        }

        $where[] = ['user_id', $this->user_id];


        // 列表
        $condition = [
            'where' => $where,
            'sortname' => 'comment_id',
            'sortorder' => 'desc'
        ];

        list($list, $total) = $this->goodsComment->getUserCenterCommentList($condition);
        $pageHtml = frontend_pagination($total);
        $page_array = frontend_pagination($total,true);
        $page_json = json_encode($page_array);

        $integral = null;
        $review = 1;
        $nav_default = 'evaluate';
        $comment_count = [
            'all' => '0',
            'praise' => '0',
            'medium' => '0',
            'bad' => '0',
        ];

        $compact = compact('seo_title','pageHtml', 'list', 'page_json',
            'integral', 'review', 'nav_default', 'comment_count',
            'comment_level');

        if ($request->ajax() && !is_app()) { // web端访问 ajax请求
            $render = view('user.evaluate.partials._list', $compact)->render();
            return result(0, $render);
        }

        $webData = []; // web端（pc、mobile）数据对象
        $data = [
            'app_prefix_data' => [
                'page' => $page_array,
                'list' => $list,
                'integral' => $integral,
                'review' => $review,
                'nav_default' => $nav_default,
                'comment_count' => $comment_count
            ],
            'app_suffix_data' => [],
            'web_data' => $webData,
            'compact_data' => $compact,
            'tpl_view' => 'user.evaluate.index'
        ];
        $this->setData($data); // 设置数据
        return $this->displayData(); // 模板渲染及APP客户端返回数据
    }

    /**
     * 评价晒单
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function info(Request $request)
    {
        $seo_title = '用户中心';

        $order_id = $request->get('order_id'); // 订单id 评价晒单 同时新增shop_comment数据

        $where = [];
        $where[] = ['order_id', $order_id];
        $where[] = ['user_id', $this->user_id];
        $orderInfo = OrderInfo::where($where)->with(['orderGoods'])->first();
        if (empty($orderInfo)) {
            abort(200, INVALID_PARAM);
        }

        // 获取数据
        $list = $this->goodsComment->getUserCenterCommentInfo($orderInfo, $this->user_id);
        $shop_comment = ShopComment::where('order_id', $order_id)->first();
        $shop_comment = $shop_comment ? $shop_comment->toArray() : null;
        $score_desc = get_score_desc('', true, true);
        $nav_default = 'evaluate';
        $shopData = $this->shop->shopInfo($orderInfo->shop_id);
        $shop_info = $shopData['shop'];
        $shop_customer = $shopData['customer_main'];
        $comment_status = $orderInfo->comment_status;
        $yikf_url = null; // 云客服url


        $compact = compact('seo_title','order_id','list','shop_comment', 'score_desc',
            'nav_default','shop_info','shop_customer','comment_status', 'yikf_url');
        $webData = []; // web端（pc、mobile）数据对象
        $data = [
            'app_prefix_data' => [
                'order_id' => $order_id,
                'list' => $list,
                'shop_comment' => $shop_comment,
                'score_desc' => get_score_desc(),
                'nav_default' => $nav_default,
                'shop_info' => $shop_info,
                'shop_customer' => $shop_customer,
                'comment_status' => $comment_status,
                'yikf_url' => $yikf_url
            ],
            'app_suffix_data' => [],
            'web_data' => $webData,
            'compact_data' => $compact,
            'tpl_view' => 'user.evaluate.info'
        ];
        $this->setData($data); // 设置数据
        return $this->displayData(); // 模板渲染及APP客户端返回数据
    }

    /**
     * 商品评价 保存数据
     *
     * @param Request $request
     * @return array|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     * @throws \Throwable
     */
    public function evalGoods(Request $request)
    {
        $post = $request->post();

        $order_id = OrderGoods::where('record_id',$post['record_id'])->value('order_id');
        if (!$order_id) {
            return result(-1,null,INVALID_PARAM);
        }

        $where = [];
        $where[] = ['order_id', $order_id];
        $where[] = ['user_id', $this->user_id];
        $orderInfo = OrderInfo::where($where)->with(['orderGoods'])->first();
        if (empty($orderInfo)) {
            abort(200, INVALID_PARAM);
        }

        $ret = $this->goodsComment->evalGoods($this->user,$this->user_rank_info, $orderInfo, $post);
        if (!$ret) {
            return result(-1,null,'评论失败！');
        }

        // 获取数据
        $list = $this->goodsComment->getUserCenterCommentInfo($orderInfo, $this->user_id);
        $score_desc = get_score_desc('', true, true);

        $render = view('user.evaluate.partials._evaluate_goods', compact('list','score_desc'))->render();

        return result(0,$render,'评论成功！');
    }

    /**
     * 店铺动态评分 保存数据
     *
     * @param Request $request
     * @return array|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     * @throws \Throwable
     */
    public function evalShop(Request $request)
    {
        $post = $request->post();

        $where = [];
        $where[] = ['order_id', $post['order_id']];
        $where[] = ['user_id', $this->user_id];
        $orderInfo = OrderInfo::where($where)->with(['orderGoods'])->first();
        if (empty($orderInfo)) {
            abort(200, INVALID_PARAM);
        }

        $ret = $this->shopComment->evalShop($this->user, $orderInfo, $post);
        if (!$ret) {
            return result(-1,null,'评论失败！');
        }

        // 获取数据
        $list = $this->goodsComment->getUserCenterCommentInfo($orderInfo, $this->user_id);
        $score_desc = get_score_desc('', true, true);

        $render = view('user.evaluate.partials._eval_goods', compact('list','score_desc'))->render();

        return result(0,$render,'评论成功！');
    }

    /**
     * 买家回复
     *
     * @param Request $request
     * @return array|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     * @throws \Throwable
     */
    public function reply(Request $request)
    {
        $comment_id = $request->get('comment_id');

        $render = view('user.evaluate.reply', compact('comment_id'))->render();

        if ($request->method() == 'POST') {
            $comment_id = $request->post('comment_id');
            $content = $request->post('content');

            $ret = $this->goodsComment->userReply($comment_id, $content);
            if (!$ret) {
                return result(-1, null,'回复失败！');
            }
            return result(0,null,'回复成功！');
        }

        return result(0, $render);
    }
}
