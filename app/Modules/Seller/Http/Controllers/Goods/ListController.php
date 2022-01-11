<?php

// +----------------------------------------------------------------------
// | Laravelvip 乐融沃B2B2C商城系统
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
// | Date:2018-07-26
// +----------------------------------------------------------------------

namespace App\Modules\Seller\Http\Controllers\Goods;

use App\Models\GoodsSku;
use App\Modules\Base\Http\Controllers\Seller;
use App\Repositories\GoodsRepository;
use Illuminate\Http\Request;


class ListController extends Seller
{

    protected $goods;


    public function __construct()
    {
        parent::__construct();

        $this->goods = new GoodsRepository();
    }

    public function index(Request $request)
    {
        $title = '列表';
        $fixed_title = '商品管理 - 列表';

        $action_span = [
            [
                'url' => '/goods/list/batch-edit',
                'icon' => 'fa-cloud-upload',
                'text' => '批量更新商品价格、库存'
            ],
            [
                'url' => '/goods/list/batch-add',
                'icon' => 'fa-cloud-upload',
                'text' => '批量上传商品'
            ],
            [
                'url' => 'goods/list/upload-set-sku-member',
                'icon' => 'fa-cloud-upload',
                'text' => '批量自定义会员价'
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
        $where[] = ['shop_id', session('shop_info')->shop_id];
        $where[] = ['is_delete', 0]; // 查询删除状态为0的商品
        // 搜索条件
        $search_arr = ['goods_barcode', 'keyword', 'cat_id'];
        foreach ($search_arr as $v) {
            if (isset($params[$v]) && !empty($params[$v])) {

                if ($v == 'goods_barcode') {
                    $where[] = [$v, 'like', "%{$params[$v]}%"];
                } else {
                    $where[] = [$v, $params[$v]];
                }
            }
        }
        // 列表
        $condition = [
            'where' => $where,
            'sortname' => 'goods_id',
            'sortorder' => 'desc',
        ];
        list($list, $total) = $this->goods->getList($condition);

        if (!empty($list)) {
            foreach ($list as $item) {
                $isSku = GoodsSku::where('goods_id',$item->goods_id)->count() > 1 ? true : false;
                $item->is_sku = $isSku;
                $item->goods_remark = unserialize($item->goods_remark);
            }
        }

        $pageHtml = pagination($total);
        if ($request->ajax()) {
            $render = view('goods.list.partials._list', compact('list', 'total', 'pageHtml'))->render();
            return result(0, $render);
        }


        // 获取数据
        $cat_list = [];
        $goods_audit['items'] = [
            ""=>'全部',
            '待审核',
            '审核通过',
            '审核未通过',
        ];
        $sales_model['items'] = [
            ""=>'全部',
            '零售',
            '批发',
        ];
        $goods_status['items'] = [
            ""=>'全部',
            '已下架',
            '出售中',
            '违规下架',
        ];
        $pricing_mode['items'] = [
            ""=>'全部',
            '计件',
            '计重',
        ];
        $status['items'] = [
            ""=>'全部',
            1=>'已下架',
            2=>'出售中',
            3=>'待审核',
            4=>'审核未通过',
            5=>'违规下架',
        ];
        $store_list = []; // 隶属网点
        $page = frontend_pagination($total, true);
//        $list = [];
        $searchModel = null;
        $action = 'index';
        $on_sale_count = 0;
        $off_sale_count = 0;
        $audit_sale_count = 0;
        $scid = 0;
        $brand_list = [];
        $goods_mix_ids = null;

        $compact = compact('cat_list','goods_audit','sales_model','goods_status','pricing_mode',
            'status','store_list','pageHtml','list','searchModel','action','on_sale_count','off_sale_count',
            'audit_sale_count','scid','brand_list','goods_mix_ids');

        $webData = []; // web端（pc、mobile）数据对象
        $data = [
            'app_extra_data' => [],
            'app_prefix_data' => [
                'cat_list' => $cat_list,
                'goods_audit' => $goods_audit,
                'sales_model' => $sales_model,
                'goods_status' => $goods_status,
                'pricing_mode' => $pricing_mode,
                'status' => $status,
                'store_list' => $store_list,
                'page' => $page,
                'list' => $list,
                'searchModel' => $searchModel,
                'action' => $action,
                'on_sale_count' => $on_sale_count,
                'off_sale_count' => $off_sale_count,
                'audit_sale_count' => $audit_sale_count,
                'scid' => $scid,
                'brand_list' => $brand_list,
                'goods_mix_ids' => $goods_mix_ids
            ],
            'app_context_data' => $this->getAppContext(),
            'app_suffix_data' => [],
            'web_data' => $webData,
            'compact_data' => $compact,
            'tpl_view' => 'goods.list.index'
        ];
        $this->setData($data); // 设置数据
        return $this->displayData(); // 模板渲染及APP客户端返回数据
    }



    public function skuList(Request $request)
    {
        $goods_id = $request->get('goods_id', 0);

        $sku_list = $this->goods->getSkuList($goods_id);
        $compact = compact('sku_list', 'goods_id');
        $render = view('goods.list.partials._sku_list', $compact)->render();

        return result(0, $render);
    }

    public function skuMember(Request $request)
    {
        $goods_id = $request->get('goods_id', 0);
        $uuid = make_uuid();

        $skuList = $this->goods->getSkuList($goods_id);

        $compact = compact('skuList', 'goods_id', 'uuid');

        if ($request->method() == 'POST') {

//            dd($request->post());
            return result(0, null, '该功能开发中！');
//            return result(0, null, '操作成功');
        }
        $render = view('goods.list.partials._sku_member', $compact)->render();
        return result(0, $render);
    }

    public function editGoodsInfo(Request $request)
    {
        $ret = $this->goods->editInfo($request);
        if ($ret === false) {
            return result(-1, null);
        }
        return result(0, null);
    }

    public function editGoodsSkuInfo(Request $request)
    {
        $ret = $this->goods->editGoodsSkuInfo($request);
        if ($ret === false) {
            return result(-1, null);
        }
        return result(0, null);
    }

    /**
     * 添加商品备注信息
     *
     * @param Request $request
     * @return array
     * @throws \Throwable
     */
    public function remark(Request $request)
    {
        $id = $request->get('id'); // 商品id
        $goods_info = $this->goods->getById($id);
        $goods_remark = !empty($goods_info->goods_remark) ? unserialize($goods_info->goods_remark) : [];

        $render = view('goods.list.remark', compact('id', 'goods_remark'))->render();

        if ($request->method() == 'POST') {
            $insert = [
                'goods_id' => $request->post('id'),
                'admin_id' => auth('seller')->id(),
                'admin_name' => auth('seller')->user()->user_name,
                'content' => $request->post('remark'),
                'created_at' => format_time(time())
            ];
            $newGoodsRemarkInsert = array_merge([$insert], $goods_remark); // 将新的备注信息与原来的合并
            $newGoodsRemarkInsert = serialize($newGoodsRemarkInsert);
            $ret = $this->goods->update($id, ['goods_remark'=>$newGoodsRemarkInsert]);

            if ($ret === false) {
                return result(-1, null, '商品备注设置失败！');
            }
            return result(0, null, '商品备注设置成功！');
        }

        return result(0, $render);
    }

    public function trash(Request $request)
    {
        $title = '列表';
        $fixed_title = '回收站 - 列表';

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
        $where[] = ['shop_id', session('shop_info')->shop_id];
        $where[] = ['is_delete', 1]; // 查询删除状态为1的商品
        // 搜索条件
        $search_arr = ['goods_barcode', 'keyword', 'cat_id'];
        foreach ($search_arr as $v) {
            if (isset($params[$v]) && !empty($params[$v])) {

                if ($v == 'goods_barcode') {
                    $where[] = [$v, 'like', "%{$params[$v]}%"];
                } else {
                    $where[] = [$v, $params[$v]];
                }
            }
        }
        // 列表
        $condition = [
            'where' => $where,
            'sortname' => 'goods_id',
            'sortorder' => 'desc',
        ];
        list($list, $total) = $this->goods->getList($condition);

        $pageHtml = pagination($total);
//        dd($list);
        if ($request->ajax()) {
            $render = view('goods.list.partials._trash_list', compact('list', 'total', 'pageHtml'))->render();
            return result(0, $render);
        }

        return view('goods.list.trash', compact('title', 'list', 'pageHtml'));
    }
}