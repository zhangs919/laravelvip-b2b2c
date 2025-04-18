<?php

namespace App\Modules\Backend\Http\Controllers\Shop;


use App\Models\ShopApply;
use App\Models\ShopFieldValue;
use App\Modules\Base\Http\Controllers\Backend;
use App\Repositories\CategoryRepository;
use App\Repositories\ShopApplyRepository;
use App\Repositories\ShopClassRepository;
use App\Repositories\ShopCreditRepository;
use App\Repositories\ShopPaymentRepository;
use App\Repositories\ShopRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class ShopController extends Backend
{

    private $links = [
        ['url' => 'shop/shop/list?is_supply=0', 'text' => '列表'],
        ['url' => 'shop/shop/apply-list?is_supply=0', 'text' => '开店申请(0)'],
        ['url' => 'shop/shop/renew-list?is_supply=0', 'text' => '待续费店铺(0)'],
        ['url' => 'shop/shop/renew-apply-list?is_supply=0', 'text' => '续签申请店铺(0)'],
        ['url' => 'shop/shop/pre-line-list?is_supply=0', 'text' => '预上线店铺(0)'],
    ];

    private $add_links = [
        ['url' => 'shop/shop/list?is_supply=0', 'text' => '列表'],
        ['url' => 'shop/shop/add', 'text' => '添加'],
    ];

    private $edit_links = [
        ['url' => 'shop/shop/edit', 'text' => '基本信息'],
        ['url' => 'shop/shop/shop-auth-info', 'text' => '认证信息（企业）'],
        ['url' => 'shop/shop/pay-list', 'text' => '付款信息'],
        ['url' => 'shop/shop/pay-add', 'text' => '添加'],
        ['url' => 'shop/shop/pay-edit', 'text' => '编辑'],
    ];

    protected $shop;
    protected $category;
    protected $user;
    protected $shopClass;
    protected $shopPayment;
    protected $shopCredit;
    protected $shopApply;

    public function __construct(
        ShopRepository $shop
        ,CategoryRepository $category
        ,UserRepository $user
        ,ShopClassRepository $shopClass
        ,ShopPaymentRepository $shopPayment
        ,ShopCreditRepository $shopCredit
        ,ShopApplyRepository $shopApply
    )
    {
        parent::__construct();

        $this->shop = $shop;
        $this->category = $category;
        $this->user = $user;
        $this->shopClass = $shopClass;
        $this->shopPayment = $shopPayment;
        $this->shopCredit = $shopCredit;
        $this->shopApply = $shopApply;

    }


    /**
     * 店铺选择器
     *
     * @param Request $request
     * @return mixed
     * @throws \Throwable
     */
    public function picker(Request $request)
    {
        $page_id = make_uuid();
        $pagination_id = $request->get('page')['page_id'];
        $output = $request->get('output');
//        $cat_type = $request->get('cat_type', '');
        $selected_ids = $request->get('selected_ids', '');
        $selected_ids = explode(',', $selected_ids);

        // 查询条件
        $where[] = ['shop_status', 1];
        $whereIn = [];

        $tpl = 'picker';
        if (!$output) {
            // ajax 输出店铺列表
            $tpl = 'partials._picker_shop_list';
            //            if (!empty($selected_ids)) {
//                $whereIn = [
//                    'field' => 'shop_id',
//                    'condition' => $selected_ids
//                ];
//            }
        }

        $condition = [
            'where' => $where,
            'in' => $whereIn,
            'sortname' => 'shop_id',
            'sortorder' => 'desc'
        ];
        list($list, $total) = $this->shop->getList($condition);
        $pageHtml = short_pagination($total);

        $render = view('shop.shop.'.$tpl, compact('page_id', 'pagination_id', 'list', 'pageHtml', 'selected_ids'))->render();
        return result(0, $render);
    }

    public function lists(Request $request)
    {
        $title = '列表';
        $fixed_title = '入驻店铺 - '.$title;
        $is_supply = $request->get('is_supply', 0);

        $this->sublink($this->links, 'list?is_supply=0');

        $action_span = [
            [
                'url' => 'add',
                'icon' => 'fa-plus',
                'text' => '添加入驻店铺'
            ],
        ];

        $explain_panel = [
            '店铺到期后如未续费店铺将自动关闭，也可手动关闭店铺，店铺关闭后，店主仍然可登录自己的卖家中心，但买家将不能访问店铺、购买店铺商品',
            '后台添加或前台入驻审核通过的店铺，需点击添加付款单，成功添加后，店铺状态才可变为启用，即可正常经营',
            '信誉显示：控制店铺的信誉、评分是否在商城前台展示；商品显示：控制店铺的商品能否在商城前台商品列表页展示；店铺街显示：控制店铺是否在商城前台店铺街展示，是否被搜索到',
        ];
        $blocks = [
            'explain_panel' => $explain_panel,
            'fixed_title' => $fixed_title,
            'action_span' => $action_span
        ];

        $this->setLayoutBlock($blocks); // 设置block

        $params = $request->all();
        $where = [];
        $where[] = ['shop_type', '>', 0]; // 个人店铺/企业店铺
        $where[] = ['shop_audit', 1]; // 审核通过
        $whereBetween = [];

        // 搜索条件
        $search_arr = ['key_word',
//            'shop_type', 'shop_status',
//            'start_from', 'start_to', 'end_from', 'end_to', 'credit_from', 'credit_to'
        ];
        foreach ($search_arr as $v) {
            if (isset($params[$v]) && !empty($params[$v])) {

                if ($v == 'key_word') {
//                    $where[] = ['auth_name', 'like', "%{$params[$v]}%"];
                } else {
                    $where[] = [$v, $params[$v]];
                }
            }
        }
        if (!empty($params['start_from']) && empty($params['start_to'])) {
            $where[] = ['created_at', '>', $params['start_from']];
        } elseif (empty($params['start_from']) && !empty($params['start_to'])) {
            $where[] = ['created_at', '<', $params['start_to']];
        } elseif (!empty($params['start_from']) && !empty($params['start_to'])) {
            $whereBetween =  [
                'field' => 'created_at',
                'condition' => [$params['start_from'], $params['start_to']]
            ];
        }
//        dd($where);
        // 列表
        $condition = [
            'where' => $where,
            'between' => $whereBetween,
            'relation' => ['orderInfo','member'],
            'sortname' => 'shop_id',
            'sortorder' => 'desc'
        ];
        list($list, $total) = $this->shop->getList($condition);
        if (!$list->isEmpty()) {
            foreach ($list as $item) {
                // 店铺信誉
                $credit = $this->shopCredit->getCreditInfoByScore($item->credit);
                $item->credit_name = $credit['credit_name'];
                $item->credit_img = $credit['credit_img'];
                $item->score = format_price(round(($item->desc_score+$item->service_score+$item->send_score) / 3, 2)); // 需计算 取平均数
            }
        }
        $pageHtml = pagination($total);

        $compact = compact('title', 'list', 'total', 'pageHtml');
        if ($request->ajax()) {
            $render = view('shop.shop.partials._list', $compact)->render();
            return result(0, $render);
        }
        return view('shop.shop.list', $compact);
    }

    /**
     * 开店申请
     *
     * @param Request $request
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Throwable
     */
    public function applyList(Request $request)
    {
        $title = '开店申请';
        $fixed_title = '入驻店铺 - '.$title;
        $is_supply = $request->get('is_supply', 0);

        $this->sublink($this->links, 'apply-list?is_supply=0');

        $action_span = [];

        $explain_panel = [
            '店铺审核通过后，即进入第二阶段：等待店主支付开店费用，付款后店铺成功开通，店主即可进入卖家中心打理店铺',
            '未通过审核的店铺可修改信息重新发起申请'
        ];
        $blocks = [
            'explain_panel' => $explain_panel,
            'fixed_title' => $fixed_title,
            'action_span' => $action_span
        ];

        $this->setLayoutBlock($blocks); // 设置block

        $params = $request->all();
        $where = [];
        $where[] = ['audit_status', '!=', 1];

        // 搜索条件
        $search_arr = ['key_word', 'shop_type', 'shop_status'];
        foreach ($search_arr as $v) {
            if (isset($params[$v]) && !empty($params[$v])) {

                if ($v == 'key_word') {
//                    $where[] = ['auth_name', 'like', "%{$params[$v]}%"];
                } else {
                    $where[] = [$v, $params[$v]];
                }
            }
        }
        // 列表
        $condition = [
            'with' => ['shopClass','shop'],
            'where' => $where,
            'sortname' => 'shop_id',
            'sortorder' => 'desc'
        ];
        list($list, $total) = $this->shopApply->getList($condition);
        if (!$list->isEmpty()) {
            foreach ($list as $item) {

                $item->shop_type = $item->shop->shop_type;
                $item->user_name = $item->user->user_name ?? '';
                $item->cls_name = $item->shopClass->cls_name ?? '';

                $duration_arr = explode('-', $item->duration);
                $item->duration_format = isset($duration_arr[2]) ? $duration_arr[0].' '.format_unit($duration_arr[1]) : '';

            }
        }

        $pageHtml = pagination($total);

        $compact = compact('title', 'list', 'total', 'pageHtml');
        if ($request->ajax()) {
            $render = view('shop.shop.partials._apply_list', $compact)->render();
            return result(0, $render);
        }
        return view('shop.shop.apply_list', $compact);
    }

    /**
     * 待续费店铺
     * todo
     * @param Request $request
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Throwable
     */
    public function renewList(Request $request)
    {
        $title = '待续费店铺';
        $fixed_title = '入驻店铺 - '.$title;
        $is_supply = $request->get('is_supply', 0);

        $this->sublink($this->links, 'renew-list?is_supply=0');

        $action_span = [];

        $explain_panel = [
            '店铺到期后将自动关闭，店内所有商品、活动自动下架，店主仍然可以登录卖家中心',
            '您可以提醒店铺续费，店铺到期后可通过续费重新开启店铺'
        ];
        $blocks = [
            'explain_panel' => $explain_panel,
            'fixed_title' => $fixed_title,
            'action_span' => $action_span
        ];

        $this->setLayoutBlock($blocks); // 设置block

        $params = $request->all();
        $where = [];
        // 搜索条件
        $search_arr = ['key_word', 'shop_type', 'shop_status', 'start_from', 'start_to', 'end_from', 'end_to', 'credit_from', 'credit_to'];
        foreach ($search_arr as $v) {
            if (isset($params[$v]) && !empty($params[$v])) {

                if ($v == 'key_word') {
//                    $where[] = ['auth_name', 'like', "%{$params[$v]}%"];
                } else {
                    $where[] = [$v, $params[$v]];
                }
            }
        }
        // 列表
        $condition = [
            'where' => $where,
            'sortname' => 'shop_id',
            'sortorder' => 'desc'
        ];
        list($list, $total) = $this->shop->getList($condition);
        $pageHtml = pagination($total);

        $compact = compact('title', 'list', 'total', 'pageHtml');
        if ($request->ajax()) {
            $render = view('shop.shop.partials._renew_list', $compact)->render();
            return result(0, $render);
        }
        return view('shop.shop.renew_list', $compact);
    }

    /**
     * 续签申请店铺
     * todo
     * @param Request $request
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Throwable
     */
    public function renewApplyList(Request $request)
    {
        $title = '续签申请店铺';
        $fixed_title = '入驻店铺 - '.$title;
        $is_supply = $request->get('is_supply', 0);

        $this->sublink($this->links, 'renew-apply-list?is_supply=0');

        $action_span = [];

        $explain_panel = [
            '平台管理员可以对商家待审核的续签申请进行审核操作，对已经取消的续签审核可进行删除操作',
            '审核通过后，系统会自动将店铺的到期时间向后延续'
        ];
        $blocks = [
            'explain_panel' => $explain_panel,
            'fixed_title' => $fixed_title,
            'action_span' => $action_span
        ];

        $this->setLayoutBlock($blocks); // 设置block

        $params = $request->all();
        $where = [];
        // 搜索条件
        $search_arr = ['key_word', 'shop_type', 'shop_status', 'start_from', 'start_to', 'end_from', 'end_to'];
        foreach ($search_arr as $v) {
            if (isset($params[$v]) && !empty($params[$v])) {

                if ($v == 'key_word') {
//                    $where[] = ['auth_name', 'like', "%{$params[$v]}%"];
                } else {
                    $where[] = [$v, $params[$v]];
                }
            }
        }
        // 列表
        $condition = [
            'where' => $where,
            'sortname' => 'shop_id',
            'sortorder' => 'desc'
        ];
        list($list, $total) = $this->shop->getList($condition);
        $pageHtml = pagination($total);

        $compact = compact('title', 'list', 'total', 'pageHtml');
        if ($request->ajax()) {
            $render = view('shop.shop.partials._renew_apply_list', $compact)->render();
            return result(0, $render);
        }
        return view('shop.shop.renew_apply_list', $compact);
    }

    /**
     * 预上线店铺
     * todo
     * @param Request $request
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Throwable
     */
    public function preLineList(Request $request)
    {
        $title = '预上线店铺';
        $fixed_title = '入驻店铺 - '.$title;
        $is_supply = $request->get('is_supply', 0);

        $this->sublink($this->links, 'pre-line-list?is_supply=0');

        $action_span = [];

        $explain_panel = [
            '预上线店铺：指有意愿加入商城运营的店铺，店铺与平台正式签署入驻合同后，即可成功在商城开店运营'
        ];
        $blocks = [
            'explain_panel' => $explain_panel,
            'fixed_title' => $fixed_title,
            'action_span' => $action_span
        ];

        $this->setLayoutBlock($blocks); // 设置block

        $params = $request->all();
        $where = [];
        // 搜索条件
        $search_arr = ['key_word', 'shop_type'];
        foreach ($search_arr as $v) {
            if (isset($params[$v]) && !empty($params[$v])) {

                if ($v == 'key_word') {
//                    $where[] = ['auth_name', 'like', "%{$params[$v]}%"];
                } else {
                    $where[] = [$v, $params[$v]];
                }
            }
        }
        // 列表
        $condition = [
            'where' => $where,
            'sortname' => 'shop_id',
            'sortorder' => 'desc'
        ];
        list($list, $total) = $this->shop->getList($condition);
        $pageHtml = pagination($total);

        $compact = compact('title', 'list', 'total', 'pageHtml');
        if ($request->ajax()) {
            $render = view('shop.shop.partials._pre_line_list', $compact)->render();
            return result(0, $render);
        }
        return view('shop.shop.pre_line_list', $compact);
    }


    public function viewMessage(Request $request)
    {

    }

    public function export(Request $request)
    {

    }

    public function searchUser(Request $request)
    {
        $keyword = $request->get('keyword', '');

        // 获取会员列表-非店铺管理员（实名认证过）
        $where = [];
        $where[] = ['is_real', 1];
        $where[] = ['is_seller', 0];
        // 根据关键词搜索 根据 会员账号/手机号码/邮箱模糊搜索
        $multiLike = '';
        if ($keyword != '') {
            $multiLike = "(concat(IFNULL(user_name,''),IFNULL(mobile,''),IFNULL(email,'')) like '%".$keyword."%')";
        }
        $condition = [
            'multi_like' => $multiLike,
            'where' => $where,
            'sortname' => 'user_id',
            'sortorder' => 'desc',
            'field' => ['user_id','user_name','mobile','email']
        ];
        list($user_list, $total) = $this->user->getList($condition);

        $data = [
            'users' => $user_list->toArray()
        ];

        return result(0, $data);
    }

    public function add(Request $request)
    {
        $title = '添加';
        $this->sublink($this->add_links, 'add', 'is_supply');

        $fixed_title = '入驻店铺 - '.$title;

        $action_span = [
            [
                'url' => 'list?is_supply=0',
                'icon' => 'fa-reply',
                'text' => '返回入驻店铺列表'
            ]
        ];
        $explain_panel = [];
        $blocks = [
            'fixed_title' => $fixed_title,
            'action_span' => $action_span,
            'explain_panel' => $explain_panel
        ];
        $this->setLayoutBlock($blocks); // 设置block

        // 获取店铺分类列表
        $where = [];
        $condition = [
            'where' => $where,
            'limit' => 0, // 不分页
            'sortname' => 'created_at',
            'sortorder' => 'desc'
        ];
        list($cat_list, $total) = $this->shopClass->getList($condition, '', false, true);
        $use_fee_value = unserialize(sysconf('use_fee_value'));

        return view('shop.shop.add', compact('title', 'cat_list', 'use_fee_value'));
    }

    public function edit(Request $request)
    {
        $title = '基本信息';
        $id = $request->get('id');

        $info = $this->shop->getById($id);
        // 店铺信誉
        $credit = $this->shopCredit->getCreditInfoByScore($info->credit);
        $info->credit_name = $credit['credit_name'];
        $info->credit_img = $credit['credit_img'];
        $info->score = '5.00'; // 需计算

        $extras = '?id='.$id.'&shop_type='.$info->shop_type.'&is_supply='.$info->is_supply;
        $this->sublink($this->edit_links, 'edit', '', $extras, 'pay-add,pay-edit');

        $fixed_title = '入驻店铺 - '.$title;

        $action_span = [
            [
                'url' => 'list?is_supply='.$info->is_supply,
                'icon' => 'fa-reply',
                'text' => '返回入驻店铺列表'
            ]
        ];
        $explain_panel = [
            '平台保证金会自动进入店主账号的“冻结资金”中，如店铺无违规行为店主关店后可申请提现该笔资金',
            '通知信息将会以短信或者邮件的形式通知店主认证的手机和邮箱'
        ];
        $blocks = [
            'fixed_title' => $fixed_title,
            'action_span' => $action_span,
            'explain_panel' => $explain_panel
        ];
        $this->setLayoutBlock($blocks); // 设置block

        // 获取店铺分类列表
        $where = [];
        $condition = [
            'where' => $where,
            'limit' => 0, // 不分页
            'sortname' => 'created_at',
            'sortorder' => 'desc'
        ];
        list($cat_list, $total) = $this->shopClass->getList($condition, '', false, true);

        $shop_bind_class = $info->shopBindClass;

        return view('shop.shop.edit', compact('title', 'info', 'cat_list', 'shop_bind_class'));
    }

    public function shopAuthInfo(Request $request)
    {
        $title = '认证信息';
        $id = $request->get('id');

        $info = $this->shop->getById($id);
        $shop_type = $info->shop_type;
        if ($shop_type == 2) {
            // 企业
            $title = '认证信息（企业）';
        }

        $this->edit_links[0]['url'] = 'shop/shop/edit?id='.$id.'&shop_type='.$info->shop_type.'&is_supply='.$info->is_supply;
        $this->edit_links[2]['url'] = 'shop/shop/pay-list?id='.$id.'&shop_type='.$info->shop_type.'&is_supply='.$info->is_supply;
        $this->sublink($this->edit_links, 'shop-auth-info', '', '', 'pay-add,pay-edit');


        $fixed_title = '入驻店铺 - '.$title;

        $action_span = [
            [
                'url' => 'list?is_supply='.$info->is_supply,
                'icon' => 'fa-reply',
                'text' => '返回入驻店铺列表'
            ]
        ];
        $explain_panel = [];
        $blocks = [
            'fixed_title' => $fixed_title,
            'action_span' => $action_span,
            'explain_panel' => $explain_panel
        ];
        $this->setLayoutBlock($blocks); // 设置block

        // 获取店铺分类列表
        $where = [];
        $condition = [
            'where' => $where,
            'limit' => 0, // 不分页
            'sortname' => 'created_at',
            'sortorder' => 'desc'
        ];
        list($cat_list, $total) = $this->shopClass->getList($condition, '', false, true);

        $info->cat_ids = explode(',', $info->cat_ids);

        if ($request->method() == 'POST') {
            $post = $request->post('ShopFieldValueModel');
            $ret = ShopFieldValue::where('shop_id', $id)->update($post);
            if ($ret === false) {
                // fail
                flash('error', OPERATE_FAIL);
                return redirect($request->fullUrl());
            }
            // success
            flash('success', OPERATE_SUCCESS);
            return redirect($request->fullUrl());
        }

        return view('shop.shop.shop_auth_info_type'.$shop_type, compact('title', 'info', 'cat_list'));
    }

    public function saveData(Request $request)
    {
        $post = $request->post('ShopModel');

        $cat_ids = $request->post('cat_ids');
        $is_supply = $request->post('is_supply', 0);
        $shop_id = $request->get('id',0);

        $post['cat_ids'] = $cat_ids; // 店铺所属分类

        if ($shop_id) {
            // 编辑
            $ret = $this->shop->modifyShop($shop_id, $post);
            $msg = '入驻店铺编辑';
        }else {
            // 添加
            $post['shop_audit'] = 1; // 默认审核通过
            $ret = $this->shop->addShop($post);
            $msg = '入驻店铺添加';
        }

        if ($ret === false) {
            // fail
            flash('error', $msg.'失败');
            return redirect('/shop/shop/list');
        }
        // success
        flash('success', $msg.'成功');
        return redirect('/shop/shop/list');
    }

    /**
     * 名称验证是否重复
     *
     * @param Request $request
     * @return mixed
     */
    public function clientValidate(Request $request)
    {
        $result = $this->shop->clientValidate($request, 'ShopModel');
        if (!$result['code']) {
            return result(-1, '', $result['message']);
        }
        return result(0);
    }

    /**
     * 设置店铺状态
     *
     * @param Request $request
     * @return mixed
     */
    public function setStatus(Request $request)
    {
        $id = $request->get('id');
        $ret = $this->shop->changeState($id, 'shop_status');
        if ($ret === false) {
            return result(-1, '', '设置失败');
        }
        return result(0, $ret, '设置成功');
    }

    /**
     * 设置是否显示店铺信誉
     *
     * @param Request $request
     * @return mixed
     */
    public function setShowCredit(Request $request)
    {
        $id = $request->get('id');
        $ret = $this->shop->changeState($id, 'show_credit');
        if ($ret === false) {
            return result(-1, '', '设置失败');
        }
        return result(0, $ret, '设置成功');
    }

    /**
     * 设置店铺商品能否在商城展示
     *
     * @param Request $request
     * @return mixed
     */
    public function setGoodsIsShow(Request $request)
    {
        $id = $request->get('id');
        $ret = $this->shop->changeState($id, 'goods_is_show');
        if ($ret === false) {
            return result(-1, '', '设置失败');
        }
        return result(0, $ret, '设置成功');
    }

    /**
     * 设置店铺能否在商城展示
     *
     * @param Request $request
     * @return mixed
     */
    public function setShowInStreet(Request $request)
    {
        $id = $request->get('id');
        $ret = $this->shop->changeState($id, 'show_in_street');
        if ($ret === false) {
            return result(-1, '', '设置失败');
        }
        return result(0, $ret, '设置成功');
    }

    public function editShopInfo(Request $request)
    {
        $id = $request->post('shop_id');
        $title = $request->post('title');
        $value = $request->post('value');

        if ($title == 'shop_sort') {
            $value = intval($value);
        }
        $ret = $this->shop->update($id, [$title => $value]);

        if ($ret === false) {
            return result(-1, '', '设置失败');
        }
        return result(0, '', '设置成功');
    }

    /**
     * 编辑开店申请
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function applyEdit(Request $request)
    {
        $id = $request->get('id');
        $shop_type = $request->get('shop_type'); // 1-个人店铺 2-企业店铺
        $audit = $request->get('audit',0); // 审核状态 0-待审核 1-审核通过 2-拒绝通过
        $is_supply = $request->get('is_supply',0); // 是否供应商

        $info = ShopApply::where('shop_id', $id)->first();
        if (empty($info)) {
            abort(404, INVALID_PARAM);
        }

        $title = '编辑开店申请';
        $fixed_title = '入驻店铺 - '.$title;

        $action_span = [];
        $explain_panel = [];
        $blocks = [
            'fixed_title' => $fixed_title,
            'action_span' => $action_span,
            'explain_panel' => $explain_panel
        ];
        $this->setLayoutBlock($blocks); // 设置block

        if ($request->method() == 'POST') {
            // 保存数据
            $shopApplyModel = $request->post('ShopApplyModel');

            // 拒绝通过 执行操作 修改审核状态并给会员发送审核拒绝通过提醒消息
            $ret = $this->shopApply->audit($shopApplyModel['shop_id'], $shopApplyModel['audit_status'], $shopApplyModel['fail_info']);
            if (!$ret) {
                admin_log('审核开店申请失败！');
                flash('error', OPERATE_FAIL);
                return back();
            }

            admin_log('审核开店申请成功！');
            flash('success', OPERATE_SUCCESS);
            return redirect('/shop/shop/list?is_supply=0');
        }

        return view('shop.shop.apply_edit', compact('title', 'info','id','shop_type','audit','is_supply'));
    }

    /**
     * 审核开店申请
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function audit(Request $request)
    {
        $id = $request->get('id');
        $audit = $request->get('audit');
        $fail_info = $request->get('fail_info');
        $is_supply = $request->get('is_supply');

        if ($audit == 1) {
            // 审核通过 执行操作 修改审核状态并给会员发送审核通过提醒消息
            $ret = $this->shopApply->audit($id, $audit, $fail_info);
            if (!$ret) {
                admin_log('审核开店申请失败！');
                flash('error', OPERATE_FAIL);
                return back();
            }

            admin_log('审核开店申请成功！');
            flash('success', OPERATE_SUCCESS);
            return back();
        }

        // 拒绝通过

        return view('shop.shop.audit');
    }

    /**
     * 批量审核通过开店申请
     *
     * @param Request $request
     * @return array|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function batchPass(Request $request)
    {
        $is_supply = $request->get('is_supply',0);

        $ids = $request->post('ids'); // array

        // 批量审核通过 执行操作 修改审核状态并给会员发送审核通过提醒消息
        $ret = $this->shopApply->batchPass($ids);
        if (!$ret) {
            admin_log('批量审核通过开店申请失败！');
            return result(-1,null, OPERATE_FAIL);
        }

        admin_log('批量审核通过开店申请成功！');
        return result(0,null,OPERATE_SUCCESS);
    }

    /**
     * 付款信息列表
     *
     * @param Request $request
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Throwable
     */
    public function payList(Request $request)
    {
        $title = '付款信息列表';
        $fixed_title = '入驻店铺 - '.$title;

        $id = $request->get('id');
        $is_supply = $request->get('is_supply', 0);
        $info = $this->shop->getById($id);

        $extra = 'id='.$id.'&shop_type='.$info->shop_type.'&is_supply='.$info->is_supply;
        $this->sublink($this->edit_links, 'pay-list', '', '?'.$extra, 'pay-add,pay-edit');

        $action_span = [
            [
                'url' => 'pay-add?'.$extra,
                'icon' => 'fa-plus',
                'text' => '添加付款信息'
            ],
        ];

        $explain_panel = [];
        $blocks = [
            'explain_panel' => $explain_panel,
            'fixed_title' => $fixed_title,
            'action_span' => $action_span
        ];

        $this->setLayoutBlock($blocks); // 设置block

        $params = $request->all();
        $where = [];
        // 搜索条件
        $search_arr = [];
        foreach ($search_arr as $v) {
            if (isset($params[$v]) && !empty($params[$v])) {

                if ($v == 'key_word') {
//                    $where[] = ['auth_name', 'like', "%{$params[$v]}%"];
                } else {
                    $where[] = [$v, $params[$v]];
                }
            }
        }
        $where[] = ['shop_id', $id]; // 查询某个店铺的付款信息列表
        // 列表
        $condition = [
            'where' => $where,
            'sortname' => 'pay_id',
            'sortorder' => 'desc'
        ];
        list($list, $total) = $this->shopPayment->getList($condition);
        $pageHtml = pagination($total);

        $compact = compact('title', 'list', 'total', 'pageHtml', 'extra');
        if ($request->ajax()) {
            $render = view('shop.shop.partials._pay_list', $compact)->render();
            return result(0, $render);
        }
        return view('shop.shop.pay_list', $compact);
    }

    public function payAdd(Request $request)
    {
        $title = '添加付款信息';

        $pay_id = $request->get('pay_id', 0); // 主键id
        $shop_id = $request->get('id'); // 店铺id
        $shop_info = $this->shop->getById($shop_id); // 店铺信息

        $use_fee_value = unserialize(sysconf('use_fee_value'));

        $extra = 'id='.$shop_id.'&shop_type='.$shop_info->shop_type.'&is_supply='.$shop_info->is_supply;
        $this->sublink($this->edit_links, 'pay-add', '', '?'.$extra, 'edit,pay-edit,shop-auth-info');

        // 检查店铺是否存在未付款信息
        if ($this->shopPayment->isExistUnpaid($shop_id) && !$pay_id) {
            flash('error', '存在未付款记录，不能添加！');
            return redirect('/shop/shop/pay-list?'.$extra);
        }

        if ($pay_id) {
            // 更新操作
            $info = $this->shopPayment->getById($pay_id);
            view()->share('info', $info);

            $title = '编辑付款信息';
            $this->sublink($this->edit_links, 'pay-edit', '', '?'.$extra, 'add,pay-add,shop-auth-info');
        }

        $fixed_title = '入驻店铺 - '.$title;
        $action_span = [
            [
                'url' => 'pay-list?'.$extra,
                'icon' => 'fa-reply',
                'text' => '返回付款信息列表'
            ]
        ];
        $explain_panel = [];
        $blocks = [
            'fixed_title' => $fixed_title,
            'action_span' => $action_span,
            'explain_panel' => $explain_panel
        ];
        $this->setLayoutBlock($blocks); // 设置block

        return view('shop.shop.pay_add', compact('title', 'shop_info', 'extra', 'use_fee_value'));
    }

    public function payEdit(Request $request)
    {
        return $this->payAdd($request);
    }

    /**
     * 付款信息添加/编辑 保存信息
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function savePayData(Request $request)
    {
        $post = $request->post('ShopPaymentModel');

        $duration_arr = explode('-', $post['duration']);
        $post['duration'] = $duration_arr[0];
        $post['unit'] = str_replace(['year','month','day'],[0,1,2], $duration_arr[1]);
        $post['system_fee'] = isset($duration_arr[2]) ? $duration_arr[2] : '0.00';

        if (!empty($post['pay_id'])) {
            // 编辑
            $ret = $this->shopPayment->addShopPayment($post, true);
            $msg = '编辑';
        }else {
            // 添加
            $ret = $this->shopPayment->addShopPayment($post);
            $msg = '添加';
        }

        $redirect_url = '/shop/shop/pay-list?'.$request->getQueryString();
        if ($ret === false) {
            // fail
            flash('error', $msg.'失败');
            return redirect($redirect_url);
        }
        // success
        flash('success', $msg.'成功');
        return redirect($redirect_url);
    }

    /**
     * 生成二维码
     * @param Request $request
     * @return mixed
     */
    public function qrCode(Request $request)
    {
        $shop_id = $request->get('shop_id',0);
        return $this->shop->generateShopQrCode($shop_id);
    }

    /**
     * 店铺删除
     *
     * @param Request $request
     * @return array
     */
    public function delete(Request $request)
    {
        $shop_id = $request->post('id');
        $ret = $this->shop->shopDelete($shop_id);

        // 判断是否删除出错
        if (isset($ret['code'])) {
            // Log
            admin_log('店铺删除失败。ID：'.$shop_id);
            return result($ret['code'], $ret['data'], $ret['message']);
        }

        // Log
        admin_log('店铺删除成功。ID：'.$shop_id);
        return result(0, null, '删除成功');
    }
}