<?php

namespace app\Modules\Backend\Http\Controllers\Shop;


use App\Models\ShopFieldValue;
use App\Modules\Base\Http\Controllers\Backend;
use App\Repositories\CategoryRepository;
use App\Repositories\ShopClassRepository;
use App\Repositories\ShopPaymentRepository;
use App\Repositories\ShopRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

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
    ];

    protected $shop;
    protected $category;
    protected $user;
    protected $shopClass;
    protected $shopPayment;

    public function __construct()
    {
        parent::__construct();

        $this->shop = new ShopRepository();
        $this->category = new CategoryRepository();
        $this->user = new UserRepository();
        $this->shopClass = new ShopClassRepository();
        $this->shopPayment = new ShopPaymentRepository();

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

        $this->sublink($this->links, 'list?is_supply=0', 'is_supply');

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

        $this->sublink($this->links, 'apply-list?is_supply=0', 'is_supply');

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
            'where' => $where,
            'sortname' => 'shop_id',
            'sortorder' => 'desc'
        ];
        list($list, $total) = $this->shop->getList($condition);
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
     *
     * @param Request $request
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Throwable
     */
    public function renewList(Request $request)
    {
        $title = '待续费店铺';
        $fixed_title = '入驻店铺 - '.$title;
        $is_supply = $request->get('is_supply', 0);

        $this->sublink($this->links, 'renew-list?is_supply=0', 'is_supply');

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
     *
     * @param Request $request
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Throwable
     */
    public function renewApplyList(Request $request)
    {
        $title = '续签申请店铺';
        $fixed_title = '入驻店铺 - '.$title;
        $is_supply = $request->get('is_supply', 0);

        $this->sublink($this->links, 'renew-apply-list?is_supply=0', 'is_supply');

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
     *
     * @param Request $request
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Throwable
     */
    public function preLineList(Request $request)
    {
        $title = '预上线店铺';
        $fixed_title = '入驻店铺 - '.$title;
        $is_supply = $request->get('is_supply', 0);

        $this->sublink($this->links, 'pre-line-list?is_supply=0', 'is_supply');

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
        // 根据关键词搜索 todo 根据 会员账号/手机号码/邮箱模糊搜索
        if ($keyword != '') {
            $where[] = ['user_name', 'like', "%{$keyword}%"];
        }
        $condition = [
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

        $extras = '?id='.$id.'&shop_type='.$info->shop_type.'&is_supply='.$info->is_supply;
        $this->sublink($this->edit_links, 'edit', '', $extras, 'pay-add');

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

//        $info->cat_ids = explode(',', $info->cat_ids);
        $shop_bind_class = $info->shopBindClass;
//        dd($shop_bind_class);

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
        $this->sublink($this->edit_links, 'shop-auth-info', '', '', 'pay-add');


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
                flash('error', '操作失败');
                return redirect($request->fullUrl());
            }
            // success
            flash('success', '操作成功');
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
            $post['user_name'] = DB::table('user')->where('user_id', $post['user_id'])->value('user_name');
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
        $this->sublink($this->edit_links, 'pay-list', '', '?'.$extra, 'pay-add');

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
        $this->sublink($this->edit_links, 'pay-add', '', '?'.$extra, 'edit,shop-auth-info');

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
            $this->sublink($this->links, 'edit', '', '?'.$extra, 'add,shop-auth-info');
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
}