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
// | Date:2018-11-01
// | Description: 批量采集
// +----------------------------------------------------------------------

namespace App\Modules\Seller\Http\Controllers\Goods;

use App\Models\Freight;
use App\Models\GoodsType;
use App\Modules\Base\Http\Controllers\Seller;
use App\Repositories\CategoryRepository;
use App\Repositories\ShopCategoryRepository;
use App\Repositories\YunCollectRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CollectController extends Seller
{

    private $links = [
        ['url' => 'goods/cloud/goods-list', 'text' => '云产品库采集'],
        ['url' => 'goods/collect/show', 'text' => '批量采集'],
        ['url' => 'goods/collect-comment/goods-list', 'text' => '评论采集'],
    ];

    protected $yunCollectRep; // 云采集
    protected $shopCategory;
    protected $category;

    public function __construct(
        YunCollectRepository $yunCollectRep
        ,ShopCategoryRepository $shopCategory
        ,CategoryRepository $category
    )
    {
        parent::__construct();

        $this->yunCollectRep = $yunCollectRep;
        $this->shopCategory = $shopCategory;
        $this->category = $category;

        $this->set_menu_select('goods', 'goods-cloud-manage');

    }

    public function show(Request $request)
    {
        $title = '批量采集';
        $fixed_title = '数据采集 - '.$title;

        $this->sublink($this->links, 'goods/collect/show');

        $action_span = [
            [
                'url' => '/goods/cloud/goods-list',
                'id' => '',
                'icon' => 'fa-reply',
                'text' => '返回数据采集'
            ],
            [
                'url' => '',
                'id' => 'shopcollectinfo',
                'icon' => '',
                'text' => '查看我的采集数量'
            ],
        ];

        $explain_panel = [
            '为了在线采集稳定、准确、快速，强烈建议一次采集少于10个商品',
            '<font color="red">采集机制更换，时时采集在线数据，保证数据的准确性，及时性，同时保证稳定，采集速度有所下降，请谅解！</font>'
        ];
        $blocks = [
            'explain_panel' => $explain_panel,
            'fixed_title' => $fixed_title,
            'action_span' => $action_span
        ];

        $this->setLayoutBlock($blocks); // 设置block

        $shop_category_list = $this->shopCategory->getShopCategoryList(seller_shop_info()->shop_id);

        $goods_type_list = GoodsType::get();

        // 分类列表
        $cat_list = $this->category->getFormatCategory();

        $shop_freight_fee = !empty(shopconf('freight_fee',false,seller_shop_info()->shop_id)) ? shopconf('freight_fee',false,seller_shop_info()->shop_id) : '0.00'; // 店铺统一运费

        // 运费模板列表
        $freight_list = Freight::where('shop_id', seller_shop_info()->shop_id)
            ->orderBy('freight_id', 'desc')
            ->select(['freight_id','title'])
            ->get()->toArray();

        // 可抓取数据条数
        $allow_collected_num = 10;
        $used_collect_num = 5;
        $rest_collect_num = $allow_collected_num - $used_collect_num;
        $can_collect = $rest_collect_num > 0 ? 1 : 0;
        $collect_msg = "您已无可抓取数据条数，共抓取了<strong>{$allow_collected_num}</strong>条数据，用了<strong>{$used_collect_num}</strong>条数据，还有<strong>{$rest_collect_num}</strong>条数据!<br>请联系平台方购买采集条数！";

        if ($request->method() == 'POST') {
            // 开始采集
            $collectModel = $request->post('CollectModel');

//            dd($collectModel);
//            $ret = $this->yunCollectRep->doCollect($collectModel);
            $ret = $this->yunCollectRep->doCollectSzy($collectModel, 1);
            if ($ret === false) {
                flash('error', '采集失败');
                return redirect('/goods/collect/show');
            }

            $third_goods_id = $ret['data'];
            $platform_name = YunCollectRepository::COLLECT_PLATFORMS[YunCollectRepository::COLLECT_PLATFORM];

            return view('goods.collect.show_post', compact('title', 'third_goods_id', 'platform_name'));
        }

        return view('goods.collect.show', compact('title','shop_category_list','goods_type_list','cat_list','shop_freight_fee','freight_list', 'can_collect','collect_msg'));

    }

    /**
     * 立即采集
     * 将待采集的商品数据缓存到系统中
     * 缓存对象标识：wait_collect_goods
     *
     * @param Request $request
     * @return array|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function ajaxCollect(Request $request)
    {
        $id = $request->post('id'); // 商品id
        $num = $request->post('num'); // 采集数量

        if (!empty($id)) {

            $extra = [
//                'surplus_num' => 0,
//                'finish_num' => 1,
//                'speed' => '100%',
                'surplus_num' => 3,
                'finish_num' => 20,
                'speed' => '60%'
            ];
            return result(1, [], '', $extra);
        }

        $extra = [
            'num' => 1, // 采集商品总数量
            'surplus_num' => 0, // 剩余待下载
            'finish_num' => 1, // 已下载
            'speed' => '100%',
            'go' => '/goods/collect/list',
        ];
        return result(0, null, '抓取完成', $extra);
    }

    /**
     * 导入产品的商品列表
     *
     * @param Request $request
     * @return array|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     * @throws \Throwable
     */
    public function lists(Request $request)
    {
        $title = '导入产品的商品列表';
        $fixed_title = '云端产品库 - '.$title;

        $action_span = [];

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
//        $search_arr = ['brand_name'];
//        foreach ($search_arr as $v) {
//            if (isset($params[$v]) && !empty($params[$v])) {
//
//                if ($v == 'brand_name') {
//                    $where[] = [$v, 'like', "%{$params[$v]}%"];
//                } else {
//                    $where[] = [$v, $params[$v]];
//                }
//            }
//        }
        // 列表
        $condition = [
            'where' => $where,
            'sortname' => 'brand_id',
            'sortorder' => 'desc'
        ];
//        list($list, $total) = [[1], 1]; //$this->brand->getList($condition);
        $list = session('wait_collect_goods');
        $total = count($list);

        $pageHtml = pagination($total);

        $compact = compact('title', 'list', 'total', 'pageHtml');
        if ($request->ajax()) {
            $render = view('goods.collect.partials._list', $compact)->render();
            return result(0, $render);
        }
        return view('goods.collect.list', $compact);
    }

    /**
     * 开始导入商品
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function addGoods(Request $request)
    {
        $title = '导入商品';
        $fixed_title = '云端产品库 - '.$title;

        $action_span = [];

        $explain_panel = [
            '已导入的商品再次采集时会跳过采集，不会被重新导入'
        ];
        $blocks = [
            'explain_panel' => $explain_panel,
            'fixed_title' => $fixed_title,
            'action_span' => $action_span
        ];

        $this->setLayoutBlock($blocks); // 设置block

        $list = session('wait_collect_goods');
        $post_collect_goods = session('post_collect_goods');
        $total = count($list);
        $ids = json_encode(array_column($list,'third_goods_id'));
        $compact = compact('title', 'list','total','ids', 'post_collect_goods');

        return view('goods.collect.add_goods', $compact);
    }

    /**
     * 异步执行商品导入操作
     *
     * @param Request $request
     * @return array|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function ajaxAdd(Request $request)
    {
//        {"code":1,"data":null,"message":"成功","ids":[],"current_id":"577454871963","dotime":0.193}
//        {"code":2,"data":null,"message":"导入完成","go":"\/goods\/collect\/show"}
        /*
         * id: 577454871963
        cat_id: 617
        type_id: 2
        is_comment: 0
        do_time: 0
         */
        $id = $request->post('id'); // 淘宝商品id
        $cat_id = $request->post('cat_id'); // 存入商品分类id
        $type_id = $request->post('type_id'); // 存入商品类型
        $is_comment = $request->post('is_comment'); // 是否采集评论
        $do_time = $request->post('do_time');
        $ids_arr = !empty($id) ? explode(',', $id) : '';

        if (!empty($ids_arr)) {
            $start = microtime(true);
            Log::stack(['api'])->info('collect start:'.$start);

            // 开始采集详细数据 每采集成功一条数据 就将该id排除
            $current_id = $ids_arr[0];
//            $ret = $this->yunCollectRep->doCollectDetail($current_id);
            $ret = $this->yunCollectRep->doCollectSzyDetail($current_id, 1, seller_shop_info()->shop_id);

            $end = microtime(true);
            Log::stack(['api'])->info('collect end:'.$end);
            $doTime = abs(round(($end - $start), 3));
            Log::stack(['api'])->info('collect doTime:'.$doTime);

            unset($ids_arr[0]);
            $extra = [
                'ids' => implode(',',$ids_arr),
                'current_id' => $current_id, //'577454871963',
                'dotime' => $doTime // 计算执行时间
            ];

            if (!$ret) {
                return result(-1,null, '导入失败', $extra);
            }


            return result(1, null, '成功', $extra);
        }

        $extra = [
            'go' => '/goods/collect/show',
        ];
        return result(2, null, '导入完成', $extra);
    }
}