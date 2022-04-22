<?php

namespace App\Modules\Seller\Http\Controllers\Goods;

use App\Modules\Base\Http\Controllers\Seller;
use App\Repositories\ShopCategoryRepository;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class CategoryController extends Seller
{

    protected $shopCategory;


    public function __construct()
    {
        parent::__construct();

        $this->shopCategory = new ShopCategoryRepository();

        $this->set_menu_select('goods', 'goods-category-list');

    }

    public function lists(Request $request)
    {
        $title = '列表';
        $fixed_title = '店铺商品分类 - 列表';

        $action_span = [
            [
                'url' => 'import',
                'icon' => 'fa-cloud-upload',
                'text' => '导入商品分类'
            ],
            [
                'url' => 'add',
                'icon' => 'fa-plus',
                'text' => '添加商品分类'
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
        $search_arr = ['cat_name'];
        foreach ($search_arr as $v) {
            if (isset($params[$v]) && !empty($params[$v])) {

                if ($v == 'cat_name') {
                    $where[] = [$v, 'like', "%{$params[$v]}%"];
                } else {
                    $where[] = [$v, $params[$v]];
                }
            }
        }
        // 列表
        $condition = [
            'where' => $where,
            'sortname' => 'cat_id',
            'sortorder' => 'asc',
        ];
        list($list, $total) = $this->shopCategory->getList($condition, '', true);

        $pageHtml = pagination($total, false);
//        dd($list);
        if ($request->ajax()) {
            $render = view('goods.category.partials._list', compact('list', 'total', 'pageHtml'))->render();
            return result(0, $render);
        }
//dd($list);
        return view('goods.category.list', compact('title', 'list', 'pageHtml'));
    }

    public function add(Request $request)
    {
        $title = '添加';

        $id = $request->get('id', 0);
        $parent_id = $request->get('parent_id', 0);

        if ($id) {
            // 更新操作
            $info = $this->shopCategory->getById($id);
            $parent_id = $info->parent_id;
            view()->share('info', $info);
            $title = '编辑';
//            dd($info);
        }

        // 一级分类列表
        $where = [];
        $where[] = ['shop_id', seller_shop_info()->shop_id];
        $where[] = ['parent_id', 0]; // 只获取一级分类
        $condition = [
            'where' => $where,
            'sortname' => 'cat_id',
            'sortorder' => 'asc',
            'limit' => 0
        ];
        list($cat_list, $total) = $this->shopCategory->getList($condition);

        $fixed_title = '店铺商品分类 - '.$title;

        $action_span = [
            [
                'url' => 'list',
                'icon' => 'fa-reply',
                'text' => '返回商品分类列表'
            ],
        ];

        $explain_panel = [];
        $blocks = [
            'explain_panel' => $explain_panel,
            'fixed_title' => $fixed_title,
            'action_span' => $action_span
        ];

        $this->setLayoutBlock($blocks); // 设置block

        return view('goods.category.add', compact('title', 'info', 'parent_id', 'cat_list'));
    }

    public function edit(Request $request)
    {
        return $this->add($request);
    }

    public function saveData(Request $request)
    {
        $post = $request->post('ShopCategory');

        if (!empty($post['cat_id'])) {
            // 编辑
            $ret = $this->shopCategory->update($post['cat_id'], $post);
            $msg = '店铺商品分类编辑';
        }else {
            // 添加
            $post['shop_id'] = seller_shop_info()->shop_id;
            $ret = $this->shopCategory->store($post);
            $msg = '店铺商品分类添加';
        }

        if ($ret === false) {
            // fail
            return result(-1, null, $msg.'失败');
        }
        // success
        return result(0, null, $msg.'成功');
    }

    public function setIsShow(Request $request)
    {
        $id = $request->get('id');
        $ret = $this->shopCategory->changeState($id, 'is_show');
        if ($ret === false) {
            return result(-1, '', '设置失败');
        }
        return result(0, $ret, '设置成功');
    }

    public function editCatInfo(Request $request)
    {
        $ret = $this->shopCategory->editSort($request);
        if ($ret === false) {
            return result(-1, '', '设置失败');
        }
        return result(0, '', '设置成功');
    }

    public function delete(Request $request)
    {
        $id = $request->post('id');
        $ret = $this->shopCategory->del($id);
        if ($ret === false) {
            // Log
            return result(-1, '', '删除失败');
        }

        // Log
        return result(0, '', '删除成功');
    }

    /**
     * 商品分类选择器
     *
     * @param Request $request
     * @return mixed
     * @throws \Throwable
     */
    public function picker(Request $request)
    {
        $page_id = make_uuid();
        $id = $request->get('id', 0); // 商品分类id
        $cat_type = $request->get('cat_type'); // 默认传入的是2

//        $is_show = $request->get('is_show', 0);

        // 商品分类列表
        $where[] = ['shop_id', seller_shop_info()->shop_id];
        $where[] = ['is_show', 1];
        $where[] = ['parent_id', $id]; // 根据父id查询商品分类
        $condition = [
            'where' => $where,
            'limit' => 0, // 不分页
            'sortname' => 'cat_sort',
            'sortorder' => 'asc'
        ];
        list($list, $total) = $this->shopCategory->getList($condition);

        $tpl = 'picker';
        if ($id > 0) {
            $tpl = 'partials._picker_by_cat_id';
        }
        $render = view('goods.category.'.$tpl, compact('page_id', 'list'))->render();
        return result(0, $render);
    }
}