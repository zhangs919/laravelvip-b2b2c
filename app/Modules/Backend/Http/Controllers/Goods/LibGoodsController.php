<?php

namespace app\Modules\Backend\Http\Controllers\Goods;

use App\Modules\Base\Http\Controllers\Backend;
use App\Repositories\CategoryRepository;
use App\Repositories\ShopRepository;
use Illuminate\Http\Request;

class LibGoodsController extends Backend
{

    private $links = [];

    private $edit_links = [
        ['url' => 'goods/lib-goods/edit', 'text' => '编辑商品'],
        ['url' => 'goods/lib-goods/edit-images', 'text' => '编辑图片'],
    ];

    protected $category;

    protected $shop;

    public function __construct()
    {
        parent::__construct();

        $this->category = new CategoryRepository();
        $this->shop = new ShopRepository();
    }


    public function lists(Request $request)
    {
        $title = '所有商品';
        $fixed_title = '本地商品库 - '.$title;

        $action_span = [
            [
                'url' => '/goods/lib-goods/batch-upload',
                'icon' => 'fa-cloud-upload',
                'text' => '导入ecshop商品'
            ],
            [
                'url' => '/goods/lib-goods/import',
                'icon' => 'fa-plus',
                'text' => '导入店铺商品'
            ],
            [
                'id' => 'add-excel-goods',
                'url' => '',
                'icon' => 'fa-plus',
                'text' => '导入excel商品'
            ],
            [
                'url' => 'add',
                'icon' => 'fa-plus',
                'text' => '发布商品'
            ],
            [
                'url' => '/goods/yun/goods-list',
                'icon' => 'fa-plus',
                'text' => '数据采集'
            ]
        ];

        $explain_panel = [
            '本地商品库：为了解决商城不同商家售卖的商品相同，每个商家要单独发布商品问题，本地商品库应运而生，本地商品库发布的商品不在商城前台展示，仅用于供商家导入使用'
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
        $search_arr = ['goods_barcode','keyword', 'cat_id','goods_status'];
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
            'sortorder' => 'desc'
        ];
//        list($list, $total) = $this->brand->getList($condition);

//        $pageHtml = pagination($total);

        $compact = compact('title', 'list'/*, 'total', 'pageHtml'*/);
        if ($request->ajax()) {
            $render = view('goods.lib-goods.partials._list', $compact)->render();
            return result(0, $render);
        }
        return view('goods.lib-goods.list', $compact);
    }

    public function add(Request $request)
    {
        $title = '选择商品分类';
        $fixed_title = '本地商品库 - '.$title;

        $explain_panel = [];
        $blocks = [
            'fixed_title' => $fixed_title,
            'explain_panel' => $explain_panel
        ];
        $this->setLayoutBlock($blocks); // 设置block

        $condition = [
            'where' => [['parent_id', 0]],
            'sortname' => 'cat_id',
            'sortorder' => 'asc'
        ];
        list($cat_list, $total)= $this->category->getList($condition);
//        dd($cat_list);

        return view('goods.lib-goods.add', compact('title', 'cat_list'));
    }

    public function saveData(Request $request)
    {
        return result(0,'', '保存成功');
    }

    public function index(Request $request)
    {
        $title = '填写商品详情';
        $fixed_title = '本地商品库 - '.$title;

        $action_span = [
            [
                'url' => 'list',
                'icon' => 'fa-reply',
                'text' => '返回商品列表'
            ]
        ];

        $explain_panel = [];
        $blocks = [
            'fixed_title' => $fixed_title,
            'explain_panel' => $explain_panel,
            'action_span' => $action_span
        ];
        $this->setLayoutBlock($blocks); // 设置block


        return view('goods.lib-goods.index', compact('title'));
    }

    public function addImages(Request $request)
    {
        $title = '上传商品图片';
        $fixed_title = '本地商品库 - '.$title;

        $action_span = [
            [
                'url' => 'list',
                'icon' => 'fa-reply',
                'text' => '返回商品列表'
            ]
        ];
        $explain_panel = [];
        $blocks = [
            'fixed_title' => $fixed_title,
            'explain_panel' => $explain_panel,
            'action_span' => $action_span
        ];
        $this->setLayoutBlock($blocks); // 设置block

        return view('goods.lib-goods.add_images', compact('title'));
    }

    public function editImages(Request $request)
    {
        $title = '编辑';
        $fixed_title = '本地商品库 - '.$title;

        $id = $request->get('id');
        $extra = '?id='.$id;
        $this->sublink($this->edit_links, 'edit-images', '', $extra);

        $action_span = [
            [
                'url' => 'list',
                'icon' => 'fa-reply',
                'text' => '返回商品列表'
            ]
        ];
        $explain_panel = [];
        $blocks = [
            'fixed_title' => $fixed_title,
            'explain_panel' => $explain_panel,
            'action_span' => $action_span
        ];
        $this->setLayoutBlock($blocks); // 设置block

        return view('goods.lib-goods.edit_images', compact('title'));
    }

    public function saveImageData(Request $request)
    {

        return result(0, '', '保存成功');
    }

    public function success(Request $request)
    {
        $title = '上传商品图片';

        $explain_panel = [];
        $blocks = [
            'explain_panel' => $explain_panel,
        ];
        $this->setLayoutBlock($blocks); // 设置block

        return view('goods.lib-goods.success', compact('title'));
    }

    public function edit(Request $request)
    {
        $title = '编辑';
        $fixed_title = '本地商品库 - '.$title;

        $id = $request->get('id');
        $extra = '?id='.$id;
        $this->sublink($this->edit_links, 'edit', '', $extra);
        $action_span = [
            [
                'url' => 'list',
                'icon' => 'fa-reply',
                'text' => '返回商品列表'
            ]
        ];

        $explain_panel = [];
        $blocks = [
            'fixed_title' => $fixed_title,
            'explain_panel' => $explain_panel,
            'action_span' => $action_span
        ];
        $this->setLayoutBlock($blocks); // 设置block


        return view('goods.lib-goods.edit', compact('title'));
    }



    public function catList(Request $request)
    {
        $parent_id = $request->get('id', 0); // 父id
        $condition = [
            'where' => [['parent_id', $parent_id]],
            'sortname' => 'cat_id',
            'sortorder' => 'asc'
        ];
        list($cat_list, $total)= $this->category->getList($condition);
        $render = view('goods.lib-goods.partials._cat_list', compact('cat_list'))->render();
        return $render;
    }

    /**
     * 导入Excel商品
     *
     * @param Request $request
     * @return array
     * @throws \Throwable
     */
    public function addExcelGoods(Request $request)
    {
        $render = view('goods.lib-goods.add_excel_goods')->render();

        return result(0, $render);
    }

    /**
     * 下载上传商品文件模板
     *
     * @param Request $request
     */
    public function downloadAdd(Request $request)
    {

    }

    public function import(Request $request)
    {
        $title = '导入店铺商品';
        $fixed_title = '本地商品库 - '.$title;

        $action_span = [
            [
                'url' => 'list',
                'icon' => 'fa-reply',
                'text' => '返回商品列表'
            ]
        ];

        $explain_panel = [
            '为了丰富本地商品库商品数据，帮助新开店铺有更多的商品选择，系统推出了导入店铺商品数据功能',
            '导入店铺商品数据：将店铺内商品导入到本地商品库（店铺内从商品库导入的商品除外）；如果导入的店铺内商品的条形码与本地商品库商品条形码一致，则需要判断本地商品库商品是否有图片，如果本地商品库商品有图片，则无需覆盖，如果本地商品库商品没有图片，则店铺内商品将覆盖本地商品库商品；如果导入的店铺内商品的条形码未在本地商品库有对应的商品，则导入的店铺商品将新添加入本地商品库中',
            '导入店铺商品，是将店铺内所有具有商品图片的商品进行导入到本地商品库',
            '商品库商品分类将自动根据店铺内商品分类名称进行匹配，名称相同，商品库商品分类自动被选中',
        ];
        $blocks = [
            'fixed_title' => $fixed_title,
            'explain_panel' => $explain_panel,
            'action_span' => $action_span
        ];
        $this->setLayoutBlock($blocks); // 设置block

        // 获取店铺列表
        $where[] = ['shop_status', 1];
        $condition = [
            'where' => $where,
            'sortname' => 'shop_sort',
            'sortorder' => 'asc',
            'field' => ['shop_id', 'shop_name']
        ];
        list($shop_list, $total) = $this->shop->getList($condition);

        $import_type = $request->get('import_type'); // 导入模式 1全部导入 0单一导入
        $goods_id = $request->get('goods_id', 0); // 商品id  单一导入才有该参数

        if ($request->method() == 'POST') {
            $key = $request->post('key'); // key: build-lib-goods-import


            // 导入成功
            return result(0, null, '成功导入了1个商品');
        }

        return view('goods.lib-goods.import', compact('title', 'shop_list'));
    }

    public function batchUpload()
    {

    }
}