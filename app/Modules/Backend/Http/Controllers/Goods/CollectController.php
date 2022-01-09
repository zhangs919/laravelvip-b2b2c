<?php

namespace app\Modules\Backend\Http\Controllers\Goods;

use App\Modules\Base\Http\Controllers\Backend;
use App\Repositories\CollectRepository;
use Illuminate\Http\Request;

class CollectController extends Backend
{

    private $links = [
        ['url' => 'goods/yun/goods-list', 'text' => '云产品库采集'],
        ['url' => 'goods/collect/show', 'text' => '批量采集'],
    ];

    protected $collectRep; // 云采集

    public function __construct()
    {
        parent::__construct();

        $this->collectRep = new CollectRepository();
    }

    /**
     * 批量采集
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Request $request)
    {
        $title = '批量采集';
        $fixed_title = '云端产品库 - '.$title;
        $this->sublink($this->links, 'show');

        $action_span = [
            [
                'id' => 'shopcollectinfo',
                'url' => '',
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

        if ($request->method() == 'POST') {
            // 开始采集
            $collectModel = $request->post('CollectModel');

//            $ret = $this->collectRep->doCollect($collectModel);

           return view('goods.collect.show_post', compact('title'));
        }

        return view('goods.collect.show', compact('title'));
    }

    /*
     * "code":0,
    "data":null,
    "message":"抓取完成",
    "num":"1",
    "surplus_num":0,
    "finish_num":"1",
    "speed":"100%",
    "go":"/goods/collect/list"
     */
    public function ajaxCollect(Request $request)
    {
        $id = $request->post('id'); // 商品id
        $num = $request->post('num'); // 采集数量

        if (!empty($id)) {

            $extra = [
                'surplus_num' => 0,
                'finish_num' => 1,
                'speed' => '100%'
            ];
            return result(1, [], '', $extra);
        }

        $extra = [
            'num' => 1,
            'surplus_num' => 0,
            'finish_num' => 1,
            'speed' => '100%',
            'go' => '/goods/collect/list',
        ];
        return result(0, null, '抓取完成', $extra);
    }

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
        list($list, $total) = [[1], 1]; //$this->brand->getList($condition);

        $pageHtml = pagination($total);

        $compact = compact('title', 'list', 'total', 'pageHtml');
        if ($request->ajax()) {
            $render = view('goods.collect.partials._list', $compact)->render();
            return result(0, $render);
        }
        return view('goods.collect.list', $compact);
    }

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

        $compact = compact('title');

        return view('goods.collect.add_goods', $compact);
    }

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
        $typ_id = $request->post('type_id'); // 存入商品类型
        $is_comment = $request->post('is_comment'); // 是否采集评论
        $do_time = $request->post('do_time');

        if (!empty($id)) {

            $extra = [
                'ids' => [],
                'current_id' => '577454871963',
                'dotime' => 0.193
            ];
            return result(1, null, '成功', $extra);
        }

        $extra = [
            'go' => '/goods/collect/show',
        ];
        return result(2, null, '导入完成', $extra);
    }

}