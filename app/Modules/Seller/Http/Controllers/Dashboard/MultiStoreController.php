<?php

namespace App\Modules\Seller\Http\Controllers\Dashboard;

use App\Models\MultiStore;
use App\Models\MultiStoreGoods;
use App\Models\MultiStoreGroup;
use App\Models\User;
use App\Modules\Base\Http\Controllers\Seller;
use App\Repositories\BrandRepository;
use App\Repositories\GoodsRepository;
use App\Repositories\MultiStoreGoodsRepository;
use App\Repositories\MultiStoreRepository;
use App\Repositories\ShopCategoryRepository;
use App\Repositories\ShopConfigFieldRepository;
use App\Repositories\ShopConfigRepository;
use Illuminate\Http\Request;

class MultiStoreController extends Seller
{

    private $links = [
        ['url' => 'dashboard/multi-store/index', 'text' => '门店列表'],
        ['url' => 'dashboard/multi-store/goods-manage', 'text' => '门店商品管理'],
        ['url' => 'dashboard/multi-store-group/list', 'text' => '门店分组'],
        ['url' => 'finance/bill/multi-store-bill', 'text' => '门店结算'],
        ['url' => 'dashboard/multi-store/site', 'text' => '门店设置'],
    ];

    private $manageLinks = [
        ['url' => 'dashboard/multi-store/index', 'text' => '门店列表'],
        ['url' => 'dashboard/multi-store/add', 'text' => '添加'],
        ['url' => 'dashboard/multi-store/edit', 'text' => '编辑'],
    ];

    protected $multiStore;
    protected $multiStoreGoods;
    protected $shopConfig;
    protected $shopConfigField;
    protected $shopCategory;
    protected $goods;
    protected $brand;


    public function __construct(MultiStoreRepository $multiStore
        , MultiStoreGoodsRepository $multiStoreGoods
        , ShopConfigRepository $shopConfig
        , ShopConfigFieldRepository $shopConfigField
        , ShopCategoryRepository $shopCategory
        ,GoodsRepository $goods
        ,BrandRepository $brand
    )
    {
        parent::__construct();

        $this->multiStore = $multiStore;
        $this->multiStoreGoods = $multiStoreGoods;
        $this->shopConfig = $shopConfig;
        $this->shopConfigField = $shopConfigField;
        $this->shopCategory = $shopCategory;
        $this->goods = $goods;
        $this->brand = $brand;

        $this->set_menu_select('dashboard', 'dashboard-center');

    }

    public function index(Request $request)
    {
        $title = '线下门店列表';
        $fixed_title = '门店管理 - ' . $title;

        $this->sublink($this->links, 'index');

        $action_span = [
            [
                'url' => 'add',
                'icon' => 'fa-plus',
                'text' => '添加门店'
            ],
        ];

        $explain_panel = [
            '多门店是一个面向线下连锁零售企业的全渠道信息化管理工具，提供完整的分门店线上经营方案',
            '适用业态：直营连锁、品牌加盟、同城O2O、大区分仓',
            '适用行业：水果蔬菜、生鲜、蛋糕烘焙、便利店、零食、餐饮外卖、鲜花、日用百货等',
            '店铺第一次开启门店独立库存和价格，如果门店独立库存和价格未设置，门店库存默认值为“0”，门店价格默认值取店铺价格',
            '店铺开启门店独立库存和价格之后再关闭门店独立库存和价格，各门店设置的独立库存和价格不清除，再次开启时可以启用',
            '店铺开启独立库存和价格后，店铺对商品规格的增加、删除、修改逻辑',
            'a) 店铺增加规格，各门店同步增加，库存默认值为0，价格默认值取总部价格',
            'b) 店铺删除规格，各门店同步删除，库存和价格等数据都删除',
            'c) 店铺变更规格名称，各门店同步变更名称，库存和价格不变',
            '1、店铺新添加的商品，不会自动同步到门店，需要手动同步到门店',
            '2、店铺删除某个商品后，门店关联的此商品也将自动删除，店铺从回收站还原商品之后，门店关联的此商品也自动还原',
        ];
        $blocks = [
            'explain_panel' => $explain_panel,
            'fixed_title' => $fixed_title,
            'action_span' => $action_span
        ];

        $this->setLayoutBlock($blocks); // 设置block

        $params = $request->all();

        $where = [];
        $where[] = ['shop_id', seller_shop_info()->shop_id];
        // 搜索条件
        $search_arr = ['key_word'];
        foreach ($search_arr as $v) {
            if (isset($params[$v]) && !empty($params[$v])) {

                if ($v == 'key_word') {
                    $where[] = ['store_name', 'like', "%{$params[$v]}%"];
                } else {
                    $where[] = [$v, $params[$v]];
                }
            }
        }
        // 列表
        $condition = [
            'where' => $where,
            'sortname' => 'store_id',
            'sortorder' => 'desc',
        ];
        list($list, $total) = $this->multiStore->getList($condition);
        if ($total > 0) {
            foreach ($list as $item) {
                $item->is_opend = '1';
                $item->user_name = $item->user->user_name ?? '';
                $item->group_name = $item->storeGroup->group_name ?? '';
                $item->uid = $item->user_id;
                $item->order_count = '0';
                $item->is_pickup = $item->pickup_id > 0 ? true : false;
                $item->url = 'http://' . config('lrw.mobile_domain') . '/'.get_store_code($item->store_id); // 门店链接地址
            }
        }
        // 获取数据
        $pageHtml = pagination($total, false);
        $page = frontend_pagination($total, true);
        $is_hongye_multi = false;
        $is_show_multi_map = false;
        $is_support_program = null;
        $is_hongye_allocation_stock = '0';

        $app_prefix_data = [
            'list' => $list,
            'page' => $page,
            'is_hongye_multi' => $is_hongye_multi,
            'is_show_multi_map' => $is_show_multi_map,
            'is_support_program' => $is_support_program,
            'is_hongye_allocation_stock' => $is_hongye_allocation_stock,
        ];

        // web html 数据
        $compact_data = $app_prefix_data;
        $compact_data['title'] = $title;
        $compact_data['pageHtml'] = $pageHtml;
        $compact_data['total'] = $total;
        if ($request->ajax()) {
            $render = view('dashboard.multi-store.partials._list', compact('list', 'pageHtml'))->render();
            return result(0, $render);
        }

        $webData = []; // web端（pc、mobile）数据对象
        $data = [
            'app_extra_data' => [],
            'app_prefix_data' => $app_prefix_data,
            'app_context_data' => $this->getAppContext(),
            'app_suffix_data' => [],
            'web_data' => $webData,
            'compact_data' => $compact_data,
            'tpl_view' => 'dashboard.multi-store.list'
        ];
        $this->setData($data); // 设置数据
        return $this->displayData(); // 模板渲染及APP客户端返回数据
    }

    public function add(Request $request)
    {
        $title = '添加';

        $id = $request->get('id', 0);
        $this->sublink($this->manageLinks, 'add', '', '', 'edit');

        $model = [
            "take_rate" => "0.00",
            "region_type" => 0,
            "user_type" => 0,
            "edit_info" => 1,
            "store_status" => 1,
            "is_opend" => 1,
            "opening_type" => 0,
            "shop_id" => seller_shop_info()->shop_id,
            "region_editable" => 1,
            "opening_hour" => null
        ];

        if ($id) {
            $this->sublink($this->manageLinks, 'edit', '', '', 'add');

            // 更新操作
            $model = $this->multiStore->getById($id);
            $model = $model->toArray();


            $title = '编辑';
        }

        $fixed_title = '门店管理 - ' . $title;

        $action_span = [
            [
                'url' => 'list',
                'icon' => 'fa-reply',
                'text' => '返回门店列表'
            ],
        ];

        $explain_panel = [];
        $blocks = [
            'explain_panel' => $explain_panel,
            'fixed_title' => $fixed_title,
            'action_span' => $action_span
        ];

        $this->setLayoutBlock($blocks); // 设置block

        $region_colors = [
            [
                "blue",
                "#93C1FC",
                "#0778E2"
            ],
            [
                "red",
                "#FF9486",
                "#BB412D"
            ],
            [
                "young",
                "#A3E1B8",
                "#47C370"
            ],
            [
                "light-blue",
                "#A4DCDE",
                "#58C9CD"
            ],
            [
                "brown",
                "#F4E08E",
                "#E9C11D"
            ],
            [
                "green",
                "#A7EE99",
                "#4FDC33"
            ],
            [
                "orange",
                "#FFBF80",
                "#FF7F00"
            ],
            [
                "purple",
                "#BDA3EF",
                "#7B47DF"
            ],
            [
                "powder",
                "#EFA3DB",
                "#DF47B6"
            ]
        ];

        // 店铺管理员列表
        $user_list = $this->userList($request);
        $is_show_settle_mode = 0;
        // 门店分组
        $group_list = [0 => '--请选择--'];
        $groupList = MultiStoreGroup::orderBy('group_sort', 'asc')->get();
        if (!empty($groupList)) {
            foreach ($groupList as $item) {
                $group_list[$item->group_id] = $item->group_name;
            }
        }

        // 获取数据
        $app_prefix_data['group_list'] = $group_list;
        $app_prefix_data['model'] = $model;
        if ($id) {
            $region_list = [];
            $region_str = "";
            $app_prefix_data['region_list'] = $region_list;
            $app_prefix_data['region_str'] = $region_str;
        } else {
            $app_prefix_data['user_list'] = $user_list;
        }
        $app_prefix_data['region_colors'] = $region_colors;
        $app_prefix_data['is_show_settle_mode'] = $is_show_settle_mode;

        $compact = compact('title', 'group_list', 'model', 'region_list', 'region_str', 'region_colors', 'user_list', 'is_show_settle_mode');

        $webData = []; // web端（pc、mobile）数据对象
        $data = [
            'app_extra_data' => [],
            'app_prefix_data' => $app_prefix_data,
            'app_context_data' => $this->getAppContext(),
            'app_suffix_data' => [],
            'web_data' => $webData,
            'compact_data' => $compact,
            'tpl_view' => 'dashboard.multi-store.add'
        ];
        $this->setData($data); // 设置数据
        return $this->displayData(); // 模板渲染及APP客户端返回数据
//        return view('dashboard.multi-store.add', compact('title', 'info', 'user_list', 'group_list'));
    }

    public function edit(Request $request)
    {
        return $this->add($request);
    }

    /**
     * 保存信息
     *
     * @param Request $request
     * @return mixed
     */
    public function saveData(Request $request)
    {
        $post = $request->post('MultiStoreModel');

        if (!empty($post['store_id'])) {
            // 编辑
            $ret = $this->multiStore->update($post['store_id'], $post);
            $msg = '门店编辑';
        } else {
            // 添加
            $post['shop_id'] = seller_shop_info()->shop_id;

            $ret = $this->multiStore->store($post);
            // 验证门店管理员不能是店主、网点主账号、门店主账号
            $user = User::where([['shop_id', 0], ['store_id', 0], ['multi_store_id', 0], ['user_id', $post['user_id']]])->first();
            if ($post['user_type'] == 0 && empty($user)) { // 会员
                return result(-1, null, '门店管理员不存在或者您没有权限操作此账户！');
            }
            if ($user->is_seller == 1) {
                return result(-1, null, '不能绑定店主为门店管理员！');
            }
            User::where('user_id', $post['user_id'])->update(['shop_id' => $post['shop_id'], 'multi_store_id' => $ret->store_id]);
            $msg = '门店添加';
        }

        if ($ret === false) {
            // fail
            return result(-1, null, $msg . '失败');
        }
        // success
        return result(0, null, $msg . '成功');
    }

    /**
     * 删除
     * @param Request $request
     * @return mixed
     */
    public function delete(Request $request)
    {
        $id = $request->post('id');
        $ret = $this->multiStore->del($id);

        if ($ret === false) {
            // Log
            return result(-1, null, '删除失败');
        }

        // Log
        return result(0, null, '删除成功');
    }

    public function batchDelete(Request $request)
    {
        $ids = $request->post('ids');
        $ret = $this->multiStore->batchDel($ids);

        $ids = implode(',', $ids);
        if ($ret === false) {
            // Log
            shop_log('门店删除失败。ID：' . $ids);
            return result(-1, '', '删除失败');
        }
        // Log
        shop_log('删除了多个门店。ID：' . $ids);
        return result(0, '', '删除成功');
    }

    /**
     * 异步加载门店分组列表
     *
     * @return array
     */
    public function groupList()
    {
        $list = [0 => '--请选择--'];
        $groupList = MultiStoreGroup::orderBy('group_sort', 'asc')->get();
        if (!empty($groupList)) {
            foreach ($groupList as $item) {
                $list[$item->group_id] = $item->group_name;
            }
        }

        return result(0, $list);
    }

    /**
     * 管理员列表
     * @param Request $request
     * @return array
     */
    public function userList(Request $request)
    {
        $format = $request->get('format', 'array');
        $userList = User::where([['shop_id', seller_shop_info()->shop_id], ['is_seller', 0], ['store_id', 0]])
            ->select(['email', 'mobile', 'user_id', 'user_name'])->get()->toArray();
        if ($format == 'json') {
            return result(0, $userList);
        }
        return $userList;
    }

    public function regionPicker()
    {
        $uuid = make_uuid();

        $render = view('dashboard.multi-store.region_picker', compact('uuid'))->render();

        return result(0, $render);
    }

    public function setIsEnable(Request $request)
    {
        $id = $request->get('id');
        $ret = $this->multiStore->changeState($id, 'store_status');
        if ($ret === false) {
            return result(-1, '', '设置失败');
        }
        return result(0, $ret, '设置成功');
    }

    /**
     * 设置默认门店
     * @param Request $request
     * @return array|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function master(Request $request)
    {
        $id = $request->post('store_id');
        $is_master = $request->post('is_master');
        //
        $info = MultiStore::where('is_master', 1)->first();
        if (!empty($info) && !$is_master) {
            return result(-1, '', '主店已经存在,设置失败！');
        }
        $ret = $this->multiStore->changeStateReverse($id, 'is_master');
        if ($ret === false) {
            return result(-1, '', '设置失败');
        }
        return result(0, $ret, '设置成功');
    }

    public function setActivity(Request $request)
    {
        $id = $request->get('id');
        $info = $this->multiStore->getById($id);
        $render = view('dashboard.multi-store.set_activity', compact('info'))->render();

        return result(0, $render);
    }

    /**
     * 门店设置
     */
    public function site(Request $request)
    {
        $action_span = [
            [
                'url' => '/dashboard/center/index',
                'icon' => 'fa-reply',
                'text' => '返回营销中心'
            ]
        ];

        $this->sublink($this->links, 'site');

        $group = 'multi_store'; // 当前配置分组
        $group_info = $this->shopConfigField->getConfigList($group, seller_shop_info()->shop_id);
        $title = $fixed_title = '门店设置';
        $uuid = make_uuid();
        $script_render = view('shop.config.partials.' . $group, compact('uuid'))->render();

        $explain_panel = [
            "门店模式-连锁店：连锁店将在手机端前台展示，消费者选择进入某个连锁店进行购物，会员在某个连锁店下单之后，订单会自动派给连锁店，由连锁店进行发货。",
            "开启门店独立库存和价格，各个门店可独立设置连锁店售卖的商品价格和库存，不受店铺设置的影响，否则门店不可设置连锁店售卖的商品价格和库存，全部按照店铺统一价售卖。"
        ];
        $blocks = [
            'fixed_title' => $fixed_title,
            'action_span' => $action_span,
            'explain_panel' => $explain_panel,
        ];
        $this->setLayoutBlock($blocks); // 设置block

        $introduce_box = '';

        // 获取数据
        $group = 'multi_store'; // 当前配置分组
        $model = $this->shopConfigField->getSpecialConfigsByGroup($group, 'code', true);
        $back_url = $request->fullUrl();

        $compact = compact('title', 'group', 'group_info', 'script_render', 'introduce_box');

        $webData = []; // web端（pc、mobile）数据对象
        $data = [
            'app_extra_data' => [],
            'app_prefix_data' => [
                'model' => $model,
                'back_url' => $back_url,
            ],
            'app_context_data' => $this->getAppContext(),
            'app_suffix_data' => [],
            'web_data' => $webData,
            'compact_data' => $compact,
            'tpl_view' => 'shop.config.config'
        ];
        $this->setData($data); // 设置数据
        return $this->displayData(); // 模板渲染及APP客户端返回数据
    }

    /**
     * 门店商品管理
     * @param Request $request
     * @return mixed
     */
    public function goodsList(Request $request)
    {
        $title = '商品管理';
        $fixed_title = '门店管理 - ' . $title;

        $store_id = $request->get('store_id', 0);
        $is_manage = $request->routeIs('goods-manage') ? 1 : 0;

        if ($is_manage) {
            $this->sublink($this->links, 'goods-manage');
            $action_span = [
                [
                    'url' => 'batch-edit-manage',
                    'icon' => 'fa-refresh',
                    'text' => '批量更新商品价格、库存、状态'
                ]
            ];
        } else {
            $action_span = [
                [
                    'url' => 'index',
                    'icon' => 'fa-reply',
                    'text' => '返回门店列表'
                ],
                [
                    'id' => 'related_goods',
                    'icon' => 'fa-plus',
                    'text' => '关联商品'
                ],
                [
                    'id' => 'upload_goods',
                    'url' => 'batch-edit?store_id=' . $store_id,
                    'icon' => 'fa-refresh',
                    'text' => '批量更新商品价格、库存、状态'
                ]
            ];
        }

        $explain_panel = $is_manage ? [] : [
            '门店中的商品，门店管理员有权限操作上下架，但此上下架仅对自己门店起作用',
            '店铺未开启门店独立库存和独立价格功能时，店铺和门店也可修改门店商品的价格和库存，修改的价格和库存会在开启门店独立库存和独立价格时起作用',
            '如果门店是独立库存、独立价格，自动关联店铺商品后，商品库存默认是0，商品价格默认是店铺售价',
            '门店关联店铺商品，店铺添加、删除、修改商品，门店商品也跟随变化',
            '开启独立库存和价格后，店铺对商品规格的增加、删除、修改逻辑：',
            'a) 店铺增加规格，各门店同步增加，库存默认值为0，价格默认值取总部价格',
            'b) 店铺删除规格，各门店同步删除，库存和价格等数据都删除',
            'c) 店铺变更规格名称，各门店同步变更名称，库存和价格不变',
            '1、店铺新添加的商品，不会自动同步到门店，需要手动同步到门店',
            '2、店铺删除某个商品后，门店关联的此商品将自动删除，店铺从回收站还原商品之后，门店关联的此商品也自动还原'
        ];
        $blocks = [
            'explain_panel' => $explain_panel,
            'fixed_title' => $fixed_title,
            'action_span' => $action_span
        ];

        $this->setLayoutBlock($blocks); // 设置block

        $params = $request->all();

        $where = [];
        $where[] = ['shop_id', seller_shop_info()->shop_id];
        $store_id && $where[] = ['store_id', $store_id];
        // 搜索条件
        $search_arr = ['key_word'];
        foreach ($search_arr as $v) {
            if (isset($params[$v]) && !empty($params[$v])) {

                if ($v == 'key_word') {
                    $where[] = ['name', 'like', "%{$params[$v]}%"];
                } else {
                    $where[] = [$v, $params[$v]];
                }
            }
        }
        // 列表
        $condition = [
            'where' => $where,
            'sortname' => 'id',
            'sortorder' => 'desc',
            'with' => ['goods','multiStore']
        ];
        list($list, $total) = $this->multiStoreGoods->getList($condition);
        $list = $list->toArray();
        if ($total > 0) {
            foreach ($list as &$item) {
                $goods = $item['goods'];
                $goods_sku_main = $goods['goods_sku_main'];
                $item['goods_name'] = $goods['goods_name'];
                $item['goods_image'] = $goods['goods_image'];
                $item['goods_mode'] = $goods['goods_mode'];
                $item['sales_model'] = $goods['sales_model'];
                $item['is_virtual'] = $goods['is_virtual'];
                $item['sku_open'] = $goods['sku_open'];
                $item['prop_open'] = $goods['prop_open'] ?? 0;
                $item['lib_goods_id'] = $goods['lib_goods_id'];
                $item['erp_goods_id'] = $goods['erp_goods_id'];
                $item['cat_id'] = $goods['cat_id'];
                $item['goods_audit'] = $goods['goods_audit'];
                $item['goods_status'] = $goods['goods_status'];
                $item['warn_number'] = $goods['warn_number'];
                $item['sku_id'] = $goods['sku_id'];
                $item['sku_warn_number'] = $goods_sku_main['warn_number'];
                $item['shop_goods_price'] = $goods['goods_price'];
                $item['shop_goods_number'] = $goods['goods_number'];
                $item['cost_price'] = $goods['cost_price'];
                $item['is_common_package'] = $goods['is_common_package'] ?? 1;
                $item['user_discount'] = $goods['user_discount'];
                $item['stock_mode'] = $goods['stock_mode'];
                $item['goods_sn'] = $goods['goods_sn'];
                $item['goods_unit'] = $goods['goods_unit'];
                $item['m_id'] = $goods['m_id'] ?? '';// todo 商品没加该字段
                $item['act_types'] = $goods['act_types'] ?? []; // todo 商品没加该字段
                $item['goods_url'] = get_store_goods_url($store_id, $item['goods_id']);
                // https://images.lrw.com/1737 /gqrcode/5C/309(店铺id)/396(门店id)/qrcode_72154(商品id).png
//                $item['goods_image_qrcode'] = get_image_url($item['goods_image_qrcode']); // 没用到该字段
                $item['store_name'] = $item['multi_store']['store_name'];
                unset($item['goods'], $item['multi_store']);
            }
        }
        // 获取数据
        $pageHtml = pagination($total);
        $page = frontend_pagination($total, true);
        $shop_cat_list = $this->shopCategory->getShopCategoryList(seller_shop_info()->shop_id);
        $on_sale_count = '0';
        $off_sale_count = '0';
        $goods_status = [
            "items" => [
                "" => "全部",
                "0" => "已下架",
                "1" => "出售中",
                "2" => "违规下架"
            ]
        ];
        $pricing_mode = [
            "items" => [
                "" => "全部",
                "0" => "计件",
                "1" => "计重"
            ]
        ];
        $status = [
            "items" => [
                "" => "全部",
                "0" => "已下架",
                "1" => "出售中"
            ]
        ];
        $keyword_type_list = [
            "商品名称",
            "商品ID",
            "货号"
        ];
        // 获取店铺全部门店
        $store_list = MultiStore::where('shop_id', seller_shop_info()->shop_id)->pluck('store_name', 'store_id')->toArray();
        $store_list = array_merge(["" => "请选择门店"], $store_list);
        $searchModel = null;
        $action = 'index';
        $shop_id = seller_shop_info()->shop_id;
        $lang = []; // 语言包
        $is_pickup = 1;
        $stock_price_txt_show = true;
        $stock_txt = '店铺统一库存';
        $price_txt = '店铺统一价格';

        $is_allowed_related_goods = 1;
        $show_seller_goods = 1;
        $is_show_multi_stock = false;
        $store_name = $this->multiStore->getFieldById($store_id, 'store_name');
        $is_show_sync_nf = false;
        $show_erp_stock = false;
        $counter = 0;
        $app_prefix_data = [
            'list' => $list,
            'page' => $page,
            'shop_cat_list' => $shop_cat_list,
            'on_sale_count' => $on_sale_count,
            'off_sale_count' => $off_sale_count,
            'goods_status' => $goods_status,
            'pricing_mode' => $pricing_mode,
            'status' => $status,
            'keyword_type_list' => $keyword_type_list,
            'store_list' => $store_list,
            'searchModel' => $searchModel,
            'action' => $action,
            'shop_id' => $shop_id,
            'store_id' => $store_id,
            'lang' => $lang,
            'is_pickup' => $is_pickup,
            'stock_price_txt_show' => $stock_price_txt_show,
            'stock_txt' => $stock_txt,
            'price_txt' => $price_txt,
            'is_manage' => $is_manage,
            'is_allowed_related_goods' => $is_allowed_related_goods,
            'show_seller_goods' => $show_seller_goods,
            'is_show_multi_stock' => $is_show_multi_stock,
            'store_name' => $store_name,
            'is_show_sync_nf' => $is_show_sync_nf,
            'show_erp_stock' => $show_erp_stock,
            'counter' => $counter,
        ];

        // web html 数据
        $compact_data = $app_prefix_data;
        $compact_data['title'] = $title;
        $compact_data['pageHtml'] = $pageHtml;
        $compact_data['total'] = $total;

        if ($request->ajax()) {
            $render = view('dashboard.multi-store.partials._goods_list', compact('list', 'pageHtml', 'is_manage'))->render();
            return result(0, $render);
        }

        $webData = []; // web端（pc、mobile）数据对象
        $data = [
            'app_extra_data' => [],
            'app_prefix_data' => $app_prefix_data,
            'app_context_data' => $this->getAppContext(),
            'app_suffix_data' => [],
            'web_data' => $webData,
            'compact_data' => $compact_data,
            'tpl_view' => 'dashboard.multi-store.goods_list'
        ];
        $this->setData($data); // 设置数据
        return $this->displayData(); // 模板渲染及APP客户端返回数据
    }

    public function setIsSell(Request $request)
    {
        $store_id = $request->get('store_id');
        $spu_id = $request->get('spu_id'); // 商品id
        $ret = $this->multiStoreGoods->changeState($store_id, $spu_id, 'is_sell');
        if ($ret === false) {
            return result(-1, '', '设置失败');
        }
        return result(0, $ret, '设置成功');
    }

    public function setIsSelfMention(Request $request)
    {
        $store_id = $request->get('store_id');
        $spu_id = $request->get('spu_id'); // 商品id
        $ret = $this->multiStoreGoods->changeState($store_id, $spu_id, 'is_self_mention');
        if ($ret === false) {
            return result(-1, '', '设置失败');
        }
        return result(0, $ret, '设置成功');
    }

    /**
     * 商品批量上架/下架
     * @param Request $request
     * @return array|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function batchIsSell(Request $request)
    {
        $store_id = $request->get('store_id');
        $shop_id = $request->get('shop_id');
        $status = $request->get('status') == 'on' ? 1 : 0; // on off
        $spu_ids = $request->get('spu_ids'); // 商品ids
        $spu_ids = explode(',', $spu_ids);
        $ret = $this->multiStoreGoods->batchChangeState($store_id, $shop_id, $spu_ids, $status, 'is_sell');
        if ($ret === false) {
            return result(-1, '', '操作失败');
        }
        return result(0, $ret, '操作成功');
    }

    /**
     * 批量自提点设置
     * @param Request $request
     * @return array|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function batchIsSelfMention(Request $request)
    {
        $store_id = $request->get('store_id');
        $shop_id = $request->get('shop_id');
        $status = $request->get('status'); // 1 0
        $spu_ids = $request->get('spu_ids'); // 商品ids
        $spu_ids = explode(',', $spu_ids);
        $ret = $this->multiStoreGoods->batchChangeState($store_id, $shop_id, $spu_ids, $status, 'is_self_mention');
        if ($ret === false) {
            return result(-1, '', '操作失败');
        }
        return result(0, $ret, '操作成功');
    }

    /**
     * 批量 商品库存、价格设置
     */
    public function editMultiGoods(Request $request)
    {
        $uuid = make_uuid();
        $store_id = $request->post('store_id');
        $shop_id = $request->post('shop_id');
        $spu_ids = $request->post('spu_ids'); // 商品id 逗号分隔
        $is_edit = $request->post('is_edit', 0); // 是否编辑

        if ($is_edit) {
            $post = $request->except(['key', '_csrf']);
            $key = $request->post('key');// batchedit:multistore:goods:price:stock:396
            cache()->set($key, $post);
            return result(1, null, '正在处理中...');
        }

        $render = view('dashboard.multi-store.edit_multi_goods', compact('store_id', 'shop_id', 'spu_ids', 'uuid'))->render();

        return result(0, $render);
    }

    /**
     * 编辑商品库存、价格
     */
    public function editGoods(Request $request)
    {
        // price[0][sku_id]: 74374
        // price[0][store_sku_price]: 0.01
        // number[0][sku_id]: 74374
        // number[0][store_sku_number]: 2
        // goods_id: 72174
        // shop_id: 309
        // store_id: 396

        $uuid = make_uuid();
        $store_id = $request->get('store_id');
        $shop_id = $request->get('shop_id');
        $goods_id = $request->get('goods_id'); // 商品id

        $storeGoods = MultiStoreGoods::where([['store_id', $store_id],['goods_id', $goods_id]])
            ->with(['goods', 'multiStoreGoodsSku'])
            ->first();
        if (empty($storeGoods)) {
            return result(-1, null, INVALID_PARAM);
        }
//        dd($model['goods']['goods_spec']);

        if ($request->method() == 'POST') {
            $post = $request->post();
            $this->multiStoreGoods->editGoods($post);

            return result(0, null, '操作成功');
        }

        // 商品SKU
        $sku_list = $this->multiStoreGoods->getSkuList($storeGoods);
        // 商品规格
        $spec_list = $this->multiStoreGoods->getGoodsSpecList($storeGoods->goods);
        $app_prefix_data = [
            'report' => null,
            'model' => [
                'store_sku_price'=>$storeGoods['store_sku_price'],
                'store_sku_number'=>$storeGoods['store_sku_number'],
                'clientRuleCache' => 'cache'
            ],
            'goods_id' => $goods_id,
            'goods_name' => $storeGoods['goods']['goods_name'],
            'store_id'=>$store_id,
            'shop_id'=>$shop_id,
            'status'=>3,
            'is_show_multi_stock'=>false,
            'sku_list'=>$sku_list,
            'spec_list'=>$spec_list,

        ];

        // web html 数据
        $compact_data = $app_prefix_data;
        $compact_data['uuid'] = $uuid;
        if ($request->ajax()) {
            $render = view('dashboard.multi-store.edit_goods', $compact_data)->render();
            return result(0, $render);
        }

        $webData = []; // web端（pc、mobile）数据对象
        $data = [
            'app_extra_data' => [],
            'app_prefix_data' => $app_prefix_data,
            'app_context_data' => $this->getAppContext(),
            'app_suffix_data' => [],
            'web_data' => $webData,
            'compact_data' => $compact_data,
            'tpl_view' => ''
        ];
        $this->setData($data); // 设置数据
        return $this->displayData(); // 模板渲染及APP客户端返回数据
    }

    /**
     * 删除门店商品
     *
     * @param Request $request
     * @return array|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     * @throws \Exception
     */
    public function goodsDelete(Request $request)
    {
        $store_id = $request->post('store_id');
        $ids = $request->post('ids');
        $ret = $this->multiStoreGoods->deleteGoods($store_id, $ids);
        if ($ret === false) {
            // Log
            shop_log('门店商品删除失败。ID：' . $ids);
            return result(-1, '', '删除失败');
        }
        // Log
        shop_log('门店商品删除成功。ID：' . $ids);
        return result(0, '', '删除成功');
    }

    /**
     * 关联商品
     */
    public function storeRelatedGoods(Request $request)
    {
        if ($request->method() == 'POST') { // 提交
            // key: update:multistore:goods:relation:396
            // type: 1
            // store_id: 396
            // group_id: 0
            // select_goods_ids: 71764,71765,72154,72174,72176,
            // add_goods_ids: 72176
            // remove_goods_ids: 
            // related_goods_type: 4

            // 写入缓存 key: update:multistore:goods:relation:396
            $post = $request->except(['key', '_csrf']);
            $key = $request->post('key');
            cache()->set($key, $post);
            return result(1, null, '正在处理中...');
        }
        $uuid = make_uuid();
        $store_id = $request->get('store_id');
        $show_seller_goods = $request->get('show_seller_goods');
        $type = $request->get('type');
        // 获取门店已选择的商品
        $selected_goods_list = $this->multiStoreGoods->getSelectedGoods($store_id); // 已选商品
        $selected_goods = json_encode($selected_goods_list);
        $select_goods_id = implode(',', array_column($selected_goods_list, 'goods_id')); // 已选商品id 多个逗号分隔

        $render = view('dashboard.multi-store.store_relate_goods', compact('uuid', 'store_id', 'show_seller_goods', 'type', 'selected_goods', 'select_goods_id'))->render();

        return result(0, $render);
    }

    /**
     * 商品选择器
     *
     * @param Request $request
     * @return mixed
     * @throws \Throwable
     */
    public function picker(Request $request)
    {
        //output: true
        //left: col-sm-0
        //right: col-sm-12
        //page[page_id]: GoodsPickerPage_1639750405681000
        //page[cur_page]: 1
        //page[page_size]: 5
        //page[page_size_list][]: 5
        //page[page_size_list][]: 10
        //page[page_size_list][]: 15
        //page[page_size_list][]: 20
        //goods_status: 1
        //is_sku: 0
        //is_supply: 0
        //show_store: 1
        //show_seller_goods:
        //show_selected: 0
        //shop_id: 309
        //url: picker.html
        //sku_ids: 0
        //goods_ids: 71764,71765,72154,72174,721
        $page_id = make_uuid();
        $pagination_id = $request->post('page')['page_id'];
        $output = $request->post('output');
        $left = $request->post('left');
        $right = $request->post('right');
        $goods_status = $request->post('goods_status', 1); // 商品状态
        $is_sku = $request->post('is_sku', 0); //
        $is_supply = $request->post('is_supply', null); //
        $show_store = $request->post('show_store', 0); //
        $show_seller_goods = $request->post('show_seller_goods', ''); //
        $show_selected = $request->post('show_selected', 0); //
        $shop_id = $request->post('shop_id', 0); //
        $url = $request->post('url', ''); //
        $sku_ids = $request->post('sku_ids', 0);
        $goods_ids = $request->post('goods_ids', '');
        $goods_ids = explode(',', $goods_ids);

        // 商品列表
        $where[] = ['shop_id', seller_shop_info()->shop_id];
        $where[] = ['goods_status', $goods_status];
//        $where[] = ['is_sku', $is_sku];
//        $where[] = ['show_store', $show_store];
//        $where[] = ['is_enable', $is_enable];
//        $where[] = ['goods_audit', $goods_audit];

        $whereIn = [];

        $tpl = 'picker';
        if (!$output) {
            $tpl = 'partials._picker_goods_list';
            $show_selected = $request->post('show_selected');
            $goods_ids = $request->post('goods_ids');
            $goods_ids = explode(',', $goods_ids);

            if (!empty($goods_ids) && $show_selected) {

                $whereIn = [
                    'field' => 'goods_id',
                    'condition' => $goods_ids
                ];
            }

        }


        $condition = [
            'where' => $where,
            'in' => $whereIn,
            'sortname' => 'goods_id',
            'sortorder' => 'desc'
        ];
        list($list, $total) = $this->goods->getList($condition);
        $pageHtml = short_pagination($total, 5);

        // 店铺内分类列表
        $shop_cat_list = $this->shopCategory->getShopCategoryList(seller_shop_info()->shop_id);

        // 查询品牌
        $where = [];
        $where[] = ['is_show',1];
        $condition = [
            'where' => $where,
            'sortname' => 'brand_id',
            'sortorder' => 'desc',
            'field' => ['brand_id', 'brand_name']
        ];
        list($brand_list, $brand_total) = $this->brand->getList($condition);

        $compact = compact(
            'page_id', 'pagination_id', 'list', 'pageHtml',
            'sku_ids', 'goods_ids', 'shop_cat_list',
            'brand_list');
        $render = view('dashboard.multi-store.'.$tpl, $compact)->render();
        return result(0, $render);
    }

}