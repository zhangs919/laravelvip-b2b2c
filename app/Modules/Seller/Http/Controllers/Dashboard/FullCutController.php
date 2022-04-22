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
// | Date:2019-1-13
// | Description:满减/送
// +----------------------------------------------------------------------

namespace app\Modules\Seller\Http\Controllers\Dashboard;

use App\Models\Activity;
use App\Models\Bonus;
use App\Models\Goods;
use App\Modules\Base\Http\Controllers\Seller;
use App\Repositories\ActivityCategoryRepository;
use App\Repositories\ActivityRepository;
use App\Repositories\BrandRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\GoodsRepository;
use Illuminate\Http\Request;

/**
 * 满减/送管理
 *
 * Class FullCutController
 * @package app\Modules\Seller\Http\Controllers\Dashboard
 */
class FullCutController extends Seller
{

    private $links = [
        ['url' => 'dashboard/full-cut/list', 'text' => '列表'],
        ['url' => 'dashboard/full-cut/add', 'text' => '添加'],
        ['url' => 'dashboard/full-cut/edit', 'text' => '编辑'],
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
                'text' => '添加满减送'
            ],
        ];

        $explain_panel = [
            '满减/送是给商家提供的一个店铺营销工具，通过这个营销工具可以实现满金额送多种优惠，还可以设置多级/按件满减，让商家的店铺促销活动更加丰富',
            '在全部商品参与活动时，一次只能设置一个活动，如果有多级促销，可在设置时选择“多级优惠”即可',
            '在参与活动商品只有部分时，可以同时设置第二个活动，但第二个活动里面的商品不能包含第一个活动里的商品',
            '批发型商品不参与满减/送活动',
            '满减送活动赠送的积分，在消费者支付成功后即送出，消费者取消订单、或者卖家发货之后申请退款退货成功、或者卖家申请售后中的退款退货并且退款成功后，赠送的积分被退回。',
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
        list($list, $total) = $this->activity->getFullCutActivityList($where);

        $pageHtml = pagination($total);
        $page = frontend_pagination($total, true);

        if ($request->ajax()) {
            $render = view('dashboard.full-cut.partials._list', compact('list', 'total', 'pageHtml'))->render();
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
            'tpl_view' => 'dashboard.full-cut.list'
        ];
        $this->setData($data); // 设置数据
        return $this->displayData(); // 模板渲染及APP客户端返回数据
    }

    public function add(Request $request)
    {
        $title = '添加';

        $id = $request->get('id', 0);
        $this->sublink($this->links, 'add', '', '', 'edit');

        $model = [
            'sort' => 255
        ];
        $start_time = date('Y-m-d H:i:s', time());
        $end_time = date("Y-m-d H:i:s",strtotime("+7 day"));

        // 红包列表
        $bonus_list = Bonus::where('shop_id', seller_shop_info()->shop_id)
            ->select(['bonus_id','bonus_name'])->orderBy('bonus_id', 'asc')->get()->toArray();

        // 赠品活动列表
        // todo 赠品活动中如果其中有一个商品库存为0，则选择赠品中即不展示此赠品活动
        $where = [];
        $where[] = ['shop_id', seller_shop_info()->shop_id];
        $where[] = ['act_type', 13]; // 13-赠品活动
        $gift_list = Activity::where($where)
            ->select(['act_id','act_name'])->orderBy('act_id', 'asc')->get()->toArray();

        $discount = [];
        $use_range = 0;
        $use_range_goods = null;
        
        if ($id) {
            // 更新操作
            $model = $this->activity->getById($id, ['sort','act_id','act_name','act_title','act_img','start_time','end_time','purchase_num','shop_id','ext_info']);
            $model = $model->toArray();

            foreach ($model['ext_info']['discount'] as $cash=>$v) {
                $discount[$cash] = [
                    'cash' => $cash,
                    'reduce_cash' => $v['reduce_cash'] ?? null,
                    'freight_free' => $v['freight_free'] ?? null,
                    'point' => null, // todo
                    'bonus' => $v['bonus'] ?? null,
                    'gift' => $v['gift'] ?? null,
                ];
            }

            // 满减/送活动 商品列表
            $use_range_goods = Goods::where([['shop_id', seller_shop_info()->shop_id],['order_act_id', $id]])
                ->select(['goods_id','sku_id'])->get()->toArray();
            $use_range = $model['ext_info']['use_range'] ?? 0;
            $start_time = $model['start_time'];
            $end_time = $model['end_time'];
            $bonus_list = $model['ext_info']['bonus_list'] ?? null;
            $gift_list = $model['ext_info']['gift_list'] ?? null;

            $title = '编辑';
            $this->sublink($this->links, 'edit', '', '', 'add');
        }

        $fixed_title = '满减送 - '.$title;

        $action_span = [
            [
                'url' => 'list',
                'icon' => 'fa-reply',
                'text' => '返回满减送列表'
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
            $app_prefix_data['discount'] = $discount;
            $app_prefix_data['use_range_goods'] = $use_range_goods;
            $app_prefix_data['use_range'] = $use_range;
            $app_prefix_data['bonus_list'] = $bonus_list;
            $app_prefix_data['gift_list'] = $gift_list;
        } else {
            $app_prefix_data['start_time'] = $start_time;
            $app_prefix_data['end_time'] = $end_time;
            $app_prefix_data['bonus_list'] = $bonus_list;
            $app_prefix_data['gift_list'] = $gift_list;
        }

        $compact = compact('title', 'model', 'goods_list', 'start_time', 'end_time', 'discount','use_range_goods','use_range','bonus_list','gift_list');

        $webData = []; // web端（pc、mobile）数据对象
        $data = [
            'app_extra_data' => [],
            'app_prefix_data' => $app_prefix_data,
            'app_context_data' => $this->getAppContext(),
            'app_suffix_data' => [],
            'web_data' => $webData,
            'compact_data' => $compact,
            'tpl_view' => 'dashboard.full-cut.add'
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
        $postModel = $request->post('FullCutModel');

        $discount = [];
        $bonus_list = null;
        $gift_list = null;
//        dd($post);
        foreach ($post['cash'] as $k=>$v) {
            if (empty($post['check_item_'.($k+1)])) {
                return result(-1, '', '优惠方式不能为空！');
            }
            if (in_array(1, $post['check_item_'.($k+1)])) {
                // 如果减现金条件为选中状态 设置值
                $discount[$v]['reduce_cash'] = $post['reduce_cash'][$k];
            } else {
                unset($discount[$v]['reduce_cash']);
            }
            if (in_array(2, $post['check_item_'.($k+1)])) {
                // 如果包邮条件为选中状态 设置为1
                $discount[$v]['freight_free'] = 1;
            } else {
                unset($discount[$v]['freight_free']);
            }

            if (!empty($post['bonus'][$k])) {
                $discount[$v]['bonus'] = $post['bonus'][$k];
                $bonus_list[] = $post['bonus'][$k];
            }
            if (!empty($post['gift'][$k])) {
                $discount[$v]['gift'] = $post['gift'][$k];
                $gift_list[] = $post['gift'][$k];
            }
        }

        // 活动扩展数据
        $ext_info['discount'] = $discount;
        $ext_info['bonus_list'] = $bonus_list;
        $ext_info['gift_list'] = $gift_list;
        $ext_info['use_range_check'] = $post['use_range_check'];
        $ext_info['use_range'] = $postModel['use_range'];

        $postModel['ext_info'] = $ext_info;
        $postModel['act_type'] = 12; // 12-满减/送

        $activityData = $postModel;
        $goodsActivityData =[]; // todo
        $goodsData = [];
        if ($postModel['use_range'] == 1) {
            $goodsData = [
                'keyword' => $post['keyword'],
                'goods_skus' => $post['goods_skus'],
                'goods_id' => $post['goods_id'],
                'sku_id' => $post['sku_id'],
                'goods_name' => $post['goods_name'],
                'sku_name' => $post['sku_name'],
                'goods_number' => $post['goods_number'],
                'goods_price' => $post['goods_price'],
                'sku_open' => $post['sku_open'],
                'sku_image' => $post['sku_image'],
                'goods_image' => $post['goods_image'],
            ];
        }


//        dd($postModel);
        if (!empty($postModel['act_id'])) {
            // 编辑
            $ret = $this->activity->modifyActivity($activityData, $goodsActivityData, $goodsData);
            $msg = '满减送编辑';
            $act_id = $postModel['act_id'];
        }else {
            // 添加
            $activityData['shop_id'] = seller_shop_info()->shop_id;

            $ret = $this->activity->addActivity($activityData, $goodsActivityData, $goodsData);
            $msg = '满减送添加';
            $act_id = @$ret->act_id;
        }

        if ($ret === false) {
            // fail
            return result(-1, null, $msg.'失败');
        }
        // success
        shop_log($msg.'成功。ID：'.$act_id);
        return result(0, null, $msg.'成功');
    }

    /**
     * 异步加载红包、赠品列表
     *
     * @param Request $request
     * @return array
     */
    public function reloadList(Request $request)
    {
        $type = $request->get('type');

        $list = [0 => '--请选择--'];
        if ($type == 'bonus') { // 会员送红包 bonus_type=4
            $bonusList = Bonus::where('shop_id', seller_shop_info()->shop_id)->orderBy('bonus_id', 'asc')->get();
            if (!empty($bonusList)) {
                foreach ($bonusList as $item) {
                    $list[$item->bonus_id] = $item->bonus_name;
                }
            }
        } elseif ($type == 'gift') { // 赠品
            // todo 赠品活动中如果其中有一个商品库存为0，则选择赠品中即不展示此赠品活动
            $where[] = ['shop_id', seller_shop_info()->shop_id];
            $where[] = ['act_type', 13]; // 13-赠品活动
            $giftList = Activity::where($where)->select(['act_id','act_name'])->orderBy('act_id', 'asc')->get();
            if (!empty($giftList)) {
                foreach ($giftList as $item) {
                    $list[$item->act_id] = $item->act_name;
                }
            }
        }

        return result(0, $list, '', ['type'=>$type]);
    }

    /**
     * 删除
     * @param Request $request
     * @return mixed
     */
    public function delete(Request $request)
    {
        $id = $request->post('id');
        $ret = $this->activity->deleteActivity(0, [$id]);

        if ($ret === false) {
            // Log
            shop_log('满减/送删除失败。ID：'.$id);
            return result(-1, null, '删除失败');
        }

        // Log
        shop_log('满减/送删除成功。ID：'.$id);
        return result(0, null, '删除成功');
    }

    public function batchDelete(Request $request)
    {
        $ids = $request->post('ids');
        $ret = $this->activity->deleteActivity(0, $ids);

        $ids = implode(',', $ids);
        if ($ret === false) {
            // Log
            shop_log('满减/送删除失败。ID：'.$ids);
            return result(-1, '', '删除失败');
        }
        // Log
        shop_log('删除了多个满减/送。ID：'.$ids);
        return result(0, '', '删除成功');
    }

}