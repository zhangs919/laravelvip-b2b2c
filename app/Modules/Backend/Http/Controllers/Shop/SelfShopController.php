<?php

namespace App\Modules\Backend\Http\Controllers\Shop;


use App\Modules\Base\Http\Controllers\Backend;
use App\Repositories\CategoryRepository;
use App\Repositories\ShopClassRepository;
use App\Repositories\ShopCreditRepository;
use App\Repositories\ShopRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SelfShopController extends Backend
{

    private $links = [
        ['url' => 'shop/self-shop/list?is_supply=0', 'text' => '列表'],
        ['url' => 'shop/self-shop/add', 'text' => '添加'],
        ['url' => 'shop/self-shop/edit', 'text' => '编辑'],

    ];

    protected $shop;
    protected $category;
    protected $user;
    protected $shopClass;
    protected $shopCredit;

    public function __construct(
        ShopRepository $shop
        ,CategoryRepository $category
        ,UserRepository $user
        ,ShopClassRepository $shopClass
        ,ShopCreditRepository $shopCredit
    )
    {
        parent::__construct();

        $this->shop = $shop;
        $this->category = $category;
        $this->user = $user;
        $this->shopClass = $shopClass;
        $this->shopCredit = $shopCredit;
    }

    public function lists(Request $request)
    {
        $title = '列表';
        $fixed_title = '自营店铺 - '.$title;
        $is_supply = $request->get('is_supply', 0);

        $this->sublink($this->links, 'list?is_supply=0', '', '', 'add,edit');

        $action_span = [
            [
                'url' => 'add',
                'icon' => 'fa-plus',
                'text' => '添加自营店铺'
            ],
        ];

        $explain_panel = [
            '平台在此处统一管理自营店铺，可以新增、编辑平台自营店铺'
        ];
        $blocks = [
            'explain_panel' => $explain_panel,
            'fixed_title' => $fixed_title,
            'action_span' => $action_span
        ];

        $this->setLayoutBlock($blocks); // 设置block

        $params = $request->all();
        $where = [];
        $where[] = ['shop_type', 0]; // 自营店铺
        $where[] = ['shop_audit', 1]; // 审核通过

        // 搜索条件
        $search_arr = ['key_word', 'start_from', 'start_to', 'end_from', 'end_to', 'credit_from', 'credit_to'];
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
                $item->score = '5.00'; // 需计算
            }
        }
        $pageHtml = pagination($total);

        $compact = compact('title', 'list', 'total', 'pageHtml');
        if ($request->ajax()) {
            $render = view('shop.self-shop.partials._list', $compact)->render();
            return result(0, $render);
        }
        return view('shop.self-shop.list', $compact);
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
        $this->sublink($this->links, 'add', 'is_supply', '', 'edit');

        $fixed_title = '自营店铺 - '.$title;

        $action_span = [
            [
                'url' => 'list?is_supply=0',
                'icon' => 'fa-reply',
                'text' => '返回自营店铺列表'
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

        return view('shop.self-shop.add', compact('title', 'cat_list'));
    }



    public function edit(Request $request)
    {
        $title = '编辑';
        $id = $request->get('id');

        $info = $this->shop->getById($id);
        // 店铺信誉
        $credit = $this->shopCredit->getCreditInfoByScore($info->credit);
        $info->credit_name = $credit['credit_name'];
        $info->credit_img = $credit['credit_img'];
        $info->score = '5.00'; // 需计算

        $this->sublink($this->links, 'edit', 'is_supply', '', 'add');

        $fixed_title = '自营店铺 - '.$title;

        $action_span = [
            [
                'url' => 'list?is_supply='.$info->is_supply,
                'icon' => 'fa-reply',
                'text' => '返回自营店铺列表'
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

        $shop_bind_class = $info->shopBindClass;

        return view('shop.self-shop.edit', compact('title', 'info', 'cat_list', 'shop_bind_class'));
    }

    public function saveData(Request $request)
    {
        $post = $request->post('SelfShopModel');
        $shopFieldValueModel = $request->post('ShopFieldValueModel');

        $cat_ids = $request->post('cat_ids');
        $is_supply = $request->post('is_supply', 0);
        $shop_id = $request->get('id',0);

        $post['cat_ids'] = $cat_ids; // 店铺所属分类

        if ($shop_id) {
            // 编辑
            $ret = $this->shop->modifyShop($shop_id, $post, $shopFieldValueModel);
            $msg = '自营店铺编辑';
        }else {
            // 添加
            $post['shop_type'] = 0; // 自营店铺
            $post['open_time'] = time(); // 开店时间
            $post['shop_audit'] = 1; // 审核通过
            $post['shop_status'] = 1; // 店铺状态 开启
            $ret = $this->shop->addShop($post, $shopFieldValueModel);
            $msg = '自营店铺添加';
        }

        if ($ret === false) {
            // fail
            flash('error', $msg.'失败');
            return redirect('/shop/self-shop/list');
        }
        // success
        flash('success', $msg.'成功');
        return redirect('/shop/self-shop/list');
    }

    /**
     * 名称验证是否重复
     *
     * @param Request $request
     * @return mixed
     */
    public function clientValidate(Request $request)
    {
        $result = $this->shop->clientValidate($request, 'SelfShopModel');
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
}