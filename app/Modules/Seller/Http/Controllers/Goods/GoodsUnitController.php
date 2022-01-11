<?php

namespace App\Modules\Seller\Http\Controllers\Goods;

use App\Modules\Base\Http\Controllers\Seller;
use App\Repositories\AttributeRepository;
use App\Repositories\GoodsUnitRepository;
use Illuminate\Http\Request;

class GoodsUnitController extends Seller
{

    private $links = [
        ['url' => 'goods/goods-set/index', 'text' => '基本设置'],
        ['url' => 'goods/goods-tag/list', 'text' => '商品标签'],
        ['url' => 'goods/goods-unit/list', 'text' => '商品单位'],
        ['url' => 'goods/layout/list', 'text' => '详情版式'],
        ['url' => 'goods/questions/list', 'text' => '常见问题'],
    ];

    protected $goodsUnit;


    public function __construct()
    {
        parent::__construct();

        $this->goodsUnit = new GoodsUnitRepository();

        $this->set_menu_select('goods', 'goods-set');

    }

    public function lists(Request $request)
    {
        $title = '商品单位';
        $fixed_title = '商品设置 - '.$title;

        $this->sublink($this->links, 'goods/goods-unit/list');

        $action_span = [
            [
                'url' => '',
                'id' => 'btn-add',
                'icon' => 'fa-plus',
                'text' => '添加商品单位'
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
        $search_arr = ['unit_name'];
        foreach ($search_arr as $v) {
            if (isset($params[$v]) && !empty($params[$v])) {

                if ($v == 'unit_name') {
                    $where[] = [$v, 'like', "%{$params[$v]}%"];
                } else {
                    $where[] = [$v, $params[$v]];
                }
            }
        }
        // 列表
        $condition = [
            'where' => $where,
            'sortname' => 'unit_id',
            'sortorder' => 'desc',
        ];
        list($list, $total) = $this->goodsUnit->getList($condition);

        $pageHtml = pagination($total);
//        dd($list);
        if ($request->ajax()) {
            $render = view('goods.goods-unit.partials._list', compact('list', 'total', 'pageHtml'))->render();
            return result(0, $render);
        }
        return view('goods.goods-unit.list', compact('title', 'list', 'pageHtml'));
    }

    public function add(Request $request)
    {
        $id = $request->get('id');
        if ($id) {
            $info = $this->goodsUnit->getById($id);
            view()->share('info', $info);
        }
        $uuid = make_uuid();

        $render = view('goods.goods-unit.add', compact('uuid'))->render();

        return result(0, $render);
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
        $post = $request->post('GoodsUnit');

        if (!empty($post['unit_id'])) {
            // 编辑
            $ret = $this->goodsUnit->update((int)$post['unit_id'], $post);
            $msg = '编辑';
        }else {
            // 添加
            $msg = '添加';
            $ret = $this->goodsUnit->store($post);
        }

        if ($ret === false) {
            // fail
            return result(-1, '', $msg.'失败');
        }

        // Log
        // success
        return result(0, '', $msg.'成功');
    }

    /**
     * 名称验证是否重复
     *
     * @param Request $request
     * @return mixed
     */
    public function clientValidate(Request $request)
    {
        $result = $this->goodsUnit->clientValidate($request, 'GoodsUnit');
        if (!$result['code']) {
            return result(-1, '', $result['message']);
        }
        return result(0);
    }

    /**
     * 删除
     * @param Request $request
     * @return mixed
     */
    public function delete(Request $request)
    {
        $id = $request->post('id');
        $ret = $this->goodsUnit->batchDel($id);
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
        $ret = $this->goodsUnit->batchDel(explode(',', $ids));

        if ($ret === false) {
            // Log
//            admin_log('商品属性批量删除失败。ID：'.$ids);
            return result(-1, '', '删除失败');
        }
        // Log
//        admin_log('商品属性批量删除成功。ID：'.$ids);
        return result(0, '', '删除成功');
    }
}