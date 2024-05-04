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
// | Date:2020-09-28
// | Description:直播
// +----------------------------------------------------------------------

namespace App\Modules\Seller\Http\Controllers\Dashboard;

use App\Models\Goods;
use App\Modules\Base\Http\Controllers\Seller;
use App\Repositories\ActivityCategoryRepository;
use App\Repositories\ActivityRepository;
use App\Repositories\BrandRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\GoodsRepository;
use App\Repositories\LiveAuthRepository;
use App\Repositories\LiveCategoryRepository;
use App\Repositories\LiveRepository;
use App\Repositories\ToolsRepository;
use App\Services\AlibabaCloudLiveService;
use App\Services\Enum\ActTypeEnum;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

/**
 * 直播管理
 *
 * Class LiveController
 * @package App\Modules\Seller\Http\Controllers\Dashboard
 */
class LiveController extends Seller
{

    private $links = [
        ['url' => 'dashboard/live/list', 'text' => '直播列表'],
        ['url' => 'dashboard/live/add', 'text' => '创建直播'],
        ['url' => 'dashboard/live/edit', 'text' => '编辑直播'],
        ['url' => 'dashboard/live/live-auth', 'text' => '直播店铺信息'],
    ];

    protected $activity;
    protected $tools;
    protected $goods;
    protected $category;
    protected $brand;

    protected $live;
    protected $liveCategory;
    protected $liveAuth;

    protected $aliLiveService;

    public function __construct(
        ActivityRepository $activity
        ,ToolsRepository $tools
        ,GoodsRepository $goods
        ,CategoryRepository $category
        ,BrandRepository $brand

        ,LiveRepository $live
        ,LiveCategoryRepository $liveCategory
        ,LiveAuthRepository $liveAuth
        ,AlibabaCloudLiveService $aliLiveService
    )
    {
        parent::__construct();

        $this->activity = $activity;
        $this->tools = $tools;
        $this->goods = $goods;
        $this->category = $category;
        $this->brand = $brand;

        $this->live = $live;
        $this->liveCategory = $liveCategory;

        $this->aliLiveService = $aliLiveService;

//        dd($this->aliLiveService->createStreamUrl(3, 1));
        // todo 直播店铺信息 后期建表存储（live_auth表）
        $this->liveAuth = $liveAuth;

        $this->set_menu_select('dashboard', 'dashboard-center');
    }

    public function lists(Request $request)
    {
        // 测试阿里云视频直播api
//        $aliService = new AlibabaCloudLiveService();
//        $r  = $aliService->describeLiveDomainDetail();
//        dd($r);
//        $r = $this->aliLiveService->createStreamUrl(2);
//        dd($r);
        $liveAuth = $this->liveAuth->getByField('shop_id', $this->shop_id);
        if (!empty($liveAuth->is_open)) {
            return $this->listOpen($request);
        } else {
            return $this->listClose($request);
        }
    }

    /**
     * 直播开启状态
     *
     * @param Request $request
     * @return mixed
     */
    public function listOpen(Request $request)
    {
        $title = '直播列表';
        $fixed_title = '营销中心 - '.$title;
        $this->sublink($this->links, 'list', '', '', 'add,edit');

        $action_span = [
            [
                'id' => '',
                'url' => '/dashboard/center/index',
                'icon' => 'fa-reply',
                'text' => '返回营销中心'
            ],
            [
                'id' => 'btn_promote',
                'url' => '',
                'icon' => 'fa-qrcode',
                'text' => '直播推广'
            ],
            [
                'id' => '',
                'url' => 'add',
                'icon' => 'fa-plus',
                'text' => '创建直播'
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
        $where[] = ['shop_id', seller_shop_info()->shop_id];
        // 搜索条件
        $search_arr = ['keyword','status','begin','end','cat_id'];
        foreach ($search_arr as $v) {
            if (isset($params[$v]) && !empty($params[$v])) {

                if ($v == 'keyword') {
                    $where[] = ['live_name', 'like', "%{$params[$v]}%"];
                } else {
                    $where[] = [$v, $params[$v]];
                }
            }
        }
        // 列表
        list($list, $total) = $this->live->getList($where);

        $pageHtml = pagination($total);
        $page = frontend_pagination($total, true);

        if ($request->ajax()) {
            $render = view('dashboard.live.partials._list', compact('list', 'total', 'pageHtml'))->render();
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
            'tpl_view' => 'dashboard.live.list_open'
        ];
        $this->setData($data); // 设置数据
        return $this->displayData(); // 模板渲染及APP客户端返回数据
    }

    /**
     * 直播关闭状态
     *
     * @param Request $request
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function listClose(Request $request)
    {
        $title = '关于直播';
        $fixed_title = '营销中心 - '.$title;

        $action_span = [

        ];

        $explain_panel = [];
        $blocks = [
            'explain_panel' => $explain_panel,
            'fixed_title' => $fixed_title,
            'action_span' => $action_span
        ];

        $this->setLayoutBlock($blocks); // 设置block

        // 获取数据

        $compact = compact('title');

        $webData = []; // web端（pc、mobile）数据对象
        $data = [
            'app_extra_data' => [],
            'app_prefix_data' => [],
            'app_context_data' => $this->getAppContext(),
            'app_suffix_data' => [],
            'web_data' => $webData,
            'compact_data' => $compact,
            'tpl_view' => 'dashboard.live.list_close'
        ];
        $this->setData($data); // 设置数据
        return $this->displayData(); // 模板渲染及APP客户端返回数据
    }

    public function add(Request $request)
    {
        $title = '创建直播';

        $id = $request->get('id', 0);
        $this->sublink($this->links, 'add', '', '', 'live-auth,edit');

        $model = [
            'sort' => 255,
            'region_code' => seller_shop_info()->region_code// 店铺所在地？
        ];
        $start_time = date('Y-m-d H:i:s', time());
        $end_time = date("Y-m-d H:i:s",strtotime("+7 day"));
        $goods_list = [];

        // 直播活动商品分类列表
        // 查询活动分类列表（树形）
        $where = [];
        $where[] = ['is_open',1];
        $condition = [
            'where' => $where,
            'limit' => 0, // 不分页
            'sortname' => 'created_at',
            'sortorder' => 'desc',
        ];
        list($cat_list, $category_total) = $this->liveCategory->getList($condition, '', false, true);

//        $cat_list = [];
//        if (!empty($category_data)) {
//            foreach ($category_data as $v) {
//                $cat_list[$v['cat_id']] = $v['title_show'];
//            }
//        }

        if ($id) {
            // 更新操作
            $model = $this->live->getById($id);
            $model = $model->toArray();

            $start_time = $model['start_time'];
            $end_time = $model['end_time'];

            // 直播活动商品列表
            $goods_list = $this->activity->getLiveGoodsActivityInfo($model['act_id']);



            $title = '编辑直播';
            $this->sublink($this->links, 'edit', '', '', 'add,live-auth');
        }

        $fixed_title = '直播活动 - '.$title;

        $action_span = [
            [
                'url' => 'list',
                'icon' => 'fa-reply',
                'text' => '返回直播列表'
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
        $app_prefix_data['model'] = $model;
        if ($id) {
            $app_prefix_data['goods_list'] = $goods_list;
            $app_prefix_data['cat_list'] = $cat_list;
        } else {
            $app_prefix_data['start_time'] = $start_time;
            $app_prefix_data['end_time'] = $end_time;
        }

        $compact = compact('title', 'model', 'start_time', 'end_time', 'goods_list', 'cat_list');

        $webData = []; // web端（pc、mobile）数据对象
        $data = [
            'app_extra_data' => [],
            'app_prefix_data' => $app_prefix_data,
            'app_context_data' => $this->getAppContext(),
            'app_suffix_data' => [],
            'web_data' => $webData,
            'compact_data' => $compact,
            'tpl_view' => 'dashboard.live.add'
        ];
        $this->setData($data); // 设置数据

        return $this->displayData(); // 模板渲染及APP客户端返回数据
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
        $post = $request->post();
        $postModel = $request->post('LiveModel');

        // 活动扩展数据
        $ext_info = null; // 直播活动没有活动扩展数据

//        $postModel['ext_info'] = $ext_info;
        $act_type = ActTypeEnum::ACT_TYPE_LIVE; // 14-直播活动

        // 活动数据
        $activityData = [
            'act_name' => $postModel['live_name'],
            'act_title' => $postModel['live_name'],
            'ext_info' => null,
            'act_type' => $act_type,
        ];

        if (empty($post['goods_spu'])) {
            return result(-1, '', '您还没有添加直播商品！');
        }
        // 活动商品数据
        $goodsActivityData =[];
        foreach ($post['goods_spu'] as $k=>$v) {
            $goodsActivityData[] = [
                'goods_id' => $v,
                'sku_id' => $post['goods_sku'][$k],
                'act_price' => $post['activity_price'][$k],
                'act_stock' => $post['activity_stock'][$k], // 活动库存 为0
            ];
        }

//        dd($postModel);
        if (!empty($postModel['id'])) {
            // 编辑
            $liveInfo = $this->live->getById($postModel['id']);
            if (empty($liveInfo)) {
                return result(-1,null,INVALID_PARAM);
            }
            $activityData['act_id'] = $liveInfo->act_id;
            $ret = $this->live->modifyData($postModel, $activityData, $goodsActivityData);
            $msg = '直播活动编辑';
            $id = $postModel['id'];
        }else {
            // 添加
            $activityData['shop_id'] = seller_shop_info()->shop_id;
            $postModel['shop_id'] = seller_shop_info()->shop_id;
            $ret = $this->live->addData($postModel, $activityData, $goodsActivityData);
            $msg = '直播活动添加';
            $id = @$ret->id;
        }

        if ($ret === false) {
            // fail
            return result(-1, null, $msg.'失败');
        }
        // success
        shop_log($msg.'成功。ID：'.$id);
        return result(0, null, $msg.'成功');
    }

    public function liveAuth(Request $request)
    {
        $title = '直播店铺信息';

        $this->sublink($this->links, 'live-auth', '', '', 'add,edit');
        $fixed_title = '直播活动 - '.$title;

        $action_span = [];

        $explain_panel = [];
        $blocks = [
            'explain_panel' => $explain_panel,
            'fixed_title' => $fixed_title,
            'action_span' => $action_span
        ];

        $this->setLayoutBlock($blocks); // 设置block

        // 获取数据
        $model = $this->liveAuth->getByField('shop_id', $this->shop_id)->toArray();

        $compact = compact('title', 'model');

        $webData = []; // web端（pc、mobile）数据对象
        $data = [
            'app_extra_data' => [],
            'app_prefix_data' => [
                'model' => $model,
            ],
            'app_context_data' => $this->getAppContext(),
            'app_suffix_data' => [],
            'web_data' => $webData,
            'compact_data' => $compact,
            'tpl_view' => 'dashboard.live.live_auth'
        ];
        $this->setData($data); // 设置数据
        return $this->displayData(); // 模板渲染及APP客户端返回数据
    }

    /**
     * 获取推流地址
     *
     * @param Request $request
     * @return array|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     * @throws \Throwable
     */
    public function getPushStream(Request $request)
    {

        if ($request->method() == 'POST') {
            // 重置推流地址
            $id = $request->post('id');
            $data = [
                'id' => $id,
                'push_stream' => $this->aliLiveService->createStreamUrl($id, 0)
                //"rtmp://livepush.xxxx.com/ysc/room60?auth_key=1581246921-0-0-9566a8d603e63b3fd9172ec42ee7ee45"
            ];
            // 更新推流地址
            $ret = $this->live->update($id, ['push_stream' => $data['push_stream']]);
            if ($ret === false) {
                return result(-1, null, OPERATE_FAIL);
            }

            return result(0,$data);
        }

        $id = $request->get('id');
        $liveInfo = $this->live->getById($id);
        if (empty($liveInfo)) {
            return result(-1, null, INVALID_PARAM);
        }

        $push_stream = $liveInfo->push_stream;
        $render = view('dashboard.live.get_push_stream', compact('push_stream'))->render();

        return result(0, $render);
    }


    /**
     * 删除
     * @param Request $request
     * @return mixed
     */
    public function delete(Request $request)
    {
        $id = $request->post('id');
        $ret = $this->live->del($id);

        if ($ret === false) {
            // Log
            shop_log('直播活动删除失败。ID：'.$id);
            return result(-1, null, '删除失败');
        }

        // Log
        shop_log('直播活动删除成功。ID：'.$id);
        return result(0, null, '删除成功');
    }

    public function batchDelete(Request $request)
    {
        $ids = $request->post('ids');
        $ids = !is_array($ids) ? [$ids] : $ids;
        $ret = $this->live->batchDel($ids);

        $ids = implode(',', $ids);
        if ($ret === false) {
            // Log
            shop_log('直播活动删除失败。ID：'.$ids);
            return result(-1, '', '删除失败');
        }
        // Log
        shop_log('删除了多个直播活动。ID：'.$ids);
        return result(0, '', '删除成功');
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
        $goods_info = Goods::where('goods_id',$goods_id)->first();
        if (empty($goods_info)) {
            return result(-1, null, '商品ID无效');
        }
        if ($goods_info->goods_number <= 0) {
            return result(-1, null, '该商品库存不足，不可选择！');
        }

        // 查询活动分类列表（树形）
        $where = [];
        $where[] = ['is_open',1];
        $condition = [
            'where' => $where,
            'limit' => 0, // 不分页
            'sortname' => 'created_at',
            'sortorder' => 'desc',
        ];
        list($category_data, $category_total) = $this->liveCategory->getList($condition, '', false, true);

        $category_list = [];
        if (!empty($category_data)) {
            foreach ($category_data as $v) {
                $category_list[$v['cat_id']] = $v['title_show'];
            }
        }

        $render = view('dashboard.live.goods_info', compact('goods_info', 'category_list'))->render();
        return result(0, $render, '');
    }

    /**
     * 上传活动图片
     *
     * @param Request $request
     * @return array
     */
//    public function uploadActImg(Request $request)
//    {
//        $act_id = $request->post('act_id');
//        $filename = $request->post('filename', 'name');
//        $storePath = 'activity/group_buy';
//        $uploadRes = $this->tools->uploadPic($request, $filename, $storePath);
//
//        if (isset($uploadRes['error'])) {
//            // 上传出错
//            return result(-1, '', $uploadRes['error']);
//        }
//
//        $ret = $this->activity->update($act_id, ['act_img' => $uploadRes['data']['path']]);
//        if ($ret === false) {
//            return result(-1, '', '上传失败！');
//        }
//
//        return result(0, $uploadRes['data'], '上传成功！', ['count' => $uploadRes['count']]);
//    }

    /**
     * 商品选择器
     *
     * @param Request $request
     * @return mixed
     * @throws \Throwable
     */
    public function picker(Request $request)
    {
        $page_id = make_uuid();
        $pagination_id = $request->post('page')['page_id'];
        $output = $request->post('output');
        $left = $request->post('left');
        $right = $request->post('right');
        $goods_status = $request->post('goods_status', 1); // 商品状态
        $is_sku = $request->post('is_sku', 0); //
        $is_supply = $request->post('is_supply', null); //
        $show_store = $request->post('show_store', 0); //
        $is_enable = $request->post('is_enable', 1); //
        $goods_audit = $request->post('goods_audit', 1); //
        $goods_ids = $request->post('goods_ids');
        $goods_ids = $goods_ids ? explode(',', $goods_ids) : [];
        $sku_ids = $request->post('sku_ids');
        $sku_ids = $sku_ids ? explode(',', $sku_ids) : [];

        // 商品列表
        $where[] = ['shop_id', seller_shop_info()->shop_id];
        $where[] = ['goods_status', $goods_status];
//        $where[] = ['is_sku', $is_sku];
//        $where[] = ['show_store', $show_store];
//        $where[] = ['is_enable', $is_enable];
        $where[] = ['goods_audit', $goods_audit];

        $whereIn = [];

        $tpl = 'picker';



        $condition = [
            'where' => $where,
            'in' => $whereIn,
            'sortname' => 'goods_id',
            'sortorder' => 'desc'
        ];
        list($list, $total) = $this->goods->getList($condition);
        $pageHtml = short_pagination($total, 5);

        // 查询商品分类列表（树形）
        $where = [];
        $where[] = ['is_show',1];
        $condition = [
            'where' => $where,
            'limit' => 0, // 不分页
            'sortname' => 'created_at',
            'sortorder' => 'asc',
        ];
        list($category_list, $category_total) = $this->category->getList($condition, '', false, true);

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
            'sku_ids', 'goods_ids', 'category_list',
            'brand_list');
        $render = view('dashboard.live.'.$tpl, $compact)->render();
        return result(0, $render);
    }

    public function editLiveInfo(Request $request)
    {
        $ret = $this->live->editInfo($request);
        if ($ret === false) {
            return result(-1, null);
        }
        return result(0, null);
    }

    public function qrcode(Request $request)
    {
        $id = $request->get('id');
        $url = route('live.show', ['id'=>$id]);
        $qrCode = QrCode::errorCorrection('L')
            ->format('png')
            ->size(180)
//            ->merge('/public/qrcodes/water.png',.15) // 合并水印图片到二维码
            ->margin(0)
//            ->color(255,0,255)
//            ->backgroundColor(125,245,0)
            ->encoding('UTF-8')
            ->generate($url);
        return response()->make($qrCode, 200, ['Content-Type' => 'image/png']);
    }

    /**
     * 下载二维码
     * todo 还有问题 不能下载
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function downloadQcode(Request $request)
    {

    }

    /**
     * 设置直播状态 开始直播/关闭直播
     *
     * @param Request $request
     * @return array|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function changeStatus(Request $request)
    {
        $id = $request->get('id');
        $ret = $this->live->changeLiveStatus($id);
        if ($ret === false) {
            return result(-1, null, OPERATE_FAIL);
        }
        return result(0, $ret, 1);
    }
}
