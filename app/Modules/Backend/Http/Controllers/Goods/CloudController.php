<?php

namespace app\Modules\Backend\Http\Controllers\Goods;

use App\Modules\Base\Http\Controllers\Backend;
use Illuminate\Http\Request;

class CloudController extends Backend
{

    private $links = [

    ];


    public function __construct()
    {
        parent::__construct();

    }

    public function lists(Request $request)
    {
        $title = '功能列表';
        $fixed_title = '云端产品库 - '.$title;

        return view('goods.cloud.list', compact('title', 'fixed_title'));
    }

    public function brandImport(Request $request)
    {
        $title = '品牌导入';
        $fixed_title = '云端产品库 - '.$title;

        $action_span = [
            [
                'url' => 'list',
                'icon' => 'fa-reply',
                'text' => '返回产品库列表'
            ],
        ];

        $explain_panel = [
            '页面展示的是云产品库为商城提供丰富的商品品牌，供其选择导入',
            '品牌库中的相同品牌可以多次添加到我的品牌中，但导入成功后，相同品牌只导入一次；如果导入到我的品牌中的品牌修改了名称，下次再导入，是不进行导入的，因为从品牌库中导入到我的品牌中的品牌是建立关联关系的！'
        ];
        $blocks = [
            'explain_panel' => $explain_panel,
            'fixed_title' => $fixed_title,
            'action_span' => $action_span
        ];

        $this->setLayoutBlock($blocks); // 设置block

        $params = $request->all();
        $where = [];
        // 搜索条件
        $search_arr = ['keywords'];
        foreach ($search_arr as $v) {
            if (isset($params[$v]) && !empty($params[$v])) {

                if ($v == 'brand_name') {
                    $where[] = [$v, 'like', "%{$params[$v]}%"];
                } else {
                    $where[] = [$v, $params[$v]];
                }
            }
        }
        // 列表
        $condition = [
            'where' => $where,
            'sortname' => 'brand_id',
            'sortorder' => 'desc'
        ];
//        list($list, $total) = $this->cloudBrand->getList($condition);
        list($list, $total) = [[], 0];
//        $pageHtml = pagination($total);

        $compact = compact('title', 'list', 'total');
        if ($request->ajax()) {
            $render = view('goods.cloud.partials._brand_list', $compact)->render();
            return result(0, $render);
        }

        return view('goods.cloud.brand_list', $compact);
    }

    public function brandImportAjax(Request $request)
    {
        // 导入时，每50条数据分批次执行导入
        // num 表示 导入执行到了第几页 0，1，2，3，...
        $importData = json_decode($request->post('data')); //
        $num = $request->post('num');
        dd($importData);
    }


    public function categoryImport(Request $request)
    {
        $title = '分类导入';
        $fixed_title = '云端产品库 - '.$title;

        $action_span = [
            [
                'url' => 'list',
                'icon' => 'fa-reply',
                'text' => '返回产品库列表'
            ],
            [
                'url' => '/goods/category/list',
                'icon' => 'fa-reply',
                'text' => '返回分类管理列表'
            ],
        ];

        $explain_panel = [
            '左侧分类库展示的是云产品库为商城提供丰富的商品分类，供其选择导入；右侧我的分类展示的是商城的商品分类',
            '操作步骤：选择分类库中的一个或多个分类->选择我的分类中的某个一级或二级分类（单选按钮要选中）->点击操作处的按钮，此时我的分类中即展示导入的分类库中的分类->点击确定导入按钮，即导入完成',
            '我的分类中如果没有分类被选择，则分类库中的分类将直接作为一级分类导入到我的分类中；如果我的分类中选择了某一级，则将会把分类库中的分类导入到这一级下变为其子分类，导入到我的分类中，注意：我的分类中不允许选择三级分类，鼠标经过分类名称处，将出现删除图标，此时即可删除导入的分类',
            '左侧分类库中的数据导入到我的分类中，分类库中的层级关系将不存在'
        ];
        $blocks = [
            'explain_panel' => $explain_panel,
            'fixed_title' => $fixed_title,
            'action_span' => $action_span
        ];

        $this->setLayoutBlock($blocks); // 设置block


        list($list, $total) = [[], 0];

        $compact = compact('title', 'list', 'total');

        return view('goods.cloud.category_list', $compact);
    }


    public function categoryImportAjax(Request $request)
    {

        $importData = json_decode($request->post('data')); //
        dd($importData);
    }
}