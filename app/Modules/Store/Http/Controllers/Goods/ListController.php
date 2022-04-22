<?php

namespace App\Modules\Store\Http\Controllers\Goods;

use App\Modules\Base\Http\Controllers\Store;
use Illuminate\Http\Request;

class ListController extends Store
{

    private $links = [
        ['url' => 'goods/list/list', 'text' => '网点商品列表'],
//        ['url' => 'goods/list/list2', 'text' => '网点商品列表'],
    ];

    protected $goods;

    public function __construct()
    {
        parent::__construct();
    }

    public function lists(Request $request)
    {
        $title = '网点商品列表';
        $fixed_title = '网点管理 - '.$title;
        $this->sublink($this->links, 'list');
        $action_span = [
            [
                'id' => 'add_goods',
                'url' => '',
                'icon' => 'fa-plus-circle',
                'text' => '关联商品'
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
//        $where[] = ['shop_id', seller_shop_info()->shop_id];

        // 搜索条件
        $search_arr = [];
//        foreach ($search_arr as $v) {
//            if (isset($params[$v]) && !empty($params[$v])) {
//
//                if ($v == 'role_name') {
//                    $where[] = [$v, 'like', "%{$params[$v]}%"];
//                } else {
//                    $where[] = [$v, $params[$v]];
//                }
//            }
//        }
        // 列表
        $condition = [
            'where' => $where,
            'sortname' => 'goods_id',
            'sortorder' => 'desc'
        ];
        list($list, $total) = [[], 1000]; //$this->goods->getList($condition);
        $pageHtml = pagination($total);

        $compact = compact('title', 'list', 'total', 'pageHtml');
        if ($request->ajax()) {
            $render = view('goods.list.partials._list', $compact)->render();
            return result(0, $render);
        }
        return view('goods.list.list', $compact);
    }
}