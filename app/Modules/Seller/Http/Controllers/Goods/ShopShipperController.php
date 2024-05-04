<?php

namespace App\Modules\Seller\Http\Controllers\Goods;

use App\Models\ShopShipper;
use App\Modules\Base\Http\Controllers\Seller;
use App\Repositories\ShopShipperRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ShopShipperController extends Seller
{

    private $links = [
        ['url' => 'goods/goods-set/index', 'text' => '基本设置'],
        ['url' => 'goods/goods-tag/list', 'text' => '商品标签'],
        ['url' => 'goods/goods-unit/list', 'text' => '商品单位'],
        ['url' => 'goods/layout/list', 'text' => '详情版式'],
        ['url' => 'goods/questions/list', 'text' => '常见问题'],
        ['url' => 'goods/shop-shipper/list', 'text' => '商品发货方'],
    ];


    protected $shopShipper;

    public function __construct(ShopShipperRepository $shopShipper)
    {
        parent::__construct();

        $this->shopShipper = $shopShipper;

        $this->set_menu_select('goods', 'goods-set');

    }

    public function lists(Request $request)
    {
        $title = '发货方列表';
        $fixed_title = '发货方管理 - ' . $title;

        $this->sublink($this->links, 'goods/shop-shipper/list');

        $action_span = [
            [
                'url' => 'add',
                'icon' => 'fa-plus',
                'text' => '添加发货方'
            ],
        ];

        $explain_panel = [
            '发货方信息用于在商品详情页显示商品发货方的信息，可通过菜单 商品 > 商品设置 > 基本设置 中进行开启或者关闭',
            '发货方信息最多允许添加20条'
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
        $search_arr = [];
        foreach ($search_arr as $v) {
            if (isset($params[$v]) && !empty($params[$v])) {

                if ($v == 'keyword') {
//                    $where[] = ['', 'like', "%{$params[$v]}%"];
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
        ];
        list($list, $total) = $this->shopShipper->getList($condition);

        $pageHtml = pagination($total);

        if ($request->ajax()) {
            $render = view('goods.shop-shipper.partials._list', compact('list', 'total', 'pageHtml'))->render();
            return result(0, $render);
        }


        return view('goods.shop-shipper.list', compact('title', 'list', 'pageHtml'));
    }

    public function add(Request $request)
    {
        $title = '添加发货方';

        $id = $request->get('id', 0);

        if ($id) {
            // 更新操作
            $info = $this->shopShipper->getById($id);
            view()->share('info', $info);
            $title = '编辑发货方';
        }

        $fixed_title = '商品发货方 - ' . $title;

        $action_span = [
            [
                'url' => 'list',
                'icon' => 'fa-reply',
                'text' => '返回列表'
            ],
        ];

        $explain_panel = [];
        $blocks = [
            'explain_panel' => $explain_panel,
            'fixed_title' => $fixed_title,
            'action_span' => $action_span
        ];

        $this->setLayoutBlock($blocks); // 设置block


        return view('goods.shop-shipper.add', compact('title'));
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
        $post = $request->post('ShopShipper');

        if (!empty($post['id'])) {
            // 编辑
            $ret = $this->shopShipper->update($post['id'], $post);
            $msg = '商品发货方编辑';
        } else {
            // 添加
            $post['shop_id'] = seller_shop_info()->shop_id;
            $ret = $this->shopShipper->store($post);
            $msg = '商品发货方添加';
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
        $ids = $request->post('ids');
        $ret = $this->shopShipper->batchDel(explode(',', $ids));
        if ($ret === false) {
            // Log
            return result(-1, '', '删除失败');
        }

        // Log
        return result(0, '', '删除成功');
    }

    /**
     * 批量删除
     * @param Request $request
     * @return mixed
     */
    public function batchDelete(Request $request)
    {
        $ids = $request->post('ids');
        $ret = $this->shopShipper->batchDel($ids);

        $ids = implode(',', $ids);
        if ($ret === false) {
            // Log
            shop_log('商品发货方批量删除失败。ID：'.$ids);
            return result(-1, '', '删除失败');
        }
        // Log
        shop_log('商品发货方批量删除成功。ID：'.$ids);
        return result(0, '', '删除成功');
    }

    /**
     * 异步加载 发货方列表
     *
     * @param Request $request
     * @return array|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function items(Request $request)
    {
        $list = ShopShipper::orderBy('sort', 'asc')->select(['id','name','image'])->get()->toArray();
        if (!empty($list)) {
            foreach ($list as &$item) {
                $item['clientRuleCache'] = 'cache';
            }
        }

        return result(0, $list);
    }

}