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
// | Date:2019-05-15
// | Description:店铺进出账明细
// +----------------------------------------------------------------------

namespace App\Modules\Seller\Http\Controllers\Finance;

use App\Modules\Base\Http\Controllers\Seller;
use App\Repositories\SellerAccountRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class SellerAccountController extends Seller
{

    private $links = [

    ];

    protected $sellerAccount;

    public function __construct(SellerAccountRepository $sellerAccount)
    {
        parent::__construct();

        $this->sellerAccount = $sellerAccount;

        $this->set_menu_select('finance', 'finance-seller-account');
    }

    /**
     * 列表
     *
     * @param Request $request
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Throwable
     */
    public function lists(Request $request)
    {
        $title = '店铺进出账明细';
        $fixed_title = $title;

        $action_span = [];
        $explain_panel = [
            '店铺进出账明细实时统计店铺收益、支出记录',
            '交易订单：消费者已付款订单即会在列表中展示；买家下单后，未付款订单，不会在店铺进出账明细中展示；货到付款订单在消费者确认收货之后才展示',
            '已付款订单在店铺进出账明细中展示一条记录，如果消费者取消订单，则系统会再生成一条取消订单记录，确保收入与支出相抵扣',
            '已付款订单在店铺进出账明细中展示一条记录，卖家发货后，如果消费者申请退款，则系统会再生成一条退款订单记录，确保退款钱支出出去',
            '店铺进出账明细包含了正在进行中、未结算的订单，账单结算中体现的是已经结算的入账和支出，所以两者会有区别',
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
        $search_arr = ['from','to','account_type','status','min_amount','max_amount','key_word'];
        foreach ($search_arr as $v) {
            if (isset($params[$v]) && !empty($params[$v])) {
                if ($v == 'key_word') { // todo
//                    $where[] = [$v, 'like', "%{$params[$v]}%"];
                } /*elseif ($v == 'add_time_begin' || $v == 'add_time_end') {

                }*/
                else {
                    $where[] = [$v, $params[$v]];
                }
            }
        }

        $where[] = ['user_id', auth('seller')->id()]; // 店铺id

        // 列表
        $condition = [
            'where' => $where,
            'sortname' => 'account_id',
            'sortorder' => 'asc'
        ];

        // 获取数据
        $income = $this->sellerAccount->getIncome($condition['where']);
        $expend = $this->sellerAccount->getExpend($condition['where']);

        list($list, $total) = $this->sellerAccount->getList($condition);
        $list = $list->toArray();

        $pageHtml = pagination($total);
        $page = frontend_pagination($total, true);

        $compact = compact('title', 'list', 'pageHtml', 'income', 'expend');

        if ($request->ajax()) {
            $render = view('finance.seller-account.partials._list', $compact)->render();
            return result(0, $render);
        }


        $webData = []; // web端（pc、mobile）数据对象
        $data = [
            'app_extra_data' => [],
            'app_prefix_data' => [
                'income' => $income,
                'expend' => $expend,
                'list' => $list,
                'page' => $page,
            ],
            'app_context_data' => $this->getAppContext(),
            'app_suffix_data' => [],
            'web_data' => $webData,
            'compact_data' => $compact,
            'tpl_view' => 'finance.seller-account.list'
        ];
        $this->setData($data); // 设置数据
        return $this->displayData(); // 模板渲染及APP客户端返回数据
    }

}