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
// | Date:2019-3/23
// | Description:搭配套餐
// +----------------------------------------------------------------------

namespace app\Modules\Seller\Http\Controllers\Dashboard;

use App\Models\Goods;
use App\Models\GoodsSku;
use App\Modules\Base\Http\Controllers\Seller;
use App\Repositories\ActivityCategoryRepository;
use App\Repositories\ActivityRepository;
use App\Repositories\BrandRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\GoodsRepository;
use Illuminate\Http\Request;

/**
 * 搭配套餐管理
 *
 * Class GoodsMixController
 * @package app\Modules\Seller\Http\Controllers\Dashboard
 */
class GoodsMixController extends Seller
{

    private $links = [
        ['url' => 'dashboard/goods-mix/list', 'text' => '列表'],
        ['url' => 'dashboard/goods-mix/add', 'text' => '添加'],
        ['url' => 'dashboard/goods-mix/check', 'text' => '查看'],
    ];

    protected $activity;
    protected $activityCategory;
    protected $goods;
    protected $category;
    protected $brand;

    public function __construct()
    {
        parent::__construct();

        $this->activity = new ActivityRepository();
        $this->activityCategory = new ActivityCategoryRepository();
        $this->goods = new GoodsRepository();
        $this->category = new CategoryRepository();
        $this->brand = new BrandRepository();

        $this->set_menu_select('dashboard', 'dashboard-center');
    }


    public function lists(Request $request)
    {
        $title = '列表';
        $fixed_title = '营销中心 - '.$title;

        $action_span = [
            [
                'id' => '',
                'url' => '/dashboard/center/index',
                'icon' => 'fa-reply',
                'text' => '返回营销中心'
            ],
            [
                'id' => '',
                'url' => 'add',
                'icon' => 'fa-plus',
                'text' => '添加搭配套餐'
            ],
        ];

        $explain_panel = [
            '商家可以将几种商品组合成套餐，并设置套餐价来销售，通过这种优惠套餐的形式让买家一次性购买更多商品。以此提升销售业绩，提高购买转化率，提升销售笔数，增加商品曝光率',
            '参与满减送活动的商品不能参与搭配套餐，如果搭配套餐商品享受会员折扣，仍需以套餐价购买',
            '参与搭配套餐的商品，在套餐有效期内，商品无法修改规格和价格',
            '虚拟商品不参与搭配套餐活动',
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
        $search_arr = ['act_name','begin','end','act_status'];
        foreach ($search_arr as $v) {
            if (isset($params[$v]) && !empty($params[$v])) {

                if ($v == 'act_name') {
                    $where[] = ['act_name', 'like', "%{$params[$v]}%"];
                } else {
                    $where[] = [$v, $params[$v]];
                }
            }
        }
        // 列表
        list($list, $total) = $this->activity->getGoodsMixActivityList($where);

        $pageHtml = pagination($total);
        $page = frontend_pagination($total, true);

        if ($request->ajax()) {
            $render = view('dashboard.goods-mix.partials._list', compact('list', 'total', 'pageHtml'))->render();
            return result(0, $render);
        }

        // 获取数据

        $compact = compact('title', 'list', 'pageHtml');

        $webData = []; // web端（pc、mobile）数据对象
        $data = [
            'app_extra_data' => [],
            'app_prefix_data' => [
                'list' => $list,
                'page' => $page
            ],
            'app_context_data' => $this->getAppContext(),
            'app_suffix_data' => [],
            'web_data' => $webData,
            'compact_data' => $compact,
            'tpl_view' => 'dashboard.goods-mix.list'
        ];
        $this->setData($data); // 设置数据
        return $this->displayData(); // 模板渲染及APP客户端返回数据
    }

    public function add(Request $request)
    {
        $title = '添加';

        $id = $request->get('id', 0);
        $this->sublink($this->links, 'add', '', '', 'check');

        $model = [
            'sort' => 255
        ];
        $start_time = date('Y-m-d H:i:s', time());
        $end_time = date("Y-m-d H:i:s",strtotime("+7 day"));

        $fixed_title = '搭配套餐 - '.$title;

        $action_span = [
            [
                'url' => 'list',
                'icon' => 'fa-reply',
                'text' => '返回搭配套餐列表'
            ],
        ];

        $explain_panel = [];
        $blocks = [
            'explain_panel' => $explain_panel,
            'fixed_title' => $fixed_title,
            'action_span' => $action_span
        ];

        $this->setLayoutBlock($blocks); // 设置block

        // 获取数据

        $discount_show = [
            '买家浏览商品详情时，不能看到套餐优惠价格',
            '买家浏览商品详情时，可以看到套餐优惠价格'
        ];
        $compact = compact('title', 'model', 'start_time', 'end_time', 'discount_show');

        $webData = []; // web端（pc、mobile）数据对象
        $data = [
            'app_extra_data' => [],
            'app_prefix_data' => [
                'model' => $model,
                'start_time' => $start_time,
                'end_time' => $end_time,
                'discount_show' => $discount_show
            ],
            'app_context_data' => $this->getAppContext(),
            'app_suffix_data' => [],
            'web_data' => $webData,
            'compact_data' => $compact,
            'tpl_view' => 'dashboard.goods-mix.add'
        ];
        $this->setData($data); // 设置数据
        return $this->displayData(); // 模板渲染及APP客户端返回数据
    }

    public function check(Request $request)
    {
        $title = '查看';

        $id = $request->get('id', 0);
        $this->sublink($this->links, 'check', '', '', 'add');
        $fixed_title = '搭配套餐 - '.$title;

        $action_span = [
            [
                'url' => 'list',
                'icon' => 'fa-reply',
                'text' => '返回搭配套餐列表'
            ],
        ];

        $explain_panel = [];
        $blocks = [
            'explain_panel' => $explain_panel,
            'fixed_title' => $fixed_title,
            'action_span' => $action_span
        ];

        $this->setLayoutBlock($blocks); // 设置block

        // 获取数据
        $min_price = '';
        $max_price = null;

        $model = $this->activity->getById($id, ['sort','act_id','act_name','act_title','act_img','start_time','end_time','purchase_num','shop_id','ext_info']);
        $model = $model->toArray();
        $goods_list = []; // 赠品商品列表
        $values = [];

        $compact = compact('title', 'model', 'goods_list', 'end_time', 'values');

        $webData = []; // web端（pc、mobile）数据对象
        $data = [
            'app_extra_data' => [],
            'app_prefix_data' => [
                'min_price' => $min_price,
                'max_price' => $max_price,
                'model' => $model,
                'goods_list' => $goods_list,
                'values' => $values,
            ],
            'app_context_data' => $this->getAppContext(),
            'app_suffix_data' => [],
            'web_data' => $webData,
            'compact_data' => $compact,
            'tpl_view' => 'dashboard.goods-mix.check'
        ];
        $this->setData($data); // 设置数据
        return $this->displayData(); // 模板渲染及APP客户端返回数据
    }

    /**
     * 保存信息
     * TODO 后期再完成
     *
     * @param Request $request
     * @return mixed
     */
    public function saveData(Request $request)
    {
        $post = $request->post();
        $postModel = $request->post('GoodsMixModel');

        // 活动扩展数据
        dd($post);


        // 添加
        $post['shop_id'] = seller_shop_info()->shop_id;

        $ret = $this->activity->store($post);
        $msg = '搭配套餐添加';

        if ($ret === false) {
            // fail
            return result(-1, null, $msg.'失败');
        }
        // success
        return result(0, null, $msg.'成功');
    }

    /**
     * 删除
     * @param Request $request
     * @return mixed
     */
    public function delete(Request $request)
    {
        $id = $request->post('id');
        $ret = $this->activity->del($id);

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
        $ret = $this->activity->batchDel($ids);

        $ids = implode(',', $ids);
        if ($ret === false) {
            // Log
            admin_log('搭配套餐删除失败。ID：'.$ids);
            return result(-1, '', '删除失败');
        }
        // Log
        admin_log('删除了多个搭配套餐。ID：'.$ids);
        return result(0, '', '删除成功');
    }

    public function skuInfo(Request $request)
    {
        $goods_id = $request->get('goods_id');
        $sku_ids = $request->get('sku_ids'); // 2,3,4,5
        $uuid = make_uuid();


        $goods_info = Goods::where('goods_id', $goods_id)->first();
        if (!empty($goods_info)) {
            $goods_info = $goods_info->toArray();
        }
        $sku_info = GoodsSku::where([['goods_id', $goods_id],['checked',1]])
            ->whereIn('sku_id', explode(',', $sku_ids))
            ->select(['sku_id','goods_id','spec_names','goods_price','checked'])->get()->toArray();
        $select_all = false; // 是否全部选中 todo
        $disable = 0; // 参与是否可用 0-可用 1-禁用
        $render = view('dashboard.goods-mix.sku_info', compact('uuid','goods_info','sku_info','select_all', 'disable'))->render();

        return result(0, $render);
    }

    /**
     * 选中商品时 异步加载商品信息
     *
     * @param Request $request
     * @return array
     * @throws \Throwable
     */
    public function goodsInfo(Request $request)
    {
        $goods_id = $request->post('goods_id');
        $price_mode = $request->post('price_mode'); // 价格模式 0-统一套餐价 1-自定义规格价

//        $goods_info = Goods::where('goods_id',$goods_id)->first();
        $goods_info = Goods::where('goods_id', $goods_id)
            ->select(['goods_id','goods_price','goods_number','goods_name'])->first();
        $goods_sku_list = GoodsSku::where([['goods_id', $goods_id],['checked',1]])
            ->select(['sku_id','goods_number','goods_price'])->get()->toArray();
        $goods_price = [];
        foreach (array_column($goods_sku_list, 'goods_price') as $gp) {
            $goods_price[] = '￥'.$gp;
        }
        $goods_price = implode('-', $goods_price);
        $sku_ids = implode(',', array_column($goods_sku_list, 'sku_id'));



        if (empty($goods_info)) {
            return result(-1, null, '商品ID无效');
        }
        if ($goods_info->goods_number <= 0) {
            return result(-1, null, '该商品库存不足，不可选择！');
        }

        // 查询活动分类列表（树形）
        $where = [];
        $where[] = ['is_show',1];
        $condition = [
            'where' => $where,
            'limit' => 0, // 不分页
            'sortname' => 'created_at',
            'sortorder' => 'desc',
        ];
        list($category_list, $category_total) = $this->activityCategory->getList($condition, '', false, true);

        $render = view('dashboard.goods-mix.goods_info', compact('goods_info', 'category_list', 'price_mode', 'goods_price', 'sku_ids'))->render();
        return result(0, $render, '');
    }

}